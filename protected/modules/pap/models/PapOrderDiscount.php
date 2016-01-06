<?php

/**
 * This is the model class for table "{{order_discount}}".
 *
 * The followings are the available columns in table '{{order_discount}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $OrderType
 * @property string $OrderAlipay
 * @property string $OrderLogis
 * @property integer $UpdateTime
 */
class PapOrderDiscount extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{order_discount}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID, OrderType', 'required'),
            array('OrganID, OrderType, UpdateTime', 'numerical', 'integerOnly' => true),
            array('OrderAlipay, OrderLogis', 'length', 'max' => 12),
//            array('OrderAlipay', 'match', 'pattern' => '/^-?\d+%$/', 'message' => '格式错误'),
//            array('OrderLogis', 'match', 'pattern' => '/^-?\d+%$/', 'message' => '格式错误'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, OrganID, OrderType, OrderAlipay, OrderLogis, UpdateTime', 'safe', 'on' => 'search'),
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
            'OrganID' => 'Organ',
            'OrderType' => 'Order Type',
            'OrderAlipay' => 'Order Alipay',
            'OrderLogis' => 'Order Logis',
            'UpdateTime' => 'Update Time',
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

        $criteria->compare('ID', $this->ID);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('OrderType', $this->OrderType);
        $criteria->compare('OrderAlipay', $this->OrderAlipay, true);
        $criteria->compare('OrderLogis', $this->OrderLogis, true);
        $criteria->compare('UpdateTime', $this->UpdateTime);

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
     * @return PapOrderDiscount the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
