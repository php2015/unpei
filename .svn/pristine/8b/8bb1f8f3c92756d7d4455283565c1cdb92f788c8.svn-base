<?php

/**
 * This is the model class for table "{{admin_template_type}}".
 *
 * The followings are the available columns in table '{{admin_template_type}}':
 * @property integer $ID
 * @property string $Name
 * @property string $Describe
 * @property integer $ParentID
 * @property integer $CreateTime
 * @property integer $Status
 */
class AdminTemplateType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminTemplateType the static model class
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
		return '{{admin_template_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ParentID, CreateTime, Status', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>64),
			array('Describe', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Name, Describe, ParentID, CreateTime, Status', 'safe', 'on'=>'search'),
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
			'Name' => '模版类型',
			'Describe' => 'Describe',
			'ParentID' => 'Parent',
			'CreateTime' => 'Create Time',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Describe',$this->Describe,true);
		$criteria->compare('ParentID',$this->ParentID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}