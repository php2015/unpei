<?php

/**
 * This is the model class for table "{{make_goods_values}}".
 *
 * The followings are the available columns in table '{{make_goods_values}}':
 * @property integer $id
 * @property integer $organID
 * @property integer $userID
 * @property string $standard_id
 * @property string $value
 * @property string $version_name
 * @property integer $goods_id
 * @property integer $template_id
 */
class MakeGoodsValues extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{make_goods_values}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organID, userID, goods_id, template_id', 'numerical', 'integerOnly'=>true),
			array('standard_id, value, version_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, organID, userID, standard_id, value, version_name, goods_id, template_id', 'safe', 'on'=>'search'),
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
			'organID' => 'Organ',
			'userID' => 'User',
			'standard_id' => 'Standard',
			'value' => 'Value',
			'version_name' => 'Version Name',
			'goods_id' => 'Goods',
			'template_id' => 'Template',
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
		$criteria->compare('organID',$this->organID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('standard_id',$this->standard_id,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('version_name',$this->version_name,true);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('template_id',$this->template_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MakeGoodsValues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
