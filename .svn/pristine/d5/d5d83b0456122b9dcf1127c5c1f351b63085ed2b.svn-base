<?php

/*
 * 退货管理--经销商
 */

class DealerreturnController extends Controller {
    /*
     * 退货管理-首页
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "退货管理";
        $Status[0] = OrderreturnService::papreturnstatus('1,11'); //待审核
        $Status[1] = OrderreturnService::papreturnstatus('2'); //待发货
        $Status[2] = OrderreturnService::papreturnstatus('3,13'); //待收货
        $Status[3] = OrderreturnService::papreturnstatus('4,14'); //完成
        $Status[4] = OrderreturnService::papreturnstatus('5,12'); //未通过
        $Status[5] = OrderreturnService::papreturnstatus('6,16'); //取消
        //申诉状态
        $ComplainStatus[0] = OrderreturnService::papgetComplainStatus('3'); //已取消
        $this->render('index', array('data' => OrderreturnService::papreturnorder(),
            'status' => $Status,
            'complainstatus' => $ComplainStatus
        ));
    }

    /*
     * 退后管理-退货单详细页
     */

    public function actionOrderinfo() {
        $this->pageTitle = Yii::app()->name . '-' . "退货单详情";
        $model = OrderreturnService::papgetreturn();
        if (!$model) {
            $this->redirect(array('index'));
        }
        $models = new JpdReceiveAddress();
        $organID = Yii::app()->user->getOrganID();
        $firstaddress = JpdReceiveAddress::model()->findAll('OrganID=:organID and State=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = JpdReceiveAddress::model()->findAll('OrganID=:organID and State!=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = array_merge($firstaddress, $address);
        $ID = Yii::app()->request->getParam('ID');

        $ReturnNO = PapReturnOrder::model()->findByPk($ID);
        $reuslt = self::getcomplaininfo($ReturnNO['ReturnNO']);
        if ($model->Type == 1) {
            $this->render('orderinfos', array('data' => $model, 'reuslt' => $reuslt, 'model' => $models));
        } elseif ($model->Type == 2) {
            $returnaddress = OrderService::getreturnship($ID);
            $this->render('orderinfo', array('data' => $model, 'reuslt' => $reuslt, 'address' => $address, 'model' => $models, 'returnaddress' => $returnaddress));
        }
    }

    /*
     * 退货管理-退款单详细页 （申请退款） 
     */

    public function actionOrderinfo2() {
        $this->pageTitle = Yii::app()->name . '-' . "退款单详情";
        $model = OrderreturnService::papgetreturn();
        if (!$model) {
            $this->redirect(array('index'));
        }
        $models = new JpdReceiveAddress();
        $organID = Yii::app()->user->getOrganID();
        $firstaddress = JpdReceiveAddress::model()->findAll('OrganID=:organID and State=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = JpdReceiveAddress::model()->findAll('OrganID=:organID and State!=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = array_merge($firstaddress, $address);
        $ID = Yii::app()->request->getParam('ID');

        $ReturnNO = PapReturnOrder::model()->findByPk($ID);
        $reuslt = self::getcomplaininfo($ReturnNO['ReturnNO']);
        if ($model->Type == 1) {
            $this->render('orderinfos2', array('data' => $model, 'reuslt' => $reuslt, 'model' => $models));
        } elseif ($model->Type == 2) {
            $returnaddress = OrderService::getreturnship($ID);
            $this->render('orderinfo2', array('data' => $model, 'reuslt' => $reuslt, 'address' => $address, 'model' => $models, 'returnaddress' => $returnaddress));
        }
    }

    /*
     * 获取申诉表信息
     */

    public function getcomplaininfo($ReturnNO) {
        $sql = "select * from pap_complain  where ReturnNO = '$ReturnNO'";
        $result = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $result;
    }

    /*
     * 退货管理-退货单审核
     */

    public function actionAudit() {
        $this->pageTitle = Yii::app()->name . '-' . "退货单审核";
        $model = OrderreturnService::papgetreturn();
        if (!$model) {
            $this->redirect(array('index'));
        }
        $models = new JpdReceiveAddress();
        $organID = Yii::app()->user->getOrganID();
        $firstaddress = JpdReceiveAddress::model()->findAll('OrganID=:organID and State=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = JpdReceiveAddress::model()->findAll('OrganID=:organID and State!=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = array_merge($firstaddress, $address);

        if ($model->Type == 1) {
            $this->render('orderinfos', array('data' => $model, 'model' => $models));
        } elseif ($model->Type == 2) {
            $this->render('orderinfo', array('data' => $model, 'address' => $address, 'model' => $models));
        }
    }

    /*
     * 退货管理-退款单审核 （申请退款） 
     */

    public function actionAudit2() {
        $this->pageTitle = Yii::app()->name . '-' . "退款单审核";
        $model = OrderreturnService::papgetreturn();
        if (!$model) {
            $this->redirect(array('index'));
        }
        $models = new JpdReceiveAddress();
        $organID = Yii::app()->user->getOrganID();
        $firstaddress = JpdReceiveAddress::model()->findAll('OrganID=:organID and State=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = JpdReceiveAddress::model()->findAll('OrganID=:organID and State!=:State order by CreateTime DESC', array(':organID' => $organID, ':State' => '370000'));
        $address = array_merge($firstaddress, $address);

        if ($model->Type == 1) {
            $this->render('orderinfos2', array('data' => $model, 'model' => $models));
        } elseif ($model->Type == 2) {
            $this->render('orderinfo2', array('data' => $model, 'address' => $address, 'model' => $models));
        }
    }

    /**
     * 经销商支付宝退款
     */
    public function actionReturnpaypal() {
        $this->pageTitle = Yii::app()->name . '-' . "付款";
        $returnID = Yii::app()->request->getParam("returnID");
        $returninfo = PapReturnOrder::model()->findBypk($returnID);
        if ($returninfo->Status != 1) {
            $this->redirect(array('Index'));
            exit;
        }
        //添加收货地址
        $addressID = Yii::app()->request->getParam("addressID");
        if (!$addressID) {
            $this->redirect(array('/pap/dealerreturn/index'));
        }
        $ship = $this->getShip($addressID);

        if (!$ship) {
            $this->redirect(array('/pap/dealerreturn/index'));
        }
        //向pap_return_address表中添加地址
        OrderreturnService::savereturnaddress($ship);
        if ($returnID) {
            $result = OrderreturnService::paypal($returnID);
            $alipay = Yii::app()->returnalipay;
            $request = new AlipayGuaranteeRequest();
            foreach ($result as $k => $rs) {
                $request->$k = $rs;
            }
            $request->logistics_payment = "BUYER_PAY";
            $request->logistics_type = "EXPRESS";
            $request->quantity = 1;
            //构建支付表单
            echo $alipay->buildForm($request);
        } else {
            throw new CHttpException(404, '页面不存在');
        }
    }

    /**
     * 经销商支付宝退款 （申请退款） 
     */
//    public function actionDealerReturn() {
////        echo '支付宝';exit;
//        $this->pageTitle = Yii::app()->name . '-' . "付款";
//        $returnID = Yii::app()->request->getParam("returnID");
//        $returninfo = PapReturnOrder::model()->findBypk($returnID);
//        if ($returninfo->Status != 11) { //退款待审核
//            $this->redirect(array('Index'));
//            exit;
//        }
//        if ($returnID) {
//            $result = OrderreturnService::dealerpaypal($returnID);
//            $alipay = Yii::app()->returnalipay;
//            $request = new AlipayGuaranteeRequest();
//            foreach ($result as $k => $rs) {
//                $request->$k = $rs;
//            }
//            $request->logistics_payment = "BUYER_PAY";
//            $request->logistics_type = "EXPRESS";
//            $request->quantity = 1;
//            $request->order_id = $returnID;
//            //构建支付表单
//            echo $alipay->buildForm($request);
//        } else {
//            throw new CHttpException(404, '页面不存在');
//        }
//    }

    /**
     * 经销商物流退款-已收货
     */
    public function actionReturnpost() {
        $this->pageTitle = Yii::app()->name . '-' . "付款";
        $returnID = Yii::app()->request->getParam("returnID");
        $returninfo = PapReturnOrder::model()->findBypk($returnID);
        if ($returninfo->Status != 1) {
            $this->redirect(array('Index'));
            exit;
        }
        //添加收货地址
        $addressID = Yii::app()->request->getParam("addressID");
        if (!$addressID) {
            $this->redirect(array('/pap/dealerreturn/index'));
        }
        $ship = $this->getShip($addressID);

        if (!$ship) {
            $this->redirect(array('/pap/dealerreturn/index'));
        }
        OrderreturnService::savereturnaddress($ship);
        if ($returnID) {
            PapReturnOrder::model()->updateBypk($returnID, array('Status' => 2, 'PayMethod' => 2));

            //更改待审核提醒为已操作
            RemindService::updateRemindStatus($returnID, 4, $returninfo['DealerID']);

            //发送待发货提醒给修理厂
            $params = array('OrganID' => $returninfo['ServiceID'], 'OrganType' => 3, 'HandleID' => $returnID);
            $params['type'] = array('name' => 'THD', 'key' => 5);
            RemindService::sendRemind($params, $returninfo);

            $this->redirect(array('Index'));
        } else {
            throw new CHttpException(404, '页面不存在');
        }
    }

    /**
     * 经销商物流退款-已收货(申请退款)
     */
//    public function actionReturnpost2() {
////        echo '物流';exit;
//        $this->pageTitle = Yii::app()->name . '-' . "付款";
//        $returnID = Yii::app()->request->getParam("returnID");
//        $returninfo = PapReturnOrder::model()->findBypk($returnID);
//        if ($returninfo->Status != 11) {
//            $this->redirect(array('Index'));
//            exit;
//        }
//        if ($returnID) {
//            PapReturnOrder::model()->updateBypk($returnID, array('Status' => 13, 'PayMethod' => 2));
//            $this->redirect(array('Index'));
//        } else {
//            throw new CHttpException(404, '页面不存在');
//        }
//    }
//    
    //获取收货地址
    public static function getShip($id) {
        //$model=  OrderService::getship($id);
        $model = JpdReceiveAddress::model()->findByPk($id)->attributes;
        return $model;
    }

    /**
     * 经销商物流退款-未收货
     */
    public function actionReturnposts() {
        $this->pageTitle = Yii::app()->name . '-' . "付款";
        $returnID = $_GET['returnID'];
        if ($returnID) {
            $lists[] = 1;
            $model = PapReturnOrder::model()->updateBypk($returnID, array('Status' => 4, 'PayMethod' => 2));
            if ($model) {
                $list = PapReturnGoods::model()->findAll("ReturnID=:ID", array(":ID" => $returnID));
                foreach ($list as $v) {
                    if (!in_array($v['OrderID'], $lists)) {
                        $model = PapOrder::model()->updateByPk($v['OrderID'], array("ReturnStatus" => 4));
                        $lists[] = $v['OrderID'];
                    }
                }

                //更改待审核提醒为已操作
                RemindService::updateRemindStatus($returnID, 4);
            }
            $this->redirect(array('Index'));
        } else {
            throw new CHttpException(404, '页面不存在');
        }
    }

    /*
     * 经销商审核退款通过
     */

    public function actionReturnprice() {
        $model = OrderreturnService::dealerpassprice();
        echo json_encode($model);
    }

    /*
     * 审核不通过  保存原因
     */

    public function actionNoaudit() {
        $model = OrderreturnService::papnoaudit();
        echo json_encode($model);
    }

    /*
     * 退款审核不通过  保存原因
     */

    public function actionNoaudit2() {
        $model = OrderreturnService::papnoaudit2();
        echo json_encode($model);
    }

    /*
     * 确认收货
     */

    public function actionGoodsget() {
        $model = OrderreturnService::papgoodsget();
        echo json_encode($model);
    }

    /*
     * 修理厂退货-未收货订单审核通过
     */

    public function actionAuditok() {
        $model = OrderreturnService::papgoodsget();
        echo json_encode($model);
    }

    /*
     * 修理厂退货查询退货地址
     */

    public function actionUpdateaddress() {
        $id = Yii::app()->user->getOrganID();
        $address = array();
        $address = Organ::model()->findByPk($id)->attributes;
        echo json_encode($address);
    }

    //添加收货地址
    public function actionAddaddress() {
        $model = new PapReturnAddress();
        $this->performAjaxValidation($model);

        if (isset($_POST)) {
            $model->ReturnID = $_POST['ReturnID'];
            $model->ShippingName = $_POST['name'];
            $model->Province = $_POST['Province'];
            $model->City = $_POST['City'];
            $model->Area = $_POST['Area'];
            $model->Address = $_POST['Address'];
            $model->Mobile = $_POST['Mobile'];
            $model->ZipCode = $_POST['ZipCode'];
            $model->CreateTime = time();
            if ($model->validate()) {
                if ($model->save()) {
                    echo json_encode(array('success' => '1'));
                } else {
                    echo json_encode(array('success' => '2'));
                }
            }
        }
    }

    //表单验证
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'address-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

?>
