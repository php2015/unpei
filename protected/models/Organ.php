<?php

/**
 * This is the model class for table "{{organ}}".
 *
 * The followings are the available columns in table '{{organ}}':
 * @property integer $ID
 * @property string $OrganName
 * @property string $Phone
 * @property string $Email
 * @property integer $Identity
 * @property string $Recommend
 * @property integer $RecomID
 * @property string $Type
 * @property string $IsAuth
 * @property string $IsBlack
 * @property string $IsFreeze
 * @property string $Status
 * @property integer $CreateTime
 * @property integer $ExpirationTime
 * @property integer $LastVisitTime
 * @property string $Province
 * @property string $City
 * @property string $Area
 * @property string $Address
 * @property string $QQ
 * @property string $Fax
 * @property integer $FoundDate
 * @property string $Introduction
 * @property string $StoreSize
 */
class Organ extends CActiveRecord {
       public  $Grade;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Organ the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return CDbConnection database connection
     */
    public function getDbConnection() {
        return Yii::app()->jpdb;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{organ}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Email', 'required'),
            array('Identity, RecomID, CreateTime, ExpirationTime, LastVisitTime, FoundDate', 'numerical', 'integerOnly' => true),
            array('OrganName, Email', 'length', 'max' => 128),
            array('Phone, Recommend, StoreSize', 'length', 'max' => 20),
            array('Type', 'length', 'max' => 12),
            array('IsAuth, IsBlack, IsFreeze, Status', 'length', 'max' => 1),
            array('Province, City, Area, Address', 'length', 'max' => 50),
            array('QQ', 'length', 'max' => 11),
            array('Fax', 'length', 'max' => 15),
            array('Introduction', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, OrganName, Phone, Email, Identity, Recommend, RecomID, Type, IsAuth, IsBlack, IsFreeze, Status, CreateTime, ExpirationTime, LastVisitTime, Province, City, Area, Address, QQ, Fax, FoundDate, Introduction, StoreSize', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//            'typeid' => array(self::BELONGS_TO, 'PapClientType', '', 'on' => 'typeid.ServiceID=t.ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'OrganName' => 'Organ Name',
            'Phone' => 'Phone',
            'Email' => 'Email',
            'Identity' => 'Identity',
            'Recommend' => 'Recommend',
            'RecomID' => 'Recom',
            'Type' => 'Type',
            'IsAuth' => 'Is Auth',
            'IsBlack' => 'Is Black',
            'IsFreeze' => 'Is Freeze',
            'Status' => 'Status',
            'CreateTime' => 'Create Time',
            'ExpirationTime' => 'Expiration Time',
            'LastVisitTime' => 'Last Visit Time',
            'Province' => 'Province',
            'City' => 'City',
            'Area' => 'Area',
            'Address' => 'Address',
            'QQ' => 'Qq',
            'Fax' => 'Fax',
            'FoundDate' => 'Found Date',
            'Introduction' => 'Introduction',
            'StoreSize' => 'Store Size',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID);
        $criteria->compare('OrganName', $this->OrganName, true);
        $criteria->compare('Phone', $this->Phone, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('Identity', $this->Identity);
        $criteria->compare('Recommend', $this->Recommend, true);
        $criteria->compare('RecomID', $this->RecomID);
        $criteria->compare('Type', $this->Type, true);
        $criteria->compare('IsAuth', $this->IsAuth, true);
        $criteria->compare('IsBlack', $this->IsBlack, true);
        $criteria->compare('IsFreeze', $this->IsFreeze, true);
        $criteria->compare('Status', $this->Status, true);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('ExpirationTime', $this->ExpirationTime);
        $criteria->compare('LastVisitTime', $this->LastVisitTime);
        $criteria->compare('Province', $this->Province, true);
        $criteria->compare('City', $this->City, true);
        $criteria->compare('Area', $this->Area, true);
        $criteria->compare('Address', $this->Address, true);
        $criteria->compare('QQ', $this->QQ, true);
        $criteria->compare('Fax', $this->Fax, true);
        $criteria->compare('FoundDate', $this->FoundDate);
        $criteria->compare('Introduction', $this->Introduction, true);
        $criteria->compare('StoreSize', $this->StoreSize, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getServicelv($id) {
        return $id;
    }

}