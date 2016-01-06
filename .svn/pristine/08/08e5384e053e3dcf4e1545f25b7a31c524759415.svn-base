<?php

/**
 * This is the model class for table "{{make_empower_dealer}}".
 *
 * The followings are the available columns in table '{{make_empower_dealer}}':
 * @property integer $id
 * @property integer $up_userID
 * @property string $organName
 * @property string $grade
 * @property string $brand
 * @property string $accountMethods
 * @property integer $dealer_id
 * @property integer $category
 */
class MakeEmpowerDealer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeEmpowerDealer the static model class
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
		return '{{make_empower_dealer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('up_userID, dealer_id, category', 'numerical', 'integerOnly'=>true),
			array('organName', 'required'),
			array('brand', 'required','message'=>'请选择授权品牌'),
			array('category', 'required','message'=>'请选择授权品类'),
			array('grade', 'required','message'=>'请选择经营级别'),
			array('accountMethods', 'required','message'=>'请选择结算方式'),
			array('brand', 'length', 'max'=>50),
			array('accountMethods', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, up_userID, organName, grade, brand, accountMethods, dealer_id, category', 'safe', 'on'=>'search'),
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
			'up_userID' => 'Up User',
			'organName' => '机构名称',
			'grade' => 'Grade',
			'brand' => 'Brand',
			'accountMethods' => 'Account Methods',
			'dealer_id' => 'Dealer',
			'category' => 'Category',
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
		$criteria->compare('up_userID',$this->up_userID);
		$criteria->compare('organName',$this->organName,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('accountMethods',$this->accountMethods,true);
		$criteria->compare('dealer_id',$this->dealer_id);
		$criteria->compare('category',$this->category);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}