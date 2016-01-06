<?php

/**
 * This is the model class for table "{{discount_code}}".
 *
 * The followings are the available columns in table '{{discount_code}}':
 * @property integer $ID
 * @property string $Code
 * @property integer $DiscountID
 * @property integer $OwnerID
 * @property string $OwnerName
 * @property string $OwnerPhone
 * @property integer $SendWay
 * @property integer $SendStatus
 * @property integer $SendTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class DiscountCode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiscountCode the static model class
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
		return '{{discount_code}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DiscountID, OwnerID, SendWay, SendStatus, SendTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('Code', 'length', 'max'=>128),
			array('OwnerName, OwnerPhone', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Code, DiscountID, OwnerID, OwnerName, OwnerPhone, SendWay, SendStatus, SendTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'Code' => 'Code',
			'DiscountID' => 'Discount',
			'OwnerID' => 'Owner',
			'OwnerName' => 'Owner Name',
			'OwnerPhone' => 'Owner Phone',
			'SendWay' => 'Send Way',
			'SendStatus' => 'Send Status',
			'SendTime' => 'Send Time',
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
		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('DiscountID',$this->DiscountID);
		$criteria->compare('OwnerID',$this->OwnerID);
		$criteria->compare('OwnerName',$this->OwnerName,true);
		$criteria->compare('OwnerPhone',$this->OwnerPhone,true);
		$criteria->compare('SendWay',$this->SendWay);
		$criteria->compare('SendStatus',$this->SendStatus);
		$criteria->compare('SendTime',$this->SendTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}