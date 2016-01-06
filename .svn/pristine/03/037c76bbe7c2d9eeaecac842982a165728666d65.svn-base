<?php

/*
 * 商务共享管理
 */

class BusinessshareController extends Controller {

    public $layout = '//layouts/cim';

    /*
     * 渲染申请共享列表页
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "商务共享管理";
        $this->render('index');
    }

    /*
     * 获取申请机构列表信息
     */

    public function actionApplylist() {
        $OrganID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        if ($_GET) {
            $criteria = $this->getSearch($_GET);
        }
        $criteria->addCondition("t.InitiatorID = $OrganID", "AND");     //当前登录用户为共享发起人
        $criteria->order = "t.CreateTime DESC";
        //分页
        $count = BusinessShare::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = BusinessShare::model()->findAll($criteria);
        foreach ($model as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['ShareID'] = $value['ShareID'];
            $data[$key]['CreateTime'] = F::msubstr(date("Y-m-d H:i:s", $value['CreateTime']));
            $data[$key]['LaunchTime'] = date("Y-m-d H:i:s", $value['CreateTime']);
            $data[$key]['UpdateTime'] = date("Y-m-d H:i:s", $value['UpdateTime']);
            $data[$key]['InitiatorName'] = F::msubstr($value['InitiatorName']);
            $data[$key]['LaunchName'] = $value['InitiatorName'];
            $data[$key]['ShareName'] = F::msubstr($value['ShareName']);
            $data[$key]['ReceiveName'] = $value['ShareName'];
            $data[$key]['VerifyInfo'] = $value['VerifyInfo'];
            //共享方式
            if ($value['ShareType'] == 1) {
                $data[$key]['ShareType'] = "联系人共享";
            } elseif ($value['ShareType'] == 2) {
                $data[$key]['ShareType'] = "商品共享";
            } elseif ($value['ShareType'] == 3) {
                $data[$key]['ShareType'] = "全部共享";
            }
            //共享状态
            if ($value['Status'] == 1) {
                $data[$key]['Status'] = "待确认";
            } elseif ($value['Status'] == 2) {
                $data[$key]['Status'] = "共享中";
            }
            //获取共享机构信息
            $organ = $this->getOrgan($value['InitiatorID'], $value['ShareID']);
            $data[$key]['ClientName'] = F::msubstr($organ['name']);
            $data[$key]['SJiapartsID'] = F::msubstr($organ['jiapart_ID']);
            $data[$key]['Phone'] = F::msubstr($organ['phone']);
            $data[$key]['Address'] = F::msubstr(Area::getCity($organ['province']) . Area::getCity($organ['city']) . Area::getCity($organ['area']));
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 渲染接受共享列表页
     */

    public function actionShare() {
        $this->pageTitle = Yii::app()->name . '-' . "商务共享管理";
        $this->render('share');
    }

    /*
     * 获取接受共享机构列表信息
     */

    public function actionSharelist() {
        $OrganID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        if ($_GET) {
            $criteria = $this->getSearch($_GET);
        }
        $criteria->addCondition("t.ShareID = $OrganID", "AND");     //当前登录用户为共享接收人
        $criteria->order = "t.CreateTime DESC";
        //分页
        $count = BusinessShare::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = BusinessShare::model()->findAll($criteria);
        foreach ($model as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['InitiatorID'] = $value['InitiatorID'];
            $data[$key]['CreateTime'] = F::msubstr(date("Y-m-d H:i:s", $value['CreateTime']));
            $data[$key]['LaunchTime'] = date("Y-m-d H:i:s", $value['CreateTime']);
            $data[$key]['UpdateTime'] = date("Y-m-d H:i:s", $value['UpdateTime']);
            $data[$key]['InitiatorName'] = F::msubstr($value['InitiatorName']);
            $data[$key]['LaunchName'] = $value['InitiatorName'];
            $data[$key]['ShareName'] = F::msubstr($value['ShareName']);
            $data[$key]['ReceiveName'] = $value['ShareName'];
            $data[$key]['VerifyInfo'] = $value['VerifyInfo'];
            //共享方式
            if ($value['ShareType'] == 1) {
                $data[$key]['ShareType'] = "联系人共享";
            } elseif ($value['ShareType'] == 2) {
                $data[$key]['ShareType'] = "商品共享";
            } elseif ($value['ShareType'] == 3) {
                $data[$key]['ShareType'] = "全部共享";
            }
            //共享状态
            if ($value['Status'] == 1) {
                $data[$key]['Status'] = "待确认";
            } elseif ($value['Status'] == 2) {
                $data[$key]['Status'] = "共享中";
            }
            //获取共享机构信息
            $organ = $this->getOrgan($value['ShareID'], $value['InitiatorID']);
            $data[$key]['ClientName'] = F::msubstr($organ['name']);
            $data[$key]['SJiapartsID'] = F::msubstr($organ['jiapart_ID']);
            $data[$key]['Phone'] = F::msubstr($organ['phone']);
            $data[$key]['Address'] = F::msubstr(Area::getCity($organ['province']) . Area::getCity($organ['city']) . Area::getCity($organ['area']));
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 通过发起方ID与共享方ID获取共享方机构信息
     */

    public function getOrgan($userid, $contactid) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.user_id = $userid", "AND");
        $criteria->addCondition("t.contact_user_id = $contactid", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
        $model = BusinessContacts::model()->find($criteria)->attributes;
        return $model;
    }

    /*
     * 获取共享关系表中已确认共享关系的机构ID
     */

    public function getShareids() {
        $OrganID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.InitiatorID = $OrganID", "AND");
        $criteria->addCondition("t.Status = 2", "AND");
        $model = BusinessShare::model()->findAll($criteria);
        $ids = array();
        foreach ($model as $value) {
            $ids[] = $value['ShareID'];
        }
        return $ids;
    }

    /*
     * 获取业务联系人中不在共享名单中的经销商信息
     */

    public function actionContact() {
        $OrganID = Commonmodel::getOrganID();
        //获取共享关系表中机构ID
        $ids = $this->getShareids();
        //获取用户表中所有经销商ID
        $users = User::getDealerID();
        foreach($users as $user){
            $identity[]=$user['id'];
        }
        //获取不在共享关系表中的机构信息
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.contact_user_id', $identity);  //业务联系人属于经销商
        $criteria->addCondition("t.user_id = $OrganID", "AND");     //当前机构下
        $criteria->addCondition("t.Status = 0", "AND");             //未删除
        $criteria->addNotInCondition('t.contact_user_id', $ids);    //业务联系人不在确定共享关系中
        $criteria->order = "t.create_time desc";    //以添加时间倒序
        //通过机构名称模糊检索
        if ($_GET['name']) {
            $criteria->addSearchCondition('t.companyname', $_GET['name'], "AND");
        }
        //分页
        $count = BusinessContacts::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = BusinessContacts::model()->findAll($criteria);
        foreach ($model as $key => $value) {
            $data[$key]['id'] = $value['id'];
            $data[$key]['name'] = F::msubstr($value['name']);
            $data[$key]['sex'] = $value['sex'];
            $data[$key]['jiapart_ID'] = $value['jiapart_ID'];
            $data[$key]['companyname'] = F::msubstr($value['companyname']);
            $data[$key]['phone'] = F::msubstr($value['phone']);
            $data[$key]['address'] = F::msubstr(Area::getCity($value['province']) . Area::getCity($value['city']) . Area::getCity($value['area']));
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 获取查询结果
     */

    public function getSearch($search) {
        if ($search) {
            $criteria = new CDbCriteria();
            if ($search['Status']) {
                $criteria->addCondition("t.Status = {$search['Status']}", "AND");
            }
            if ($search['ShareType']) {
                $criteria->addCondition("t.ShareType = {$search['ShareType']}", "AND");
            }
            return $criteria;
        }
    }

    /*
     * 通过ID获取业务联系人信息
     */

    public function getContact($id) {
        $model = BusinessContacts::model()->findByPk($id)->attributes;
        return $model;
    }

    /*
     * 共享申请--判断添加
     */

    public function actionShareapply() {
        //通过$_POST['ContactID']获取联系人信息
        $contact = $this->getContact(Yii::app()->request->getParam("ContactID"));
        //判断该共享机构是否与当前登录用户存在共享关系，存在则提示用户是否覆盖
        $share = BusinessShare::model()->find(array(
            "condition" => "InitiatorID = {$contact['user_id']} and ShareID = {$contact['contact_user_id']} and Status = 1"
                ));
        //向该机构的共享申请已存在，但尚未确认
        if ($share) {
            $result['exists'] = "已存在向该机构的申请记录，是否覆盖？";
            echo json_encode($result);
        }
        //向该机构的申请记录不存在，进行添加操作
        else {
            $type = explode(',', Yii::app()->request->getParam("ShareType"));
            if ($type[1]) {
                $ShareType = 3;
            } else {
                $ShareType = Yii::app()->request->getParam("ShareType");
            }
            $verify = Yii::app()->request->getParam("VerifyInfo");
            $model = new BusinessShare;
            $model->InitiatorID = $contact['user_id'];
            $model->InitiatorName = Commonmodel::getOrganName();
            $model->ShareID = $contact['contact_user_id'];
            $model->ShareName = $contact['companyname'];
            $model->ShareType = $ShareType;
            $model->VerifyInfo = ($verify == "(验证信息不能超过64个字符)") ? '' : $verify;
            $model->Status = 1;
            $model->CreateTime = time();
            $model->UpdateTime = time();
            $success = $model->save();
            if ($success == 1) {
                $result['success'] = "共享申请发送成功!";
            } else {
                $result['errorMsg'] = "系统异常，共享申请发送失败!";
            }
            echo json_encode($result);
        }
    }

    /*
     * 共享申请--覆盖修改
     */

    public function actionCover() {
        $type = explode(',', Yii::app()->request->getParam("ShareType"));
        if ($type[1]) {
            $ShareType = 3;
        } else {
            $ShareType = Yii::app()->request->getParam("ShareType");
        }
        $verify = Yii::app()->request->getParam("VerifyInfo");
        $contact = $this->getContact(Yii::app()->request->getParam("ContactID"));
        //获取向该机构的共享记录，取出记录id
        $share = BusinessShare::model()->find(array(
                    "condition" => "InitiatorID = {$contact['user_id']} and ShareID = {$contact['contact_user_id']} and Status = 1"
                ));
        //编辑
        $success = BusinessShare::model()->updateAll(array(
            "ShareType" => $ShareType,
            "VerifyInfo" => ($verify == "(验证信息不能超过64个字符)") ? '' : $verify,
            "CreateTime" => time(),
            "UpdateTime" => time()
                ), "ID=:ID", array(":ID" => $share['ID']));
        if ($success == 1) {
            $result['success'] = "共享申请发送成功!";
        } else {
            $result['errorMsg'] = "系统异常，共享申请发送失败!";
        }
        echo json_encode($result);
    }

    /*
     * 确认共享申请
     */

    public function actionConfirm() {
        $success = BusinessShare::model()->updateAll(array(
            "Status" => 2,
            "UpdateTime" => time()
                ), "ID=:id", array(":id" => Yii::app()->request->getParam("ID")));
        if ($success == 1) {
            $result['success'] = "共享状态删除成功!";
        } else {
            $result['errorMsg'] = "系统异常，共享状态删除失败!";
        }
        echo json_encode($result);
    }

    /*
     * 取消共享
     */

    public function actionCancel() {
        $success = BusinessShare::model()->deleteAll("ID=:id", array(":id" => Yii::app()->request->getParam("ID")));
        if ($success == 1) {
            $result['success'] = "共享状态删除成功!";
        } else {
            $result['errorMsg'] = "系统异常，共享状态删除失败!";
        }
        echo json_encode($result);
    }

}

?>
