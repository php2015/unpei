<?php

/**
 * UserRecoveryForm class.
 * UserRecoveryForm is the data structure for keeping
 * user recovery form data. It is used by the 'recovery' action of 'UserController'.
 */
class UserRecoveryForm extends CFormModel {

    public $login_or_email, $user_id, $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('login_or_email', 'required'),
            array('login_or_email', 'match', 'pattern' => '/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$|^[0-9a-zA-Z_\-]+$/i', 'message' => UserModule::t("用户名或邮箱格式不正确")),
            // password needs to be authenticated
            array('login_or_email', 'checkexists'),
            array('verifyCode', 'captcha', 'allowEmpty' => !UserModule::doCaptcha('login')),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'login_or_email' => UserModule::t("username or email"),
        );
    }

    public function checkexists($attribute, $params) {
        if (!$this->hasErrors()) {  // we only want to authenticate when no input errors
            if (strpos($this->login_or_email, "@")) {
                $organ = Organ::model()->findByAttributes(array('Email' => $this->login_or_email));
                if ($organ) {
                    $user = User::model()->findByAttributes(array('OrganID' => $organ->ID, 'IsMain' => '1'));
                    $this->user_id = $user->ID;
                }
            } else {
                $user = User::model()->findByAttributes(array('UserName' => $this->login_or_email));
                if ($user->IsMain == '0') {
                    //子账户
                    $this->addError("login_or_email", UserModule::t("请找主帐号管理员修改密码!"));
                } else
                    $this->user_id = $user->ID;
            }

            if ($user === null)
                if (strpos($this->login_or_email, "@")) {
                    $this->addError("login_or_email", UserModule::t("Email is incorrect."));
                } else {
                    $this->addError("login_or_email", UserModule::t("Username is incorrect."));
                }
        }
    }

}
