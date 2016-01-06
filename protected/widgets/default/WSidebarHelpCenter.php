<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSidebarHelpCenter extends CWidget {
    
    public function getHelp()
    {
    	$help = array();
    	$menuID = F::sg('menu','helpSiderbarMenu');
    	if(empty($menuID)){
    		return $help;
    	}
        $category = Category::model()->findByPk($menuID);
        if($category != null){
        	$help = $category->children()->findAll("if_show=:if_show",array(":if_show"=>1));
        }
        return $help;
    }
    public function run() {
        $this->render('sidebarHelpCenter');
    }

}