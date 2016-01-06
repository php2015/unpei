<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WAutodataMenu extends CWidget {

	public function getMainMenu() {
		$descendants = array();
		$mainMenu = F::sg('menu','autodataMenu');
		if(empty($mainMenu)) {
			return $descendants;
		}
		$main = Menu::model()->findByPk($mainMenu);
		if($main){
			$descendants = $main->children()->findAll();
		}
		return $descendants;
	}
	
    public function run() {
        $this->render('mainMenu');
    }

}