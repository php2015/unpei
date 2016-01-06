<?php

class ReserveService {

    //根据车辆信息查询车型保养所需配件
    public static function queryFrontVehicleMaintenanceIteminfo($params) {
        //检查参数
        if (!isset($params["Code"]) || empty($params["Code"])) {
            exit;
        }

        //查询参数
        //$vehicleID = (int) $params["vehicleID"];

        //车型保养周期信息息
        $sql = "select distinct c.Code, c.Name, b.Mileage, b.Period, b.Desc, b.InFirst, b.InSecond,"
                . " d.FirstMileage, d.FirstPeriod, d.SecondMileage, d.SecondPeriod, d.IntervalMileage, d.IntervalPeriod"
                . " from {{vehicle_to_maintenance_config}} a, {{maintenance_config_to_item}} b, {{gcategory}} c, "
                . "{{maintenance_config}} d, {{front_mtc_relation}} e"
                . " where a.MaintenanceConfigID = b.MaintenanceConfigID and b.Code = c.Code"
                . " and a.MaintenanceConfigID = d.MaintenanceConfigID and a.vehicleid = e.MtcID"
                . " and e.FrontCode = :FrontCode";
        $sqlParams = array(':FrontCode' => $params["Code"]);
        $result = DBUtil::queryAll($sql, $sqlParams);
        return $result;
    }

    //查询商品sql
    public static function getGoodsSql($params) {
        $organ_ID = Yii::app()->user->getOrganID();
        // 查询条件
        $sub = $params['sub'];            //子类
        $code = $params['code'];            //标准名称
        $select = "distinct dg.ID,dg.Name, dg.Pinyin, dg.BrandID, dg.GoodsNO, dg.Price, dg.ProPrice,dg.PartsLevel,dg.StandCode,dg.Memo,
                dg.IsPro,dg.IsSale,dg.OrganID,dg.CreateTime,dg.ProTime,dg.Sales,dg.Provenance,dg.CommentNo,pb.BrandName";
        $sql = "SELECT $select,                
                if(dg.ProPrice and dg.IsPro=1,dg.ProPrice,if(discount.PriceRatio,discount.PriceRatio*dg.Price,dg.Price)) as ppp
                FROM `pap_goods` dg 
                left join(SELECT p.OrganID as OrganID, p.PriceRatio/100 as PriceRatio from `pap_goods_price_manage` AS p ,`pap_client_type` as ct 
                WHERE p.CooperationType = ct.Cooperationtype AND  ct.ServiceID = $organ_ID and ct.DealerID=p.OrganID 
                AND (!ISNULL(p.PriceRatio) AND p.PriceRatio !='')) as discount on dg.OrganID = discount.OrganID"
                . " LEFT JOIN pap_brand AS pb ON dg.BrandID = pb.ID";
        $sqlw = " where dg.IsDelete=1 and dg.IsSale=1";

        if ($code)
            $sqlw.= " and dg.StandCode='{$code}'";
        else if ($sub) {
            $codestr = self::getCodeBySub($sub);
            $sqlw.= " and dg.StandCode in ({$codestr})";
        }

        //商品查询sql
        $sql = $sql . $sqlw;
        //查询商品个数sql
        $countSql = str_replace($select, 'count(distinct(dg.ID)) as count', $sql);

        return array('sql' => $sql, 'countSql' => $countSql);
    }

    //获取商品列表
    public static function getGoodsData($params) {
        $sql = self::getGoodsSql($params);
        if ($params['SellerID'] && $params['IsSale'] == 0) {
            $sql["countSql"] = str_replace('dg.IsSale=1', 'dg.IsSale=0', $sql["countSql"]);
            $sql["sql"] = str_replace('dg.IsSale=1', 'dg.IsSale=0', $sql["sql"]);
        }
        $res = Yii::app()->papdb->createCommand($sql["countSql"])->queryAll();
        $count = $res[0]['count'];
        $dataProvider = new CSqlDataProvider($sql["sql"], array(
            'db' => Yii::app()->papdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => $params['rows'] ? $params['rows'] : 10,
            ),
        ));
        $goods = $dataProvider->getData();
        foreach ($goods as $k => $v) {
            $image = self::getOneGoodsImage($v['ID']);
            if (!$image) {
                $goods[$k]['image'] = F::baseUrl() . '/upload/' . 'dealer/default-goods.png';
            } else {
                $goods[$k]['image'] = F::baseUrl() . '/upload/' . $image;
            }

            //获取标准名称
            if ($v['StandCode']) {
                $goods[$k]['cpname'] = Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code = '{$v['StandCode']}'"))->attributes['Name'];
            }

            //卖家信息
            $goods[$k]['dealername'] = Organ::model()->findByPk($v['OrganID'], array('select' => 'OrganName'))->attributes['OrganName'];
            if (!$params["resource"] || $params["resource"] != "mall") {
                //OE号
                $goods[$k]['OENOS'] = self::getOENOSByGoodsID($v['ID']);
                // 车型车系
                //$carmodel = explode('、', self::getVehicleByGoodsID($v['ID']));
                //$goods[$k]['vehicle'] = $carmodel[0];
                //$goods[$k]['vehicle'] = self::getOneVehicleByGoodsID($v['ID']);
            }
        }
        $dataProvider->setData($goods);
        return array('dataProvider' => $dataProvider, 'count' => $count);
    }

    //获取商品列表
    public static function getPurchaseData($params) {
        //var_dump($params);die;
        $OrganID = Yii::app()->user->getOrganID();
        $sql = "SELECT prp.ReserveID, prp.CreateTime, jsr.LicensePlate, prp.InOrder, jsr.ReserveNum
		    	FROM pap_reserve_purchase as prp,jpd.jpd_service_reserve as jsr
		        WHERE prp.ReserveID = jsr.ID AND prp.OrganID = '{$OrganID}' ";
        if ($params['LicensePlate']) {
            $sql .= "AND LicensePlate LIKE '%{$params['LicensePlate']}%' ";
        }
        if ($params['CreateTime']) {
            $sql .= "AND prp.CreateTime = unix_timestamp('{$params['CreateTime']}') ";
        }
        if ($params['ReserveNum']) {
            $sql .= "AND jsr.ReserveNum = '{$params['ReserveNum']}' ";
        }
        if ($params['InOrder'] == 2) {
            $sql .= "AND InOrder = 0 ";
        } elseif ($params['InOrder'] == 3) {
            $sql .= "AND InOrder = 1 ";
        }
        $sql .= "group by prp.ReserveID, prp.InOrder, prp.CreateTime order by prp.ID desc";
        $countsql = "SELECT COUNT(*) FROM (" . $sql . ") as tab";
        //echo $sql;die;
        $count = Yii::app()->papdb->createCommand($countsql)->queryScalar();

        $dataProvider = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->papdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
        $data = $dataProvider->getData();
        //var_dump($data);die;
        foreach ($data as $key => $val) {
            $arr = self::getPurchaseDataByReserveID($val['ReserveID'], $val['InOrder'], $val['CreateTime']);
            $data[$key]['goodsinfo'] = $arr['data'];
            $data[$key]['RealPrice'] = $arr['RealPrice'];
        }
        $dataProvider->setData($data);
        return $dataProvider;
    }

    //根据车牌号查询所需采购配件
    public static function getPurchaseDataByReserveID($ReserveID, $InOrder, $CreateTime) {
        $OrganID = Yii::app()->user->getOrganID();
        $sql = "SELECT distinct prp.ID as purchaseID, pg.ID as GoodsID, pg.Price, pg.ProPrice, 
                pg.IsPro, prp.Num as Quantity, pg.Name as GoodsName, pg.GoodsNO as GoodsNum, 
                pb.BrandName, jg.Name as CpName, prp.CreateTime, pg.OrganID, prp.OrderID, jo.OrganName
                FROM pap_reserve_purchase AS prp LEFT JOIN jpd.jpd_gcategory AS jg ON prp.GcategoryCode = jg.Code 
                LEFT JOIN pap_goods AS pg ON prp.GoodsID = pg.ID LEFT JOIN jpd.jpd_organ AS jo ON pg.OrganID = jo.ID
                LEFT JOIN pap_brand AS pb ON pg.BrandID = pb.ID
                WHERE prp.OrganID = '{$OrganID}' AND prp.ReserveID = '{$ReserveID}' 
                AND prp.InOrder = '{$InOrder}' AND prp.CreateTime = '{$CreateTime}' ORDER BY prp.ID DESC";
        $data = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        $RealPrice = 0;
        foreach ($data as $key => $val) {
            $price = self::getContactprice($val['OrganID'], $OrganID);
            $data[$key]['Price'] = $val['Price'];
            $val['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
            if ($val['PriceRatio'] > 0) {
                $data[$key]['DisPrice'] = sprintf("%.2f", $val['Price'] * $val['PriceRatio'] / 100);    // 折扣价,小数点后面保留两位
            }
            if ($val['IsPro'] == 1) {
                if (!is_null($val['ProPrice']) && $val['ProPrice']) {
                    $data[$key]['ProPrice'] = $val['ProPrice'];
                }
            }
            if ($data[$key]['ProPrice']) {
                $RealPrice += $data[$key]['ProPrice'] * $val['Quantity'];
            } else if ($data[$key]['DisPrice']) {
                $RealPrice += $data[$key]['DisPrice'] * $val['Quantity'];
            } else {
                $RealPrice += $data[$key]['Price'] * $val['Quantity'];
            }
            $data[$key]['GoodsOE'] = self::getOENOSByGoodsID($val['GoodsID']);
            $data[$key]['ImageUrl'] = self::getOneGoodsImage($val['GoodsID']);
        }
        return array('data' => $data, 'RealPrice' => $RealPrice);
    }

    //获取商品图片
    public static function getOneGoodsImage($id) {
        $sql = "select ImageUrl from pap_goods_image_relation where GoodsID=$id limit 1";
        $data = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        return $data[0]['ImageUrl'];
    }

    /**
     * 获取OE号
     */
    public static function getOENOSByGoodsID($goodsID) {
        $key = 'oenu_' . $goodsID;
        $OENOS = Yii::app()->cache->get($key);
        if (!$OENOS) {
            $goodsOES = PapGoodsOeRelation::model()->findAll("GoodsID=$goodsID");
            $data = array();
            $OENOS = '';
            foreach ($goodsOES as $key => $value) {
                $data[$key]['ID'] = $value['ID'];
                $data[$key]['OENO'] = $value['OENO'];
                if ($key == 0)
                    $OENOS .= $value['OENO'];
                else
                    $OENOS .= '、' . $value['OENO'];
            }
            Yii::app()->cache->set($key, $OENOS);
        }
        return $OENOS;
    }

    //经销商和修理厂之间的折扣
    public static function getContactprice($dealerID, $seriveID) {
        $criteria = new CDbCriteria();
        $criteria->select = "Cooperationtype";
        $criteria->addCondition("t.DealerID = $dealerID", "AND");            //经销商ID
        $criteria->addCondition("t.ServiceID = $seriveID", "AND");     //当前登录的修理厂ID
        $contact = PapClientType::model()->find($criteria);
        if (!$contact) {
            $contact['Cooperationtype'] = 'C';
        }
        return PapGoodsPriceManage::model()->find(array(
                    "condition" => "OrganID = $dealerID AND CooperationType like '%{$contact['Cooperationtype']}%'"
        ));
    }

    public static function checkmin($params){
        $str = rtrim($params['key'],',');
        $sql = "SELECT a.ID, a.Num, b.OrganID, b.Price, b.ProPrice, b.IsPro, c.OrganName 
                FROM pap_reserve_purchase AS a LEFT JOIN pap_goods AS b ON a.GoodsID = b.ID 
                LEFT JOIN jpd.jpd_organ AS c ON b.OrganID = c.ID 
                WHERE b.IsSale =1 AND a.ID IN ({$str})";
        $result = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        $data = array();
        foreach ($result as $val){
            $data[$val['OrganID']][] = $val;
        }
        foreach ($data as $key=>$val){
            $min = PapOrderMinTurnover::model()->find("OrganID = {$key}")->MinTurnover;
            $sum = 0;
            foreach ($val as $v){
                if ($v['IsPro']) {
                    $sum += $v['ProPrice'] * $v['Num'];
                } else {
                    $price = self::getContactprice($key, Yii::app()->user->getOrganID());
                    $PriceRatio = $price['PriceRatio'] ? $price['PriceRatio'] : "100";
                    $DisPrice = sprintf("%.2f", $v['Price'] * $PriceRatio / 100);    // 折扣价,小数点后面保留两位
                    $sum += $DisPrice * $v['Num'];
                }
            }
            if($min > $sum){
                $strarr = explode(",", $str);
                 foreach ($val as $v){
                    $index = array_keys($strarr,$v['ID']);
                    unset($strarr[$index[0]]);
                 }
                $ID = implode(",", $strarr);
                $arr['result'] = 1;
                $arr['ID'] = $ID;
                $arr['min'] = $min;
                $arr['sum'] = $sum;
                $arr['OrganName'] = $val[0]['OrganName'];
                return $arr;
            }
        }
        return array('result'=>0);
    }
}
