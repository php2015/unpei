<?php

/**
 * This is the model class for table "{{service_car}}".
 *
 * The followings are the available columns in table '{{service_car}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $OwnerID
 * @property string $Car
 * @property string $LicensePlate
 * @property integer $UseNature
 * @property string $VinCode
 * @property integer $BuyTime
 * @property integer $Mileage
 * @property string $VehicleLicense
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $Status
 * @property string $Code
 * @property integer $Relation
 * @property string $PartsLevel
 *
 * The followings are the available model relations:
 * @property Organ $organ
 */
class ServiceCar extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{service_car}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID, LicensePlate, CreateTime, Mileage', 'required'),
            array('OrganID, OwnerID, UseNature, BuyTime, Mileage, CreateTime, UpdateTime, Status, Relation', 'numerical', 'integerOnly' => true),
            array('Car, LicensePlate', 'length', 'max' => 64),
            array('VinCode, LicensePlate', 'length', 'max' => 10),
            array('VehicleLicense', 'length', 'max' => 30),
            array('Code', 'length', 'max' => 50),
            array('PartsLevel', 'length', 'max' => 24),
            array('LicensePlate', 'match', 'pattern' => '/^[^<>&~]*$/', 'message' => "不允许<、>、&、~等特殊符号"),
            array('VehicleLicense', 'match', 'pattern' => '/^[^<>&~]*$/', 'message' => "不允许<、>、&、~等特殊符号"),
            array('LicensePlate', 'checkLicensePlate', 'on' => 'insert,update'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, OrganID, OwnerID, Car, LicensePlate, UseNature, VinCode, BuyTime, Mileage, VehicleLicense, CreateTime, UpdateTime, Status, Code, Relation, PartsLevel', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'organ' => array(self::BELONGS_TO, 'Organ', 'OrganID'),
            'owner' => array(self::BELONGS_TO, 'ServiceCarOwner', 'OwnerID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'OrganID' => '机构',
            'OwnerID' => '车主',
            'Car' => '品牌',
            'LicensePlate' => '车牌号',
            'UseNature' => '使用性质',
            'VinCode' => '车架/VIN码(前10位)',
            'BuyTime' => '购买时间',
            'Mileage' => '里程数',
            'VehicleLicense' => '行驶证号',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'Status' => 'Status',
            'Code' => 'Code',
            'Relation' => 'Relation',
            'PartsLevel' => 'Parts Level',
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
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('OwnerID', $this->OwnerID);
        $criteria->compare('Car', $this->Car, true);
        $criteria->compare('LicensePlate', $this->LicensePlate, true);
        $criteria->compare('UseNature', $this->UseNature);
        $criteria->compare('VinCode', $this->VinCode, true);
        $criteria->compare('BuyTime', $this->BuyTime);
        $criteria->compare('Mileage', $this->Mileage);
        $criteria->compare('VehicleLicense', $this->VehicleLicense, true);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Code', $this->Code, true);
        $criteria->compare('Relation', $this->Relation);
        $criteria->compare('PartsLevel', $this->PartsLevel, true);

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
     * @return ServiceCar the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * 检测车牌号
     */

    public function checkLicensePlate() {
        $OrganID = Yii::app()->user->getOrganID();
        $ID = $_POST['ServiceCar']['ID'] ? $_POST['ServiceCar']['ID'] : 0;
        $model = ServiceCar::model()->findAll('LicensePlate = :LicensePlate AND OrganID = :OrganID AND ID <> :id AND Status = 0', array(':LicensePlate' => $_POST['ServiceCar']['LicensePlate'], ':OrganID' => $OrganID, ':id' => $ID));
        if ($model && count($model) > 0) {
            $this->addError('LicensePlate', '该车牌号已存在，请勿重复添加！');
        }
    }

}
