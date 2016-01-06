<?php

/**
 * This is the model class for table "{{financial_bank}}".
 *
 * The followings are the available columns in table '{{financial_bank}}':
 * @property integer $ID
 * @property string $OwnerName
 * @property string $BankName
 * @property string $OpenBankName
 * @property string $BankAccount
 * @property string $Uses
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 * @property integer $if_recommend
 */
class FinancialBank extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FinancialBank the static model class
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
		return '{{financial_bank}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BankName, BankAccount, OrganID, UserID', 'required'),
			array('OrganID, UserID, CreateTime, UpdateTime, Status, if_recommend', 'numerical', 'integerOnly'=>true),
			array('OwnerName, BankName, OpenBankName', 'length', 'max'=>24),
			array('BankAccount, Uses', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OwnerName, BankName, OpenBankName, BankAccount, Uses, OrganID, UserID, CreateTime, UpdateTime, Status, if_recommend', 'safe', 'on'=>'search'),
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
			'OwnerName' => 'Owner Name',
			'BankName' => 'Bank Name',
			'OpenBankName' => 'Open Bank Name',
			'BankAccount' => 'Bank Account',
			'Uses' => 'Uses',
			'OrganID' => 'Organ',
			'UserID' => 'User',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Status' => 'Status',
			'if_recommend' => 'If Recommend',
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
		$criteria->compare('OwnerName',$this->OwnerName,true);
		$criteria->compare('BankName',$this->BankName,true);
		$criteria->compare('OpenBankName',$this->OpenBankName,true);
		$criteria->compare('BankAccount',$this->BankAccount,true);
		$criteria->compare('Uses',$this->Uses,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('if_recommend',$this->if_recommend);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}