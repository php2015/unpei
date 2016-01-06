<?php

/**
 * This is the model class for table "{{dealer_cpname}}".
 *
 * The followings are the available columns in table '{{dealer_cpname}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $BigpartsID
 * @property integer $SubCodeID
 * @property integer $CpNameID
 * @property string $BigName
 * @property string $SubName
 * @property string $CpName
 */
class DealerCpname extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerCpname the static model class
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
		return '{{dealer_cpname}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID', 'required'),
			array('OrganID, BigpartsID, SubCodeID, CpNameID', 'numerical', 'integerOnly'=>true),
			array('BigName, SubName, CpName', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, BigpartsID, SubCodeID, CpNameID, BigName, SubName, CpName', 'safe', 'on'=>'search'),
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
			'BigpartsID' => 'Bigparts',
			'SubCodeID' => 'Sub Code',
			'CpNameID' => 'Cp Name',
			'BigName' => 'Big Name',
			'SubName' => 'Sub Name',
			'CpName' => 'Cp Name',
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
		$criteria->compare('BigpartsID',$this->BigpartsID);
		$criteria->compare('SubCodeID',$this->SubCodeID);
		$criteria->compare('CpNameID',$this->CpNameID);
		$criteria->compare('BigName',$this->BigName,true);
		$criteria->compare('SubName',$this->SubName,true);
		$criteria->compare('CpName',$this->CpName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}