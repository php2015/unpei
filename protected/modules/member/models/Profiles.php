<?php

/**
 * This is the model class for table "{{profiles}}".
 *
 * The followings are the available columns in table '{{profiles}}':
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $truename
 * @property string $nickname
 * @property string $phone
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $district
 * @property string $Validity
 * @property string $HeadPhoto
 * @property integer $Sex
 * @property integer $Birthday
 * @property string $Position
 * @property string $OPH
 * @property string $Remark
 * @property integer $ExpirationDate
 * @property string $EmployeeNum
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class Profiles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profiles the static model class
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
		return '{{profiles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Sex, Birthday, ExpirationDate, OrganID, UserID, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, Remark', 'length', 'max'=>255),
			array('truename, nickname, country, state, city, district', 'length', 'max'=>45),
			array('phone', 'length', 'max'=>20),
			array('Validity', 'length', 'max'=>1),
			array('HeadPhoto', 'length', 'max'=>100),
			array('Position', 'length', 'max'=>80),
			array('OPH, EmployeeNum', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, first_name, last_name, truename, nickname, phone, country, state, city, district, Validity, HeadPhoto, Sex, Birthday, Position, OPH, Remark, ExpirationDate, EmployeeNum, OrganID, UserID, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'truename' => 'Truename',
			'nickname' => 'Nickname',
			'phone' => 'Phone',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'district' => 'District',
			'Validity' => 'Validity',
			'HeadPhoto' => 'Head Photo',
			'Sex' => 'Sex',
			'Birthday' => 'Birthday',
			'Position' => 'Position',
			'OPH' => 'Oph',
			'Remark' => 'Remark',
			'ExpirationDate' => 'Expiration Date',
			'EmployeeNum' => 'Employee Num',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('truename',$this->truename,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('Validity',$this->Validity,true);
		$criteria->compare('HeadPhoto',$this->HeadPhoto,true);
		$criteria->compare('Sex',$this->Sex);
		$criteria->compare('Birthday',$this->Birthday);
		$criteria->compare('Position',$this->Position,true);
		$criteria->compare('OPH',$this->OPH,true);
		$criteria->compare('Remark',$this->Remark,true);
		$criteria->compare('ExpirationDate',$this->ExpirationDate);
		$criteria->compare('EmployeeNum',$this->EmployeeNum,true);
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