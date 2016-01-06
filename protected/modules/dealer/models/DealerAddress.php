<?php

/**
 * This is the model class for table "{{dealer_address}}".
 *
 * The followings are the available columns in table '{{dealer_address}}':
 * @property integer $id
 * @property integer $userID
 * @property string $shippingName
 * @property string $zipCode
 * @property string $phone_mod
 * @property string $phone_tel
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property string $flag
 * @property string $createtime
 */
class DealerAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerAddress the static model class
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
		return '{{dealer_address}}';
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
			array('shippingName', 'length', 'max'=>64),
			array('shippingName,zipCode,phone_mod,province','required'),
			array('zipCode, phone_mod, phone_tel, province, city, area, createtime', 'length', 'max'=>24),
			array('address', 'length', 'max'=>255),
			array('flag', 'length', 'max'=>12),
			array('zipCode','required','message'=>'邮政编码'),
			//array('phone_tel', 'match',  'allowEmpty'=>true, 'pattern'=>"/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/",'message'=>'固定电话格式错误'),
			array('phone_mod', 'match',  'allowEmpty'=>true, 'pattern'=>"/^1[3|4|5|8][0-9]\d{4,8}$/",'message'=>'手机号码格式错误'),
		/*	array('email', 'email','message'=>'邮箱格式错误'),
			array('url', 'url','message'=>'网址格式错误'),
			array('qq', 'match',  'allowEmpty'=>true, 'pattern'=>"/^[1-9]\d{4,10}$/",'message'=>'qq号码格式错误'),
			*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, shippingName, zipCode, phone_mod, phone_tel, province, city, area, address, flag, createtime', 'safe', 'on'=>'search'),
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
			'shippingName' => '收货人姓名：',
			'zipCode' => '邮政编码：',
			'phone_mod' => '手机号码：',
			'phone_tel' => '电话号码：',
			'province' => '所在地区：',
			'city' => 'City',
			'area' => 'Area',
			'address' => '街道地址：',
			'flag' => 'Flag',
			'createtime' => 'Createtime',
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
		$criteria->compare('shippingName',$this->shippingName,true);
		$criteria->compare('zipCode',$this->zipCode,true);
		$criteria->compare('phone_mod',$this->phone_mod,true);
		$criteria->compare('phone_tel',$this->phone_tel,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('createtime',$this->createtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function getaddress($id){
		$model=self::model()->find('id=:id',array(':id'=>$id));
		echo Area::showCity($model->province).Area::showCity($model->city).Area::showCity($model->area).$model->address."（".$model->shippingName." 收）".
							"<br>".
							"电话：".$model->phone_mod.
							"<br>
							物流公司：";
	}
	
	public static function getaddress2($id){
		$model=self::model()->find('id=:id',array(':id'=>$id));
		echo Area::showCity($model->province).Area::showCity($model->city).Area::showCity($model->area).$model->address."（".$model->shippingName." 收）".
							" ".
							"电话：".$model->phone_mod.
							" 物流公司：";
	}
	public static function retaddress($id){
		$model=self::model()->find('id=:id',array(':id'=>$id));
		return Area::getCity($model->province).Area::getCity($model->city).Area::getCity($model->area).$model->address."（".$model->shippingName." 收）".
							" ".
							"电话：".$model->phone_mod.
							" 物流公司：";
	}
	public static function retaddress2($id){
		$model=self::model()->find('id=:id',array(':id'=>$id));
		return Area::getCity($model->province).Area::getCity($model->city).Area::getCity($model->area).$model->address."（".$model->shippingName." 收）".
							" ".
							"电话：".$model->phone_mod;
	}
	public static function gettab($id){
		$model=self::model()->find('id=:id',array(':id'=>$id));
		return 'JH'.sprintf("%04d", $model->id).' '.Area::getCity($model->province).Area::getCity($model->city).Area::getCity($model->area).$model->address;
	}
}