<?php

/**
 * This is the model class for table "{{organ_department}}".
 *
 * The followings are the available columns in table '{{organ_department}}':
 * @property integer $ID
 * @property string $DepartmentName
 * @property integer $ParentID
 * @property string $Describe
 * @property integer $OrganID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class OrganDepartment extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{organ_department}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepartmentName, OrganID, CreateTime', 'required'),
			//array('ParentID, OrganID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('DepartmentName', 'length', 'max'=>64),
			array('Describe', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, DepartmentName, ParentID, Describe, OrganID, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'DepartmentName' => '部门名称',
			'ParentID' => '上级部门',
			'Describe' => '描述',
			'OrganID' => 'Organ',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('DepartmentName',$this->DepartmentName,true);
		$criteria->compare('ParentID',$this->ParentID);
		$criteria->compare('Describe',$this->Describe,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

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
	 * @return OrganDepartment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
