<?php

/**
 * 经销商-发货公告
 */
class SendnoticeController extends Controller {
    /*
     * 发货公告
     */

    public function actionIndex() {
        $OrganID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition("OrganID=$OrganID");
        $dataProvider = new CActiveDataProvider('PapGoodsSendnotice', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '10'
            ),
                )
        );
        $this->render('index', array('dataProvider' => $dataProvider));
    }

    /*
     * 添加发货公告
     */

    public function actionAdd() {
        $this->render('addSendnotice');
    }

    /*
     * 公告发布保存
     */

    public function actionAddsave() {
        if ($_POST) {
            $OrganID = Yii::app()->request->getParam("OrganID");
            $Content = Yii::app()->request->getParam("Content");
            $addsql = "insert into pap_goods_sendnotice (OrganID,Content,CreateTime) value ('" . $OrganID . "','" . $Content . "','" . time() . "')";
            $result = Yii::app()->papdb->createCommand($addsql)->execute();
            if ($result) {
                $this->redirect(array('index'));
            } else {
                $this->redirect(array('add'));
            }
        }
    }

    /*
     * 修改发货公告
     */

    public function actionEdit() {
        $id = Yii::app()->request->getParam("id");
        $data = PapGoodsSendnotice::model()->findByPk($id);
        $this->render('editSendnotice', array('data' => $data));
    }

    /*
     * 公告修改保存 
     */

    public function actionEditsave() {
        $Content = Yii::app()->request->getParam("Content");
        $ID = Yii::app()->request->getParam("ID");
        if ($_POST) {
            $editsql = "update pap_goods_sendnotice set Content='" . $Content . "',UpdateTime='" . time() . "' where ID=" . $ID;
            $result = Yii::app()->papdb->createCommand($editsql)->execute();
            if ($result) {
                $this->redirect(array('index'));
            } else {
                $this->redirect(array('Edit', 'ID' => $ID));
            }
        }
    }

    /*
     * 发货公告删除
     */

    public function actionDel() {
        $data = PapGoodsSendnotice::model();
        $id = Yii::app()->request->getParam("id");
        $result = $data->deleteByPk($id);
        echo json_encode($result);
    }

}
