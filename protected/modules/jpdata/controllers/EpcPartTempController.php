<?php

class EpcPartTempController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/jpdata';

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// 查询epc信息
// 		$partId = Yii::app()->request->getParam('ep_pt');
// 		$groupId = Yii::app()->request->getParam('ep_gp');
// 		$epcInfo = $this->_queryEpcInfo($partId,$groupId);
		
// 		$partInfo = $epcInfo['epcPart'];
		// 显示页面
		$model = new EpcPartTemp('create');
// 		$model->attributes = $partInfo;
//		$this->render('index',array_merge(array('model'=>$model),$epcInfo));
		$this->render('index',array('model'=>$model));
	}
	
	private function _queryEpcInfo($partId, $groupId) 
	{
		// 获取epc配件信息
		$partInfo = array();
		if($partId) {
			$partInfo = RPCClient::call('PartsService_queryPartInfo',array('partId'=>$partId));
		}
		// 获取epc配件组信息
		if($partInfo && $partInfo['groupId']) {
			$groupId = $partInfo['groupId'];
		} 
		$groupInfo = array();
		if($groupId) {
			$groupInfo = RPCClient::call('PartsService_queryGroupInfo',array('groupId'=>$groupId));
		}
		// 获取epc车型信息
		$modelId = "";
		if($groupInfo && $groupInfo['modelId']) {
			$modelId = $groupInfo['modelId'];
		}
		$modelInfo = array();
		if($modelId) {
			$modelInfo = RPCClient::call('VehicleService_queryEpcModelInfo',array('modelId'=>$modelId));
		}	
		return array('epcModel'=>$modelInfo,'epcGroup'=>$groupInfo,'epcPart'=>$partInfo);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionList()
	{
		$criteria = new CDbCriteria();
		//$criteria->index = "id";
		$criteria->order = "id desc";
		$count = EpcPartTemp::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize = $_GET['rows'];
		$pages->applyLimit($criteria);
		//EpcPartTemp::model()->scenario='list';
		$models = EpcPartTemp::model()->findAll($criteria);
		// 转换成数组
		$rows = array();
		foreach ($models as $model) {
			$rows[] = $model->attributes;
		}
		$rs = array('total'=>$count,'rows'=>$rows);
		echo CJSON::encode($rs);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function _actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
// 		var_dump($_POST);die;
		$model=new EpcPartTemp('create');
		$action = 'epc/part';
		$isPost = false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$EpcPartTemp=Yii::app()->request->getparam('EpcPartTemp');
                $EpcPartTempedit=Yii::app()->request->getparam('EpcPartTempedit');
// 		var_dump($EpcPartTemp);die;
		if(isset($EpcPartTemp))
		{
                        $url=$_POST['purl'];
			$isPost = true;
			$model->attributes = $EpcPartTemp;
			$model->ModelID = $EpcPartTemp['modelId'];
			$model->GroupIG = $EpcPartTemp['groupId'];
			$model->MainGroupID = $EpcPartTemp['mainGroupId'];
                        $model->OrganId=Yii::app()->user->getOrganID();
                        $model->UserId=Yii::app()->user->id;
                        $model->CreateTime=time();
                        $model->UpdateTime=time();
                        if($EpcPartTemp['mainGroupId']===null){
                            $model->MainGroupID = $EpcPartTempedit['mainGroupId'];
                            $model->ModelID = $EpcPartTempedit['modelId'];
                            $model->GroupIG = $EpcPartTempedit['groupId'];
                        }
				$imageUploadFile = CUploadedFile::getInstance($model, 'picture');
				if ($imageUploadFile !== null) { // only do if file is really uploaded
					$imageFileExt = $imageUploadFile->extensionName;
				
					$save_path = dirname(Yii::app()->basePath) . '/upload/' . $action . '/';
					if (!file_exists($save_path)) {
						mkdir($save_path, 0777, true);
					}
					$ymd = date("Ymd");
					$save_path .= $ymd . '/';
					if (!file_exists($save_path)) {
						mkdir($save_path, 0777, true);
					}
					$img_prefix = date("YmdHis") . '_' . rand(10000, 99999);
					$imageFileName = $img_prefix . '.' . $imageFileExt;
					$model->picture = $imageFileName;
					$model->picturePath = 'upload/' . $action . '/'.$ymd;
					$save_path .= $imageFileName;
				}
				// 获取epc车型信息
				$modelId = $model->ModelID;
				$modelInfo = RPCClient::call('VehicleService_queryEpcModelInfo',array('ModelID'=>$modelId));
				if($modelInfo){
					$model->ModelName = $modelInfo['ModelName'];
				}
				// 获取主组信息
				$mainGroupId = $model->MainGroupID;
				$mainGroupInfo = RPCClient::call('PartsService_queryGroupInfo',array('GroupIG'=>$mainGroupId));
				if($mainGroupInfo){
					$model->MainGroupName = $mainGroupInfo['Name'];
				}
// 		 		var_dump($model->attributes);die;
				// 获取子组信息
				$groupId = $model->GroupIG;
				$groupInfo = RPCClient::call('PartsService_queryGroupInfo',array('GroupIG'=>$groupId));
				if($groupInfo){
					$model->GroupName = $groupInfo['Name'];
				}
				if ($model->save()) {
					if ($imageUploadFile !== null) { // validate to save file
						$imageUploadFile->saveAs($save_path);
					}
					//Yii::app()->user->setFlash('success', "提交成功");
                                        echo 'success';
					//header("location:".$purl);
					Yii::app()->end();
				
					}
				
			}
// 		}
		
		// 获取参数		
		if($isPost){
			$partId = $model->PartID;
			$groupId = $model->GroupIG;
		}else{
			$partId = Yii::app()->request->getParam('ep_pt');
			$groupId = Yii::app()->request->getParam('ep_gp');
		}
	
		// 查询epc信息
		$epcInfo = $this->_queryEpcInfo($partId,$groupId);
		// 初始赋值
		if(!$isPost && $epcInfo && $epcInfo['epcPart']) {
			//$model->attributes = $epcInfo['epcPart'];
                        $parts=$epcInfo['epcPart'];
                        //var_dump($model->attributes);die;
                        $model->PartID=$parts['partId'];
                        $model->Name=$parts['name'];
                        $model->Oeno=$parts['oeno'];
                        $model->Amount=$parts['amount'];
                        //$model->Name=$parts['jpno'];
                        $model->Price=$parts['price'];
                        $model->PicturePath=$parts['picture'];
                        $model->MarkNo=$parts['markNo'];
                        $model->Note=$parts['note'];
                        $model->Specification=$parts['specification'];
                        $model->Beginyear=$parts['beginyear'];
                        $model->Endyear=$parts['endyear'];
                        $model->ApplicableModel=$parts['applicableModel'];
                        $model->MainGroupID=$parts['groupId'];
		}
		//Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		//Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
                $action=array();
                if(Yii::app()->request->getParam('ep_pt')){
                    $action=array('action'=>'edit');
                }
                $this->renderPartial('_form',array_merge(
			array(
				'model'=>$model,
				'action'=>Yii::app()->createUrl('jpdata/epcPartTemp/create'),
			),
			$epcInfo,$action),false,false);
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function _actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EpcPartTemp']))
		{
			$model->attributes=$_POST['EpcPartTemp'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function _actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function _actionAdmin()
	{
		$model=new EpcPartTemp('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EpcPartTemp']))
			$model->attributes=$_GET['EpcPartTemp'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=EpcPartTemp::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='epc-part-temp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
