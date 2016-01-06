<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WSliderbar extends CWidget {
	
    public function run() {
        //定义参数数组
       // $params = array("rootID" => 0);
        //根据用户的角色选择根节点
//        if (Yii::app()->user->isMaker()) {
//            $params["rootID"] = 1;
//        }else if (Yii::app()->user->isDealer()) {
//            $params["rootID"] = 2;
//        }else if (Yii::app()->user->isServicer()) {
//            $params["rootID"] = 3;
//        }
         if(Yii::app()->user->isServicer()){
          $menu=self::getmenu('修理厂菜单');
          $params['rootID']=$menu['ID'];
        }else if(Yii::app()->user->isDealer()){
          $menu=self::getmenu('经销商菜单');
          $params['rootID']=$menu['ID'];
        }
        //组装参数
        $params["scope"] = "sliderbar"; //指定定查询范围
      //  $route = Yii::app()->getController()->getRoute(); //获取当前路由
        //获取菜单数组
   
        $menuArr = FrontMenu::getChildMenu($params);
        $this->render('sliderbar', array("menu" => $menuArr));

    }
      protected static function getmenu($name){
       return FrontMenu::model()->find('Name=:name',array(":name"=>$name));
    }
}