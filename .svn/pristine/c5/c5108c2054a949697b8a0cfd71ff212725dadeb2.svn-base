<?php

/**
 * This is the model class for table "{{goods_category}}".
 *
 * The followings are the available columns in table '{{goods_category}}':
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property integer $manufacturer_id
 */
class GoodsCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GoodsCategory the static model class
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
		return '{{goods_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('manufacturer_id', 'length', 'max'=>20),
			array('name', 'required', 'message'=>'请输入类别名称'),
			 array('name','validateName'),
			array('code', 'required', 'message'=>'请输入类别代码'),
			array('code','validateCode'),
			array('desc', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, desc, manufacturer_id,code', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'desc' => 'Desc',
			'manufacturer_id' => 'Manufacturer',
			'code'=>'code',
		);
	}
	//验证商品类别唯一
	public function validateCode($attribute,$params)
	{
		$manufacturer_id=Yii::app()->user->id;
		if(!$this->hasErrors('code'))
		{
			$code=trim($this->code);
			$result=GoodsCategory::model()->findAll('code=:goodsno and manufacturer_id=:manufacturer_id',array(':goodsno'=>$code,':manufacturer_id'=>$manufacturer_id));
			if($result && count($result)>0)
			{
				$this->addError('code','该类别代号已使用');
			}
		}
	
	}
	//验证商品类别唯一
	public function validateName($attribute,$params)
	{
		$manufacturer_id=Yii::app()->user->id;
		if(!$this->hasErrors('name'))
		{
			$name=trim($this->name);
			$result=GoodsCategory::model()->findAll('name=:goodsno and manufacturer_id=:manufacturer_id',array(':goodsno'=>$name,':manufacturer_id'=>$manufacturer_id));
			if($result && count($result)>0)
			{
				$this->addError('name','该类别名称已使用');
			}
		}
	
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
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('manufacturer_id',$this->manufacturer_id,true);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}