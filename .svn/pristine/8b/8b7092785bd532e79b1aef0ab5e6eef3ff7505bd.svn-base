<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSidebarDealer extends CWidget {

    public $menuId = "";
    
    public function init() {
    	$controllerID = trim(Yii::app()->controller->id);    
        $actionID = trim(Yii::app()->controller->action->id);
    	$controlerId = strtolower(trim($controlerId));
        $actionID = strtolower(trim($actionID));
		if($controllerID == "order" || $controllerID == 'myaddress')
		{
			$this->menuId = F::sg('menu','dealerOrderMenu');
			
		}
        else if ($controllerID == "sell")
		{
			$this->menuId  = F::sg('menu','dealerSellMenu');	//销售管理
		}else if ($controllerID == "makequery")
		{
			$this->menuId  = F::sg('menu','dealermakequeryMenu');	//商家查询
		}else if (in_array($controllerID,array('marketing','business')))
		{
                    if($controllerID =="business" && $actionID == "index"){
                        $this->menuId  = F::sg('menu','dealerSidebarMenu');    //我的公司
                    }else{
                        $this->menuId  = F::sg('menu','dealermarketingMenu');  //营销管理
                    }				
		}else
    	$this->menuId = F::sg('menu','dealerSidebarMenu');
    }
    
    public function getMenu() {
    	$descendants = array();
    	if(empty($this->menuId)){
    		return $descendants;
    	}
    	$main = Menu::model()->findByPk($this->menuId);
    	if($main){
    		$descendants = $main->children()->findAll("if_show=:if_show",array(":if_show"=>1));
    	}
    	return $descendants;
    }
    
    public function getMenuTitle() {
    	$title = "";
    	if(empty($this->menuId)){
    		return $title;
    	}
    	$main = Menu::model()->findByPk($this->menuId);
    	if($main != null && $main->position != 9) {
    		$title = $main->name;
    	}
    	return $title;
    }
    
    public function run() {
        $this->render('sidebarCommon');
    	//$this->render('sidebarMenu');
    }
}