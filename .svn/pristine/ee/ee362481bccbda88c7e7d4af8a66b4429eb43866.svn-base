<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSidebarMallCenter extends CWidget {

    public $menuId = "";

    public function init() {
        $user = Yii::app()->user;
        $controlerId = Yii::app()->getController()->id;
        $controlerId = strtolower(trim($controlerId));
        if ($controlerId == 'quotationsell') {
            $this->menuId = F::sg('menu', 'mallQuotationSellSiderbarMenu');
        } elseif ($controlerId == 'quotationbuy') {

            if ($user->isDealer()) {
                $this->menuId = F::sg('menu','dealerOrderMenu');
            } else if ($user->isServicer()) {
                $this->menuId = F::sg('menu', 'mallQuotationBuySiderbarMenu');
            }
            
        }
    }

    public function getMenu() {
        $descendants = array();
        if (empty($this->menuId)) {
            return $descendants;
        }
        $main = Menu::model()->findByPk($this->menuId);
        if ($main) {
            $descendants = $main->children()->findAll();
        }
        return $descendants;
    }

    public function getMenuTitle() {
        $title = "";
        if (empty($this->menuId)) {
            return $title;
        }
        $main = Menu::model()->findByPk($this->menuId);
        if ($main != null  && $main->position != 9) {
            $title = $main->name;
        }
        return $title;
    }

    public function run() {
        if( strtolower(Yii::app()->getController()->id) == 'quotationbuy' && Yii::app()->user->isDealer()){
            $this->render('sidebarCommon');        
        }else{
            $this->render('sidebarMenu');
        }
        
    }

}