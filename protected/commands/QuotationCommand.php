<?php

/**
 * 询报价发送后两天无响应状态改为失效
 */
class QuotationCommand extends CConsoleCommand {

    //2个工作日内，未经过服务店确认（同意/拒绝/待修改），则此报价单无效
    public function run() {
        echo date('Y-m-d H:i:s') . " [Quotation] start \n";
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . " [Quotation] start", 'info', 'command');
        $time = $_SERVER['REQUEST_TIME'];
        $failuretime = 3600 * 24 * 2;   //2天
        $t = $time - $failuretime;
        //无询价单的报价单失效
        $quosql = 'update `pap_quotation` set Status="5" where IfSend="2" and CreateTime<' . $t . ' and Status="1" and InquiryID=0';
        $quocount = Yii::app()->papdb->CreateCommand($quosql)->execute();
        Yii::log(date('Y-m-d H:i:s') . " The quotation " . $quocount . " total failure(not inq)" . " [Quotation] end \n", 'info', 'command');

        //根据询价单发送的报价单(已报价未确认或拒绝)
        $inq = 'update `pap_inquiry` set Status="5" where Status=1 and InquiryID in( select InquiryID from `pap_quotation` ' .
                'where IfSend="2" and CreateTime<' . $t . ' and Status="1" and InquiryID!=0)';
        $inqcount_quo=Yii::app()->papdb->CreateCommand($inq)->execute();
        Yii::log(date('Y-m-d H:i:s') . " The inquiry " . $inqcount_quo . " total failure(have quo)" . " [Quotation] end \n", 'info', 'command');
        $quosql_inq = 'update `pap_quotation` set Status="5" where CreateTime<' . $t . ' and Status="1" and InquiryID!=0';
        $quocount_inq = Yii::app()->papdb->CreateCommand($quosql_inq)->execute();
        Yii::log(date('Y-m-d H:i:s') . " The quotation " . $quocount_inq . " total failure(have inq)" . " [Quotation] end \n", 'info', 'command');

        //询价单失效(未报价)
        $inqsql = 'update `pap_inquiry` set Status="5" where  CreateTime<' . $t . ' and Status=0';
        $inqcount = Yii::app()->papdb->CreateCommand($inqsql)->execute();
        Yii::log(date('Y-m-d H:i:s') . " The inquiry " . $inqcount . " total failure(not quo)" . " [Quotation] end \n", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [Quotation] end \n";
    }

}

?>
