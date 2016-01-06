<?php

/*
 * 折扣率设置
 */

class DiscountsetController extends Controller {
	/**
     * @return array action filters
     * 
     */
	  public $layout = '//layouts/cms';
    public function filters() {
        return CMap::mergeArray(parent::filters(), array(
                    'accessControl', // perform access control for CRUD operations
        ));
    }
    
    /*
     * 折扣率列表
     */
    public function actionDiscountset() {
        $this->pageTitle = Yii::app()->name . '-' . "折扣率设置";
        $model = new PapOrderDiscount();
        
        $this->render('discountset', array('model' => $model));
    }

    /*
     * 修改折扣率
     */

    public function actionEditorderdis() {
        $this->pageTitle = Yii::app()->name . '-' . "修改订单折扣率";
        $id = Yii::app()->request->getParam('id'); //获取要修改的ID
        if ($id) {
            $model = PapOrderDiscount::model()->findByPk($id);
        }

        if (isset($_POST['PapOrderDiscount'])) {
            $model->OrderAlipay = $_POST['PapOrderDiscount']['OrderAlipay'];
            $model->OrderLogis = $_POST['PapOrderDiscount']['OrderLogis'];
            $model->UpdateTime = time();
//            $bool=  PapOrderDiscount::model()->updateByPk($id);
            if($model->save()){
                $this->redirect(array('discountset'));
            }
        }
       
        switch ($model['OrderType']) {
            case '1':$orderType = '商城订单';
                break;
            case '2':$orderType = '询价单订单';
                break;
        }
         $this->performAjaxValidation($model);
        $this->render('editorderdis', array(
            'model' => $model,
            'orderType' => $orderType,
        ));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'financial-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

?>
