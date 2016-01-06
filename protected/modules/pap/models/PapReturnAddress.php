<?php

/**
 * This is the model class for table "{{return_address}}".
 *
 * The followings are the available columns in table '{{return_address}}':
 * @property integer $ID
 * @property integer $ReturnID
 * @property string $ShippingName
 * @property string $ZipCode
 * @property string $Mobile
 * @property string $TelePhone
 * @property string $Province
 * @property string $City
 * @property string $Area
 * @property string $Address
 * @property integer $CreateTime
 *
 * The followings are the available model relations:
 * @property ReturnOrder $return
 */
class PapReturnAddress extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PapReturnAddress the static model class
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
        return '{{return_address}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('ZipCode,ShippingName,Address,Mobile,Province,City,Area', 'required'),
            array('ReturnID, CreateTime', 'numerical', 'integerOnly' => true),
            array('ShippingName, ZipCode, Mobile, TelePhone, Province, City, Area', 'length', 'max' => 24),
            array('Address', 'length', 'max' => 64),
            array('ZipCode', 'match', 'pattern' => '/^[0-9][0-9]{5}$/', 'message' => '邮编格式不正确'),
            array('Mobile', 'match', 'pattern' => '/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/', 'message' => "手机号格式不正确"),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, ReturnID, ShippingName, ZipCode, Mobile, TelePhone, Province, City, Area, Address, CreateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'return' => array(self::BELONGS_TO, 'ReturnOrder', 'ReturnID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'ReturnID' => 'Return',
            'ShippingName' => '收货人姓名',
            'ZipCode' => '邮编',
            'Mobile' => '手机',
            'TelePhone' => 'Tele Phone',
            'Province' => '省',
            'City' => '市',
            'Area' => '区',
            'Address' => '地址',
            'CreateTime' => 'Create Time',
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

        $criteria->compare('ID', $this->ID);
        $criteria->compare('ReturnID', $this->ReturnID);
        $criteria->compare('ShippingName', $this->ShippingName, true);
        $criteria->compare('ZipCode', $this->ZipCode, true);
        $criteria->compare('Mobile', $this->Mobile, true);
        $criteria->compare('TelePhone', $this->TelePhone, true);
        $criteria->compare('Province', $this->Province, true);
        $criteria->compare('City', $this->City, true);
        $criteria->compare('Area', $this->Area, true);
        $criteria->compare('Address', $this->Address, true);
        $criteria->compare('CreateTime', $this->CreateTime);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}