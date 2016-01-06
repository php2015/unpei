<?php

/**
 * This is the MongoDB Document model class based on table "{{operate_quota}}".
 */
class OperateQuota extends EMongoDocument
{
	public $OrganID;
	public $OperUrl;
	public $MaxNum;
	public $Num;
	public $Time;

	/**
	 * Returns the static model of the specified AR class.
	 * @return OperateQuota the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * returns the primary key field for this model
	 */
	public function primaryKey()
	{
		return NULL;
	}

	/**
	 * @return string the associated collection name
	 */
	public function getCollectionName()
	{
		return 'operate_quota';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OperUrl', 'required'),
			array('OrganID, MaxNum, Num, Time', 'numerical', 'integerOnly'=>true),
			array('OperUrl', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OrganID, OperUrl, MaxNum, Num, Time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'OrganID' => 'Organ',
			'OperUrl' => 'Oper Url',
			'MaxNum' => 'Max Num',
			'Num' => 'Num',
			'Time' => 'Time',
		);
	}
}