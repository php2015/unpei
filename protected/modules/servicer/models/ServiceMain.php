<?php

/**
 * This is the model class for table "{{service_main}}".
 *
 * The followings are the available columns in table '{{service_main}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $OrganType
 * @property string $DeepClean
 * @property string $CarBeauty
 * @property string $RouMain
 * @property string $Diagnos
 * @property string $ProRepair
 * @property string $WearParts
 * @property string $AutoService
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class ServiceMain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceMain the static model class
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
		return '{{service_main}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('OrganType', 'length', 'max'=>12),
			array('DeepClean, CarBeauty, RouMain, Diagnos, AutoService', 'length', 'max'=>64),
			array('ProRepair, WearParts', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, OrganType, DeepClean, CarBeauty, RouMain, Diagnos, ProRepair, WearParts, AutoService, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'routine' => array(self::HAS_MANY,'ServiceMainRoutine','MainID'),
			'diagnos' => array(self::HAS_MANY,'ServiceMainDiagnos','MainID'),
			'parts' => array(self::HAS_MANY,'ServiceMainWearparts','MainID'),
			'repair' => array(self::HAS_MANY,'ServiceMainRepair','MainID')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'OrganID' => 'Organ',
			'OrganType' => 'Organ Type',
			'DeepClean' => 'Deep Clean',
			'CarBeauty' => 'Car Beauty',
			'RouMain' => 'Rou Main',
			'Diagnos' => 'Diagnos',
			'ProRepair' => 'Pro Repair',
			'WearParts' => 'Wear Parts',
			'AutoService' => 'Auto Service',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('OrganType',$this->OrganType,true);
		$criteria->compare('DeepClean',$this->DeepClean,true);
		$criteria->compare('CarBeauty',$this->CarBeauty,true);
		$criteria->compare('RouMain',$this->RouMain,true);
		$criteria->compare('Diagnos',$this->Diagnos,true);
		$criteria->compare('ProRepair',$this->ProRepair,true);
		$criteria->compare('WearParts',$this->WearParts,true);
		$criteria->compare('AutoService',$this->AutoService,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}