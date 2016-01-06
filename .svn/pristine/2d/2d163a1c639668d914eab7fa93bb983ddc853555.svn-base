<?php

/**
 * This is the model class for table "{{organ_employees}}".
 *
 * The followings are the available columns in table '{{organ_employees}}':
 * @property integer $ID
 * @property string $Name
 * @property integer $Birth
 * @property integer $ExpireTime
 * @property string $Sex
 * @property string $Job
 * @property string $JobNum
 * @property string $TelPhone
 * @property string $Email
 * @property integer $Phone
 * @property string $Remark
 * @property integer $DepartmentID
 * @property integer $OrganID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class OrganEmployees extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{organ_employees}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepartmentID, OrganID, CreateTime', 'required'),
			array('ExpireTime, Phone, DepartmentID, OrganID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>60),
			array('Sex', 'length', 'max'=>3),
			array('Job, JobNum', 'length', 'max'=>20),
			array('TelPhone', 'length', 'max'=>15),
			array('Email', 'length', 'max'=>30),
			array('Email', 'unique'),
			array('Remark', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Name, Birth, ExpireTime, Sex, Job, JobNum, TelPhone, Email, Phone, Remark, DepartmentID, OrganID, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'user' => array(self::HAS_ONE, 'User', '', 'on' => 't.ID=user.EmployeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Name' => '姓名',
			'Birth' => '生日',
			'ExpireTime' => '过期时间',
			'Sex' => '性别',
			'Job' => '职位',
			'JobNum' => '工号',
			'TelPhone' => '座机',
			'Email' => 'Email',
			'Phone' => '手机',
			'Remark' => '备注',
			'DepartmentID' => '部门',
			'OrganID' => '机构',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Birth',$this->Birth);
		$criteria->compare('ExpireTime',$this->ExpireTime);
		$criteria->compare('Sex',$this->Sex,true);
		$criteria->compare('Job',$this->Job,true);
		$criteria->compare('JobNum',$this->JobNum,true);
		$criteria->compare('TelPhone',$this->TelPhone,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Phone',$this->Phone);
		$criteria->compare('Remark',$this->Remark,true);
		$criteria->compare('DepartmentID',$this->DepartmentID);
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
	 * @return OrganEmployees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
