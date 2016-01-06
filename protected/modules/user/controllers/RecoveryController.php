<?php

class RecoveryController extends Controller {

    public $defaultAction = 'recovery';
    public $layout='//layouts/login';

    public function filters() {
        return array(
        );
    }

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
                'testLimit' => 1, //验证码失效次数,默认是3次
            //'transparent'=>true,  //显示为透明
            //'fixedVerifyCode'=>'' //固定的验证码,自动测试中想每次返回 相同的验证码值时会用到
            ),
        );
    }

    /**
     * Recovery password
     */
    public function actionRecovery() {
        $form = new UserRecoveryForm;
        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->returnUrl);
        } else {
            $email = ((isset($_GET['email'])) ? $_GET['email'] : '');
            $activkey = ((isset($_GET['activkey'])) ? $_GET['activkey'] : '');
            if ($email && $activkey) {
                $form2 = new UserChangePassword;
                $organ = Organ::model()->findByAttributes(array('Email' => $email));
                $find = User::model()->findByAttributes(array('OrganID' => $organ->ID, 'IsMain' => '1'));
                if (isset($find) && $find->ActiveKey == $activkey) {
                    if (isset($_POST['UserChangePassword'])) {
                        $form2->attributes = $_POST['UserChangePassword'];
                        if ($form2->validate()) {
                            $find->PassWord = Yii::app()->controller->module->encrypting($form2->password);
                            $find->ActiveKey = Yii::app()->controller->module->encrypting(microtime() . $form2->password);
                            User::model()->updateByPk($find->ID, array('PassWord' => $find->PassWord, 'ActiveKey' => $find->ActiveKey));
                            Yii::app()->user->setFlash('recoveryMessage', UserModule::t("New password is saved."));
                            $this->redirect(array('recovery/finish'));
                        }
                    }
                    $this->render('changepassword', array('form' => $form2));
                } else {
                    Yii::app()->user->setFlash('recoveryMessage', UserModule::t("Incorrect recovery link."));
                    $this->redirect(Yii::app()->controller->module->recoveryUrl);
                }
            } else {
                if (isset($_POST['UserRecoveryForm'])) {
                    $status = 2;
                    $form->attributes = $_POST['UserRecoveryForm'];
                    if ($form->validate()) {
                        $user = User::model()->findByPk($form->user_id);
                        //激活码
                        if ($user->ActiveKey == null) {
                            $user->ActiveKey = $user->encrypting(microtime() . $user->PassWord);
                            $user->verifyPassword=$user->PassWord;
                            $user->save();
                        }
                        //获取邮箱
                        $organinfo = Organ::model()->findByPk($user->OrganID);
                        $activation_url = 'http://' . $_SERVER['HTTP_HOST'] . $this->createUrl(implode(Yii::app()->controller->module->recoveryUrl), array("activkey" => $user->ActiveKey, "email" => $organinfo->Email));
                        $subject = UserModule::t("找回 {site_name}密码", array(
                                    '{site_name}' => Yii::app()->name,
                                ));
                        $message = UserModule::t("You have requested the password recovery site {site_name}. To receive a new password, go to {activation_url}.", array(
                                    '{site_name}' => Yii::app()->name,
                                    '{activation_url}' => $activation_url . ' ',
                                ));

                        $res = UserModule::sendMail($organinfo->Email, $subject, $message);
                        if ($res == 'ok')
                            Yii::app()->user->setFlash('recoveryMessage',UserModule::t("Please check your email. An instructions was sent to your email address."));
                        else {
                            $this->render('recovery', array('form' => $form, 'emailError' => $res));
                            exit;
                        }
                        $this->refresh();
                    }
                }
                $this->render('recovery', array('form' => $form));
            }
        }
    }

    public function actionFinish() {
        if (Yii::app()->user->hasFlash('recoveryMessage')) {
            $this->render('finish');
        } else {
            $this->redirect(array('recovery/recovery'));
        }
    }

}