<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class DefaultService {

    //获取事故件标准名称
    public static function accidentparts() {
        $main = Gcategory::model()->find('Name=?', array('事故件'));
        //获取事故件子类
        if ($main['ID']) {
            $sub = self::getsub($main['ID']);
        }
        return $sub;
    }

    //获取常用件
    public static function commonparts() {
        $main = Gcategory::model()->find('Name=?', array('常用件'));
        //获取常用件子类
        if ($main['ID']) {
            $sub = self::getsub($main['ID']);
        }
        return $sub;
    }

    //获取子类
    public static function getsub($mainID) {
        if ($mainID) {
            $cri = new CDbCriteria(array(
                'condition' => 'ParentID =' . $mainID . ' and IsShow=1',
                'order' => 'SortOrder asc',
            ));
        }
        $categorys = Gcategory::model()->findAll($cri);
        return $categorys;
    }

    //根据子类查询商品
    public static function getsubgoods($params) {
        if (!isset($params['subid']) || empty($params['subid'])) {
            return null;
        }
        $subid = $params['subid'];
        $organID = $params['organID'];
        $code = self::getCode($subid);
        $cri = new CDbCriteria();
        $cri->addInCondition('StandCode', $code);
        $cri->addCondition('IsSale=1');
        $cri->addCondition('ISdelete=1');

        $goods = PapGoods::model()->findAll($cri);
        //$goods=PapGoodsGcategory::model()->findAll('SubParts=:sub',array(':sub'=>$subid));
        $result = array();
        if ($goods) {
            foreach ($goods as $key => $val) {
                $res = PapGoods::model()->findByPk($val['ID'], 'IsSale=1 and ISdelete=1');

                //获取商品首张图片
                if (isset($res['ID']) && !is_null($res['ID'])) {
                    $result[$key] = $res->attributes;
                    $price = MallService::getContactprice($res['OrganID'], $organID);
                    $result[$key]['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";

                    $result[$key]['Price'] = sprintf("%.2f", $res['Price'] * $result[$key]['PriceRatio'] / 100);
                    if ($res['IsPro'] == 1) {
                        if (!is_null($res['ProPrice']) && $res['ProPrice']) {
                            $result[$key]['Price'] = $res['ProPrice'];
                        }
                    }
                    $image = PapGoodsImageRelation::model()->find('GoodsID=:goodsID', array(':goodsID' => $res['ID']));
                    if (empty($image['ImageUrl'])) {
                        $result[$key]['imageurl'] = 'dealer/default-goods.png';
                    } else {
                        $result[$key]['imageurl'] = $image['ImageUrl'];
                    }
                }
            }
            return $result;
        }
    }

    //查询经销商
    public static function querydealer() {
        $cri = new CDbCriteria;
        $cri->addCondition('Identity=2');
        $cri->addCondition("IsBlack='0'");
        $cri->addCondition("IsFreeze='0'");
        $cri->addCondition("Status='1'");
        //获得联盟id
        $organID = Yii::app()->user->getOrganID();
        $unionid = MallService::getUnioninfo($organID);
        $unionid = $unionid ? $unionid : '-1';
        //联盟商品
        $dids = MallService::getUnionOrgan(array('UnionID' => $unionid, 'type' => 2));
        $cri->addCondition('ID in (' . $dids . ')');
        $cri->order = 'Sort ASC';
        $dealer = Organ::model()->findAll($cri);
        $deal_info = array();
        if ($dealer) {
            foreach ($dealer as $key => $val) {
                //将机构图片换成LOGO  修改时间2014-09-03   修改人：邓家文    
                //$img=JpdOrganPhoto::model()->find('OrganID=:organ',array(':organ'=>$val['ID']));
                $deal_info[$key]['ID'] = $val['ID'];
                $deal_info[$key]['OrganName'] = $val['OrganName'];
                $deal_info[$key]['Phone'] = $val['Phone'];
                if (!isset($val['Logo']) && empty($val['Logo'])) {
                    $val['Logo'] = 'common/default-goods.png';
                }
                $deal_info[$key]['imgpath'] = $val['Logo'];
            }
        }

        return $deal_info;
    }

    //查询经销商店铺信息
    public static function sellerstore($orderid) {
        return Organ::model()->findByPk($orderid);
    }
    
    //查询店家积分
    public static function getrecord($OrganID){
        $recordmodel = LlegalRecord::model()->find("OrganID = '{$OrganID}'");
        if (empty($recordmodel)) {
            $recordmodel = new LlegalRecord();
            $recordmodel->OrganID = $OrganID;
            $recordmodel->save();
        }
        return $recordmodel->TotalScore;
    }

    //获取大类子类中的code
    public static function getCode($sub) {
        if ($sub) {
            $cri = new CDbCriteria(array(
                'condition' => 'ParentID = ' . $sub . ' and IsShow=1',
                'order' => 'SortOrder asc',
            ));
        }
        $categorys = Gcategory::model()->findAll($cri);
        $data = array();
        foreach ($categorys as $key => $value) {
            $data[] = $value['Code'];
        }
        return $data;
    }

    //商城新首页
    static function getMainCategorys($parentID) {
        $cri = new CDbCriteria(array(
            'condition' => 'ParentID =' . $parentID . ' or ParentID <=> NULL and IsShow=1',
            'order' => 'SortOrder asc',
        ));
        $categorys = Gcategory::model()->findAll($cri);
        return $categorys;
    }

    //取大类
    static function findChild($arr, $id) {
        $childs = array();
        foreach ($arr as $k => $v) {
            if ($v['ParentID'] == $id) {
                $childs[] = $v;
            }
        }
        return $childs;
    }

//取子类
    static function findsub($rows) {
        foreach ($rows as $k => $v) {
            $childs[$k] = $v->attributes;
            $sub = self::getMainCategorys($v['ID']);
            $childs[$k]['children'] = $sub;
        }
        return $childs;
    }

    static function findstand($rows) {
        foreach ($rows as $k => $v) {
            $childs[$k] = $v->attributes;
            $sub = self::getMainCategorys($v['ID']);
            $childs[$k]['stand'] = $sub;
        }
        return $childs;
    }

    //获取提醒邮箱和警告邮箱地址并发送提醒内容
    public static function sendwarnemail($params) {
        $organID = $params['organID'];
        $UserID = $params['UserID'];
        $subject = $params['subject'];
        $remind = $params['remind'];
        $warn = $params['warn'];
        $time = $_SERVER['REQUEST_TIME'];
        //获取提醒邮箱和警告邮箱地址
        $emailsql = ' select * from jpd_admin_settings where Category="system" and (`Key`="safe_warn_email" or `Key`="safe_remind_email")';
        $emailres = Yii::app()->jpdb->createCommand($emailsql)->queryAll();
        $reminds = array();
        $warns = array();
        foreach ($emailres as $v) {
            $email = @unserialize($v['Value']);
            if ($v['Key'] == 'safe_remind_email') {
                //提醒邮箱列表
                if ($email != '') {
                    $remindemails = $email;
                    $reminds = explode(';', $email);
                }
            } else {
                //警告邮箱
                if ($email != '') {
                    $warnsemails = $email;
                    $warns = explode(';', $email);
                }
            }
        }
        $res = array();
        foreach ($reminds as $r) {
            if ($r == '')
                continue;
            $res[] = UserModule::sendMail($r, $subject, $remind);
            Yii::app()->mailer->ClearAddresses();
        }
        foreach ($warns as $w) {
            if ($w == '')
                continue;
            $res[] = UserModule::sendMail($w, $subject, $warn);
            Yii::app()->mailer->ClearAddresses();
        }
        $insert = 'insert into jpd_login_remind (OrganID,UserID,RemindContent,WarnContent,RemindEmail,WarnEmail,CreateTime) values('
                . $organID . ',' . $UserID . ',"' . $remind . '","' . $warn . '","' . $remindemails . '","' . $warnsemails . '",' . $time . ')';
        Yii::app()->jpdb->createCommand($insert)->execute();
        //Yii::log($insert, 'info', 'order');
        //Yii::log(date('Y-m-d H:i:s') . '   email_result:' . json_encode($res), 'info', 'order');
    }
    //获取菜单
      public static function getmenu($name){
       return FrontMenu::model()->find('Name=:name',array(":name"=>$name));
    }

}
