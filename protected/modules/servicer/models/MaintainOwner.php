<?php

/**
 * This is the model class for table "{{maintain_owner}}".
 *
 * The followings are the available columns in table '{{maintain_owner}}':
 * @property integer $ID
 * @property integer $RemindID
 * @property integer $OwnerID
 * @property integer $CarID
 * @property string $Name
 * @property string $NickName
 * @property integer $FirstRemind
 * @property integer $IsFirst
 * @property integer $SecondRemind
 * @property integer $IsSecond
 * @property integer $Status
 */
class MaintainOwner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MaintainOwner the static model class
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
		return '{{maintain_owner}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RemindID, OwnerID, CarID, FirstRemind, IsFirst, SecondRemind, IsSecond, Status', 'numerical', 'integerOnly'=>true),
			array('Name, NickName', 'length', 'max'=>24),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, RemindID, OwnerID, CarID, Name, NickName, FirstRemind, IsFirst, SecondRemind, IsSecond, Status', 'safe', 'on'=>'search'),
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
			'remind' => array(self::BELONGS_TO,'MaintainRemind','RemindID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'RemindID' => 'Remind',
			'OwnerID' => 'Owner',
			'CarID' => 'Car',
			'Name' => 'Name',
			'NickName' => 'Nick Name',
			'FirstRemind' => 'First Remind',
			'IsFirst' => 'Is First',
			'SecondRemind' => 'Second Remind',
			'IsSecond' => 'Is Second',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('RemindID',$this->RemindID);
		$criteria->compare('OwnerID',$this->OwnerID);
		$criteria->compare('CarID',$this->CarID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('NickName',$this->NickName,true);
		$criteria->compare('FirstRemind',$this->FirstRemind);
		$criteria->compare('IsFirst',$this->IsFirst);
		$criteria->compare('SecondRemind',$this->SecondRemind);
		$criteria->compare('IsSecond',$this->IsSecond);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}