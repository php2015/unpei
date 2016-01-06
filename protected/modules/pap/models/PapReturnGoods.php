<?php

/**
 * This is the model class for table "{{return_goods}}".
 *
 * The followings are the available columns in table '{{return_goods}}':
 * @property integer $ID
 * @property integer $OrderID
 * @property integer $GoodsID
 * @property integer $ReturnID
 * @property integer $Amount
 * @property integer $BuyAmount
 * @property string $Price
 * @property string $PIN
 * @property integer $BuyTime
 */
class PapReturnGoods extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PapReturnGoods the static model class
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
		return Yii::app()->papdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{return_goods}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrderID, GoodsID, ReturnID', 'required'),
			array('OrderID, GoodsID, ReturnID, Amount, BuyAmount, BuyTime', 'numerical', 'integerOnly'=>true),
			array('Price', 'length', 'max'=>9),
			array('PIN', 'length', 'max'=>124),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrderID, GoodsID, ReturnID, Amount, BuyAmount, Price, PIN, BuyTime', 'safe', 'on'=>'search'),
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
			'OrderID' => 'Order',
			'GoodsID' => 'Goods',
			'ReturnID' => 'Return',
			'Amount' => 'Amount',
			'BuyAmount' => 'Buy Amount',
			'Price' => 'Price',
			'PIN' => 'Pin',
			'BuyTime' => 'Buy Time',
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
		$criteria->compare('OrderID',$this->OrderID);
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('ReturnID',$this->ReturnID);
		$criteria->compare('Amount',$this->Amount);
		$criteria->compare('BuyAmount',$this->BuyAmount);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('PIN',$this->PIN,true);
		$criteria->compare('BuyTime',$this->BuyTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}