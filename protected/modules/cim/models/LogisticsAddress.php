<?php

/**
 * This is the model class for table "{{logistics_address}}".
 *
 * The followings are the available columns in table '{{logistics_address}}':
 * @property string $ID
 * @property integer $LogisticsID
 * @property string $Bigarea
 * @property string $Province
 * @property string $City
 * @property string $Area
 */
class LogisticsAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LogisticsAddress the static model class
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
		return '{{logistics_address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LogisticsID', 'required'),
			array('LogisticsID', 'numerical', 'integerOnly'=>true),
			array('Bigarea, Province, City, Area', 'length', 'max'=>24),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, LogisticsID, Bigarea, Province, City, Area', 'safe', 'on'=>'search'),
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
			'LogisticsID' => 'Logistics',
			'Bigarea' => 'Bigarea',
			'Province' => 'Province',
			'City' => 'City',
			'Area' => 'Area',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('LogisticsID',$this->LogisticsID);
		$criteria->compare('Bigarea',$this->Bigarea,true);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Area',$this->Area,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}