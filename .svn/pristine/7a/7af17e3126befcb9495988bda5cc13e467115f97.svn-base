<?php

Class QuotationService {

    //获取报价单列表
    public static function getquolists($params) {
        $organID = Yii::app()->user->getOrganID();
        $where = ' where DealerID=' . $organID;
        if (!empty($params['no'])) {
            $no = urldecode(trim($params['no']));
            if (strpos($no, '%') !== false)
                $no = str_replace('%', '\%', $no);
            $where.=' and QuoSn like "%' . $no . '%"';
        }
        if (is_numeric($params['status'])) {
            $where.=' and Status ="' . $params['status'] . '"';
        }
        if (!empty($params['start']) && $t1 = strtotime(urldecode($params['start']))) {
            $where.=' and CreateTime>' . $t1;
        }
        if (!empty($params['end']) && $t2 = strtotime(urldecode($params['end']))) {
            $where.=' and CreateTime<' . ($t2 + 3600 * 24 - 1);
        }
        if ($params['ifsend']) {
            $where.=' and  IfSend="1" and Status="1"';
        } else {
            $where.=' and  (IfSend="2" or Status="5")';
        }
        $sql = 'select * from `pap_quotation`' . $where;
        ;
        $sqlcount = 'select count(*) from `pap_quotation`' . $where;
        $count = Yii::app()->papdb->createCommand($sqlcount)->queryScalar();
        $sql.=' order by CreateTime desc ';
        $lists = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->papdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => 10,
            ),
                )
        );
        $datas = $lists->getData();
        foreach ($datas as $k => $v) {
            if ($v['InquiryID'] == 0) {
                $datas[$k]['from'] = '经销商';
            } else {
                $datas[$k]['from'] = '修理厂';
            }
        }
        $lists->setData($datas);
        return $lists;
    }

    //获取经销商信息或者服务店信息
    public static function getorganinfo($params) {
        if ($params['identity'] == 2) {
            $organsql = 'select OrganName,Phone from `jpd_organ` where ID=' . $params['organID'];
        } else if ($params['identity'] == 3) {
            $organsql = 'select OrganName,Phone,Province,City,Area,Address from `jpd_organ` where ID=' . $params['organID'];
        }
        $organinfo = Yii::app()->jpdb->createCommand($organsql)->queryRow();
        $organinfo['organID'] = $params['organID'];
        if ($params['identity'] == 3) {
            $dealerid = Yii::app()->user->getOrganID();
            $discount = self::getpriceratio($dealerid, $params['organID']);
            if ($params['quoid']) {
                $sql = 'select Discount from `pap_quotation` where QuoID=' . $params['quoid'];
                $res = Yii::app()->papdb->createCommand($sql)->queryRow();
                $rebate = explode(',', $res['Discount']);
                if ($res['Discount'])
                    $organinfo['type'] = '该客户为<span style="color:red">' . $rebate[0]
                            . '类客户</span>,其商品折扣率为<span style="color:red">' . $rebate[1] . '%</span>。';
                else {
                    $organinfo['type'] = '该客户为<span style="color:red">' . $discount['type']
                            . '类客户</span>,其商品折扣率为<span style="color:red">' . $discount['discount'] . '%</span>。';
                }
            } else {
                $organinfo['type'] = '该客户为<span style="color:red">' . $discount['type']
                        . '类客户</span>,其商品折扣率为<span style="color:red">' . $discount['discount'] . '%</span>。';
            }
        }
        return $organinfo;
    }

    //获取服务店列表
    public static function getservices($params) {
        $organID = Yii::app()->user->getOrganID();
        //获取联盟id
        $sql = 'select UnionID from jpd_organ where ID=' . $organID;
        $organ = Yii::app()->jpdb->createCommand($sql)->queryRow();
        if (!$organ['UnionID']) {
            $organ['UnionID'] = -1;
        }
        $time = $_SERVER['REQUEST_TIME'] - 7 * 24 * 3600;
        $querysql = ' where a.Identity=3 and a.IsBlack="0" and a.IsFreeze="0" and a.Status="1" and UnionID=' . $organ['UnionID'];
        if ($params['organname'] !== null) {
            $organname = trim($params['organname']);
            if (strpos($organname, '%') !== false)
                $organname = str_replace('%', '\%', $organname);
            $querysql .= ' and (OrganName like "%' . $organname . '%")';
        }
        if (is_numeric($params['organphoto'])) {
            $querysql.=' and Phone like "' . trim($params['organphoto']) . '%"';
        }
        $page = $params['page'] ? intval($params['page']) : 1;
        $pagesize = 10;
        $start = ($page - 1) * $pagesize;
        $sql = 'select ID,OrganName,Phone,Province,City,Area,Address,'
                . '(select QuoID from pap.pap_quotation where DealerID=' . $params['organID'] . ' and CreateTime>' . $time
                . ' and ServiceID=a.ID ORDER BY QuoID desc limit 0,1) as quoid '
                . 'from `jpd_organ` a' . $querysql . ' order by quoid desc';
        $sqlcount = 'select count(*) from jpd_organ a ' . $querysql;
        $count = Yii::app()->jpdb->createCommand($sqlcount)->queryScalar();
        $dataProvider = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->jpdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => $pagesize,
            ),
                )
        );
        $datas = $dataProvider->getData();
        foreach ($datas as $k => $v) {
            $discount = self::getpriceratio($organID, $v['ID']);
            $datas[$k]['rowNo'] = 10 * ($page - 1) + $k + 1;
            $datas[$k]['type'] = $discount['type'] . '类客户';
            $datas[$k]['discount'] = $discount['discount'] . '%';
        }
        $dataProvider->setData($datas);
        return $dataProvider;
    }

    //经销商商品适用车型查询
    public static function getgoodsbycarmodel($params) {
        if (!empty($params['Make'])) {
            $sql = 'select distinct GoodsID from pap_goods_vehicle_relation where OrganID=' . $params['organID'] . ' and Make=' . $params['Make'];
            if (!empty($params['Car']) && $params['Car'] != 'ALL') {
                $sql.=' and Car=' . $params['Car'];
                if (!empty($params['Year']) && $params['Year'] != 'ALL') {
                    $sql.=' and Year="' . trim($params['Year']) . '"';
                    if (!empty($params['Model']) && $params['Model'] != 'ALL') {
                        $sql.=' and Model=' . $params['Model'];
                    }
                }
            }
            $res = Yii::app()->papdb->createCommand($sql)->queryAll();
            $ids = array();
            foreach ($res as $v) {
                $ids[] = $v['GoodsID'];
            }
            $idstr = implode(',', $ids);
            if ($idstr)
                $where.=' and ID in (' . $idstr . ')';
            else {
                $where.=' and ID in (0)';
            }
            return $where;
        }
    }

    //获取经销商商品
    public static function getgoods($params) {
        $page = $params['page'] ? intval($params['page']) : 1;
        $rows = $params['rows'] ? intval($params['rows']) : 10;
        $organID = Yii::app()->user->getOrganID();
        $sql = 'select distinct a.ID,a.`Name`,a.BrandID,a.GoodsNO,a.Price,a.ProPrice,a.IsPro,a.PartsLevel,a.Version,a.StandCode,'
                . '(select BrandName from pap_brand b where  a.BrandID=b.ID) as BrandName'
                . ' from `pap_goods` a';
        $sqlcount = ' select count(distinct(a.ID)) from `pap_goods` a';
        $where = ' where a.IsSale=1 and a.ISdelete=1 and a.OrganID=' . $organID;
        //车型查询
        if ($params['Make']) {
            $sql.=' left join pap_goods_vehicle_relation pgvr on pgvr.GoodsID=a.ID ';
            $sqlcount.=' left join pap_goods_vehicle_relation pgvr on pgvr.GoodsID=a.ID ';
            $where.= ' and pgvr.Make=' . $params['Make'];
            if (!empty($params['Car']) && $params['Car'] != 'ALL') {
                $where.=' and pgvr.Car=' . $params['Car'];
                if (!empty($params['Year']) && $params['Year'] != 'ALL') {
                    $where.=' and pgvr.Year="' . trim($params['Year']) . '"';
                    if (!empty($params['Model']) && $params['Model'] != 'ALL') {
                        $where.=' and pgvr.Model=' . $params['Model'];
                    }
                }
            }
        }
        //标准名称查询
        if (!empty($params['standcode'])) {
            $where.=' and a.StandCode="' . $params['standcode'] . '"';
        }
        //配件档次查询
        if (!empty($params['partslevel'])) {
            $where.=' and a.PartsLevel="' . $params['partslevel'] . '"';
        }
        if (!empty($params['keyword'])) {
            $params['keyword'] = trim($params['keyword']);
            if ($params['searchtype'] == 1) {
                //根据标准名称获取standcode
                $standcode = self::standgetcode($params['keyword']);
                if ($standcode)
                    $where.=' and ((a.Name like "%' . $params['keyword'] . '%") or (a.Pinyin like "%' . $params['keyword'] . '%") or (a.StandCode="' . $standcode . '"))';
                else
                    $where.=' and ((a.Name like "%' . $params['keyword'] . '%") or (a.Pinyin like "%' . $params['keyword'] . '%"))';
            } else if ($params['searchtype'] == 2) {
                $where.=' and a.GoodsNO like "%' . $params['keyword'] . '%"';
            } else if ($params['searchtype'] == 3) {
                //按oe号查询
                $sql.= ' left join pap_goods_oe_relation pgor on pgor.GoodsID=a.ID ';
                $sqlcount.= ' left join pap_goods_oe_relation pgor on pgor.GoodsID=a.ID ';
                $where.= ' and pgor.OrganID=' . $organID . ' and pgor.OENO like "%' . $params['keyword'] . '%"';
            }
        }
        $sql = $sql . $where;
        $sqlcount = $sqlcount . $where;
        $count = Yii::app()->papdb->createCommand($sqlcount)->queryScalar();
        $dataProvider = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->papdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => $rows,
            ),
                )
        );
        //服务店客户类型所对应的商品折扣率
        $serviceid = $params['sid'];
        $discount = self::getpriceratio($organID, $serviceid);
        $priceratio = $discount['discount'];
        $datas = $dataProvider->getData();
        $partlevel = Yii::app()->getParams()->PartsLevel;
        foreach ($datas as $k => $data) {
            $nameurl = Yii::app()->createUrl('/pap/dealergoods/goodsinfo/', array('goods' => $data['ID']));
            $datas[$k]['rowNo'] = 10 * ($page - 1) + $k + 1;
            $datas[$k]['Name'] = '<a  version="' . $data['Version'] . '" goodsid="' . $data['ID'] . '" class="order_goods"  href="' . $nameurl . '" title="' . $data['Name'] . '">' . $data['Name'] . '</a>';
            $datas[$k]['GoodsNO'] = '<a target="_blank" href="' . $nameurl . '">' . $data['GoodsNO'] . '</a>';
            $oearr = self::getoebygoodsid($data['ID']);
            $oes = self::getgoodsoes($oearr);
            $stand = self::getstand($data['StandCode']);
            $stand = '<a title="' . $stand . '">' . $stand . '</a>';
            $datas[$k]['Stand'] = $stand;
            $datas[$k]['OENO'] = $oes;
            //商品价格(促销价优先 折扣价其次  最后是参考价)
            if ($data['IsPro'] == 1) {
                if (is_null($data['ProPrice']))
                    $datas[$k]['GoodsPrice'] = sprintf("%.2f", $data['Price'] * $priceratio / 100);
                else {
                    if ($data['ProPrice'] < $data['Price'] && $data['ProPrice'] != 0)
                        $datas[$k]['GoodsPrice'] = $data['ProPrice'];
                    else
                        $datas[$k]['GoodsPrice'] = sprintf("%.2f", $data['Price'] * $priceratio / 100);
                }
            } else
                $datas[$k]['GoodsPrice'] = sprintf("%.2f", $data['Price'] * $priceratio / 100);
            $datas[$k]['PL'] = $partlevel[$data['PartsLevel']];
        }
        $dataProvider->setData($datas);
        return $dataProvider;
    }

    //通过standcode获取标准名称
    public static function getstand($standcode) {
        $sql = 'select Name from `jpd_gcategory` where Code="' . $standcode . '"' . ' and Level=3';
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $res['Name'];
    }

    //通过standcode获取标准名称
    public static function standgetcode($standname) {
        $sql = 'select Code from `jpd_gcategory` where `Name`="' . $standname . '"' . ' and Level=3';
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $res['Code'];
    }

    //根据商品id获取商品oe号
    public static function getoebygoodsid($goodsid) {
        $oesql = 'select OENO from `pap_goods_oe_relation` where GoodsID=' . $goodsid;
        $oes = Yii::app()->papdb->createCommand($oesql)->queryAll();
        $oearr = array();
        foreach ($oes as $oe) {
            $oearr[] = $oe['OENO'];
        }
        return $oearr;
    }

    public static function getgoodsoes($oearr) {
        if ($oearr) {
            $oestr = implode(',', $oearr);
            return '<a title="' . $oestr . '">' . $oestr . '</a>';
        } else {
            return '';
        }
    }

    //根据商品id获取商品信息
    public static function getgoodsinfobyid($goodsid, $Version, $QuogoodsID = '') {
        $info = DealergoodsService::getmongoversion($goodsid, $Version);
        $goodsinfo = $info['GoodsInfo'];
        $goodsinfo['PL'] = $goodsinfo['PartsLevelName'];
        $goodsinfo['BrandName'] = $goodsinfo['Brand'];
        $oes = self::getgoodsoes($goodsinfo['oeno']);
        if (Yii::app()->user->isDealer() == 1) {
            $nameurl = Yii::app()->createUrl('/pap/dealergoods/goodsinfo/', array('goods' => $goodsid));
            $goodsinfo['Name'] = '<a  version="' . $Version . '" goodsid="' . $goodsid . '" class="order_goods" href="' . $nameurl . '">' . $goodsinfo['Name'] . '</a>';
            $goodsinfo['GoodsNO'] = '<a target="_blank" href="' . $nameurl . '">' . $goodsinfo['GoodsNO'] . '</a>';
        } elseif (Yii::app()->user->isServicer() == 1) {
            $nameurl = Yii::app()->createUrl('/pap/mall/detail/', array('goods' => $goodsid));
            $goodsinfo['Name'] = '<a  version="' . $Version . '"  quogoodsid=' . $QuogoodsID . ' goodsid="' . $goodsid . '" class="quottion_goods_href" href="javascript:void(0);">' . $goodsinfo['Name'] . '</a>';
            $goodsinfo['GoodsNO'] = '<a  version="' . $Version . '"  quogoodsid=' . $QuogoodsID . ' goodsid="' . $goodsid . '" class="quottion_goods_href" href="javascript:void(0);">' . $goodsinfo['GoodsNO'] . '</a>';
        }
        $goodsinfo['Name'] = '<a  version="' . $Version . '" goodsid="' . $goodsid . '" class="order_goods" href="' . $nameurl . '">' . $goodsinfo['Name'] . '</a>';
        $goodsinfo['GoodsNO'] = '<a target="_blank" href="' . $nameurl . '">' . $goodsinfo['GoodsNO'] . '</a>';
        $goodsinfo['OENO'] = $oes;
        $goodsinfo['StandCodeName'] = '<a title="' . $goodsinfo['StandCodeName'] . '">' . $goodsinfo['StandCodeName'] . '</a>';
        unset($goodsinfo['Price']);
        return $goodsinfo;
    }

    //获取服务店客户类别对应的折扣率
    public static function getpriceratio($dealerid, $serviceid) {
        $typesql = 'select Cooperationtype from `pap_client_type` where DealerID=' . $dealerid . ' and ServiceID=' . $serviceid;
        $type = Yii::app()->papdb->createCommand($typesql)->queryRow();
        $res = array();
        if ($type['Cooperationtype']) {
            $typelevel = trim($type['Cooperationtype']);
        } else
            $typelevel = 'C';
        $res['type'] = $typelevel;
        $sql = 'select PriceRatio from `pap_goods_price_manage` where OrganID=' . $dealerid . ' and CooperationType like "%' . $typelevel . '%"';
        $data = $type = Yii::app()->papdb->createCommand($sql)->queryRow();
        if ($data['PriceRatio'])
            $res['discount'] = $data['PriceRatio'];
        else {
            $res['discount'] = '100';
        }
        return $res;
    }

    //新建报价单方案
    public static function newscheme($params) {
        $organID = Yii::app()->user->getOrganID();
        $time = $_SERVER['REQUEST_TIME'];
        $quoID = $params['quoid'];
        if ($quoID == null) {
            //新建报价单
            $quodatas['InquiryID'] = 0;
            $quodatas['DealerID'] = $organID;
            $quodatas['ServiceID'] = $params['sid'];
            $quodatas['SorceID'] = $organID;
            $quodatas['Status'] = '1';
            $quodatas['CreateTime'] = $time;
            $quodatas['UpdateTime'] = $time;
            $quodatas['QuoSn'] = $params['quosn'];
            $quodatas['Title'] = $params['quoname'];
            $result = Yii::app()->papdb->createCommand()->insert('pap_quotation', $quodatas);
            $quoID = Yii::app()->papdb->getLastInsertID();
        } else {
            //更新报价单
            $quodatas['ServiceID'] = $params['sid'];
            $quodatas['UpdateTime'] = $time;
            $quodatas['Title'] = $params['quoname'];
            $result = Yii::app()->papdb->createCommand()->update('pap_quotation', $quodatas, 'QuoID=' . $quoID);
        }

        //新建报价单方案
        $datas['QuoID'] = $quoID;
        $datas['TotalFee'] = $params['quoprices'];
        $datas['GoodFee'] = $params['totalprices'];
        $datas['ShipFee'] = $params['shipprices'];
        $datas['Status'] = '1';
        $datas['CreateTime'] = $time;
        $datas['UpdateTime'] = $time;
        //保存附件
        if ($params['fileurl']) {
            $datas['FileName'] = $params['filename'];
            $datas['FileUrl'] = $params['fileurl'];
        }
        $result = Yii::app()->papdb->createCommand()->insert('pap_quotation_scheme', $datas);
        $SchID = Yii::app()->papdb->getLastInsertID();
        //获取商品信息
        $goodsinfo = array();
        $goodsids = explode(',', $params['quoids']);
        $goodsnum = explode(',', $params['quonum']);
        $goodsprice = explode(',', $params['quoprice']);
        //插入报价单商品
        $sql = 'INSERT INTO `pap`.`pap_quotation_goods` (`SchID`, `GoodsID`, `Num`, `Price`,`Version`) VALUES';
        foreach ($goodsids as $key => $v) {
            if ($v) {
                $version = self::getgoodsversion($goodsids[$key]);
                $version = $version ? $version : 0;
                $sql.="($SchID,$goodsids[$key],$goodsnum[$key],$goodsprice[$key],$version),";
            }
        }
        $sql = rtrim($sql, ',') . ';';
        $res = Yii::app()->papdb->createCommand($sql)->execute();
        echo json_encode(array('quoid' => $quoID, 'count' => $res, 'schid' => $SchID, 'success' => true));
    }

    //查询报价单方案详情
    public static function getschemedetails($params) {
        $organID = Yii::app()->user->getOrganID();
        $quosql = 'select QuoSn,Title from pap_quotation where (status="1" or status="3") and QuoID=' . $params['quoid'] . ' and DealerID=' . $organID;
        $quoinfo = Yii::app()->papdb->createCommand($quosql)->queryRow();
        if ($quoinfo == null) {
            Controller::redirect(Yii::app()->createUrl('pap/quotation/index'));
        }
        $schsql = 'select * from pap_quotation_scheme where QuoID=' . $params['quoid'] . ' and SchID=' . $params['schid'];
        $schinfo = Yii::app()->papdb->createCommand($schsql)->queryRow();
        if ($schinfo == null) {
            Controller::redirect(Yii::app()->createUrl('pap/quotation/index'));
        }
        $schinfo['QuoSn'] = $quoinfo['QuoSn'];
        $schinfo['Title'] = $quoinfo['Title'];
        //报价单商品列表
        $quogoodssql = 'select GoodsID,Num,Price,Version from pap_quotation_goods where SchID=' . $params['schid'];
        $countsql = 'select count(*) from pap_quotation_goods where SchID=' . $params['schid'];
        $total = Yii::app()->papdb->createCommand($countsql)->queryScalar();
        $dataProvider = new CSqlDataProvider($quogoodssql, array(
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $total,
            ),
                )
        );
        $datas = $dataProvider->getData();
        $info = '';
        foreach ($datas as $k => $data) {
            $datas[$k]['rowNo'] = $k + 1;
            $goodsinfo = self::getgoodsinfobyid($data['GoodsID'], $data['Version']);
            $datas[$k] = array_merge($goodsinfo, $datas[$k]);
            $datas[$k]['totalprices'] = sprintf("%.2f", $data['Price'] * $data['Num']);
            $htmlnum = '<a class="s" onclick="numsub(' . $data['GoodsID'] . ',this)" href="javascript:void(0)"></a>'
                    . '<input class="input input5 width40 float_l" style="width:30px;margin-top:2px;height:20px;line-height:20px" type="text" name="num" onblur="numblur(' . $data['GoodsID'] . ',this);" onkeyup="numkeyup(' . $data['GoodsID'] . ',this)" value="' . $data['Num'] . '">'
                    . '<a class="a" onclick="numadd(' . $data['GoodsID'] . ',this)" href="javascript:void(0)"></a>';
            $datas[$k]['Num'] = $htmlnum;
            $info.=$data['GoodsID'] . ',' . $data['Price'] . ',' . $data['Num'] . ',';
        }
        $schinfo['info']['goodsinfo'] = $info;
        $schinfo['info']['QuoSn'] = $quoinfo['QuoSn'];
        $schinfo['info']['Title'] = $quoinfo['Title'];
        $schinfo['info']['GoodFee'] = $schinfo['GoodFee'];
        $dataProvider->setData($datas);
        return array('buylist' => $dataProvider, 'schinfo' => $schinfo);
    }

    //报价单方案编辑
    public static function editscheme($params) {
        $organID = Yii::app()->user->getOrganID();
        $time = $_SERVER['REQUEST_TIME'];
        //更新报价单
        $quodatas['UpdateTime'] = $time;
        $quodatas['ServiceID'] = $params['sid'];
        $quodatas['Title'] = $params['quoname'];
        $result = Yii::app()->papdb->createCommand()->update('pap_quotation', $quodatas, 'QuoID=' . $params['quoid']);
        $SchID = $params['schid'];
        $datas['TotalFee'] = $params['quoprices'];
        $datas['GoodFee'] = $params['totalprices'];
        $datas['ShipFee'] = $params['shipprices'];
        $datas['ShipFee'] = $params['shipprices'];
        $datas['UpdateTime'] = $time;
        //保存附件
        if ($params['fileurl']) {
            $datas['FileName'] = $params['filename'];
            $datas['FileUrl'] = $params['fileurl'];
            //删除之前附件
            $quo_data = PapQuotationScheme::model()->findByPk($SchID);
            if (!empty($quo_data['FileName'])) {
                $ftp = new Ftp();
                $res = $ftp->delete_file($quo_data->FileUrl);
                $ftp->close();
            }
        }
        $result = Yii::app()->papdb->createCommand()->update('pap_quotation_scheme', $datas, 'SchID=:SchID', array(':SchID' => $SchID));
        //获取商品信息
        $goodsinfo = array();
        $goodsids = explode(',', $params['quoids']);
        $goodsnum = explode(',', $params['quonum']);
        $goodsprice = explode(',', $params['quoprice']);
        //获取以前的商品信息
        $oldgoodsinfo = PapQuotationGoods::model()->findAll('SchID=' . $SchID);
        $newgoodsinfo = array();
        foreach ($goodsids as $key => $v) {
            if ($v) {
                $newgoodsinfo[$key]['GoodsID'] = $goodsids[$key];
                $newgoodsinfo[$key]['Num'] = $goodsnum[$key];
                $newgoodsinfo[$key]['Price'] = $goodsprice[$key];
                $version = self::getgoodsversion($goodsids[$key]);
                $newgoodsinfo[$key]['Version'] = $version ? $version : 0;
            }
        }
        $insertid = array();
        //将报价单商品插入报价单商品表中
        if ($SchID) {
            foreach ($newgoodsinfo as $nkey => $new) {
                $newids[] = $new['GoodsID'];
            }
            if ($oldgoodsinfo) {
                foreach ($oldgoodsinfo as $okey => $old) {
                    $oldids[] = $old['GoodsID'];
                }
            } else {
                $oldids = array();
            }
            foreach ($oldids as $id) {
                if (!in_array($id, $newids)) {
                    //删除商品
                    $delcount = Yii::app()->papdb->createCommand()->delete('pap_quotation_goods', 'SchID=:SchID and GoodsID=:goodsid', array(':SchID' => $SchID, ':goodsid' => $id));
                }
            }
            foreach ($newids as $key => $id) {
                if (in_array($id, $oldids)) {
                    //更新商品
                    $update['Num'] = $newgoodsinfo[$key]['Num'];
                    $update['Price'] = $newgoodsinfo[$key]['Price'];
                    $update['Version'] = $newgoodsinfo[$key]['Version'];
                    $result = Yii::app()->papdb->createCommand()->update('pap_quotation_goods', $update, 'SchID=:SchID and GoodsID=:goodsid', array(':SchID' => $SchID, ':goodsid' => $id));
                    if ($result == 1) {
                        $res = 1;
                    }
                } else {
                    //插入商品
                    $goodsdatas['SchID'] = $SchID;
                    $goodsdatas['GoodsID'] = $newgoodsinfo[$key]['GoodsID'];
                    $goodsdatas['Num'] = $newgoodsinfo[$key]['Num'];
                    $goodsdatas['Price'] = $newgoodsinfo[$key]['Price'];
                    $goodsdatas['Version'] = $newgoodsinfo[$key]['Version'];
                    $result = Yii::app()->papdb->createCommand()->insert('pap_quotation_goods', $goodsdatas);
                    $insertid[] = Yii::app()->papdb->getLastInsertID();
                }
            }
        }
        if ($res = 1 || count($insertid) > 0 || $delcount > 0)
            echo json_encode(array('count' => 1, 'quoid' => $params['quoid'], 'schid' => $SchID, 'success' => true));
        else {
            echo json_encode(array('count' => 0));
        }
    }

    //获取报价单方案列表
    public static function getschemelists($params) {
        if ($params['quoid']) {
            $organID = Yii::app()->user->getOrganID();
            if ($params['type'] == 1)
                $quosql = 'select * from pap_quotation where InquiryID=0 and (Status="1" or Status="3") and QuoID=' . $params['quoid'] . ' and DealerID=' . $organID;
            elseif ($params['type'] == 2)
                $quosql = 'select * from pap_quotation where InquiryID=0 and QuoID=' . $params['quoid'] . ' and DealerID=' . $organID;
            elseif ($params['type'] == 3)
                $quosql = 'select * from pap_quotation where InquiryID!=0 and (Status="1" or Status="3") and QuoID=' . $params['quoid'] . ' and DealerID=' . $organID;
            elseif ($params['type'] == 4)
                $quosql = 'select * from pap_quotation where InquiryID!=0 and QuoID=' . $params['quoid'] . ' and DealerID=' . $organID;
            elseif ($params['type'] == 5)
                $quosql = 'select * from pap_quotation where  QuoID=' . $params['quoid'] . ' and ServiceID=' . $params['sid'];
            elseif ($params['type'] == 6)
                $quosql = 'select * from pap_quotation where QuoID=' . $params['quoid'] . ' and ServiceID=' . $params['sid'];
            $quoinfo = Yii::app()->papdb->createCommand($quosql)->queryRow();
            if (!$quoinfo) {
                Controller::redirect(Yii::app()->createUrl('pap/quotation/index'));
            }
            $schsql = 'select * from pap_quotation_scheme where QuoID=' . $params['quoid'];
            $schlists = Yii::app()->papdb->createCommand($schsql)->queryAll();
            $schinfo = array();
            foreach ($schlists as $key => $list) {
                $schinfo[$key] = $list;
                $quogoodssql = 'select ID as QuogoodsID,GoodsID,Num,Price,Version from pap_quotation_goods where SchID=' . $list['SchID'];
                $countsql = 'select count(*) from pap_quotation_goods where SchID=' . $list['SchID'];
                $total = Yii::app()->papdb->createCommand($countsql)->queryScalar();
                $goodslists = new CSqlDataProvider($quogoodssql, array(
                    'db' => Yii::app()->papdb,
                    'pagination' => array(
                        'pageSize' => $total,
                    ),
                        )
                );
                $datas = $goodslists->getData();
                foreach ($datas as $k => $data) {
                    $goodsinfo = self::getgoodsinfobyid($data['GoodsID'], $data['Version'], $data['QuogoodsID']);
                    $datas[$k]['rowNo'] = '<span issell="' . $goodsinfo['IsPro'] . '" goodsid="'.$data['GoodsID'].'">' . ($k + 1) . '<span>';
                    $datas[$k] = array_merge($goodsinfo, $datas[$k]);
                    $datas[$k]['totalprices'] = sprintf("%.2f", $data['Price'] * $data['Num']);
                    if (($params['type'] === 5 ||$params['type'] === 6) && $quoinfo['Status']==='1') {
                        $datas[$k]['selected'] = '<input type="checkbox" name="selectgoods" checked=true goodsid="'.$data['GoodsID'].'" price="'.$data['Price'].'">';
                        $htmlnum = '<a class="s" onclick="numsub(' . $data['GoodsID'] . ',this)" href="javascript:void(0)"></a>'
                                . '<input class="input input5 width40 float_l" style="width:30px;margin-top:2px;height:20px;line-height:20px" type="text" name="num" onblur="numblur(' . $data['GoodsID'] . ',this);" onkeyup="numkeyup(' . $data['GoodsID'] . ',this)" value="' . $data['Num'] . '">'
                                . '<a class="a" onclick="numadd(' . $data['GoodsID'] . ',this)" href="javascript:void(0)"></a>';
                        $datas[$k]['Num'] = $htmlnum;
                    }
                }
                $goodslists->setData($datas);
                $schinfo[$key]['goodsinfo'] = $goodslists;
            }
            return array('schinfo' => $schinfo, 'quoinfo' => $quoinfo);
        }
    }

    //删除报价单方案
    public static function delscheme($schid) {
        $res = PapQuotationGoods::model()->deleteAll('SchID=' . $schid);
        $count = PapQuotationScheme::model()->deleteByPk($schid);
        echo json_encode(array('count' => $count + $res));
    }

    //获取方案个数
    public static function getschemecount($params) {
        $organID = Yii::app()->user->getOrganID();
        $quosql = 'select QuoSn,Title from pap_quotation where DealerID=' . $organID . ' and QuoID=' . $params['quoid'] . ' and (Status="1" or Status="3")';
        $quoinfo = Yii::app()->papdb->createCommand($quosql)->queryRow();
        if (!$quoinfo) {
            Controller::redirect(Yii::app()->createUrl('pap/quotation/index'));
        }
        $sql = 'select count(*) from pap_quotation_scheme where QuoID=' . $params['quoid'];
        $count = Yii::app()->papdb->createCommand($sql)->queryScalar();
        if ($count > 2) {
            if ($params['type'] == 1) {
                echo json_encode(array('count' => 0, 'msg' => '已添加3个方案,不能再添加了!'));
                exit;
            } else {
                Controller::redirect(Yii::app()->createUrl('pap/quotation/index'));
            }
        }
        return $quoinfo;
    }

    //发送报价单给服务店
    public static function sendquo($params) {
        $time = $_SERVER['REQUEST_TIME'];
        $sql = ' select ServiceID,IfSend from pap_quotation where QuoID=' . $params['quoid'];
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        $sql = 'update pap_quotation set IfSend="2",ServiceID=' . $params['sid'] . ',Status="1",UpdateTime=' . $time;
        //发送草稿箱内容
        if ($params['draft']) {
            $sql.=',CreateTime=' . $time;
        }
        $sql.=' where QuoID=' . $params['quoid'];
        $count = Yii::app()->papdb->createCommand($sql)->execute();
        if ($res['IfSend'] == 2 && $res['ServiceID'] != $params['sid']) {
            //删除业务提醒数据
            $delete = 'delete from pap_remind_business where HandleID=' . $params['quoid'] . ' and OrganID=' . $res['ServiceID'];
            Yii::app()->papdb->createCommand($delete)->execute();
        }
        if ($count > 0 && (($res['IfSend'] == 2 && $res['ServiceID'] != $params['sid']) || $res['IfSend'] == 1)) {
            //给修理厂发送提醒
            $params = array('OrganID' => $params['sid'], 'OrganType' => 3, 'HandleID' => $params['quoid']);
            $params['type'] = array('name' => 'BJD', 'key' => 3);
            $r = RemindService::sendRemind($params);
        }
        echo json_encode(array('count' => $count));
    }

    //取消发送报价单
    public static function cancelquo($params) {
        $quoid = $params['quoid'];
        if ($params['inqid']) {
            //查询询价单状态
            $sta = 'select Status from pap_inquiry where InquiryID=' . $params['inqid'];
            $r = Yii::app()->papdb->createCommand($sta)->queryRow();
            if ($r['Status'] > 1) {
                echo json_encode(array('count' => -1, 'msg' => '只能取消待报价或待确认的询价单'));
                die;
            }
        } else {
            //查询报价单状态
            $sta = 'select Status from pap_quotation where QuoID=' . $quoid;
            $r = Yii::app()->papdb->createCommand($sta)->queryRow();
            if ($r['Status'] != '1') {
                echo json_encode(array('count' => -1, 'msg' => '只能取消待确认的报价单'));
                die;
            }
        }
        $sql = 'select SchID from pap_quotation_scheme where QuoID=' . $quoid;
        $result = Yii::app()->papdb->createCommand($sql)->queryAll();
        $schids = array();
        foreach ($result as $r)
            $schids[] = $r['SchID'];
        $schstr = implode(',', $schids);
        if ($schids) {
            $goods = PapQuotationGoods::model()->deleteAll('SchID in (' . $schstr . ')');
        }
        $sch = PapQuotationScheme::model()->deleteAll('QuoID=' . $quoid);
        $quo = PapQuotation::model()->deleteByPk($quoid);
        if ($params['inqid']) {
            //查询询价单是否报价
            $quosql = 'select QuoID from pap_quotation where IfSend="2" and InquiryID=' . $params['inqid'];
            $quos = Yii::app()->papdb->createCommand($quosql)->queryRow();
            if (!$quos) {
                $update = 'update pap_inquiry set Status=0 where InquiryID=' . $params['inqid'];
                Yii::app()->papdb->createCommand($update)->execute();
            }
        }
        echo json_encode(array('count' => $quo + $sch + $goods));
    }

    //获取服务店名称
    public static function getservicename($serviceid) {
        if (is_numeric($serviceid)) {
            $sql = 'select OrganName from `jpd_organ` where `ID`=' . $serviceid;
            $service = Yii::app()->jpdb->createCommand($sql)->queryRow();
            return $service['OrganName'];
        }
    }

    //获取报价单状态
    public static function getstatus($status) {
        if (!is_numeric($status))
            return;
        if ($status == 1)
            return '<span>已报价待确认</span>';
        elseif ($status == 2)
            return '<span style="color:green">已确认</span>';
        elseif ($status == 3)
            return '<span>待修改</span>';
        elseif ($status == 4)
            return '<span style="color:red">已拒绝</span>';
        elseif ($status == 5)
            return '<span style="color:gray">已失效</span>';
    }

    //获取商品版本
    public static function getgoodsversion($goodsid) {
        $sql = ' select Version from pap_goods where ID=' . $goodsid;
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $res['Version'];
    }

    //获取经销商订单最小交易金额
    public static function getminturnover($organID) {
        $sql = 'select MinTurnover from pap_order_min_turnover where OrganID=' . $organID;
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        if (!$res || !$res['MinTurnover'])
            return 0;
        else {
            return $res['MinTurnover'];
        }
    }

    //获取系统参数
    public static function getsysparam($key, $category = 'system') {
        $sql = 'select Value from jpd_admin_settings where Category="' . trim($category) . '" and `Key`="' . trim($key) . '"';
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        if ($res['Value']) {
            $value = trim(@unserialize($res['Value']));
            if ($value != '') {
                return $value;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

}

?>
