<?php

class DefaultController extends PapmallController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    public function actionIndex() {
        $this->pageTitle=Yii::app()->name.'-商城首页';
        $this->redirect(array('home/index'));Yii::app()->end();
        //获取事故件
        $accident=  DefaultService::accidentparts();
//        $accident=RPCClient::call('DefaultService_accidentparts');
       //常用件
        $usua=DefaultService::commonparts();
       // $usua=RPCClient::call('DefaultService_commonparts');
        //经销商列表
        $dealer=DefaultService::querydealer();
      //  $dealer=RPCClient::call('DefaultService_querydealer');
        $arr=array('accident'=>$accident,'usua'=>$usua,'dealer'=>$dealer);
        $this->render("index",$arr);
    }
    
    public function actionGetgoods()
    {
        $subid=Yii::app()->request->getParam('subid');
        $organID=Yii::app()->user->getOrganID();
        $goods=DefaultService::getsubgoods(array('subid'=>$subid,'organID'=>$organID));
      //$goods=RPCClient::call('DefaultService_getsubgoods',array('subid'=>$subid,'organID'=>$organID));
        echo json_encode($goods);
   
    }
    public function actionGetservicer() {
        //订购平台
        $organID = Commonmodel::getOrganID();

        //待确认的报价单
        $result['dquotions'] = PapQuotation::model()->count(array('condition' => "status = 1 and ServiceID = {$organID}"));
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
   
}