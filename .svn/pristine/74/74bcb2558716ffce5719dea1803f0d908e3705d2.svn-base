<?php

/*
 * 客户管理
 */

class ContactController extends Controller {
    /*
     * 获取机构表 服务店
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "客户管理";
        $page = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : 1;
        $pageSize = 15;
        $sql = "select * from jpd_organ where Identity=3";
        if ($_GET) {
            $OrganName = Yii::app()->request->getParam('OrganName');
            if ($OrganName) {
                $sql.=" and OrganName like '%{$OrganName}%'";
            }
            $Phone = Yii::app()->request->getParam('Phone');
            if ($Phone) {
                $sql.=" and Phone like '%{$Phone}%'";
            }
        }
        $sql.=" order by ID desc";
        $count = Yii::app()->jpdb->createCommand(str_replace('*', 'count(*)', $sql))->queryScalar();
        $data = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->jpdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            $datas[$k]['rowNO'] = $k + 1 + ($page - 1) * $pageSize;
//            $datas[$k]['OrganName']='<div title="'.$v['OrganName'].'">'.$v['OrganName'].'</div>';
        }
        $data->setData($datas);
        $this->render('index', array('dataProvider' => $data, 'OrganName' => $OrganName, 'Phone' => $Phone));
    }

    public function actionEditlist() {
        $this->pageTitle = Yii::app()->name . '-' . "修改客户级别";
        $id = Yii::app()->request->getParam('id');
        $DealerID = Yii::app()->user->getOrganID();
        $organname = Organ::model()->findByPk($id);
        $model = PapClientType::model()->find('DealerID = :DealerID and ServiceID = :ServiceID', array(':DealerID' => $DealerID, ':ServiceID' => $id));
        $this->render('editlist', array('organname' => $organname, 'model' => $model));
    }

    /*
     * 修改级别
     */

    public function actionEditclient() {
        $this->pageTitle = Yii::app()->name . '-' . "修改客户级别";
        $DealerID = Yii::app()->user->getOrganID();
        $ServiceID = $_POST['ServiceID'];
        $Cooperationtype = $_POST['Cooperationtype'];
        $model = PapClientType::model()->find('DealerID = :DealerID and ServiceID = :ServiceID', array(':DealerID' => $DealerID, ':ServiceID' => $ServiceID));
        if ($model) {
            $model->ServiceID = $ServiceID;
            $model->Cooperationtype = $Cooperationtype;
            $model->CreateTime = time();
            $model->UpdateTime = time();
            $model->save();
            if ($model->save()) {
                echo json_encode(array('success' => 1));
            }
        } else {
            $sql = "insert into pap_client_type (DealerID,ServiceID,Cooperationtype,UpdateTime) values ('$DealerID','$ServiceID','$Cooperationtype'," . time() . ")";
            $insert = Yii::app()->papdb->createCommand($sql)->query();
            if ($insert) {
                echo json_encode(array('success' => 1));
            }
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'financial-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

?>
