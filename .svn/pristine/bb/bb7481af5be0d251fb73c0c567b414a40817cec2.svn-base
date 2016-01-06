<?php

/**
 * This is the model class for table "{{make_goods_temp}}".
 *
 * The followings are the available columns in table '{{make_goods_temp}}':
 * @property integer $id
 * @property string $goods_no
 * @property string $goods_name
 * @property string $brand
 * @property string $category
 * @property string $benchmarking_brand
 * @property string $benchmarking_sn
 * @property string $marketprice
 * @property string $salesprice
 * @property string $discountprice
 * @property integer $inventory
 * @property string $senddays
 * @property string $description
 * @property string $params
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 */
class MakeGoodsTemp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeGoodsTemp the static model class
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
		return '{{make_goods_temp}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inventory, OrganID, UserID, CreateTime', 'numerical', 'integerOnly'=>true),
			array('goods_no', 'length', 'max'=>32),
			array('goods_name', 'length', 'max'=>64),
			array('brand, category, benchmarking_brand, benchmarking_sn, senddays', 'length', 'max'=>24),
			array('marketprice, salesprice, discountprice', 'length', 'max'=>9),
			array('description, params', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, goods_no, goods_name, brand, category, benchmarking_brand, benchmarking_sn, marketprice, salesprice, discountprice, inventory, senddays, description, params, OrganID, UserID, CreateTime', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'goods_no' => 'Goods No',
			'goods_name' => 'Goods Name',
			'brand' => 'Brand',
			'category' => 'Category',
			'benchmarking_brand' => 'Benchmarking Brand',
			'benchmarking_sn' => 'Benchmarking Sn',
			'marketprice' => 'Marketprice',
			'salesprice' => 'Salesprice',
			'discountprice' => 'Discountprice',
			'inventory' => 'Inventory',
			'senddays' => 'Senddays',
			'description' => 'Description',
			'params' => 'Params',
			'OrganID' => 'Organ',
			'UserID' => 'User',
			'CreateTime' => 'Create Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('goods_no',$this->goods_no,true);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('benchmarking_brand',$this->benchmarking_brand,true);
		$criteria->compare('benchmarking_sn',$this->benchmarking_sn,true);
		$criteria->compare('marketprice',$this->marketprice,true);
		$criteria->compare('salesprice',$this->salesprice,true);
		$criteria->compare('discountprice',$this->discountprice,true);
		$criteria->compare('inventory',$this->inventory);
		$criteria->compare('senddays',$this->senddays,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}