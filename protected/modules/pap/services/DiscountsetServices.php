<?php

/*
 * 营销参数设置
 */

class DiscountsetServices {

    //营销参数设置  获取合作类型
    public static function getCooperationtype($id) {
        $OrganID = Yii::app()->user->getOrganID();
        $model = GoodsPriceManage::model()->find("OrganID=$OrganID and ID=$id")->attributes;
        //return $model['CooperationType'];
        if ($model['CooperationType'] == 'A') {
            return "A:VIP客户";
        } else if ($model['CooperationType'] == 'B') {
            return "B:重要客户";
        } else {
            $model['CooperationType'] ? $model['CooperationType'] : 'C';
            return "C:普通客户";
        }
    }

    //营销参数设置  折扣率 获取订单的类型
    public static function getDisOrdertype($id) {
        $OrganID = Yii::app()->user->getOrganID();
        $model = OrderDiscount::model()->find("OrganID=$OrganID and ID=$id")->attributes;
        if ($model['OrderType'] == 1) {
            return '商城订单';
        } else if ($model['OrderType'] == 2) {
            return '询价单订单';
        } else {
            $model['OrderType'] == 3;
            return '报价单订单';
        }
    }

    //获取当前经销商设置的订单最小交易额
    public static function getTurnover($id) {
        $OrganID = Yii::app()->user->getOrganID();
        $model = OrderMinTurnover::model()->find("OrganID=$OrganID and ID=$id")->attributes;
        if ($model['MinTurnover'] && $model['MinTurnover'] != '0.00') { //有最小金额 且不是0.00
            return $model['MinTurnover'];
        } elseif ($model['MinTurnover'] == '0.00') { //如果没有  则0.00
            return '还没设置(请修改)';
        }
        return '';
    }

}
?>

