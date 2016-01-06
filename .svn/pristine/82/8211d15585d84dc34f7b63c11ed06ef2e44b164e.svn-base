<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	public $layout='//layouts/user';
	
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','view','Dynamiccities','Dynamicdistrict',
					
				'Dynamicarea'	,'Deleteall','Freeze','unfreeze','black','blacklist','Deleteblack','Delallblack',
				'Importoutexcel'
				),
//				'users'=>UserModule::getAdmins(),
                'users' => array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$page=isset($_GET['User_page'])? $_GET['User_page']:1;
		Yii::app()->session['user']=$_GET['User'];
		$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];
        $this->render('index',array(
            'model'=>$model,
        ));
		/*$dataProvider=new CActiveDataProvider('User', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));//*/
	}


	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$id=intval($_GET['id']);
		$model = $this->loadModel();
		
		$profile=Profile::model()->findByPk($id);
		$this->render('view',array(
			'model'=>$model,
			'profile'=>$profile
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			//用户名
			$model->username=$_POST['User']['username'];
			//邮箱
			$model->email=$_POST['User']['email'];
			//机构类型
			$model->identity=$_POST['User']['identity'];
			//是否为超级用户 默认0不是
			$model->superuser=$_POST['User']['superuser'];
			//是否激活 默认已经激活
			$model->status=$_POST['User']['status'];
			$model->create_at=date('Y-m-d H:i:s',time());
			$profile->attributes=$_POST['Profile'];
			$profile->state=$_POST['Profile']['Province'];
			$profile->city=$_POST['Profile']['City'];
			$profile->district=$_POST['Profile']['Area'];
			$profile->UserType=$_POST['Profile']['usertype'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				$model->verifyPassword=Yii::app()->controller->module->encrypting($model->verifyPassword);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();
				}
			$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$id=intval($_GET['id']);
		//$model=User::model()->findByPk($id);
	//	$profile=Profile::model()->findByPk($id);
		$model=$this->loadModel();
		$profile=$model->profile;
		$profile->usertype=$profile->UserType;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('update',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			// Make sure profile exists
			if ($profile)
			{
				Profile::model()->updateByPk($model->id,array('Status'=>'1')); 
			}
			//$profile->delete();
			//$model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
		public function actionDynamiccities() {
		//echo CHtml::tag("option", array("value" => ''), '请选择城市', true);
        if ($_GET['province']){
	        $data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $_GET['province']));
	
	        $data = CHtml::listData($data, "id", "name");
	       
	        foreach ($data as $value => $name) {
	            echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
	        }
        }
        if(empty($_GET['province']))
        {
        	echo CHtml::tag("option", array("value" => ''), '请选择城市', true);
        }
        
    }

    public function actionDynamicdistrict() {
    	//echo CHtml::tag("option", array("value" => ''), '请选择地区', true);
        if ($_GET["city"]) {
            $data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $_GET["city"]));

            $data = CHtml::listData($data, "id", "name");
           
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
        if(emtpy($_GET["city"]))
        {
        	echo CHtml::tag("option", array("value" => ''), '请选择地区', true);
        }
    }
		public function actionDynamicarea() {
        if ($_GET["province"]) {
            $city = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $_GET["province"]));
            foreach ($city as $ci) {
                $data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $ci->id));
                $data = CHtml::listData($data, "id", "name");
                break;
            }
            echo json_encode($data);
        }
    }
    //批量删除
    public function actionDeleteall()
    {
    	if(Yii::app()->request->isPostReQuest)
    	{
			  $sql="update tbl_profiles set Status=1 where user_id in($_POST[data])";
			  $result=Yii::app()->db->createCommand($sql)->execute();
			  if($result)
			  {
			  	Yii::app()->user->setFlash('success','删除成功');
			  }
              echo json_encode($result);
    	}
    	else
    	{
    		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    	}
    }
    //冻结
    public function actionFreeze()
    {
    	if(Yii::app()->request->isPostReQuest)
    	{
    		  $sql="update tbl_profiles set freeze=1,freezeremark='$_POST[remark]' where user_id in($_POST[data])";
			  $result=Yii::app()->db->createCommand($sql)->execute();
    	  	  echo json_encode($result);
    	}
    	else
    	{
    		throw new CHttpException(400,'请求无效,请重新发送请求');
    	}
    }
    //解冻
    public function actionUnfreeze()
    {
    	if(Yii::app()->request->isPostReQuest)
    	{
    		$sql="update tbl_profiles set freeze=0 where user_id in($_POST[data])";
    		$result=Yii::app()->db->createCommand($sql)->execute();
    		echo json_encode($result);
    	}
    	else
    	{
    		throw new CHttpException(400,'请求无效,请重新发送请求');
    	}
    }
    //加入黑名单
    public function actionBlack()
    {
    	if(Yii::app()->request->isPostReQuest)
    	{
    		$sql="update tbl_profiles set isblack=1 where user_id in($_POST[data])";
    		$result=Yii::app()->db->createCommand($sql)->execute();
    		echo json_encode($result);
    	}
    	else
    	{
    		throw new CHttpException(400,'请求无效,请重新发送请求');
    	}
    }
    //黑名单列表
    public function actionBlacklist()
    {
    	$model =new User();
    	$model->unsetAttributes();
    	$this->render('black',array('model'=>$model));
    }
    //移除黑名单
    public function actionDeleteblack()
    {
    	$id=isset($_GET['id'])?$_GET['id']:null;
    	if($id)
    	{
	    	$result=Profile::model()->updateByPk($id,array('isblack'=>'0'));
// 	       	$this->redirect(array('/user/admin/blacklist'));
           if($result)
           {
         	 $this->redirect(array('/user/admin/blacklist'));
           }
	    	
    	}else 
    	{
    		throw new CHttpException(400,'请求无效,请重新发送请求');
    	}
    }
    //移除所有的黑名单
    public function actionDelallblack()
    {
    	if(Yii::app()->request->isPostReQuest)
    	{
    		$sql="update tbl_profiles set isblack=0 where user_id in($_POST[data])";
    		$result=Yii::app()->db->createCommand($sql)->execute();
    		echo json_encode($result);
    	}
    	else
    	{
    		throw new CHttpException(400,'请求无效,请重新发送请求');
    	}
    }
    //Excel导出
    public function actionImportoutexcel()
    {
    	$objectPHPExcel = new PHPExcel();
    	$objectPHPExcel->setActiveSheetIndex(0);
    	//当期查询出的数据
    	//$page = isset($_GET['User_page']) ? intval($_GET['User_page']) : 1;
    	$page=Yii::app()->session['page'];
    	$user=Yii::app()->session['user'];
    	$username=isset($user['username'])?trim($user['username']):null;
    	$email=isset($user['email'])?trim($user['email']):null;
    	$identity=isset($user['identity'])?$user['identity']:null;
    	$phone=isset($user['phone'])?trim($user['phone']):null;
    	$freeze=isset($user['freeze'])?trim($user['freeze']):null;
    	$state=isset($user['Province'])?trim($user['Province']):null;
    	$city=isset($user['City'])?trim($user['City']):null;
    	$district=isset($user['Area'])?trim($user['Area']):null;
    	$page_size = 10;
    	$sql="select a.username,a.email,a.identity,a.create_at,b.truename,
    		  b.phone,b.usertype,b.freeze
    		 from tbl_user a,tbl_profiles b where b.user_id=a.id and b.Status=0 and b.isblack=0";
    	if($username)
    	{
    		$sql.=" and a.username like '%$username%'";
    	}
    	if($email)
    	{
    		$sql.=" and a.email like '%$email%'";
    	}
    	if($identity)
    	{
    		$sql.=" and a.identity='$identity'";
    	}
    	if($phone)
    	{
    		$sql.=" and b.phone like '%$phone%'";
    	}
    	if($freeze)
    	{
    		$sql.=" and b.freeze ='$freeze'";
    	}
    	if($state)
    	{
    		$sql.=" and b.state='$state' and b.city='$city' and b.district='$district' ";
    		
    	}
    	$sql.=" order by create_at desc";
    	$model=Yii::app()->db->CreateCommand($sql)->queryAll();
    	$count=count($model);
    	$pages = new CPagination(count($model));
    	$pages->pageSize = 10;
    	$pages->setCurrentPage($page-1);
    	//$pages->applylimit($criteria);
    	
    	$model=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
    	$model->bindValue(':offset', $pages->currentPage*$pages->pageSize);
    	$model->bindValue(':limit', $pages->pageSize);
    	$model=$model->queryAll();
    	$page_count = (int)($count/$page_size) +1;
    	 
    		$n = 0;
    		foreach ($model as $list )
    		{
    			if ( $n % $page_size === 0 )
    			{
    			//报表头的输出
    			$objectPHPExcel->getActiveSheet()->mergeCells('B1:G1');
    			$objectPHPExcel->getActiveSheet()->setCellValue('B1','会员信息表');
    
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','会员信息表');
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','会员信息表');
    			$objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
    			$objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
    			->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','日期：'.date("Y年m月j日"));
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E2','第'.$page.'/'.$page_count.'页');
    			$objectPHPExcel->setActiveSheetIndex(0)->getStyle('E2')
    			->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    
    			//表格头的输出
    				
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3','用户名称');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3','创建时间');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3','邮箱');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3','机构');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F3','真实姓名');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(22);
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G3','会员类型');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(22);
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('H3','手机号');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
    			$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('I3','是否冻结');
    			$objectPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
    			$objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(32);
    			//设置居中
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
    			->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    			//设置边框
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
    			->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    
    			//设置颜色
    			$objectPHPExcel->getActiveSheet()->getStyle('B3:I3')->getFill()
    			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF66CCCC');
    		}
    		//明细的输出
    		$objectPHPExcel->getActiveSheet()->setCellValue('B'.($n+4) ,$list['username']);
    		$objectPHPExcel->getActiveSheet()->setCellValue('C'.($n+4) ,$list['create_at']);
    		$objectPHPExcel->getActiveSheet()->setCellValue('D'.($n+4) ,$list['email']);
    		switch ($list['identity'])
    		{
    		  case 1:
    		   $objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+4) ,'生产商');
    		   break;
    		  case 2:
    		  	$objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+4) ,'经销商');
    		  	break;
    		  case 3:
    		  	$objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+4) ,'修理厂');
    		  	break;
    		}
    		$objectPHPExcel->getActiveSheet()->setCellValue('F'.($n+4) ,$list['truename']);
    		switch ($list['usertype'])
    		{
    			case 0:
    				$objectPHPExcel->getActiveSheet()->setCellValue('G'.($n+4) ,'非会员');
    				break;
    			case 1:
    				$objectPHPExcel->getActiveSheet()->setCellValue('G'.($n+4) ,'试用会员');
    				break;
    			case 2:
    				$objectPHPExcel->getActiveSheet()->setCellValue('G'.($n+4) ,'正式会员');
    				break;
    		}
    		
    		$objectPHPExcel->getActiveSheet()->setCellValue('H'.($n+4) ,$list['phone']);
    		switch ($list['freeze'])
    		{
    			case 0:
	    			$objectPHPExcel->getActiveSheet()->setCellValue('I'.($n+4) ,'未冻结');
	    			break;
    			case 1:
    			    $objectPHPExcel->getActiveSheet()->setCellValue('I'.($n+4) ,'已冻结');
    				break;
    		}
    		
    		//设置边框
    		$currentRowNum = $n+4;
    		$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
    		->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
    		->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
    		->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
    		->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
    		->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$n = $n +1;
    
    
    		//设置分页显示
    		$objectPHPExcel->getActiveSheet()->setBreak( 'I55' , PHPExcel_Worksheet::BREAK_ROW );
    		$objectPHPExcel->getActiveSheet()->setBreak( 'I10' , PHPExcel_Worksheet::BREAK_COLUMN );
    		//$objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
    		//$objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
    
    		ob_end_clean();
    		ob_start();
    		}
    		header('Content-Type : application/vnd.ms-excel');
    		header('Content-Disposition:attachment;filename="'.'会员信息表-'.date("Y-m-d").'.xls"');
    		$objWriter= PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
    		$objWriter->save('php://output');
    	}
}
