<?php

/**
 * This is the model class for table "{{dealer_subdealer}}".
 *
 * The followings are the available columns in table '{{dealer_subdealer}}':
 * @property integer $id
 * @property integer $userID
 * @property integer $subUserID
 * @property string $organName
 * @property string $grade
 * @property string $allowCate
 * @property string $allowBrand
 * @property string $allowProvince
 * @property string $allowCity
 * @property string $person
 * @property string $phone
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $address
 * @property integer $flag
 */
class DealerSubdealer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerSubdealer the static model class
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
		return '{{dealer_subdealer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID', 'required'),
			array('userID, subUserID, flag', 'numerical', 'integerOnly'=>true),
			array('organName, grade, allowCate, allowBrand, allowProvince, person, phone, province, address','required'),
			array('organName, grade, allowCate, allowBrand, allowProvince, allowCity, person, phone, province, city, area, address', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, subUserID, organName, grade, allowCate, allowBrand, allowProvince, allowCity, person, phone, province, city, area, address, flag', 'safe', 'on'=>'search'),
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
			'subUserID' => 'Sub User',
			'organName' => '机构名称：',
			'grade' => '经营级别：',
			'allowCate' => '授权品类：',
			'allowBrand' => '授权品牌：',
			'allowProvince' => '授权销售地域：',
			'allowCity' => 'Allow City',
			'person' => '联系人：',
			'phone' => '联系电话：',
			'province' => '地址：',
			'city' => 'City',
			'area' => 'Area',
			'address' => 'Address',
			'flag' => 'Flag',
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
		$criteria->compare('subUserID',$this->subUserID);
		$criteria->compare('organName',$this->organName,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('allowCate',$this->allowCate,true);
		$criteria->compare('allowBrand',$this->allowBrand,true);
		$criteria->compare('allowProvince',$this->allowProvince,true);
		$criteria->compare('allowCity',$this->allowCity,true);
		$criteria->compare('person',$this->person,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('flag',$this->flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}