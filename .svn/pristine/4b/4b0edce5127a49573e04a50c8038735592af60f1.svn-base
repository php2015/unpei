<?php

/**
 * This is the model class for table "{{goods_values}}".
 *
 * The followings are the available columns in table '{{goods_values}}':
 * @property integer $id
 * @property integer $manufacturer_id
 * @property string $Column1
 * @property string $Column2
 * @property string $Column3
 * @property string $Column4
 * @property string $Column5
 */
class GoodsValues extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GoodsValues the static model class
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
		return '{{goods_values}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('manufacturer_id', 'numerical', 'integerOnly'=>true),
			array('Column1, Column2, Column3, Column4, Column5', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, manufacturer_id, Column1, Column2, Column3, Column4, Column5', 'safe', 'on'=>'search'),
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
			'manufacturer_id' => 'Manufacturer',
			'Column1' => 'Column1',
			'Column2' => 'Column2',
			'Column3' => 'Column3',
			'Column4' => 'Column4',
			'Column5' => 'Column5',
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
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('Column1',$this->Column1,true);
		$criteria->compare('Column2',$this->Column2,true);
		$criteria->compare('Column3',$this->Column3,true);
		$criteria->compare('Column4',$this->Column4,true);
		$criteria->compare('Column5',$this->Column5,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}