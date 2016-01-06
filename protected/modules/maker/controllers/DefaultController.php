<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/main';
	private $search = array();
	public function actionIndex()
	{
//		$user_id=OrderCommonForm::getuserID();
//		$seaCon="t.maker_id = {$user_id} and t.status=20 and t.if_abnormal=0";
//		$criteria = new CDbCriteria();
//		$criteria->condition = $seaCon;
//		$model=DealerOrder::model()->findAll($criteria);
//		$delcount = count($model);
//		$seaCon="t.seller_id = {$user_id} and order.status=30 and t.abn_status=0 and t.status=10";
//		$criteria = new CDbCriteria();
//		$criteria->condition = $seaCon;
//		$model=DealerBatchCheck::model()->with('order')->findAll($criteria);
//		$regcount = count($model);
//		$seaCon="t.seller_id = {$user_id} and t.abn_status in(10,20) and t.status!=70";
//		$criteria = new CDbCriteria();
//		$criteria->condition = $seaCon;
//		$model=DealerBatchCheck::model()->with('order')->findAll($criteria);
//		$abncount = count($model);
		$this->render('index',array('delcount'=>$delcount,'regcount'=>$regcount,'abncount'=>$abncount));
	}
}