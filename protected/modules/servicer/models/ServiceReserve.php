<?php

/**
 * This is the model class for table "{{service_reserve}}".
 *
 * The followings are the available columns in table '{{service_reserve}}':
 * @property integer $ID
 * @property string $LicensePlate
 * @property string $Car
 * @property string $Code
 * @property integer $Mileage
 * @property integer $StartTime
 * @property integer $ReserveTime
 * @property integer $OrganID
 * @property string $ReserveNum
 * @property string $BeginTime
 * @property string $EndTime
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property string $Remark
 * @property string $OwnerName
 * @property string $Phone
 */
class ServiceReserve extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_reserve}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LicensePlate, OwnerName, Phone', 'required'),
			array('Mileage, StartTime, ReserveTime, OrganID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('LicensePlate, Car, OwnerName, Phone', 'length', 'max'=>64),
			array('Code', 'length', 'max'=>50),
			array('ReserveNum, BeginTime, EndTime', 'length', 'max'=>10),
			array('Remark', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, LicensePlate, Car, Code, Mileage, StartTime, ReserveTime, OrganID, ReserveNum, BeginTime, EndTime, CreateTime, UpdateTime, Remark, OwnerName, Phone', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'LicensePlate' => 'License Plate',
			'Car' => 'Car',
			'Code' => 'Code',
			'Mileage' => 'Mileage',
			'StartTime' => 'Start Time',
			'ReserveTime' => 'Reserve Time',
			'OrganID' => 'Organ',
			'ReserveNum' => 'Reserve Num',
			'BeginTime' => 'Begin Time',
			'EndTime' => 'End Time',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Remark' => 'Remark',
			'OwnerName' => 'Owner Name',
			'Phone' => 'Phone',
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
		$criteria->compare('LicensePlate',$this->LicensePlate,true);
		$criteria->compare('Car',$this->Car,true);
		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('Mileage',$this->Mileage);
		$criteria->compare('StartTime',$this->StartTime);
		$criteria->compare('ReserveTime',$this->ReserveTime);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('ReserveNum',$this->ReserveNum,true);
		$criteria->compare('BeginTime',$this->BeginTime,true);
		$criteria->compare('EndTime',$this->EndTime,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Remark',$this->Remark,true);
		$criteria->compare('OwnerName',$this->OwnerName,true);
		$criteria->compare('Phone',$this->Phone,true);

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
	 * @return ServiceReserve the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
