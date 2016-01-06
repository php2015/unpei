<?php

/**
 * This is the model class for table "{{service}}".
 *
 * The followings are the available columns in table '{{service}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $PositionCount
 * @property string $TechnicianCount
 * @property string $ParkingDigits
 * @property string $OpenTime
 * @property string $ReservationMode
 */
class Service extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, OrganID', 'numerical', 'integerOnly'=>true),
			array('PositionCount, TechnicianCount, ParkingDigits', 'length', 'max'=>64),
			array('OpenTime', 'length', 'max'=>100),
			array('ReservationMode', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganID, PositionCount, TechnicianCount, ParkingDigits, OpenTime, ReservationMode', 'safe', 'on'=>'search'),
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
			'PositionCount' => 'Position Count',
			'TechnicianCount' => 'Technician Count',
			'ParkingDigits' => 'Parking Digits',
			'OpenTime' => 'Open Time',
			'ReservationMode' => 'Reservation Mode',
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
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('PositionCount',$this->PositionCount,true);
		$criteria->compare('TechnicianCount',$this->TechnicianCount,true);
		$criteria->compare('ParkingDigits',$this->ParkingDigits,true);
		$criteria->compare('OpenTime',$this->OpenTime,true);
		$criteria->compare('ReservationMode',$this->ReservationMode,true);

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
	 * @return Service the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}