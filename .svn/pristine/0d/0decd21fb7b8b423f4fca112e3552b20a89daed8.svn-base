<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MReGoods extends CWidget {

    public $sellerID;

    public function run() {
        $re = array(
            'OrganID' => $this->sellerID, //经销商ID
            'rows' => 3, //显示条数
            'page' => 1 //页数
        );
        $serviceID = Yii::app()->user->getOrganID();
        $organID=$this->sellerID;
        $sql = "select ID,Name,ProPrice from pap_goods where IsDelete=1 and IsSale=1 and IsPro=1 and OrganID=$organID limit 0,3 ";
        $goods = Yii::app()->papdb->createCommand($sql)->queryAll();
        foreach ($goods as $k => $v) {
            $image = MallService::getOneGoodsImage($v['ID']);
            if (!$image) {
                $goods[$k]['image'] = F::uploadUrl() . 'dealer/goods-img-big.jpg';
            } else {
                $goods[$k]['image'] = F::uploadUrl() . $image;
            }
        }
        $this->render("goods", array('goods' => $goods));
    }

}
