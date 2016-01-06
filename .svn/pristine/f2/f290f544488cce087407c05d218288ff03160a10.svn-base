<?php

class InfomanagerController extends Controller {

    //public $layout = '//layouts/member';

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
            // 'testLimit' => 1, //验证码失效次数,默认是3次
            //'transparent'=>true,  //显示为透明
            //'fixedVerifyCode'=>'' //固定的验证码,自动测试中想每次返回 相同的验证码值时会用到
            ),
        );
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'infomanager-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionIndex() {
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'update') {
            $display = 'none';
        }
        //查看我的会员信息
        $userID = Yii::app()->user->id;
        $model = User::model()->with('organ')->findByPk($userID);
        $identity = $model['organ']['Identity'];
        $lastvisittime = Yii::app()->user->getLastVisitTime();
        if (!$lastvisittime) {
            $lastvisittime = time() - 60 * 60 * 24 - 54321;
        }
        $this->render('index', array(
            'model' => $model,
            //'userInfo' => $userInfo,
            'identity' => $identity,
            'display' => $display,
            'lasttime' => $lastvisittime
        ));
    }

    public function actionApplycert() {
        //申请机构认证
        $this->render('applycert');
    }

    public function actionUpdate() {
        $organID = Yii::app()->user->OrganID;
        //organ表单验证
        $model = Organ::model()->findByPK($organID);
        $this->performAjaxValidation($model);
        $userpost = Yii::app()->request->getParam('User');
        $user = User::model()->findByPK(Yii::app()->user->id);

        $organ = Yii::app()->request->getParam('Organ');
        $model->attributes = $organ;
        if ($model->save()) {
            //更新登陆时保存的session信息
            Yii::app()->user->updateSession();
            $this->redirect(array('index'));
        }
    }

    /*
     * 编辑LOGO
     */

    public function actionEditlogo() {
        $organID = Yii::app()->user->OrganID;
        //organ表单验证
        $model = Organ::model()->findByPK($organID);
        if ($model->Logo) {
            //删除
            $ftp = new Ftp();
            $res = $ftp->delete_file($model->Logo);
            $ftp->close();
        }
        //获得一个CUploadedFile的实例  

        $file = CUploadedFile::getInstanceByName('Logo');
        $rs = array('code' => 100, 'msg' => '上传失败！' . $ImgName . '已经上传');

        $upload = Yii::app()->params['uploadPath'] . 'tmp/logo/' . $organID . '/';
        $path = Yii::app()->params['uploadPath'] . 'tmp/';
        if (!is_dir($upload)) {
            mkdir($upload, 0777, true) or die('创建失败');
            chmod($upload, 0777);
        }
        // 判断实例化是否成功  
        if (is_object($file) && get_class($file) === 'CUploadedFile') {
            $model->Logo = 'logo/' . $organID . '/' . 'file_' . date("YmdHis") . '_' . rand(1000, 9999) . '.' . $file->extensionName;   //定义文件保存的名称  
        }/* else{  // 若果失败则应该是什么图片  
          $model->url = './assets/upfile/noPic.jpg';
          } */
        if ($model->save()) {
            $file->saveAs($path . $model->Logo, true);
            $ftp = new Ftp();
            $res = $ftp->uploadfile($path . $model->Logo, $model->Logo);
            $ftp->close();
            @unlink($path . $model->Logo);
        }
        $this->redirect(array('index'));
    }

    /*
     * 修改密码后提示重新登录页面
     */

    public function actionPrompt() {
        $this->render('prompt');
    }

    /**
     * 修改机构信息
     */
    private function updateOrgan($mobphone, $qq, $email) {
        $userID = Yii::app()->user->id;
        $usertype = User::model()->find('id=' . $userID);  // 获取会员的类型
        if ($usertype['identity'] == 1) {   // 生产商
            $bool = MakeOrgan::model()->updateByPk($userID, array(
                'mobile_phone' => $mobphone,
//                'email' => $email,
                'qq' => $qq,
            ));
        } elseif ($usertype['identity'] == 2) { // 经销商
            $bool = Dealer::model()->updateAll(array(
                'Phone' => $mobphone,
//                'Email' => $email,
                'QQ' => $qq,
                    ), 'userID=:userID', array(':userID' => $userID));
        } elseif ($usertype['identity'] == 3) { // 修理厂
            $bool = Service::model()->updateByPk($userID, array(
                'serviceCellPhone' => $mobphone,
//                'serviceEmail' => $email,
                'serviceQQ' => $qq,
            ));
        } else {
            //用户不存在
            $bool = false;
        }
        return $bool;
    }

    //验证验证码
    public function actionCheckcode() {
        $codetxt = Yii::app()->request->getParam('code');
        $code = $this->createAction('captcha')->getVerifyCode(false);
        if (trim($codetxt) == $code) {
            echo json_encode(array('msg' => 'code success', 'success' => 1));
        } else {
            echo json_encode(array('msg' => 'code fail', 'success' => 2));
        }
    }

    //帐号管理-修改密码
    public function actionPassword() {
        $this->render('password');
    }

    //密码修改验证
    public function actionUpdatepasseord() {
        if (Yii::app()->request->isAjaxRequest) {
            $userid = Yii::app()->user->id;
            $user = User::model()->findByPk($userid);
            $old = Yii::app()->request->getParam('old');
            $newly = Yii::app()->request->getParam('newly');
            if ($user->encrypting($old) != $user->PassWord) {
                echo json_encode(array('res' => 0, 'msg' => '原密码错误'));
                exit;
            } else {
                $user->PassWord = $user->encrypting($newly);
                $user->ActiveKey = $user->encrypting(microtime() . $newly);
                $user->verifyPassword = $user->PassWord;
                if ($user->save()) { {
                        Yii::app()->user->logout();
                        $this->redirect(array('index'));
                    }
                } else {
                    echo json_encode(array('res' => 0, 'msg' => '修改失败'));
                    exit;
                }
            }
        }
    }

}
