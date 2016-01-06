<?php

/**
 * This is the model class for table "{{service_car_owner}}".
 *
 * The followings are the available columns in table '{{service_car_owner}}':
 * @property integer $ID
 * @property string $Name
 * @property string $Phone
 * @property string $NickName
 * @property integer $Sex
 * @property string $City
 * @property string $Email
 * @property string $QQ
 * @property string $DrivingLicense
 * @property integer $DrivingEnvironment
 * @property integer $OrganID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class ServiceCarOwner extends JPDActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_car_owner}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, Phone, DrivingLicense, OrganID, CreateTime', 'required'),
            array('Sex, DrivingEnvironment, OrganID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly' => true),
            array('Name, Phone, NickName', 'length', 'max' => 64),
            array('City', 'length', 'max' => 45),
            array('Email', 'length', 'max' => 128),
            array('QQ', 'length', 'max' => 24),
            array('DrivingLicense', 'length', 'max' => 30),
            array('Phone', 'match', 'pattern' => '/^(1(([35][0-9])|(47)|[8][01256789]))\d{8}$/', 'message' => "手机号格式不正确"),
            array('Email', 'match', 'pattern' => '/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i', 'message' => "邮箱格式不正确"),
            array('QQ', 'match', 'pattern' => '/^\d{5,12}$/', 'message' => "QQ格式不正确"),
            array('DrivingLicense', 'match', 'pattern' => '/^[^<>&~]*$/', 'message' => "不允许<、>、&、~等特殊符号"),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, Name, Phone, NickName, Sex, City, Email, QQ, DrivingLicense, DrivingEnvironment, OrganID, CreateTime, UpdateTime, Status', 'safe', 'on' => 'search'),
        );
    }
 
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'car' => array(self::HAS_MANY, 'ServiceCar', 'OwnerID', 'order' => 't.CreateTime desc'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Name' => '车主姓名',
            'Phone' => '手机号',
            'NickName' => '昵称',
            'Sex' => '性别',
            'City' => '所在城市',
            'Email' => '邮箱',
            'QQ' => 'QQ',
            'DrivingLicense' => '驾驶证号',
            'DrivingEnvironment' => '驾驶环境',
            'OrganID' => '机构编号',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'Status' => 'Status',
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
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Phone', $this->Phone, true);
        $criteria->compare('NickName', $this->NickName, true);
        $criteria->compare('Sex', $this->Sex);
        $criteria->compare('City', $this->City, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('QQ', $this->QQ, true);
        $criteria->compare('DrivingLicense', $this->DrivingLicense, true);
        $criteria->compare('DrivingEnvironment', $this->DrivingEnvironment);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);
        $criteria->compare('Status', $this->Status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return CDbConnection the database connection used for this class
     */
    public function getDbConnection() {
        return Yii::app()->jpdb;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ServiceCarOwner the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
