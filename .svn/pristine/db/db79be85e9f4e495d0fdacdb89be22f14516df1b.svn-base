<?php

/**
 * This is the model class for table "{{approve_brand}}".
 *
 * The followings are the available columns in table '{{approve_brand}}':
 * @property integer $ID
 * @property string $BrandName
 * @property string $Pinyin
 * @property string $CpNameTxt
 * @property string $description
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $IsDelete
 */
class ApproveBrand extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApproveBrand the static model class
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
		return '{{approve_brand}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BrandName, Pinyin', 'required'),
			array('UserID, CreateTime, UpdateTime, IsDelete', 'numerical', 'integerOnly'=>true),
			array('BrandName', 'length', 'max'=>48),
			array('Pinyin', 'length', 'max'=>24),
			array('CpNameTxt', 'length', 'max'=>64),
			array('description', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, BrandName, Pinyin, CpNameTxt, description, UserID, CreateTime, UpdateTime, IsDelete', 'safe', 'on'=>'search'),
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
			'BrandName' => 'Brand Name',
			'Pinyin' => 'Pinyin',
			'CpNameTxt' => 'Cp Name Txt',
			'description' => 'Description',
			'UserID' => 'User',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'IsDelete' => 'Is Delete',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('BrandName',$this->BrandName,true);
		$criteria->compare('Pinyin',$this->Pinyin,true);
		$criteria->compare('CpNameTxt',$this->CpNameTxt,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('IsDelete',$this->IsDelete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * 获取认证品牌
         * @return type
         */
        public static function getApproveBrand(){
            $datas = self::model()->findAll();
            $data = CHtml::listData($datas, "BrandName", "BrandName");
            return $data;
        }
}