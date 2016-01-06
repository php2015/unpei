<?php

/**
 * This is the model class for table "{{user_account}}".
 *
 * The followings are the available columns in table '{{user_account}}':
 * @property integer $ID
 * @property string $TotalBalance
 * @property string $CashBalance
 * @property string $CouponsBalance
 * @property string $Remark
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class UserAccount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserAccount the static model class
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
		return '{{user_account}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, UserID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('TotalBalance, CashBalance, CouponsBalance', 'length', 'max'=>9),
			array('Remark', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, TotalBalance, CashBalance, CouponsBalance, Remark, OrganID, UserID, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'TotalBalance' => 'Total Balance',
			'CashBalance' => 'Cash Balance',
			'CouponsBalance' => 'Coupons Balance',
			'Remark' => 'Remark',
			'OrganID' => 'Organ',
			'UserID' => 'User',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('TotalBalance',$this->TotalBalance,true);
		$criteria->compare('CashBalance',$this->CashBalance,true);
		$criteria->compare('CouponsBalance',$this->CouponsBalance,true);
		$criteria->compare('Remark',$this->Remark,true);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}