<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MTopNav extends CWidget {

    public function run() {
        //大类子类数据源
        $main = DefaultService::getMainCategorys(0);
        $main = DefaultService::findChild($main, 0);
        $maincate = DefaultService::findsub($main);
        //获取是经销商还是服务店菜单
        $params=M::getRoot();
        //组装参数
        $params["scope"] = "sliderbar"; //指定定查询范围
        //获取菜单数组
        $navarr = FrontMenu::getChildMenu($params);
        foreach($navarr as $key=>$val){
            if($val['name']!='信息管理'){
                unset($navarr[$key]);
                continue;
            }
        }
       
        $this->render('topNav', array('MainCategory' => $maincate,'permenu'=>$navarr));
    }
}
