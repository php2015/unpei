<?php

/**
 * This is the model class for table "{{evaluation_goods_image}}".
 *
 * The followings are the available columns in table '{{evaluation_goods_image}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $GoodsID
 * @property string $ImageUrl
 * @property string $ImageName
 * @property integer $CreateTime
 * @property integer $EvalID
 */
class PapEvaluationGoodsImage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{evaluation_goods_image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID, GoodsID, ImageUrl, ImageName, EvalID', 'required'),
			array('OrganID, GoodsID, CreateTime, EvalID', 'numerical', 'integerOnly'=>true),
			array('ImageUrl, ImageName', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganID, GoodsID, ImageUrl, ImageName, CreateTime, EvalID', 'safe', 'on'=>'search'),
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
			'ID' => '主键ID',
			'OrganID' => '机构ID',
			'GoodsID' => '商品ID',
			'ImageUrl' => '图片路径',
			'ImageName' => '图片名称',
			'CreateTime' => '创建时间',
			'EvalID' => '评论ID',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('GoodsID',$this->GoodsID);
		$criteria->compare('ImageUrl',$this->ImageUrl,true);
		$criteria->compare('ImageName',$this->ImageName,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('EvalID',$this->EvalID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->papdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PapEvaluationGoodsImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
