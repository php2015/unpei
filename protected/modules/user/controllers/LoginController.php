<?php

class LoginController extends Controller {

    public $defaultAction = 'login';

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
                'testLimit' => 3, //验证码失效次数,默认是3次
            //'transparent'=>true,  //显示为透明
//            'fixedVerifyCode'=>'1234' //固定的验证码,自动测试中想每次返回 相同的验证码值时会用到
            ),
        );
    }

    public function filters() {
        return array(
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = '//layouts/login';
        if (Yii::app()->user->isGuest) {
            $model = new UserLogin;
            if (isset($_POST['UserLogin'])) {
                $model->attributes = $_POST['UserLogin'];
                $model->username = trim($model->username);
                $model->password = trim($model->password);
                $model->verifyCode = trim($model->verifyCode);
                if ($model->validate()) {
                    Yii::app()->session['login_error_times'] = 0;
                    //记录登录时间
                    $this->getlogintime();
                    //用户登录验证
                    $this->getlogin();
                    $organID=Yii::app()->user->getOrganID();
                    if (Yii::app()->user->isMaker()) {
                        $this->redirect(array('/maker'));
                    } else if (Yii::app()->user->isDealer()) {
                        //判断经销商账号是否激活
                        $statu=$this->getActive($organID);
                        if($statu==0){
                               $this->redirect(array('/user/agreement/agreement'));
                         // $this->redirect(array('/user/activation/index'));
                        }elseif ($statu==2) {
                             $this->redirect(array('/user/activecompany/index'));
                        }
                        else{
                        $this->redirect(array('/pap/sellerorder/index'));
                        }
                    } else if (Yii::app()->user->isServicer()) {
                        //判断修理厂账号是否激活
                        $statu=$this->getActive($organID);
                        if($statu==0){
                            $this->redirect(array('/user/agreement/agreement'));
                           // $this->redirect(array('/user/activation/index'));
                        }else if($statu==2){
                             $this->redirect(array('/user/activecompany/index'));
                        }
                        else{
                        $this->redirect(array('/pap/home/index'));
                        }
                    } else {
                        $this->redirect(Yii::app()->controller->module->returnUrl);
                    }
                }
            }
            $this->render('/user/newlogin', array('model' => $model));
        } else {
            //$this->getlogin();
            $this->redirect(Yii::app()->controller->module->returnUrl);
        }
    }
    private function getActive($organID){
       $organ=Organ::model()->findByPk($organID);
       return $organ->Status;
    }
    private function setLastViset() {
        $model = User::model()->all()->findByPk(Yii::app()->user->id);
        $model->LastVisitTime = time();
        $model->save();
    }

    public function actionLnk() {
        $fileurl = dirname(Yii::app()->BasePath) . '/themes/default/images/lnk/unipeilnk.url';
        $filename = '由你配.url';
        if ($fileurl) {
            $file = $fileurl;
            if (is_file($file)) {
                $ua = $_SERVER["HTTP_USER_AGENT"];
                $encoded_filename = urlencode($filename);
                $encoded_filename = str_replace("+", "%20", $encoded_filename);
                header('Content-Type: application/octet-stream');
                if (preg_match("/MSIE/", $ua) || preg_match("/Trident\/7.0/", $ua)) {
                    header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
                } else if (preg_match("/Firefox/", $ua)) {
                    header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
                } else {
                    header('Content-Disposition: attachment; filename="' . $filename . '"');
                }
                readfile($file);
                exit;
            } else {
                echo json_encode(array('fail' => "文件不存在或路径错误！"));
            }
        } else {
            echo json_encode(array('fail' => "文件不存在或路径错误！"));
        }
    }

    protected function getlogintime() {
        $userid = Yii::app()->user->id;
        $organID = Yii::app()->user->getOrganID();
        $OrganName = Organ::model()->findByPk($organID);
        $time = time();
        $ip = F::get_client_ip();
        $arr = array(
            'OrganID' => $organID,
            'OrganName' => $OrganName->OrganName,
            'UserID' => $userid,
            'IP' => $ip,
            'LoginTime' => $time,
        );
        return Yii::app()->mongodb->getDbInstance()->user_login_record->insert($arr);
    }

    //获取登陆者ip、判断登陆地址
    public function getlogin() {
        $organID = Yii::app()->user->getOrganID();
        $username = Yii::app()->user->getState('userName');
        $userid = Yii::app()->user->id;
        $ip = F::get_client_ip();
        $url = Yii::app()->createUrl('upload/logincheck') . '?OrganID=' . $organID . '&username=' . $username . '&UserID=' . $userid. '&ip=' . $ip;
        //$fp = fsockopen($host, 80, $errno, $errstr, 30);
        $params=Yii::app()->params['fsockopen'];
        if(!$params['open'])
            return;
        //Yii::log(date('Y-m-d H:i:s') . '   email_result:' . json_encode($res), 'info', 'order');
        $fp = fsockopen($params['host'], $params['port'], $errno, $errstr, $params['timeout']);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            $out = 'GET ' . $url . " HTTP/1.1\r\n";
            $out .= "Host: $host\r\n";
            $out .= "Connection: Close\r\n\r\n";
            $res = fwrite($fp, $out);
            fclose($fp);
            return;
        }
    }

}

