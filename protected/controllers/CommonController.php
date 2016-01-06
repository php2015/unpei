<?php

class CommonController extends Controller {

    /**
     * 根据系统获取标准名称
     * Enter description here ...
     */
    public function actionGetcp_name() {
        echo CHtml::tag("option", array("value" => ''), '请选择品类', true);
        if ($_GET['system_type']) {
            $type = $_GET['system_type'];
            $encode = mb_detect_encoding($type, array("ASCII", 'UTF-8', "GB2312", "GBK", "BIG5"));
            //	echo $encode;exit;
            if ($encode != "UTF-8") {
                $type = mb_convert_encoding($_GET['system_type'], "utf8", "gbk");
            }
            $data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $type));
//        	$sql="select cp_name from tbl_goods_standard where system_type='{$type}'";
//	        file_put_contents("D://text.txt", $sql);
//	        $data=Yii::app()->db->createCommand($sql)->queryAll();
            $data = CHtml::listData($data, "cp_name", "cp_name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionGetcpnames() {
        echo CHtml::tag("option", array("value" => ''), '请选择品类', true);
        if ($_GET['system_type']) {
            $type = $_GET['system_type'];
            $encode = mb_detect_encoding($type, array("ASCII", 'UTF-8', "GB2312", "GBK", "BIG5"));
            //	echo $encode;exit;
            if ($encode != "UTF-8") {
                $type = mb_convert_encoding($_GET['system_type'], "utf8", "gbk");
            }
            $data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $type));
            //        	$sql="select cp_name from tbl_goods_standard where system_type='{$type}'";
            //	        file_put_contents("D://text.txt", $sql);
            //	        $data=Yii::app()->db->createCommand($sql)->queryAll();
            $data = CHtml::listData($data, "id", "cp_name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
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

    public function actionDynamicareas() {
        echo CHtml::tag("option", array("value" => ''), '请选择区', true);
        if ($_GET["city"]) {
            $data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $_GET["city"]));

            $data = CHtml::listData($data, "ID", "Name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
//        if(emtpy($_GET["city"]))
//        {
//        	echo CHtml::tag("option", array("value" => ''), '请选择地区', true);
//        }
    }

    public function actionDynamiccity() {
        echo CHtml::tag("option", array("value" => ''), '请选择市', true);
        if ($_GET['Province']) {
            $data = JpdArea::model()->findAll("ParentID=:parent_id", array(":parent_id" => $_GET['Province']));

            $data = CHtml::listData($data, "ID", "Name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
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

    /**
     * 根据车型获取车系
     * Enter description here ...
     */
    public function actionGetcar() {
        echo CHtml::tag("option", array("value" => ''), '请选择车系', true);
        if ($_GET["make"]) {
            $data = TransportCar::model()->findAll("Make=:Make", array(":Make" => $_GET["make"]));

            $data = CHtml::listData($data, "Code", "Car");
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    /**
     * 根据主组获取子组
     * Enter description here ...
     */
    public function actionGetchildren() {
        echo CHtml::tag("option", array("value" => ''), '请选择子组', true);
        if ($_GET["father"]) {
            $data = MakePartsGroupChildren::model()->findAll("father=:father", array(":father" => $_GET["father"]));

            $data = CHtml::listData($data, "code", "category_children");
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    /**
     * 删除列表选择的数据
     */
    public function actionDelall() {
        if ($_GET['ids']) {
            $ids = $_GET['ids'];
            $ids = implode(',', $ids);
            $conditions = "id in ({$ids})";
            switch ($_GET['key']) {
                case 'emp' :$return = MakeEmpowerDealer::model()->deleteAll($conditions);
                    break;
                case 'tech':$return = MakeTechniqueService::model()->deleteAll($conditions);
                    break;
                case 'cont':$return = MakeContacts::model()->deleteAll($conditions);
                    break;
                case 'dis' :$return = MakeDistributionBusiness::model()->deleteAll($conditions);
                    break;
                case 'emca':$return = MakeEmpowerCategory::model()->deleteAll($conditions);
                    MakeEmpowerCategoryRelation::model()->deleteAll("cate_id in ({$ids})");
                    break;
                case 'stor':$return = MakeStorageService::model()->deleteAll($conditions);
                    break;
            }
        }
        echo $return;
    }

    /**
     * 单个删除列表中的数据
     */
    public function actionDelete() {
        if ($_GET['id']) {
            switch ($_GET['key']) {
                case 'emp' :$return = MakeEmpowerDealer::model()->deleteByPk($_GET['id']);
                    break;
                case 'tech':$return = MakeTechniqueService::model()->deleteByPk($_GET['id']);
                    break;
                case 'cont':$return = MakeContacts::model()->deleteByPk($_GET['id']);
                    break;
                case 'dis' :$return = MakeDistributionBusiness::model()->deleteByPk($_GET['id']);
                    break;
                case 'emca':$return = MakeEmpowerCategory::model()->deleteByPk($_GET['id']);
                    MakeEmpowerCategoryRelation::model()->deleteAll("cate_id = {$_GET['id']}");
                    break;
                case 'stor':$return = MakeStorageService::model()->deleteByPk($_GET['id']);
                    break;
            }
        }
        echo $return;
    }

    public function actionGetcpname() {
        echo CHtml::tag("option", array("value" => ''), '请选择品类', true);
        if ($_GET['system_type']) {
            $data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $_GET['system_type']));

            $data = CHtml::listData($data, "cp_name", "cp_name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    public function actionGetsubparts() {
        // echo CHtml::tag("option", array("value" => ''), '请选择配件子类', true);
        if ($_GET["bigcode"]) {
            //$brand =  GoodsBrand::model()->find('id='.$_GET['make']);
            $data = DealerSubparts::model()->findAll("BigCode=:BigCode", array(":BigCode" => $_GET["bigcode"]));

            $data = CHtml::listData($data, "SubCode", "SubParts");
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    /**
     * 获取标准名称
     */
    public function actiongetnormname() {
        //  echo CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
        if ($_GET["subcode"]) {
            //$brand =  GoodsBrand::model()->find('id='.$_GET['make']);
            $data = DealerCpname::model()->findAll("SubCode=:SubCode", array(":SubCode" => $_GET["subcode"]));

            $data = CHtml::listData($data, "ID", "CpName");
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    /**
     * 通过配件大类过去标准名称
     */
    public function actionGetcpnamebybigp() {
        if ($_GET["bigcode"]) {
            $subparts = DealerSubparts::model()->find("BigCode=:BigCode", array(":BigCode" => $_GET["bigcode"]));
            //   $subparts = DealerSubparts::model()->findAll('BigCode='.$_GET["bigcode"]]);
            //  foreach ($subparts as $ci) {
            $data = DealerCpname::model()->findAll("SubCode=:SubCode", array(":SubCode" => $subparts['SubCode']));
            $data = CHtml::listData($data, "ID", "CpName");
            //       break;
            //  }
            echo json_encode($data);
        }
    }

    // 根据品牌查车系
    public function actionGetcarbyid() {
        echo CHtml::tag("option", array("value" => ''), '请选择车系', true);
        if ($_GET["make"]) {
            $brand = GoodsBrand::model()->find('id=' . $_GET['make']);
            $data = GoodsBrand::model()->findAll("name=:Make", array(":Make" => $brand['name']));

            $data = CHtml::listData($data, "id", "car");
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    // 根据车系查年款
    public function actionGetyearbyid() {
        echo CHtml::tag("option", array("value" => ''), '请选择年款', true);
        if ($_GET["car"]) {
            $brand = GoodsBrand::model()->find('id=' . $_GET['car']);
            $data = GoodsBrand::model()->findAll("car=:car", array(":car" => $brand['car']));

            $data = CHtml::listData($data, "id", "year");
            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    //获取前市场车系
    public function actionQueryMake() {
        echo CHtml::tag("option", array("value" => ''), '请选择车系', true);
        $make = $_GET['make'];
        $sql = "select distinct a.make from jpd_vehicle a where a.VehicleID='$make' order by CONVERT(make USING gb2312)";
        $result = DBUtil::query($sql);
        $makes = $result['make'];
        if ($makes) {
            $sql = "select distinct a.car,a.vehicleID from jpd_vehicle a "
                    . "  where a.make = :make and a.car is not null group by a.car order by CONVERT(car USING gb2312)";
            $sqlParams = array(':make' => $makes);
            $data = DBUtil::queryAll($sql, $sqlParams);
            $data = CHtml::listData($data, "vehicleID", "car");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
    }

    /**
     * 获取商品子类
     */
    public function actionDynamicSubcates() {
        if (empty($_POST["mainCategory"])) {
            $dropDownSubcates = CHtml::tag("option", array("value" => ''), '请选择子类', true);
            $dropDownLeafcates = CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
            echo CJSON::encode(array(
                'dropDownSubCategorys' => $dropDownSubcates,
                'dropDownLeafCategorys' => $dropDownLeafcates,
            ));
            Yii::app()->end();
        }

        //SubCates
        $subcates = Gcategory::model()->findAll('ParentID=:parent_id', array(':parent_id' => (int) $_POST['mainCategory']));
        $subcates = CHtml::listData($subcates, 'ID', 'Name');
        //	$dropDownSubcates = CHtml::tag("option", array("value" => ''), '请选择子类', true);
        $selectedSubcate = 0;
        foreach ($subcates as $value => $name) {
            if (!$selectedSubcate) {
                $selectedSubcate = $value;
            }
            $dropDownSubcates .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }

        //LeafCates
        // $leafcates = Gcategory::model()->findAll('parent_id=:parent_id', array(':parent_id' => $selectedSubcate));
        //$leafcates = Gcategory::model()->findAll('parent_id= {$selectedSubcate} order by name desc');
        $leafcates = Gcategory::model()->findAll(array(
            "condition" => "ParentID= {$selectedSubcate}",
            "order" => "SUBSTR(Pinyin,1,1),Name"
        ));
        $leafcates = CHtml::listData($leafcates, 'ID', 'Name');
        //$dropDownLeafcates = CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
        foreach ($leafcates as $value => $name) {
            $dropDownLeafcates .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }

        //return data(JSON formatted)
        echo CJSON::encode(array(
            'dropDownSubCategorys' => $dropDownSubcates,
            'dropDownLeafCategorys' => $dropDownLeafcates,
        ));
    }

    /**
     * 获取商品子类，不联动
     */
    public function actionDynamicSubcates2() {
        if (empty($_POST["mainCategory"])) {
            $dropDownSubcates = CHtml::tag("option", array("value" => ''), '请选择子类', true);
            $dropDownLeafcates = CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
            echo CJSON::encode(array(
                'dropDownSubCategorys' => $dropDownSubcates,
                'dropDownLeafCategorys' => $dropDownLeafcates,
            ));
            Yii::app()->end();
        }

        //SubCates
        $subcates = Gcategory::model()->findAll('ParentID=:parent_id', array(':parent_id' => (int) $_POST['mainCategory']));
        $subcates = CHtml::listData($subcates, 'ID', 'Name');
        $dropDownSubcates = CHtml::tag("option", array("value" => ''), '请选择子类', true);
        $selectedSubcate = 0;
        foreach ($subcates as $value => $name) {
            if (!$selectedSubcate) {
                $selectedSubcate = $value;
            }
            $dropDownSubcates .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }

        //LeafCates
        // $leafcates = Gcategory::model()->findAll('parent_id=:parent_id', array(':parent_id' => $selectedSubcate));
        $leafcates = Gcategory::model()->findAll(array(
            "condition" => "ParentID= {$selectedSubcate}",
            "order" => "Name desc"
        ));
        $leafcates = CHtml::listData($leafcates, 'ID', 'Name');
        $dropDownLeafcates = CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
//    	foreach($leafcates as $value=>$name){
//    		$dropDownLeafcates .= CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
//    	}
        //return data(JSON formatted)
        echo CJSON::encode(array(
            'dropDownSubCategorys' => $dropDownSubcates,
            'dropDownLeafCategorys' => $dropDownLeafcates,
        ));
    }

    /**
     * 获取商品标准名称
     */
    public function actionDynamicLeafcates() {
        if (!empty($_POST["subCategory"])) {
            $data = Gcategory::model()->findAll('ParentID=:parent_id ORDER BY SUBSTR(Pinyin,1,1),Name', array(':parent_id' => (int) $_POST['subCategory']));
            $data = CHtml::listData($data, 'ID', 'Name');
//            echo CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
            foreach ($data as $value => $name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        } else {
            echo CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
        }
    }

    /**
     * 获取商品标准名称 ,不联动
     */
    public function actionDynamicLeafcates2() {
        $data = Gcategory::model()->findAll('ParentID=:parent_id', array(':parent_id' => (int) $_POST['subCategory']));
        $data = CHtml::listData($data, 'ID', 'Name');
        echo CHtml::tag("option", array("value" => ''), '请选择标准名称', true);
        ;
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actiongetSubCategorys() {
        $mainCategory = $make = Yii::app()->request->getParam('mainCategory');
        $subCategory = D::getSubCategorys($mainCategory);
        echo json_encode($subCategory);
    }

    public function actiongetLeafCategorys() {
        $subCategory = $make = Yii::app()->request->getParam('subCategory');
        $LeafCategorys = D::getLeafCategorys($subCategory);

        $firstA = array();
        foreach ($LeafCategorys as $key => $value) {
            $firstA[$key] = substr($this->checkFirstName($value[2]), 0, 1);
        }

        $unique_a = array_unique($firstA);
        sort($unique_a);
        $i = 0;
        foreach ($unique_a as $key => $val) {
            $new_models2[$key]['first'] = $val;
            $i = 0;
            foreach ($LeafCategorys as $key2 => $val2) {
                $f = substr($this->checkFirstName($val2[2]), 0, 1);
                if ($val == $f) {
                    $new_models2[$key]['children'][$i] = $val2;
                    $i++;
                }
            }
        }
        echo json_encode($new_models2);
    }

    private function checkFirstName($subject) {
        $pattern = '/[A-Za-z]+/';
        preg_match($pattern, $subject, $matches);
        return $matches[0];
    }

    // 拼音查询
    public function actiongetLeafCategorysofp() {
        $subCategory = Yii::app()->request->getParam('subCategory');
        $pinyin = Yii::app()->request->getParam('pinyin');
        $LeafCategorys = D::getLeafCategorysofp($subCategory, $pinyin);
        $firstA = array();
        $new_models2 = array();
        foreach ($LeafCategorys as $key => $value) {
            $firstA[$key] = substr($this->checkFirstName($value['Pinyin']), 0, 1);
        }
        $unique_a = array_unique($firstA);
        sort($unique_a);
        $i = 0;
        foreach ($unique_a as $key => $val) {
            $new_models2[$key]['first'] = $val;
            $i = 0;
            foreach ($LeafCategorys as $key2 => $val2) {
                $f = substr($this->checkFirstName($val2['Pinyin']), 0, 1);
                if ($val == $f) {
                    $new_models2[$key]['children'][$i] = $val2;
                    $i++;
                }
            }
        }
        echo json_encode($new_models2);
    }

    // 拼音查询-车型
    public function actiongetLeafCarsofp() {
        $pinyin = Yii::app()->request->getParam('pinyin');
        $LeafCategorys = D::getLeafCarsofp($pinyin);
        $firstA = array();
        $new_models2 = array();
        foreach ($LeafCategorys as $key => $value) {
            $firstA[$key] = substr($this->checkFirstName($value['Pinyin']), 0, 1);
        }
        $unique_a = array_unique($firstA);
        sort($unique_a);
        $i = 0;
        foreach ($unique_a as $key => $val) {
            $i = 0;
            foreach ($LeafCategorys as $key2 => $val2) {
                $f = substr($this->checkFirstName($val2['Pinyin']), 0, 1);
                if ($val == $f) {
                    $new_models2[$key][$i] = $val2;
                    $i++;
                }
            }
        }
        echo json_encode($new_models2[0]);
    }

    // 拼音查询-车型
    public function actiongetLeafMakesofp() {
        $brandid = Yii::app()->request->getParam('brandid');
        $makes = D::getLeafMakesofp($brandid);
        echo json_encode($makes);
    }

    // 关键字查询 
    public function actiongetleafcategorysofkey() {
        $cpnames = Yii::app()->request->getParam('cpname');
        $patterns = array('/<<q/', '/%/', '/_/', '/\[/', '/\]/', '/\'/', '/q>>/');
        $replacements = array('/', '\\\\\%', '\\\\\_', '\\\\\[', '\\\\\]', '\\\\\'', '\\\\\\\\\\');
        $keyword2 = preg_replace($patterns, $replacements, $cpnames);
        $cpname = str_replace(' ', '%', $keyword2);
        $sql = " select ID,Name,ParentID,Code from jpd_gcategory where name like '%{$cpname}%' OR pinyin like '{$cpname}%' and IsShow = 1 order by SortOrder asc ";
        $datas = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $array_cate = array();
        if (!$datas) {
            echo json_encode($array_cate);
            exit();
        }
        $parent_id = '';
        foreach ($datas as $key => $value) {
            $array_cate[$key]['cpname'] = $value['Name'];
            $array_cate[$key]['cpnameid'] = $value['Id'];
            $array_cate[$key]['parent_id'] = $value['ParentID'];
            if ($value['Code']) {
                $array_cate[$key]['code'] = $value['Code'];
            }
            if ($key != 0) {
                $parent_id .= ',' . $value['ParentID'];
            } else {
                $parent_id .= $value['ParentID'];
            }
        }

        $subsql = "select ID,Name,ParentID,Code from jpd_gcategory where ID in ( $parent_id ) ";
        $subdatas = Yii::app()->jpdb->createCommand($subsql)->queryAll();
        $bparent_id = '';
        foreach ($subdatas as $key => $value) {
            foreach ($array_cate as $k => $v) {
                if ($v['parent_id'] == $value['ID']) {
                    $array_cate[$k]['subname'] = $value['Name'];
                    $array_cate[$k]['subnameid'] = $value['ID'];
                    $array_cate[$k]['parent_id'] = $value['ParentID'];
                    if ($value['Code']) {
                        $array_cate[$k]['code'] = $value['Code'];
                    }
                }
            }
            if ($key != 0) {
                $bparent_id .= ',' . $value['ParentID'];
            } else {
                $bparent_id .= $value['ParentID'];
            }
        }
        $bigsql = "select ID,Name,ParentID,Code from jpd_gcategory where ID in ( $bparent_id ) ";
        $bigdatas = Yii::app()->jpdb->createCommand($bigsql)->queryAll();
        foreach ($bigdatas as $key => $value) {
            foreach ($array_cate as $kk => $vv) {
                if ($vv['parent_id'] == $value['ID']) {
                    $array_cate[$kk]['bigname'] = $value['Name'];
                    $array_cate[$kk]['bignameid'] = $value['ID'];
                    $array_cate[$kk]['parent_id'] = $value['ParentID'];
                    if ($value['Code']) {
                        $array_cate[$kk]['code'] = $value['Code'];
                    }
                }
            }
        }
        echo json_encode($array_cate);
        exit;
    }

    // 修改tbl_dealer_goods title 的字段信息
    public function actionUpdatetitleold() {
        if (!isset($_GET['do']) || $_GET['do'] != 'unipei') {
            echo '你没有权限访问！';
            return;
        }
        $sql = "select ID,Name,Pinyin,Brand,OENO from tbl_dealer_goods WHERE ISNULL(Title) OR Title = '' OR Title = '0'";
        $datas = DBUtil::queryAll($sql);
        echo '更新的数据：<br>';
        foreach ($datas as $key => $value) {
            $title = $value['Name'] . ' ' . $value['Pinyin'] . ' ' . $value['Brand'] . ' ' . $value['OENO'] . ' ' . $this->getMakeName($value['ID']);
            $updatesql = "UPDATE tbl_dealer_goods SET Title = '" . $title . " '  WHERE ID = " . $value['ID'];
            $bool = DBUtil::execute($updatesql);

            echo $key . ':' . $title . '<br>';
        }
        if ($bool) {
            echo '修改数据成功';
        } else {
            echo '修改数据失败 或没有数据需要更改';
        }
    }

    /*
     * 添加brand
     */

    public function actionUpdatebrand() {
        if (!isset($_GET['do']) || $_GET['do'] != 'unipei') {
            echo '你没有权限访问！';
            return;
        }
        $sql = 'update pap_goods dg 
                set 
                Brand = (select BrandName from  pap_brand where ID = dg.BrandID )
                WHERE ';
        if (Yii::app()->user->isDealer()) {
            $OrganID = Commonmodel::getOrganID();
            $sql .= "OrganID = " . $OrganID;
        }
        $bool = Yii::app()->papdb->createCommand($sql)->execute();
        echo '更新的数据：<br>';
        if ($bool) {
            echo "修改数据成功";
            var_dump($bool);
        } else {
            echo '修改数据失败 或没有数据需要更改';
        }
    }

    public function actionUpdatetitle() {
        if (!isset($_GET['do']) || $_GET['do'] != 'unipei') {
            echo '你没有权限访问！';
            return;
        }
        $sql = 'update pap_goods dg 
                set 
                Title = CONCAT_WS(" ",dg.Name,dg.GoodsNO,dg.Pinyin,(select Name from jpd.jpd_gcategory where Code = dg.StandCode and dg.StandCode!="" limit 1),(select BrandName from  pap_brand where ID = dg.BrandID),(select GROUP_CONCAT(OENO SEPARATOR " ") from  pap_goods_oe_relation where GoodsID = dg.ID),dg.StandCode) 
                WHERE (ISNULL(Title) OR (Title = "" OR Title = 0))';
        if (Yii::app()->user->isDealer()) {
            $OrganID = Commonmodel::getOrganID();
            $sql .= "and OrganID = " . $OrganID;
        }
        echo $sql;exit;
        $bool = Yii::app()->papdb->createCommand($sql)->execute();
//        $bool = DBUtil::execute($sql);
        echo '更新的数据：<br>';
//        foreach ($datas as $key => $value) {
//            //查询oe表
//            $oes = $this->getOENOSByGoodsID($value['ID']);
//            $value['OENO'] = $oes ? $oes : $value['OENO'];
//            $title = $value['Name'] . ' ' . $value['Pinyin'] . ' ' . $value['Brand'] . ' ' . $value['GoodsNO'] . ' ' . $value['OENO'] . ' ' . $this->getMakeName($value['ID']);
//            $updatesql = "UPDATE tbl_dealer_goods SET Title = '" . $title . " '  WHERE ID = " . $value['ID'];
//            $bool = DBUtil::execute($updatesql);
//
//            echo $value["GoodsNO"] . ':' . $title . '<br>';
//        }
        if ($bool) {
            echo "修改数据成功";
            var_dump($bool);
        } else {
            echo '修改数据失败 或没有数据需要更改';
        }
    }

    public function actionDeltitle() {
        if (!isset($_GET['do']) || $_GET['do'] != 'unipei') {
            echo '你没有权限访问！';
            return;
        }
        $OrganID = Commonmodel::getOrganID();
        $sql = "update pap_goods set Title ='' where OrganID = " . $OrganID;
        $bool = Yii::app()->papdb->createCommand($sql)->execute();
        if ($bool) {
            echo "清楚成功";
            var_dump($bool);
        } else {
            echo '清除失败';
        }
    }

    // 获取品牌厂家
    private function getMakeName($goodsID) {
        $sql = "SELECT DISTINCT Marktxt FROM tbl_dealer_goods_vehicle_relation WHERE GoodsID = $goodsID";
        $data = DBUtil::queryAll($sql);
        if (!$data) {
            return '';
        }
        $str = '';
        foreach ($data as $value) {
            $str .= ' ' . $value['Marktxt'];
        }
        return $str;
    }

    //数据查询list
    public function actionJplist() {
        $this->render('jplist');
    }

    //询报价list
    public function actionInquerylist() {
        $this->render('inquerylist');
    }

    //会员list
    public function actionMemberlist() {
        $this->render('memberlist');
    }

    //采购管理
    public function actionBuylist() {
        $this->render('buylist');
    }

    //服务管理
    public function actionServicelist() {
        $this->render('servicelist');
    }

    /*
     * 经销商首页图标
     */

    //商品管理
    public function actionGoodslist() {
        $this->render('goodslist');
    }

    //报价单管理
    public function actionQuotationlist() {
        $this->render('quolist');
    }

    //销售管理
    public function actionSaleslist() {
        $this->render('saleslist');
    }

    //营销管理
    public function actionMarketlist() {
        $this->render('marketlist');
    }

    //经销商汽配数据管理
    public function actionDealjplist() {
        $this->render('dejplist');
    }

    //会员中心
    public function actionDealmemberlist() {
        $this->render('delmemberlist');
    }

    /*
     * 清除cache的model缓存
     * 
     */

    public function actionDelcache() {
        if (!isset($_GET['do']) || $_GET['do'] != 'unipei') {
            echo '你没有权限访问！';
            return;
        }
        Yii::app()->cache->flush();
    }

    /*
     * 批量修改价格
     */

    public function actionPriceupdate() {
        if (!isset($_GET['do']) || $_GET['do'] != 'unipei') {
            echo '你没有权限访问！';
            return;
        }
        $goods = PapGoodsUpdateprice::model()->findAll();
        foreach ($goods as $goodsk => $goodsv) {
            $goodsinfo = PapGoods::model()->findBypk($goodsv->GoodsID);
            $oldprice = $goodsinfo->Price;
            $goodsinfo->Price = $goodsv->GoodsPrice;
            $updatetime = time();
            $goodsinfo->UpdateTime = $updatetime;

            if ($goodsinfo->save()) {
                $editarr = array(
                    'GoodsID' => (int) $goodsv->GoodsID,
                    'UpdateTime' => (int) $updatetime,
                    'EditInfo' => array('Price' => array('old' => (string) $oldprice, 'news' => $goodsv->GoodsPrice)),
                    'type' => 'edit',
                );
                Yii::app()->mongodb->getDbInstance()->goods_log->insert($editarr);
                PapGoods::model()->updateBypk($goodsv->GoodsID, array('Version' => $updatetime));
                $redis = $version = DealergoodsService::newgoodsxinfo($goodsv->GoodsID);
                $Goodsarr = array(
                    'GoodsID' => (int) $goodsv->GoodsID,
                    'GoodsInfo' => $version,
                    'Version' => (int) $updatetime,
                    'VehVersion' => (int) $goodsinfo->VehVersion,
                );
                Yii::app()->mongodb->getDbInstance()->goods_version->insert($Goodsarr);
                Yii::app()->redis->set('GoodsID' . $goodsv->GoodsID, json_encode($redis));
                $result = PapGoodsUpdateprice::model()->findByPk($goodsv->ID)->delete();
            }
        }
    }

}
