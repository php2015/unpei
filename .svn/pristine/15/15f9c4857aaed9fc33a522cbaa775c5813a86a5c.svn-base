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
 * @property string $Logo
 * @property integer $Sort
 * @property string $TelPhone
 * @property string $Registration
 * @property string $BLPoto
 *
 * The followings are the available model relations:
 * @property Dealer[] $dealers
 * @property DealerVehicles[] $dealerVehicles
 * @property OrganCpname[] $organCpnames
 * @property OrganDepartment[] $organDepartments
 * @property OrganEmployees[] $organEmployees
 * @property OrganPhoto[] $organPhotos
 * @property OrganRoleEmployees[] $organRoleEmployees
 * @property OrganRoles[] $organRoles
 * @property Service[] $services
 * @property ServiceCar[] $serviceCars
 * @property ServiceCarOwner[] $serviceCarOwners
 */
class Organ extends JPDActiveRecord {

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $UserName;
    public $AllAddress;
    public $verifyCode;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return Yii::app()->getModule('user')->tableOrgan;
        //return '{{organ}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Province,City', 'required'),
            array('Identity, RecomID, CreateTime, LastVisitTime, FoundDate', 'numerical', 'integerOnly' => true),
            array('OrganName, Email, TelPhone', 'length', 'max' => 128),
            array('Phone, Recommend, StoreSize, Registration', 'length', 'max' => 20),
            array('Type', 'length', 'max' => 12),
            array('IsAuth, IsBlack, IsFreeze, Status', 'length', 'max' => 1),
            array('Province, City, Area, Address', 'length', 'max' => 50),
            array('QQ', 'length', 'max' => 12),
            array('Fax', 'length', 'max' => 15),
            array('Introduction, Logo', 'length', 'max' => 255),
            array('BLPoto', 'length', 'max' => 250),
            array('Phone', 'required', 'message' => "手机号码不能为空"),
            //array('Phone', 'uniquephone', 'message' => "该手机号已经存在"),
            array('Phone', 'match', 'pattern'=>'/^1[3|4|5|8][0-9]\d{4,8}$/', 'message' => "请输入正确的手机号码"),
            array('Registration', 'match', 'pattern'=>'/^\d{12,18}$/', 'message' => "请输入正确的注册号"),
            array('QQ', 'match', 'pattern'=>'/^\d{5,12}$/', 'message' => "请输入正确的QQ号"),
            //array('QQ', 'unique', 'message' => "该QQ号已被使用"),
            array('Fax', 'match', 'pattern'=>'/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/', 'message' => "请输入正确的传真号"),
            //上传
            array('Logo',
                'file', //定义为file类型  
                'allowEmpty' => true,
                'types' => 'jpg,png,gif,bmp,jpeg', //上传文件的类型  
                'maxSize' => 1024 * 1024 * 2, //上传大小限制，注意不是php.ini中的上传文件大小  
                'tooLarge' => 'LOGO大于2M，上传失败！请上传小于2M的LOGO！'
            ),
            //验证
            //array('Email', 'unique', 'message' => "该邮箱已被使用"),
            array('Email', 'required', 'message' => "邮箱地址不能为空"),
            array('Email', 'match', 'pattern'=>'/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/', 'message' => "请输入正确的邮箱地址"),
            array('OrganName', 'unique', 'message' => "该机构已存在"),
            array('OrganName', 'required', 'message' => "机构名称不能为空"),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, OrganName, Phone, Email, Identity, Recommend, RecomID, Type, IsAuth, IsBlack, IsFreeze, Status, CreateTime, ExpirationTime, LastVisitTime, Province, City, Area, Address, QQ, Fax, FoundDate, Introduction, StoreSize, Logo, Sort, TelPhone, Registration, BLPoto', 'safe', 'on' => 'search'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'infomanager-form'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::HAS_ONE, 'User', '', 'on' => 't.ID=user.OrganID'),
            'maker' => array(self::HAS_ONE, 'Make', '', 'on' => 't.ID=maker.OrganID'),
            'dealer' => array(self::HAS_ONE, 'Dealer', '', 'on' => 't.ID=dealer.OrganID'),
            'service' => array(self::HAS_ONE, 'Service', '', 'on' => 't.ID=service.OrganID'),
            'dealers' => array(self::HAS_MANY, 'Dealer', 'OrganID'),
            'dealerVehicles' => array(self::HAS_MANY, 'DealerVehicles', 'OrganID'),
            'organCpnames' => array(self::HAS_MANY, 'OrganCpname', 'OrganID'),
            'organDepartments' => array(self::HAS_MANY, 'OrganDepartment', 'OrganID'),
            'organEmployees' => array(self::HAS_MANY, 'OrganEmployees', 'OrganID'),
            'organPhotos' => array(self::HAS_MANY, 'OrganPhoto', 'OrganID'),
            'organRoleEmployees' => array(self::HAS_MANY, 'OrganRoleEmployees', 'OrganID'),
            'organRoles' => array(self::HAS_MANY, 'OrganRoles', 'OrganID'),
            'services' => array(self::HAS_MANY, 'Service', 'OrganID'),
            'serviceCars' => array(self::HAS_MANY, 'ServiceCar', 'OrganID'),
            'serviceCarOwners' => array(self::HAS_MANY, 'ServiceCarOwner', 'OrganID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'OrganName' => '机构名称',
            'Phone' => '手机号',
            'Email' => '邮箱',
            'Identity' => '机构类型',
            'Recommend' => '推荐人',
            'RecomID' => '推荐人',
            'Type' => '会员类型',
            'IsAuth' => '认证',
            'IsBlack' => '黑名单',
            'IsFreeze' => '冻结',
            'Status' => '是否激活',
            'CreateTime' => '创建时间',
            'Province' => '省',
            'City' => '市',
            'Area' => '区',
            'Address' => '街道',
            'QQ' => 'QQ',
            'Fax' => '传真',
            'FoundDate' => '成立年份',
            'Introduction' => '机构简介',
            'StoreSize' => '店铺面积',
            'UserName' => '用户名',
            'AllAddress' => '详细地址',
            'Registration' => '注册号',
            'BLPoto' => '营业执照图片地址',
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
        $criteria->compare('Logo', $this->Logo, true);
        $criteria->compare('Sort', $this->Sort);
        $criteria->compare('TelPhone', $this->TelPhone, true);
        $criteria->compare('Registration', $this->Registration, true);
        $criteria->compare('BLPoto', $this->BLPoto, true);
        $criteria->with = 'user';
        $criteria->addCondition("user.OrganID=t.ID");
        $criteria->addCondition("IsBlack<>1");
        $criteria->compare('user.UserName', $_GET['Organ']['UserName'], 'AND');
        $criteria->order = 'CreateTime DESC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function black() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('ID', $this->ID);
        $criteria->compare('Email', $this->Email, true);

        //$criteria->compare('activkey', $this->activkey);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Type', $this->Type, true);
        $criteria->compare('Phone', $this->Phone, true);
        $criteria->compare('Identity', $this->Identity, true);
        $criteria->compare('IsFreeze', $this->IsFreeze, true);

        $criteria->with = 'user';
        //$criteria->addCondition("profile.Status=0");
        $criteria->addCondition('IsBlack=1');
        $criteria->compare('user.UserName', $_GET['Organ']['UserName'], 'AND');

        $criteria->order = 'CreateTime DESC';

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->getModule('user')->user_page_size,
            ),
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
     * @return Organ the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'UserStatus' => array(
                '0' => '未激活',
                '1' => '已激活',
            //self::STATUS_BANNED => 'Banned'),
            ),
            'AdminStatus' => array(
                '0' => '否',
                '1' => '是',
            ),
            'IsBlack' => array(
                '0' => '否',
                '1' => '是',
            ),
            'Identity' => array(
                '1' => '生产商',
                '2' => '经销商',
                '3' => '修理厂',
            ),
            'usertype' => array(
                '非会员' => '非会员',
                '试用会员' => '试用会员',
                '正式会员' => '正式会员',
            ),
            'freeze' => array(
                '0' => '未冻结',
                '1' => '已冻结',
            )
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    //验证手机号唯一性
    public function uniquephone() {
        $OrganID = Yii::app()->user->getOrganID();
        if (!$this->hasErrors('Phone')) {
            if ($_GET['id']) {
                $organ = User::model()->findByPk($_GET['id']);
                $organsID = $organ['OrganID'];
                $organ = Organ::model()->findAll('Phone=:phone and ID <>:id', array(':phone' => $_POST['Organ']['Phone'], ':id' => $organsID));
            } else if ($OrganID) {
                $organ = Organ::model()->findAll('Phone=:phone and ID <>:id', array(':phone' => $_POST['Organ']['Phone'], ':id' => $OrganID));
            } else {
                $organ = Organ::model()->findAll('Phone=:phone', array(':phone' => $_POST['Organ']['Phone']));
            }

            if ($organ && count($organ) > 0) {
                $this->addError('Phone', '该手机号已存在');
            }
        }
    }

}
