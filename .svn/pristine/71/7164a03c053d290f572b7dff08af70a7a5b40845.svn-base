<?php

/*
 * 物流配送管理
 */

class LogisticsController extends Controller {

    public $layout = '//layouts/cim';

    /*
     * 配送管理页面
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "物流配送管理";
        $this->render("index");
    }

    /*
     * 物流公司配送列表  
     */

    public function actionGetlogisticslist() {
        $organID = Commonmodel::getOrganID();  //获取机构ID
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = "id DESC";
        $criteria->addCondition("OrganID=" . $organID);  //查询条件：根据机构ID查询物流数据
        $count = Logistics::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->applyLimit($criteria);
        $modeles = Logistics::model()->findAll($criteria);
        foreach ($modeles as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['OrganID'] = $value['OrganID'];
            $data[$key]['Company'] = F::msubstr($value['LogisticsCompany']);
            $data[$key]['Description'] = F::msubstr($value['LogisticsDescription']);
            $data[$key]['LogisticsCompany'] = $value['LogisticsCompany'];
            $data[$key]['LogisticsDescription'] = $value['LogisticsDescription'];
            $data[$key]['CreateTime'] = date("Y-m-d H:i:s", $value['CreateTime']);
            $data[$key]['UpdateTime'] = $value['UpdateTime'];
            $data[$key]['Status'] = $value['Status'];

            $address = $this->getAddress($value['ID']);
            $data[$key]['Address'] = $address ? F::msubstr(substr($address, 0, -3)) : '';
            $data[$key]['AddressDetail'] = $address ? substr($address, 0, -3) : '';
            //$data[$key]['Address'] = Area::getCity($address['Province']) . Area::getCity($address['City']) . Area::getCity($address['Area']);
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
//        var_dump($rs);exit;
        echo json_encode($rs);
    }

    /*
     * 添加物流公司
     */

    public function actionAddlogistics() {
        $organID = Commonmodel::getOrganID();
        if (isset($_POST)) {
            $model = Logistics::model()->find(array(
                "condition" => "OrganID = $organID and LogisticsCompany = '{$_POST['LogisticsCompany']}'"
                    ));
            if (!empty($model)) {
                $rs = array('success' => 0, 'errorMsg' => '物流公司不能重复添加');
            } else {
                unset($model);
                $model = new Logistics();
                $model->OrganID = $organID;
                $model->LogisticsCompany = $_POST['LogisticsCompany'];
                $model->LogisticsDescription = $_POST['LogisticsDescription'];
                $model->CreateTime = time();
                $model->UpdateTime = time();
                $model->Status = 2;
                $bool = $model->save();
                if ($bool == 1) {
                    $ID = Yii::app()->db->getLastInsertID();
                    // 把地址添加到关系表里，可添加多个
                    $sprovince = $_POST['province'];
                    $scity = $_POST['city'];
                    $sarea = $_POST['area'];
                    $addlegth = count($sprovince);
                    for ($i = 0; $i < $addlegth; $i++) {
                        $model1 = new LogisticsAddress();
                        $model1->LogisticsID = $ID;
                        $model1->Province = $sprovince[$i];
                        $model1->City = $scity[$i];
                        $model1->Area = $sarea[$i];
                        $res = $model1->save();
                    }
                }
                if ($res == 1) {
                    $rs = array('success' => 1, 'errorMsg' => '物流公司添加成功');
                } else {
                    $rs = array('success' => 0, 'errorMsg' => '物流公司添加失败');
                }
            }
        }
        echo json_encode($rs);
    }

    /**
     * 删除物流公司以及地址列表
     */
    public function actionDeletelogistics() {
        $id = trim($_GET['ID']);
        $model = Logistics::model()->findByPk($id);
        $data = array();
        $dellog = $model->delete();
        if ($dellog) {
            $del_address = LogisticsAddress::model()->deleteAll("LogisticsID= '$id '");
            if ($del_address) {
                $data['success'] = 1;
                $data['errorMsg'] = '物流公司删除成功！';
            }
        } else {
            $data['success'] = 0;
            $data['errorMsg'] = '物流公司删除失败！';
        }
        echo json_encode($data);
    }

    /*
     * 只删除弹框里一条地址  不删除物流
     */

    public function actionDeletelogaddress() {
        $id = $_GET['ID'];
        $model = LogisticsAddress::model()->findByPk($id)->delete();
        echo json_decode($model);
    }

    /*
     * 修改物流信息
     */

    public function actionUpdatelogistics() {
        $id = trim($_GET['ID']);
        $organID = Commonmodel::getOrganID();
        $model = Logistics::model()->findByPk($id);
        if (isset($_POST)) {
            $attributes['LogisticsDescription'] = $_POST['LogisticsDescription'];
            $model->attributes = $attributes;
            $model->LogisticsCompany = $_POST['LogisticsCompany'];
            $model->OrganID = $organID;
            $model->CreateTime = time();
            $model->UpdateTime = time();
            $model->Status = 2; //状态为2是经销商物流
            $bool = $model->save();
            if ($bool) {
                // 把地址添加到关系表里，可添加多个
                $sprovince = $_POST['province'];
                $scity = $_POST['city'];
                $sarea = $_POST['area'];
                $addlegth = count($sprovince);
                for ($i = 0; $i < $addlegth; $i++) {
                    $model1 = new LogisticsAddress();
                    $model1->LogisticsID = $id;
                    $model1->Province = $sprovince[$i];
                    $model1->City = $scity[$i];
                    $model1->Area = $sarea[$i];
                    $model1->save();
                }
            }
            if ($bool) {
                $rs = array('success' => 1, 'errorMsg' => '物流公司修改成功');
            } else {
                $rs = array('success' => 0, 'errorMsg' => '物流公司修改失败');
            }
        }
        echo json_encode($rs);
    }

    /*
     * 获取前台地址列表
     */

    public function getAddress($address) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("LogisticsID=$address");
        $model = LogisticsAddress::model()->findAll($criteria);
        //循环多个地址
        $add = '';
        foreach ($model as $value) {
            $add .= Area::getCity($value['Province']) . Area::getCity($value['City']) . Area::getCity($value['Area']) . '、';
        }
        return $add;
    }

    /*
     * 获取弹框地址
     */

    public function actionGetaddlogs() {
//      $address = Yii::app()->request->getParams('ID');
        $address = $_GET['ID'];
        $criteria = new CDbCriteria();
        $criteria->addCondition("LogisticsID=$address");
        $model = LogisticsAddress::model()->findAll($criteria);
        if (!empty($model)) {
            foreach ($model as $key => $showAddress) {
                $add[$key]['ID'] = $showAddress['ID']; //传入要删除的弹框地址 ID
                $add[$key]['add'] = Area::getCity($showAddress['Province']) . Area::getCity($showAddress['City']) . Area::getCity($showAddress['Area']);
            }
        }
        echo json_encode($add);
    }

}

?>
