<?php

/**
 * This is the model class for table "{{financial_paypal}}".
 *
 * The followings are the available columns in table '{{financial_paypal}}':
 * @property integer $ID
 * @property string $PaypalAccount
 * @property string $OwnerName
 * @property string $Uses
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 * @property integer $IsCollect
 * @property integer $IsRecommend
 */
class FinancialPaypal extends JPDActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{financial_paypal}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OwnerName, PaypalAccount, OrganID, UserID', 'required'),
            array('OrganID, UserID, CreateTime, UpdateTime, Status, IsCollect, IsRecommend', 'numerical', 'integerOnly' => true),
            array('PaypalAccount, Uses', 'length', 'max' => 64),
            array('OwnerName', 'length', 'max' => 24),
            //array('PaypalAccount','unique','message'=>'账号已绑定'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('OwnerName', 'match', 'pattern' => '/^[^<>&~]*$/', 'message' => "不允许<、>、&、~等特殊符号"),
            array('PaypalAccount', 'match', 'pattern' => '/^[^<>&~]*$/', 'message' => "不允许<、>、&、~等特殊符号"),
            array('Uses', 'match', 'pattern' => '/^[^<>&~]*$/', 'message' => "不允许<、>、&、~等特殊符号"),
            array('ID, PaypalAccount, OwnerName, Uses, OrganID, UserID, CreateTime, UpdateTime, Status, IsCollect, IsRecommend', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'PaypalAccount' => '支付宝账号',
            'OwnerName' => '姓名',
            'Uses' => '用处',
            'OrganID' => 'Organ',
            'UserID' => 'User',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'Status' => 'Status',
            'IsCollect' => 'Is Collect',
            'IsRecommend' => 'Is Recommend',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID);
        $criteria->compare('PaypalAccount', $this->PaypalAccount, true);
        $criteria->compare('OwnerName', $this->OwnerName, true);
        $criteria->compare('Uses', $this->Uses, true);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('UserID', $this->UserID);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('IsCollect', $this->IsCollect);
        $criteria->compare('IsRecommend', $this->IsRecommend);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return CDbConnection the database connection used for this class
     */
    public function getDbConnection() {
        return Yii::app()->jpdb;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FinancialPaypal the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * 检验支付宝账户唯一性
     */

    public function checkPaypalAccount() {
        $model = FinancialPaypal::model()->findAll('Status=0 AND OrganID = :OrganID', array(':OrganID' => Yii::app()->user->getOrganID()));
        if ($model && count($model) > 0) {
            $this->addError('PaypalAccount', '系统暂时仅支持一个账号！');
        }
    }

}
