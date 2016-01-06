<?php

/**
 * This is the model class for table "{{pushmessage}}".
 *
 * The followings are the available columns in table '{{pushmessage}}':
 * @property integer $ID
 * @property string $Content
 * @property integer $SendWay
 * @property integer $UserID
 * @property integer $OrganID
 * @property integer $SendTime
 */
class Pushmessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pushmessage the static model class
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
		return '{{pushmessage}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SendWay, UserID, OrganID, SendTime', 'numerical', 'integerOnly'=>true),
			array('Content', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Content, SendWay, UserID, OrganID, SendTime', 'safe', 'on'=>'search'),
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
			'Content' => 'Content',
			'SendWay' => 'Send Way',
			'UserID' => 'User',
			'OrganID' => 'Organ',
			'SendTime' => 'Send Time',
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
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('SendWay',$this->SendWay);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('SendTime',$this->SendTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}