<?php

/**
 * This is the model class for table "{{recommend_income}}".
 *
 * The followings are the available columns in table '{{recommend_income}}':
 * @property integer $ID
 * @property integer $EffectTime
 * @property integer $OrganID
 * @property string $IncomeAccount
 * @property string $MonthIncome
 * @property integer $IsAccount
 * @property string $Year
 * @property string $Month
 */
class RecommendIncome extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{recommend_income}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EffectTime, OrganID', 'required'),
			array('EffectTime, OrganID, IsAccount', 'numerical', 'integerOnly'=>true),
			array('IncomeAccount', 'length', 'max'=>64),
			array('MonthIncome', 'length', 'max'=>9),
			array('Year', 'length', 'max'=>4),
			array('Month', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, EffectTime, OrganID, IncomeAccount, MonthIncome, IsAccount, Year, Month', 'safe', 'on'=>'search'),
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
			//'list' => array(self::HAS_ONE,'RecommendList','on' => 't.OrganID = list.OrganID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'EffectTime' => 'Effect Time',
			'OrganID' => 'Organ',
			'IncomeAccount' => 'Income Account',
			'MonthIncome' => 'Month Income',
			'IsAccount' => 'Is Account',
			'Year' => 'Year',
			'Month' => 'Month',
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
		$criteria->compare('EffectTime',$this->EffectTime);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('IncomeAccount',$this->IncomeAccount,true);
		$criteria->compare('MonthIncome',$this->MonthIncome,true);
		$criteria->compare('IsAccount',$this->IsAccount);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('Month',$this->Month,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
//	public function getDbConnection()
//	{
//		return Yii::app()->jpdb;
//	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RecommendIncome the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
