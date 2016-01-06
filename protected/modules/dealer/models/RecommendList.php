<?php

/**
 * This is the model class for table "{{recommend_list}}".
 *
 * The followings are the available columns in table '{{recommend_list}}':
 * @property integer $ID
 * @property string $Name
 * @property string $MobPhone
 * @property string $CompanyType
 * @property string $Email
 * @property string $CompanyName
 * @property string $Province
 * @property string $City
 * @property string $Area
 * @property string $Address
 * @property string $TelePhone
 * @property integer $RecomStatus
 * @property integer $OrganID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class RecommendList extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{recommend_list}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, CompanyType, OrganID', 'required'),
			array('RecomStatus, OrganID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('Name, Email, CompanyName, Address', 'length', 'max'=>64),
			array('MobPhone, TelePhone', 'length', 'max'=>13),
			array('CompanyType', 'length', 'max'=>10),
			array('Province, City, Area', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Name, MobPhone, CompanyType, Email, CompanyName, Province, City, Area, Address, TelePhone, RecomStatus, OrganID, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'record' => array(self::HAS_ONE,'RecommendRecord','RecomID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Name' => 'Name',
			'MobPhone' => 'Mob Phone',
			'CompanyType' => 'Company Type',
			'Email' => 'Email',
			'CompanyName' => 'Company Name',
			'Province' => 'Province',
			'City' => 'City',
			'Area' => 'Area',
			'Address' => 'Address',
			'TelePhone' => 'Tele Phone',
			'RecomStatus' => 'Recom Status',
			'OrganID' => 'Organ',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('MobPhone',$this->MobPhone,true);
		$criteria->compare('CompanyType',$this->CompanyType,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('CompanyName',$this->CompanyName,true);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Area',$this->Area,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('TelePhone',$this->TelePhone,true);
		$criteria->compare('RecomStatus',$this->RecomStatus);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

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
	 * @return RecommendList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
