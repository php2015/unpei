<?php

/**
 * This is the model class for table "{{goods_spec}}".
 *
 * The followings are the available columns in table '{{goods_spec}}':
 * @property integer $ID
 * @property integer $GoodsID
 * @property double $Weight
 * @property double $Length
 * @property double $Wide
 * @property double $Height
 * @property double $Volume
 * @property integer $ValidityType
 * @property string $ValidityDate
 * @property string $Specifica
 * @property string $DetectionImg
 * @property string $Unit
 * @property string $BganCompany
 * @property string $BganGoodsNO
 * @property string $JiapartsNO
 *
 * The followings are the available model relations:
 * @property Goods $goods
 */
class PapGoodsSpec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PapGoodsSpec the static model class
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
		return Yii::app()->papdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{goods_spec}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GoodsID, ValidityType', 'numerical', 'integerOnly'=>true),
			array('ValidityDate', 'length', 'max'=>50),
			array('Unit, BganCompany, BganGoodsNO', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, GoodsID,ValidityType, ValidityDate, Unit, BganCompany, BganGoodsNO', 'safe', 'on'=>'search'),
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
			'goods' => array(self::BELONGS_TO, 'Goods', 'GoodsID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'GoodsID' => 'Goods',
			'ValidityType' => 'Validity Type',
			'ValidityDate' => 'Validity Date',
			'Unit' => 'Unit',
			'BganCompany' => 'Bgan Company',
			'BganGoodsNO' => 'Bgan Goods No',
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
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('ValidityType',$this->ValidityType);
		$criteria->compare('ValidityDate',$this->ValidityDate,true);
		$criteria->compare('Unit',$this->Unit,true);
		$criteria->compare('BganCompany',$this->BganCompany,true);
		$criteria->compare('BganGoodsNO',$this->BganGoodsNO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}