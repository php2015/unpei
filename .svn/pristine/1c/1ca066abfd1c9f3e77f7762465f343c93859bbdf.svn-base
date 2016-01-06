<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GoodsService {

    //取第一个大类的子类
    public static function getfirstCategory() {
        $t = Gcategory::model()->find('ParentID=0 and IsShow = 1 order by SortOrder,ID asc')->attributes;
        return Gcategory::model()->find("ParentID={$t['ID']} and IsShow = 1 order by SortOrder,ID asc")->attributes;
    }

    //获取被选中的子类
    public static function checkSub($params) {
        $sub = $params['sub'];
        $code = $params['code'];
        //是否为空
        if ($sub == '') {
            $m = self::getfirstCategory();
            $sub = $m['ID'];
            $newCode = '';
        } else {
            //是否存在
            $m = Gcategory::model()->findByPk($sub, 'IsShow = 1')->attributes;
            if (!$m) {
                $m = self::getfirstCategory();
                $sub = $m['ID'];
                $newCode = '';
            } else {
                //父类是否为大类
                $p = Gcategory::model()->findByPk($m['ParentID'], "ParentID=0 and IsShow = 1");
                if (!$p) {
                    $m = self::getfirstCategory();
                    $sub = $m['ID'];
                    $newCode = '';
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
        $m = $tmp['m'];
        $subModel = Gcategory::model()->findAll(array('condition' => "ParentID={$m['ParentID']} and IsShow = 1",
            'select' => 'Name,ID,ParentID', 'order' => 'SortOrder,ID asc'));
        $data = array();
        foreach ($subModel as $v) {
            $data[$v['ID']]['ID'] = $v['ID'];
            $data[$v['ID']]['Name'] = $v['Name'];
            $data[$v['ID']]['ParentID'] = $v['ParentID'];
            $cpModel = Gcategory::model()->findAll(array('condition' => "ParentID={$v['ID']} and IsShow = 1",
                'order' => "SortOrder,ID asc", 'select' => 'Name,ID,ParentID,Code'));
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

    //根据子类获取商品id
    public static function getGoodsIDBySub($sub) {
        $model = PapGoodsGcategory::model()->findAll(array('select' => 'GoodsID', 'condition' => "SubParts=$sub"));
        if ($model) {
            $idStr = '';
            foreach ($model as $v) {
                $idStr.=$v['GoodsID'] . ',';
            }
            return substr($idStr, 0, -1);
        } else {
            return "''";
        }
    }

    //获取商品品牌
    public static function getBrand($params) {
        $sub = $params['sub'];
        $code = $params['code'];
        $brand = $params['brand'];
        $sql = "select ID,BrandName,Pinyin from pap_brand where ID in(SELECT BrandID FROM `pap_goods` where";
        if ($code) {
            $sql.=" StandCode='{$code}')";
        } else {
            $id = self::getGoodsIDBySub($sub);
            $sql.=" ID in($id))";
        }
        $model = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        $data = array();
        $newBrand = array();
        foreach ($model as $v) {
            if ($v['ID'] == $brand) {
                $newBrand['ID'] = $brand;
                $newBrand['Name'] = $v['BrandName'];
            }
            $py = strtoupper(substr(self::checkFirstName($v["Pinyin"]), 0, 1));
            $data['All'][$v['ID']] = $v['BrandName'];
            if (!$py) {
                $data['Else'][$v['ID']] = $v['BrandName'];
            } else {
                $data[$py][$v['ID']] = $v['BrandName'];
            }
        }
        return array('data' => $data, 'brand' => $newBrand);
    }

    //检测品牌拼音
    private static function checkFirstName($subject) {
        $pattern = '/[A-Za-z]+/';
        preg_match($pattern, $subject, $matches);
        return $matches[0];
    }

    //商品价格区间
    public static function getPrice($params) {
        $price = $params['price'];
        $priceData = array('99' => array('text' => '100以下', 'cond' => ' < 100'), '100' => array('text' => '100-199', 'cond' => ' between 100 and 199'),
            '200' => array('text' => '200-499', 'cond' => ' between 200 and 499'), '500' => array('text' => '500-999', 'cond' => ' between 500 and 999'),
            '1000' => array('text' => '1000-1999', 'cond' => ' between 1000 and 1999'), '2000' => array('text' => '1999以上', 'cond' => ' > 1999'));
        $pricearr = array();
        if (array_key_exists($price, $priceData)) {
            $pricearr['cond'] = $priceData[$price]['cond'];
            $pricearr['val'] = $price;
            $pricearr['text'] = $priceData[$price]['text'];
        }
        return array('data' => $priceData, 'price' => $pricearr);
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
        $cp = Gcategory::model()->find(array('select' => 'Name,ParentID', 'condition' => "Code='{$code}'"))->attributes;
        $sub = Gcategory::model()->findByPk($cp['ParentID'], array('select' => 'ID,Name,ParentID'))->attributes;
        $big = Gcategory::model()->findByPk($sub['ParentID'], array('select' => 'Name,ParentID'))->attributes;
        return array('CpName' => $cp['Name'], 'SubParts' => $sub['Name'], 'BigParts' => $big['Name'], 'sub' => $sub['ID']);
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

    //获取商品图片
    public static function getOneGoodsImage($id) {
        return PapGoodsImageRelation::model()->find(array('condition' => "GoodsID=$id",
                    'select' => 'ImageUrl', 'order' => 'CreateTime DESC'))->attributes['ImageUrl'];
    }

    //获取商品
    public static function getGoods($params) {
        $organ_ID = Yii::app()->user->getOrganID();
        // 查询条件
        $sub = $params['sub'];
        $code = $params['code'];
        $rows = $params['rows'];                    // 每页显示条数
        $curpage = $params['page'];                 // 当前页码
        $orderby = $params['order'];                // 排序
        $brand = $params['brand'];              // 商品品牌ID
        $price = $params['price'];              // 商品品牌ID
//            $organID = $params['OrganID'];              // 经销商机构ID
//            $goodsNO = $params['goodsNO'];              // 商品编号
//            $goodsName = trim($params['goodsName']);          // 商品名称
//            $pinyin = $params['pinyin'];          // 商品名称
//            $brand = $params['BrandName'];              // 商品品牌名
//            $OENO = $params['OENO'];                    // 商品OE号
//            $IsSale = $params['IsSale'];                // 是否上架
//            $IsPro = $params['IsPro'];                  // 是否促销                                                                                                                                                                 
//            $gbigparts = $params['gbigparts'];          // 大类
//            $gsubparts = $params['gsubparts'];          // 子类
//            $gmake = $params['gmake'];                  // 厂家
//            $gcar = $params['gcar'];                    // 车系
//            $gyear = $params['gyear'];                  // 年款
//            $gmodel = $params['gmodel'];                // 车型
        $sql = "SELECT dg.*,if(dg.ProPrice and dg.IsPro=1,dg.ProPrice,if(discount.PriceRatio,discount.PriceRatio*dg.Price,dg.Price)) as ppp FROM `pap_goods` dg left join(
                SELECT p.OrganID as OrganID, left(p.PriceRatio,char_length(p.PriceRatio)-1)/100 as PriceRatio from  `pap_goods_price_manage` AS p ,`pap_client_type` as ct WHERE 
                p.CooperationType = ct.Cooperationtype 
                AND  ct.ServiceID = $organ_ID and ct.DealerID=p.OrganID 
                AND (!ISNULL(p.PriceRatio) AND p.PriceRatio !='')) as discount 
                on dg.OrganID = discount.OrganID where dg.ISdelete=1 and dg.IsSale=1";
        //子类和标准名称查询
        if ($code) {
            $sql.= " and dg.StandCode='{$code}'";
        } else {
            $id = self::getGoodsIDBySub($sub);
            $sql.=" and dg.ID in($id)";
        }

        //商品品牌筛选
        if ($brand) {
            $sql.=" and dg.BrandID = '{$brand}'";
        }

        //商品价格筛选
        if ($price) {
            $sql.=" and if(dg.ProPrice and dg.IsPro=1,dg.ProPrice,if(discount.PriceRatio,discount.PriceRatio*dg.Price,dg.Price)) {$price}";
        }
        //商品编号、oe号
//            if ($goodsName) {
//                $sql.=" and (dg.Title like '%$goodsName%') ";
//            }
        // 机构名称
//            if (!empty($organID)) {
//                $sql.=" and dg.OrganID = $organID";
//            }
        // 是否促销
//            if (empty($IsPro) || $IsPro == 'all') {
//                $sql.=" and dg.IsPro between 0 and 1";
//            } else {
//                if ($IsPro == 2) {     // 不是促销的
//                    $sql.=" and dg.IsPro = 0";
//                } else {        // 是促销的
//                    $sql.=" and dg.IsPro = 1 and !ISNULL(dg.ProPrice)";
//                }
//            }
        // 车型车系
//            if (!empty($gmake)) {
//                $arr = array();
//                $arr['gmake'] = $gmake ? $gmake : 0;
//                $arr['gcar'] = $gcar ? $gcar : 0;
//                $arr['gyear'] = $gyear ? $gyear : 0;
//                $arr['gmodel'] = $gmodel ? $gmodel : 0;
//                $goodsIDS = self::getVehcondition($arr);
//                if ($goodsIDS) {
//                    $goodsStr = implode(',', $goodsIDS);
//                    $sql.=" and dg.ID in ($goodsStr)";
//                } else {
//                    $sql.=" and dg.ID in (0)";
//                }
//            }
//            
//            
        //查询商品个数
        $countSql = str_replace('dg.*', 'count(*)', $sql);
       // return $countSql;exit;
        //商品排序
        if ($orderby) {
            if ($orderby == 'sales_l') {    // 按销量从多到少
                $sql.=" order by dg.Sales DESC";
            } elseif ($orderby == 'sales_h') {    // 按销量从少到多
                $sql.=" order by dg.Sales ASC";
            } elseif ($orderby == 'price_l') {   //总价从高到低
                $sql.=" order by ppp DESC";
            } elseif ($orderby == 'price_h') { // 总价从低到高
                $sql.=" order by ppp ASC";
            }
        }
        $res = Yii::app()->papdb->createCommand($countSql)->queryAll();
        $count = $res[0]['count(*)'];
        $pages = new CPagination($count);
        $pages->pageSize = $rows;
        $offset = ($curpage - 1) * $pages->pageSize;
        $goods = Yii::app()->papdb->createCommand($sql . " LIMIT $offset,$pages->pageSize")->queryAll();
        foreach ($goods as $k => $v) {
            $image = self::getOneGoodsImage($v['ID']);
            if (!$image) {
                $goods[$k]['image'] = F::baseUrl() . '/upload/' . 'dealer/goods-img-big.jpg';
//            } else if (!file_exists(F::baseUrl() . '/upload/' . $image)) {
//                $goods[$k]['image'] = F::baseUrl() . '/upload/' . 'dealer/default-goods2.png';
            } else {
                $goods[$k]['image'] = F::baseUrl() . '/upload/' . $image;
            }
        }
        return array('data' => $goods, 'count' => $count);
    }

    //获取商品详情
    public static function getGoodByID($id) {
        $criteria = new CDbCriteria();
        $criteria->condition = " t.IsSale = 1 and t.ISdelete = 1";  // 上架的和没有删除的商品
        $criteria->with = "goodsimage";
        $model = PapGoods::model()->findByPk($id, $criteria);
        if (!$model) {
            return false;
            exit;
        }
        $data = array();
        //商品基本信息
        $data['GoodsID'] = $id;
        $data['Name'] = $model['Name'];
        $data['GoodsNO'] = $model['GoodsNO'];
        $organID = Yii::app()->user->getOrganID();
        //商品价格
        $price = self::getContactprice($model['OrganID'], $organID);
        $data['Price'] = $model['Price'];
        $data['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
        if ($data['PriceRatio'] > 0 && $data['PriceRatio'] < '100%') {
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
        // $data['goodsBrand'] = $goods['Brand'];
        //商品OE号
        //   $data['OENO'] = self::getOENOSByGoodID($id);
        //    $data['LogisticsPrice'] = $goods['LogisticsPrice'];    // 物流价
        $cpArr = self::getCategory($model['StandCode']);
        $data['BigParts'] = $cpArr['BigParts'];
        $data['SubParts'] = $cpArr['SubParts'];
        $data['CpName'] = $cpArr['CpName'];
        $data['sub'] = $cpArr['sub'];
        $data['code'] = $model['StandCode'];
//            $vehs = self::getVehicleByGoodsID($id);
//            $data['Vehicle'] = $vehs[0];
//            $data['IsSale'] = $data['IsSale'] == 1 ? '已上架' : '已下架';
//
//            // 商品属性
//            $data['Weight'] = $data->goodsspec->Weight;
//            $data['Length'] = $data->goodsspec->Length;
//            $data['Wide'] = $data->goodsspec->Wide;
//            $data['Height'] = $data->goodsspec->Height;
//            $data['Volume'] = $data->goodsspec->Volume;
//            $data['ValidityDate'] = $data->goodsspec->ValidityDate;
//            $data['ValidityType'] = $data->goodsspec->ValidityType;
//            if ($data['ValidityType'] == 1) {
//                $data['Validity'] = '不保修';
//            }if ($data['ValidityType'] == 2) {
//                $data['Validity'] = '保装车';
//            }if ($data['ValidityType'] == 3) {
//                $data['Validity'] = $data['ValidityDate'] . '个月';
//            }
//            $data['Specifica'] = $data->goodsspec->Specifica;
//            $data['Unit'] = $data->goodsspec->Unit;
//            $data['BganCompany'] = $data->goodsspec->BganCompany;
//            $data['BganGoodsNO'] = $data->goodsspec->BganGoodsNO;
//            $data['PartsNO'] = $data->goodsspec->PartsNO;
//            $data['JiapartsNO'] = $data->goodsspec->JiapartsNO;    // 嘉配号
//            $data['ImageUrl'] = $data->goodsspec->ImageUrl;        // 图像
//            $data['DetectionImg'] = $data->goodsspec->DetectionImg; // 检测图像
//            // 商品包装
//            $data['pWeight'] = $data->goodspack->Weight;
//            $data['pLength'] = $data->goodspack->Volume;
//            $data['MinQuantity'] = $data->goodspack->MinQuantity;
//
//            // OE号
//            $data['OENOS'] = self::getOENOSByGoodsID($id);
//
//            // 车型车系
//            $data['Vehicles'] = self::getVehicleByGoodsID($id);
        // 图片
        if (!$model->goodsimage) {
            $data['Images'][0]['ImageUrl'] = 'dealer/goods-img-big.jpg';
        } else {
            foreach ($model->goodsimage as $v) {
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

}

?>
