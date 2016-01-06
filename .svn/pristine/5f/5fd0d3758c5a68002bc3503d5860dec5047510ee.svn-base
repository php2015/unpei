<?php

/**
 * This is the model class for table "{{return_order}}".
 *
 * The followings are the available columns in table '{{return_order}}':
 * @property integer $ID
 * @property string $ReturnNO
 * @property integer $DealerID
 * @property integer $ServiceID
 * @property integer $Status
 * @property string $LogtigCompany
 * @property integer $PayMethod
 * @property string $RefundStatus
 * @property integer $CreateTime
 * @property string $Price
 * @property integer $Type
 * @property string $Result
 * @property string $NoResult
 * @property string $ReShipLogis
 * @property integer $DeliveryTime
 * @property string $AlipayTN
 */
class PapReturnOrder extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PapReturnOrder the static model class
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
        return '{{return_order}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ReturnNO, DealerID, ServiceID, LogtigCompany', 'required'),
            array('DealerID, ServiceID, Status, PayMethod, CreateTime, Type, DeliveryTime', 'numerical', 'integerOnly' => true),
            array('ReturnNO, LogtigCompany, RefundStatus', 'length', 'max' => 20),
            array('Price', 'length', 'max' => 10),
            array('Result, NoResult', 'length', 'max' => 128),
            array('ReShipLogis, AlipayTN', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, ReturnNO, DealerID, ServiceID, Status, LogtigCompany, PayMethod, RefundStatus, CreateTime, Price, Type, Result, NoResult, ReShipLogis, DeliveryTime, AlipayTN', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'returngoods' => array(self::HAS_MANY, 'PapReturnGoods', 'ReturnID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'ReturnNO' => 'Return No',
            'DealerID' => 'Dealer',
            'ServiceID' => 'Service',
            'Status' => 'Status',
            'LogtigCompany' => 'Logtig Company',
            'PayMethod' => 'Pay Method',
            'RefundStatus' => 'Refund Status',
            'CreateTime' => 'Create Time',
            'Price' => 'Price',
            'Type' => 'Type',
            'Result' => 'Result',
            'NoResult' => 'No Result',
            'ReShipLogis' => 'Re Ship Logis',
            'DeliveryTime' => 'Delivery Time',
            'AlipayTN' => 'Alipay Tn',
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
        $criteria->compare('ReturnNO', $this->ReturnNO, true);
        $criteria->compare('DealerID', $this->DealerID);
        $criteria->compare('ServiceID', $this->ServiceID);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('LogtigCompany', $this->LogtigCompany, true);
        $criteria->compare('PayMethod', $this->PayMethod);
        $criteria->compare('RefundStatus', $this->RefundStatus, true);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('Price', $this->Price, true);
        $criteria->compare('Type', $this->Type);
        $criteria->compare('Result', $this->Result, true);
        $criteria->compare('NoResult', $this->NoResult, true);
        $criteria->compare('ReShipLogis', $this->ReShipLogis, true);
        $criteria->compare('DeliveryTime', $this->DeliveryTime);
        $criteria->compare('AlipayTN', $this->AlipayTN, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}