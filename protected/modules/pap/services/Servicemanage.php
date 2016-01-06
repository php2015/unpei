<?php

/*
 * 修理厂服务管理
 */

class Servicemanage {
    /*
     * 获得服务记录列表
     */

    public static function servicegetmanagelist() {
        $OrganID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'vehicle' => array(
                'with' => array('owner')));
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = {$OrganID}", "AND");
        $criteria->addCondition("t.Status = 0", "AND");
        $dataProvider = new CActiveDataProvider('ServiceRecord',
                        array(
                            'criteria' => $criteria,
                            'pagination' => array(
                                'pageSize' => '4'
                            ),
                        )
        );
//        return $dataProvider;
        $data = $dataProvider->getData();
        foreach ($data as $k => $val) {
            if ($val['ServiceType'] == 2) {
                $val['ServiceType'] = "配件服务";
            } elseif ($val['ServiceType'] == 3) {
                $val['ServiceType'] = "全部服务";
            } else {
                $val['ServiceType'] = "保养服务";
            }
        }

        $dataProvider->setData($data);
        return $dataProvider;
    }

}

?>
