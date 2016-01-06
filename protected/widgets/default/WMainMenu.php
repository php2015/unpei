<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WMainMenu extends CWidget {

	public function getMainMenu() {
		$mainMenu = F::sg('menu','defaultMainMenu');
		$user = Yii::app()->user;
		if($user->isMaker()){
			$mainMenu = F::sg('menu','makerMainMenu');
		}else if($user->isDealer()){
			$mainMenu = F::sg('menu','dealerMainMenu');
		}else if($user->isServicer()){
			$mainMenu = F::sg('menu','servicerMainMenu');
		}
		$main = Menu::model()->findByPk($mainMenu);
		$descendants = array();
		if($main){
			$descendants = $main->children()->findAll("if_show=:if_show",array(":if_show"=>1));
		}
		return $descendants;
	}
	
    public function run() {
        $this->render('mainMenu');
    }

}