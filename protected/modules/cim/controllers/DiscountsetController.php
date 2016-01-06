<?php

/*
 * 经销商-订单折扣率设置
 */

class DiscountsetController extends Controller {

    public $layout = '//layouts/cim';

    /*
     * 嘉配商城折扣率
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "折扣率设置";
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'set') {
            $display = 'none';
        }
        $OrganID = Commonmodel::getOrganID();
        $model = JpOrderDiscount::model()->find(array("condition" => "OrganID = $OrganID AND OrderType = 1"))->attributes;
        $this->render("index", array(
            "model" => $model,
            "display" => $display
        ));
    }

    /*
     * 商城订单折扣率设置
     */

    public function actionMallorder() {
        $OrganID = Commonmodel::getOrganID();
        $model = JpOrderDiscount::model()->find(array("condition" => "OrganID = $OrganID AND OrderType = 1"))->attributes;
        if ($model) {
            $bool = JpOrderDiscount::model()->updateAll(array(
                "OrderAlipay" => $_POST['OrderAlipay'],
                "OrderLogis" => $_POST['OrderLogis'],
                "UpdateTime" => time()
                    ), array("condition" => "OrganID = $OrganID AND OrderType = 1"));
        } else {
            unset($model);
            $model = new JpOrderDiscount();
            $model->OrganID = $OrganID;
            $model->OrderType = 1;
            $model->attributes = $_POST;
            $model->UpdateTime = time();
            $bool = $model->save();
        }
        if ($bool == 1) {
            $result['success'] = "商城订单折扣率设置成功！";
        } else {
            $result['errorMsg'] = "系统异常，商城订单折扣率设置失败！";
        }
        echo json_encode($result);
    }

    /*
     * 询价单订单折扣率
     */

    public function actionInquiry() {
        $this->pageTitle = Yii::app()->name . '-' . "折扣率设置";
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'set') {
            $display = 'none';
        }
        $OrganID = Commonmodel::getOrganID();
        $model = JpOrderDiscount::model()->find(array("condition" => "OrganID = $OrganID AND OrderType = 2"))->attributes;
        $this->render("inquiry", array(
            "model" => $model,
            "display" => $display
        ));
    }

    /*
     * 询价单订单折扣率设置
     */

    public function actionInquiryorder() {
        $OrganID = Commonmodel::getOrganID();
        $model = JpOrderDiscount::model()->find(array("condition" => "OrganID = $OrganID AND OrderType = 2"))->attributes;
        if ($model) {
            $bool = JpOrderDiscount::model()->updateAll(array(
                "OrderAlipay" => $_POST['OrderAlipay'],
                "OrderLogis" => $_POST['OrderLogis'],
                "UpdateTime" => time()
                    ), array("condition" => "OrganID = $OrganID AND OrderType = 2"));
        } else {
            unset($model);
            $model = new JpOrderDiscount();
            $model->OrganID = $OrganID;
            $model->OrderType = 2;
            $model->attributes = $_POST;
            $model->UpdateTime = time();
            $bool = $model->save();
        }
        if ($bool == 1) {
            $result['success'] = "询价单订单折扣率设置成功！";
        } else {
            $result['errorMsg'] = "系统异常，询价单订单折扣率设置失败！";
        }
        echo json_encode($result);
    }

    /*
     * 报价单订单折扣率
     */

    public function actionQuote() {
        $this->pageTitle = Yii::app()->name . '-' . "折扣率设置";
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'set') {
            $display = 'none';
        }
        $OrganID = Commonmodel::getOrganID();
        $model = JpOrderDiscount::model()->find(array("condition" => "OrganID = $OrganID AND OrderType = 3"))->attributes;
        $this->render("quote", array(
            "model" => $model,
            "display" => $display
        ));
    }

    /*
     * 询价单订单折扣率设置
     */

    public function actionQuoteorder() {
        $OrganID = Commonmodel::getOrganID();
        $model = JpOrderDiscount::model()->find(array("condition" => "OrganID = $OrganID AND OrderType = 3"))->attributes;
        if ($model) {
            $bool = JpOrderDiscount::model()->updateAll(array(
                "OrderAlipay" => $_POST['OrderAlipay'],
                "OrderLogis" => $_POST['OrderLogis'],
                "UpdateTime" => time()
                    ), array("condition" => "OrganID = $OrganID AND OrderType = 3"));
        } else {
            unset($model);
            $model = new JpOrderDiscount();
            $model->OrganID = $OrganID;
            $model->OrderType = 3;
            $model->attributes = $_POST;
            $model->UpdateTime = time();
            $bool = $model->save();
        }
        if ($bool == 1) {
            $result['success'] = "报价单订单折扣率设置成功！";
        } else {
            $result['errorMsg'] = "系统异常，报价单订单折扣率设置失败！";
        }
        echo json_encode($result);
    }

}

?>
