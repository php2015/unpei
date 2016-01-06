<?php

/**
 * This is the model class for table "{{dealer_promotion}}".
 *
 * The followings are the available columns in table '{{dealer_promotion}}':
 * @property integer $id
 * @property integer $userID
 * @property string $goodsName
 * @property string $goodsNO
 * @property string $goodsBrand
 * @property string $normName
 * @property string $partsLevel
 * @property string $OENO
 * @property string $make
 * @property string $car
 * @property string $youhui
 * @property integer $flag
 * @property string $createtime
 */
class DealerPromotion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerPromotion the static model class
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
		return '{{dealer_promotion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID, flag', 'numerical', 'integerOnly'=>true),
			array('goodsName, goodsNO, goodsBrand, normName, OENO', 'length', 'max'=>64),
			array('partsLevel, make, car, createtime', 'length', 'max'=>24),
			array('goodsName,goodsNO,goodsBrand,OENO','required'),
			array('youhui', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, goodsName, goodsNO, goodsBrand, normName, partsLevel, OENO, make, car, youhui, flag, createtime', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'userID' => 'User',
			'goodsName' => '商品名称：',
			'goodsNO' => '商品编号：',
			'goodsBrand' => '商品品牌：',
			'normName' => '标准名称：',
			'partsLevel' => '配件级别：',
			'OENO' => 'OENO',
			'make' => '适用车系',
			'car' => 'Car',
			'youhui' => '优惠说明',
			'flag' => 'Flag',
			'createtime' => 'Createtime',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('goodsName',$this->goodsName,true);
		$criteria->compare('goodsNO',$this->goodsNO,true);
		$criteria->compare('goodsBrand',$this->goodsBrand,true);
		$criteria->compare('normName',$this->normName,true);
		$criteria->compare('partsLevel',$this->partsLevel,true);
		$criteria->compare('OENO',$this->OENO,true);
		$criteria->compare('make',$this->make,true);
		$criteria->compare('car',$this->car,true);
		$criteria->compare('youhui',$this->youhui,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('createtime',$this->createtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}