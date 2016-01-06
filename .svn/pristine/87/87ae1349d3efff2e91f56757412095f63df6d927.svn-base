<?php

/**
 * This is the model class for table "{{service_items_temp}}".
 *
 * The followings are the available columns in table '{{service_items_temp}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $ItemName
 * @property string $ItemQuote
 * @property string $ItemIntro
 */
class ServiceItemsTemp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceItemsTemp the static model class
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
		return '{{service_items_temp}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID', 'numerical', 'integerOnly'=>true),
			array('ItemName', 'length', 'max'=>100),
			array('ItemQuote', 'length', 'max'=>10),
			array('ItemIntro', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, ItemName, ItemQuote, ItemIntro', 'safe', 'on'=>'search'),
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
			'ItemName' => 'Item Name',
			'ItemQuote' => 'Item Quote',
			'ItemIntro' => 'Item Intro',
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
		$criteria->compare('ItemName',$this->ItemName,true);
		$criteria->compare('ItemQuote',$this->ItemQuote,true);
		$criteria->compare('ItemIntro',$this->ItemIntro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}