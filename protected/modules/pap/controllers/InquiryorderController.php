<?php

class InquiryorderController extends Controller {

//询价单列表
    public function actionIndex() {
        $arr = $_GET;
        $data = RPCClient::call('InquiryorderService_inquirylistdata', array('arrt' => $arr));
        $this->render('index', $data);
    }

    //撤销询价单
    public function actionReturninquiry() {
        if (Yii::app()->request->isAjaxRequest) {
            $inquiryID = Yii::app()->request->getParam('InquiryID');
            $result = RPCClient::call('InquiryorderService_returninquiry', $inquiryID);
            echo $result;
        }
    }

//新建询价单
    public function actionInquiryadd() {
        $get_param=$_GET;
        $params = array();
        if (Yii::app()->request->isAjaxRequest) {
            $params['kword'] = Yii::app()->request->getParam('kword');
            $params['epc_make'] = Yii::app()->request->getParam('epc_make');
            $params['epc_make'] = $params['epc_make'] == '请选择厂家' ? '' : $params['epc_make'];
            $params['epc_model'] = Yii::app()->request->getParam('epc_model');
            $params['epc_model'] = $params['epc_model'] == '请选择车型' ? '' : $params['epc_model'];
            $params['epc_series'] = Yii::app()->request->getParam('epc_series');
            $params['epc_series'] = $params['epc_series'] == '请选择车系' ? '' : $params['epc_series'];
            $params['epc_year'] = Yii::app()->request->getParam('epc_year');
            $params['epc_year'] = $params['epc_year'] == '请选择年款' ? '' : $params['epc_year'];
        }
        $sql_uninid = 'select UnionID from jpd_organ where ID=' . Yii::app()->user->getOrganID();
        $union_result = Yii::app()->jpdb->createCommand($sql_uninid)->queryRow();
        if (!$union_result['UnionID']) {
            $data['dataProvider'] = InquiryorderService::getnull();
        } else {
            $data = RPCClient::call('InquiryorderService_getdealerlist', $params);
        }
        $lists = RPCClient::call('InquiryorderService_getnull');
        $this->render('inquiryadd', array('data' => $data['dataProvider'], 'lists' => $lists,'get_param'=>$get_param));
    }

    //修改询价单
    public function actionEditinquiry() {
        $id = Yii::app()->request->getParam('inquiryID');
        if (!empty($id)) {
            $sql = 'select * from pap_inquiry where InquiryID=' . $id;
            $exit = InquiryorderService::excutesql(array('sql' => $sql, 'db' => 'pap'));
            if ($exit && $exit[0]['Status'] == 0) {
                $sql_category = 'select *  from pap_inquiry_category where InquiryID=' . $id;
                $category = InquiryorderService::excutesql(array('sql' => $sql_category, 'db' => 'pap'));
                $sql_picfile = 'select *  from pap_inquiry_picfile where InquiryID=' . $id;
                $picfile = InquiryorderService::excutesql(array('sql' => $sql_picfile, 'db' => 'pap'));
                $date = array();
                $lists = InquiryorderService::dataprovider($date);
                $params = array();
                if (Yii::app()->request->isAjaxRequest) {
                    $params['kword'] = Yii::app()->request->getParam('kword');
                    $params['epc_make'] = Yii::app()->request->getParam('epc_make');
                    $params['epc_make'] = $params['epc_make'] == '请选择厂家' ? '' : $params['epc_make'];
                    $params['epc_model'] = Yii::app()->request->getParam('epc_model');
                    $params['epc_model'] = $params['epc_model'] == '请选择车型' ? '' : $params['epc_model'];
                    $params['epc_series'] = Yii::app()->request->getParam('epc_series');
                    $params['epc_series'] = $params['epc_series'] == '请选择车系' ? '' : $params['epc_series'];
                    $params['epc_year'] = Yii::app()->request->getParam('epc_year');
                    $params['epc_year'] = $params['epc_year'] == '请选择年款' ? '' : $params['epc_year'];
                }
                $sql_uninid = 'select UnionID from jpd_organ where ID=' . Yii::app()->user->getOrganID();
                $union_result = Yii::app()->jpdb->createCommand($sql_uninid)->queryRow();
                if (!$union_result['UnionID']) {
                    $data['dataProvider'] = InquiryorderService::getnull();
                } else {
                    $data = RPCClient::call('InquiryorderService_getdealerlist', $params);
                }
                if ($category) {
                    foreach ($category as $key => $value) {
                        $sql_findexit = 'select ID,ParentID from jpd_gcategory where Name="' . $value['LeafCategory'] . '" and Code="' . $value['StandCode'] . '" order by ID desc';
                        $result = InquiryorderService::excutesql(array('sql' => $sql_findexit, 'db' => 'jpd'));
                        if (count($result) == 1 && $result[0]) {
                            $category[$key]['cpid'] = $result[0]['ID'];
                        } else if (count($result) > 1) {
                            foreach ($result as $vvv) {
                                $sql_execute = 'select Name from jpd_gcategory where ID=' . $vvv['ParentID'];
                                $execute_result = Yii::app()->jpdb->createCommand($sql_execute)->queryRow();
                                if ($execute_result && $execute_result['Name'] == $value['SubCategory']) {
                                    $category[$key]['cpid'] = $vvv['ID'];
                                }
                            }
                        }
                    }
                }
                $this->render('inquiryedit', array(
                    'category' => $category[0] ? json_encode($category) : '',
                    'inquiryinfo' => $exit,
                    'imges' => $picfile[0] ? json_encode($picfile) : '',
                    'lists' => $lists,
                    'data' => $data['dataProvider'],
                    'inquiryID' => $id
                ));
            } else {
                $this->redirect('index');
            }
        }
    }

//修改后保存询价单
    public function actionUpdateinquiry() {
        $ID = Yii::app()->request->getParam('inquiryID');
        $epc = Yii::app()->request->getParam('epc');
        $type = Yii::app()->request->getParam('Type');

        if ($ID) {
            $status_lms = 'select Status,DealerID from pap_inquiry where InquiryID=' . $ID;
            $ares = InquiryorderService::excutesql(array('sql' => $status_lms, 'db' => 'pap'));
            if (!$ares || $ares[0]['Status'] != 0) {
                echo json_encode(array('success' => false, 'message' => '修改失败'));
                exit;
            }
            $inquiry['Make'] = $epc['make'];
            $inquiry['Car'] = !empty($epc['series'])?$epc['series']:'0';
            $inquiry['Year'] = !empty($epc['year'])?$epc['year']:'0';
            $inquiry['Model'] = !empty($epc['model'])?$epc['model']:'0';
            if (empty($inquiry['Make'])) {
                $inquiry['Make'] = '0';
                $inquiry['Car'] = '0';
                $inquiry['Year'] = '0';
                $inquiry['Model'] ='0';
            }
            $vin = Yii::app()->request->getParam('VIN');
            $inquiry['VIN'] = $vin == '请输入VIN码' ? '' : $vin;
            $inquiry['Describe'] = Yii::app()->request->getParam('Describe');
            $inquiry['UpdateTime'] = time();
            $inquiry['DealerID'] = Yii::app()->request->getParam('DealerID');
            $inquiry['OrganID'] = Yii::app()->user->getOrganID();
            $results = InquiryorderService::updateinquriy(array('ID' => $ID, 'data' => $inquiry));
            if ($results == 1) {
                $sql_find_img = 'select ID from pap_inquiry_picfile where InquiryID=' . $ID;
                $arrr = InquiryorderService::excutesql(array('sql' => $sql_find_img, 'db' => 'pap'));
                if ($arrr) {
                    InquiryorderService::delimg($ID);
                }
                $sql_find_cate = 'select ID from pap_inquiry_category where InquiryID=' . $ID;
                $arrs = InquiryorderService::excutesql(array('sql' => $sql_find_cate, 'db' => 'pap'));
                if ($arrs) {
                    InquiryorderService::delcate($ID);
                }
                $picfiles = Yii::app()->request->getParam('inquiryImages');
                if ($picfiles) {
                    $picfilesname = Yii::app()->request->getParam('inquiryImagesname');
                    $params = array(
                        'inquiryID' => $ID,
                        'imgs' => $picfiles,
                        'imgsname' => $picfilesname
                    );
                    //保存上传图片
                    RPCClient::call('InquiryorderService_savepic', $params);
                }
                $aps = Yii::app()->request->getParam('parts');
                if ($aps) {
                    $categorydata = array(
                        'part' => $aps,
                        'inquiryID' => $ID
                    );
                    //保存配件信息
                    RPCClient::call('InquiryorderService_newPapInquiryCategory', $categorydata);
                }
                if ($inquiry['DealerID'] != $ares[0]['DealerID']) {
                    $dealerID = trim($inquiry['DealerID'], ',');
                    //删除报业务提醒对象
                    $delete = 'delete from pap_remind_business where HandleID=' . $ID . ' and OrganID=' . $dealerID;
                    Yii::app()->papdb->createCommand($delete)->execute();
                    //询价单制作成功发送消息通知经销商
                    $params = array('OrganID' => $dealerID, 'OrganType' => 2, 'HandleID' => $ID);
                    $params['type'] = array('name' => 'XJD', 'key' => 3);
                    RemindService::sendRemind($params);
                }
                echo json_encode(array('success' => true, 'message' => '修改成功，点击跳转'));
            } else {
                echo json_encode(array('success' => false, 'message' => '修改失败'));
            }
        }
    }

    //保存询价单
    public function actionSaveinquiry() {
        $type = Yii::app()->request->getParam('Type');
        $epc = Yii::app()->request->getParam('epc');
        $inquiry = array();
        //生成询价单编号
        $inquiry['InquirySn'] = RPCClient::call('InquiryorderService_setinquirysn');
        $inquiry['Make'] = $epc['make'];
          $inquiry['Car'] = !empty($epc['series'])?$epc['series']:'0';
            $inquiry['Year'] = !empty($epc['year'])?$epc['year']:'0';
            $inquiry['Model'] = !empty($epc['model'])?$epc['model']:'0';
            if (empty($inquiry['Make'])) {
                $inquiry['Make'] = '0';
                $inquiry['Car'] = '0';
            $inquiry['Year'] = '0';
            $inquiry['Model'] = '0';
        }
        $vin = Yii::app()->request->getParam('VIN');
        $inquiry['VIN'] = $vin == '请输入VIN码' ? '' : $vin;
        $inquiry['Describe'] = Yii::app()->request->getParam('Describe');
        $inquiry['CreateTime'] = time();
        $inquiry['DealerID'] = Yii::app()->request->getParam('DealerID');
        $inquiry['OrganID'] = Yii::app()->user->getOrganID();
        //InquirySn是否存在
        $ser = RPCClient::call('InquiryorderService_ifexitinquirysn', $inquiry['InquirySn']);
        if (!empty($ser)) {
            echo json_encode(array('success' => false, 'message' => '发送失败'));
        } else {
            //保存询价单返回inquiryid
            $saveinquiry = RPCClient::call('InquiryorderService_saveinquiry', $inquiry);
            if (!empty($saveinquiry)) {
                $picfiles = Yii::app()->request->getParam('inquiryImages');
                if ($picfiles) {
                    $picfilesname = Yii::app()->request->getParam('inquiryImagesname');
                    $params = array(
                        'inquiryID' => $saveinquiry,
                        'imgs' => $picfiles,
                        'imgsname' => $picfilesname
                    );
                    //保存上传图片
                    RPCClient::call('InquiryorderService_savepic', $params);
                }
                $aps = Yii::app()->request->getParam('parts');
                if ($aps) {
                    $categorydata = array(
                        'part' => $aps,
                        'inquiryID' => $saveinquiry
                    );
                    //保存配件信息
                    RPCClient::call('InquiryorderService_newPapInquiryCategory', $categorydata);
                }
                //询价单制作成功发送消息通知经销商
                $params = array('OrganID' => trim($inquiry['DealerID'], ','), 'OrganType' => 2, 'HandleID' => $saveinquiry);
                $params['type'] = array('name' => 'XJD', 'key' => 3);
                RemindService::sendRemind($params);
                echo json_encode(array('success' => true, 'message' => '发送成功'));
            }
        }
    }

    //询价单报价页面
    public function actionInquirydetail() {
        $inquiryid = Yii::app()->request->getParam('inquiryID');
        if (!$inquiryid) {
            throw new CHttpException('404');
        }
        //获取询价单信息
        $inquiryinfo = RPCClient::call('InquiryorderService_getinquirybyid', $inquiryid);
        if (!$inquiryinfo) {
            throw new CHttpException('404', '没有该询价单');
        }
        //获取发送经销商信息
        $dealerID = str_replace(',', '', $inquiryinfo['DealerID']);
        $sql_senddealer = 'select * from jpd_organ where ID=' . $dealerID;
        $delaer_info = InquiryorderService::excutesql(array('sql' => $sql_senddealer, 'db' => 'jpd'));
        //获取附件信息
        $inquiryimgs = RPCClient::call('InquiryorderService_getinquiryimgs', $inquiryid);
        //获取配件信息
        $sql = 'select * from pap_inquiry_category where InquiryID=' . $inquiryid;
        $categpry = InquiryorderService::excutesql(array('sql' => $sql, 'db' => 'pap'));
        if (!empty($categpry)) {
            $datacate = new CArrayDataProvider($categpry, array(
                'pagination' => array(
                    'pageSize' => count($categpry),
                ),
            ));
        } else {
            $datacate = '';
        }
        $prams = array(
            'inquiryID' => $inquiryid,
            'dealerids' => $inquiryinfo['DealerID']
        );
        $res;
        if ($inquiryinfo['Make']) {
            $paramas['Make'] = $inquiryinfo['Make'];
            $paramas['Car'] = $inquiryinfo['Car'];
            $paramas['Year'] = $inquiryinfo['Year'];
            $paramas['Model'] = $inquiryinfo['Model'];
            $res = InquiryService::getcarmodel($paramas);
        }
        //获取报价单信息
        $sql_findquo = 'select * from pap_quotation where InquiryID=' . $inquiryid . ' and IfSend="2"';
        $ars = InquiryorderService::excutesql(array('sql' => $sql_findquo, 'db' => 'pap'));
        $schinfo = '';
        $discount;
        if (!empty($ars)) {
            $schparams['quoid'] = $ars[0]['QuoID'];
            $schparams['type'] = 6;
            $schparams['sid'] = Yii::app()->user->getOrganID();
            $schinfo = QuotationService::getschemelists($schparams);
            //获取经销商最小交易额
            $miniprice = 0;
            $sql_findmini = 'select MinTurnover from pap_order_min_turnover where OrganID=' . $ars[0]['DealerID'];
            $lms_results = InquiryorderService::excutesql(array('sql' => $sql_findmini, 'db' => 'pap'));
            if ($lms_results && $lms_results[0]['MinTurnover']) {
                $miniprice = $lms_results[0]['MinTurnover'];
            }
            //获取经销商的折扣率
            $sql_finddiscount = 'select * from pap_order_discount where OrderType=2 ';
            $discount = InquiryorderService::excutesql(array('sql' => $sql_finddiscount, 'db' => 'pap'));
            if ($discount) {
                $discount[0]['OrderAlipay'] = $discount[0]['OrderAlipay'] ? $discount[0]['OrderAlipay'] . '%' : '';
                $discount[0]['OrderLogis'] = $discount[0]['OrderLogis'] ? $discount[0]['OrderLogis'] . '%' : '';
            }
        }
        //如果报价单已确认，查询订单ID
        $goodsdata;
        $sumtotal = 0;
        if (!empty($ars) && $ars[0]['OrderID']) {
            $sql_find_sum = 'select GoodsAmount from pap_order where ID=' . $ars[0]['OrderID'];
            $sum = Yii::app()->papdb->createCommand($sql_find_sum)->queryRow();
            $sumtotal = $sum['GoodsAmount'];
            $sql_find_goods = 'select * from pap_order_goods where OrderID=' . $ars[0]['OrderID'];
            $goodsinfo = Yii::app()->papdb->createCommand($sql_find_goods)->queryAll();
            $rearray = array();
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
        //己方地址
        $address = RPCClient::call('InquiryorderService_getaddressid', Yii::app()->user->getOrganID());
        $addressprovider = RPCClient::call('InquiryorderService_dataproviderpage', $address);
        $model = new JpdReceiveAddress();
        $this->render('inquirydetail', array(
            'inquiryinfo' => $inquiryinfo,
            'res' => $res,
            'imsgs' => $inquiryimgs,
            'category' => $datacate ? $datacate : '',
            'schinfo' => $schinfo ? $schinfo['schinfo'] : $schinfo,
            'model' => $model,
            'quoinfo' => $ars ? $ars[0] : $ars,
            'address' => $addressprovider,
            'discount' => $discount ? $discount[0] : $discount,
            'mini' => $miniprice,
            'goodsdata' => $goodsdata ? $goodsdata : '',
            'sumtotal' => $sumtotal,
            'dealer_info' => $delaer_info ? $delaer_info[0] : ''
        ));
    }

    //拒绝报价单
    public function actionDeletequotation() {
        if (Yii::app()->request->isAjaxRequest) {
            $Quoid = Yii::app()->request->getParam('quoID');
            $inquiryID = Yii::app()->request->getParam('InquiryID');
            $result = RPCClient::call('InquiryorderService_exchangestatus', array('status' => 4, 'quoID' => $Quoid));
            // 修改询价单状态
            InquiryorderService::changeinquirystatus($inquiryID, '4');
            if ($result == 1) {
                //更改报价单待确认状态为已处理
                $organID = Yii::app()->user->getOrganID();
                $sql = 'update pap_remind_business set HandleStatus=2 where HandleID=' . $Quoid . ' and OrganID=' . $organID;
                Yii::app()->papdb->createCommand($sql)->execute();
                echo json_encode(array('success' => true, 'message' => '已拒绝'));
            } else {
                echo json_encode(array('success' => false, 'message' => '修改失败'));
            }
        }
    }

    //确认报价单
    public function actionSurequotation() {
        if (Yii::app()->request->isAjaxRequest) {
            $quoID = Yii::app()->request->getParam('quoID');
            $address = Yii::app()->request->getParam('addressID');
            $payment = Yii::app()->request->getParam('payment');
            $schID = Yii::app()->request->getParam('SchID');
            $goodsids= Yii::app()->request->getParam('goodsid');
            $nums= Yii::app()->request->getParam('num');
            $CouponSn=Yii::app()->request->getParam('CouponSn');
            if ($quoID && $address && $payment && $schID) {
                //InquiryorderService::createorder(报价单ID，方案ID，支付方式，地址ID，'类型')
                $ordertype = 2;
                $result = InquiryorderService::createorder($quoID, $schID, $payment, $address, $ordertype,$goodsids,$nums,$CouponSn);
                echo $result;
            } else {
                
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

}

?>
