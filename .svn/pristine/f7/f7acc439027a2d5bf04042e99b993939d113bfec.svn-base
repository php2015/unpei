<?php

class ServicemanageController extends Controller {


	/*
	 * 表单验证
	 */
	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='ServicePartsEdit-form' && $_POST['ajax']==='ServiceRecordEdit-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}
	
    /*
     * 渲染服务记录页面
     */
    public function actionIndex() {
    	$OrganID = Yii::app()->user->getOrganID();
    	
		
		//获取服务记录列表
		$plate = Yii::app()->request->getParam("plate");
		$name = Yii::app()->request->getParam("name");
		$type = Yii::app()->request->getParam("type");
		$time = Yii::app()->request->getParam("time");
		
		$criteria = new CDbCriteria();
	    $criteria->with= array(  
            'vehicle'=>array(  
            'with'=>array('owner')));
       // $criteria->with = "vehicle";
        if (!empty($plate)) {//车牌号
            $criteria->addSearchCondition('vehicle.LicensePlate', "{$plate}", "AND");
        }
        if (!empty($name)) {//车主姓名
            $owner = $this->getOwner($name);
            $criteria->addInCondition('vehicle.OwnerID', $owner);
        }
        if (!empty($type)) {//服务类别
            $criteria->addSearchCondition('t.ServiceType', "{$type}", "AND");
        }
        if (!empty($time)) {//登记时间
            $CurrentTime = time();
            switch ($time) {
                case "1": $CurrentTime -= 24 * 60 * 60 * 7;
                    break;  //一周内
                case "2": $CurrentTime -= 24 * 60 * 60 * 30 * 1;
                    break;  //一月内
                case "3": $CurrentTime -= 24 * 60 * 60 * 30 * 3;
                    break;  //三月内
                case "4": $CurrentTime -= 24 * 60 * 60 * 30 * 6;
                    break;  //六月内
                case "5": $CurrentTime -= 24 * 60 * 60 * 30 * 12;
                    break; //一年内
                default: $CurrentTime -= 24 * 60 * 60 * 30 * 12 * 10;
                    break; //显示全部
            }
            $criteria->addCondition("t.CreateTime >= {$CurrentTime}", "AND");
        }
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = {$OrganID}", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
       
        $dataProvider = new CActiveDataProvider('ServiceRecord',
	        array(
	            'criteria'=>$criteria,
	            'pagination'=>array(
	      			'pageSize'=>'10'
	                ),
	            )
	    );
        $data = $dataProvider->getData();
        foreach ($data as $val){
        	if ($val['ServiceType'] == 2){
        		$val['ServiceType'] = "配件服务";
        	}elseif ($val['ServiceType'] == 3){
        		$val['ServiceType'] = "全部服务";
        	}else {
        		$val['ServiceType'] = "保养服务";
        	}
        }
        $this->render('index',array('dataProvider'=>$dataProvider, 'plate'=>$plate, 'name'=>$name, 'type'=>$type, 'time'=>$time));
    }
    
	/*
     * 添加服务记录-检索车辆
     */
    public function actionCheckcars() {
        $OrganID = Yii::app()->user->getOrganID();
    	//检索车辆
    	$addLicensePlate = Yii::app()->request->getParam("addLicensePlate");
    	if (empty($addLicensePlate)){$addLicensePlate = "NULL";}
	    $cri = new CDbCriteria();
		$cri->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
		$cri->addCondition("t.OrganID = {$OrganID}");
		$cri->addCondition("t.Status = 0");
		$cri->addSearchCondition("t.LicensePlate", "{$addLicensePlate}");
		$cardata = new CActiveDataProvider('ServiceCar',
	        array(
	            'criteria'=>$cri,
	            'pagination'=>array(
	      			'pageSize'=>'10'
	                ),
	            )
	    );
		$data = $cardata->getData();
		foreach ($data as $key => $val){
		   	$val['Car'] = str_replace(",", " ", $val['Car']);
		    if ($val['UseNature'] == 2){
		   		$val['UseNature'] = '公务车';
		   	}elseif ($val['UseNature'] == 3){
		   		$val['UseNature'] = '运营车';
		   	}else {
		   		$val['UseNature'] = '私家车';
		   	}
		}
        $this->render('checkcar',array('cardata'=>$cardata, 'addLicensePlate'=>$addLicensePlate));
    }
    
	/*
     * 添加服务记录
     */
    public function actionAddrecord() {
        $carID = Yii::app()->request->getParam("id");//$_GET['ID'];
        $this->render('add',array('id' => $carID));
    }
    
	/*
     * 修改服务记录
     */
    public function actionEdit() {
    	$OrganID = Yii::app()->user->getOrganID();
        $ServiceID = Yii::app()->request->getParam("id");//$_GET['ID'];
        //获取服务记录详情
        $record = ServiceRecord::model()->findByPK($ServiceID);
        
        //获取配件服务记录详情
        $criteria = new CDbCriteria();
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("ServiceID = {$ServiceID}", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
    	$dataProvider = new CActiveDataProvider('ServiceParts',
	        array(
	            'criteria'=>$criteria,
	            'pagination'=>array(
	      			'pageSize'=>'5'
	                ),
	            )
	    );
        $data = $dataProvider->getData();
        $key = 0;
        foreach ($data as $val){
        	$part = explode(",", $val['PartName']);
                if(empty(array_filter($part))){
                    array_splice($data,$key,1);
                    continue;
                }
                $key++;
        	$val['PartName'] = '';
        	foreach ($part as $v){
        		$name = Gcategory::model()->find(array(
				    'select'=>'Name',
				    'condition'=>'ID= :ID',
				    'params'=>array(':ID'=>$v),
				));
				$val['PartName'] .= $name['Name'].",";
        	}
        	$val['PartName'] = substr($val['PartName'],0,strlen($val['PartName'])-1); 
        	if ($val['OperateType'] == 2){
        		$val['OperateType'] = "维修";
        	}else {
        		$val['OperateType'] = "更换";
        	}
        }
        $dataProvider->setData($data);
        
        //获取车辆详情
        //根据服务记录ID获取车辆ID
        $carID = ServiceRecord::model()->find(array(
        			'select'=>'CarID',
				    'condition'=>'ID= :ID',
				    'params'=>array(':ID'=>$ServiceID),
        			));
        $car = ServiceCar::model()->findByPK($carID['CarID']);
        if ($car['UseNature'] == 2){
        	$car['UseNature'] = "公务车";
        }elseif ($car['UseNature'] == 3){
        	$car['UseNature'] = "运营车";
        }else {
        	$car['UseNature'] = "私家车";
        }
		$car['Car'] = str_replace(",", " ", $car['Car']);
        
        //获取车主详情
        $owner = ServiceCarOwner::model()->findByPK($car['OwnerID']);
        
        $this->render('edit',array('dataProvider'=>$dataProvider, 'car'=>$car, 'owner'=>$owner, 'record'=>$record));
    }
    
    /*
     * 修改日常保养
     */
    public function actionEditrecord(){
    	$ServiceRecord = Yii::app()->request->getParam("ServiceRecord");
    	$model = ServiceRecord::model()->findByPK($ServiceRecord['ID']);
    	$model->Mileage = $ServiceRecord['Mileage'];
    	$model->Remark = $ServiceRecord['Remark'];
    	$model->UpdateTime = time();
    	if ($model->save()){
    		$this->redirect('index');
    	}else {
    		var_dump($model->errors);die;
    	}
    }
    
    /*
     * 修改配件记录
     */
    public function actionEditparts(){
    	$id = Yii::app()->request->getParam("id");
    	$model = ServiceParts::model()->findByPK($id);
    	$this->performAjaxValidation($model);
    	
    	if ($_POST){
    		$model->attributes = Yii::app()->request->getParam("ServiceParts");
    		$model->PartName = Yii::app()->request->getParam("mainCategory").",".Yii::app()->request->getParam("subCategory").",".Yii::app()->request->getParam("leafCategory");
    		if ($model->save()){
                    $this->redirect(array('edit','id'=>$model->ServiceID));die;
                }else{
                    var_dump($model->errors);die;
                }
    	}else{
            $this->render('editparts',array('model'=>$model));
        }
    }
    
	/*
     * 删除配件信息
     */
    public function actionDelparts() {
    	$ID = Yii::app()->request->getParam("id");
        $success = ServiceParts::model()->updateByPk($ID, array(
            'Status' => 1,
            'UpdateTime' => time()
                ));
        $parts = ServiceParts::model()->findByPK($ID);
    	//如果配件记录为空，则将服务记录类型修改为日常保养
        $record = ServiceParts::model()->findAll(array(
            "condition" => "ServiceID = {$parts->ServiceID} AND Status != 1"
                ));
        if (empty($record)) {
            ServiceRecord::model()->updateByPk($parts->ServiceID, array("ServiceType" => '1'));
        }
        //判断返回值
    	if ($success) {
            $result = array('success' => 1, 'errorMsg' => '信息删除成功！');
        } else {
            $result = array('success' => 0, 'errorMsg' => '系统异常，配件信息删除失败！');
        }
        echo json_encode($result);
    }
    
	/*
     * 服务记录详情
     */
    public function actionDetail() {
    	$OrganID = Yii::app()->user->getOrganID();
        $ServiceID = Yii::app()->request->getParam("id");//$_GET['ID'];
        //获取服务记录详情
        $record = ServiceRecord::model()->findByPK($ServiceID);
        
        //获取配件服务记录详情
        $criteria = new CDbCriteria();
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("ServiceID = {$ServiceID}", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
    	$dataProvider = new CActiveDataProvider('ServiceParts',
	        array(
	            'criteria'=>$criteria,
	            'pagination'=>array(
	      			'pageSize'=>'10'
	                ),
	            )
	    );
        $data = $dataProvider->getData();
        $key=0;
        foreach ($data as $val){
        	$part = explode(",", $val['PartName']);
                if(empty(array_filter($part))){
                    array_splice($data,$key,1);
                    continue;
                }
                $key++;
        	$val['PartName'] = '';
        	foreach ($part as $v){
        		$name = Gcategory::model()->find(array(
				    'select'=>'Name',
				    'condition'=>'ID= :ID',
				    'params'=>array(':ID'=>$v),
				));
				$val['PartName'] .= $name['Name'].",";
        	}
        	$val['PartName'] = substr($val['PartName'],0,strlen($val['PartName'])-1); 
        	if ($val['OperateType'] == 2){
        		$val['OperateType'] = "维修";
        	}else {
        		$val['OperateType'] = "更换";
        	}
        }
                //var_dump($data);die;
        $dataProvider->setData($data);
        //获取车辆详情
        //根据服务记录ID获取车辆ID
        $carID = ServiceRecord::model()->find(array(
        			'select'=>'CarID',
				    'condition'=>'ID= :ID',
				    'params'=>array(':ID'=>$ServiceID),
        			));
        $car = ServiceCar::model()->findByPK($carID['CarID']);
        if ($car['UseNature'] == 2){
        	$car['UseNature'] = "公务车";
        }elseif ($car['UseNature'] == 3){
        	$car['UseNature'] = "运营车";
        }else {
        	$car['UseNature'] = "私家车";
        }
		$car['Car'] = str_replace(",", " ", $car['Car']);
        
        //获取车主详情
        $owner = ServiceCarOwner::model()->findByPK($car['OwnerID']);
        
        $this->render('detail',array('dataProvider'=>$dataProvider, 'car'=>$car, 'owner'=>$owner, 'record'=>$record));
    }
    
    /*
     * 配件服务记录详情
     */
    public function actionServedetail(){
    	$id = Yii::app()->request->getParam("id");
    	$model = ServiceParts::model()->findByPK($id);
    	
    	$data = array();
    	$data = $model->attributes;
        $part = explode(",", $data['PartName']);
        $data['PartName'] = '';
        foreach ($part as $v){
        	$name = Gcategory::model()->find(array(
			    'select'=>'Name',
			    'condition'=>'ID= :ID',
			    'params'=>array(':ID'=>$v),
			));
			$data['PartName'] .= $name['Name'].",";
        }
        $data['PartName'] = substr($data['PartName'],0,strlen($data['PartName'])-1); 
        if ($data['OperateType'] == 2){
        	$data['OperateType'] = "维修";
        }else {
        	$data['OperateType'] = "更换";
        }
    	$this->render("servedetail",array('data'=>$data));
    }

    /*
     * 通过车主姓名获取车牌号
     */

    public function getOwner($name) {
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.Name', "{$name}", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
        $model = ServiceCarOwner::model()->findAll($criteria);
        $data = array();
        foreach ($model as $key => $value) {
            if (!in_array($value['ID'], $data)) {
                $data[] = $value['ID'];
            }
        }
        return $data;
    }

    /*
     * 服务记录详情
     */

    public function actionPartsservice() {
        $ID = $_POST['ID'];
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.ServiceID = {$ID}", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.UpdateTime,t.ID倒叙
        $model = CarServiceParts::model()->findAll($criteria);
        foreach ($model as $key => $value) {
            $data[$key] = $value->attributes;
            if ($value['OperateType'] == '1') {
                $data[$key]['Type'] = '更换';
            } else {
                $data[$key]['Type'] = '维修';
            }
            $data[$key]['OperateType'] = $value['OperateType'];
            $partName = explode(',', $value['PartName']);
            $data[$key]['mainCategory'] = $partName[0];
            $data[$key]['subCategory'] = $partName[1];
            $data[$key]['leafCategory'] = $partName[2];
            if (is_numeric($partName[0])) {
                $data[$key]['PartName'] = F::msubstr(Commonmodel::getCategory($partName[0]) . "," . Commonmodel::getCategory($partName[1]) . "," . Commonmodel::getCategory($partName[2]));
            }
            $data[$key]['TechnicianName'] = $value['TechnicianName'];
            $data[$key]['RepairCause'] = $value['RepairCause'];
            $data[$key]['RevisedNote'] = $value['RevisedNote'];
            $data[$key]['UpdateTime'] = F::msubstr(date('Y-m-d', $value['UpdateTime']));
        }
        $rs = array(
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 通过车牌号检索车辆是否存在
     */

    public function actionCheckcar() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->with = "owner";
        $criteria->addCondition("t.OrganID = {$organID}");
        $criteria->addSearchCondition('t.LicensePlate', "{$_POST['licenseplate']}", "AND");
        $model = CarInfo::model()->findAll($criteria);
        foreach ($model as $key => $value) {
            //车辆ID
            $data[$key]['ID'] = $value['ID'];
            //车主信息
            $data[$key]['Name'] = $value->owner->Name ? F::msubstr($value->owner->Name) : '未绑定';
            $data[$key]['Phone'] = $value->owner->Phone ? F::msubstr($value->owner->Phone) : '未绑定';
            $data[$key]['City'] = $value->owner->City ? F::msubstr(str_replace("/", "", $value->owner->City)) : '未绑定';
            //车辆信息
            $data[$key]['LicensePlate'] = F::msubstr($value['LicensePlate']);
            if ($value['UseNature'] == '1') {
                $data[$key]['Uses'] = "私家车";
            } elseif ($value['UseNature'] == '2') {
                $data[$key]['Uses'] = "公务车";
            } else {
                $data[$key]['Uses'] = "运营车辆";
            }
            $data[$key]['Car'] = F::msubstr(str_replace(",", "", $value['Car']));
            $data[$key]['VinCode'] = $value['VinCode'];
            $data[$key]['Miles'] = $value['Mileage'];
            $data[$key]['BuyTime'] = date('Y-m-d', $value['BuyTime']);
        }
        $rs = array(
            'totals' => count($model),
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 添加服务记录
     */

    public function actionAdd() {
    	//var_dump($_POST);die;
        $record = new ServiceRecord();
        $record->CarID = Yii::app()->request->getParam("ID");//$_GET['ID'];
        $record->Mileage = Yii::app()->request->getParam("Mileage");//$_POST['Mileage'];
        $record->ServiceType = Yii::app()->request->getParam("ServiceType");//$_POST['ServiceType'];
        $record->Remark = Yii::app()->request->getParam("Remark");//$_POST['Remark'];
        $record->OrganID = Yii::app()->user->getOrganID();//Commonmodel::getOrganID();
        $record->UserID = Yii::app()->user->id;
        $record->CreateTime = time();
        $record->UpdateTime = time();
        $record_success = $record->save();
        //添加配件服务记录
        $id = $record->attributes['ID'];
        $partsType = Yii::app()->request->getParam("partsType");//$_POST['partsType'];
    	//var_dump($partsType);die;
        $partsCount = 0;
        for ($i = 0; $i <= count($partsType); $i++) {
            $partsCount += $partsType[$i];
        }
        if (Yii::app()->request->getParam("ServiceType") != '1') {
            if ($partsCount) {
                if ($partsCount == 1) {
                    if (Yii::app()->request->getParam("replace")) {
                        $replace_success = $this->addReplace($id, Yii::app()->request->getParam("replace"));
                    } else {
                        $replace_success = $this->addOneReplace($id, $_POST);
                    }
                } else if ($partsCount == 2) {
                    if (Yii::app()->request->getParam("repair")) {
                        $repair_success = $this->addRepair($id,Yii::app()->request->getParam("repair"), $_POST);
                    } else {
                        $repair_success = $this->addOneRepair($id, $_POST);
                    }
                } else {
                    if (Yii::app()->request->getParam("replace")) {
                        $replace_success = $this->addReplace($id, Yii::app()->request->getParam("replace"));
                    } else {
                        $replace_success = $this->addOneReplace($id, $_POST);
                    }
                    if ($_POST['repair']) {
                        $repair_success = $this->addRepair($id, Yii::app()->request->getParam("repair"), $_POST);
                    } else {
                        $repair_success = $this->addOneRepair($id, $_POST);
                    }
                }
            }
        }
        $result = array();
        if ($record_success == '1') {
        	$result['result'] = 1;
            $result['Msg'] = '服务记录添加成功!';
        } elseif ($record_success == '0') {
        	$result['result'] = 0;
            $result['Msg'] = '数据异常，日常保养记录添加失败!';
        } elseif ($record_success == '1' && ($replace_success == '0' || $repair_success == '0')) {
        	$result['result'] = 0;
            $result['Msg'] = '数据异常，配件服务记录添加失败!';
        } elseif ($record_success == '0' && ($replace_success == '0' || $repair_success == '0')) {
        	$result['result'] = 0;
            $result['Msg'] = '数据异常，服务记录添加失败!';
        }
        $this->render('add',array('id' => Yii::app()->request->getParam("ID"), 'result' => $result));
        //echo json_encode($result);
    }

    /*
     * 添加配件更换信息
     */

    public function addReplace($id, $replaces) {
        foreach ($replaces as $key => $value) {
            $replace = new ServiceParts();
            $rs = explode(',', $value);
            $replace->ServiceID = $id;
            $replace->OperateType = "1";
            $replace->PartName = $rs[0] . "," . $rs[1] . "," . $rs[2];
            $replace->Brand = $rs[3];
            $replace->Num = $rs[4];
            $replace->OE = $rs[5];
            $replace->UserID = Yii::app()->user->id;
            $replace->CreateTime = time();
            $replace->UpdateTime = time();
            $replace->Status = 0;
            $success = $replace->save();
        }
        return $success;
    }

    /*
     * 添加一条配件更换信息
     */

    public function addOneReplace($id, $part) {
        $replace = new ServiceParts();
        $replace->ServiceID = $id;
        $replace->OperateType = "1";
        $replace->PartName = $part['mainCategory_add_replace'] . "," . $part['subCategory_add_replace'] . "," . $part['leafCategory_add_replace'];
        $replace->Brand = $part['replace_brand'];
        $replace->Num = $part['replace_num'];
        $replace->OE = $part['replace_OE'];
        $replace->UserID = Yii::app()->user->id;
        $replace->CreateTime = time();
        $replace->UpdateTime = time();
        $replace->Status = 0;
        $success = $replace->save();
        return $success;
    }

    /*
     * 编辑时添加一条配件更换信息
     */

    public function editOneReplace($id, $part) {
        $replace = new ServiceParts();
        $replace->ServiceID = $id;
        $replace->OperateType = "1";
        $replace->PartName = $part['mainCategory_edit_replace'] . "," . $part['subCategory_edit_replace'] . "," . $part['leafCategory_edit_replace'];
        $replace->Brand = $part['replaceBrand'];
        $replace->Num = $part['replaceNum'];
        $replace->OE = $part['replaceOE'];
        $replace->UserID = Yii::app()->user->id;
        $replace->CreateTime = time();
        $replace->UpdateTime = time();
        $replace->Status = 0;
        $success = $replace->save();
        return $success;
    }

    /*
     * 添加配件维修信息
     */

    public function addRepair($id, $repairs, $part) {
        foreach ($repairs as $key => $value) {
            $repair = new ServiceParts();
            $rs = explode(',', $value);
            $repair->ServiceID = $id;
            $repair->OperateType = "2";
            $repair->PartName = $rs[0] . "," . $rs[1] . "," . $rs[2];
            $repair->Brand = $rs[3];
            $repair->TechnicianName = $part['TechnicianName'];
            $repair->RepairCause = $part['RepairCause'];
            $repair->RevisedNote = $part['RevisedNote'];
            $repair->UserID = Yii::app()->user->id;
            $repair->CreateTime = time();
            $repair->UpdateTime = time();
            $repair->Status = 0;
            $success = $repair->save();
        }
        return $success;
    }

    /*
     * 添加一条配件维修信息
     */

    public function addOneRepair($id, $part) {
        $repair = new ServiceParts();
        $repair->ServiceID = $id;
        $repair->OperateType = "2";
        $repair->PartName = $part['mainCategory_add_repair'] . "," . $part['subCategory_add_repair'] . "," . $part['leafCategory_add_repair'];
        $repair->Brand = $part['repair_brand'];
        $repair->TechnicianName = $part['TechnicianName'];
        $repair->RepairCause = $part['RepairCause'];
        $repair->RevisedNote = $part['RevisedNote'];
        $repair->UserID = Yii::app()->user->id;
        $repair->CreateTime = time();
        $repair->UpdateTime = time();
        $repair->Status = 0;
        $success = $repair->save();
        return $success;
    }

    /*
     * 编辑时添加一条配件维修信息
     */

    public function editOneRepair($id, $part) {
        $repair = new ServiceParts();
        $repair->ServiceID = $id;
        $repair->OperateType = "2";
        $repair->PartName = $part['mainCategory_edit_repair'] . "," . $part['subCategory_edit_repair'] . "," . $part['leafCategory_edit_repair'];
        $repair->Brand = $part['repairBrand'];
        $repair->TechnicianName = $part['TechnicianName'];
        $repair->RepairCause = $part['RepairCause'];
        $repair->RevisedNote = $part['RevisedNote'];
        $repair->UserID = Yii::app()->user->id;
        $repair->CreateTime = time();
        $repair->UpdateTime = time();
        $repair->Status = 0;
        $success = $repair->save();
        return $success;
    }

    /*
     * 编辑时添加配件服务记录
     */

    public function actionAddparts() {
        $id = Yii::app()->request->getParam("id");
        $partsCate = Yii::app()->request->getParam('partsCate');
        $partsCount = 0;
        for ($i = 0; $i <= count($partsCate); $i++) {
            $partsCount += $partsCate[$i];
        }
        if ($partsCount) {
            if ($partsCount == 1) {
                if ($_POST['partsreplace']) {
                    $replace_success = $this->addReplace($id, Yii::app()->request->getParam('partsreplace'));
                } else {
                    $replace_success = $this->editOneReplace($id, $_POST);
                }
            } else if ($partsCount == 2) {
                if ($_POST['partsrepair']) {
                    $repair_success = $this->addRepair($id, Yii::app()->request->getParam('partsrepair'), $_POST);
                } else {
                    $repair_success = $this->editOneRepair($id, $_POST);
                }
            } else {
                if ($_POST['partsreplace']) {
                    $replace_success = $this->addReplace($id, Yii::app()->request->getParam('partsreplace'));
                } else {
                    $replace_success = $this->editOneReplace($id, $_POST);
                }
                if ($_POST['partsrepair']) {
                    $repair_success = $this->addRepair($id, Yii::app()->request->getParam('partsrepair'), $_POST);
                } else {
                    $repair_success = $this->editOneRepair($id, $_POST);
                }
            }
        }
        //在日常保养类型下，添加服务记录则将记录类型改为日常保养+配件维修
        //ServiceRecord::model()->updateByPk($id, array("ServiceType" => '3'));
        if ($replace_success == '1' && $repair_success == '1') {
            $this->redirect(array('edit','id'=>$id));
        	//$result['success'] = '配件添加成功!';
        } elseif ($replace_success == '1') {
        	$this->redirect(array('edit','id'=>$id));
            //$result['success'] = '配件更换记录添加成功!';
        } elseif ($repair_success == '1') {
        	$this->redirect(array('edit','id'=>$id));
            //$result['success'] = '配件维修记录添加成功!';
        } elseif ($replace_success == '0' && $repair_success == '0') {
            $result['errorMsg'] = '系统异常，服务记录添加失败!';
        }
        $this->render('addparts', array('id'=>$id));
        //echo json_encode($result);
    }
    
    //删除服务记录
    public function actionDeleteservice(){
        if(Yii::app()->request->IsAjaxRequest){
            $id=Yii::app()->request->getParam('id');
            if($id){
               $result= ServiceRecord::model()->deleteByPK($id);
               echo $result;
            }
        }
    }
}