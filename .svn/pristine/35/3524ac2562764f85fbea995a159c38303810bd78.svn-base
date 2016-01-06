<?php

class ContactController extends Controller {

    //public $layout = '//layouts/cim';

    /*
     * 业务联系人管理
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "业务联系人管理";
        $model=new Contacts();
        if(isset($_GET))
        {
            $model->Name=$_GET['name'];
            $model->Phone=$_GET['phone'];
        }
          $dataProvider = $model->search();
//        $pages=$dataProvider->getPagination();
       
        $data=array('dataProvider'=>$dataProvider,'organ'=>$organ);
        $this->render('list',$data);
    }
   
//添加
 public function actionAdd()
 {
      $model=new Contacts();
      $this->performAjaxValidation($model);
      //调用获取所有机构方法
      $organ=$this->Getorgan();
      if(isset($_POST['Contacts']))
      {
          $model->attributes=$_POST['Contacts'];
          
          if($model->validate()&&$model->save())
          {
              $this->redirect(array('index'));
          }
      }
     $this->render('add',array('model'=>$model,'organ'=>$organ));
 }
public function actionUpdate()
{
         $id=intval($_GET['id']);
        $model = Contacts::model()->findByPk($id);
        $this->performAjaxValidation($model);
        $organs= Organ::model()->findByPk($model['ContactID']);
        $model['OrganName']=$organs['OrganName'];
      
      //调用获取所有机构方法
      $organ=$this->Getorgan();
      if(isset($_POST['Contacts']))
      {
          $model->attributes=$_POST['Contacts'];
          if($model->validate()&&$model->save())
          {
                $this->redirect(array('index'));
          }
      }
     $this->render('add',array('model'=>$model,'organ'=>$organ));
}

//删除联系人
public function actionDelete() {
    $id = intval($_GET['id']);
	$del = Contacts::model()->deleteAll("ID in ({$id})");
    if ($del) {
    	$result = array('success' => 1, 'errorMsg' => '联系人删除成功！');
    } else {
    	$result = array('success' => 0, 'errorMsg' => '系统异常，联系人删除失败！');
    }
    echo json_encode($result);
}
  
 //验证
 protected function performAjaxValidation($model)
{
    if(isset($_POST['ajax']) && $_POST['ajax']==='contactadd-form')
    {
        echo CActiveForm::validate($model);
        Yii::app()->end();
    }
}




 public function actionAllcontact() {
        $user_id = Commonmodel::getOrganID();
        $sql = "select a.id,a.contact_user_id,a.customertype,
		a.cooperationtype,a.name,a.sex,
		a.companyname,a.phone,a.province,a.city,a.area,a.email,
		a.weixin,a.QQ,a.create_time,a.Status,a.jiapart_ID,a.update_time,
		(select b.category from tbl_customer_category b where a.customercategory=b.id and a.user_id=$user_id) as customercategory
		from tbl_business_contacts a where
		user_id='$user_id' and Status=0 ";
        $sql.="order by create_time desc";
        $models = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($models as $key => $value) {
            $iden = User::model()->findByPk($value['contact_user_id']);
            $data[$key]['organ'] = $iden['identity'];
            switch ($iden['identity']) {
                case 1:
                    $data[$key]['organ'] = '生产商';
                    break;
                case 2:
                    $data[$key]['organ'] = '经销商';
                    break;
                case 3:
                    $data[$key]['organ'] = '修理厂';
                    break;
            }
            $data[$key]['id'] = $value['id'];
            $data[$key]['companyID'] = $value['contact_user_id'];
            $data[$key]['customertype'] = $value['customertype'];
            $data[$key]['cooperationtype'] = $value['cooperationtype'];
            $data[$key]['customercategory'] = $value['customercategory'];
            $data[$key]['name'] = $value['name'];
            $data[$key]['sex'] = $value['sex'];
            $data[$key]['companyname2'] = F::msubstr($value['companyname']);
            $data[$key]['companyname'] = $value['companyname'];
            $data[$key]['phone'] = $value['phone'];
            $data[$key]['province'] = $value['province'];
            $data[$key]['city'] = $value['city'];
            $data[$key]['area'] = $value['area'];
            $data[$key]['address'] = F::msubstr(Area::getCity($value['province']) . Area::getCity($value['city']) . Area::getCity($value['area']));
            $data[$key]['email'] = $value['email'];
            $data[$key]['weixin'] = $value['weixin'];
            $data[$key]['QQ'] = $value['QQ'];
            $data[$key]['create_time'] = $value['create_time'];
            $data[$key]['Status'] = $value['Status'];
            $data[$key]['jiapart_ID'] = $value['jiapart_ID'];
            $data[$key]['update_time'] = $value['update_time'];
            //$data[$key]['checked']=true;
        }
        $rs = array(
            'total' => 1000,
            'rows' => !empty($data) ? $data : array()
        );
        echo json_encode($rs);
    }

    //业务联系人列表
    public function actionContactlist() {
        die;
        $user_id = Commonmodel::getOrganID();
        $sql = "select a.id,a.contact_user_id,a.customertype,
		   a.cooperationtype,a.name,a.sex,
		   a.companyname,a.phone,a.province,a.city,a.area,a.email,
		   a.weixin,a.QQ,a.create_time,a.Status,a.jiapart_ID,a.update_time,
		   	customercategory as customercategorys ,
		   (select b.category from tbl_customer_category b where a.customercategory=b.id and a.user_id=$user_id) as customercategory
		   from tbl_business_contacts a where 
		   user_id='$user_id' and Status=0 ";
        if ($_POST) {
            $search['name'] = $_POST['name'];
            $search['phone'] = $_POST['phone'];
            $search['keyword'] = $_POST['keyword'];
            $search['group'] = $_POST['group'];
            if ($search) {
                if ($search['name']) {
                    $sql.=" and name like'%$search[name]%'";
                }
                if ($search['phone']) {
                    $sql.=" and phone like '%$search[phone]%'";
                }
                if ($search['keyword']) {
                    $sql.=" and (companyname like '%$search[keyword]%') ";
                }
                if ($search['group']) {
                    $sql.=" and id in(select ContactsID from tbl_business_contacts_relation where GroupID='$search[group]')";
                }
            }
        }
        $sql.="order by create_time desc";
        $criteria = new CDbCriteria();
// 		$criteria->addCondition("user_id = $user_id and  Status=0");
// 		$criteria->order = "id DESC, update_time DESC";
// 		//$pages->pageSize = 5;
// 		$pages->applyLimit($criteria);
// 		$models = BusinessContacts::model()->findAll($criteria);
        $models = Yii::app()->db->createCommand($sql)->queryAll();
        $count = count($models);
        $pages = new CPagination($count);
        $pages->pageSize = intval($_GET['rows']);
        $pages->applylimit($criteria);
        $models = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $models->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $models->bindValue(':limit', $pages->pageSize);
        $models = $models->queryAll();
        foreach ($models as $key => $value) {
            $iden = User::model()->findByPk($value['contact_user_id']);
            $data[$key]['organ'] = $iden['identity'];
            switch ($iden['identity']) {
                case 1:
                    $data[$key]['organ'] = '生产商';
                    $organName = MakeOrgan::getMakeName($value['contact_user_id']);
                    break;
                case 2:
                    $data[$key]['organ'] = '经销商';
                    $organName = Dealer::dealername($value['contact_user_id']);
                    break;
                case 3:
                    $data[$key]['organ'] = '修理厂';
                    $organName = Service::getservicename($value['contact_user_id']);
                    break;
                default:
                    $organName = '';
            }
            $data[$key]['id'] = $value['id'];
            $data[$key]['companyID'] = $value['contact_user_id'];
            $data[$key]['customertype'] = $value['customertype'];
            $data[$key]['cooperationtype'] = $value['cooperationtype'];
            $data[$key]['customercategory'] = $value['customercategory'];
            $data[$key]['customercategorys'] = $value['customercategorys'];
            $data[$key]['name'] = $value['name'];
            $data[$key]['sex'] = $value['sex'];
            if ($value['contact_user_id'] && $organName) {
                $data[$key]['companyname2'] = F::msubstr($organName);
                $data[$key]['companyname'] = $organName;
            } else {
                $data[$key]['companyname2'] = F::msubstr($value['companyname']);
                $data[$key]['companyname'] = $value['companyname'];
            }
            $data[$key]['phone'] = $value['phone'];
            $data[$key]['province'] = $value['province'];
            $data[$key]['city'] = $value['city'];
            $data[$key]['area'] = $value['area'];
            $data[$key]['address'] = F::msubstr(Area::getCity($value['province']) . Area::getCity($value['city']) . Area::getCity($value['area']));
            $data[$key]['email'] = $value['email'];
            $data[$key]['weixin'] = $value['weixin'];
            $data[$key]['QQ'] = $value['QQ'];
            $data[$key]['create_time'] = $value['create_time'];
            $data[$key]['Status'] = $value['Status'];
            $data[$key]['jiapart_ID'] = $value['jiapart_ID'];
            $data[$key]['update_time'] = $value['update_time'];
            //$data[$key]['checked']=true;
        }
        $rs = array(
            'total' => $count,
            'rows' => !empty($data) ? $data : array()
        );
        echo json_encode($rs);
    }

    public function actionAddcontacts() {
        $user_id = Commonmodel::getOrganID();
        $contact_id = !empty($_POST['companyID']) ? $_POST['companyID'] : null;
        $jiapart_ID = time();
        $customertype = isset($_POST['customertype']) ? $_POST['customertype'] : null;
        $cooperationtype = isset($_POST['cooperationtype']) ? $_POST['cooperationtype'] : null;
        $customercategory = isset($_POST['customercategorys']) ? $_POST['customercategorys'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $sex = isset($_POST['sex']) ? $_POST['sex'] : null;
        $companyname = isset($_POST['companyname']) ? $_POST['companyname'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        $province = isset($_POST['Province']) ? $_POST['Province'] : null;
        $city = isset($_POST['City']) ? $_POST['City'] : null;
        $area = isset($_POST['Area']) ? $_POST['Area'] : null;
        $address = isset($_POST['address']) ? $_POST['address'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $qq = isset($_POST['QQ']) ? $_POST['QQ'] : null;
        $weixin = isset($_POST['weixin']) ? $_POST['weixin'] : null;
        $createtime = time();
        $sql = "insert into tbl_business_contacts (id,user_id,contact_user_id,jiapart_ID,customertype,cooperationtype,customercategory,name,
	   			sex,companyname,phone,province,city,area,address,email,weixin,QQ,memo,create_time,update_time,Status) 
	   			values (null,'$user_id','$contact_id',
	   			'$jiapart_ID','$customertype','$cooperationtype','$customercategory','$name',
	   			'$sex','$companyname','$phone',$province,$city,'$area',null,'$email','$weixin',
	   			'$qq',null,'$createtime',null,'0')";
        $result = Yii::app()->db->createCommand($sql)->execute();
// 	    $result=Yii::app()->db->createCommand()->insert('tbl_business_contacts',
// 	    		array('user_id'=>$user_id,'customertype'=>$customertype,'jiapart_ID'=>$jiapart_ID,
// 	    		'cooperationtype'=>$cooperationtype,
// 	    		'customercategory'=>$customercategory,'name'=>$name,
// 	    		'sex'=>$sex,'companyname'=>$companyname,'phone'=>$phone,
// 	    		//'province'=>$province,'city'=>$city,'area'=>$area,'address'=>$address,
// 	    		'email'=>$email,'QQ'=>$qq,'create_time'=>$createtime
// 	    ));
        echo json_encode($result);
    }

    //修改联系人
    public function actionUpdatecontacts() {
        $id = intval($_GET['id']);
        $customertype = isset($_POST['customertype']) ? $_POST['customertype'] : null;
        $cooperationtype = isset($_POST['cooperationtype']) ? $_POST['cooperationtype'] : null;
        $customercategory = isset($_POST['customercategorys']) ? $_POST['customercategorys'] : null;
        $contact_id = isset($_POST['companyID']) ? $_POST['companyID'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $sex = isset($_POST['sex']) ? $_POST['sex'] : null;
        $companyname = isset($_POST['companyname']) ? $_POST['companyname'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        $province = isset($_POST['Province']) ? $_POST['Province'] : null;
        $city = isset($_POST['City']) ? $_POST['City'] : null;
        $area = isset($_POST['Area']) ? $_POST['Area'] : null;
        $address = isset($_POST['address']) ? $_POST['address'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $qq = isset($_POST['QQ']) ? $_POST['QQ'] : null;
        $weixin = isset($_POST['weixin']) ? $_POST['weixin'] : null;
        $updatetime = time();
        $result = Yii::app()->db->createCommand()->update('tbl_business_contacts', array('customertype' => $customertype, 'cooperationtype' => $cooperationtype,
            'contact_user_id' => $contact_id, 'customercategory' => $customercategory,
            'name' => $name, 'sex' => $sex, 'companyname' => $companyname,
            'province' => $province, 'city' => $city, 'area' => $area,
            'phone' => $phone, 'email' => $email, 'qq' => $qq, 'weixin' => $weixin,
            'update_time' => $updatetime
                ), 'id=:id', array(':id' => $id));
        echo json_encode($result);
    }

    //删除联系人
    public function actionDeletecontacts() {
        $id = intval($_GET['id']);
        $result = Yii::app()->db->createCommand()->update('tbl_business_contacts', array('Status' => 1), 'id=:id', array(':id' => $id));
        echo json_encode($result);
    }

    /*
     * 通过联系人ID获取业务联系人信息
     */

    public function actionGetContact() {
        $model = BusinessContacts::model()->findByPk($_GET['id']);
        $model = $model->attributes;
        $model['deatil_address'] = Area::getCity($model['province']) . Area::getCity($model['city']) .
                Area::getCity($model['area']) . $model['address'];
        echo json_encode($model);
    }

    /*
     * 添加/编辑业务联系人
     */

    public function actionProcesscontact() {
        $model = new BusinessContacts();
        $user_id = Commonmodel::getOrganID();
        $contacts = $_GET;
        $contacts['update_time'] = time();
        $bool = false;
        if (!empty($_GET['id'])) {
            $bool = BusinessContacts::model()->updateByPk($_GET['id'], $contacts);
        } else {
            $model->attributes = $_GET;
            $model->user_id = $user_id;
            $model->jiapart_ID = date('YmdHis');
            $model->create_time = time();
            $bool = $model->save();
        }
        echo $bool;
    }

    /*
     * 删除业务联系人
     */

    public function actionDeletecontact() {
        if ($_GET['id']) {
            BusinessContacts::model()->deleteByPk($_GET['id']);
        }
        echo true;
    }

    /*
     * 全选删除
     */

    public function actionDelall() {
        if ($_GET['ids']) {
            $ids = $_GET['ids'];
            foreach ($ids as $id) {
                BusinessContacts::model()->deleteByPk($id);
            }
        }
        echo true;
    }

    /*
     * 客户类别管理
     */

    public function actionCustomercategory() {
        $this->pageTitle = Yii::app()->name . '-' . "客户类别管理";
        $this->render('categorylist');
    }

    /**
     * 客户类别列表
     */
    public function actionCustormercategorylist() {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $this->pageTitle = Yii::app()->name . '-' . "客户类别管理";
        $user_id = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition("user_Id = $user_id");
        $criteria->order = "create_time DESC";
        $count = CustomerCategory::model()->count($criteria);
// 		//分页类调用
        $pages = new CPagination($count);
// 		//每页显示的行数
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $models = CustomerCategory::model()->findAll($criteria);
        foreach ($models as $key => $value) {
            $data[$key]['category'] = $value['category'];
            $data[$key]['create_time'] = date('Y-m-d H:i:s', $value['create_time']);
            $data[$key]['id'] = $value['id'];
        }
        $rs = array(
            'total' => $count,
            'rows' => !empty($data) ? $data : array()
        );
        echo json_encode($rs);
    }

    //添加客户类别
    public function actionAddcustomercate() {
        $user_id = Commonmodel::getOrganID();
        $category = trim($_POST['category']);
        if (empty($category)) {
            $result['blank'] = '客户类别不可为空!';
        } else {
            $model = CustomerCategory::model()->findAll('category=:category and user_id=:userid', array(':category' => $category, ':userid' => $user_id));
            if ($model && $model > 0) {
                $result['only'] = '该类别名称已经存在';
            } else {
                $data = Yii::app()->db->createCommand()->insert('tbl_customer_category', array(
                    'category' => $category,
                    'user_id' => $user_id,
                    'create_time' => time(),
                    'update_time' => time()
                ));
                $result['data'] = $data;
            }
        }

        echo json_encode($result);
    }

    //修改
    public function actionUpdatecustomercate() {
        $user_id = Commonmodel::getOrganID();
        $id = $_GET['id'];
        $category = trim($_POST['category']);
        if (empty($category)) {
            $result['blank'] = '客户类别不可为空!';
        } else {
            $model = CustomerCategory::model()->findAll('category=:category and user_id=:userid and ID <> :id', array(':category' => $category, ':id' => $id, ':userid' => $user_id));
            if ($model && $model > 0) {
                $result['only'] = '该类别名称已经存在';
            } else {
                $data = CustomerCategory::model()->updateByPk($id, array('category' => $category, 'update_time' => time()));
                $result['data'] = $data;
            }
        }
        echo json_encode($result);
    }

    public function actionDeletecustomercate() {
        $id = intval($_GET['id']);
        $result = Yii::app()->db->createCommand()->delete('tbl_customer_category', 'id=:id', array(':id' => $id));
        echo json_encode($result);
    }

    /*
     * 通过ID获取类别信息
     */

    public function actionGetcategory() {
        $model = CustomerCategory::model()->findByPk($_GET['id']);
        $model = $model->attributes;
        echo json_encode($model);
    }

    /*
     * 添加/编辑客户类别
     */

    public function actionProcesscategory() {
        $model = new CustomerCategory();
        $user_id = Commonmodel::getOrganID();
        $category = $_GET;
        $category['user_id'] = $user_id;
        $category['update_time'] = time();
        $bool = false;
        if (!empty($_GET['id'])) {
            $bool = CustomerCategory::model()->updateByPk($_GET['id'], $category);
        } else {
            $model->attributes = $category;
            $model->create_time = time();
            $bool = $model->save();
        }
        echo $bool;
    }

    /*
     * 删除客户类别
     */

    public function actionDeletecategory() {
        if ($_GET['id']) {
            CustomerCategory::model()->deleteByPk($_GET['id']);
        }
        echo true;
    }

    public function actionAddcontactsgroup() {
        $this->pageTitle = Yii::app()->name . '-' . "业务联系人群组管理";
        $this->render('contactgroup');
    }

    /**
     * 群组列表
     */
    public function actionGrouplist() {

        $model = new BusinessContactsGroup();
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        //查询条件
        $criteria->addCondition("Status=:status and OrganID=:organID");
        $criteria->params[':status'] = 0;
        $criteria->params[':organID'] = $organID;
        $criteria->order = "CreateTime DESC";
        $count = $model->count($criteria);
        //分页类调用
        $pages = new CPagination($count);
        //每页显示的行数
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = $model->findAll($criteria);
        // $model=$model->findAll('Status=:status',array(':status'=>'0'));
        foreach ($model as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['GroupName'] = $value["GroupName"];
            $data[$key]['Remark'] = $value['Remark'];
            $data[$key]['CreateTime'] = date('Y-m-d H:i:s', $value['CreateTime']);
        }
        $rs = array(
            'total' => $count,
            'rows' => !empty($data) ? $data : array()
        );
        echo json_encode($rs);
    }

    /**
     * 增加群组
     */
    public function actionAddgroup() {
        $organID = Commonmodel::getOrganID();
        $userID = Commonmodel::getOrganID();
        $contactID = substr($_POST['ids'], 0, -1);
        $contactID = explode(',', $contactID);
        $ID = $_POST['ID'];
        $remark = $_POST['Remark'];
        $GroupName = trim($_POST['GroupName']);
        if (empty($GroupName)) {
            $result['blank'] = '群组名称不可为空!';
        } else {
            $model = BusinessContactsGroup::model()->findAll('GroupName=:groupname and Status=0 and UserID=:userID', array(':groupname' => $GroupName, ':userID' => $userID));
            if ($model && count($model) > 0) {
                $result['only'] = '该群组名称已经存在';
            } else {
                $datas = Yii::app()->db->createCommand()->insert('tbl_business_contacts_group', array(
                    'GroupName' => $GroupName, 'Remark' => $remark,
                    'OrganID' => $organID, 'UserID' => $userID,
                    'CreateTime' => time(), 'UpdateTime' => time()));
                $groupID = Yii::app()->db->getLastInsertID();
                $contactsID = count($contactID);
                for ($i = 0; $i < $contactsID; $i++) {
                    $data = Yii::app()->db->createCommand()->insert('tbl_business_contacts_relation', array('ContactsID' => $contactID[$i], 'GroupID' => $groupID));
                }
                $result['data'] = $datas;
            }
        }
        echo json_encode($result);
    }

    //修改群组
    public function actionUpdategroup() {
        $id = intval($_GET['id']);
        $remark = $_POST['Remark'];
        $GroupName = $_POST['GroupName'];
        $result = Yii::app()->db->createCommand()->update('tbl_business_contacts_group', array(
            'GroupName' => $GroupName, 'UpdateTime' => time(), 'remark' => $remark), 'id=:id', array(
            ':id' => $id));
        echo json_encode($result);
    }

    //获取联系人ID
    public function actionQuerycontacts() {
        $id = $_GET['id'];
        $groupname = $_GET['groupname'];
        $sql = "select ContactsID from tbl_business_contacts_relation where GroupID=$id";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        echo json_encode($data);
    }

    //删除群组
    public function actionDeletegroup() {
        $id = intval($_GET['id']);
        $result = Yii::app()->db->createCommand()->update('tbl_business_contacts_group', array('Status' => 1), 'id=:id', array(':id' => $id));
        echo json_encode($result);
    }

    public function actionEditselect() {
        $groupID = $_GET['id'];
        $userid = Commonmodel::getOrganID();
        $sql = "select a.id, a.name,a.customertype,
        		(select b.category from tbl_customer_category b where a.customercategory=b.id and a.user_id=$userid) as customercategory,
        		a.companyname"
                . " ,a.phone,a.cooperationtype,a.sex"
                . " from tbl_business_contacts a "
                . " where a.id in(select b.ContactsID from  tbl_business_contacts_relation b where b.GroupId='$groupID')
           and a.user_id='$userid' and a.Status=0";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($result as $key => $value) {
            $data[$key]['id'] = $value['id'];
            $data[$key]['customertype'] = $value['customertype'];
            $data[$key]['companyname'] = $value['companyname'];
            $data[$key]['cooperationtype'] = $value['cooperationtype'];
            $data[$key]['customercategory'] = $value['customercategory'];
            $data[$key]['name'] = $value['name'];
            $data[$key]['sex'] = $value['sex'];
        }
        $rs = array(
            'total' => count($result),
            'rows' => $data ? $data : array(),
        );

        echo json_encode($rs);
    }

    public function actionEditgroup() {
        $groupID = $_GET['id'];
        $userid = Commonmodel::getOrganID();
        ;
        //    	$sql="select a.id, a.name,a.customertype,a.customercategory"
        //    			." ,a.phone,a.cooperationtype,a.sex,a.companyname"
        //    			." from tbl_business_contacts a "
        //    					." where a.id not in(select b.ContactsID from  tbl_business_contacts_relation b where b.GroupId='$groupID')
        //    					and a.user_id='$userid'";
        $sql = "select a.id,a.contact_user_id,a.customertype,
	   	a.cooperationtype,a.name,a.sex,
	   	a.companyname,a.phone,a.province,a.city,a.area,a.email,
	   	a.weixin,a.QQ,a.create_time,a.Status,a.jiapart_ID,a.update_time,
	   	(select b.category from tbl_customer_category b where a.customercategory=b.id and a.user_id=$userid) as customercategory
	   	from tbl_business_contacts a where
	   	a.id not in(select b.ContactsID from  tbl_business_contacts_relation b where b.GroupId='$groupID') and
	   	user_id='$userid' and Status=0 ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $data[$key]['id'] = $value['id'];
                $data[$key]['companyname'] = $value['companyname'];
                $data[$key]['customertype'] = $value['customertype'];
                $data[$key]['cooperationtype'] = $value['cooperationtype'];
                $data[$key]['customercategory'] = $value['customercategory'];
                $data[$key]['name'] = $value['name'];
                $data[$key]['sex'] = $value['sex'];
            }
        }
        $rs = array(
            'total' => count($result),
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    public function actionEditgroupsave() {
        $userid = Commonmodel::getOrganID();
        $groupid = $_GET['id'];
        $iddata = $_POST['iddata'];
        $remark = $_POST['remark'];
        $groupname = trim($_POST['groupname']);
        if (empty($groupname)) {
            $result['blank'] = '群组名称不可为空!';
        } else {
            //去除最后一个分隔符
            $iddata = substr($iddata, 0, -1);
            $iddata = explode(',', $iddata);
            $model = BusinessContactsGroup::model()->findAll('GroupName=:groupname and Status=0 and ID<>:id and UserID=:userID', array(':groupname' => $groupname, 'id' => $groupid, ':userID' => $userid));
            if ($model && count($model) > 0) {
                $result['only'] = '该群组名称已经存在';
            } else {
                $update_result = Yii::app()->db->createCommand()->update('tbl_business_contacts_group', array('GroupName' => $groupname, 'Remark' => $remark, 'UpdateTime' => time()), 'ID=:id', array(':id' => $groupid));
                $result['update'] = $update_result;
                $sql = "select ContactsID from tbl_business_contacts_relation where GroupID='$groupid'";
                $results = Yii::app()->db->createCommand($sql)->queryAll();
                if (!empty($results)) {
                    foreach ($results as $value) {
                        if (!in_array($value['ContactsID'], $iddata)) {
                            $sql = "delete from tbl_business_contacts_relation where ContactsID={$value['ContactsID']} and GroupID='$groupid'";
                            $results = Yii::app()->db->createCommand($sql)->execute();
                        } else {
                            $arr[] = $value['ContactsID'];
                        }
                    }
                } else {
                    $contactsID = count($iddata);
                    for ($i = 0; $i < $contactsID; $i++) {
                        $data = Yii::app()->db->createCommand()->insert('tbl_business_contacts_relation', array('ContactsID' => $iddata[$i], 'GroupID' => $groupid));
                    }
                }
                if (!empty($arr)) {
                    foreach ($iddata as $val) {
                        if (!in_array($val, $arr)) {
                            $data = Yii::app()->db->createCommand()->insert('tbl_business_contacts_relation', array('ContactsID' => $val, 'GroupID' => $groupid));
                        }
                    }
                }
            }
        }
        echo json_encode($result);
    }
//获取所有机构
    protected function Getorgan()
   {
       //获取自身机构ID
       $organID=Yii::app()->user->getOrganID();
       $businessContacts= Contacts::model()->findAll('OrganID=:organID and Status=:stu',array(':organID'=>$organID,':stu'=>'0'));

       foreach($businessContacts as $val)
       {
           if($val['ContactID'])
           {
               $ids[]=$val['ContactID'];
           }
       }
           //新增的联系人不能是本人
           $ids[]=$organID;
           $ids=implode(',',$ids);
           $result=Organ::model()->findAll("ID not in($ids) and !ISNULL(OrganName)");
           return $result;
      
   }
    public function actionOrgan() {
        $user_id = Commonmodel::getOrganID();
        // $ids = $user_id;
        $businessContacts = BusinessContacts::model()->findAll('user_id=:user_id and Status=0', array(':user_id' => $user_id));
        foreach ($businessContacts as $key => $val) {
            if ($val['contact_user_id']) {
                $ids[] = $val['contact_user_id'];
            }
        }
        $ids[] = $user_id; //新增的联系人不能是添加者本人
        $ids = implode(',', $ids);
        //经销商数据
        $i = 0;
        $model = Dealer::model()->findAll("userID not in ($ids) and !ISNULL(organName)");
        foreach ($model as $key => $value) {

            $data[$i]['companyname'] = $value['organName'];
            $data[$i]['userID'] = $value['userID'];
            // $data[$key]['companytype']=$value['userID'];
            $result = User::model()->findByPk($value['userID']);
            switch ($result['identity']) {
                case 1:
                    $data[$i]['companytype'] = '生产商';
                    break;
                case 2:
                    $data[$i]['companytype'] = '经销商';
                    break;
                case 3:
                    $data[$i]['companytype'] = '修理厂';
            }
            $i++;
        }
        //修理厂
        $model = Service::model()->findAll("userId not in ($ids) and !ISNULL(serviceName)");
        foreach ($model as $key => $value) {
            $data[$i]['companyname'] = $value['serviceName'];
            $data[$i]['userID'] = $value['userId'];
            //$data[$value['userId']]['companytype']=$value['userId'];
            $result = User::model()->findByPk($value['userId']);
            switch ($result['identity']) {
                case 1:
                    $data[$i]['companytype'] = '生产商';
                    break;
                case 2:
                    $data[$i]['companytype'] = '经销商';
                    break;
                case 3:
                    $data[$i]['companytype'] = '修理厂';
            }
            $i++;
        }
        //生产商
//    		$model=Yii::app()->db->createCommand()
//    		->select('*')
//    		->from('tbl_make_organ')
//    		->queryAll();
        $model = MakeOrgan::model()->findAll("userID not in ($ids)");
        foreach ($model as $key => $value) {
            $data[$i]['companyname'] = $value['name'];
            $data[$i]['userID'] = $value['userID'];
            //$data[$key]['companytype']=$value['userID'];
            $result = User::model()->findByPk($value['userID']);
            switch ($result['identity']) {
                case 1:
                    $data[$i]['companytype'] = '生产商';
                    break;
                case 2:
                    $data[$i]['companytype'] = '经销商';
                    break;
                case 3:
                    $data[$i]['companytype'] = '修理厂';
            }
            $i++;
        }

        $rs = array(
            'total' => 1000,
            'rows' => $data
        );
        echo json_encode($rs);
    }

    public function actionShare() {
        $this->pageTitle = Yii::app()->name . '-' . '共享联系人管理';
        $this->render('sharelist');
    }

    public function actionSharecontact() {
        $organID = Commonmodel::getOrganID();
        $dealer = Dealer::model()->find('userID=:userid', array(':userid' => $organID));
        $share = BusinessShare::model()->findAll('InitiatorID=:intorID and Status=2', array(':intorID' => $organID));
        foreach ($share as $key => $value) {
            $shareID.=',' . $value['ShareID'];
        }
        $shareID = ltrim($shareID, ",");
        //查出shareID 
        $sql = "select a.id,a.contact_user_id,a.customertype,
		   a.cooperationtype,a.name,a.sex,
		   a.companyname,a.phone,a.province,a.city,a.area,a.email,
		   a.weixin,a.QQ,a.create_time,a.Status,a.jiapart_ID,a.update_time,
		   (select b.category from tbl_customer_category b where a.customercategory=b.id and a.user_id=$organID) as customercategory
		   from tbl_business_contacts a where 
		   user_id='$organID' and Status=0  and a.contact_user_id in($shareID)";
        if ($_POST) {
            $search['name'] = $_POST['name'];
            $search['phone'] = $_POST['phone'];
            $search['keyword'] = $_POST['keyword'];
            if ($search) {
                if ($search['name']) {
                    $sql.=" and name like'%$search[name]%'";
                }
                if ($search['phone']) {
                    $sql.=" and phone like '%$search[phone]%'";
                }
                if ($search['keyword']) {
                    $sql.=" and (companyname like '%$search[keyword]%') ";
                }
            }
        }
        $sql.="order by create_time desc";
        $criteria = new CDbCriteria();
        $models = Yii::app()->db->createCommand($sql)->queryAll();
        $count = count($models);
        $pages = new CPagination($count);
        $pages->pageSize = intval($_GET['rows']);
        $pages->applylimit($criteria);
        $models = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $models->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $models->bindValue(':limit', $pages->pageSize);
        $models = $models->queryAll();
        foreach ($models as $key => $value) {
            $data[$key]['id'] = $value['id'];
            $data[$key]['Initiator'] = F::msubstr($dealer['organName']);
            $data[$key]['companyID'] = $value['contact_user_id'];
            //$data[$key]['customertype'] = $value['customertype'];
            $data[$key]['cooperationtype'] = $value['cooperationtype'];
            $data[$key]['customercategory'] = $value['customercategory'];
            $data[$key]['name'] = $value['name'];
            $data[$key]['sex'] = $value['sex'];
            $data[$key]['companyname2'] = F::msubstr($value['companyname']);
            $data[$key]['companyname'] = $value['companyname'];
            $data[$key]['phone'] = $value['phone'];
            $data[$key]['province'] = $value['province'];
            $data[$key]['city'] = $value['city'];
            $data[$key]['area'] = $value['area'];
            $data[$key]['address'] = F::msubstr(Area::getCity($value['province']) . Area::getCity($value['city']) . Area::getCity($value['area']));
            $data[$key]['email'] = $value['email'];
            $data[$key]['weixin'] = $value['weixin'];
            $data[$key]['QQ'] = $value['QQ'];
            $data[$key]['create_time'] = $value['create_time'];
            $data[$key]['Status'] = $value['Status'];
            $data[$key]['jiapart_ID'] = $value['jiapart_ID'];
            $data[$key]['update_time'] = $value['update_time'];
            //$data[$key]['checked']=true;
        }
        $rs = array(
            'total' => $count,
            'rows' => !empty($data) ? $data : array()
        );
        echo json_encode($rs);
    }

}