<?php

/*
 * 营销参数设置
 */

class DiscountsetController extends Controller {
    /*
     * 当前机构合作类型数据显示
     * 先判断当前机构的合作类型数据是否存在，不存在则添加，添加后显示；
     * 存在则直接显示
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "营销参数设置";
        $OrganID = Yii::app()->user->getOrganID();
        $model = GoodsPriceManage::model()->findAll("OrganID=:ID", array(":ID" => $OrganID));
        if (empty($model)) {
            unset($model);
            $model = new GoodsPriceManage;
            $model->OrganID = $OrganID;
            $model->CooperationType = "A";
            $model->PriceRatio = "";
            $model->UpdateTime = time();
            if ($model->insert()) {
                unset($model);
                $model = new GoodsPriceManage;
                $model->OrganID = $OrganID;
                $model->CooperationType = "B";
                $model->PriceRatio = "";
                $model->UpdateTime = time();
                if ($model->insert()) {
                    unset($model);
                    $model = new GoodsPriceManage;
                    $model->OrganID = $OrganID;
                    $model->CooperationType = "C";
                    $model->PriceRatio = "100";
                    $model->UpdateTime = time();
                    $model->insert();
                }
            }
            unset($model);
            $model = GoodsPriceManage::model()->findAll("OrganID=:ID", array(":ID" => $OrganID));
        }
        $criteria = new CDbCriteria();
        $criteria->addCondition('OrganID =' . $OrganID);
        //  $criteria->order = 'ID desc';
        $dataProvider = new CActiveDataProvider('GoodsPriceManage',
                        array(
                            'criteria' => $criteria,
                ));
        $this->render('index', array('dataProvider' => $dataProvider));
    }

    /*
     * 修改合作类型价格比
     */

    public function actionEditdis() {
        $this->pageTitle = Yii::app()->name . '-' . "修改价格比";
        $id = Yii::app()->request->getParam('id'); //获取要修改的ID
        $OrganID = Yii::app()->user->getOrganID();
        $bool = true;
        if ($id) {
            $model = GoodsPriceManage::model()->findByPk($id);
        } else {
            $model = new GoodsPriceManage();
        }
        $this->performAjaxValidation($model);
        if (isset($_POST['GoodsPriceManage'])) {
            if ($model->CooperationType == 'A') {
                $model->PriceRatio = $_POST['GoodsPriceManage']['PriceRatio'];
                $res = GoodsPriceManage::model()->find(array(
                    "condition" => "OrganID = $OrganID AND CooperationType like 'B%'"
                        ));
//              echo 'B.' . $res['PriceRatio'] . '||A.' . $_POST['GoodsPriceManage']['PriceRatio'];exit;
                if (!empty($res['PriceRatio']) && $res['PriceRatio'] <= $_POST['GoodsPriceManage']['PriceRatio']) {
                    //如果B比A还小
                    $bool = false;
                }
            }
            if ($model->CooperationType == 'B') {
                $model->PriceRatio = $_POST['GoodsPriceManage']['PriceRatio'];
//                if (empty($model->PriceRatio)) {
//                    $bool = false;
//                }
                $res = GoodsPriceManage::model()->find(array(
                    "condition" => "OrganID = $OrganID AND CooperationType like 'A%'"
                        ));
                //  echo 'A.' . $res['PriceRatio'] . '||B.' . $_POST['GoodsPriceManage']['PriceRatio'];exit;
                if (!empty($res['PriceRatio']) && $res['PriceRatio'] >= $_POST['GoodsPriceManage']['PriceRatio']) {
                    //如果A比B还大
                    $bool = false;
                }
                if ($_POST['GoodsPriceManage']['PriceRatio'] >= 100) {
                    $bool = false;
                }
            }
            if ($model->CooperationType == 'C') {
                $bool = false;
            }
            if ($bool == true) {
                $model->save();
                $this->redirect(array('index'));
            }
        }
        switch ($model['CooperationType']) {
            case 'A':$cooperationType = 'VIP客户';
                break;
            case 'B':$cooperationType = '重要客户';
                break;
            case 'C':$cooperationType = '普通客户';
                break;
        }

        $aa = GoodsPriceManage::model()->find(array(
            "condition" => "OrganID = $OrganID AND CooperationType like 'A%'"
                ));
        $bb = GoodsPriceManage::model()->find(array(
            "condition" => "OrganID = $OrganID AND CooperationType like 'B%'"
                ));
        $this->render('editdis', array(
            'model' => $model,
            'aa' => $aa,
            'bb' => $bb,
            'cooperationType' => $cooperationType,
        ));
    }

    /*
     * 最小金额列表
     */

    public function actionTurnover() {
        $this->pageTitle = Yii::app()->name . '-' . "订单最小金额";
        $OrganID = Yii::app()->user->getOrganID();
        $model = PapOrderMinTurnover::model()->find("OrganID=:OrganID", array(":OrganID" => $OrganID))->attributes;
        if (empty($model)) {
            unset($model);
            $model = new PapOrderMinTurnover;
            $model->OrganID = $OrganID;
            $model->MinTurnover = '';
            $model->UpdateTime = time();
            $model->insert();
        }
        $criteria = new CDbCriteria();
        $criteria->addCondition('OrganID =' . $OrganID);
        $dataProvider = new CActiveDataProvider('PapOrderMinTurnover',
                        array(
                            'criteria' => $criteria,
                ));
        $this->render('turnover', array('dataProvider' => $dataProvider));
    }

    /*
     * 修改订单最小金额
     */

    public function actionEditturnover() {
        $this->pageTitle = Yii::app()->name . '-' . "修改订单最小金额";
        $id = Yii::app()->request->getParam('id'); //获取要修改的ID
        if ($id) {
            $model = PapOrderMinTurnover::model()->findByPk($id);
        } else {
            $model = new PapOrderMinTurnover();
        }
        $this->performAjaxValidation($model);
        if (isset($_POST['PapOrderMinTurnover'])) {
            $model->MinTurnover = $_POST['PapOrderMinTurnover']['MinTurnover'];
            $model->UpdateTime = time();
            if ($model->save()) {
                $this->redirect(array('turnover'));
            }
        }
        $this->render('editturnover', array(
            'model' => $model,
        ));
    }

    /*
     * 折扣率列表
     */

    /* public function actionDiscountset() {
      $this->pageTitle = Yii::app()->name . '-' . "折扣率设置";
      $OrganID = Yii::app()->user->getOrganID();
      $criteria = new CDbCriteria();
      $criteria->addCondition('OrganID =' . $OrganID);
      $model = PapOrderDiscount::model()->findAll("OrganID=$OrganID");
      if (!$model) {
      $sql = "insert into pap_order_discount(OrganID,OrderType,OrderAlipay,OrderLogis,UpdateTime)"
      . "values($OrganID,1,null,null," . time() . "),($OrganID,2,null,null," . time() . "),($OrganID,3,null,null," . time() . ")";
      Yii::app()->papdb->CreateCommand($sql)->execute();
      }
      //  $criteria->order = 'ID desc';
      $dataProvider = new CActiveDataProvider('PapOrderDiscount',
      array(
      'criteria' => $criteria,
      ));
      $this->render('discountset', array('dataProvider' => $dataProvider));
      } */

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
            if ($model->save()) {
                $this->redirect(array('discountset'));
            }
        }

        switch ($model['OrderType']) {
            case '1':$orderType = '商城订单';
                break;
            case '2':$orderType = '询价单订单';
                break;
            case '3':$orderType = '报价单订单';
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
