<?php

/*
 * 保证金管理
 */

class CashdepositService {
    /*
     * 查询交易记录
     */

    public static function getrecords($Item) {
        $OrganID = Yii::app()->user->getOrganID();
        $time = Yii::app()->request->getParam('time');
        $criteria = new CDbCriteria();
        if ($Item == 1) {
            $criteria->addCondition("Item = 1 or Item = 3", "AND");
            $criteria->addCondition("OrganID=" . $OrganID, "AND");
        } elseif ($Item == 0) {
            $criteria->addCondition("Item = 0 or Item = 2", "AND");
            $criteria->addCondition("OrganID =" . $OrganID, "AND");
        }
        if (strtotime(Yii::app()->request->getParam('starttime')))
            $StartTime = Yii::app()->request->getParam('starttime');
        if (strtotime(Yii::app()->request->getParam('endtime')))
            $endtime = Yii::app()->request->getParam('endtime');
        if (Yii::app()->request->getParam('time'))
            $Time = Yii::app()->request->getParam('time');
        if ($StartTime && $EndTime) {
            $StartTime = strtotime($StartTime);
            $EndTime = (int) (strtotime($EndTime) + 60 * 60 * 24);
            $criteria->addBetweenCondition('CreateTime', "{$StartTime}", "{$EndTime}", "AND");
        } elseif ($StartTime) {
            $StartTime = strtotime($StartTime);
            $criteria->addCondition("CreateTime >= " . $StartTime);
        } elseif ($EndTime) {
            $EndTime = (int) (strtotime($EndTime) + 60 * 60 * 24);
            $criteria->addCondition("CreateTime <= " . $EndTime, "AND");
        }
        if ($Time && !$StartTime && !$EndTime) {
            $newtime = time();
            $datetime = strtotime(date("Y-m-d", $newtime));
            if ($Time == 1) {
                $criteria->addBetweenCondition('CreateTime', "{$datetime}", "{$newtime}", "AND");
            } elseif ($Time == 2) {
                $oldtime = (int) ($datetime - 60 * 60 * 24 * 30);
                $criteria->addBetweenCondition('CreateTime', "{$oldtime}", "{$newtime}", "AND");
            } elseif ($Time == 3) {
                $oldtime = (int) ($datetime - 60 * 60 * 24 * 30 * 3);
                $criteria->addBetweenCondition('CreateTime', "{$oldtime}", "{$newtime}", "AND");
            }
        }

//        $criteria->addCondition('OrganID =' . $OrganID, 'AND');
//        $criteria->addCondition('Item =' . $Item, 'AND');
        //  $criteria->order = 'ID desc';
        $dataProvider = new CActiveDataProvider('PapTransactionRecords', array(
            'criteria' => $criteria,
        ));
        $datas = $dataProvider->getData();
        foreach ($datas as $v) {
            if ($v->Item == '2') {
                $v->Item = '买方退货:' . $v->BusinessNO;
                $v->OrganID = OrderreturnService::idgetname($v->GetID);
                $v->view = "<a class='view' href='" . Yii::app()->createUrl('pap/Cashdeposit/info', array('id' => $v->ID)) . "' title='详情'>查看详情</a>";
            }
            if ($v->Item == '0') {
                $v->Item = '充值';
                $v->OrganID = '北京嘉配科技有限公司';
                $v->view = '';
            }
            if ($v->Item == '1') {
                $v->Item = '充值';
                $v->OrganID = OrderreturnService::idgetname($v->OrganID);
                $v->view = '';
            }
            if ($v->Item == '3') {
                $v->Item = '违规处罚';
                $v->OrganID = CashdepositService::idgetunion($v->GetID);
                $v->view = "<a class='view' href='" . Yii::app()->createUrl('pap/Cashdeposit/infos', array('id' => $v->ID)) . "' title='详情'>查看详情</a>";
            }
        }
        $dataProvider->setData($datas);
        return $dataProvider;
    }

    /*
     * 获得余额
     */

    public static function getdeposit($Item) {
        $OrganID = Yii::app()->user->getOrganID();
        $model = PapCashDeposit::model()->find('OrganID=:OrganID', array(':OrganID' => $OrganID));
        if ($Item == 1) {
            return $model->BaseMoney;
        } elseif ($Item == 0) {
            return $model->QualityMoney;
        }
    }

    /*
     * 通过交易ID获得交易信息
     */

    public static function cashgetcash($ID) {
        $model = PapTransactionRecords::model()->findBypk($ID);
        return $model;
    }

    /*
     *                     
     */

    public static function idgetunion($ID) {
        if ($ID) {
            $sql = 'select Name from jpd_union where ID =' . $ID;
            $res = Yii::app()->jpdb->createCommand($sql)->queryAll();
            return $res[0]['Name'];
        } else {
            return '北京嘉配科技有限公司';
        }
    }

}
