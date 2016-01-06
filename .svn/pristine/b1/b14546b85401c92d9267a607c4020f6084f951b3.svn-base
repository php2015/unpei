<?php

class ServicemaininfoController extends Controller {

    public $layout = '//layouts/service';

    /*
     * 渲染服务报价管理页面
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "服务报价管理";
        $this->render('index');
    }

    /*
     * 服务报价列表
     */

    public function actionQuotelist() {
        $userID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        if ($_GET) {
            if ($_GET['num']) {
                $criteria->addSearchCondition('ItemNum', "{$_GET['num']}", "AND");
            }
            if ($_GET['name']) {
                $criteria->addSearchCondition('ItemName', "{$_GET['name']}", "AND");
            }
        }
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:t.UpdateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = {$userID}");
        $criteria->addCondition("t.Status = 0");
        $count = ServiceItems::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = ServiceItems::model()->findAll($criteria);
        foreach ($model as $key => $value) {
            $data[$key] = $value->attributes;
            $data[$key]['ItemNums'] = F::msubstr($value['ItemNum']);
            $data[$key]['ItemNames'] = F::msubstr($value['ItemName']);
            $data[$key]['ItemExplan'] = F::msubstr($value['ItemIntro']);
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 添加服务报价
     */

    public function actionAdd() {
        $organID = Commonmodel::getOrganID();
        $count = ServiceItems::model()->count("ItemName= '{$_POST['ItemName']}' and OrganID='{$organID}' and Status=0");
        if ($count > 0) {
            $result['errorMsg'] = "该项目名称已存在";
            echo json_encode($result);
            exit;
        }
        $model = new ServiceItems();
        $model->ItemNum = "FWBJ" . F::get_order_id();
        $model->OrganID = $organID;
        $model->attributes = $_POST;
        $model->CreateTime = time();
        $model->UpdateTime = time();
        $success = $model->save();
        if ($success == '1') {
            $result['success'] = "数据添加成功!";
            echo json_encode($result);
        } else {
            $result['errorMsg'] = "系统异常，数据添加失败!";
            echo json_encode($result);
        }
    }

    /*
     * 编辑服务报价
     */

    public function actionEdit() {
        $organID = Commonmodel::getOrganID();
        $count = ServiceItems::model()->count("ItemName= '{$_POST['ItemName']}' and OrganID='{$organID}' and Status=0 and ID <> '{$_GET['ID']}'");
        if ($count > 0) {
            $result['errorMsg'] = "该项目名称已存在";
            echo json_encode($result);
            exit;
        }
        $success = ServiceItems::model()->updateByPk($_GET['ID'], array(
            'ItemName' => $_POST['ItemName'],
            'ItemQuote' => $_POST['ItemQuote'],
            'ItemIntro' => $_POST['ItemIntro'],
            'UpdateTime' => time()
                ));
        if ($success == '1') {
            $result['success'] = "数据修改成功!";
            echo json_encode($result);
        } else {
            $result['errorMsg'] = "系统异常，数据修改失败!";
            echo json_encode($result);
        }
    }

    /*
     * 删除服务报价
     */

    public function actionDestory() {
        $success = ServiceItems::model()->updateByPk($_POST['id'], array(
            'Status' => 1,
            'UpdateTime' => time()
                ));
        if ($success == '1') {
            $result['success'] = "数据删除成功!";
            echo json_encode($result);
        } else {
            $result['errorMsg'] = "系统异常，数据删除失败!";
            echo json_encode($result);
        }
    }

    /*
     * 批量上传服务报价
     */

    public function actionImport() {
        $this->pageTitle = Yii::app()->name . '-' . "服务报价管理";
        $template = "serviceitems";
        $OrganID = Commonmodel::getOrganID(); //获取当前修理厂的ID
        //上传文件
        if ($_FILES['inputExcel']['name']) {
            $filename = iconv("utf-8", "gb2312", $_FILES['inputExcel']['name']);
            $tmp_name = $_FILES['inputExcel']['tmp_name'];
            //$filePath = dirname(Yii::app()->BasePath) . "/themes/default/uploadsfile/servicer/excel/";
            $filePath = Yii::app()->params['uploadPath'] . "servicer/excel/";
            $upload_result = UploadsFile::uploadFile($filename, $tmp_name, $filePath);
            //如果上传成功，则解析Excel文件
            if ($upload_result['success']) {
                //解析Excel文件，返回结果为错误消息，如果不为空则表明发生错误
                $uploadfile = $upload_result['uploadfile'];
                $dataImport = new ServiceImport();
                $data = array('OrganID' => $OrganID);
                $result = $dataImport->parse($uploadfile, $template, $data);
                //如果不成功则返回错误结果
                if (!$result['success']) {
                    $message = $result['error'];
                    $this->render('index', array('message' => $message));
                    exit;
                }
                $insert_sql = $result['sql'];
                $sql_result = DBUtil::execute($insert_sql);
                //如果SQL执行不成功则返回错误结果
                if ($sql_result && !$sql_result['result']) {
                    $this->render('index', array('message' => $sql_result['error']));
                    exit;
                }
                //上传成功，则把上传成功的数据展示出来
                else {
                    $message = "succeed";
                    $this->redirect(array('index', 'message' => $message, 'success' => TRUE));
                }
            } else {
                $message = $upload_result['error'];
                $this->render('index', array('message' => $message));
            }
        } else {
            $this->redirect(array("index"));
        }
    }

    /*
     * 获取临时上传的数据
     */

    public function actionTemplist() {
        $organID = Commonmodel::getOrganID();
        $model = ServiceItemsTemp::model()->findAll("OrganID= " . $organID . " order by ID desc ");
        foreach ($model as $key => $value) {
            if ($this->isExist($value['ItemName'], $organID)) {
                $data[$key]['Status'] = 2;
            } else if ($this->isTempExist($value['ItemName'], $organID, $value['ID'])) {
                $data[$key]['Status'] = 3;
            } else {
                $data[$key]['Status'] = 0;
            }
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['OrganID'] = $value['OrganID'];
            $data[$key]['ItemName'] = $value['ItemName'];
            $data[$key]['ItemQuote'] = $value['ItemQuote'];
            $data[$key]['ItemIntro'] = $value['ItemIntro'];
            $data[$key]['ItemRemove'] = '';
        }
        $rs = array(
            'total' => count($model),
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 删除临时表中的项目
     */

    public function actionDelitem() {
        if (empty($_POST['ID'])) {
            $this->redirect('index');
        } else {
            $OrganID = Commonmodel::getOrganID();
            $ID = $_POST['ID'];
            $count = ServiceItemsTemp::model()->deleteByPk($ID, 'OrganID=:OrganID', array(':OrganID' => $OrganID));
            $num = ServiceItemsTemp::model()->count('OrganID=:OrganID', array(':OrganID' => $OrganID));
            if ($num == 0) {
                $result = array('emptyMsg' => '服务项目列表已清空');
            } else if ($count) {
                $result = array('successMsg' => '项目删除成功');
            } else {
                $result = array('errorMsg' => '项目删除失败！');
            }
            echo json_encode($result);
        }
    }

    /*
     * 保存表格行内修改的值
     */

    public function actionSavecell() {
        $ID = $_GET['ID'];
        $fieldName = $_GET['fieldName'];
        $change = $_GET['change'];
        $bool = ServiceItemsTemp::model()->updateByPk($ID, array(
            $fieldName => $change,
                ));
        echo $bool;
    }

    /*
     * 把临时表里的数据循环添加到服务项目表
     */

    public function actionImportitem() {
        $OrganID = Commonmodel::getOrganID();
        //获取临时表中的数据 
        $tempItems = ServiceItemsTemp::model()->findAll('OrganID=:OrganID', array(':OrganID' => $OrganID));
        if (!empty($tempItems)) {
            foreach ($tempItems as $key => $value) {
                if ($this->isTempExist($value['ItemName'], $OrganID, $value['ID'])) {
                    $result = array('error' => 1, 'errorMsg' => '项目列表内有相同的项目名称，请先修改');
                    echo json_encode($result);
                    exit;
                } else if ($this->isExist($value['ItemName'], $OrganID)) {
                    $result = array('error' => 1, 'errorMsg' => '存在已导入的项目名称，请先修改！');
                    echo json_encode($result);
                    exit;
                }
            }
            //把临时表里的数据循环添加到服务项目表
            foreach ($tempItems as $key => $tempItem) {
                $model = new ServiceItems();
                $model->OrganID = $OrganID;
                $model->ItemNum = "FWBJ" . F::get_order_id();
                $model->ItemName = $tempItem['ItemName'];
                $model->ItemQuote = $tempItem['ItemQuote'];
                $model->ItemIntro = $tempItem['ItemIntro'];
                $model->CreateTime = time();
                $model->UpdateTime = time();
                $success = $model->save();
                if ($success) {  //成功添加一条时删除这条数据
                    $bool = ServiceItemsTemp::model()->deleteByPk($tempItem['ID']);
                }
                $result = array('success' => 1, 'errorMsg' => '导入成功！');
            }
        }
        echo json_encode($result);
    }

    /*
     * 判断服务项目名称是否存在
     */

    private function isExist($itemName, $id = 0) {
        // if ($id == 0) {
        $count = ServiceItems::model()->count("ItemName= '{$itemName}' and OrganID='{$id}' and Status=0");
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        // }
    }

    private function isTempExist($itemName, $organID = 0, $id = 0) {
        $count = ServiceItemsTemp::model()->count("ItemName= '{$itemName}' and OrganID='{$organID}' and ID<>{$id}");
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * 删除临时表里的数据
     */

    public function actionDestoryitem() {
        $OrganID = Commonmodel::getOrganID();
        $count = ServiceItemsTemp::model()->deleteAll('OrganID=:OrganID', array(':OrganID' => $OrganID));
        if ($count > 0) {
            echo $bool = true;
        } else {
            echo $bool = false;
        }
    }

    /*
     * 获取当前机构主营登记信息
     */

    public function getMain() {
        $OrganID = Commonmodel::getOrganID();
        $result = array();
        $result['model'] = ServiceMain::model()->find("OrganID=:ID", array(":ID" => $OrganID))->attributes;
        $routines = ServiceMainRoutine::model()->findAll(
                "MainID=:ID AND OrganType=:Type", array(":ID" => $result['model']['ID'], ":Type" => $result['model']['OrganType']));
        foreach ($routines as $rokey => $rovalue) {
            $result['routine'][$rokey] = $rovalue->attributes;
        }
        $diagnos = ServiceMainDiagnos::model()->findAll(
                "MainID=:ID AND OrganType=:Type", array(":ID" => $result['model']['ID'], ":Type" => $result['model']['OrganType']));
        foreach ($diagnos as $dikey => $divalue) {
            $result['diagno'][$dikey] = $divalue->attributes;
        }
        $parts = ServiceMainWearparts::model()->findAll(
                "MainID=:ID AND OrganType=:Type", array(":ID" => $result['model']['ID'], ":Type" => $result['model']['OrganType']));
        foreach ($parts as $pakey => $pavalue) {
            $result['part'][$pakey] = $pavalue->attributes;
        }
        $repairs = ServiceMainRepair::model()->findAll(
                "MainID=:ID AND OrganType=:Type", array(":ID" => $result['model']['ID'], ":Type" => $result['model']['OrganType']));
        foreach ($repairs as $rekey => $revalue) {
            $result['repair'][$rekey] = $revalue->attributes;
        }
        return $result;
    }

    /*
     * 渲染并显示当前机构主营登记信息（显示页面）
     */

    public function actionMaininfo() {
        $this->pageTitle = Yii::app()->name . '-' . "主营类别管理";
        $result = $this->getMain();
        $this->render('maininfo', array(
            "model" => $result['model'],
            "routine" => $result['routine'],
            "diagno" => $result['diagno'],
            "part" => $result['part'],
            "repair" => $result['repair']
        ));
    }

    /*
     * 渲染并显示当前机构主营登记信息（修改页面）
     */

    public function actionBusiness() {
        $this->pageTitle = Yii::app()->name . '-' . "主营类别管理";
        $result = $this->getMain();
        $this->render('business', array(
            "model" => $result['model'],
            "routine" => $result['routine'],
            "diagno" => $result['diagno'],
            "part" => $result['part'],
            "repair" => $result['repair']
        ));
    }

    /*
     * 获取易损件更换--易损件信息
     */

    public function actionGetparts() {
        $model = ServiceMainParts::model()->findAll();
        foreach ($model as $key => $value) {
            $data[$key] = $value->attributes;
        }
        $rs = array(
            'total' => count($model),
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 获取专业修理--修理范围
     */

    public function actionGetrange() {
        $model = ServiceMainRange::model()->findAll();
        foreach ($model as $key => $value) {
            $data[$key] = $value->attributes;
        }
        $rs = array(
            'total' => count($model),
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 获取险企服务--险企信息
     */

    public function actionGetinsur() {
        $model = ServiceMainInsur::model()->findAll();
        foreach ($model as $key => $value) {
            $data[$key] = $value->attributes;
        }
        $rs = array(
            'total' => count($model),
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 添加或修改主营类别
     */

    public function actionAddbusiness() {
        if ($_POST) {
            //添加主营类别
            $OrganID = Commonmodel::getOrganID();
            $OrganType = $_POST['OrganType'];
            //查找当前机构主营类别是否存在
            $model = ServiceMain::model()->find("OrganID=:ID", array(":ID" => $OrganID));
            if ($model) {
                //当前机构主营记录主键ID
                $ID = $model['ID'];
                //修改主营登记
                if ($OrganType == '1') {
                    //var_dump($_POST);
                    $WearParts = $_POST['WearParts'] ? $_POST['WearParts'] : "定向车系";
                    $success['main'] = ServiceMain::model()->updateByPk($ID, array(
                        "OrganType" => $OrganType,
                        "DeepClean" => $_POST['DeepClean'],
                        "RouMain" => $_POST['RouMain'] ? $_POST['RouMain'] : "定向车系",
                        "WearParts" => $WearParts . "," . $_POST['partscate'],
                        "CarBeauty" => "",
                        "Diagnos" => "",
                        "ProRepair" => "",
                        "AutoService" => "",
                        "UpdateTime" => time()
                            ));
                    $success['vehicle'] = $this->addFrepair($ID, $_POST);
                    //var_dump($success);exit;
                } else if ($OrganType == '2') {
                    //var_dump($_POST);
                    $success['main'] = ServiceMain::model()->updateByPk($ID, array(
                        "OrganType" => $OrganType,
                        "DeepClean" => $_POST['DeepClean'],
                        "CarBeauty" => $_POST['CarBeauty'],
                        "RouMain" => $_POST['RouMain'] ? $_POST['RouMain'] : "定向车系",
                        "WearParts" => "",
                        "Diagnos" => "",
                        "ProRepair" => "",
                        "AutoService" => "",
                        "UpdateTime" => time()
                            ));
                    $success['vehicle'] = $this->addBshop($ID, $_POST);
                    //var_dump($success); exit;
                } else if ($OrganType == '3') {
                    //var_dump($_POST);
                    $WearParts = $_POST['WearParts'] ? $_POST['WearParts'] : "定向车系";
                    $ProRepair = $_POST['ProRepair'] ? $_POST['ProRepair'] : "定向车系";
                    $success['main'] = ServiceMain::model()->updateByPk($ID, array(
                        "OrganType" => $OrganType,
                        "DeepClean" => $_POST['DeepClean'],
                        "RouMain" => $_POST['RouMain'] ? $_POST['RouMain'] : "定向车系",
                        "WearParts" => $WearParts . "," . $_POST['partscate'],
                        "Diagnos" => $_POST['Diagnos'] ? $_POST['Diagnos'] : "定向车系",
                        "ProRepair" => $ProRepair . "," . $_POST['repairrange'],
                        "AutoService" => $_POST['InsurType'] . "," . $_POST['insurname'],
                        "CarBeauty" => "",
                        "UpdateTime" => time()
                            ));
                    $success['vehicle'] = $this->addRfactory($ID, $_POST);
                    //var_dump($success);exit;
                } else {
                    //var_dump($_POST);
                    $WearParts = $_POST['WearParts'] ? $_POST['WearParts'] : "定向车系";
                    $ProRepair = $_POST['ProRepair'] ? $_POST['ProRepair'] : "定向车系";
                    $success['main'] = ServiceMain::model()->updateByPk($ID, array(
                        "OrganType" => $OrganType,
                        "DeepClean" => $_POST['DeepClean'],
                        "RouMain" => $_POST['RouMain'] ? $_POST['RouMain'] : "定向车系",
                        "WearParts" => $WearParts . "," . $_POST['partscate'],
                        "Diagnos" => $_POST['Diagnos'] ? $_POST['Diagnos'] : "定向车系",
                        "ProRepair" => $ProRepair . "," . $_POST['repairrange'],
                        "AutoService" => $_POST['InsurType'] . "," . $_POST['insurname'],
                        "CarBeauty" => "",
                        "UpdateTime" => time()
                            ));
                    $success['vehicle'] = $this->addRfactory($ID, $_POST);
                    //var_dump($success);exit;
                }
            } else {
                //var_dump($_POST);
                //添加主营登记
                $main = new ServiceMain();
                $main->OrganID = $OrganID;
                $main->OrganType = $OrganType;
                if ($OrganType == '1') {
                    $WearParts = $_POST['WearParts'] ? $_POST['WearParts'] : "定向车系";
                    $main->DeepClean = $_POST['DeepClean'];
                    $main->RouMain = $_POST['RouMain'] ? $_POST['RouMain'] : "定向车系";
                    $main->WearParts = $WearParts . "," . $_POST['partscate'];
                } else if ($OrganType == '2') {
                    $main->DeepClean = $_POST['DeepClean'];
                    $main->CarBeauty = $_POST['CarBeauty'];
                    $main->RouMain = $_POST['RouMain'] ? $_POST['RouMain'] : "定向车系";
                } else {
                    $WearParts = $_POST['WearParts'] ? $_POST['WearParts'] : "定向车系";
                    $ProRepair = $_POST['ProRepair'] ? $_POST['ProRepair'] : "定向车系";
                    $main->DeepClean = $_POST['DeepClean'];
                    $main->RouMain = $_POST['RouMain'] ? $_POST['RouMain'] : "定向车系";
                    $main->WearParts = $WearParts . "," . $_POST['partscate'];
                    $main->Diagnos = $_POST['Diagnos'] ? $_POST['Diagnos'] : "定向车系";
                    $main->ProRepair = $ProRepair . "," . $_POST['repairrange'];
                    $main->AutoService = $_POST['InsurType'] . "," . $_POST['insurname'];
                }
                $main->CreateTime = time();
                $main->UpdateTime = time();
                $success['main'] = $main->save();
                //刚刚添加的机构主营记录主键ID
                $ID = $main->attributes['ID'];
                //分机构类型添加主营类别品牌车系
                switch ($OrganType) {
                    case '1' : $success['vehicle'] = $this->addFrepair($ID, $_POST);
                        break; //快修店
                    case '2' : $success['vehicle'] = $this->addBshop($ID, $_POST);
                        break; //美容店
                    case '3' : $success['vehicle'] = $this->addRfactory($ID, $_POST);
                        break; //车系专修厂
                    case '4' : $success['vehicle'] = $this->addRfactory($ID, $_POST);
                        break; //全修厂
                }
                //var_dump($success);exit;
            }
            //在全车系或者更换机构类型的基础上，删除多余的品牌车系信息
            $result = ServiceMain::model()->findByPk($ID)->attributes;
            $part = explode(',', $result['WearParts']);
            $repair = explode(',', $result['ProRepair']);
            if ($result['RouMain'] == "全车系" || $result['RouMain'] == "") {
                ServiceMainRoutine::model()->deleteAll("MainID = {$ID}");
            }
            if ($result['Diagnos'] == "全车系" || $result['Diagnos'] == "") {
                ServiceMainDiagnos::model()->deleteAll("MainID = {$ID}");
            }
            if ($part[0] == "全车系" || $result['WearParts'] == "") {
                ServiceMainWearparts::model()->deleteAll("MainID = {$ID}");
            }
            if ($repair[0] == "全车系" || $result['ProRepair'] == "") {
                ServiceMainRepair::model()->deleteAll("MainID = {$ID}");
            }
            $this->redirect(array('maininfo'));
        }
    }

    /*
     * 添加快修店日常保养、易损件更换品牌车系
     */

    public function addFrepair($id, $posts) {
        if ($posts['main']) {
            $success['main'] = $this->addMain($id, $posts['OrganType'], $posts['main']);
        } else if ($posts['main-make'] && $posts['main-car']) {
            $success['main'] = $this->addOneMain($id, $posts['OrganType'], $posts['main-make'], $posts['main-car']);
        }
        if ($posts['parts']) {
            $success['parts'] = $this->addParts($id, $posts['OrganType'], $posts['parts']);
        } else if ($posts['parts-make'] && $posts['parts-car']) {
            $success['parts'] = $this->addOneParts($id, $posts['OrganType'], $posts['parts-make'], $posts['parts-car']);
        }
        return $success;
    }

    /*
     * 添加美容店日常保养品牌车系
     */

    public function addBshop($id, $posts) {
        if ($posts['main']) {
            $success = $this->addMain($id, $posts['OrganType'], $posts['main']);
        } else if ($posts['main-make'] && $posts['main-car']) {
            $success = $this->addOneMain($id, $posts['OrganType'], $posts['main-make'], $posts['main-car']);
        }
        return $success;
    }

    /*
     * 添加修理厂日常保养、易损件更换、检测诊断、专业修理品牌车系
     */

    public function addRfactory($id, $posts) {
        if ($posts['main']) {
            $success['main'] = $this->addMain($id, $posts['OrganType'], $posts['main']);
        } else if ($posts['main-make'] && $posts['main-car']) {
            $success['main'] = $this->addOneMain($id, $posts['OrganType'], $posts['main-make'], $posts['main-car']);
        }
        if ($posts['parts']) {
            $success['parts'] = $this->addParts($id, $posts['OrganType'], $posts['parts']);
        } else if ($posts['parts-make'] && $posts['parts-car']) {
            $success['parts'] = $this->addOneParts($id, $posts['OrganType'], $posts['parts-make'], $posts['parts-car']);
        }
        if ($posts['diag']) {
            $success['diag'] = $this->addDiagos($id, $posts['OrganType'], $posts['diag']);
        } else if ($posts['diag-make'] && $posts['diag-car']) {
            $success['diag'] = $this->addOneDiagos($id, $posts['OrganType'], $posts['diag-make'], $posts['diag-car']);
        }
        if ($posts['repair']) {
            $success['repair'] = $this->addRepair($id, $posts['OrganType'], $posts['repair']);
        } else if ($posts['repair-make'] && $posts['repair-car']) {
            $success['repair'] = $this->addOneRepair($id, $posts['OrganType'], $posts['repair-make'], $posts['repair-car']);
        }
        return $success;
    }

    /*
     * 添加日常保养品牌车系
     */

    public function addMain($id, $type, $main) {
        foreach ($main as $key => $value) {
            $main = new ServiceMainRoutine();
            $ten = explode(';', $value);
            $main->MainID = $id;
            $main->OrganType = $type;
            $main->Make = $ten[0];
            $main->Car = $ten[1];
            $success = $main->save();
        }
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        ServiceMain::model()->updateByPk($id, array(
            "RouMain" => "定向车系",
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainRoutine::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 添加一条日常保养品牌车系
     */

    public function addOneMain($id, $type, $make, $car) {
        $main = new ServiceMainRoutine();
        $main->MainID = $id;
        $main->OrganType = $type;
        $main->Make = $make;
        $main->Car = $car;
        $success = $main->save();
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        ServiceMain::model()->updateByPk($id, array(
            "RouMain" => "定向车系",
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainRoutine::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 添加检测诊断品牌车系
     */

    public function addDiagos($id, $type, $diag) {
        foreach ($diag as $key => $value) {
            $diag = new ServiceMainDiagnos();
            $diagno = explode(';', $value);
            $diag->MainID = $id;
            $diag->OrganType = $type;
            $diag->Make = $diagno[0];
            $diag->Car = $diagno[1];
            $success = $diag->save();
        }
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        ServiceMain::model()->updateByPk($id, array(
            "Diagnos" => "定向车系",
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainDiagnos::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 添加一条检测诊断品牌车系
     */

    public function addOneDiagos($id, $type, $make, $car) {
        $diag = new ServiceMainDiagnos();
        $diag->MainID = $id;
        $diag->OrganType = $type;
        $diag->Make = $make;
        $diag->Car = $car;
        $success = $diag->save();
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        ServiceMain::model()->updateByPk($id, array(
            "Diagnos" => "定向车系",
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainDiagnos::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 添加易损件更换品牌车系
     */

    public function addParts($id, $type, $parts) {
        foreach ($parts as $key => $value) {
            $parts = new ServiceMainWearparts();
            $part = explode(';', $value);
            $parts->MainID = $id;
            $parts->OrganType = $type;
            $parts->Make = $part[0];
            $parts->Car = $part[1];
            $success = $parts->save();
        }
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        $model = ServiceMain::model()->findByPk($id)->attributes;
        $Wearpart = explode(',', $model['WearParts']);
        $Category = implode(array_splice($Wearpart, 1), ',');
        ServiceMain::model()->updateByPk($id, array(
            "WearParts" => "定向车系" . "," . $Category,
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainWearparts::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 添加一条易损件更换品牌车系
     */

    public function addOneParts($id, $type, $make, $car) {
        $parts = new ServiceMainWearparts();
        $parts->MainID = $id;
        $parts->OrganType = $type;
        $parts->Make = $make;
        $parts->Car = $car;
        $success = $parts->save();
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        $model = ServiceMain::model()->findByPk($id)->attributes;
        $Wearpart = explode(',', $model['WearParts']);
        $Category = implode(array_splice($Wearpart, 1), ',');
        ServiceMain::model()->updateByPk($id, array(
            "WearParts" => "定向车系" . "," . $Category,
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainWearparts::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 添加专业修理品牌车系
     */

    public function addRepair($id, $type, $repair) {
        foreach ($repair as $key => $value) {
            $repair = new ServiceMainRepair();
            $rep = explode(';', $value);
            $repair->MainID = $id;
            $repair->OrganType = $type;
            $repair->Make = $rep[0];
            $repair->Car = $rep[1];
            $success = $repair->save();
        }
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        $model = ServiceMain::model()->findByPk($id)->attributes;
        $Prorepair = explode(',', $model['ProRepair']);
        $Range = implode(array_splice($Prorepair, 1), ',');
        ServiceMain::model()->updateByPk($id, array(
            "ProRepair" => "定向车系" . "," . $Range,
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainRepair::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 添加一条专业修理品牌车系
     */

    public function addOneRepair($id, $type, $make, $car) {
        $repair = new ServiceMainRepair();
        $repair->MainID = $id;
        $repair->OrganType = $type;
        $repair->Make = $make;
        $repair->Car = $car;
        $success = $repair->save();
        //添加品牌车系后，修改主表中的全车系字段为定向车系
        $model = ServiceMain::model()->findByPk($id)->attributes;
        $Prorepair = explode(',', $model['ProRepair']);
        $Range = implode(array_splice($Prorepair, 1), ',');
        ServiceMain::model()->updateByPk($id, array(
            "ProRepair" => "定向车系" . "," . $Range,
            "UpdateTime" => time()
        ));
        //删除相同记录下不同的机构类型的品牌车系信息
        ServiceMainRepair::model()->deleteAll(array(
            "condition" => "MainID = {$id} and OrganType!={$type}"
        ));
        return $success;
    }

    /*
     * 删除日常保养品牌车系
     */

    public function actionDeletemain() {
        $result = ServiceMainRoutine::model()->deleteByPk($_GET['id']);
        echo json_decode($result);
    }

    /*
     * 删除检测诊断品牌车系
     */

    public function actionDeletediagnos() {
        $result = ServiceMainDiagnos::model()->deleteByPk($_GET['id']);
        echo json_decode($result);
    }

    /*
     * 删除易损件更换
     */

    public function actionDeleteparts() {
        $result = ServiceMainWearparts::model()->deleteByPk($_GET['id']);
        echo json_decode($result);
    }

    /*
     * 删除专业修理
     */

    public function actionDeleterepair() {
        $result = ServiceMainRepair::model()->deleteByPk($_GET['id']);
        echo json_decode($result);
    }

}