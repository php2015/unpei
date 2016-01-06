<?php

/**
 * This is the model class for table "{{help_question}}".
 *
 * The followings are the available columns in table '{{help_question}}':
 * @property integer $ID
 * @property integer $TypeID
 * @property string $Title
 * @property string $Desc
 * @property string $ImagePath
 * @property string $Answer
 * @property integer $Sort
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class CsHelpQuestion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CsHelpQuestion the static model class
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
		return Yii::app()->csdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{help_question}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Title, Desc, ImagePath, CreateTime', 'required'),
			array('TypeID, Sort, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('Title', 'length', 'max'=>64),
			array('ImagePath', 'length', 'max'=>255),
			array('Answer', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, TypeID, Title, Desc, ImagePath, Answer, Sort, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'TypeID' => 'Type',
			'Title' => 'Title',
			'Desc' => 'Desc',
			'ImagePath' => 'Image Path',
			'Answer' => 'Answer',
			'Sort' => 'Sort',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
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
		$criteria->compare('TypeID',$this->TypeID);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Desc',$this->Desc,true);
		$criteria->compare('ImagePath',$this->ImagePath,true);
		$criteria->compare('Answer',$this->Answer,true);
		$criteria->compare('Sort',$this->Sort);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}