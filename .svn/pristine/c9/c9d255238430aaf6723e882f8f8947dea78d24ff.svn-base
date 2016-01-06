<?php

/**
 * This is the model class for table "admin_user".
 *
 * The followings are the available columns in table 'admin_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class AdminUser extends JPDActiveRecord {

    public $verifyPassword;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return AdminUser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{admin_user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('UserName, PassWord, Email,verifyPassword', 'required'),
            array('UserName, PassWord, Email', 'length', 'max' => 128),
            array('PassWord', 'length', 'max'=>128, 'min' => 6,'message' =>'密码不能少于6个字符'),
            array('verifyPassword','compare', 'compareAttribute' => 'PassWord', 'message' => '确认密码必须一致'),
            array('Profile', 'safe'),
             array('UserName', 'uniquename','message'=>'会员名已经存在'),
              array('Email', 'match', 'pattern' => '/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i', 'message' => "邮箱格式不正确"),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, UserName, PassWord, Email,Profile,verifyPassword', 'safe', 'on' => 'search'),
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
            'UserName' => '用户名',
            'PassWord' => '密码',
            'Email' => '邮箱',
            'Profile' => '说明',
             'verifyPassword' => "确认密码"
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
        $criteria->compare('UserName', $this->UserName, true);
       $criteria->compare('PassWord', $this->PassWord, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('Profile', $this->Profile, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        if ($this->hashPassword($password) === $this->PassWord) {
            return true;
        } 
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password) {
        return md5($password);
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     *
     * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
     * requires, for the Blowfish hash algorithm, a salt string in a specific format:
     *  - "$2a$"
     *  - a two digit cost parameter
     *  - "$"
     *  - 22 characters from the alphabet "./0-9A-Za-z".
     *
     * @param int cost parameter for Blowfish hash algorithm
     * @return string the salt
     */
    protected function generateSalt($cost = 10) {
        if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
            throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
        }
        // Get some pseudo-random data from mt_rand().
        $rand = '';
        for ($i = 0; $i < 8; ++$i)
            $rand.=pack('S', mt_rand(0, 0xffff));
        // Add the microtime for a little more entropy.
        $rand.=microtime();
        // Mix the bits cryptographically.
        $rand = sha1($rand, true);
        // Form the prefix that specifies hash algorithm type and cost parameter.
        $salt = '$2a$' . str_pad((int) $cost, 2, '0', STR_PAD_RIGHT) . '$';
        // Append the random salt string in the required base64 format.
        $salt.=strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
        return $salt;
    }
        public function uniquename() {
        if (!$this->hasErrors('UserName')) {
            if ($_GET['id']) {
                $user = AdminUser::model()->find('UserName=:name and ID <> :id', array(':name' => $_POST['AdminUser']['UserName'], 'id' => $_GET['id']));
            } else {
             
                $user = AdminUser::model()->find('UserName=:name ', array(':name' => $_POST['AdminUser']['UserName']));
            }
            if ($user) {
                $this->addError('UserName', '该会员名已存在');
            }
        }
    }

}