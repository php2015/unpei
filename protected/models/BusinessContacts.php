<?php

/**
 * This is the model class for table "{{business_contacts}}".
 *
 * The followings are the available columns in table '{{business_contacts}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $contact_user_id
 * @property integer $jiapart_ID
 * @property string $customertype
 * @property string $cooperationtype
 * @property string $customercategory
 * @property string $name
 * @property string $sex
 * @property string $companyname
 * @property string $phone
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $email
 * @property string $weixin
 * @property string $QQ
 * @property string $memo
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $Status
 */
class BusinessContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BusinessContacts the static model class
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
		return '{{business_contacts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, jiapart_ID, create_time, update_time, Status', 'numerical', 'integerOnly'=>true),
			array('contact_user_id', 'length', 'max'=>10),
			array('customertype, name, QQ', 'length', 'max'=>20),
			array('cooperationtype, email, weixin', 'length', 'max'=>50),
			array('customercategory', 'length', 'max'=>16),
			array('sex', 'length', 'max'=>4),
			array('companyname, address', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>15),
			array('province, city, area', 'length', 'max'=>12),
			array('memo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, contact_user_id, jiapart_ID, customertype, cooperationtype, customercategory, name, sex, companyname, phone, province, city, area, address, email, weixin, QQ, memo, create_time, update_time, Status', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'contact_user_id' => 'Contact User',
			'jiapart_ID' => 'Jiapart',
			'customertype' => 'Customertype',
			'cooperationtype' => 'Cooperationtype',
			'customercategory' => 'Customercategory',
			'name' => 'Name',
			'sex' => 'Sex',
			'companyname' => 'Companyname',
			'phone' => 'Phone',
			'province' => 'Province',
			'city' => 'City',
			'area' => 'Area',
			'address' => 'Address',
			'email' => 'Email',
			'weixin' => 'Weixin',
			'QQ' => 'Qq',
			'memo' => 'Memo',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('contact_user_id',$this->contact_user_id,true);
		$criteria->compare('jiapart_ID',$this->jiapart_ID);
		$criteria->compare('customertype',$this->customertype,true);
		$criteria->compare('cooperationtype',$this->cooperationtype,true);
		$criteria->compare('customercategory',$this->customercategory,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('weixin',$this->weixin,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}