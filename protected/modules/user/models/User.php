<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $ID
 * @property string $UserName
 * @property string $PassWord
 * @property string $IsMain
 * @property integer $OrganID
 * @property integer $EmployeID
 */
class User extends JPDActiveRecord {

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $verifyPassword;
    public $verifynewPassword;
    public $NewPassword;
    public $agreement;
    //添加属性用于搜索
    public $OrganName;
    public $RecomID;
    public $Recommend;
    public $Identity;
    public $Type;
    public $Email;
    public $Phone;
    public $IsFreeze;
    public $Status;
 
   
        
        

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('UserName,PassWord', 'required'),
            array('NewPassword,verifynewPassword','required','on'=>'active'),
            array('PassWord','getoldpassword','message'=>'原始密码错误','on'=>'active'),
           // array('agreement','required','message'=>'您还未接受由你配会员协议','on'=>'active'),
             array('NewPassword', 'length', 'max' => 128, 'min' => 4, 'message' => "Incorrect password (minimal length 4 symbols).",'on'=>'active'),
            array('verifynewPassword', 'compare', 'compareAttribute' => 'NewPassword', 'message' => '确认新密码必须一致','on'=>'active'),
            array('UserName', 'unique'),
            array('ID, OrganID, EmployeID', 'numerical', 'integerOnly' => true),
            array('UserName, PassWord', 'length', 'max' =>50),
            array('PassWord', 'length', 'max' => 128, 'min' => 4, 'message' => "Incorrect password (minimal length 4 symbols)."),
            array('verifyPassword', 'compare', 'compareAttribute' => 'PassWord', 'message' => '确认密码必须一致'),
            array('IsMain', 'length', 'max' => 1),
            array('ActiveKey', 'length', 'max'=>64),
            array('UserName', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => "Incorrect symbols (A-z0-9)."),
            array('UserName', 'length', 'max' => 20, 'min' => 3, 'message' => "Incorrect username (length between 3 and 20 characters)."),
            array('UserName', 'uniquename', 'message' => "This user's name already exists."),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, UserName, PassWord, IsMain, OrganID, EmployeID,verifyPassword', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'organ' => array(self::HAS_ONE, 'Organ', '', 'on' => 't.OrganID = organ.ID'),
            'employ'=>array(self::HAS_ONE,'JpdOrganEmployees','','on'=>'t.EmployeID=employ.ID')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'UserName' => '用户名',
            'PassWord' => '密码',
            'IsMain' => 'Is Main',
            'OrganID' => 'Organ',
            'EmployeID' => 'Employe',
            'verifyPassword' => "Retype Password",
            'ActiveKey' => 'Active Key',
            //搜索属性名称
            'OrganName'=>'机构名称',
            'Recommend'=>'推荐人',
            'Type'=>'会员类型',
            'Identity'=>'机构类型',
            'Email'=>'邮箱',
            'Phone'=>'手机号',
            'IsFreeze'=>'是否冻结',
             'Status'=>'是否激活',
            'NewPassword'=>'新密码',
            'verifynewPassword'=>'确认新密码'
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
        $criteria->compare('UserName', $this->UserName, true);
        $criteria->compare('PassWord', $this->PassWord, true);
//        $criteria->compare('IsMain', $this->IsMain, true);
        $criteria->compare('OrganID', $this->OrganID); 
        $criteria->compare('EmployeID', $this->EmployeID);
        //添加搜索条件
        $criteria->compare('OrganName',$_GET['User']['OrganName'],'AND');
        $criteria->compare('Identity',$_GET['User']['Identity'],'AND');
        $criteria->compare('Type',$_GET['User']['Type'],'AND');
        $criteria->compare('Phone',$_GET['User']['Phone'],'AND');
        $criteria->compare('Email',$_GET['User']['Email'],'AND');
        $criteria->compare('IsFreeze',$_GET['User']['IsFreeze'],'AND');
        $criteria->compare('Status',$_GET['User']['Status'],'AND');
        $criteria->addCondition("IsMain='1'");
        $criteria->addCondition("organ.IsBlack<>1");
        $criteria->with='organ';
        $criteria->order='organ.CreateTime DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    //加密
    public static function encrypting($string = "") {
        $hash = Yii::app()->getModule('user')->hash;
        if ($hash == "md5")
            return md5($string);
        if ($hash == "sha1")
            return sha1($string);
        else
            return hash($hash, $string);
    }

    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'Status=' . self::STATUS_ACTIVE,
            ),
            'notactive' => array(
                'condition' => 'Status=' . self::STATUS_NOACTIVE,
            ),
//            'banned' => array(
//                'condition' => 'status=' . self::STATUS_BANNED,
//            ),
            'all' => array(
                'select' => 'ID,UserName,PassWord,IsMain,OrganID,EmployeID',
            ),
        );
    }

    //验证用户唯一性
    public function uniquename() {
        if (!$this->hasErrors('UserName')) {
            if ($_GET['id']) {
                $user = User::model()->find('UserName=:name and ID <> :id', array(':name' => $_POST['User']['UserName'], 'id' => $_GET['id']));
            } else {
                $user = User::model()->find('UserName=:name ', array(':name' => $_POST['User']['UserName']));
            }
            if ($user) {
                $this->addError('UserName', '该会员名已存在');
            }
        }
    }
    public function getoldpassword(){
        $userid=Yii::app()->user->id;
        if(!$this->hasErrors('PassWord')){
            $user=User::model()->findByPk($userid);
            if($user->PassWord!=md5($this->PassWord)){
                $this->addError('PassWord','原始密码错误');
            }
        }
    }

}
