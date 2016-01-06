<?php

/**
 * This is the model class for table "{{logistics_area}}".
 *
 * The followings are the available columns in table '{{logistics_area}}':
 * @property integer $ID
 * @property integer $LogID
 * @property string $Province
 * @property string $City
 * @property string $Area
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class JpdLogisticsArea extends PAPActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{logistics_area}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LogID', 'required'),
			array('LogID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('Province, City, Area', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, LogID, Province, City, Area, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'LogID' => '物流配送ID',
			'Province' => 'Province',
			'City' => 'City',
			'Area' => 'Area',
			'CreateTime' => '创建时间',
			'UpdateTime' => '更新时间',
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
		$criteria->compare('LogID',$this->LogID);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Area',$this->Area,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

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
	 * @return JpdLogisticsArea the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
