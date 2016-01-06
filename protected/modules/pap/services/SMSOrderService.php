<?php

//修理厂回复短信确认生成订单接口
Class SMSOrderService {

    // 生成订单
    public static function createorder($quoID, $schID, $payment, $address) {
        $sql_findQuo = 'select * from pap_quotation where QuoID=' . $quoID;
        $Quoinfo = self::excutesql(array('sql' => $sql_findQuo, 'db' => 'pap'));
        $Quoinfo = $Quoinfo[0];
        //获取方案信息
        $sql_findshem = 'select * from pap_quotation_scheme where SchID=' . $schID;
        $schemeinfo = self::excutesql(array('sql' => $sql_findshem, 'db' => 'pap'));
        $schemeinfo = $schemeinfo[0];
        //获取方案对应的商品
        $sql_goods = 'select * from pap_quotation_goods where SchID=' . $schID;
        $goodsinfo = self::excutesql(array('sql' => $sql_goods, 'db' => 'pap'));
        //获取商品数量,以便生成均价
        $totalnum = 0; //总数量
        $lmstotal = 0; //总价
        $factdiscount = 100;

        $discount = PapOrderDiscount::model()->find('OrderType=:OrderType', array(':OrderType' => 2));
        if ($discount) {
            if ($payment == 1) {
                $factdiscount = $discount['OrderAlipay'] ? $discount['OrderAlipay'] : 100;
            } else if ($payment == 2) {
                $factdiscount = $discount['OrderLogis'] ? $discount['OrderLogis'] : 100;
            }
        } else {
            $factdiscount = 100;
        }

        $totalgoods;
        foreach ($goodsinfo as $kk => $value) {
             if(!empty($value['Version'])){
            $_sql_find_version='select Info from pap_goods_version where GoodsID='.$value['GoodsID'].' and Version='.$value['Version'];
            $goods_versi=Yii::app()->papdb->createCommand($_sql_find_version)->queryRow();   
            $goodsbyid=json_decode($goods_versi['Info'],true);
                        $oes;
                        if($goodsbyid['oeno']){
                            if(!is_array($goodsbyid['oeno'][0])){
                                 $oes= implode('、', $goodsbyid['oeno']);    
                            }
                        }else{
                                $oes = PapGoods::getOENOSByGoodsID($value['GoodsID']);   
                        }
            }else{
                  $goodsbyid = PapGoods::model()->findByPK($value['GoodsID']);
            $oes = PapGoods::getOENOSByGoodsID($value['GoodsID']);   
            }
            if ($goodsbyid) {
                $lmstotal+=round($value['Price'] * $value['Num'] * $factdiscount / 100, 2);
                $ppprice = $value['Price'] * $factdiscount / 100;
                $totalnum+= $value['Num'];
                $totalgoods[$kk] = array(
                    "GoodsID" => $value['GoodsID'],
                    "GoodsNum" => $goodsbyid['GoodsNO'],
                    "GoodsOE" => $oes ? $oes : '',
                    "GoodsName" => $goodsbyid['Name'],
                    "CpName" => $goodsbyid['StandCode'] ? self::getCpName($goodsbyid['StandCode']) : '',
                    "Brand" => self::getBrand($goodsbyid['BrandID']),
                    "Price" => $goodsbyid['Price'],
                    "ProPrice" => round($ppprice, 2), //$values['Price']+$minus ,
                    "Quantity" => $value['Num'],
                    "GoodsAmount" => round($value['Num'] * $ppprice, 2),
                    "CreateTime" => time(),
                    "UpdateTime" => time(),
                     "Version"=>$goodsbyid['Version']
                );
            }
        }
        //获取经销商最小价格
        $min_price = PapOrderMinTurnover::model()->find('OrganID=:OrganID', array(':OrganID' => $Quoinfo['DealerID']));
        $min_price = $min_price['MinTurnover'];
        //获取经销商信息
        $sql_dealer = 'select * from jpd_organ where ID=' . $Quoinfo['DealerID'];
        $dealerinfo = self::excutesql(array('sql' => $sql_dealer, 'db' => 'jpd'));
        $dealerinfo = $dealerinfo[0];
        //生成订单编号
        $order_sn = self::gen_order_sn();

        // 修改询价单状态
        $updateinquiry = PapInquiry::model()->updateByPK($Quoinfo['InquiryID'], array('Status' => 2));

        //修改别的报价单状态，改为已拒绝
        $sql_dppend = 'select * from pap_quotation where InquiryID=' . $Quoinfo['InquiryID'];
        $dppall = self::excutesql(array('sql' => $sql_dppend, 'db' => 'pap'));
        foreach ($dppall as $keyy => $valuee) {
            if ($valuee['QuoID'] != $quoID) {
                PapQuotation::model()->updateByPK($valuee['QuoID'], array('Status' => 4));
            }
        }
        if ($updateinquiry != 1) {
            //确认询价单失败
            return array('success' => false, 'msg' => 'check inquiry fail','QuoID'=>$quoID,'data'=>'确认询价单失败');
            exit;
        }

        //修改方案状态
        $updateschemsql = 'update pap_quotation_scheme set Status="2" where SchID=' . $schID;
        $updateschem = Yii::app()->papdb->createCommand($updateschemsql)->execute();
        if ($updateschem != 1) {
            //确认报价单方案失败
            return array('success' => false, 'msg' => 'check quo scheme fail','QuoID'=>$quoID,'data'=>'确认报价单方案失败');
            exit;
        }
        // 修改报价单状态
        $discountdesc = self::getpriceratio($Quoinfo['DealerID'], $Quoinfo['ServiceID']);
        $updateQuo = PapQuotation::model()->updateByPK($quoID, array('Status' => 2, 'Discount' => $discountdesc['type'] . ',' . $discountdesc['discount']));
        if ($updateQuo != 1) {
            //更新报价单状态失败
            return array('success' => false, 'msg' => 'update quo status fail','QuoID'=>$quoID,'data'=>'更新报价单状态失败');
            exit;
        }
        //生成平摊金额
        $amountlist = 0;
        $minus = 0;
        if ($min_price && $min_price > $lmstotal) {
            $minus = round(($min_price - $lmstotal) / $totalnum, 2);
            $amountlist = $lmstotal + $minus * $totalnum;
            if ($amountlist < $min_price) {
                $amountlist = $min_price;
            }
        } else {
            $amountlist +=$lmstotal;
        }
        $find_lsm_orgname = 'select OrganName from jpd_organ where ID=' . $Quoinfo['ServiceID'];
        $lms_orgname = Yii::app()->jpdb->createCommand($find_lsm_orgname)->queryRow();
        $params = array(
            "OrderSN" => "DD" . $order_sn,
            "OrderName" => "嘉配订单:DD" . $order_sn,
            "SellerID" => $dealerinfo["ID"],
            "OrganID" => $dealerinfo["ID"],
            "SellerName" => $dealerinfo["OrganName"],
            "BuyerID" => $Quoinfo['ServiceID'], //Yii::app()->user->getOrganID(),
            "BuyerName" => $lms_orgname['OrganName'], //Commonmodel::getOrganName(),
            "Payment" => $payment,
            "OrderType" => 2, //订单类型
            'Discount' => $factdiscount,
            'GoodsAmount' => $amountlist,
            'ShipCost' => $schemeinfo['ShipFee'],
            'TotalAmount' => $amountlist + $schemeinfo['ShipFee'],
            'RealPrice' => $amountlist + $schemeinfo['ShipFee'],
            "Status" => ($payment == 1) ? 1 : 2,
            "CreateTime" => time(),
            "UpdateTime" => time()
        );
        $orderID = self::saveorderinfo($params);
        if (!$orderID) {
            //创建订单失败
            return array('success' => false, 'msg' => 'create order fail','QuoID'=>$quoID,'data'=>'创建订单失败');
            exit;
        }
        //保存订单编号到询价单表
        PapInquiry::model()->updateByPK($Quoinfo['InquiryID'], array('OrderSn' => "DD" . $order_sn,));

        //保存订单ID到报价单表
        PapQuotation::model()->updateByPK($quoID, array('OrderID' => $orderID));

        //保存订单商品                           
        self::saveordergoods($totalgoods, $orderID, $minus);
        //保存地址
        if ($orderID) {
            $adressinfo = self::getaddressbypk($address);
            $addr = array(
                'OrderID' => $orderID,
                'ShippingName' => $adressinfo['ContactName'],
                'ZipCode' => $adressinfo['ZipCode'],
                'Mobile' => $adressinfo['Phone'],
                'TelePhone' => $adressinfo['TelPhone'],
                'Province' => $adressinfo['State'],
                'City' => $adressinfo['City'],
                'Area' => $adressinfo['District'],
                'Address' => $adressinfo['Address'],
                'CreateTime' => time()
            );
            self::saveinquiryaddress($addr);
        }
        //生成订单通知经销商
        if ($payment == 1) {
            //待付款
            $params = array('OrganID' => $Quoinfo['DealerID'], 'OrganType' => 2, 'HandleID' => $orderID);
            $params['type'] = array('name' => 'DD', 'key' => 1);
            RemindService::sendRemind($params);
        } elseif ($payment == 2) {
            //待发货
            $params = array('OrganID' => $Quoinfo['DealerID'], 'OrganType' => 2, 'HandleID' => $orderID);
            $params['type'] = array('name' => 'DD', 'key' => 2);
            //命令行链接
            $params['from']='http://192.168.2.29:8000/pap/sellerorder/detail&ID='.$orderID;
            RemindService::sendRemind($params);
        }
        //更改报价单待确认状态为已处理
        $sql = 'update pap_remind_business set HandleStatus=2 where HandleID=' . $quoID . ' and OrganID=' . $Quoinfo['ServiceID'];
        Yii::app()->papdb->createCommand($sql)->execute();
        //创建订单成功
        return array('success' => true, 'msg' => 'carate order success','QuoID'=>$quoID,'data'=>'创建订单成功','orderID'=>$orderID,'ordersn'=>$order_sn);
    }

    //pap 传sql语句，执行返回结果
    public static function excutesql($data) {
        if ($data['db'] == 'pap') {
            $result = Yii::app()->papdb->createCommand($data['sql'])->queryAll();
        } elseif ($data['db'] == 'jpd') {
            $result = Yii::app()->jpdb->createCommand($data['sql'])->queryAll();
        } elseif ($data['db'] == 'dsp') {
            $result = Yii::app()->dspdb->createCommand($data['sql'])->queryAll();
        }
        return $result;
    }

    public static function getCpName($code) {
        $sql = 'select * from jpd_gcategory where Code="' . $code . '"';
        $result = self::excutesql(array('sql' => $sql, 'db' => 'jpd'));
        return $result[0]['Name'];
    }

    public static function getBrand($BrandID) {
        $result = PapBrand::model()->findByPK($BrandID);
        return $result['BrandName'];
    }

    public static function getaddressbypk($id) {
        $sql = 'select * from jpd_receive_address where ID=' . $id;
        $result = self::excutesql(array('sql' => $sql, 'db' => 'jpd'));
        return $result[0];
    }

    //保存订单
    public static function saveorderinfo($data) {
        $arr = new PapOrder();
        $arr->attributes = $data;
        $arr->save();
        return $arr->ID;
    }

    //保存商品
    public static function saveordergoods($data, $orderID, $mine) {//参数为数据源，订单ID，均价
        foreach ($data as $value) {
            $factprice = $value['ProPrice'] + $mine;
            $facttotal = $factprice * $value['Quantity'];
            $value['ProPrice'] = $factprice;
            $value['GoodsAmount'] = $facttotal;
            $arr = new PapOrderGoods();
            $arr->attributes = $value;
            $arr->OrderID = $orderID;
            $arr->Version=$value['Version']?$value['Version']:'';
            $arr->save();
        }
    }

    //保存地址
    public static function saveinquiryaddress($data) {
        $arr = new PapOrderAddress();
        $arr->attributes = $data;
        $arr->save();
    }

    //生成订单号
    public static function gen_order_sn() {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);
        $timestamp = time() - date('Z');
        $y = date('y', $timestamp);
        $z = date('z', $timestamp);
        $order_sn = $y . str_pad($z, 3, '0', STR_PAD_LEFT) . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $orders = PapOrder::model()->find('OrderSN=' . $order_sn);
        if (empty($orders)) {
            /* 否则就使用这个订单号 */
            return $order_sn;
        }

        /* 如果有重复的，则重新生成 */
        return $this->gen_order_sn();
    }
    
    //获取服务店客户类别对应的折扣率
    public static function getpriceratio($dealerid, $serviceid) {
        $typesql = 'select Cooperationtype from `pap_client_type` where DealerID=' . $dealerid . ' and ServiceID=' . $serviceid;
        $type = Yii::app()->papdb->createCommand($typesql)->queryRow();
        $res = array();
        if ($type['Cooperationtype']) {
            $typelevel = trim($type['Cooperationtype']);
        }
        else
            $typelevel = 'C';
        $res['type'] = $typelevel;
        $sql = 'select PriceRatio from `pap_goods_price_manage` where OrganID=' . $dealerid . ' and CooperationType like "%' . $typelevel . '%"';
        $data = $type = Yii::app()->papdb->createCommand($sql)->queryRow();
        if ($data['PriceRatio'])
            $res['discount'] = $data['PriceRatio'];
        else {
            $res['discount'] = '100';
        }
        return $res;
    }

}
