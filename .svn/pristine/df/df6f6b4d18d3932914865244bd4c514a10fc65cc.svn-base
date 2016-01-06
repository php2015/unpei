<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PromotionService {
    /*
     * 促销结算-优惠券列表
     */

    public static function Cprogetlist() {
//        $page = $params['page'] ? $params['page'] : 1;
//        $seaCon = self::getOrderCond($params);
//        $count = Yii::app()->papdb->createCommand(str_replace('t.*', 'count(*)', $seaCon))->queryScalar();
        $OrganID = Yii::app()->user->getOrganID();
        $sql = "SELECT a.BuyerName as BuyerName,d.CouponSn as CouponSn,a.OrderSN as OrderSN,a.CreateTime as CreateTime,b.Amount as Amount,b.Status as Status
            from pap_order a JOIN 
                pap_promotion_order b on a.ID=b.OrderID JOIN 
                pap_promotion c on b.PromoID=c.ID JOIN 
                pap_coupon d on b.CouponID=d.ID where a.SellerID=" . $OrganID . " and c.Type=3";
        $sqlcount = "SELECT count(*)
            from pap_order a JOIN 
                pap_promotion_order b on a.ID=b.OrderID JOIN 
                pap_promotion c on b.PromoID=c.ID JOIN 
                pap_coupon d on b.CouponID=d.ID where a.SellerID=" . $OrganID . " and c.Type=3";
        $count = Yii::app()->papdb->createCommand($sqlcount)->queryScalar();
        $data = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => 2,
        )));
//        $datas = $data->getData();
//        var_dump($datas);exit;
        return $data;
    }

    /*
     * 促销结算-促销减免列表
     */

    public static function Mprogetlist() {
        $OrganID = Yii::app()->user->getOrganID();
        $buyname = Yii::app()->request->getParam('buyname');
        if ($buyname) {
            $select .= " and  a.BuyerName = '" . $buyname . "'";
        }
        $type = Yii::app()->request->getParam('type');
        if ($type == '0') {
            $select .= " and  c.Type!=3";
            $protitle = Yii::app()->request->getParam('protitle');
            if ($protitle) {
                $select .= " and  c.Title = '" . $protitle . "'";
            }
            $sql = "SELECT a.BuyerName as BuyerName,c.Title as Title,a.OrderSN as OrderSN,a.CreateTime as CreateTime,b.Amount as Amount,b.Status as Status
            from pap_order a JOIN 
                pap_promotion_order b on a.ID=b.OrderID JOIN 
                pap_promotion c on b.PromoID=c.ID where a.SellerID=" . $OrganID;
            $sqlcount = "SELECT count(*)
            from pap_order a JOIN 
                pap_promotion_order b on a.ID=b.OrderID JOIN 
                pap_promotion c on b.PromoID=c.ID where a.SellerID=" . $OrganID;
        } else if ($type == '1') {
            $select .= " and  b.CouponID!=0";
            $protitle = Yii::app()->request->getParam('protitle');
            if ($protitle) {
                $select .= " and  c.CouponSn = '" . $protitle . "'";
            }
            $sql = "SELECT a.BuyerName as BuyerName,c.CouponSn as CouponSn,a.OrderSN as OrderSN,a.CreateTime as CreateTime,b.Amount as Amount,b.Status as Status
            from pap_order a JOIN 
                pap_promotion_order b on a.ID=b.OrderID JOIN 
                pap_coupon_manage c on b.PromoID=c.ID where a.SellerID=" . $OrganID;
            $sqlcount = "SELECT count(*)
            from pap_order a JOIN 
                pap_promotion_order b on a.ID=b.OrderID JOIN 
                pap_coupon_manage c on b.PromoID=c.ID where a.SellerID=" . $OrganID;
        }

        $orderno = Yii::app()->request->getParam('orderno');
        if ($orderno) {
            $select .= " and  a.OrderSN = '" . $orderno . "'";
        }
        $Status = Yii::app()->request->getParam('Status');
        if ($Status == '0') {
            $select .= " and  b.Status = '" . $Status . "'";
        } else if ($Status == '1') {
            $select .= " and  b.Status = '" . $Status . "'";
        }
        $starttime = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $endtime = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        if ($starttime && $endtime) {
            $select .=" and a.CreateTime > {$starttime} and a.CreateTime < {$endtime}+3600*24";
        } else if ($starttime) {
            $select .=" and a.CreateTime > {$starttime}";
        } else if ($endtime) {
            $select .=" and a.CreateTime < {$endtime}+3600*24";
        } else {
//            $seaCon.=" and t.CreateTime >" . strtotime(date('Y-m-01')) . " and t.CreateTime < " . strtotime(date('Y-m-d')) . "+3600*24";
        }
        if ($select) {
            $sql .=$select;
            $sqlcount .=$select;
        }
        $count = Yii::app()->papdb->createCommand($sqlcount)->queryScalar();
        $data = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => 2,
        )));
        return $data;
    }

    /*
     * 返回状态
     */

    public static function returnStatus($Status) {
        if ($Status == '0') {
            return '未结算';
        } else if ($Status == '1') {
            return '已结算';
        }
    }

}
