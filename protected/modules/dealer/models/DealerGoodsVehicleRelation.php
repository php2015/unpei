<?php

/**
 * This is the model class for table "{{dealer_goods_vehicle_relation}}".
 *
 * The followings are the available columns in table '{{dealer_goods_vehicle_relation}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $GoodsID
 * @property string $Make
 * @property string $Car
 * @property string $Year
 * @property string $Model
 * @property string $Marktxt
 * @property string $Cartxt
 * @property string $Modeltxt
 */
class DealerGoodsVehicleRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerGoodsVehicleRelation the static model class
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
		return '{{dealer_goods_vehicle_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, GoodsID, Make, Car, Year, Model', 'required'),
			array('OrganID, GoodsID', 'numerical', 'integerOnly'=>true),
			array('Make, Car, Year, Model', 'length', 'max'=>20),
			array('Marktxt, Cartxt, Modeltxt', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, GoodsID, Make, Car, Year, Model, Marktxt, Cartxt, Modeltxt', 'safe', 'on'=>'search'),
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
			'GoodsID' => 'Goods',
			'Make' => 'Make',
			'Car' => 'Car',
			'Year' => 'Year',
			'Model' => 'Model',
			'Marktxt' => 'Marktxt',
			'Cartxt' => 'Cartxt',
			'Modeltxt' => 'Modeltxt',
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
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Car',$this->Car,true);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('Model',$this->Model,true);
		$criteria->compare('Marktxt',$this->Marktxt,true);
		$criteria->compare('Cartxt',$this->Cartxt,true);
		$criteria->compare('Modeltxt',$this->Modeltxt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}