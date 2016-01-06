<?php

/**
 * This is the model class for table "{{transport_make}}".
 *
 * The followings are the available columns in table '{{transport_make}}':
 * @property integer $id
 * @property string $Code
 * @property string $Make
 */
class TransportMake extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransportMake the static model class
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
		return '{{transport_make}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Code, Make', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, Code, Make', 'safe', 'on'=>'search'),
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
			'Code' => 'Code',
			'Make' => 'Make',
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
		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('Make',$this->Make,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function showMake($id)
	{
		$model = self::model()->find("Code=:id",array(":id"=>$id));
		echo $model->Make;
	}
	public static function getMake($id)
	{
		$model = self::model()->find("Code=:id",array(":id"=>$id));
		return $model->Make;
	}
	public static function getCode($name){
		$model = self::model()->find( array('select' => 'Code', 'condition'=> 'Make LIKE :name','params'=> array (':name' =>"%$name%" )));
		return $model['Code'];
	}
}