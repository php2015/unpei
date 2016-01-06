<?php

/**
 * This is the model class for table "{{make_promit_brand}}".
 *
 * The followings are the available columns in table '{{make_promit_brand}}':
 * @property integer $ID
 * @property integer $DealerID
 * @property string $Level
 * @property integer $OrganID
 * @property string $BrandName
 * @property string $PromitArea
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Settlement
 * @property integer $CustomerType
 */
class MakePromitBrand extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakePromitBrand the static model class
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
		return '{{make_promit_brand}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DealerID, Level, OrganID, BrandName, PromitArea, UserID, CreateTime', 'required'),
			array('DealerID, OrganID, UserID, CreateTime, UpdateTime, Settlement, CustomerType', 'numerical', 'integerOnly'=>true),
			array('Level', 'length', 'max'=>2),
			array('BrandName, PromitArea', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, DealerID, Level, OrganID, BrandName, PromitArea, UserID, CreateTime, UpdateTime, Settlement, CustomerType', 'safe', 'on'=>'search'),
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
			'DealerID' => 'Dealer',
			'Level' => 'Level',
			'OrganID' => 'Organ',
			'BrandName' => 'Brand Name',
			'PromitArea' => 'Promit Area',
			'UserID' => 'User',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Settlement' => 'Settlement',
			'CustomerType' => 'Customer Type',
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
		$criteria->compare('DealerID',$this->DealerID);
		$criteria->compare('Level',$this->Level,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('BrandName',$this->BrandName,true);
		$criteria->compare('PromitArea',$this->PromitArea,true);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Settlement',$this->Settlement);
		$criteria->compare('CustomerType',$this->CustomerType);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}