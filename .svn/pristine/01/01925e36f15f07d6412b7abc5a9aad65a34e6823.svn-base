<?php

/**
 * This is the model class for table "{{service}}".
 *
 * The followings are the available columns in table '{{service}}':
 * @property integer $userId
 * @property string $serviceName
 * @property string $serviceIntro
 * @property string $serviceProvince
 * @property string $serviceCity
 * @property string $serviceArea
 * @property string $serviceAddress
 * @property string $serviceContact
 * @property string $serviceEmail
 * @property string $serviceCellPhone
 * @property string $serviceTelePhone
 * @property string $serviceQQ
 * @property string $serviceFounded
 * @property string $serviceStoreSize
 * @property string $servicePositionCount
 * @property string $serviceTechnicianCount
 * @property string $serviceParkingDigits
 * @property string $serviceOpenTime
 * @property string $serviceReservationMode
 * @property string $serviceRegionProvince
 * @property string $serviceRegionCity
 * @property string $serviceRegionArea
 * @property string $UserType
 * @property string $status
 * @property string $IsBlcak
 * @property string $IsApprove
 * @property integer $ApproveTime
 * @property string $jiapartsID
 */
class Service extends CActiveRecord
{
	/**
	 * 字段别名
	 *
	 * @var array
	 */
//	public $_fieldsArias = array(
//		'name' => 'serviceName',
//	);
        public $name='';

        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Service the static model class
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
		return '{{service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serviceName,serviceFounded,servicePositionCount,serviceTechnicianCount,serviceParkingDigits,
			serviceCellPhone,serviceEmail,serviceStoreSize,serviceOpenTime','required'),
			array('serviceName, serviceTelePhone, serviceCellPhone, serviceEmail', 'unique', 'caseSensitive'=>false, 'message'=>'该记录已存在'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('serviceName, serviceEmail, serviceOpenTime', 'length', 'max'=>100),
			array('serviceIntro, serviceProvince, serviceCity, serviceArea, serviceReservationMode, serviceRegionProvince, serviceRegionCity, serviceRegionArea', 'length', 'max'=>50),
			array('serviceAddress', 'length', 'max'=>255),
			array('serviceContact, serviceStoreSize, servicePositionCount, serviceTechnicianCount, serviceParkingDigits', 'length', 'max'=>64),
			array('serviceCellPhone, serviceTelePhone', 'length', 'max'=>13),
			array('serviceQQ', 'length', 'max'=>15),
			array('serviceFounded', 'length', 'max'=>4),
			array('serviceTelePhone', 'match',  'allowEmpty'=>true, 'pattern'=>"/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/",'message'=>'固定电话格式错误'),
			array('serviceCellPhone', 'match',  'allowEmpty'=>false, 'pattern'=>"/^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/",'message'=>'手机号码格式错误'),
			array('serviceEmail', 'email',  'allowEmpty'=>false, 'message'=>'邮箱格式错误'),
			array('serviceQQ', 'match',  'allowEmpty'=>true, 'pattern'=>"/^[1-9]\d{4,10}$/",'message'=>'QQ号码格式错误'),
			array('jiapartsID', 'length', 'max'=>24),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userId, serviceName, serviceIntro, serviceProvince, serviceCity, serviceArea, serviceAddress, serviceContact, serviceEmail, serviceCellPhone, serviceTelePhone, serviceQQ, serviceFounded, serviceStoreSize, servicePositionCount, serviceTechnicianCount, serviceParkingDigits, serviceOpenTime, serviceReservationMode, serviceRegionProvince, serviceRegionCity, serviceRegionArea, UserType, status, IsBlcak, IsApprove, ApproveTime, jiapartsID', 'safe', 'on'=>'search'),
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
			'userId' => 'User',
			'serviceName' => '机构名称',
			'serviceIntro' => '机构简介',
			'serviceProvince' => '地址',
			'serviceCity' => '地址',
			'serviceArea' => '地址',
			'serviceAddress' => '地址',
			'serviceContact' => '联系人',
			'serviceEmail' => '邮箱',
			'serviceCellPhone' => '手机',
			'serviceTelePhone' => '固定电话',
			'serviceQQ' => 'QQ',
			'serviceFounded' => '成立年份',
			'serviceStoreSize' => '店铺面积',
			'servicePositionCount' => '工位数',
			'serviceTechnicianCount' => '技师人数',
			'serviceParkingDigits' => '停车位数',
			'serviceOpenTime' => '营业时间',
			'serviceReservationMode' => '预约模式',
			'serviceRegionProvince' => '经营区域',
			'serviceRegionCity' => '经营区域',
			'serviceRegionArea' => '经营区域',
			'UserType' => 'User Type',
			'status' => 'Status',
			'IsBlcak' => 'Is Blcak',
			'IsApprove' => 'Is Approve',
			'ApproveTime' => 'Approve Time',
			'jiapartsID' => 'Jiaparts',
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

		$criteria->compare('userId',$this->userId);
		$criteria->compare('serviceName',$this->serviceName,true);
		$criteria->compare('serviceIntro',$this->serviceIntro,true);
		$criteria->compare('serviceProvince',$this->serviceProvince,true);
		$criteria->compare('serviceCity',$this->serviceCity,true);
		$criteria->compare('serviceArea',$this->serviceArea,true);
		$criteria->compare('serviceAddress',$this->serviceAddress,true);
		$criteria->compare('serviceContact',$this->serviceContact,true);
		$criteria->compare('serviceEmail',$this->serviceEmail,true);
		$criteria->compare('serviceCellPhone',$this->serviceCellPhone,true);
		$criteria->compare('serviceTelePhone',$this->serviceTelePhone,true);
		$criteria->compare('serviceQQ',$this->serviceQQ,true);
		$criteria->compare('serviceFounded',$this->serviceFounded,true);
		$criteria->compare('serviceStoreSize',$this->serviceStoreSize,true);
		$criteria->compare('servicePositionCount',$this->servicePositionCount,true);
		$criteria->compare('serviceTechnicianCount',$this->serviceTechnicianCount,true);
		$criteria->compare('serviceParkingDigits',$this->serviceParkingDigits,true);
		$criteria->compare('serviceOpenTime',$this->serviceOpenTime,true);
		$criteria->compare('serviceReservationMode',$this->serviceReservationMode,true);
		$criteria->compare('serviceRegionProvince',$this->serviceRegionProvince,true);
		$criteria->compare('serviceRegionCity',$this->serviceRegionCity,true);
		$criteria->compare('serviceRegionArea',$this->serviceRegionArea,true);
		$criteria->compare('UserType',$this->UserType,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('IsBlcak',$this->IsBlcak,true);
		$criteria->compare('IsApprove',$this->IsApprove,true);
		$criteria->compare('ApproveTime',$this->ApproveTime);
		$criteria->compare('jiapartsID',$this->jiapartsID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}