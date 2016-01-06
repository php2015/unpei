<?php

class VehicleService {

//整车厂家列表
    public static function queryEpcMakes() {
        $sql = "select a.makeid as makeId, a.name as name from {{epc_makes}}  a order by CONVERT(name USING gb2312)";
        $vehiclemake = DBUtil::queryAll($sql);
        return $vehiclemake;
    }

//查询整车厂家车系
    public static function queryEpcSeries($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return null;
        }
        $make = $params['make'];
        $sql = "select a.seriesid as seriesId, a.name as name from {{epc_series}} a where a.makeid=:make order by CONVERT(name USING gb2312)";
        $sqlParams = array(':make' => $make);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//查询整车厂家车型年款
    public static function queryEpcSeriesYears($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return null;
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return null;
        }

        $make = $params['make'];
        $series = $params['series'];
        $sql = "select distinct case when a.year is null then '' else a.year end as year"
                . " from {{epc_model}} a "
                . " where a.makeid = :make and a.seriesid = :series order by year desc";
        $sqlParams = array(':make' => $make, ':series' => $series);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//查询整车厂家生产的车型列表
    public static function queryEpcModels($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return null;
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return null;
        }
        $make = $params['make'];
        $series = $params['series'];
        $year = $params['year'];
        $sql = "select a.modelid as modelId, a.name as name "
                . " from {{epc_model}} a "
                . " where a.makeid = :make and a.seriesid = :series";
        $sqlParams = array(':make' => $make, ':series' => $series);
        if (!empty($year)) {
            $sql .= " and a.year = :year ";
            $sqlParams[':year'] = $year;
        } else {
            $sql .= " and (a.year is null or year = '')";
        }
        $sql .= " order by CONVERT(name USING gb2312)";
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//查询整车厂家信息
    public static function queryEpcMakeInfo($params) {
        if (!isset($params['makeId']) || empty($params['makeId'])) {
            return null;
        }
        $makeId = $params['makeId'];

        $sql = "select a.makeid as makeId, a.name as makeName"
                . " from  {{epc_makes}} a"
                . " where a.makeid = :makeid";
        $sqlParams = array(':makeid' => $makeId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询车系信息	
    public static function queryEpcSeriesInfo($params) {
        if (!isset($params['seriesId']) || empty($params['seriesId'])) {
            return null;
        }
        $seriesId = $params['seriesId'];

        $sql = "select a.seriesid as seriesId, a.name as seriesName, b.makeid as makeId, b.name as makeName"
                . " from {{epc_series}} a, {{epc_makes}} b"
                . " where a.seriesid = :seriesid and a.makeid = b.makeid";
//   echo $sql;
        $sqlParams = array(':seriesid' => $seriesId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询整车厂家生产的车型列表
    public static function queryEpcModelInfo($params) {
        if (!isset($params['modelId']) || empty($params['modelId'])) {
            return null;
        }
        $modelId = $params['modelId'];

        $sql = "select a.modelid as modelId, a.name as modelName, b.seriesid as seriesId, b.name as seriesName, "
                . " c.makeid as makeId, c.name as makeName, a.year as year"
                . " from {{epc_model}} a, {{epc_series}} b, {{epc_makes}} c"
                . " where a.modelid = :modelid and a.seriesid = b.seriesid and a.makeid = c.makeid";
        $sqlParams = array(':modelid' => $modelId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//前市场车型查询-整车厂家列表
    public static function queryFrontMakes() {
        $sql = "select a.makeid as makeId, a.name as name from {{front_makes}} a order by CONVERT(name USING gb2312)";
        $result = DBUtil::queryAll($sql);
        return $result;
    }

//前市场车型查询-依据整车厂家生产的车系列表
    public static function queryFrontSeries($params) {
        if (!isset($params['make'])) {
            return null;
        }
        $make = $params['make'];
        $sql = "select a.seriesid as seriesId, a.name as name from {{front_series}} a "
                . "  where a.makeid = :make order by CONVERT(name USING gb2312)";
        $sqlParams = array(':make' => $make);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//前市场车型查询-依据车系的车型年款
    public static function queryFrontSeriesYears($params) {
        if (!isset($params['make']) || !isset($params['series'])) {
            return null;
        }
        $make = $params['make'];
        $series = $params['series'];
        $sql = "select distinct case when a.year is null then '' else a.year end as year "
                . " from {{front_model}} a "
                . " where a.makeid = :make and a.seriesid = :series order by year desc";
        $sqlParams = array(':make' => $make, ':series' => $series);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//前市场车型查询-依据厂家、车系、年款的车型列表
    public static function queryFrontModels($params) {
        if (!isset($params['make']) || !isset($params['series'])) {
            return null;
        }
        $make = $params['make'];
        $series = $params['series'];
        $year = $params['year'];
        $sql = "select a.modelId, a.name as name, a.code as code from {{front_model}} a "
                . " where a.makeid = :make and a.seriesid = :series";
        $sqlParams = array(':make' => $make, ':series' => $series);
        if (!empty($year)) {
            $sql .= " and a.year = :year";
            $sqlParams[':year'] = $year;
        } else {
            $sql .= " and (a.year is null or year = '')";
        }
        $sql .= " order by CONVERT(name USING gb2312)";
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//查询整车厂家信息
    public static function queryFrontMakeInfo($params) {
        if (!isset($params['makeId']) || empty($params['makeId'])) {
            return null;
        }
        $makeId = $params['makeId'];

        $sql = "select a.makeid as makeId, a.name as makeName"
                . " from {{front_makes}} a"
                . " where a.makeid = :makeid";
        $sqlParams = array(':makeid' => $makeId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询车系信息
    public static function queryFrontSeriesInfo($params) {
        if (!isset($params['seriesId']) || empty($params['seriesId'])) {
            return null;
        }
        $seriesId = $params['seriesId'];

        $sql = "select a.seriesid as seriesId, a.name as seriesName, b.makeid as makeId, b.name as makeName"
                . " from {{front_series}} a, {{front_makes}} b"
                . " where a.seriesid = :seriesid and a.makeid = b.makeid";

        $sqlParams = array(':seriesid' => $seriesId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询整车厂家生产的车型列表
    public static function queryfrontModelInfo($params) {
        if (!isset($params['modelId']) || empty($params['modelId'])) {
            return null;
        }
        $modelId = $params['modelId'];

        $sql = "select a.modelid as modelId, a.name as modelName, b.seriesid as seriesId, b.name as seriesName, "
                . " c.makeid as makeId, c.name as makeName, a.year as year"
                . " from {{front_model}} a, {{front_series}} b, {{front_makes}} c"
                . " where a.modelid = :modelid and a.seriesid = b.seriesid and a.makeid = c.makeid";
        $sqlParams = array(':modelid' => $modelId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//前市场车型查询-依据整车厂家生产的车系列表
    public static function queryFrontModelsByCode($params) {
        if (!$params['code']) {
            return null;
        }
        $code = $params['code'];
        $sql = "select a.modelId as modelId, a.name as modelName, a.code as modelCode "
                . " from {{front_model}} a "
                . " where a.code = :code ";
        $sqlParams = array(':code' => $code);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询车型的详细信息
    public static function queryFrontModelParams($params) {
//检查参数
        if (!isset($params["modelId"]) || empty($params["modelId"])) {
            return null;
        }
//查询参数
        $modelId = $params["modelId"];

//车型参数信息
        $sql = " select a.modelId,a.year as yearId,a.makeid as makeId,a.seriesid as seriesId, a.name as modelName, a.code as modelCode,"
                . " (select name from {{front_makes}} m where m.makeid = a.makeid) as makeName, "
                . " (select name from {{front_series}} s where s.Seriesid = a.SeriesID) as seriesName, "
                . "    b.engineCapacity, b.aspiration, b.gearbox, b.gearboxStalls, b.bodyForm,"
                . "    b.frontTiresWidth, b.rearTiresWidth, b.skylight, b.bodyColor, b.seatMaterial,"
                . "    b.rearAirConditioner"
                . " from {{front_model}} a left join  {{front_model_params}} b on a.modelid = b.modelid"
                . " where a.modelid = :modelid";
        $sqlParams = array(':modelid' => $modelId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询车型的图片列表
    public static function queryFrontModelPics($params) {
//检查参数
        if (!isset($params["modelId"]) || empty($params["modelId"])) {
            return null;
        }

//查询参数
        $modelId = $params["modelId"];

//车型图片信息
        $sql = "select a.picId, a.title as picTitle, a.caption as picCaption, "
                . " concat(TRIM('/' from picPath),'/',a.picName) as originPic"
                . " from {{front_pic}} a right join {{front_model_pic}} b on a.picid = b.picid"
                . " where b.modelid = :modelid "
                . " order by a.picNo";
        $sqlParams = array(':modelid' => $modelId);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//整车厂家列表
    public static function queryEpcMakesWithPartname($params) {
        if (!isset($params['partname']) || empty($params['partname'])) {
            return null;
        }
        $partname = $params['partname'];
        $sql = "select a.makeid as makeId, a.name as name from {{epc_makes}} a "
                . "  where exists (select 1 from {{epc_model}}  b, {{epc_group}} c, {{epc_parts}} d "
                . "               where a.makeid = b.makeid and  b.modelid = c.modelid and c.groupid = d.groupid"
                . "                  and (d.name like :partname or d.ename like :partcname) ) ";
        $partname = '%' . $partname . '%';
        $sqlParams = array(':partname' => $partname, ':partcname' => $partname);
        $vehiclemake = DBUtil::queryAll($sql, $sqlParams);
        return $vehiclemake;
    }

//查询整车厂家车系
    public static function queryEpcSeriesWithPartname($params) {
        if (!isset($params['makeId']) || empty($params['makeId'])) {
            return null;
        }
        if (!isset($params['partname']) || empty($params['partname'])) {
            return null;
        }
        $makeId = $params['makeId'];
        $partname = $params['partname'];
        $sql = "select a.seriesid as seriesId, a.name as name from {{epc_series}} a where a.makeid = :makeid "
                . "   and exists (select 1 from {{epc_model}} b, {{epc_group}} c, {{epc_parts}} d "
                . "               where a.seriesid = b.seriesid and  b.modelid = c.modelid and c.groupid = d.groupid"
                . "                  and (d.name like :partname or d.ename like :partcname) ) ";
        $partname = '%' . $partname . '%';
        $sqlParams = array(':makeid' => $makeId, ':partname' => $partname, ':partcname' => $partname);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//查询整车厂家车型年款
    public static function queryEpcSeriesYearsWithPartname($params) {
        if (!isset($params['makeId']) || empty($params['makeId'])) {
            return null;
        }
        if (!isset($params['seriesId']) || empty($params['seriesId'])) {
            return null;
        }
        if (!isset($params['partname']) || empty($params['partname'])) {
            return null;
        }
        $makeId = $params['makeId'];
        $seriesId = $params['seriesId'];
        $partname = $params['partname'];
        $sql = "select distinct case when a.year is null then '' else a.year end as year"
                . " from {{epc_model}} a where a.makeid = :makeid and a.seriesid = :seriesid"
                . "   and exists (select 1 from {{epc_group}} c, {{epc_parts}} d "
                . "               where a.modelid = c.modelid and c.groupid = d.groupid"
                . "                  and (d.name like :partname or d.ename like :partcname) ) "
                . " order by year desc";
        $partname = '%' . $partname . '%';
        $sqlParams = array(':makeid' => $makeId, ':seriesid' => $seriesId, ':partname' => $partname, ':partcname' => $partname);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//查询整车厂家生产的车型列表
    public static function queryEpcModelsWithPartname($params) {
        if (!isset($params['makeId']) || empty($params['makeId'])) {
            return null;
        }
        if (!isset($params['seriesId']) || empty($params['seriesId'])) {
            return null;
        }
        if (!isset($params['partname']) || empty($params['partname'])) {
            return null;
        }
        $makeId = $params['makeId'];
        $seriesId = $params['seriesId'];
        $year = $params['year'];
        $partname = $params['partname'];
        $sql = "select a.modelid as modelId, a.name as name"
                . " from {{epc_model}} a where a.makeid = :makeid and a.seriesid = :seriesid"
                . "   and exists (select 1 from {{epc_group}} c, {{epc_parts}} d "
                . "               where a.modelid = c.modelid and c.groupid = d.groupid"
                . "                  and (d.name like :partname or d.ename like :partcname) ) ";
        $partname = '%' . $partname . '%';
        $sqlParams = array(':makeid' => $makeId, ':seriesid' => $seriesId, ':partname' => $partname, ':partcname' => $partname);
        if (!empty($year)) {
            $sql .= " and a.year = :year ";
            $sqlParams[':year'] = $year;
        } else {
            $sql .= " and (a.year is null or year = '')";
        }
        $sql .= " order by CONVERT(name USING gb2312)";
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//养护周期查询-整车厂家列表
    public static function queryMtcVehicleMake() {
        $sql = "select distinct a.make from {{vehicle_mtc}} a where a.make is not null order by CONVERT(make USING gb2312)";
        $result = DBUtil::queryAll($sql);
        return $result;
    }

//养护周期查询-依据整车厂家生产的车系列表
    public static function queryMtcVehicleCarByMake($params) {
        if (!isset($params['make'])) {
            return null;
        }
        $make = $params['make'];
        $sql = "select distinct a.car from {{vehicle_mtc}} a "
                . "  where a.make = :make and a.car is not null order by CONVERT(car USING gb2312)";
        $sqlParams = array(':make' => $make);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//养护周期查询-依据车系查询车型发动机
    public static function queryMtcVehicleEngineByMake($params) {
        if (!isset($params['make']) || !isset($params['car'])) {
            return null;
        }
        $make = $params['make'];
        $car = $params['car'];
        $sql = "select distinct a.vehicleMtcID, a.engine "
                . " from {{vehicle_mtc}} a "
                . " where a.make = :make and a.car = :car order by CONVERT(engine USING gb2312)";
        $sqlParams = array(':make' => $make, ':car' => $car);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

//养护周期查询-查询车型信息
    public static function queryMtcVehicleDetail($params) {
//检查参数
        if (!isset($params["vehicleMtcID"]) || empty($params["vehicleMtcID"])) {
            exit;
        }
//查询参数
        $vehicleMtcID = (int) $params["vehicleMtcID"];

//车型参数信息
        $sql = " select a.VehicleMtcID, a.Make, a.Car, a.Engine, CONCAT(a.Car ,' ',a.Engine) as Model"
                . " from {{vehicle_mtc}} a"
                . " where a.vehicleMtcID = :vehicleMtcID";
        $sqlParams = array(':vehicleMtcID' => $vehicleMtcID);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//----goods
//整车厂家列表
    public static function queryGoodsMakes() {
//  $sql = "select a.makeid as makeId, a.name as name ,a.pyf as pinyin from goods_makes a order by CONVERT(pinyin USING gb2312)";
        $sql = "select a.makeid as makeId, a.name as name ,a.pyf as pinyin from {{front_makes}} a order by pyf, CONVERT(name USING gb2312)";
        $vehiclemake = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
        return $vehiclemake;
    }

    //----goods
//整车厂家列表
    public static function queryGoodsBrands() {
//  $sql = "select a.makeid as makeId, a.name as name ,a.pyf as pinyin from goods_makes a order by CONVERT(pinyin USING gb2312)";
        $sql = "select a.BrandID as BrandID,a.BrandLogo as BrandLogo, a.Name as Name ,a.Pyf as pinyin from {{front_brand}} a order by Pyf, CONVERT(Name USING gb2312)";
        $vehiclemake = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
        return $vehiclemake;
    }

//----goods
//整车厂家列表-关联主营车系
    public static function queryGoodsMakeself() {
//  $sql = "select a.makeid as makeId, a.name as name ,a.pyf as pinyin from goods_makes a order by CONVERT(pinyin USING gb2312)";
        $organID = Yii::app()->user->getOrganID();
        $sqlmid = "select distinct(MakeID) from {{dealer_vehicles}} where OrganID=" . $organID;
        $makeID = Yii::app()->jpdb->createCommand($sqlmid)->queryAll();
        $makeIDs = '(';
        foreach ($makeID as $key => $value) {
            if ($key)
                $makeIDs .= ',' . $value['MakeID'];
            else
                $makeIDs .= $value['MakeID'];
        }
        $makeIDs .= ')';
        $sql = "select a.makeid as makeId, a.name as name ,a.pyf as pinyin from {{front_makes}} a where a.makeid in " . $makeIDs . "  order by pyf, CONVERT(name USING gb2312)";
        $vehiclemake = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
        return $vehiclemake;
    }

//查询整车厂家车系
    public static function queryGoodsSeries($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return null;
        }
        $make = $params['make'];
        $sql = "select a.seriesid as seriesId, a.name as name, t.Number as number from {{front_series}} a left outer join {{number_goods}} t  on a.Seriesid=t.ReID and t.Type=1 where a.makeid='" . $make . "' order by a.Sort asc";
        $result = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
        return $result;
    }

//查询整车厂家车系
    public static function queryGoodsSerieself($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return array();
        }
        $make = $params['make'];
        $organID = Yii::app()->user->getOrganID();
        $sqlcid = "select distinct(CarID) from {{dealer_vehicles}} where OrganID=" . $organID . " and  MakeID=" . $make;
        $CarID = Yii::app()->jpdb->createCommand($sqlcid)->queryAll();
        if ($CarID[0][CarID]) {
            $CarIDs = '(';
            foreach ($CarID as $key => $value) {
                if ($key)
                    $CarIDs .= ',' . $value['CarID'];
                else
                    $CarIDs .= $value['CarID'];
            }
            $CarIDs .= ')';
            $sql = "select a.seriesid as seriesId, a.name as name from {{front_series}} a where a.seriesid in " . $CarIDs . " and a.makeid='" . $make . "' order by CONVERT(name USING gb2312)";
            $result = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
            return $result;
        }else {
            $sql = "select a.seriesid as seriesId, a.name as name from {{front_series}} a where a.makeid='" . $make . "' order by CONVERT(name USING gb2312)";
            $result = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
            return $result;
        }
    }

//查询整车厂家车型年款
    public static function queryGoodsSeriesYears($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return null;
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return null;
        }

        $make = $params['make'];
        $series = $params['series'];
        $sql = "select distinct case when a.year is null then '' else a.year end as year"
                . " from {{front_model}} a "
                . " where a.makeid = '" . $make . "' and a.seriesid = '" . $series . "' order by year desc";
        $result = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
        return $result;
    }

//查询整车厂家生产的车型列表
    public static function queryGoodsModels($params) {
        if (!isset($params['make']) || empty($params['make'])) {
            return null;
        }
        if (!isset($params['series']) || empty($params['series'])) {
            return null;
        }
        $make = $params['make'];
        $series = $params['series'];
        $year = $params['year'];
        $sql = "select a.modelid as modelId, a.name as name"
                . " from {{front_model}} a "
                . " where a.makeid = '" . $make . "' and a.seriesid = '" . $series . "'";
        if (!empty($year)) {
            $sql .= " and a.year = '" . $year . "'";
        } else {
            $sql .= " and (a.year is null or year = '')";
        }
        $sql .= " order by CONVERT(name USING gb2312)";
        $result = Yii::app()->jpdb->cache(0, $dependency)->createCommand($sql)->queryAll();
        return $result;
    }

//查询整车厂家信息
    public static function queryGoodsMakeInfo($params) {
        if (!isset($params['makeId']) || empty($params['makeId'])) {
            return null;
        }
        $makeId = $params['makeId'];

        $sql = "select a.makeid as makeId, a.name as makeName"
                . " from {{goods_makes}} a"
                . " where a.makeid = :makeid";
        $sqlParams = array(':makeid' => $makeId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询车系信息	
    public static function queryGoodsSeriesInfo($params) {
        if (!isset($params['seriesId']) || empty($params['seriesId'])) {
            return null;
        }
        $seriesId = $params['seriesId'];

        $sql = "select a.seriesid as seriesId, a.name as seriesName, b.makeid as makeId, b.name as makeName"
                . " from {{goods_series}} a, {{goods_makes}} b"
                . " where a.seriesid = :seriesid and a.makeid = b.makeid";
//   echo $sql;
        $sqlParams = array(':seriesid' => $seriesId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询整车厂家生产的车型列表
    public static function queryGoodsModelInfo($params) {
        if (!isset($params['modelId']) || empty($params['modelId'])) {
            return null;
        }
        $modelId = $params['modelId'];

        $sql = "select a.modelid as modelId, a.name as modelName, b.seriesid as seriesId, b.name as seriesName, "
                . " c.makeid as makeId, c.name as makeName, a.year as year,a.alias as alias"
                . " from {{goods_model}} a, {{goods_series}} b, {{goods_makes}} c"
                . " where a.modelid = :modelid and a.seriesid = b.seriesid and a.makeid = c.makeid";
        $sqlParams = array(':modelid' => $modelId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

    public static function queryGoodsYearModels($seriesId) {
        if (!isset($seriesId) || empty($seriesId)) {
            return null;
        }
//                $sql="select a.seriesid as seriesId, a.name as seriesName, b.makeid as makeId, b.name as makeName"
//			." from goods_series a, goods_makes b"
//			." where a.seriesid = :seriesid and a.makeid = b.makeid";

        $sql = "select a.modelid as modelId, a.name as name, a.alias as alias, a.ename as ename, a.year as year"
                . " from {{goods_model}} a "
                . " where a.seriesid = :seriesid";
//   echo $sql;
        $sqlParams = array(':seriesid' => $seriesId);
        $result = DBUtil::query($sql, $sqlParams);
        return $result;
    }

//查询EPC主组子组ID查询主组子组名称
    public static function queryEpcGroupName($params) {
//检查参数
        if (!isset($params["groupId"]) || empty($params["groupId"])) {
            exit;
        }
        $sql = "select name from {{epc_group}} where groupid=:groupId";
        $sqlParams = array(':groupId' => $params['groupId']);
        $group = DBUtil::query($sql, $sqlParams);
        return $group['name'];
    }

// 获取年款 车型
    public static function queryGoodsYearModels2($params) {
        if (!isset($params['seriesId']) || empty($params['seriesId'])) {
            return array();
        }
        $seriesId = $params['seriesId'];
        $sql = "select a.modelid as modelId, a.name as name, a.alias as alias, a.ename as ename, a.year as year FROM {{goods_model}} a where seriesid =" . $seriesId;
        $models = DBUtil::queryAll($sql);
        $year = array();
        $new_models = array();
        foreach ($models as $key => $value) {
            $year[$key] = $value['year'];
        }
        $unique_year = array_unique($year);
        $i = 0;
        if (!$models) {
            return array();
        }
        foreach ($models as $k => $v) {
            if (!empty($new_models[$i])) {
                if (!in_array($v['year'], $new_models[$i])) {
                    $i++;
                }
            }
            if (in_array($v['year'], $unique_year)) {
                $new_models[$i]['year'] = $v['year'];
                foreach ($models as $key => $model) {
                    if ($model['year'] == $new_models[$i]['year']) {
                        $new_models[$i][$key]['modelId'] = $model['modelId'];
                        $new_models[$i][$key]['name'] = $model['name'];
                        $new_models[$i][$key]['alias'] = $model['alias'];
                        $new_models[$i][$key]['year'] = $model['year'];
                        $new_models[$i][$key]['ename'] = $model['ename'];
                    }
                }
            }
        }
        return $new_models;
    }

}

?>