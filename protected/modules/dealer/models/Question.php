<?php

/**
 * This is the model class for table "{{question}}".
 *
 * The followings are the available columns in table '{{question}}':
 * @property integer $ID
 * @property string $Title
 * @property string $Desc
 * @property string $Type
 * @property string $State
 * @property integer $Promoter
 * @property string $OrganName
 * @property string $Phone
 * @property string $Email
 * @property string $QQ
 * @property integer $Submitter
 * @property integer $SubmitTime
 * @property integer $Executor
 * @property string $Answer
 * @property integer $AnswerTime
 * @property integer $Satisfaction
 * @property string $SatisfactionDesc
 * @property integer $SatisfactionTime
 * @property string $Visit
 * @property string $UserType
 * @property integer $AlloterID
 * @property integer $AllotTime
 * @property string $SubmitterType
 * @property string $ExecutorType
 */
class Question extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Title, Desc', 'required'),
			array('Promoter, Submitter, SubmitTime, Executor, AnswerTime, Satisfaction, SatisfactionTime, AlloterID, AllotTime', 'numerical', 'integerOnly'=>true),
			array('Title', 'length', 'max'=>40),
			array('Type, State, Visit, UserType, SubmitterType, ExecutorType', 'length', 'max'=>1),
			array('OrganName, Email', 'length', 'max'=>128),
			array('Phone', 'length', 'max'=>20),
			array('QQ', 'length', 'max'=>11),
			array('SatisfactionDesc', 'length', 'max'=>200),
			array('Answer', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Title, Desc, Type, State, Promoter, OrganName, Phone, Email, QQ, Submitter, SubmitTime, Executor, Answer, AnswerTime, Satisfaction, SatisfactionDesc, SatisfactionTime, Visit, UserType, AlloterID, AllotTime, SubmitterType, ExecutorType', 'safe', 'on'=>'search'),
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
			'Title' => 'Title',
			'Desc' => 'Desc',
			'Type' => 'Type',
			'State' => 'State',
			'Promoter' => 'Promoter',
			'OrganName' => 'Organ Name',
			'Phone' => 'Phone',
			'Email' => 'Email',
			'QQ' => 'Qq',
			'Submitter' => 'Submitter',
			'SubmitTime' => 'Submit Time',
			'Executor' => 'Executor',
			'Answer' => 'Answer',
			'AnswerTime' => 'Answer Time',
			'Satisfaction' => 'Satisfaction',
			'SatisfactionDesc' => 'Satisfaction Desc',
			'SatisfactionTime' => 'Satisfaction Time',
			'Visit' => 'Visit',
			'UserType' => 'User Type',
			'AlloterID' => 'Alloter',
			'AllotTime' => 'Allot Time',
			'SubmitterType' => 'Submitter Type',
			'ExecutorType' => 'Executor Type',
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
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Desc',$this->Desc,true);
		$criteria->compare('Type',$this->Type,true);
		$criteria->compare('State',$this->State,true);
		$criteria->compare('Promoter',$this->Promoter);
		$criteria->compare('OrganName',$this->OrganName,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('Submitter',$this->Submitter);
		$criteria->compare('SubmitTime',$this->SubmitTime);
		$criteria->compare('Executor',$this->Executor);
		$criteria->compare('Answer',$this->Answer,true);
		$criteria->compare('AnswerTime',$this->AnswerTime);
		$criteria->compare('Satisfaction',$this->Satisfaction);
		$criteria->compare('SatisfactionDesc',$this->SatisfactionDesc,true);
		$criteria->compare('SatisfactionTime',$this->SatisfactionTime);
		$criteria->compare('Visit',$this->Visit,true);
		$criteria->compare('UserType',$this->UserType,true);
		$criteria->compare('AlloterID',$this->AlloterID);
		$criteria->compare('AllotTime',$this->AllotTime);
		$criteria->compare('SubmitterType',$this->SubmitterType,true);
		$criteria->compare('ExecutorType',$this->ExecutorType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->csdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
