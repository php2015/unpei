<?php

/**
 * This is the model class for table "{{server_order_evaluation}}".
 *
 * The followings are the available columns in table '{{server_order_evaluation}}':
 * @property string $ID
 * @property integer $OrderID
 * @property integer $BuyerID
 * @property integer $BuyerToItemDescription
 * @property integer $BuyerToSellerManner
 * @property integer $BuyerToSellerSpeed
 * @property integer $BuyerToShipSpeed
 * @property integer $BuyerToShipManner
 */
class ServerOrderEvaluation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServerOrderEvaluation the static model class
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
		return '{{server_order_evaluation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BuyerID', 'required'),
			array('OrderID, BuyerID, BuyerToItemDescription, BuyerToSellerManner, BuyerToSellerSpeed, BuyerToShipSpeed, BuyerToShipManner', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrderID, BuyerID, BuyerToItemDescription, BuyerToSellerManner, BuyerToSellerSpeed, BuyerToShipSpeed, BuyerToShipManner', 'safe', 'on'=>'search'),
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
			'BuyerID' => 'Buyer',
			'BuyerToItemDescription' => 'Buyer To Item Description',
			'BuyerToSellerManner' => 'Buyer To Seller Manner',
			'BuyerToSellerSpeed' => 'Buyer To Seller Speed',
			'BuyerToShipSpeed' => 'Buyer To Ship Speed',
			'BuyerToShipManner' => 'Buyer To Ship Manner',
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
		$criteria->compare('OrderID',$this->OrderID);
		$criteria->compare('BuyerID',$this->BuyerID);
		$criteria->compare('BuyerToItemDescription',$this->BuyerToItemDescription);
		$criteria->compare('BuyerToSellerManner',$this->BuyerToSellerManner);
		$criteria->compare('BuyerToSellerSpeed',$this->BuyerToSellerSpeed);
		$criteria->compare('BuyerToShipSpeed',$this->BuyerToShipSpeed);
		$criteria->compare('BuyerToShipManner',$this->BuyerToShipManner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}