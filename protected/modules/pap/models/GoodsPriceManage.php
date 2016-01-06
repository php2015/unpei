<?php

/**
 * This is the model class for table "{{goods_price_manage}}".
 *
 * The followings are the available columns in table '{{goods_price_manage}}':
 * @property string $ID
 * @property string $OrganID
 * @property string $CooperationType
 * @property string $PriceRatio
 * @property string $UpdateTime
 */
class GoodsPriceManage extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GoodsPriceManage the static model class
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
        return '{{goods_price_manage}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID', 'required'),
            array('OrganID', 'length', 'max' => 11),
            array('CooperationType', 'length', 'max' => 1),
            array('UpdateTime', 'length', 'max' => 13),
            array('ID, OrganID, CooperationType, PriceRatio, UpdateTime', 'safe', 'on' => 'search'),
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
            'CooperationType' => 'Cooperation Type',
            'PriceRatio' => 'Price Ratio',
            'UpdateTime' => 'Update Time',
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
        $criteria->compare('OrganID', $this->OrganID, true);
        $criteria->compare('CooperationType', $this->CooperationType, true);
        $criteria->compare('PriceRatio', $this->PriceRatio, true);
        $criteria->compare('UpdateTime', $this->UpdateTime, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}