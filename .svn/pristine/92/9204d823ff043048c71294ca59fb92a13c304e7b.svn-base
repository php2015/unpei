<?php

/**
 * This is the model class for table "{{goods_vehicle_version}}".
 *
 * The followings are the available columns in table '{{goods_vehicle_version}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $GoodsID
 * @property string $VechleVesrion
 * @property integer $VehVersion
 */
class PapGoodsVehicleVersion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PapGoodsVehicleVersion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->papdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{goods_vehicle_version}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, GoodsID, VechleVesrion, VehVersion', 'required'),
			array('OrganID, GoodsID, VehVersion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, OrganID, GoodsID, VechleVesrion, VehVersion', 'safe', 'on'=>'search'),
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
			'OrganID' => 'Organ',
			'GoodsID' => 'Goods',
			'VechleVesrion' => 'Vechle Vesrion',
			'VehVersion' => 'Veh Version',
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
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('VechleVesrion',$this->VechleVesrion,true);
		$criteria->compare('VehVersion',$this->VehVersion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}