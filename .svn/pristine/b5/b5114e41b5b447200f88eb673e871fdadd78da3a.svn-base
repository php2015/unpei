<?php

/**
 * This is the model class for table "{{make_type}}".
 *
 * The followings are the available columns in table '{{make_type}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $TypeName
 * @property string $TypeDesc
 * @property integer $TypeQuantity
 * @property integer $IsDefault
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class MakeType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeType the static model class
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
		return '{{make_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, TypeName', 'required'),
			array('OrganID, TypeQuantity, IsDefault, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('TypeName', 'length', 'max'=>24),
			array('TypeDesc', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, TypeName, TypeDesc, TypeQuantity, IsDefault, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'OrganID' => 'Organ',
			'TypeName' => 'Type Name',
			'TypeDesc' => 'Type Desc',
			'TypeQuantity' => 'Type Quantity',
			'IsDefault' => 'Is Default',
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
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('TypeName',$this->TypeName,true);
		$criteria->compare('TypeDesc',$this->TypeDesc,true);
		$criteria->compare('TypeQuantity',$this->TypeQuantity);
		$criteria->compare('IsDefault',$this->IsDefault);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}