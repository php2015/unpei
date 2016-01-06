<?php

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

    public function actionIndex() {
        $this->redirect(array('/pap/home/index'));
        $this->pageTitle = Yii::app()->name . '-修理厂工作台';
        $user_id = Yii::app()->user->id;
        $conditions = "receiver_id = {$user_id}";
        //买家-已收到的报价单条数--报价单处于默认状态，或者处于同意但尚未付款状态
        $receive = new CDbCriteria();
        $receive->addCondition($conditions);
        $receive->addCondition("quotation_status = 0 OR (quotation_status = 1 AND pay_status = 0)");
//        $receiveCount = PapQuotation::model()->count($receive);
        //买家-执行中的报价单--报价单已同意并付款，但还未执行成功或拒绝、废弃,也没有异常申请
        $implement = new CDbCriteria();
        $implement->addCondition($conditions);
        $implement->addCondition('quotation_status =1');
        $implement->addCondition('pay_status = 1');
        $implement->addCondition('unusual_status = 0');
//        $impleCount = Quotation::model()->count($implement);
        //买家-异常订单
        $unusual = new CDbCriteria();
        $unusual->addCondition($conditions);
        $unusual->addCondition('unusual_status = 1');
//        $unusualCount = Quotation::model()->count($unusual);
        // 订购平台
        $organID = Yii::app()->user->getOrganID();
        //待确认的报价单
        $dquotions = PapQuotation::model()->count(array('condition' => "`Status` = '1' and IfSend='2' and ServiceID = {$organID} and InquiryID=0"));
        //待付款的订单
        $forder = PapOrder::model()->count(array('condition' => "Status = 1 and BuyerID = {$organID}"));
        //待收货的订单
        $torder = PapOrder::model()->count(array('condition' => "Status = 3 and BuyerID = {$organID}"));
        //异常订单
//        $uorder = PapOrder::model()->count(array('condition' => "Status not in (11,12,13,14) and IsUnusual!=0 and BuyerID = {$organID}"));
//        //待报价的询价单
//        $inquirys = ServiceInquiry::model()->count(array('condition' => "Status = 0 and OrganID = {$organID}"));
//        //待发货的订单
//        $sorder = PapOrder::model()->count(array('condition' => "Status = 2 and BuyerID = {$organID}"));
//        //待卖家同意退货
//        $fforder1 = PapOrder::model()->count(array('condition' => "Payment=2 and Status = 11 and BuyerID = {$organID}"));
//        $fforder2 = PapOrder::model()->count(array('condition' => "Payment=1 and PayStatus = 'WAIT_SELLER_AGREE' and BuyerID = {$organID}"));
//        $fforder=$fforder1+$fforder2;
        //待买家退货的订单
        $ssorder1 = PapOrder::model()->count(array('condition' => "Payment=2 and Status = 12 and BuyerID = {$organID}"));
        $ssorder2 = PapOrder::model()->count(array('condition' => "Payment=1 and PayStatus = 'WAIT_BUYER_RETURN_GOODS' and BuyerID = {$organID}"));
        $ssorder = $ssorder1 + $ssorder2;
        //待卖家收到退货
        $ttorder1 = PapOrder::model()->count(array('condition' => "Payment=2 and Status = 13 and BuyerID = {$organID}"));
        $ttorder2 = PapOrder::model()->count(array('condition' => "Payment=1 and PayStatus = 'WAIT_SELLER_CONFIRM_GOODS' and BuyerID = {$organID}"));
        $ttorder = $ttorder1 + $ttorder2;

        $this->render('index', array(
//            'receiveCount' => $receiveCount,
//            'impleCount' => $impleCount,
//            'unusualCount' => $unusualCount,
            'dquotions' => $dquotions,
            'forder' => $forder,
            'torder' => $torder,
//            'uorder' => $uorder,
            'ssorder' => $ssorder
        ));
    }

    public function actionGetservicer() {
        //订购平台
        $organID = Commonmodel::getOrganID();

        //待确认的报价单
        $result['dquotions'] = PapQuotation::model()->count(array('condition' => "`Status` = '1' and IfSend='2' and ServiceID = {$organID} and InquiryID=0"));
        //待付款的订单
        $result['forder'] = PapOrder::model()->count(array('condition' => "Status = 1 and BuyerID = {$organID}"));
        //待收货的订单
        $result['torder'] = PapOrder::model()->count(array('condition' => "Status = 3 and BuyerID = {$organID}"));
        //异常订单
        $result['uorder'] = PapOrder::model()->count(array('condition' => "Payment=2 and Status not in (11,12,13,14) and IsUnusual!=0 and BuyerID = {$organID}"));
        //待买家退货的订单
        $ssorder1 = PapOrder::model()->count(array('condition' => "Payment=2 and Status = 12 and BuyerID = {$organID}"));
        $ssorder2 = PapOrder::model()->count(array('condition' => "Payment=1 and PayStatus = 'WAIT_BUYER_RETURN_GOODS' and BuyerID = {$organID}"));
        $result['sorder'] = $ssorder1 + $ssorder2;

        echo json_encode($result);
    }

    public function actionList() {
        $this->render('list');
    }

    //新手入门
    public function actionNewer() {
        $goto = Yii::app()->request->getParam('goto');
        $this->renderpartial($goto);
    }

}