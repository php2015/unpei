<?php

/**
 * This is the model class for table "{{dealer_vehicles}}".
 *
 * The followings are the available columns in table '{{dealer_vehicles}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $Make
 * @property string $Car
 * @property string $Year
 * @property string $Model
 */
class JpdDealerVehicles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JpdDealerVehicles the static model class
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
		return Yii::app()->jpdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dealer_vehicles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID', 'required'),
			array('OrganID', 'numerical', 'integerOnly'=>true),
			array('Make, Car, Year, Model', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, Make, Car, Year, Model', 'safe', 'on'=>'search'),
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
                    'organ' => array(self::BELONGS_TO, 'Organ', 'OrganID'),
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
			'Make' => 'Make',
			'Car' => 'Car',
			'Year' => 'Year',
			'Model' => 'Model',
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
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Car',$this->Car,true);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('Model',$this->Model,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}