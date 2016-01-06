<?php

/**
 * This is the model class for table "{{apply_service}}".
 *
 * The followings are the available columns in table '{{apply_service}}':
 * @property integer $ID
 * @property string $OrganName
 * @property string $Name
 * @property string $StaffNum
 * @property string $TechnicianNum
 * @property string $PositionNum
 * @property string $Phone
 * @property string $TelPhone
 * @property string $Email
 * @property string $Province
 * @property string $City
 * @property string $Area
 * @property string $Address
 * @property string $QQ
 * @property string $Status
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class JpdApplyService extends PAPActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{apply_service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganName, Name, Phone, Email', 'required'),
			array('CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('OrganName, Name, TelPhone, Email', 'length', 'max'=>128),
			array('StaffNum, TechnicianNum, PositionNum, Address', 'length', 'max'=>64),
			array('Phone', 'length', 'max'=>20),
			array('Province, City, Area', 'length', 'max'=>24),
			array('QQ', 'length', 'max'=>11),
			array('Status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganName, Name, StaffNum, TechnicianNum, PositionNum, Phone, TelPhone, Email, Province, City, Area, Address, QQ, Status, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'OrganName' => '机构名称',
			'Name' => '申请人姓名',
			'StaffNum' => '店铺人数',
			'TechnicianNum' => '技师人数',
			'PositionNum' => '工位数',
			'Phone' => '手机',
			'TelPhone' => '座机',
			'Email' => '邮箱',
			'Province' => '省',
			'City' => '市',
			'Area' => '区',
			'Address' => '街道地址',
			'QQ' => 'QQ号',
			'Status' => '(1/2/3 /待审核/审核通过/审核未通过)',
			'CreateTime' => '创建时间',
			'UpdateTime' => '修改时间',
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
		$criteria->compare('OrganName',$this->OrganName,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('StaffNum',$this->StaffNum,true);
		$criteria->compare('TechnicianNum',$this->TechnicianNum,true);
		$criteria->compare('PositionNum',$this->PositionNum,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('TelPhone',$this->TelPhone,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Area',$this->Area,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('Status',$this->Status,true);
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
	 * @return JpdApplyService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
