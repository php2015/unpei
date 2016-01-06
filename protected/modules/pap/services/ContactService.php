<?php

class ContactService {
    /*
     * 获取当前经销商匹配的服务店的客户级别
     */

    public static function getServicelv($id) {
        //获取当前登录的经销商机构ID
        $dealer = Yii::app()->user->getOrganID();
        if ($id && $dealer) {
            //查询匹配当前经销商ID的服务店ID
            $model = PapClientType::model()->find("DealerID=$dealer and ServiceID=$id")->attributes;
            if ($model['Cooperationtype'] == 'A') {
                return "A:VIP客户";
            } else if ($model['Cooperationtype'] == 'B') {
                return "B:重要客户";
            } else {
                $model['Cooperationtype'] ? $model['Cooperationtype'] : 'C';
                return "C:普通客户";
            }
        } else {
            return "C:普通客户";
        }
    }


    //获得修改时间
    public static function getpdateTime($id) {
        $dealer = Yii::app()->user->getOrganID();
        if ($dealer && $id) {
            $model = PapClientType::model()->find("DealerID=$dealer and ServiceID=$id")->attributes;
            if ($model['UpdateTime']) {
                return date('Y-m-d H:i', $model['UpdateTime']);
            }
        }
        return "";
    }

    //获得激活时间
    public static function getCreateTime($id) {
        $dealer = Yii::app()->user->getOrganID();
        if ($dealer && $id) {
            $model = PapClientType::model()->find("DealerID=:deal and ServiceID=:sid", array(':deal' => $dealer, ':sid' => $id))->attributes;
            if ($model['CreateTime']) {
                return date('Y-m-d H:i', $model['CreateTime']);
            }
        }
        return "";
    }

}

?>
