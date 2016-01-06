<?php

/**
 * This is the model class for table "{{remind_business}}".
 *
 * The followings are the available columns in table '{{remind_business}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $OrganType
 * @property integer $PromoterID
 * @property integer $PromoterType
 * @property string $Content
 * @property string $LinkUrl
 * @property integer $CreateTime
 * @property integer $EffectiveTime
 * @property integer $HandleID
 * @property integer $HandleType
 * @property integer $HandleStatus
 */
class PapRemindBusiness extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PapRemindBusiness the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->papdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{remind_business}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, OrganType, PromoterID, PromoterType, Content, CreateTime, EffectiveTime', 'required'),
			array('OrganID, OrganType, PromoterID, PromoterType, CreateTime, EffectiveTime, HandleID, HandleType, HandleStatus', 'numerical', 'integerOnly'=>true),
			array('Content, LinkUrl', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, OrganType, PromoterID, PromoterType, Content, LinkUrl, CreateTime, EffectiveTime, HandleID, HandleType, HandleStatus', 'safe', 'on'=>'search'),
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
			'OrganType' => 'Organ Type',
			'PromoterID' => 'Promoter',
			'PromoterType' => 'Promoter Type',
			'Content' => 'Content',
			'LinkUrl' => 'Link Url',
			'CreateTime' => 'Create Time',
			'EffectiveTime' => 'Effective Time',
			'HandleID' => 'Handle',
			'HandleType' => 'Handle Type',
			'HandleStatus' => 'Handle Status',
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
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('OrganType',$this->OrganType);
		$criteria->compare('PromoterID',$this->PromoterID);
		$criteria->compare('PromoterType',$this->PromoterType);
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('LinkUrl',$this->LinkUrl,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('EffectiveTime',$this->EffectiveTime);
		$criteria->compare('HandleID',$this->HandleID);
		$criteria->compare('HandleType',$this->HandleType);
		$criteria->compare('HandleStatus',$this->HandleStatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}