<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSidebarMemberCenter extends CWidget {

    public $menuId = "";
    
    public function init() {
        $identity = Yii::app()->user->identity;
        if($identity==1){
            $this->menuId = F::sg('menu','makermemberSiderbarMenu');
        }elseif($identity==2){
            $this->menuId = F::sg('menu','dealermemberSiderbarMenu');
        }else{
            $this->menuId = F::sg('menu','servicememberSiderbarMenu');
        }
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
    	if($main != null) {
    		$title = $main->name;
    	}
    	return $title;
    }
    
    public function run() {
    	$this->render('sidebarMenu');
    }
    
    
}