<?php

/**
 * 自动化执行 命令行模式
 */
class RecommendIncomeCommand extends CConsoleCommand {

    /**
     * 计算经销商推荐收益
     * 每个月1号执行一次, 或者每隔1个月执行一次
     * @param unknown $args
     */
    public function run($args) {
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . " [RecommendIncome] start", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [RecommendIncome] start \n";
        $beginmoth = strtotime('-1 month');
        $year = date('Y', $beginmoth);
        $month = date('m', $beginmoth);
        $beginmoth = date('Y-m', $beginmoth);
        $beginmoth = strtotime($beginmoth);
        $endmoth = date('Y-m');
        $endmoth = strtotime($endmoth);
        $Time = date('Y-m', time());
        $Time = strtotime($Time);
        Yii::log('beginmoth:' . $beginmoth, 'info', 'command');
        Yii::log('beginyear:' . $year, 'info', 'command');
        Yii::log('beginmoth:' . $beginmoth, 'info', 'command');
        Yii::log('endmoth:' . $endmoth, 'info', 'command');
        Yii::log('time:' . $Time, 'info', 'command');
        $discountRate = Settings::getValue("discountRate"); //获取推荐收益参数
        $criteria = new CDbCriteria;
        $criteria->select = 'userID';
        $criteria->distinct = true;
        $criteria->order = 'userID desc';
        $sql_find = 'select ID from jpd_organ where Identity=2';
        $dealers = Yii::app()->jpdb->createcommand($sql_find)->queryAll();
        if (!empty($dealers)) {
            foreach ($dealers as $deakey => $deaval) {
                $IncomeID = '';
                $exit = RecommendIncome::model()->find('OrganID=:OrganID and Month=:Month and Year=:Year', array(':OrganID' => $deaval['ID'], ':Month' => $month, ':Year' => $year));
                if ($exit) {
                    $IncomeID = $exit->ID;
                } else {
                    $model = new RecommendIncome();
                    $model->EffectTime = time();
                    $model->OrganID = $deaval['ID'];
                    $model->IsAccount = 0;
                    $model->Month = $month;
                    $model->Year = $year;
                    $model->save();
                    $IncomeID = Yii::app()->jpdb->getLastInsertID();
                }
                $serviceID = '';
                $lastmonthtotal = 0;
                $Record_all = RecommendRecord::model()->findAll('DealerID=:OrganID ', array(':OrganID' => $deaval['ID']));
                if ($Record_all) {
                    foreach ($Record_all as $app2) {
                        if (!empty($app2)) {
                            if ($app2->ServiceID) {
                                $serviceID[] = $app2->ServiceID;
                                $app4 = PapOrder::model()->findAll('BuyerID=:BuyerID and Status=:Status and SellerID!=:SellerID and ReceiptTime<:endmoth and ReceiptTime>=:beginmoth', array(':BuyerID' => $app2->ServiceID, ':Status' => 9, ':SellerID' => $deaval['ID'], ':endmoth' => $endmoth, ':beginmoth' => $beginmoth));
                                if (!empty($app4)) {
                                    $month1 = 0;
                                    foreach ($app4 as $ke => $valu) {
                                        $discountAmount = $valu['RealPrice'] * $discountRate;
//                                        $payAmount = is_float($discountAmount) ? substr_replace($discountAmount, '', strpos($discountAmount, '.') + 3) : $discountAmount . '.00';
                                        $payAmount = round($discountAmount, 2);
                                        $month1+=$payAmount;
                                        $lastmonthtotal+=$payAmount;
                                    }
                                    $detail = RecommendIncomeDetail::model()->find("OrganID=:OrganID and ServiceID=:ServiceID and incomeID=:incomeID", array(':OrganID' => $deaval['ID'], ":ServiceID" => $app2->ServiceID, ':incomeID' => $IncomeID));
                                    if (!empty($detail)) {
                                        RecommendIncomeDetail::model()->updateByPK($detail->ID, array('income' => $month1));
                                    } else {
                                        $income = new RecommendIncomeDetail();
                                        $income->RecomID = $app2->RecomID;
                                        $income->RecomTime = time();
//                                        $income->IncomeAccount = 0;
                                        $income->IncomeTime = time();
                                        $income->isAccount = 0;
                                        $income->BeFormalTime = 0;
                                        $income->income = $month1;
                                        $income->OrganID = $deaval['ID'];
                                        $income->ServiceID = $app2->ServiceID;
                                        $income->incomeID = $IncomeID;
                                        $income->save();
                                    }
                                }
                            }
                        }
                    }
                }

                $criteria = new CDbCriteria;
                $criteria->select = 'BuyerID';
                $criteria->distinct = true;
                $criteria->addCondition('Status=9');
                $criteria->addCondition("ReceiptTime<" . $endmoth);
                $criteria->addCondition("ReceiptTime>=" . $beginmoth);
                $criteria->addCondition("SellerID=" . $deaval['ID']);
                if (!empty($serviceID)) {
                    $criteria->addNotInCondition('BuyerID', $serviceID);
                }
                $criteria->order = 'BuyerID desc';
                $payservicers = PapOrder::model()->findAll($criteria);
                if (!empty($payservicers)) {
                    foreach ($payservicers as $paykey => $payval) {
                        $record = RecommendRecord::model()->find('ServiceID=:ServiceID', array(":ServiceID" => $payval->BuyerID));
                        if (!empty($record)) {
                            $month2 = 0;
                            $paysers = PapOrder::model()->findAll('BuyerID=:BuyerID and Status=:Status and SellerID=:SellerID and ReceiptTime<:endmoth and ReceiptTime>=:beginmonth', array(':BuyerID' => $payval->BuyerID, ':Status' => 9, ':SellerID' => $deaval['ID'], ':endmoth' => $endmoth, ':beginmonth' => $beginmoth));
                            foreach ($paysers as $Skey => $Sval) {
                                $discountAmount = $Sval['RealPrice'] * $discountRate;
//                                $payAmount = is_float($discountAmount) ? substr_replace($discountAmount, '', strpos($discountAmount, '.') + 3) : $discountAmount . '.00';
                                $payAmount = round($discountAmount, 2);
                                $month2-=$payAmount;
                                $lastmonthtotal-=$payAmount;
                            }
                            $detail = RecommendIncomeDetail::model()->find("OrganID=:OrganID and ServiceID=:ServiceID and incomeID=:incomeID", array(':OrganID' => $deaval['ID'], ":ServiceID" => $payval->BuyerID, ':incomeID' => $IncomeID));
                            if (!empty($detail)) {
                                RecommendIncomeDetail::model()->updateByPK($detail->ID, array('income' => $month2));
                            } else {
                                $income = new RecommendIncomeDetail();
                                $income->RecomID = $record->RecomID;
                                $income->RecomTime = time();
                                $income->IncomeTime = time();
                                $income->isAccount = 0;
                                $income->BeFormalTime = 0;
                                $income->income = $month2;
                                $income->OrganID = $deaval['ID'];
                                $income->ServiceID = $payval->BuyerID;
                                $income->incomeID = $IncomeID;
                                $income->save();
                            }
                        }
                    }
                }
                RecommendIncome::model()->updateByPK($IncomeID, array('MonthIncome' => $lastmonthtotal));
            }
        }
        Yii::log(date('Y-m-d H:i:s') . " [RecommendIncome] end \n", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [RecommendIncome] end \n";
    }

}
