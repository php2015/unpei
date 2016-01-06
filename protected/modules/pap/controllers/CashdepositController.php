<?php

/*
 * 保证管理
 */

class CashdepositController extends Controller {
    /*
     * 我的保证金-首页
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "我的保证金";
        $type = Yii::app()->request->getParam('type');
        $data = CashdepositService::getrecords($type);
        $money = CashdepositService::getdeposit($type);
        $this->render('index', array('dataProvider' => $data, 'type' => $type, 'money' => $money));
    }

    /*
     * 我的保证金-详情-退款
     */

    public function actionInfo() {
        $this->pageTitle = Yii::app()->name . '-' . "我的保证金";
        $ID = Yii::app()->request->getParam('id');
        $cashinfo = CashdepositService::cashgetcash($ID);
        if ($cashinfo->Item == '2') {
            $model = OrderreturnService::nogetreturn($cashinfo->BusinessNO);
            if (!$model) {
                $this->redirect(array('index'));
            }
            $returnaddress = OrderService::getreturnship($model->ID);
            $this->render('returninfo', array('data' => $model, 'cashinfo' => $cashinfo, 'returnaddress' => $returnaddress));
        }
    }

    /*
     * 我的保证金-详情-违规
     */

    public function actionInfos() {
        $OrganID = Yii::app()->user->getOrganID();
        $ID = Yii::app()->request->getParam('id');
        $cashinfo = CashdepositService::cashgetcash($ID);
        $sql = "SELECT b.OrganName, b.Identity, b.UnionID, c.Behavior, e.Name AS itemName, a.* 
                FROM jpd_llegal_record_dealer AS a LEFT JOIN jpd_organ AS b ON a.OrganID = b.ID LEFT JOIN jpd_irregular AS c on a.SettingsID = c.ID 
                LEFT JOIN jpd_irregular_item AS e ON c.ItemID = e.ID
                WHERE a.IsDelete = 0 AND a.LlegalNO = '{$cashinfo->BusinessNO}' AND c.`Status` = 1";
        $data = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $TotalScore = LlegalRecord::model()->find("OrganID = '{$OrganID}'")->TotalScore;
        if (!$TotalScore) {
            $TotalScore = 100;
        }
        $this->render('detail', array("data" => $data[0], "TotalScore" => $TotalScore));
    }

}
