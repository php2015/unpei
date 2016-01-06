<?php

/**
 * This is the model class for table "{{quotation_goods}}".
 *
 * The followings are the available columns in table '{{quotation_goods}}':
 * @property integer $ID
 * @property integer $SchID
 * @property integer $GoodsID
 * @property integer $Num
 * @property string $Price
 * @property integer $IfSelect
 * @property integer $InquiryCategoryID
 * @property string $PartLevel
 * @property integer $Version
 */
class PapQuotationGoods extends PAPActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{quotation_goods}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SchID, GoodsID, Num, Price', 'required'),
			array('SchID, GoodsID, Num, IfSelect, InquiryCategoryID, Version', 'numerical', 'integerOnly'=>true),
			array('Price', 'length', 'max'=>9),
			array('PartLevel', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, SchID, GoodsID, Num, Price, IfSelect, InquiryCategoryID, PartLevel, Version', 'safe', 'on'=>'search'),
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
			'SchID' => 'Sch',
			'GoodsID' => 'Goods',
			'Num' => 'Num',
			'Price' => 'Price',
			'IfSelect' => 'If Select',
			'InquiryCategoryID' => 'Inquiry Category',
			'PartLevel' => 'Part Level',
			'Version' => 'Version',
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
		$criteria->compare('SchID',$this->SchID);
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('Num',$this->Num);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('IfSelect',$this->IfSelect);
		$criteria->compare('InquiryCategoryID',$this->InquiryCategoryID);
		$criteria->compare('PartLevel',$this->PartLevel,true);
		$criteria->compare('Version',$this->Version);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->papdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PapQuotationGoods the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
