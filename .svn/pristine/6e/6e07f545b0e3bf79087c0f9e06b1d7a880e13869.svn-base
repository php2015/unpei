<?php

/**
 * This is the model class for table "{{order_goods}}".
 *
 * The followings are the available columns in table '{{order_goods}}':
 * @property string $ID
 * @property string $OrderID
 * @property string $GoodsID
 * @property string $GoodsNum
 * @property string $GoodsOE
 * @property string $GoodsName
 * @property string $CpName
 * @property string $Brand
 * @property string $Price
 * @property string $ProPrice
 * @property string $Quantity
 * @property string $ShipCost
 * @property string $GoodsAmount
 * @property string $CreateTime
 * @property string $UpdateTime
 * @property integer $IsDelete
 * @property string $PN
 * @property integer $ReQuantity
 */
class PapOrderGoods extends JPDActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PapOrderGoods the static model class
     */
    public $ImageUrl;
    public $GoodsOE;
    public $GoodsName;
    public $GoodsNum;
    public $Brand;
    public $CpName;
    public $PartsLevelName;
    public $Carmodeltxt;

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
        return '{{order_goods}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrderID, GoodsID, Price, CreateTime, UpdateTime', 'required'),
            array('IsDelete, ReQuantity', 'numerical', 'integerOnly' => true),
            array('OrderID, GoodsID, Quantity', 'length', 'max' => 11),
            array('GoodsNum,GoodsName, CpName, Brand', 'length', 'max' => 64),
            array('GoodsOE', 'length', 'max' => 255),
            array('Price, ProPrice, ShipCost, GoodsAmount', 'length', 'max' => 10),
            array('CreateTime, UpdateTime', 'length', 'max' => 13),
            array('PN', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, OrderID, GoodsID, GoodsNum, GoodsOE, GoodsName, CpName, Brand, Price, ProPrice, Quantity, ShipCost, GoodsAmount, CreateTime, UpdateTime, IsDelete, PN, ReQuantity', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'OrderID' => 'Order',
            'GoodsID' => 'Goods',
            'GoodsNum' => 'Goods Num',
            'GoodsOE' => 'Goods Oe',
            'GoodsName' => 'Goods Name',
            'CpName' => 'Cp Name',
            'Brand' => 'Brand',
            'Price' => 'Price',
            'ProPrice' => 'Pro Price',
            'Quantity' => 'Quantity',
            'ShipCost' => 'Ship Cost',
            'GoodsAmount' => 'Goods Amount',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'IsDelete' => 'Is Delete',
            'PN' => 'Pn',
            'ReQuantity' => 'Re Quantity',
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
        $criteria->compare('OrderID', $this->OrderID, true);
        $criteria->compare('GoodsID', $this->GoodsID, true);
        $criteria->compare('GoodsNum', $this->GoodsNum, true);
        $criteria->compare('GoodsOE', $this->GoodsOE, true);
        $criteria->compare('GoodsName', $this->GoodsName, true);
        $criteria->compare('CpName', $this->CpName, true);
        $criteria->compare('Brand', $this->Brand, true);
        $criteria->compare('Price', $this->Price, true);
        $criteria->compare('ProPrice', $this->ProPrice, true);
        $criteria->compare('Quantity', $this->Quantity, true);
        $criteria->compare('ShipCost', $this->ShipCost, true);
        $criteria->compare('GoodsAmount', $this->GoodsAmount, true);
        $criteria->compare('CreateTime', $this->CreateTime, true);
        $criteria->compare('UpdateTime', $this->UpdateTime, true);
        $criteria->compare('IsDelete', $this->IsDelete);
        $criteria->compare('PN', $this->PN, true);
        $criteria->compare('ReQuantity', $this->ReQuantity);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
