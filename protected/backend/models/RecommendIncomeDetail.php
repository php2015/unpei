<?php

/**
 * This is the model class for table "{{recommend_income_detail}}".
 *
 * The followings are the available columns in table '{{recommend_income_detail}}':
 * @property integer $ID
 * @property integer $RecomID
 * @property integer $OrganID
 * @property string $IncomeAccount
 * @property string $income
 * @property integer $isAccount
 * @property integer $IncomeTime
 * @property integer $RecomTime
 * @property integer $BeFormalTime
 * @property string $RecomMethod
 * @property integer $MemberStatus
 * @property integer $ServiceID
 * @property integer $incomeID
 */
class RecommendIncomeDetail extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{recommend_income_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RecomID, OrganID, BeFormalTime, ServiceID', 'required'),
			array('RecomID, OrganID, isAccount, IncomeTime, RecomTime, BeFormalTime, MemberStatus, ServiceID, incomeID', 'numerical', 'integerOnly'=>true),
			array('IncomeAccount', 'length', 'max'=>64),
			array('income', 'length', 'max'=>9),
			array('RecomMethod', 'length', 'max'=>24),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, RecomID, OrganID, IncomeAccount, income, isAccount, IncomeTime, RecomTime, BeFormalTime, RecomMethod, MemberStatus, ServiceID, incomeID', 'safe', 'on'=>'search'),
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
			'list'=>array(self::HAS_ONE,'RecommendList','','on'=>'t.RecomID=list.ID and list.RecomStatus=1')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'RecomID' => 'Recom',
			'OrganID' => 'Organ',
			'IncomeAccount' => 'Income Account',
			'income' => 'Income',
			'isAccount' => 'Is Account',
			'IncomeTime' => 'Income Time',
			'RecomTime' => 'Recom Time',
			'BeFormalTime' => 'Be Formal Time',
			'RecomMethod' => 'Recom Method',
			'MemberStatus' => 'Member Status',
			'ServiceID' => 'Service',
			'incomeID' => 'Income',
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
		$criteria->compare('RecomID',$this->RecomID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('IncomeAccount',$this->IncomeAccount,true);
		$criteria->compare('income',$this->income,true);
		$criteria->compare('isAccount',$this->isAccount);
		$criteria->compare('IncomeTime',$this->IncomeTime);
		$criteria->compare('RecomTime',$this->RecomTime);
		$criteria->compare('BeFormalTime',$this->BeFormalTime);
		$criteria->compare('RecomMethod',$this->RecomMethod,true);
		$criteria->compare('MemberStatus',$this->MemberStatus);
		$criteria->compare('ServiceID',$this->ServiceID);
		$criteria->compare('incomeID',$this->incomeID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->jpdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RecommendIncomeDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
