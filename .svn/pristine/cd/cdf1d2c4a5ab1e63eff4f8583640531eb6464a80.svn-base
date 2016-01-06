<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class WNavbar extends CWidget{
    public function  run(){
        $params=M::getRoot();
        //组装参数
        $params["scope"] = "sliderbar"; //指定定查询范围
        //获取菜单数组
        $navarr = FrontMenu::getChildMenu($params);
        $this->render('navbar',array('nav'=>$navarr));
    }
}
