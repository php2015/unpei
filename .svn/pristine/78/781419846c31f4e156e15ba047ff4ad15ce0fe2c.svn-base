<?php

/**
 * This is the model class for table "{{contacts}}".
 *
 * The followings are the available columns in table '{{contacts}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $ContactID
 * @property string $CooperationType
 * @property integer $CategoryID
 * @property string $Name
 * @property string $QQ
 * @property string $Weixin
 * @property string $Email
 * @property string $Phone
 * @property string $Sex
 * @property string $Memo
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property string $Status
 */

class Contacts extends JPDActiveRecord
{
                 public $OrganName;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contacts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name,OrganName,Email,Phone', 'required'),
			array('OrganID, ContactID, CategoryID, CreateTime, UpdateTime', 'numerical', 'integerOnly'=>true),
			//array('CooperationType, Status', 'length', 'max'=>1),
			array('Name, QQ, Weixin', 'length', 'max'=>20),
			array('Email', 'length', 'max'=>50),
                                                       array('Phone', 'match', 'pattern' => '/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/', 'message' => "手机号格式不正确"),
                                                   array('Email', 'match', 'pattern' => '/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i', 'message' => "邮箱格式不正确"),
			array('Phone', 'length', 'max'=>15),
			array('Sex', 'length', 'max'=>3),
			array('Memo', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganID, ContactID, CooperationType, CategoryID, Name, QQ, Weixin, Email, Phone, Sex, Memo, CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
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
               'organ' => array(self::BELONGS_TO, 'Organ', '', 'on' => 't.ContactID=organ.ID'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'OrganID' => 'OrganID',
			'ContactID' => 'Contact',
			'CooperationType' => '合作类型',
			'CategoryID' => '客户类别',
			'Name' => '姓名',
			'QQ' => 'QQ',
			'Weixin' => '微信',
			'Email' => '邮箱',
			'Phone' => '手机号',
			'Sex' => '性别',
			'Memo' => '备注',
			'CreateTime' => '创建时间',
			'UpdateTime' => '修改时间',
			'Status' => 'Status',
                                                    'OrganName'=>'机构名称'
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
                                    $organID=Yii::app()->user->getOrganID();
		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('ContactID',$this->ContactID);
		$criteria->compare('CooperationType',$this->CooperationType,true);
		$criteria->compare('CategoryID',$this->CategoryID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('Weixin',$this->Weixin,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('t.Phone',$this->Phone,true);
		$criteria->compare('Sex',$this->Sex,true);
		$criteria->compare('Memo',$this->Memo,true);
		$criteria->compare('CreateTime',$this->CreateTime);
		$criteria->compare('UpdateTime',$this->UpdateTime);
                                    $criteria->addCondition('t.OrganID='.$organID);
                                    $criteria->addCondition("t.Status='0'");
                                    $criteria->with='organ';
                                    $criteria->order='t.ID DESC';
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
	 * @return Contacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
                //替换机构类型
                public static function item($type,$value)
                {
                    $items=array(
                        'Identity' => array(
                        '1' => '生产商',
                        '2' => '经销商',
                        '3' => '修理厂',
                    )
                    );
                    return isset($items[$type][$value]) ? $items[$type][$value] : false;
                }
               protected function beforeSave()
               {
                   if(parent::beforeSave())
                   {
                       if($this->isNewRecord)
                       {
                           $this->CreateTime=time();
                           $this->UpdateTime=time();
                           $this->OrganID=Yii::app()->user->getOrganID();
                       }else
                       {
                           $this->CreateTime=time();
                           $this->UpdateTime=time();
                           $this->OrganID=Yii::app()->user->getOrganID();
                       }
                       return true;
                   }else
                   {
                       return false;
                   }
               }
}
