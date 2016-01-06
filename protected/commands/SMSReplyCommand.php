<?php

/**
 * 读取用户回复短信及后续操作
 */
Yii::import('application.modules.pap.models.*');
Yii::import('application.modules.pap.services.*');

class SMSReplyCommand extends CConsoleCommand {

    public function run() {
        $t1 = microtime(true);
        echo date('Y-m-d H:i:s') . " [SMSReply] start \n";
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . " [SMSReply] start", 'info', 'command');
        $res = F::getReplyMessage();
//        if (!$res['replys']) {
//            $nowtime = date('Y-m-d H:i:s');
//            $res['replys'] = array(
//                array('mdn' => '15377076988', 'content' => 'B171Y', 'id' => '202270567', 'reply_time' => $nowtime)
//            );
//        }
        if ($res['error'] > 0) {
            Yii::log(date('Y-m-d H:i:s') . '  CURL fail:' . $res['msg'], 'info', 'command');
            Yii::log(date('Y-m-d H:i:s') . " [SMSReply] end", 'info', 'command');
            echo date('Y-m-d H:i:s') . " [SMSReply] end \n";
            Yii::app()->end();
        } elseif ($res['code'] > 0) {
            Yii::log(date('Y-m-d H:i:s') . '  SMS fail code:' . $res['code'], 'info', 'command');
            Yii::log(date('Y-m-d H:i:s') . " [SMSReply] end", 'info', 'command');
            echo date('Y-m-d H:i:s') . " [SMSReply] end \n";
            Yii::app()->end();
        }
        if ($res['replys']) {
            $replys = $res['replys'];
            foreach ($replys as $v) {
                $organ = self::getorganinfo($v['mdn']);
                if (!$organ) {
                    //如果机构不存在,确认回复短信,
                    $msg = $v['mdn'] . ' organ not exist! continue!';
                    Yii::log(date('Y-m-d H:i:s') . '  ' . $msg, 'info', 'command');
                    $confirm = F::ConfirmReplyMessage($v['id']);
                    continue;
                } else {
                    //判断回复信息操作
                    $msg = $v['mdn'] . ' organ exist!';
                    if ($v['content'] == '') {
                        $msg = 'reply content is null';
                        Yii::log(date('Y-m-d H:i:s') . '  ' . $msg, 'info', 'command');
                        continue;
                    }
                    $r = self::checkSMS(array_merge(array('msg' => trim($v['content']), 'time' => strtotime($v['reply_time'])), $organ));
                    $confirm = F::ConfirmReplyMessage($v['id']);
                    //echo date('Y-m-d H:i:s') . '  ' . $r['msg'] . "\n";
                    Yii::log(date('Y-m-d H:i:s') . '  ' . $r['msg'], 'info', 'command');
                }
            }
        } else {
            //没有回复短息 程序结束
            Yii::log(date('Y-m-d H:i:s') . " SMSReply is null, exit!", 'info', 'command');
        }
        $t2 = microtime(true);
        $time = round($t2 - $t1, 3) . 's';
        Yii::log(date('Y-m-d H:i:s') . " [SMSReply] run " . $time . " ;end", 'info', 'command');
        echo date('Y-m-d H:i:s') . " [SMSReply] run " . $time . " ;end \n";
    }

    //通过短信回复内容确认不同的操作
    public static function checkSMS($params) {
        //echo date('Y-m-d H:i:s') . json_encode($params) . "\n";
        $params['content'] = $params['msg'];
        $first = strtoupper(substr($params['msg'], 0, 1));
        $end = strtoupper(substr($params['msg'], -1));
        if ($first == 'B' && $params['Identity'] == 3 && ($end == 'Y' || $end == 'N')) {
            $params['msg'] = substr($params['msg'], 0, strlen($params['msg']) - 1);
            $msg = $params['ID'] . '  ' . $params['msg'] . '  SMS format right,start check checksn!';
            $res = self::QuoCreateOrder(array_merge($params, array('operate' => $end)));
            return $res;
        } else {
            $msg = $params['ID'] . '  ' . $params['msg'] . ' SMS format error!';
            return array('success' => false, 'msg' => $msg);
        }
    }

    //修理厂确认报价单信息并生成订单
    public static function QuoCreateOrder($params) {
        $sql = ' select QuoID,InquiryID from `pap_quotation` where CheckSn="' . $params['msg'] . '" and ServiceID=' . $params['ID'] . ' and Status="1"';
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        if (!$res) {
            //没有符合条件的报价单  短信回复内容无效
            $msg = $params['ID'] . '  ' . $params['content'] . '  checksn void!';
            return array('success' => false, 'msg' => $msg);
        } else {
            //获取生成订单需要的参数
            $msg = $params['ID'] . '  ' . $params['content'] . '  checksn valid! start create order';
            $schemesql = ' select SchID from `pap_quotation_scheme` where  QuoID=' . $res['QuoID'];
            $scheme = Yii::app()->papdb->createCommand($schemesql)->queryRow();
            $inqsql = ' select AddressID,Payment,Status from `pap_inquiry` where InquiryID=' . $res['InquiryID'];
            $inqres = Yii::app()->papdb->createCommand($inqsql)->queryRow();
            if ($scheme && $inqres['Status'] == 1 && $params['operate'] == 'Y') {
                //创建订单
                $orderres = InquiryorderService::createorder($res['QuoID'], $scheme['SchID'], $inqres['Payment'], $inqres['AddressID'],2);
                $orderres=  json_decode($orderres, true);
                $orderres['msg'] = $params['ID'] . '  ' . $params['content'] . '  ' . $orderres['msg'];
                if ($orderres['success']) {
//                    $smsmsg='尊敬的'.$params['OrganName'].'客户,您短信确认的报价单方案生成订单成功,订单号为:'.$orderres['ordersn'].'!';
//                    $sms = F::sendSMS(array(
//                                'msg' => $smsmsg,
//                                'phone' => $params['Phone'])
//                    );      
                    Yii::log(date('Y-m-d H:i:s') . " [SMSReply]  order create success", 'info', 'command');
                }
                //更改报价单确认表内容
                $order=$orderres['orderID']?$orderres['orderID']:0;
                $update = ' update pap_quotation_confirm set ReplyTime=' . $params['time'] . ',ReplyContent="' . $params['content'] . '",`Status`=1,`Desc`="' . $orderres['data'] . '",OrderID=' . $order . ' where QuoID=' . $res['QuoID'];
                Yii::app()->papdb->createCommand($update)->execute();
                return $orderres;
            } else if ($scheme && $inqres['Status'] == 1 && $params['operate'] == 'N') {
                //拒绝报价单
                $updatesql = 'update pap_quotation set Status="4" where QuoID=' . $res['QuoID'];
                $count = Yii::app()->papdb->createCommand($updatesql)->execute();
                $updatesql = 'update pap_inquiry set Status="4" where InquiryID=' . $res['InquiryID'];
                $count = Yii::app()->papdb->createCommand($updatesql)->execute();
                $data = '修理厂拒绝';
                //更改报价单确认表内容
                $update = ' update pap_quotation_confirm set ReplyTime=' . $params['time'] . ',ReplyContent="' . $params['content'] . '",`Status`=2, `Desc`="' . $data . '" where QuoID=' . $res['QuoID'];
                Yii::app()->papdb->createCommand($update)->execute();
                $msg = $params['ID'] . '  ' . $params['content'] . ' refuse quotation';
                return array('success' => false, 'msg' => $msg, 'QuoID' => $res['QuoID']);
            } else {
                if (!$scheme) {
                    $msg = $params['ID'] . '  ' . $params['content'] . '  scheme not exist!';
                    $data = '报价单方案不存在';
                }
                $status = array('待报价', '已报价待确认', '已确认', '已撤销', '已拒绝');
                if ($inqres['Status'] != 1) {
                    $msg = $params['ID'] . '  ' . $params['content'] . '  inquiry status is' . $status[$inqres['Status']];
                    $data = '询价单是' . $status[$inqres['Status']] . '状态';
                }
                if ($inqres['Status'] != 1 && !$scheme) {
                    $msg = $params['ID'] . '  ' . $params['content'] . '  scheme not exist! inquiry inquiry status is' . $status[$inqres['Status']];
                    $data = '报价单方案不存在,询价单是' . $status[$inqres['Status']] . '状态';
                }
                //更改报价单确认表内容
                $update = ' update pap_quotation_confirm set ReplyTime=' . $params['time'] . ',ReplyContent="' . $params['content'] . '",`Status`=2,`Desc`="' . $data . ' where QuoID=' . $res['QuoID'];
                Yii::app()->papdb->createCommand($update)->execute();
                return array('success' => false, 'msg' => $msg, 'QuoID' => $res['QuoID']);
            }
        }
    }

    //通过手机号获得机构信息
    public static function getorganinfo($phone) {
        $sql = ' select ID,OrganName,Identity,Phone from `jpd_organ` where Phone="' . $phone . '"';
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $res;
    }

}

?>
