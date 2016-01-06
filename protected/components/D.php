<?php

class D {

    /**
     * 获取EPC车型厂家信息
     * @return array('makeId'=>'','name'=>'')
     */
    static public function queryEpcMakes() {
        $result = RPCClient::call('VehicleService_queryEpcMakes');
        return $result;
    }

    /**
     * 联动获取EPC车型车系信息
     * @param array('make'=>'')
     * @return array('seriesId'=>'','name'=>'')
     */
    public static function queryEpcSeries($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryEpcSeries', $params);
        return $result;
    }

    /**
     * 联动获取EPC车型年款
     * @param array('make'=>'','series'=>'')
     * @return array('year'=>'')
     */
    public static function queryEpcSeriesYears($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryEpcSeriesYears', $params);
        return $result;
    }

    /**
     * 联动获取EPC车型
     * @param array('make'=>'','series'=>'','year'=>'')
     * @return array('modelId'=>'','name'=>'')
     */
    public static function queryEpcModels($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return array();
        }
        if (!isset($params['series'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryEpcModels', $params);
        return $result;
    }

    /**
     * 获取前市场车型厂家信息
     * @return array('makeId'=>'','name'=>'')
     */
    static public function queryFrontMakes() {
        $makes = RPCClient::call('VehicleService_queryFrontMakes');
        return $makes;
    }

    /**
     * 联动获取前市场车型车系信息
     * @param array('make'=>'')
     * @return array('seriesId'=>'','name'=>'')
     */
    public static function queryFrontSeries($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryFrontSeries', $params);
        return $result;
    }

    /**
     * 联动获取前市场车型年款
     * @param array('make'=>'','series'=>'')
     * @return array('year'=>'')
     */
    public static function queryFrontSeriesYears($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryFrontSeriesYears', $params);
        return $result;
    }

    /**
     * 联动获取前市场车型
     * @param array('make'=>'','series'=>'','year'=>'')
     * @return array('modelId'=>'','name'=>'')
     */
    public static function queryFrontModels($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return array();
        }
        if (!isset($params['series'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryFrontModels', $params);
        return $result;
    }

    /**
     * 联动获取配件子组
     * @param modelId 车型ID  groupId 父组ID(不传时，取主组)
     * @return array('partId'=>'','name'=>'')
     */
    public static function queryPartChildGroups($params) {
        if (!isset($params['modelId']) || empty($params['modelId'])) {
            return array();
        }
        $modelId = $params['modelId'];
        $groupId = empty($params['groupId']) ? 0 : $params['groupId'];
        $params = array('modelId' => $modelId, 'groupId' => $groupId);
        $result = RPCClient::call('PartsService_queryChildGroups', $params);
        return $result;
    }

    /**
     * 查询前市场整车厂家信息
     * @param  $makeId
     * @return array('makeId'=>'','makeName'=>'')
     */
    public static function queryFrontMakeInfo($makeId) {
        if (!$makeId) {
            return null;
        }
        $params = array('makeId' => $makeId);
        return RPCClient::call('VehicleService_queryFrontMakeInfo', $params);
    }

    /**
     * 查询前市场车系信息
     * @param  $seriesId
     * @return array('seriesId'=>'','seriesName'=>'','makeId'=>'','makeName'=>'')
     */
    public static function queryFrontSeriesInfo($seriesId) {
        if (!$seriesId) {
            return null;
        }
        $params = array('seriesId' => $seriesId);
        return RPCClient::call('VehicleService_queryFrontSeriesInfo', $params);
    }

    /**
     * 查询前市场车型信息
     * @param  $seriesId
     * @return array('modelId'=>'','modelName'=>'','seriesId'=>'','seriesName'=>'','makeId'=>'','makeName'=>'')
     */
    public static function queryFrontModelInfo($modelId) {
        if (!$modelId) {
            return null;
        }
        $params = array('modelId' => $modelId);
        return RPCClient::call('VehicleService_queryFrontModelInfo', $params);
    }

    /**
     * 查询前市场车型的详细参数信息
     * @param  $seriesId
     * @return array('modelId'=>'','modelName'=>'','seriesId'=>'','seriesName'=>'','makeId'=>'','makeName'=>'')
     */
    public static function queryFrontModelParams($modelId) {
        if (!$modelId) {
            return null;
        }
        $params = array('modelId' => $modelId);
        return RPCClient::call('VehicleService_queryFrontModelParams', $params);
    }

    /**
     * 依据车型编码查询前市场车型信息
     * @param  $code
     * @return array(array('modelId'=>'','modelName'=>''),array('modelId'=>'','modelName'=>''),...)
     */
    public static function queryFrontModelsByCode($code) {
        if (!$code) {
            return null;
        }
        $params = array('code' => $code);
        return RPCClient::call('VehicleService_queryFrontModelsByCode', $params);
    }

    /**
     * 查询EPC整车厂家信息
     * @param  $makeId
     * @return array('makeId'=>'','makeName'=>'')
     */
    public static function queryEpcMakeInfo($makeId) {
        if (!$makeId) {
            return null;
        }
        $params = array('makeId' => $makeId);
        return RPCClient::call('VehicleService_queryEpcMakeInfo', $params);
    }

    /**
     * 查询EPC车系信息
     * @param  $seriesId
     * @return array('seriesId'=>'','seriesName'=>'','makeId'=>'','makeName'=>'')
     */
    public static function queryEpcSeriesInfo($seriesId) {
        if (!$seriesId) {
            return null;
        }
        $params = array('seriesId' => $seriesId);
        return RPCClient::call('VehicleService_queryEpcSeriesInfo', $params);
    }

    /**
     * 查询EPC车型信息
     * @param  $modelId
     * @return array('modelId'=>'','modelName'=>'','seriesId'=>'','seriesName'=>'','makeId'=>'','makeName'=>'')
     */
    public static function queryEpctModelInfo($modelId) {
        if (!$modelId) {
            return null;
        }
        $params = array('modelId' => $modelId);
        return RPCClient::call('VehicleService_queryEpcModelInfo', $params);
    }

    /**
     * 获取EPC车型厂家信息
     * @return array('makeId'=>'','name'=>'')
     */
    static public function queryGoodsMakes() {
        $result = RPCClient::call('VehicleService_queryGoodsMakes');
        return $result;
    }

    /*
     * 获取车型品牌信息
     */

    static public function queryGoodsBrands() {
        $result = RPCClient::call('VehicleService_queryGoodsBrands');
        return $result;
    }

    /**
     * 获取EPC车型厂家信息-关联主营车系
     * @return array('makeId'=>'','name'=>'')
     */
    static public function queryGoodsMakeself() {
        $result = RPCClient::call('VehicleService_queryGoodsMakeself');
        return $result;
    }

    /**
     * 联动获取Goods车型车系信息
     * @param array('make'=>'')
     * @return array('seriesId'=>'','name'=>'')
     */
    public static function queryGoodsSeries($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryGoodsSeries', $params);
        return $result;
    }

    /**
     * 联动获取GOODS车型年款
     * @param array('make'=>'','series'=>'')
     * @return array('year'=>'')
     */
    public static function queryGoodsSeriesYears($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryGoodsSeriesYears', $params);
        return $result;
    }

    /**
     * 联动获取GOODS车型
     * @param array('make'=>'','series'=>'','year'=>'')
     * @return array('modelId'=>'','name'=>'')
     */
    public static function queryGoodsModels($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return array();
        }
        if (!isset($params['series'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryGoodsModels', $params);
        return $result;
    }

    public static function queryGoodsYearModels2($params) {
        if (!isset($params['seriesId']) || empty($params['seriesId'])) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryGoodsYearModels2', $params);
        return $result;
    }

    /**
     * 查询GOODS整车厂家信息
     * @param  $makeId
     * @return array('makeId'=>'','makeName'=>'')
     */
    public static function queryGoodsMakeInfo($makeId) {
        if (!$makeId) {
            return null;
        }
        $params = array('makeId' => $makeId);
        return RPCClient::call('VehicleService_queryGoodsMakeInfo', $params);
    }

    /**
     * 查询GOODS车系信息
     * @param  $seriesId
     * @return array('seriesId'=>'','seriesName'=>'','makeId'=>'','makeName'=>'')
     */
    public static function queryGoodsSeriesInfo($seriesId) {
        if (!$seriesId) {
            return null;
        }
        $params = array('seriesId' => $seriesId);
        return RPCClient::call('VehicleService_queryGoodsSeriesInfo', $params);
    }

    /**
     * 查询GOODS车型信息
     * @param  $modelId
     * @return array('modelId'=>'','modelName'=>'','seriesId'=>'','seriesName'=>'','makeId'=>'','makeName'=>'',alias=>'')
     */
    public static function queryGoodsModelInfo($modelId) {
        if (!$modelId) {
            return null;
        }
        $params = array('modelId' => $modelId);
        return RPCClient::call('VehicleService_queryGoodsModelInfo', $params);
    }

    /**
     * 查询EPC主组子组名称
     * @param  $groupId
     * @return name
     */
    public static function queryEpcGroupName($groupId) {
        if (!$groupId) {
            return null;
        }
        $params = array('groupId' => $groupId);
        return RPCClient::call('VehicleService_queryEpcGroupName', $params);
    }

    /**
     * 
     * @param type $seriesId
     * @return type
     */
    public static function queryGoodsYearModels($seriesId) {
        if (!isset($seriesId)) {
            return array();
        }
        $result = RPCClient::call('VehicleService_queryGoodsYearModels', $seriesId);
        return $result;
    }

    /**
     * 获取大类
     */
    public static function getMainCategorys() {
        // 缓存时间
        $queryCachingDuration = F::sg('cache', 'categoryCachingDuration');
        // 查询数据库
        $cri = new CDbCriteria(array(
            'select' => 'ID,Name,Pinyin,Code,ParentID,Level,SortOrder,IsShow',
            'condition' => 'ParentID = 0 or ParentID <=> NULL',
            'order' => 'SortOrder asc',
        ));
        $categorys = JPDGcategory::model()->cache($queryCachingDuration)->findAll($cri);
        return $categorys;
    }

    /**
     * 取商品品类第二级子类
     * @return array
     */
    public static function getSubCategorys($mainCategory) {
        if (!$mainCategory) {
            return null;
        }
        // 缓存时间，大于0时才缓存
        $queryCachingDuration = F::sg('cache', 'categoryCachingDuration');
        // 查询数据库
//      $cri = new CDbCriteria(array(
//                  'condition' => 'parent_id = '.$mainCategory.' and if_show=1', 
//                  'order' => 'sort_order asc',
//      		));
//  	$categorys = Gcategory::model()->cache($queryCachingDuration)->findAll($cri);
        $sql = "select ID,Name,Pinyin,Code,ParentID,Level,SortOrder,IsShow "
                . " from jpd_gcategory where ParentID = " . $mainCategory . " and IsShow = 1 order by SortOrder asc";
//        $categorys = DBUtil::queryAll($sql, array(), $queryCachingDuration);
        $categorys = Yii::app()->jpdb->createCommand($sql)->queryAll($queryCachingDuration);
        return $categorys;
    }

    /**
     * 取商品品类第三级标准名称
     * @return array
     */
    public static function getLeafCategorys($subCategory) {
        if (!$subCategory) {
            return null;
        }
        // 缓存时间，大于0时才缓存
        $queryCachingDuration = F::sg('cache', 'categoryCachingDuration');
        // 查询数据库
//      $cri = new CDbCriteria(array(
//                    'condition' => 'parent_id = '.$subCategory.' and if_show=1', 
//                    'order' => 'sort_order asc',
//               ));
//  	$categorys = Gcategory::model()->cache($queryCachingDuration)->findAll($cri);
        $sql = "select ID,Name,Pinyin,Code,ParentID,Level,SortOrder,IsShow "
                . " from jpd_gcategory where ParentID = " . $subCategory . " and IsShow = 1 order by SortOrder asc";
        $categorys = Yii::app()->jpdb->createCommand($sql)->queryAll($queryCachingDuration);
        return $categorys;
    }

    /**
     * 通过拼音获取商品品类第三级标准名称
     * @return array
     */
    public static function getLeafCategorysofp($subCategory, $pinyin = null) {
        if (!$subCategory) {
            return null;
        }
        // 缓存时间，大于0时才缓存
        $queryCachingDuration = F::sg('cache', 'categoryCachingDuration');
        // 查询数据库    	   	
        $categorys = array();
        $sql = "select ID,Name,Pinyin,Code,ParentID,Level,SortOrder,IsShow "
                . " from jpd_gcategory where ParentID = " . $subCategory . " and ( Pinyin like '{$pinyin}%' or Pinyin like '({$pinyin}%' ) and IsShow = 1 order by SortOrder asc";
//        $categorys = DBUtil::queryAll($sql, array(), $queryCachingDuration);
        $categorys = Yii::app()->jpdb->createCommand($sql)->queryAll();
        return $categorys;
    }

    /**
     * 通过拼音获取商品品类第三级标准名称
     * @return array
     */
    public static function getLeafCarsofp($pinyin = null) {
        // 缓存时间，大于0时才缓存
        $queryCachingDuration = F::sg('cache', 'carCachingDuration');
        // 查询数据库    	   	
        $categorys = array();
        $sql = "select BrandID,Name,Pyf,EName,BrandLogo"
                . " from jpd_front_brand where Pyf like '{$pinyin}%' order by Pyf";
//        $categorys = DBUtil::queryAll($sql, array(), $queryCachingDuration);
        $categorys = Yii::app()->jpdb->createCommand($sql)->queryAll();
        return $categorys;
    }

    /*
     * 通过品牌查产家
     */

    public static function getLeafMakesofp($brandid = null) {
        // 缓存时间，大于0时才缓存
        $queryCachingDuration = F::sg('cache', 'makeCachingDuration');
        // 查询数据库    	   	
        $categorys = array();
        $sql = "select MakeID,Name,Pyf,EName,CarLogo"
                . " from jpd_front_makes where BrandID = '{$brandid}' order by Pyf";
        $categorys = Yii::app()->jpdb->createCommand($sql)->queryAll();
        return $categorys;
    }

    /**
     * 获取认证品牌
     * @return type
     */
    public static function getApproveBrand() {
        // 缓存时间，大于0时才缓存
        $queryCachingDuration = F::sg('cache', 'approveBrandCachingDuration');
        $datas = ApproveBrand::model()->cache($queryCachingDuration)->findAll();
        $data = CHtml::listData($datas, "BrandName", "BrandName");
        return $data;
    }

    /*
     * 获取经销商物流公司
     */

    public static function getLogistics($organID) {
        //$sql = " select * from  jpd.jpd_logistics where OrganID in ($organID) and Status = 2";
        $sql = " select * from  jpd.jpd_logistics where Status = 2";
//        $criteria = new CDbCriteria();
//        $criteria ->condition = 'Status = 2';  
//        $criteria ->addInCondition('OrganID',array($organID));
//       // $datas =  Logistics::model()->findAll('Status=:Status', array(':Status'=>2)); //查询状态是2的经销商物流
//        $datas =  Logistics::model()->findAll($criteria);   
        $datas = Yii::app()->jpdb->createCommand($sql)->queryAll();
        //$datas = DBUtil::queryAll($sql);
        $data = CHtml::listData($datas, "LogisticsCompany", "LogisticsCompany"); //传入物流公司字段
        return $data;
    }

    //配件查询日志翻译
    public static function querypvlog($modelId, $groupId) {
        if (isset($modelId) && !empty($modelId)) {
            $sql = "select a.Name as model,a.Year as year,b.Name as make,c.Name as car from jpd_epc_model a,jpd_epc_makes b,jpd_epc_series c";
            $sql.=" where a.MakeID=b.MakeID and a.SeriesID=c.Seriesid and a.ModelID=$modelId";
            $res = DBUtil::query($sql);
            if ($res) {
                $vehicle = $res['make'] . ' ' . $res['car'] . '  ' . $res['year'] . ' ' . $res['model'];
            }
        }
        if ($groupId) {
            $sql = "select Name,ParentID from jpd_epc_group where GroupID=$groupId";
            $group_res = DBUtil::query($sql);
            if ($group_res) {
                $main_sql = "select Name from jpd_epc_group where GroupID={$group_res['ParentID']}";
                $maingroup = DBUtil::query($main_sql);
                //主组名称
                $main_group = $maingroup['Name'];
                //子组名称
                $child_group = $group_res['Name'];
            }
        }
        return '车型:' . $vehicle . '　主组:' . $main_group . '　子组:' . $child_group;
    }

    //配件查询oe号日志
    public static function querypvoelog($oeno, $makeId) {
        if (isset($makeId) && !empty($makeId)) {
            $sql = "select Name from jpd_epc_makes where MakeID=$makeId";
            $res = DBUtil::query($sql);
            if ($res) {
                $make = $res['Name'];
            }
        }
        return 'OE号：' . $oeno . '  厂家:' . $make;
    }

    //配件查询配件名称日志
    public static function querypvnamelog($name, $modelId) {
        if (isset($modelId) && !empty($modelId)) {
            $sql = "select a.Name as model,a.Year as year,b.Name as make,c.Name as car from jpd_epc_model a,jpd_epc_makes b,jpd_epc_series c";
            $sql.=" where a.MakeID=b.MakeID and a.SeriesID=c.Seriesid and a.ModelID=$modelId";
            $res = DBUtil::query($sql);
            if ($res) {
                $vehicle = $res['make'] . ' ' . $res['car'] . '  ' . $res['year'] . ' ' . $res['model'];
            }
        }
        return '配件名称:' . $name . ' 车型:' . $vehicle;
    }

    //配件详情日志
    public static function querypvdetailog($modelId, $partid) {
        if (isset($modelId) && !empty($modelId)) {
            $sql = "select a.Name as model,a.Year as year,b.Name as make,c.Name as car from jpd_epc_model a,jpd_epc_makes b,jpd_epc_series c";
            $sql.=" where a.MakeID=b.MakeID and a.SeriesID=c.Seriesid and a.ModelID=$modelId";
            $res = DBUtil::query($sql);
            if ($res) {
                $vehicle = $res['make'] . ' ' . $res['car'] . '  ' . $res['year'] . ' ' . $res['model'];
            }
        }
        $part_sql = "select Name as partname from jpd_epc_parts where PartID=$partid";
        $parts = DBUtil::query($part_sql);
        if ($parts) {
            $partsname = $parts['partname'];
        }
        return '车型：' . $vehicle . ' 查看配件:' . $partsname;
    }

    //查询前市场车型日志
    public static function queryfrontvelog($modelId) {
        if (isset($modelId) && !empty($modelId)) {
            $sql = "select a.Name as model,a.Year as year,b.Name as make,c.Name as car from jpd_front_model a,jpd_front_makes b,jpd_front_series c";
            $sql.=" where a.MakeID=b.MakeID and a.SeriesID=c.Seriesid and a.ModelID=$modelId";
            $res = DBUtil::query($sql);
            if ($res) {
                $vehicle = $res['make'] . ' ' . $res['car'] . '  ' . $res['year'] . ' ' . $res['model'];
            }
        }
        return $vehicle;
    }

    //养护周期
    public static function querymainlog($vehicleID) {
        $sql = "select * from jpd_vehicle_mtc where VehicleMtcID=$vehicleID";
        $res = DBUtil::query($sql);
        if ($res) {
            $vehicle = $res['Make'] . ' ' . $res['Car'] . ' ' . $res['Engine'];
        }
        return $vehicle;
    }

}
