<?php

class DefaultController extends Controller
{
	public $layout = '//layouts/jpdata';
	
	public function actionIndex()
	{
		$this->redirect(array('parts/'));
	}
}