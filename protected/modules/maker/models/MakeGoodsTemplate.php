<?php

/**
 * This is the model class for table "{{make_goods_template}}".
 *
 * The followings are the available columns in table '{{make_goods_template}}':
 * @property integer $id
 * @property string $name
 * @property integer $organID
 * @property integer $userID
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $mark
 * @property integer $standard_id
 * @property string $ISdelete
 */
class MakeGoodsTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{make_goods_template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organID, userID, createtime, updatetime, standard_id', 'numerical', 'integerOnly'=>true),
			array('name, mark', 'length', 'max'=>20),
			array('ISdelete', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, organID, userID, createtime, updatetime, mark, standard_id, ISdelete', 'safe', 'on'=>'search'),
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
			'organID' => 'Organ',
			'userID' => 'User',
			'createtime' => 'Createtime',
			'updatetime' => 'Updatetime',
			'mark' => 'Mark',
			'standard_id' => 'Standard',
			'ISdelete' => 'Isdelete',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('organID',$this->organID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('createtime',$this->createtime);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('mark',$this->mark,true);
		$criteria->compare('standard_id',$this->standard_id);
		$criteria->compare('ISdelete',$this->ISdelete,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MakeGoodsTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
