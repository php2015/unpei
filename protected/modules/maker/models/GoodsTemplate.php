<?php

/**
 * This is the model class for table "{{goods_template}}".
 *
 * The followings are the available columns in table '{{goods_template}}':
 * @property integer $id
 * @property string $name
 * @property integer $manufacturer_id
 * @property string $Column1
 * @property string $Column2
 * @property string $Column3
 * @property string $Column4
 * @property string $Column5
 * @property integer $createtime
 * @property string $mark
 */
class GoodsTemplate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GoodsTemplate the static model class
	 */
	public $value1;
	public $value2;
	public $value3;
	public $value4;
	public $value5;
    public $cpname;
    public $system_type;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{goods_template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('manufacturer_id', 'required'),
			array('manufacturer_id, createtime', 'numerical', 'integerOnly'=>true),
			array('name, Column1, Column2, Column3, Column4, Column5, mark', 'length', 'max'=>20),
			array('name','required','message'=>'请输入模板名称'),
			array('cpname','required','message'=>'请选择标准名称'),
			array('Column1,Column2,Column3,Column4,Column5','required','message'=>'请输入参数名称'),
			array('id, name, manufacturer_id, Column1, Column2, Column3, Column4, Column5, createtime, mark', 'safe', 'on'=>'search'),
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
			'name' => '模板名称',
			'manufacturer_id' => 'Manufacturer',
            ' standard_id'=>'standard_id',
			'Column1' => '参数名1',
			'Column2' => '参数名2',
			'Column3' => '参数名3',
			'Column4' => '参数名4',
			'Column5' => '参数名5',
			'createtime' => 'Createtime',
			'mark' => 'Mark',
			'value1'=>'参数值1',
			'value2'=>'参数值2',
			'value3'=>'参数值3',
			'value4'=>'参数值4',
			'value5'=>'参数值5',
				
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('Column1',$this->Column1,true);
		$criteria->compare('Column2',$this->Column2,true);
		$criteria->compare('Column3',$this->Column3,true);
		$criteria->compare('Column4',$this->Column4,true);
		$criteria->compare('Column5',$this->Column5,true);
		$criteria->compare('createtime',$this->createtime);
		$criteria->compare('mark',$this->mark,true);
                $criteria->compare(' standard_id',$this-> standard_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
		
	}
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->createtime=time();
			
			}
			return true;
		}
		else
			return false;
	}
}