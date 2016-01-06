<?php

/**
 * This is the model class for table "{{help_video}}".
 *
 * The followings are the available columns in table '{{help_video}}':
 * @property integer $ID
 * @property string $Title
 * @property string $Path
 * @property string $Desc
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class CsHelpVideo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CsHelpVideo the static model class
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
		return '{{help_video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Title, Path, Desc, CreateTime', 'required'),
			array('CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('Title', 'length', 'max'=>64),
			array('Path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Title, Path, Desc, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'Path' => 'Path',
			'Desc' => 'Desc',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
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
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Path',$this->Path,true);
		$criteria->compare('Desc',$this->Desc,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}