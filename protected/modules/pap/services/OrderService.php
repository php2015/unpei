<?php

/* 嘉配商城订单逻辑层
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class OrderService {

    /**
     * 创建未付款订单
     * $order参数：一维数组，存放订单基本信息，
     * 包括卖家ID,卖家机构名称，收货地址ID，商品总价，以及订单总金额；
     * $address参数：一维数组，存放订单收货地址信息，
     * 包括订单ID，收货人信息，邮编，手机，固话，省，市，区，详细地址和添加时间
     * $goodsList参数：二维数组，存放订单商品信息，
     * 包括商品ID，商品编号，商品OE号，商品名称，标准名称，品牌，单价，促销价，数量以及商品总价。
     * @param type $result:eg array("order"=>array(),"address"=>array(),"goodsList"=> array())
     */
    public static function create($result) {
        //添加订单基本信息
        $model = new PapOrder();
        if ($result['order']['BuyerID'])
            $result['order']['OrganID'] = $result['order']['BuyerID'];
        else
            $result['order']['OrganID'] = Yii::app()->user->getOrganID();
        $model->attributes = $result["order"];
        $model->save();
        $orderId = $model->ID;
        // $model = PapOrder::model()->findByPk(557);
        if ($orderId) {
            $key = $model['Status'];
            //待付款提醒发给修理厂
            if ($key == 1) {
                $params = array('OrganID' => $result['order']['BuyerID'], 'OrganType' => 3, 'HandleID' => $orderId);
                $params['type'] = array('name' => 'DD', 'key' => $key);
                RemindService::sendRemind($params);
            }

            //发送待付款、待发货提醒给经销商
            $params = array('OrganID' => $result['order']['SellerID'], 'OrganType' => 2, 'HandleID' => $orderId);
            $params['type'] = array('name' => 'DD', 'key' => $key);
            RemindService::sendRemind($params);

//            //生成订单发送邮件
            if (Yii::app()->Params['sendEmail']['send']) {
                self::createSendEmail($result);
            }
            //添加订单收货地址
            unset($model);
            $model = new PapOrderAddress;
            // $model->OrderID = $orderId;
            $result['address']['OrderID'] = $orderId;
            $model->attributes = $result["address"];
            Yii::app()->papdb->createCommand()->insert('pap_order_address', $result['address']);
            // $model->save();
        }
        foreach ($result["goodsList"] as $list) {
            //添加订单商品信息
            $list["OrderID"] = $orderId;
            unset($model);
            if (is_array($list)) {
                //判断商品是否已经添加
                $model = PapOrderGoods::model()->findByAttributes(array(
                    "OrderID" => $orderId,
                    "GoodsID" => $list["GoodsID"],
                ));
                //没有添加则添加，有则累加商品(数量、物流费及总价)
                if (empty($model) && !isset($model)) {
                    $model = new PapOrderGoods();
                    $b = self::UgoodsSalesByGoodsID($list["GoodsID"], $list["Quantity"]);
                } else {
                    $list["Quantity"] = $model['Quantity'] + $list["Quantity"];
                    $list["ShipCost"] = $model['ShipCost'] + $list["ShipCost"];
                    $list["GoodsAmount"] = $model['ProPrice'] ? $model['ProPrice'] + $list["GoodsAmount"] : $model['Price'] + $list["GoodsAmount"];
                    // 修改商品表的销售数量
                    $b = self::UgoodsSalesByGoodsID($list["GoodsID"], $list["Quantity"]);
                }
            } else {
                return false;
            }
            $model->attributes = $list;
            $res = Yii::app()->papdb->createCommand()->insert('pap_order_goods', $list);
            //$model->save();
        }
        //插入机构活动记录表
//        if (!empty($result['order']['PromoID'])) {
//            $times = self::insert_promotion_times($result);
//        }
         if (!empty($result['order']['PromoID'])) {
        OrderService::insert_active_times();
         }
        //优惠活动添加记录
        if (in_array($result['order']['Type'], array(1, 2))) {
            $promotion_order = array(
                'OrderID' => $orderId,
                'PromoID' => $result['order']['PromoID'],
                'Amount' => $result['order']['DecrTotal'],
                'CreateTime' => time(),
                'SellerID' => $result['order']['SellerID']
            );
            //插入优惠活动订单表
            self::insert_promotion_order($promotion_order);
        }
        if (isset($result['order']['UseCouponID']) && !empty($result['order']['UseCouponID'])) {
            //使用优惠券更新使用状态
            self::update_coupon_status($result['order']['UseCouponID']);
            $promotion_order = array(
                'OrderID' => $orderId,
                'CouponID' => $result['order']['UseCouponID'],
                'Amount' => $result['order']['DecrTotal'],
                'CreateTime' => time(),
                'SellerID' => $result['order']['SellerID']
            );
            //插入优惠活动订单表
            self::insert_promotion_order($promotion_order);
        }
        return $orderId;
    }

    // 修改商品表销售的数量，通过商品ID
    public static function UgoodsSalesByGoodsID($goodsID, $quantity) {
        if (empty($goodsID) || empty($quantity)) {
            return;
        }
        $model = PapGoods::model()->findByPk($goodsID, array('select' => 'ID,Sales'))->attributes;
        $b = PapGoods::model()->updateByPk($goodsID, array(
            'Sales' => $model['Sales'] + $quantity
        ));
        return $b;
    }

    /*
     * 获取嘉配订单信息及订单商品信息
     * 适用于选择付款方式页面
     * @param type $result:eg array("order"=>array(),"goodsList"=> array()) 
     */

    public static function order($orderId) {
        $orderArr = array();
        $organID = Yii::app()->user->getOrganID();
        $orders = PapOrder::model()->findAll("ID=:ID and BuyerID=:BuyerID", array(":ID" => $orderId, ':BuyerID' => $organID));
        foreach ($orders as $order) {
            $orderArr['order'] = $order->attributes;
            if (!empty($order['OrderType'])) {
                $discount = PapOrderDiscount::model()->find(array("condition" => "OrderType = {$order['OrderType']}"));
                $orderArr['discount'] = $discount->attributes;
            }
            $goods = PapOrderGoods::model()->findAll("OrderID=:ID and IsDelete=0", array(":ID" => $orderId));
            foreach ($goods as $key => $value) {
                $data = $value->attributes;
                $image = PapGoodsImageRelation::model()->find('GoodsID=:goodsID', array(':goodsID' => $value['GoodsID']));
                $data['ImageUrl'] = $image['ImageUrl'];
                $orderArr['goodsList'][$key] = $data;
            }
        }
        return $orderArr;
    }

    /*
     * 获取订单信息、卖家信息及收货人信息
     * 适用于支付宝付款
     * @param type $result:eg array(""=>"",""=>"",...) 
     */

    public static function paypal($orderid) {
        //获取订单信息
        $order = PapOrder::model()->findByPk($orderid)->attributes;

        //获取卖家支付宝帐号
        $paypal = JpdFinancialPaypal::model()->find('OrganID=:ID', array(':ID' => $order['SellerID']));
        //获取订单收货地址
        $ship = self::getship($orderid);

        $payArr = array();
        $payArr['order_id'] = $order['ID'];  //订单ID
        $payArr['out_trade_no'] = $order['OrderSN'];    //订单编号
        $payArr['subject'] = $order["OrderName"];    //订单名称
        $payArr['seller_email'] = $paypal['PaypalAccount'];     //卖家的支付宝账号
        $payArr['body'] = '';   //订单描述
//        $payArr['price'] = $order['GoodsAmount']/$order['TotalAmount'];   //商品总价
        $payArr['price'] = $order['RealPrice'];  //商品总价
//        $payArr['price'] = $order['TotalAmount'];  //商品总价
        $payArr['logistics_fee'] = $order['ShipCost'];  //物流费
        $payArr['receive_name'] = $ship['ShippingName'];    //收货人信息
        $payArr['receive_address'] = Area::getCity($ship['Province']) . Area::getCity($ship['City']) . Area::getCity($ship['Area']) . $ship['Address'];
        $payArr['receive_zip'] = $ship['ZipCode'];
//        $payArr['receive_phone'] = $ship['Mobile'];
        $payArr['receive_mobile'] = $ship['Mobile'];
        return $payArr;
    }

    /**
     * 获取订单收货地址信息
     * 
     */
    public static function getship($id) {
        $model = PapOrderAddress::model()->find('OrderID=:orderID', array(':orderID' => $id))->attributes;
        return $model;
    }

    /**
     * 获取退货单收货地址信息
     * 
     */
    public static function getreturnship($id) {
        $model = PapReturnAddress::model()->find('ReturnID=:orderID', array(':orderID' => $id))->attributes;
        return $model;
    }

    /**
     * 获取嘉配商城订单信息
     * @param unknown $orderId
     */
    public static function getOrder($orderId) {
        return PapOrder::model()->findByPK($orderId);
    }

    /**
     *    响应嘉配订单支付通知
     *
     *    @author    Garbin
     *    @param     int    $order_id
     *    @param     array  $notify_result
     *    @return    bool
     */
    public static function respondNotify($order_id, $notify_result) {
        if ($notify_result['target'] == ORDER_PENDING) {
            return;
        }
        $where = "ID = {$order_id}";
        $data = array('Status' => $notify_result['target'], 'PayStatus' => $notify_result['trade_status']);
        $OrganID = Yii::app()->user->getOrganID();
        switch ($notify_result['target']) {
            case ORDER_ACCEPTED:
                $where .= ' AND Status=' . ORDER_PENDING;   //只有待付款的订单才会被修改为已付款
                $data['AlipayTN'] = $notify_result['trade_no'];
                $data['PayTime'] = time();

                //更新待付款提醒状态
                RemindService::updateRemindStatus($order_id, 1, $OrganID);
                $sql = 'select SellerID from pap_order where ID=' . $order_id;
                $res = Yii::app()->papdb->createCommand($sql)->queryRow();
                //发送待发货提醒给经销商
                $params = array('OrganID' => $res['SellerID'], 'OrganType' => 2, 'HandleID' => $order_id, 'OrderID' => $order_id, 'TotalAmount' => $res['TotalAmount']);
                $params['type'] = array('name' => 'DD', 'key' => 2);
                RemindService::sendRemind($params);
                //赠送积分
                self::saveIntegral($params);
                break;
            case ORDER_SHIPPED:
                $where .= ' AND Status=' . ORDER_ACCEPTED;  //只有等待发货的订单才会被修改为已发货
                $data['DeliveryTime'] = time();

                break;
            case ORDER_FINISHED:
                $where .= ' AND Status=' . ORDER_SHIPPED;   //只有已发货的订单才会被自动修改为交易完成
                $data['ReceiptTime'] = time();
                break;
            case ORDER_CANCLED:                             //任何情况下都可以关闭
                /* 加回商品库存 */
                break;
        }
        switch ($notify_result['refund']) {
            case 'WAIT_SELLER_AGREE'://待审核
                $data['PayStatus'] = 'WAIT_SELLER_AGREE';
                $data['ReturnStatus'] = '1';
                //$data['AlipayTN'] = $notify_result['trade_no'];
                break;
            case 'WAIT_BUYER_RETURN_GOODS'://等待买家发货
                $data['PayStatus'] = 'WAIT_BUYER_RETURN_GOODS';  //只有等待发货的订单才会被修改为已发货
                $data['ReturnStatus'] = '2';
                break;
            case 'WAIT_SELLER_CONFIRM_GOODS'://等待卖家收货
                $data['PayStatus'] = 'WAIT_SELLER_CONFIRM_GOODS';
                $data['ReturnStatus'] = '3';
                break;
            case 'REFUND_SUCCESS':                             //任何情况下都可以关闭
                /* 加回商品库存 */
                $where .= ' AND Status=' . ORDER_CANCLED;
                $data['PayStatus'] = 'REFUND_SUCCESS';
                $data['ReturnStatus'] = '4';
                break;
        }

        return PapOrder::model()->updateAll($data, $where);
    }

    //获取卖家信息
    public static function getSeller($orderid) {
        $order = PapOrder::model()->findByPK($orderid);
        $dealer = Organ::model()->findByPk($order['SellerID']);
        return $dealer;
    }

    //获取当前登录机构支付宝帐号
    public static function getPayaccount() {
        $organID = Yii::app()->user->getOrganID();
        $account = JpdFinancialPaypal::model()->find('OrganID=:organID and Status=:sta', array(':organID' => $organID, ':sta' => '0'));
        return $account;
    }

    //根据订单状态统计订单数量
    public static function getordercount($organID) {
        $count = array();
//        //未付款
//        $count['paycount'] = PapOrder::model()->count("BuyerID=$organID and Status=1");
//        //待发货
//        $count['shipcount'] = PapOrder::model()->count("BuyerID=$organID and Status=2");
//        //待收货
//        $count['waipcount'] = PapOrder::model()->count("BuyerID=$organID and Status=3");
//        //已收货待评价
//        $count['acceptcount'] = PapOrder::model()->count("BuyerID=$organID and EvaStatus in(0,16) and Status=9");
        $sql1 = "select Status,count(ID) as count from (
                SELECT DISTINCT(po.ID) as ID,po.Status FROM `pap_order` po 
                right join pap_order_goods pog on po.ID=pog.OrderID where po.BuyerID=$organID and po.IsDelete=0
                and po.ReturnStatus=0) as oid group by Status";
        $res1 = Yii::app()->papdb->CreateCommand($sql1)->queryAll();
        foreach ($res1 as $v) {
            switch ($v['Status']) {
                case '1':$count['paycount'] = $v['count'];
                    break;
                case '2':$count['shipcount'] = $v['count'];
                    break;
                case '3':$count['waipcount'] = $v['count'];
                    break;
                //   case '9':$count[9]=$v['count'];break;
            }
        }
        $sql2 = "SELECT DISTINCT(po.ID) as ID FROM `pap_order` po right join pap_order_goods pog on 
                po.ID=pog.OrderID where BuyerID=$organID and Status=9 and (EvaStatus=0 or EvaStatus=16) and po.IsDelete=0";
        $res2 = Yii::app()->papdb->CreateCommand($sql2)->queryAll();
        $count['acceptcount'] = count($res2);
        return $count;
    }

    //操作:确认收货操作 状态改为9
    public static function confirmgoods($orderid) {
        $update = PapOrder::model()->updateByPk($orderid, array('Status' => '9', 'PayTime' => time(), 'ReceiptTime' => time(), 'UpdateTime' => time()), 'IsDelete=0');
        if ($update) {
            //更新待收货提醒状态
            RemindService::updateRemindStatus($orderid, 2);
            //嘉配积分
            $order = PapOrder::model()->findByPk($orderid);
            $Param = array();
            if ($order) {
                $Param['OrderID'] = $orderid; //订单ID
                $Param['OrganID'] = $order['BuyerID']; //购买方机构ID
                $Param['TotalAmount'] = $order['TotalAmount']; //订单总金额
                self::saveIntegral($Param);
            }
        }
        return $update;
    }

    //获取订单列表
    public static function getOrderlist($params) {
        $payment = $params['Payment'];
        $BuyerName = $params['BuyerName'];
        $Status = $params['Status'];
        $EvaStatus = $params['EvaStatus'];
        $OrderSN = $params['search_text'];
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $criteria = new CDbCriteria();
        $criteria->order = "t.CreateTime desc";
        $criteria->condition = "t.BuyerID = {$params['OrganID']}";
        //订单类型
        if ($payment && in_array($payment, array(1, 2))) {
            $criteria->addCondition("t.Payment = $payment", "AND");
        }
        //买家查询
        if ($BuyerName) {
            $model = self::getOrgan(array('OrganName' => $BuyerName));
            $idArr = array();
            foreach ($model as $v) {
                $idArr[] = $v->ID;
            }
            $criteria->addInCondition("t.BuyerID", $idArr);
        }
        //订单状态
        if ($Status && in_array($Status, array(1, 2, 3, 9, 10))) {
            $criteria->addCondition("t.Status = $Status", "AND");
        } else if ($params['SendStatus']) {
            $criteria->addCondition("t.Status in(1,2)", "AND");
        }
        //订单评价
        if ($EvaStatus && $EvaStatus == 1) {
            $criteria->addCondition("t.EvaStatus in(0,15) and t.Status=9 and t.Payment=2", "AND");
        } else if ($EvaStatus == 2) {
            $criteria->addCondition("t.EvaStatus in(16,20) and t.Status=9 and t.Payment=2", "AND");
        }
        //订单号
        if ($OrderSN) {
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
        $criteria->with = 'goods';
        $data = new CActiveDataProvider('PapOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $datas = $data->getData();
        foreach ($datas as $key => $value) {
            $value['SellerName'] = '<div title=' . $datas[$key]['SellerName'] . ' style=" width: 200px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">' . $datas[$key]['SellerName'] . '</div>';
        }
        return $data;
    }

    /**
     * 获取购物车商品总数
     * @return int
     */
    public static function getCartCount() {
        return count(PapCart::model()->findAllByAttributes(array("BuyerID" => Yii::app()->user->getOrganID())));
    }

    public static function createSendEmail($result) {
        //发送邮件
        $email = Yii::app()->Params['sendEmail']['email'];
        $seller = Organ::model()->findByPk($result['order']['SellerID'], array('select' => 'Phone,QQ'))->attributes;
        $buyer = Organ::model()->findByPk($result['order']['BuyerID'], array('select' => 'Phone,QQ'))->attributes;
        $subject = $result['order']['OrderSN'];
        $message = '<p>订单信息</p><table>
            <tr>
                <td>订单编号：</td><td>' . $result['order']['OrderSN'] . '</td>
            </tr>
                        <tr>
                <td>下单时间：</td><td>' . date('Y-m-d H:i:s', $result['order']['CreateTime']) . '</td>
            </tr></table><p>经销商信息</p><table>
                        <tr>
                <td>经销商名称：</td><td>' . $result['order']['SellerName'] . '</td>
            </tr>
                        <tr>
                <td align="right">联系电话：</td><td>' . $seller['Phone'] . '</td>
            </tr>';
        if ($seller['QQ'])
            $message.='<tr><td align="right">QQ号：</td><td>' . $seller['QQ'] . '</td></tr>';
        $message.='</table><p>服务店信息</p><table>
                        <tr>
                <td>服务店名称：</td><td>' . $result['order']['BuyerName'] . '</td>
            </tr>
                        <tr>
                <td align="right">联系电话：</td><td>' . $result["address"]['Mobile'] . '</td>
            </tr>';
        if ($buyer['QQ'])
            $message.='<tr><td align="right">QQ号：</td><td>' . $buyer['QQ'] . '</td></tr>';
        $message.='</table>';
        $host = 'http://' . $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'];
        $message.='<p>备注:来自嘉配(' . $host . ')</p>';
        UserModule::sendMail($email, $subject, $message);
    }

    //订单修改操作
    public static function changeOrder($params) {
        $ID = $params['ID'];
        $idArr = explode(',', $params['idArr']);
        $amountArr = explode(',', $params['amountArr']);
        $payment = $params['payment'];
        $ProPrice = explode(',', $params['ProPrice']);
        $criteria = new CDbCriteria();
        $organID = Yii::app()->user->getOrganID();
        $criteria->condition = "t.BuyerID=$organID and t.IsDelete=0 and ((t.Payment=1 and t.Status=1 and ISNULL(t.AlipayTN)) or (t.Payment=2 and t.Status=2))";
        $order = PapOrder::model()->findByPk($ID, $criteria);
        if ($payment == 1) {
            $status = 1;
        } elseif ($payment == 2) {
            $status = 2;
        }
        if (!$payment) {
            return array('error' => 1, 'msg' => '修改失败，请稍后再试!');
        }
        //订单是否存在
        if (!$order) {
            return array('error' => 1, 'msg' => '改价失败，请稍后再试!');
        }
        //商品数量是否合理
        foreach ($idArr as $k => $v) {
            if (!is_int(intval($amountArr[$k])) || $amountArr[$k] < 0)
                return array('error' => 2, 'msg' => '改价失败，请稍后再试!');
            $orderGoods[$k] = PapOrderGoods::model()->findByPk($v, array(
                        'condition' => "OrderID=$ID"))->attributes;
            if (!$orderGoods[$k])
                return array('error' => 3, 'msg' => '改价失败，请稍后再试!');
        }
        //订单商品价格修改
        $sum = 0;
        //$discount = number_format(($order['RealPrice'] - $order['ShipCost']) / $order['GoodsAmount'], 4);
        // $discount = $order['Discount'] ? $order['Discount'] : "100%";
        foreach ($orderGoods as $k => $v) {
            if ($amountArr[$k] == 0) {
                PapOrderGoods::model()->updateByPk($idArr[$k], array(
                    'IsDelete' => 1,
                    'UpdateTime' => time(),
                        ), "Quantity!=$amountArr[$k] OR ProPrice!=$ProPrice[$k]");
            } else {
                $goods = $ProPrice[$k] * $amountArr[$k];
                PapOrderGoods::model()->updateByPk($idArr[$k], array(
                    'Quantity' => $amountArr[$k],
                    'ProPrice' => $ProPrice[$k],
                    'GoodsAmount' => $goods,
                    'UpdateTime' => time(),
                        ), "Quantity!=$amountArr[$k] OR ProPrice!=$ProPrice[$k]");
                $sum+=$goods;
            }
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
            'Payment' => $payment,
            'Status' => $status
        ));
        return array('success' => 1);
    }

    /*
     * 判断订单，询价单，退货单中谁最新添加了数据
     */

    public static function getnewsshow() {
        //查询最新的一条订单
        $SellerID = Yii::app()->user->getOrganID();
        $ordersql = "SELECT * FROM pap_order where SellerID='" . $SellerID . "' ORDER BY CreateTime DESC LIMIT 1";
        //查询最新的一条询价单
        $inquirysql = "select * from pap_inquiry where Status=0 and DealerID  =  '" . $SellerID . "'  ORDER BY CreateTime DESC LIMIT 1 ";
        //查询最新的一条退货单
        $returnsql = "select * from pap_return_order where Status=1 and DealerID  =  '" . $SellerID . "'  ORDER BY CreateTime DESC LIMIT 1 ";

        $order = Yii::app()->papdb->CreateCommand($ordersql)->queryAll();
        $inquiry = Yii::app()->papdb->CreateCommand($inquirysql)->queryAll();
        $return = Yii::app()->papdb->CreateCommand($returnsql)->queryAll();
        if ($order[0]['CreateTime'] >= $inquiry[0]['CreateTime']) {
            if ($order[0]['CreateTime'] >= $return[0]['CreateTime']) {
                $new = 'order';
            } else {
                $new = 'inquiry';
            }
        } else {
            if ($inquiry[0]['CreateTime'] >= $return[0]['CreateTime']) {
                $new = 'inquiry';
            } else {
                $new = 'return';
            }
        }
        return $new;
    }

    /**
     * 优惠活动生成订单,插入记录表
     * pap_promotion_order
     */
    public static function insert_promotion_order($promotion_order) {
        return Yii::app()->papdb->createCommand()->insert('pap_promotion_order', $promotion_order);
    }

    //随机生成优惠券编号
    public static function gen_coupon_sn() {
        mt_srand((double) microtime() * 1000000);
        $timestamp = time() - date('Z');
        $y = date('y', $timestamp);
        $z = date('z', $timestamp);
        $coupon_sn = $y . str_pad($z, 3, '0', STR_PAD_LEFT) . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $sql = "select CouponSn from pap_coupon_manage where CouponSn =$coupon_sn";
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        if (empty($res['CouponSn'])) {
            /* 否则就使用这个优惠券号 */
            return $coupon_sn;
        }
        /* 如果有重复的，则重新生成 */
        return $this->gen_coupon_sn();
    }

    public static function update_coupon_status($couponID) {
        return Yii::app()->papdb->createCommand()->update('pap_coupon_manage', array(
                    'IsUse' => 1
                        ), 'ID=:ID', array(':ID' => $couponID));
    }

    //获取活动信息
    public static function getHuodong($id) {
        $param = '';
        $sql = 'select PromoID,CouponID,Amount from pap_promotion_order where OrderID=' . $id;
        $promot = Yii::app()->papdb->createCommand($sql)->queryRow();
        //如果已使用优惠券则不参加活动
        if ($promot && $promot['CouponID']) {
            $sql2 = 'select CouponSn,CouponID from pap_coupon_manage where ID=' . $promot['CouponID'];
            $result2 = Yii::app()->papdb->createCommand($sql2)->queryRow();
            $param['CouponSn'] = $result2['CouponSn'];
//            $sql4 = 'select Amount from pap_coupon where ID=' .$result2['CouponID'];
//            $result4 = Yii::app()->papdb->createCommand($sql4)->queryRow();
            $param['Amount'] = isset($result2['Amount']) ? $result2['Amount'] : $promot['Amount'];
        } else if ($promot && $promot['PromoID']) {
            $param['Amount'] = $promot['Amount'];
            $sql3 = 'select Title,Url from pap_promotion where ID=' . $promot['PromoID'];
            $result3 = Yii::app()->papdb->createCommand($sql3)->queryRow();
            $param['Title'] = $result3['Title'];
            $param['Url'] = $result3['Url'];
            $param['PromoID'] = $promot['PromoID'];
        }
        return $param;
    }

    //判断当前日期是否在今天之内
    public static function is_inday($time) {
        $currentstart = strtotime(date("Y-m-d") . " 00:00:00");
        $currentend = strtotime(date("Y-m-d") . ' 23:59:59');
        if ($time >= $currentstart && $time <= $currentend) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
     * 修理厂获取嘉配积分
     * @param OrderID 订单ID / OrganID 购买方机构ID / TotalAmount 订单总金额
     */

    private static function saveIntegral($Param) {
        $SetModel = IntegralSet::model()->findByPk("1");
        if (empty($SetModel)) {
            return 1;
        }
        $IntegralRecordModel = new IntegralRecord();
        $IntegralRecordModel->OrderID = $Param['OrderID'];
        $IntegralRecordModel->OrganID = $Param['OrganID'];
        //计算积分
        $Integral = floor($Param['TotalAmount'] / $SetModel['Value']) * $SetModel['Integral'];
        $IntegralRecordModel->Integral = $Integral;
        $IntegralRecordModel->CreateTime = time();
        if ($IntegralRecordModel->save()) {
            //计算机构当前嘉配总积分
            $IntegralModel = Integral::model()->find("OrganID = {$Param['OrganID']}");
            if (empty($IntegralModel)) {
                $IntegralModel = new Integral();
                $IntegralModel->CreateTime = time();
                $IntegralModel->Integral = 0;
                $IntegralModel->OrganID = $Param['OrganID'];
            }
            $IntegralModel->Integral += $Integral;
            $IntegralModel->UpdateTime = time();
            if ($IntegralModel->save()) {
                return 2;
            }
        }
    }

    public static function insert_active_times() {
        $organID = Yii::app()->user->getOrganID();
        //$promoID = $result['order']['PromoID'];
        $sql = "select * from pap_promotion_times where OrganID=$organID ";
        $pro_times = Yii::app()->papdb->createCommand($sql)->queryRow();
        if (!empty($pro_times) && is_array($pro_times)) {
            $num = $pro_times['Num'] + 1;
            return Yii::app()->papdb->createCommand()->update('pap_promotion_times', array(
                        'Num' => $num,
                        'LastTime' => time(),
                            ), ' OrganID=:organID', array(':organID' => $organID));
        } else {
            return Yii::app()->papdb->createCommand()->insert('pap_promotion_times', array(
                        'OrganID' => $organID,
                        'LastTime' => time(),
                        'Num' => 1
            ));
        }
    }

    public static function is_current_date() {
        $organID = Yii::app()->user->getOrganID();
        $sql = "select LastTime,Num from pap_promotion_times where OrganID=$organID ";
        $pro_times = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $pro_times;
    }

}
