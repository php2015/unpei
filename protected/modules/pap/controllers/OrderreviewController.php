<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class OrderreviewController extends Controller {

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-订单总览';
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->condition = 't.IsDelete=0 and BuyerID=' . $organID;
        $criteria->with = 'goodsinfo';
        $criteria->order = 't.CreateTime DESC';
        //搜索条件
        $this->search($criteria);
        //订单数量
        $count = OrderService::getordercount($organID);
        $dataProvider = new CActiveDataProvider('PapOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
        $datas = $dataProvider->getData();
        foreach ($datas as $vv) {
            foreach ($vv->goodsinfo as $v) {
                $v = self::getVersionGoods($v);
            }
        }
        $dataProvider->setData($datas);
        $this->render('index', array('dataProvider' => $dataProvider, 'count' => $count));
    }

    private static function getVersionGoods($v) {
        $res = DealergoodsService::getmongoversion($v['GoodsID'], $v['Version']);
        $goods = $res['GoodsInfo'];
        //商品图片
        if (is_array($goods['img']) && !empty($goods['img'])) {
            if (!$goods['img'][0]['ImageUrl']) {
                $v['ImageUrl'] = $goods['img'][0]['MallImage'];
            } else {
                $v['ImageUrl'] = $goods['img'][0]['ImageUrl'];
            }
        } else {
            $v['ImageUrl'] = '';
        }
        //商品oe号
        if (is_array($goods['oeno']) && !empty($goods['oeno'])) {
            $oe = '';
            foreach ($goods['oeno'] as $ov) {
                if ($ov) {
                    $oe.=$ov . ',';
                }
            }
            $v['GoodsOE'] = substr($oe, 0, -1);
        } else {
            $v['GoodsOE'] = '';
        }
        $v['GoodsName'] = $goods['Name'];
        $v['GoodsNum'] = $goods['GoodsNO'];
        $v['Brand'] = $goods['Brand'];
        $v['PartsLevelName'] = $goods['PartsLevelName'];
        $v['CpName'] = Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['StandCode']}'"))->attributes['Name'];
        $v['Carmodeltxt'] = MallService::getCarmodeltxt(array('make' => $v['MakeID'], 'series' => $v['CarID'], 'year' => $v['Year'], 'model' => $v['ModelID']));
        return $v;
    }

    /**
     * 订单总览搜索
     */
    public function search($criteria) {
        //订单编号搜索
        if (isset($_GET['ordersn']) && !empty($_GET['ordersn']) && $_GET['ordersn'] != '订单编号') {
            $ordersn = trim($_GET['ordersn']);
            $criteria->addCondition("t.OrderSN='$ordersn'", "AND");
        }
        //订单类型搜索
        if (isset($_GET['ordertype']) && !empty($_GET['ordertype'])) {
            $ordertype = $_GET['ordertype'];
            $criteria->addCondition("t.OrderType='$ordertype'", "AND");
        }
        //下单时间
        if (isset($_GET['starttime']) && !empty($_GET['starttime'])) {
            $start_time = strtotime($_GET['starttime']);
            if ($start_time) {
                $criteria->addCondition("t.CreateTime>=$start_time", "AND");
            }
        }
        if (isset($_GET['endtime']) && !empty($_GET['endtime'])) {
            $end_time = strtotime("{$_GET['endtime']} + 1 day");
            if ($end_time) {
                $criteria->addCondition("t.CreateTime<=$end_time", 'AND');
            }
        }
        //卖家名称
        if (isset($_GET['sellername']) && !empty($_GET['sellername'])) {
            $sellername = trim($_GET['sellername']);
            $criteria->compare('t.SellerName', $sellername, 'AND');
        }
        //订单状态
        if (isset($_GET['status']) && !empty($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 5) {
                $criteria->addCondition("t.Status=3 and t.ReturnStatus!=0", 'AND');
            } else if ($status == 3) {
                $criteria->addCondition("t.Status=3 and t.ReturnStatus=0", 'AND');
            } else {
                $criteria->addCondition("t.Status=$status", 'AND');
            }
            $criteria->addCondition("t.IsUnusual = 0", "AND");
        }
        //评价状态
        if (isset($_GET['evastatus']) && !empty($_GET['evastatus'])) {
            $evastatus = $_GET['evastatus'];
            if ($evastatus && $evastatus == 1) {
                $criteria->addCondition("t.EvaStatus in(0,16) and t.Status=9", "AND");
            } else if ($evastatus == 2) {
                $criteria->addCondition("t.EvaStatus in(15,20) and t.Status=9", "AND");
            }
        }
    }

    /*
     * 订单详情
     */

    public function ActionDetail() {
        $this->pageTitle = Yii::app()->name . '-订单详情';
        $orderid = Yii::app()->request->getParam('orderid');
        $organID = Yii::app()->user->getOrganID();
        //获取订单信息及商品信息
        $model = PapOrder::model()->findByPk($orderid, "BuyerID=$organID");
        if (!$model) {
            $this->redirect(array('index'));
        }
        $order['order'] = $model->attributes;
        $discount = PapOrderDiscount::model()->find(array("condition" => "OrderType = {$order['order']['OrderType']}"));
        $order['discount'] = $discount->attributes;
        foreach ($model->goodsinfo as $k => $v) {
            $order['goodsList'][$k] = self::getVersionGoods($v);
        }
        //获取收货地址
        $address = OrderService::getship($orderid);
        //获取卖家信息
        $dealer = OrderService::getSeller($orderid);
        //支付宝帐号
        // $account = OrderService::getPayaccount();
        //获取活动信息
        $huodong=  OrderService::getHuodong($orderid);
        $this->render('detail', array('order' => $order, 'address' => $address, 'dealer' => $dealer,'huodong'=>$huodong));
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
                $data['text'] = "（支付保担保），请您尽快付款";
            } else {
                $data['text'] = "（物流代收款），等待卖家确认";
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

    /**
     * 确认收货操作
     */
    public function ActionConfirmgoods() {
        $orderid = Yii::app()->request->getParam('orderid');
        $result = OrderService::confirmgoods($orderid);
        if ($result) {
            echo json_encode(1);
        } else {
            echo json_encode(2);
        }
    }

    /*
     * 修理厂评价商品
     */

    public function actionBuytoevaluation() {
        $this->pageTitle = Yii::app()->name . '-' . "修理厂评价商品";
        $this->layout = '';
        $OrderStatus = $_GET['OrderStatus'];
        $EvaStatus = $_GET['EvaStatus'];
        $OrderID = $_GET['OrderID'];
        $omodel = PapOrder::model()->findByPk($OrderID, '(EvaStatus=0 or EvaStatus=16) and (Status=9 or Status = 16)');
        if (!$omodel) {
            $this->redirect(array('orderreview/index/orderstype/4/evastatus/1'));
        }
        $model = PapOrderGoods::model()->findAll("OrderID=:ID", array(":ID" => $OrderID));
        foreach ($model as $key => $value) {
            //获得机构ID
//            $goodsinfo = PapGoods::model()->find("ID=:ID", array(":ID" => $value['GoodsID']));
//            $data[$key]['GoodsID'] = $GoodsID = $goodsinfo->ID;
//            $data[$key]['GoodsName'] = $goodsinfo->Name;
//            $data[$key]['GoodsNO'] = $goodsinfo->GoodsNO;
//            $data[$key]['OrganID'] = $OrganID = $goodsinfo->OrganID;
            $data[$key]['GoodsID'] = $GoodsID = $value['GoodsID'];
            $data[$key]['GoodsName'] = $value['GoodsName'];
            $data[$key]['GoodsNO'] = $value['GoodsNum'];
            $data[$key]['OrganID'] = $OrganID = $omodel->SellerID; //卖家ID
            //获得图片
            $goodsimg = PapGoodsImageRelation::model()->findAll("GoodsID=:GoodsID ", array(":GoodsID" => $GoodsID));
            $data[$key]['GoodsIMG'] = $goodsimg[0]->ImageUrl;
        }
        $evarr = EvaluateService::getevainfo(2);
        $this->render("papeva", array('data' => $data, 'OrderID' => $OrderID, 'OrderStatus' => $OrderStatus, 'EvaStatus' => $EvaStatus, 'evarr' => $evarr));
    }

    //保存评价
    public function actionSaveevaluation() {
        $OrderID = $_POST['evalOrderID'];
        //避免重复评论  如果该订单 修理厂评价过15 或者 双方都评价过20
        $omodel = PapOrder::model()->findByPk($OrderID, '(EvaStatus=15 or EvaStatus=20) and (Status=9 or Status = 16)');
        if ($omodel) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script>alert('该订单已评论！');window.location.href='" .
            Yii::app()->createUrl('pap/orderreview/index', array('orderstype' => 4, 'evastatus' => 1)) . "'</script>";
            exit;
        }
        $this->pageTitle = Yii::app()->name . '-' . "保存评价";
        $BuyerID = Yii::app()->user->getOrganID();
        //处理前台穿过来的数据
        $BuyerToEvalRemark = explode(',', $_POST['BuyerToEvalRemark']);
        $Status = explode(',', $_POST['Status']);
        $GoodsID = explode(',', $_POST['GoodsID']);
        //var_dump(ltrim($_POST['GoodsID'],"0,"));die;
        $OrganID = $_POST['OrganID'];
        $OrderStatus = $_POST['OrderStatus'];
        $EvaStatus = $_POST['EvaStatus'] ? $_POST['EvaStatus'] : null;
        $evaID = Yii::app()->request->getParam('evaID');


        //删除已添加的评价
        PapEvaluationGoods::model()->deleteAll('OrderID=:OrderID', array(':OrderID' => $OrderID));
        $length = count($Status);
        $gbool = 1;
        for ($i = 1; $i < $length; $i++) {
            $gevaluation = new PapEvaluationGoods();
            $gevaluation->OrganID = $OrganID;
            $gevaluation->GoodsID = $GoodsID[$i];
            $gevaluation->BuyerID = $BuyerID;
            if ($BuyerToEvalRemark[$i] != '质量如何？来说说吧...')
                $gevaluation->BuyerToEvalRemark = htmlspecialchars($BuyerToEvalRemark[$i]);
            $gevaluation->CreateTime = time();
            $gevaluation->OrderID = $OrderID;
            $gevaluation->Status = $Status[$i];
            $model = $gevaluation->save();
            $evasID[$i] = Yii::app()->papdb->getLastinsertID();
            $goodsImages = Yii::app()->request->getParam("goodsImages" . ($i - 1));
            if (isset($goodsImages) && !empty($goodsImages)) {
                $this->saveorganphoto($goodsImages, $GoodsID[$i], $evasID[$i]);
            }
            if ($model) {
                $m = PapGoods::model()->findByPk($GoodsID[$i]);
                if ($m['CommentNo']) {
                    PapGoods::model()->updateByPk($GoodsID[$i], array('CommentNo' => $m['CommentNo'] + 1));
                } else {
                    PapGoods::model()->updateByPk($GoodsID[$i], array('CommentNo' => 1));
                }
            } else {
                $gbool = 0;
                foreach ($gevaluation->errors as $errorsv) {
                    if (!$error)
                        $error = $errorsv[0];
                }
            }
        }
        //获取修理厂评价经销商的商品积分
        $pap_eva_goods = "select OrganID,Status,OrderID from pap_evaluation_goods where OrganID =$OrganID and OrderID=" . $OrderID;
        $bool2 = Yii::app()->papdb->createCommand($pap_eva_goods)->queryAll();
        $sum = 0;
        foreach ($bool2 as $v) {
            if ($v['Status'] == 3) {
                $sum+=-1;
            }
            if ($v['Status'] == 2) {
                $sum+=0;
            }
            if ($v['Status'] == 1) {
                $sum+=1;
            }
        }

        //获取经销商的信用等级
        $organGrade = "select Grade from jpd_organ where ID=" . $bool2[0]['OrganID'];
        $bool3 = Yii::app()->jpdb->createCommand($organGrade)->queryRow();

        //更新经销商的信用等级
        $sum2 = $sum + $bool3['Grade'];
        $Gradesum = "update jpd_organ set Grade =$sum2 where ID=" . $bool2[0]['OrganID'];
        $bool4 = Yii::app()->jpdb->createCommand($Gradesum)->execute();

        $addsql = "insert into pap_evaluation_organ (Identity,OrganID,Recier,JudgeID,OrderID,Score,CreateTime) values ";
        $keytop = 1;
        foreach ($evaID as $ekeys => $evalue) {
            if ($keytop != 1) {
                $addsql .=",";
            }
            $addsql .="(";
            $addsql .=2;
            $addsql .=",";
            $addsql .=$BuyerID;
            $addsql .=",";
            $addsql .=$OrganID;
            $addsql .=",";
            $addsql .=$ekeys;
            $addsql .=",";
            $addsql .=$OrderID;
            $addsql .=",";
            $addsql .=$evalue;
            $addsql .=",";
            $addsql .=time();
            $addsql .=")";
            $keytop = 2;
//            EvaluateService::addjudgerecord($ekeys, $evalue, $OrganID, 2, $OrderID);
        }
        $obool = Yii::app()->papdb->createCommand($addsql)->execute();
        if ($gbool && $obool) {
            if ($OrderStatus == 9 && $EvaStatus == null) {
                $EvaStatus = 15; //如果该订单服务店先评价，把状态改为15
            } elseif ($OrderStatus == 9 && $EvaStatus == 16) {
                $EvaStatus = 20;  //如果该订单之前经销商评价过一次，则服务店此时评价状态改为20
            }

            $bool2 = PapOrder::model()->updateByPK($OrderID, array('EvaStatus' => $EvaStatus));
            $rs = array('success' => 1, 'errorMsg' => '评价成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '评价失败', 'error' => $error);
        }
        $this->render("evaresult", array('result' => $rs));
    }

    /*
     * 删除图片
     */

    public function actionDelPto() {
        $imageid = Yii::app()->request->getParam("imageid");
        $ftp = new Ftp();
        $res = $ftp->delete_file($imageid);
        $ftp->close();
        echo json_encode($res);
    }

    public function saveorganphoto($goodsImages, $goodID, $EvalID) {
        $OrganID = Yii::app()->user->getOrganID();
        $Time = time();
        $imglegth = count($goodsImages);
        $sql = "INSERT INTO pap_evaluation_goods_image (OrganID,ImageUrl,GoodsID,CreateTime,EvalID) values";
        for ($i = 0; $i < $imglegth; $i++) {
            $insert .= "('{$OrganID}','{$goodsImages[$i]}','{$goodID}','{$Time}','{$EvalID}'),";
        }

        if (!empty($insert)) {
            $sql .= rtrim($insert, ",");
        }
        $result = Yii::app()->papdb->createCommand($sql)->execute();
        if (!$result) {
            throw new CHttpException(400, '保存图片失败！');
        }
    }

    //取消订单
    public function actionCancelOrder() {
        $orderid = Yii::app()->request->getParam('orderid');
        $OrganID = Yii::app()->user->getOrganID();
        $result = PapOrder::model()->updateByPk($orderid, array(
            'Status' => '10', 'UpdateTime' => time()), "BuyerID = $OrganID and ((Payment=1 and Status=1) or (Payment=2 and Status=2))");
        if ($result) {
            //更改待付款、待发货提醒状态
            RemindService::updateRemindStatus($orderid, '1,2', $OrganID = 'no');
            echo json_encode(array('success' => '1'));
        } else {
            echo json_encode(array('error' => '1', 'msg' => '取消订单失败，请稍后再试！'));
        }
    }

    //修改订单
    public function actionChangeOrder() {
        $ID = Yii::app()->request->getParam('order');

        if ($_POST['idArr'] && isset($_POST['amountArr']) && $_POST['ID'] && $_POST['payment']) {
            $res = OrderService::changeOrder($_POST);
            echo json_encode($res);
            exit;
        }
        $cond = "((t.Payment=1 and t.Status=1 and ISNULL(t.AlipayTN)) or (t.Payment=2 and t.Status=2))";
        $criteria = new CDbCriteria();
        $organID = Yii::app()->user->getOrganID();
        $criteria->condition = "t.BuyerID=$organID and t.IsDelete=0 and $cond";
        $model = PapOrder::model()->findByPk($ID, $criteria);
        if (!$model) {
            $this->redirect(array('index'));
        }
        foreach ($model->goodsinfo as $v) {
            $v = self::getVersionGoods($v);
        }
        //var_dump($model);die;
        $this->pageTitle = Yii::app()->name . ' - ' . "修改订单";
        $this->render('changeorder', array('data' => $model));
    }
    
    //修改支付方式
    public function actionChangepay(){
        $data = array();
        //订单类别  商城订单、询价单订单、报价单订单---1/2/3
        $OrderType = Yii::app()->request->getParam("OrderType");
        if($OrderType!=1){
            $OrderType = 2;
        }
        //付款方式（支付宝担保交易/物流代收款--1/2）
        $Payment = Yii::app()->request->getParam("Payment");
        $SellerID = Yii::app()->request->getParam("SellerID");
        $BuyerID = Yii::app()->request->getParam("BuyerID");
        $IDArr = explode(',', Yii::app()->request->getParam("idArr"));
        $discount = PapOrderDiscount::model()->find(array("condition" => "OrderType = {$OrderType}"));
        if (isset($discount) && !empty($discount)) {
            if ($Payment == 1) {
                $dis = $discount['OrderAlipay'] / 100;
            } else if ($Payment == 2) {
                $dis = $discount['OrderLogis'] / 100;
            }
        }
        //获取订单折扣率或促销价
        $price = MallService::getContactprice($SellerID, $BuyerID);
        $PriceRatio = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
        foreach ($IDArr as $key=>$val){
            $Price = 0;
            $model = PapGoods::model()->findByPk($val, array("condition"=>"ISdelete=1"));
            if ($model['IsPro'] == 1) {//判断是否有促销价
                if (!is_null($model['ProPrice']) && $model['ProPrice']) {
                    $Price = $model['ProPrice'];
                }
            }else{
                if ($PriceRatio > 0) {
                    $Price = sprintf("%.2f", $model['Price'] * $PriceRatio / 100);    // 折扣价,小数点后面保留两位
                }
            }
            $data[$key] = sprintf("%.2f", $Price * $dis);
        }
        echo json_encode($data);die;
    }

    //支付宝确认收货
    public function actionPayConfirm() {
        $id = Yii::app()->request->getParam('id');
        $tradeNo = PapOrder::model()->findByPK($id)->attributes['AlipayTN'];
        header("location:https://lab.alipay.com/consume/queryTradeDetail.htm?tradeNo=$tradeNo");
    }

    //退货支付宝确认收货
    public function actionPayConfirmreturn() {
        $id = Yii::app()->request->getParam('id');
        $tradeNo = PapReturnOrder::model()->findByPK($id)->attributes['AlipayTN'];
        header("location:https://lab.alipay.com/consume/queryTradeDetail.htm?tradeNo=$tradeNo");
    }

    public function actionOrderGoods() {
        $this->layout = '//layouts/base';
        $goodsid = Yii::app()->request->getParam('goods');
        $version = Yii::app()->request->getParam('Version');
        $order = Yii::app()->request->getParam('Order');
        $return = Yii::app()->request->getParam('return');
        $quo = Yii::app()->request->getParam('quo');

        //版本信息
        $good = DealergoodsService::getmongoversion($goodsid, $version);
        $result = $good['GoodsInfo'];
        $result['SellerID'] = $result['OrganID'];
        if ($order) {
            $model = PapOrderGoods::model()->find(array('select' => 'ProPrice as Price,Quantity,MakeID,CarID,Year,ModelID', 'condition' => "OrderID=$order and GoodsID=$goodsid"))->attributes;
            $result['Quantity'] = $model['Quantity'];
            $result['Price'] = $model['Price'];
            $car = array('make' => $model['MakeID'], 'series' => $model['CarID'], 'year' => $model['Year'], 'model' => $model['ModelID']);
        } else if ($return) {
            $model = PapReturnGoods::model()->find(array('select' => 'Price,OrderID', 'condition' => "ReturnID='$return' and GoodsID='$goodsid'"))->attributes;
            $result['Quantity'] = $model['Quantity'];
            $result['Price'] = $model['Price'];
            $ordermodel = PapOrderGoods::model()->find(array('select' => 'MakeID,CarID,Year,ModelID', 'condition' => "OrderID={$model['OrderID']} and GoodsID=$goodsid"))->attributes;
            $car = array('make' => $ordermodel['MakeID'], 'series' => $ordermodel['CarID'], 'year' => $ordermodel['Year'], 'model' => $ordermodel['ModelID']);
        } else if ($quo) {
            $model = PapQuotationGoods::model()->findByPk($quo, array('select' => 'Price,Num', 'condition' => "GoodsID='$goodsid'"))->attributes;
            $result['Quantity'] = $model['Num'];
            $result['Price'] = $model['Price'];
        } else {
            $this->redirect(array('index'));
        }

        //发货公告
        $model = new PapGoodsSendnotice();
        $notice = $model->find("OrganID = {$result['SellerID']}");

        //商品基本信息
        $result['GoodsID'] = $goodsid;
        $result['BrandName'] = $result['Brand'];
        $goods = PapGoods::model()->findByPk($goodsid, array('select' => 'IsSale,CommentNo'));
        $result['IsSale'] = $goods->attributes['IsSale'];
        $result['CommentNo'] = $goods->attributes['CommentNo'];
        if ($result['oeno']) {
            $oe = '';
            foreach ($result['oeno'] as $v) {
                $oe.=$v . ',';
            }
            $result['OENO'] = substr($oe, 0, -1);
        } else {
            $result['OENO'] = '';
        }

        //最小交易金额
        $result['MinTurnover'] = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $result['SellerID']))->attributes['MinTurnover'];
        //店家积分
        $result['TotalScore'] = DefaultService::getrecord($result['SellerID']);
        //店家信息
        $organInfo = Organ::model()->findByPk($result['SellerID'])->attributes;
        $result['OrganName'] = $organInfo['OrganName'];
        $result['QQ'] = $organInfo['QQ'];
        $result['Phone'] = $organInfo['Phone'];
        $result['Address'] = array(Area::getCity($organInfo['Province']), Area::getCity($organInfo['City']), Area::getCity($organInfo['Area']));

        //大类子类标准名称
        $result['StandCodeName'] = Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$result['StandCode']}'"))->attributes['Name'];
        $cpArr = MallService::getCategory($result['StandCode']);
        $result['BigName'] = $cpArr['BigParts'];
        $result['SubName'] = $cpArr['SubParts'];
        $result['sub'] = $cpArr['sub'];

        $result['ValidityType'] = $result['spec']['ValidityType'];
        $result['ValidityDate'] = $result['spec']['ValidityDate'];
        $result['BganCompany'] = $result['spec']['BganCompany'] ? $result['spec']['BganCompany'] : ''; //标品
        $result['BganGoodsNO'] = $result['spec']['BganGoodsNO'] ? $result['spec']['BganGoodsNO'] : ''; //标商
        $result['Unit'] = $result['spec']['Unit'] ? $result['spec']['Unit'] : ''; //单位ID
        $result['UnitName'] = GoodsUnit::model()->findByPk($result['Unit'])->attributes['UnitName']; //单位
        $result['MinQuantity'] = $result['pack']['MinQuantity'] ? $result['pack']['MinQuantity'] : ''; //最小包装
        // 图片
        if (!$result['img']) {
            $result['Images'][0]['ImageUrl'] = 'dealer/goods-img-big.jpg';
            $result['Images'][0]['BigImage'] = 'dealer/goods-img-big.jpg';
        } else {
            foreach ($result['img'] as $k => $v) {
                $result['Images'][$k]['MallImage'] = $v['MallImage'];
                $result['Images'][$k]['ImageUrl'] = $v['ImageUrl'];
                if (!$v['BigImage']) {
                    $result['Images'][$k]['BigImage'] = $v['ImageUrl'];
                } else {
                    $result['Images'][$k]['BigImage'] = $v['BigImage'];
                }
            }
        }
        if (!$result) {
            $this->redirect(array('index'));
        }
        $carmodeltext = MallService::getCarmodeltxt($car);
        $carfit = $car;
        $carfit['goodsid'] = $goodsid;
        $fitres = MallService::checkCarfit($carfit);
        $rows = $this->Getmaincate($result['SellerID']);
        $cate = $this->findsub($rows);
        $this->pageTitle = Yii::app()->name . '-' . "订单商品详情";
        //获取经销商客服列表
        $csparams['organID'] = $result['SellerID'];
        $csparams['type'] = 1;
        $csinfo = CsService::getcslists($csparams);
        $this->render('ordergoods', array('r' => $result, 'cate' => $cate, 'carmodeltext' => $carmodeltext,
            'fitres' => $fitres['success'] == 1 ? 1 : 0,
            'csinfo' => $csinfo, 'car' => $car, 'data' => $notice, 'goodsid' => $goodsid));
    }

    //获取经销商主营分类
    public function Getmaincate($organID) {
        $big = JpdOrganCpname::model()->findAll(array(
            'select' => 'DISTINCT BigpartsID,BigName',
            'condition' => 'OrganID=' . $organID
        ));
        return $big;
    }

    //取子类
    protected function findsub($rows) {
        foreach ($rows as $k => $v) {
            $childs[$k] = $v->attributes;
            $cri = new CDbCriteria(array(
                'condition' => 'ParentID =' . $v[BigpartsID] . ' and IsShow=1',
                'order' => 'SortOrder asc',
            ));
            $sub = Gcategory::model()->findAll($cri);
            $childs[$k]['children'] = $sub;
        }
        return $childs;
    }

    public function actionGetGoods() {
        if (Yii::app()->request->isAjaxRequest) {
            $goodsid = Yii::app()->request->getParam('goodsid');
            $serviceID = Yii::app()->user->getOrganID();
            $result = MallService::getredis($goodsid);

            //商品折扣价
            if ($result['IsPro'] != 1) {
                $PriceRatio = MallService::getDisprice($result['OrganID'], $serviceID);
                if ($PriceRatio > 0 && $PriceRatio < 100) {
                    $result['DisPrice'] = sprintf('%.2f', $result['Price'] * $PriceRatio / 100);
                }
            }
            $result['spec']['UnitName'] = GoodsUnit::model()->findByPk($result['spec']['Unit'])->attributes['UnitName']; //单位
            echo json_encode($result, true);
        } else {
            $this->redirect('index');
        }
    }

}
