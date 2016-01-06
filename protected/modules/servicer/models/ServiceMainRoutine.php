<?php

/**
 * This is the model class for table "{{service_main_routine}}".
 *
 * The followings are the available columns in table '{{service_main_routine}}':
 * @property integer $ID
 * @property integer $MainID
 * @property string $OrganType
 * @property string $Make
 * @property string $Car
 */
class ServiceMainRoutine extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceMainRoutine the static model class
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
		return '{{service_main_routine}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MainID', 'numerical', 'integerOnly'=>true),
			array('OrganType', 'length', 'max'=>12),
			array('Make', 'length', 'max'=>24),
			array('Car', 'length', 'max'=>248),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, MainID, OrganType, Make, Car', 'safe', 'on'=>'search'),
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
			'MainID' => 'Main',
			'OrganType' => 'Organ Type',
			'Make' => 'Make',
			'Car' => 'Car',
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
		$criteria->compare('MainID',$this->MainID);
		$criteria->compare('OrganType',$this->OrganType,true);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Car',$this->Car,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}