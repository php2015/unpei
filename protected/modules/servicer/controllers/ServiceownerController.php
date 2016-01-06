<?php

class ServiceownerController extends Controller {


	/*
	 * 表单验证
	 */
	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='ServiceCarOwner-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}
	
    /*
     * 渲染车主列表页面
     */

    public function actionIndex() {
    	$OrganID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        
        //表单提交查询
        $phone = Yii::app()->request->getParam('phone');
        $name = Yii::app()->request->getParam('name');
        if (!empty($phone)) {
            $criteria->addSearchCondition('t.Phone', "{$phone}", "AND");
        }
        if (!empty($name)) {
            $criteria->addSearchCondition('t.Name', "{$name}", "AND");
        }
        //$criteria->select = "t.ID as ID, t.CreateTime as CreateTime, t.Name as Name, car.LicensePlate as LicensePlate, t.Phone as Phone";
        //$criteria->join = " join jpd.jpd_service_car as car on t.id = car.OwnerID";
        $criteria->with = "car";
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = {$OrganID}", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
        
        $dataProvider=new CActiveDataProvider('ServiceCarOwner',
                array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                      'pageSize'=>'10'
                        ),
                ));
        
        $data = $dataProvider->getData();
        foreach ($data as $key => $val){
        	$LicensePlate = '';
        	foreach ($val['car'] as $k => $v){
        		$LicensePlate .= $v['LicensePlate'].',';
        	}
        	$val['car'] = substr($LicensePlate, 0, -1);
        }
        $this->render('index',array('dataProvider'=>$dataProvider, 'phone'=>$phone, 'name'=>$name));
    }
    
    /*
     * 添加、编辑车主信息
     */
    public function actionAddowner() {
        $OrganID = Yii::app()->user->getOrganID();
    	$id = Yii::app()->request->getParam("id");
    	if (!empty($id)) {
            $model = ServiceCarOwner::model()->findByPk($id);
            $str = "修改车主信息";
            //获取车主绑定车辆信息
            $cri = new CDbCriteria();
	        $cri->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
	        $cri->addCondition("t.OrganID = {$OrganID}");
	        $cri->addCondition("t.OwnerID = {$id}");
	        $cri->addCondition("t.Status = 0");
	        $dataProvider=new CActiveDataProvider('ServiceCar',
                array(
                    'criteria'=>$cri,
                    'pagination'=>array(
                      'pageSize'=>'5'
                        ),
                ));
                
	    	$data = $dataProvider->getData();
	        foreach ($data as $key => $val){
	        	$val['Car'] = str_replace(",", " ", $val['Car']);
		        if ($val['UseNature']==1){
                            $val['UseNature'] = "私家车";
                        }elseif ($val['UseNature']==2){
                            $val['UseNature'] = "公务车";
                        }elseif ($val['UseNature']==3){
                            $val['UseNature'] = "运营车";
                        }else{
                            $val['UseNature'] = "";
                        }
	        }
        } else {
    		$model = new ServiceCarOwner();
    		$str = "添加车主信息";
        }
        
        //获取未绑定车主的车辆信息
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = {$OrganID}");
        $criteria->addCondition("t.OwnerID IS NULL");
        $criteria->addCondition("t.Status = 0");
        $car = new CActiveDataProvider('ServiceCar',
                array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                      'pageSize'=>'5'
                        ),
                ));
                
    	$data = $car->getData();
	    foreach ($data as $key => $val){
	    	$val['Car'] = str_replace(",", " ", $val['Car']);
                if ($val['UseNature'] == 1) {
                    $val['UseNature'] = "私家车";
                } elseif ($val['UseNature'] == 2) {
                    $val['UseNature'] = "公务车";
                } elseif ($val['UseNature'] == 3) {
                    $val['UseNature'] = "运营车";
                } else {
                    $val['UseNature'] = "";
                }
        }
        //表单验证
    	$this->performAjaxValidation($model);
    	
    	//获取表单提交数据
        $ServiceCarOwner = Yii::app()->request->getParam("ServiceCarOwner");
        if (!empty($ServiceCarOwner)){
        	$model->attributes = $ServiceCarOwner;
        	$model->OrganID = Yii::app()->user->getOrganID();
        	if (empty($ServiceCarOwner->CreateTime)){
        		$model->CreateTime = time();
        	}
        	//绑定车辆
        	$carID = $this->getCarID(Yii::app()->request->getParam("LicensePlate"));
	        if (!empty($carID)){
	        	$carModel = ServiceCar::model()->updateByPk($carID[0],array(
	        		'OwnerID' => $id,
	        	));
	        }
        	//保存修改
        	if ($model->save()){
        		$this->redirect(Yii::app()->createUrl('/servicer/serviceowner/index'));
        	}
        }
    	$this->render('addowner',array('model'=>$model, 'str' => $str, 'car' => $car, 'dataProvider'=>$dataProvider));
    }

    /*
     * 删除车主信息
     */
    public function actionDelowner() {
    	$ID = Yii::app()->request->getParam("id");
        $success = ServiceCarOwner::model()->updateByPk($ID, array(
            'Status' => 1,
            'UpdateTime' => time()
                ));
        //判断返回值
    	if ($success) {
            $result = array('success' => 1, 'errorMsg' => '信息删除成功！');
        } else {
            $result = array('success' => 0, 'errorMsg' => '系统异常，车主信息删除失败！');
        }
        echo json_encode($result);
    }
    
    /*
     * 车主详情
     */
    public function actionDetail() {
    	$id = Yii::app()->request->getParam("id");
    	//车主详情
    	$owner = ServiceCarOwner::model()->findByPK($id);
    	if ($owner['Sex'] == 2){
    		$owner['Sex'] = '女';
    	}else {
    		$owner['Sex'] = '男';
    	}
    	if ($owner['DrivingEnvironment'] == 2){
    		$owner['DrivingEnvironment'] = '高速';
    	}elseif ($owner['DrivingEnvironment'] == 3){
    		$owner['DrivingEnvironment'] = '郊区';
    	}else {
    		$owner['DrivingEnvironment'] = '市区';
    	}

    	//拥有车辆详情
    	$dataProvider = new CActiveDataProvider('ServiceCar',
	    	array(
	    		'criteria' => array(
	    			'condition'=>'status=0 AND OwnerID = '.$id,
	    		),
	    		'pagination' => array(
	    			'pageSize' => '10',
	    		),
	    	)
    	);
    	$data = $dataProvider->getData();
    	foreach ($data as $val){
            $val['Car'] = str_replace(",", " ", $val['Car']);
            if ($val['UseNature'] == 1) {
                $val['UseNature'] = "私家车";
            } elseif ($val['UseNature'] == 2) {
                $val['UseNature'] = "公务车";
            } elseif ($val['UseNature'] == 3) {
                $val['UseNature'] = "运营车";
            } else {
                $val['UseNature'] = "";
            }
        }
    	$this->render('detail',array(
    		'owner' => $owner,
    		'dataProvider' => $dataProvider
    	));
    }
    
	/*
     * 解除车辆绑定
     */
    public function actionDelcar() {
        $ID = Yii::app()->request->getParam("id");
        $success = ServiceCar::model()->updateByPk($ID, array(
            'OwnerID' => NULL,
            'UpdateTime' => time()
                ));
        //判断返回值
        if ($success) {
            $result = array('success' => 1, 'errorMsg' => '接触绑定成功！');
        } else {
            $result = array('success' => 0, 'errorMsg' => '系统异常，车主信息删除失败！');
        }
        echo json_encode($result);
    }

    /*
     * 通过车牌号获取车辆ID
     */

    public function getCarID($licenseplate) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.LicensePlate = '{$licenseplate}'", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
        $model = ServiceCar::model()->findAll($criteria);
        $data = array();
        foreach ($model as $key => $value) {
            if (!in_array($value['ID'], $data)) {
                $data[] = $value['ID'];
            }
        }
        return $data;
    }
}