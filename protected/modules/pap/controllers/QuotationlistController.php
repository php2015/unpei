<?php

/*
 * 服务店收到的报价单
 */

class QuotationlistController extends Controller {

    //获取报价单列表
    public function actionIndex() {
        $params['status'] = Yii::app()->request->getParam('sta');
//        if (Yii::app()->request->isAjaxRequest) {
        $params['no'] = Yii::app()->request->getParam('no');
        $status = Yii::app()->request->getParam('status');
        if ($status !== null)
            $params['status'] = $status;
        $params['start'] = Yii::app()->request->getParam('start');
        $params['end'] = Yii::app()->request->getParam('end');
//        }
        //获取询价单列表
        $lists = QuotationlistService::getquolists($params);
        $this->render('index', array('lists' => $lists));
    }

    //查看报价单
    public function actionViewquo() {
        $params['quoid'] = Yii::app()->request->getParam('quoid');
        $sql = 'select * from pap_quotation where QuoID=' . $params['quoid'];
        $aps = InquiryorderService::excutesql(array('sql' => $sql, 'db' => 'pap'));
        if ($aps && $aps[0]['InquiryID'] > 0) {//获取询价单信息
            $inquiryorder_id = $aps[0]['InquiryID'];
            $inquiryinfo = RPCClient::call('InquiryorderService_getinquirybyid', $inquiryorder_id);
            $inquiryimgs = RPCClient::call('InquiryorderService_getinquiryimgs', $inquiryorder_id);
            $sql_files = 'select * from pap_inquiry_category where InquiryID=' . $inquiryorder_id;
            $categpry = Yii::app()->papdb->createCommand($sql_files)->queryAll();
            if (!empty($categpry)) {
                $datacate = new CArrayDataProvider($categpry, array(
                    'pagination' => array(
                        'pageSize' => count($categpry),
                    ),
                ));
            } else {
                $datacate = '';
            }
            $res;
            if ($inquiryinfo['Make']) {
                $paramas['Make'] = $inquiryinfo['Make'];
                $paramas['Car'] = $inquiryinfo['Car'];
                $paramas['Year'] = $inquiryinfo['Year'];
                $paramas['Model'] = $inquiryinfo['Model'];
                $res = InquiryService::getcarmodel($paramas);
            }
        }
        //获取地址
        $addr = InquiryorderService::getaddressid($aps[0]['ServiceID']);
        $address = InquiryorderService::dataproviderpage($addr);
        //获取经销商最小交易额
        $miniprice = 0;
        $sql_findmini = 'select MinTurnover from pap_order_min_turnover where OrganID=' . $aps[0]['DealerID'];
        $lms_results = InquiryorderService::excutesql(array('sql' => $sql_findmini, 'db' => 'pap'));
        if ($lms_results && $lms_results[0]['MinTurnover']) {
            $miniprice = $lms_results[0]['MinTurnover'];
        }
        //获取经销商信息
        $sql2 = 'select OrganName,Phone from jpd_organ where ID=' . $aps[0]['DealerID'];
        $dealer = InquiryorderService::excutesql(array('sql' => $sql2, 'db' => 'jpd'));
        $params['sid'] = Yii::app()->user->getOrganID();
        $params['type'] = 5;
        $result = QuotationService::getschemelists($params);
        $schinfo = $result['schinfo'];
        $quoinfo = $result['quoinfo'];
        $model = new JpdReceiveAddress();
        $discount;
        if ($aps) {
            $sql_finddiscount = 'select * from pap_order_discount where OrderType=2 '; //询报价折扣率一样
            $discount = InquiryorderService::excutesql(array('sql' => $sql_finddiscount, 'db' => 'pap'));
            if ($discount) {
                $discount[0]['OrderAlipay'] = $discount[0]['OrderAlipay'] ? $discount[0]['OrderAlipay'] . '%' : '';
                $discount[0]['OrderLogis'] = $discount[0]['OrderLogis'] ? $discount[0]['OrderLogis'] . '%' : '';
            }
        }
        //如果报价单已确认，查询订单ID
        $goodsdata;
        $sumtotal = 0;
        if (!empty($aps) && $aps[0]['OrderID']) {
            $sql_find_sum = 'select GoodsAmount from pap_order where ID=' . $aps[0]['OrderID'];
            $sum = Yii::app()->papdb->createCommand($sql_find_sum)->queryRow();
            $sumtotal = $sum['GoodsAmount'];
            $sql_find_goods = 'select * from pap_order_goods where OrderID=' . $aps[0]['OrderID'];
            $goodsinfo = Yii::app()->papdb->createCommand($sql_find_goods)->queryAll();
            $rearray;
            $partlevel = Yii::app()->getParams()->PartsLevel;
            $totals = 0;
            foreach ($goodsinfo as $key => $value) {
                //插入配件档次
                $pat_sql = 'select PartsLevel from pap_goods where ID=' . $value['GoodsID'];
                $final = Yii::app()->papdb->createCommand($pat_sql)->queryRow();
                $value['PL'] = $partlevel[$final['PartsLevel']];
                $value['GoodsOE'] = '<div style="width: 120px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" title="' . $value['GoodsOE'] . '" >' . $value['GoodsOE'] . '</div>'; //self::getmaxlength($value['GoodsOE'], 8, true);
                $value['rowNo'] = $key + 1;
                $value['GoodsName'] = '<div  href="javascript:void(0);" goodsid="' . $value['GoodsID'] . '"  orderid="' . $value['OrderID'] . '" version="' . $value['Version'] . '" class="quottion_goods_href" title="' . $value['GoodsName'] . '"  style="width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;cursor:pointer;">' . $value['GoodsName'] . '</div>';
                $value['GoodsNum'] = '<div   href="javascript:void(0);" goodsid="' . $value['GoodsID'] . '"  orderid="' . $value['OrderID'] . '" version="' . $value['Version'] . '" class="quottion_goods_href"  title="' . $value['GoodsNum'] . '" style="width: 80px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;cursor:pointer;">' . $value['GoodsNum'] . '</div>';
                $rearray[$key] = $value;
            }
            $goodsdata = new CArrayDataProvider($rearray, array(
                'pagination' => array(
                    'pageSize' => count($rearray),
                ),
            ));
        }
        $this->render('quodetails', array(
            'inquiryinfo' => $inquiryinfo,
            'res' => $res,
            'imsgs' => $inquiryimgs,
            'category' => $datacate ? $datacate : '',
            'dealer' => $dealer ? $dealer : array(),
            'schinfo' => $schinfo,
            'quoinfo' => $quoinfo,
            'address' => $address,
            'model' => $model,
            'discount' => $discount ? $discount[0] : $discount,
            'mini' => $miniprice,
            'goodsdata' => $goodsdata ? $goodsdata : '',
            'sumtotal' => $sumtotal
        ));
    }

    public function actionSurequotation() {
        if (Yii::app()->request->isAjaxRequest) {
            $quoID = Yii::app()->request->getParam('quoID');
            $address = Yii::app()->request->getParam('addressID');
            $payment = Yii::app()->request->getParam('payment');
            $schID = Yii::app()->request->getParam('SchID');
            $goodsids = Yii::app()->request->getParam('goodsid');
            $nums = Yii::app()->request->getParam('num');
            $CouponSn=Yii::app()->request->getParam('CouponSn');
            if ($quoID && $address && $payment && $schID) {
                $sql_inquiry = 'select InquiryID from pap_quotation where QuoID=' . $quoID;
                $result_inquiry = Yii::app()->papdb->createCommand($sql_inquiry)->queryRow();
//              InquiryorderService::createorder(报价单ID，方案ID，支付方式，地址ID，'类型')
                if ($result_inquiry && $result_inquiry['InquiryID'] > 0) {
                    $ordertype = 2;
                } else {
                    $ordertype = 3;
                }
                $result = InquiryorderService::createorder($quoID, $schID, $payment, $address, $ordertype, $goodsids, $nums,$CouponSn);
                echo $result;
            }
        }
    }

    public static function getmaxlength($string, $length, $title) {
        if ($string) {
            if (strlen($string) > $length && $length) {
                $str = mb_substr($string, 0, $length, 'utf-8'); //substr($string, 0,$length);
                $str.='…';
                if ($title) {
                    $string = '<a title="' . $string . '">' . $str . '</a>';
                } else {
                    $string = $str;
                }
            } else {
                if ($title) {
                    $string = '<a title="' . $string . '">' . $string . '</a>';
                }
            }
        }
        return $string;
    }

    public function actionGetaction() {
        $html='';
        $order_decr=0;
        $cop_amout=Yii::app()->request->getParam(cop_amout);
        $organID = Yii::app()->user->getOrganID();
        $data = BuyGoodsService::activeorgan();
//        var_dump($data);die;
        $params = array();
        if (in_array($organID, $data)) {
            $act = BuyGoodsService::active();
            if (!empty($act) && is_array($act)) {
                   $payment=$act['Payment'];
                $params['PromoID'] = intval($act['ID']);
                $params['TotalAmount'] = Yii::app()->request->getParam('amount');
                switch ($act['Type']) {
                    case 1:
                        //满多少减多少
                        $act_res = BuyGoodsService::decre($params);
                        if (!empty($act_res) && is_array($act_res)) {
                            if(!empty($act_res['DecrAmount'])){
                            $html= "<span style='color:red'>优惠:-￥" . $act_res['DecrAmount'] . "(单笔订单满 ￥" . $act_res['MinAmount'] . " 减￥" . $act_res['DecrAmount'] . ")</span>";
                            }else{
                               $html=''; 
                            }
                            
                            }
                        $order_decr = $act_res['DecrAmount'];
                        break;
                    case 2:
                        //每满减
                        $act_res = BuyGoodsService::pperdecre($params);
                        $order_decr = $act_res['DecrTotal'];
                        if(!empty($act_res['DecrAmount'])){
                        $html= "<span style='color:red'>优惠:-" . $act_res['DecrTotal'] . "(单笔订单每满 ￥" . $act_res['MinAmount'] . " 减￥" . $act_res['DecrAmount'] . ")</span>";
                        }
                        break;
                    case 3:
                        //优惠券
                        $params['search'] = 'search';
                        $res = BuyGoodsService::mycoupon();
                        $act_res = BuyGoodsService::coupondecre($params);
                        $coupon = $res->getData();
                        $html="";// "<span style='color:red'>单笔订单满" . $act_res['MinAmount'] . "元,系统将赠送您价值" . $act_res['DecrAmount'] . "元优惠券" . $act_res['Num'] . "张</span><br>";
                        if($cop_amout){
                             $html.='<span style="color:red">使用优惠券:-￥'.floatval($cop_amout);
                        }elseif (!empty($coupon) && is_array($coupon)) {
                            $html.= "<span class='cup' style='color:red'><span class='payper' style='color:blue'>使用我的优惠券</span>(您可以使用优惠券，减免订单金额,每次只限一张)</span>";
                        }
                        break;
                }
            }
        } 
                    echo json_encode(array('html'=>$html,'order_decr'=>$order_decr,'payment'=>  isset($payment)?($payment-1):'1'));
    }

}

?>
