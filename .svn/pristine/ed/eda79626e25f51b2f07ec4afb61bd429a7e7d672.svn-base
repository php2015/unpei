<?php

/*
 * 退货管理
 */

class OrderreturnService {
    /*
     * 获得退货订单
     * @param int                    $Type   订单状态；1：未收货订单生成的退货单，2：已收货订单生成的退货单
     */

    public static function papreturnorder($Type = 0, $Status = 0) {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->order = "t.ID desc";
        if ($_GET) {
            $ReturnNO = Yii::app()->request->getParam('ReturnNO');
            if ($ReturnNO && $ReturnNO != '请输入退货单号') {
                $ReturnNO = urldecode($ReturnNO);
                $ReturnNO = str_replace('%', '\\%', $ReturnNO);
                $ReturnNO = str_replace('<<q>>', '/', $ReturnNO);
                $criteria->addCondition("t.ReturnNO like'%$ReturnNO%'", "AND");
            }
            $ServiceName = Yii::app()->request->getParam('ServiceName');
            if ($ServiceName) {
                $ServiceName = urldecode($ServiceName);
                $ServiceName = str_replace('%', '\\%', $ServiceName);
                $ServiceName = str_replace('<<q>>', '/', $ServiceName);
                $sql = "select ID from jpd_organ where OrganName like '%$ServiceName%'";
                $sqlParams = array();
                $res = Yii::app()->jpdb->createCommand($sql)->queryAll($sqlParams);
                foreach ($res as $v) {
                    $modelRow[] = $v[0];
                }
                $criteria->addInCondition('t.ServiceID', $modelRow, "AND");
            }
            if (strtotime(Yii::app()->request->getParam('StartTime')))
                $StartTime = Yii::app()->request->getParam('StartTime');
            if (strtotime(Yii::app()->request->getParam('EndTime')))
                $EndTime = Yii::app()->request->getParam('EndTime');
            if ($StartTime && $EndTime) {
                $StartTime = strtotime($StartTime);
                $EndTime = (int) (strtotime($EndTime) + 60 * 60 * 24);
                $criteria->addBetweenCondition('t.CreateTime', "{$StartTime}", "{$EndTime}", "AND");
            } elseif ($StartTime) {
                $StartTime = strtotime($StartTime);
                $criteria->addCondition("t.CreateTime >= " . $StartTime, "AND");
            } elseif ($EndTime) {
                $EndTime = (int) (strtotime($EndTime) + 60 * 60 * 24);
                $criteria->addCondition("t.CreateTime <= " . $EndTime, "AND");
            }
            $Type = Yii::app()->request->getParam('Type');
            if ($Type) {
                $criteria->addCondition("t.Type like '%$Type%'", "AND");
            }
            $Status = Yii::app()->request->getParam('Status');
            if ($Status) {
                switch ($Status) {
                    case 1;
                        $cond = "t.Status in (1,11)";
                        break;
                    case 2;
                        $cond = "t.Status = 2";
                        break;
                    case 3;
                        $cond = "t.Status in(3,13)";
                        break;
                    case 4;
                        $cond = "t.Status in(4,14)";
                        break;
                    case 5;
                        $cond = "t.Status in(5,12)";
                        break;
                    case 6;
                        $cond = "t.Status in(6,16) or t.ComplainStatus =3";
                        break;
                }
                $criteria->addCondition($cond, "AND");
            }
        }
//        if ($Type) {
//            $criteria->condition = "t.Type = " . $Type . " and";
//        }
//        if ($Status) {
//            $criteria->addCondition(" t.Status = " . $Status, "AND");
//        }
        $criteria->addCondition(" t.DealerID = " . $organID, "AND");
        $criteria->with = array('returngoods');
        $data = new CActiveDataProvider('PapReturnOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 4,
        )));
//        var_dump($data);
//        exit;
        return $data;
    }

    /*
     * 获得待审核的退货单
     */

    public static function getauditreturn() {

        $organID = Yii::app()->user->getOrganID();
        $returnsql = "select * from pap_return_order where Status=1 and DealerID  =  '" . $organID . "'  ORDER BY CreateTime DESC";
        $data = new CSqlDataProvider($returnsql, array(
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));

//pap/dealerreturn/audit/ID/134
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            $datas[$k]['rowNO'] = $k + 1;
            $datas[$k]['Info'] = "<a href='" . Yii::app()->createUrl('/pap/dealerreturn/audit', array('ID' => $v['ID'])) . "' target='_blank'>退货单详情</a>";
        }
        $data->setData($datas);
        return $data;
    }

    /*
     * 获得退货订单不同状态数量
     */

    public static function papreturnstatus($Status) {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.Status in($Status) ", "AND");
        $criteria->addCondition(" t.DealerID = " . $organID, "AND");
        $count = PapReturnOrder::model()->count($criteria);
        return $count;
    }

    public static function papgetComplainStatus($ComplainStatus) {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.DealerID = " . $organID, "AND");
        $criteria->addCondition(" t.ComplainStatus = " . $ComplainStatus, "AND");
        $count = PapReturnOrder::model()->count($criteria);
        return $count;
    }

    /*
     * 通过ID获得机构名称
     * @param int                    $ID  机构ID
     */

    public static function idgetname($ID) {
        $model = Organ::model()->findByPk($ID);
        return $model->OrganName;
    }

    /*
     * 通过ID获得修理厂订单商品中商品数据
     * @param int                    $GoodsID  商品ID
     * @param int                    $OrderID  订单ID
     * @param varcher                $Name  所需要的字段
     */

    public static function idgetordergoods($OrderID, $GoodsID, $Name) {
        $model = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $OrderID, ":GoodsID" => $GoodsID));
        return $model->$Name;
    }

    /*
     * 把status状态转换为汉字
     * @param int                    $Status  状态
     */

    public static function showOrderStatus($Status) {
        if ($Status == 1) {
            return '退货待审核';
        } else if ($Status == 2) {
            return '退货待发货';
        } else if ($Status == 3) {
            return '退货待收货';
        } else if ($Status == 4) {
            return '退货已完成';
        } else if ($Status == 5) {
            return '退货未通过';
        } else if ($Status == 6) {
            return '退货已取消';
        } else if ($Status == 11) {
            return '退款待审核';
        } else if ($Status == 12) {
            return '退款不通过';
        } else if ($Status == 13) {
            return '退款待收款';
        } else if ($Status == 14) {
            return '退款完成';
        } else if ($Status == 16) {
            return '退款已取消';
        }
    }

    /*
     * 通过ID获得修理厂订单商品中商品数据
     * @param int                    $ID  商品ID
     */

    public static function idgetimg($ID) {
        $model = PapGoodsImageRelation::model()->findAll("GoodsID =:ID", array(":ID" => $ID));
        return $model;
    }

    /*
     * 通过退货单ID获取退货单信息
     */

    public static function papgetreturn() {
        $ID = Yii::app()->request->getParam('ID');
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.ID = " . $ID, "AND");
        $criteria->with = "returngoods";
        $model = PapReturnOrder::model()->find($criteria);
        return $model;
    }

    /*
     * 通过退货单号获取退货单信息
     */

    public static function nogetreturn($returnNO) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.ReturnNO = '$returnNO'", "AND");
        $criteria->with = "returngoods";
//        var_dump($criteria);
//        exit;
        $model = PapReturnOrder::model()->find($criteria);
        return $model;
    }

    /*
     * 通过ID机构信息
     */

    public static function idgetorgan($ID, $Name = '') {
        $criteria = new CDbCriteria();
        $criteria->addCondition("ID = $ID");
        $model = Organ::model()->find($criteria);
        if ($Name == 'Address') {
            return Area::getCity($model->Province) . Area::getCity($model->City) . Area::getCity($model->Area) . $model->Address;
        } else if ($Name == 'all') {
            $model->Area = Area::getCity($model->Province) . Area::getCity($model->City) . Area::getCity($model->Area);
            return $model;
        } else {
            return $model->$Name;
        }
    }

    /*
     * 退货不通过保存原因
     */

    public static function papnoaudit() {
        $ID = Yii::app()->request->getParam('ID');
        $noinfo = Yii::app()->request->getParam('noinfo');
        $returnNumber = PapReturnOrder::model()->findByPk($ID)->attributes;
        if ($returnNumber['ReturnNumber'] == '1') {  //第一次审核 把第1次申请的1变为不通过5
            $model = PapReturnOrder::model()->updateByPk($ID, array("ReturnNumber" => 5, "Status" => 5, "NoResult" => $noinfo));
        }
        if ($returnNumber['ReturnNumber'] == '2') { //第二次审核 把第2次申请的2变为不通过10
            $model = PapReturnOrder::model()->updateByPk($ID, array("ReturnNumber" => 10, "Status" => 5, "NoResult" => $noinfo));
        }
        if ($returnNumber['ReturnNumber'] == '3') { //第三次审核 把第3次申请的3变为不通过15
            $model = PapReturnOrder::model()->updateByPk($ID, array("ReturnNumber" => 15, "Status" => 5, "NoResult" => $noinfo));
        }
        $return = PapReturnOrder::model()->findByPk($ID)->attributes;

        //更改待审核提醒状态为已操作
        RemindService::updateRemindStatus($ID, 4, $return['DealerID']);
        //审核不通过发送给修理厂
        $params = array('OrganID' => $return['ServiceID'], 'OrganType' => 3, 'HandleID' => $ID);
        $params['type'] = array('name' => 'THD', 'key' => 4);
        RemindService::sendRemind($params, $return);

        return $model;
    }

    /*
     * 退款不通过保存原因 (申请退款)
     */

    public static function papnoaudit2() {
        $ID = Yii::app()->request->getParam('ID');
        $noinfo = Yii::app()->request->getParam('noinfo');

        $returnNumber = PapReturnOrder::model()->findByPk($ID)->attributes;
        if ($returnNumber['ReturnNumber'] == '11') {  //第一次审核 把第1次申请的11变为不通过55
            $model = PapReturnOrder::model()->updateByPk($ID, array("ReturnNumber" => 55, "Status" => 12, "NoResult" => $noinfo));
        }
        if ($returnNumber['ReturnNumber'] == '22') { //第二次审核  把第2次申请的22变为不通过65
            $model = PapReturnOrder::model()->updateByPk($ID, array("ReturnNumber" => 65, "Status" => 12, "NoResult" => $noinfo));
        }
        if ($returnNumber['ReturnNumber'] == '33') { //第三次审核  把第3次申请的33变为不通过75
            $model = PapReturnOrder::model()->updateByPk($ID, array("ReturnNumber" => 75, "Status" => 12, "NoResult" => $noinfo));
        }
        $return = PapReturnOrder::model()->findByPk($ID)->attributes;

        //更改待审核提醒状态为已操作
        RemindService::updateRemindStatus($ID, 4, $return['DealerID']);
        //审核不通过发送给修理厂
        $params = array('OrganID' => $return['ServiceID'], 'OrganType' => 3, 'HandleID' => $ID);
        $params['type'] = array('name' => 'THD', 'key' => 4);
        RemindService::sendRemind($params, $return);

        return $model;
    }

    /*
     * 经销商退款通过 (申请退款) 审核退款通过 状态改为13 退款待收款
     */

    public static function dealerpassprice() {
        $ID = Yii::app()->request->getParam('ID');
        $model = PapReturnOrder::model()->updateByPk($ID, array("Status" => 13));

        //更改提醒状态为已操作
        RemindService::updateRemindStatus($ID, 4);

        return $model;
    }

    /*
     * 确认收货
     */

    public static function papgoodsget() {
        $ID = Yii::app()->request->getParam('ID');
        $organID = Yii::app()->user->getOrganID();
        $model = PapReturnOrder::model()->updateByPk($ID, array("Status" => 4));
        $lists[] = 1;
        if ($model) {
            $list = PapReturnGoods::model()->findAll("ReturnID=:ID", array(":ID" => $ID));
            foreach ($list as $v) {
                if (!in_array($v['OrderID'], $lists)) {
                    $model = PapOrder::model()->updateByPk($v['OrderID'], array("ReturnStatus" => 4));
                    $lists[] = $v['OrderID'];
                }
            }

            //更新待收货提醒状态
            RemindService::updateRemindStatus($ID, 5, $organID);
        }
        return $model;
    }

    /*
     * 通过orderID获得订单编号
     */

    public static function orderIDgetorder($ID, $Name) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("ID = $ID");
        $model = PapOrder::model()->find($criteria);
        return $model->$Name;
    }

    public static function paypal($returnID) {
        //获取订单信息
        $order = PapReturnOrder::model()->findByPk($returnID)->attributes;
        $serviceID = $order['ServiceID'];
        //获取服务店支付宝帐号
        $paypal = JpdFinancialPaypal::model()->find("OrganID=:ID", array(":ID" => $serviceID));
        //获取服务店地址
        $address = Organ::model()->findByPk($order['ServiceID']);
        $payArr = array();
        //  $payArr['order_rs'] = "D-S";
        $payArr['order_id'] = $order['ID'];    //退货单ID
        $payArr['out_trade_no'] = $order['ReturnNO'];   //退货单编号
        $payArr['subject'] = '退货单编号:' . $order['ReturnNO'];    //订单名称
        $payArr['seller_email'] = $paypal['PaypalAccount'];     //卖家（生产商）的支付宝账号
        $payArr['body'] = '';   //订单描述
        $payArr['price'] = $order['Price'];   //退货总价
        $payArr['logistics_fee'] = "0";  //物流费
        $payArr['receive_name'] = $address['OrganName'];    //收货人信息
        $payArr['receive_address'] = Area::getCity($address['Province']) . Area::getCity($address['City']) .
                Area::getCity($address['Area']) . $address['Address'];
        $payArr['receive_phone'] = $address['Phone'];
        return $payArr;
    }

    public static function dealerpaypal($returnID) { //申请退款  
        //获取订单信息
        $order = PapReturnOrder::model()->findByPk($returnID)->attributes;
        $serviceID = $order['ServiceID'];
        //获取服务店支付宝帐号
        $paypal = JpdFinancialPaypal::model()->find("OrganID=:ID", array(":ID" => $serviceID));
        //获取服务店地址
        $address = Organ::model()->findByPk($serviceID, 'IsDelete=0');
        $payArr = array();
//  $payArr['order_rs'] = "D-S";
        $payArr['order_id'] = $order['ID'];    //退货单ID
        $payArr['out_trade_no'] = $order['ReturnNO'];   //退货单编号
        $payArr['subject'] = '退货单编号:' . $order['ReturnNO'];    //订单名称
        $payArr['seller_email'] = $paypal['PaypalAccount'];     //卖家（生产商）的支付宝账号
        $payArr['body'] = '';   //订单描述
        $payArr['price'] = $order['Price'];   //退货总价
        $payArr['logistics_fee'] = "0";  //物流费
        $payArr['receive_name'] = $address['OrganName'];    //收货人信息
        $payArr['receive_address'] = Area::getCity($address['Province']) . Area::getCity($address['City']) .
                Area::getCity($address['Area']) . $address['Address'];
        $payArr['receive_phone'] = $address['Phone'];
        return $payArr;
    }

    //获取退货单信息
    public static function getOrder($returnID) {
        $orders = array();
        $order = PapReturnOrder::model()->findByPk($returnID);
        $address = Organ::model()->findByPk($order['ServiceID']);
        $orders['ReturnNO'] = $order['ReturnNO'];
        $orders['Price'] = $order['Price'];
        $orders['receive_name'] = $address['OrganName'];
        return $orders;
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
        $where = "ID = {$order_id}";
        //$data = array('RefundStatus' => $notify_result['trade_status']);
        //   $orderdata=array('ReturnStatus'=>'1','Status' => $notify_result['target']);
        switch ($notify_result['target']) {
            case RORDER_READY:
                $where .= ' AND Status <= ' . RORDER_PENDING;
                $data['AlipayTN'] = $notify_result['trade_no'];
                $data['Status'] = RORDER_READY;
                break;
            case RORDER_PENDING:    // 付款， 待发货
                $where .= ' AND Status <= ' . RORDER_PENDING;
                $data['AlipayTN'] = $notify_result['trade_no'];
                $data['Status'] = RORDER_PENDING;
                $data['CreateTime'] = time();

                //更改提醒状态为已操作
                $returninfo = PapReturnOrder::model()->findByPk($order_id);
                RemindService::updateRemindStatus($order_id, 4, $returninfo['DealerID']);
                //发送待发货提醒给修理厂
                $params = array('OrganID' => $returninfo['ServiceID'], 'OrganType' => 3, 'HandleID' => $order_id);
                $params['type'] = array('name' => 'THD', 'key' => 5);
                RemindService::sendRemind($params, $returninfo);

                break;
            case RORDER_ACCEPTED:  // 待收货
                $where .= ' AND Status <= ' . RORDER_ACCEPTED;
                $where .= ' AND Status >= ' . RORDER_PENDING;
                $data['Status'] = RORDER_ACCEPTED;
                $data['DeliveryTime'] = time();
                break;
            case RORDER_ABNORMAL://已收货，完成
                $where .= ' AND Status <= ' . RORDER_ABNORMAL;
                $where .= ' AND Status >= ' . RORDER_ACCEPTED;
                $data['Status'] = RORDER_ABNORMAL;
                $return = PapReturnGoods::model()->find('ReturnID=:returnID', array(':returnID' => $order_id));
                if ($return) {
                    $orderID = $return['OrderID'];
                    if ($orderID) {
                        $wheres = "ID = {$orderID}";
                        PapOrder::model()->updateAll(array('ReturnStatus' => 4), $wheres);
                    }
                }
                break;
//            case RORDER_READY_PAYPAL://退款 待付款
//                  $where .= ' AND Status = ' . RORDER_READY_PAYPA;
//                  $data['Status']=RORDER_READY_PAYPAL;
//                  break;
//            case RORDER_PAYPAL_FINISHED://退款完成
//                  $where .= ' AND Status =' .RORDER_PAYPAL_FINISHED;
//                  $data['Status']=RORDER_PAYPAL_FINISHED;
//                  break;
        }
        //PapReturnOrder::model()->updateByPk($order_id,$data)
        //PapReturnOrder::model()->updateAll($data, $where)
        if (PapReturnOrder::model()->updateAll($data, $where)) {

            return true;
        } else {
            return false;
        }
    }

    /*
     * 获得退货单收货地址
     */

    public static function getreturnaddress() {
        $ID = Yii::app()->request->getParam('ID');
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.ReturnID = " . $ID, "AND");
        $model = PapReturnAddress::model()->find($criteria);
        return $model;
    }

    /*
     * 获得收货地址-转换为汉字
     */

    public static function returnidgetaddress($ReturnID) {
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.ReturnID = " . $ReturnID, "AND");
        $model = PapReturnAddress::model()->find($criteria);

        return Area::getCity($model->Province) . Area::getCity($model->City) . Area::getCity($model->Area) . $model->Address;
    }

    /*
     * 添加退货单收货地址 
     */

    public static function savereturnaddress($params) {
        $returnID = Yii::app()->request->getParam("returnID");
        PapReturnAddress::model()->deleteAll('ReturnID=:ReturnID', array(':ReturnID' => $returnID));
        $returnArr = array(
            "ReturnID" => $returnID,
            "ShippingName" => $params['ContactName'],
            "ZipCode" => $params['ZipCode'],
            "Mobile" => $params['Phone'],
            "Province" => $params['State'],
            "City" => $params['City'],
            "Area" => $params['District'],
            "Address" => $params['Address'],
            "CreateTime" => time()
        );
        Yii::app()->papdb->createCommand()->insert('pap_return_address', $returnArr);
    }

}

?>
