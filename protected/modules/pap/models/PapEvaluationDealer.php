<?php

/**
 * This is the model class for table "{{evaluation_dealer}}".
 *
 * The followings are the available columns in table '{{evaluation_dealer}}':
 * @property string $ID
 * @property integer $OrganID
 * @property integer $SellerID
 * @property integer $OrderID
 * @property integer $SellerBusiness
 * @property integer $SellerService
 * @property integer $SellerExact
 * @property integer $SellerSpeed
 * @property integer $ItemDescription
 * @property integer $SellerPrice
 * @property integer $SellerScore
 * @property string $Evaluation
 * @property integer $CreateTime
 */
class PapEvaluationDealer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PapEvaluationDealer the static model class
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
		return '{{evaluation_dealer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, SellerID, OrderID', 'required'),
			array('OrganID, SellerID, OrderID, SellerBusiness, SellerService, SellerExact, SellerSpeed, ItemDescription, SellerPrice, SellerScore, CreateTime', 'numerical', 'integerOnly'=>true),
			array('Evaluation', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, SellerID, OrderID, SellerBusiness, SellerService, SellerExact, SellerSpeed, ItemDescription, SellerPrice, SellerScore, Evaluation, CreateTime', 'safe', 'on'=>'search'),
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
			'SellerID' => 'Seller',
			'OrderID' => 'Order',
			'SellerBusiness' => 'Seller Business',
			'SellerService' => 'Seller Service',
			'SellerExact' => 'Seller Exact',
			'SellerSpeed' => 'Seller Speed',
			'ItemDescription' => 'Item Description',
			'SellerPrice' => 'Seller Price',
			'SellerScore' => 'Seller Score',
			'Evaluation' => 'Evaluation',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('SellerID',$this->SellerID);
		$criteria->compare('OrderID',$this->OrderID);
		$criteria->compare('SellerBusiness',$this->SellerBusiness);
		$criteria->compare('SellerService',$this->SellerService);
		$criteria->compare('SellerExact',$this->SellerExact);
		$criteria->compare('SellerSpeed',$this->SellerSpeed);
		$criteria->compare('ItemDescription',$this->ItemDescription);
		$criteria->compare('SellerPrice',$this->SellerPrice);
		$criteria->compare('SellerScore',$this->SellerScore);
		$criteria->compare('Evaluation',$this->Evaluation,true);
		$criteria->compare('CreateTime',$this->CreateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}