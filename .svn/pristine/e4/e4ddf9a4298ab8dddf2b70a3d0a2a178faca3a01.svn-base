<?php

/**
 * AuthFilter class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package auth.components
 */

/**
 * Filter that automatically checks if the user has access to the current controller action.
 */
class AuthFilter extends CFilter {

    /**
     * @var array name-value pairs that would be passed to business rules associated
     * with the tasks and roles assigned to the user.
     */
    public $params = array();

    /**
     * Performs the pre-action filtering.
     * @param CFilterChain $filterChain the filter chain that the filter is on.
     * @return boolean whether the filtering process should continue and the action should be executed.
     * @throws CHttpException if the user is denied access.
     */
    protected function preFilter($filterChain) {
        $itemName = '';
        $controller = $filterChain->controller;

        /* @var $user CWebUser */
        $user = Yii::app()->getUser();

        // 是否登录
        if ($user->isGuest)
        $user->loginRequired();
    //    $kaiying = AdminUser::model()->find('LOWER(username)=?', array(strtolower('kaiying')));
        $name=Yii::app()->user->name;
        if ( $name=='kaiying') {
            $route = Yii::app()->getController()->getRoute();
            if (in_array($route, array('admin/admin', 'admin/create', 'admin/view','admin/update','admin/Dynamiccities',
                'admin/Dynamicdistrict','admin/Dynamicarea','admin/dynamicdistrict')))
                return true;
            else {
                return false;
            }
        }
        return true;

//        // Module
//        if (($module = $controller->getModule()) !== null) {
//        	$itemName .= $module->getId() . '.';
//        	if ($user->checkAccess($itemName . '*')) {
//        		return true;
//        	}
//        }
//
        // Controller
//        $itemName .= $controller->getId();
//        if ($user->checkAccess($itemName . '.*')){
//            return true;
//        }
//		
//        // Action
//        $itemName .= '.' . $controller->action->getId();
//        if ($user->checkAccess($itemName, $this->params)){
//            return true;
//        }
//        
//        throw new CHttpException(401, 'Access denied.');
    }

}
