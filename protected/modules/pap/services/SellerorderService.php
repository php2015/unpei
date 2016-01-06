<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SellerorderService {

    //获取订单列表
    public static function getOrderlist($params) {
        $payment = $params['Payment'];
        $BuyerName = $params['BuyerName'];
        $Status = $params['Status'];
        $EvaStatus = $params['EvaStatus'];
        $OrderSN = $params['search_text'];
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 10;
        $criteria = new CDbCriteria();
        $criteria->order = "t.CreateTime desc";
        $criteria->condition = "t.SellerID = {$params['OrganID']} and t.IsDelete=0";
        //订单类型
        if ($payment && in_array($payment, array(1, 2))) {
            $criteria->addCondition("t.Payment = $payment", "AND");
        }
        //买家查询
        if ($BuyerName) {
            $BuyerName = EvaluateService::checkKey(urldecode($BuyerName));
            $model = self::getOrgan(array('OrganName' => $BuyerName));
            $idArr = array();
            foreach ($model as $v) {
                $idArr[] = $v->ID;
            }
            $criteria->addInCondition("t.BuyerID", $idArr);
        }
        //订单状态
        if ($Status && in_array($Status, array(1, 2, 3, 5, 9, 10))) {
            if ($Status == 5) {
                $criteria->addCondition("t.Status = 3 and t.ReturnStatus!=0", "AND");
            } else if ($Status == 3) {
                $criteria->addCondition("t.Status = 3 and t.ReturnStatus=0", "AND");
            } else {
                $criteria->addCondition("t.Status = $Status", "AND");
            }
        } else if ($params['SendStatus']) {
            $criteria->addCondition("t.Status in(1,2)", "AND");
        }
        //订单评价
        if ($EvaStatus && $EvaStatus == 1) {
            $criteria->addCondition("t.EvaStatus in(0,15) and t.Status=9", "AND");
        } else if ($EvaStatus == 2) {
            $criteria->addCondition("t.EvaStatus in(16,20) and t.Status=9", "AND");
        }
        //订单号
        if ($OrderSN) {
            $OrderSN = EvaluateService::checkKey(urldecode($OrderSN));
            $criteria->addCondition("t.OrderSN like '%{$OrderSN}%'");
        }
        //下单时间
        if ($starttime && $endtime) {
            $criteria->addCondition("t.CreateTime > {$starttime} and t.CreateTime < {$endtime}+3600*24", 'AND');
        } else if ($starttime) {
            $criteria->addCondition("t.CreateTime > {$starttime}", 'AND');
        } else if ($endtime) {
            $criteria->addCondition("t.CreateTime < {$endtime}+3600*24", 'AND');
        }
        $data = new CActiveDataProvider('PapOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $datas = $data->getData();
        foreach ($datas as $vv) {
            foreach ($vv->goodsinfo as $v) {
                $v = self::getVersionGoods($v);
            }
        }
        $data->setData($datas);
        return $data;
    }

    //订单数目
    public static function getOrderCount($organ, $eval = '') {
        if ($eval == 'eval') {
            $sql = "SELECT DISTINCT(po.ID) as ID FROM `pap_order` po right join pap_order_goods pog on 
                po.ID=pog.OrderID where SellerID=$organ and Status=9 and (EvaStatus=0 or EvaStatus=15) and po.IsDelete=0";
            return Yii::app()->papdb->CreateCommand($sql)->queryAll();
        } else {
            /* $sql = "select Status,count(ID) as count from (
              SELECT DISTINCT(po.ID) as ID,po.Status FROM `pap_order` po
              right join pap_order_goods pog on po.ID=pog.OrderID where po.SellerID=$organ and po.IsDelete=0
              ) as oid group by Status"; */
            $sql = "select Status,count(ID) as count from pap_order where SellerID=$organ and IsDelete=0 and ReturnStatus=0 group by Status";
            return Yii::app()->papdb->CreateCommand($sql)->queryAll();
        }
    }

    private static function getVersionGoods($v) {
        $res = DealergoodsService::getmongoversion($v['GoodsID'], $v['Version']);
        $goods = $res['GoodsInfo'];
        // if (is_array($goods) && !empty($goods)) {
        //商品图片
        if (is_array($goods['img']) && !empty($goods['img'])) {
            if (!$goods['img'][0]['ImageUrl']) {
                $v['ImageUrl'] = $goods['img'][0]['MallImage'];
            } else {
                $v['ImageUrl'] = $goods['img'][0]['ImageUrl'];
            }
        } else {
            $v['ImageUrl'] = '';
        }
        //商品oe号
        if (is_array($goods['oeno']) && !empty($goods['oeno'])) {
            $oe = '';
            foreach ($goods['oeno'] as $ov) {
                if ($ov) {
                    $oe.=$ov . ',';
                }
            }
            $v['GoodsOE'] = substr($oe, 0, -1);
        } else {
            $v['GoodsOE'] = '';
        }
        $v['GoodsName'] = $goods['Name'];
        $v['GoodsNum'] = $goods['GoodsNO'];
        $v['Brand'] = $goods['Brand'];
        $v['PartsLevelName'] = $goods['PartsLevelName'];
        $v['CpName'] = Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['StandCode']}'"))->attributes['Name'];
        $v['Carmodeltxt'] = MallService::getCarmodeltxt(array('make' => $v['MakeID'], 'series' => $v['CarID'], 'year' => $v['Year'], 'model' => $v['ModelID']));
        return $v;
    }

    //订单详情
    public static function getOrderDetail($id, $cond = '') {
        $criteria = new CDbCriteria();
        $organID = Yii::app()->user->getOrganID();
        if ($cond) {
            $criteria->condition = "t.SellerID=$organID and t.IsDelete=0 and $cond";
        } else {
            $criteria->condition = "t.SellerID=$organID and t.IsDelete=0";
        }
        $criteria->with = array('goodsinfo');
        $model = PapOrder::model()->findByPk($id, $criteria);
        if (!$model) {
            return false;
        }
        foreach ($model->goodsinfo as $v) {
            $v = self::getVersionGoods($v);
        }
        //更新确认时间
        if (!$model->ConfirmTime && $model->Status == 2) {
            PapOrder::model()->updateByPk($id, array('ConfirmTime' => time()));
        }
        //更改待付款提醒状态
        if ($model->Status == 1 || $model->Status == 10) {
            RemindService::updateRemindStatus($id, 1, $organID);
        }
        return $model;
    }

    //设置订单状态，用于页面显示
    public static function showOrderStatus($status, $returnstatus = 0) {
        $newos = '';
        switch ($status) {
            case '1':
                $newos = '买家待付款';
                break;
            case '2':
                $newos = '待发货';
                break;
            case '3':
                if (in_array($returnstatus, array(1, 2, 3, 4))) {
                    $newos = '买家已拒收';
                } else
                    $newos = '买家待收货';
                break;
            case '9':
                $newos = '订单交易完成';
                break;
            case '10':
                $newos = '订单交易取消';
                break;
            case '11':
                $newos = '待退款';
                break;
        }
        return $newos;
    }

    //订单支付方式
    public static function showOrderPayment($payment) {
        switch ($payment) {
            case '1': return '支付宝担保';
            case '2': return '物流代收款';
        }
    }

    //查询机构ID
    protected static function getOrgan($params) {
        $criteria = new CDbCriteria();
        if ($params['OrganName']) {
            $criteria->addCondition("OrganName like '%{$params['OrganName']}%'");
        }
        if ($params['ID']) {
            return Organ::model()->findByPk($params['ID'])->attributes;
        }
        return Organ::model()->findAll($criteria);
    }

    //订单地址
    public static function getOrderAddress($id) {
        $model = PapOrderAddress::model()->find("OrderID=$id")->attributes;
        $str = $model['ShippingName'] . '，';
        if ($model['Mobile'] && $model['TelePhone']) {
            $str.=$model['Mobile'] . '，' . $model['TelePhone'] . '，';
        } else if ($model['Mobile']) {
            $str.=$model['Mobile'] . '，';
        } else if ($model['TelePhone']) {
            $str.=$model['TelePhone'] . '，';
        }
        $address = array(Area::getCity($model['Province']), Area::getCity($model['City']), Area::getCity($model['Area']));
        $str.=$address[2] ? $address[0] . ' ' . $address[1] . ' ' . $address[2] . ' ' :
                $address[0] . ' ' . $address[1] . ' ';
        $str.=$model['Address'] . '，' . $model['ZipCode'];
        return $str;
    }

    //卖家信息
    public static function getSellerOrgan($id) {
        $organ = self::getOrgan(array('ID' => $id));
        $model['OrganName'] = $organ['OrganName'];
        $model['phone'] = $organ['Phone'];
        $model['citys'] = Area::getCity($organ['Province']) . Area::getCity($organ['City']) . Area::getCity($organ['Area']);
        return $model;
    }

    //发货
    public static function getSendOrder($params) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.SellerID = {$params['OrganID']} and t.IsDelete=0");
        $criteria->addCondition("t.Status = 2");
        $criteria->addInCondition("t.ID", $params['ID']);
        $data = new CActiveDataProvider('PapOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
        )));
        foreach ($data->getData() as $v) {
            //更新确认时间
            if (!$v->ConfirmTime && $v->Status == 2) {
                PapOrder::model()->updateByPk($v['ID'], array('ConfirmTime' => time()));
            }
            foreach ($v->goodsinfo as $vv) {
                $vv = self::getVersionGoods($vv);
            }
        }
        return $data;
    }

    //发货订单地址
    public static function getSendAddress($id) {
        //河北省石家庄市长安区小河西村 张（收） 13147218913
        $model = PapOrderAddress::model()->find("OrderID=$id")->attributes;
        $str = '';
        if ($model) {
            $address = array(Area::getCity($model['Province']), Area::getCity($model['City']), Area::getCity($model['Area']));
            $str.=$address[2] ? $address[0] . '' . $address[1] . '' . $address[2] :
                    $address[0] . '' . $address[1];
            $str.=$model['Address'] . ' （' . $model['ShippingName'] . '） ';
            if ($model['Mobile'] && $model['TelePhone']) {
                $str.=$model['Mobile'] . ' ' . $model['TelePhone'];
            } else if ($model['Mobile']) {
                $str.=$model['Mobile'];
            } else if ($model['TelePhone']) {
                $str.=$model['TelePhone'];
            }
        }
        return $str;
    }

    //发货ID检测
    public static function checkSendID($ID) {
        $criteria = new CDbCriteria();
        $OrganID = Yii::app()->user->getOrganID();
        $criteria->addCondition("t.SellerID = $OrganID and t.IsDelete=0");
        $criteria->addCondition("t.Status = 2");
        $criteria->addInCondition("t.ID", $ID);
        $criteria->select = 't.ID,t.BuyerID';
        $model = PapOrder::model()->findAll($criteria);
        if (count($model) != count($ID)) {
            return array('error' => 1, 'msg' => '发货失败，请选择待发货订单');
        }
        //合并发货
        if (count($ID) > 1) {
            $addr = array();
            $name = array();
            foreach ($model as $k => $v) {
                $name[$k] = $v['BuyerID'];
                if ($k >= 1 && $name[$k] != $name[0]) {
                    return array('error' => 2, 'msg' => '发货失败，请选择同一买家');
                }
                $addr[$k] = PapOrderAddress::model()->find(array('condition' => "OrderID={$v['ID']}",
                            'select' => 'ShippingName,ZipCode,Mobile,TelePhone,Province,City,Area,Address'))->attributes;
                if ($k >= 1 && $addr[$k] != $addr[0]) {
                    return array('error' => 3, 'msg' => '发货失败，收货地址不相同');
                }
            }
        }
        return array('success' => 1);
    }

    //订单改价操作
    public static function changeOrder($params) {
        $ID = $params['ID'];
        $idArr = explode(',', $params['idArr']);
        $priceArr = explode(',', $params['priceArr']);
        $criteria = new CDbCriteria();
        $organID = Yii::app()->user->getOrganID();
        $criteria->condition = "t.SellerID=$organID and t.IsDelete=0 and ((t.Payment=1 and t.Status=1 and ISNULL(t.AlipayTN)) or (t.Payment=2 and t.Status=2))";
        $order = PapOrder::model()->findByPk($ID, $criteria);
        //订单是否存在
        if (!$order) {
            return array('error' => 1, 'msg' => '改价失败，订单已经被修改!');
            exit;
        }
        //商品价格是否合理
        foreach ($idArr as $k => $v) {
            $orderGoods[$k] = PapOrderGoods::model()->findByPk($v, array(
                        'condition' => "$priceArr[$k]>0 and $priceArr[$k]<=ProPrice and OrderID=$ID"))->attributes;
            if (!$orderGoods[$k]) {
                return array('error' => 2, 'msg' => '改价失败，价格设置不合理!');
            }
        }
        //订单商品价格修改
        $sum = 0;
        //$discount = number_format(($order['RealPrice'] - $order['ShipCost']) / $order['GoodsAmount'], 4);
        // $discount = $order['Discount'] ? $order['Discount'] : "100%";
        foreach ($orderGoods as $k => $v) {
            $goods = $v['Quantity'] * $priceArr[$k];
            PapOrderGoods::model()->updateByPk($idArr[$k], array(
                'ProPrice' => $priceArr[$k],
                'GoodsAmount' => $goods,
                'UpdateTime' => time(),
                    ), "ProPrice!=$priceArr[$k]");
            $sum+=$goods;
        }
        //return $discount;
        //  $real = sprintf("%.2f", $sum * $discount / 100) + $order['ShipCost'];
        $real = $sum + $order['ShipCost'];
        $RealPrice = $real >= 0.01 ? $real : 0.01;
        PapOrder::model()->updateByPk($ID, array(
            'GoodsAmount' => $sum,
            'TotalAmount' => $RealPrice,
            'RealPrice' => $RealPrice,
            'UpdateTime' => time(),
                ), '(Payment=1 and Status=1 and ISNULL(AlipayTN)) or (Payment=2 and Status=2)');
        return array('success' => 1);
    }

    //订单发货
    public static function sendOrder($params, $ID, $OrganID) {
        $sql = "select * from pap_order t where t.SellerID = $OrganID and t.IsDelete=0 and Status=2 and t.ID in($ID)";
        $model = Yii::app()->papdb->createCommand($sql)->queryAll();
        if (!$model) {
            return array('error' => 4, 'msg' => '发货失败，请稍后再试!');
        }
        $goodsid = explode(',', $params['goodsid']);
        $pn = explode('|', $params['PN']);
        $idarr = explode(',', $ID);
        if (count($model) != count($idarr)) {
            return array('error' => 1, 'msg' => '发货失败，请稍后再试!');
        }


        foreach ($model as $v) {
            // 如果是支付宝订单，则调用确认收货接口
            $isAlipay = false;
            $alipayResult = false;
            $alipayError = "";
            $paymentMethod = $v['Payment'];
            if ($paymentMethod == '1') {
                $isAlipay = true;
                // 订单交易号是否存在
                if (!$v['AlipayTN']) {
                    return array('error' => 2, 'msg' => '订单支付信息错误');
                    Yii::app()->end();
                }
                $payment = Yii::app()->alipay;
                // 确认收货请求参数
                $request = new AlipaySendConfirmRequest();
                $request->trade_no = $v['AlipayTN'];
                if ($params['ShipSn'])
                    $request->invoice_no = $params['ShipSn'];
                $request->logistics_name = $params['ShipLogis'];
                $request->transport_type = "EXPRESS";
                // var_dump($request).'<br>';
                //建立请求
                $html_text = $payment->buildRequestHttp($request);
                //解析XML
                //注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
                $doc = new DOMDocument();
                $doc->loadXML($html_text);
                if (!empty($doc->getElementsByTagName("alipay")->item(0)->nodeValue)) {
                    $alipay = $doc->getElementsByTagName("alipay")->item(0);
                    //echo $alipay->nodeValue;
                    $is_success = $alipay->getElementsByTagName("is_success")->item(0)->nodeValue;
                    if ($is_success == 'T') {
                        $alipayResult = true;
                    } else {
                        $alipayResult = false;
                        $alipayError = $alipay->getElementsByTagName("error")->item(0)->nodeValue;
                    }
                }

                // 记录日志
                $userId = Yii::app()->user->id;
                $payment->put_send_goods_log($v, $request->getParams(), $html_text, $alipayResult, $userId);
            }
            // 如果是支付宝，并且支付宝接口返回成功  或者 不是支付宝，保存物流信息
            $bool = false;
            if (!$isAlipay || ($isAlipay && $alipayResult)) {
                $bool = PapOrder::model()->updateByPk($v['ID'], array(
                    'Status' => 3,
                    'UpdateTime' => time(),
                    'DeliveryTime' => time(),
                    'ShipSn' => $params['ShipSn'],
                    'ShipLogis' => $params['ShipLogis'],
                    'PayStatus' => $isAlipay === true ? 'WAIT_BUYER_CONFIRM_GOODS' : ''
                ));
                if ($bool) {
                    //更新待发货提醒状态
                    RemindService::updateRemindStatus($v['ID'], 2, $v['SellerID']);
                    //待收货提醒给修理厂
                    $params = array('OrganID' => $v['BuyerID'], 'OrganType' => 3, 'HandleID' => $v['ID']);
                    $params['type'] = array('name' => 'DD', 'key' => 2);
                    RemindService::sendRemind($params, $v);
                }
            } else {
                return array('error' => 3, 'msg' => '支付宝接口繁忙，请重新发货！');
            }
        }
        //订单商品
        if ($goodsid && $pn) {
            foreach ($goodsid as $k => $v) {
                if (preg_match('/^[A-Za-z0-9][A-Za-z0-9,，-]*$/', $pn[$k])) {
                    PapOrderGoods::model()->updateByPk($v, array(
                        'PN' => $pn[$k],
                        'UpdateTime' => time(),
                    ));
                }
            }
        }
         return array('success' => 1);
        //$userid = RemindService::getUserID($model[0]['BuyerID']);
       // return array('success' => 1, 'userid' => $userid);
    }

    //订单发货
    public static function editSendOrder($params) {
        $ID = $params['ID'];
        //订单状态更改
        $criteria = new CDbCriteria();
        $organID = Yii::app()->user->getOrganID();
        $criteria->condition = "t.SellerID=$organID and t.IsDelete=0 and t.Status=3 and t.ReturnStatus=0"; // and (ISNULL(t.ShipSn) or t.ShipSn='')
        $criteria->with = array('goodsinfo');
        $model = PapOrder::model()->findByPk($ID, $criteria)->attributes;
        if (!$model) {
            return array('error' => 1, 'msg' => '发货修改失败，请稍后再试!');
        }

        //如果是支付宝订单，则调用确认收货接口
        $isAlipay = false;
        $alipayResult = false;
        $alipayError = "";
        $paymentMethod = $model['Payment'];
        if ($paymentMethod == '1') {
            $isAlipay = true;
            // 订单交易号是否存在
            if (!$model['AlipayTN']) {
                return array('error' => 2, 'msg' => '订单支付信息错误');
                Yii::app()->end();
            }
            $payment = Yii::app()->alipay;
            // 确认收货请求参数
            $request = new AlipaySendConfirmRequest();
            //  $request->trade_no = $v['AlipayTN'];
            $request->invoice_no = $params['ShipSn'];
            $request->logistics_name = $params['ShipLogis'];
            $request->transport_type = "EXPRESS";

            //建立请求
            $html_text = $payment->buildRequestHttp($request);

            //var_dump($html_text);
            //解析XML
            //注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
            $doc = new DOMDocument();
            $doc->loadXML($html_text);
            if (!empty($doc->getElementsByTagName("alipay")->item(0)->nodeValue)) {
                $alipay = $doc->getElementsByTagName("alipay")->item(0);
                //echo $alipay->nodeValue;
                $is_success = $alipay->getElementsByTagName("is_success")->item(0)->nodeValue;
                if ($is_success == 'T') {
                    $alipayResult = true;
                } else {
                    $alipayResult = false;
                    $alipayError = $alipay->getElementsByTagName("error")->item(0)->nodeValue;
                }
            }

            // 记录日志
            $userId = Yii::app()->user->id;
            $payment->put_send_goods_log($model, $request->getParams(), $html_text, $alipayResult, $userId);
        }
        // 如果是支付宝，并且支付宝接口返回成功  或者 不是支付宝，保存物流信息
        $bool = false;
        if (!$isAlipay || ($isAlipay && $alipayResult)) {
            $bool = PapOrder::model()->updateByPk($ID, array(
                'UpdateTime' => time(),
                //    'DeliveryTime' => time(),
                'ShipSn' => $params['ShipSn'],
                'ShipLogis' => $params['ShipLogis'],
            ));
        }
        return array('success' => 1);
    }

    //返回时间
    public static function returnTime($time) {
        return date('Y-m-d H:i:s', $time);
    }

    //返回平均价格
    public static function getAverageprice($total, $num) {
        return '￥' . sprintf('%.2f', $total / $num); //number_format($total/$num,2,'.');
    }

    //最多商品
    public static function getMostBuyGoods($goods, $num) {
        return $goods . " ({$num}件)";
    }

    //商品销售条件
    public static function getGoodsCond($params) {
        $OrganID = $params['OrganID'];
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        //查询订单ID
        $seaCon = " select distinct ID from pap_order as t where";
        //去掉待付款订单
        $seaCon.= " t.SellerID = $OrganID and t.IsDelete = 0 and (case when t.Payment=1 then t.Status!=1 else t.Payment=2 end)";
        //下单时间
        if ($starttime && $endtime) {
            $seaCon.=" and t.CreateTime > {$starttime} and t.CreateTime < {$endtime}+3600*24";
        } else if ($starttime) {
            $seaCon.=" and t.CreateTime > {$starttime}";
        } else if ($endtime) {
            $seaCon.=" and t.CreateTime < {$endtime}+3600*24";
        } else {
            $seaCon.=" and t.CreateTime >" . strtotime(date('Y-m-01')) . " and t.CreateTime < " . strtotime(date('Y-m-d')) . "+3600*24";
        }
        $model = Yii::app()->papdb->CreateCommand($seaCon)->queryAll();
        if ($model) {
            $idStr1 = '';
            foreach ($model as $v) {
                $idStr1.=$v['ID'] . ',';
            }
        }
        $idStr = $idStr1 ? substr($idStr1, 0, -1) : "''";
        //查询商品数量、总销售额
        $sql = "select sum(Quantity) as ReQuantity,sum(GoodsAmount) as ShipCost,GoodsNum,GoodsName";
        $sql.=" from pap_order_goods t where t.OrderID in ($idStr)";
        //商品名称、编号
        if (!empty($params['search_text'])) {
            $goods = $params['search_text'];
            $sql.="and (GoodsNum like '%{$goods}%' or GoodsName like '%{$goods}%')";
        }
        $sql.=" group by t.GoodsID order by ShipCost DESC";
        return $sql;
    }

    //商品销售统计
    public static function getSellGoodsList($params) {
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $page = $params['page'] ? $params['page'] : 1;
        $seaCon = self::getGoodsCond($params);
        $count = Yii::app()->papdb->createCommand("SELECT COUNT(*) FROM($seaCon) bb")->queryScalar();
        $data = new CSqlDataProvider($seaCon, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            $datas[$k]['rowNO'] = $k + 1 + ($page - 1) * $pageSize;
        }
        $data->setData($datas);
        return $data;
    }

    //商品销售统计导出
    public function SellGoodsExport($params) {
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $page = $params['page'] ? $params['page'] : 1;
        $offset = ($page - 1) * $pageSize;
        $seaCon = self::getGoodsCond($params);
        $data = Yii::app()->papdb->createCommand($seaCon . " limit $offset,$pageSize")->queryAll();

        //导出
        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        //报表头的输出
        $objectPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objectPHPExcel->getActiveSheet()->setCellValue('A1', '商品销售统计表');
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $time = '';
        if ($params['starttime'] && $params['endtime']) {
            $time = date('Y-m-d', $params['starttime']) . '至' . date('Y-m-d', $params['endtime']);
        } elseif ($params['starttime']) {
            $time = date('Y-m-d', $params['starttime']) . '至' . date('Y-m-d');
        } elseif ($params['endtime']) {
            $time = '~至' . date('Y-m-d', $params['endtime']);
        } else {
            $time = '';
        }
        $objectPHPExcel->getActiveSheet()->setCellValue('A2', $time);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')->getFont()->setSize(14);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objectPHPExcel->getActiveSheet()->getStyle('A2:G2')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //表格头的输出
        $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '排名');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '商品编号');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '商品名称');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '销售量');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '销售额');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '均价');

        //设置行高
        $objectPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);
        $objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objectPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $objectPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(true);

        //设置居中
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //设置边框
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $n = 0;
        //  $no = $pages->pageSize * $pages->currentPage + 1;
        $no = $offset + 1;
        foreach ($data as $product) {
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($n + 4), $no);
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 4), $product['GoodsNum']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 4), $product['GoodsName']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 4), $product['ReQuantity']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), '￥' . $product['ShipCost']);
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($n + 4), '￥' . round($product['ShipCost'] / $product['ReQuantity'], 2));

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . $currentRowNum)
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . $currentRowNum)
                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . $currentRowNum)
                    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . $currentRowNum)
                    ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . $currentRowNum)
                    ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . $currentRowNum)
                    ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . $currentRowNum)
                    ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $n+=1;
            $no++;
        }
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

        ob_end_clean();
        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . iconv("utf-8", "gb2312", "商品销售统计表-") . date("Ymd") . rand(1000, 9999) . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    //客户购买条件
    public static function getCustomCond($params) {
        $OrganID = $params['OrganID'];
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $seaCon = " SellerID = $OrganID and IsDelete = 0 and (case when t.Payment=1 then t.Status!=1 else t.Payment=2 end)";
        //下单时间
        if ($starttime && $endtime) {
            $seaCon.=" and t.CreateTime > {$starttime} and t.CreateTime < {$endtime}+3600*24";
        } else if ($starttime) {
            $seaCon.=" and t.CreateTime > {$starttime}";
        } else if ($endtime) {
            $seaCon.=" and t.CreateTime < {$endtime}+3600*24";
        } else {
            $seaCon.=" and t.CreateTime >" . strtotime(date('Y-m-01')) . " and t.CreateTime < " . strtotime(date('Y-m-d')) . "+3600*24";
        }
        if (!empty($params['search_text'])) {
            $BuyerName = $params['search_text'];
            $seaCon.=" and BuyerName like '%{$BuyerName}%'";
        }
        return $seaCon;
    }

    //客户购买统计
    public static function getSellCustomList($params) {
        $page = $params['page'] ? $params['page'] : 1;
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $seaCon = "select count(ID) as Status,sum(TotalAmount) as GoodsAmount,BuyerID,BuyerName from pap_order t where";
        $cond = self::getCustomCond($params);
        $seaCon.=$cond . ' group by BuyerID order by GoodsAmount DESC';
        $count = Yii::app()->papdb->createCommand("SELECT COUNT(*) FROM($seaCon) bb")->queryScalar();
        $data = new CSqlDataProvider($seaCon, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            $sql = "select sum(Quantity) as goods_count,GoodsNum FROM `pap_order_goods` where 
                 OrderID in(select ID from pap_order t where BuyerID={$v['BuyerID']} and $cond)
                         group by GoodsID order by goods_count desc";
            $res = Yii::app()->papdb->CreateCommand($sql)->queryAll();
            $datas[$k]['goods_count'] = $res[0]['goods_count'];
            $datas[$k]['GoodsNum'] = $res[0]['GoodsNum'];
            $datas[$k]['rowNO'] = $k + 1 + ($page - 1) * $pageSize;
        }
        $data->setData($datas);
        return $data;
    }

    //客户购买统计导出
    public static function SellCustomExport($params) {
//        $seaCon = self::($params);
//        $data = Yii::app()->papdb->CreateCommand($seaCon)->queryAll();
        $page = $params['page'] ? $params['page'] : 1;
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $offset = ($page - 1) * $pageSize;
        $seaCon = "select count(ID) as Status,sum(TotalAmount) as GoodsAmount,BuyerID,BuyerName from pap_order t where";
        $cond = self::getCustomCond($params);
        $seaCon.=$cond . ' group by BuyerID order by GoodsAmount DESC';
        // return $seaCon . " limit $offset,$pageSize";
        $data = Yii::app()->papdb->createCommand($seaCon . " limit $offset,$pageSize")->queryAll();
        foreach ($data as $k => $v) {
            $sql = "select sum(Quantity) as goods_count,GoodsNum FROM `pap_order_goods` where 
                 OrderID in(select ID from pap_order t where BuyerID={$v['BuyerID']} and $cond) group by GoodsNum order by goods_count desc";
            $res = Yii::app()->papdb->CreateCommand($sql)->queryAll();
            $data[$k]['goods_count'] = $res[0]['goods_count'];
            $data[$k]['GoodsNum'] = $res[0]['GoodsNum'];
            $data[$k]['rowNO'] = $k + 1;
            $data[$k]['BuyerName'] = Organ::model()->findByPk($v['BuyerID'])->attributes['OrganName'];
        }
        //导出
        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        //报表头的输出
        $objectPHPExcel->getActiveSheet()->mergeCells('A1:E1');
        $objectPHPExcel->getActiveSheet()->setCellValue('A1', '客户购买统计表');
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $time = '';
        if ($params['starttime'] && $params['endtime']) {
            $time = date('Y-m-d', $params['starttime']) . '至' . date('Y-m-d', $params['endtime']);
        } elseif ($params['starttime']) {
            $time = date('Y-m-d', $params['starttime']) . '至' . date('Y-m-d');
        } elseif ($params['endtime']) {
            $time = '~至' . date('Y-m-d', $params['endtime']);
        } else {
            $time = '';
        }
        $objectPHPExcel->getActiveSheet()->setCellValue('A2', $time);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')->getFont()->setSize(14);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objectPHPExcel->getActiveSheet()->getStyle('A2:G2')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //表格头的输出
        $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '排名');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '机构名称');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '订单个数');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '购买总额');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '购买最多');

        //设置行高
        $objectPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);
        $objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objectPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $objectPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true);

        //设置居中
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')
                ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //设置边框
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')
                ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')
                ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')
                ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:E3')
                ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $n = 0;
        foreach ($data as $product) {
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($n + 4), $product['rowNO']);
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 4), $product['BuyerName']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 4), $product['Status']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 4), '￥' . $product['GoodsAmount']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), $product['GoodsNum']);

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':E' . $currentRowNum)
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':E' . $currentRowNum)
                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':E' . $currentRowNum)
                    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':E' . $currentRowNum)
                    ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':E' . $currentRowNum)
                    ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':E' . $currentRowNum)
                    ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':E' . $currentRowNum)
                    ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $n+=1;
        }
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

        ob_end_clean();
        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . iconv("utf-8", "gb2312", "客户购买统计表-") . date("Ymd") . rand(1000, 9999) . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    //订单交易统计
    public static function getSellOrderList($params) {
        $page = $params['page'] ? $params['page'] : 1;
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $seaCon = self::getOrderCond($params);
        $count = Yii::app()->papdb->createCommand(str_replace('t.*', 'count(*)', $seaCon))->queryScalar();
        $data = new CSqlDataProvider($seaCon, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $datas = $data->getData();
        $i = 0;
        $total = 0;
        foreach ($datas as $k => $v) {
            $datas[$k]['rowNO'] = $k + 1 + ($page - 1) * $pageSize;
            $datas[$k]['Info'] = "<a href='" . Yii::app()->createUrl('/pap/sellerorder/detail', array('ID' => $v['ID'])) . "'>订单详情</a>";
            if (!$v['BuyerName']) {
                $datas[$k]['BuyerName'] = Organ::model()->findByPk($v['BuyerID'], array('select' => 'OrganName'))->attributes['OrganName'];
            }
            $i++;
            $total+=$v['RealPrice'];
        }
        // var_dump($datas);die;
        $data->setData($datas);
        return array('dataProvider' => $data, 'count' => $i, 'total' => $total);
    }

    //交易统计条件
    public static function getOrderCond($params) {
        $payment = $params['Payment'];
        $Status = $params['Status'];
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $OrganID = $params['OrganID'] ? $params['OrganID'] : Yii::app()->user->getOrganID();
        $seaCon = "select t.* from pap_order t where";
        $seaCon.= " SellerID = $OrganID and IsDelete = 0";
        //订单状态
        if ($Status && in_array($Status, array(1, 2, 3, 5, 9, 10))) {
            if ($Status == 5)
                $seaCon.=" and t.Status = 3 and t.ReturnStatus!=''";
            else
                $seaCon.=" and t.Status = $Status";
        }
        //订单类型
        if ($payment && in_array($payment, array(1, 2))) {
            $seaCon.=" and t.Payment = $payment";
        }
        //下单时间
        if ($starttime && $endtime) {
            $seaCon.=" and t.CreateTime > {$starttime} and t.CreateTime < {$endtime}+3600*24";
        } else if ($starttime) {
            $seaCon.=" and t.CreateTime > {$starttime}";
        } else if ($endtime) {
            $seaCon.=" and t.CreateTime < {$endtime}+3600*24";
        } else {
            $seaCon.=" and t.CreateTime >" . strtotime(date('Y-m-01')) . " and t.CreateTime < " . strtotime(date('Y-m-d')) . "+3600*24";
        }
        if (!empty($params['search_text'])) {
            $BuyerName = $params['search_text'];
            $seaCon.=" and BuyerName like '%{$BuyerName}%'";
        }
        $seaCon.=" order by CreateTime DESC";
        return $seaCon;
    }

    //订单交易统计导出
    public static function SellCountExport($params) {
        $page = $params['page'] ? $params['page'] : 1;
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $offset = ($page - 1) * $pageSize;
        $seaCon = self::getOrderCond($params);
        // return $seaCon . " limit $offset,$pageSize";
        $data = Yii::app()->papdb->createCommand($seaCon . " limit $offset,$pageSize")->queryAll();
        //导出
        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        //报表头的输出
        $objectPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objectPHPExcel->getActiveSheet()->setCellValue('A1', '订单交易统计表');
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objectPHPExcel->getActiveSheet()->mergeCells('A2:B2');
        $time = '';
        if ($params['starttime'] && $params['endtime']) {
            $time = date('Y-m-d', $params['starttime']) . '至' . date('Y-m-d', $params['endtime']);
        } elseif ($params['starttime']) {
            $time = date('Y-m-d', $params['starttime']) . '至' . date('Y-m-d');
        } elseif ($params['endtime']) {
            $time = '~至' . date('Y-m-d', $params['endtime']);
        } else {
            $time = '';
        }
        $objectPHPExcel->getActiveSheet()->setCellValue('A2', $time);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')->getFont()->setSize(14);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objectPHPExcel->getActiveSheet()->getStyle('A2:G2')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //表格头的输出
        $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '序号');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '订单编号');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '下单时间');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '机构名称');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '支付方式');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '订单状态');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '订单总金额');

        //设置行高
        $objectPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);
        $objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objectPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $objectPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(true);

        //设置居中
        $objectPHPExcel->getActiveSheet()->getStyle('A3:G3')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:G3')
                ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //设置边框
        $objectPHPExcel->getActiveSheet()->getStyle('A3:G3')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:G3')
                ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:G3')
                ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:G3')
                ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:G3')
                ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $allGoodsAmount = 0;
        $n = 0;
        $no = $offset + 1;
        foreach ($data as $product) {
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($n + 4), $no);
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 4), $product['OrderSN']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 4), date('Y-m-d H:i:s', $product['CreateTime']));
            if (!$product['BuyerName']) {
                $product['BuyerName'] = Organ::model()->findByPk($product['BuyerID'], array('select' => 'OrganName'))->attributes['OrganName'];
            }
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 4), $product['BuyerName']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), self::showOrderPayment($product['Payment']));
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($n + 4), self::showOrderStatus($product['Status'], $product['ReturnStatus']));
            $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($n + 4), '￥' . $product['TotalAmount']);
            $allGoodsAmount+=$product['TotalAmount'];

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . $currentRowNum)
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . $currentRowNum)
                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . $currentRowNum)
                    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . $currentRowNum)
                    ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . $currentRowNum)
                    ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . $currentRowNum)
                    ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . $currentRowNum)
                    ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $n+=1;
            $no++;
        }
        //设置订单个数
        $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 4), '订单总数');
        $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), $n . '个');
        //设置总金额
        $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($n + 4), '订单总额共计');
        $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($n + 4), '￥' . $allGoodsAmount);
        //设置边框
        $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . ($n + 4))
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . ($n + 4))
                ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . ($n + 4))
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . ($n + 4))
                ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . ($n + 4))
                ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . ($n + 4))
                ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':G' . ($n + 4))
                ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

        ob_end_clean();
        ob_start();

        header('Content-Type : application/vnd.ms-excel;charset=gbk');
        header('Content-Disposition:attachment;filename="' . iconv("utf-8", "gb2312", "订单交易统计表-") . date("Ymd") . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    //获取商品图片
    public static function getOneGoodsImage($id) {
        return PapGoodsImageRelation::model()->find(array('condition' => "GoodsID=$id",
                    'select' => 'ImageUrl'))->attributes['ImageUrl'];
    }

}

?>
