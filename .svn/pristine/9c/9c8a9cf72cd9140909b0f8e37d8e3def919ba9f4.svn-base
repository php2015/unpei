<?php

/**
 * This is the model class for table "{{service_mainbusiness}}".
 *
 * The followings are the available columns in table '{{service_mainbusiness}}':
 * @property integer $userId
 * @property string $serviceType
 * @property string $deepCleaning
 * @property string $vehiclesBeauty
 * @property string $routineMaintenance
 * @property string $diagnosis
 * @property string $wearingParts
 * @property string $professionalRepair
 * @property string $insuranceService
 * @property string $keyWord
 */
class ServiceMainbusiness extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceMainbusiness the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_mainbusiness}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('serviceType, deepCleaning, vehiclesBeauty, routineMaintenance, diagnosis, wearingParts, professionalRepair, insuranceService', 'length', 'max'=>64),
			array('keyWord', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, serviceType, deepCleaning, vehiclesBeauty, routineMaintenance, diagnosis, wearingParts, professionalRepair, insuranceService, keyWord', 'safe', 'on'=>'search'),
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
			'userId' => 'User',
			'serviceType' => 'Service Type',
			'deepCleaning' => 'Deep Cleaning',
			'vehiclesBeauty' => 'Vehicles Beauty',
			'routineMaintenance' => 'Routine Maintenance',
			'diagnosis' => 'Diagnosis',
			'wearingParts' => 'Wearing Parts',
			'professionalRepair' => 'Professional Repair',
			'insuranceService' => 'Insurance Service',
			'keyWord' => 'Key Word',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('userId',$this->userId);
		$criteria->compare('serviceType',$this->serviceType,true);
		$criteria->compare('deepCleaning',$this->deepCleaning,true);
		$criteria->compare('vehiclesBeauty',$this->vehiclesBeauty,true);
		$criteria->compare('routineMaintenance',$this->routineMaintenance,true);
		$criteria->compare('diagnosis',$this->diagnosis,true);
		$criteria->compare('wearingParts',$this->wearingParts,true);
		$criteria->compare('professionalRepair',$this->professionalRepair,true);
		$criteria->compare('insuranceService',$this->insuranceService,true);
		$criteria->compare('keyWord',$this->keyWord,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}