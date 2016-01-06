<?php

/**
 * This is the model class for table "{{server_goods_evaluation}}".
 *
 * The followings are the available columns in table '{{server_goods_evaluation}}':
 * @property string $ID
 * @property integer $OrganID
 * @property integer $GoodsID
 * @property integer $OrderID
 * @property integer $BuyerID
 * @property string $BuyerToEvalRemark
 * @property string $SellerToEvalRemark
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class ServerGoodsEvaluation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServerGoodsEvaluation the static model class
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
		return '{{server_goods_evaluation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, GoodsID, BuyerID, CreateTime', 'required'),
			array('OrganID, GoodsID, OrderID, BuyerID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('BuyerToEvalRemark, SellerToEvalRemark', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, GoodsID, OrderID, BuyerID, BuyerToEvalRemark, SellerToEvalRemark, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'OrderID' => 'Order',
			'BuyerID' => 'Buyer',
			'BuyerToEvalRemark' => 'Buyer To Eval Remark',
			'SellerToEvalRemark' => 'Seller To Eval Remark',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Status' => 'Status',
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
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('OrderID',$this->OrderID);
		$criteria->compare('BuyerID',$this->BuyerID);
		$criteria->compare('BuyerToEvalRemark',$this->BuyerToEvalRemark,true);
		$criteria->compare('SellerToEvalRemark',$this->SellerToEvalRemark,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}