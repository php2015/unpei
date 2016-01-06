<?php

/**
 * This is the model class for table "{{recommend_record}}".
 *
 * The followings are the available columns in table '{{recommend_record}}':
 * @property integer $ID
 * @property integer $RecomID
 * @property integer $RecomTime
 * @property integer $BeFormalTime
 * @property string $RecomMethod
 * @property integer $MemberStatus
 * @property integer $DealerID
 * @property integer $ServiceID
 */
class RecommendRecord extends JPDActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{recommend_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('RecomID, BeFormalTime, DealerID, ServiceID', 'required'),
			array('RecomID, RecomTime, BeFormalTime, MemberStatus, DealerID, ServiceID', 'numerical', 'integerOnly'=>true),
			array('RecomMethod', 'length', 'max'=>24),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, RecomID, RecomTime, BeFormalTime, RecomMethod, MemberStatus, DealerID, ServiceID', 'safe', 'on'=>'search'),
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
			'RecomID' => 'Recom',
			'RecomTime' => 'Recom Time',
			'BeFormalTime' => 'Be Formal Time',
			'RecomMethod' => 'Recom Method',
			'MemberStatus' => 'Member Status',
			'DealerID' => 'Dealer',
			'ServiceID' => 'Service',
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
		$criteria->compare('RecomTime',$this->RecomTime);
		$criteria->compare('BeFormalTime',$this->BeFormalTime);
		$criteria->compare('RecomMethod',$this->RecomMethod,true);
		$criteria->compare('MemberStatus',$this->MemberStatus);
		$criteria->compare('DealerID',$this->DealerID);
		$criteria->compare('ServiceID',$this->ServiceID);

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
	 * @return RecommendRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
