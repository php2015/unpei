<?php

/**
 * This is the model class for table "{{quotation_scheme}}".
 *
 * The followings are the available columns in table '{{quotation_scheme}}':
 * @property string $SchID
 * @property integer $QuoID
 * @property string $TotalFee
 * @property string $ShipFee
 * @property string $Status
 * @property string $FileUrl
 * @property string $GoodFee
 * @property string $FileName
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class PapQuotationScheme extends PAPActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{quotation_scheme}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('QuoID, TotalFee, ShipFee, CreateTime, UpdateTime', 'required'),
			array('QuoID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			array('TotalFee, ShipFee, GoodFee', 'length', 'max'=>10),
			array('Status', 'length', 'max'=>1),
			array('FileUrl', 'length', 'max'=>255),
			array('FileName', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('SchID, QuoID, TotalFee, ShipFee, Status, FileUrl, GoodFee, FileName, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
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
			'SchID' => '报价单方案ID',
			'QuoID' => '报价单ID',
			'TotalFee' => '报价金额',
			'ShipFee' => '物流费用',
			'Status' => '(1/2 /未选择/已选择)',
			'FileUrl' => '附件',
			'GoodFee' => '商品总金额',
			'FileName' => 'File Name',
			'CreateTime' => '创建时间',
			'UpdateTime' => '修改时间',
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

		$criteria->compare('SchID',$this->SchID,true);
		$criteria->compare('QuoID',$this->QuoID);
		$criteria->compare('TotalFee',$this->TotalFee,true);
		$criteria->compare('ShipFee',$this->ShipFee,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('FileUrl',$this->FileUrl,true);
		$criteria->compare('GoodFee',$this->GoodFee,true);
		$criteria->compare('FileName',$this->FileName,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);

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
	 * @return PapQuotationScheme the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
