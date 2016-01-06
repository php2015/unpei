<?php

class RegistrationController extends Controller {

    public $defaultAction = 'registration';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'foreColor' => 0xdd7a36,
                'backColor' => 0xfbfbfb, //背景颜色
                'minLength' => 4, //最短为4位
                'maxLength' => 4, //是长为4位
                'width' => 70, //图片宽度
                'height' => 30, //图片高度
                'offset' => 2, //字符间偏移量。默认是-2
                'padding' => 2, //文字周边填充大小。默认为2
            //'testLimit' => 1,   	//验证码失效次数,默认是3次
            ),
        );
    }

    public function filters() {
        return array(
        );
    }

    /**
     * Registration user
     */
    public function actionRegistration() {
        $this->redirect(Yii::app()->controller->module->returnUrl);
        Profile::$regMode = true;
        $model = new RegistrationForm;
        $profile = new Profile;

        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            echo UActiveForm::validate(array($model, $profile));
            Yii::app()->end();
        }

        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->profileUrl);
        } else {
            if (isset($_POST['RegistrationForm'])) {
                $RegistrationForm = $_POST['RegistrationForm'];
                $model->attributes = $RegistrationForm;
                $profile->attributes = ((isset($_POST['Profile']) ? $_POST['Profile'] : array()));
                if ($model->validate() && $profile->validate()) {
                    $soucePassword = $model->password;
                    $model->activkey = UserModule::encrypting(microtime() . $model->password);
                    $model->password = UserModule::encrypting($model->password);
                    $model->verifyPassword = UserModule::encrypting($model->verifyPassword);
                    $model->superuser = 0;
                    $model->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);
                    $model->create_at = date('Y-m-d H:i:s');
                    //添加推荐人ID
                    $model->recommend = ($RegistrationForm['recommend'] != "用户名/手机号") ? $RegistrationForm['recommend'] : "";
                    if ($RegistrationForm['recommend'] && $RegistrationForm['recommend'] != "用户名/手机号") {
                        $recommend = $RegistrationForm['recommend'];
                        if (is_numeric($recommend)) {
                            $recomID = $this->getRecommendByPhone($recommend);
                        } else {
                            $recomID = $this->getRecommendByName($recommend);
                        }
                        $model->recomID = $recomID;
                    }
                    if ($model->save()) {
                        $profile->user_id = $model->id;
                        $profile->save();
                        if (Yii::app()->controller->module->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $model->activkey, "email" => $model->email));
                            //UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
                        }

                        if ((Yii::app()->controller->module->loginNotActiv || (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false)) && Yii::app()->controller->module->autoLogin) {
                            $identity = new UserIdentity($model->username, $soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity, 0);
                            $this->redirect(Yii::app()->controller->module->returnUrl);
                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please {{login}}.", array('{{login}}' => CHtml::link(UserModule::t('Login'), Yii::app()->controller->module->loginUrl))));
                            } elseif (Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                } else
                    $profile->validate();
            }
            $this->render('/user/registration', array('model' => $model, 'profile' => $profile));
        }
    }

    public function actionDynamiccities() {
        $Profile_state = !empty($_GET['Profile_state']) ? $$_GET['Profile_state'] : $_POST['Profile_state'];
        if ($Profile_state) {
            $data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $Profile_state));

            $data = CHtml::listData($data, "id", "name");
            //echo CHtml::tag("option", array("value" => ''), '', true);
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionDynamicdistrict() {
        $Profile_city = !empty($_GET['Profile_city']) ? $$_GET['Profile_city'] : $_POST['Profile_city'];
        if ($Profile_city) {
            $data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $Profile_city));

            $data = CHtml::listData($data, "id", "name");
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    /*
     * 通过推荐人用户名获取推荐人ID
     */

    public static function getRecommendByName($recommend) {
        $model = User::model()->find("username=:name", array(":name" => $recommend))->attributes['id'];
        return $model;
    }

    /*
     * 通过推荐人手机号获取推荐人ID
     */

    public static function getRecommendByPhone($recommend) {
        $model = Dealer::model()->find("Phone=:phone", array(":phone" => $recommend))->attributes['userID'];
        if (empty($model)) {
            unset($model);
            $model = Service::model()->find("serviceCellPhone=:cellphone", array(":cellphone" => $recommend))->attributes['userId'];
        }
        return $model;
    }

    /*
     * 通过推荐人用户名或者手机号获取推荐人ID
     */

    public function actionCheckrecommend() {
        if ($_POST['recommend']) {
            $recommend = $_POST['recommend'];
            if (is_numeric($recommend)) {
                $model = $this->getRecommendByPhone($recommend);
                if (empty($model)) {
                    $result = "推荐人手机号不存在，请确认！";
                }
            } else {
                $model = $this->getRecommendByName($recommend);
                if (empty($model)) {
                    $result = "推荐人用户名不存在，请确认！";
                }
            }
            echo json_encode($result);
        }
    }

}