<?php

/**
 * This is the model class for table "{{support_parts}}".
 *
 * The followings are the available columns in table '{{support_parts}}':
 * @property integer $ID
 * @property integer $RecordID
 * @property string $ItemID
 * @property string $GoodsName
 * @property string $Brand
 * @property integer $Num
 * @property string $GoodsNum
 * @property string $PartsLevel
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 */
class SupportParts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{support_parts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RecordID, ItemID, GoodsName, CreateTime, Status', 'required'),
			array('RecordID, Num, CreateTime, UpdateTime, Status', 'numerical', 'integerOnly'=>true),
			array('ItemID', 'length', 'max'=>2),
			array('GoodsName, Brand, GoodsNum', 'length', 'max'=>50),
			array('PartsLevel', 'length', 'max'=>24),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, RecordID, ItemID, GoodsName, Brand, Num, GoodsNum, PartsLevel, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
			'RecordID' => 'Record',
			'ItemID' => 'Item',
			'GoodsName' => 'Goods Name',
			'Brand' => 'Brand',
			'Num' => 'Num',
			'GoodsNum' => 'Goods Num',
			'PartsLevel' => 'Parts Level',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Status' => 'Status',
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
		$criteria->compare('RecordID',$this->RecordID);
		$criteria->compare('ItemID',$this->ItemID,true);
		$criteria->compare('GoodsName',$this->GoodsName,true);
		$criteria->compare('Brand',$this->Brand,true);
		$criteria->compare('Num',$this->Num);
		$criteria->compare('GoodsNum',$this->GoodsNum,true);
		$criteria->compare('PartsLevel',$this->PartsLevel,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->jpdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SupportParts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
