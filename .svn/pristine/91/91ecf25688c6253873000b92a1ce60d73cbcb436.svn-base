<?php

/**
 * This is the model class for table "{{dealer_business_contact}}".
 *
 * The followings are the available columns in table '{{dealer_business_contact}}':
 * @property integer $id
 * @property integer $dealer_id
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
 */
class DealerBusinessContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerBusinessContact the static model class
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
		return '{{dealer_business_contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyname,name,customertype,cooperationtype', 'required'),
			array('dealer_id, jiapart_ID, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('contact_user_id', 'length', 'max'=>10),
			array('customertype, name, email, QQ', 'length', 'max'=>20),
			array('cooperationtype, weixin', 'length', 'max'=>50),
			array('customercategory', 'length', 'max'=>16),
			array('sex', 'length', 'max'=>4),
			array('companyname, address', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>15),
			array('province, city, area', 'length', 'max'=>12),
			array('memo', 'length', 'max'=>255),
			array('phone', 'match', 'allowEmpty'=>false, 'pattern'=>"/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$|(^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$)/",'message'=>'电话格式错误'),
			array('email', 'email','message'=>'邮箱格式错误'),
			array('QQ', 'match',  'allowEmpty'=>true, 'pattern'=>"/^[1-9]\d{4,10}$/",'message'=>'QQ号码格式错误'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dealer_id, contact_user_id, jiapart_ID, customertype, cooperationtype, customercategory, name, sex, companyname, phone, province, city, area, address, email, weixin, QQ, memo, create_time, update_time', 'safe', 'on'=>'search'),
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
			'id' => '业务联系人ID',
			'dealer_id' => '添加人ID',
			'contact_user_id' => '被添加人ID',
			'jiapart_ID' => '嘉配号',
			'customertype' => '客户类型',
			'cooperationtype' => '合作类型',
			'customercategory' => '客户类别',
			'name' => '姓名',
			'sex' => '性别',
			'companyname' => '机构名称',
			'phone' => '联系电话',
			'province' => '省',
			'city' => '市',
			'area' => '区',
			'address' => '地址',
			'email' => '邮箱',
			'weixin' => '微信号',
			'QQ' => 'QQ号',
			'memo' => '备注',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
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
		$criteria->compare('dealer_id',$this->dealer_id);
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}