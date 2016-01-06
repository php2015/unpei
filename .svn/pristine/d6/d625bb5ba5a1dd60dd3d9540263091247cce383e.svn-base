<?php

/**
 * This is the model class for table "{{service_reserve_purchase}}".
 *
 * The followings are the available columns in table '{{service_reserve_purchase}}':
 * @property integer $ID
 * @property integer $GoodsID
 * @property integer $Num
 * @property string $GcategoryCode
 * @property integer $ReserveID
 * @property integer $OrderID
 * @property integer $OrganID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $InOrder
 */
class ServiceReservePurchase extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_reserve_purchase}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GoodsID, Num, GcategoryCode, ReserveID', 'required'),
			array('GoodsID, Num, ReserveID, OrderID, OrganID, CreateTime, UpdateTime, InOrder', 'numerical', 'integerOnly'=>true),
			array('GcategoryCode', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, GoodsID, Num, GcategoryCode, ReserveID, OrderID, OrganID, CreateTime, UpdateTime, InOrder', 'safe', 'on'=>'search'),
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
			'Num' => 'Num',
			'GcategoryCode' => 'Gcategory Code',
			'ReserveID' => 'Reserve',
			'OrderID' => 'Order',
			'OrganID' => 'Organ',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'InOrder' => 'In Order',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('Num',$this->Num);
		$criteria->compare('GcategoryCode',$this->GcategoryCode,true);
		$criteria->compare('ReserveID',$this->ReserveID);
		$criteria->compare('OrderID',$this->OrderID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('InOrder',$this->InOrder);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->jpdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceReservePurchase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
