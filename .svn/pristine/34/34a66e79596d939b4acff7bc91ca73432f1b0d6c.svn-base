<?php

class RecommendController extends Controller {

    public $layout = '//layouts/system';
    public function actionIndex() {
        $data = new RecommendList();
        $this->render('index', array(
            'data' => $data
        ));
    }

    public function actionRecomupload() {
        $rsult = new RecommendList;
        //文件模板为product
        $template = "recommend";
        $userID = Yii::app()->user->id;
        //上传文件
        if (!empty($_FILES['inputExcel']['tmp_name'])) {
            $filename = rand(1000, 10000) . Yii::app()->user->id . strrchr($_FILES['inputExcel']['name'], '.');
//            $filename = iconv("utf-8", "gb2312", $_FILES['inputExcel']['name']);
            $tmp_name = $_FILES['inputExcel']['tmp_name'];
            $filePath = Yii::app()->params['uploadPath'] . "dealer/excel/" . $organID . '/';
            $type = 'xlsx|xls';
            $files = $this->upload('inputExcel', $type, '', $filePath);
            //如果上传成，则解析Excel文件
            if (file_exists($files['file'])) {
                //解析Excel文件，返回结果为错误消息，如果不为空则表明发生错误
                $uploadfile = $files['file'];
                $dataImport = new RecomImport();
                $createtime = time();
                $data = array('RecomStatus' => 0,
                    'OrganID' => Yii::app()->user->getOrganID(),//Commonmodel::getOrganID(),
                    'UserID' => $userID,
                );
                $result = $dataImport->parse($uploadfile, $template, $data);
                //如果不成功则返回错误结果
                if (!$result['success']) {
                    unlink($files['file']);
                    $message = $result['error'];
                    $this->render('index', array('message' => $message,'data'=>$rsult));
                    exit;
                }
                $insert_sql = $result['sql'];
                $sql_result = self::execute($insert_sql);
                //如果SQL执行不成功则返回错误结果
                if ($sql_result && !$sql_result['result']) {
                    unlink($files['file']);
                    $this->render('index', array('message' => $sql_result['error'],'data'=>$rsult));
                    exit;
                } else { // 上传成功，则把上传成功的数据展示出来
                    $message = "上传成功！";
                    $this->render('index', array('message' => $message,'data'=>$rsult));
                    
                }
                //查询上传成功的产品信息
//				$message = "文件上传成功！";
//				$this->redirect('recommendlist',array('message' => $message));
            } else {
                $message = $files['message'];
                $this->render('index', array('message' => $message,'data'=>$rsult));
            }
        } else {
            $this->redirect('index');
        }
    }
    
    public function actioneMailandrecord(){
        $ids = $_POST['ids']; // 需要注册的ID
        $ids=  substr($ids, 0,-1);
        $modeles = RecommendList::model()->findAll("ID in ($ids)");
        foreach ($modeles as $kkk=>$model) {
            $truename=  RecommendList::showOrganname($model['OrganID']);
            // 判断用户是否存在
            $exitemail=  Organ::model()->find('Email=:Email',array(':Email'=>$model['Email']));
           $exitusername=  User::model()->find('UserName=:UserName',array(':UserName'=>$model['MobPhone']));
           $exitorganname=Organ::model()->find('organName=:organName',array(':organName'=>$model['CompanyName']));
//               $isexit = Organ::model()->findAll("username= '{$model['MobPhone']}' or email='{$model['Email']}'");
//            if (count($isexit) > 0) {
//                $PhoneArr = array();
//                $EmailArr = array();
//                $errstr = '';
//                foreach ($isexit as $val) {
//                    $PhoneArr[] = $val->username;
//                    $EmailArr[] = $val->email;
//                }
//                if (in_array($model['MobPhone'], $PhoneArr)) {
//                    $errstr = $model->Name . "：电话号码已被使用 ";
//                }
//                if (in_array($model['Email'], $EmailArr)) {
//                    if (!empty($errstr)) {
//                        $errstr.="邮箱已被使用 ";
//                    } else {
//                        $errstr.=$model->Name . "：邮箱已被使用 ";
//                    }
//                }
//                $errMsg[] = $errstr;
//                continue;
//            }
                if($exitemail ||$exitusername || $exitorganname){
                    if($exitusername){
                        $errstr[$kkk].= $model->Name . "：电话号码已被使用 ";
                    }
                    if($exitorganname){
                       if(!empty($errstr)){
                            $errstr[$kkk].="机构名称已被使用 ";
                        }else{
                          $errstr[$kkk].= $model->Name . "：机构名称已被使用 ";   
                        }  
                    }
                    if($exitemail){
                        if(!empty($errstr)){
                            $errstr[$kkk].="邮箱已被使用 ";
                        }else{
                          $errstr[$kkk].= $model->Name . "：邮箱已被使用 ";   
                        }
                    }
                    continue;
                }
            // 代理注册
                $organ=new Organ();
                $organ->OrganName=$model['CompanyName'];
                $organ->Phone=$model['MobPhone'];
                $organ->Email=$model['Email'];
                $organ->Identity=$model['CompanyType'];
                $organ->Recommend=$model['OrganID'];
                $organ->RecomID=$model['OrganID'];
                $organ->Status=1;
                $organ->CreateTime=  time();
                $organ->Province=$model['Province'];
                $organ->City=$model['City'];
                $organ->Area=$model['Area'];
                $organ->Address=$model['Address'];
                $apl= Yii::app()->jpdb->createCommand()->insert('jpd_organ',$organ->attributes);
                if($apl==1){
                    $lastUserID = Yii::app()->jpdb->getLastInsertID();   
                }else{
                    $lmserror['$kkk']=$model->Name . "：注册失败 ";
                    continue;
                }
               
                $user = new User();
                $user->UserName = $model['MobPhone'];
                $user->PassWord = md5($model['MobPhone']);
                $user->verifyPassword=$user->PassWord;
                $user->IsMain=1;
                $user->OrganID =$lastUserID;
            if ($user->save()) {    // 注册成功
//                Yii::app()->db->createCommand()->insert('tbl_profiles', array(
//                    'user_id' => $lastUserID,
//                    'CreateTime' => time(),
//                ));
                $this->AddRRecord($model, $lastUserID);
                // 邮件内容
                $emialcontent = "<p>尊敬的" . $model['Name'] . "，</p>
                                <p>" . $truename . "推荐您试用嘉配服务平台。 </p>
                                <p>" . $truename . "已经帮您开通了试用账户，用户名 :" . $model['MobPhone'] . "，密码:" . $model['MobPhone'] . "，点击</p>
                                <p>http://192.168.2.29，立即激活账号，享受嘉配服务！</p>
                                <p style='text-align: right;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 北京嘉配科技公司&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                <p style='text-align: right;'>" . date('Y年 m月 d日', time()) . "</p>";
                $title = "嘉配推荐使用嘉配服务平台";
                $bool = self::sendMail($model['Email'], $title, $emialcontent);
//                $bool = $this->SendEmailtochen('chenhg@jiaparts.com', '', $model['Email'], $title, $emialcontent);
                if (!$bool) {
                    $sendErr[] = $model->Name . "：注册成功，邮件发送失败 ";
                }
            } else {
                $userErr[] = $model->Name . "：注册失败 ";
            }
        } // endforeach
        //$bool =	$this->SendEmailtochen('chenhg@jiaparts.com', '',$emailurl, $messages[0]['title'], $messages[0]['messContent']);
        if (count($errstr) > 0) {
            $errhtml = "";
            foreach ($errstr as $val) {
                $errhtml.="$val\n";
            }
        }
        if(count($lmserror)){
              foreach ($lmserror as $val) {
                $errhtml.="$val\n";
            }
        }
        if (count($userErr) > 0) {
            $errhtml.="注册失败" . count($userErr) . "个：\n";
            foreach ($userErr as $val) {
                $errhtml.="$val\/n";
            }
        }
        if (count($sendErr) > 0) {
            $errhtml.="发送邮件失败" . count($sendErr) . "个：\n";
            foreach ($sendErr as $val) {
                $errhtml.="$val";
            }
        }
        if ($bool) { // 发送成功
            echo json_encode(array('success' => true, 'errMsg' => '恭喜您，代理注册成功！邮件已发送。'));
        } else {    // 发送失败 
            echo json_encode(array('success' => false, 'errMsg' => $errhtml));
        }
    }
    
    
      /**
     * Send to user mail
     */
    public static function sendMail($email, $subject, $message) {
//        $adminEmail = Yii::app()->params['adminEmail'];
//        $headers = "MIME-Version: 1.0\r\nFrom: $adminEmail\r\nReply-To: $adminEmail\r\nContent-Type: text/html; charset=utf-8";
//        $message = wordwrap($message, 70);
//        $message = str_replace("\n.", "\n..", $message);
//        return mail($email, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);
        header("Content-type:text/html; charset=utf-8");
        $mailer = Yii::app()->mailer;
        $mailer->Host = 'smtp.exmail.qq.com';
        $mailer->Port = '25';
        $mailer->SMTPAuth = true;
        $emamodel = self::getemail();
        if ($emamodel) {
            foreach ($emamodel as $model) {
                if ($model->attributes) {
                    $model->Value = @unserialize($model->Value);
                }
                if ($model->Key == 'adminEmail') {
//                    $adminEmail = substr($val['value'], 5, -2);
//                    $mailer->Username=substr($val['value'], 5, -2);
                    $adminEmail = $model->Value;
                    $mailer->Username = $model->Value;
                } else {
//                    $mailer->Password=substr($val['value'], 5, -2);
                    $mailer->Password = $model->Value;
                }
            }
        }
        $mailer->IsSMTP();
        $mailer->From = $adminEmail;

        $mailer->AddReplyTo($adminEmail);
        $mailer->AddAddress($email);
        $mailer->FromName = Yii::app()->name;
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $subject;
        $mailer->Body = $message;
        $mailer->IsHTML(true);
        return $mailer->send();
    }
    
       /**
     * 获取邮箱帐号密码
     */
    public static function getemail() {
        $model = Settings::model()->findAll("t.key=:email or t.key=:pwd", array(":email" => 'adminEmail', ":pwd" => 'password'));
        
        return $model;
    }

    //查看
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
//添加
    	public function actionCreate()
	{
		$model=new RecommendList;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['RecommendList']))
		{
                    $_POST['RecommendList']['OrganID']=  RecommendList::Getrecommenduserid($_POST['RecommendList']['OrganID']);
                    $_POST['RecommendList']['CreateTime']=time();
			$model->attributes=$_POST['RecommendList'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
                        else{
                            
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function loadModel($id) {
        $model = RecommendList::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
  public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
            $this->performAjaxValidation($model);
		if(isset($_POST['RecommendList']))
		{
                    $_POST['RecommendList']['OrganID']=  RecommendList::Getrecommenduserid($_POST['RecommendList']['OrganID']);
			$model->attributes=$_POST['RecommendList'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    /*
     * 上传推荐xls
     */

    public function upload($upload_file, $type, $size, $url) {
        $file = $_FILES[$upload_file];
// 		if ($file['error']!=0){
// 			return array('message'=>'请选择文件');
// 		}
        $uploader = new Uploader();
        if ($type) {
            $uploader->allowed_type($type); // 限制文件类型
        }
        if ($size) {
            $uploader->allowed_size($size);
        }
        $uploader->addFile($file);
        if ($uploader->_file['error']) {
            return array('message' => $uploader->_file['error']);
        }
        $newName = $uploader->random_filename();
        //$uploader->root_dir(dirname(Yii::app()->BasePath));
        $uploader->root_dir('');
        $uploader->save($url, $newName);
        return array('filePath' => dirname(Yii::app()->BasePath), 'file' => $url . $newName . '.' . $uploader->_file['extension']);
    }
    
     public function AddRRecord($model, $lastUserID) {
        $bool2 = RecommendList::model()->updateByPk($model['ID'], array(
            'RecomStatus' => 1
                ));
        if ($bool2) {
            $recrec = new RecommendRecord();  // 推荐记录
            $recrec->RecomID = $model['ID'];
            $recrec->RecomMethod = '代注册推荐';
            $recrec->RecomTime = time();
            $recrec->BeFormalTime = 0;
//            $recrec->UserID = $model['OrganID'];
            $recrec->DealerID = $model['OrganID'];
            $recrec->ServiceID = $lastUserID;
            $recrec->save();

//            $income = new RecommendIncomeDetail(); // 推荐收入
//            $income->RecomID = $model['ID'];
//            $income->RecomTime = time();
//            $income->ServiceID = $lastUserID;
//            $income->IncomeAccount = 0;
//            $income->isAccount = 0;
//            $income->RecomMethod = "代注册推荐";
////            $income->UserID = $model['UserID'];
//            $income->OrganID = $model['OrganID'];
//            $recrec->BeFormalTime = 0;
//            $income->save();
        }
    }
    
    //删除
    public function actionDelete(){
        $id=$_GET['id'];
        $result=  RecommendList::model()->deleteByPK($id);
       $messager='';
        if($result>0){
           $message='删除成功';
        }else{
           $message='删除失败';  
        }
        $data=new RecommendList;
        $this->redirect('index',array('message'=>$message));
    }
 protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='recommend-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
    
  	//执行语句
	public static function execute($sql,$params=array()){
		if(empty($sql)){
			return false;
		}
		$error = "";
		$result = false;
		try
		{
			$connection = self::getDbCon();
			$result = $connection->createCommand($sql)->execute($params);
			$result = true;
		} catch(Exception $e) {
			$error .= '数据库执行异常：'.$e->__toString();
			$result = false;
		}
		//返回处理结果
		return array('result' => $result,'error' => $error);
	}  
        
    	public static function getDbCon () 
	{
		$db_con = '';
		if(isset(Yii::app()->controller->module->db)){
			$db_con = Yii::app()->controller->module->db;
		}
		if(!$db_con){
			$db_con = 'jpdb';
		}
		return Yii::app()->getComponent($db_con);
	}
      
    
}
?>
