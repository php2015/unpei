<?php

/*
 * 价格管理
 */

class PricemanageController extends Controller {

    public $layout = '//layouts/cim';

    /*
     * 渲染价格管理页面
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "价格管理";
        $this->render("index");
    }

    /*
     * 当前机构合作类型数据显示
     * 先判断当前机构的合作类型数据是否存在，不存在则添加，添加后显示；
     * 存在则直接显示
     */

    public function actionPricelist() {
        $OrganID = Commonmodel::getOrganID();
        $model = PriceManage::model()->findAll("OrganID=:ID", array(":ID" => $OrganID));
        if (empty($model)) {
            unset($model);
            $model = new PriceManage;
            $model->OrganID = $OrganID;
            $model->CooperationType = "A：VIP客户";
            $model->PriceRatio = "";
            $model->UpdateTime = time();
            if ($model->save()) {
                unset($model);
                $model = new PriceManage;
                $model->OrganID = $OrganID;
                $model->CooperationType = "B：重要客户";
                $model->PriceRatio = "";
                $model->UpdateTime = time();
                if ($model->save()) {
                    unset($model);
                    $model = new PriceManage;
                    $model->OrganID = $OrganID;
                    $model->CooperationType = "C：普通客户";
                    $model->PriceRatio = "100%";
                    $model->UpdateTime = time();
                    $model->save();
                }
            }
            unset($model);
            $model = PriceManage::model()->findAll("OrganID=:ID", array(":ID" => $OrganID));
        }
        foreach ($model as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['OrganName'] = Commonmodel::getOrganName();
            $data[$key]['CooperationType'] = $value['CooperationType'];
            $data[$key]['PriceRatio'] = $value['PriceRatio'];
        }
        $rs = array(
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 设置价格比
     */

    public function actionSetprice() {
        $OrganID = Commonmodel::getOrganID();
        $type = $_POST['CooperationType'];
        $bool = true;
        if ($type == 'A：VIP客户') {
            $res = PriceManage::model()->find(array(
                "condition" => "OrganID = $OrganID AND CooperationType = 'B：重要客户'"
                    ));
            if (!empty($res['PriceRatio'])&&$res['PriceRatio'] <= $_POST['PriceRatio']) {
                $bool =false;
            }
        } elseif ($type == 'B：重要客户') {
            $res = PriceManage::model()->find(array(
                "condition" => "OrganID = $OrganID AND CooperationType = 'A：VIP客户'"
                    ));
            if ($res['PriceRatio'] >= $_POST['PriceRatio']) {
                $bool = false;
            }
        }
        if ($bool == true) {
            $model = PriceManage::model()->updateByPk($_POST['priceID'], array(
                "PriceRatio" => $_POST['PriceRatio'],
                "UpdateTime" => time()
                    ));
        }
        if ($bool == false) {
            $result['errorMsg'] = "设置失败，A类VIP客户价格比要小于B类重要客户！";
        } elseif ($model == 1 && $bool == true) {
            $result['success'] = "价格比设置成功！";
        } else {
            $result['errorMsg'] = "系统异常，价格比设置失败！";
        }
        echo json_encode($result);
    }

    /*
     * 渲染设置订单最小交易额页面
     */

    public function actionTurnover() {
        $this->pageTitle = Yii::app()->name . '-' . "价格管理";
        //获取当前经销商设置的订单最小交易额
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'set') {
            $display = 'none';
        }
        $OrganID = Commonmodel::getOrganID();
        $model = OrderMinTurnover::model()->find("OrganID=:OrganID", array(":OrganID" => $OrganID))->attributes;
        $this->render("turnover", array(
            "model" => $model,
            "display" => $display
        ));
    }

    /*
     * 设置订单最小交易额
     */

    public function actionSetturnover() {
        $OrganID = Commonmodel::getOrganID();
        $MinTurnover = $_POST['MinTurnover'];
        $model = OrderMinTurnover::model()->find("OrganID=:OrganID", array(":OrganID" => $OrganID))->attributes;
        if (empty($model)) {
            unset($model);
            $model = new OrderMinTurnover();
            $model->OrganID = $OrganID;
            $model->MinTurnover = $MinTurnover;
            $model->UpdateTime = time();
            $success = $model->save();
        } else {
            $success = OrderMinTurnover::model()->updateAll(array(
                "MinTurnover" => $MinTurnover,
                "UpdateTime" => time()
                    ));
        }
        if ($success == 1) {
            $result['success'] = "订单最小交易额设置成功！";
        } else {
            $result['errorMsg'] = "系统异常，订单最小交易额设置失败！";
        }
        echo json_encode($result);
    }

}

?>
