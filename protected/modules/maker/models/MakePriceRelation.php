<?php

/**
 * This is the model class for table "{{make_price_relation}}".
 *
 * The followings are the available columns in table '{{make_price_relation}}':
 * @property integer $ID
 * @property integer $GoodsID
 * @property integer $TypeID
 * @property string $Price
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class MakePriceRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakePriceRelation the static model class
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
		return '{{make_price_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GoodsID, TypeID', 'required'),
			array('GoodsID, TypeID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('Price', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, GoodsID, TypeID, Price, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'GoodsID' => 'Goods',
			'TypeID' => 'Type',
			'Price' => 'Price',
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
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('TypeID',$this->TypeID);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}