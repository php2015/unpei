<?php

/**
 * This is the model class for table "{{help_contact}}".
 *
 * The followings are the available columns in table '{{help_contact}}':
 * @property integer $ID
 * @property integer $Recommend
 * @property string $Suit
 * @property string $OpenTime
 * @property string $Desc
 * @property string $TelPhone
 * @property string $NickName
 * @property string $QQ
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class CsHelpContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CsHelpContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->csdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{help_contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Suit, Desc, CreateTime', 'required'),
			array('Recommend, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('Suit, Desc', 'length', 'max'=>255),
			array('OpenTime', 'length', 'max'=>100),
			array('TelPhone, NickName, QQ', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Recommend, Suit, OpenTime, Desc, TelPhone, NickName, QQ, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'Recommend' => 'Recommend',
			'Suit' => 'Suit',
			'OpenTime' => 'Open Time',
			'Desc' => 'Desc',
			'TelPhone' => 'Tel Phone',
			'NickName' => 'Nick Name',
			'QQ' => 'Qq',
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
		$criteria->compare('Recommend',$this->Recommend);
		$criteria->compare('Suit',$this->Suit,true);
		$criteria->compare('OpenTime',$this->OpenTime,true);
		$criteria->compare('Desc',$this->Desc,true);
		$criteria->compare('TelPhone',$this->TelPhone,true);
		$criteria->compare('NickName',$this->NickName,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}