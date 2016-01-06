<?php
class PurchaseController extends Controller {
    public function actionIndex() {
    	$OrganID = Yii::app()->user->getOrganID();
    	$LicensePlate = Yii::app()->request->getParam('LicensePlate');
    	$CreateTime = Yii::app()->request->getParam('CreateTime');
    	$InOrder = Yii::app()->request->getParam('InOrder');
        $ReserveNum = Yii::app()->request->getParam('ReserveNum');
    	$dataProvider = RPCClient::call('ReserveService_getPurchaseData',array('LicensePlate'=>$LicensePlate, 'CreateTime'=>$CreateTime, 'InOrder'=>$InOrder, 'ReserveNum'=>$ReserveNum));  
        $this->render('index', array('dataProvider' => $dataProvider, 'LicensePlate'=>$LicensePlate, 'CreateTime'=>$CreateTime, 'InOrder'=>$InOrder, 'ReserveNum'=>$ReserveNum));
    }
    
    /*
     * 采购单验证最小交易金额
     */
    public function actionCheckmin(){
        $key = Yii::app()->request->getParam('key');
        $result = RPCClient::call('ReserveService_checkmin',array('key'=>$key));  
        echo json_encode($result);die;
    }
}