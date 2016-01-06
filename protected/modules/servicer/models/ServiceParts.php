<?php

/**
 * This is the model class for table "{{service_parts}}".
 *
 * The followings are the available columns in table '{{service_parts}}':
 * @property integer $ID
 * @property integer $ServiceID
 * @property integer $UserID
 * @property string $OperateType
 * @property string $PartName
 * @property string $Brand
 * @property integer $Num
 * @property string $OE
 * @property string $TechnicianName
 * @property string $RepairCause
 * @property string $RevisedNote
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class ServiceParts extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_parts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ServiceID, UserID, OperateType, PartName, CreateTime, Status', 'required'),
			array('ServiceID, UserID, Num, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('OperateType', 'length', 'max'=>2),
			array('PartName, Brand, OE', 'length', 'max'=>50),
			array('TechnicianName', 'length', 'max'=>24),
			array('RepairCause, RevisedNote', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, ServiceID, UserID, OperateType, PartName, Brand, Num, OE, TechnicianName, RepairCause, RevisedNote, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'ServiceID' => 'Service',
			'UserID' => 'User',
			'OperateType' => 'Operate Type',
			'PartName' => 'Part Name',
			'Brand' => 'Brand',
			'Num' => 'Num',
			'OE' => 'Oe',
			'TechnicianName' => 'Technician Name',
			'RepairCause' => '维护原因',
			'RevisedNote' => '修后说明',
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
		$criteria->compare('ServiceID',$this->ServiceID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('OperateType',$this->OperateType,true);
		$criteria->compare('PartName',$this->PartName,true);
		$criteria->compare('Brand',$this->Brand,true);
		$criteria->compare('Num',$this->Num);
		$criteria->compare('OE',$this->OE,true);
		$criteria->compare('TechnicianName',$this->TechnicianName,true);
		$criteria->compare('RepairCause',$this->RepairCause,true);
		$criteria->compare('RevisedNote',$this->RevisedNote,true);
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
	 * @return ServiceParts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
