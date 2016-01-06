<?php

/**
 * This is the model class for table "{{receive_address}}".
 *
 * The followings are the available columns in table '{{receive_address}}':
 * @property string $ID
 * @property string $OrganID
 * @property string $ContactName
 * @property string $Country
 * @property string $State
 * @property string $City
 * @property string $District
 * @property string $ZipCode
 * @property string $Address
 * @property string $Phone
 * @property string $TelPhone
 * @property string $Memo
 * @property integer $IsDefault
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class JpdReceiveAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
         public $Country;
         public $TelPhone;
	public function tableName()
	{
		return '{{receive_address}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('ContactName,State,City,District,ZipCode,Phone,Address','required'),
			array('IsDefault', 'numerical', 'integerOnly'=>true),
			array('OrganID, CreateTime, UpdateTime', 'length', 'max'=>10),
			array('ContactName, Country, State, City, District, ZipCode, Phone, TelPhone', 'length', 'max'=>45),
			array('Address', 'length', 'max'=>40),
                        array('Phone', 'match', 'pattern' => '/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/', 'message' => "手机号格式不正确"),
			array('Memo', 'safe'),
                        array('ZipCode', 'match', 'pattern' =>'/^[0-9][0-9]{5}$/','message'=>'邮编格式不正确'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganID, ContactName, Country, State, City, District, ZipCode, Address, Phone, TelPhone, Memo, IsDefault, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'OrganID' => 'Organ',
			'ContactName' => '收货人',
			'Country' => '国家',
			'State' => '省',
			'City' => '市',
			'District' => '区',
			'ZipCode' => '邮政编码',
			'Address' => '街道地址',
			'Phone' => '手机',
			'TelPhone' => 'Tel Phone',
			'Memo' => 'Memo',
			'IsDefault' => 'Is Default',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('OrganID',$this->OrganID,true);
		$criteria->compare('ContactName',$this->ContactName,true);
		$criteria->compare('Country',$this->Country,true);
		$criteria->compare('State',$this->State,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('District',$this->District,true);
		$criteria->compare('ZipCode',$this->ZipCode,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('TelPhone',$this->TelPhone,true);
		$criteria->compare('Memo',$this->Memo,true);
		$criteria->compare('IsDefault',$this->IsDefault);
		$criteria->compare('CreateTime',$this->CreateTime,true);
		$criteria->compare('UpdateTime',$this->UpdateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->jpdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JpdReceiveAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        protected function beforeSave()
        {
            $organID=Yii::app()->user->getOrganID();
            if(parent::beforeSave()){
                if($this->isNewRecord){
                    $this->CreateTime=time();
                    $this->UpdateTime=time();
                    $this->OrganID=$organID;
                }else{
                    $this->UpdateTime=time();
                }
                return true;
            }else{
                return false;
            }
        }
}
