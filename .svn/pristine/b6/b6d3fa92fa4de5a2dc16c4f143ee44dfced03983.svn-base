<?php

/**
 * 自动化执行 命令行模式
 */
Yii::import('application.modules.user.models.*'); //引入models

class SendaccountEmailCommand extends CConsoleCommand {

    public function run() {
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . " [SendaccountEmail] start", 'info', 'command');
        //所要执行的任务，如数据符合某条件更新，删除，修改
//    	$Times = time() - 24 * 60 * 60 * 7 * 2;
//    	$count = PapGoods::model()->updateAll(array(
//    			'IsPro' => 0,
//    			'UpdateTime' => time(),
//    			'ProTime' => '',
//    			'ProPrice' => NULL,
//    	), "ProTime < $Times");
        $day = date('d');
        if ($day == 1) {
            $dyear = date('Y');
            $dmonth = date('m');
            if ($dmonth <= 1) {
                $uyear = $dyear - 1;
                $umonth = 12;
            } else {
                $uyear = $dyear;
                $umonth = $dmonth - 1;
            }
            $starttime = strtotime("$uyear-$umonth-01");
            $endtime = strtotime("$dyear-$dmonth-01");
            $day = date('t', $starttime);
            $dealersql = "select ID,OrganName,Email from jpd_organ where Identity=2 and IsBlack='0' and IsFreeze='0' and Status='1' and IsDelete='0' ";
            $dealer = Yii::app()->jpdb->createCommand($dealersql)->queryAll();
            foreach ($dealer as $v) {
                $select1 = "OrderSN as No,CreateTime,Payment,BuyerID,RealPrice as Price,BuyerName";
                $seaCon1 = "select $select1 from pap_order t where t.Status=9";
                $seaCon1.= " and SellerID = {$v['ID']} and IsDelete = 0";
                $seaCon1.=" and t.CreateTime>=$starttime and t.CreateTime<$endtime";
                $seaCon1.=" order by CreateTime DESC";
                $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
                $count1 = Yii::app()->papdb->createCommand(str_replace($select1, 'sum(RealPrice)', $seaCon1))->queryScalar();
                $select2 = "ReturnNO as No,CreateTime,PayMethod as Payment,ServiceID as BuyerID,Price";
                $seaCon2 = "select $select2 from pap_return_order t where t.Status in(4,14)";
                $seaCon2.= " and DealerID = {$v['ID']}";
                $seaCon2.=" and t.CreateTime>=$starttime and t.CreateTime<$endtime";
                $seaCon2.=" order by CreateTime DESC";
                $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
                $count2 = Yii::app()->papdb->createCommand(str_replace($select2, 'sum(Price)', $seaCon2))->queryScalar();
                $total1 = $count1 ? $count1 : 0;
                $total2 = $count2 ? $count2 : 0;
                $gain = $total1 - $total2;

                $subject = '由你配-' . $uyear . '年' . $umonth . '月对账单';
                $message = "
            <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
         <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>由你配 - 打印对账单</title>
        </head>
         <body>
        <div class='wrapper' style='width:700px; background:#fff; margin:0 auto'>
            <div class='head' style='height:55px; line-height:55px; border-bottom:1px solid #0566c2; background:url(\"http://192.168.2.29:8000/themes/default/images/jpd/logo_account.jpg\") #1f76c8 no-repeat'>
                <div class='title' style='margin:0 auto; text-align:center'>
                <span style='font-family:微软雅黑; font-size:24px; font-weight: bold; color:#fff; word-spacing:8px; letter-spacing: 1.5px;'>" . $uyear . "年" . $umonth . "月对账单</span>
                </div>
            </div>
            <div class='info' style='padding:0 20px; font-size:12px; color:#343434'>
                <p style='margin:0px; line-height:28px'>亲爱的" . $v['OrganName'] . "，您好！</p>
                <p style='margin:0px; line-height:28px'>感谢您使用由你配平台，以下是您" . $umonth . "月的平台交易明细：</p>
            </div>
            <div class='summary' style=' height:60px; line-height:30px; border-bottom:2px solid #c9c7c7; border-top:2px solid #c9c7c7; background:#f2f2f2; padding:0 30px'>
                <div class='float_l all' style='font-size:14px; font-weight:bold; color:#565656; line-height:60px;float:left'>
                    本月净收益： <span class='blue' style='color:#1f76c8'>" . $gain . "</span> 元

                </div>
                <div class='float_r detial' style='font-size:12px; font-weight:bold; line-height:30px;float:right'>
                    <p style='margin:0px; line-height:28px'>本月总收入： <span class='blue f14' style='color:#1f76c8;font-size:14px'>" . $total1 . "</span>元
                        <span class='m_left50' style='margin-left:50px'>本月总支出： 
                        <span class='blue f14' style='color:#1f76c8;font-size:14px'>" . $total2 . "</span>元</span></p>
                    <p style='margin:0px; line-height:28px'>账单周期：" . $uyear . "年" . $umonth . "月01日—" . $uyear . "年" . $umonth . "月" . $day . "日</p>
        </div>
        </div>
        <p class='line30' style='line-height:35px; margin:0px; margin-left:7px'><b class='f14 blue' style='color:#1f76c8;font-size:14px'>订单明细:</b></p>
        <table class='table' cellpadding='0'  cellspacing='0' style='width:685px; text-align:center; border:1px solid #c9c7c7; border-top:none; margin:0 auto; border-right:none; border-bottom:none'>
            <thead>
                <tr style='background:#5783ad; line-height:35px; color:#fff; font-weight:bold; font-size:14px; letter-spacing:1px'>
                <td>时间</td><td>交易类型</td><td>修理厂名称</td><td>订单编号</td><td class='last'>收入（元）</td></tr>
            </thead>
            <tbody>";
                foreach ($data1 as $k1 => $v1) {
                    $payment = $v1['Payment'] == 1 ? '支付宝担保' : '物流代收款';
                    $class = $k1 % 2 != 0 ? ';background:#eef6fd' : '';
                    $message.="<tr style='line-height:30px" . $class . "'><td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . date('Y-m-d', $v1['CreateTime']) . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $payment . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v1['BuyerName'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v1['No'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>￥" . $v1['Price'] . "</td>
                </tr>";
                }
                $message.="</tbody></table> <p class='line30' style='line-height:35px; margin:0px; margin-left:7px'><b class='f14 blue' style='color:#1f76c8;font-size:14px'>退货明细:</b></p>
        <table class='table' cellpadding='0'  cellspacing='0' style='width:685px; text-align:center; border:1px solid #c9c7c7; border-top:none; margin:0 auto; border-right:none; border-bottom:none'>
            <thead>
                <tr style='background:#5783ad; line-height:35px; color:#fff; font-weight:bold; font-size:14px; letter-spacing:1px'>
                <td>时间</td><td>退款方式</td><td>修理厂名称</td><td>退货单号</td><td class='last'>支出（元）</td></tr>
            </thead>
            <tbody>";
                foreach ($data2 as $k2 => $v2) {
                    $payment = $v2['Payment'] == 0 ? '支付宝担保' : '物流代收款';
                    $v['BuyerName'] = Organ::model()->findByPk($v2['BuyerID'], array('select' => 'OrganName'))->attributes['OrganName'];
                    $class = $k2 % 2 != 0 ? ';background:#eef6fd' : '';
                    $message.="<tr style='line-height:30px" . $class . "'><td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . date('Y-m-d', $v2['CreateTime']) . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $payment . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v2['BuyerName'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v2['No'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>￥" . $v2['Price'] . "</td>
                </tr>";
                }
                $message.="</tbody></table></div></body></html>";
                UserModule::sendMail($v['Email'], $subject, $message);
                Yii::app()->mailer->ClearAddresses();
            }
        }
        Yii::log(date('Y-m-d H:i:s') . " [SendaccountEmail] end \n", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [SendaccountEmail] end \n";
    }

}