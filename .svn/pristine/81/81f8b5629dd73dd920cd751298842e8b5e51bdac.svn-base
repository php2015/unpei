<?php

/**
 * This is the model class for table "{{service_record}}".
 *
 * The followings are the available columns in table '{{service_record}}':
 * @property integer $ID
 * @property integer $CarID
 * @property string $ServiceType
 * @property integer $Mileage
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 * @property string $Remark
 */
class ServiceRecord extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CarID, ServiceType, OrganID, UserID, CreateTime', 'required'),
			array('CarID, Mileage, OrganID, UserID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('ServiceType', 'length', 'max'=>2),
			array('Remark', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, CarID, ServiceType, Mileage, OrganID, UserID, CreateTime, UpdateTime, Status, Remark', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'vehicle' => array(self::BELONGS_TO,'ServiceCar','CarID'),
			'parts' => array(self::HAS_MANY,'ServiceParts','ServiceID','order'=>'t.CreateTime desc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'CarID' => 'Car',
			'ServiceType' => 'Service Type',
			'Mileage' => 'Mileage',
			'OrganID' => 'Organ',
			'UserID' => 'User',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Status' => 'Status',
			'Remark' => 'Remark',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('CarID',$this->CarID);
		$criteria->compare('ServiceType',$this->ServiceType,true);
		$criteria->compare('Mileage',$this->Mileage);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('Remark',$this->Remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->jpdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
