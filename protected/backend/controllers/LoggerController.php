<?php

class LoggerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/system';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$line = Yii::app()->request->getParam("line");
		if(!$line){
			$line = 100;
		}
		$frontRuntimePath = Yii::app()->basepath.DIRECTORY_SEPARATOR.'..'
			.DIRECTORY_SEPARATOR.'runtime'.DIRECTORY_SEPARATOR.'front'.DIRECTORY_SEPARATOR;
		$logs = array('front'=>$frontRuntimePath.'application.log',
			'business'=>$frontRuntimePath.'business.log',
			'crons'=>$frontRuntimePath.'crons.log',
			'command'=>$frontRuntimePath.'command.log',
			'php_error'=>$frontRuntimePath.'php_error.log',
			'alipay_notify'=>$frontRuntimePath.'alipay'.DIRECTORY_SEPARATOR.'notify_'. date("Ym") . ".log",
			'alipay_return'=>$frontRuntimePath.'alipay'.DIRECTORY_SEPARATOR.'return_'. date("Ym") . ".log",
			'alipay_send'=>$frontRuntimePath.'alipay'.DIRECTORY_SEPARATOR.'send_'. date("Ym") . ".log",
			);
				
		$this->render('index',array('logs'=>$logs,'line'=>$line));
	}

}
