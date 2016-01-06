<?php

class ServicevehicleController extends Controller {


    /*
     * 渲染车辆列表页面
     */

    public function actionIndex() {
    	$OrganID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->with = "owner";
        
		$arr['name'] = Yii::app()->request->getParam("Name");
		$arr['phone'] = Yii::app()->request->getParam("Phone");
		$arr['licenseplate'] = Yii::app()->request->getParam("LicensePlate");
		$arr['car'] = Yii::app()->request->getParam("Car");
		$arr['mileage'] = Yii::app()->request->getParam("Mileage");
		$arr['drivinglicense'] = Yii::app()->request->getParam("DrivingLicense");
		$arr['vehiclelicense'] = Yii::app()->request->getParam("VehicleLicense");
		$arr['buytime'] = Yii::app()->request->getParam("BuyTime");
		$arr['usenature'] = Yii::app()->request->getParam("UseNature");
		$arr['vincode'] = Yii::app()->request->getParam("VinCode");
        if (!empty($arr['name'])) {// 车主姓名
            $criteria->addSearchCondition('Name', "{$arr['name']}", "AND");
        }
        if (!empty($arr['phone'])) {//手 机 号
            $criteria->addSearchCondition('Phone', "{$arr['phone']}", "AND");
        }
        if (!empty($arr['licenseplate'])) {//车 牌 号
            $criteria->addSearchCondition('t.LicensePlate', "{$arr['licenseplate']}", "AND");
        }
        if (!empty($arr['car'])) {//汽车品牌
            $car = "";
            $car_arr = explode(" ", $arr['car']);
            foreach ($car_arr as $val){
                if($val === "不确定年款" || $val === "不确定车型"){
                    continue;
                }
                $car .= $val." ";
            }
            $car = rtrim($car, " ");
            $criteria->addSearchCondition('Car', "{$car}", "AND");
        }
        if (!empty($arr['mileage'])){//行驶里程
        	 $criteria->addSearchCondition('t.Mileage', "{$arr['mileage']}", "AND");
        }
        if (!empty($arr['vehiclelicense'])) {//行驶证号
            $criteria->addSearchCondition('t.VehicleLicense', "{$arr['vehiclelicense']}", "AND");
        }
        if (!empty($arr['buytime'])) {//购置时间
            $starttime = strtotime($arr['buytime']);
            $endtime = (int) (strtotime($arr['buytime']) + 60 * 60 * 24);
            $criteria->addBetweenCondition('t.BuyTime', $starttime, $endtime, "AND");
        }
        if (!empty($arr['usenature'])) {//使用性质
            $criteria->addSearchCondition('t.UseNature', "{$arr['usenature']}", "AND");
        }
        if (!empty($arr['vincode'])) {//车架/VIN码(前10位)
        	$criteria->addSearchCondition('t.VinCode', "{$arr['vincode']}", "AND");
        }
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = {$OrganID}");
        $criteria->addCondition("t.Status = 0");
        $dataProvider=new CActiveDataProvider('ServiceCar',
                array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                      'pageSize'=>'10'
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
        //var_dump($data);die;
        $this->render('index',array('dataProvider'=>$dataProvider, 'arr'=>$arr));
    }

	/*
	 * 表单验证
	 */
	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='ServiceCar-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}
	
    /*
     * 添加、编辑车辆信息
     */
    public function actionAddcar(){
    	//var_dump($model->errors);die;
    	$id = Yii::app()->request->getParam("id");
    	if (!empty($id)) {
            $model = ServiceCar::model()->findByPk($id);
            $model['BuyTime'] = date("Y-m-d",$model['BuyTime']);
            $model['Car'] = str_replace(",", " ", $model['Car']);
            $str = "编辑车辆信息";
        } else {
    		$model = new ServiceCar();
    		$str = "添加车辆信息";
        }
        $this->performAjaxValidation($model);
        
        //var_dump($_POST);die;
        $ServiceCar = Yii::app()->request->getParam('ServiceCar');
        //var_dump($ServiceCar);die;
        if (!empty($ServiceCar)){
        	$name = Yii::app()->request->getParam('Name');
        	if (!empty($name)){
        		$ownerID = $this->getOwnerID($name);
        		//var_dump($ownerID);die;
        		$model->OwnerID = $ownerID[0];
        	}
        	$ServiceCar['CreateTime'] = $ServiceCar['CreateTime']?$ServiceCar['CreateTime']:time();
        	$model->attributes = $ServiceCar;
        	$model->BuyTime = $ServiceCar['BuyTime']?strtotime($ServiceCar['BuyTime']):'';
        	$model->OrganID = Yii::app()->user->getOrganID();

	        if ($model->save()){
	        	$this->redirect(Yii::app()->createUrl('servicer/servicevehicle/index'));
	        }
	        var_dump($model->errors);
        }
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.OrganID = ".Yii::app()->user->getOrganID());
        $criteria->addCondition("t.Status = 0");
        $dataProvider = new CActiveDataProvider('ServiceCarOwner',
                array(
                	'criteria'=>$criteria,
                    'pagination'=>array(
                      'pageSize'=>'5'
                        ),
                ));
        $data = $dataProvider->getData();
        foreach ($data as $key => $val){
        	if ($val['DrivingEnvironment']==1){
        		$val['DrivingEnvironment'] = "市区";
        	}elseif ($val['DrivingEnvironment']==2){
        		$val['DrivingEnvironment'] = "高速";
        	}elseif ($val['DrivingEnvironment']==3){
        		$val['DrivingEnvironment'] = "郊区";
        	}
        }
        $this->render('addcar',array('model'=>$model, 'str'=>$str, 'dataProvider'=>$dataProvider));
    }
    
	/*
     * 通过车主姓名获取车主ID
     */

    public function getOwnerID($name) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.Name = '{$name}'", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
        $model = ServiceCarOwner::model()->findAll($criteria);
        $data = array();
        foreach ($model as $key => $value) {
            if (!in_array($value['ID'], $data)) {
                $data[] = $value['ID'];
            }
        }
        //var_dump($modle->errors);die;
        return $data;
    }
    
	/*
     * 删除车辆信息
     */
    public function actionDelcar() {
    	$ID = Yii::app()->request->getParam("id");
        $success = ServiceCar::model()->updateByPk($ID, array(
            'Status' => 1,
            'UpdateTime' => time()
                ));
        //判断返回值
    	if ($success) {
            $result = array('success' => 1, 'errorMsg' => '信息删除成功！');
        } else {
            $result = array('success' => 0, 'errorMsg' => '系统异常，车辆信息删除失败！');
        }
        echo json_encode($result);
    }
    
	/*
     * 车主详情
     */
    public function actionDetail() {
    	$id = Yii::app()->request->getParam("id");
    	
    	//车辆详情
    	$car = ServiceCar::model()->findByPK($id);
    	if ($car['UseNature'] == 1) {
            $car['UseNature'] = "私家车";
        } elseif ($car['UseNature'] == 2) {
            $car['UseNature'] = "公务车";
        } elseif ($car['UseNature'] == 3) {
            $car['UseNature'] = "运营车";
        } else {
            $car['UseNature'] = "";
        }
        if ($car['Relation'] == 1) {
            $car['Relation'] = "长期";
        } elseif ($car['Relation'] == 2) {
            $car['Relation'] = "暂时";
        } else {
            $car['Relation'] = "";
        }
        $car['PartsLevel'] = Yii::app()->params['PartsLevel'][$car['PartsLevel']];
        $car['Car'] = str_replace(",", "", $car['Car']);

        //车主详情
    	$owner = ServiceCarOwner::model()->findByPK($car->OwnerID);
    	//判断是否为空   （可能未选车主）
    	if (!empty($owner)){
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
    	}
    	
    	$this->render('detail',array(
    		'owner' => $owner,
    		'car' => $car
    	));
    }

}