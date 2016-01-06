<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class M {
    /*
     * 获取经销商/服务店rootID
     */

    public static function getRoot() {
        if (Yii::app()->user->isServicer()) {
            $menu = self::getmenu('修理厂菜单');
            $params['rootID'] = $menu['ID'];
        } else if (Yii::app()->user->isDealer()) {
            $menu = self::getmenu('经销商菜单');
            $params['rootID'] = $menu['ID'];
        }
        return $params;
    }
    //获取菜单
    public static function getmenu($name) {
        return FrontMenu::model()->find('Name=:name', array(":name" => $name));
    }
    public static  function getFileUrl() {
        // $sensfile = Yii::app()->Params['badword'];
        $upload = Yii::app()->Params['uploadHelpPath'];
        $sensfile = $upload . 'badword/sensword.txt';
        $string = file_get_contents($sensfile);
        return $string;
    }
    public static function replace($filestring){
        $badword=self::getFileUrl();
        $badword=trim($badword,"||");
        $badword=  explode("||", $badword);
        $badwordq=array_combine($badword,array_fill(0,count($badword),'*'));
        $str=strtr($filestring,$badwordq);
        return $str;
    }

}
