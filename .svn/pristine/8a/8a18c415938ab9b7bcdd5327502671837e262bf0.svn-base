<?php

class MdbGoodsLog extends EMongoDocument {

    public $_id;
    public $GoodsID;
    public $UpdateTime;
    public $EditInfo;
    public $type;

    // This has to be defined in every model, this is same as with standard Yii ActiveRecord
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    // This method is required!
    public function getCollectionName() {
        return 'goods_log';
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
            'UpdateTime' => '修改时间',
            'EditInfo' => '修改内容',
            'type' => '修改类型',
        );
    }

}
