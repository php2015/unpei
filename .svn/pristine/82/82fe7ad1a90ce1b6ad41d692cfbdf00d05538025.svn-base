<?php

/**
 * This is the model class for table "{{make_storage}}".
 *
 * The followings are the available columns in table '{{make_storage}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $OrganName
 * @property string $TodayArrPro
 * @property string $TodayArrCity
 * @property string $TridArrPro
 * @property string $TridArrCity
 * @property string $TridAboveArrPro
 * @property string $TridAboveArrCity
 * @property string $Contacts
 * @property string $Telephone
 * @property string $AddProvince
 * @property string $AddCity
 * @property string $AddArea
 * @property string $AddStreet
 */
class MakeStorage extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{make_storage}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, OrganName, Telephone, Contacts', 'required'),
                        array('OrganName, Telephone', 'unique', 'caseSensitive'=>false),
			array('OrganID', 'numerical', 'integerOnly'=>true),
			array('OrganName, TodayArrPro, TodayArrCity, TridArrPro, TridArrCity, TridAboveArrPro, TridAboveArrCity, Contacts, AddProvince, AddCity, AddArea', 'length', 'max'=>100),
			array('Telephone', 'length', 'max'=>20),
			array('AddStreet', 'length', 'max'=>255),
                        array('AddProvince', 'required', 'message'=>'请选择所在地区'),
			array('TodayArrCity, TridArrCity, TridAboveArrCity', 'required', 'message'=>'请选择具体区域'),
    		        array('Telephone', 'match',  'allowEmpty'=>true, 'pattern'=>"/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$|(^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$)/",'message'=>'格式错误'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganID, OrganName, TodayArrPro, TodayArrCity, TridArrPro, TridArrCity, TridAboveArrPro, TridAboveArrCity, Contacts, Telephone, AddProvince, AddCity, AddArea, AddStreet', 'safe', 'on'=>'search'),
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
			'OrganName' => '机构名称',
			'TodayArrPro' => 'Today Arr Pro',
			'TodayArrCity' => 'Today Arr City',
			'TridArrPro' => 'Trid Arr Pro',
			'TridArrCity' => 'Trid Arr City',
			'TridAboveArrPro' => 'Trid Above Arr Pro',
			'TridAboveArrCity' => 'Trid Above Arr City',
			'Contacts' => '联系人',
			'Telephone' => '联系人电话',
			'AddProvince' => 'Add Province',
			'AddCity' => 'Add City',
			'AddArea' => 'Add Area',
			'AddStreet' => '街道地址',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('OrganName',$this->OrganName,true);
		$criteria->compare('TodayArrPro',$this->TodayArrPro,true);
		$criteria->compare('TodayArrCity',$this->TodayArrCity,true);
		$criteria->compare('TridArrPro',$this->TridArrPro,true);
		$criteria->compare('TridArrCity',$this->TridArrCity,true);
		$criteria->compare('TridAboveArrPro',$this->TridAboveArrPro,true);
		$criteria->compare('TridAboveArrCity',$this->TridAboveArrCity,true);
		$criteria->compare('Contacts',$this->Contacts,true);
		$criteria->compare('Telephone',$this->Telephone,true);
		$criteria->compare('AddProvince',$this->AddProvince,true);
		$criteria->compare('AddCity',$this->AddCity,true);
		$criteria->compare('AddArea',$this->AddArea,true);
		$criteria->compare('AddStreet',$this->AddStreet,true);

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
	 * @return MakeStorage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
