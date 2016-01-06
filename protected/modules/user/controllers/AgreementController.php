<?php

class AgreementController extends Controller
{
	public $defaultAction = 'agreement';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'foreColor'=> 0xdd7a36,
				'backColor' => 0xfbfbfb,//背景颜色
				'minLength' => 4,  		//最短为4位
				'maxLength' => 4,   	//是长为4位
				//'width' => 70, 		//图片宽度
				//'height' => 30, 		//图片高度
				'offset' => 2, 			//字符间偏移量。默认是-2
				'padding' => 2, 		//文字周边填充大小。默认为2
				//'testLimit' => 1,   	//验证码失效次数,默认是3次
			),
		);
	}

	public function filters()
	{
		return array(
		);
	}
	
	/**
	 * Registration user
	 */
	public function actionAgreement() {
            $this->pageTitle=Yii::app()->name.'-会员协议';
            $this->layout=false;
            //$this->layout='//layouts/login';
               // $this->redirect(Yii::app()->controller->module->returnUrl);
		//用户是否同意协议信息
		$agreement = $_GET['agreement'];
		if($agreement == 'yes'){
			$this->redirect(array('/user/activation/index'));
		}else if($agreement == 'no'){
			$this->redirect(array('/user/logout'));
		}else{
			$this->render('/user/agreement');
		}
	}
}