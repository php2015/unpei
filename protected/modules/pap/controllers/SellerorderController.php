<?php

class SellerorderController extends Controller {

    //首页
    public function actionIndex() {
        $payment = Yii::app()->request->getParam('Payment');
        $buyerName = trim(Yii::app()->request->getParam('BuyerName'));
        $status = Yii::app()->request->getParam('Status');
        $evastatus = Yii::app()->request->getParam('EvaStatus');
        $search = trim(Yii::app()->request->getParam('search_text'));
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['type'] = Yii::app()->request->getParam('type');
        if ($buyerName) {
            $params['BuyerName'] = $buyerName;
        }
        if ($search && $search != '请输入订单号') {
            $params['search_text'] = $search;
        }
        if (Yii::app()->request->getParam('search') == 'zk') {
            $params['search'] = 'zk';
        }
        //支付方式
        $typeArr = $this->getPayment();
        if ($payment && array_key_exists($payment, $typeArr)) {
            $params['Payment'] = $payment;
        }
        //订单状态
        $statusArr = $this->getStatus();
        if ($status && array_key_exists($status, $statusArr)) {
            $params['Status'] = $status;
        }
        //评价状态
        if ($evastatus && in_array($evastatus, array(1, 2))) {
            $params['EvaStatus'] = $evastatus;
        }
        //订单列表
        $params['pageSize'] = 5;
        $data = SellerorderService::getOrderList($params);
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search);
        $get['BuyerName'] = EvaluateService::changeKey($buyerName);
        unset($get['OrganID'], $get['pageSize']);
        $countRes = SellerorderService::getOrderCount($params['OrganID']);
        $count = array(0, 0, 0, 0, 0);
        foreach ($countRes as $v) {
            switch ($v['Status']) {
                case '1':$count[1] = $v['count'];
                    break;
                case '2':$count[2] = $v['count'];
                    break;
                case '3':$count[3] = $v['count'];
                    break;
                //   case '9':$count[9]=$v['count'];break;
            }
        }
        $countRes2 = SellerorderService::getOrderCount($params['OrganID'], 'eval');
        $count[4] = count($countRes2);
        $this->pageTitle = Yii::app()->name . ' - ' . "已卖出的商品";
        $this->render("index", array('data' => $data, 'params' => $get,
            'type' => $typeArr, 'status' => $statusArr, 'count' => $count
        ));
    }

    //参数方法
    protected function getParams($params) {
        $arr = array();
        foreach ($params as $k => $v) {
            if ($v) {
                $arr[$k] = $v;
            }
        }
        return $arr;
    }

    private function getPayment() {
        return array(1 => '支付宝担保', 2 => '物流代收款');
    }

    private function getStatus() {
        return array(1 => '待付款', 2 => '待发货', 3 => '待收货', 5 => '已拒收', 9 => '已收货', 10 => '已取消');
    }

    //订单详情页
    public function actionDetail() {
        $ID = Yii::app()->request->getParam('ID');
        $data = SellerorderService::getOrderDetail($ID);
        if (!$data) {
            $this->redirect(array('index'));
        }
        //var_dump($data);exit;
        $this->pageTitle = Yii::app()->name . ' - ' . "订单详情";
        $this->render('detail', array('data' => $data));
    }

    //ajax获取订单
    public function actionGetOrder() {
        $ID = Yii::app()->request->getParam('ID');
        $data = PapOrder::model()->findByPk($ID)->attributes;
        if (!$data) {
            echo json_encode(array('error' => 1));
        } else {
            $data['CreateTime'] = date('Y-m-d H:i:s', $data['CreateTime']);
            if ($data['Payment'] == 1) {
                $data['text'] = "（支付保担保），等待买家付款";
            } else {
                $data['text'] = "（物流代收款），请您点击订单详情确认";
            }
            $data['PayTime'] = $data['PayTime'] ? date('Y-m-d H:i:s', $data['PayTime']) : '';
            $data['ConfirmTime'] = $data['ConfirmTime'] ? date('Y-m-d H:i:s', $data['ConfirmTime']) : '';
            $data['DeliveryTime'] = $data['DeliveryTime'] ? date('Y-m-d H:i:s', $data['DeliveryTime']) : '';
            $data['ShipLogis'] = $data['ShipLogis'] ? $data['ShipLogis'] : '无';
            $data['ReceiptTime'] = $data['ReceiptTime'] ? date('Y-m-d H:i:s', $data['ReceiptTime']) : '';
            $data['UpdateTime'] = $data['UpdateTime'] ? date('Y-m-d H:i:s', $data['UpdateTime']) : '';
            echo json_encode($data);
        }
    }

    //订单发货列表
    public function actionSend() {
        if ($_POST['sendstr']) {
            $ID = Yii::app()->request->getParam('sendstr');
            $res = SellerorderService::checkSendID(explode(',', $ID));
            echo json_encode($res);
            exit;
        }
        $shipping = trim(Yii::app()->request->getParam('BuyerName'));
        $status = Yii::app()->request->getParam('Status');
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $search_text = trim(Yii::app()->request->getParam('search_text'));

        //$params['type'] = Yii::app()->request->getParam('type');
        if ($shipping) {
            $params['BuyerName'] = $shipping;
        }

        $statusArr = $this->getStatus();
        unset($statusArr[3], $statusArr[9]);
        if ($status && array_key_exists($status, $statusArr)) {
            $params['Status'] = $status;
        }
        $params['Status'] = 2;
        $params['type'] = 2;  //只显示待发货订单

        $params['SendStatus'] = 1;
        if ($search_text) {
            $params['search_text'] = $search_text;
        }
        $params['pageSize'] = 6;
        $data = SellerorderService::getOrderList($params);
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search_text);
        $get['BuyerName'] = EvaluateService::changeKey($shipping);
        $count1 = PapOrder::model()->count("SellerID={$params['OrganID']} and status=1 and Payment=1 and IsDelete=0");
        $sql = "SELECT count(distinct po.ID) as count FROM `pap_order` po right join pap_order_goods pog on 
                po.ID=pog.OrderID where SellerID={$params['OrganID']} and Status=2 and po.IsDelete=0";
        $model = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        $count2 = $model[0]['count'];
        $this->pageTitle = Yii::app()->name . ' - ' . "发货管理";
        $this->render("send", array('data' => $data, 'get' => $get,
            'status' => $statusArr, 'count1' => $count1, 'count2' => $count2
        ));
    }

    //订单发货
    public function actionSendorder() {
        $OrganID = Yii::app()->user->getOrganID();
        if ($_POST['sendstr']) {
            $ID = explode(',', Yii::app()->request->getParam('sendstr'));
            $data = SellerorderService::getSendOrder(array('ID' => $ID, 'OrganID' => $OrganID));
            if (!$data->getData()) {
                $this->redirect(array('send'));
            }
            $logCompany = Logistics::model()->findAll();
            $ShipLogis = PapOrder::model()->findByPk($ID[0], array('select' => 'ShipLogis'))->attributes['ShipLogis'];
            $address = SellerorderService::getSendAddress($ID[0]);
            $this->pageTitle = Yii::app()->name . ' - ' . "订单发货";
            $this->render('sendorder', array('data' => $data, 'ID' => $ID, 'logCompany' => $logCompany,
                'ShipLogis' => $ShipLogis, 'address' => $address));
        } else if ($_POST['id']) {
            $ID = Yii::app()->request->getParam('id');
            $res = SellerorderService::sendOrder($_POST, $ID, $OrganID);
            echo json_encode($res);
            exit;
        } else {
            $this->redirect(array('send'));
        }
    }

    //发货订单修改
    public function actionEditSendOrder() {
        $ID = Yii::app()->request->getParam('order');
        if ($_POST['ID'] && $_POST['ShipLogis']) {
            $res = SellerorderService::editSendOrder($_POST);
            echo json_encode($res);
            exit;
        }
        $cond = "t.Status=3 and t.ReturnStatus=0"; // and (ISNULL(t.ShipSn) or t.ShipSn='')
        $data = SellerorderService::getOrderDetail($ID, $cond);
        if (!$data) {
            $this->redirect(array('index'));
        }
        $logCompany = Logistics::model()->findAll();
        $this->pageTitle = Yii::app()->name . ' - ' . "订单发货编辑";
        $this->render('sendedit', array('data' => $data, 'ID' => $ID, 'logCompany' => $logCompany));
    }

    //订单改价
    public function actionChangeOrder() {
        $ID = Yii::app()->request->getParam('order');
        if ($_POST['idArr'] && $_POST['priceArr'] && $_POST['ID']) {
            $res = SellerorderService::changeOrder($_POST);
            echo json_encode($res);
            exit;
        }
        $cond = "((t.Payment=1 and t.Status=1 and ISNULL(t.AlipayTN)) or (t.Payment=2 and t.Status=2))";
        $data = SellerorderService::getOrderDetail($ID, $cond);
        if (!$data) {
            $this->redirect(array('index'));
        }
        $data['BuyerName'] = $data->BuyerName;
        if (!$data['BuyerName']) {
            $data['BuyerName'] = Organ::model()->findByPk($data->BuyerID, array('select' => 'OrganName'))->attributes['OrganName'];
        }
        $this->pageTitle = Yii::app()->name . ' - ' . "订单改价";
        $this->render('changeorder', array('data' => $data, 'ID' => $ID));
    }

    /*
     * 经销商评价修理厂
     */

    public function actionPapeva() {
        $evarr = array();
        $evarr = EvaluateService::getevainfo(3);
        $this->pageTitle = Yii::app()->name . '-' . "添加评价";
        $OrderID = Yii::app()->request->getParam('order'); //订单ID  传递前台(input)
        if ($OrderID) {
            $Status = $_GET['Status'];  //订单状态 
            $BuyerID = $_GET['BuyerID'];  //买家ID 
            $EvaStatus = $_GET['EvaStatus']; //评价状态
            $this->render('papeva', array('OrderID' => $OrderID, 'Status' => $Status, 'EvaStatus' => $EvaStatus, 'BuyerID' => $BuyerID, 'evarr' => $evarr));
            exit;
        } else {
            $Status = $_POST['Status'];
            $BuyerID = $_POST['BuyerID'];
            $OrderID = $_POST['evalOrderID'];
            $EvaStatus = $_POST['EvaStatus'] ? $_POST['EvaStatus'] : null;
            $OrganID = Commonmodel::getOrganID();
            $Message = Yii::app()->request->getParam('Evaluations');
//            var_dump($Message);die;
            $evaID = Yii::app()->request->getParam('evaID');
            if (isset($_POST)) {
                $addsql = "insert into pap_evaluation_organ (Identity,OrganID,Recier,JudgeID,OrderID,Score,Message,CreateTime) values ";
                $keytop = 1;
                foreach ($evaID as $ekeys => $evalue) {
                    if ($keytop != 1) {
                        $addsql .=",";
                    }
                    $addsql .="(";
                    $addsql .=3;
                    $addsql .=",";
                    $addsql .=$OrganID;
                    $addsql .=",";
                    $addsql .=$BuyerID;
                    $addsql .=",";
                    $addsql .=$ekeys;
                    $addsql .=",";
                    $addsql .=$OrderID;
                    $addsql .=",";
                    $addsql .=$evalue;
                    $addsql .=",'";
                    $addsql .=htmlspecialchars($Message);
                    $addsql .="',";
                    $addsql .=time();
                    $addsql .=")";
                    $keytop = 2;
//                    EvaluateService::addjudgerecord($ekeys, $evalue, $BuyerID, 3, $OrderID);
                }
                $bool = Yii::app()->papdb->createCommand($addsql)->execute();

                if ($bool) {
                    //获取被评价机构分数
                    $organScore = "select Recier,Score,OrderID from pap_evaluation_organ where OrganID=$OrganID and OrderID=" . $OrderID;
                    $bool2 = Yii::app()->papdb->createCommand($organScore)->queryAll();
                    $sum = 0;
                    foreach ($bool2 as $v) {
                        $sum+=$v['Score'];
                    }
                    //获取被评价的机构信用等级
                    $organGrade = "select Grade from jpd_organ where ID=" . $bool2[0]['Recier'];
                    $bool3 = Yii::app()->jpdb->createCommand($organGrade)->queryRow();

                    //更新被评价的机构信用等级
                    $sum2 = $sum + $bool3['Grade'];
                    $Gradesum = "update jpd_organ set Grade = $sum2 where ID=" . $bool2[0]['Recier'];
                    $bool4 = Yii::app()->jpdb->createCommand($Gradesum)->execute();

                    if ($Status == 9 && $EvaStatus == null) {
                        $EvaStatus = 16; //如果该订单经销商先评价，把状态改为16
                    } else if ($Status == 9 && $EvaStatus == 15) {
                        $EvaStatus = 20; //如果该订单之前服务店评价过一次，则经销商此时评价状态改为20
                    }
                    $bool2 = PapOrder::model()->updateByPK($OrderID, array('EvaStatus' => $EvaStatus));
                    $rs = array('success' => 1, 'errorMsg' => '评价成功');
                } else {
                    $rs = array('success' => 0, 'errorMsg' => '评价失败');
                }
            }
        }
        $this->render("evaresult", array('result' => $rs));
    }

    //订单交易统计
    public function actionSellCount() {
        $payment = Yii::app()->request->getParam('Payment');
        $status = Yii::app()->request->getParam('Status');
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if (trim($search_text && $search_text) != '') {
            $params['search_text'] = $search_text;
        }
        //支付方式
        $typeArr = $this->getPayment();
        if ($payment && array_key_exists($payment, $typeArr)) {
            $params['Payment'] = $payment;
        }
        //订单状态
        $statusArr = $this->getStatus();
        if ($status && array_key_exists($status, $statusArr)) {
            $params['Status'] = $status;
        }
        //订单列表
        $params['pageSize'] = 15;
        $res = SellerorderService::getSellOrderList($params);
        $data = $res['dataProvider'];
        $count = $res['count'];
        $total = $res['total'];
        // var_dump($data);exit;
        $get = self::getParams($params);
        $this->pageTitle = Yii::app()->name . ' - ' . "订单交易统计";
        $this->render('sellcount', array('orderlist' => $data, 'params' => $get, 'count' => $count,
            'type' => $typeArr, 'status' => $statusArr, 'total' => $total));
    }

    //订单交易导出
    public function actionSellCountExport() {
        $payment = Yii::app()->request->getParam('Payment');
        $status = Yii::app()->request->getParam('Status');
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if (trim($search_text && $search_text) != '') {
            $params['search_text'] = $search_text;
        }
        //支付方式
        $typeArr = $this->getPayment();
        if ($payment && array_key_exists($payment, $typeArr)) {
            $params['Payment'] = $payment;
        }
        //订单状态
        $statusArr = $this->getStatus();
        if ($status && array_key_exists($status, $statusArr)) {
            $params['Status'] = $status;
        }
        //订单列表
        $params['pageSize'] = 15;
        SellerorderService::SellCountExport($params);
    }

    //商品销售统计
    public function actionSellGoods() {
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if ($search_text && $search_text != '商品名称或商品编号') {
            $params['search_text'] = $search_text;
        }
        //订单列表
        $params['pageSize'] = 10;
        $data = SellerorderService::getSellGoodsList($params);
        $get = self::getParams($params);
        $this->pageTitle = Yii::app()->name . ' - ' . "商品销售统计";
        $this->render('sellgoods', array('goodslist' => $data, 'params' => $get));
    }

    //商品销售导出
    public function actionSellGoodsExport() {
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if ($search_text && $search_text != '商品名称/商品编号') {
            $params['search_text'] = $search_text;
        }
        $params['pageSize'] = 10;
        SellerorderService::SellGoodsExport($params);
    }

    //客户购买统计
    public function actionSellCustom() {
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if (trim($search_text && $search_text) != '') {
            $params['search_text'] = $search_text;
        }
        //订单列表
        $params['pageSize'] = 10;
        $data = SellerorderService::getSellCustomList($params);
        $get = self::getParams($params);
        $this->pageTitle = Yii::app()->name . ' - ' . "客户购买统计";
        $this->render('sellcustom', array('goodslist' => $data, 'params' => $get));
    }

    //客户购买导出
    public function actionSellCustomExport() {
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if ($search_text && $search_text != '商品名称/商品编号') {
            $params['search_text'] = $search_text;
        }
        $params['pageSize'] = 10;
        SellerorderService::SellCustomExport($params);
    }

    //订单打印
    public function actionOrderexport() {
        $model = PapOrder::model()->findByPk($_GET['ID']);
        //订单信息
        $data['SellerID'] = $model->SellerID;
        $data['BuyerID'] = $model->BuyerID;
        $data['CreateTime'] = date("Y-m-d H:i:s", $model->CreateTime);
        $data['OrderSN'] = $model->OrderSN;
        $data['SellerName'] = $model->SellerName;
        $data['BuyerName'] = $model->BuyerName;
        $data['GoodsList'] = "商品清单";
        $data['TotalAmount'] = "￥" . $model->TotalAmount;
        $data['ShipSn'] = $model->ShipSn;
        $data['ShipLogis'] = $model->ShipLogis;
        $data['ReShipSn'] = $model->ReShipSn;
        $data['ReShipLogis'] = $model->ReShipLogis;
        $data['ListShip'] = $model->ShipCost;
        $data['PayTime'] = $model->PayTime ? date("Y-m-d H:i:s", $model->PayTime) : '';
        $data['DeliveryTime'] = $model->DeliveryTime ? date("Y-m-d H:i:s", $model->DeliveryTime) : '';
        $data['ReceiptTime'] = $model->ReceiptTime ? date("Y-m-d H:i:s", $model->ReceiptTime) : '';
        if ($model->Payment == '1') {
            $data['Payment'] = "支付宝担保交易";
        } elseif ($model->Payment == '2') {
            $data['Payment'] = "物流代收款";
        }
        $data['Status'] = $model->Status;
        $data['IsUnusual'] = $model->IsUnusual;
        //获取收货地址
//        $ship = JporderService::getShip($model->ID);
        $ship = PapOrderAddress::model()->find("OrderID=:ID", array(":ID" => $model->ID))->attributes;
        $data['Consignee'] = $ship['ShippingName'] ? $ship['ShippingName'] : '';
        $data['Mobile'] = $ship['Mobile'] ? $ship['Mobile'] : '';
        $data['Phone'] = $ship['TelePhone'] ? $ship['TelePhone'] : '';
        $data['Delivery'] = Area::getCity($ship['Province']) . Area::getCity($ship['City']) . Area::getCity($ship['Area']) . $ship['Address'];
        $data['ZipCode'] = $ship['ZipCode'] ? $ship['ZipCode'] : '';
        //获取卖方基本信息
        $seller = $this->getSeller($model->SellerID);
        $data['OrganName'] = $seller['organName'];
        $data['ContactPhone'] = $seller['Phone'];
        $data['QQ'] = $seller['QQ'];
        $data['Address'] = Area::getCity($seller['province']) . Area::getCity($seller['city']) . Area::getCity($seller['area']);
        $model1 = PapOrderGoods::model()->findAll("OrderID=:ID", array(":ID" => $model->ID));
        foreach ($model1 as $key => $value) {
            $data['goods'][$key]['ID'] = $value['ID'];
            $data['goods'][$key]['CreateTime'] = F::msubstr(date("Y-m-d", $value['CreateTime']));
            $data['goods'][$key]['GoodsNum'] = F::msubstr($value['GoodsNum']);
            $data['goods'][$key]['GoodsOE'] = F::msubstr($value['GoodsOE']);
            $data['goods'][$key]['GoodsName'] = F::msubstr($value['GoodsName']);
            $data['goods'][$key]['Brand'] = F::msubstr($value['Brand']);
            $data['goods'][$key]['Price'] = $value['Price'];
            $data['goods'][$key]['editPrice'] = ($value['ProPrice'] ? $value['ProPrice'] : $value['Price']);
            $data['goods'][$key]['ShipCost'] = $value['ShipCost'];
            $data['goods'][$key]['Quantity'] = $value['Quantity'];
            $data['goods'][$key]['PN'] = $value['PN'];
            $data['goods'][$key]['ReQuantity'] = $value['ReQuantity'];
            $data['goods'][$key]['GoodsAmount'] = "￥" . $value['GoodsAmount'];
        }
        $this->renderPartial('orderexport', array('row' => $data));
    }

    /*
     * 获取卖家基本信息
     */

    public function getSeller($id) {
        $criteria = new CDbCriteria();
        $criteria->select = "OrganName,Phone,QQ,province,city,area";
        $criteria->addCondition("ID = $id");
        $model = Organ::model()->find($criteria)->attributes;
        return $model;
    }

    private static function accountCond() {
        $starttime = strtotime(Yii::app()->request->getParam('year') . '-' . Yii::app()->request->getParam('mouth')) ?
                strtotime(Yii::app()->request->getParam('year') . '-' . Yii::app()->request->getParam('mouth')) : '';
        $params['payment'] = Yii::app()->request->getParam('payment');
        $params['OrganID'] = Yii::app()->user->getOrganID();
        if (!$starttime) {
            $endtime = time();
            $dmonth = date('m', $endtime);
            $dyear = date('Y', $endtime);
            if ($dmonth <= 1) {
                $uyear = $dyear - 1;
                $umonth = 12;
            } else {
                $uyear = $dyear;
                $umonth = $dmonth - 1;
            }
        } else {
            $starttime = $starttime > time() ? time() : $starttime;
            $umonth = date('m', $starttime);
            $uyear = date('Y', $starttime);
            if ($umonth >= 12) {
                $dyear = $uyear + 1;
                $dmonth = 1;
            } else {
                $dyear = $uyear;
                $dmonth = $umonth + 1;
            }
        }
        $params['uyear'] = $uyear;
        $params['umonth'] = $umonth;
        $params['starttime'] = strtotime("$uyear-$umonth-01");
        $params['endtime'] = strtotime("$dyear-$dmonth-01");
        if (in_array(Yii::app()->request->getParam('type'), array(1, 2))) {
            $params['type'] = Yii::app()->request->getParam('type');
        }
        return $params;
    }

    //月度对账单
    public function actionAccount() {
        $params = self::accountCond();
//        $order = SelleraccountService::getOrder($params);
//        $return = SelleraccountService::getReturn($params);
        //'order' => $order, 'return' => $return,
        $model = SelleraccountService::getAccount($params);
        $this->pageTitle = Yii::app()->name . ' - ' . "平台对账单";
        $this->render('account', array('model' => $model, 'payment' => $params['payment'],
            'year' => $params['uyear'], 'month' => $params['umonth'], 'type' => $params['type']));
    }

    //下载对账单为excel
    public function actionExportAccount() {
        $params = self::accountCond();
        SelleraccountService::exportAccount($params);
    }

    //打印对账单
    public function actionPrintAccount() {
        $params = self::accountCond();
        $data = SelleraccountService::printAccount($params);
        if (empty($data['order']['data']) && empty($data['return']['data'])) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script>alert('没有该月的对账单');window.location.href='" . Yii::app()->createUrl('pap/sellerorder/account') . "'</script>";
            exit;
        }
        $organ = Organ::model()->findByPk($params['OrganID'], array('select' => 'OrganName'))->attributes;
        $params['OrganName'] = $organ['OrganName'];
        $this->renderPartial('accountprint', array('order' => $data['order'], 'return' => $data['return'], 'params' => $params));
    }

    //发送邮件
    public function actionSendAccount() {
        $params = self::accountCond();
        echo SelleraccountService::sendAccount($params);
    }

    //php生成pdf文件
    public function actionCreateAccount() {
        $params = self::accountCond();
        $select1 = "OrderSN as No,CreateTime,Payment,BuyerID,RealPrice as Price,BuyerName";
        $select2 = "ReturnNO as No,CreateTime,PayMethod as Payment,ServiceID as BuyerID,Price";
        if ($params['type'] == 1) {
            $seaCon1 = "select $select1 from pap_order t where t.Status=9";
            $seaCon1.= " and SellerID = {$params['OrganID']} and IsDelete = 0";
            $seaCon1.=" and t.CreateTime>={$params['starttime']} and t.CreateTime<{$params['endtime']}";
            $seaCon1.=" order by CreateTime DESC";
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
            $count1 = Yii::app()->papdb->createCommand(str_replace($select1, 'sum(RealPrice)', $seaCon1))->queryScalar();
        } else if ($params['type'] == 2) {
            $seaCon2 = "select $select2 from pap_return_order t where t.Status in(4,14)";
            $seaCon2.= " and DealerID = {$params['OrganID']}";
            $seaCon2.=" and t.CreateTime>={$params['starttime']} and t.CreateTime<{$params['endtime']}";
            $seaCon2.=" order by CreateTime DESC";
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
            $count2 = Yii::app()->papdb->createCommand(str_replace($select2, 'sum(Price)', $seaCon2))->queryScalar();
        } else {
            $seaCon1 = "select $select1 from pap_order t where t.Status=9";
            $seaCon1.= " and SellerID = {$params['OrganID']} and IsDelete = 0";
            $seaCon1.=" and t.CreateTime>={$params['starttime']} and t.CreateTime<{$params['endtime']}";
            $seaCon1.=" order by CreateTime DESC";
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
            $count1 = Yii::app()->papdb->createCommand(str_replace($select1, 'sum(RealPrice)', $seaCon1))->queryScalar();
            $seaCon2 = "select $select2 from pap_return_order t where t.Status in(4,14)";
            $seaCon2.= " and DealerID = {$params['OrganID']}";
            $seaCon2.=" and t.CreateTime>={$params['starttime']} and t.CreateTime<{$params['endtime']}";
            $seaCon2.=" order by CreateTime DESC";
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
            $count2 = Yii::app()->papdb->createCommand(str_replace($select2, 'sum(Price)', $seaCon2))->queryScalar();
        }
        $count1 = $count1 ? $count1 : 0;
        $count2 = $count2 ? $count2 : 0;
        $gain = $count1 - $count2;
        $day = date('t', $params['starttime']);
        $organ = Organ::model()->findByPk($params['OrganID'], array('select' => 'OrganName'))->attributes;

        $html = '<div style="height:24px; line-height:24px; background-color:#1f76c8">
                <div style="margin:0 auto; text-align:center">
                <span style="font-family:微软雅黑; font-size:24px; color:#fff; word-spacing:8px; letter-spacing: 1.5px;">' . $params['uyear'] . '年' . $params['umonth'] . '月对账单</span>
                </div>
            </div>
            <div style="font-size:16px; color:#343434; line-height:16px">
                <p style="margin:0px; ">亲爱的' . $organ['OrganName'] . '，您好！</p>
                <p style="margin:0px; ">感谢您使用由你配平台，以下是您' . $params['umonth'] . '月的平台交易明细：</p>
            </div>
            <div style="height:20px; line-height:18px; border-bottom:2px solid #c9c7c7; border-top:2px solid #c9c7c7; background-color:#f2f2f2; padding:0 30px">
                <div style="font-size:16px; font-weight:bold; color:#565656; line-height:18px;float:left">
                    本月净收益： <span style="color:#1f76c8">' . $gain . '</span> 元
                </div>
                <div style="font-size:16px; line-height:18px;float:right">
                    <p style="margin:0px; line-height:15px">
                    	本月总收入： <span style="color:#1f76c8;font-size:14px">' . $count1 . '</span>元
                       	&nbsp;&nbsp;
                       	本月总支出： <span style="color:#1f76c8;font-size:14px">' . $count2 . '</span>元</p>
                    <p style="margin:0px; line-height:15px">
                    	账单周期：' . $params['uyear'] . '年' . $params['umonth'] . '月01日—' . $params['uyear'] . '年' . $params['umonth'] . '月' . $day . '日
                    </p>
        </div>
        </div>';

        Yii::import('application.extensions.tcpdf.*');
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // 设置文档信息   
        $pdf->SetCreator('--');
        $pdf->SetAuthor('北京嘉配科技有限公司');
        $pdf->SetTitle('由你配 - 对账单');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, PHP');

        // 设置页眉和页脚信恿  
        $pdf->SetHeaderData('', 30, '', '', array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // 设置页眉和页脚字使  
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // 设置默认等宽字体   
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // 设置间距   
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // 设置分页   
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // 设置字体
        $pdf->SetFont('stsongstdlight', '', 14, true);

        // 添加页面
        $pdf->AddPage();


        // Image example with resizing
        $pdf->Image(F::themeUrl() . '/images/jpd/logo_account.jpg', 20, 28, 30, 18, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);

        // 设置字体阴影
        //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        // 输出HTML内容
        $pdf->writeHTML($html, true, false, true, false, '');

        if (!empty($data1)) {
            $html = '<p style="color:#1f76c8">订单明细:</p>';
            $pdf->writeHTML($html, true, false, true, false, '');

            // 表格标题
            $header = array('时间', '交易类型', '修理厂名称', '订单编号', '收入（元）');

            // data loading
            $data = array();
            foreach ($data1 as $key => $val) {
                $data[$key][0] = date('Y-m-d', $val['CreateTime']);
                $data[$key][1] = $val['Payment'] == 2 ? '物流代收款' : '支付宝担保';
                if (!$val['BuyerName']) {
                    $val['BuyerName'] = Organ::model()->findByPk($val['BuyerID'], array('select' => 'OrganName'))->attributes['OrganName'];
                }
                $data[$key][2] = $val['BuyerName'];
                $data[$key][3] = $val['No'];
                $data[$key][4] = $val['Price'];
            }
            // 输出表格
            $pdf->ColoredTable($header, $data);

            //换行
            $pdf->Ln();
        }

        if (!empty($data2)) {
            $html = '<p style="color:#1f76c8;">退货明细:</p>';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            // 表格标题
            $header = array('时间', '退款方式', '修理厂名称', '退货单号', '支出（元）');

            // 导入数据
            $data = array();
            foreach ($data2 as $key => $val) {
                $data[$key][0] = date('Y-m-d', $val['CreateTime']);
                $data[$key][1] = $val['Payment'] == 1 ? '物流代收款' : '支付宝担保';
                $data[$key][2] = Organ::model()->findByPk($val['BuyerID'], array('select' => 'OrganName'))->attributes['OrganName'];
                $data[$key][3] = $val['No'];
                $data[$key][4] = $val['Price'];
            }
            // 输出表格
            $pdf->ColoredTable($header, $data);
        }

        $pdf->Output('Account.pdf', 'I');
    }

    //订单商品详情
    public function actionOrderGoods() {
        $this->layout = '//layouts/papmall';
        $goodsid = $subParts = Yii::app()->request->getParam('goods');
        $payment = 1;
        $result = MallService::getGoodByID($goodsid, $payment);
        if (!$result) {
            $this->redirect(array('index'));
        }
        $cookie = Yii::app()->request->getCookies();
        $car = array('make' => $cookie['mallmake']->value, 'series' => $cookie['mallseries']->value, 'year' => $cookie['mallyear']->value, 'model' => $cookie['mallmodel']->value);
        $carmodeltext = MallService::getCarmodeltxt($car);
        $res = array();
        if ($car['make'] && $car['series'] && $car['year'] && $car['model']) {
            $params = $car;
            $params['goodsid'] = $goodsid;
            $res = MallService::checkCarfit($params);
        }
        $this->pageTitle = Yii::app()->name . '-' . "商品详情";
        //获取经销商客服列表
        $csparams['organID'] = $result['SellerID'];
        $csparams['type'] = 1;
        $csinfo = CsService::getcslists($csparams);
        $this->render('ordergoods', array('r' => $result, 'carmodeltext' => $carmodeltext, 'res' => $res, 'csinfo' => $csinfo));
    }

}
