<?php

/*
 * 服务店退货管理
 */

class BuyreturnController extends Controller {
    /*
     * 退货单列表
     */

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "退货/退款管理";
        $Status[0] = ReturnorderService::papreturnstatus('1,11'); //待审核
        $Status[1] = ReturnorderService::papreturnstatus('2'); //待发货
        $Status[2] = ReturnorderService::papreturnstatus('3,13'); //待收货
        $Status[3] = ReturnorderService::papreturnstatus('4,14'); //完成
        $Status[4] = ReturnorderService::papreturnstatus('5,12'); //未通过
        $Status[5] = ReturnorderService::papreturnstatus('6,16'); //取消
        //申诉状态
        $ComplainStatus[0] = ReturnorderService::papgetComplainStatus('3'); //已取消
        $this->render('index', array('data' => ReturnorderService::getRetorderlist(),
            'status' => $Status,
            'complainstatus' => $ComplainStatus
        ));
    }

    /*
     * 获取退货单详情
     */

    public function actionOrderinfo() {
        $this->pageTitle = Yii::app()->name . '-' . "退货单详情";
        $model = ReturnorderService::getorderinfo();
        if (!$model) {
            $this->redirect(array('index'));
        }
        $ID = Yii::app()->request->getParam('ID');
        $ReturnNO = PapReturnOrder::model()->findByPk($ID);
        $reuslt = self::getcomplaininfo($ReturnNO['ReturnNO']);
        if ($model->Type == 1) {
            $this->render('orderinfon', array('data' => $model, 'reuslt' => $reuslt));
        } elseif ($model->Type == 2) {
            $returnaddress = OrderService::getreturnship($ID);
            $this->render('orderinfo', array('data' => $model, 'reuslt' => $reuslt, 'returnaddress' => $returnaddress));
        }
    }

    /*
     * 获取申诉表信息
     */

    public function getcomplaininfo($ReturnNO) {
        $sql = "select * from pap_complain  where ReturnNO = '$ReturnNO'";
        $result = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $result;
    }

    /*
     * 获取退款单详情
     */

    public function actionOrderinfo2() {
        $this->pageTitle = Yii::app()->name . '-' . "退款单详情";
        $model = ReturnorderService::getorderinfo();
        if (!$model) {
            $this->redirect(array('index'));
        }
        $ID = Yii::app()->request->getParam('ID');
        $ReturnNO = PapReturnOrder::model()->findByPk($ID);
        $reuslt = self::getcomplaininfo($ReturnNO['ReturnNO']);
        if ($model->Type == 1) {
            $this->render('orderinfon2', array('data' => $model, 'reuslt' => $reuslt));
        } elseif ($model->Type == 2) {
            $returnaddress = OrderService::getreturnship($ID);
            $this->render('orderinfo2', array('data' => $model, 'reuslt' => $reuslt, 'returnaddress' => $returnaddress));
        }
    }

    /*
     * 重新申请退货
     */

    public function actionAgaginret() {
        $this->pageTitle = Yii::app()->name . '-' . "重新申请退货";
        $model = ReturnorderService::getorderinfo();
        $organID = Yii::app()->user->getOrganID();
        if ($_POST) {
            $ReturnOrderID = $_POST['ID'];   //ReturnOrder表ID   
            if (!$_POST['type'] || !$_POST['reason'] || !$ReturnOrderID) {
                $this->redirect(array('index'));
            }

            //更改未通过提醒状态为已操作
            RemindService::updateRemindStatus($ReturnOrderID, 4, $organID);
            //发送待审核提醒给经销商
            $params = array('OrganID' => $model['DealerID'], 'OrganType' => 2, 'HandleID' => $ReturnOrderID);
            $params['type'] = array('name' => 'THD', 'key' => 4);
            RemindService::sendRemind($params, $model);

            if ($_POST['type'] == 1) {
                //未收货订单 退货 不退款 'Price' => 0
                $returnNumber = PapReturnOrder::model()->findByPk($ReturnOrderID)->attributes;
                if ($returnNumber['ReturnNumber'] == 5) {  //第2次申请
                    $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 1, "ReturnNumber" => 2, 'Result' => $_POST['reason'], 'Price' => 0), "Status = 5");
                }
                if ($returnNumber['ReturnNumber'] == 10) {  //第3次申请
                    $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 1, "ReturnNumber" => 3, 'Result' => $_POST['reason'], 'Price' => 0), "Status = 5");
                }
                if ($edit < 0) {
                    echo json_encode(array('error' => '重新申请失败，请稍后再试!'));
                } else {
                    echo json_encode(array('success' => 1));
                }
            } else
            if ($model->Type == 2) {
                $returnNumber = PapReturnOrder::model()->findByPk($ReturnOrderID)->attributes;
                if ($returnNumber['ReturnNumber'] == 5) {   //第2次申请 把第1次审核未通过的5改为申请状态2
                    $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 1, "ReturnNumber" => 2, 'Result' => $_POST['reason'], 'Price' => $_POST['price']), "Status = 5");
                }
                if ($returnNumber['ReturnNumber'] == 10) {  //第3次申请 把第2次审核未通过的10改为申请状态3
                    $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 1, "ReturnNumber" => 3, 'Result' => $_POST['reason'], 'Price' => $_POST['price']), "Status = 5");
                }
                if ($edit) {
                    if ($_POST['id']) {
                        PapReturnGoods::model()->deleteAll("ID in ({$_POST['id']})");
                    }
                    if ($_POST['oid']) {
                        PapOrder::model()->updateAll(array('ReturnStatus' => 0), "ID in ({$_POST['oid']})");
                    }
                    $goodsArr = explode(',', $_POST['goods']);
                    foreach ($goodsArr as $v) {
                        $list = explode('-', $v);
                        PapReturnGoods::model()->updateByPk($list[0], array('Price' => $list[1], 'Amount' => $list[2]));
                    }
                    echo json_encode(array('success' => 1));
                } else {
                    echo json_encode(array('error' => '重新申请失败，请稍后再试!'));
                }
            }
            exit;
        }
        $this->render('againreturn', array('data' => $model));
    }

    /*
     * 重新申请退款
     */

    public function actionAgaginret2() {
        $this->pageTitle = Yii::app()->name . '-' . "重新申请退款";
        $model = ReturnorderService::getorderinfo();
        $organID = Yii::app()->user->getOrganID();
        if ($_POST) {
            $ReturnOrderID = $_POST['ID'];   //ReturnOrder表ID   
            if (!$_POST['type'] || !$_POST['reason'] || !$ReturnOrderID) {
                $this->redirect(array('index'));
            }

            //更改未通过提醒状态为已操作
            RemindService::updateRemindStatus($ReturnOrderID, 4, $organID);
            //发送待审核提醒给经销商
            $params = array('OrganID' => $model['DealerID'], 'OrganType' => 2, 'HandleID' => $ReturnOrderID);
            $params['type'] = array('name' => 'THD', 'key' => 4);
            RemindService::sendRemind($params, $model);

            if ($_POST['type'] == 1) {   //退款不执行此操作
                $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 1, 'Result' => $_POST['reason'], 'Price' => 0), "Status = 5");
                if ($edit < 0) {
                    echo json_encode(array('error' => '重新申请失败，请稍后再试!'));
                } else {
                    echo json_encode(array('success' => 1));
                }
            } else
            if ($model->Type == 2) {
                $returnNumber = PapReturnOrder::model()->findByPk($ReturnOrderID)->attributes;
                if ($returnNumber['ReturnNumber'] == 55) {  //第2次申请 把第一次审核未通过的55改为申请状态22
                    $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 11, "ReturnNumber" => 22, 'Result' => $_POST['reason'], 'Price' => $_POST['price']), "Status = 12");
                }
                if ($returnNumber['ReturnNumber'] == 65) {  //第3次申请 把第2次审核未通过的65改为申请状态33
                    $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 11, "ReturnNumber" => 33, 'Result' => $_POST['reason'], 'Price' => $_POST['price']), "Status = 12");
                }
                if ($edit) {
                    $goodsArr = explode(',', $_POST['goods']);
                    foreach ($goodsArr as $v) {
                        $list = explode('-', $v);
                        PapReturnGoods::model()->updateByPk($list[0], array('Price' => $list[1], 'Amount' => $list[2]));
                    }

                    echo json_encode(array('success' => 1));
                } else {
                    echo json_encode(array('error' => '重新申请失败，请稍后再试!'));
                }
            }
            exit;
        }
        $this->render('againreturn2', array('data' => $model));
    }

    /*
     * 确认收款（申请退款）
     */

    public function actionGetprice() {
        $model = ReturnorderService::getpassprice();
        echo json_encode($model);
    }

    /*
     * 退货单发货
     */

    public function actionSend() {
        $this->pageTitle = Yii::app()->name . '-' . "退货单发货";
        $model = ReturnorderService::getorderinfo();
        $organID = Yii::app()->user->getOrganID();
        if ($_POST) {
            $ReturnOrderID = $_POST['ID'];
//            if (!$_POST['ID'] || !$_POST['PN'] || !$ReturnID) {
//                $this->redirect(array('index'));
//            }
            $idArr = explode(',', $_POST['goodsid']);
            $pnArr = explode('-', $_POST['PN']);
//            $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 3, 'LogtigCompany' => $_POST['LogtigCompany'],
//                'ReShipLogis' => $_POST['ReShipLogis'], 'DeliveryTime' => time()), "Status = 2 and Type=2");
            $edit = PapReturnOrder::model()->updateByPk($ReturnOrderID, array("Status" => 3, 'LogtigCompany' => $_POST['LogtigCompany'],
                'ReShipLogis' => $_POST['ReShipLogis'], 'DeliveryTime' => time()), "Status = 2");

            //更改待发货提醒状态
            RemindService::updateRemindStatus($ReturnOrderID, 5, $organID);
            //提醒经销商待收货
            $params = array('OrganID' => $model['DealerID'], 'OrganType' => 2, 'HandleID' => $ReturnOrderID);
            $params['type'] = array('name' => 'THD', 'key' => 5);
            RemindService::sendRemind($params, $model);

            //把发货 填写的物流公司和运单号更新到paporder中退货物理公司
            $o = PapReturnGoods::model()->find('ReturnID=:returnID', array(':returnID' => $_POST['ID']));
            $orderID = PapOrder::model()->findByPk($o['OrderID']);
            $wuliu = PapOrder::model()->updateByPk($orderID['ID'], array('ReShipSn' => $_POST['LogtigCompany'], 'ReShipLogis' => $_POST['ReShipLogis']));

            if ($edit) {
                foreach ($idArr as $k => $v) {
                    PapReturnGoods::model()->updateByPk($v, array('PIN' => $pnArr[$k]));
                }
                echo json_encode(array('success' => 1));
            } else {
                echo json_encode(array('error' => '发货失败，请稍后再试!'));
            }
            exit;
        }

        $this->render('sendgoods', array('data' => $model));
    }

    public function ActionsendToApliay() {
        $returnID = Yii::app()->request->getParam('ID');
        $billno = Yii::app()->request->getParam('ReShipLogis');
        $logtigCompany = Yii::app()->request->getParam('LogtigCompany');
        $model = PapReturnOrder::model()->findByPk($returnID);
        $isAlipay = false;
        $alipayResult = false;
        $alipayError = "";
        $paymentMethod = $model['PayMethod'];
        if ($paymentMethod == '0') {
            $isAlipay = true;
            // 订单交易号是否存在
            if (!$model['AlipayTN']) {
                return array('error' => '订单支付信息错误');
                Yii::app()->end();
            }
            $payment = Yii::app()->returnalipay;
            // 确认收货请求参数
            $request = new AlipaySendConfirmRequest();
            $request->trade_no = $model->AlipayTN;
            $request->invoice_no = $billno;
            $request->logistics_name = $logtigCompany;
            $request->transport_type = "EXPRESS";
            $request->order_id = $returnID;
            //建立请求
            $html_text = $payment->buildRequestHttp($request);
            //解析XML
            //注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
            $doc = new DOMDocument();
            $doc->loadXML($html_text);
            if (!empty($doc->getElementsByTagName("alipay")->item(0)->nodeValue)) {
                $alipay = $doc->getElementsByTagName("alipay")->item(0);
                //echo $alipay->nodeValue;
                $is_success = $alipay->getElementsByTagName("is_success")->item(0)->nodeValue;
                if ($is_success == 'T') {
                    $alipayResult = true;
                } else {
                    $alipayResult = false;
                    $alipayError = $alipay->getElementsByTagName("error")->item(0)->nodeValue;
                }
            }
            // 记录日志
            $userId = Yii::app()->user->id;
            $payment->put_send_goods_log($model, $request->getParams(), $html_text, $alipayResult, $userId);
            if ($alipayResult) {

                //更改待发货提醒状态
                RemindService::updateRemindStatus($returnID, 5, $model['ServiceID']);
                //提醒经销商待收货
                $params = array('OrganID' => $model['DealerID'], 'OrganType' => 2, 'HandleID' => $returnID);
                $params['type'] = array('name' => 'THD', 'key' => 5);
                RemindService::sendRemind($params, $model);

                echo json_encode(array('success' => '1'));
            } else {
                echo json_encode(array('error' => '发货失败'));
            }
        }
    }

    /*
     * 取消退货
     */

    public function actionNoreturn() {
        if (!$_POST['ID']) {
            $this->redirect(array('index'));
        }
        $id = $_POST['ID']; //后台ajax post：ID
        $m = PapReturnOrder::model()->findByPk($id);
        if (!$m) {
            $this->redirect(array('index'));
        }
        $order = PapReturnGoods ::model()->findAll("ReturnID=$id");
        foreach ($order as $v) {
            //$v['OrderID'] 退货商品表PapReturnGoods的OrderID对应PapOrder的ID
            PapOrder::model()->updateByPk($v['OrderID'], array('ReturnStatus' => 0), 'ReturnStatus = 1');
        }

        $edit = PapReturnOrder::model()->updateByPk($id, array("Status" => 6), "Status = 1 or Status = 5");
        if ($edit > 0) {

            //更改待审核提醒状态为已操作
            RemindService::updateRemindStatus($id, 4, $m['ServiceID']);

            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('error' => '取消退货单失败，请稍后再试!'));
        }
    }

    /*
     * 取消退款
     */

    public function actionNoreturnprice() {
        if (!$_POST['ID']) {
            $this->redirect(array('index'));
        }
        $id = $_POST['ID']; //后台ajax post：ID
        $m = PapReturnOrder::model()->findByPk($id);
        if (!$m) {
            $this->redirect(array('index'));
        }
        $order = PapReturnGoods ::model()->findAll("ReturnID=$id");
        foreach ($order as $v) {
            //$v['OrderID'] 退货商品表PapReturnGoods的OrderID对应PapOrder的ID
            PapOrder::model()->updateByPk($v['OrderID'], array('ReturnStatus' => 0), 'ReturnStatus = 11');
        }

        $edit = PapReturnOrder::model()->updateByPk($id, array("Status" => 16), "Status = 11 or Status = 12");
        if ($edit > 0) {

            //更改待审核提醒状态为已操作
            RemindService::updateRemindStatus($id, 4, $m['ServiceID']);

            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('error' => '取消退货单失败，请稍后再试!'));
        }
    }

    /*
     * 申请退货 选择经销商
     */

    public function actionaddsecond() {
        $this->pageTitle = Yii::app()->name . '-' . "退货申请";
        if (Yii::app()->request->getParam('SellerName') && Yii::app()->request->getParam('SellerName') != '请输入经销商名称') {
            $SellerName = trim(Yii::app()->request->getParam('SellerName'));
        } else {
            $SellerName = '';
        }
        $dataProvider = ReturnorderService::getDelername2(array('SellerName' => $SellerName));
        $this->render('addsecond', array('dataProvider' => $dataProvider, 'SellerName' => $SellerName));
    }

    /*
     * 申请退款 选择经销商
     */

    public function actionaddsecond2() {
        $this->pageTitle = Yii::app()->name . '-' . "退款申请";
        if (Yii::app()->request->getParam('SellerName') && Yii::app()->request->getParam('SellerName') != '请输入经销商名称') {
            $SellerName = trim(Yii::app()->request->getParam('SellerName'));
        } else {
            $SellerName = '';
        }
        $dataProvider = ReturnorderService::getDelername2(array('SellerName' => $SellerName));
        $this->render('addsecond2', array('dataProvider' => $dataProvider, 'SellerName' => $SellerName));
    }

    /*
     * 申请退货页面 
     */

    public function actionaddreturn() {
        $this->pageTitle = Yii::app()->name . '-' . "申请退货";
        $deid = Yii::app()->request->getParam('id');
        $organID = Organ::model()->findByPk($deid);
        if (!isset($organID) && empty($organID)) {
            $this->redirect(array('addsecond'));
        }
        $model = ReturnorderService::getDealer();
        $Status = 9;
        if (Yii::app()->request->getParam('Title') && Yii::app()->request->getParam('Title') != '商品名称|商品编号|OE号|品牌|拼音代码') {
            $Title = trim(Yii::app()->request->getParam('Title'));
        } else {
            $Title = '';
        }

        if (Yii::app()->request->getParam('OrderSN') && Yii::app()->request->getParam('OrderSN') != '订单编号') {
            $OrderSN = trim(Yii::app()->request->getParam('OrderSN'));
        } else {
            $OrderSN = '';
        }

        if (Yii::app()->request->getParam('Vehicle') && Yii::app()->request->getParam('Vehicle') != '请选择适用车系') {
            $Vehicle = trim(Yii::app()->request->getParam('Vehicle'));
        } else {
            $Vehicle = '';
        }

        if (Yii::app()->request->getParam('start_time') && Yii::app()->request->getParam('start_time') != '') {
            $CreateTime = Yii::app()->request->getParam('start_time');
        }
        if (Yii::app()->request->getParam('end_time') && Yii::app()->request->getParam('end_time') != '') {
            $CreateTime = Yii::app()->request->getParam('end_time');
        }

        $this->render('addreturn', array(
            'data' => ReturnorderService::getRetordlist(array(
                'OrderSN' => $OrderSN,
                'Status' => $Status,
                'Vehicle' => $Vehicle,
                'Title' => $Title,
                'CreateTime' => $CreateTime)),
            'model' => $model,
            'Title' => $Title,
            'OrderSN' => $OrderSN,
            'deid' => $deid,
            'Vehicle' => $Vehicle,
            'Status' => $Status,
            'CreateTime' => $CreateTime
        ));
    }

    /*
     * 申请退款页面 
     */

    public function actionaddreturn2() {
        $this->pageTitle = Yii::app()->name . '-' . "申请退款";
        $deid = Yii::app()->request->getParam('id');
        $organID = Organ::model()->findByPk($deid);
        if (!isset($organID) && empty($organID)) {
            $this->redirect(array('addsecond2'));
        }
        $model = ReturnorderService::getDealer();
//        if (Yii::app()->request->getParam('SellerName')) {
//            $SellerName = Yii::app()->request->getParam('SellerName');
//        } else {
//            $SellerName = $model[0]->SellerName;
//        }
//        $orderstatus = Yii::app()->request->getParam('Status'); //得到订单状态
        $Status = 9;

        if (Yii::app()->request->getParam('Title') && Yii::app()->request->getParam('Title') != '商品名称|商品编号|OE号|品牌|拼音代码') {
            $Title = trim(Yii::app()->request->getParam('Title'));
        } else {
            $Title = '';
        }

        if (Yii::app()->request->getParam('OrderSN') && Yii::app()->request->getParam('OrderSN') != '订单编号') {
            $OrderSN = trim(Yii::app()->request->getParam('OrderSN'));
        } else {
            $OrderSN = '';
        }

        if (Yii::app()->request->getParam('Vehicle') && Yii::app()->request->getParam('Vehicle') != '') {
            $Vehicle = Yii::app()->request->getParam('Vehicle');
        } else {
            $Vehicle = '';
        }

        if (Yii::app()->request->getParam('start_time') && Yii::app()->request->getParam('start_time') != '') {
            $CreateTime = Yii::app()->request->getParam('start_time');
        }
        if (Yii::app()->request->getParam('end_time') && Yii::app()->request->getParam('end_time') != '') {
            $CreateTime = Yii::app()->request->getParam('end_time');
        }

        $this->render('addreturn2', array(
            'data' => ReturnorderService::getRetordlist(array(
                //   'SellerName' => $SellerName,
                'OrderSN' => $OrderSN,
                'Status' => $Status,
                'Vehicle' => $Vehicle,
                'Title' => $Title,
                'CreateTime' => $CreateTime)),
            'model' => $model,
            'Title' => $Title,
            'OrderSN' => $OrderSN,
            'Vehicle' => $Vehicle,
            'deid' => $deid,
            //    'SellerName' => $SellerName,
            'Status' => $Status,
            'CreateTime' => $CreateTime
        ));
    }

    /*
     * 订单 商品列表
     */

    public function actionReturngoods() {
        $this->pageTitle = Yii::app()->name . '-' . "申请退货";
        $model = ReturnorderService::Getordergoodlist();
        if (!$model) {
            $this->redirect(array('addreturn'));
        }
        $this->render('returngoods', array('model' => $model));
    }

    /*
     * 订单 商品列表 退款页面
     */

    public function actionReturngoods2() {
        $this->pageTitle = Yii::app()->name . '-' . "申请退款";
        $model = ReturnorderService::Getordergoodlist();
        if (!$model) {
            $this->redirect(array('addreturn2'));
        }
        $this->render('returngoods2', array('model' => $model));
    }

    /*
     * 提交申请 退货
     */

    public function actionAddreturnorder() {
        if (!$_POST['Goods']) {
            $this->redirect(array('index'));
        }
        $goodsArr = explode(',', $_POST['Goods']);
        $sql = 'insert into `pap_return_goods` values';
        $idStr = '(';
        foreach ($goodsArr as $v) {
            $g = explode('-', $v);
            $idStr.=$g[0] . ','; //(455,
            if (!$g[6]) {    //如果该商品版本就空
                $g[6] = 'NULL';
            }
            $sql.="(NULL,$g[0],$g[1],'ReturnID',$g[2],$g[3],$g[4],'',$g[5],$g[6]),";
        }
        $idStr = substr($idStr, 0, -1) . ')';
        $c = new CDbCriteria();
        $c->addCondition("ID in $idStr and ReturnStatus=0", 'AND');
        $m = PapOrder::model()->findAll($c);
        if (!$m) {
            echo json_encode(array('error' => '提交退货单失败，请先刷新订单列表!'));
            exit;
        }
        $organID = Yii::app()->user->getOrganID();
        $model = new PapReturnOrder();
        $model->ReturnNO = 'THD' . ReturnorderService::gen_order_sn();
        $model->DealerID = $m[0]['SellerID'];
        $model->ServiceID = $organID;
        $model->Status = 1; //待审核
        $model->CreateTime = time();
        $model->Price = $_POST['Price'];
        $model->LogtigCompany = '顺丰';
        $model->Result = $_POST['Reseaon'];
        $model->Type = $m[0]['Status'] == 9 ? 2 : 1;
        $model->ReturnNumber = 1;
        $model->save();
        if (!$model->save()) {
            echo json_encode(array('error' => '提交退货单失败，请稍后再试!'));
            exit;
        }
        $id = $model->attributes['ID'];
        $editSql = "update `pap_order` set ReturnStatus=1 where ID in $idStr";
        $sql = str_replace('ReturnID', $id, substr($sql, 0, -1));
//        echo $sql;
//        exit;
        $ins = Yii::app()->papdb->createCommand($sql)->execute();
        $edt = Yii::app()->papdb->createCommand($editSql)->execute();

        //更新待收货提醒状态
        RemindService::updateRemindStatus($idStr, 2, $organID);
        //发送待审核提醒给经销商
        $params = array('OrganID' => $model['DealerID'], 'OrganType' => 2, 'HandleID' => $id);
        $params['type'] = array('name' => 'THD', 'key' => 4);
        RemindService::sendRemind($params);

        if ($ins && $edt) {
            echo json_encode(array('success' => 1));
        }
    }

    /*
     * 提交申请 退款
     */

    public function actionAddreturnorder2() {
        $goodsArr = explode(',', $_POST['Goods']);
        $sql = 'insert into `pap_return_goods` values';
        $idStr = '(';
        foreach ($goodsArr as $v) {
            $g = explode('-', $v);
            $idStr.=$g[0] . ',';
            if (!$g[6]) {    //如果该商品版本就空
                $g[6] = 'NULL';
            }
            $sql.="(NULL,$g[0],$g[1],'ReturnID',$g[2],$g[3],$g[4],'',$g[5],$g[6]),";
        }
        $idStr = substr($idStr, 0, -1) . ')';
        $c = new CDbCriteria();
        $c->addCondition("ID in $idStr and ReturnStatus=0", 'AND');
        $m = PapOrder::model()->findAll($c);
        if (!$m) {
            echo json_encode(array('error' => '提交退款单失败，请先刷新订单列表!'));
            exit;
        }
        $model = new PapReturnOrder();
        $model->ReturnNO = 'THD' . ReturnorderService::gen_order_sn();
        $model->DealerID = $m[0]['SellerID'];
        $model->ServiceID = Commonmodel::getOrganID();
        $model->Status = 11; //退款待审核
        $model->CreateTime = time();
        $model->Price = $_POST['Price'];
        $model->LogtigCompany = '顺丰';
        $model->Result = $_POST['Reseaon'];
        $model->Type = $m[0]['Status'] == 9 ? 2 : 1;
        $model->ReturnNumber = 11;
        $model->save();
        if (!$model->save()) {
            echo json_encode(array('error' => '提交退货单失败，请稍后再试!'));
            exit;
        }
        $id = $model->attributes['ID'];
        $editSql = "update `pap_order` set ReturnStatus=11 where ID in $idStr";
        $sql = str_replace('ReturnID', $id, substr($sql, 0, -1));
        $ins = Yii::app()->papdb->createCommand($sql)->execute();
        $edt = Yii::app()->papdb->createCommand($editSql)->execute();

        //发送待审核提醒给经销商
        $params = array('OrganID' => $model['DealerID'], 'OrganType' => 2, 'HandleID' => $id);
        $params['type'] = array('name' => 'THD', 'key' => 4);
        RemindService::sendRemind($params);

        if ($ins && $edt) {
            echo json_encode(array('success' => 1));
        }
    }

    /*
     * 退货单申诉页面
     */

    public function actionComplain() {
        $this->pageTitle = Yii::app()->name . '-' . "修理厂提出退货申诉";
        $model = ReturnorderService::getorderinfo();
        if (!$model) {
            $this->redirect(array('index'));
        }
        $this->render('complain', array('data' => $model));
    }

    /*
     * 退货提交申诉
     */

    public function actionSubcomplain() {

        $DealerID = Yii::app()->request->getParam("DealerID");
        $ServiceID = Yii::app()->request->getParam("ServiceID");
        $ServiceName = Organ::model()->findByPk($ServiceID);

        $UserID = Yii::app()->user->ID;
        $ReturnNO = Yii::app()->request->getParam("ReturnNO");
        $ComplainText = Yii::app()->request->getParam("ComplainText");
        $goodsImages = Yii::app()->request->getParam("goodsImages");
        $AppealTime = time();
        $sql = "insert into pap_complain (ReturnNO,AppealTime,AppealerID,AppealRemark,AnnexUrl,HandleStatus) values ('$ReturnNO','$AppealTime','$UserID','$ComplainText','$goodsImages',1)";
        $insert = Yii::app()->papdb->createCommand($sql)->execute();

        $ssql = "update pap_return_order set ComplainStatus = 1 where ReturnNO = '$ReturnNO'";
        $update = Yii::app()->papdb->createCommand($ssql)->execute();
        if ($insert && $update) {
            //发送提醒给经销商
            $params['OrganID'] = $DealerID;
            $params['OrganType'] = 1;
            $params['Title'] = '退货申诉登记处理提醒';
            $params['Content'] = '您好，' . $ServiceName['OrganName'] . '向您提交了一条已申诉的退货单' . $ReturnNO . '。如有问题,请及时联系嘉配客服人员！';
            $params['UserID'] = $UserID;
            ReturnorderService::sendRemind($params);
//            $rs = array('success' => 1, 'errorMsg' => '申诉成功');
            echo json_encode(array('success' => 1));
        } else {
//            $rs = array('success' => 0, 'errorMsg' => '申诉失败');
            echo json_encode(array('success' => 0));
        }
//        $this->render("complainsuccess", array('result' => $rs));
    }

    /*
     * 退货取消申诉
     */

    public function actionNocomplain() {
        if (!$_POST['ID']) {
            $this->redirect(array('index'));
        }
        $id = $_POST['ID']; //后台ajax post：ID
        $sql = "select * from pap_return_order where ID='$id'";
        $select = Yii::app()->papdb->createCommand($sql)->queryRow();
        if (!$select) {
            $this->redirect(array('index'));
        }


        $sqlup = 'update pap_return_order set ComplainStatus = 0 where ReturnNO ="' . $select['ReturnNO'] . '"';
        $update = Yii::app()->papdb->createCommand($sqlup)->execute();

        $sqlupp = 'delete from pap_complain where ReturnNO ="' . $select['ReturnNO'] . '"';
        $complainupdate = Yii::app()->papdb->createCommand($sqlupp)->execute();

        if ($update > 0 && $complainupdate > 0) {
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('error' => '取消失败，请稍后再试!'));
        }
    }

    /*
     * 退货申诉删除图片
     */

    public function actionDelPto() {
        $imageid = Yii::app()->request->getParam("imageid");
        $ftp = new Ftp();
        $res = $ftp->delete_file($imageid);
        $ftp->close();
        echo json_encode($res);
    }

}

?>
