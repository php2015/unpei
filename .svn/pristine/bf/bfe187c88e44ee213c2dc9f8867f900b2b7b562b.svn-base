<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MallService {

    //获取一个子类下面的所有标准名称
    public static function getCodeBySub($sub) {
        $model = Gcategory::model()->findAll("ParentID=$sub and IsShow = 1");
        // $model = Gcategory::model()->findAll(array('condition'=>"ParentID=$sub and IsShow = 1",'select'=>'distinct Code'));
        $code = '';
        if ($model) {
            foreach ($model as $v) {
                $code.= $v['Code'] ? "'" . $v['Code'] . "'," : "";
            }
            $code = substr($code, 0, -1);
        }
        return $code ? $code : "''";
    }

    //获取被选中的子类
    public static function checkSub($params) {
        $sub = $params['sub'];
        $code = $params['code'];
        //是否为空
        if ($sub == '') {
            return false;
        } else {
            //是否存在
            $m = Gcategory::model()->findByPk($sub, 'IsShow = 1')->attributes;
            if (!$m) {
                return false;
            } else {
                //父类是否为大类
                $p = Gcategory::model()->findByPk($m['ParentID'], "ParentID=0 and IsShow = 1");
                if (!$p) {
                    return false;
                } else {
                    //标准名称是否存在
                    $c = Gcategory::model()->find("ParentID={$sub} and IsShow = 1 and Code='{$code}'");
                    $newCode = $c ? $code : '';
                }
            }
        }
        $choose = $c ? $c['Name'] : $m['Name'];
        return array('m' => $m, 'sub' => $sub, 'code' => $newCode, 'choose' => $choose);
    }

    //获取子类和标准名称
    public static function getList($param) {
        $tmp = self::checkSub($param);
        if (!$tmp['sub']) {
            return false;
        }
        $m = $tmp['m'];
        $subModel = Gcategory::model()->findAll(array('condition' => "ParentID={$m['ParentID']} and IsShow = 1",
            'select' => 'Name,ID,ParentID', 'order' => 'PinYin,SortOrder,ID asc'));
        $data = array();
        foreach ($subModel as $v) {
            $data[$v['ID']]['ID'] = $v['ID'];
            $data[$v['ID']]['Name'] = $v['Name'];
            $data[$v['ID']]['ParentID'] = $v['ParentID'];
            $cpModel = Gcategory::model()->findAll(array('condition' => "ParentID={$v['ID']} and IsShow = 1",
                'order' => "PinYin,SortOrder,ID asc", 'select' => 'Name,ID,ParentID,Code'));
            $data[$v['ID']]['code'] = array();
            if ($cpModel) {
                foreach ($cpModel as $kk => $vv) {
                    $data[$v['ID']]['code'][$kk]['ID'] = $vv['ID'];
                    $data[$v['ID']]['code'][$kk]['Name'] = $vv['Name'];
                    $data[$v['ID']]['code'][$kk]['ParentID'] = $vv['ParentID'];
                    $data[$v['ID']]['code'][$kk]['Code'] = $vv['Code'];
                }
            }
        }
        return array('sub' => $tmp['sub'], 'code' => $tmp['code'], 'choose' => $tmp['choose'], 'data' => $data);
    }

    //关键字过滤
    public static function checkKey($key) {
        $key = trim($key);
        if ($key) {
            $patterns = array('/<<q>>/', '/%/', '/_/', '/\[/', '/\]/');
            $replacements = array('/', '\\\\\%', '\\\\\_', '\\\\\[', '\\\\\]');
            $keyword2 = preg_replace($patterns, $replacements, $key);
            $keyword = str_replace(' ', '%', $keyword2);
        }
        return $keyword ? $keyword : $key;
    }

    //获取查询到的子类和标准名称
    public static function getSearchCode($params) {
        if (!$params['keyword'] || !$params['union'] || !is_array($params['union'])) {
            return array();
        }
        $sqlg = "SELECT distinct StandCode FROM pap.`pap_goods` pg";
        if (!empty($params['car']['make'])) {
            $sqlm.= " and pv.Make='{$params['car']['make']}'";
            if (!empty($params['car']['series'])) {
                $sqlm.=" and pv.Car='{$params['car']['series']}'";
                if (!empty($params['car']['year'])) {
                    $sqlm.=" and pv.Year='" . trim($params['car']['year']) . "'";
                    if (!empty($params['model'])) {
                        $sqlm.=" and pv.Model='{$params['car']['model']}'";
                    }
                }
            }
            $sqlg.=" join pap.pap_goods_vehicle_relation pv on pg.ID = pv.GoodsID ";
        }
        $unionstr = implode(',', $params['union']);
        $sqlg.=" where pg.StandCode!='' and pg.IsDelete=1 and pg.IsSale=1 and pg.OrganID in($unionstr)";
        if ($params['keyword']) {
            $sqlg.=" and pg.title like '%{$params['keyword']}%'";
        }
        if ($params['skwd']) {
            $sqlg.=" and pg.title like '%{$params['skwd']}%'";
        }
        if ($params['brand']) {
            $sqlg.=" and pg.Brand = '{$params['brand']}'";
        }
        $sql = "select jp.ID,jp.Name,jg.codestr,jg.codename from jpd_gcategory jp join 
            (SELECT ParentID,GROUP_CONCAT(Code) as codestr,GROUP_CONCAT(Name) as codename from jpd_gcategory jg1 join($sqlg $sqlm) 
            as pg1 on jg1.Code =pg1.StandCode group by ParentID ) as jg on jp.ID=jg.ParentID group by jp.Name order by jp.PinYin";
        // die;  
        return $model = Yii::app()->jpdb->CreateCommand($sql)->queryAll();
    }

    //获取商品品牌
    public static function getBrand($params) {
        if (!$params['keyword'] && $params['type'] == 1) {
            return array();
        }
        if (!$params['union'] || !is_array($params['union'])) {
            return array();
        }
        $sub = $params['sub'];
        $code = $params['code'];
        $brand = $params['brand'];
        $sql = "select distinct pb.BrandName,pb.Pinyin from pap_brand pb";
        $sqlw = " join `pap_goods` pg on pb.ID=pg.BrandID";
        $keyword = $params['keyword'];
        $skwd = $params['skwd'];
        if (!empty($params['car']['make'])) {
            $sqlm.= " and pv.Make='{$params['car']['make']}'";
            if (!empty($params['car']['series'])) {
                $sqlm.=" and pv.Car='{$params['car']['series']}'";
                if (!empty($params['car']['year'])) {
                    $sqlm.=" and pv.Year='" . trim($params['car']['year']) . "'";
                    if (!empty($params['model'])) {
                        $sqlm.=" and pv.Model='{$params['car']['model']}'";
                    }
                }
            }
            $sqlw.=" join pap.pap_goods_vehicle_relation pv on pg.ID = pv.GoodsID ";
        }
        $unionstr = implode(',', $params['union']);
        $sqlw.=" where pg.IsSale=1 and pg.IsDelete=1 and pg.OrganID in($unionstr)" . $sqlm;
        if ($params["type"] == 2) {
            //关键字搜索品牌
            if (!empty($skwd) || $sub) {
                $sql = $sql . $sqlw;
                //关键字搜索
                if (!empty($skwd))
                    $sql.=" and pg.Title like  '%" . trim($skwd) . "%'";
                //子类搜索品牌
                if ($sub) {
                    $codestr = self::getCodeBySub($sub);
                    $sql.=" and pg.StandCode in ({$codestr})";
                }
                $sql.=" and pg.OrganID={$params['dealerid']} and pb.OrganID={$params['dealerid']}";
            } else {
                if ($sqlm)
                    $sql = $sql . $sqlw . " and pg.OrganID={$params['dealerid']} and pb.OrganID=" . $params['dealerid'];
                else
                    $sql.= ' where pb.OrganID=' . $params['dealerid'];
            }
        } else {
            $sql = $sql . $sqlw;
            if (!empty($skwd))
                $sql.=' and pg.Title like "%' . trim($skwd) . '%" ';
            if ($code) {
                $sql.= " and pg.StandCode='{$code}'";
            } else if ($sub) {
                $codestr = self::getCodeBySub($sub);
                $sql.= " and pg.StandCode in ({$codestr})";
            }
            if ($params['type'] == 1) {
                if (!empty($keyword)) {
                    $sql.=" and pg.Title like  '%" . trim($keyword) . "%'";
                }
            }
        }
        $sql.=" order by PinYin";
        //die;
        $model = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        $data = array();
        $newBrand = '';
        foreach ($model as $v) {
            if ($v['BrandName'] == $brand) {
                $newBrand = $v['BrandName'];
            }
            $py = strtoupper(substr(self::checkFirstName($v["Pinyin"]), 0, 1));
            $data['All'][] = $v['BrandName'];
            if (!$py) {
                $data['Else'][] = $v['BrandName'];
            } else {
                $data['Sort'][$py][] = $v['BrandName'];
            }
        }
        return array('data' => $data, 'brand' => $newBrand);
    }

    //检测品牌拼音
    public static function checkFirstName($subject) {
        $pattern = '/[A-Za-z]+/';
        preg_match($pattern, $subject, $matches);
        return $matches[0];
    }

    //排序类别
    public static function getOrder($order) {
        switch ($order) {
            //销量升序
            case 'sales_h':$o[0] = 'sales_h';
                $o['class'][0] = 'li_current li_current_up';
                break;
            //价格降序
            case 'price_l':$o[0] = 'price_l';
                $o['class'][1] = 'li_current li_current_down';
                break;
            //价格升序
            case 'price_h':$o[0] = 'price_h';
                $o['class'][1] = 'li_current li_current_up';
                break;
            //评论数降序
            case 'comment_l':$o[0] = 'comment_l';
                $o['class'][2] = 'li_current li_comment_down';
                break;
            //评论数升序
            case 'comment_h':$o[0] = 'comment_h';
                $o['class'][2] = 'li_current li_comment_up';
                break;
            //上架时间降序
            case 'ctime_l':$o[0] = 'ctime_l';
                $o['class'][3] = 'li_current li_ctime_down';
                break;
            //上架时间升序
            case 'ctime_h':$o[0] = 'ctime_h';
                $o['class'][3] = 'li_current li_ctime_up';
                break;
            //默认销量降序
            default:$o[0] = 'sales_l';
                $o['class'][0] = 'li_current li_current_down';
        }
        $o['name'] = array('销量', '价格', '评论数', '上架时间');
        $o['order'][0] = $o[0] == 'sales_l' ? 'sales_h' : '';
        $o['order'][1] = $o[0] == 'price_l' ? 'price_h' : 'price_l';
        $o['order'][2] = $o[0] == 'comment_l' ? 'comment_h' : 'comment_l';
        $o['order'][3] = $o[0] == 'ctime_l' ? 'ctime_h' : 'ctime_l';
        return $o;
    }

    //商品价格区间
    public static function getPrice($params) {
        $price = $params['price'];
        $priceData = array('99' => array('text' => '100以下', 'cond' => array('min' => 0, 'max' => 99)),
            '100' => array('text' => '100-199', 'cond' => array('min' => 100, 'max' => 199)),
            '200' => array('text' => '200-499', 'cond' => array('min' => 200, 'max' => 499)),
            '500' => array('text' => '500-999', 'cond' => array('min' => 500, 'max' => 999)),
            '1000' => array('text' => '1000-1999', 'cond' => array('min' => 1000, 'max' => 1999)),
            '2000' => array('text' => '1999以上', 'cond' => array('min' => 1999, 'max' => 10000000))
        );
        $pricearr = array();
        if (array_key_exists($price, $priceData)) {
            $pricearr['cond'] = $priceData[$price]['cond'];
            $pricearr['val'] = $price;
            $pricearr['text'] = $priceData[$price]['text'];
        }
        return array('data' => $priceData, 'price' => $pricearr);
    }

    //获取商品图片
    public static function getOneGoodsImage($id) {
        $sql = "select ImageUrl from pap_goods_image_relation where GoodsID=$id limit 1";
        $data = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        return $data[0]['ImageUrl'];
    }

    //获取商品图片
    public static function getOneGoodsImagethumb($id) {
        $sql = "select MallImage from pap_goods_image_relation where GoodsID=$id limit 1";
        $data = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        return $data[0]['MallImage'];
    }

    //根据oe号获取商品ID
    public static function getGoodsIDByOE($oe) {
        $model = PapGoodsOeRelation::model()->findAll(array('select' => 'GoodsID', 'condition' => "OENO like '%$oe%'"));
        $id = '';
        if ($model) {
            foreach ($model as $v) {
                $id.= $v['GoodsID'] . ',';
            }
            $id = substr($id, 0, -1);
        }
        return $id ? $id : "''";
    }

    //一周销量商品
    public static function getWeekSales($params) {
        if (!$params['keyword']) {
            return array();
        }
        $sub = $params['sub'];
        $code = $params['code'];
        $keyword = $params['keyword'];
        $skwd = $params['skwd'];
        $car = $params['car'];
        $sql = "SELECT og.GoodsID,count(Quantity) as count,pg.Name,pg.ProPrice,pg.Price,pg.IsPro,gi.ImageUrl FROM `pap_order_goods` og";
        $sql.= " left join pap_goods pg on og.GoodsID=pg.ID  left join pap_goods_image_relation gi on og.GoodsID=gi.GoodsID where pg.ISdelete=1 and pg.IsSale=1";
        if ($code) {
            $sql.=" and pg.StandCode='$code'";
        }
        if ($sub) {
            $codestr = self::getCodeBySub($sub);
            $sql.=" and pg.StandCode in ({$codestr})";
        }
        if ($params['brand']) {
            $sql.=" and pg.Brand = '{$params['brand']}'";
        }
        if (!empty($keyword)) {
            $sql.=" and pg.Title like '%$keyword%'";
        }
        if (!empty($skwd)) {
            $sql.=" and pg.Title like '%$skwd%'";
        }
        //适用车型
        if ($car['make']) {
            $idstr = self::getgoodsbycarmodel($car);
            if ($idstr)
                $sql.=" and pg.ID in $idstr";
            else {
                $sql.=' and pg.ID in (0)';
            }
        }
        $sql.=" group by og.GoodsID order by count desc limit 10";
        $res = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        return $res;
    }

    //促销商品
    public static function getisprogoods($params) {
        $sub = $params['sub'];
        $code = $params['code'];
        $car = $params['car'];
        $sql = "SELECT pg.Name,pg.ID FROM `pap_goods` pg";
        if ($code) {
            $sql.=" where pg.ISdelete=1 and pg.IsSale=1  and pg.StandCode='$code'";
        } else {
            $codestr = self::getCodeBySub($sub);
            $sql.=" where pg.ISdelete=1 and pg.IsSale=1 and pg.StandCode in ({$codestr})";
        }
        //适用车型
        if ($car['make']) {
            $idstr = self::getgoodsbycarmodel($car);
            if ($idstr)
                $sql.=" and pg.ID in $idstr";
            else {
                $sql.=' and pg.ID in (0)';
            }
        }
        $sql.=" and pg.IsPro=1 order by pg.ProTime desc limit 6";
        $res = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        return $res;
    }

    //经销商商品适用车型查询
    public static function getgoodsbycarmodel($params) {
        if (!empty($params['make'])) {
            $sql = "select distinct GoodsID from pap_goods_vehicle_relation where Make='{$params['make']}'";
            if ($params['organID'])
                $sql.=' and OrganID=' . $params['organID'];
            if (!empty($params['series'])) {
                $sql.=" and Car='{$params['series']}'";
                if (!empty($params['year'])) {
                    $sql.=" and Year='" . trim($params['year']) . "'";
                    if (!empty($params['model'])) {
                        $sql.=" and Model='{$params['model']}'";
                    }
                }
            }
            $res = Yii::app()->papdb->createCommand($sql)->queryAll();
            if ($res) {
                $idstr = '(';
                foreach ($res as $v) {
                    $idstr.= "{$v['GoodsID']},";
                }
                $idstr = substr($idstr, 0, -1) . ')';
            } else {
                $idstr = '';
            }
            return $idstr;
        }
    }

    //查询商品sql
    public static function getGoodsSql($params) {
        $organ_ID = Yii::app()->user->getOrganID();
        // 查询条件
        $keyword = $params['keyword'];
        $skwd = $params['skwd'];
        $sub = $params['sub'];            //子类
        $code = $params['code'];            //标准名称
        $orderby = $params['order'];                // 排序
        $brand = $params['brand'];              // 商品品牌名称
        $brandID = $params['brandID'];              // 商品品牌名称
        $price = $params['price'];              // 价格区间
        //$OENO = $params['oeno'];                    // 商品OE号
        $dealerID = $params['OrganID'];              // 经销商机构ID
        $SellerID = $params['SellerID'];    //经销商商品管理 
        $UnionID = $params['UnionID'];      //联盟ID
        $select = "distinct dg.ID,dg.Name, dg.Pinyin, dg.BrandID, dg.GoodsNO, dg.Price, dg.ProPrice,dg.PartsLevel,dg.StandCode,dg.Memo,
                dg.IsPro,dg.IsSale,dg.OrganID,dg.CreateTime,dg.ProTime,dg.Sales,dg.Provenance,dg.CommentNo,(select BrandName from `pap_brand` jb where jb.ID=dg.BrandID) as Brand";
        $sql = "SELECT $select,                
                if(dg.ProPrice and dg.IsPro=1,dg.ProPrice,if(discount.PriceRatio,discount.PriceRatio*dg.Price,dg.Price)) as ppp
                FROM `pap_goods` dg 
                left join(SELECT p.OrganID as OrganID, p.PriceRatio/100 as PriceRatio from `pap_goods_price_manage` AS p ,`pap_client_type` as ct 
                WHERE p.CooperationType = ct.Cooperationtype AND  ct.ServiceID = $organ_ID and ct.DealerID=p.OrganID 
                AND (!ISNULL(p.PriceRatio) AND p.PriceRatio !='')) as discount on dg.OrganID = discount.OrganID";
        $sqlw = " where dg.IsDelete=1 and dg.IsSale=1";

        //联盟商品
        if ($UnionID) {
            if ($UnionID == -1)
                $sqlw.=" and dg.ID = ''";
            else {
                //获取联盟内经销商id
                $dids = self::getUnionOrgan(array('UnionID' => $UnionID, 'type' => 2));
                $sqlw.= ' and dg.OrganID in (' . $dids . ')';
            }
        }

        //经销商店铺
        if ($dealerID) {
            $sqlw.=" and dg.OrganID=$dealerID";
            if (!empty($skwd))
                $sqlw.=" and dg.Title like '%$skwd%'";
            if ($sub) {
                $codestr = self::getCodeBySub($sub);
                $sqlw.= " and dg.StandCode in ({$codestr})";
            }
            if ($params['codes']) {
                $sqlw.=" and dg.StandCode='{$params['codes']}'";
            }
        }
        //经销商商品管理
        else if ($SellerID) {
            $sqlw.=" and dg.OrganID=$SellerID";
            if ($params['SellerIsPro'] == 2) { //未促销的
                $sqlw.=" and dg.IsPro=0";
            }
            if ($params['SellerIsPro'] == 22) {  //已促销的
                $sqlw.=" and dg.IsPro=1";
            }
            if ($params['keywords']) {
                $sqlw.=" and dg.Title like '%{$params['keywords']}%'";
            }
            if ($params['codes']) {
                $sqlw.=" and dg.StandCode='{$params['codes']}'";
            }
            if ($params['GoodsNO']) {
                $sqlw.=" and dg.GoodsNO like '%{$params['GoodsNO']}%'";
            }
            if ($params['Name']) {
                $sqlw.=" and dg.Name like '%{$params['Name']}%'";
            }
            if ($params['Pinyin']) {
                $sqlw.=" and dg.Pinyin like '%{$params['Pinyin']}%'";
            }
            if ($params['PartsLevel']) {
                $sqlw.=" and dg.PartsLevel like '%{$params['PartsLevel']}%'";
            }
            if ($params['goodprice']) {
                $sqlw.=" and dg.Price='{$params['goodprice']}'";
            }
            if ($params['oeno']) {
                $oenos = self::getGoodsIDByOE($params['oeno']);
                $sqlw.= " and dg.ID in ({$oenos})";
            }
        }
        //子类和标准名称
        else {
            //页面关键字搜索
            if (!empty($skwd))
                $sqlw.=" and dg.Title like '%$skwd%'";
            if ($code)
                $sqlw.= " and dg.StandCode='{$code}'";
            else if ($sub) {
                $codestr = self::getCodeBySub($sub);
                $sqlw.= " and dg.StandCode in ({$codestr})";
            }
            //search页面关键字搜索
            if ($params['type'] == 1) {
                if (!empty($keyword))
                    $sqlw.=" and dg.Title like '%$keyword%'";
                else
                    $sqlw.=" and dg.ID = ''";
            }
        }
        //商品品牌筛选
        if ($brand) {
            $sqlw.=" and dg.Brand = '{$brand}'";
        }
        if ($brandID) {
            $sqlw.=" and dg.BrandID= '{$brandID}'";
        }

        //适用车型
        if ($params['car']['make']) {
            if ($dealerID)
                $car['organID'] = $dealerID;
            $car = $params['car'];
            $sql.=" left join pap_goods_vehicle_relation pgv on dg.ID=pgv.GoodsID";
            if ($car['make'])
                $sqlw.=" and pgv.Make='" . $car['make'] . "'";
            if ($car['organID'])
                $sqlw.=' and pgv.OrganID=' . $car['organID'];
            if (!empty($car['series'])) {
                $sqlw.=" and pgv.Car='{$car['series']}'";
                if (!empty($car['year'])) {
                    $sqlw.=" and pgv.Year='" . trim($car['year']) . "'";
                    if (!empty($car['model'])) {
                        $sqlw.=" and pgv.Model='{$car['model']}'";
                    }
                }
            }
        }
        //$idstr = self::getgoodsbycarmodel($car);
        //  if ($idstr)
        //   $sqlw.=" and dg.ID in $idstr";
        // else {
        //   $sqlw.=' and dg.ID in (0)';
        // }
        // }
        //商品价格筛选
        if ($price) {
            $sqlw.=" and if(dg.ProPrice and dg.IsPro=1,dg.ProPrice,if(discount.PriceRatio,discount.PriceRatio*dg.Price,dg.Price)) {$price}";
        }
        if ($params['ispro'] == 1) {
            $sqlw.=" and dg.IsPro= '1'";
        }
        if ($params['ispro'] == 2) {
            $sqlw.=" and dg.IsPro= '0'";
        }
        if ($params['partslevel'] && in_array($params['partslevel'], array('A', 'B', 'C', 'D', 'E'))) {
            $sqlw.=" and dg.PartsLevel='{$params['partslevel']}'";
        }
        //商品查询sql
        $sql = $sql . $sqlw;
        //查询商品个数sql
        $countSql = str_replace($select, 'count(distinct(dg.ID)) as count', $sql);

        //商品排序
        if ($orderby) {
            if ($orderby == 'sales_l') {    // 按销量从多到少
                $sql.=" order by dg.Sales DESC";
            } elseif ($orderby == 'sales_h') {    // 按销量从少到多
                $sql.=" order by dg.Sales ASC";
            } elseif ($orderby == 'price_l') {   //总价从高到低
                $sql.=" order by ppp DESC";
            } elseif ($orderby == 'price_h') {   // 总价从低到高
                $sql.=" order by ppp ASC";
            } elseif ($orderby == 'comment_l') {  // 评论数从高到低
                $sql.=" order by dg.CommentNo DESC";
            } elseif ($orderby == 'comment_h') {  // 评论数从低到高
                $sql.=" order by dg.CommentNo ASC";
            } elseif ($orderby == 'ctime_l') {  // 上架时间从高到低
                $sql.=" order by dg.UpdateTime DESC";
            } elseif ($orderby == 'ctime_h') {  // 上架时间从低到高
                $sql.=" order by dg.UpdateTime ASC";
            } elseif ($orderby == 'time_l') {  // 创建时间从高到低
                $sql.=" order by dg.CreateTime DESC";
            } elseif ($orderby == 'time_h') {  // 创建时间从低到高
                $sql.=" order by dg.CreateTime ASC";
            }
        }
        return array('sql' => $sql, 'countSql' => $countSql);
    }

    public static function getGoodsData($params) {
        $serviceID = $params['organID'];
        Yii::import("widgets.default.WSphinxResult");
        $searchCriteria = new stdClass();
        $searchCriteria->select = 'goodsid,sales,commentno,ispro,standsort,price';
        if ($params['SellerID'] && $params['IsSale'] == 0) {
            $filters = array('isdelete' => 1, 'issale' => 0, 'organid' => $params['SellerID']);
        } else {
            $filters = array('isdelete' => 1, 'issale' => 1);
        }
        $query = '';

        //子类、标准名称
        if ($params['sub']) {
            //标准名称code查询
            if ($params['code']) {
                $filters['standcode'] = base_convert($params['code'], 36, 10);
            } else {
                //子类查询
                $codeArr = self::getstandcode($params['sub']);
                $filters['standcode'] = $codeArr;
            }
        }
        //search页面关键字搜索
        if ($params['type'] == 1) {
            if ($params['keyword']) {
                $params['keyword'] = str_replace("\"", "'", $params['keyword']);
                $query = $query ? $query . ' ' . $params['keyword'] : $params['keyword'];
            } else {
                $filters['organid'] = '-1';
            }
        }
        //获取经销商商品列表
        if ($params['dealerid']) {
            $filters['organid'] = $params['dealerid'];
        } else {
            //获取联盟内的商品
            if (is_array($params['union']) && !empty($params['union'])) {
                $filters['organid'] = $params['union'];
            }
        }
        //品牌查询
        if ($params['brand']) {
            $brandArr = self::getbrandid($params['brand']);
            $filters['brandid'] = $brandArr;
        }

        //配件档次查询
        if ($params['partslevel']) {
            $filters['partslevel'] = ord($params['partslevel']);
        }
        //厂家、车系、车型查询
        if ($params['car']['make']) {
            $filters['make'] = $params['car']['make'];
            if ($params['car']['series']) {
                $filters['car'] = $params['car']['series'];
            }
            if ($params['car']['year']) {
                $filters['year'] = $params['car']['year'];
            }
            if ($params['car']['model']) {
                $filters['model'] = $params['car']['model'];
            }
        }
        //是否促销
        if ($params['ispro'] == 1) {
            $filters['ispro'] = 1;
        } else if ($params['ispro'] == 2) {
            $filters['ispro'] = 0;
        }
        //价格区间
        if (!empty($params['price']) && is_array($params['price'])) {
            $filters['range'] = array('price' => $params['price']);
        }

        //商品排序
        $order = '';
        if ($params['order']) {
            $orderby = $params['order'];
            if ($orderby == 'sales_l') {    // 按销量从多到少
                $order = " sales DESC";
            } elseif ($orderby == 'sales_h') {    // 按销量从少到多
                $order = " sales ASC";
            } elseif ($orderby == 'price_l') {   //总价从高到低
                $order = " price DESC";
            } elseif ($orderby == 'price_h') {   // 总价从低到高
                $order = " price ASC";
            } elseif ($orderby == 'comment_l') {  // 评论数从高到低
                $order = " CommentNo DESC";
            } elseif ($orderby == 'comment_h') {  // 评论数从低到高
                $order = " CommentNo ASC";
            }
            $order.=",";
//            elseif ($orderby == 'ctime_l') {  // 上架时间从高到低
//                $order = " order by dg.UpdateTime DESC";
//            } elseif ($orderby == 'ctime_h') {  // 上架时间从低到高
//                $order = " order by dg.UpdateTime ASC";
//            }
        }
        $order.= 'standsort DESC,standcode asc,price ASC';
//        
        $searchCriteria->groupby = array('field' => 'goodsid', 'mode' => 4, 'order' => $order);
        $searchCriteria->filters = $filters;
        $searchCriteria->query = $query;
        //$searchCriteria->query = '@title ' . 1 . '*';
        // $searchCriteria->orders = $order;
        $searchCriteria->from = "main";
        $model = new WSphinxResult($searchCriteria, array(
            'pagination' => array(
                'pageSize' => 12,
            ),
        ));

        //搜索机构
        if ($params['type'] != 3 && !$params['dealerid']) {
            $searchCriteria1 = clone $searchCriteria;
            $dealerdata = self::getDealerArr($searchCriteria1);
        }

        //搜索品牌
        if ($params['type'] != 3 && !$params['brand']) {
            $searchCriteria2 = clone $searchCriteria;
            $branddata = self::getBrandArr($searchCriteria2);
        }

        //搜索子类、标准名称
        if ($params['type'] == 1) {
            $searchCriteria3 = clone $searchCriteria;
            $codemodel = self::getCodeTree($searchCriteria3);
        }

        $data = $model->getData();
        foreach ($data as $key => $value) {
            $goods = MallService::getredis($value['attrs']['goodsid'], 'search');
            $goods['standsort'] = $value['attrs']['standsort'];
            $goods['Sales'] = $value['attrs']['sales'];
//            $goods['CommentNo'] = $value['attrs']['commentno'];
            if ($goods['IsPro'] == 1) {
                $goods['ppp'] = $goods['ProPrice'];
            } else {
                $priceratio = self::getDisprice($goods['OrganID'], $serviceID);
                if (!$priceratio) {
                    $goods['ppp'] = $goods['Price'];
                } else {
                    $goods['ppp'] = sprintf('%2f', $goods['Price'] * $priceratio / 100);
                }
            }
            $goods['CommentNo'] = PapGoods::model()->findByPk($goods['ID'])->attributes['CommentNo'];
            $data[$key] = $goods;
        }
        $model->setData($data);
        return array('dataProvider' => $model, 'count' => count($data) == 0 ? 0 : $model->totalNum,
            'branddata' => $branddata, 'dealerdata' => $dealerdata, 'codedata' => $codemodel);
    }

    //获取树
    private static function getCodeTree(stdClass $searchCriteria) {
        $searchCriteria->select = 'standcode';
        unset($searchCriteria->filters['standcode']);
        $searchCriteria->groupby = array('field' => 'standcode', 'mode' => 4, 'order' => '@group desc');
        $coderes = Yii::app()->search->SetLimits(0, 300)->searchRaw($searchCriteria);
        $codestr = '';
        foreach ($coderes['matches'] as $cv) {
            if ($cv['attrs']['standcode']) {
                $codestr.="'" . base_convert($cv['attrs']['standcode'], 10, 36) . "',";
            }
        }
        $codestr = substr($codestr, 0, -1);
        if ($codestr) {
            $codesql = "select jp.ID,jp.Name,jg.codestr,jg.codename from jpd_gcategory jp join 
            (SELECT ParentID,GROUP_CONCAT(Code) as codestr,GROUP_CONCAT(Name) as codename from jpd_gcategory jg1
            where Code in($codestr) group by ParentID ) as jg on jp.ID=jg.ParentID group by jp.Name order by jp.PinYin";
            return Yii::app()->jpdb->CreateCommand($codesql)->queryAll();
        } else {
            return array();
        }
    }

    //获取搜索机构列表
    private static function getDealerArr(stdClass $searchCriteria) {
        $searchCriteria->select = 'organid';
        $searchCriteria->groupby = array('field' => 'organid', 'mode' => 4, 'order' => '@group asc');
        $brandres = Yii::app()->search->SetLimits(0, 300)->searchRaw($searchCriteria);
        $dealerstr = '';
        foreach ($brandres['matches'] as $mv) {
            if ($mv['attrs']['organid']) {
                $dealerstr.=$mv['attrs']['organid'] . ',';
            }
        }
        $dealerstr = substr($dealerstr, 0, -1);
        if ($dealerstr) {
            $dealersql = "select ID,OrganName from jpd_organ where 1=1";
            $dealersql.=" and ID in($dealerstr)";
            return Yii::app()->jpdb->CreateCommand($dealersql)->queryAll();
        } else {
            return array();
        }
    }

    //获取品牌
    private static function getBrandArr(stdClass $searchCriteria) {
        $searchCriteria->select = 'brandid';
        $searchCriteria->groupby = array('field' => 'brandid', 'mode' => 4, 'order' => '@group desc');
        $brandres = Yii::app()->search->SetLimits(0, 300)->searchRaw($searchCriteria);
        $brandstr = '';
        foreach ($brandres['matches'] as $mv) {
            if ($mv['attrs']['brandid']) {
                $brandstr.=$mv['attrs']['brandid'] . ',';
            }
        }
        $brandstr = substr($brandstr, 0, -1);
        $brandmodel = $branddata = array();
        if ($brandstr) {
            $brandsql = "select distinct BrandName,pb.Pinyin from pap_brand pb where 1=1";
            $brandsql.=" and id in($brandstr)";
            $brandsql.=" order by pinyin";
            $brandmodel = Yii::app()->papdb->CreateCommand($brandsql)->queryAll();
        }
        foreach ($brandmodel as $bv) {
            $py = strtoupper(substr(self::checkFirstName($bv["Pinyin"]), 0, 1));
            $branddata['All'][] = $bv['BrandName'];
            if (!$py) {
                $branddata['Else'][] = $bv['BrandName'];
            } else {
                $branddata['Sort'][$py][] = $bv['BrandName'];
            }
        }
        return $branddata;
    }

    //获取联盟经销商id数组
    public static function getUnion($serviceID) {
        $sql = "SELECT ID FROM `jpd_organ` where UnionID=(select UnionID from jpd_organ where ID=$serviceID)";
        $sql.=" and IsFreeze='0' and IsBlack='0' and Status='1' and Identity=2";
        $res = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $unionArr = array();
        if (!empty($res)) {
            foreach ($res as $v) {
                $unionArr[] = $v['ID'];
            }
        }
        return $unionArr;
    }

    //获取修理厂在经销商中的类别
    private static function getcooper($organid, $serviceID) {
        $sql = "select Cooperationtype from pap_client_type where DealerID=$organid and ServiceID=$serviceID";
        $cooper = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $cooper['Cooperationtype'];
    }

    //获取品牌id数组
    private static function getbrandid($brand) {
        $sql = "select ID from pap_brand where BrandName ='$brand'";
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        $brandArr = array();
        if (!empty($res)) {
            foreach ($res as $v) {
                $brandArr[] = $v['ID'];
            }
        }
        return $brandArr;
    }

    //获取code数组
    private static function getstandcode($sub) {
        $sql = "select distinct Code from jpd_gcategory where ParentID={$sub} and IsShow = 1";
        $res = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $codeArr = array();
        if (!empty($res)) {
            foreach ($res as $v) {
                $codeArr[] = $v['Code'] ? base_convert($v['Code'], 36, 10) : "";
            }
        }
        return $codeArr;
    }

    public static function getDisprice($organid, $serviceID) {
        $sql = "SELECT PriceRatio FROM `pap_goods_price_manage` where OrganID=$organid and Cooperationtype=
                (select Cooperationtype from pap_client_type where DealerID=$organid and ServiceID=$serviceID)";
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $res['PriceRatio'];
    }

    //获取商品列表
    public static function getGoodsDataold($params) {
        $sql = self::getGoodsSql($params);
        if ($params['SellerID'] && $params['IsSale'] == 0) {
            $sql["countSql"] = str_replace('dg.IsSale=1', 'dg.IsSale=0', $sql["countSql"]);
            $sql["sql"] = str_replace('dg.IsSale=1', 'dg.IsSale=0', $sql["sql"]);
        }
        $res = Yii::app()->papdb->createCommand($sql["countSql"])->queryAll();
        $count = $res[0]['count'];
//        echo $sql["sql"];
//        exit;
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
                $goods[$k]['image'] = F::uploadUrl() . 'common/default-goods.png';
            } else {
                $goods[$k]['image'] = F::uploadUrl() . $image;
            }
            $MallImage = self::getOneGoodsImagethumb($v['ID']);
            if (!$MallImage) {
                $goods[$k]['MallImage'] = F::uploadUrl() . 'common/default-goods.png';
            } else {
                $goods[$k]['MallImage'] = F::uploadUrl() . self::getOneGoodsImagethumb($v['ID']);
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

    public static function getredis($GoodsID, $search = '') {
        $info = Yii::app()->redis->get('GoodsID' . $GoodsID);
        if ($info) {
            $info = json_decode($info, true);
//            $info['atBrand'] = Yii::app()->redis->get('Brand' . $Goods->attributes['BrandID'] . 'o' . $Goods->attributes['OrganID']);
        } else {
            $Goods = PapGoods::model()->findBypk($GoodsID);
//            if ($search != 'search') {
//                if (!$Goods || $Goods->ISdelete == 0) {
//                    return 'null';
//                } else if ($Goods->IsSale == 0) {
//                    return 'nosale';
//                }
//            }
            $redis = $Goods->attributes;
            $brandid = $Goods->attributes['BrandID'];
            if ($brandid) {
                $sql = "select BrandName from pap_brand where ID=$brandid";
                $res = Yii::app()->papdb->createCommand($sql)->queryRow();
            }
            //if($res['Name']){
            $redis['Brand'] = $res['BrandName'] ? $res['BrandName'] : '';
            //品牌认证
            //}
            //机构名称
            $redis['OrganName'] = DealergoodsService::getnamebyorganid($Goods->attributes['OrganID']);
            $redis['PartsLevelName'] = Yii::app()->getParams()->PartsLevel[$Goods->attributes['PartsLevel']];
            $redis['StandCodeName'] = DealergoodsService::StandCodegetcpname($Goods->attributes['StandCode'], 'Name');
            //var_dump($redis);exit;
            $gcategory = self::getCategory($Goods->attributes['StandCode']);
//            $version['gcategory'] = $gcategory->attributes;
            $redis['gcategory']['BigParts'] = $gcategory['BigPartsID'];
            $redis['gcategory']['SubParts'] = $gcategory['SubPartsID'];
            $redis['gcategory']['BigName'] = $gcategory['BigParts'];
            $redis['gcategory']['SubName'] = $gcategory['SubParts'];
            $oeno = PapGoodsOeRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            if ($oeno) {
                foreach ($oeno as $value) {
                    $redis['oeno'][] = $value->attributes['OENO'];
                }
            }
            $img = PapGoodsImageRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            if ($img) {
                foreach ($img as $key => $value) {
                    $redis['img'][$key]['ImageUrl'] = $value->attributes['ImageUrl'];
                    $redis['img'][$key]['ImageName'] = $value->attributes['ImageName'];
                    $redis['img'][$key]['MallImage'] = $value->attributes['MallImage'];
                    $redis['img'][$key]['BigImage'] = $value->attributes['BigImage'];
                }
            }


            $spec = PapGoodsSpec::model()->find('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            $redis['spec']['ValidityType'] = $spec->attributes['ValidityType'];
            $redis['spec']['ValidityDate'] = $spec->attributes['ValidityDate'];
            $redis['spec']['Unit'] = $spec->attributes['Unit'];
            $redis['spec']['BganCompany'] = $spec->attributes['BganCompany'];
            $redis['spec']['BganGoodsNO'] = $spec->attributes['BganGoodsNO'];

            $pack = PapGoodsPack::model()->find('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            $redis['pack']['MinQuantity'] = $pack->attributes['MinQuantity'];

            $vehicle = PapGoodsVehicleRelation::model()->findAll('GoodsID=:GoodsID', array(':GoodsID' => $GoodsID));
            if ($vehicle) {
                foreach ($vehicle as $value) {
                    $redis['vehicle'][$key]['Make'] = $value->attributes['Make'];
                    $redis['vehicle'][$key]['Car'] = $value->attributes['Car'];
                    $redis['vehicle'][$key]['Year'] = $value->attributes['Year'];
                    $redis['vehicle'][$key]['Model'] = $value->attributes['Model'];
                    $redis['vehicle'][$key]['Marktxt'] = $value->attributes['Marktxt'];
                    $redis['vehicle'][$key]['Cartxt'] = $value->attributes['Cartxt'];
                    $redis['vehicle'][$key]['Modeltxt'] = $value->attributes['Modeltxt'];
                }
            }
            if ($search == 'search') {
                $redis['atBrand'] = Yii::app()->redis->get('Brand' . $Goods->attributes['BrandID'] . 'o' . $Goods->attributes['OrganID']);
                return $redis;
            }
            $info = $redis;
            Yii::app()->redis->set('GoodsID' . $GoodsID, json_encode($redis));
        }
        $info['atBrand'] = Yii::app()->redis->get('Brand' . $Goods->attributes['BrandID'] . 'o' . $Goods->attributes['OrganID']);
        return $info;
    }

    //获取商品
    public static function getGoods($params) {

        $sub = $params['sub'];
        $code = $params['code'];
        $rows = $params['rows'];                    // 每页显示条数
        $curpage = $params['page'] ? $params['page'] : 1;
        $sqlRs = self::getGoodsSql($params);
        $sql = $sqlRs["sql"];
        $countSql = $sqlRs["countSql"];


        $res = Yii::app()->papdb->createCommand($countSql)->queryAll();
        $count = $res[0]['count(*)'];
        $pages = new CPagination($count);
        $pages->pageSize = $rows;
        $offset = ($curpage - 1) * $pages->pageSize;
        $goods = Yii::app()->papdb->createCommand($sql . " LIMIT $offset,$pages->pageSize")->queryAll();

        foreach ($goods as $k => $v) {
            $image = self::getOneGoodsImage($v['ID']);
            if (!$image) {
                $goods[$k]['image'] = F::uploadUrl() . 'common/goods-img-big.jpg';
            } else {
                $goods[$k]['image'] = F::uploadUrl() . $image;
            }
//            //获取品牌名称
            $brandID = $v['BrandID'];
            $brandname = PapBrand::model()->findByPk($brandID);
            if ($brandname) {
                $goods[$k]['brandname'] = $brandname['BrandName'];
            }
            //获取标准名称
            $cd = self::getCategory($v['StandCode']);
            if (is_array($cd)) {
                $goods[$k]['cpname'] = $cd['CpName'];
            }
            //卖家信息
            $organInfo = Organ::model()->findByPk($v['OrganID'])->attributes;
            if ($organInfo) {
                $goods[$k]['dealername'] = $organInfo['OrganName'];
            }
            //OE号
            $goods[$k]['OENOS'] = self::getOENOSByGoodsID($v['ID']);
            // 车型车系
            $vehs = explode('、', self::getVehicleByGoodsID($v['ID']));
        }

        return array('data' => $goods, 'count' => $count);
    }

    //获取单个商品详情
    public static function getGoodByID($id, $payment, $m = '') {
        Yii::app()->cache->flush();
        $criteria = new CDbCriteria();
        $criteria->condition = "t.ISdelete = 1 and t.OrganID!=''";  // 上架的和没有删除的商品
        $criteria->with = array("img", 'spec', 'pack');
        $model = PapGoods::model()->findByPk($id, $criteria);
        if (!$model) {
            return false;
        } else if ($model->IsSale == 0) {
            if ($m == 'mall')
                return 'nosale';
            else
                return false;
        }
        $data = array();
        $sellerID = $model->OrganID;
        $discount = PapOrderDiscount::model()->find(array("condition" => " OrderType = 1"));
        if ($discount) {
            if ($payment == 1) {
                $dis = $discount['OrderAlipay'];
            } else if ($payment == 2) {
                $dis = $discount['OrderLogis'];
            }
            if (isset($dis) && !empty($dis)) {
                $dis = $dis;
            } else {
                $dis = 100;
            }
        } else {
            $dis = 100;
        }

        //获取该经销商最小交易额
        $turnover = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $model['OrganID']));
        if ($turnover) {
            $data["MinTurnover"] = $turnover['MinTurnover'];
        }
        $data['Version'] = $model->Version;
        $data['discount'] = $dis;

        //商品基本信息  
        $data['GoodsID'] = $id;
        $data['Name'] = $model['Name'];
        $data['GoodsNO'] = $model['GoodsNO'];
        $data['CommentNo'] = $model['CommentNo'];
        $data['Info'] = $model['Info'];
        $data['Memo'] = $model['Memo'];
        $data['IsSale'] = $model['IsSale'];
        $data['PartsLevel'] = $model['PartsLevel'];
        $data['code'] = $model['StandCode'];
        if ($model['BrandID']) {
            $sql = "select BrandName from pap_brand where ID={$model['BrandID']}";
            $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        }
        $data['BrandName'] = $res['BrandName'];
        $organID = Yii::app()->user->getOrganID();

        //商品价格
        $priceRatio = self::getContactprice($model['OrganID'], $organID);
        $data['Price'] = $model['Price'];
        $data['LogisticsPrice'] = 0;
        $data['PriceRatio'] = $priceRatio['PriceRatio'] > 0 && $priceRatio['PriceRatio'] <= 100 ? $priceRatio['PriceRatio'] : 100;
        $data['DisPrice'] = sprintf("%.2f", $model['Price'] * $data['PriceRatio'] / 100);    // 折扣价,小数点后面保留两位
        if ($model['IsPro'] == 1) {
            if (!is_null($model['ProPrice']) && $model['ProPrice']) {
                $data['ProPrice'] = $model['ProPrice'];
            }
        }

        //店家信息
        $organInfo = Organ::model()->findByPk($model['OrganID'])->attributes;
        $data['OrganName'] = $organInfo['OrganName'];
        $data['SellerID'] = $model['OrganID'];
        $data['QQ'] = $organInfo['QQ'];
        $data['Phone'] = $organInfo['Phone'];
        //$address = self::getOrganAddress($organInfo['Province'], $organInfo['City'], $organInfo['Area']);
        $data['Address'] = array(Area::getCity($organInfo['Province']), Area::getCity($organInfo['City']), Area::getCity($organInfo['Area']));

        //商品OE号
        $data['OENO'] = PapGoods::model()->getOENOSByGoodsID($id);
        //$data['LogisticsPrice'] = $goods['LogisticsPrice'];   
        //商品大类、子类、标准名称
        $cpArr = self::getCategory($model['StandCode']);
        $data['BigParts'] = $cpArr['BigParts'];
        $data['SubParts'] = $cpArr['SubParts'];
        $data['CpName'] = $cpArr['CpName'];
        $data['sub'] = $cpArr['sub'];

        $data['BganCompany'] = $model->spec->BganCompany ? $model->spec->BganCompany : ''; //标品
        $data['BganGoodsNO'] = $model->spec->BganGoodsNO ? $model->spec->BganGoodsNO : ''; //标商
        $data['Unit'] = $model->spec->Unit ? $model->spec->Unit : ''; //单位ID
        $data['UnitName'] = GoodsUnit::model()->findByPk($data['Unit'])->attributes['UnitName']; //单位

        $data['MinQuantity'] = $model->pack->MinQuantity ? $model->pack->MinQuantity : ''; //最小包装
//        $data['pLength'] = $model->pack->Volume ? $model->pack->Volume : ''; //体积
//        $data['Weight'] = $model->pack->Weight ? $model->pack->Weight : ''; //重量
        $data['ValidityType'] = $model->spec->ValidityType;
        $data['ValidityDate'] = $model->spec->ValidityDate;
        // 图片
        if (!$model->img) {
            $data['Images'][0]['ImageUrl'] = 'dealer/goods-img-big.jpg';
        } else {
            foreach ($model->img as $v) {
                $data['Images'][] = $v->attributes;
            }
        }
        return $data;
    }

    //获取商品详情   无上下架
    public static function getDealerGoodByID($id) {
        $criteria = new CDbCriteria();
        $criteria->condition = " t.ISdelete = 1";  // 没有删除的商品
        $criteria->with = array("img", 'PapJpbrand', 'spec', 'pack');
        $model = PapGoods::model()->findByPk($id, $criteria);
        //return $model;
        if (!$model) {
            return false;
        }
        $data = array();
        //获取该经销商最小交易额
        $turnover = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $model['OrganID']));
        if ($turnover) {
            $data["MinTurnover"] = $turnover['MinTurnover'];
        }
        //商品基本信息
        $data['GoodsID'] = $id;
        $data['Version'] = $model['Version'];
        $data['Name'] = $model['Name'];
        $data['GoodsNO'] = $model['GoodsNO'];
        $data['CommentNo'] = $model['CommentNo'];
        $data['Info'] = $model['Info'];
        $data['Memo'] = $model['Memo'];
        $data['PartsLevel'] = $model['PartsLevel'];
        $data['code'] = $model['StandCode'];
        $organID = Yii::app()->user->getOrganID();
        //商品价格
        $price = self::getContactprice($model['OrganID'], $organID);
        $data['Price'] = $model['Price'];
        //$data['ListPrice'] = $model['Price'];
        $data['LogisticsPrice'] = 0;
        $data['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
        if ($data['PriceRatio'] > 0) {
            $data['DisPrice'] = sprintf("%.2f", $model['Price'] * $data['PriceRatio'] / 100);    // 折扣价,小数点后面保留两位
        }
        if ($model['IsPro'] == 1) {
            if (!is_null($model['ProPrice']) && $model['ProPrice']) {
                $data['ProPrice'] = $model['ProPrice'];
            }
        }
        //店家信息
        $organInfo = Organ::model()->findByPk($model['OrganID'])->attributes;
        $data['OrganName'] = $organInfo['OrganName'];
        $data['SellerID'] = $model['OrganID'];
        $data['QQ'] = $organInfo['QQ'];
        $data['Phone'] = $organInfo['Phone'];
        $address = self::getOrganAddress($organInfo['Province'], $organInfo['City'], $organInfo['Area']);
        $data['Address'] = array($address[0]['Name'], $address[1]['Name'], $address[2]['Name']);
        //商品品牌
        $data['BrandName'] = $model->PapJpbrand->BrandName ? $model->PapJpbrand->BrandName : '';
        //商品OE号
        $data['OENO'] = PapGoods::model()->getOENOSByGoodsID($id);
//    $data['LogisticsPrice'] = $goods['LogisticsPrice'];   
        //商品大类、子类、标准名称
        $cpArr = self::getCategory($model['StandCode'], $id);
        $data['BigParts'] = $cpArr['BigParts'];
        $data['SubParts'] = $cpArr['SubParts'];
        $data['CpName'] = $cpArr['CpName'];
        $data['sub'] = $cpArr['sub'];

        $data['BganCompany'] = $model->spec->BganCompany ? $model->spec->BganCompany : ''; //标品
        $data['BganGoodsNO'] = $model->spec->BganGoodsNO ? $model->spec->BganGoodsNO : ''; //标商
        $data['Unit'] = $model->spec->Unit ? $model->spec->Unit : ''; //单位

        $data['MinQuantity'] = $model->pack->MinQuantity ? $model->pack->MinQuantity : ''; //最小包装
//        $data['pLength'] = $model->pack->Volume ? $model->pack->Volume : ''; //体积
//        $data['Weight'] = $model->pack->Weight ? $model->pack->Weight : ''; //重量
        // 图片
        if (!$model->img) {
            $data['Images'][0]['ImageUrl'] = 'dealer/goods-img-big.jpg';
        } else {
            foreach ($model->img as $v) {
                $data['Images'][] = $v->attributes;
            }
        }
        return $data;
    }

    /**
     * 添加商品到购物车
     * @param array $params 商品字段列表
     * @return boolean
     */
    public static function addtocart($params) {
        //判断商品是否已经添加
        $model = PapCart::model()->findByAttributes(array(
            "GoodsID" => $params["GoodsID"],
            "BuyerID" => $params["BuyerID"],
        ));
        //没有添加则添加，有则累加商品
        if (empty($model)) {
            $model = new PapCart();
        } else {
            $params["Quantity"] = $model->Quantity + $params["Quantity"];
        }
        $model->attributes = $params;
        return $model->save();
    }

    //查询机构信息
    public static function getOrgan($id) {
        return Organ::model()->findByPk($id);
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

    /*
     * 获取一个车型车系
     */

//    public static function getOneVehicleByGoodsID($goodsID) {
//        $value = PapGoodsVehicleRelation::model()->find("GoodsID=$goodsID");
//        $year = $value['Year'] == 0 ? '' : $value['Year'];
//        $model = $value['Modeltxt'] ? $value['Modeltxt'] : '';
//        return $value['Marktxt'] . ' ' . $value['Cartxt'] . ' ' . $year . $model;
//    }

    /**
     * 获取车型车系
     */
    public static function getVehicleByGoodsID($goodsID) {
        $goodsVehicle = PapGoodsVehicleRelation::model()->findAll("GoodsID=$goodsID");
        $data = array();
        $Vehicles = '';
        foreach ($goodsVehicle as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['Make'] = $value['Make'];
            $data[$key]['Car'] = $value['Car'];
            $data[$key]['Year'] = $value['Year'];
            $data[$key]['Model'] = $value['Model'];
            $year = $value['Year'] == 0 ? '' : $value['Year'];
            $modeltxt = $value['Modeltxt'] ? $value['Modeltxt'] : '';
            if ($key == 0)
                $Vehicles .= $value['Marktxt'] . ' ' . $value['Cartxt'] . ' ' . $year . ' ' . $modeltxt;
            else
                $Vehicles .= '、' . $value['Marktxt'] . ' ' . $value['Cartxt'] . ' ' . $year . ' ' . $modeltxt;
        }
        return $Vehicles;
    }

    public static function getRecomeGoods($params) {
        return self::getGoods($params);
    }

    public static function getDisplayType($key) {
        $cookie = Yii::app()->request->getCookies();
        $type = Yii::app()->request->getParam("type");
        if ($type && in_array($type, array("list", "grid"))) {
            $cookie = new CHttpCookie($key, $type);
            $cookie->expire = time() + 60 * 60 * 24 * 30;  //有限期30天
            Yii::app()->request->cookies[$key] = $cookie;
        } else {
            $type = $cookie[$key]->value;
            if (!$type) {
                $type = "list";
            }
        }
        return $type;
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

    //获取大类、子类、标准名称
    public static function getCategory($code) {
        if ($code) {
            $cp = Gcategory::model()->find(array('select' => 'Name,ParentID', 'condition' => "Code='{$code}'"))->attributes;
            $sub = Gcategory::model()->findByPk($cp['ParentID'], array('select' => 'Name,ParentID,ID'))->attributes;
            $big = Gcategory::model()->findByPk($sub['ParentID'], array('select' => 'Name,ID'))->attributes;
            return array('CpName' => $cp['Name'], 'SubParts' => $sub['Name'], 'BigParts' => $big['Name'], 'sub' => $cp['ParentID'],
                'BigPartsID' => $big['ID'], 'SubPartsID' => $sub['ID']);
        } else {
            return array();
        }
    }

    //获取商家地址
    public static function getOrganAddress($id1, $id2, $id3) {
        $c = new CDbCriteria();
        $c->select = 'Name';
        if ($id3) {
            $c->condition = "ID in($id1,$id2,$id3)";
        } else {
            $c->condition = "ID in($id1,$id2)";
        }
        return Area::model()->findAll($c);
    }

    //设置车型cookie
    public static function setCarModel($car) {
        if ($car['make'] || $car['series'] || $car['year'] || $car['model']) {
            $cookie = Yii::app()->request->getCookies();
            unset($cookie['mallmake'], $cookie['mallseries'], $cookie['mallyear'], $cookie['mallmodel']);
            foreach ($car as $k => $v) {
                if ($v) {
                    $cookie = new CHttpCookie('mall' . $k, $v);
                    $cookie->expire = time() + 60 * 60 * 24;  //有限期30天
                    Yii::app()->request->cookies['mall' . $k] = $cookie;
                }
            }
        }
        return $car;
    }

    //获取适用车型名称
    public static function getCarmodeltxt($params) {
        $txt = '';
        if (!empty($params['make']) && isset($params['make'])) {
            $msql = 'select Name from `jpd_front_makes` where MakeID=' . $params['make'];
            $mres = Yii::app()->jpdb->createCommand($msql)->queryRow();
            $txt.=$mres['Name'];
            if (!empty($params['series']) && isset($params['series'])) {
                $ssql = 'select Name from `jpd_front_series` where MakeID=' . $params['make'] . ' and Seriesid=' . $params['series'];
                $sres = Yii::app()->jpdb->createCommand($ssql)->queryRow();
                $txt.=' ' . $sres['Name'];
                if (!empty($params['year']) && isset($params['year'])) {
                    $txt.=' ' . $params['year'];
                    if (!empty($params['model']) && isset($params['model'])) {
                        $mosql = 'select Name from `jpd_front_model` where MakeID=' . $params['make'] . ' and SeriesID=' . $params['series'] . ' and Year="' . $params['year'] . '" and ModelID=' . $params['model'];
                        $mores = Yii::app()->jpdb->createCommand($mosql)->queryRow();
                        $txt.=' ' . $mores['Name'];
                    } else {
                        $txt.=' 不确定车型';
                    }
                } else {
                    $txt.=' 不确定年款';
                }
            } else {
                $txt.=' 部分车系';
            }
        }
        return $txt;
    }

    //查看商品是否适用车型
    public static function checkCarfit($params) {
        $sql = "select * from pap_goods_vehicle_relation where GoodsID='{$params['goodsid']}' and Make='{$params['make']}'";
        if ($params['organID'])
            $sql.=" and OrganID='{$params['organID']}'";
        $sql.=" and Car='{$params['series']}' and Year='" . trim($params['year']) . "' and Model='{$params['model']}'";
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        if (!$res)
            return array('fit' => '不适用', 'error' => 1);
        else
            return array('fit' => '适用', 'success' => 1);
    }

    //获取经销商主营品牌
    public static function getDealerbrand($params) {
        $organID = $params['dealerid'];
        $key = "dealer_brand_ID_" . $organID;
        $result = Yii::app()->cache->get($key);
        if (!$result) {
            $sql = "select  distinct BrandName,a.Pinyin  from pap_brand a,pap_dealer_brand b";
            $sql.=" where b.OrganID=:organID and b.BrandID=a.ID order by a.Pinyin";
//            $sql = "select distinct BrandID from pap_dealer_brand pb,pap_jpbrand ";
//            $sql.=" where pb.OrganID=:organID order by Pinyin";
            $result = Yii::app()->papdb->createCommand($sql)->bindParam('organID', $organID)->queryAll();
            Yii::app()->cache->set($key, $result);
        }
        $data = array();
        $newBrand = '';
        foreach ($result as $v) {
            if ($v['BrandName'] == $params["brand"]) {
                $newBrand = $v['BrandName'];
            }
            $py = strtoupper(substr(self::checkFirstName($v["Pinyin"]), 0, 1));
            $data['All'][] = $v['BrandName'];
            if (!$py) {
                $data['Else'][] = $v['BrandName'];
            } else {
                $data['Sort'][$py][] = $v['BrandName'];
            }
        }
        return array('data' => $data, 'brand' => $newBrand);
    }

    //根据机构ID获取联盟信息
    public static function getUnioninfo($organID) {
        $sql = ' select UnionID from `jpd_organ` where ID=' . $organID;
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $res['UnionID'];
    }

    //获取联盟机构ID
    public static function getUnionOrgan($params) {
        $sql = ' select ID from `jpd_organ` where UnionID=' . $params['UnionID'];
        if ($params['type'] == 2) {
            //经销商
            $sql.=' and Identity=2';
        }
        $res = Yii::app()->jpdb->createCommand($sql)->queryAll();
        if ($res) {
            foreach ($res as $v)
                $ids.=$v['ID'] . ',';
            $ids = rtrim($ids, ',');
        } else {
            $ids = '0';
        }
        return $ids;
    }

    //购物车或订单获取定位车型
    public static function getlocalcarmodel($params) {
        if ($params['from'] == 'cart') {
            $sql = 'select MakeID as make,CarID as series,Year as year,ModelID as model from pap_cart where ID=' . $params['ID'];
        } elseif ($params['from'] == 'order') {
            $sql = 'select MakeID as make,CarID as series,Year as year,ModelID as model from pap_order_goods where ID=' . $params['ID'];
        }
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        if ($res) {
            return self::getCarmodeltxt($res);
        }
    }

    //判断商品是否下架
    public static function getunsale($goodsid) {
        $res = PapGoods::model()->findByPk($goodsid);
        return $res['IsSale'];
    }

    //重置商品评论数
    public static function setEvalNum() {
        PapGoods::model()->updateAll(array('CommentNo' => 0));
        $sql = "SELECT GoodsID,count(ID) as count FROM `pap_evaluation_goods` group by GoodsID";
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        foreach ($res as $v) {
            PapGoods::model()->updateByPk($v['GoodsID'], array('CommentNo' => $v['count'])) . '<br/>';
        }
    }

    //显示经销商常用件完整度、全车件覆盖率等级
    public static function showxinxin($OrganID) {
        if ($OrganID) {
            $sql = 'select PartIt,CarRate,GoodsLevel,PriceLevel from jpd_organ_scoring where OrganID=' . $OrganID;
            $result = Yii::app()->jpdb->createCommand($sql)->queryRow();
            if (empty($result)) {
                $result['PartIt'] = '0';
                $result['CarRate'] = '0';
                $result['GoodsLevel'] = '0';
                $result['PriceLevel'] = '0';
            }
            $baseurl = Yii::app()->theme->baseUrl . '/images/papmall/';
            $xinxin = array(
                '0' => ' <img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png"/>',
                '1.0' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png"/>',
                '1.5' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x1.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png"/>',
                '2.0' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png"/>',
                '2.5' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x1.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png"/>',
                '3.0' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x2.png" /><img src="' . $baseurl . 'x2.png"/>',
                '3.5' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x1.png" /><img src="' . $baseurl . 'x2.png"/>',
                '4.0' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x2.png"/>',
                '4.5' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x1.png"/>',
                '5.0' => ' <img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png" /><img src="' . $baseurl . 'x3.png"/>',
            );
            $html['avg'] = ($result['PartIt'] + $result['CarRate'] + $result['GoodsLevel'] + $result['PriceLevel']) / 4;
            $html['PartIt'] = '<p class="m-top5"><label>常用件完整度：</label>' . $xinxin[$result['PartIt']] . '</p>';
            $html['CarRate'] = '<p><label>全车件覆盖率：</label>' . $xinxin[$result['CarRate']] . '</p>';
            $html['GoodsLevel'] = '<p><label>　商品竞争度：</label>' . $xinxin[$result['GoodsLevel']] . '</p>';
            $html['PriceLevel'] = '<p><label>　　价格水平：</label>' . $xinxin[$result['PriceLevel']] . '</p>';
            return $html;
        }
    }

}

?>
