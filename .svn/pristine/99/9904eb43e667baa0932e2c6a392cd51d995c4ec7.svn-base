<?php

class JpdataModule extends CWebModule
{
	private $_assetsUrl;
	
	/**
	 * @var string
	 * @desc 数据库组件名称
	 */
	public $db = "jpdb";
	
	//public $defaultController = "parts";
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'jpdata.models.*',
			'jpdata.components.*',
			'jpdata.services.*',
			'dealer.models.DealerGoods',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	/*
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.jpdata.assets'));
		return$this->_assetsUrl;
	}
	
	public function setAssetsUrl($value)
	{
		$this->_assetsUrl=$value;
	}
	*/
}
