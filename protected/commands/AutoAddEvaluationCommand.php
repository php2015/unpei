<?php

/**
 * 自动化执行 命令行模式
 */
Yii::import('application.modules.pap.models.*');

class AutoAddEvaluationCommand extends CConsoleCommand {

    public function run($args) {
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . " [AutoEvaluation] start", 'info', 'command');
        //所要执行的任务，如数据符合某条件更新，删除，修改
        $Timeeva = time() - 24 * 60 * 60 * 10; //定义时间  收货15天后自动评价
        //服务店评价
        $model = PapOrder::model()->findAll("Status=9 and (EvaStatus = 0 or EvaStatus = 16)"); //查询符合要求的已收货订单
        foreach ($model as $value) {
            if ($value['ReceiptTime'] < $Timeeva) {
                //已经收货订单执行下面代码
                $modelg = PapOrderGoods::model()->findAll("OrderID=:ID", array(":ID" => $value['ID'])); //获得订单的商品
                $gbool = 1;
                foreach ($modelg as $valueg) {
                    //获得机构ID
                    $goodsinfo = PapGoods::model()->find("ID=:ID", array(":ID" => $valueg['GoodsID']));
                    $gevaluation = new PapEvaluationGoods();
                    $gevaluation->OrganID = $goodsinfo->OrganID;
                    $gevaluation->OrderID = $value['ID'];
                    $gevaluation->GoodsID = $goodsinfo->ID;
                    $gevaluation->BuyerID = $value['BuyerID'];
                    $gevaluation->CreateTime = time();
                    $gevaluation->Status = 1;
                    $model = $gevaluation->save(); //插入对单个商品的评价
                    if ($model) {
                        $m = PapGoods::model()->findByPk($goodsinfo->ID);
                        if ($m['CommentNo']) {
                            PapGoods::model()->updateByPk($goodsinfo->ID, array('CommentNo' => $m['CommentNo'] + 1));
                        } else {
                            PapGoods::model()->updateByPk($goodsinfo->ID, array('CommentNo' => 1));
                        }
                    } else {
                        $gbool = 0;
                    }
                }
                $oevaluation = new PapEvaluationDealer();
                $oevaluation->OrganID = $value['BuyerID'];
                $oevaluation->SellerID = $value['SellerID'];
                $ID = $oevaluation->OrderID = $value['ID'];
                $oevaluation->SellerBusiness = 5;
                $oevaluation->SellerService = 5;
                $oevaluation->SellerExact = 5;
                $oevaluation->SellerSpeed = 5;
                $oevaluation->ItemDescription = 5;
                $oevaluation->SellerPrice = 5;
                $oevaluation->SellerScore = 5;
                $oevaluation->CreateTime = time();
                $obool = $oevaluation->save(); //插入对商家的评价
                if ($obool && $gbool) {
                    //评价插入成功后，修改订单的状态
                    if ($value['EvaStatus'] == 0) {
                        $EvaStatus = 15; //如果该订单服务店先评价，把状态改为15
                    } elseif ($value['EvaStatus'] == 16) {
                        $EvaStatus = 20;  //如果该订单之前经销商评价过一次，则服务店此时评价状态改为20
                    }
                    PapOrder::model()->updateByPK($ID, array('EvaStatus' => $EvaStatus));
                }
            }
        }

        //经销商评价
        $modeld = PapOrder::model()->findAll("Status=9 and (EvaStatus = 0 or EvaStatus = 15)"); //查询符合要求的已收货订单
        foreach ($modeld as $value) {
            if ($value['ReceiptTime'] < $Timeeva) {
                $model = new PapEvaluationService();
                $model->BuyerID = $value['BuyerID'];
                $ID = $model->OrderID = $value['ID'];
                $model->OrganID = $value['SellerID'];
                $model->BuyerFamily = 5;
                $model->BuyerAccept = 5;
                $model->BuyerBusiness = 5;
                $model->BuyerSpeed = 5;
                $model->BuyerCommunication = 5;
                $model->BuyerScore = 5;
                $model->CreateTime = time();
                $bool = $model->insert();
                if ($bool) {
                    if ($value['EvaStatus'] == 0) {
                        $EvaStatus = 16; //如果该订单经销商先评价，把状态改为16
                    } else if ($value['EvaStatus'] == 15) {
                        $EvaStatus = 20; //如果该订单之前服务店评价过一次，则经销商此时评价状态改为20
                    }
                    PapOrder::model()->updateByPK($ID, array('EvaStatus' => $EvaStatus));
                }
            }
        }
        Yii::log(date('Y-m-d H:i:s') . " [AutoEvaluation] end \n", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [AutoEvaluation] end \n";
    }

}