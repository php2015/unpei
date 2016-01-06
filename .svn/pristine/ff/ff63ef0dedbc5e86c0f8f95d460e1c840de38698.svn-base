<?php

/**
 * This is the model class for table "{{cash_deposit}}".
 *
 * The followings are the available columns in table '{{cash_deposit}}':
 * @property string $ID
 * @property integer $OrganID
 * @property string $QualityMoney
 * @property string $BaseMoney
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class PapCashDeposit extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{cash_deposit}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID, CreateTime, UpdateTime', 'numerical', 'integerOnly' => true),
            array('QualityMoney, BaseMoney', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, OrganID, QualityMoney, BaseMoney, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
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
            'QualityMoney' => 'Quality Money',
            'BaseMoney' => 'Base Money',
            'CreateTime' => 'Create Time',
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

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('QualityMoney', $this->QualityMoney, true);
        $criteria->compare('BaseMoney', $this->BaseMoney, true);
        $criteria->compare('CreateTime', $this->CreateTime);
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
     * @return PapCashDeposit the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
