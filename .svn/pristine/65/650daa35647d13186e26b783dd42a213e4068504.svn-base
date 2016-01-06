<?php

/**
 * This is the model class for table "{{dealer_goods_unit}}".
 *
 * The followings are the available columns in table '{{dealer_goods_unit}}':
 * @property integer $ID
 * @property string $UnitName
 * @property string $UnitMemo
 * @property integer $IsDelete
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class DealerGoodsUnit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerGoodsUnit the static model class
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
		return '{{dealer_goods_unit}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UnitName, UnitMemo, OrganID, UserID', 'required'),
			array('IsDelete, OrganID, UserID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('UnitName', 'length', 'max'=>64),
			array('UnitMemo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UnitName, UnitMemo, IsDelete, OrganID, UserID, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'UnitName' => 'Unit Name',
			'UnitMemo' => 'Unit Memo',
			'IsDelete' => 'Is Delete',
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
		$criteria->compare('UnitName',$this->UnitName,true);
		$criteria->compare('UnitMemo',$this->UnitMemo,true);
		$criteria->compare('IsDelete',$this->IsDelete);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}