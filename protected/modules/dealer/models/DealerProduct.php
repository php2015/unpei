<?php

/**
 * This is the model class for table "{{dealer_product}}".
 *
 * The followings are the available columns in table '{{dealer_product}}':
 * @property integer $ProductID
 * @property string $Name
 * @property integer $UserID
 * @property string $BrandName
 * @property string $Make
 * @property string $Model
 * @property string $ProductNO
 * @property string $OENO
 * @property string $PartCate
 * @property string $flag
 * @property string $Description
 * @property string $MainGroup
 * @property string $SubGroup
 * @property string $PartName
 * @property string $Params
 * @property string $error
 */
class DealerProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerProduct the static model class
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
		return '{{dealer_product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, UserID, BrandName, Make, Model, ProductNO, OENO, PartCate', 'required'),
			array('UserID', 'numerical', 'integerOnly'=>true),
			array('Name, BrandName, Make, Model, ProductNO, OENO, PartCate, MainGroup, SubGroup, PartName', 'length', 'max'=>50),
			array('flag', 'length', 'max'=>2),
			array('error', 'length', 'max'=>200),
			array('Description, Params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ProductID, Name, UserID, BrandName, Make, Model, ProductNO, OENO, PartCate, flag, Description, MainGroup, SubGroup, PartName, Params, error', 'safe', 'on'=>'search'),
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
			'ProductID' => 'Product',
			'Name' => 'Name',
			'UserID' => 'User',
			'BrandName' => 'Brand Name',
			'Make' => 'Make',
			'Model' => 'Model',
			'ProductNO' => 'Product No',
			'OENO' => 'Oeno',
			'PartCate' => 'Part Cate',
			'flag' => 'Flag',
			'Description' => 'Description',
			'MainGroup' => 'Main Group',
			'SubGroup' => 'Sub Group',
			'PartName' => 'Part Name',
			'Params' => 'Params',
			'error' => 'Error',
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

		$criteria->compare('ProductID',$this->ProductID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('BrandName',$this->BrandName,true);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Model',$this->Model,true);
		$criteria->compare('ProductNO',$this->ProductNO,true);
		$criteria->compare('OENO',$this->OENO,true);
		$criteria->compare('PartCate',$this->PartCate,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('MainGroup',$this->MainGroup,true);
		$criteria->compare('SubGroup',$this->SubGroup,true);
		$criteria->compare('PartName',$this->PartName,true);
		$criteria->compare('Params',$this->Params,true);
		$criteria->compare('error',$this->error,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}