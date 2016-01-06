<?php

class MdbVehcleVersion extends EMongoDocument {

    public $_id;
    public $GoodsID;
    public $Organ;
    public $VehcleInfo;
    public $VehVersion;

    // This has to be defined in every model, this is same as with standard Yii ActiveRecord
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    // This method is required!
    public function getCollectionName() {
        return 'vehcle_version';
    }

    public function rules() {
        return array(
//          array('login, pass', 'required'),
//          array('login, pass', 'length', 'max' => 20),
//          array('name', 'length', 'max' => 255),
        );
    }

    public function attributeLabels() {
        return array(
            '_id' => 'ID',
            'GoodsID' => '商品ID',
            'Organ' => '机构ID',
            'VehcleInfo' => '版本详情',
            'VehVersion' => '车系版本',
        );
    }

}
