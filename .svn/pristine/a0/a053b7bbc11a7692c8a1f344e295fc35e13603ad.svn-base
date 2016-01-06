<?php

/**
 * This is the model class for table "{{gcategory}}".
 *
 * The followings are the available columns in table '{{gcategory}}':
 * @property string $ID
 * @property string $Name
 * @property string $PinYin
 * @property string $Code
 * @property integer $ParentID
 * @property integer $Level
 * @property integer $SortOrder
 * @property integer $IsShow
 */
class JPDGcategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JPDGcategory the static model class
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
		return '{{gcategory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ParentID, Level, SortOrder, IsShow', 'numerical', 'integerOnly'=>true),
			array('Name, PinYin', 'length', 'max'=>100),
			array('Code', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Name, PinYin, Code, ParentID, Level, SortOrder, IsShow', 'safe', 'on'=>'search'),
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
			'Name' => 'Name',
			'PinYin' => 'Pin Yin',
			'Code' => 'Code',
			'ParentID' => 'Parent',
			'Level' => 'Level',
			'SortOrder' => 'Sort Order',
			'IsShow' => 'Is Show',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('PinYin',$this->PinYin,true);
		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('ParentID',$this->ParentID);
		$criteria->compare('Level',$this->Level);
		$criteria->compare('SortOrder',$this->SortOrder);
		$criteria->compare('IsShow',$this->IsShow);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}