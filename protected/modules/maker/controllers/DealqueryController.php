<?php

class DealqueryController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';
    private $search = array();

    public function actionSearch() {
        $sqldealer = "select dealer.id,dealer.BusinessScope,dealer.organName,dealer.jiapartsID,dealer.province,dealer.city,dealer.area,dealer.address,dealer.Phone,dealer.keyword,dealer.BusinessBrand,dealer.userID,dealer.ContactPhone from tbl_dealer as dealer ";
        $searchSql = " where !ISNULL(dealer.organName)";
        if (!empty($_GET['search'])) {
            $search = $_GET['search'];
            $search['mainCategory']=$_GET['jpmall_maincate'];
            $search['subCategory']=$_GET['jpmall_subcate'];
            $search['leafCategory']=$_GET['jpmall_cpname'];
            $search['cpname']=$_GET['cpname'];
            if (!empty($search['brand'])) {
                $searchSql .= " AND dealer.userID in (select brand.OrganID from tbl_dealer_brand as brand where brand.BrandName  like '%{$search['brand']}%' ) ";
            }
            if (!empty($search['province'])) {
                if (!empty($search['city']) && $search['city'] != '0') {
                   $searchSql .= " AND dealer.province = '{$search['province']}' AND dealer.city = '{$search['city']}'";
                } else {
                   $searchSql .= " AND dealer.province = '{$search['province']}'";
                }
            }
            if( $search['mainCategory'] && $search['subCategory'] && $search['leafCategory']){
                 $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where
                        (mogr.BigpartsID = '{$search['mainCategory']}' and mogr.SubCodeID = '' and mogr.CpNameID = '')
                     or (mogr.BigpartsID = '{$search['mainCategory']}' and mogr.SubCodeID = '{$search['subCategory']}' and mogr.CpNameID = '')
                     or (mogr.BigpartsID = '{$search['mainCategory']}' and mogr.SubCodeID = '{$search['subCategory']}' and mogr.CpNameID = '{$search['leafCategory']}'))";
            } elseif ($search['subCategory'] && $search['mainCategory']) {
                 $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where
                     (mogr.BigpartsID = '{$search['mainCategory']}' and mogr.SubCodeID = '{$search['subCategory']}') 
                   or (mogr.BigpartsID = '{$search['mainCategory']}' and mogr.SubCodeID = '')) ";
            }elseif($search['mainCategory']){
                $searchSql .= " AND dealer.userID in (select mogr.OrganID from tbl_dealer_cpname as mogr where mogr.BigpartsID = '{$search['mainCategory']}' ) ";
            }
            if(!empty($search['payway'])){
                //echo $search['payway'];
                // 查询授权的经销商ID
                $organID = Commonmodel::getOrganID();
                $sql = "select dealer_id from tbl_make_empower_dealer where up_userID = $organID";
                
                if($search['payway'] ==2){  // 未授权经销商
                    $searchSql .= " AND dealer.userID NOT IN (select ed.DealerID from tbl_make_promit_brand ed where ed.OrganID = $organID ) ";
                }else if($search['payway'] ==3){    // 授权经销商
                    $searchSql .= " AND dealer.userID IN (select ed.DealerID from tbl_make_promit_brand ed where ed.OrganID = $organID ) ";
                }
            }
            
//			if(!empty($search['vehicleMake'])){
//				$carcriteria=new CDbCriteria();
//				if (!empty($search['vehicleModel'])){
//					$carcriteria->addCondition("t.businessCar = '".$search['vehicleMake']."'",'AND');
//					$carcriteria->addCondition("t.businessCarModel = '".$search['vehicleModel'])."'",'AND');
////					$searchSql.=" AND vehicle.businessCar = '".$search['vehicleMake']."' AND vehicle.businessCarModel= '".$search['vehicleModel']."'";
//				}else {
//					$carcriteria->addCondition("t.businessCar = '".$search['vehicleMake']."'",'AND');
////					$searchSql.=" AND vehicle.businessCar = '".$search['vehicleMake']."'";
//				}
//				$carcriteria->distinct=true;
//				$carcriteria->select='t.userid';
//				$carmodels=DealerVehicle::model()->findAll($carcriteria);
//				if (!empty($carmodels)){
//					foreach ($carmodels as $car){
//						$users[]=$car->userid;
//					}
//				}
//				$criteria->addInCondition('userID', $users);
//			}
        }
        $sqldealer .= $searchSql;
        $pagesize = 10;
        $result = DBUtil::queryAll($sqldealer);
        $count = count($result);
        $pagess = 1;
        if ($count % $pagesize) {
            $pagess = floor($count / $pagesize) + 1;
        }
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        if ($page <= 1) {
            $page = 1;
        }if ($page > $pagess) {
            $page = $pagess;
        }
        $page = $pagesize * ($page - 1);
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
        $this->render("search", array(
            'search' => $search,
            'dealers' => $dealers,
            'count' => $count,
            'page' => $page,
            'pagesize' => $pagesize,
        ));
    }

    public function actionDetail() {
        $model = Dealer::model()->find("userID=:userID", array(":userID" => $_GET['dealer']));
        // 机构照片
        $organphotoSql = "select id, photoName from tbl_dealer_organphoto where dealerID = ".$_GET['dealer'];
        $organphotos = DBUtil::queryAll($organphotoSql);
        $brands = DealerBrand::model()->findAll("OrganID = {$_GET['dealer']}");
        $data = array();
        foreach ($brands as $key => $brand) {
            $data[$key]['brandname'] = $brand['BrandName'];
        }
          //主营车系
        $dealerv = DealerVehicle::model()->findAll("userID=:userID", array(":userID" => $_GET['dealer']));
        //主营品类
        $cpnames = DealerCpname::model()->findAll("OrganID=:userID", array(":userID" => $_GET['dealer']));

        $this->render("detail", array(
            'model' => $model,
            'organphotos' => $organphotos,
            'dealerv' => $dealerv,
            'cpnames' => $cpnames,
             'data' => $data,
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
        $manufacturer_id = Yii::app()->user->id;
        $sql = "SELECT DISTINCT name,id  FROM tbl_goods_category group by name";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

//获取更多车系
    public function actionGetmore() {
        $field = $_GET['field'];
        $goodsID = $_GET['id'];
        if ($field == 'suitcartype') {
            $sql = "select a.car from tbl_vehicle a where a.VehicleID in (select distinct m.VehicleID from tbl_goods_vehicle m where m.Goods_ID=" . $goodsID . ")";
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