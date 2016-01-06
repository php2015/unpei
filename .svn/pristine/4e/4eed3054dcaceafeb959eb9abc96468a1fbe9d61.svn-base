<?php

/**
 * 经销商登记
 */
class BusinessController extends Controller {

    public $layout = '//layouts/dealer';

    /**
     * 我的黄页
     */
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "我的公司";
        $userID = Commonmodel::getOrganID();
        Yii::app()->user->name;

        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'update') {
            $display = 'none';
        }
        //$model = Dealer::model()->findBySql("select *from tbl_dealer where userID=:userId",array(':userId'=>$userID));
        $model = Dealer::model()->findByAttributes(array('userID' => $userID));
        if (empty($model)) {
            $model = new Dealer();
            $display = 'none';
        }
        // 机构照片
        $organphotoSql = "select id, photoName from tbl_dealer_organphoto where dealerID = $userID";
        $organphotos = DBUtil::queryAll($organphotoSql);

        //ajax校验
//        if (isset($_POST['ajax']) && $_POST['ajax'] === 'dealer-form') {
//            echo CActiveForm::validate($model);
//            Yii::app()->end();
//        }
        //echo F::themeUrl();//
        //  echo $filePath = dirname(Yii::app()->BasePath) . "/themes/default/uploadsfile/dealer/images/";
        //var_dump($model['keyword']);
        $this->render('index', array('model' => $model,
            'display' => $display,
            'organphotos' => $organphotos,
        ));
    }

    /**
     * 保存机构信息
     */
    public function actionSavedealerorgan() {
        $userID = Commonmodel::getOrganID();
        $model = Dealer::model()->findByAttributes(array('userID' => $userID));
        if (empty($model)) {
            $model = new Dealer();
//            $display = 'none';
        }
        if (isset($_POST['Dealer'])) {
            $model->attributes = $_POST['Dealer'];
            $model->Pinyin = F::Pinyin1($_POST['Dealer']['organName']);
            $model->CreateTime = time();
            $model->userID = $userID;
            $model->jiapartsId = $model->attributes['Phone'];
            // 上传图片
            $goodsImages = $_POST['goodsImages'];
            $imglegth = count($goodsImages);
            for ($i = 0; $i < $imglegth; $i++) {
                $goodsImg = new DealerOrganphoto();
                $goodsImg->addtime = time();
                $goodsImg->dealerID = $userID;
                $goodsImg->photoName = $goodsImages[$i];
                $goodsImg->save();
            }
            $usercheckmodel = Dealer::model()->findByAttributes(array('userID' => $userID));
            if ($model->save()) {
                if (empty($usercheckmodel)) {
                    $user = User::model()->findByPk($userID);
                    $user->OrganID = $userID;
                    $user->save();
                    $dealmenu = Menu::model()->find("root=1 and level=2 and name='经销商菜单' and if_show=1");
                    $threeM = Menu::model()->findAll("lft>:lft and rgt<:rgt and root=1 and level=3 and if_show=1", array(
                        ':lft' => $dealmenu->lft,
                        ':rgt' => $dealmenu->rgt
                            ));
                    $jurF = '';
                    $jurS = '';
                    $jurT = '';
                    foreach ($threeM as $key => $val) {
                        if ($val->name == '销售管理' || $val->name == '营销管理' || $val->name == '数据查询'
                                || $val->name == '用户中心' || $val->name == '采购管理') {
                            $jusM = Menu::model()->findAll("lft>:lft and rgt<:rgt and root=1 and level>3 and if_show=1", array(
                                ':lft' => $val->lft,
                                ':rgt' => $val->rgt
                                    ));
                            if ($val->name == '销售管理') {
                                foreach ($jusM as $keyj => $valj) {
                                    if ($valj->name == '统计分析') {
                                        $jurT.=$valj->id . ',';
                                    } else {
                                        $jurF.=$valj->id . ',';
                                    }
                                }
                            } elseif ($val->name == '营销管理') {
                                foreach ($jusM as $keyj => $valj) {
                                    if ($valj->name != '业务联系人管理') {
                                        $jurF.=$valj->id . ',';
                                    }
                                }
                            } elseif ($val->name == '数据查询') {
                                $jurF.=$val->id . ',';
                                foreach ($jusM as $keyj => $valj) {
                                    $jurF.=$valj->id . ',';
                                }
                            } elseif ($val->name == '用户中心') {
                                foreach ($jusM as $keyj => $valj) {
                                    if ($valj->name == '物流配送管理') {
                                        $jurF.=$valj->id . ',';
                                    } elseif ($valj->name == '金融账户管理') {
                                        $jurT.=$valj->id . ',';
                                    }
                                }
                            } elseif ($val->name == '采购管理') {
                                foreach ($jusM as $keyj => $valj) {
                                    if ($valj->name == '统计分析') {
                                        $jurT.=$valj->id . ',';
                                    } else {
                                        $jurS.=$valj->id . ',';
                                    }
                                }
                            }
                        }
                    }
                    for ($i = 0; $i < 3; $i++) {
                        $jur = '';
                        $role = new Role();
                        if ($i == 0) {
                            $role->RoleName = "销售专员";
                            $role->Jurisdiction = $jurF;
                        } elseif ($i == 1) {
                            $role->RoleName = "采购专员";
                            $role->Jurisdiction = $jurS;
                        } elseif ($i == 2) {
                            $role->RoleName = "财务专员";
                            $role->Jurisdiction = $jurT;
                        }
                        $role->OrganID = $userID;
                        $role->UserID = Yii::app()->user->id;
                        $role->CreateTime = time();
                        $role->save();
                    }
                }
                echo json_encode('OK');
//                $this->redirect('Index');
            } else {
                echo json_encode('NoOk');
            }
        }
    }

    // 处理上传的图片
    public function actionUploadify() {
        $organID = Commonmodel::getOrganID();
        if (!empty($_FILES)) {
            $fileName = $_FILES['Filedata']['name'];
            //$fileParts = pathinfo($_FILES['Filedata']['name']);
            //复制文件到目的地址
            $fileName = $this->getRandomName($fileName);
            $fileDir = "dealer/" . $organID . '/' . 'organ';
            $filePath = Yii::app()->params['uploadPath'] . $fileDir;
            if (!file_exists($filePath)) {
                mkdir($filePath, '777');
            }
            $targetFile = $filePath . $fileName;
            $imgurlname = $fileDir . $fileName;       // 新文件名
            $tmpfile = $_FILES['Filedata']['tmp_name'];
            @move_uploaded_file($tmpfile, $targetFile);
        }
        echo json_encode(array('code' => 200, 'filename' => $imgurlname, 'msg' => '上传成功！'));
    }

    //生成随机的文件名
    function getRandomName($filename) {

        $pos = strrpos($filename, ".");
        $fileExt = strtolower(substr($filename, $pos));
        //ini_set('date.timezone', 'Asia/Shanghai');
        $t = getdate();
        $year = $t[year];
        $mon = $t[mon] > 10 ? $t[mon] : "0" . $t[mon];
        $day = $t[mday] > 10 ? $t[mday] : "0" . $t[mday];
        $hours = $t[hours] > 10 ? $t[hours] : "0" . $t[hours];
        $minutes = $t[minutes] > 10 ? $t[minutes] : "0" . $t[minutes];
        $seconds = $t[seconds] > 10 ? $t[seconds] : "0" . $t[seconds];
        return $year . $mon . $day . $hours . $minutes . $seconds . rand(1000, 9999) . $fileExt;
    }

// 删除图片
    public function actionDeleteimg() {
        $imageName = $_GET['xximage'];
        $targetFile = Yii::app()->params['uploadPath'] . $imageName;
        $sql = "delete from tbl_dealer_organphoto where photoName= '$imageName' ";
        $bools = DBUtil::execute($sql);
        $bool = false;
        if ($bools) {
            if (file_exists($targetFile)) {
                $bool = unlink($targetFile);
            }
            echo json_encode($bool);
            exit();
        } else {
            echo json_encode($bool);
            exit;
        }
    }

    /**
     * 主营登记
     */
    public function actionMainbusiness() {
        $this->pageTitle = Yii::app()->name . '-' . "主营登记";
        $userID = Commonmodel::getOrganID();
        $model = Dealer::model()->findByAttributes(array('userID' => $userID));
        if (empty($model)) {
            $model = new Dealer();
        }
        // 显示车系
        $showvehicle = DealerVehicle::model()->findAll('userid=:userid', array(':userid' => $userID));
        //$sqlveh = "select * from jpd_dealer_vehicle where userid = $userID";
        //$showvehicle = DBUtil::queryAll($sqlveh);
        //ajax校验
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'dealer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Dealer'])) {
            $businessCar = $_POST['businessCar'];
            $businessCarModel = $_POST['businessCarModel'];
            //var_dump($businessCar);exit;
            // 把主营车系添加到数据库
            $vehlegth = count($businessCar);
            for ($i = 0; $i < $vehlegth; $i++) {
                $dealerVehicle = new DealerVehicle();
                $dealerVehicle->userid = $userID;
                $dealerVehicle->businessCar = $businessCar[$i];
                $dealerVehicle->businessCarModel = $businessCarModel[$i];
                $dealerVehicle->save();
            }

            $model->attributes = $_POST['Dealer'];
            $model->CreateTime = time();
            $model->userID = $userID;
            //var_dump($model->attributes);exit;
            //$model->save();
            if ($model->save())
                $this->redirect('mainbusiness');
        }
        $this->render('mainbusiness', array('model' => $model,
            'showvehicles' => $showvehicle,
        ));
        //$this->render('mainbusiness');
    }

    /**
     * 下属机构登记
     */
    public function actionSubdealer() {
        $userID = Commonmodel::getOrganID();
        if ($_POST['search']) {
            $search = $_POST['search'];
            $where = "";
            $where .=" organName LIKE '%{$search}%' OR grade LIKE '%{$search}%' OR allowCate LIKE '%{$search}%' OR allowBrand LIKE '%{$search}%' OR allowProvince LIKE '%{$search}%' OR person LIKE '%{$search}%' OR phone LIKE '%{$search}%' and";
        }


        // 下级经销商
        $sqlsubdealer = "select * from tbl_dealer_subdealer where " . $where . " userID = $userID order by id desc ";
        $pagesize = 3;
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $page = $pagesize * ($page - 1);
        $result = DBUtil::queryAll($sqlsubdealer);
        $count = count($result);
        $limit = " limit $page, $pagesize ";
        $subdealers = DbUtil::queryAll($sqlsubdealer . $limit);
        $pageData = array('total_rows' => $count,
            'parameter' => '',
            'list_rows' => $pagesize,
            'page_name' => 'page',
            'ajax_func_name' => '',
            'method' => '');
        $page = new Pagination($pageData);
        $page = $page->show(1);
        // var_dump($subdealers);

        $this->render('subdealer', array(
            'subdealers' => $subdealers,
            'page' => $page,
        ));
    }

    /**
     * 添加下属机构
     */
    public function actionAddsubdealer() {
        $userID = Commonmodel::getOrganID();
        $model = new DealerSubdealer();

        if (isset($_POST['DealerSubdealer'])) {
            $model->attributes = $_POST['DealerSubdealer'];
            $model->userID = $userID;
            //var_dump($model->attributes);exit;
            if ($model->save())
                $this->redirect(array('subdealer'));
        }

        $this->render('addsubdealer', array(
            'model' => $model,
        ));
    }

    /**
     * 修改下属机构
     */
    public function actionUpdatesubdealer() {
        $userID = Commonmodel::getOrganID();
        $id = $_GET['id'];
        $model = DealerSubdealer::model()->findByPk($id);

        if (isset($_POST['DealerSubdealer'])) {
            $model->attributes = $_POST['DealerSubdealer'];
            if ($model->save())
                $this->redirect(array('subdealer', 'id' => $model->id));
        }
        $this->render('updatesubdealer', array(
            'model' => $model,
        ));
    }

    /**
     * ajax 删除下属机构
     */
    public function actionAjaxdelete() {
        $id = $_GET['promID'];

        $count = DealerSubdealer::model()->deleteAll('id IN (' . $id . ')');
        if ($count > 0)
            echo $bool = true;
        else
            echo $bool = false;
    }

    /**
     * 批量导入
     */
    public function actionBatchimport() {
        $this->render('batchimport', array(
        ));
    }

    /**
     * 经销商上传下属机构信息
     */
    public function actionSubdealerupload() {
        //文件模板为product
        $template = "subdealer";
        $dealerID = Commonmodel::getOrganID();
        //上传文件
        if ($_POST['leadExcel'] == "true") {
            $filename = iconv("utf-8", "gb2312", $_FILES['inputExcel']['name']);
            $tmp_name = $_FILES['inputExcel']['tmp_name'];
            //$filePath = dirname(Yii::app()->BasePath) . "\\themes\\default\\uploadsfile\\dealer\\execl\\";
            $filePath = Yii::app()->params['uploadPath'] . '/dealer/execl/';
            $upload_result = UploadsFile::uploadFile($filename, $tmp_name, $filePath);
            //var_dump($upload_result);
            //如果上传成，则解析Excel文件
            if ($upload_result['success']) {
                //解析Excel文件，返回结果为错误消息，如果不为空则表明发生错误
                $uploadfile = $upload_result['uploadfile'];
                $dataImport = new DataImport();
                $endtime = time() + (24 * 60 * 60 * 2 * 7);
                $data = array('flag' => '1', 'UserID' => $dealerID);
                $result = $dataImport->parse($uploadfile, $template, $data);
                //如果不成功则返回错误结果
                if (!$result['success']) {
                    $message = $result['error'];
                    //var_dump($message);
                    $this->render('batchimport', array('message' => $message));
                    exit;
                }
                //var_dump($result);
                $insert_sql = $result['sql'];

                $sql_result = DbUtil::execute($insert_sql);

                //如果SQL执行不成功则返回错误结果
                if ($sql_result && !$sql_result['result']) {
                    $this->render('batchimport', array('message' => $sql_result['error']));
                    exit;
                }
                //查询上传成功的产品信息
                $message = "文件上传成功！";
                $this->redirect('subdealer');
            } else {
                $message = $upload_result['error'];
                $this->render('batchimport', array('message' => $message));
            }
        }
    }

    // 删除图片
    public function actionDeleteImage() {
        $imageName = $_POST['imageName'];
        $dealerid = $_POST['dealerid'];
        $bool = Dealer::model()->updateByPk($dealerid, array('organPhoto' => ''));
        //$targetFile = dirname(Yii::app()->BasePath) . "/themes/default/uploadsfile/dealer/images/" . $imageName;
        $targetFile = Yii::app()->params['uploadPath'] . $imageName;

        if (file_exists($targetFile) && $bool)
            $bools = unlink($targetFile);
        echo json_encode($bools);
    }

    /*
     * 删除车系
     */

    public function actionDeletevehicle() {
        $cateid = $_GET['cateid'];
        //$sql = "delete from jpd_dealer_vehicle where id= $cateid";
        $model = DealerVehicle::model()->findByPk($cateid)->delete();
        //$result = DBUtil::execute($sql);
        echo json_decode($model);
        //echo 1;
    }

    /**
     * 验证机构名称 手机号码 邮箱是否重复
     */
    public function actionCheckorgan() {
        $model = Yii::app()->db->createCommand()
                ->select("OrganID as organID")
                ->from("tbl_user")
                ->where("id=:userid", array(":userid" => Yii::app()->user->id))
                ->queryRow();
        if (empty($model['organID'])) {
            $organID = 0;
        } else {
            $organID = $model['organID'];
        }
        $name = $_GET['name'];
        if (!empty($name)) {
            $model = Dealer::model()->findAll("userID!=:organID and organName=:name", array(
                ":organID" => $organID,
                ":name" => $name));
            if (!empty($model)) {
                $message = "机构名称已存在,不可重复";
            } else {
                $phone = $_GET['phone'];
                if (!empty($phone)) {
                    $model = Dealer::model()->findAll("userID!=:organID and Phone=:phone", array(
                        ":organID" => $organID,
                        ":phone" => $phone));
                    if (!empty($model)) {
                        $message = "手机号码已被使用";
                    } else {
                        $email = $_GET['email'];
                        if (!empty($email)) {
                            $model = Dealer::model()->findAll("userID!=:organID and Email=:email", array(
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