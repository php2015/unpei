<?php

Class PermissionController extends Controller {

    public function actionIndex() {
        $organID = Yii::app()->user->getOrganID();
        $params = array("rootID" => 0);

        $rootID = F::getroot();
        $params['rootID'] = $rootID;
        //组装参数
        //$params["scope"] = "stage"; //制定查询范围
        $params["scope"] = "sliderbar";
        //获取菜单数组
        if ($params["rootID"]) {
            //获取菜单模型
            $criteria = new CDbCriteria();
            $criteria->addCondition('ID=' . $params["rootID"]);
            $criteria->addCondition('IsShow=1');
            $firstmenu = FrontMenu::model()->find($criteria);
        }

        $menuArr = FrontMenu::getChildMenu($params);
        //获取列表角色
        $treeData = JpdOrganRoles::model()->findAll('OrganID=:organ and Status=:stu', array(':organ' => $organID, ':stu' => '0'));
        //获取部门
//        $depart = $this->Department();
        $data = array('treeData' => $treeData, 'menuArr' => $menuArr, 'firstmenu' => $firstmenu
//            'depart' => $depart
        );
        $this->render('index', $data);
    }

    //添加修改角色
    public function actionAddroles() {
        $organID = Yii::app()->user->getOrganID();
        $perID = Yii::app()->request->getParam('per');
        $rolename = Yii::app()->request->getParam('rolename');
        $des = Yii::app()->request->getParam('des');
        $roleID = Yii::app()->request->getParam('edit');
        if (isset($roleID) && !empty($roleID)) {
            $res = JpdOrganRoles::model()->updateByPk($roleID, array('RoleName' => $rolename, 'Describe' => $des, 'Jurisdiction' => $perID, 'UpdateTime' => time()));
            if ($res) {
                $this->redirect(array('index'));
            }
        }
        $data = array('RoleName' => $rolename, 'OrganID' => $organID, 'Describe' => $des,
            'Jurisdiction' => $perID, 'CreateTime' => time(), 'UpdateTime' => time()
        );
        $role = Yii::app()->jpdb->createCommand()->insert('jpd_organ_roles', $data);
        if ($role) {
            $this->redirect(array('index'));
        }
    }

    public function actionRoleuserinfo() {
        $data = array();
        $roleid = Yii::app()->request->getParam('roleid');
        $organID = Yii::app()->user->getOrganID();
        $roleID = Yii::app()->request->getParam('roleid');
        $res = JpdOrganRoleEmployees::model()->findAll('RoleID=:roleid and OrganID=:organ and Status=:sta', array(
            ':roleid' => $roleid, ':organ' => $organID, ':sta' => '0'
        ));
        if ($res) {
            foreach ($res as $key => $val) {
                $data[$key] = $val->attributes;
                $data[$key]['empinfo'] = JpdOrganEmployees::model()->find("t.ID = :ID AND t.Status = 0", array(":ID" => $val['EmployeeID']))->attributes;
            }
        }
        $role = JpdOrganRoles::model()->findByPk($roleid, 'Status=0')->attributes;
        $data['rolename'] = $role['RoleName'];

        echo json_encode($data);
    }

    //角色信息
    public function actionRoleinfo() {
        $per = array();
        $roleID = Yii::app()->request->getParam('roleid');
        $ress = JpdOrganRoles::model()->findByPk($roleID);
        $rootID = F::getroot();
        $per = $ress->attributes;
        $rs = array();
        $rs['per'] = $per;
        if ($per['Jurisdiction']) {
            $params['role'] = $per['Jurisdiction'];
            $params["scope"] = "sliderbar";
            $params['rootID'] = $rootID;
            $res = FrontMenu::getChildMenu($params);
            if ($res) {
                $rs['res'] = $res;
            }
        }
        echo json_encode($rs);
    }

    //修改
    public function actionGetroleid() {
        $per = array();
        $roleID = Yii::app()->request->getParam('roleid');
        $res = JpdOrganRoles::model()->findByPk($roleID);
        $per = $res->attributes;
        echo json_encode($per);
    }

//    //根据用户的角色选择根节点
//    public function getroot() {
//        if (Yii::app()->user->isMaker()) {
//            $rootID = 1;
//        } else if (Yii::app()->user->isDealer()) {
//            $rootID = 2;
//        } else if (Yii::app()->user->isServicer()) {
//            $rootID = 171;
//        }
//        return $rootID;
//    }
    //用户权限信息
    public function actionUserinfo() {
        $data = array();
        $empid = Yii::app()->request->getParam('empid');
        $emp = JpdOrganEmployees::model()->findByPk($empid)->attributes;
        if ($emp) {
            $per = JpdOrganRoleEmployees::model()->findAll('EmployeeID=:emp and Status=:sta ', array(':emp' => $emp['ID'], ':sta' => '0'));
            if ($per) {
                foreach ($per as $k => $v) {
                    $data[$k] = $v->attributes;
                    $data[$k]['empname'] = $emp['Name'];
                    $data[$k]['empID'] = $emp['ID'];
                    $data[$k]['role'] = JpdOrganRoles::model()->findByPk($v['RoleID'])->attributes;
                    $ress = JpdOrganRoles::model()->findByPk($v['RoleID']);
                    $rootID = F::getroot();
                    $per = $ress->attributes;
                    if ($per['Jurisdiction']) {
                        $params['role'] = $per['Jurisdiction'];
                        $params["scope"] = "stage"; //制定查询范围
                        $params["scope"] = "sliderbar";
                        $params['rootID'] = $rootID;
                        if ($params["rootID"]) {
                            //获取菜单模型
                            $criteria = new CDbCriteria();
                            $criteria->addCondition('ID=' . $params["rootID"]);
//                            $criteria->addCondition('IsRoot=1');
                            $criteria->addCondition('IsShow=1');
                            $firstmenu = FrontMenu::model()->find($criteria);
                        }
                        $data[$k]['root'] = $firstmenu['Name'];
                        $res = FrontMenu::getChildMenu($params);
                        $rs = array();

                        $data[$k]['per'] = $res;
                    }
                }
            } else {
                $data['empname'] = $emp['Name'];
                $data['empID'] = $emp['ID'];
            }
        }
        echo json_encode($data);
    }

    public function actionupdateuserole() {
        $roleid = Yii::app()->request->getParam('roleid');
        $roleid = explode(',', $roleid);
        $rs = array();
        $memid = Yii::app()->request->getParam('memid');
        $emp = JpdOrganRoleEmployees::model()->findAll('EmployeeID=:empid and Status=:sta', array(':empid' => $memid, ':sta' => '0'));

        if ($emp) {
            foreach ($emp as $k => $v) {
                if (!in_array($v['RoleID'], $roleid)) {
                    $res = JpdOrganRoleEmployees::model()->UpdateAll(array('Status' => '1'), "RoleID in($v[RoleID]) AND EmployeeID = {$memid}");
                    if ($res) {
                        echo json_encode(1);
                    }
                }
            }
        }
    }

    //删除角色
    public function actionDeleterole() {
        $roleid = Yii::app()->request->getParam("roleid");
        $organID = Yii::app()->user->getOrganID();
        if (!isset($roleid) || empty($roleid)) {
            Yii::app()->end;
        }
        $res = JpdOrganRoles::model()->updateByPk($roleid, array('Status' => '1'));
        if ($res) {
            $result = JpdOrganRoleEmployees::model()->updateAll(array('Status' => '1'), "RoleID=$roleid and OrganID=$organID");
            echo json_encode(1);
        }
    }

    //保存分配给用户的角色
    public function actionSaveemployrole() {
        if (Yii::app()->request->isAjaxRequest) {
            $roleID = Yii::app()->request->getParam('RoleID');
            if (!$roleID) {
                echo json_encode(array('success' => false, 'message' => '保存失败'));
                exit;
            }
            $employIDs = Yii::app()->request->getParam('employIDs');
            $OrganID = Yii::app()->user->getOrganID();
            if ($employIDs) {
                $employs = explode(',', $employIDs);
            }
            //获取该用户的该角色的所有用户
            $sql_findall = 'select * from jpd_organ_role_employees where RoleID=' . $roleID . ' and OrganID=' . $OrganID;
            $findAll = Yii::app()->jpdb->createCommand($sql_findall)->queryAll();
            //删除
            if ($findAll) {
                foreach ($findAll as $keys => $values) {
                    if ($employs) {
                        if (!in_array($values['EmployeeID'], $employs)) {
                            OrganRoleEmployees::model()->updateByPK($values['ID'], array('Status' => 1));
                        }
                    } else {
                        OrganRoleEmployees::model()->updateByPK($values['ID'], array('Status' => 1));
                    }
                }
            }
            $savenum = 0;
            $factnum = 0;
            //添加
            if ($employs) {
                foreach ($employs as $key => $value) {
                    $sql_exit = 'select * from jpd_organ_role_employees where EmployeeID=' . $value . ' and RoleID=' . $roleID . ' and OrganID=' . $OrganID;
                    $exit = Yii::app()->jpdb->createCommand($sql_exit)->queryRow();
                    $sql_getstatus = 'select * from jpd_organ_role_employees where EmployeeID=' . $value . ' and RoleID=' . $roleID . ' and OrganID=' . $OrganID . ' and Status=1';
                    $getstatus = Yii::app()->jpdb->createCommand($sql_getstatus)->queryRow();
                    if ($getstatus) {
                        OrganRoleEmployees::model()->updateByPK($getstatus['ID'], array('Status' => 0));
                        $savenum+=1;
                        $factnum+=1;
                        continue;
                    }
                    if (!$exit && $value) {
                        $savenum+=1;
                        $arr = new OrganRoleEmployees();
                        $arr->EmployeeID = $value;
                        $arr->RoleID = $roleID;
                        $arr->OrganID = $OrganID;
                        $arr->CreateTime = time();
                        $arr->Status = 0;
                        if ($arr->save())
                            $factnum+=1;
                    }
                }
            }
            if ($savenum == $factnum) {
                echo json_encode(array('success' => true, 'message' => '保存成功'));
            } else {
                echo json_encode(array('success' => false, 'message' => '保存失败'));
            }
        }
    }

    //部门员工菜单
    public function actionAjaxFillTree() {
        if (!Yii::app()->request->isAjaxRequest) {
            exit();
        }
        $data = MemberService::Getmenu();

        echo str_replace(
                '"hasChildren":"0"', '"hasChildren":true', CTreeView::saveDataAsJson($data)
        );
        exit();
    }

}
