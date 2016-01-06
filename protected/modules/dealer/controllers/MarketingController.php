<?php

class MarketingController extends Controller {

    public $layout = "//layouts/dealer";

    public function actionIndex() {
        $organID = Commonmodel::getOrganID();
// $id = DealerGoodsSpec::model()->find("GoodsID=43")->attributes['ID'];
//   var_dump(Dealer::getDealerList(300010043));
//  var_dump(Dealer::getDealerList(100050002));
//  var_dump(DealerGoods::getGoodsByID(36));
// var_dump(DealerGoods::getGoodsInfo());
//   echo F::basePath()."/../upload/dealer/";
//  echo    dirname(Yii::app()->BasePath) . "/../upload/dealer/".$organID;
//  echo  Yii::app()->basePath. '/extensions/swfupload/assets/handler.js';
        $this->pageTitle = Yii::app()->name . '-' . "商品管理";
//echo F::Pinyin1('管理');
        $this->render('index');
    }

    /**
     * 主营登记
     */
    public function actionMainbusiness() {
        $this->pageTitle = Yii::app()->name . '-' . "主营登记";
        $userID = Commonmodel::getOrganID();
        $model = Dealer::model()->findByAttributes(array('userID' => $userID));
        if (empty($model)) {
//$model = new Dealer();
        }
// 显示车系
        $showvehicle = DealerVehicle::model()->findAll('userid=:userid', array(':userid' => $userID));
// 显示主营品类
        $showcpname = DealerCpname::model()->findAll('OrganID=:userID', array(':userID' => $userID));
//$sqlveh = "select * from jpd_dealer_vehicle where userid = $userID";
//$showvehicle = DBUtil::queryAll($sqlveh);
//ajax校验
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'dealer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST)) {
            $make = $_POST['make'];
            $car = $_POST['car'];
            $year = $_POST['year'];
            $model2 = $_POST['model'];
//  var_dump($_POST['make']); 
// 把主营车系添加到数据库
            $vehlegth = count($make);
            for ($i = 0; $i < $vehlegth; $i++) {
                $dealerVehicle = new DealerVehicle();
                $dealerVehicle->userid = $userID;
                $dealerVehicle->businessMake = $make[$i];
                $dealerVehicle->businessCar = $car[$i];
                $dealerVehicle->businessYear = $year[$i];
                $dealerVehicle->businessCarModel = $model2[$i];
                $bool1 = $dealerVehicle->save();
            }
            //主营品类（标准名称）
            $BigName = $_POST['BigName'];
            $SubName = $_POST['SubName'];
            $CpName = $_POST['CpName'];
            $BigpartsID = $_POST['BigpartsID'];
            $SubCodeID = $_POST['SubCodeID'];
            $CpNameID = $_POST['CpNameID'];

            // 把主营车系添加到数据库
            $cplegth = count($BigName);
            for ($j = 0; $j < $cplegth; $j++) {
                $mogr = new DealerCpname();
                $mogr->OrganID = $userID;
                $mogr->BigName = $BigName[$j];
                $mogr->SubName = $SubName[$j];
                $mogr->CpName = $CpName[$j];
                $mogr->BigpartsID = $BigpartsID[$j];
                $mogr->SubCodeID = $SubCodeID[$j];
                $mogr->CpNameID = $CpNameID[$j];
                $bool2 = $mogr->save();
            }

            // $model->attributes = $_POST['Dealer'];
            // $model->businessCar = '';
            // $model->CreateTime = time();
            // $model->userID = $userID;
            //$model->save();
            //  if ($bool1 || $bool2)
            if ($_POST['returnok'] == "ok" || $bool1 || $bool2)
                $this->redirect('mainbusupdate');
        }
        $this->render('mainbusiness', array(
            'model' => $model,
            'showvehicles' => $showvehicle,
            'showcpnames' => $showcpname,
        ));
    }

    public function actionMainbusupdate() {
        $this->pageTitle = Yii::app()->name . '-' . "主营登记";
        $userID = Commonmodel::getOrganID();
        $model = Dealer::model()->findByAttributes(array('userID' => $userID));
        // 显示车系
        $showvehicle = DealerVehicle::model()->findAll('userid=:userid', array(':userid' => $userID));
        // 显示主营品类
        $showcpname = DealerCpname::model()->findAll('OrganID=:userID', array(':userID' => $userID));
        //$sqlveh = "select * from jpd_dealer_vehicle where userid = $userID";
        //$showvehicle = DBUtil::queryAll($sqlveh);
        //ajax校验
        $this->render('mainbusiness_update', array(
            'model' => $model,
            'showvehicles' => $showvehicle,
            'showcpnames' => $showcpname,
        ));
    }

    /**
     * 添加商品
     */
    public function actionAdd() {
        $organID = Commonmodel::getOrganID();
        $userID = Yii::app()->user->id;
        if ($_POST) {
            $data['Name'] = trim($_POST['Name']);
            if (trim($_POST['Pinyin']) == "") {
                $pinyin = F::Pinyin1($_POST['Name']); // 如果未输入拼音则自动添加拼音
            } else {
                $pinyin = trim($_POST['Pinyin']);
            }
            //echo $_POST['goodsBrand'];exit;
            // echo $pinyin;exit;
            $LogisticsPrice = trim($_POST['LogisticsPrice']);
            if (empty($LogisticsPrice)) {
                $LogisticsPrice = 0;
            }

            $data['Pinyin'] = $pinyin;
            $data['GoodsNO'] = trim($_POST['GoodsNO']);     // 商品编号
            //$data['OENO'] = trim($_POST['OENO']);
            if ($_POST['OENOS'][0]) {
                $data['OENO'] = $_POST['OENOS'][0];
            } else {
                $data['OENO'] = trim($_POST['OENO']);
            }
            $data['PartsLevel'] = trim($_POST['PartsLevel']);
            $data['Memo'] = trim($_POST['Memo']);
            $data['Price'] = trim($_POST['Price']);
            if (!empty($_POST['goodsBrand'])) {
                $data['BrandID'] = trim($_POST['goodsBrand']);    // id
                $data['Brand'] = trim($_POST['brandID']);    // 名称
            }
            //  $data['BigParts'] = $_POST['mainCategory'];         // 配件大类
            //  $data['SubParts'] = $_POST['subCategory'];          // 配件子类
            //   $data['CpName'] = $_POST['leafCategory'];           // 标准名称
            $data['CpNameTxt'] = $_POST['CpNameTxt'];           // 标准名称txt
            $goodsspec['JiapartsNO'] = $data['BrandID']; // 加配号
            $data['LogisticsPrice'] = $LogisticsPrice;
            if (!empty($_POST['IsUpSale'])) {
                $data['IsSale'] = $_POST['IsUpSale'];
            }
            $model = new DealerGoods();
            $model->attributes = $data;
            $oenos = $_POST['OENOS'] ? $_POST['OENOS'] : $_POST['OENO'];
            if ($oenos) {
                foreach ($oenos as $value) {
                    $oe .=$value;
                }
            }else{
                $oe ='';
            }


            $make_hidden = explode(',', $_POST["make_hidden"]);
            $make_hidden = array_unique($make_hidden);
            $make_hidden = array_filter($make_hidden);
            $make_hidden = implode(',', $make_hidden);
            $model->Title = $data['Name'] . ' ' . $pinyin . ' ' . $data['Brand'] . ' ' . $oe . ' ' . $make_hidden;
            // $model->Title = $data['Name'].' '. $pinyin.' '.$data['Brand'].' '.$data['OENO'];
            $model->OrganID = $organID;
            $model->UserID = $userID;
            $model->CreateTime = time();
            // var_dump($model->attributes);exit;
            if ($this->Isexist($data['GoodsNO'])) {  // 添加
                if ($model->save()) {
                    //得到刚插入数据库的商品Id
                    $pid = $model->attributes['ID'];
                    //$businessCar = $_POST['businessCar'];
                    //$businessCarModel = $_POST['businessCarModel'];
                    $make = explode(',', $_POST["make"]);
                    $car = explode(',', $_POST["car"]);
                    $year = explode(',', $_POST["year"]);
                    $model2 = explode(',', $_POST["model"]);
                    $maketext = explode(',', $_POST["maketxt"]);
                    $cartext = explode(',', $_POST["cartxt"]);
                    $modeltext = explode(',', $_POST["modeltxt"]);
                    // 把主营车系添加到商品车系关系表
                    $vehlegth = count($make);
                    for ($i = 0; $i < $vehlegth; $i++) {
                        //$pVehicle = new DealerParts(); // 促销商品的车系
                        if ($make[$i] != 0) {
                            $goodsv = new DealerGoodsVehicleRelation();
                            $goodsv->OrganID = $organID;
                            $goodsv->GoodsID = $pid;
                            $goodsv->Make = $make[$i];
                            $goodsv->Car = $car[$i];
                            $goodsv->Year = $year[$i];
                            $goodsv->Model = $model2[$i];
                            $goodsv->Marktxt = $maketext[$i];
                            $goodsv->Cartxt = $cartext[$i];
                            $goodsv->Modeltxt = $modeltext[$i];
                            $goodsv->save();
                        }
                    }
                    $sql = "update tbl_dealer_goods_vehicle_relation set GoodsID = {$pid} where OrganID = {$organID} and GoodsID = 0";
                    $b = DBUtil::execute($sql);


                    // 把OENO号添加到关系表里
                    $oenos = $_POST['OENOS'];
                    $oelegth = count($oenos);
                    for ($i = 0; $i < $oelegth; $i++) {
                        $goodsoeno = new DealerGoodsOenoRelation();
                        $goodsoeno->OrganID = $organID;
                        $goodsoeno->GoodsID = $pid;
                        $goodsoeno->OENO = $oenos[$i];
                        $goodsoeno->save();
                    }
                    // 添加商品图片
                    $urlimg = explode(',', $_PODT['urlimg']); //根据逗号拆分，得到图片信息的字符串
                    $sqlimg = "insert into tbl_dealer_goods_image_relation (OrganID,GoodsID,ImageUrl,CreateTime,ImageName) values";
                    foreach ($urlimg as $k => $value) {
                        if ($value) {//去掉初始值0
                            $addimg = explode(';', $value); //根据分号拆分，得到图片的相关信息
                            if ($k != 1) {
                                $sqlimg .=",";
                            }
                            $sqlimg .="(";
                            $sqlimg .=$organID;
                            $sqlimg .=",";
                            $sqlimg .=$pid; //商品ID
                            $sqlimg .=",'";
                            $sqlimg .=$addimg[0]; //图片url
                            $sqlimg .="',";
                            $sqlimg .=time();
                            $sqlimg .=",'";
                            $sqlimg .=$addimg[1]; //图片原名
                            $sqlimg .="')";
                        }
                    }
                    DBUtil::execute($sqlimg);






//                    $goodsImages = $_POST['goodsImages'];
//                    $imglegth = count($goodsImages);
//                    for ($i = 0; $i < $imglegth; $i++) {
//                        $goodsImg = new DealerGoodsImageRelation();
//                        $goodsImg->GoodsID = $pid;
//                        $goodsImg->OrganID = $organID;
//                        $goodsImg->ImageUrl = $goodsImages[$i];
//                        $goodsImg->save();
//                    }
                    // var_dump($goodsImages);exit;
                    // 添加商品属性
                    if ($goodsImages) {
                        $goodsspec['ImageUrl'] = $goodsImages[0];
                    }
                    if ($_POST['detcImages']) {
                        $goodsspec['DetectionImg'] = $_POST['detcImages'];
                    }
                    $goodsspec['Weight'] = $_POST['Weight'];    // 重量
                    $goodsspec['Length'] = $_POST['Length'];    // 长
                    $goodsspec['Wide'] = $_POST['Wide'];        // 宽
                    $goodsspec['Height'] = $_POST['Height'];    // 高
                    $goodsspec['Volume'] = $_POST['Volume'];    //体积
                    $goodsspec['ValidityType'] = $_POST['ValidityType']; // 保质期类型
                    $goodsspec['ValidityDate'] = $_POST['ValidityDate']; // 保质期
                    $goodsspec['BganCompany'] = $_POST['BganCompany']; // 标杆公司
                    $goodsspec['BganGoodsNO'] = $_POST['BganGoodsNO']; // 标杆商品号
                    $goodsspec['Specifica'] = $_POST['Specifica'];  // 规格
                    $goodsspec['PartsNO'] = $_POST['PartsNO'];      // 配件类别
                    $goodsspec['Unit'] = $_POST['Unit'];      // 配件类别
                    //  $goodsspec['JiapartsNO'] = $_POST['JiapartsNO']; // 加配号
                    $goodsspe = new DealerGoodsSpec();
                    $goodsspe->attributes = $goodsspec;
                    $goodsspe->GoodsID = $pid;      // 商品ID
                    $goodsspe->save();
                    /* 保存上传的图片
                      end ** */

                    // 添加商品包装
                    $goodspack['MinQuantity'] = $_POST['MinQuantity'];    //
                    $goodspack['Weight'] = $_POST['pWeight'];    //
                    $goodspack['Volume'] = $_POST['pVolume'];    //

                    $gpack = new DealerGoodsPack();
                    $gpack->attributes = $goodspack;
                    $gpack->GoodsID = $pid;
                    $gpack->save();

                    $rs = array('success' => 1, 'errorMsg' => '保存数据成功');
                } else {
                    $rs = array('success' => 0, 'errorMsg' => '保存数据失败');
                }
            } else {
                $rs = array('success' => 0, 'errorMsg' => '商品编号已存在，请修改！');
            }
        }
        echo json_encode($rs);
    }

    /*
     * 获取适用车系
     */

    public function actionGetyearmodel() {
        $Car = $_GET['carID'];
        $Year = $_GET['Year'];
        if ($Year == '请选择年款') {
            $sql = "select modelid,name,alias,year,makeid,seriesid from goods_model where  seriesid = {$Car}";
            $model = DBUtil::queryAll($sql);
        } else {
            $sql = "select modelid,name,alias,year,makeid,seriesid from goods_model where seriesid = {$Car} and year='" . $Year . "'";
            $model = DBUtil::queryAll($sql);
        }
        foreach ($model as $key => $value) {
            $rs[$key]['Model'] = $value['modelid'];
            $rs[$key]['Modeltxt'] = $value['name'] . '(' . $value['alias'] . ')';
            $rs[$key]['Year'] = $value['year'];
            $rs[$key]['Make'] = $value['makeid'];
            $rs[$key]['Car'] = $value['seriesid'];
        }
        echo json_encode($rs);
    }

//    /*
//     * 添加适用车系
//     */
//
//    public function actionAddyearmodel() {
//        if ($_GET['Year'] == 'ALL') {
//            $makeid = $_GET['Make'];
//            $seriesid = $_GET['Car'];
//            $OrganID = $add['OrganID'] = Commonmodel::getOrganID();
//            $model = GoodsModel::model()->findAll("makeid= '$makeid' and seriesid='$seriesid'");
//            if ($_GET['GoodsID']) {
//                $model1 = DealerGoodsVehicleRelation::model()->findAll("Car='$seriesid' and OrganID='$OrganID' and (GoodsID = '$_GET[GoodsID]' or GoodsID = 0)");
//            } else {
//                $model1 = DealerGoodsVehicleRelation::model()->findAll("Car='$seriesid' and OrganID='$OrganID' and GoodsID = 0");
//            }
//            $list = array();
//            foreach ($model1 as $k => $v) {
//                $list[$k] .= $v['Year'];
//                $list[$k] .= $v['Model'];
//            }
//            foreach ($model as $value) {
//                $model = new DealerGoodsVehicleRelation();
//                $OrganID = $add['OrganID'] = Commonmodel::getOrganID();
//                $add['GoodsID'] = 0;
//                $Make = $add['Make'] = $_GET['Make'];
//                $Car = $add['Car'] = $_GET['Car'];
//                $add['Marktxt'] = $_GET['Maketxt'];
//                $add['Cartxt'] = $_GET['Cartxt'];
//                $Year = $add['Year'] = $value['year'];
//                $Model = $add['Model'] = $value['modelid'];
//                if ($value['alias']) {
//                    $add['Modeltxt'] = $value['name'] . '(' . $value['alias'] . ')';
//                } else {
//                    $add['Modeltxt'] = $value['name'];
//                }
//                $aa = $Year . $Model;
//                if ($list) {
//                    if (!in_array($aa, $list)) {
//                        $model->attributes = $add;
//                        $bool = $model->save();
//                    }
//                } else {
//                    $model->attributes = $add;
//                    $bool = $model->save();
//                }
//            }
//        } else if ($_GET['Model'] == 'ALL') {
//            $OrganID = $add['OrganID'] = Commonmodel::getOrganID();
//            $makeid = $_GET['Make'];
//            $seriesid = $_GET['Car'];
//            $year = $_GET['Year'];
//            $add['Year'] = $year;
//            $model = GoodsModel::model()->findAll("makeid= '$makeid' and seriesid='$seriesid'and year='$year'");
//            if ($_GET['GoodsID']) {
//                $GoodsID = $_GET['GoodsID'];
//                $model1 = DealerGoodsVehicleRelation::model()->findAll("Car='$seriesid' and OrganID='$OrganID' and (GoodsID = '$GoodsID' or GoodsID = 0)");
//            } else {
//                $model1 = DealerGoodsVehicleRelation::model()->findAll("Car='$seriesid' and OrganID='$OrganID' and GoodsID = 0");
//            }
//            $list = array();
//            foreach ($model1 as $k => $v) {
//                $list[$k] .= $v['Year'];
//                $list[$k] .= $v['Model'];
//            }
//            foreach ($model as $value) {
//                $model = new DealerGoodsVehicleRelation();
//                $add['OrganID'] = Commonmodel::getOrganID();
//                $add['GoodsID'] = 0;
//                $add['Make'] = $_GET['Make'];
//                $add['Car'] = $_GET['Car'];
//                $add['Marktxt'] = $_GET['Maketxt'];
//                $add['Cartxt'] = $_GET['Cartxt'];
//                $Year = $add['Year'] = $value['year'];
//                $Model = $add['Model'] = $value['modelid'];
//                if ($value['alias']) {
//                    $add['Modeltxt'] = $value['name'] . '(' . $value['alias'] . ')';
//                } else {
//                    $add['Modeltxt'] = $value['name'];
//                }
//                $aa = $Year . $Model;
//                if ($list) {
//                    if (!in_array($aa, $list)) {
//                        $model->attributes = $add;
//                        $bool = $model->save();
//                    }
//                } else {
//                    $model->attributes = $add;
//                    $bool = $model->save();
//                }
//            }
//        } else {
//            $OrganID = $add['OrganID'] = Commonmodel::getOrganID();
//            $add['GoodsID'] = 0;
//            $Make = $add['Make'] = $_GET['Make'];
//            $Car = $add['Car'] = $_GET['Car'];
//            $add['Marktxt'] = $_GET['Maketxt'];
//            $add['Cartxt'] = $_GET['Cartxt'];
//            $Year = $add['Year'] = $_GET['Year'];
//            $Model = $add['Model'] = $_GET['Model'];
//            $add['Modeltxt'] = $_GET['Modeltxt'];
//            if ($_GET['GoodsID']) {
//                $aa = DealerGoodsVehicleRelation::model()->findAll("OrganID = '$OrganID' and Make = '$Make' and Car = '$Car' and Year = '$Year' and Model = '$Model' and (GoodsID = '$_GET[GoodsID]' or GoodsID = 0)");
//            } else {
//                $aa = DealerGoodsVehicleRelation::model()->findAll("OrganID = '$OrganID' and Make = '$Make' and Car = '$Car' and Year = '$Year' and Model = '$Model' and GoodsID = 0");
//            }
//            if (!$aa) {
//                $model = new DealerGoodsVehicleRelation();
//                $model->attributes = $add;
//                $bool = $model->save();
//            }
//        }
//        if ($bool) {
//            $rs = array('success' => 1, 'errorMsg' => '添加成功', 'id' => $ID);
//        } else {
//            $rs = array('success' => 0, 'errorMsg' => '添加失败,该车系可能已经添加');
//        }
//        echo json_encode($rs);
//    }

    /*
     * 删除没被保存的适用车系
     */

    public function actionDelyearmodel() {
        $organID = Commonmodel::getOrganID();
        $sql = "delete from tbl_dealer_goods_vehicle_relation  where OrganID = {$organID} and GoodsID = 0";
        $b = DBUtil::execute($sql);
        echo json_encode($b);
    }

    public function actionUpdate() {
        $organID = Commonmodel::getOrganID();
        $userID = Yii::app()->user->id;
        $goodsID = $_GET['id'];
        if ($_POST) {
            $data['Name'] = trim($_POST['Name']);
            if (trim($_POST['Pinyin']) == "") {
                $pinyin = F::Pinyin1($_POST['Name']); // 如果未输入拼音则自动添加拼音
            } else {
                $pinyin = trim($_POST['Pinyin']);
            }
            $data['Pinyin'] = $pinyin;
            $data['GoodsNO'] = trim($_POST['GoodsNO']);
            if (!empty($_POST['OENOS'][0])) {
                $data['OENO'] = $_POST['OENOS'][0];
            }
            $data['PartsLevel'] = trim($_POST['PartsLevel']);
            $data['Memo'] = trim($_POST['Memo']);
            $data['Price'] = trim($_POST['Price']);
            $data['Unit'] = trim($_POST['Unit']);
            $LogisticsPrice = trim($_POST['LogisticsPrice']);
            if (empty($LogisticsPrice)) {
                $data['LogisticsPrice'] = 0;
            } else {
                $data['LogisticsPrice'] = $LogisticsPrice;
            }
            if (empty($_POST['goodsBrand'])) {
                $data['BrandID'] = trim($_POST['goodsBrand']);      // id
                $data['Brand'] = '';           // 名称
            } else if (!empty($_POST['goodsBrand'])) {
                $data['BrandID'] = trim($_POST['goodsBrand']);      // id
                $data['Brand'] = trim($_POST['brandID']);           // 名称
            }
//            if (!empty($_POST['leafCategory'])) {
//                $data['BigParts'] = $_POST['mainCategory'];         // 配件大类
//                $data['SubParts'] = $_POST['subCategory'];          // 配件子类
//                $data['CpName'] = $_POST['leafCategory'];           // 标准名称
            $data['CpNameTxt'] = $_POST['CpNameTxt'];           // 标准名称
            $goodsspec['JiapartsNO'] = $data['BrandID']; // 加配号
//            }
//            if (!empty($_POST['IsUpSale'])) {
            $data['IsSale'] = $_POST['IsUpSale'];
//            }
            // $model = new DealerGoods();
            $model = DealerGoods::model()->findByPk($goodsID);
            // var_dump($data);exit;
            $model->attributes = $data;
            $oenos = $_POST['OENOS'] ? $_POST['OENOS'] : $_POST['OENO'];
            if ($oenos) {
                foreach ($oenos as $value) {
                    $oe .=$value;
                }
            }else{
                $oe ='';
            }
            $make_hidden = explode(',', $_POST["make_hidden"]);
            $make_hidden = array_unique($make_hidden);
            $make_hidden = array_filter($make_hidden);
            $make_hidden = implode(',', $make_hidden);
            $model->Title = $data['Name'] . ' ' . $pinyin . ' ' . $data['Brand'] . ' ' . $oe . ' ' . $make_hidden;
            // $model->CreateTime = time();
            $model->UpdateTime = time();
            if ($this->Isexist($data['GoodsNO'], $goodsID)) {  // 修改
                if ($model->save()) {
                    $make = explode(',', $_POST["make"]);
                    $car = explode(',', $_POST["car"]);
                    $year = explode(',', $_POST["year"]);
                    $model2 = explode(',', $_POST["model"]);
                    $maketext = explode(',', $_POST["maketxt"]);
                    $cartext = explode(',', $_POST["cartxt"]);
                    $modeltext = explode(',', $_POST["modeltxt"]);
                    // 把主营车系添加到商品车系关系表
                    $vehlegth = count($make);
                    for ($i = 0; $i < $vehlegth; $i++) {
                        if ($make[$i] != 0) {
                            $goodsv = new DealerGoodsVehicleRelation();    // 车型车系
                            $goodsv->OrganID = $organID;
                            $goodsv->GoodsID = $goodsID;
                            $goodsv->Make = $make[$i];
                            $goodsv->Car = $car[$i];
                            $goodsv->Year = $year[$i];
                            $goodsv->Model = $model2[$i];
                            $goodsv->Marktxt = $maketext[$i];
                            $goodsv->Cartxt = $cartext[$i];
                            $goodsv->Modeltxt = $modeltext[$i];
                            $goodsv->save();
                        }
                    }
                    $sql = "update tbl_dealer_goods_vehicle_relation set GoodsID = {$goodsID} where OrganID = {$organID} and GoodsID = 0";
                    $b = DBUtil::execute($sql);

                    // 把OENO号添加到关系表里
                    $oenos = $_POST['OENOS'];
                    $oelegth = count($oenos);
                    DealerGoodsOenoRelation::model()->deleteAll("OrganID= '$organID' and GoodsID='$goodsID'");
                    for ($i = 0; $i < $oelegth; $i++) {
                        $goodsoeno = new DealerGoodsOenoRelation();     // OE号关系表
                        $goodsoeno->OrganID = $organID;
                        $goodsoeno->GoodsID = $goodsID;
                        $goodsoeno->OENO = $oenos[$i];
                        $goodsoeno->save();
                    }
                    // 添加商品图片
//                    $goodsImages = $_POST['goodsImages'];
//                    $imglegth = count($goodsImages);
//                    for ($i = 0; $i < $imglegth; $i++) {
//                        $goodsImg = new DealerGoodsImageRelation();
//                        $goodsImg->GoodsID = $goodsID;
//                        $goodsImg->OrganID = $organID;
//                        $goodsImg->ImageUrl = $goodsImages[$i];
//                        $goodsImg->save();
//                    }
                    $urlimg = explode(',', $_POST['urlimg']); //根据逗号拆分，得到图片信息的字符串
                    $sqlimg = "insert into tbl_dealer_goods_image_relation (OrganID,GoodsID,ImageUrl,CreateTime,ImageName) values";
                    foreach ($urlimg as $k => $value) {
                        if ($value) {//去掉初始值0
                            $addimg = explode(';', $value); //根据分号拆分，得到图片的相关信息
                            if ($k != 1) {
                                $sqlimg .=",";
                            }
                            $sqlimg .="(";
                            $sqlimg .=$organID;
                            $sqlimg .=",";
                            $sqlimg .=$goodsID; //商品ID
                            $sqlimg .=",'";
                            $sqlimg .=$addimg[0]; //图片url
                            $sqlimg .="',";
                            $sqlimg .=time();
                            $sqlimg .=",'";
                            $sqlimg .=$addimg[1]; //图片原名
                            $sqlimg .="')";
                        }
                    }
                    DBUtil::execute($sqlimg);

                    // 添加商品属性
                    if ($goodsImages) {
                        $goodsspec['ImageUrl'] = $goodsImages[0];
                    }
                    if ($_POST['detcImages']) {
                        $goodsspec['DetectionImg'] = $_POST['detcImages'];
                    }
                    // 添加商品属性
                    $goodsspec['Weight'] = $_POST['Weight'];    // 重量
                    $goodsspec['Length'] = $_POST['Length'];    // 长
                    $goodsspec['Wide'] = $_POST['Wide'];        // 宽
                    $goodsspec['Height'] = $_POST['Height'];    // 高
                    $goodsspec['Volume'] = $_POST['Volume'];    //体积
                    $goodsspec['ValidityType'] = $_POST['ValidityType']; // 保质期类型
                    $goodsspec['ValidityDate'] = $_POST['ValidityDate']; // 保质期
                    $goodsspec['BganCompany'] = $_POST['BganCompany']; // 标杆公司
                    $goodsspec['BganGoodsNO'] = $_POST['BganGoodsNO']; // 标杆商品号
                    $goodsspec['Specifica'] = $_POST['Specifica'];  // 规格
                    $goodsspec['PartsNO'] = $_POST['PartsNO'];      // 配件类别
                    $goodsspec['Unit'] = trim($_POST['Unit']);

                    $psid = DealerGoodsSpec::model()->find("GoodsID=$goodsID")->attributes['ID'];
                    $goodssp = DealerGoodsSpec::model()->findByPk($psid);
                    if (empty($psid)) {
                        $goodssp = new DealerGoodsSpec();
                    }
                    $goodssp->attributes = $goodsspec;
                    $goodssp->GoodsID = $goodsID;
                    $goodssp->save();

                    // 添加商品包装
                    $goodspack['MinQuantity'] = $_POST['MinQuantity'];    //
                    $goodspack['Weight'] = $_POST['pWeight'];    //
                    $goodspack['Volume'] = $_POST['pVolume'];    //

                    $pcid = DealerGoodsPack::model()->find("GoodsID=$goodsID")->attributes['ID'];
                    $goodspc = DealerGoodsPack::model()->findByPk($pcid);
                    if (empty($pcid)) {
                        $goodspc = new DealerGoodsPack();
                    }
                    $goodspc->attributes = $goodspack;
                    $goodspc->GoodsID = $goodsID;
                    $goodspc->save();
//                $bool2 = DealerGoodsPack::model()->updateAll(array(
//                    'MinQuantity' => $goodspack['MinQuantity'],
//                    'Weight' => $goodspack['Weight'],
//                    'Volume' => $goodspack['Volume'],
//                        ), "GoodsID=" . $goodsID);
                    $rs = array('success' => 1, 'errorMsg' => '修改数据成功');
                } else {
                    $rs = array('success' => 0, 'errorMsg' => '修改数据失败');
                }
            } else {
                $rs = array('success' => 0, 'errorMsg' => '商品编号已存在，请修改！');
            }
        }
        echo json_encode($rs);
    }

    /**
     * 获取商品
     */
    public function actionGetgoods() {
        $organID = Commonmodel::getOrganID();
        $rows = $_GET['rows'] == '' ? 10 : $_GET['rows'];          // 一页显示多少条
        $page = $_GET['page'] == '' ? 1 : $_GET['page'];           // 第几页
        $IsSale = $_GET['IsSale'] == '' ? 'all' : $_GET['IsSale'];  // 是否上架
        $goodsNO = trim($_GET['goodsNO']);                                // 商品编号
        $goodsName = trim($_GET['goodsName']);                            // 商品名称
        $OENO = trim($_GET['OENO']);                                      // OE号
        $gbigparts = $_GET['gbigparts'];                            // 大类
        $gsubparts = $_GET['gsubparts'];                            // 子类
        $gcpname = $_GET['gcpname'];                                // 标准名称
        $gcpnametxt = $_GET['gcpnametxt'];                          // 标准名称txt
        $gmake = $_GET['gmake'];                                    // 厂家
        $gcar = $_GET['gcar'];                                      // 车系
        $gyear = $_GET['gyear'];                                    // 年款
        $gmodel = $_GET['gmodel'];                                   // 车型

        $params = array(
            'OrganID' => $organID,
            'page' => $page,
            'rows' => $rows,
            'goodsNO' => $goodsNO,
            'goodsName' => $goodsName,
            'OENO' => $OENO,
            'IsSale' => $IsSale,
            'gbigparts' => $gbigparts,
            'gsubparts' => $gsubparts,
            'gcpname' => $gcpname,
            'gcpnametxt' => $gcpnametxt == "选择标准名称" ? '' : $gcpnametxt,
            'gmake' => $gmake,
            'gcar' => $gcar,
            'gyear' => $gyear,
            'gmodel' => $gmodel,
        );
        $data = DealerGoods::getGoodsInfo($params);
        $rs['total'] = $data[0]['count'];
        $rs['rows'] = $data[0]['count'] == 0 ? array() : $data; // $record;
        echo json_encode($rs);
    }

    /**
     * 删除商品
     */
    public function actionDelete() {
        $organID = Commonmodel::getOrganID();
        $id = $_POST['id'];
        $bool = DealerGoods::model()->updateAll(array('ISdelete' => 0, 'UpdateTime' => time()), "ID in (" . $id . ")");
//        if ($bool) {
//            $rs = array('success' => 1, 'errorMsg' => '上架成功');
//        } else {
//            $rs = array('success' => 0, 'errorMsg' => '上架失败');
//        }
//        $bool = DealerGoods::model()->updateByPk($id, array(
//            'ISdelete' => 0,
//            'UpdateTime' => time()
//                ));
        if ($bool) {
            DealerGoodsImageRelation::model()->deleteAll("OrganID= '$organID' and GoodsID='$id'");
            $result = array('success' => 1, 'errorMsg' => '删除成功！');
        } else {
            $result = array('success' => 0, 'errorMsg' => '删除失败！');
        }
        echo json_encode($result);
    }

    /**
     * 批量上传商品
     */
    public function actionRecomupload() {
        $this->pageTitle = Yii::app()->name . '-' . "商品管理";
        //文件模板为product
        $template = "dealergoods";
        $userID = Yii::app()->user->id;
        $organID = Commonmodel::getOrganID();
        //上传文件
        if ($_POST['leadExcel'] == "true") {
            $filename = iconv("utf-8", "gb2312", $_FILES['inputExcel']['name']);
            $tmp_name = $_FILES['inputExcel']['tmp_name'];
            //$filePath = dirname(Yii::app()->BasePath) . "/themes/default/uploadsfile/dealer/execl/";
            $filePath = Yii::app()->params['uploadPath'] . 'dealer/execl/';
            $upload_result = UploadsFile::uploadFile($filename, $tmp_name, $filePath);
            //如果上传成，则解析Excel文件
            if ($upload_result['success']) {
                //解析Excel文件，返回结果为错误消息，如果不为空则表明发生错误
                $uploadfile = $upload_result['uploadfile'];
                $dataImport = new GoodsImport();
                $createtime = time();
                $data = array(
                    'OrganID' => $organID,
                    'UserID' => $userID,
                    'CreateTime' => $createtime,
                );
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
                } else { // 上传成功，则把上传成功的数据展示出来
                    // 把数据分拆出来，添加到其他表 、DealerParts  、DealerPromotionCpname
                    // $message = Yii::app()->db->getLastInsertID();
                    $lastID = Yii::app()->db->getLastInsertID();
                    $newsgoods = DealerGoods::model()->findAll("ID >= $lastID");
                    foreach ($newsgoods as $value) {
                        $goodsspec = new DealerGoodsSpec();
                        $goodsspec->GoodsID = $value['ID'];
                        $goodsspec->save();
                        $goodspack = new DealerGoodsPack();
                        $goodspack->GoodsID = $value['ID'];
                        $goodspack->save();

                        $goodsoe = new DealerGoodsOenoRelation();
                        $goodsoe->GoodsID = $value['ID'];
                        $goodsoe->OENO = $value['OENO'];
                        $goodsoe->OrganID = $organID;
                        $goodsoe->save();
                    }
                    $this->redirect(array('index', 'message' => $booc, 'success' => TRUE));
                }
            } else {
                $message = $upload_result['error'];
                $this->render('index', array('message' => $message));
            }
        }
    }

    /**
     * 获取系统类别
     */
    private function getsystem($cpname) {
        $system = GoodsStandard::model()->find("cp_name like '%{$cpname}%'");
        return $system['system_type'];
    }

    /*
     * 获取主营品牌
     */

    public function actionGetbrand() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->condition = "OrganID = " . $organID;
        $count = DealerBrand::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);

        $brands = DealerBrand::model()->findAll($criteria);
        // $brands = DealerBrand::model()->findAll("OrganID = $organID");
        //  $count = count($brands);
        $data = array();
        foreach ($brands as $key => $brand) {
            $data[$key]['ID'] = $brand['ID'];
            $data[$key]['brandname'] = $brand['BrandName'];
            $data[$key]['BrandName'] = $brand['BrandName'];
            $data[$key]['Pinyin'] = $brand['Pinyin'];
            $data[$key]['description'] = $brand['description'];
            $data[$key]['goodsCount'] = $this->getBrandgoodsCount($organID, $brand['ID']);
        }
        $rs = array('total' => $count, 'rows' => $data);
        echo json_encode($rs);
    }

    /**
     *  上架
     */
    public function actionUpsale() {
        $id = $_POST['id'];
        $bool = DealerGoods::model()->updateAll(array('IsSale' => 1, 'UpdateTime' => time()), "ID in (" . $id . ")");
        if ($bool) {
            $rs = array('success' => 1, 'errorMsg' => '上架成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '上架失败');
        }
        echo json_encode($rs);
    }

    /**
     *  下架
     */
    public function actionDownsale() {
        $id = $_POST['id'];
//        $bool = DealerGoods::model()->updateByPk(array($id), array('IsSale' => 0, 'UpdateTime' => time()));
        $bool = DealerGoods::model()->updateAll(array('IsSale' => 0, 'UpdateTime' => time()), "ID in (" . $id . ")");
        if ($bool) {
            $rs = array('success' => 1, 'errorMsg' => '下架成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '下架失败');
        }
        echo json_encode($rs);
    }

    /**
     * 通过商品ID获取车系车型
     */
    public function actionGetvehbygoodsid() {
        $goodID = $_GET['id'];
        $sql = "select * from tbl_dealer_goods_vehicle_relation where GoodsID = " . $goodID;
        $vehs = DBUtil::queryAll($sql);
        $car = array();
        $list = array();
        $k = 0;
        if (!empty($vehs)) {
            foreach ($vehs as $vehicle) {
                //$aa =$vehicle['Cartxt'].$vehicle['Marktxt'];
                $bb = $vehicle['Marktxt'] . '-' . $vehicle['Cartxt'];
                if (!in_array($bb, $list)) {
                    $car[$bb]['ID'] = $vehicle['ID'];
                    $car[$bb]['ModelID'] = $vehicle['Model'];
                    $car[$bb]['CarID'] = $vehicle['Car'];
                    $car[$bb]['Make'] = $vehicle['Marktxt'];
                    $car[$bb]['Car'] = $vehicle['Cartxt']; // == 0 ? '' : $vehicle['Cartxt'];
                    $car[$bb]['year'] = $vehicle['Year'] == 0 ? '' : $vehicle['Year'];
                    $car[$bb]['Model'] = $vehicle['Modeltxt'] == 0 ? '' : $vehicle['Modeltxt'];
                    $car[$bb]['Carlist'][$k]['ID'] = $vehicle['ID'];
                    $car[$bb]['Carlist'][$k]['Year'] = $vehicle['Year'] ? $vehicle['Year'] : '';
                    $car[$bb]['Carlist'][$k]['Modeltxt'] = $vehicle['Modeltxt'] ? $vehicle['Modeltxt'] : '';
                    // $car[$bb]['Carlist'][] = $vehicle['Marktxt'] . '-' . $vehicle['Cartxt'];
//                    var_dump($car[$k]['Carlist']);
//                    var_dump($this->Getyearmodel($vehicle['Car']));
                    $list[] = $bb;
                    $k++;
                } else {
                    //  $car[$bb]['Carlist'][] = $vehicle['Marktxt'] . '-' . $vehicle['Cartxt'];
                    $car[$bb]['Carlist'][$k]['ID'] = $vehicle['ID'];
                    $car[$bb]['Carlist'][$k]['Year'] = $vehicle['Year'] ? $vehicle['Year'] : '';
                    $car[$bb]['Carlist'][$k]['Modeltxt'] = $vehicle['Modeltxt'] ? $vehicle['Modeltxt'] : '';
                    $k++;
                }
            }
        }
        //   print_r($car);
        echo json_encode($car);
//        $vehs = DealerGoodsVehicleRelation::model()->findAll("GoodsID = " . $goodID);
//        $car = array();
//        $list=array();
//        $k=0;
//        if (!empty($vehs)) {
//            foreach ($vehs as  $vehicle) {
//                $aa =$vehicle['Cartxt'].$vehicle['Marktxt'];
//                if(!in_array($aa,$list)){
//                    $car[$k]['ID'] = $vehicle['ID'];
//                    $car[$k]['ModelID'] = $vehicle['Model'];
//                    $car[$k]['CarID'] = $vehicle['Car'];
//                    $car[$k]['Make'] = $vehicle['Marktxt'];
//                    $car[$k]['Car'] = $vehicle['Cartxt'];// == 0 ? '' : $vehicle['Cartxt'];
//                    $car[$k]['year'] = $vehicle['Year'] == 0 ? '' : $vehicle['Year'];
//                    $car[$k]['Model'] = $vehicle['Modeltxt'] == 0 ? '' : $vehicle['Modeltxt'];
//                    $car[$k]['Carlist'] = $this->Getyearmodel($vehicle['Car']);
////                    var_dump($car[$k]['Carlist']);
////                    var_dump($this->Getyearmodel($vehicle['Car']));
//                    $list[]=$aa;
//                    $k++;
//                }
//               
//            }
//        }
//        var_dump($car);exit;
        //  echo json_encode($car);
    }

    /*
     * 获取适用车系
     */

    public function Getyearmodel($carID) {
        $organID = Commonmodel::getOrganID();
        $Car = $carID;
        $model = DealerGoodsVehicleRelation::model()->findAll("OrganID= '$organID' and Car='$Car'");
        $rs = array();
        foreach ($model as $key => $value) {
            $rs[$key]['ID'] = $value['ID'];
            $rs[$key]['Year'] = $value['Year'] ? $value['Year'] : '';
            $rs[$key]['Model'] = $value['Model'] ? $value['Model'] : '';
            $rs[$key]['Modeltxt'] = $value['Modeltxt'] ? $value['Modeltxt'] : '';
        }
        return $rs;
    }

    public function actiongetoenobygoodsid() {
        $goodID = $_GET['id'];
        //   $OENOs = DealerGoodsOenoRelation::model()->findAll("GoodsID = " . $goodID);
        $sql = "select * from tbl_dealer_goods_oeno_relation where GoodsID =" . $goodID;
        $OENOs = DBUtil::queryAll($sql);
        if (!empty($OENOs)) {
            foreach ($OENOs as $key => $showOENO) {
                $OENO[$key]['ID'] = $showOENO['ID'];
                $OENO[$key]['OENO'] = $showOENO['OENO'];
            }
        }
        echo json_encode($OENO);
    }

    public function actiongetimgbygoodsid() {
        $goodID = $_GET['id'];
        // $images = DealerGoodsImageRelation::model()->findAll("GoodsID = " . $goodID);
        $sql = "select * from tbl_dealer_goods_image_relation where GoodsID =" . $goodID;
        $images = DBUtil::queryAll($sql);
        $img = array();
        if (!empty($images)) {
            foreach ($images as $key => $showimg) {
                $img[$key]['ID'] = $showimg['ID'];
                $img[$key]['ImageUrl'] = $showimg['ImageUrl'];
            }
        }
        echo json_encode($img);
    }

    /*
     * 删除主营品类
     */

    public function actiondeletecpname() {
        $cateid = $_GET['ID'];
        $model = DealerCpname::model()->findByPk($cateid)->delete();
        echo json_decode($model);
    }

    /**
     * 删除促销商品中的品类
     */
    public function actionDeletepromcpname() {
        $cateid = $_GET['cpnid'];
        $model = DealerPromotionCpname::model()->findByPk($cateid)->delete();
        echo json_decode($model);
    }

    /*
     * 删除车系
     */

    public function actionDeletevehicle() {
        $cateid = $_GET['cateid'];
        $model = DealerVehicle::model()->findByPk($cateid)->delete();
        echo json_decode($model);
    }

    /*
     * 删除促销商品中的车系
     */

    public function actionDeletecar() {

        $Car = $_GET['cateid'];
        $organID = Commonmodel::getOrganID();

        $model = DealerGoodsVehicleRelation::model()->deleteAll("OrganID= '$organID' and Car='$Car'");
//        $sql = "delete from tbl_dealer_goods_vehicle_relation where Car = {$cateid}' and OrganID = {$organID} ";
//        $bools = DBUtil::execute($sql);
        if ($model) {
            $model = 1;
        }
        echo json_encode($model);
    }

    /*
     * 删除促销商品中的车系
     */

    public function actionDeletepromvehicle() {

        $cateid = $_GET['cateid'];
        $model = DealerGoodsVehicleRelation::model()->findByPk($cateid)->delete();
        echo json_decode($model);
    }

    public function actionDeletegoodsoeno() {
        $cateid = $_GET['cateid'];
        $model = DealerGoodsOenoRelation::model()->findByPk($cateid)->delete();
        echo json_decode($model);
    }

    /**
     * 获取拼音代码
     */
    public function actionGetpinyin() {
        $name = $_GET['name'];
        $pinyin = F::pinyin1($name);
        if ($pinyin) {
            echo json_encode($pinyin);
        } else {
            echo '';
        }
    }

    /**
     *  检索品牌
     */
    public function actionSearchbrand() {
        $brand = $_GET['brand'];
        $brands = ApproveBrand::model()->findAll("BrandName like '%{$brand}%' or Pinyin like '%{$brand}%'"); // 
        $data = array();
        foreach ($brands as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['BrandName'] = $value['BrandName'];
            $data[$key]['Pinyin'] = $value['Pinyin'];
            $data[$key]['description'] = $value['description'];
        }
        echo json_encode($data);
    }

    /**
     * 添加品牌
     */
    public function actionAddbrand() {
        $userID = Yii::app()->user->id;
        $organID = Commonmodel::getOrganID();
        $brandName = trim($_POST['BrandName']);
        $Pinyin = trim($_POST['Pinyin']);
        $desc = trim($_POST['description']);
        $isexsit = DealerBrand::model()->find("BrandName = '{$brandName}' and OrganID= $organID ");
        if ($isexsit) {
            echo json_encode(array('success' => 0, 'errorMsg' => $brandName . '品牌已存在'));
            exit;
        }
        $brand = new DealerBrand();
        $brand->BrandName = $brandName;
        $brand->Pinyin = $Pinyin;
        $brand->description = $desc;
        $brand->OrganID = $organID;
        $brand->CreateTime = time();
        $brand->UserID = $userID;
        if ($brand->save()) {
            $rs = array('success' => 1, 'errorMsg' => '保存数据成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '保存数据失败');
        }
        echo json_encode($rs);
    }

    /**
     * 修改品牌
     */
    public function actionUpdatebrand() {
        $organID = Commonmodel::getOrganID();
        $brandID = $_GET['id'];
        $brandName = trim($_POST['BrandName']);
        $Pinyin = trim($_POST['Pinyin']);
        $desc = trim($_POST['description']);
        $isexsit = DealerBrand::model()->find(" ID != $brandID and BrandName = '{$brandName}' and OrganID= $organID");
        if ($isexsit) {
            echo json_encode(array('success' => 0, 'errorMsg' => '品牌已存在'));
            exit;
        }
        $bool = DealerBrand::model()->updateByPk($brandID, array(
            'BrandName' => $brandName,
            'Pinyin' => $Pinyin,
            'description' => $desc,
            'UpdateTime' => time()
                ));



        if ($bool) {

            $update['Brand'] = $brandName;
//             updateAll(array('username'=>'11111','password'=>'11111'),'password=:pass',array(':pass'=>
            //echo $$organID.'  '.$brandID;
            DealerGoods::model()->updateAll($update, 'BrandID=' . $brandID . ' and OrganID=' . $organID);
            $rs = array('success' => 1, 'errorMsg' => '保存数据成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '保存数据失败');
        }
        echo json_encode($rs);
    }

    /**
     * 删除品牌
     */
    public function actionDeletebrand() {
        $brandID = $_POST['id'];
        $bool = DealerBrand::model()->deleteByPk($brandID);
        if ($bool) {
            $rs = array('success' => 1, 'errorMsg' => '删除数据成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '删除数据失败');
        }
        echo json_encode($rs);
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
        $sql = "delete from tbl_dealer_goods_image_relation where ImageUrl= '$imageName' ";
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
     * 删除检测图片
     */
    public function actionDeleteimgdetc() {
        $imageName = $_GET['xximage'];
        $goodsID = $_GET['tag'];
        $targetFile = Yii::app()->params['uploadPath'] . $imageName;
        // $sql = "delete from tbl_dealer_goods_image_relation where ImageUrl= '$imageName' ";
        $sql = "UPDATE tbl_dealer_goods_spec SET DetectionImg = '' WHERE GoodsID = $goodsID ";
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

    private function upImage($upfile) {
        $organID = Commonmodel::getOrganID();
        $DetectionImg = $upfile;
        if (!empty($DetectionImg['name'])) {
            $fileDir = "dealer/" . $organID . '/';
            $filePath = Yii::app()->params['uploadPath'] . $fileDir;
            if (!file_exists($filePath)) {
                mk_dir($filePath, '777', true);
            }
//            $tp = array("image/gif", "image/pjpeg", "image/jpeg", "image/png");
//            //检查上传文件是否在允许上传的类型
//            if (!in_array($DetectionImg["type"], $tp)) {
//                $message = '对不起,您上传图片的格式不正确';
//            }
            if ($DetectionImg["size"] > 1024 * 1024 * 2) {
                $message = '对不起,您上传图片的太大!!';
            }if ($message) {
                $rs = array('success' => 0, 'errorMsg' => $message);
                echo json_encode($rs);
                exit;
            }
            $imageName = $fileDir . UploadsFile::uploadImage($DetectionImg, $DetectionImg['name'], $DetectionImg['tmp_name'], $filePath);
        }

        return $imageName;
    }

    /**
     * 获取品牌对应下的商品数量
     */
    private function getBrandgoodsCount($organID, $brandID) {
        $goodsCount = DealerGoods::model()->count(array('condition' => "OrganID = $organID and BrandID =$brandID and ISdelete = 1"));
        return $goodsCount;
    }

    /**
     * 修改促销状态
     */
    public function actionUpdateprosatus() {
        $Times = time() - 24 * 60 * 60 * 7 * 2;
        $count = DealerGoods::model()->updateAll(array(
            'IsPro' => 0,
            'UpdateTime' => time(),
            'ProTime' => '',
            'ProPrice' => NULL,
                ), "ProTime < $Times");
        if ($count) {
            echo $count;
        }
    }

    /**
     * 判断商品编号是否存在
     */
    private function Isexist($goodsNo, $id = 0) {
        $organID = Commonmodel::getOrganID();
        if ($id == 0) { // 添加
            $model = DealerGoods::model()->findAll("GoodsNO= '{$goodsNo}' and OrganID= $organID");
            if (count($model) > 0) {   // 大于0 则已存在
                return false;
            } else {                  // 可以添加
                return true;
            }
        } else {    // 修改
            $model = DealerGoods::model()->findAll("ID !=" . $id . " AND GoodsNO='{$goodsNo}' and OrganID= $organID");
            if (count($model) > 0) {   // 大于0 则已存在
                return false;
            } else {                  // 可以添加
                return true;
            }
        }
    }

    public function actionChangename() {
        $goodsID = Yii::app()->request->getParam('goodsID');
        $sql = "select ID as id,Name as name,GoodsNO as goodsno from {{dealer_goods}} where ID in (" . $goodsID . ")";
        $data = DBUtil::queryAll($sql);
        echo json_encode($data);
    }

    //添加图片
    public function actionAddimg() {
        $urlimg = explode(',', $_GET['urlimg']); //根据逗号拆分，得到图片信息的字符串
        $organID = Commonmodel::getOrganID();
        $sql = "insert into tbl_dealer_goods_image_relation (OrganID,GoodsID,ImageUrl,CreateTime,ImageName) values";
        foreach ($urlimg as $k => $value) {
            if ($value) {//去掉初始值0
                $addimg = explode(';', $value); //根据分号拆分，得到图片的相关信息
                if ($k != 1) {
                    $sql .=",";
                }
                $sql .="(";
                $sql .=$organID;
                $sql .=",";
                $sql .=$addimg[1]; //商品ID
                $sql .=",'";
                $sql .=$addimg[0]; //图片url
                $sql .="',";
                $sql .=time();
                $sql .=",'";
                $sql .=$addimg[2]; //图片原名
                $sql .="')";
            }
        }
        if (DBUtil::execute($sql)) {
            $rs = array('success' => 1, 'errorMsg' => '图片上传成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '图片上传失败');
        }
        echo json_encode($rs);
    }

    //查询已添加的图片地址
    public function actionGeturl() {
        $organID = Commonmodel::getOrganID();
        $GoodsID = $_GET['GoodsID'];
        $sql = "select ImageUrl,ImageName from tbl_dealer_goods_image_relation where OrganID=" . $organID . " and GoodsID=" . $GoodsID;
//         $data = DBUtil::queryAll($sql);
        $data = DBUtil::queryAll($sql) ? DBUtil::queryAll($sql) : 0;
        echo json_encode($data);
        ;
    }

    //查询添加的图片商品ID Name
    public function actionGetID() {
        $organID = Commonmodel::getOrganID();
        $aa = explode('#', $_GET['Name']);
        $GoodsNO = $aa[0];
        $sql = "select ID as GoodsID,Name as GoodsName,GoodsNO from {{dealer_goods}} where OrganID=" . $organID . " and GoodsNO='" . $GoodsNO . "'";
        $data = DBUtil::query($sql);
        echo json_encode($data);
        ;
    }

    public function actionDelImgGoods() {
        $organID = Commonmodel::getOrganID();
        $GoodsID = $_GET['goodsid'];
//         $sql = "delete from tbl_dealer_goods_image_relation  where OrganID = ".$organID." and GoodsID =".$GoodsID;
        $model = DealerGoodsImageRelation::model()->deleteAll("OrganID= '$organID' and GoodsID='$GoodsID'");
        if ($model) {
            $model = 1;
        }
        echo json_encode($model);
    }

}

?>
