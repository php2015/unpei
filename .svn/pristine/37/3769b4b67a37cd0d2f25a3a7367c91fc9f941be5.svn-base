<?php

/**
 * This is the model class for table "{{evaluation_goods}}".
 *
 * The followings are the available columns in table '{{evaluation_goods}}':
 * @property string $ID
 * @property integer $OrganID
 * @property integer $GoodsID
 * @property integer $BuyerID
 * @property string $BuyerToEvalRemark
 * @property string $SellerToEvalRemark
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class PapEvaluationGoods extends JPDActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PapEvaluationGoods the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return CDbConnection database connection
     */
    public function getDbConnection() {
        return Yii::app()->papdb;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{evaluation_goods}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID, GoodsID, BuyerID, CreateTime', 'required'),
            array('OrganID, GoodsID, BuyerID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly' => true),
            array('BuyerToEvalRemark, SellerToEvalRemark', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, OrganID, GoodsID, BuyerID, BuyerToEvalRemark, SellerToEvalRemark, CreateTime, UpdateTime, Status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'image' => array(self::HAS_MANY, 'PapEvaluationGoodsImage', 'EvalID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'OrganID' => 'Organ',
            'GoodsID' => 'Goods',
            'BuyerID' => 'Buyer',
            'BuyerToEvalRemark' => '商品评价内容',
            'SellerToEvalRemark' => 'Seller To Eval Remark',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'Status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('GoodsID', $this->GoodsID);
        $criteria->compare('BuyerID', $this->BuyerID);
        $criteria->compare('BuyerToEvalRemark', $this->BuyerToEvalRemark, true);
        $criteria->compare('SellerToEvalRemark', $this->SellerToEvalRemark, true);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);
        $criteria->compare('Status', $this->Status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
