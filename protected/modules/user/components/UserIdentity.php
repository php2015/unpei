<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    const ERROR_EMAIL_INVALID = 3;
    const ERROR_STATUS_NOTACTIV = 4;
    const ERROR_STATUS_BAN = 5;
    const ERROR_FREEZE = 6;
    const ERROR_BLACK = 7;
    const ERROR_EXPIRATION = 8;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = User::model()->findByAttributes(array('UserName' => $this->username));
        //验证账户是否存在，存在则获取其机构ID
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $organ = Organ::model()->findByPk($user->OrganID);
            $employ = OrganEmployees::model()->findByPk($user->EmployeID);
            //判断密码是否错误
            if (Yii::app()->getModule('user')->encrypting($this->password) !== $user->PassWord)
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            //判断机构是否加入黑名单
            else if ($organ->IsBlack == 1)
                $this->errorCode = self::ERROR_BLACK;
            //判断机构是否被冻结
            else if ($organ->IsFreeze == 1)
                $this->errorCode = self::ERROR_FREEZE;
            //判断机构是否失效
            else if ($organ->ExpirationTime && time() > $organ->ExpirationTime)
                $this->errorCode = self::ERROR_EXPIRATION;
            //判断子账户是否失效
            else if ($employ && $employ->ExpireTime && time() > $employ->ExpireTime)
                $this->errorCode = self::ERROR_EXPIRATION;
            else {
                $this->_id = $user->ID;
                $this->username = $user->UserName;
                $this->errorCode = self::ERROR_NONE;
            }
        }

        return !$this->errorCode;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

}