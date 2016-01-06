<?php

class ServicerModule extends CWebModule
{
	public $layouts = '//layouts/column1';
	public $db='jpdb';
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'servicer.models.*',
			'servicer.components.*',
			'servicer.services.*',
                        'maker.models.MakePartsGroupFather',
                        'pap.models.*',
                        'user.models.*'
                        
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
}
