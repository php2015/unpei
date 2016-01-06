<?php

/*
 * 工作台页面功能展示
 * 
 */

class WStage extends CWidget {

    public function run() {
        //定义参数数组
        $params = array("rootID" => 0);
        //根据用户的角色选择根节点
        if (Yii::app()->user->isMaker()) {
            $params["rootID"] = 1;
        } else if (Yii::app()->user->isDealer()) {
            $params["rootID"] = 2;
        } else if (Yii::app()->user->isServicer()) {
            $params["rootID"] = 3;
        }
        //组装参数
        $params["scope"] = "stage"; //制定查询范围
        //获取菜单数组
        $menuArr = FrontMenu::getChildMenu($params);
        $this->render('stage', array("menu" => $menuArr));
    }

}