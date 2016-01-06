<?php

class AdminController extends Controller {

    public $defaultAction = 'admin';
    public $layout = '//layouts/user';
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return CMap::mergeArray(parent::filters(), array(
                    'accessControl', // perform access control for CRUD operations
                ));
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'create', 'update', 'view', 'Dynamiccities', 'Dynamicdistrict',
                    'Dynamicarea', 'Deleteall', 'Freeze', 'unfreeze', 'black', 'blacklist', 'Deleteblack', 'Delallblack',
                    'Importoutexcel', 'Account'
                ),
                //'users'=>UserModule::getAdmins(),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $page = isset($_GET['Organ_page']) ? $_GET['Organ_page'] : 1;
        Yii::app()->session['user'] = $_GET['Organ'];
        $model = new User();
        $organ = new Organ('search');
        //$profile = new Profile();
        // $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
        // $model->attributes = $_GET['User'];
            $model->UserName = $_GET['User']['UserName'];
        $model->OrganName = $_GET['User']['OrganName'];
        $model->Identity = $_GET['User']['Identity'];
        $model->Type = $_GET['User']['Type'];
        $model->Email = $_GET['User']['Email'];
        $model->Phone = $_GET['User']['Phone'];
        $model->Status = $_GET['User']['Status'];
        $model->IsFreeze = $_GET['User']['IsFreeze'];
        $this->render('index', array(
            'model' => $model,
            'organ' => $organ
        ));
    }

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $id = intval($_GET['id']);
        $user = User::model()->findByPK($id);
        $organID = $user['OrganID'];
        $model = Organ::model()->findByPk($organID);
        $this->render('view', array(
            'model' => $model,
            'user' => $user
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        $organ = new Organ;
        //$profile = new Profile;
        $this->performAjaxValidation(array($model, $organ));

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            //用户名
            $model->UserName = $_POST['User']['UserName'];
            $organ->attributes = $_POST['organ'];
            //$model->activkey = $model->encrypting(microtime() . $model->password);
            //$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
            //邮箱
            $organ->OrganName = $_POST['Organ']['OrganName'];
            $organ->Email = $_POST['Organ']['Email'];
            //机构类型
            $organ->Identity = $_POST['Organ']['Identity'];
            $organ->Type = $_POST['Organ']['Type'];
            $organ->Phone = $_POST['Organ']['Phone'];
            //是否激活 默认已经激活
            $organ->Status = $_POST['Organ']['Status'];
            $organ->CreateTime = time();
            $organ->LastVisitTime = time();
            $organ->Province = $_POST['Organ']['Province'];
            $organ->City = $_POST['Organ']['City'];
            $organ->Area = $_POST['Organ']['Area'];
            $organ->Sort = $_POST['Organ']['Sort'];
            $organ->Recommend = $_POST['Organ']['Recommend'];
            if ($model->validate() && $organ->validate()) {
                if ($organ->save()) {
                    $organID = Yii::app()->jpdb->getLastInsertID();
                    $model->LastVisitTime = time();
                    $model->OrganID = $organID;
                    $model->PassWord = $model->encrypting($model->PassWord);
                    $model->verifyPassword = $model->encrypting($model->verifyPassword);
                    $model->IsMain = '1';  //主帐号
                    //激活码
                    $model->ActiveKey = $model->encrypting(microtime() . $model->PassWord);
                    $result = Yii::app()->jpdb->createCommand()->insert('{{user}}', array(
                        'UserName' => $model->UserName,
                        'PassWord' => $model->PassWord,
                        'OrganID' => $model->OrganID,
                        'LastVisitTime' => $model->LastVisitTime,
                        'ActiveKey' => $model->ActiveKey,
                        'IsMain' => $model->IsMain
                            ));
                    //添加到推荐记录里面,现只支持修理厂start
                    if ($_POST['Organ']['Identity'] == 3 && $_POST['Organ']['Recommend']) {
                        $record['RecomTime'] = time();
                        $record['BeFormalTime'] = 0;
                        $record['MemberStatus'] = 0;
                        $organ_factid = Organ::model()->find('OrganName=:OrganName', array(':OrganName' => $_POST['Organ']['Recommend']));
                        $record['DealerID'] = $organ_factid ? $organ_factid->ID : '';
                        $record['ServiceID'] = $organID;
                        $lms = Yii::app()->jpdb->createCommand()->insert('jpd_recommend_record', $record);
                    }
                    //添加到推荐记录里面,现只支持修理厂end
                    if ($result) {
                        $this->redirect(array('admin/admin'));
                    }
                }
            } else
                $organ->validate();
        }

        $this->render('create', array(
            'model' => $model,
            'organ' => $organ
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        $id = intval($_GET['id']);
        $model = User::model()->findByPk($id);
        $organID = $model->OrganID;
        $organ = Organ::model()->findByPk($organID);
        //$model = new User();
        //   $model = User::model()->find('OrganID=:organID', array(':organID' => $id));
        $this->performAjaxValidation(array($model, $organ));

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $organ->attributes = $_POST['Organ'];
            $organ->OrganName = $_POST['Organ']['OrganName'];
            $organ->Email = $_POST['Organ']['Email'];
            //机构类型
            $organ->Identity = $_POST['Organ']['Identity'];
            $organ->Type = $_POST['Organ']['Type'];
            $organ->Phone = $_POST['Organ']['Phone'];
            //是否激活 默认已经激活
            $organ->Status = $_POST['Organ']['Status'];
            //$organ->CreateTime = time();
            //$organ->LastVisitTime = time();
            $organ->Province = $_POST['Organ']['Province'];
            $organ->City = $_POST['Organ']['City'];
            $organ->Area = $_POST['Organ']['Area'];
            $organ->Sort = $_POST['Organ']['Sort'];
            $organ->Recommend = $_POST['Organ']['Recommend'];
            //user
            $model->UserName = $_POST['User']['UserName'];

            $model->PassWord = $_POST['User']['PassWord'];
            $model->verifyPassword = $_POST['User']['verifyPassword'];
            //$model->LastVisitTime = time();

            if ($model->validate() && $organ->validate()) {

                $old_password = User::model()->findByPk($id);
                if ($old_password->PassWord != $model->PassWord) {
                    $model->PassWord = $model->encrypting($model->PassWord);
                    //激活码
                    $model->ActiveKey = $model->encrypting(microtime() . $model->PassWord);
                    $model->verifyPassword = $model->PassWord;
                }
                if ($organ->save()) {
                    $model->save();
                }
                //添加到推荐记录里面,现只支持修理厂
                if ($_POST['Organ']['Identity'] == 3 && $_POST['Organ']['Recommend']) {
                    //查询推荐记录是否存在
                    $sql = ' select ID from jpd_recommend_record where ServiceID=' . $organID;
                    $recommendres = Yii::app()->jpdb->createCommand($sql)->queryRow();
                    if ($recommendres) {
                        $organ_factid = Organ::model()->find('OrganName=:OrganName', array(':OrganName' => $_POST['Organ']['Recommend']));
                        $record['DealerID'] = $organ_factid ? $organ_factid->ID : '';
                        $update='update jpd_recommend_record set DealerID='.$record['DealerID'].' where ServiceID=' . $organID;
                        $up=Yii::app()->jpdb->createCommand($update)->execute();
                    } else {
                        $record['RecomTime'] = time();
                        $record['BeFormalTime'] = 0;
                        $record['MemberStatus'] = 0;
                        $organ_factid = Organ::model()->find('OrganName=:OrganName', array(':OrganName' => $_POST['Organ']['Recommend']));
                        $record['DealerID'] = $organ_factid ? $organ_factid->ID : '';
                        $record['ServiceID'] = $organID;
                        $lms = Yii::app()->jpdb->createCommand()->insert('jpd_recommend_record', $record);
                    }
                }
                else if($_POST['Organ']['Identity'] == 3 && $_POST['Organ']['Recommend']==''){
                    //删除推荐记录
                    $delsql='delete from jpd_recommend_record where ServiceID=' . $organID;
                    $del=Yii::app()->jpdb->createCommand($delsql)->execute();
                }
                $this->redirect(array('view', 'id' => $id));
            } else
                $model->validate();
        }

        $this->render('update', array(
            'model' => $model,
            'organ' => $organ
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $id = Yii::app()->request->getParam("id");
            $user = User::model()->findByPk($id);
            $organID = $user['OrganID'];
            if ($organID) {
                $employ = $this->getEmploy($organID);
                if (!empty($employ) && is_array($employ)) {
                    echo json_encode(array("res" => '0', 'message' => '对不起,请您先删除子帐户'));
                    Yii::app()->end();
                }
            }
//            if($user['employ']){
//                echo json_encode(array("res"=>'1','message'=>'请先删除子帐户'));
//                Yii::app()->end();
//            }
            //   $organ = Organ::model()->deleteByPk($id);

            $user = User::model()->deleteByPk($id);
            $organ = Organ::model()->deleteByPk($organID);

            // $user = User::model()->deleteAll('OrganID=:id', array(':id' => $id));
            echo json_encode(array('res' => '1', 'message' => "删除成功"));
            Yii::app()->end();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if (!isset($_POST['ajax']))
//                $this->redirect(array('/admin/admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = Organ::model()->findbyPk($_GET['id']);
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }

    public function actionDynamiccities() {
        //echo CHtml::tag("option", array("value" => ''), '请选择城市', true);
        if ($_GET['province']) {
            $data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $_GET['province']));
            $data = CHtml::listData($data, "ID", "Name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
        if (empty($_GET['province'])) {
            echo CHtml::tag("option", array("value" => ''), '请选择城市', true);
        }
    }

    public function actionDynamicdistrict() {

        //echo CHtml::tag("option", array("value" => ''), '请选择地区', true);
        if ($_GET["city"]) {
            $data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $_GET["city"]));

            $data = CHtml::listData($data, "ID", "Name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
        if (empty($_GET["city"])) {
            echo CHtml::tag("option", array("value" => ''), '请选择地区', true);
        }
    }

    public function actionDynamicarea() {
        if ($_GET["province"]) {
            $city = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $_GET["province"]));
            foreach ($city as $ci) {
                $data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $ci->ID));
                $data = CHtml::listData($data, "ID", "Name");
                break;
            }
            echo json_encode($data);
        }
    }

    //批量删除
    public function actionDeleteall() {
        if (Yii::app()->request->isPostReQuest) {
            $data = $_POST['data'];
            $data = explode(',', $data);
            $db = new CDbCriteria();
            $db->addInCondition('id', $data);
            $user = User::model()->findAll($db);
            $arr = array();
            foreach ($user as $value) {
                $arr[] = $value['OrganID'];
            }
            if ($user) {
                $user = User::model()->deleteByPk($data);
                $result = Organ::model()->deleteByPk($arr);
                echo json_encode($result);
//                $sql = "delete from {{organ}}  where ID in($_POST[data])";
//                $result = Yii::app()->jpdb->createCommand($sql)->execute();
            }
        } else {
            throw new CHttpException(400, '请求无效,请重新发送请求');
        }
    }

    //冻结
    public function actionFreeze() {
        if (Yii::app()->request->isPostReQuest) {
            $data = $_POST['data'];
            $data = explode(',', $data);
            $db = new CDbCriteria();
            $db->addInCondition('id', $data);
            $user = User::model()->findAll($db);
            $arr = array();
            foreach ($user as $value) {
                $arr[] = $value['OrganID'];
            }
            $arr = implode(',', $arr);
            $result = Organ::model()->updateAll(array('IsFreeze' => '1'), "ID in ($arr)");
            echo json_encode($result);
        } else {
            throw new CHttpException(400, '请求无效,请重新发送请求');
        }
    }

    //解冻
    public function actionUnfreeze() {
        if (Yii::app()->request->isPostReQuest) {
            $data = $_POST['data'];
            $data = explode(',', $data);
            $db = new CDbCriteria();
            $db->addInCondition('id', $data);
            $user = User::model()->findAll($db);
            $arr = array();
            foreach ($user as $value) {
                $arr[] = $value['OrganID'];
            }
            $arr = implode(',', $arr);
            $result = Organ::model()->updateAll(array('IsFreeze' => '0'), "ID in ($arr)");
            echo json_encode($result);
        } else {
            throw new CHttpException(400, '请求无效,请重新发送请求');
        }
    }

    //加入黑名单
    public function actionBlack() {
        if (Yii::app()->request->isPostReQuest) {
            $data = $_POST['data'];
            $data = explode(',', $data);
            $db = new CDbCriteria();
            $db->addInCondition('id', $data);
            $user = User::model()->findAll($db);
            $arr = array();
            foreach ($user as $value) {
                $arr[] = $value['OrganID'];
            }
            $arr = implode(',', $arr);
            $result = Organ::model()->updateAll(array('IsBlack' => '1'), "ID in ($arr)");
            echo json_encode($result);
        } else {
            throw new CHttpException(400, '请求无效,请重新发送请求');
        }
    }

    //黑名单列表
    public function actionBlacklist() {
        $model = new Organ();
        $model->unsetAttributes();
        if (isset($_GET['Organ'])) {
            $model->UserName = $_GET['Organ']['UserName'];
            $model->OrganName = $_GET['Organ']['OrganName'];
            $model->Identity = $_GET['Organ']['Identity'];
            $model->Type = $_GET['Organ']['Type'];
            $model->Email = $_GET['Organ']['Email'];
            $model->Phone = $_GET['Organ']['Phone'];
            $model->Status = $_GET['Organ']['Status'];
            $model->IsFreeze = $_GET['Organ']['IsFreeze'];
        }
        $this->render('black', array('model' => $model));
    }

    //移除黑名单
    public function actionDeleteblack() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $result = Organ::model()->updateByPk($id, array('IsBlack' => '0'));
// 	       	$this->redirect(array('/user/admin/blacklist'));
            if ($result) {
                $this->redirect(array('/admin/blacklist'));
            }
        } else {
            throw new CHttpException(400, '请求无效,请重新发送请求');
        }
    }

    //移除所有的黑名单
    public function actionDelallblack() {
        if (Yii::app()->request->isPostReQuest) {
            $sql = "update {{organ}} set IsBlack=0 where ID in($_POST[data])";
            $result = Yii::app()->jpdb->createCommand($sql)->execute();
            echo json_encode($result);
        } else {
            throw new CHttpException(400, '请求无效,请重新发送请求');
        }
    }

    //Excel导出
    public function actionImportoutexcel() {
        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        //当期查询出的数据
        //$page = isset($_GET['User_page']) ? intval($_GET['User_page']) : 1;
        $page = Yii::app()->session['page'];
        $user = Yii::app()->session['user'];
        $data = isset($_GET['crowid']) ? $_GET['crowid'] : null;
        $username = isset($user['UserName']) ? trim($user['UserName']) : null;
        $organname = isset($user['OrganName']) ? trim($user['OrganName']) : null;
        $email = isset($user['Email']) ? trim($user['Email']) : null;
        $identity = isset($user['Identity']) ? $user['Identity'] : null;
        $phone = isset($user['Phone']) ? trim($user['Phone']) : null;
        $freeze = isset($user['IsFreeze']) ? trim($user['ISFreeze']) : null;
        $active = isset($user['Status']) ? trim($user['Status']) : null;
        $state = isset($user['Province']) ? trim($user['Province']) : null;
        $city = isset($user['City']) ? trim($user['City']) : null;
        $district = isset($user['Area']) ? trim($user['Area']) : null;
        $page_size = 10;
        $sql = "select a.UserName,b.Email,b.Identity,b.CreateTime,
    		  b.Phone,b.Type,b.IsFreeze,b.OrganName,b.Status
    		  from {{user}} a,{{organ}} b 
    		  where b.user_id=a.id and b.Status=0 
    		  and b.isblack=0 and a.id in($data)";
        if ($username) {
            $sql.=" and a.username like '%$username%'";
        }
        if ($organname) {
            $sql.=" and b.OrganName like '%$organname%'";
        }
        if ($email) {
            $sql.=" and b.Email like '%$email%'";
        }
        if ($identity) {
            $sql.=" and b.Identity='$identity'";
        }
        if ($phone) {
            $sql.=" and b.Phone like '%$phone%'";
        }
        if ($freeze) {
            $sql.=" and b.IsFreeze ='$freeze'";
        }
        if ($state) {
            $sql.=" and b.Province='$state' and b.City='$city' and b.Area='$district' ";
        }
        $sql.=" order by CreateTime DESC";
        $model = Yii::app()->jpdb->CreateCommand($sql)->queryAll();
//        $count = count($model);
//        $pages = new CPagination(count($model));
//        $pages->pageSize = 10;
//        $pages->setCurrentPage($page - 1);
//        //$pages->applylimit($criteria);
//
//        $model = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
//        $model->bindValue(':offset', $pages->currentPage * $pages->pageSize);
//        $model->bindValue(':limit', $pages->pageSize);
//        $model = $model->queryAll();
//        $page_count = (int) ($count / $page_size) + 1;

        $n = 0;
        foreach ($model as $list) {
            if ($n % $page_size === 0) {
                //报表头的输出
                $objectPHPExcel->getActiveSheet()->mergeCells('B1:G1');
                $objectPHPExcel->getActiveSheet()->setCellValue('B1', '会员信息表');

                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '会员信息表');
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '会员信息表');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
                        ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '日期：' . date("Y年m月j日"));
                //$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E2','第'.$page.'/'.$page_count.'页');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('E2')
                        ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                //表格头的输出

                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '用户名称');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '创建时间');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '邮箱');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '机构');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '真实姓名');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '会员类型');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', '手机号');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', '是否冻结');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
                $objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(32);
                //设置居中
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //设置边框
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
                        ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                //设置颜色
                $objectPHPExcel->getActiveSheet()->getStyle('B3:I3')->getFill()
                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF66CCCC');
            }
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 4), $list['username']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 4), $list['create_at']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 4), $list['email']);
            switch ($list['identity']) {
                case 1:
                    $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), '生产商');
                    break;
                case 2:
                    $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), '经销商');
                    break;
                case 3:
                    $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), '修理厂');
                    break;
            }
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($n + 4), $list['truename']);
            switch ($list['usertype']) {
                case 0:
                    $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($n + 4), '非会员');
                    break;
                case 1:
                    $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($n + 4), '试用会员');
                    break;
                case 2:
                    $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($n + 4), '正式会员');
                    break;
            }

            $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($n + 4), $list['phone']);
            switch ($list['freeze']) {
                case 0:
                    $objectPHPExcel->getActiveSheet()->setCellValue('I' . ($n + 4), '未冻结');
                    break;
                case 1:
                    $objectPHPExcel->getActiveSheet()->setCellValue('I' . ($n + 4), '已冻结');
                    break;
            }

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()->getStyle('B' . ($n + 4) . ':I' . $currentRowNum)
                    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B' . ($n + 4) . ':I' . $currentRowNum)
                    ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B' . ($n + 4) . ':I' . $currentRowNum)
                    ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B' . ($n + 4) . ':I' . $currentRowNum)
                    ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B' . ($n + 4) . ':I' . $currentRowNum)
                    ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $n = $n + 1;


            //设置分页显示
            $objectPHPExcel->getActiveSheet()->setBreak('I55', PHPExcel_Worksheet::BREAK_ROW);
            $objectPHPExcel->getActiveSheet()->setBreak('I10', PHPExcel_Worksheet::BREAK_COLUMN);
            //$objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            //$objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

            ob_end_clean();
            ob_start();
        }
        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . '会员信息表-' . date("Y-m-d") . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    //查看子帐户
    public function actionAccount() {
        $id = Yii::app()->request->getParam('id');
        if (!isset($id) && !empty($id)) {
            throw new CHttpException(400, '请求无效,请重新发送请求');
        }
        //获取机构ID
        $user = $this->getOrganID($id);
        $organID = $user['OrganID'];
        $username = $user['UserName'];
        $model = new JpdOrganEmployees();
        //搜索条件
        if (isset($_GET['JpdOrganEmployees'])) {
            $model->Name = $_GET['JpdOrganEmployees']['Name'];
        }
        //查询子账户
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.OrganID=' . $organID);
        $criteria->addCondition("t.IsMain='0'");
        $criteria->addCondition("employ.Status='0'");
        //子帐户搜索
        if (isset($_GET['JpdOrganEmployees'])) {
            $name = $_GET['JpdOrganEmployees']['Name'];
            $criteria->compare("employ.Name", "$name", 'AND');
        }
        $criteria->with = 'employ';
        $dataProvider = new CActiveDataProvider('User',
                        array(
                            'criteria' => $criteria,
                            'pagination' => array(
                                'pageSize' => '10'
                            ),
                        )
        );
        $this->render('account', array('dataProvider' => $dataProvider, 'model' => $model, 'username' => $username));
    }

    //根据userID查询机构ID
    protected function getOrganID($id) {
        $user = User::model()->findByPk($id);
        return $user;
    }

    //根据organID查询子帐户
    protected function getEmploy($organID) {
        $cri = new CDbCriteria();
        $cri->addCondition('OrganID=' . $organID);
        $cri->addCondition("IsMain='0'");
        $user = User::model()->findAll($cri);
        return $user;
    }

}
