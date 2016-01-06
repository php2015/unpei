<?php

/**
 * This is the model class for table "goods_model".
 *
 * The followings are the available columns in table 'goods_model':
 * @property string $modelid
 * @property string $name
 * @property string $ename
 * @property string $year
 * @property string $makeid
 * @property string $seriesid
 * @property string $alias
 */
class GoodsModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodsModel the static model class
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
		return 'goods_model';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modelid, name, makeid, seriesid', 'required'),
			array('modelid, makeid, seriesid', 'length', 'max'=>20),
			array('name, ename', 'length', 'max'=>200),
			array('year', 'length', 'max'=>10),
			array('alias', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('modelid, name, ename, year, makeid, seriesid, alias', 'safe', 'on'=>'search'),
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
			'modelid' => 'Modelid',
			'name' => 'Name',
			'ename' => 'Ename',
			'year' => 'Year',
			'makeid' => 'Makeid',
			'seriesid' => 'Seriesid',
			'alias' => 'Alias',
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

		$criteria->compare('modelid',$this->modelid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ename',$this->ename,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('makeid',$this->makeid,true);
		$criteria->compare('seriesid',$this->seriesid,true);
		$criteria->compare('alias',$this->alias,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}