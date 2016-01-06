<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSidebarPartnerCenter extends CWidget {

    public $menuId = "";

    public function init() {
        $user = Yii::app()->user;
        $controlerId = Yii::app()->getController()->id;
        $controlerId = strtolower(trim($controlerId));
        echo $user;
        if ($controlerId == 'partner') {
            $this->menuId = F::sg('menu', 'partnerSiderMenu');
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
            $this->render('sidebarCommon');        
    }

}