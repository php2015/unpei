<?php

/**
 * This is the model class for table "{{logistics}}".
 *
 * The followings are the available columns in table '{{logistics}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $LogisticsCompany
 * @property string $LogisticsDescription
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class Logistics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Logistics the static model class
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
		return '{{logistics}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, LogisticsCompany, CreateTime, UpdateTime, Status', 'required'),
			array('OrganID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('LogisticsCompany', 'length', 'max'=>20),
			array('LogisticsDescription', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, LogisticsCompany, LogisticsDescription, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'LogisticsCompany' => 'Logistics Company',
			'LogisticsDescription' => 'Logistics Description',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Status' => 'Status',
		);
	}

        public function getDbConnection()
	{
		return Yii::app()->jpdb;
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
		$criteria->compare('LogisticsCompany',$this->LogisticsCompany,true);
		$criteria->compare('LogisticsDescription',$this->LogisticsDescription,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}