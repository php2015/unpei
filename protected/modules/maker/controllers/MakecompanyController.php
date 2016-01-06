<?php

class MakecompanyController extends Controller {

    //public $layout = '//layouts/maker';
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

    /**
     * 我的黄页
     */
    public function actionIndex() {
    	if ($_POST){
    		$this->actionSavemakeorgan();
    	}
        $OrganID = Yii::app()->user->getOrganID();
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'update') {
            $display = 'none';
        }
        $model = Organ::model()->with('maker')->findByPk($OrganID);
        if (empty($model)) {
            $model = new Organ();
            $display = 'none';
        }
        // 机构照片
        $photosql = 'select * from `{{organ_photo}}` where OrganID=' . $OrganID;
        $organphotos = Yii::app()->jpdb->createCommand($photosql)->queryAll();
        $this->render('index', array(
            'model' => $model,
            'display' => $display,
            'organphotos' => $organphotos,
        ));
    }

    /**
     * 公司信息保存
     */
    public function actionSavemakeorgan() {
        $OrganID = Yii::app()->user->getOrganID();
        
        $Organ = Yii::app()->request->getParam("Organ");
        $model = Organ::model()->findByPK($OrganID);
    	if (empty($model)) {
            $model = new Organ();
        }
        //保存organ数据
        $model->attributes=$Organ; 
        
        //判断基本信息是否为空，为空则不提交
        if ($Organ){
        	//接收删除图片的地址
        	$photoId = Yii::app()->request->getParam("photoId");
        	//判断是否删除图片
        	if (!empty($photoId)){
        		$imageids = explode(',', $photoId);
        		foreach ($imageids as $imageid) {
                    $picture = OrganPhoto::model()->find('Path=:img AND OrganID=:OrganID', array(':img' => $imageid,':OrganID'=>$OrganID));
                    //判断该图片路径是否存在数据库中
                    if (empty($picture)) {
                        $myfileurl = Yii::app()->params['uploadPath'] . $imageid;
                        if (file_exists($myfileurl)) {
                            $result = unlink($myfileurl);
                        }
                    } else {
                        $myfileurl = Yii::app()->params['uploadPath'] . $picture->Path;
                        OrganPhoto::model()->deleteAll('Path=:img AND OrganID=:OrganID', array(':img' => $imageid,':OrganID'=>$OrganID));
                        if (file_exists($myfileurl)) {
                            $result = unlink($myfileurl);
                        }
                    }
                }
        	}
        	
        	//接收上传图片地址
        	$goodsImages = Yii::app()->request->getParam("goodsImages");
        	//判断是否有上传图片
        	if (!empty($goodsImages)){
	            $imglegth = count($goodsImages);
	            for ($i = 0; $i < $imglegth; $i++) {
	                $goodsImg = new OrganPhoto();
	                $goodsImg->OrganID = $OrganID;
	                $goodsImg->Path = $goodsImages[$i];
	                $goodsImg->save();
	            }
        	}
        	
        	//判断是否上传营业执照
        	$BLPoto = Yii::app()->request->getParam("BLPoto");
        	if ($model->BLPoto != $BLPoto){
        		if (!empty($model->BLPoto)){
		        	$filePath = Yii::app()->params['uploadPath'] . $model->BLPoto;
		            if (file_exists($filePath)) {
		                unlink($filePath);
		            }
        		}
        		$model->BLPoto = $BLPoto;
        	}
        	
        	//接收make数据
        	$make = Yii::app()->request->getParam("Make");
        	//保存make数据
        	$makemodel = Make::model()->find("OrganID=:organid",array(":organid" => $OrganID));
        	if (empty($makemodel)){//判断是否第一次添加
        		$makemodel = new Make();
        		$makemodel->OrganID = $OrganID;
        	}
        	$makemodel->SaleMoney = $make['SaleMoney'];
        	$makemodel->SaleDomain = $make['SaleDomain'];
        	
        	if ($makemodel->save() && $model->save()) {
		       	//保存成功
		      	$this->redirect(array('index'));
		    }else {
		    	var_dump($makemodel->errors);var_dump($model->errors);die;
		    }
        }
    }

    /**
     * 我的黄页网店添加
     */
    /*public function actionAddonlinestore() {
        if ($_GET['store_id'] && $_GET['store_url']) {
            $user_id = Yii::app()->user->id;
            if (!$user_id) {
                $this->redirect('../../site/login');
                exit;
            }
            $onlinestore = new MakeOnlineStoreRelation();
            $onlinestore->userID = $user_id;
            $onlinestore->onlineStoreID = $_GET['store_id'];
            $onlinestore->onlineStoreUrl = $_GET['store_url'];
            $onlinestore->save();
            $result = Yii::app()->db->getLastInsertID();
            echo $result;
        } else {
            echo '';
        }
    }*/

    /**
     * 删除图片
     */
/*    public function actionDeleteimage() {
        $imageid = $_POST['imageid'];
        $picture = MakeOrganPicture::model()->findByPk($imageid);
        $myfileurl = Yii::app()->params['uploadPath'] . $picture->picture_file;
        MakeOrganPicture::model()->deleteByPk($imageid);
        if (file_exists($myfileurl)) {
            $result = unlink($myfileurl);
        }
        echo json_encode($result);
    }*/

    /**
     * 配送商列表页面
     */
    public function actionDistribution() {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition('OrganID=' . $organID);
        $criteria->order='ID desc';
        $dataProvider = new CActiveDataProvider('DistributionBusiness',
                        array(
                            'criteria' => $criteria,
                            'pagination' => array(
                                'pageSize' => '10'
                            ),
                ));
        $pages = $dataProvider->getPagination();
        $this->render('delivery', array('pages' => $pages, 'dataProvider' => $dataProvider));
    }

    /**
     * 配送商添加页面
     */
    public function actionAdddistribution() {
        if ($_GET['id']) {
            $model = DistributionBusiness::model()->findByPk($_GET['id']);
        } else {
            $model = new DistributionBusiness();
            $model->OrganID = Yii::app()->user->getOrganID();
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'distribution-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['DistributionBusiness'])) {
            $model->attributes = $_POST['DistributionBusiness'];
            if ($model->save())
                $this->redirect(array('distribution'));
        }
        $this->render('adddistribution', array(
            'model' => $model,
        ));
    }
    
     /**
     * 配送商删除
     */
     public function actionDeldistribution() {
        if ($_GET['id']) {
            $model = DistributionBusiness::model()->deleteByPk($_GET['id']);
            if ($model == 1)
                $this->redirect(array('distribution'));
        }
    }

    /**
     * 仓储服务点列表页面
     */
    public function actionStorage() {
         $organID=Yii::app()->user->getOrganID();
         $criteria=new CDbCriteria();
         $criteria->addCondition('OrganID='.$organID);
         $criteria->order='ID desc';
         $dataProvider=new CActiveDataProvider('MakeStorage',
                array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                      'pageSize'=>'10'
                        ),
                ));
          $this->render('storages',array('dataProvider'=>$dataProvider));
    }
    
    /**
     * 添加仓储服务点
     */
    public function actionAddstorage()
    {
        if ($_GET['id']) {
            $model = MakeStorage::model()->findByPk($_GET['id']);
        } else {
            $model = new MakeStorage();
            $model->OrganID = Yii::app()->user->getOrganID();
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'MakeStorage-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['MakeStorage'])) {
            $model->attributes = $_POST['MakeStorage'];
            if ($model->save())
                $this->redirect(array('storage'));
        }
        $this->render('addstorage', array(
            'model' => $model,
        ));
    }
    
    /**
     * 仓储服务点删除
     */
     public function actionDelstorage() {
        if ($_GET['id']) {
            $model = MakeStorage::model()->deleteByPk($_GET['id']);
            if ($model == 1)
                $this->redirect(array('storage'));
        }
    }

    /**
     * 技术服务点列表页面
     */
    public function actionTechnique() {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->condition = 'OrganID=' . $organID;
        $criteria->order = 'ID DESC';
        $dataProvider = new CActiveDataProvider('MakeTechnique', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => '10',
                    )
                ));
        $pages = $dataProvider->getPagination();
        $this->render('techque', array('pages' => $pages, 'dataProvider' => $dataProvider));
    }

    /**
     * 添加技术服务点页面
     */
    public function actionAddtechnique() {
        if ($_GET['id']) {
            $model = MakeTechnique::model()->findByPk($_GET['id']);
        } else {
            $model = new MakeTechnique();
            $model->OrganID = Yii::app()->user->getOrganID();
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'MakeTechnique-form') {
            $model->ServiceTime=$_POST['beginWeek'].'至'.$_POST['endWeek'].' '.$_POST['beginHour'].'-'.$_POST['endHour'];
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['MakeTechnique'])) {
            $model->attributes = $_POST['MakeTechnique'];
            $model->ServiceTime=$_POST['beginWeek'].'至'.$_POST['endWeek'].' '.$_POST['beginHour'].'-'.$_POST['endHour'];
            if ($model->save())
                $this->redirect(array('technique'));
        }
        $this->render('addtechnique', array(
            'model' => $model,
        ));
    }
    
    /**
     * 技术服务点删除
     */
     public function actionDeltechnique() {
        if ($_GET['id']) {
            $model = MakeTechnique::model()->deleteByPk($_GET['id']);
            if ($model == 1)
                $this->redirect(array('technique'));
        }
    }

    /**
     * 验证机构名称 手机号码 邮箱是否重复
     */
    public function actionCheckorgan() {
    	$OrganID = Yii::app()->user->getOrganID();
        if (empty($OrganID)) {
            $organID = 0;
        } else {
            $organID = $OrganID;
        }
        $name = $_GET['name'];
        if (!empty($name)) {
            $model = Organ::model()->findAll("ID!=:organID and OrganName=:name", array(":organID" => $organID, ":name" => $name));
            if (!empty($model)) {
                $message = "机构名称已存在,不可重复";
            } else {
                $mobilephone = $_GET['mobilephone'];
                if (!empty($mobilephone)) {
                    $model = Organ::model()->findAll("ID!=:organID and Phone=:mobilephone", array(":organID" => $organID, ":mobilephone" => $mobilephone));
//                        $model=Yii::app()->db->createCommand()
//                            ->select('id')
//                            ->from("tbl_user")
//                            ->where("id!=:employID and username=:username",  array(":employID"=>$employID,":username"=>$username))
//                            ->queryAll();
                    if (!empty($model)) {
                        $message = "手机号码已被使用";
                    } else {
                        $email = $_GET['email'];
                        if (!empty($email)) {
                            $model = Organ::model()->findAll("ID!=:organID and Email=:email", array(
                                ":organID" => $organID,
                                ":email" => $email));
                            if (!empty($model)) {
                                $message = "邮箱已被使用";
                            }
                        }
                    }
                }
            }
        }
        if (empty($message)) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        $resu['result'] = $result;
        $resu['message'] = $message;
        echo json_encode($resu);
    }

}