<?php

/**
 * This is the model class for table "{{companytype}}".
 *
 * The followings are the available columns in table '{{companytype}}':
 * @property integer $companyType
 * @property string $companyTypeName
 */
class Companytype extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Companytype the static model class
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
		return '{{companytype}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyTypeName', 'required'),
			array('companyTypeName', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('companyType, companyTypeName', 'safe', 'on'=>'search'),
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
			'companyType' => 'Company Type',
			'companyTypeName' => 'Company Type Name',
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

		$criteria->compare('companyType',$this->companyType);
		$criteria->compare('companyTypeName',$this->companyTypeName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function showIdentity()
	{
		$userId = Yii::app()->user->id;
		$Code = User::model()->find("id=:id",array(":id"=>$userId));
		$model = self::model()->find("companyType=:companyType",array(":companyType"=>$Code['identity']));
		echo $model->companyTypeName;
	}
        public static function Identity($userId)
	{
		//$userId = Yii::app()->user->id;
		$Code = User::model()->find("id=:id",array(":id"=>$userId));
		$model = self::model()->find("companyType=:companyType",array(":companyType"=>$Code['identity']));
		echo $model->companyTypeName;
	}
	/*
	 * 格式化金钱函数
	 * 格式转换:1234567 => ￥1,234,567.00
	 */		
	public function doFormatMoney($money, $len=2, $sign='￥'){
	    $negative = $money >= 0 ? '' : '-';
	    $int_money = intval(abs($money));
	    $len = intval(abs($len));
	    $decimal = '';	//小数
	    if ($len > 0) {
	     $decimal = '.'.substr(sprintf('%01.'.$len.'f', $money),-$len);
	    }
	    $tmp_money = strrev($int_money);
	    $strlen = strlen($tmp_money);
	    for ($i = 3; $i < $strlen; $i += 3) {
	        $format_money .= substr($tmp_money,0,3).',';
	        $tmp_money = substr($tmp_money,3);
	    }
	    $format_money .= $tmp_money;
	    $format_money = strrev($format_money);
	    return $sign.$negative.$format_money.$decimal;
	}
}