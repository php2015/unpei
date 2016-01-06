<?php

/**
 * This is the model class for table "{{make_logistics_service}}".
 *
 * The followings are the available columns in table '{{make_logistics_service}}':
 * @property integer $id
 * @property integer $up_userID
 * @property string $organName
 * @property string $empowerSendProvince
 * @property string $empowerSendCity
 * @property string $directSendProvince
 * @property string $directSendCity
 * @property string $contacts
 * @property string $telephone
 * @property string $AddProvince
 * @property string $AddCity
 * @property string $AddArea
 * @property string $AddStreet
 */
class MakeLogisticsService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeLogisticsService the static model class
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
		return '{{make_logistics_service}}';
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
			array('up_userID', 'numerical', 'integerOnly'=>true),
			array('organName, empowerSendProvince, empowerSendCity, directSendProvince, directSendCity, contacts, AddProvince, AddCity, AddArea', 'length', 'max'=>100),
			array('telephone', 'length', 'max'=>20),
			array('AddStreet', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, up_userID, organName, empowerSendProvince, empowerSendCity, directSendProvince, directSendCity, contacts, telephone, AddProvince, AddCity, AddArea, AddStreet', 'safe', 'on'=>'search'),
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
			'organName' => 'Organ Name',
			'empowerSendProvince' => 'Empower Send Province',
			'empowerSendCity' => 'Empower Send City',
			'directSendProvince' => 'Direct Send Province',
			'directSendCity' => 'Direct Send City',
			'contacts' => 'Contacts',
			'telephone' => 'Telephone',
			'AddProvince' => 'Add Province',
			'AddCity' => 'Add City',
			'AddArea' => 'Add Area',
			'AddStreet' => 'Add Street',
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
		$criteria->compare('empowerSendProvince',$this->empowerSendProvince,true);
		$criteria->compare('empowerSendCity',$this->empowerSendCity,true);
		$criteria->compare('directSendProvince',$this->directSendProvince,true);
		$criteria->compare('directSendCity',$this->directSendCity,true);
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