<?php

/**
 * This is the model class for table "{{pushbuy_record}}".
 *
 * The followings are the available columns in table '{{pushbuy_record}}':
 * @property integer $ID
 * @property integer $PushType
 * @property integer $Count
 * @property integer $PayWay
 * @property string $Amount
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class PushbuyRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PushbuyRecord the static model class
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
		return '{{pushbuy_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PushType, Count, PayWay, OrganID, UserID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('Amount', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, PushType, Count, PayWay, Amount, OrganID, UserID, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'PushType' => 'Push Type',
			'Count' => 'Count',
			'PayWay' => 'Pay Way',
			'Amount' => 'Amount',
			'OrganID' => 'Organ',
			'UserID' => 'User',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
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
		$criteria->compare('PushType',$this->PushType);
		$criteria->compare('Count',$this->Count);
		$criteria->compare('PayWay',$this->PayWay);
		$criteria->compare('Amount',$this->Amount,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}