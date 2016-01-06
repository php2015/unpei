<?php

class ActivationController extends Controller {

    public $defaultAction = 'activation';

    public function filters() {
        return array(
        );
    }

    public function actionIndex() {
        $this->pageTitle=Yii::app()->name.'-账号激活';
        $this->layout = '//layouts/login';
        if(Yii::app()->user->isGuest){
            $this->redirect(array('/user/login'));
        }
        $organID=Yii::app()->user->getOrganID();
        $organ=Organ::model()->findByPk($organID);
        if($organ->Status==1){
            if(Yii::app()->user->isServicer()){
                $this->redirect(array('/pap/home/index'));
            }else if(Yii::app()->user->isDealer()){
                  $this->redirect(array('/pap/sellerorder/index'));
            }
        }else if($organ->Status==2){
            $this->redirect(array('/user/activecompany/index'));
        }
        $model = new User('active');
        $model->agreement=1;
        $this->performAjaxValidation($model);
        if($_POST['User']){
            $userid=Yii::app()->user->id;
            $organID=Yii::app()->user->getOrganID();
            $user=$model->findByPk($userid);
            if($user->PassWord===md5(trim($_POST['User']['PassWord']))){
              $newpassword=trim($_POST['User']['NewPassword']);
              $model->PassWord=md5($newpassword);
              $pass=User::model()->updateByPk($userid,array('PassWord'=> $model->PassWord));
              //$organ=Organ::model()->updateByPk($organID,array('Status'=>'2'));
              $res=Yii::app()->jpdb->createCommand()->update('jpd_organ',array('Status'=>'2'),'ID='.$organID);
              $this->redirect(array('/user/activecompany/index'));
            }else{
                $this->redirect(array('/user/activation/index'));
            }
        }
        $this->render('index', array('model' => $model));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'active-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    /**
     * Activation user account
     */
    public function actionActivation() {
        $email = $_GET['email'];
        $activkey = $_GET['activkey'];
        if ($email && $activkey) {
            $find = User::model()->notsafe()->findByAttributes(array('email' => $email));
            if (isset($find) && $find->status) {
                $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("You account is active.")));
            } elseif (isset($find->activkey) && ($find->activkey == $activkey)) {
                $find->activkey = UserModule::encrypting(microtime());
                $find->status = 1;
                $find->save();
                $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("You account is activated.")));
            } else {
                $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("Incorrect activation URL.")));
            }
        } else {
            $this->render('/user/message', array('title' => UserModule::t("User activation"), 'content' => UserModule::t("Incorrect activation URL.")));
        }
    }
    /*
     * 第三步完善子账户权限管理
     */
    public function actionFinish(){
        $this->layout = '//layouts/login';
        $this->pageTitle=Yii::app()->name.'-员工及权限信息完善';
        $this->render('finish');
    }
}
