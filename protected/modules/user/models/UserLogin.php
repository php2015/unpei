<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserLogin extends CFormModel {

    public $username;
    public $password;
    public $verifyCode;
    public $rememberMe;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // Verification Code needs to be authenticated
            // array('verifyCode', 'captcha', 'allowEmpty' => !UserModule::doCaptcha('login')),
            array('verifyCode', 'captcha', 'allowEmpty' => $this->checkVerifyCode()),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe' => UserModule::t("Remember me next time"),
            'username' => UserModule::t("username or email"),
            'password' => UserModule::t("password"),
            'verifyCode' => UserModule::t("verifyCode"),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {  // we only want to authenticate when no input errors
            $identity = new UserIdentity($this->username, $this->password);
            $identity->authenticate();
            switch ($identity->errorCode) {
                case UserIdentity::ERROR_NONE:
                    $duration = $this->rememberMe ? Yii::app()->controller->module->rememberMeTime : 3600;
                    Yii::app()->user->login($identity, $duration);
                    break;
                case UserIdentity::ERROR_EMAIL_INVALID:
                    $this->addError("username", UserModule::t("Email is incorrect."));
                    break;
                case UserIdentity::ERROR_USERNAME_INVALID:
                    $this->addError("username", UserModule::t("该账号不存在"));
                    break;
                case UserIdentity::ERROR_STATUS_NOTACTIV:
                    $this->addError("status", UserModule::t("You account is not activated."));
                    break;
                case UserIdentity::ERROR_STATUS_BAN:
                    $this->addError("status", UserModule::t("You account is blocked."));
                    break;
                case UserIdentity::ERROR_PASSWORD_INVALID:
                    $this->addError("password", UserModule::t("Password is incorrect."));
                    break;
                case UserIdentity::ERROR_FREEZE:
                    $this->addError("username", UserModule::t("对不起,您的账号已被冻结,请联系管理员"));
                    break;
                case UserIdentity::ERROR_BLACK:
                    $this->addError("username", UserModule::t("对不起,您的账号已被列入黑名单,请联系管理员"));
                    break;
                case UserIdentity::ERROR_EXPIRATION:
                    $this->addError("username", UserModule::t("对不起,您的账号已过期,请联系管理员"));
                    break;
            }
        }
    }

    //验证登陆帐号是否过期
    public function expiration() {
        if (!$this->hasErrors('username')) {
//    		$user=User::model()->find('username=:name and id <> :id',array(':name'=>$this->username,'id'=>$this->id));
            $result = Profile::model()->findByPk($this->id);
            if ($result) {
                if ($result['ExpirationDate']) {
                    $this->addError('username', '该帐号已过期');
                }
            }
        }
    }

    public function checkVerifyCode() {

        if (isset($_POST['UserLogin'])) {
            $error_msg = '验证码输入不正确.';
            $loginErrorTimes = intval(Yii::app()->session['login_error_times']);
            if ($loginErrorTimes > 0) {
                $loginErrorTimes++;
            } else {
                $loginErrorTimes = 1;
            }

            Yii::app()->session['login_error_times'] = $loginErrorTimes;
            if ($loginErrorTimes > 3) {
                $verifyCode = trim($this->verifyCode);
                $captcha = Yii::app()->controller->createAction('captcha')->getVerifyCode();
                if (strtolower($captcha) == strtolower($verifyCode)) {
                    return true;
                } else {
                    $this->addError('verifyCode', $error_msg);
                    return false;
                }
            }
        }
        return true;
    }

}
