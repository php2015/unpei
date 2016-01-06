<?php

/**
 * This is the model class for table "{{make_goods_version}}".
 *
 * The followings are the available columns in table '{{make_goods_version}}':
 * @property integer $id
 * @property string $version_name
 * @property integer $organID
 * @property integer $userID
 * @property string $goods_oe
 * @property integer $goods_category
 * @property integer $goods_brand
 * @property integer $goods_id
 * @property string $goods_no
 * @property string $goods_name
 * @property string $benchmarking_brand
 * @property string $benchmarking_sn
 * @property integer $maincategory
 * @property integer $subcategory
 * @property integer $standard_id
 * @property string $marketprice
 * @property string $salesprice
 * @property string $discountprice
 * @property string $inventory
 * @property string $senddays
 * @property string $description
 * @property integer $ISdelete
 */
class MakeGoodsVersion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{make_goods_version}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('version_name, goods_id', 'required'),
			array('organID, userID, goods_category, goods_brand, goods_id, maincategory, subcategory, standard_id, ISdelete', 'numerical', 'integerOnly'=>true),
			array('version_name, goods_no, goods_name', 'length', 'max'=>20),
			array('goods_oe, benchmarking_brand', 'length', 'max'=>200),
			array('benchmarking_sn', 'length', 'max'=>25),
			array('marketprice, salesprice, discountprice', 'length', 'max'=>10),
			array('inventory, senddays', 'length', 'max'=>10),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, version_name, organID, userID, goods_oe, goods_category, goods_brand, goods_id, goods_no, goods_name, benchmarking_brand, benchmarking_sn, maincategory, subcategory, standard_id, marketprice, salesprice, discountprice, inventory, senddays, description, ISdelete', 'safe', 'on'=>'search'),
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
			'version_name' => 'Version Name',
			'organID' => 'Organ',
			'userID' => 'User',
			'goods_oe' => 'Goods Oe',
			'goods_category' => 'Goods Category',
			'goods_brand' => 'Goods Brand',
			'goods_id' => 'Goods',
			'goods_no' => 'Goods No',
			'goods_name' => 'Goods Name',
			'benchmarking_brand' => 'Benchmarking Brand',
			'benchmarking_sn' => 'Benchmarking Sn',
			'maincategory' => 'Maincategory',
			'subcategory' => 'Subcategory',
			'standard_id' => 'Standard',
			'marketprice' => 'Marketprice',
			'salesprice' => 'Salesprice',
			'discountprice' => 'Discountprice',
			'inventory' => 'Inventory',
			'senddays' => 'Senddays',
			'description' => 'Description',
			'ISdelete' => 'Isdelete',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('version_name',$this->version_name,true);
		$criteria->compare('organID',$this->organID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('goods_oe',$this->goods_oe,true);
		$criteria->compare('goods_category',$this->goods_category);
		$criteria->compare('goods_brand',$this->goods_brand);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('goods_no',$this->goods_no,true);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('benchmarking_brand',$this->benchmarking_brand,true);
		$criteria->compare('benchmarking_sn',$this->benchmarking_sn,true);
		$criteria->compare('maincategory',$this->maincategory);
		$criteria->compare('subcategory',$this->subcategory);
		$criteria->compare('standard_id',$this->standard_id);
		$criteria->compare('marketprice',$this->marketprice,true);
		$criteria->compare('salesprice',$this->salesprice,true);
		$criteria->compare('discountprice',$this->discountprice,true);
		$criteria->compare('inventory',$this->inventory,true);
		$criteria->compare('senddays',$this->senddays,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('ISdelete',$this->ISdelete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MakeGoodsVersion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
