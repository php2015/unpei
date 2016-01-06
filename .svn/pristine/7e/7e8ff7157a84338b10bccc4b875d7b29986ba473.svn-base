<?php

/**
 * This is the model class for table "{{push_contact_relation}}".
 *
 * The followings are the available columns in table '{{push_contact_relation}}':
 * @property integer $ID
 * @property integer $ContactID
 * @property integer $PushID
 * @property integer $OrganID
 */
class PushContactRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PushContactRelation the static model class
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
		return '{{push_contact_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ContactID, PushID, OrganID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ContactID, PushID, OrganID', 'safe', 'on'=>'search'),
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
			'ContactID' => 'Contact',
			'PushID' => 'Push',
			'OrganID' => 'Organ',
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
		$criteria->compare('ContactID',$this->ContactID);
		$criteria->compare('PushID',$this->PushID);
		$criteria->compare('OrganID',$this->OrganID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}