<?php

/**
 * This is the model class for table "{{service_discount}}".
 *
 * The followings are the available columns in table '{{service_discount}}':
 * @property integer $id
 * @property integer $userId
 * @property string $discountRate
 * @property string $releaseDate
 * @property string $closeDate
 * @property string $consumerHelp
 * @property string $remark
 */
class ServiceDiscount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceDiscount the static model class
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
		return '{{service_discount}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId', 'numerical', 'integerOnly'=>true),
			array('discountRate', 'length', 'max'=>10),
			array('consumerHelp, remark', 'length', 'max'=>50),
			array('releaseDate, closeDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, discountRate, releaseDate, closeDate, consumerHelp, remark', 'safe', 'on'=>'search'),
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
			'userId' => 'User',
			'discountRate' => 'Discount Rate',
			'releaseDate' => 'Release Date',
			'closeDate' => 'Close Date',
			'consumerHelp' => 'Consumer Help',
			'remark' => 'Remark',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('discountRate',$this->discountRate,true);
		$criteria->compare('releaseDate',$this->releaseDate,true);
		$criteria->compare('closeDate',$this->closeDate,true);
		$criteria->compare('consumerHelp',$this->consumerHelp,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}