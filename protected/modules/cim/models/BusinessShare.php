<?php

/**
 * This is the model class for table "{{business_share}}".
 *
 * The followings are the available columns in table '{{business_share}}':
 * @property integer $ID
 * @property integer $InitiatorID
 * @property integer $ShareID
 * @property string $InitiatorName
 * @property string $ShareName
 * @property integer $ShareType
 * @property string $VerifyInfo
 * @property integer $Status
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class BusinessShare extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BusinessShare the static model class
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
		return '{{business_share}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('InitiatorID, ShareID, ShareType', 'required'),
			array('InitiatorID, ShareID, ShareType, Status, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('InitiatorName, ShareName, VerifyInfo', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, InitiatorID, ShareID, InitiatorName, ShareName, ShareType, VerifyInfo, Status, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'InitiatorID' => 'Initiator',
			'ShareID' => 'Share',
			'InitiatorName' => 'Initiator Name',
			'ShareName' => 'Share Name',
			'ShareType' => 'Share Type',
			'VerifyInfo' => 'Verify Info',
			'Status' => 'Status',
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
		$criteria->compare('InitiatorID',$this->InitiatorID);
		$criteria->compare('ShareID',$this->ShareID);
		$criteria->compare('InitiatorName',$this->InitiatorName,true);
		$criteria->compare('ShareName',$this->ShareName,true);
		$criteria->compare('ShareType',$this->ShareType);
		$criteria->compare('VerifyInfo',$this->VerifyInfo,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}