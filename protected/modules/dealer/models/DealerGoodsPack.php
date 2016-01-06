<?php

/**
 * This is the model class for table "{{dealer_goods_pack}}".
 *
 * The followings are the available columns in table '{{dealer_goods_pack}}':
 * @property integer $ID
 * @property integer $GoodsID
 * @property integer $MinQuantity
 * @property double $Weight
 * @property double $Volume
 */
class DealerGoodsPack extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerGoodsPack the static model class
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
		return '{{dealer_goods_pack}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('GoodsID, MinQuantity', 'numerical', 'integerOnly'=>true),
			array('Weight, Volume', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, GoodsID, MinQuantity, Weight, Volume', 'safe', 'on'=>'search'),
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
			'MinQuantity' => 'Min Quantity',
			'Weight' => 'Weight',
			'Volume' => 'Volume',
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
		$criteria->compare('MinQuantity',$this->MinQuantity);
		$criteria->compare('Weight',$this->Weight);
		$criteria->compare('Volume',$this->Volume);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}