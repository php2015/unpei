<?php

/**
 * This is the model class for table "{{make_organ}}".
 *
 * The followings are the available columns in table '{{make_organ}}':
 * @property string $userID
 * @property string $jiapartsID
 * @property string $name
 * @property string $synopsis
 * @property string $province
 * @property string $city
 * @property string $area
 * @property string $url
 * @property string $mobile_phone
 * @property string $telephone
 * @property string $email
 * @property string $fax
 * @property string $qq
 * @property integer $establish_year
 * @property string $company_scale
 * @property string $year_sales_volume
 * @property string $operate_region
 * @property string $keywords
 * @property string $storeUrl
 * @property string $businessBrand
 * @property string $UserType
 * @property string $status
 * @property string $IsBlcak
 * @property string $IsApprove
 * @property integer $ApproveTime
 * @property integer $IsPartner
 * @property integer $PartnerTime
 * @property string $grade
 */
class MakeOrgan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeOrgan the static model class
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
		return '{{make_organ}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('userID, jiapartsID, name,mobile_phone,email', 'required'),
			array('name, mobile_phone, email', 'unique', 'caseSensitive'=>false),
			array('establish_year, ApproveTime, IsPartner, PartnerTime', 'numerical', 'integerOnly'=>true),
			array('userID', 'length', 'max'=>15),
			array('jiapartsID', 'length', 'max'=>64),
			array('name, url', 'length', 'max'=>100),
			array('synopsis, keywords', 'length', 'max'=>255),
			array('province, city, area', 'length', 'max'=>25),
			array('mobile_phone, qq', 'length', 'max'=>24),
			array('telephone, fax, company_scale, year_sales_volume', 'length', 'max'=>20),
			array('email, operate_region', 'length', 'max'=>50),
			array('storeUrl, businessBrand', 'length', 'max'=>150),
			array('UserType, grade', 'length', 'max'=>10),
			array('status, IsBlcak, IsApprove', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userID, jiapartsID, name, synopsis, province, city, area, url, mobile_phone, telephone, email, fax, qq, establish_year, company_scale, year_sales_volume, operate_region, keywords, storeUrl, businessBrand, UserType, status, IsBlcak, IsApprove, ApproveTime, IsPartner, PartnerTime, grade', 'safe', 'on'=>'search'),
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
                   'users' => array(self::BELONGS_TO, 'User', '', 'on' => 't.userID=user.id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userID' => 'User',
			'jiapartsID' => 'Jiaparts',
			'name' => 'Name',
			'synopsis' => 'Synopsis',
			'province' => 'Province',
			'city' => 'City',
			'area' => 'Area',
			'url' => 'Url',
			'mobile_phone' => 'Mobile Phone',
			'telephone' => 'Telephone',
			'email' => 'Email',
			'fax' => 'Fax',
			'qq' => 'Qq',
			'establish_year' => 'Establish Year',
			'company_scale' => 'Company Scale',
			'year_sales_volume' => 'Year Sales Volume',
			'operate_region' => 'Operate Region',
			'keywords' => 'Keywords',
			'storeUrl' => 'Store Url',
			'businessBrand' => 'Business Brand',
			'UserType' => 'User Type',
			'status' => 'Status',
			'IsBlcak' => 'Is Blcak',
			'IsApprove' => 'Is Approve',
			'ApproveTime' => 'Approve Time',
			'IsPartner' => 'Is Partner',
			'PartnerTime' => 'Partner Time',
			'grade' => 'Grade',
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

		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('jiapartsID',$this->jiapartsID,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('synopsis',$this->synopsis,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('establish_year',$this->establish_year);
		$criteria->compare('company_scale',$this->company_scale,true);
		$criteria->compare('year_sales_volume',$this->year_sales_volume,true);
		$criteria->compare('operate_region',$this->operate_region,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('storeUrl',$this->storeUrl,true);
		$criteria->compare('businessBrand',$this->businessBrand,true);
		$criteria->compare('UserType',$this->UserType,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('IsBlcak',$this->IsBlcak,true);
		$criteria->compare('IsApprove',$this->IsApprove,true);
		$criteria->compare('ApproveTime',$this->ApproveTime);
		$criteria->compare('IsPartner',$this->IsPartner);
		$criteria->compare('PartnerTime',$this->PartnerTime);
		$criteria->compare('grade',$this->grade,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public static function getMakeName($makeid)
	{
            $makerNanme = MakeOrgan::model()->find('userID=:userID',array(':userID'=>$makeid));
            return $makerNanme['name'];
	}
}