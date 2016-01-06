<?php

class SupportService {
    
    //获取保养服务记录
    public static function getServiceData($params) {
        $OrganID = Yii::app()->user->getOrganID();
        $sql = "SELECT jsp.RecordID, jsr.CreateTime, jsr.Mileage 
                FROM jpd_support_parts AS jsp, jpd_support_record AS jsr 
                WHERE jsp.RecordID = jsr.ID AND jsr.OrganID = '{$OrganID}' AND jsr.CarID = '{$params['CarID']}' AND jsr.Status = 0
                GROUP BY jsp.RecordID ORDER BY jsr.CreateTime DESC";
        $countsql = "SELECT COUNT(*) FROM (" . $sql . ") as tab";
        //echo $sql;die;
        $count = Yii::app()->jpdb->createCommand($countsql)->queryScalar();

        $dataProvider = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->jpdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
        $data = $dataProvider->getData();
        //var_dump($data);die;
        foreach ($data as $key => $val) {
            $data[$key]['partsinfo'] = self::getServiceDataByServiceID($val['RecordID']);
        }
        $dataProvider->setData($data);
        return $dataProvider;
    }

    /*
     * 获取保养信息
     * params $ServiceID 保养项目ID
     */
    public static function getServiceDataByServiceID($ServiceID){
        $sql = "SELECT jmi.ItemName, jmi.ItemID, jsp.RecordID
                FROM jpd_support_parts AS jsp LEFT JOIN jpd_maintenance_item AS jmi
                ON jsp.ItemID = jmi.ItemID WHERE jsp.RecordID = '{$ServiceID}' AND jsp.Status = 0 
                GROUP BY jsp.ItemID ORDER BY jsp.ID ASC";
        $parts = Yii::app()->jpdb->createCommand($sql)->queryAll();
        //var_dump($parts);die;
        foreach ($parts as $key=>$val){
            $infosql = "SELECT GoodsName, Brand, Num, GoodsNum, PartsLevel FROM jpd_support_parts 
                        WHERE RecordID = '{$ServiceID}' AND ItemID = '{$val['ItemID']}' AND Status = 0 ORDER BY ID ASC";
            $info = Yii::app()->jpdb->createCommand($infosql)->queryAll();
            foreach ($info as $k=>$v) {
                $info[$k]['PartsLevel'] = Yii::app()->params['PartsLevel'][$v['PartsLevel']];
            }
            $parts[$key]['info'] = $info;
        }
        return $parts;
    }
    
    /*
     * 获取保养信息列表（修改配件登记）
     * params $ServiceID 保养项目ID
     */
    public static function getServiceDataByServiceIDList($ServiceID){
        if(is_array($ServiceID)){
            $ServiceID = $ServiceID['ServiceID'];
        }
        $sql = "SELECT jmi.ItemName, jmi.ItemID, jsp.RecordID, jsr.CreateTime, jsr.Mileage, jsr.Remark
                FROM jpd_support_parts AS jsp LEFT JOIN jpd_maintenance_item AS jmi ON jsp.ItemID = jmi.ItemID
                LEFT JOIN jpd_support_record AS jsr ON jsp.RecordID = jsr.ID WHERE jsp.RecordID = '{$ServiceID}' 
                AND jsp.Status = 0 GROUP BY jsp.ItemID ORDER BY jsp.ID ASC";
        $parts = Yii::app()->jpdb->createCommand($sql)->queryAll();
        foreach ($parts as $key=>$val){
            $infosql = "SELECT ID, GoodsName, Brand, Num, GoodsNum, PartsLevel FROM jpd_support_parts 
                        WHERE RecordID = '{$ServiceID}' AND ItemID = '{$val['ItemID']}' AND Status = 0 ORDER BY ID ASC";
//            $info = Yii::app()->jpdb->createCommand($infosql)->queryAll();
//            $parts[$key]['info'] = self::getPartsInfo($info);
            $parts[$key]['info'] = Yii::app()->jpdb->createCommand($infosql)->queryAll();
        }
        return $parts;
    }
    
    //获取配件信息
//    public static function getPartsLevel($info){
//        foreach ($info as $key=>$val) {
//            $val['PartsLevel'] = Yii::app()->params[$val['PartsLevel']];
//        }
//        return $info;
//    }
    
    //获取保养项目信息
    public static function getMaintenanceItemData(){
        $sql = "SELECT * FROM jpd_maintenance_item";
        $Data = Yii::app()->jpdb->CreateCommand($sql)->queryAll();
        return $Data;
    }
}
