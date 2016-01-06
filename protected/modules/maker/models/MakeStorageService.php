<?php

/**
 * This is the model class for table "{{make_storage_service}}".
 *
 * The followings are the available columns in table '{{make_storage_service}}':
 * @property integer $id
 * @property integer $up_userID
 * @property string $organName
 * @property string $TodayArrPro
 * @property string $TodayArrCity
 * @property string $TridArrPro
 * @property string $TridArrCity
 * @property string $TridAboveArrPro
 * @property string $TridAboveArrCity
 * @property string $contacts
 * @property string $telephone
 * @property string $AddProvince
 * @property string $AddCity
 * @property string $AddArea
 * @property string $AddStreet
 */
class MakeStorageService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeStorageService the static model class
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
		return '{{make_storage_service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('up_userID', 'numerical', 'integerOnly'=>true),
			array('organName, telephone', 'unique', 'caseSensitive'=>false),
			array('organName, telephone, contacts', 'required'),
			array('AddProvince', 'required', 'message'=>'请选择所在地区'),
			array('AddStreet', 'length'),
			array('TodayArrCity, TridArrCity, TridAboveArrCity', 'required', 'message'=>'请选择具体区域'),
    		array('telephone', 'match',  'allowEmpty'=>true, 'pattern'=>"/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$|(^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$)/",'message'=>'格式错误'),
    		array('TodayArrPro, TridArrPro, TridAboveArrPro, AddProvince, AddCity, AddArea', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, up_userID, organName, TodayArrPro, TodayArrCity, TridArrPro, TridArrCity, TridAboveArrPro, TridAboveArrCity, contacts, telephone, AddProvince, AddCity, AddArea, AddStreet', 'safe', 'on'=>'search'),
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
			'TodayArrPro' => 'Today Arr Pro',
			'TodayArrCity' => 'Today Arr City',
			'TridArrPro' => 'Trid Arr Pro',
			'TridArrCity' => 'Trid Arr City',
			'TridAboveArrPro' => 'Trid Above Arr Pro',
			'TridAboveArrCity' => 'Trid Above Arr City',
			'contacts' => '联系人',
			'telephone' => '联系电话',
			'AddProvince' => 'Add Province',
			'AddCity' => 'Add City',
			'AddArea' => 'Add Area',
			'AddStreet' => '街道地址',
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
		$criteria->compare('TodayArrPro',$this->TodayArrPro,true);
		$criteria->compare('TodayArrCity',$this->TodayArrCity,true);
		$criteria->compare('TridArrPro',$this->TridArrPro,true);
		$criteria->compare('TridArrCity',$this->TridArrCity,true);
		$criteria->compare('TridAboveArrPro',$this->TridAboveArrPro,true);
		$criteria->compare('TridAboveArrCity',$this->TridAboveArrCity,true);
		$criteria->compare('contacts',$this->contacts,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('AddProvince',$this->AddProvince,true);
		$criteria->compare('AddCity',$this->AddCity,true);
		$criteria->compare('AddArea',$this->AddArea,true);
		$criteria->compare('AddStreet',$this->AddStreet,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}