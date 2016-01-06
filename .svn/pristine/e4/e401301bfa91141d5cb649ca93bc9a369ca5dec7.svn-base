<?php

class EmployeeController extends Controller {

    //public $layout = '//layouts/member';

	/*
	 * 表单验证
	 */
	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='OrganDepartment-form' && $_POST['ajax']==='OrganEmployees-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}
	
    public function Getorganid() {
    	$id = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->with = "organ";
        $criteria->addCondition("t.id={$id}");
        $model = User::model()->find($criteria);
        $organid = array('OrganID'=>$model->OrganID,'identity'=>$model->organ->Identity,'id'=>$model->ID);
        return $organid;
    }

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "子账户管理";
        $organid = $this->Getorganid();
        $department = OrganDepartment::model()->findAll(array(
					    'select'=>'*',
					    'condition'=>'OrganID = :OrganID AND Status = 0',
					    'params'=>array(':OrganID'=>Yii::app()->user->getOrganID()),
					));  
        $this->render('index', array('organID' => $organid['OrganID'], 'identity' => $organid['identity'], 'department'=>$department));
    }
    
    /*
     * 根据员工ID获取员工信息
     */
    public function actionGetEmploy(){
    	$id = Yii::app()->request->getParam('id');
    	$id = ltrim($id, 'emp_');
    	$criteria = new CDbCriteria();
    	$criteria->with = 'user';
    	$criteria->addCondition("t.ID = {$id}");
    	$criteria->addCondition("t.Status = 0");
    	$model = OrganEmployees::model()->find($criteria);
    	$depart = OrganDepartment::model()->findByPK($model->DepartmentID);
    	$data = $model->attributes;
    	$data['UserName'] = $model->user->UserName;
    	$data['PassWord'] = $model->user->PassWord;
    	$data['ExpireTime'] =$data['ExpireTime']? date("Y-m-d",$data['ExpireTime']):'';
    	$data['Birth'] = date("Y-m-d",$data['Birth']);
    	$data['Status'] = $depart->DepartmentName;
    	echo json_encode($data);
    }
    
    /*
     * 添加、修改部门信息
     */
    public function actionEditdepart(){
    	$id = Yii::app()->request->getParam("id");
    	if (!empty($id)){
    		$model = OrganDepartment::model()->findByPK($id);
    	}else {
    		$model = new OrganDepartment();
    		$model->CreateTime = time();
    		$model->OrganID = Yii::app()->user->getOrganID();
    	}
    	if ($_POST){
    		$model->DepartmentName = Yii::app()->request->getParam("DepartmentName");
    		$model->ParentID = Yii::app()->request->getParam("ParentID");
    		$model->Describe = Yii::app()->request->getParam("Describe");
    		//$model->ID = Yii::app()->request->getParam("id");
    		$model->UpdateTime = time();
    		if ($model->save()){
				$data['result'] = 1;
				$data['message'] = "编辑部门信息成功！";
			}else {
				$data['result'] = 0;
				$data['message'] = "部门名称不能为空！";
			}
    	}else {
			$data['result'] = 0;
			$data['message'] = "系统异常，编辑部门信息失败！";
    	}
    	echo json_encode($data);exit();
    }
    
	/*
     * 添加、修改员工信息
     */
    public function actionEditemploy(){
    	//echo json_encode($_POST);die;
    	$id = Yii::app()->request->getParam("id");
    	if (!empty($id)){//修改
    		$model = OrganEmployees::model()->findByPK($id);
    		$user = User::model()->find("t.EmployeID = {$id}");
    	}else {//添加
    		$model = new OrganEmployees();
    		$model->CreateTime = time();
    		$model->OrganID = Yii::app()->user->getOrganID();
    		$user = new User();
    	}
    	if ($_POST){
                if($_POST['editExpireTime']&&$time=strtotime($_POST['editExpireTime'])){
                    $ExpireTime=$time;
                }
    		$model->Name = Yii::app()->request->getParam("Name");
    		$model->Birth = Yii::app()->request->getParam("editBirth")?strtotime(Yii::app()->request->getParam("editBirth")):time();
    		$model->ExpireTime = $ExpireTime;
    		$model->JobNum = Yii::app()->request->getParam("JobNum");
    		$model->DepartmentID = Yii::app()->request->getParam("DepartmentID");
    		$model->Job = Yii::app()->request->getParam("Job");
    		$model->Phone = Yii::app()->request->getParam("Phone");
    		$model->TelPhone = Yii::app()->request->getParam("TelPhone");
    		$model->Email = Yii::app()->request->getParam("Email");
    		$model->Remark = Yii::app()->request->getParam("Remark");
    		$model->Sex = Yii::app()->request->getParam("Sex");
    		$model->UpdateTime = time();
    		if ($model->save()){
    			$PassWord = Yii::app()->request->getParam("PassWord");
    			if (strlen($PassWord)!=32){
    				$PassWord = md5($PassWord);
    			}
    			$user->EmployeID = $model->ID;
    			$user->UserName = Yii::app()->request->getParam("UserName");
    			$user->PassWord = $PassWord;
    			$user->verifyPassword = $PassWord;
    			$user->OrganID = Yii::app()->user->getOrganID();
    			if ($user->save()){
					//$this->redirect('index');
					$data['result'] = 1;
					$data['message'] = "编辑员工信息成功！";
    			}else {
    				//echo json_encode($user->errors);
					OrganEmployees::model()->deleteByPk($model->ID);
					$data['result'] = 0;
    				$data['message'] = "该用户名已被注册！";
    			}
			}else {
                            var_dump($model);
                            var_dump($model->errors);die;
				//echo json_encode($model->errors);
				$errors = $model->errors;
                                foreach ($errors as $val){
                                    $msg = $val['0'];break;
                                }
				$data['result'] = 0;
				$data['message'] = $msg;//$errors['Email'][0];
			}
    	}else {
			$data['result'] = 0;
			$data['message'] = "系统异常，编辑员工信息失败！";
    	}
    	echo json_encode($data);
    }
    
	/*
     * 删除部门信息
     */
    public function actionDeldepart(){
    	$id = Yii::app()->request->getParam("id");
    	$success = OrganDepartment::model()->updateByPk($id, array(
            'Status' => 1,
            'UpdateTime' => time()
                ));
    	$this->redirect(Yii::app()->createUrl('/member/employee/index'));
    }
    
	/*
     * 删除会员信息
     */
    public function actionDelemploy(){
    	$id = Yii::app()->request->getParam("id");
    	$success = OrganEmployees::model()->updateByPk($id, array(
            'Status' => 1,
            'UpdateTime' => time()
                ));
        $resule = User::model()->deleteAll("EmployeID=:id", array(":id" => $id));
    	$this->redirect(Yii::app()->createUrl('/member/employee/index'));
    }
    
    /*
     * 部门员工菜单
     */
    public function actionAjaxFillTree(){
    	/*if (!Yii::app()->request->isAjaxRequest) {
        	exit();
        }*/
        $data=MemberService::Getmenu();
        echo str_replace(
           '"hasChildren":"0"',
           '"hasChildren":false',
           CTreeView::saveDataAsJson($data)
        );
        exit();
    }
    
    /*
     * 获取部门信息
     */
    public function actionGetDepart(){
    	if (!Yii::app()->request->isAjaxRequest) {
        	exit();
        }
    	$id = Yii::app()->request->getParam("id");
    	$id = ltrim($id, 'dep_');
    	$data = Yii::app()->jpdb->createCommand("SELECT m1.*, m2.DepartmentName AS ParentName
				FROM jpd_organ_department AS m1 LEFT JOIN jpd_organ_department AS m2 
				ON m1.ParentID=m2.ID 
				WHERE  m1.Status = 0 AND m1.ID = $id
				GROUP BY m1.ID ASC")->queryRow();
    	echo json_encode($data);exit();
    }

    public function actionGetmenu() {
        $organid = $this->Getorganid();
        if ($organid['OrganID']) {
            $menus = Yii::app()->db->createCommand()
                    ->select('ID,DepartmentName,ParentID,Describe')
                    ->from('tbl_department')
                    ->where('OrganID=:OrganID', array(':OrganID' => $organid['OrganID']))
                    ->queryAll();
            $departcount = count($menus);
            if (!empty($menus)) {
                foreach ($menus as $key => $val) {
                    $menu[$key]['id'] = $val['ID'];
                    $menu[$key]['text'] = $val['DepartmentName'];
                    $menu[$key]['describe'] = $val['Describe'];
                    $menu[$key]['parentID'] = $val['ParentID'];
                    $menu[$key]['iconCls'] = 'icon-depart';
                    $menu[$key]['type'] = 0;
                    $employids = UserDepart::model()->findAll("OrganID=" . $organid['OrganID'] . " and DepartmentID=" . $val['ID']);
                    if (!empty($employids)) {
                        $ids = array();
                        foreach ($employids as $employkey => $employid) {
                            $ids[] = $employid->EmployeeID;
                        }
                        $employee = Yii::app()->db->createCommand()
                                ->select('user_id,truename,nickname,sex')
                                ->from('tbl_profiles')
                                ->where(array('in', 'user_id', $ids))
                                ->queryAll();
                        foreach ($employee as $empkey => $empval) {
                            $usemodel = Yii::app()->db->createCommand()
                                    ->select('id,username')
                                    ->from('tbl_user')
                                    ->where('id=:id', array(':id' => $empval['user_id']))
                                    ->queryRow();
                            $menu[$departcount]['id'] = $empval['user_id'];
                            $menu[$departcount]['text'] = $empval['truename'];
                            $menu[$departcount]['nickname'] = $empval['nickname'];
                            $menu[$departcount]['sex'] = $empval['sex'];
                            $menu[$departcount]['username'] = $usemodel['username'];
                            $menu[$departcount]['parentID'] = $val['ID'];
                            $menu[$departcount]['iconCls'] = 'icon-employee';
                            $menu[$departcount]['type'] = 1;
                            $departcount++;
                        }
                    }
                }
                $menus = $this->Treearray($menu);
            } else {
                $menus["id"] = 0;
                $menus["text"] = "所有部门";
                $menus['iconCls'] = 'icon-depart';
            }
        } else {
            $menus["id"] = 0;
            $menus["text"] = "所有部门";
            $menus['iconCls'] = 'icon-depart';
        }
        echo json_encode($menus);
    }

    public function actionGetdepartmenu() {
        $organid = $this->Getorganid();
        if ($organid['OrganID']) {
            $menus = Yii::app()->db->createCommand()
                    ->select('ID,DepartmentName,ParentID,Describe')
                    ->from('tbl_department')
                    ->where('OrganID=:OrganID', array(':OrganID' => $organid['OrganID']))
                    ->queryAll();
            if (!empty($menus)) {
                foreach ($menus as $key => $val) {
                    $menu[$key]['id'] = $val['ID'];
                    $menu[$key]['text'] = $val['DepartmentName'];
                    $menu[$key]['describe'] = $val['Describe'];
                    $menu[$key]['parentID'] = $val['ParentID'];
                    $menu[$key]['iconCls'] = 'icon-depart';
                    $menu[$key]['type'] = 0;
                }
                $menus = $this->Treearray($menu);
            } else {
                $menus["id"] = 0;
                $menus["text"] = "所有部门";
                $menus['iconCls'] = 'icon-depart';
            }
        } else {
            $menus["id"] = 0;
            $menus["text"] = "所有部门";
            $menus['iconCls'] = 'icon-depart';
        }
//                var_dump($menus);
        echo json_encode($menus);
//		echo "[{\"id\":1,\"text\":\"Folder1\",\"iconCls\":\"icon-ok\",\"children\":[{\"id\":2,\"text\":\"File1\",\"checked\":true},{\"id\":3,\"text\":\"Folder2\",\"state\":\"open\",\"children\":[{\"id\":4,\"text\":\"File3\",\"checked\":true,\"iconCls\":\"icon-reload\"},{\"id\": 8,\"text\":\"Async Folder\",\"state\":\"closed\"}]}]},{\"text\":\"Languages\",\"state\":\"closed\",\"children\":[{\"text\":\"Java\"},{\"text\":\"C#\"}]}]";
    }

    /**
     * 生成树数组
     * @param  $data 从数据库出来select出来的数数组
     * @return  [{"id":1,"name":"Folder1", "children":[{"id":1,"name":"File1"}] }]
     * */
    public function Treearray($data) {
        $result = array();
        //定义索引数组，用于记录节点在目标数组的位置，类似指针
        $p = array();

        foreach ($data as $val) {
            if ($val['ParentID'] == 0) {
                $i = count($result);
                $result[$i] = isset($p[$val['ID']]) ? array_merge($val, $p[$val['ID']]) : $val;
                $p[$val['ID']] = & $result[$i];
            } else {
                $i = count($p[$val['ParentID']]['children']);
                $p[$val['ParentID']]['children'][$i] = $val;
                $p[$val['ID']] = & $p[$val['ParentID']]['children'][$i];
            }
        }
        return $result;
    }

    public function actionSavedepartment() {
        $organid = $this->Getorganid();
        if (empty($_POST['departid'])) {
            $department = new Department();
            $department->DepartmentName = $_POST['departmentName'];
            $department->ParentID = $_POST['parentID'];
            $department->Describe = $_POST['describe'];
            $department->OrganID = $organid['OrganID'];
            $department->UserID = Yii::app()->user->id;
            $department->CreateTime = time();
            $result = $department->save();
        } else {
            $department = Department::model()->findByPk($_POST['departid']);
            $department->DepartmentName = $_POST['departmentName'];
            $department->ParentID = $_POST['parentID'];
            $department->Describe = $_POST['describe'];
            $department->UserID = Yii::app()->user->id;
            $department->UpdateTime = time();
            $result = $department->save();
        }
        if ($result) {
            $message = "保存成功";
        } else {
            $message = "保存失败";
        }
        echo json_encode($message);
    }

/*    public function actionDeldepart() {
//		$organid=$this->Getorganid();
//		$ri=Department::model()->find('OrganID=:OrganID and ParentID=:id',array(":OrganID"=>$organid['OrganID'],":id"=>$_GET['departid']));
        if ($_GET['departid']) {
            $resule = Department::model()->deleteByPk($_GET['departid']);
            echo $resule;
        } else {
            $resule = Department::model()->deleteAll("ID IN (" . $_GET['departsid'] . ")");
            echo $resule;
        }
    }*/

    public function actionSaveemployee() {
        $organid = $this->Getorganid();
        $us = $_POST['User'];
        if (empty($_POST['employeeid'])) {
            $users = new User();
            $profiles = new Profile();
            $userdepart = new UserDepart();
            $users->create_at = date('Y-m-d H:i:s', time());
            $users->status = 1;
            $users->identity = $organid['identity'];
            $users->OrganID = $organid['OrganID'];
            $profiles->OrganID = $organid['OrganID'];
            $profiles->CreateTime = time();
            $userdepart->OrganID = $organid['OrganID'];
            $userdepart->CreateTime = time();
            $us['password'] = md5($us['password']);
            foreach ($us as $key => $val) {
                $users->$key = $val;
            }
            $resurt1 = Yii::app()->db->createCommand()->insert('tbl_user', $users->attributes);
        } else {
            $employeeid = $_POST['employeeid'];
            $users = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from("tbl_user")
                    ->where("id=:id", array(':id' => $employeeid))
                    ->queryRow();
            $profiles = Profile::model()->findByPk($employeeid);
            $userdepart = UserDepart::model()->find("EmployeeID=:ID", array(":ID" => $employeeid));
            $profiles->UpdateTime = time();
            $userdepart->UpdateTime = time();
            if ($users['password'] != $us['password']) {
                $us['password'] = md5($us['password']);
            }
            foreach ($us as $key => $val) {
                $users[$key] = $val;
            }
            $resurt1 = Yii::app()->db->createCommand()->update('tbl_user', $users, "id=:id", array(":id" => $employeeid));
        }

        if (empty($_POST['employeeid'])) {
            $user_id = Yii::app()->db->getLastInsertID();
            $profiles->user_id = $user_id;
            $userdepart->EmployeeID = $user_id;
        }
        if ($resurt1 || $resurt1 == 0) {
            $pro = $_POST['Profiles'];
            foreach ($pro as $key => $val) {
                if ($key == 'ExpirationDate' || $key == 'Birthday') {
                    if (!empty($val)) {
                        $profiles->$key = strtotime($val);
                    }
                } elseif ($key == 'Sex') {
                    $profiles->$key = $val;
                } else {
                    if (!empty($val)) {
                        $profiles->$key = $val;
                    }
                }
            }
            $profiles->UserID = $organid['id'];
            if (empty($_POST['employeeid'])) {
                $resurt2 = Yii::app()->db->createCommand()->insert('tbl_profiles', $profiles->attributes);
            } else {
                $resurt2 = Yii::app()->db->createCommand()->update('tbl_profiles', $profiles->attributes, "user_id=:id", array(":id" => $employeeid));
            }
            if ($resurt2 == 1) {
                $userdepart->DepartmentID = $_POST['parID'];
                $userdepart->UserID = $organid['id'];
                $resurt3 = $userdepart->save();
            }
        }
        if ($resurt1 || $resurt1 == 0) {
            if ($resurt2 == 1) {
                if ($resurt3) {
                    $message = "保存成功";
                } else {
                    $message = "保存失败";
                }
            } else {
                $message = "保存失败";
            }
        } else {
            $message = "保存失败";
        }
        echo json_encode($message);
    }

    public function actionGetemployinfo() {
        $id = $_GET['id'];
        $employee = Yii::app()->db->createCommand()
                ->select('truename,nickname,Sex,phone,Validity,Birthday,Position,OPH,Remark,ExpirationDate,EmployeeNum')
                ->from('tbl_profiles')
                ->where("user_id=:id", array(":id" => $id))
                ->queryRow();
        if ($employee['Birthday']) {
            $employee['Birthday'] = date('Y-m-d', $employee['Birthday']);
        }
        if ($employee['ExpirationDate']) {
            if ($employee['ExpirationDate'] < strtotime(date('Y-m-d', time()))) {
                $employee['Validity'] = 'N';
            }
            $employee['ExpirationDate'] = date('Y-m-d', $employee['ExpirationDate']);
        }
        $userinfo = Yii::app()->db->createCommand()
                ->select('username,password,email')
                ->from('tbl_user')
                ->where("id=:id", array(":id" => $id))
                ->queryRow();
        $employee['username'] = $userinfo['username'];
        $employee['password'] = $userinfo['password'];
        $employee['email'] = $userinfo['email'];
        $userdepart = UserDepart::model()->find("EmployeeID=:id", array(":id" => $id));
        $employee['parentID'] = $userdepart->DepartmentID;
        echo json_encode($employee);
    }

    public function actionDelemployee() {
        $employeeid = $_GET['employeeid'];
        $resule = Profile::model()->deleteAll("user_id =:id", array(":id" => $employeeid));
        $resule = UserDepart::model()->deleteAll("EmployeeID=:id", array(":id" => $employeeid));
        $resule = UserRole::model()->deleteAll("EmployeeID=:id", array(":id" => $employeeid));
        $resule = User::model()->deleteAll("id =:id", array(":id" => $employeeid));
        echo $resule;
    }

    public function actionCheckemploy() {
        $organid = $this->Getorganid();
        $employID = $_GET['employID'];
        if (empty($employID)) {
            $employID == 0;
        }
        $truename = $_GET['truename'];
        if (!empty($truename)) {
            $model = Yii::app()->db->createCommand()
                    ->select('user_id')
                    ->from("tbl_profiles")
                    ->where("user_id!=:employID and truename=:truename and OrganID=:organid", array(":employID" => $employID, ":truename" => $truename, ":organid" => $organid['OrganID']))
                    ->queryAll();
            if (!empty($model)) {
                $message = "员工已存在,不可重复";
            }
        }
        if (empty($message)) {
            $username = $_GET['username'];
            if (!empty($username)) {
                $model = Yii::app()->db->createCommand()
                        ->select('id')
                        ->from("tbl_user")
                        ->where("id!=:employID and username=:username", array(":employID" => $employID, ":username" => $username))
                        ->queryAll();
                if (!empty($model)) {
                    $message = "用户名已被使用";
                }
            }
        }
        if (empty($message)) {
            $employeeNum = $_GET['employeeNum'];
            if (!empty($employeeNum)) {
                $model = Yii::app()->db->createCommand()
                        ->select('user_id')
                        ->from("tbl_profiles")
                        ->where("user_id!=:employID and EmployeeNum=:employeeNum and OrganID=:organid", array(":employID" => $employID, ":employeeNum" => $employeeNum, ":organid" => $organid['OrganID']))
                        ->queryAll();
                if (!empty($model)) {
                    $message = "员工号已被使用";
                }
            }
        }
        if (empty($message)) {
            $phone = $_GET['phone'];
            if (!empty($phone)) {
                $model = Yii::app()->db->createCommand()
                        ->select('user_id')
                        ->from("tbl_profiles")
                        ->where("user_id!=:employID and phone=:phone", array(":employID" => $employID, ":phone" => $phone))
                        ->queryAll();
                if (!empty($model)) {
                    $message = "手机号码已被使用";
                }
            }
        }
        if (empty($message)) {
            $email = $_GET['email'];
            if (!empty($email)) {
                $model = Yii::app()->db->createCommand()
                        ->select('id')
                        ->from("tbl_user")
                        ->where("id!=:employID and email=:email", array(":employID" => $employID, ":email" => $email))
                        ->queryAll();
                if (!empty($model)) {
                    $message = "邮箱已被使用";
                }
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

    public function actionCheckdepart() {
        $organid = $this->Getorganid();
        $departid = $_GET['departid'];
        $parentID = $_GET['parentID'];
        $departName = $_GET['departName'];
        $result = false;
        if (empty($parentID) && empty($departid)) {
            $result = true;
        } else {
            if (empty($departid)) {
                $departid = 0;
            }
            if (empty($parentID)) {
                $result = true;
            } else {
                $model = Department::model()->findAll('ID!=:id and ParentID=:parentID and DepartmentName=:departName and OrganID=:organid', array(
                    ":id" => $departid,
                    ":parentID" => $parentID,
                    ":departName" => $departName,
                    ":organid" => $organid['OrganID']));
                if (empty($model)) {
                    $result = true;
                } else {
                    $result = false;
                }
            }
        }
        echo json_encode($result);
    }

}