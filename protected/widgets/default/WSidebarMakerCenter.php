<?php
/**
 * 品牌厂家登记菜单
 * 
 **/

class WSidebarMakerCenter extends CWidget {

	public $menuId = "";
	
	public function init() {	
		$controlerId = Yii::app()->getController()->id;
		$controlerId = strtolower(trim($controlerId));
		if ($controlerId=='makecompany'){
			$this->menuId = F::sg('menu','makeCompanySiderMenu');
		}elseif($controlerId=='makeorder') {
			$this->menuId = F::sg('menu','makeOrderSiderMenu');
		}elseif($controlerId=='default') {
			$this->menuId = F::sg('menu','makeSearchSiderMenu');
		}elseif(in_array($controlerId, array('salesmanage','goodscategory','templatemanage'))) {
			$this->menuId = F::sg('menu','makeGoodsSiderMenu');
		}else {
			$this->menuId = F::sg('menu','makeSiderMenu');
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