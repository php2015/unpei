<?php

/**
 * This is the model class for table "{{order_min_turnover}}".
 *
 * The followings are the available columns in table '{{order_min_turnover}}':
 * @property string $ID
 * @property string $OrganID
 * @property string $MinTurnover
 * @property string $UpdateTime
 */
class PapOrderMinTurnover extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{order_min_turnover}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID', 'required'),
            array('OrganID, MinTurnover', 'length', 'max' => 11),
            array('UpdateTime', 'length', 'max' => 13),
//            array('MinTurnover', 'compare', 'compareValue' => '-1', 'operator' => '>', 'message' => '最小金额不能为负数'),
            array('MinTurnover', 'match', 'pattern' => '/^\d{0,7}(\.\d{0,2})?$/', 'message' => '请输入数字(例:0.00),最高保留两位小数!'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, OrganID, MinTurnover, UpdateTime', 'safe', 'on' => 'search'),
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
            'MinTurnover' => 'Min Turnover',
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
        $criteria->compare('OrganID', $this->OrganID, true);
        $criteria->compare('MinTurnover', $this->MinTurnover, true);
        $criteria->compare('UpdateTime', $this->UpdateTime, true);

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
     * @return PapOrderMinTurnover the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
