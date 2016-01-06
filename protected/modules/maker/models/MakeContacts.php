<?php

/**
 * This is the model class for table "{{make_contacts}}".
 *
 * The followings are the available columns in table '{{make_contacts}}':
 * @property integer $id
 * @property integer $up_userID
 * @property string $organName
 * @property string $customerType
 * @property string $cooperateType
 * @property string $AddProvince
 * @property string $AddCity
 * @property string $AddArea
 * @property string $AddStreet
 * @property string $contactsName
 * @property string $sex
 * @property string $telephone
 * @property string $email
 * @property string $wechat
 * @property string $qq
 * @property string $remarks
 */
class MakeContacts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeContacts the static model class
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
		return '{{make_contacts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('up_userID', 'required'),
			array('organName,telephone,email', 'unique', 'caseSensitive'=>false),
			array('up_userID', 'numerical', 'integerOnly'=>true),
			array('organName, contactsName,telephone, email', 'required'),
			array('AddProvince', 'required', 'message'=>'请选择所在地区'),
			array('customerType', 'required', 'message'=>'请选择客户类型'),
			array('cooperateType', 'required', 'message'=>'请选择合作类型'),
			array('AddProvince, AddCity, AddArea', 'length', 'max'=>100),
			array('customerType, cooperateType', 'length', 'max'=>50),
			array('qq', 'match',  'allowEmpty'=>true, 'pattern'=>"/^[1-9]\d{4,10}$/",'message'=>'qq号码格式错误'),
			array('remarks, AddStreet, wechat, qq', 'length'),
			array('telephone', 'match',  'allowEmpty'=>true, 'pattern'=>"/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$|(^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$)/",'message'=>'电话格式错误'),
			array('email', 'email','message'=>'邮箱格式错误'),
			array('sex', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, up_userID, organName, customerType, cooperateType, AddProvince, AddCity, AddArea, AddStreet, contactsName, sex, telephone, email, wechat, qq, remarks', 'safe', 'on'=>'search'),
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
			'up_userID' => 'Up User',
			'organName' => '机构名称',
			'customerType' => 'Customer Type',
			'cooperateType' => 'Cooperate Type',
			'AddProvince' => 'Add Province',
			'AddCity' => 'Add City',
			'AddArea' => 'Add Area',
			'AddStreet' => '街道地址',
			'contactsName' => '联系人姓名',
			'sex' => 'Sex',
			'telephone' => '电话',
			'email' => '邮箱',
			'wechat' => '微信号',
			'qq' => 'QQ号',
			'remarks' => '备注',
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
		$criteria->compare('up_userID',$this->up_userID);
		$criteria->compare('organName',$this->organName,true);
		$criteria->compare('customerType',$this->customerType,true);
		$criteria->compare('cooperateType',$this->cooperateType,true);
		$criteria->compare('AddProvince',$this->AddProvince,true);
		$criteria->compare('AddCity',$this->AddCity,true);
		$criteria->compare('AddArea',$this->AddArea,true);
		$criteria->compare('AddStreet',$this->AddStreet,true);
		$criteria->compare('contactsName',$this->contactsName,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('wechat',$this->wechat,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}