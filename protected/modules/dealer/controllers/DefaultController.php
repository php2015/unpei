<?php

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

    public function actionIndex() {
         $this->redirect(array('/pap/sellerorder/index'));
//        var_dump(OrderreturnService::getauditreturn());
//        exit;
        $user_id = Commonmodel::getOrganID();
//        //买家-已收到的报价单条数--报价单处于默认状态，或者处于同意但尚未付款状态
//        $receive = new CDbCriteria();
//        $receive->addCondition("receiver_id = {$user_id}");
//        $receive->addCondition("quotation_status = 0 OR (quotation_status = 1 AND pay_status = 0)");
//        $receiveCount = Quotation::model()->count($receive);
//
//        //买家-执行中的报价单--报价单已同意并付款，但还未执行成功或拒绝、废弃,也没有异常申请
//        $implement = new CDbCriteria();
//        $implement->addCondition("receiver_id = {$user_id}");
//        $implement->addCondition('quotation_status = 1');
//        $implement->addCondition('pay_status = 1');
//        $implement->addCondition('unusual_status = 0');
//        $buyImple = Quotation::model()->count($implement);
//        //卖家-报价单总览--报价单未执行成功或拒绝、废弃,也没有异常申请
//        $list = new CDbCriteria();
//        $list->addCondition("user_id = {$user_id}");
//        $list->addInCondition('quotation_status', array(0, 1));
//        $list->addCondition('unusual_status = 0');
//        $sellImple = Quotation::model()->count($list);
//        //买家-异常订单
//        $buyUnusual = Quotation::model()->count(array(
//            "condition" => "unusual_status = 1 AND receiver_id = {$user_id}"));
//        //卖家-异常订单
//        $sellUnusual = Quotation::model()->count(array(
//            "condition" => "unusual_status = 1 AND user_id = {$user_id}"));
//
//
//        //经销商订单状态数量
//        $weishouhuo = DealerBatchCheck::model()->count(array('condition' => "status = 20 and buyer_id ={$user_id} and abn_status = 0"));
////		$statist = DealerOrder::model()->count(array('condition'=>"status = 25 and dealer_id ={$user_id}"));
//        $statist = DealerOrder::model()->count(array('condition' => "IfAffirm = 2 and dealer_id ={$user_id}"));
////                $abnormal = DealerBatchCheck::model()->count(array('condition'=>"status = 30 and buyer_id ={$user_id} and abn_status <= 20"));
//        $abnormal = DealerBatchCheck::model()->count(array('condition' => "status = 30 and buyer_id ={$user_id} and abn_status <= 20 and abn_status >0"));
//        // 订购平台 
        $organID = Commonmodel::getOrganID();
        $sql = "select * from pap_inquiry a"
                . " where a.Status=0 and a.DealerID  =  ',{$user_id},' ";
        $result = Yii::app()->papdb->createCommand($sql)->queryAll();
        $dquotions = count($result);
//        $quot = new CDbCriteria();
//        $quot->addCondition("Status = 0");
//        $quot->addSearchCondition("DealerID", ",{$organID},");
//          $dquotions = ServiceInquiry::model()->count($quot);
//        //待发货的订单
        $dShipping = PapOrder::model()->count(array('condition' => "Status = 2 and SellerID = {$organID}"));
//        // 销售异常订单
//        $dAbnormal = PapOrder::model()->count(array('condition' => " IsUnusual !=0 and Status =9 and SellerID = {$organID}"));
//
//        //待付款的订单
//        //$waitpay=  PapOrder::model()->count('Status=1 and SellerID ='.$organID);
//        //待买家收货的订单
//        //$buyerwaitreceipt=  PapOrder::model()->count('Status=3 and SellerID ='.$organID);
////                待同意退货的订单
//        $waitcheckreturn = PapOrder::model()->count('Status=11 and SellerID =' . $organID);
//        //待买家退货的订单
//        //$waitreturn= PapOrder::model()->count('Status=12 and SellerID ='.$organID);
//        //退货待收货
//        $sellerwaitreceipt = PapOrder::model()->count('Status=13 and SellerID =' . $organID);
        //待审核的退货单
        $returnaudit = OrderreturnService::papreturnstatus('1');
        $this->render('index', array(
//            'receiveCount' => $receiveCount,
//            'buyImple' => $buyImple,
//            'sellImple' => $sellImple,
//            'buyUnusual' => $buyUnusual,
//            'sellUnusual' => $sellUnusual,
//            'weishouhuo' => $weishouhuo, // 待收货
//            'statist' => $statist, // 查看订单
//            'abnormal' => $abnormal, // 异常订单 
            'dquotions' => $dquotions, // 待报价询价单
            'dShipping' => $dShipping, // 待发货订单
//            'dAbnormal' => $dAbnormal, // 销售异常订单
//            'waitpay' => $waitpay, //待付款的订单
//            'buyerwaitreceipt' => $buyerwaitreceipt, //待买家收货的订单
//            'waitcheckreturn' => $waitcheckreturn, //待同意退货的订单
//            'waitreturn' => $waitreturn, //待买家退货的订单
//            'sellerwaitreceipt' => $sellerwaitreceipt, //退货待收货
            'returnaudit' => $returnaudit//退货待审核
        ));
    }

    public function actionQuotions() {
        $organID = Commonmodel::getOrganID();
        $sqls = "select a.InquiryID,b.QuoID from pap_inquiry a,pap_quotation b"
                . " where b.InquiryID=a.InquiryID and a.Status <>3  and a.DealerID  like  '%,$organID,%' ";
        $result = Yii::app()->papdb->CreateCommand($sqls)->queryAll();
        foreach ($result as $value) {

            $inq.=$value['InquiryID'] . ',';
        }
        $inq = substr($inq, 0, -1);
        if (!$inq) {
            $inq = 0;
        }
        $sql = "select * from pap_inquiry a"
                . " where a.Status <>3 and a.DealerID  like  '%,$organID,%' ";
        $sql.="and a.InquiryID not in($inq)";
        $result = Yii::app()->papdb->createCommand($sql)->queryAll();
        $quotions = count($result);
//             		$receive =new CDbCriteria();
//             $receive->addCondition("Status = 0");
//             $receive->addSearchCondition("DealerID","{$organID}");
//             $quotions = ServiceInquiry::model()->count($receive);
        //$quotions = ServiceInquiry::model()->count(array('condition'=>"Status = 0 and DealerID in ({$organID})"));
        echo $quotions;
    }

    public function actionShipping() {
        $organID = Commonmodel::getOrganID();
        $Shipping = PapOrder::model()->count(array('condition' => "Status = 2 and SellerID = {$organID}"));
        echo $Shipping;
    }

    public function actionAbnormal() {
        $organID = Commonmodel::getOrganID();
        $Abnormal = PapOrder::model()->count(array('condition' => " IsUnusual != 0 and Status =9  and SellerID = {$organID}"));
        echo $Abnormal;
    }

    //页面加载ajax赋值给隐藏的待办事记录
    public function actionHiderecord() {
        $organID = Commonmodel::getOrganID();
        $sql = "select * from pap_inquiry a"
                . " where a.Status=0 and a.DealerID  like  '%,$organID,%' ";
        $result = Yii::app()->papdb->createCommand($sql)->queryAll();
        $quotions = count($result);
        //$waitpay=  PapOrder::model()->count('Status=1 and SellerID ='.$organID);
        $Shipping = PapOrder::model()->count(array('condition' => "Status = 2 and SellerID = {$organID}"));
        $Abnormal = PapOrder::model()->count(array('condition' => " IsUnusual != 0 and Status =9 and SellerID = {$organID}"));

        //待付款的订单
        //$waitpay=  PapOrder::model()->count('Status=1 and SellerID ='.$organID);
        //待买家收货的订单
        //$buyerwaitreceipt=  PapOrder::model()->count('Status=3 and SellerID ='.$organID);
        //待同意退货的订单
        $waitcheckreturn = PapOrder::model()->count('Status=11 and SellerID =' . $organID);
        //待买家退货的订单
        //$waitreturn= PapOrder::model()->count('Status=12 and SellerID ='.$organID);
        //退货待收货
        $sellerwaitreceipt = PapOrder::model()->count('Status=13 and SellerID =' . $organID);
        //待审核的退货单
        $returnaudit = OrderreturnService::papreturnstatus('1');
//            echo json_encode(array('quotions'=>$quotions,'shipping'=>$Shipping,'abnormal'=>$Abnormal,'waitpay'=>$waitpay,
//                             'buyerwaitreceipt'=>$buyerwaitreceipt,'waitcheckreturn'=>$waitcheckreturn,'waitreturn'=>$waitreturn,
//                               'sellerwaitreceipt'=>$sellerwaitreceipt));
        echo json_encode(array('quotions' => $quotions, 'shipping' => $Shipping,
            'abnormal' => $Abnormal, 'waitcheckreturn' => $waitcheckreturn, 'sellerwaitreceipt' => $sellerwaitreceipt, 'returnaudit' => $returnaudit));
    }

}