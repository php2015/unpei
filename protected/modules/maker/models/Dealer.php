<?php

/**
 * This is the model class for table "{{dealer}}".
 *
 * The followings are the available columns in table '{{dealer}}':
 * @property integer $id
 * @property integer $userID
 * @property string $organName
 * @property string $loginPassword
 * @property string $jiapartsId
 * @property string $organPhoto
 * @property string $organIntroduction
 * @property string $Phone
 * @property string $QQ
 * @property string $Email
 * @property string $FoudingDate
 * @property string $CompanySize
 * @property string $BusinessScope
 * @property string $Fax
 * @property string $StoreSize
 * @property string $BusinessBrand
 * @property string $BusinessCate
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $BusinessCateSub
 * @property string $businessCar
 * @property string $businessCarModel
 * @property string $keyword
 * @property string $SaleMoney
 * @property string $Website
 * @property string $ContactPhone
 * @property string $Accredit
 * @property string $CreateTime
 * @property string $address
 */
class Dealer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dealer the static model class
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
		return '{{dealer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID', 'numerical', 'integerOnly'=>true),
			array('organName, loginPassword, Email, BusinessScope, businessCar, businessCarModel, keyword, Accredit, CreateTime, address', 'length', 'max'=>128),
			array('jiapartsId, Phone, QQ, Fax', 'length', 'max'=>24),
			array('organPhoto, organIntroduction, Website', 'length', 'max'=>255),
			array('FoudingDate, CompanySize, StoreSize, BusinessBrand, BusinessCate, province, city, area, BusinessCateSub, SaleMoney, ContactPhone', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, organName, loginPassword, jiapartsId, organPhoto, organIntroduction, Phone, QQ, Email, FoudingDate, CompanySize, BusinessScope, Fax, StoreSize, BusinessBrand, BusinessCate, province, city, area, BusinessCateSub, businessCar, businessCarModel, keyword, SaleMoney, Website, ContactPhone, Accredit, CreateTime, address', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'userID' => 'User',
			'organName' => 'Organ Name',
			'loginPassword' => 'Login Password',
			'jiapartsId' => 'Jiaparts',
			'organPhoto' => 'Organ Photo',
			'organIntroduction' => 'Organ Introduction',
			'Phone' => 'Phone',
			'QQ' => 'QQ',
			'Email' => 'Email',
			'FoudingDate' => 'Fouding Date',
			'CompanySize' => 'Company Size',
			'BusinessScope' => 'Business Scope',
			'Fax' => 'Fax',
			'StoreSize' => 'Store Size',
			'BusinessBrand' => 'Business Brand',
			'BusinessCate' => 'Business Cate',
			'province' => 'Province',
			'city' => 'City',
			'area' => 'Area',
			'BusinessCateSub' => 'Business Cate Sub',
			'businessCar' => 'Business Car',
			'businessCarModel' => 'Business Car Model',
			'keyword' => 'Keyword',
			'SaleMoney' => 'Sale Money',
			'Website' => 'Website',
			'ContactPhone' => 'Contact Phone',
			'Accredit' => 'Accredit',
			'CreateTime' => 'Create Time',
			'address' => 'Address',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('organName',$this->organName,true);
		$criteria->compare('loginPassword',$this->loginPassword,true);
		$criteria->compare('jiapartsId',$this->jiapartsId,true);
		$criteria->compare('organPhoto',$this->organPhoto,true);
		$criteria->compare('organIntroduction',$this->organIntroduction,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('FoudingDate',$this->FoudingDate,true);
		$criteria->compare('CompanySize',$this->CompanySize,true);
		$criteria->compare('BusinessScope',$this->BusinessScope,true);
		$criteria->compare('Fax',$this->Fax,true);
		$criteria->compare('StoreSize',$this->StoreSize,true);
		$criteria->compare('BusinessBrand',$this->BusinessBrand,true);
		$criteria->compare('BusinessCate',$this->BusinessCate,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('BusinessCateSub',$this->BusinessCateSub,true);
		$criteria->compare('businessCar',$this->businessCar,true);
		$criteria->compare('businessCarModel',$this->businessCarModel,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('SaleMoney',$this->SaleMoney,true);
		$criteria->compare('Website',$this->Website,true);
		$criteria->compare('ContactPhone',$this->ContactPhone,true);
		$criteria->compare('Accredit',$this->Accredit,true);
		$criteria->compare('CreateTime',$this->CreateTime,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}