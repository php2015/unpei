<?php

class LogoutController extends Controller
{
	public $defaultAction = 'logout';

	public function filters()
	{
		return array(
		);
	}
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionLogout()
	{
                $sql = 'update `jpd_user` set Online=0 where ID=' . Yii::app()->user->id;
                $res= Yii::app()->jpdb->createCommand($sql)->execute();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->controller->module->returnLogoutUrl);
	}

}