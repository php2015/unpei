<?php

/**
 * This is the model class for table "{{evaluation_service}}".
 *
 * The followings are the available columns in table '{{evaluation_service}}':
 * @property string $ID
 * @property integer $OrganID
 * @property integer $BuyerID
 * @property integer $OrderID
 * @property integer $BuyerFamily
 * @property integer $BuyerAccept
 * @property integer $BuyerBusiness
 * @property integer $BuyerSpeed
 * @property integer $BuyerCommunication
 * @property integer $BuyerScore
 * @property string $Evaluation
 * @property integer $CreateTime
 */
class PapEvaluationService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PapEvaluationService the static model class
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
		return '{{evaluation_service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, BuyerID, OrderID', 'required'),
			array('OrganID, BuyerID, OrderID, BuyerFamily, BuyerAccept, BuyerBusiness, BuyerSpeed, BuyerCommunication, BuyerScore, CreateTime', 'numerical', 'integerOnly'=>true),
			array('Evaluation', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, BuyerID, OrderID, BuyerFamily, BuyerAccept, BuyerBusiness, BuyerSpeed, BuyerCommunication, BuyerScore, Evaluation, CreateTime', 'safe', 'on'=>'search'),
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
			'BuyerID' => 'Buyer',
			'OrderID' => 'Order',
			'BuyerFamily' => 'Buyer Family',
			'BuyerAccept' => 'Buyer Accept',
			'BuyerBusiness' => 'Buyer Business',
			'BuyerSpeed' => 'Buyer Speed',
			'BuyerCommunication' => 'Buyer Communication',
			'BuyerScore' => 'Buyer Score',
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
		$criteria->compare('BuyerID',$this->BuyerID);
		$criteria->compare('OrderID',$this->OrderID);
		$criteria->compare('BuyerFamily',$this->BuyerFamily);
		$criteria->compare('BuyerAccept',$this->BuyerAccept);
		$criteria->compare('BuyerBusiness',$this->BuyerBusiness);
		$criteria->compare('BuyerSpeed',$this->BuyerSpeed);
		$criteria->compare('BuyerCommunication',$this->BuyerCommunication);
		$criteria->compare('BuyerScore',$this->BuyerScore);
		$criteria->compare('Evaluation',$this->Evaluation,true);
		$criteria->compare('CreateTime',$this->CreateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}