<?php

/**
 * This is the model class for table "{{user_orderservice}}".
 *
 * The followings are the available columns in table '{{user_orderservice}}':
 * @property integer $ID
 * @property string $ProuductName
 * @property string $Amount
 * @property integer $OrderDate
 * @property integer $EndDate
 * @property string $Auditor
 * @property string $PayMethod
 * @property integer $OrganID
 * @property integer $UserID
 * @property string $Remark
 */
class UserOrderservice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserOrderservice the static model class
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
		return '{{user_orderservice}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrderDate, EndDate, OrganID, UserID', 'numerical', 'integerOnly'=>true),
			array('ProuductName, Auditor, Remark', 'length', 'max'=>64),
			array('Amount', 'length', 'max'=>9),
			array('PayMethod', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ProuductName, Amount, OrderDate, EndDate, Auditor, PayMethod, OrganID, UserID, Remark', 'safe', 'on'=>'search'),
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
			'ProuductName' => 'Prouduct Name',
			'Amount' => 'Amount',
			'OrderDate' => 'Order Date',
			'EndDate' => 'End Date',
			'Auditor' => 'Auditor',
			'PayMethod' => 'Pay Method',
			'OrganID' => 'Organ',
			'UserID' => 'User',
			'Remark' => 'Remark',
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
		$criteria->compare('ProuductName',$this->ProuductName,true);
		$criteria->compare('Amount',$this->Amount,true);
		$criteria->compare('OrderDate',$this->OrderDate);
		$criteria->compare('EndDate',$this->EndDate);
		$criteria->compare('Auditor',$this->Auditor,true);
		$criteria->compare('PayMethod',$this->PayMethod,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('Remark',$this->Remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}