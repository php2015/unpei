<?php

/*
 * 批量修改价格
 */
Yii::import('application.extensions.YiiMongoDbSuite.*');
Yii::import('application.modules.pap.services.*');
Yii::import('application.modules.pap.models.*');

class UpdateGoodsPriceCommand extends CConsoleCommand {

    public function run() {4
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . " [UpdateGoodsPrice] start", 'info', 'command');
        $goods = PapGoodsUpdateprice::model()->findAll('UpdateTime is null');
        foreach ($goods as $goodsk => $goodsv) {
            $goodsinfo = PapGoods::model()->findBypk($goodsv->GoodsID);
            $oldprice = $goodsinfo->Price;
            $goodsinfo->Price = $goodsv->GoodsPrice;
            $updatetime = time();
            $goodsinfo->UpdateTime = $updatetime;

            if ($goodsinfo->save()) {
                $editarr = array(
                    'GoodsID' => (int) $goodsv->GoodsID,
                    'UpdateTime' => (int) $updatetime,
                    'EditInfo' => array('Price' => array('old' => (string) $oldprice, 'news' => $goodsv->GoodsPrice)),
                    'type' => 'edit',
                );
                Yii::app()->mongodb->getDbInstance()->goods_log->insert($editarr);
                PapGoods::model()->updateBypk($goodsv->GoodsID, array('Version' => $updatetime));
                $redis = $version = DealergoodsService::newgoodsxinfo($goodsv->GoodsID);
                $Goodsarr = array(
                    'GoodsID' => (int) $goodsv->GoodsID,
                    'GoodsInfo' => $version,
                    'Version' => (int) $updatetime,
                    'VehVersion' => (int) $goodsinfo->VehVersion,
                );
                Yii::app()->mongodb->getDbInstance()->goods_version->insert($Goodsarr);
                Yii::app()->redis->set('GoodsID' . $goodsv->GoodsID, json_encode($redis));
                $result = PapGoodsUpdateprice::model()->findByPk($goodsv->ID)->delete();
            }
        }
        Yii::log(date('Y-m-d H:i:s') . " [UpdateGoodsPrice] end \n", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [UpdateGoodsPrice] end \n";
    }

}
