<?php

/**
 * This is the model class for table "{{cart}}".
 *
 * The followings are the available columns in table '{{cart}}':
 * @property string $ID
 * @property string $BuyerID
 * @property string $BuyerName
 * @property string $SellerID
 * @property string $SellerName
 * @property integer $GoodsID
 * @property string $GoodsNum
 * @property string $GoodsOE
 * @property string $GoodsName
 * @property string $CpName
 * @property string $Brand
 * @property string $ImageUrl
 * @property string $Price
 * @property string $ProPrice
 * @property string $Quantity
 * @property string $ShipCost
 * @property string $CreateTime
 * @property string $UpdateTime
 * @property integer $MakeID
 * @property integer $CarID
 * @property integer $Year
 * @property integer $ModelID
 *
 * The followings are the available model relations:
 * @property Goods $goods
 */
class PapCart extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $Version;

    public function tableName() {
        return '{{cart}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('BuyerID, SellerID, GoodsID, Price, CreateTime, UpdateTime', 'required'),
            array('GoodsID, MakeID, CarID, Year, ModelID', 'numerical', 'integerOnly' => true),
            array('BuyerID, SellerID, Quantity', 'length', 'max' => 11),
            array('BuyerName, SellerName, GoodsNum, GoodsOE, GoodsName, CpName, Brand', 'length', 'max' => 64),
            array('ImageUrl', 'length', 'max' => 255),
            array('Price, ProPrice, ShipCost', 'length', 'max' => 10),
            array('CreateTime, UpdateTime', 'length', 'max' => 13),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Version, BuyerID, BuyerName, SellerID, SellerName, GoodsID, GoodsNum, GoodsOE, GoodsName, CpName, Brand, ImageUrl, Price, ProPrice, Quantity, ShipCost, CreateTime, UpdateTime, MakeID, CarID, Year, ModelID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'goods' => array(self::BELONGS_TO, 'Goods', 'GoodsID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'BuyerID' => 'Buyer',
            'BuyerName' => 'Buyer Name',
            'SellerID' => 'Seller',
            'SellerName' => 'Seller Name',
            'GoodsID' => 'Goods',
            'GoodsNum' => 'Goods Num',
            'GoodsOE' => 'Goods Oe',
            'GoodsName' => 'Goods Name',
            'CpName' => 'Cp Name',
            'Brand' => 'Brand',
            'ImageUrl' => 'Image Url',
            'Price' => 'Price',
            'ProPrice' => 'Pro Price',
            'Quantity' => 'Quantity',
            'ShipCost' => 'Ship Cost',
            'Version' => 'Version',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'MakeID' => 'Make',
            'CarID' => 'Car',
            'Year' => 'Year',
            'ModelID' => 'Model',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('BuyerID', $this->BuyerID, true);
        $criteria->compare('BuyerName', $this->BuyerName, true);
        $criteria->compare('SellerID', $this->SellerID, true);
        $criteria->compare('SellerName', $this->SellerName, true);
        $criteria->compare('GoodsID', $this->GoodsID);
        $criteria->compare('GoodsNum', $this->GoodsNum, true);
        $criteria->compare('GoodsOE', $this->GoodsOE, true);
        $criteria->compare('GoodsName', $this->GoodsName, true);
        $criteria->compare('CpName', $this->CpName, true);
        $criteria->compare('Brand', $this->Brand, true);
        $criteria->compare('ImageUrl', $this->ImageUrl, true);
        $criteria->compare('Price', $this->Price, true);
        $criteria->compare('ProPrice', $this->ProPrice, true);
        $criteria->compare('Quantity', $this->Quantity, true);
        $criteria->compare('ShipCost', $this->ShipCost, true);
        $criteria->compare('CreateTime', $this->CreateTime, true);
        $criteria->compare('UpdateTime', $this->UpdateTime, true);
        $criteria->compare('MakeID', $this->MakeID);
        $criteria->compare('CarID', $this->CarID);
        $criteria->compare('Year', $this->Year);
        $criteria->compare('ModelID', $this->ModelID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return CDbConnection the database connection used for this class
     */
    public function getDbConnection() {
        return Yii::app()->papdb;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PapCart the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
