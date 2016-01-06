<?php

/**
 * This is the model class for table "{{goods_benchmarking}}".
 *
 * The followings are the available columns in table '{{goods_benchmarking}}':
 * @property integer $id
 * @property string $brand
 * @property string $name
 * @property string $code
 * @property string $OE
 * @property string $Jiaparts_no
 */
class GoodsBenchmarking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GoodsBenchmarking the static model class
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
		return '{{goods_benchmarking}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand, Jiaparts_no', 'length', 'max'=>20),
			array('name, code, OE', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand, name, code, OE, Jiaparts_no', 'safe', 'on'=>'search'),
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
				'oe' => array(self::HAS_ONE, 'goods', 'oe' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brand' => 'Brand',
			'name' => 'Name',
			'code' => 'Code',
			'OE' => 'Oe',
			'Jiaparts_no' => 'Jiaparts No',
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
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('OE',$this->OE,true);
		$criteria->compare('Jiaparts_no',$this->Jiaparts_no,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}