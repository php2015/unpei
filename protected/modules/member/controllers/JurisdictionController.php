<?php

class JurisdictionController extends Controller {

    public $layout = '//layouts/member';

    public function Getorganid() {
        $organid = Yii::app()->db->createCommand()
                ->select('OrganID,identity,id')
                ->from('tbl_user')
                ->where('id=:id', array(':id' => Yii::app()->user->id))
                ->queryRow();
        return $organid;
    }

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "权限管理";
        $organid = $this->Getorganid();
        $this->render('index', array('organID' => $organid['OrganID'], 'identity' => $organid['identity']));
    }

    public function Getroledata() {
        $organid = $this->Getorganid();
        $roles = Yii::app()->db->createCommand()
                ->select('ID as id,RoleName as text,Describe,Jurisdiction')
                ->from('tbl_role')
                ->where('OrganID=:organid', array(":organid" => $organid['OrganID']))
                ->queryAll();
        if (!empty($roles)) {
            foreach ($roles as $key => $val) {
                $role[$key] = $val;
                $role[$key]['iconCls'] = 'icon-roles';
            }
        }

        $rs = array(
            'id' => 0,
            'text' => '角色',
            'iconCls' => 'icon-roles',
        );
        $rs['children'] = $role;
        return $rs;
    }

    public function Getrootname() {
        $organid = $this->Getorganid();
        if ($organid['identity'] == 1) {
            $rootname = "生产商菜单";
        } elseif ($organid['identity'] == 2) {
            $rootname = "经销商菜单";
        } else {
            $rootname = "修理厂菜单";
        }
        return $rootname;
    }

    public function Getmenufilename() {
        $organid = $this->Getorganid();
        $fileurl = dirname(Yii::app()->BasePath) . '/runtime/front/cache/';
        if ($organid['identity'] == 1) {
            $filename = $fileurl . "makemenucache.txt";
        } elseif ($organid['identity'] == 2) {
            $filename = $fileurl . "dealermenucache.txt";
        } else {
            $filename = $fileurl . "servicemenucache.txt";
        }
        return $filename;
    }

    public function Allmenudata() {
        $organname = $this->Getrootname();
        $mainmenu = Yii::app()->db->createCommand()
                ->select('id,root,lft,rgt,level,name as text,url,if_show,extra_url')
                ->from('tbl_menu')
                ->where("name=:name and level=2", array(":name" => $organname))
                ->queryRow();
        $menus = Yii::app()->db->createCommand()
                ->select('id,root,lft,rgt,level,name as text,url,if_show,extra_url')
                ->from('tbl_menu')
                ->where('root=1 and if_show=1 and lft>=:lft and rgt<=:rgt and name!=:name', array(":lft" => $mainmenu['lft'], ":rgt" => $mainmenu['rgt'], ":name" => "首页"))
                ->order('level')
                ->queryAll();

        return $menus;
    }

    public function Menudata($filename = false) {
        $organname = $this->Getrootname();
        $mainmenu = Yii::app()->db->createCommand()
                ->select('id,root,lft,rgt,level,name as text,url,if_show,extra_url')
                ->from('tbl_menu')
                ->where("name=:name and level=2", array(":name" => $organname))
                ->queryRow();
        $menus[0] = $mainmenu;
        $menus[0]['parentID'] = 0;
        $childrenmenu = Yii::app()->db->createCommand()
                ->select('id,root,lft,rgt,level,name as text,url,if_show,extra_url')
                ->from('tbl_menu')
                ->where('root=1 and if_show=1 and lft>:lft and rgt<:rgt and name!=:name', array(":lft" => $mainmenu['lft'], ":rgt" => $mainmenu['rgt'], ":name" => "首页"))
                ->queryAll();
        $i = 0;
        if (!empty($childrenmenu)) {
            foreach ($childrenmenu as $key1 => $val1) {
                if ($val1['level'] == 3) {
                    $menus[0]['children'][$i] = $val1;
                    $state = Yii::app()->db->createCommand()
                            ->select('id')
                            ->from('tbl_menu')
                            ->where(array('and', 'lft>' . $val1['lft'] . ' and rgt<' . $val1['rgt'] . ' and root=1 and if_show=1'))
                            ->queryRow();
                    if ($state) {
                        $menus[0]['children'][$i]['state'] = 'closed';
                    } else {
                        $menus[0]['children'][$i]['state'] = 'open';
                    }
//                    $menus[0]['children'][$i]['state'] = 'open';
                    $menus[0]['children'][$i]['parentID'] = $menus['id'];
                    $j = 0;
                    foreach ($childrenmenu as $key2 => $val2) {
                        if ($val2['lft'] > $val1['lft'] && $val2['rgt'] < $val1['rgt'] && $val2['level'] == 4) {
                            $menus[0]['children'][$i]['children'][$j] = $val2;
                            $menus[0]['children'][$i]['children'][$j]['parentID'] = $val1['id'];
                            $k = 0;
                            foreach ($childrenmenu as $key3 => $val3) {
                                if ($val3['lft'] > $val2['lft'] && $val3['rgt'] < $val2['rgt'] && $val3['level'] == 5) {
                                    $menus[0]['children'][$i]['children'][$j]['children'][$k] = $val3;
                                    $menus[0]['children'][$i]['children'][$j]['children'][$k]['parentID'] = $val2['id'];
                                    $k++;
                                }
                            }
                            $j++;
                        }
                    }
                    $i++;
                }
            }
        }
//        $menus['state']='open';
//        $menus['parentID'] = 0;
//        $menus['children']=$childrenmenu;
//        foreach ($childrenmenu as $key=>$children){ 
//            $footmenu = Yii::app()->db->createCommand()
//                ->select('id,root,lft,rgt,level,name as text,url,if_show,extra_url')
//                ->from('tbl_menu')
//                ->where('root=1 and if_show=1 and lft>:lft and rgt<:rgt and level=4', array(":lft" => $children['lft'], ":rgt" => $children['rgt']))
//                ->queryAll();
//            $menus['children'][$key]['state'] = 'closed';
//            $menus['children'][$key]['parentID'] = $menus['id'];
//            $menus['children'][$key]['children']=$footmenu;
//            
//            foreach ($footmenu as $footkey=>$foot){
//                $menus['children'][$key]['children'][$footkey]['state'] = 'open';
//                $menus['children'][$key]['children'][$footkey]['parentID'] = $menus['children'][$key]['id'];
//                if($foot['id']=='105'||$foot['id']=='108'||$foot['id']=='167'){
//                    $menu5 = Yii::app()->db->createCommand()
//                        ->select('id,root,lft,rgt,level,name as text,url,if_show,extra_url')
//                        ->from('tbl_menu')
//                        ->where('root=1 and if_show=1 and lft>:lft and rgt<:rgt and level=5', array(":lft" => $foot['lft'], ":rgt" => $foot['rgt']))
//                        ->queryAll();
//                     $menus['children'][$key]['children'][$footkey]['children']=$menu5;
//                }
//            }
//        }
        if ($filename) {
            $file_hwnd = fopen($filename, "w");
            fwrite($file_hwnd, serialize($menus)); //输入序列化的数据
            fclose($file_hwnd);
        }
        return $menus;
    }

    public function Rolemenudata($roleid) {
        $organname = $this->Getrootname();
        $role = Role::model()->findByPk($roleid);
//		echo $role->Jurisdiction;exit;
        if (!empty($role->Jurisdiction)) {
            $jurisdiction = substr($role->Jurisdiction, 0, strlen($role->Jurisdiction) - 1);
            $jurisdiction = explode(',', $jurisdiction);
            $childrenmenu = Yii::app()->db->createCommand()
                    ->select('id,root,lft,rgt,level,name as text,url,if_show,extra_url')
                    ->from('tbl_menu')
                    ->where(array('and', 'root=1 and if_show=1', array('in', 'id', $jurisdiction)))
                    ->queryAll();
            if (!empty($childrenmenu)) {
                foreach ($childrenmenu as $key => $val) {
                    if ($val['level'] == 2) {
                        $menus[0] = $val;
                        $menus[0]['state'] = 'open';
                        $menus[0]['parentID'] = 0;
                        $i = 0;
                        foreach ($childrenmenu as $key1 => $val1) {
                            if ($val1['level'] == 3) {
                                $menus[0]['children'][$i] = $val1;
                                $state = Yii::app()->db->createCommand()
                                        ->select('id')
                                        ->from('tbl_menu')
                                        ->where(array('and', 'lft>' . $val1['lft'] . ' and rgt<' . $val1['rgt'] . ' and root=1 and if_show=1'))
                                        ->queryRow();
                                if ($state) {
                                    $menus[0]['children'][$i]['state'] = 'closed';
                                } else {
                                    $menus[0]['children'][$i]['state'] = 'open';
                                }
//                                $menus[0]['children'][$i]['state'] = 'closed';
                                $menus[0]['children'][$i]['parentID'] = $menus['id'];
                                $j = 0;
                                foreach ($childrenmenu as $key2 => $val2) {
                                    if ($val2['lft'] > $val1['lft'] && $val2['rgt'] < $val1['rgt'] && $val2['level'] == 4) {
                                        $menus[0]['children'][$i]['children'][$j] = $val2;
                                        $menus[0]['children'][$i]['children'][$j]['parentID'] = $val1['id'];
                                        $k = 0;
                                        foreach ($childrenmenu as $key3 => $val3) {
                                            if ($val3['lft'] > $val2['lft'] && $val3['rgt'] < $val2['rgt'] && $val3['level'] == 5) {
                                                $menus[0]['children'][$i]['children'][$j]['children'][$k] = $val3;
                                                $menus[0]['children'][$i]['children'][$j]['children'][$k]['parentID'] = $val2['id'];
                                                $k++;
                                            }
                                        }
                                        $j++;
                                    }
                                }
                                $i++;
                            }
                        }
                    }
                }
            }
        }
        return $menus;
    }

    public function actionGetroles() {
        $rs = $this->Getroledata();
        echo '[' . json_encode($rs) . ']';
    }

    public function actionGetmenu() {
        if ($_GET['roleid']) {
            $menus = $this->Rolemenudata($_GET['roleid']);
//            $menus = $this->Treemenu($menus);
        } else {
            // 开始读取并还原数组
            $filename = $this->Getmenufilename();
            if (file_exists($filename)) {
                $content = file_get_contents($filename);  // 读去文件全部内容
                $menus = unserialize($content); // 将文本数据转换回数组
            } else {
                $menus = $this->Menudata($filename);
//                $menus = $this->Treemenu($menus,$filename);
            }
        }
        if (!empty($menus)) {
            echo json_encode($menus);
        }
    }

    /**
     * 生成树菜单
     * @param  $data 从数据库出来select出来的数数组
     * @return  [{"id":1,"name":"Folder1", "children":[{"id":1,"name":"File1"}] }]
     * */
    public function Treemenu($data, $filename = false) {
        $result = array();
        //定义索引数组，用于记录节点在目标数组的位置，类似指针
        $p = array();

        foreach ($data as $val) {
            $val['state'] = 'open';
            if ($val['level'] == 3) {
                $val['state'] = 'closed';
            }
            $menus = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('tbl_menu')
                    ->where('lft<=:lft and rgt>=:rgt and level=:level and if_show=1 and root=1 and level>1', array(":lft" => $val['lft'], ":rgt" => $val['rgt'], ":level" => $val['level'] - 1))
                    ->queryRow();
            if (empty($menus)) {
                $val['parentID'] = 0;
                $val['state'] = 'open';
            } else {
                $val['parentID'] = $menus['id'];
            }
            if ($val['level'] == 2) {
                $i = count($result);
                $result[$i] = isset($p[$val['id']]) ? array_merge($val, $p[$val['id']]) : $val;
                $p[$val['id']] = & $result[$i];
            } else {
                $i = count($p[$val['parentID']]['children']);
                $p[$val['parentID']]['children'][$i] = $val;
                $p[$val['id']] = & $p[$val['parentID']]['children'][$i];
            }
        }
        // 写入数组
//        $filename="D:/makemenucache.txt";
        if ($filename) {
            $file_hwnd = fopen($filename, "w");
            fwrite($file_hwnd, serialize($result)); //输入序列化的数据
            fclose($file_hwnd);
        }
        return $result;
    }

    /**
     * 生成树菜单
     * @param  $data 从数据库出来select出来的数数组
     * @return  [{"id":1,"name":"Folder1", "children":[{"id":1,"name":"File1"}] }]
     * */
    public function Treerolemenu($data) {
        $result = array();
        //定义索引数组，用于记录节点在目标数组的位置，类似指针
        $p = array();

        foreach ($data as $val) {
            $val['state'] = 'open';
            if ($val['level'] == 3) {
                $val['state'] = 'closed';
            }
            $menus = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('tbl_menu')
                    ->where('lft<=:lft and rgt>=:rgt and level=:level and if_show=1 and root=1 and level>1', array(":lft" => $val['lft'], ":rgt" => $val['rgt'], ":level" => $val['level'] - 1))
                    ->queryRow();
            if (empty($menus)) {
                $val['parentID'] = 0;
                $val['state'] = 'open';
            } else {
                $val['parentID'] = $menus['id'];
            }
            if ($val['level'] == 2) {
                $i = count($result);
                $result[$i] = isset($p[$val['id']]) ? array_merge($val, $p[$val['id']]) : $val;
                $p[$val['id']] = & $result[$i];
            } else {
                $i = count($p[$val['parentID']]['children']);
                $p[$val['parentID']]['children'][$i] = $val;
                $p[$val['id']] = & $p[$val['parentID']]['children'][$i];
            }
        }
        return $result;
    }

    public function actionSaverole() {
        $organid = $this->Getorganid();
        if (empty($_POST['roleid']) || $_POST['roleid'] == 0) {
            $role = new Role();
            $role->OrganID = $organid['OrganID'];
            $role->CreateTime = time();
        } else {
            $role = Role::model()->findByPk($_POST['roleid']);
            $role->UpdateTime = time();
        }
        $role->RoleName = $_POST['rolename'];
        $role->Describe = $_POST['describe'];
        $role->Jurisdiction = $_POST['jurisdiction'];
        $role->UserID = $organid['id'];
        $result = $role->save();
        if (empty($_POST['roleid']) || $_POST['roleid'] == 0) {
            $roleinfo['id'] = Yii::app()->db->getLastInsertID();
        } else {
            $roleinfo['id'] = $_POST['roleid'];
        }
        $roleinfo['text'] = $_POST['rolename'];
        $roleinfo['Describe'] = $_POST['rolename'];
        $roleinfo['Jurisdiction'] = $_POST['jurisdiction'];
        if ($result) {
            $data = array('roleinfo' => $roleinfo, 'message' => '保存成功');
        } else {
            $data = array('roleinfo' => $roleinfo, 'message' => '保存失败');
        }
        echo json_encode($data);
    }

    public function actionMenulist() {
        $menus = $this->Allmenudata();
        echo json_encode($menus);
    }

    public function actionDelrole() {
        $roleid = $_GET['roleid'];
        if ($roleid) {
            $result = UserRole::model()->deleteAll("RoleID=:roleid", array(":roleid" => $roleid));
            $result = Role::model()->deleteByPk($roleid);
        }
        echo json_encode($result);
    }

    public function actionUserrolerel() {
        if ($_GET['roleid']) {
            $roleID = $_GET['roleid'];
            $relations = UserRole::model()->findAll("RoleID=:roleid", array(":roleid" => $roleID));
            if ($relations) {
                foreach ($relations as $rela) {
                    $userids[] = $rela->EmployeeID;
                }
                $employs = Yii::app()->db->createCommand()
                        ->select('user_id as id,truename as text,nickname,sex')
                        ->from('tbl_profiles')
                        ->where(array('in', 'user_id', $userids))
                        ->queryAll();

                $employtree['id'] = 0;
                $employtree['text'] = "角色关联的用户";
                $employtree['iconCls'] = 'icon-roles';
                if ($employs) {
                    foreach ($employs as $key => $val) {
                        $employs[$key] = $val;
                        $employs[$key]['iconCls'] = 'icon-employee';
                    }
                    $employtree['children'] = $employs;
                }
            } else {
                $employtree['id'] = 0;
                $employtree['text'] = "角色关联的用户";
                $employtree['iconCls'] = 'icon-roles';
            }
        } else {
            $employtree['id'] = 0;
            $employtree['text'] = "角色关联的用户";
            $employtree['iconCls'] = 'icon-roles';
        }

        echo '[' . json_encode($employtree) . ']';
    }

    public function actionSaveallocation() {
        $organid = $this->Getorganid();
        $roleid = $_POST['allocroleid'];
        $userids = $_POST['allocuserid'];
        $findmodel = UserRole::model()->findAll("RoleID=:roleid", array(':roleid' => $roleid));
        if (!$userids || $userids == '') {
            $delcount = UserRole::model()->deleteAll("RoleID=:roleid", array(':roleid' => $roleid));
            if (count($findmodel) == $delcount) {
                $message = "保存成功";
            } else {
                $message = "保存失败";
            }
        } else {
            $userids = substr($userids, 0, strlen($userids) - 1);
            $userids = explode(',', $userids);
            if (count($findmodel) == 0) {
                $i = 0;
                foreach ($userids as $urid) {
                    $model = new UserRole();
                    $model->RoleID = $roleid;
                    $model->EmployeeID = $urid;
                    $model->OrganID = $organid['OrganID'];
                    $model->UserID = $organid['id'];
                    $model->CreateTime = time();
                    $result = $model->save();
                    if ($result) {
                        $i++;
                    }
                }
                if ($i == count($userids)) {
                    $message = "保存成功";
                } else {
                    $message = "保存失败";
                }
            } else {
                foreach ($findmodel as $key => $val) {
                    if (!in_array($val->EmployeeID, $userids)) {
                        $delcount = UserRole::model()->deleteByPk($val->ID);
                    }
                }
                foreach ($userids as $urid) {
                    $findmodel = UserRole::model()->findAll("RoleID=:roleid and EmployeeID=:urid", array(':roleid' => $roleid, ':urid' => $urid));
                    if (!$findmodel) {
                        $model = new UserRole();
                        $model->RoleID = $roleid;
                        $model->EmployeeID = $urid;
                        $model->OrganID = $organid['OrganID'];
                        $model->UserID = $organid['id'];
                        $model->CreateTime = time();
                        $result = $model->save();
                    }
                }
                $findmodel = UserRole::model()->findAll("RoleID=:roleid", array(':roleid' => $roleid));
                if (count($userids) == count($findmodel)) {
                    $message = "保存成功";
                } else {
                    $message = "保存失败";
                }
            }
        }
        echo json_encode($message);
    }

    /**
     * 根据前台选择的EmployeeID获取其所关联的角色
     * Enter description here ...
     */
    public function actionGetuserroles() {
        $employeeID = $_GET['userid'];
        $relation = YII::app()->db->createCommand()
                ->select('RoleID')
                ->from('tbl_user_role')
                ->where("EmployeeID=:userID", array(":userID" => $employeeID))
                ->queryAll();
        echo json_encode($relation);
    }

    public function actionSaveuserrole() {
        $organid = $this->Getorganid();
        $roleids = $_POST['roleids'];
        $employeeID = $_POST['userid'];
        $findmodel = UserRole::model()->findAll("EmployeeID=:userid", array(':userid' => $employeeID));
        if (!empty($employeeID)) {
            if (!empty($roleids)) {
                $roleids = substr($roleids, 0, strlen($roleids) - 1);
                $roleids = explode(',', $roleids);
                if (count($findmodel) == 0) {
                    $i = 0;
                    foreach ($roleids as $roleid) {
                        $model = new UserRole();
                        $model->RoleID = $roleid;
                        $model->EmployeeID = $employeeID;
                        $model->OrganID = $organid['OrganID'];
                        $model->UserID = $organid['id'];
                        $model->CreateTime = time();
                        $result = $model->save();
                        if ($result) {
                            $i++;
                        }
                    }
                    if ($i == count($roleids)) {
                        $message = "保存成功";
                    } else {
                        $message = "保存失败";
                    }
                } else {
                    foreach ($findmodel as $key => $val) {
                        if (!in_array($val->RoleID, $roleids)) {
                            $delcount = UserRole::model()->deleteByPk($val->ID);
                        }
                    }
                    foreach ($roleids as $roleid) {
                        $findmodel = UserRole::model()->findAll("RoleID=:roleid and EmployeeID=:urid", array(':roleid' => $roleid, ':urid' => $employeeID));
                        if (empty($findmodel)) {
                            $model = new UserRole();
                            $model->RoleID = $roleid;
                            $model->EmployeeID = $employeeID;
                            $model->OrganID = $organid['OrganID'];
                            $model->UserID = $organid['id'];
                            $model->CreateTime = time();
                            $result = $model->save();
                        }
                    }
                    $findmodel = UserRole::model()->findAll("EmployeeID=:userid", array(':userid' => $employeeID));
                    if (count($roleids) == count($findmodel)) {
                        $message = "保存成功";
                    } else {
                        $message = "保存失败";
                    }
                }
            } else {
                $result = UserRole::model()->deleteAll("EmployeeID=:userid", array(":userid" => $employeeID));
                if ($result > 0) {
                    $message = "保存成功";
                } else {
                    $message = "保存失败";
                }
            }
        } else {
            $message = "保存失败";
        }
        echo json_encode($message);
    }

    public function actionCheckrole() {
        $organid = $this->Getorganid();
        $roleID = $_GET['roleID'];
        if (empty($roleID)) {
            $roleID == 0;
        }
        $rolename = $_GET['rolename'];
        if (!empty($rolename)) {
            $model = Yii::app()->db->createCommand()
                    ->select('ID')
                    ->from("tbl_role")
                    ->where("ID!=:roleID and RoleName=:rolename and OrganID=:organid", array(":roleID" => $roleID, ":rolename" => $rolename, ":organid" => $organid['OrganID']))
                    ->queryAll();
            if (!empty($model)) {
                $message = "角色名已存在";
            }
        }
        if (empty($message)) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        $resu['result'] = $result;
        $resu['message'] = $message;
        echo json_encode($resu);
    }

}