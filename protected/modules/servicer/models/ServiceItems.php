<?php

/**
 * This is the model class for table "{{service_items}}".
 *
 * The followings are the available columns in table '{{service_items}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $ItemNum
 * @property string $ItemName
 * @property string $ItemQuote
 * @property string $ItemIntro
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class ServiceItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceItems the static model class
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
		return '{{service_items}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('ItemNum', 'length', 'max'=>50),
			array('ItemName', 'length', 'max'=>100),
			array('ItemQuote', 'length', 'max'=>10),
			array('ItemIntro', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, ItemNum, ItemName, ItemQuote, ItemIntro, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'OrganID' => 'Organ',
			'ItemNum' => 'Item Num',
			'ItemName' => 'Item Name',
			'ItemQuote' => 'Item Quote',
			'ItemIntro' => 'Item Intro',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Status' => 'Status',
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
		$criteria->compare('ItemNum',$this->ItemNum,true);
		$criteria->compare('ItemName',$this->ItemName,true);
		$criteria->compare('ItemQuote',$this->ItemQuote,true);
		$criteria->compare('ItemIntro',$this->ItemIntro,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}