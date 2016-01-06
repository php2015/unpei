<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class WCustomerService extends CWidget
{
    public function run()
    {
//         $cri = new CDbCriteria(array(
//             'condition'=>'is_show = 1',
//             'order'=>'sort_order asc, id desc'
//         ));
//         $CustomerService = CustomerService::model()->findAll($cri);
//         $this->render('customerService', array(
//             'CustomerService'=>$CustomerService
//         ));
        $dealerid=Yii::app()->request->getParam('dealerid')?Yii::app()->request->getParam('dealerid'):Yii::app()->request->getParam('dealer');
        if($dealerid){
        $csparams['organID'] = $dealerid;
        $csparams['type'] = 1;
        $csinfo = CsService::getcslists($csparams);
        $seller = DefaultService::sellerstore($dealerid);
        }
        if(Yii::app()->request->getParam('goods')){
        $goodsid= Yii::app()->request->getParam('goods');
        $criteria = new CDbCriteria();
        $criteria->condition = " t.OrganID!=''";  // 上架的和没有删除的商品
        $model = PapGoods::model()->findByPk($goodsid, $criteria);
        if($model['OrganID']){
        $csparams['organID'] = $model['OrganID'];
        $csparams['type'] = 1;
        $csinfo = CsService::getcslists($csparams);
        $seller = DefaultService::sellerstore($model['OrganID']);
        }
        }
        $this->render('customerService',array('csinfo'=>$csinfo,'seller'=>$seller));
    }
}
?>
