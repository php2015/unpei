<?php

/**
 * This is the model class for table "{{inquiry}}".
 *
 * The followings are the available columns in table '{{inquiry}}':
 * @property integer $InquiryID
 * @property string $InquirySn
 * @property string $VIN
 * @property string $OrderSn
 * @property string $Describe
 * @property integer $CreateTime
 * @property string $DealerID
 * @property integer $UpdateTime
 * @property integer $OrganID
 * @property integer $Status
 * @property string $Make
 * @property string $Car
 * @property string $Year
 * @property string $Model
 * @property integer $State
 */
class PapInquiry extends PAPActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{inquiry}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CreateTime, UpdateTime, OrganID, Status, State', 'numerical', 'integerOnly'=>true),
			array('InquirySn, VIN', 'length', 'max'=>50),
			array('OrderSn', 'length', 'max'=>24),
			array('DealerID', 'length', 'max'=>255),
			array('Make, Car, Model', 'length', 'max'=>20),
			array('Year', 'length', 'max'=>10),
			array('Describe', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('InquiryID, InquirySn, VIN, OrderSn, Describe, CreateTime, DealerID, UpdateTime, OrganID, Status, Make, Car, Year, Model, State', 'safe', 'on'=>'search'),
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
			'InquiryID' => '主键ID',
			'InquirySn' => '询价单编号',
			'VIN' => 'VIN码',
			'OrderSn' => '订单编号',
			'Describe' => '详细说明',
			'CreateTime' => '询价时间',
			'DealerID' => '接收询价单的经销商ID',
			'UpdateTime' => '更新时间',
			'OrganID' => '服务店ID',
			'Status' => '状态（待报价/已报价待确认/已确认/已撤销-0/1/2/3）',
			'Make' => '厂家',
			'Car' => '车系',
			'Year' => '年款',
			'Model' => '车型',
			'State' => '来源',
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

		$criteria->compare('InquiryID',$this->InquiryID);
		$criteria->compare('InquirySn',$this->InquirySn,true);
		$criteria->compare('VIN',$this->VIN,true);
		$criteria->compare('OrderSn',$this->OrderSn,true);
		$criteria->compare('Describe',$this->Describe,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('DealerID',$this->DealerID,true);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Car',$this->Car,true);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('Model',$this->Model,true);
		$criteria->compare('State',$this->State);

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
	 * @return PapInquiry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
		   public static function Showfact($row,$type){
            $inquiryStatus=array(
                0=>'待报价',
                1=>'已报价待确认',
                2=>'<span style="color:green">已确认</span>',
                3=>'<span style="color:gray">已撤销</span>',
                4=>'<span style="color:red">已拒绝</span>',
                5=>'<span style="color:gray">已失效</span>'
            );
            $data=$$type;
            return $data[$row];
        }
}
