<?php

/*
 * @desc 经销商采购平台数据模型
 * 
 */
class DSPActiveRecord extends CActiveRecord{
    
    public function getDbConnection(){
          return  Yii::app()->dspdb;
    }
}
?>