<?php

class DealergoodsService {
    /*
     * 获取促销商品
     */

    public static function getPromoGoods($params) {
        $criteria = new CDbCriteria();
        $Vehicle = $params['Vehicle'];
        if ($params['Title'] && $params['Title'] != '商品名称/商品编号/拼音代码/OE号/品牌') {  //关键字
            $criteria->addCondition("t.Title like '%{$params['Title']}%'", "AND");
        }
        if ($params['GoodsNO']) {
            $criteria->addCondition("t.GoodsNO = '{$params['GoodsNO']}'", "AND");
        }
        if ($params['Name']) {
            $criteria->addCondition("t.Name = '{$params['Name']}'", "AND");
        }
        if ($params['BrandID']) {
            $criteria->addCondition("t.BrandID = '{$params['BrandID']}'", "AND");
        }
        if ($params['Pinyin']) {
            $criteria->addCondition("t.Pinyin = '{$params['Pinyin']}'", "AND");
        }
        if ($params['PartsLevel']) {
            $criteria->addCondition("t.PartsLevel = '{$params['PartsLevel']}'", "AND");
        }
        if ($params['Price']) {
            $criteria->addCondition("t.Price = '{$params['Price']}'", "AND");
        }
        if ($params['OE']) {
            $sql = "select GoodsID from pap_goods_oe_relation where OENO like '%{$params['OE']}%'";
            $sqlParams = array();
            $res = Yii::app()->papdb->createCommand($sql)->queryAll($sqlParams);
            foreach ($res as $v) {
                $modelRow[] = $v[0];
            }
            $criteria->addInCondition('t.ID', $modelRow, "AND");
        }
        if ($Vehicle) {
            $Vehicle = explode(' ', $Vehicle);
            $sql = "select GoodsID from pap_goods_vehicle_relation where Marktxt = '" . $Vehicle[0] . "'";
            if ($Vehicle[1]) {
                $sql .=" and Cartxt = '" . $Vehicle[1] . "'";
            }
            if ($Vehicle[2]) {
                $sql .=" and Year = '" . $Vehicle[2] . "'";
            }
            if ($Vehicle[3]) {
                $sql .=" and Modeltxt = '" . $Vehicle[3] . "'";
            }
            $sqlParams = array();
            $res = Yii::app()->papdb->createCommand($sql)->queryAll($sqlParams);
            foreach ($res as $v) {
                $modelRow[] = $v[0];
            }
            $criteria->addInCondition('t.ID', $modelRow, "AND");
        }
        $organID = Yii::app()->user->getOrganID();
        $criteria->order = "t.UpdateTime desc";
        $criteria->addCondition("t.IsPro = 1 and t.IsSale = 1 and t.ISdelete = 1 and t.OrganID = " . $organID, "AND");
        $criteria->with = array('PapJpbrand', 'goodoe', 'img', 'vehicle'); //调用relations
        $data = new CActiveDataProvider('PapGoods', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 15,
        )));
        return $data;
    }

    /*
     * 促销管理 添加促销商品  获取所有上架并且未促销商品
     */

//    public static function getNoprogoods($params) {
//        $criteria = new CDbCriteria();
//        $Vehicle = $params['Vehicle'];
//        if ($params['Title'] && $params['Title'] != '请输入关键字') {  //关键字
//            $criteria->addCondition("t.Title like '%{$params['Title']}%'", "AND");
//        }
//        if ($params['GoodsNO']) {
//            $criteria->addCondition("t.GoodsNO = '{$params['GoodsNO']}'", "AND");
//        }
//        if ($params['Name']) {
//            $criteria->addCondition("t.Name = '{$params['Name']}'", "AND");
//        }
//        if ($params['BrandID']) {
//            $criteria->addCondition("t.BrandID = '{$params['BrandID']}'", "AND");
//        }
//        if ($params['Pinyin']) {
//            $criteria->addCondition("t.Pinyin = '{$params['Pinyin']}'", "AND");
//        }
//        if ($params['PartsLevel']) {
//            $criteria->addCondition("t.PartsLevel = '{$params['PartsLevel']}'", "AND");
//        }
//        if ($params['Price']) {
//            $criteria->addCondition("t.Price = '{$params['Price']}'", "AND");
//        }
//        if ($params['OE']) {
//            $sql = "select GoodsID from pap_goods_oe_relation where OENO like '%{$params['OE']}%'";
//            $sqlParams = array();
//            $res = Yii::app()->papdb->createCommand($sql)->queryAll($sqlParams);
//            foreach ($res as $v) {
//                $modelRow[] = $v[0];
//            }
//            $criteria->addInCondition('t.ID', $modelRow, "AND");
//        }
//        if ($Vehicle) {
//            $Vehicle = explode(' ', $Vehicle);
//            $sql = "select GoodsID from pap_goods_vehicle_relation where Marktxt = '" . $Vehicle[0] . "'";
//            if ($Vehicle[1]) {
//                $sql .=" and Cartxt = '" . $Vehicle[1] . "'";
//            }
//            if ($Vehicle[2]) {
//                $sql .=" and Year = '" . $Vehicle[2] . "'";
//            }
//            if ($Vehicle[3]) {
//                $sql .=" and Modeltxt = '" . $Vehicle[3] . "'";
//            }
//            $sqlParams = array();
//            $res = Yii::app()->papdb->createCommand($sql)->queryAll($sqlParams);
//            foreach ($res as $v) {
//                $modelRow[] = $v[0];
//            }
//            $criteria->addInCondition('t.ID', $modelRow, "AND");
//        }
//        $organID = Yii::app()->user->getOrganID();
////        $criteria->order = "t.ID desc";
////        $criteria->addCondition("t.IsPro = 0 and t.IsSale = 1 and t.ISdelete = 1 and t.OrganID = " . $organID, "AND");
////        $criteria->with = array('brand', 'goodoe', 'img', 'vehicle'); //调用relations
////        $data = new CActiveDataProvider('PapGoods', array(
////                    'criteria' => $criteria,
////                    'pagination' => array(
////                        'pageSize' => 15,
////                        )));
//        $model = MallService::getGoodsData($params);
//    }

    /*
     * 设置促销价格(添加促销页面)
     */

    public static function setProgoodsprice() {
        $ID = Yii::app()->request->getParam('ID');
        $proprice = Yii::app()->request->getParam('proprice');
        $model = PapGoods::model()->findByPk($ID);
        if ($model) {
            $bool = PapGoods::model()->updateByPk($ID, array(
                'ProPrice' => $proprice,
                'IsPro' => 1,
                'ProTime' => time(),
                'UpdateTime' => time(),
            ));
        }
        return $bool;
    }

    /*
     * 修改促销价格(促销列表页面)
     */

    public static function editPro() {
        $ID = Yii::app()->request->getParam('ID');
        $proprice = Yii::app()->request->getParam('proprice');
        $model = PapGoods::model()->findByPk($ID);
        if ($model) {
            $bool = PapGoods::model()->updateByPk($ID, array(
                'ProPrice' => $proprice, //修改的价格
                'ProTime' => time(), //修改促销价时候修改促销时间
            ));
        }
        return $bool;
    }

    /*
     * 取消促销商品(促销列表页面)
     */

    public static function delPro() {
        $ID = Yii::app()->request->getParam('ID');
        $bool = PapGoods::model()->updateByPk($ID, array(
            'IsPro' => 0,
            'UpdateTime' => time(),
            'ProTime' => '',
            'ProPrice' => NULL,
        ));
        return $bool;
    }

    /*
     * 批量取消促销价(促销列表页面)
     */

    public static function deletePro() {
        $ID = Yii::app()->request->getParam('id');
        $IDs = explode(',', $ID);
        foreach ($IDs as $value) {
            if ($value) {
                $bool = PapGoods::model()->updateByPk($value, array(
                    'IsPro' => 0,
                ));
            }
        }
        return $bool;
    }

    /*
     * 经销商-销售中商品查询
     */

    public static function papgetgoods($param = array()) {

        $car['make'] = Yii::app()->request->getParam('make') ? Yii::app()->request->getParam('make') : Yii::app()->request->getParam('jpmall_make');
        $car['series'] = Yii::app()->request->getParam('series') ? Yii::app()->request->getParam('series') : Yii::app()->request->getParam('jpmall_series');
        $car['year'] = Yii::app()->request->getParam('year') ? Yii::app()->request->getParam('year') : Yii::app()->request->getParam('jpmall_year');
        $car['model'] = Yii::app()->request->getParam('model') ? Yii::app()->request->getParam('model') : Yii::app()->request->getParam('jpmall_model');

        $params = array(
            'rows' => 12,
            'page' => Yii::app()->request->getParam("page") ? Yii::app()->request->getParam("page") : 1,
            'car' => $car,
//            'make' => $car['make'],
//            'series' => $car['series'],
//            'year' => $car['year'],
//            'model' => $car['model'],
            'SellerID' => Yii::app()->user->getOrganID(),
        );
        if ($param['IsPro'] == 2) {  //促销
            $params['SellerIsPro'] = 2;
        }
        if ($param['IsPro'] == 5) { //未促销
            $params['SellerIsPro'] = 22;
        }
        if ($_GET) {
            $Title = Yii::app()->request->getParam('Title');
            if ($Title && $Title != '请输入关键字') {
                $Title = urldecode($Title);
                $params['keywords'] = $Title;
            }
            $GoodsNO = Yii::app()->request->getParam('GoodsNO');
            if ($GoodsNO) {
                $GoodsNO = urldecode($GoodsNO);
                $params['GoodsNO'] = $GoodsNO;
            }
            $Name = Yii::app()->request->getParam('Name');
            if ($Name) {
                $Name = urldecode($Name);
                $params['Name'] = $Name;
            }
            $BrandID = Yii::app()->request->getParam('BrandID');
            if ($BrandID) {
                $params['brandID'] = $BrandID;
            }
            $StandCode = Yii::app()->request->getParam('StandCode');
            if ($StandCode) {
                $params['codes'] = $StandCode;
            }
            $Pinyin = Yii::app()->request->getParam('Pinyin');
            if ($Pinyin) {
                $Pinyin = urldecode($Pinyin);
                $params['Pinyin'] = $Pinyin;
            }
            $PartsLevel = Yii::app()->request->getParam('PartsLevel');
            if ($PartsLevel) {
                $params['PartsLevel'] = $PartsLevel;
            }
            $Price = Yii::app()->request->getParam('Price');
            if ($Price) {
                $Price = urldecode($Price);
                $params['goodprice'] = $Price;
            }
            $OE = Yii::app()->request->getParam('OE');
            if ($OE) {
                $OE = urldecode($OE);
                $params['oeno'] = $OE;
            }
            $IsSale = Yii::app()->request->getParam('IsSale');
            if ($IsSale == 1) {
                $params['IsSale'] = 1;
            } else if ($IsSale == 0) {
                $params['IsSale'] = 0;
            }
        }
//        exit;
        foreach ($params as $key => $value) {
            $params[$key] = str_replace('%', '\\%', $params[$key]);
            $params[$key] = str_replace('<<q>>', '/', $params[$key]);
        }
        $params['order'] = 'time_l';
        $model = MallService::getGoodsDataold($params);
        $car = MallService::getCarmodeltxt($params);
        return array('model' => $model, 'car' => $car);
    }

    /*
     * 经销商-下架商品查询
     */

    public static function dropgetgoods() {
        $criteria = new CDbCriteria();
        if ($_GET) {
            $Title = Yii::app()->request->getParam('Title');
            if ($Title && $Title != '请输入关键字') {
                $criteria->addCondition("t.Title like '%$Title%'", "AND");
            }
            $GoodsNO = Yii::app()->request->getParam('GoodsNO');
            if ($GoodsNO) {
                $criteria->addCondition("t.GoodsNO like '%$GoodsNO%'", "AND");
            }
            $Name = Yii::app()->request->getParam('Name');
            if ($Name) {
                $criteria->addCondition("t.Name like '%$Name%'", "AND");
            }
            $BrandID = Yii::app()->request->getParam('BrandID');
            if ($BrandID) {
                $criteria->addCondition("t.BrandID like '$BrandID'", "AND");
            }
            $StandCode = Yii::app()->request->getParam('StandCode');
            if ($StandCode) {
                $criteria->addCondition("t.StandCode like '$StandCode'", "AND");
            }
            $Pinyin = Yii::app()->request->getParam('Pinyin');
            if ($Pinyin) {
                $criteria->addCondition("t.Pinyin like '%$Pinyin%'", "AND");
            }
            $PartsLevel = Yii::app()->request->getParam('PartsLevel');
            if ($PartsLevel) {
                $criteria->addCondition("t.PartsLevel like '$PartsLevel'", "AND");
            }
            $Price = Yii::app()->request->getParam('Price');
            if ($Price) {
                $criteria->addCondition("t.Price like '%$Price%'", "AND");
            }

            $OE = Yii::app()->request->getParam('OE');
            if ($OE) {
                $sql = "select GoodsID from pap_goods_oe_relation where OENO like '%$OE%'";
                $sqlParams = array();
                $res = Yii::app()->papdb->createCommand($sql)->queryAll($sqlParams);
                foreach ($res as $v) {
                    $modelRow[] = $v[0];
                }
                $criteria->addInCondition('t.ID', $modelRow, "AND");
            }
            $Vehicle = Yii::app()->request->getParam('Vehicle');
            if ($Vehicle) {
                $Vehicle = explode(' ', $Vehicle);
                $sql = "select GoodsID from pap_goods_vehicle_relation where Marktxt = '" . $Vehicle[0] . "'";
                if ($Vehicle[1]) {
                    $sql .=" and Cartxt = '" . $Vehicle[1] . "'";
                }
                if ($Vehicle[2]) {
                    $sql .=" and Year = '" . $Vehicle[2] . "'";
                }
                if ($Vehicle[3]) {
                    $sql .=" and Modeltxt = '" . $Vehicle[3] . "'";
                }
                $sqlParams = array();
                $res = Yii::app()->papdb->createCommand($sql)->queryAll($sqlParams);
                foreach ($res as $v) {
                    $modelRow[] = $v[0];
                }
                $criteria->addInCondition('t.ID', $modelRow, "AND");
            }
        }
        $organID = Yii::app()->user->getOrganID();
        $criteria->order = "t.ID desc";
        $criteria->addCondition("t.IsSale = 0 and t.ISdelete = 1 and t.OrganID = " . $organID, "AND");
        $criteria->with = array('PapJpbrand', 'goodoe', 'img', 'vehicle'); //调用relations
        $data = new CActiveDataProvider('PapGoods', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 15,
        )));
        return $data;
    }

    /*
     * 经销商-修改商品
     */

    public static function editgetgoods($ID) {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->order = "t.ID desc";
        $criteria->condition = "t.ID = " . $ID;
        $criteria->with = array('PapJpbrand', 'goodoe', 'img', 'vehicle', 'spec'); //调用relations
        $data = new CActiveDataProvider('PapGoods', array(
            'criteria' => $criteria));
//        var_dump($data->getData());
//        die;
        return $data;
    }

    /*
     * 经销商发布商品-把主营车系添加到商品车系关系表
     */

    public static function addvehiclegoods($pid, $organID, $time) {
        $make = explode(',', $_POST["make"]);
        $car = explode(',', $_POST["car"]);
        $year = explode(',', $_POST["year"]);
        $model2 = explode(',', $_POST["model"]);
        $maketext = explode(',', $_POST["maketxt"]);
        $cartext = explode(',', $_POST["cartxt"]);
        $modeltext = explode(',', $_POST["modeltxt"]);
        $vehlegth = count($make);
        for ($i = 0; $i < $vehlegth; $i++) {
            if ($make[$i] != 0) {
                $goodsv = new PapGoodsVehicleRelation();
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
                $vehicles[] = $vehicle = array('Type' => 'add', 'Make' => $make[$i], 'Car' => $car[$i], 'Year' => $year[$i], 'Model' => $model2[$i], 'Marktxt' => $maketext[$i], 'Cartxt' => $cartext[$i], 'Modeltxt' => $modeltext[$i]);
                $veharr = array(
                    'GoodsID' => (int) $pid,
                    'UpdateTime' => (int) $time,
                    'VehInfo' => $vehicle,
                    'Type' => 'add',
                );
                Yii::app()->mongodb->getDbInstance()->vehicle_log->insert($veharr);
            }
        }
    }

    /*
     * 经销商发布商品-把配件品类添加到配件表中
     */

    public static function addgcategorygoods($pid, $organID) {
        $category['BigParts'] = $_POST['BigParts'];
        $category['SubParts'] = $_POST['SubParts'];
        $category['OrganID'] = $organID;
        $cid = PapGoodsGcategory::model()->find("GoodsID=$pid")->attributes['ID'];
        $goodspc = PapGoodsGcategory::model()->findByPk($cid);
        if (empty($cid)) {
            $goodspc = new PapGoodsGcategory();
        }
        $goodspc->attributes = $category;
        $goodspc->GoodsID = $pid;
        $goodspc->save();
        return array('BigParts' => $category['BigParts'], 'SubParts' => $category['SubParts']);
    }

    /*
     * 经销商发布商品-把OE号添加到OE表中
     */

    public static function addoegoods($pid, $organID) {
        $oenos = $_POST['OENOS'];
        $oelegth = count($oenos);
        $del = PapGoodsOeRelation::model()->deleteAll("OrganID=:organID and GoodsID=:pid", array(":organID" => $organID, ":pid" => $pid));
//        if ($del) {
        for ($i = 0; $i < $oelegth; $i++) {
//                $model = PapGoodsOeRelation::model()->find("OrganID=:organID and GoodsID=:pid and OENO=:oe", array(":organID" => $organID, ":pid" => $pid, ":oe" => $oenos[$i]));
//                if ($model) {
//                    $model = PapGoodsOeRelation::model()->updateByPk($model->ID, array('OENO' => $oenos[$i]));
//                } else {
            $goodsoeno = new PapGoodsOeRelation();
            $goodsoeno->OrganID = $organID;
            $goodsoeno->GoodsID = $pid;
            $goodsoeno->OENO = $oenos[$i];
            $goodsoeno->CreateTime = time();
            $goodsoeno->save();
            $oeno[$i] = $oenos[$i];
        }
        return $oeno;
//            }
//        }
    }

    /*
     * 经销商发布商品-把商品图片添加发到图片表中
     */

    public static function addimggoods($pid, $organID) {
        $urlimg = explode(',^', $_POST['urlimg']); //根据逗号拆分，得到图片信息的字符串
        $delimg = explode(',^', $_POST['delimg']);
        if ($delimg[0]) {
            foreach ($delimg as $delv) {
                $delsql = "delete from pap_goods_image_relation where ImageUrl='" . $delv . "'";
                $delresult = Yii::app()->papdb->createCommand($delsql)->execute();
//                if ($delresult) {
//                    $path = $delv;
//                    $mpath = str_replace('/small/', '/normal/', $delv); //缩略小图url
//                    $bpath = str_replace('/small/', '/thumb/', $delv); //原图url
//                    $ftp = new Ftp();
//                    $ftp->delete_file($mpath);
//                    $ftp->delete_file($bpath);
//                    $ftp->close();
//                }
            }
        }
        if ($urlimg[1]) {
            $sqlimg = "insert into pap_goods_image_relation (OrganID,GoodsID,ImageUrl,CreateTime,ImageName,MallImage,BigImage) values";
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
                    $sqlimg .="','";
                    $sqlimg .=str_replace('/small/', '/thumb/', $addimg[0]); //缩略小图url
                    $sqlimg .="','";
                    $sqlimg .=str_replace('/small/', '/normal/', $addimg[0]); //原图url
                    $sqlimg .="')";
                    $img[$k - 1] = array('ImageUrl' => $addimg[0], 'ImageName' => $addimg[1]);
                }
            }
            Yii::app()->papdb->createCommand($sqlimg)->execute();
            return $img;
        }
    }

    /*
     * 经销商发布商品-把商品属性添加到属性表中
     */

    public static function addspecgoods($pid) {
        $goodsspec['ValidityType'] = $_POST['ValidityType']; // 保质期类型
//        $goodsspec['ValidityDate'] = $_POST['ValidityDate']; // 保质期
//        $goodsspec['dataday'] = $_POST['dataday']; // 保质期单位
        if ($goodsspec['ValidityType'] == 3) {
            $goodsspec['ValidityDate'] = $_POST['ValidityDate'] . $_POST['dataday']; // 保质期
        }
        $goodsspec['BganCompany'] = $_POST['BganCompany']; // 标杆公司
        $goodsspec['BganGoodsNO'] = $_POST['BganGoodsNO']; // 标杆商品号
        $goodsspec['Unit'] = $_POST['Unit'];      // 配件单位
//  $goodsspec['JiapartsNO'] = $_POST['JiapartsNO']; // 加配号
        $psid = PapGoodsSpec::model()->find("GoodsID=$pid")->attributes['ID'];
        $goodssp = PapGoodsSpec::model()->findByPk($psid);
        if (empty($psid)) {
            $goodssp = new PapGoodsSpec();
        }
        $goodssp->attributes = $goodsspec;
        $goodssp->GoodsID = $pid;
        $goodssp->save();

        $arr['ValidityType'] = $goodsspec['ValidityType'];
        $arr['ValidityDate'] = $goodsspec['ValidityDate'];
        $arr['Unit'] = $goodsspec['Unit'];
        $arr['BganCompany'] = $goodsspec['BganCompany'];
        $arr['BganGoodsNO'] = $goodsspec['BganGoodsNO'];


        return $arr;

//        $goodsspe = new PapGoodsSpec();
//        $goodsspe->attributes = $goodsspec;
//        $goodsspe->GoodsID = $pid;      // 商品ID
//        $goodsspe->save();
    }

    /*
     * 经销商发布商品-把商品包装属性添加到包装属性表中
     */

    public static function addpackgoods($pid) {
        $goodspack['MinQuantity'] = $_POST['MinQuantity'];    //

        $pcid = PapGoodsPack::model()->find("GoodsID=$pid")->attributes['ID'];
        $goodspc = PapGoodsPack::model()->findByPk($pcid);
        if (empty($pcid)) {
            $goodspc = new PapGoodsPack();
        }
        $goodspc->attributes = $goodspack;
        $goodspc->GoodsID = $pid;
        $goodspc->save();
        $arr['MinQuantity'] = $goodspack['MinQuantity'];
        return $arr;
    }

    /*
     * 删除OE号
     */

    public static function deloegoods() {
        $cateid = $_GET['cateid'];
        $delete = explode(',', $cateid);
        if (is_numeric($delete[0])) {
            $model = PapGoodsOeRelation::model()->findByPk($delete[0])->delete();
        } else {
            $model = PapGoods::model()->updateByPk($delete[1], array('OENO' => ''));
        }
        return $model;
    }

    /*
     * 删除单个适用车系
     */

    public static function delvehiclegoods() {
        $cateid = $_GET['cateid'];
        $models = PapGoodsVehicleRelation::model()->findByPk($cateid);
        $model = $models->delete();
        $vehicle = array('Type' => 'del', 'Make' => $models->attributes['Make'], 'Car' => $models->attributes['Car'], 'Year' => $models->attributes['Year'], 'Model' => $models->attributes['Model'], 'Marktxt' => $models->attributes['Marktxt'], 'Cartxt' => $models->attributes['Cartxt'], 'Modeltxt' => $models->attributes['Modeltxt']);
        $veharr = array(
            'GoodsID' => (int) $models->attributes['GoodsID'],
            'UpdateTime' => time(),
            'VehInfo' => $vehicle,
            'Type' => 'del',
        );
        if ($model) {
            Yii::app()->mongodb->getDbInstance()->vehicle_log->insert($veharr);
        }
//        PapGoods::model()->updateBypk($models->attributes['GoodsID'], array('VehVersion' => ''));
        return $model;
    }

    /*
     * 删除整个适用车系
     */

    public static function delvehiclesgoods() {
        $Car = $_GET['cateid'];
        $goodsid = $_GET['goodsid'];
        $organID = Commonmodel::getOrganID();
        $veh = PapGoodsVehicleRelation::model()->findAll("OrganID= '$organID' and Car='$Car' and GoodsID='$goodsid'");
        $model = PapGoodsVehicleRelation::model()->deleteAll("OrganID= '$organID' and Car='$Car' and GoodsID='$goodsid'");
        if ($model) {
            $model = 1;
//            PapGoods::model()->updateBypk($goodsid, array('VehVersion' => ''));
            $time = time();
            foreach ($veh as $vehv) {
                $vehicle = array('Type' => 'del', 'Make' => $vehv->attributes['Make'], 'Car' => $vehv->attributes['Car'], 'Year' => $vehv->attributes['Year'], 'Model' => $vehv->attributes['Model'], 'Marktxt' => $vehv->attributes['Marktxt'], 'Cartxt' => $vehv->attributes['Cartxt'], 'Modeltxt' => $vehv->attributes['Modeltxt']);
                $veharr = array(
                    'GoodsID' => (int) $vehv->attributes['GoodsID'],
                    'UpdateTime' => (int) $time,
                    'VehInfo' => $vehicle,
                    'Type' => 'del',
                );
                Yii::app()->mongodb->getDbInstance()->vehicle_log->insert($veharr);
            }
        }
        return $model;
    }

    /*
     * 获得上架商品数量
     */

    public static function getsaleprocount() {
        $organID = Yii::app()->user->getOrganID();
        $progoods = PapGoods::model()->count(array("condition" => "IsSale = 1 and ISdelete = 1 and t.OrganID = " . $organID));
        return $progoods;
    }

    /*
     * 获得下架商品数量
     */

    public static function getdropprocount() {
        $organID = Yii::app()->user->getOrganID();
        $progoods = PapGoods::model()->count(array("condition" => "IsSale = 0 and ISdelete = 1 and t.OrganID = " . $organID));
        return $progoods;
    }

    /*
     * 下/上架商品
     */

    public static function editsalegoods($edit) {

        $ID = Yii::app()->request->getParam('id');
        $IDs = explode(',', $ID);
        $bools = 0;
        foreach ($IDs as $value) {
            if ($value != 0) {
                Yii::app()->redis->delete('GoodsID' . $value);
                $bool = PapGoods::model()->updateByPk($value, array(
                    'IsSale' => $edit,
                    'IsPro' => 0,
                    'ProPrice' => null,
                    'UpdateTime' => time(),
                ));
                if (!$bool) {
                    $bools +=1;
                    $info = PapGoods::model()->findByPk($value);
                    if (!$name) {
                        $name .= $info['Name'];
                    } else {
                        $name .= ',' . $info['Name'];
                    }
                }
            }
        }
        return array('bool' => $bools, 'name' => $name);
    }

    /*
     * 永久删除商品
     */

    public static function yjdeloegoods() {
        $ID = Yii::app()->request->getParam('id');
        $IDs = explode(',', $ID);
        $bools = 0;
        foreach ($IDs as $value) {
            if ($value != 0) {
                $bool = PapGoods::model()->updateByPk($value, array('ISdelete' => 0));
                if (!$bool) {
                    $bools +=1;
                    $info = PapGoods::model()->findByPk($value);
                    if (!$name) {
                        $name .= $info['Name'];
                    } else {
                        $name .= ',' . $info['Name'];
                    }
                }
            }
        }
        return array('bool' => $bools, 'name' => $name);
    }

    /*
     * 通过StandCode获得标准名称
     */

    public static function StandCodegetcpname($StandCode, $Name = '') {
        if ($StandCode) {
            $model = JPDGcategory::model()->find("Code=:Code", array(':Code' => $StandCode));
            if ($Name) {
                return $model->$Name;
            } else {
                return $model;
            }
        }
    }

    public static function idgetgcategory($ID) {
        $model = JPDGcategory::model()->findBypk($ID);
        return $model;
    }

    /*
     * 通过商品ID获得pap_goods表中商品数据
     * @param int                    $GoodsID  商品ID
     * @param varcher                $Name  所需要的字段
     */

    public static function idgetgoods($GoodsID, $Name) {
        $model = PapGoods::model()->findBypk($GoodsID);
        return $model->$Name;
    }

    /*
     * 获得品牌
     */

    public static function idgetbrand($brandid, $name) {
        $model = PapBrand::model()->findBypk($brandid);
        return $model->$name;
    }

    /*
     * 获得品牌
     */

    public static function idgetjpbrand($brandid, $name) {
        $model = PapJpbrand::model()->findBypk($brandid);
        return $model->$name;
    }

    /**
     * 模糊循环匹配配件信息(配件查询会用到)
     */
    public static function getGoodsByPartsOENO($oe) {
        $sql = "select * from `pap_goods` where  IsSale = 1 and ISdelete = 1";
        if (!empty($oe) && is_array($oe)) {                   // OE号不为空，并且是数组
            $oearr = array_unique($oe);
            $oesql = 'select DISTINCT GoodsID from pap_goods_oe_relation where ';
            foreach ($oearr as $v) {
                $oesql.='OENO = "' . $v . '" or ';
            }
            $oesql = rtrim($oesql, 'or ');
        } elseif (!empty($oe) && !is_array($oe)) {           // OE号不为空，并且不是数组
            $oesql = 'select DISTINCT GoodsID from pap_goods_oe_relation where OENO = "' . $oe . '"';
        }
        $oedatas = Yii::app()->papdb->createCommand($oesql)->queryAll();
        $ids = array();
        foreach ($oedatas as $v) {
            $ids[] = $v['GoodsID'];
        }
        $idstr = implode(',', $ids);
        if ($idstr)
            $where.=' and ID in (' . $idstr . ')';
        else {
            $where.=' and ID in (0)';
        }
        $sql.=$where . ' order by ID desc limit 3';
        $goodses = Yii::app()->papdb->createCommand($sql)->queryAll();
        $data = array();
//判断当前登录角色（修理厂/经销商）
        $Identity = Yii::app()->user->getIdentity();
        if ($Identity == 'servicer')
            $Identity = 3;
        else
            $Identity = 2;
        $OrganID = Yii::app()->user->getOrganID();
        foreach ($goodses as $key => $goods) {
            $data[$key]['ImageUrl'] = self::getGoodsImage($goods['ID']);
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['OENO'] = QuotationService::getoebygoodsid($goods['ID']);
            $data[$key]['OrganID'] = $goods['OrganID'];
            $data[$key]['Name'] = $goods['Name'];
            $data[$key]['OrganName'] = self::getnamebyorganid($goods['OrganID']);
            $data[$key]['ListPrice'] = $goods['Price'];
            $data[$key]['Identity'] = $Identity;    //当前登录用户觉角色
//折扣率
            if ($Identity == 3) {   //修理厂
                $discount = QuotationService::getpriceratio($goods['OrganID'], $OrganID);
                $data[$key]['PriceRatio'] = $discount['discount'] ? $discount['discount'] . '%' : "100%";
                $DisPrice = sprintf("%.2f", $goods['Price'] * $data[$key]['PriceRatio'] / 100); // 折扣价,小数点后面保留两位
                if ($goods['IsPro'] == 1) {     //促销商品
                    $ProPrice = (empty($goods['ProPrice']) || $goods['ProPrice'] == 0 ) ? $DisPrice : $goods['ProPrice']; // 促销价
                    $data[$key]['Price'] = ($ProPrice < $DisPrice) ? $ProPrice : $DisPrice;
                } else {   //非促销商品
                    $data[$key]['Price'] = $DisPrice;   //折扣价
                }
            } elseif ($Identity == 2) {     //经销商
                $data[$key]['Price'] = $goods['Price'];     //参考价
            }
        }
        return $data;
    }

//获取商品图片
    public static function getGoodsImage($goodsid) {
        $sql = 'select ImageUrl from `pap_goods_image_relation` where GoodsID=' . $goodsid;
        $data = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $data['ImageUrl'];
    }

//通过机构id获取机构名称
    public static function getnamebyorganid($organid) {
        $sql = 'select OrganName from `jpd_organ` where ID=' . $organid;
        $data = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $data['OrganName'];
    }

    //商品上架-生成版本-生成redis数据
    public static function addversiongoods($GoodsID) {
        $Organ = Yii::app()->user->getOrganID();
        //版本
        $versiontime = time();
        //商品信息
        $Good = PapGoods::model()->findBypk($GoodsID);
//        var_dump($Good);
//        eixt;
        if ($Good->attributes['Version']) {
            $contrast = self::goodsedit($GoodsID, $Good->attributes['Version'], $Good->attributes['VehVersion']);
        } else {
            $contrast['countveh'] = 1;
        }
//        var_dump($contrast);
//        exit;
        //车系版本
        if ($contrast['countgoods'] > 0 && $contrast['countveh'] == 0) {
            PapGoods::model()->updateBypk($GoodsID, array('Version' => $versiontime));
        } else if ($contrast['countveh'] > 0) {
            PapGoods::model()->updateBypk($GoodsID, array('VehVersion' => $versiontime, 'Version' => $versiontime));
        }

        $redis = $version = self::newgoodsxinfo($GoodsID);
//        $redis['vehicle'] = self::newvehicleinfo($GoodsID);
        //车系版本
        $vehicle = PapGoodsVehicleRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
        if ($vehicle) {
            foreach ($vehicle as $vehk => $value) {
                //商品有变化，适用车系版本为空,插入适用车系版本
                $vehicleinfo[$vehk]['Make'] = $value->attributes['Make'];
                $vehicleinfo[$vehk]['Car'] = $value->attributes['Car'];
                $vehicleinfo[$vehk]['Year'] = $value->attributes['Year'];
                $vehicleinfo[$vehk]['Model'] = $value->attributes['Model'];
                $vehicleinfo[$vehk]['Marktxt'] = $value->attributes['Marktxt'];
                $vehicleinfo[$vehk]['Cartxt'] = $value->attributes['Cartxt'];
                $vehicleinfo[$vehk]['Modeltxt'] = $value->attributes['Modeltxt'];
//                    $veh = new PapGoodsVehicleVersion();
//                    $veh->OrganID = $value->attributes['OrganID'];
//                    $veh->GoodsID = $GoodsID;
//                    $veh->VechleVesrion = json_encode($vehicleinfo);
//                    $veh->VehVersion = $versiontime;
//                    $veh->save();
            }
//            if ($contrast && !$Good->attributes['VehVersion']) {
            if ($contrast['countveh'] > 0) {
                $veharr = array(
                    'GoodsID' => (int) $GoodsID,
                    'Organ' => (int) $Organ,
                    'VehcleInfo' => $vehicleinfo,
                    'VehVersion' => (int) $versiontime,
                );
                Yii::app()->mongodb->getDbInstance()->vehcle_version->insert($veharr);
            }

//            $res = Yii::app()->mongodb->getDbInstance()->vehcle_version->findOne(array("GoodsID" => $GoodsID));
//
//            var_dump($res);
//            exit;
        }
        if ($contrast['countgoods'] > 0 || $contrast['countveh'] > 0) {
//            $ver = new PapGoodsVersion();
//            $ver->GoodsID = $GoodsID;
//            $ver->Info = json_encode($version);
//            $ver->Version = $versiontime;
            //车系版本
            if ($contrast['countveh'] == 0) {
                $VehVersion = $Good->attributes['VehVersion'];
            } else {
                $VehVersion = $versiontime;
            }
            $Goodsarr = array(
                'GoodsID' => (int) $GoodsID,
                'GoodsInfo' => $version,
                'Version' => (int) $versiontime,
                'VehVersion' => (int) $VehVersion,
            );
            Yii::app()->mongodb->getDbInstance()->goods_version->insert($Goodsarr);
//            $ver->save();
        }
//        DealergoodsService::getmongoversion($GoodsID, $versiontime, 'haveveh');
        //cache缓存
//        self::yiicache($GoodsID, $redis);
        //存储redis缓存
        Yii::app()->redis->set('GoodsID' . $GoodsID, json_encode($redis));
    }

    /*
     * 添加商品时，版本和redis
     */

    public static function addverredis($GoodsID) {
        $Organ = Yii::app()->user->getOrganID();
        //版本
        $redis = $version = self::newgoodsxinfo($GoodsID);
        $versiontime = $redis['Version'];
//        $redis['vehicle'] = self::newvehicleinfo($GoodsID);
        //车系版本
        $vehicle = PapGoodsVehicleRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
        if ($vehicle) {
            foreach ($vehicle as $vehk => $value) {
                //商品有变化，适用车系版本为空,插入适用车系版本
                $vehicleinfo[$vehk]['Make'] = $value->attributes['Make'];
                $vehicleinfo[$vehk]['Car'] = $value->attributes['Car'];
                $vehicleinfo[$vehk]['Year'] = $value->attributes['Year'];
                $vehicleinfo[$vehk]['Model'] = $value->attributes['Model'];
                $vehicleinfo[$vehk]['Marktxt'] = $value->attributes['Marktxt'];
                $vehicleinfo[$vehk]['Cartxt'] = $value->attributes['Cartxt'];
                $vehicleinfo[$vehk]['Modeltxt'] = $value->attributes['Modeltxt'];
//                    $veh = new PapGoodsVehicleVersion();
//                    $veh->OrganID = $value->attributes['OrganID'];
//                    $veh->GoodsID = $GoodsID;
//                    $veh->VechleVesrion = json_encode($vehicleinfo);
//                    $veh->VehVersion = $versiontime;
//                    $veh->save();
            }
//            if ($contrast && !$Good->attributes['VehVersion']) {
            $veharr = array(
                'GoodsID' => (int) $GoodsID,
                'Organ' => (int) $Organ,
                'VehcleInfo' => $vehicleinfo,
                'VehVersion' => (int) $versiontime,
            );
            Yii::app()->mongodb->getDbInstance()->vehcle_version->insert($veharr);
        }

        //车系版本
        $VehVersion = $versiontime;
        $Goodsarr = array(
            'GoodsID' => (int) $GoodsID,
            'GoodsInfo' => $version,
            'Version' => (int) $versiontime,
            'VehVersion' => (int) $versiontime,
        );
        Yii::app()->mongodb->getDbInstance()->goods_version->insert($Goodsarr);
//        DealergoodsService::getmongoversion($GoodsID, $versiontime, 'haveveh');
        //cache缓存
//        self::yiicache($GoodsID, $redis);
        //存储redis缓存
        Yii::app()->redis->set('GoodsID' . $GoodsID, json_encode($redis));
    }

    public static function yiicache($GoodsID, $cache) {
        $sqlcache = new CDbCacheDependency();
        $sqlcache->connectionID = papdb;
        $sqlcache->sql = 'select IsSale from pap_goods where ID = ' . $GoodsID;
        Yii::app()->cache->set('GoodsID' . $GoodsID, json_encode($cache), 30000, $sqlcache);
    }

    /*
     * 查询商品品牌是否被认证
     */

    public static function getbrandat($BrandID, $OrganID) {
        if ($BrandID) {
            $sql = "select * from pap_dealer_brand where BrandID = " . $BrandID . " and OrganID = " . $OrganID;
            $result = Yii::app()->papdb->createCommand($sql)->queryAll();
            if ($result[0]['url1'] || $result[0]['url2']) {
                return 'true';
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    }

    /*
     * 获得商品当前信息
     */

    public static function newgoodsxinfo($GoodsID) {
        $PartsLevel = array(
            'A' => '原厂',
            'B' => '高端品牌',
            'C' => '经济实用',
            'D' => '下线',
            'E' => '拆车',
        );
        $Goods = PapGoods::model()->findBypk($GoodsID);
        if ($Goods) {
            $arr = $Goods->attributes;
            $arr['Brand'] = self::idgetjpbrand($Goods->attributes['BrandID'], 'BrandName');
            //机构名称
            $arr['OrganName'] = self::getnamebyorganid($Goods->attributes['OrganID']);
            //获得配件档次名称
            $arr['PartsLevelName'] = $PartsLevel[$Goods->attributes['PartsLevel']];
            //获得标准名称
            $arr['StandCodeName'] = DealergoodsService::StandCodegetcpname($Goods->attributes['StandCode'], 'Name');
            //商品-OE号
            $oeno = PapGoodsOeRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            foreach ($oeno as $value) {
                $arr['oeno'][] = $value->attributes['OENO'];
            }
            $gcategory = MallService::getCategory($Goods->attributes['StandCode']);
//            $version['gcategory'] = $gcategory->attributes;
            $redis['gcategory']['BigParts'] = $gcategory['BigPartsID'];
            $redis['gcategory']['SubParts'] = $gcategory['SubPartsID'];
            $redis['gcategory']['BigName'] = $gcategory['BigParts'];
            $redis['gcategory']['SubName'] = $gcategory['SubParts'];
            //商品-图片
            $img = PapGoodsImageRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            foreach ($img as $key => $value) {
                $arr['img'][$key]['ImageUrl'] = $value->attributes['ImageUrl'];
                $arr['img'][$key]['ImageName'] = $value->attributes['ImageName'];
                $arr['img'][$key]['BigImage'] = $value->attributes['BigImage'];
                $arr['img'][$key]['MallImage'] = $value->attributes['MallImage'];
            }
            //商品-属性
            $spec = PapGoodsSpec::model()->find('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            $arr['spec']['ValidityType'] = $spec->attributes['ValidityType'];
            $arr['spec']['ValidityDate'] = $spec->attributes['ValidityDate'];
            $arr['spec']['Unit'] = $spec->attributes['Unit'];
            $arr['spec']['BganCompany'] = $spec->attributes['BganCompany'];
            $arr['spec']['BganGoodsNO'] = $spec->attributes['BganGoodsNO'];
            //商品-包装
            $pack = PapGoodsPack::model()->find('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            $arr['pack']['MinQuantity'] = $pack->attributes['MinQuantity'];
        }
        return $arr;
    }

    /*
     * 获得商品当前适用车系信息
     */

    public static function newvehicleinfo($GoodsID) {
        $vehicle = PapGoodsVehicleRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
        foreach ($vehicle as $key => $value) {
            $arr[$key]['Make'] = $value->attributes['Make'];
            $arr[$key]['Car'] = $value->attributes['Car'];
            $arr[$key]['Year'] = $value->attributes['Year'];
            $arr[$key]['Model'] = $value->attributes['Model'];
            $arr[$key]['Marktxt'] = $value->attributes['Marktxt'];
            $arr[$key]['Cartxt'] = $value->attributes['Cartxt'];
            $arr[$key]['Modeltxt'] = $value->attributes['Modeltxt'];
        }
        return $arr;
    }

//获得商品的所有版本
    public static function getgoodsversion($GoodsID) {
//        $criteria = new CDbCriteria();
//        $criteria->order = 'Version Desc';
//        $criteria->addCondition("GoodsID = '{$GoodsID
//                }'", "AND");
//        $version = PapGoodsVersion::model()->findAll($criteria);
//
//        $GoodsInfo = Yii::app()->mongodb->getDbInstance()->goods_version->findOne(array("GoodsID" => $GoodsID, "Version" => $Version));
        $Goods = (int) $GoodsID;
        $version = Yii::app()->mongodb->getDbInstance()->goods_version->distinct('Version', array("GoodsID" => $Goods));
        return $version;
    }

//获得版本详情
    public static function goodsversioninfo($GoodsID, $Version) {
        $Goodsinfo = PapGoodsVersion::model()->find('GoodsID=:GoodsID and Version=:Version', array(':GoodsID' => $GoodsID, ':Version' => $Version));
        $info = json_decode($Goodsinfo->Info, true);
        $vehicle = PapGoodsVehicleVersion::model()->findAll('GoodsID=:GoodsID and VehVersion=:VehVersion', array(':GoodsID' => $GoodsID, ':VehVersion' => $info['VehVersion']));
        foreach ($vehicle as $value) {
            $info['vehicle'][] = json_decode($value->VechleVesrion, true);
        }
        return $info;
    }

//比较版本信息-有当前版本
    public static function goodshaveversion($old, $new) {
        foreach ($old['info'] as $key => $value) {
            if ($key == 'spec' || $key == 'pack') {
                if ($value) {
                    foreach ($value as $k => $v) {

                        if ($old['info']->$key->$k == $new['info']->$key->$k) {
                            $verupdate[$k] = 0;
                        } else {
                            $verupdate[$k] = 1;
                        }
                    }
                }
            } else {
                if ($new['info']->$key == $old['info']->$key) {
                    $verupdate[$key] = 0;
                } else {
                    $verupdate[$key] = 1;
                }
            }
        }
        foreach ($new['info'] as $key => $value) {
            if ($key == 'spec' || $key == 'pack') {
                if ($value) {
                    foreach ($value as $k => $v) {
                        if ($old['info']->$key->$k == $new['info']->$key->$k) {
                            $verupdate[$k] = 0;
                        } else {
                            $verupdate[$k] = 1;
                        }
                    }
                }
            } else {
                if ($new['info']->$key == $old['info']->$key) {
                    $verupdate[$key] = 0;
                } else {
                    $verupdate[$key] = 1;
                }
            }
        }
        if ($old['vehicle'] == $new['vehicle']) {
            $verupdate['vehicle'] = 0;
        } else {
            $verupdate['vehicle'] = 1;
        }
        return $verupdate;
    }

//比较版本信息-无当前版本
    public static function goodsversion($new, $old) {
        foreach ($old as $key => $value) {
            if ($key == 'spec' || $key == 'pack') {
                if ($value) {
                    foreach ($value as $k => $v) {
                        if ($old[$key][$k] == $new[$key][$k]) {
                            $verupdate[$k] = 0;
                        } else {
                            $verupdate[$k] = 1;
                        }
                    }
                }
            } else {
                if ($new[$key] == $old[$key]) {
                    $verupdate[$key] = 0;
                } else {
                    $verupdate[$key] = 1;
                }
            }
        }
        foreach ($new as $key => $value) {
            if ($key == 'spec' || $key == 'pack') {
                if ($value) {
                    foreach ($value as $k => $v) {
                        if ($old[$key][$k] == $new[$key][$k]) {
                            $verupdate[$k] = 0;
                        } else {
                            $verupdate[$k] = 1;
                        }
                    }
                }
            } else {
                if ($new[$key] == $old[$key]) {
                    $verupdate[$key] = 0;
                } else {
                    $verupdate[$key] = 1;
                }
            }
        }
        if ($old['vehicle'] == $new['vehicle']) {
            $verupdate['vehicle'] = 0;
        } else {
            $verupdate['vehicle'] = 1;
        }
        $new['StandCode'] = self::StandCodegetcpname($new['StandCode'], 'Name');
        $old['StandCode'] = self::StandCodegetcpname($old['StandCode'], 'Name');
        foreach (Yii::app()->getParams()->PartsLevel as $key => $value) {
            if ($key == $new['info']['PartsLevel']) {
                $new['PartsLevel'] = $value;
            }
            if ($key == $old['info']['PartsLevel']) {
                $old['PartsLevel'] = $value;
            }
        }
        $units = GoodsUnit::model()->findAll(array('select' => '*', 'group' => 'UnitName'));
        foreach ($units as $value) {
            $unit[$value->attributes['ID']] = $value->attributes['UnitName'];
        }
        if ($old['spec']['Unit']) {
            $old['spec']['Unit'] = $unit[$old['spec']['Unit']];
        }
        if ($new['spec']['Unit']) {
            $new['spec']['Unit'] = $unit[$new['spec']['Unit']];
        }
        if ($new['spec']['ValidityType'] == 1) {
            $new['spec']['ValidityType'] = '不保修';
        }
        if ($new['spec']['ValidityType'] == 2) {
            $new['spec']['ValidityType'] = '保修车';
        }
        if ($new['spec']['ValidityType'] == 3) {
            $new['spec']['ValidityType'] = '保修时间：';
        }
        if ($old['spec']['ValidityType'] == 1) {
            $old['spec']['ValidityType'] = '不保修';
        }
        if ($old['spec']['ValidityType'] == 2) {
            $old['spec']['ValidityType'] = '保修车';
        }
        if ($old['spec']['ValidityType'] == 3) {
            $old['spec']['ValidityType'] = '保修时间：';
        }
        if ($new['img'] && !$old['img']) {
            foreach ($new['img'] as $k => $v) {
                $verupdate['addimg'][] = $v['ImageName'];
            }
        }
        if (!$new['img'] && $old['img']) {
            foreach ($old['img'] as $k => $v) {
                $verupdate['delimg'][] = $v['ImageName'];
            }
        }
        if ($old['img'] && $new['img']) {
            foreach ($old['img'] as $k => $v) {
                if (!in_array($v, $new['img'])) {
                    $verupdate['delimg'][] = $v['ImageName'];
                }
            }
            foreach ($new['img'] as $k => $v) {
                if (!in_array($v, $old['img'])) {
                    $verupdate['addimg'][] = $v['ImageName'];
                }
            }
        }
        if ($new['vehicle'] && !$old['vehicle']) {
            foreach ($new['vehicle'] as $k => $v) {
                $verupdate['addvehicle'][] = $v['Marktxt'] . ' ' . $v['Cartxt'] . ' ' . $v['Year'] . ' ' . $v['Modeltxt'];
            }
        } else if (!$new['vehicle'] && $old['vehicle']) {
            foreach ($old['vehicle'] as $k => $v) {
                $verupdate['delvehicle'][] = $v['Marktxt'] . ' ' . $v['Cartxt'] . ' ' . $v['Year'] . ' ' . $v['Modeltxt'];
            }
        } else {
            if ($new['vehicle']) {
                foreach ($new['vehicle'] as $k => $v) {
                    if (!in_array($v, $old['vehicle'])) {
                        $verupdate['addvehicle'][] = $v['Marktxt'] . ' ' . $v['Cartxt'] . ' ' . $v['Year'] . ' ' . $v['Modeltxt'];
                    }
                }
            }
            if ($old['vehicle']) {
                foreach ($old['vehicle'] as $k => $v) {
                    if (!in_array($v, $new['vehicle'])) {
                        $verupdate['delvehicle'][] = $v['Marktxt'] . ' ' . $v['Cartxt'] . ' ' . $v['Year'] . ' ' . $v['Modeltxt'];
                    }
                }
            }
        }
        return array('edit' => $verupdate, 'new' => $new, 'old' => $old);
    }

    //比较版本信息-无当前版本-无详细返回值
    public static function goodsversions($new, $old) {
        $contrast = 0;
        foreach ($old as $key => $value) {
            if (($key == 'spec' || $key == 'pack') && $value) {
                foreach ($value as $k => $v) {
                    if ($old[$key][$k] != $new[$key][$k]) {
                        $contrast = 1;
                    }
                }
            } else {
                if (($new[$key] != $old[$key]) && $key != 'IsSale' && $key != 'Version' && $key != 'VehVersion') {
                    $contrast = 1;
                }
            }
        }
        foreach ($new as $key => $value) {
            if (($key == 'spec' || $key == 'pack') && $value) {
                foreach ($value as $k => $v) {
                    if ($old[$key][$k] != $new[$key][$k]) {
                        $contrast = 1;
                    }
                }
            } else {
                if (($new[$key] != $old[$key]) && $key != 'IsSale' && $key != 'Version' && $key != 'VehVersion') {
                    $contrast = 1;
                }
            }
        }
        if ($old['vehicle'] != $new['vehicle']) {
            $contrast = 1;
        }
        return $contrast;
    }

    //获取商品价格最大值
    public static function getmaxprice() {
        $prices = array('maxprice' => 9999999.99, 'maxnum' => 7);
        $sql = 'select Value from jpd_admin_settings where Category="system" and `Key`="GoodsMaxPrice"';
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        if ($res['Value']) {
            $value = @unserialize($res['Value']);
            if (is_numeric($value)) {
                $arr = explode('.', $value);
                if (isset($arr[0])) {
                    $prices['maxnum'] = strlen($arr[0]);
                }
                $prices['maxprice'] = $value;
            }
        }
        return $prices;
    }

    /*
     * 向mongoDB中取版本数据
     */

    public static function getmongoversion($Goods, $Ver, $VehVersion = '') {
        $GoodsID = (int) $Goods;
        $Version = (int) $Ver;
        if ($Version) {
            $GoodsInfo = Yii::app()->mongodb->getDbInstance()->goods_version->findOne(array("GoodsID" => $GoodsID, "Version" => $Version));
            if (!$GoodsInfo) {
                $GoodsInfo['GoodsInfo'] = self::newgoodsxinfo($Goods);
            } else {
                $GoodsInfo['GoodsInfo']['StandCode'] = self::idgetgoods($GoodsID, 'StandCode');
                $GoodsInfo['GoodsInfo']['StandCodeName'] = self::StandCodegetcpname($new['StandCode'], 'Name');
            }
//            exit;
            if ($VehVersion == 'haveveh') {
                $VehcleInfo = Yii::app()->mongodb->getDbInstance()->vehcle_version->findOne(array("GoodsID" => $GoodsID, "VehVersion" => (int) $GoodsInfo['VehVersion']));
                if (!$VehcleInfo) {
                    if ($VehVersion == 'haveveh') {
                        $GoodsInfo['GoodsInfo']['vehicle'] = self::newvehicleinfo($GoodsID);
                    }
                } else {
                    $GoodsInfo['GoodsInfo']['vehicle'] = $VehcleInfo['VehcleInfo'];
                }
            }
        } else {
            $GoodsInfo['GoodsInfo'] = self::newgoodsxinfo($Goods);
            if ($VehVersion == 'haveveh') {
                $GoodsInfo['GoodsInfo']['vehicle'] = self::newvehicleinfo($GoodsID);
            }
        }
        return $GoodsInfo;
    }

    /*
     * 商品修改日志-添加
     */

    public static function addgoodslog($new) {
        $new['StandCode'] = self::StandCodegetcpname($new['StandCode'], 'Name');
        foreach (Yii::app()->getParams()->PartsLevel as $key => $value) {
            if ($key == $new['info']['PartsLevel']) {
                $new['PartsLevel'] = $value;
            }
        }
        $units = GoodsUnit::model()->findAll(array('select' => '*', 'group' => 'UnitName'));
        foreach ($units as $value) {
            $unit[$value->attributes['ID']] = $value->attributes['UnitName'];
        }
        if ($new['spec']['Unit']) {
            $new['spec']['Unit'] = $unit[$new['spec']['Unit']];
        }
        if ($new['spec']['ValidityType'] == 1) {
            $new['spec']['ValidityType'] = '不保修';
        }
        if ($new['spec']['ValidityType'] == 2) {
            $new['spec']['ValidityType'] = '保修车';
        }
        if ($new['spec']['ValidityType'] == 3) {
            $new['spec']['ValidityType'] = '保修时间：';
        }
        foreach ($new as $key => $value) {
            if ($key == 'spec' || $key == 'pack') {
                if ($value) {
                    foreach ($value as $k => $v) {
                        if ($v) {
                            $mongo[$k]['old'] = '';
                            $mongo[$k]['new'] = $v;
                        }
                    }
                }
            } else {
                if ($value) {
                    $mongo[$key]['old'] = '';
                    $mongo[$key]['new'] = $value;
                }
            }
        }
        if ($new['img']) {
            foreach ($new['img'] as $k => $v) {
                $mongo[img]['add'][] = $v['ImageName'];
            }
        }
        $editarr = array(
            'GoodsID' => (int) $new['ID'],
            'UpdateTime' => (int) $new['UpdateTime'],
            'EditInfo' => $mongo,
            'type' => 'edit',
        );
        Yii::app()->mongodb->getDbInstance()->goods_log->insert($editarr);
    }

    /*
     * 商品修改日志-修改
     */

    public static function editgoodslog($edit) {
        $type = 'edit';
        foreach ($edit['edit'] as $editk => $editv) {
            if ($editv) {
                if ($editk == 'Unit' || $editk == 'BganCompany' || $editk == 'BganGoodsNO') {
                    $mongo[$editk]['old'] = $edit['old']['spec'][$editk];
                    $mongo[$editk]['news'] = $edit['new']['spec'][$editk];
                } else if ($editk == 'ValidityType') {
                    $mongo[$editk]['old'] = $edit['old']['spec'][$editk];
                    $mongo[$editk]['news'] = $edit['new']['spec'][$editk];
                    if ($mongo[$editk]['news'] == '保修时间：') {
                        $mongo[$editk]['news'] .=$edit['new']['spec']['ValidityDate'];
                    }
                    if ($mongo[$editk]['old'] == '保修时间：') {
                        $mongo[$editk]['old'] .=$edit['old']['spec']['ValidityDate'];
                    }
                } else if ($editk == 'ValidityDate') {
                    $mongo['ValidityType']['old'] .= '保修时间：' . $edit['old']['spec']['ValidityDate'];
                    $mongo['ValidityType']['new'] .= '保修时间：' . $edit['new']['spec']['ValidityDate'];
                } else if ($editk == 'MinQuantity') {
                    $mongo[$editk]['old'] = $edit['old']['pack'][$editk];
                    $mongo[$editk]['news'] = $edit['new']['pack'][$editk];
                } else if ($editk == 'img') {
                    $mongo[$editk]['add'] = $edit['edit']['addimg'];
                    $mongo[$editk]['del'] = $edit['edit']['delimg'];
                } else if ($editk == 'UpdateTime') {
                    
                } else if ($editk == 'IsSale') {
                    $mongo[$editk]['old'] = $edit['old'][$editk];
                    $mongo[$editk]['news'] = $edit['new'][$editk];
                    if ($edit['old'][$editk] && !$edit['new'][$editk]) {
                        $type = 'under';
                    } else if (!$edit['old'][$editk] && $edit['new'][$editk]) {
                        $type = 'top';
                    }
                } else {
                    $mongo[$editk]['old'] = $edit['old'][$editk];
                    $mongo[$editk]['news'] = $edit['new'][$editk];
                }
            }
        }
        if ($mongo) {
            $editarr = array(
                'GoodsID' => (int) $edit['new']['ID'],
                'UpdateTime' => (int) $edit['new']['UpdateTime'],
                'EditInfo' => $mongo,
                'type' => $type,
            );
            Yii::app()->mongodb->getDbInstance()->goods_log->insert($editarr);
        }
    }

    /*
     * 查看商品是否修改
     */

    public static function goodsedit($Goods, $Ver, $Veh) {
        $GoodsID = (int) $Goods;
        $Version = (int) $Ver;
        $VehVersion = (int) $Veh;
        $goodslog = Yii::app()->mongodb->getDbInstance()->goods_log->distinct('EditInfo', array("GoodsID" => $GoodsID, 'UpdateTime' => array('$gt' => $Version), 'type' => 'edit'));
        $vehlog = Yii::app()->mongodb->getDbInstance()->vehicle_log->distinct('UpdateTime', array("GoodsID" => $GoodsID, 'UpdateTime' => array('$gt' => $VehVersion)));
        return array(
            'countgoods' => count($goodslog),
            'countveh' => count($vehlog)
        );
    }

    /*
     * 获得修改信息
     */

    public static function goodseditinfo($Goods, $Ver, $Veh) {
        $GoodsID = (int) $Goods;
        $Version = (int) $Ver;
        $VehVersion = (int) $Veh;
        $goodslog = Yii::app()->mongodb->getDbInstance()->goods_log->distinct('EditInfo', array("GoodsID" => $GoodsID, 'UpdateTime' => array('$gt' => $Version), 'type' => 'edit'));
        if ($goodslog) {
            foreach ($goodslog as $key1 => $value1) {
                foreach ($value1 as $key2 => $value2) {
                    if ($value2['new']) {
                        $goodslog[$key1][$key2]['news'] = $value2['new'];
                    }
                }
            }
        }
        $vehlog = Yii::app()->mongodb->getDbInstance()->vehicle_log->distinct('VehInfo', array("GoodsID" => $GoodsID, 'UpdateTime' => array('$gt' => $VehVersion)));
        return array(
            'goodslog' => $goodslog,
            'vehlog' => $vehlog,
        );
    }

    /*
     * 品牌查询-通过code
     */

    public static function codegetbrand($code) {
        $Organ = Yii::app()->user->getOrganID();
        $codesql = "select BrandID from pap_brand_relation where Code='" . $code . "'";
        $codearr = Yii::app()->papdb->createCommand($codesql)->queryAll();
        $dealersql = "select BrandID from pap_dealer_brand where OrganID=" . $Organ;
        $dealerarr = Yii::app()->papdb->createCommand($dealersql)->queryAll();
        foreach ($codearr as $codev) {
            $codearrs[] = $codev['BrandID'];
        }
        foreach ($dealerarr as $dealerv) {
            $dealerarrs[] = $dealerv['BrandID'];
        }
        if ($dealerarrs && $codearrs) {
            $arr = array_intersect($codearrs, $dealerarrs);
            if ($arr) {
                foreach ($arr as $arrv) {
                    if ($arrvs) {
                        $arrvs .=',';
                    } else {
                        $arrvs = '(';
                    }
                    $arrvs .=$arrv;
                }
                $arrvs .=')';
                $brandsql = "select * from pap_brand where ID in " . $arrvs;
                $brandarr = Yii::app()->papdb->createCommand($brandsql)->queryAll();
                foreach ($brandarr as $brandv) {
                    $brandarrs[$brandv['ID']] = $brandv['BrandName'];
                }
                return $brandarrs;
            }
        }
    }

    /*
     * 品牌查询-通过organ
     */

    public static function dealergetbrand() {
        $Organ = Yii::app()->user->getOrganID();
        $dealersql = "SELECT * FROM pap_dealer_brand deb join `pap_brand` jpb on deb.BrandID=jpb.ID where OrganID=" . $Organ;
        $dealerarr = Yii::app()->papdb->createCommand($dealersql)->queryAll();
        return $dealerarr;
//        var_dump($dealerarr);
//        foreach ($dealerarr as $dealerv) {
//            $dealerarrs[] = $dealerv['BrandID'];
//        }
//        if ($dealerarrs) {
//            foreach ($arr as $arrv) {
//                $brandsql = "select * from pap_jpbrand where ID=" . $arrv;
//            }
//            $brandarr = Yii::app()->papdb->createCommand($brandsql)->queryAll();
//            foreach ($brandarr as $brandv) {
//                $brandarrs[$brandv['ID']] = $brandv['Name'];
//            }
//            return $brandarrs;
//        }
    }

    /*
     * 修改商品版本数据
     */

    public static function UpdateMdbgoodsversion() {

        $model = Yii::app()->mongodb->getDbInstance()->goods_version->distinct('_id', array('GoodsID' => array('$type' => 2)));
        if (!$model) {
            $model = Yii::app()->mongodb->getDbInstance()->goods_version->distinct('_id', array('Version' => array('$type' => 2)));
        }
        if (!$model) {
            $model = Yii::app()->mongodb->getDbInstance()->goods_version->distinct('_id', array('VehVersion' => array('$type' => 2)));
        }
        if (!$model) {
            echo '暂无需要更新的数据';
            exit;
        }
        foreach ($model as $key => $mvalue) {
            $result = MdbGoodsVersion::model()->findByPk($mvalue);
            $Goodsarr = array(
                'GoodsID' => (int) $result->GoodsID,
                'GoodsInfo' => $result->GoodsInfo,
                'Version' => (int) $result->Version,
                'VehVersion' => (int) $result->VehVersion,
            );
            if ($key == 1000) {
                echo $key;
                exit;
            }
            Yii::app()->mongodb->getDbInstance()->goods_version->insert($Goodsarr);
            $results = MdbGoodsVersion::model()->deleteByPk($mvalue);
//            $res = Yii::app()->mongodb->getDbInstance()->vehcle_version->findOne(array("GoodsID" => (int) $result->GoodsID, "Organ" => (int) $result->Organ,'VehVersion'=>(int) $result->VehVersion));
        }




//        $c = new EMongoCriteria();
//        $res = MdbGoodsVersion::model()->findAll($c);
//        foreach ($res as $mvalus) {
//            if (!is_int($mvalus->GoodsID) || !is_int($mvalus->Version) || !is_int($mvalus->VehVersion)) {
//                $Goodsarr = array(
//                    'GoodsID' => (int) $mvalus->GoodsID,
//                    'GoodsInfo' => $mvalus->GoodsInfo,
//                    'Version' => (int) $mvalus->Version,
//                    'VehVersion' => (int) $mvalus->VehVersion,
//                );
//                Yii::app()->mongodb->getDbInstance()->goods_version->insert($Goodsarr);
//                $id = new MongoId($mvalus->_id);
//                $result = MdbGoodsVersion::model()->deleteByPk($id);
//            }
//        }
    }

    /*
     * 修改车系版本数据
     */

    public static function UpdateMdbvehcleversion() {

        $model = Yii::app()->mongodb->getDbInstance()->vehcle_version->distinct('_id', array('GoodsID' => array('$type' => 2)));
        if (!$model) {
            $model = Yii::app()->mongodb->getDbInstance()->vehcle_version->distinct('_id', array('Organ' => array('$type' => 2)));
        }
        if (!$model) {
            $model = Yii::app()->mongodb->getDbInstance()->vehcle_version->distinct('_id', array('VehVersion' => array('$type' => 2)));
        }
        if (!$model) {
            echo '暂无需要更新的数据';
            exit;
        }
        foreach ($model as $key => $mvalue) {
            $result = MdbVehcleVersion::model()->findByPk($mvalue);
            $Goodsarr = array(
                'GoodsID' => (int) $result->GoodsID,
                'VehcleInfo' => $result->VehcleInfo,
                'Organ' => (int) $result->Organ,
                'VehVersion' => (int) $result->VehVersion,
            );
            if ($key == 1000) {
                echo $key;
                exit;
            }
            Yii::app()->mongodb->getDbInstance()->vehcle_version->insert($Goodsarr);
            $results = MdbVehcleVersion::model()->deleteByPk($mvalue);
//            $res = Yii::app()->mongodb->getDbInstance()->vehcle_version->findOne(array("GoodsID" => (int) $result->GoodsID, "Organ" => (int) $result->Organ,'VehVersion'=>(int) $result->VehVersion));
        }
    }

    /*
     * 修改商品日志数据
     */

    public static function UpdateMdbgoodslog() {
        $model = Yii::app()->mongodb->getDbInstance()->goods_log->distinct('_id', array('GoodsID' => array('$type' => 2)));
        if (!$model) {
            $model = Yii::app()->mongodb->getDbInstance()->goods_log->distinct('_id', array('UpdateTime' => array('$type' => 2)));
        }
        if (!$model) {
            echo '暂无需要更新的数据';
            exit;
        }
        foreach ($model as $key => $mvalue) {
            $result = MdbGoodsLog::model()->findByPk($mvalue);
            $Logarr = array(
                'GoodsID' => (int) $result->GoodsID,
                'UpdateTime' => (int) $result->UpdateTime,
                'EditInfo' => $result->EditInfo,
                'type' => $result->type,
            );
            if ($key == 1000) {
                echo $key;
                exit;
            }
            Yii::app()->mongodb->getDbInstance()->goods_log->insert($Logarr);
            $results = MdbGoodsLog::model()->deleteByPk($mvalue);
//            $res = Yii::app()->mongodb->getDbInstance()->vehcle_version->findOne(array("GoodsID" => (int) $result->GoodsID, "Organ" => (int) $result->Organ,'VehVersion'=>(int) $result->VehVersion));
        }



//        $c = new EMongoCriteria();
//        $res = MdbGoodsLog::model()->findAll($c);
//        foreach ($res as $mvalus) {
//            if (!is_int($mvalus->GoodsID) || !is_int($mvalus->UpdateTime)) {
//                $Logarr = array(
//                    'GoodsID' => (string) $mvalus->GoodsID,
//                    'UpdateTime' => (int) $mvalus->UpdateTime,
//                    'EditInfo' => $mvalus->EditInfo,
//                    'type' => $mvalus->type,
//                );
//                Yii::app()->mongodb->getDbInstance()->goods_log->insert($Logarr);
//                $id = new MongoId($mvalus->_id);
//                $result = MdbGoodsLog::model()->deleteByPk($id);
//            }
//        }
    }

    /*
     * 修改车系日志数据
     */

    public static function UpdateMdbvehclelog() {
        $model = Yii::app()->mongodb->getDbInstance()->vehcle_log->distinct('_id', array('GoodsID' => array('$type' => 2)));
        if (!$model) {
            $model = Yii::app()->mongodb->getDbInstance()->vehcle_log->distinct('_id', array('UpdateTime' => array('$type' => 2)));
        }
        if (!$model) {
            echo '暂无需要更新的数据';
            exit;
        }
        foreach ($model as $key => $mvalue) {
            $result = MdbVehcleLog::model()->findByPk($mvalue);
            $Logarr = array(
                'GoodsID' => (int) $result->GoodsID,
                'UpdateTime' => (int) $result->UpdateTime,
                'VehInfo' => $result->VehInfo,
                'type' => $result->type,
            );
            if ($key == 1000) {
                echo $key;
                exit;
            }
            Yii::app()->mongodb->getDbInstance()->vehcle_log->insert($Logarr);
            $results = MdbVehcleLog::model()->deleteByPk($mvalue);
//            $res = Yii::app()->mongodb->getDbInstance()->vehcle_version->findOne(array("GoodsID" => (int) $result->GoodsID, "Organ" => (int) $result->Organ,'VehVersion'=>(int) $result->VehVersion));
        }



//
//        $c = new EMongoCriteria();
//        $res = MdbVehcleLog::model()->findAll($c);
//        foreach ($res as $mvalus) {
//            if (!is_int($mvalus->GoodsID) || !is_int($mvalus->UpdateTime)) {
//                $Logarr = array(
//                    'GoodsID' => (string) $mvalus->GoodsID,
//                    'UpdateTime' => (int) $mvalus->UpdateTime,
//                    'VehInfo' => $mvalus->VehInfo,
//                    'type' => $mvalus->type,
//                );
//                Yii::app()->mongodb->getDbInstance()->vehcle_log->insert($Logarr);
//                $id = new MongoId($mvalus->_id);
//                $result = MdbVehcleLog::model()->deleteByPk($id);
//            }
//        }
    }

    /*
     * 修改商品接口
     */

    public static function editgoods($goods) {
        $organID = Yii::app()->user->getOrganID();
        $goodsID = $goods['GoodsID'];
        if ($goods) {
            $data['Name'] = trim($goods['Name']);
            if (trim($goods['Pinyin']) == "") {
                $pinyin = F::Pinyin1($goods['Name']); // 如果未输入拼音则自动添加拼音
            } else {
                $pinyin = trim($goods['Pinyin']);
            }
            $data['IsSale'] = 0; //商品默认不上架
            $data['Pinyin'] = $pinyin;
            $data['GoodsNO'] = trim($goods['GoodsNO']);     // 商品编号
            $data['PartsLevel'] = trim($goods['PartsLevel']);
            $data['Memo'] = trim($goods['Memo']);
            $data['Price'] = trim($goods['Price']);
            if (!empty($goods['goodsBrand'])) {
                $data['BrandID'] = trim($goods['goodsBrand']);    // id
            }
            $data['StandCode'] = $goods['StandCode'];           // 标准名称txt
            $data['Info'] = $goods['Info'];
            $data['Provenance'] = $goods['Provenance'];
            $model = PapGoods::model()->findByPk($goodsID);
            $model->attributes = $data;
            $oenos = $goods['OENOS'] ? $goods['OENOS'] : $goods['OENO'];
            if ($oenos) {
                foreach ($oenos as $value) {
                    $oe .=$value . ' ';
                }
            } else {
                $oe = '';
            }
            $model->Title = $data['Name'] . ' ' . $data['GoodsNO'] . ' ' . $pinyin . ' ' . $data['Brand'] . ' ' . $oe . ' ' . $goods['cpname'];
            $edtitime = $model->UpdateTime = time();
            $goodsold = DealergoodsService::newgoodsxinfo($goodsID);
            if ($model->save()) {
                // 把主营车系添加到商品车系关系表
                if ($goods["make"]) {
                    DealergoodsService::editvehiclegoods($goodsID, $organID, $edtitime, $goods);
                }
                // 把OENO号添加到关系表里
                if ($goods['OENOS']) {
                    DealergoodsService::editoegoods($goodsID, $organID, $goods);
                }
                // 添加商品图片
                if ($goods['urlimg']) {
                    DealergoodsService::editimggoods($goodsID, $organID, $goods);
                }
                // 添加商品属性
                DealergoodsService::editspecgoods($goodsID, $goods);
                // 添加商品包装
                DealergoodsService::editpackgoods($goodsID, $goods);
                $goodsnew = DealergoodsService::newgoodsxinfo($goodsID);
                $edit = DealergoodsService::goodsversion($goodsnew, $goodsold);
                DealergoodsService::editgoodslog($edit);
                $rs = array('success' => 1, 'errorMsg' => '修改数据成功', 'status' => 'save');
            } else {
                foreach ($model->errors as $key => $value) {
                    if ($key == 0)
                        $errorMsg = $value['0'];
                }
                $rs = array('success' => 0, 'errorMsg' => $errorMsg, 'status' => 'save');
            }
        }
    }

    /*
     * 修改商品接口商品-把主营车系添加到商品车系关系表
     */

    public static function editvehiclegoods($pid, $organID, $time, $goods) {
        $make = explode(',', $goods["make"]);
        $car = explode(',', $goods["car"]);
        $year = explode(',', $goods["year"]);
        $model2 = explode(',', $goods["model"]);
        $maketext = explode(',', $goods["maketxt"]);
        $cartext = explode(',', $goods["cartxt"]);
        $modeltext = explode(',', $goods["modeltxt"]);
        $vehlegth = count($make);
        for ($i = 0; $i < $vehlegth; $i++) {
            if ($make[$i] != 0) {
                $goodsv = new PapGoodsVehicleRelation();
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
                $vehicles[] = $vehicle = array('Type' => 'add', 'Make' => $make[$i], 'Car' => $car[$i], 'Year' => $year[$i], 'Model' => $model2[$i], 'Marktxt' => $maketext[$i], 'Cartxt' => $cartext[$i], 'Modeltxt' => $modeltext[$i]);
                $veharr = array(
                    'GoodsID' => (int) $pid,
                    'UpdateTime' => (int) $time,
                    'VehInfo' => $vehicle,
                    'Type' => 'add',
                );
                Yii::app()->mongodb->getDbInstance()->vehicle_log->insert($veharr);
            }
        }
    }

    /*
     * 经销商发布商品-把OE号添加到OE表中
     */

    public static function editoegoods($pid, $organID, $goods) {
        $oenos = $goods['OENOS'];
        $oelegth = count($oenos);
        for ($i = 0; $i < $oelegth; $i++) {
            $goodsoeno = new PapGoodsOeRelation();
            $goodsoeno->OrganID = $organID;
            $goodsoeno->GoodsID = $pid;
            $goodsoeno->OENO = $oenos[$i];
            $goodsoeno->CreateTime = time();
            $goodsoeno->save();
            $oeno[$i] = $oenos[$i];
        }
        return $oeno;
    }

    /*
     * 经销商发布商品-把商品图片添加发到图片表中
     */

    public static function editimggoods($pid, $organID, $goods) {
        $urlimg = explode(',^', $goods['urlimg']); //根据逗号拆分，得到图片信息的字符串
        $sqlimg = "insert into pap_goods_image_relation (OrganID,GoodsID,ImageUrl,CreateTime,ImageName,MallImage,BigImage) values";
        foreach ($urlimg as $k => $value) {
            $addimg = explode(';', $value); //根据分号拆分，得到图片的相关信息
            if ($k) {
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
            $sqlimg .="','";
            $sqlimg .=str_replace('/small/', '/thumb/', $addimg[0]); //缩略小图url
            $sqlimg .="','";
            $sqlimg .=str_replace('/small/', '/normal/', $addimg[0]); //原图url
            $sqlimg .="')";
            $img[$k - 1] = array('ImageUrl' => $addimg[0], 'ImageName' => $addimg[1]);
        }
        Yii::app()->papdb->createCommand($sqlimg)->execute();
    }

    /*
     * 经销商发布商品-把商品属性添加到属性表中
     */

    public static function editspecgoods($pid, $goods) {
        $goodsspec['ValidityType'] = $goods['ValidityType']; // 保质期类型
        if ($goodsspec['ValidityType'] == 3) {
            $goodsspec['ValidityDate'] = $goods['ValidityDate'] . $goods['dataday']; // 保质期
        }
        $goodsspec['BganCompany'] = $goods['BganCompany']; // 标杆公司
        $goodsspec['BganGoodsNO'] = $goods['BganGoodsNO']; // 标杆商品号
        $goodsspec['Unit'] = $goods['Unit'];      // 配件单位
        $psid = PapGoodsSpec::model()->find("GoodsID=$pid")->attributes['ID'];
        $goodssp = PapGoodsSpec::model()->findByPk($psid);
        if (empty($psid)) {
            $goodssp = new PapGoodsSpec();
        }
        $goodssp->attributes = $goodsspec;
        $goodssp->GoodsID = $pid;
        $goodssp->save();
    }

    /*
     * 经销商发布商品-把商品包装属性添加到包装属性表中
     */

    public static function editpackgoods($pid, $goods) {
        $goodspack['MinQuantity'] = $goods['MinQuantity'];    //

        $pcid = PapGoodsPack::model()->find("GoodsID=$pid")->attributes['ID'];
        $goodspc = PapGoodsPack::model()->findByPk($pcid);
        if (empty($pcid)) {
            $goodspc = new PapGoodsPack();
        }
        $goodspc->attributes = $goodspack;
        $goodspc->GoodsID = $pid;
        $goodspc->save();
        $arr['MinQuantity'] = $goodspack['MinQuantity'];
    }

    /*
     * 获得每日爆款商品
     */

    public static function gethotgoods() {
        $week = date('W', time());
        $w = date('w', time());
        if ($week == '01') {
            $year = date("Y", time() + 60 * 60 * 24 * 7);
        } else {
            $year = date("Y", time());
        }
        $CarryTime = strtotime($year . '-W' . $week) ? strtotime($year . '-W' . $week) : strtotime($year . '-W0' . $week);
        $selectsql = "select * from cs_carry where CarryTime = " . $CarryTime;
        $carry = Yii::app()->csdb->createCommand($selectsql)->queryAll();
        if ($carry) {
            $selectsql = "select * from cs_carry_goods where CarryID = " . $carry[0]['ID'] . " and Week = " . $w;
            $carry[0]['carrygoods'] = Yii::app()->csdb->createCommand($selectsql)->queryAll();
            if ($carry[0]['carrygoods']) {
                foreach ($carry[0]['carrygoods'] as $k => $v) {
                    $carry[0]['carrygoods'][$k]['Goodsinfo'] = MallService::getredis($v['GoodsID'], 'search');
                }
                return $carry[0];
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    }

}

?>
