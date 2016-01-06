<?php

class InquiryorderService {

    //获取询价单数据
    public static function inquirylistdata($app) {
        $data = $app['arrt'];
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition('OrganID=' . $organID);
        if ($data['startdate']) {
            $criteria->addCondition('CreateTime>=' . strtotime($data['startdate']));
        }

        if ($data['enddate']) {
            $criteria->addCondition('CreateTime<' . strtotime("+1 day", strtotime($data['enddate'])));
        }
        if (!empty($data['status']) || $data['status'] == '0') {
            $criteria->addCondition('Status =' . $data['status']);
        }
        if ($data['inquirySn']) {
            $criteria->addSearchCondition('InquirySn', $data['inquirySn']);
        }
        $criteria->order = 'CreateTime desc';
        $dataProvider = new CActiveDataProvider('PapInquiry', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '10'
            ),
        ));

        $pages = $dataProvider->getPagination();
        $result = array('pages' => $pages, 'dataProvider' => $dataProvider);
        return $result;
    }

    //获取经销商数据
    public static function getdealerlist($data) {
         $organID = Yii::app()->user->getOrganID();
        $time = $_SERVER['REQUEST_TIME'] - 7 * 24 * 3600;
         $sql_uninid='select UnionID from jpd_organ where ID='.Yii::app()->user->getOrganID();
        $union_result=Yii::app()->jpdb->createCommand($sql_uninid)->queryRow();
        $querysql = ' where a.Identity=2 and (IsDelete is null or IsDelete!=1 ) and IsBlack="0" and IsFreeze="0" and Status="1" and UnionID='.$union_result['UnionID'];
        if ($data['kword'] !== null) {
            $querysql .= ' and (OrganName like "%' . $data['kword'] . '%")';
        }
        if ($data['epc_make']) {
            $r_r = self::getdealeridbyepc($data);
            //判断是否符合条件
            $r = self::is_dealer_del($r_r,$union_result['UnionID']);
            if ($r) {
                $rr = implode(',', $r);
                $querysql.=' and ID in (' . $rr . ')';
            } else {
//                $querysql.=' and ID in (0)';
            }
        }
        $sql = 'select *,'
                . '(select InquiryID from pap.pap_inquiry where OrganID =' . $organID . ' and CreateTime>' . $time
                . ' and DealerID=CONCAT(",",a.ID,",") ORDER BY InquiryID desc limit 0,1) as inqid '
                . 'from `jpd_organ` a' . $querysql . ' order by inqid desc';
        $sqlcount = 'select count(*) from jpd_organ a ' . $querysql;
        $pagesize = 10;
        $count = Yii::app()->jpdb->createCommand($sqlcount)->queryScalar();
        $dataProvider = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->jpdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => $pagesize,
            ),
                )
        );
        $result = array('dataProvider' => $dataProvider);
        return $result;
    }

    public static function getdealeridbyepc($data) {
        $datas;
        if (!empty($data['epc_make']) && empty($data['epc_series'])) {
            $sql = 'select OrganID from jpd_dealer_vehicles  where  Car=0 and  Make="' . $data['epc_make'] . '"';
            $res = self::excutesql(array('sql' => $sql, 'db' => jpd));
            $arr = self::outdelaerid($res);
            $datas = $arr;
        }else if (!empty($data['epc_series'])) {
            $data['epc_series'] = $data['epc_series'] == 'ALL' ? 0 : $data['epc_series'];
            $sql2 = 'select OrganID from jpd_dealer_vehicles where Make="' . $data['epc_make'] . '"' . ' and (Car="' . $data['epc_series'] . '" or Car=0)';
            $res2 = self::excutesql(array('sql' => $sql2, 'db' => jpd));
            $arr2 = self::outdelaerid($res2);
            if (!empty($arr2)) {
                $datas =$arr2;
            }
        }
        return $datas;
    }

    public static function is_dealer_del($data,$UnionID) {
        $sql = 'select ID from jpd_organ where Identity=2 and (IsDelete !=1 or IsDelete is null) and IsBlack="0" and IsFreeze="0" and Status="1" and UnionID='.$UnionID;
        $result = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $result_data;
        if ($result) {
            $fuhe;
            foreach ($result as $key => $value) {
                $fuhe[$key] = $value['ID'];
            }
            if ($data) {
                foreach ($data as $keys => $values) {
                    if (in_array($values, $fuhe)) {
                        $result_data[$keys] = $values;
                    }
                }
            }
        }
        return $result_data;
    }

    public static function getdealermainchexi($id) {
        $sql = 'select distinct Make,Car from jpd_dealer_vehicles where OrganID="' . $id . '"';
        $result = Yii::app()->jpdb->createCommand($sql)->queryAll();
        if ($result) {
            $arr = '';
//            $first;
            foreach ($result as $key => $value) {
                if (empty($arr)) {
//                    $first = $value['Make'];
                    $arr.=$value['Make']; //.!empty($value['Car'])?$value['Car']:''.!empty($value['Year'])?$value['Year']:''.!empty($value['Model'])?$value['Model']:'';
                    if(!empty($value['Car'])){$arr.=' '.$value['Car'];}
                    } else {
                    $arr.='、' . $value['Make']; //.!empty($value['Car'])?$value['Car']:''.!empty($value['Year'])?$value['Year']:''.!empty($value['Model'])?$value['Model']:'';
                    if(!empty($value['Car'])){$arr.=' '.$value['Car'];}}
            }
            return '<div title="'.$arr.'" style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;width:150px;cursor:pointer">'.$arr.'</div>';
        } else {
            return '';
        }
    }

    public function outdelaerid($data) {
        $result;
        if ($data) {
            foreach ($data as $value) {
                $result[] = $value['OrganID'];
            }
        }
        return $result ? $result : '';
    }

    //创建一个空对象
    public static function getnull() {
        $criteria2 = new CDbCriteria();
        $criteria2->addCondition('1>2');
        $lists = new CActiveDataProvider('PapInquiry', array(
            'criteria' => $criteria2,
            'pagination' => array(
                'pageSize' => '10'
            ),
        ));
        return $lists;
    }

    //生成询价单编号
    public static function setinquirysn() {
        $organID = Yii::app()->user->getOrganID();
        return 'XJ' . time() . $organID . Yii::app()->user->id;
    }

    //撤销询价单
    public static function returninquiry($ID) {
        $sql = PapInquiry::model()->findByPK($ID);
        $result = 0;
        if ($sql->Status == 0 || $sql->Status == 1) {
            $result = PapInquiry::model()->updateByPK($ID, array('UpdateTime' => time(), 'Status' => 3));
        }
        return $result;
    }

    //
    public static function ifexitinquirysn($InquirySn) {
        $sql = 'select * from pap_inquiry where InquirySn=' . $InquirySn;
        $result = DBUtil::query($sql);
        return $result;
    }

    //获取pap插入数据的ID
    public static function getpaplastinsertid() {
        $id = Yii::app()->papdb->getLastInsertID();
        return $id;
    }

    //new PapInquiryCategory
    public static function newPapInquiryCategory($data) {
        $part = $data['part'];
        $inquiryID = $data['inquiryID'];
        foreach ($part as $val) {
            $partsinfo = new PapInquiryCategory();
            $info = explode(',', $val);
            $partsinfo->MainCategory = $info[0];
            $partsinfo->SubCategory = $info[1];
            $partsinfo->LeafCategory = $info[2];
            $partsinfo->Number = $info[3];
            $partsinfo->StandCode = $info[4];
            $partsinfo->InquiryID = $inquiryID;
            $partsinfo->save();
        }
    }

    //保存上传picture
    public static function savepic($data) {
        $inquiryid = $data['inquiryID'];
        foreach ($data['imgs'] as $key => $val) {
            $arr = new PapInquiryPicfile;
            $arr->PicName = $data['imgsname'][$key];
            $arr->PicPath = $val;
            $arr->InquiryID = $inquiryid;
            $arr->save();
        }
    }

    //创建询价单
    public static function saveinquiry($data) {
        $inquiry = new PapInquiry;
        $inquiry->attributes = $data;
        if ($inquiry->save()) {
            $arr = new InquiryorderService();
            $inquiryid = $arr->getpaplastinsertid();
            return $inquiryid;
        } else {
            return false;
        }
    }

    /*
     * 根据询价单id获取询价单信息
     */

    public static function getinquirybyid($inquiryid) {
        $user = Yii::app()->user->getOrganID();
        $sql = 'select * from pap_inquiry where InquiryID=' . $inquiryid;
        $result = Yii::app()->papdb->createCommand($sql)->queryRow();
        if ($result && $result['OrganID'] != $user) {
            throw new CHttpException(404, '没有权限查看');
            exit;
        }
        return $result;
    }

    public static function getinquiryimgs($inquiryid) {
        $sql = 'select * from pap_inquiry_picfile where InquiryID=' . $inquiryid;
        $result = Yii::app()->papdb->createCommand($sql)->queryAll();
        return $result;
    }

    //获取询价单发送方的信息
    public static function getinquirydealers($data) {
        $dealersID = $data['dealerids'];
        $dealersIDs = substr($dealersID, 1);
        $dealersIDs = substr($dealersIDs, 0, -1);
        $inquiry = $data['inquiryID'];
        $sql = "select * from jpd_organ where ID in ($dealersIDs)";
        $arr = Yii::app()->jpdb->createCommand($sql)->queryAll();
        return $arr;
    }

    /*
     * 根据inquiryID和dealerid获取报价单信息,只能有一条
     */

    public static function getinquirystatus($data) {
        $sql = "select * from pap_quotation where InquiryID=" . $data['inquiryID'] . " and DealerID=" . $data['dealerID'] . " and IfSend='2'";
        $result = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $result;
    }

    //pap 传sql语句，执行返回结果
    public static function excutesql($data) {
        if ($data['db'] == 'pap') {
            $result = Yii::app()->papdb->createCommand($data['sql'])->queryAll();
        } elseif ($data['db'] == 'jpd') {
            $result = Yii::app()->jpdb->createCommand($data['sql'])->queryAll();
        } elseif ($data['db'] == 'dsp') {
            $result = Yii::app()->dspdb->createCommand($data['sql'])->queryAll();
        }
        return $result;
    }

    //用二位数组生成dataprovider没有分页
    public static function dataprovider($data) {
        $dataProvider = new CArrayDataProvider($data, array(
        ));
        return $dataProvider;
    }

    //用二位数组生成dataprovider有分页
    public static function dataproviderpage($data) {
        $dataProvider = new CArrayDataProvider($data, array(
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
        return $dataProvider;
    }

    //修改报价单状态
    public static function exchangestatus($data) {
        $arr = PapQuotation::model()->updateByPK($data['quoID'], array('Status' => $data['status']));
        return $arr;
    }

    //修改方案状态
    public static function changeschstatus($data) {
        $arr = PapQuotationScheme::model()->updateByPK($data['SchID'], array('Status' => $data['status']));
        return $arr;
    }

    //根据id修改询价单状态
    public static function changeinquirystatus($id, $status) {
        PapInquiry::model()->updateByPK($id, array('Status' => $status));
    }

    //获取经销商的地址
    public static function getaddressid($id) {
        $sql = 'select * from jpd_receive_address where OrganID=' . $id;
        $address = Yii::app()->jpdb->createCommand($sql)->queryAll();
        return $address;
    }

    //显示地址
    public static function showaddress($data) {
        return Area::getaddress($data['State'], $data['City'], $data['District']) . $data['Address'];
    }

    //显示查看详情
    public static function showdetail($id) {
        return '<a href="' . Yii::app()->baseUrl . '/pap/inquiryorder/inquirydetail/inquiryID/' . $id . '">查看详情</a>';
    }

    // 生成订单
    public static function createorder($quoID, $schID, $payment, $address, $ordertype,$goodsids,$nums,$CouponSn) {
        $opration=array();//错误时执行操作
        $sql_findQuo = 'select * from pap_quotation where QuoID=' . $quoID;
        $Quoinfo = Yii::app()->papdb->createCommand($sql_findQuo)->queryRow();
        //获取方案对应的商品
        $sql_goods = 'select * from pap_quotation_goods where SchID=' . $schID.' and GoodsID in('.$goodsids.') ';
        $goodsinfo = self::excutesql(array('sql' => $sql_goods, 'db' => 'pap'));
        //获取经销商最小价格
        $min_price = PapOrderMinTurnover::model()->find('OrganID=:OrganID', array(':OrganID' => $Quoinfo['DealerID']));
        $min_price = $min_price['MinTurnover'];
        //获取经销商信息
        $sql_dealer = 'select ID,OrganName from jpd_organ where ID=' . $Quoinfo['DealerID'];
        $dealerinfo = Yii::app()->jpdb->createCommand($sql_dealer)->queryRow();
        //获取修理厂信息
        $find_lsm_orgname = 'select OrganName from jpd_organ where ID=' . $Quoinfo['ServiceID'];
        $serviceinfo = Yii::app()->jpdb->createCommand($find_lsm_orgname)->queryRow();
        //调用商城生成订单方法
        $carts = array();
        $carts['SellerID'] = $Quoinfo['DealerID'];
        $carts['BuyerID'] = $Quoinfo['ServiceID'];
        $carts['SellerName'] = $dealerinfo['OrganName'];
        $carts['BuyerName'] = $serviceinfo['OrganName'];
        $carts['MinTurnover'] = $min_price ? $min_price : '0';
        //获取经销商订单折扣率--询报价订单
        $dis=100;
        $discount = PapOrderDiscount::model()->find(array("condition" => " OrderType = 2"));
        if ($discount) {
            if ($payment == 1&&$discount['OrderAlipay']) {
                $dis = $discount['OrderAlipay'];
            } else if ($payment == 2&&$discount['OrderLogis']) {
                $dis = $discount['OrderLogis'];
            }else{
                $dis = 100;
            }
        } else {
            $dis = 100;
        }
        $carts['discount'] = $dis;
        $totalgoods;
        $nums=  explode(',', $nums);
        foreach ($goodsinfo as $kk => $value) {
            
           $goodsbyid= DealergoodsService::getmongoversion($value['GoodsID'] , $value['Version']);
           if ($goodsbyid) {
                $totalgoods[$kk] = array(
                    'BuyerID' => $Quoinfo['ServiceID'],
                    'BuyerName' => $serviceinfo['OrganName'],
                    'SellerID' => $dealerinfo['ID'],
                    'SellerName' => $dealerinfo['OrganName'],
                    "GoodsID" => $value['GoodsID'],
                    "GoodsNum" => $goodsbyid['GoodsInfo']['GoodsNO'],
                    "GoodsOE" => is_array($goodsbyid['GoodsInfo']['oeno']) ? implode(',', $goodsbyid['GoodsInfo']['oeno']) : (is_string($goodsbyid['GoodsInfo']['oeno'])?['GoodsInfo']['oeno']:''),
                    "GoodsName" => $goodsbyid['GoodsInfo']['Name'],
                    "CpName" => $goodsbyid['GoodsInfo']['StandCode'] ? self::getCpName($goodsbyid['GoodsInfo']['StandCode']) : '',
                    "Brand" => $goodsbyid['GoodsInfo']['Brand'],
                    "Price" => $goodsbyid['GoodsInfo']['Price'],
                    "ProPrice" => $value['Price'],
                    "Quantity" => $nums[$kk],
                    "ShipCost" => null,
                    "CreateTime" => time(),
                    "UpdateTime" => time(),
                    "Version" => $goodsbyid['Version']
                );
            }
        }
        $carts['GoodsList'] = $totalgoods;
        if ($ordertype == 2) {//如果是由询价单生成的订单
            //获取询价单信息
            $sql = 'select * from pap_inquiry where InquiryID=' . $Quoinfo['InquiryID'];
            $Inquiryinfo = Yii::app()->papdb->createCommand($sql)->queryRow();
            if (!$Inquiryinfo) {
                return json_encode(array('success' => false, 'message' => '确认失败，该询价单不存在'));
            }
            if ($Inquiryinfo['Status'] == 2) {
                return json_encode(array('success' => false, 'message' => '确认失败，该询价单已确认'));
            }
            if ($Inquiryinfo['Status'] == 3) {
                return json_encode(array('success' => false, 'message' => '确认失败，该询价单已撤销'));
            }
            // 修改询价单状态
            $updateinquiry = PapInquiry::model()->updateByPK($Quoinfo['InquiryID'], array('Status' => 2));
            if ($updateinquiry != 1) {
                return json_encode(array('success' => false, 'message' => '确认询价单失败', 'msg' => 'check inquiry fail', 'QuoID' => $quoID, 'data' => '确认询价单失败'));
            }else{//成功时插入return的SQL
                  $opration[1]='update pap_inquiry set Status=1 where InquiryID='.$Quoinfo['InquiryID'];
            }
        }
        //修改方案状态
        $updateschem = InquiryorderService::changeschstatus(array('status' => 2, 'SchID' => $schID));
        if ($updateschem != 1) {
            self::returnint($opration);
            return json_encode(array('success' => false, 'message' => '确认方案失败', 'msg' => 'check scheme fail', 'QuoID' => $quoID, 'data' => '确认方案失败'));
        }else{
            $opration[2]='update pap_quotation_scheme set Status="1" where SchID='.$schID;
        }
        // 修改报价单状态
        $discountdesc = QuotationService::getpriceratio($Quoinfo['DealerID'], $Quoinfo['ServiceID']);
        $updateQuo = PapQuotation::model()->updateByPK($quoID, array('Status' => '2', 'Discount' => $discountdesc['type'] . ',' . $discountdesc['discount']));
        if ($updateQuo != 1) {
            self::returnint($opration);
            return json_encode(array('success' => false, 'message' => '确认报价单失败', 'msg' => 'check quo scheme fail', 'QuoID' => $quoID, 'data' => '确认报价单方案失败'));
        }  else {
            $opration[3]='update pap_quotation set Status=1 where QuoID='.$quoID;
        }
        $adressinfo = self::getaddressbypk($address);
        $params = array(
            'payment' => $payment,
            'ship' => $adressinfo,
            'ordertype' => $ordertype,
            'cartsGoods' => array($carts)
        );
            //根据优惠券编号查询优惠券金额
        if($CouponSn){
            $copinfo=BuyGoodsService::couponbysn(array('couponsn'=>$CouponSn));
            if($copinfo){
                  $params['coupon']=$copinfo['Amount'];
                  $params['couponsn']=$copinfo['CouponSn'];
                  $params['usecouponID']=$copinfo['CouponID'];
            } 
        }
         //self::returnint($opration);
        $orderID = BuyGoodsService::createorder($params);
//        exit;
        $orderID = intval($orderID);
        //获取订单编号
        $sql_order = 'select OrderSN from pap_order where ID=' . $orderID;
        $res = Yii::app()->papdb->createCommand($sql_order)->queryRow();
        $order_sn = $res['OrderSN'];
        if (!$orderID) {
            self::returnint($opration);
            return json_encode(array('success' => false, 'message' => '生成订单失败', 'msg' => 'create order fail', 'QuoID' => $quoID, 'data' => '创建订单失败'));
        }
        //保存订单编号到询价单表
        if ($ordertype == 2) {
            PapInquiry::model()->updateByPK($Quoinfo['InquiryID'], array('OrderSn' => $order_sn,));
        }
        //保存订单ID到报价单表
        PapQuotation::model()->updateByPK($quoID, array('OrderID' => $orderID));
        //更改报价单待确认状态为已处理
        $sql = 'update pap_remind_business set HandleStatus=2 where HandleID=' . $quoID . ' and OrganID=' . $Quoinfo['ServiceID'];
        Yii::app()->papdb->createCommand($sql)->execute();
        return json_encode(array('success' => true, 'message' => '生成订单成功，点击跳转', 'msg' => 'carate order success', 'QuoID' => $quoID, 'data' => '创建订单成功', 'orderID' => $orderID, 'ordersn' => $order_sn));
    }
    
    //订单生成步奏错误时返回初始化
    public static function returnint($data){//$data为sql数组
        if(is_array($data) && !empty($data)){
            foreach ($data as $key){
              Yii::app()->papdb->createCommand($key)->execute();
            }
        }
    }

    //修改询价单
    public static function updateinquriy($data) {
        $arr = PapInquiry::model()->updateByPK($data['ID'], $data['data']);
        return $arr;
    }

    //删除图片
    public static function delimg($id) {
        $find = 'select PicPath from pap_inquiry_picfile where InquiryID=' . $id;
        $exit = Yii::app()->papdb->createCommand($find)->queryAll();
        if ($exit) {
            Yii::app()->papdb->createCommand()->delete('pap_inquiry_picfile', 'InquiryID=:id', array(
                ':id' => $id));
        }
    }

    //删除大类子类
    public static function delcate($id) {
        Yii::app()->papdb->createCommand()->delete('pap_inquiry_category', 'InquiryID=:id', array(
            ':id' => $id));
    }

    public static function getCpName($code) {
        $sql = 'select * from jpd_gcategory where Code="' . $code . '"';
        $result = self::excutesql(array('sql' => $sql, 'db' => 'jpd'));
        return $result[0]['Name'];
    }

    public static function getBrand($BrandID) {
        if($BrandID){
         $sql='select BrandName from pap_brand where ID='.$BrandID;
         $result=Yii::app()->papdb->creatCommand($sql)->queryRow();
        return $result['BrandName'];   
        }
    }

    public static function getaddressbypk($id) {
        $sql = 'select * from jpd_receive_address where ID=' . $id;
        $result = self::excutesql(array('sql' => $sql, 'db' => 'jpd'));
        return $result[0];
    }

    public static function getfrom($state) {
        if (empty($state)) {
            return '系统';
        } elseif ($state == 1) {
            return '客服';
        } else {
            return '其他';
        }
    }
    public static function addOverflow($string,$width=null){
        $style='text-overflow: ellipsis;overflow: hidden;white-space: nowrap;cursor:pointer;';
        if(!empty(intval($width))){
            $style.='width:'.intval($width).'px';
        }
        return  '<div style="'.$style.'" title="'.$string.'">'.$string.'</div>';
    }
    
    //推荐收益列表显示，勿删除
    public static function showIncomeDetail($id,$name){
        if($id && $name){
               $sql='select '.$name.' from jpd_organ where ID='.$id;
               $result=Yii::app()->jpdb->createCommand($sql)->queryRow();
               return $result[$name];
        }
    }
    //推荐收益列表姓名显示，勿删除
    public static function showIncomeName($RecomID,$Service){
        if(!empty($RecomID)){
            $sql='select Name from jpd_recommend_list where ID='.$RecomID;
            $result=Yii::app()->jpdb->createCommand($sql)->queryRow();
            return $result['Name'];
        }else{
             $sql='select OrganName from jpd_organ where ID='.$Service;
            $result=Yii::app()->jpdb->createCommand($sql)->queryRow();
            return $result['OrganName'];
        }
    }

}

?>
