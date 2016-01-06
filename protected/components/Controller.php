<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
        public $workPage = true;
        
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function filters()
	{
		return array(
			//'accessControl',
			array(
				'application.filters.AuthFilter',
			),
// 			array(
// 				'application.filters.LogFilter',
// 			)
		);
	}
	
//	public function init() {
// 		$behaviors = array(
// 			'menu' => array(
// 				'class'=>'application.components.MenuBehavior',
// 			),
// 		);
// 		$this->attachBehaviors($behaviors);
//	}
}