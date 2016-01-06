<?php

/**
 * This is the model class for table "{{quotation}}".
 *
 * The followings are the available columns in table '{{quotation}}':
 * @property string $QuoID
 * @property string $InquiryID
 * @property string $DealerID
 * @property string $ServiceID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $SorceID
 * @property string $IfSend
 * @property string $QuoSn
 * @property string $Title
 * @property string $Status
 * @property string $Discount
 */
class PapQuotation extends PAPActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{quotation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DealerID, ServiceID, CreateTime, UpdateTime, QuoSn, Title', 'required'),
			array('CreateTime, UpdateTime, SorceID', 'numerical', 'integerOnly'=>true),
			array('InquiryID, DealerID, ServiceID', 'length', 'max'=>11),
			array('IfSend, Status', 'length', 'max'=>1),
			array('QuoSn', 'length', 'max'=>25),
			array('Title', 'length', 'max'=>255),
			array('Discount', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('QuoID, InquiryID, DealerID, ServiceID, CreateTime, UpdateTime, SorceID, IfSend, QuoSn, Title, Status, Discount', 'safe', 'on'=>'search'),
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
			'QuoID' => '报价单ID',
			'InquiryID' => '询价单ID',
			'DealerID' => '经销商ID',
			'ServiceID' => '服务店ID',
			'CreateTime' => '报价时间',
			'UpdateTime' => '修改时间',
			'SorceID' => '起发人ID',
			'IfSend' => '(1/2 /未发送/已发送)',
			'QuoSn' => '报价单编号',
			'Title' => '报价单名称',
			'Status' => '(1/2/3/4/5 /已报价待确认/已确认/待修改/已拒绝/已失效)',
			'Discount' => '折扣率备注',
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

		$criteria->compare('QuoID',$this->QuoID,true);
		$criteria->compare('InquiryID',$this->InquiryID,true);
		$criteria->compare('DealerID',$this->DealerID,true);
		$criteria->compare('ServiceID',$this->ServiceID,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('SorceID',$this->SorceID);
		$criteria->compare('IfSend',$this->IfSend,true);
		$criteria->compare('QuoSn',$this->QuoSn,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('Discount',$this->Discount,true);

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
	 * @return PapQuotation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
