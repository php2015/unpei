<?php

/**
 * This is the model class for table "{{goods_standard}}".
 *
 * The followings are the available columns in table '{{goods_standard}}':
 * @property integer $id
 * @property string $cp_name
 * @property string $aliases
 * @property string $consumable
 */
class GoodsStandard extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GoodsStandard the static model class
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
		return '{{goods_standard}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cp_name, aliases', 'length', 'max'=>50),
			array('consumable', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cp_name, aliases, consumable', 'safe', 'on'=>'search'),
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
			'cp_name' => 'Cp Name',
			'aliases' => 'Aliases',
			'consumable' => 'Consumable',
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
		$criteria->compare('cp_name',$this->cp_name,true);
		$criteria->compare('aliases',$this->aliases,true);
		$criteria->compare('consumable',$this->consumable,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}