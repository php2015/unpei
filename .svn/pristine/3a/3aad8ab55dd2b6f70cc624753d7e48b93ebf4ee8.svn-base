<?php

/**
 * This is the model class for table "{{dealer_goods_spec}}".
 *
 * The followings are the available columns in table '{{dealer_goods_spec}}':
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
 * @property string $ImageUrl
 * @property string $DetectionImg
 * @property string $Unit
 * @property string $BganCompany
 * @property string $BganGoodsNO
 * @property string $PartsNO
 * @property string $JiapartsNO
 */
class DealerGoodsSpec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerGoodsSpec the static model class
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
		return '{{dealer_goods_spec}}';
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
			array('Weight, Length, Wide, Height, Volume', 'numerical'),
			array('ValidityDate, Specifica, ImageUrl, DetectionImg, Unit, BganCompany, BganGoodsNO, PartsNO, JiapartsNO', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, GoodsID, Weight, Length, Wide, Height, Volume, ValidityType, ValidityDate, Specifica, ImageUrl, DetectionImg, Unit, BganCompany, BganGoodsNO, PartsNO, JiapartsNO', 'safe', 'on'=>'search'),
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
			'GoodsID' => 'Goods',
			'Weight' => 'Weight',
			'Length' => 'Length',
			'Wide' => 'Wide',
			'Height' => 'Height',
			'Volume' => 'Volume',
			'ValidityType' => 'Validity Type',
			'ValidityDate' => 'Validity Date',
			'Specifica' => 'Specifica',
			'ImageUrl' => 'Image Url',
			'DetectionImg' => 'Detection Img',
			'Unit' => 'Unit',
			'BganCompany' => 'Bgan Company',
			'BganGoodsNO' => 'Bgan Goods No',
			'PartsNO' => 'Parts No',
			'JiapartsNO' => 'Jiaparts No',
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
		$criteria->compare('Weight',$this->Weight);
		$criteria->compare('Length',$this->Length);
		$criteria->compare('Wide',$this->Wide);
		$criteria->compare('Height',$this->Height);
		$criteria->compare('Volume',$this->Volume);
		$criteria->compare('ValidityType',$this->ValidityType);
		$criteria->compare('ValidityDate',$this->ValidityDate,true);
		$criteria->compare('Specifica',$this->Specifica,true);
		$criteria->compare('ImageUrl',$this->ImageUrl,true);
		$criteria->compare('DetectionImg',$this->DetectionImg,true);
		$criteria->compare('Unit',$this->Unit,true);
		$criteria->compare('BganCompany',$this->BganCompany,true);
		$criteria->compare('BganGoodsNO',$this->BganGoodsNO,true);
		$criteria->compare('PartsNO',$this->PartsNO,true);
		$criteria->compare('JiapartsNO',$this->JiapartsNO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}