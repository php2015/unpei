<?php

/**
 * This is the model class for table "{{order_address}}".
 *
 * The followings are the available columns in table '{{order_address}}':
 * @property integer $ID
 * @property integer $OrderID
 * @property string $ShippingName
 * @property string $ZipCode
 * @property string $Mobile
 * @property string $TelePhone
 * @property string $Province
 * @property string $City
 * @property string $Area
 * @property string $Address
 * @property integer $CreateTime
 */
class PapOrderAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order_address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ShippingName,ZipCode,Province,City,Area,Address', 'required'),
			array('OrderID, CreateTime', 'numerical', 'integerOnly'=>true),
			array('ShippingName, ZipCode, Mobile, TelePhone, Province, City, Area', 'length', 'max'=>24),
			array('Address', 'length', 'max'=>64),
                      //  array('ZipCode', 'match', 'pattern' =>'/^[0-9]d{5}$/','message'=>'邮编格式不正确'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrderID, ShippingName, ZipCode, Mobile, TelePhone, Province, City, Area, Address, CreateTime', 'safe', 'on'=>'search'),
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
			'ShippingName' => '收货人',
			'ZipCode' => '邮编',
			'Mobile' => 'Mobile',
			'TelePhone' => '手机号',
			'Province' => '省',
			'City' => '市',
			'Area' => '区',
			'Address' => '街道地址',
			'CreateTime' => '创建时间',
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
		$criteria->compare('OrderID',$this->OrderID);
		$criteria->compare('ShippingName',$this->ShippingName,true);
		$criteria->compare('ZipCode',$this->ZipCode,true);
		$criteria->compare('Mobile',$this->Mobile,true);
		$criteria->compare('TelePhone',$this->TelePhone,true);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Area',$this->Area,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('CreateTime',$this->CreateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->papdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PapOrderAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
