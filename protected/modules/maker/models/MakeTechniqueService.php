<?php

/**
 * This is the model class for table "{{make_technique_service}}".
 *
 * The followings are the available columns in table '{{make_technique_service}}':
 * @property integer $id
 * @property integer $up_userID
 * @property string $organName
 * @property string $serviceProject
 * @property string $serviceTime
 * @property string $empowerServiceProvince
 * @property string $empowerServiceCity
 * @property string $contacts
 * @property string $telephone
 * @property string $AddProvince
 * @property string $AddCity
 * @property string $AddArea
 * @property string $AddStreet
 */
class MakeTechniqueService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeTechniqueService the static model class
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
		return '{{make_technique_service}}';
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
			array('AddStreet', 'length'),
			array('AddProvince', 'required', 'message'=>'请选择所在地区'),
			array('organName, serviceTime, serviceProject, contacts, telephone', 'required'),array('empowerServiceCity', 'required', 'message'=>'请选择具体地区'),
    		array('telephone', 'match',  'allowEmpty'=>true, 'pattern'=>"/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$|(^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$)/",'message'=>'格式错误'),
    		array('empowerServiceProvince, empowerServiceCity, AddProvince, AddCity, AddArea', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, up_userID, organName, serviceProject, serviceTime, empowerServiceProvince, empowerServiceCity, contacts, telephone, AddProvince, AddCity, AddArea, AddStreet', 'safe', 'on'=>'search'),
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
			'serviceProject' => '服务项目',
			'serviceTime' => 'Service Time',
			'empowerServiceProvince' => 'Empower Service Province',
			'empowerServiceCity' => 'Empower Service City',
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
		$criteria->compare('serviceProject',$this->serviceProject,true);
		$criteria->compare('serviceTime',$this->serviceTime,true);
		$criteria->compare('empowerServiceProvince',$this->empowerServiceProvince,true);
		$criteria->compare('empowerServiceCity',$this->empowerServiceCity,true);
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