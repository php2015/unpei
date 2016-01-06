<?php

/**
 * This is the model class for table "{{dealer_promotion_cpname}}".
 *
 * The followings are the available columns in table '{{dealer_promotion_cpname}}':
 * @property integer $id
 * @property integer $userid
 * @property integer $pgoods_id
 * @property string $system_type
 * @property string $cp_name
 */
class DealerPromotionCpname extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerPromotionCpname the static model class
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
		return '{{dealer_promotion_cpname}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, pgoods_id', 'numerical', 'integerOnly'=>true),
			array('system_type, cp_name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, pgoods_id, system_type, cp_name', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'pgoods_id' => 'Pgoods',
			'system_type' => 'System Type',
			'cp_name' => 'Cp Name',
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
		$criteria->compare('userid',$this->userid);
		$criteria->compare('pgoods_id',$this->pgoods_id);
		$criteria->compare('system_type',$this->system_type,true);
		$criteria->compare('cp_name',$this->cp_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}