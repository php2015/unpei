<?php

/*
 * @desc 工作台数据模型
 * 
 */
class JPDActiveRecord extends CActiveRecord{
    
    public function getDbConnection(){
           return  Yii::app()->jpdb;
    }
}
?>
