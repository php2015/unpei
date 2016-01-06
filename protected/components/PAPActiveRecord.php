<?php

/*
 * @desc 嘉配商城数据模型
 * 
 */

class PAPActiveRecord extends CActiveRecord {

    public function getDbConnection() {
        return Yii::app()->papdb;
    }

}

?>
