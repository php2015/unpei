<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSidebarServiceCenter extends CWidget {

	public $menuId = "";
	
	public function init() {		
		$controlerId = Yii::app()->getController()->id;		
		$controlerId = strtolower(trim($controlerId));
		if ($controlerId=='servicemain' || $controlerId=='servicebusiness'){
			$this->menuId = F::sg('menu','servicerSiderbarMenu');
		}
		elseif ($controlerId=='servicemarket' || $controlerId=='servicepromotions') {
			$this->menuId = F::sg('menu','servicerMarketSiderbarMenu');
		}
	}
	
	public function getMenu() {
		$descendants = array();
		if(empty($this->menuId)){
			return $descendants;
		}
		$main = Menu::model()->findByPk($this->menuId);
		if($main){
			$descendants = $main->children()->findAll();
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