<?php

class ServicequeryController extends Controller {

    private $search = array();

    /*
     * 经销商查询
     */


    public function actionIndex() {
        $sqldealer = "select dealer.id,dealer.organName,dealer.jiapartsID,dealer.province,dealer.city,dealer.area,dealer.address,dealer.Phone,dealer.keyword,dealer.BusinessBrand,dealer.userID,dealer.ContactPhone from tbl_dealer as dealer ";
        $searchSql = " where !ISNULL(dealer.organName)";
        if ($_GET['search']) {
            $search['keyword'] = $keyword = trim(($_GET['keyword'] == "OE号/商品名称/商品品牌") ? '' : $_GET['keyword']);
//            $search['MainGroup'] = $MainGroup = $_GET['MainGroup'];
//            $search['SubGroup'] = $SubGroup = $_GET['SubGroup'];
//            $search['vehicleMake'] = $vehicleMake = $_GET['vehicleMake'];
//            $search['vehicleModel'] = $vehicleModel = $_GET['vehicleModel'];
            $search['makecar'] = $makecar = trim(($_GET['makecar'] == "请选择适用车系") ? '' : $_GET['makecar']);
            // 适用车系
            $search['jpmall_make'] = $make = $_GET['select_make'];
            $search['jpmall_series'] = $series = $_GET['select_series'];
            $search['jpmall_year'] = $year = $_GET['select_year'];
            $search['jpmall_model'] = $model = $_GET['select_model'];
            $search['province'] = $pro = $_GET['province'];
            $search['city'] = $city = $_GET['city'];
           $search['cpname'] = $cpname = $_GET['cpname'];
//            $search['system_type'] = $system_type = $_GET['system_type'];
            $search['category'] = $category = ($_GET['category'] == "请选择标准名称") ? '' : $_GET['category'];
            //当前页面的搜索
          //  if ($_GET['mainCategory']) {
                $search['mainCategory'] = $mainCategory = $_GET['jpmall_maincate'];
                $search['subCategory'] = $subCategory = $_GET['jpmall_subcate'];
                $search['leafCategory'] = $leafCategory = $_GET['jpmall_cpname'];
         //   }
            //首页的搜索
            if ($_GET['mainCategorySOrgan']) {
                $search['mainCategory'] = $mainCategory = $_GET['mainCategorySOrgan'];
                $search['subCategory'] = $subCategory= $_GET['subCategorySOrgan'];
                $search['leafCategory'] = $leafCategory= $_GET['leafCategorySOrgan'];
            }

            if ($_GET['SOrgan']) {
                $SOrgan = $_GET['SOrgan'];
                $search['make'] = $make = $SOrgan['make'];
                $search['series'] = $series = $SOrgan['series'];
                $search['year'] = $year = $SOrgan['year'];
                $search['model'] = $model = $SOrgan['model'];
            }

            $search['is'] = $_GET['is'];
            if (!empty($keyword) && $keyword != '0') {
                if ($keyword == "OE号，商品名称，商品品牌") {
                    $search['keyword'] = '';
                } else {
                    $sql = " select distinct a.id as goodsID "
                            . "  from tbl_goods a ,tbl_goods_version b,tbl_goods_template d, tbl_goods_standard e"
                            . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
                            . "  and b.templet_id=d.id"
                            . "  and e.id=d.standard_id"
                            . "  and (a.oe like '%{$search['keyword']}%'"
                            . "  or (b.name like '%{$search['keyword']}%')"
                            . "  or (a.brand like '%{$search['keyword']}%'))"
                            . "  and a.ISdelete='N' and a.IsSale='Y'  "
                            . "  group by a.id order by a.id desc";
                    $result = Yii::app()->db->createCommand($sql)->queryAll();
                    foreach ($result as $key => $val) {
                        $arr[$key] = $val['goodsID'];
                    }
                    if (empty($result)) {
                        $arr = array('11111111111', '222222222222');
                    }
                    if (!empty($arr)) {
                        $result = implode(',', $arr);
                        $sql = "select distinct a.dealer_id 
				  			from tbl_make_empower_dealer a,
				  				tbl_make_empower_category b,
				  			 tbl_make_empower_category_relation c 
				  			 where a.category=c.cate_id and a.category=b.id and c.cate_id=b.id
				  			 and b.userID=a.up_userID and goods_id in ($result)";
                        $result = Yii::app()->db->createCommand($sql)->queryAll();
                        foreach ($result as $key => $val) {
                            $arr[$key] = $val['dealer_id'];
                        }
                        if (!empty($arr)) {
                            $result = implode(',', $arr);
                            $searchSql .=" and dealer.id in ($result)";
                        }
                    }
                }
            }
            if ($search['jpmall_make'] != '') {
                $searchSql .=" and dealer.userID in (select userid from tbl_dealer_vehicle where businessMake = '{$make}' )";
            }
            if ($search['jpmall_series'] != '') {
                $searchSql .=" and dealer.userID in (select userid from tbl_dealer_vehicle where businessCar = '{$series}' )";
            }
            if ($search['jpmall_year'] != '') {
                $searchSql .=" and dealer.userID in (select userid from tbl_dealer_vehicle where businessYear = '{$year}' )";
            }
            if ($search['jpmall_model'] != '') {
                $searchSql .=" and dealer.userID in (select userid from tbl_dealer_vehicle where businessCarModel = '{$model}')";
            }
//            if (!empty($vehicleMake) && $vehicleMake != '0') { // 车品牌
//                if (!empty($vehicleModel) && $vehicleModel != '0') {
//                    $searchSql .=" and dealer.userID in (select userid from tbl_dealer_vehicle where businessCar = '{$vehicleMake}' AND businessCarModel = '{$vehicleModel}' )";
//                }else
//                    $searchSql .=" and dealer.userID in (select userid from tbl_dealer_vehicle where businessCar = '{$vehicleMake}' )";
//            }
            if (!empty($pro) && $pro != '0') {
                if (!empty($city) && $city != '0')
                    $searchSql .= " AND dealer.province = '{$pro}' AND dealer.city = '{$city}'";
                else
                    $searchSql .= " AND dealer.province = '{$pro}'";
            }else {
                // 默认所在城市
            }
//            if ($search['system_type'] != '') {
//                if ($search['cpname'] != '') {
//                    $searchSql .= " AND dealer.userID in (select mogr.userID from tbl_make_organ_group_relation as mogr where mogr.father_code = '{$search['system_type']}' AND mogr.children_code ='{$search['cpname']}' )";
//                } else {
//                    $searchSql .= " AND dealer.userID in (select mogr.userID from tbl_make_organ_group_relation as mogr where mogr.father_code = '{$search['system_type']}') ";
//                }
//            }
            if( $mainCategory && $subCategory && $leafCategory){
                 $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where
                        (mogr.BigpartsID = '{$mainCategory}' and mogr.SubCodeID = '' and mogr.CpNameID = '')
                     or (mogr.BigpartsID = '{$mainCategory}' and mogr.SubCodeID = '{$subCategory}' and mogr.CpNameID = '')
                     or (mogr.BigpartsID = '{$mainCategory}' and mogr.SubCodeID = '{$subCategory}' and mogr.CpNameID = '{$leafCategory}'))";
            } elseif ($subCategory && $mainCategory) {
                 $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where
                     (mogr.BigpartsID = '{$mainCategory}' and mogr.SubCodeID = '{$subCategory}') 
                   or (mogr.BigpartsID = '{$mainCategory}' and mogr.SubCodeID = '')) ";
            }elseif($mainCategory){
                $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where mogr.BigpartsID = '{$mainCategory}' ) ";
            }
//            if (empty($subCategory) && empty($leafCategory)) {
//                echo '1';exit;
//                $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where mogr.BigpartsID = '{$mainCategory}' ) ";
//            }else if (isset($leafCategory)) {
//                echo '2';exit;
//                $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where mogr.BigpartsID = '{$mainCategory}' and mogr.SubCodeID = '{$subCategory}') ";
//            }else {
//                echo '3';exit;
//                $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where mogr.BigpartsID = '{$mainCategory}' and mogr.SubCodeID = '{$subCategory}' and mogr.CpNameID = '{$leafCategory}') ";
//            }
        }
        // 合并sql语句
        $sqldealer .= $searchSql;
        $pagesize = 10;
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $page = $pagesize * ($page - 1);
        $result = DBUtil::queryAll($sqldealer);
        $count = count($result);
        $limit = " limit $page, $pagesize ";
        $dealers = DbUtil::queryAll($sqldealer . $limit);
        $pageData = array('total_rows' => $count,
            'parameter' => '',
            'list_rows' => $pagesize,
            'page_name' => 'page',
            'ajax_func_name' => '',
            'method' => '');
        $page = new Pagination($pageData);
        $page = $page->show(1);
        //主营品类
        //$sql = "select distinct system_type,id from tbl_goods_standard where system_type is not null group by system_type";
        //$parts = Yii::app()->db->createCommand($sql)->queryAll();
        $this->render("index", array(
            'makecar'=>$makecar,
            'search' => $search,
            'dealers' => $dealers,
            'count' => $count,
            'page' => $page,
            'pagesize' => $pagesize,
                //    'parts' => $parts
        ));
    }

    /*
     * 经销商详细信息
     */

    public function actionDetail() {
        $model = Dealer::model()->find("userID=:userID", array(":userID" => $_GET['dealer']));
        //主营品牌

        $organID = $model[userID];
        $brands = DealerBrand::model()->findAll("OrganID = $organID");
        $data = array();
        foreach ($brands as $key => $brand) {
            $data[$key]['brandname'] = $brand['BrandName'];
        }
        //主营车系
        $dealerv = DealerVehicle::model()->findAll("userID=:userID", array(":userID" => $_GET['dealer']));
        //主营品类
//        $cpnames = MakeOrganGroupRelation::model()->findAll("userID=:userID", array(":userID" => $_GET['dealer']));
        $cpnames = DealerCpname::model()->findAll('OrganID=:userID', array(':userID' =>$_GET['dealer']));
        // 机构照片
        $organphotoSql = "select id, photoName from tbl_dealer_organphoto where dealerID = " . $_GET['dealer'];
        $organphotos = DBUtil::queryAll($organphotoSql);
        $this->render("detail", array(
            'model' => $model,
            'organphotos' => $organphotos,
            'dealerv' => $dealerv,
            'showcpnames' => $cpnames,
            'data' => $data,
        ));
    }

    /*
     * 修理厂查询
     */

    public function actionService() {
        $this->pageTitle = Yii::app()->name . ' - 修理厂查询';
        $userId = Commonmodel::getOrganID();
        if ($_GET) {
            $search['keyword'] = ($_GET['keyWord'] == "机构名称或关键词") ? '' : ($_GET['keyWord']);
            $search['province'] = $_GET['province'];
            $search['city'] = $_GET['city'];
            $search['area'] = $_GET['area'];
            $search['category'] = $_GET['category'];
            $search['deep'] = $_GET['deep'];
            $search['vehicle'] = $_GET['vehicle'];
            $search['maintenance'] = $_GET['maintenance'];
            $search['maintenance-make'] = $_GET['maintenance-make'];
            $search['maintenance-car'] = $_GET['maintenance-car'];
            $search['diagnosis'] = $_GET['diagnosis'];
            $search['diagnosis-make'] = $_GET['diagnosis-make'];
            $search['diagnosis-car'] = $_GET['diagnosis-car'];
            $search['parts'] = $_GET['parts'];
            $search['repair'] = $_GET['repair'];
            $search['repair-make'] = $_GET['repair-make'];
            $search['repair-car'] = $_GET['repair-car'];
            $search['insurer'] = $_GET['insurer'];
        }

        $conditions = " 1 = 1 ";
        $join = "";
        $inner = " INNER JOIN {{service_mainbusiness}} AS main ON main.userId = ser.userId";

        if ($search) {
            if ($search['keyword']) {
                $join.= " AND (ser.serviceName like '%{$search['keyword']}%' or main.keyWord like '%{$search['keyword']}%')";
            }
            if ($search['province']) {
                $conditions.= " AND serviceProvince = {$search['province']}";
            }
            if ($search['city']) {
                $conditions.= " AND serviceCity = {$search['city']}";
            }
            if ($search['area']) {
                $conditions.= " AND serviceArea = {$search['area']}";
            }
            if ($search['category']) {
                switch ($search['category']) {
                    case "深度清洁" : $join.= " AND main.deepCleaning = '{$search['deep']}'";
                        break;
                    case "车辆美容" : $join.= " AND main.vehiclesBeauty = '{$search['vehicle']}'";
                        break;
                    case "日常保养" :
                        if ($search['maintenance'] == "全车系") {
                            $join.= " AND main.routineMaintenance = '{$search['maintenance']}'";
                        } else {
                            $join.= " INNER JOIN {{service_mainbusiness_routine}} AS rou ON ser.userId = rou.userId
									AND rou.make = '{$search['maintenance-make']}' AND rou.car = '{$search['maintenance-car']}'";
                        }
                        break;
                    case "检查诊断" :
                        if ($search['diagnosis'] == "全车系") {
                            $join.= " AND main.diagnosis = '{$search['diagnosis']}'";
                        } else {
                            $join.= " INNER JOIN {{service_mainbusiness_diagnosis}} AS diag ON ser.userId = diag.userId
									AND diag.make = '{$search['diagnosis-make']}' AND diag.car = '{$search['diagnosis-car']}'";
                        }
                        break;
                    case "易损件更换" : $join.= " AND main.wearingParts like '%{$search['parts']}%'";
                        break;
                    case "专业修理" :
                        if ($search['repair'] == "全车系") {
                            $join.= " AND main.professionalRepair = '{$search['repair']}'";
                        } else {
                            $join.= " INNER JOIN {{service_mainbusiness_repair}} AS rep ON ser.userId = rep.userId
									AND rep.make = '{$search['repair-make']}' AND rep.car = '{$search['repair-car']}'";
                        }
                        break;
                    case "车险服务" :
                        foreach ($search['insurer'] as $key => $value) {
                            $join.= " AND main.insuranceService like '%{$value}%'";
                        }
                        break;
                }
            }
        }
        $sql = "SELECT * FROM {{service}} AS ser $inner $join where $conditions";
        //获取修理厂数量(在常态下及在查询状态下的判断)
        $csql = "SELECT * FROM {{service}}";
        if ($search) {
            $count = DBUtil::queryAll($sql);
        } else {
            $count = DBUtil::queryAll($csql);
        }
        $pagesize = 3;
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $page = $pagesize * ($page - 1);
        $result = DBUtil::queryAll($sql);
        $count = count($result);
        $limit = " limit $page, $pagesize ";
        $service = DBUtil::queryAll($sql . $limit);
        $pageData = array(
            'total_rows' => $count,
            'parameter' => '',
            'list_rows' => $pagesize,
            'page_name' => 'page',
            'ajax_func_name' => '',
            'method' => ''
        );
        $page = new Pagination($pageData);
        $page = $page->show(1);

        $make = TransportMake::model()->findAll();
        $parts = WearingParts::model()->findAll();
        $insur = Insurance::model()->findAll();
        foreach ($service as $res) {
            $major = ServiceMainbusiness::model()->findAll(array("condition" => "userId = {$res['userId']}"));
            foreach ($major as $val) {
                $type[] = ServiceMainbusiness::model()->find(array("condition" => "userId = {$val['userId']}"));
                $insurance[] = ServiceMainbusiness::model()->find(array("condition" => "userId = {$val['userId']}"));
            }
        }
        $this->render('service', array(
            'service' => $service,
            'search' => $search,
            'page' => $page,
            'make' => $make,
            'parts' => $parts,
            'insur' => $insur,
            'count' => $count,
            'type' => $type,
            'insurance' => $insurance
        ));
    }

    /*
     * 修理厂详细信息
     */

    public function actionServicedetail() {
        $id = $_GET['id'];
        //获取机构照片
        $photo = ServicePhoto::model()->find("userId=:userId", array(":userId" => $id));
        //获取修理厂基础信息
        $model = Service::model()->find("userId=:userId", array(":userId" => $id));
        $this->render('result', array(
            'photo' => $photo,
            'model' => $model
        ));
    }

    /*
     * 促销信息查询
     */

    public function actionPromotions() {
        $this->pageTitle = Yii::app()->name . ' - 经销商促销查询';
        if (isset($_GET)) {
            $search['keywords'] = $_GET['keywords'];
            $search['provice'] = $_GET['provice'];
            $search['city'] = $_GET['city'];
            $search['make'] = $_GET['make'];
            $search['car'] = $_GET['car'];
            $search['OENO'] = $_GET['OENO'];
            $search['system_type'] = $_GET['system_type'];
            $search['cp_name'] = $_GET['cp_name'];
            $search['is'] = $_GET['is'];
        }
        //organName,FoudingDate,province,city,area,Phone,businessCate,businessBrand
        //$searchsql="SELECT * FROM tbl_dealer AS makeorgan $join where $conditions";
        //$searchsql="SELECT distinct makeorgan.userID, organName,FoudingDate,province,city,area,address,Phone,BusinessBrand,BusinessCate FROM tbl_dealer AS makeorgan $join where $conditions";
        $conditions = " and  1=1 ";
        $join = "";
        if ($search) {
            $keywords = trim($search['keywords']);
            if ($keywords && $keywords != "配件名称、配件品牌") {
                $conditions .=" AND d.userID in (select dp.userID from tbl_dealer_promotion as pd where dp.goodsName like '%{$keywords}%' OR dp.goodsBrand like '%{$keywords}%' )";
            }
            $oeno = trim($search['OENO']);
            if (!empty($oeno) && $oeno != "输入OE号") { // OE号
                $conditions .= " AND dp.OENO like '%{$oeno}%' ";
            }
            if ($search['system_type'] != '') {
                if ($search['cp_name'] != '') {
                    $conditions .= " AND d.userID in (select dpc.userid from tbl_dealer_promotion_cpname as dpc where dpc.system_type = '{$search['system_type']}' AND dpc.cp_name ='{$search['cp_name']}' )";
                } else {
                    $conditions .= " AND d.userID in (select dpc.userid from tbl_dealer_promotion_cpname as dpc where dpc.system_type = '{$search['system_type']}') ";
                }
            }
            if ($search['provice'] != '') {
                if ($search['city'] != '') {
                    $conditions .= " AND d.province = '{$search['provice']}' AND d.city ='{$search['city']}' ";
                } else {
                    $conditions .= " AND d.province = '{$search['provice']}' ";
                }
            }
            if ($search['make'] != 0) {
                if ($search['car'] != 0) {
                    $conditions .=" and d.userID in (select dpa.userid from tbl_dealer_vehicle as dpa where dpa.businessCar = {$search['make']} and dpa.businessCarModel = {$search['car']})";
                    //$join.=" INNER JOIN tbl_dealer_vehicle AS carrelation ON carrelation.userID = makeorgan.userID AND carrelation.businessCar = '{$search['make']}' AND carrelation.businessCarModel = '{$search['car']}'";
                } else {
                    $conditions .=" and d.userID in (select dpa.userid from tbl_dealer_vehicle as dpa where dpa.businessCar = '{$search['make']}')";
                }
            }
        }
        $searchsql = "select  distinct d.userID, organName,FoudingDate,province,city,area,address,Phone,BusinessBrand from tbl_dealer as d, tbl_dealer_promotion as dp ,tbl_make_organ_group_relation as mogr where d.userID = dp.userID " . $conditions;
        $pagesize = 10;
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $page = $pagesize * ($page - 1);
        $result = DBUtil::queryAll($searchsql);
        $count = count($result);
        $limit = " limit $page, $pagesize ";
        $results = DBUtil::queryAll($searchsql . $limit);
        $pageData = array('total_rows' => $count,
            'parameter' => '',
            'list_rows' => $pagesize,
            'page_name' => 'page',
            'ajax_func_name' => '',
            'method' => '');
        $page = new Pagination($pageData);
        $page = $page->show(1);

        $this->render('promotions', array(
            'models' => $results,
            'page' => $page,
            'count' => $count,
            'search' => $search,
        ));
    }

    /**
     * 显示促销商品
     */
    public function actionQueryprogoods() {
        $userID = $_GET['userID'];
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = "id DESC"; //排序条件:update_time,id倒叙
        $criteria->addCondition("userID=" . $userID); //查询条件，即where id = 1

        $count = DealerPromotion::model()->count($criteria);
        $pages = new CPagination($count);
        // $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        $models = DealerPromotion::model()->findAll($criteria);
        $this->render("promotiongoods", array(
            'models' => $models,
            'pages' => $pages,
        ));
    }

    public function actionEmpgoods() {
        //内容查询
        $pageNo = !empty($_GET['page']) ? $_GET['page'] : 1;
        if (isset($_GET['search'])) {
            $params = $_GET['search'];
            $result = Goods::getGoodsByDearID($_GET['dealer'], $params, $pageNo, 10);
        } else {
            $result = Goods::getGoodsByDearID($_GET['dealer'], null, $pageNo, 10);
        }
        //搜索中的适用品牌
        $brand = $this->getbrand(0);
        //类别
        $category = $this->getcategory();
        $this->render("empgoods", array(
            'search' => $params,
            'models' => $result[0],
            'pages' => $result[1],
            'brand' => $brand,
            'category' => $category
        ));
    }

    //获取品牌
    public function GetBrand() {
        $sql = "select distinct name,id from tbl_goods_brand group by name";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    //获取车系
    public function GetCar() {
        $sql = "select Distinct car,VehicleID FROM tbl_vehicle group by car ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    //获取商品类别
    public function GetCategory() {
        $manufacturer_id = Commonmodel::getOrganID();
        $sql = "SELECT DISTINCT name,id  FROM tbl_goods_category group by name";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    public function actionGetmore() {
        $field = $_GET['field'];
        $goodsID = $_GET['id'];
        if ($field == 'suitcartype') {
            $sql = "select a.car from tbl_vehicle a where a.VehicleID in (select distinct m.VehicleID from tbl_goods_vehicle m where m.Goods_ID={$goodsID})";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $list = '';
            foreach ($data as $k => $s) {
                if ($k == 0) {
                    $list.=$s['car'];
                } else {
                    $list.=',' . $s['car'];
                }
            }
            $more = explode(',', $list);
        } else {
            $mores = Yii::app()->db->createCommand("select oe from tbl_goods where id={$_GET['id']}")->queryScalar();
            $more = explode(',', $mores);
        }
        array_shift($more);
        $more = array_filter($more);
        foreach ($more as $key => $value) {
            $result[$key][$field] = $value;
        }
        echo json_encode($result);
    }

}