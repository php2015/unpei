<?php

//消息提醒服务类
class RemindService {

    public static function saveRemind($params, $organtype = 3) {
        $organ = Organ::model()->findByPk($params['OrganID'], array('select' => 'OrganName,Phone,Email,LinkmanPhone'))->attributes;
        $promoter = Organ::model()->findByPk($params['PromoterID'], array('select' => 'OrganName,Phone,Email'))->attributes;
        switch ($organtype) {
            //生产商
            case '1':break;
            //经销商
            case '2':
                switch ($params['type']['key']) {
                    case '1':
                        $content = $promoter['OrganName'] . '向您下了一笔待付款的订单,订单号为：' . $params['No'] . '!';
                        $link = Yii::app()->CreateUrl('pap/sellerorder/detail', array('ID' => $params['HandleID']));
                        break;
                    case '2':
                        $content = $promoter['OrganName'] . '的订单' . $params['No'] . '待发货,请您尽快发货!';
                        $link = Yii::app()->CreateUrl('pap/sellerorder/detail', array('ID' => $params['HandleID']));
                        //如果是命令行执行
                        if (PHP_SAPI == 'cli') {
                            $link = 'http://www.unipei.com/pap/sellerorder/detail&ID=' . $params['HandleID'];
                        }
                        break;
                    case '3':
                        $content = $promoter['OrganName'] . '向您发布了询价单,单号为：' . $params['No'] . '。请注意确认!';
                        $link = Yii::app()->CreateUrl('pap/inquirylist/viewquo', array('inqid' => $params['HandleID']));
                        break;
                    case '4':
                        $content = $promoter['OrganName'] . '向您申请了退货单' . $params['No'] . '，请尽快审核!';
                        if (in_array($params['THDStatus'], array(11, 12, 13, 14))) {
                            $link = Yii::app()->CreateUrl('pap/dealerreturn/audit2', array('ID' => $params['HandleID']));
                        } else {
                            $link = Yii::app()->CreateUrl('pap/dealerreturn/audit', array('ID' => $params['HandleID']));
                        }
                        break;
                    case '5':
                        $content = $promoter['OrganName'] . '的退货单' . $params['No'] . '已发货，请注意查收！';
                        if (in_array($params['THDStatus'], array(11, 12, 13, 14))) {
                            $link = Yii::app()->CreateUrl('pap/dealerreturn/orderinfo2', array('ID' => $params['HandleID']));
                        } else {
                            $link = Yii::app()->CreateUrl('pap/dealerreturn/orderinfo', array('ID' => $params['HandleID']));
                        }
                        break;
                }
                break;
            //修理厂
            case '3':
                switch ($params['type']['key']) {
                    case '1':
                        $content = "您向" . $promoter['OrganName'] . '下了一笔订单,订单号为 ' . $params['No'] . '。请尽快登录由你配系统付款!';
                        $link = Yii::app()->CreateUrl('pap/orderreview/detail', array('orderid' => $params['HandleID']));
                        break;
                    case '2':
                        $content = "您向" . $promoter['OrganName'] . '下的订单' . $params['No'] . '已发货，请注意收货!';
                        $link = Yii::app()->CreateUrl('pap/orderreview/detail', array('orderid' => $params['HandleID']));
                        break;
                    case '3':
                        $content = $promoter['OrganName'] . '向您发布了报价单,单号为' . $params['No'] . '。请注意确认!';
                        if ($params['link']) {
                            //修理厂先发送了询价单  经销商根据询价单生成报价单
                            $link = $params['link'];
                        } else {
                            $link = Yii::app()->CreateUrl('pap/quotationlist/viewquo', array('quoid' => $params['HandleID']));
                        }
                        break;
                    case '4':
                        $content = "您向" . $promoter['OrganName'] . '申请的退货单' . $params['No'] . '未通过!';
                        if (in_array($params['THDStatus'], array(11, 12, 13, 14))) {
                            $link = Yii::app()->CreateUrl('pap/buyreturn/orderinfo2', array('ID' => $params['HandleID']));
                        } else {
                            $link = Yii::app()->CreateUrl('pap/buyreturn/orderinfo', array('ID' => $params['HandleID']));
                        }
                        break;
                    case '5':
                        $content = "您向" . $promoter['OrganName'] . '申请的退货单' . $params['No'] . '已通过，请尽快发货！';
                        if (in_array($params['THDStatus'], array(11, 12, 13, 14))) {
                            $link = Yii::app()->CreateUrl('pap/buyreturn/send', array('ID' => $params['HandleID']));
                        } else {
                            $link = Yii::app()->CreateUrl('pap/buyreturn/send', array('ID' => $params['HandleID']));
                        }
                        break;
                }
                break;
        }

        $params['content'] = $content;
        $params['linkurl'] = $link;
        $params['organ'] = $organ;
        $params['promoter'] = $promoter;
        //保存到数据库
        self::sendSYSRemind($params);
        //发送邮件
        if (in_array(1, $params['Method'])) {
            self::sendEmailRemind($params);
        }
        //发送短信        
        if (in_array(2, $params['Method'])) {
            self::sendSMSRemind($params);
        }
    }

    //系统发送
    private static function sendSYSRemind($params) {
        $time = time();
        $eff = $time + 3600 * 24 * 2;
        $sql = "insert into pap_remind_business values(null,{$params['OrganID']},{$params['OrganType']},{$params['PromoterID']},"
                . "{$params['PromoterType']},'{$params['content']}','{$params['linkurl']}',$time,$eff," .
                "{$params['HandleID']},{$params['HandleType']},0)";
        Yii::app()->papdb->createCommand($sql)->execute();
    }

    //邮件发送
    private static function sendEmailRemind($params) {
        $subject = '由你配 提醒您';
        $message = $params['organ']['OrganName'] . '：<br/>' . $params['content'];
        $fsock = Yii::app()->params['fsockopen'];
        //   if (!$fsock['open'])
        //      return;
        if ($params['linkurl']) {
            $link = "http://{$_SERVER['HTTP_HOST']}{$params['linkurl']}";
            $message.="<br/>详情点击：<a href='$link'>{$link}</a>";
        }
        $emaildata = array('email' => $params['organ']['Email'], 'subject' => $subject, 'message' => $message);
        self::sock_request($_SERVER['SERVER_ADDR'], $_SERVER['SERVER_PORT'], 30, Yii::app()->createUrl('upload/sendemail'), 'POST', array(), $emaildata);
        //UserModule::sendMail($params['organ']['Email'], $subject, $message);
        Yii::app()->mailer->ClearAddresses();
    }

    //短信发送
    private static function sendSMSRemind($params) {
        $msg = '尊敬的' . $params['organ']['OrganName'] . '客户,' . $params['content'];
        $phone = array();
        switch ($params['OrganType']) {
            case 1:break;
            case 2:$typearr = array('DD' => 1, 'XJD' => 2, 'THD' => 3);
                break;
            case 3:$typearr = array('DD' => 1, 'BJD' => 2, 'THD' => 3);
                break;
        }
        $type = $typearr[$params['type']['name']];
        $remindSet = PapRemindSet::model()->find("OrganID={$params['OrganID']} and Type={$type}")->attributes;
        //发送给机构（BOSS）
        if ($remindSet['IfSend'] == 1) {
            $phone[] = $params['organ']['Phone'];
        }
        //发送给子账户
        if ($remindSet['SonID']) {
            $sql = 'select Phone from jpd_organ_employees where ID=' . $remindSet['SonID'];
            $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
            if ($res['Phone']) {
                $phone[] = $res['Phone'];
            }
        }
        //发送给其他
        if ($remindSet['OtherPhone']) {
            $phone[] = $remindSet['OtherPhone'];
        }
        $phonestr = implode(',', array_unique($phone));
        $res = F::sendSMS(array(
                    'msg' => $msg,
                    'phone' => $phonestr)
        );
        Yii::app()->getComponent('log');
        Yii::log(date('Y-m-d H:i:s') . '   ' . $msg, 'info', 'order');
        Yii::log(date('Y-m-d H:i:s') . '   ' . json_encode($res), 'info', 'order');
    }

    //获取业务提醒
    public static function getBusinessRemind($params) {
        $pageSize = $params['pageSize'] ? $params['pageSize'] : '10';
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $sql = "select t.* from pap_remind_business t where 1=1";
        if ($params['OrganID']) {
            $sql.=" and OrganID={$params['OrganID']}";
        }
        //时间
        if ($starttime && $endtime) {
            $sql.=" and t.CreateTime >= {$starttime} and t.CreateTime <= {$endtime}+3600*24";
        } else if ($starttime) {
            $sql.=" and t.CreateTime >= {$starttime}";
        } else if ($endtime) {
            $sql.=" and t.CreateTime <= {$endtime}+3600*24";
        }
        if (isset($params['HandleStatus'])) {
            $sql.=" and t.HandleStatus in({$params['HandleStatus']})";
        }
        if ($params['type']) {
            //$sql.=" and t.HandleType ={$params['type']}";
        }
        if ($params['status']) {
            if ($params['status'] == 1) {
                $sql.=" and t.HandleType in(1,2)";
            } else if ($params['status'] == 2) {
                $sql.=" and t.HandleType in(3)";
            } else if ($params['status'] == 3) {
                $sql.=" and t.HandleType in(4,5)";
            }
        }
        $unhandle = $sql . " and HandleStatus=0 order by CreateTime desc";
        $sql.=" order by CreateTime desc";
        $count = Yii::app()->papdb->createCommand(str_replace('t.*', 'count(*)', $sql))->queryScalar();
        $uncount = Yii::app()->papdb->createCommand(str_replace('t.*', 'count(*)', $unhandle))->queryScalar();
        if ($params['handle'] == 'un') {
            $sql = $unhandle;
            $total = $uncount;
        } else {
            $total = $count;
        }
        $data = new CSqlDataProvider($sql, array(
            'totalItemCount' => $total,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        return array('data' => $data, 'count' => $count, 'uncount' => $uncount);
    }

    //获取系统提醒
    public static function getSystemRemind($params) {
        $pageSize = $params['pageSize'] ? $params['pageSize'] : '10';
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $sql = "select t.* from pap_remind_system t where 1=1";
        if ($params['OrganID']) {
            $sql.=" and OrganID={$params['OrganID']}";
        }
        //时间
        if ($starttime && $endtime) {
            $sql.=" and t.CreateTime >= {$starttime} and t.CreateTime <= {$endtime}+3600*24";
        } else if ($starttime) {
            $sql.=" and t.CreateTime >= {$starttime}";
        } else if ($endtime) {
            $sql.=" and t.CreateTime <= {$endtime}+3600*24";
        }
        if (isset($params['type']) && in_array($params['type'], array(0, 1, 2))) {
            $sql.=" and t.Type={$params['type']}";
        }
        $unread = $sql . " and ReadStatus=0 order by CreateTime desc";
        $sql.=" order by CreateTime desc";
        $count = Yii::app()->papdb->createCommand(str_replace('t.*', 'count(*)', $sql))->queryScalar();
        $uncount = Yii::app()->papdb->createCommand(str_replace('t.*', 'count(*)', $unread))->queryScalar();
        if ($params['read'] == 'un') {
            $sql = $unread;
            $total = $uncount;
        } else {
            $total = $count;
        }
        $data = new CSqlDataProvider($sql, array(
            'totalItemCount' => $total,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        return array('data' => $data, 'count' => $count, 'uncount' => $uncount);
    }

    //发送提醒
    public static function sendRemind($params, $arr = array()) {
        switch ($params['OrganType']) {
            case '1':break;
            case '2':
                self::sendDealerRemind($params, $arr);
                break;
            case '3':
                self::sendServiceRemind($params, $arr);
                break;
        }
    }

    private static function sendServiceRemind($params, $model) {
        $set = array('DD' => 1, 'BJD' => 2, 'THD' => 3);
        $type = $set[$params['type']['name']];
        $remindSetService = PapRemindSet::model()->find("OrganID={$params['OrganID']} and Type={$type}")->attributes;
        if ($remindSetService) {
            $exist1 = in_array($params['type']['key'], explode(',', $remindSetService['RemindItem']));
        }
        switch ($type) {
            case 1:
                //$key值 1,2
                if (!$remindSetService && is_array(Yii::app()->params['ServiceRemind']['DD']['children'])) {
                    $exist2 = array_key_exists($params['type']['key'], Yii::app()->params['ServiceRemind']['DD']['children']);
                }
                break;
            // case 'XJD':
            //    break;
            case 2:
                //$key值 3
                if (!$remindSetService && is_array(Yii::app()->params['ServiceRemind']['BJD']['children'])) {
                    $exist2 = array_key_exists($params['type']['key'], Yii::app()->params['ServiceRemind']['BJD']['children']);
                }
                break;
            case 3:
                //$key值 4,5
                if (!$remindSetService && is_array(Yii::app()->params['ServiceRemind']['THD']['children'])) {
                    $exist2 = array_key_exists($params['type']['key'], Yii::app()->params['ServiceRemind']['THD']['children']);
                }
                break;
        }
        if ($exist1 || $exist2) {
            $params['HandleType'] = $params['type']['key'];
            switch ($params['HandleType']) {
                case '1': case'2':
                    $model = $model ? $model : PapOrder::model()->findByPk($params['HandleID']);
                    $params['No'] = $model['OrderSN'];
                    $params['PromoterID'] = $model['SellerID'];
                    break;
                case '3':
                    $model = $model ? $model : PapQuotation::model()->findByPk($params['HandleID']);
                    $params['PromoterID'] = $model['DealerID'];
                    $params['No'] = $model['QuoSn'];
                    break;
                case '4':case '5':
                    $model = $model ? $model : PapreturnOrder::model()->findByPk($params['HandleID']);
                    $params['PromoterID'] = $model['DealerID'];
                    $params['No'] = $model['ReturnNO'];
                    $params['THDStatus'] = $model['Status'];
                    break;
            }
            $params['PromoterType'] = 2;
            if ($params['nosms']) {
                if ($exist1) {
                    $method = explode(',', $remindSetService['Method']);
                    $params['Method'] = array_diff($method, array(2));
                } else {
                    $params['Method'] = array(1);
                }
            } else {
                $params['Method'] = $exist1 === true ? explode(',', $remindSetService['Method']) : array(1, 2);
            }
            RemindService::saveRemind($params, 3);
        }
    }

    private static function sendDealerRemind($params, $model) {
        $set = array('DD' => 1, 'XJD' => 2, 'THD' => 3);
        $type = $set[$params['type']['name']];
        $remindSetService = PapRemindSet::model()->find("OrganID={$params['OrganID']} and Type={$type}")->attributes;
        if ($remindSetService) {
            $exist1 = in_array($params['type']['key'], explode(',', $remindSetService['RemindItem']));
        }
        switch ($type) {
            case 1:
                //$key值 1,2
                if (!$remindSetService && is_array(Yii::app()->params['DealerRemind']['DD']['children'])) {
                    $exist2 = array_key_exists($params['type']['key'], Yii::app()->params['DealerRemind']['DD']['children']);
                }
                break;
            case 2:
                //$key值 3
                if (!$remindSetService && is_array(Yii::app()->params['DealerRemind']['XJD']['children'])) {
                    $exist2 = array_key_exists($params['type']['key'], Yii::app()->params['DealerRemind']['XJD']['children']);
                }
                break;
//            case 'BJD':
//                //$params['HandleType'] = 3;
//                break;
            case 3:
                //$key值 4,5
                if (!$remindSetService && is_array(Yii::app()->params['DealerRemind']['THD']['children'])) {
                    $exist2 = array_key_exists($params['type']['key'], Yii::app()->params['DealerRemind']['THD']['children']);
                }
                break;
        }
        if ($exist1 || $exist2) {
            $params['HandleType'] = $params['type']['key'];
            switch ($params['HandleType']) {
                case '1':case '2':
                    $model = $model ? $model : PapOrder::model()->findByPk($params['HandleID']);
                    $params['No'] = $model['OrderSN'];
                    $params['PromoterID'] = $model['BuyerID'];
                    break;
                case '3':
                    $model = $model ? $model : PapInquiry::model()->findByPk($params['HandleID']);
                    $params['PromoterID'] = $model['OrganID'];
                    $params['No'] = $model['InquirySn'];
                    break;
                case '4':case '5':
                    $model = $model ? $model : PapreturnOrder::model()->findByPk($params['HandleID']);
                    $params['PromoterID'] = $model['ServiceID'];
                    $params['No'] = $model['ReturnNO'];
                    $params['THDStatus'] = $model['Status'];
                    break;
            }
            $params['PromoterType'] = 3;
            $params['Method'] = $exist1 === true ? explode(',', $remindSetService['Method']) : array(1, 2);
            RemindService::saveRemind($params, 2);
        }
    }

    private static function sock_request($host, $port = 80, $time = 30, $getPath = '/', $verb = 'GET', $getdata = array(), $postdata = array()) {
        $fp = fsockopen($host, $port, $errno, $errstr, $time);
        // var_dump($fp);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            $verb = strtoupper($verb);
            $getdata_str = count($getdata) ? '?' : '';
            $postdata_str = '';

            foreach ($getdata as $k => $v) {
                $getdata_str.= urlencode($k) . '=' . urlencode($v) . '&';
            }

            foreach ($postdata as $k => $v) {
                $postdata_str.= urlencode($k) . '=' . urlencode($v) . '&';
            }

            $crlf = "\r\n";
            $req = $verb . ' ' . $getPath . $getdata_str . ' HTTP/1.1' . $crlf;
            $req.= 'Host: ' . $host . $crlf;

            if ($verb == 'POST' && !empty($postdata_str)) {
                $postdata_str = substr($postdata_str, 0, -1);
                $req.= 'Content-Type: application/x-www-form-urlencoded' . $crlf;
                $req.= 'Content-Length: ' . strlen($postdata_str) . $crlf . $crlf;
                $req.= $postdata_str;
            }

            $req.="Connection:Close" . $crlf . $crlf;

            stream_set_timeout($fp, 0, 1000 * 1000);
            fwrite($fp, $req);
            fclose($fp);
        }
    }

    public static function updateRemindStatus($HandleID, $HandleType, $organID = '') {
        $cond = "HandleStatus=0 and HandleType in ($HandleType)";
        if (substr($HandleID, 0, 1) == '(' && substr($HandleID, -1) == ')') {
            $cond.=" and HandleID in $HandleID";
        } else {
            $cond.=" and HandleID = $HandleID";
        }
        if ($organID != 'no') {
            $organID = $organID ? $organID : Yii::app()->user->getOrganID();
            $cond.= " and OrganID = $organID";
        }
        //更新提醒状态
        PapRemindBusiness::model()->updateAll(array(
            'HandleStatus' => 2, //改为已操作
                ), $cond);
    }

    //获取信息沟通数据
    public static function getInfo($params) {
        $organID = $params['organID'] ? $params['organID'] : Yii::app()->user->getOrganID();
        $pinyin = $params['pinyin'];
        $pageSize = intval($params['rows']) ? intval($params['rows']) : 24;
        $select = "distinct dv.OrganID,dv.MakeID,q.qq,q.qqname,fm.name,fm.pyf,fm.CarLogo,o.OrganName,o.Phone";
        $sql = "SELECT $select
                FROM `jpd_dealer_vehicles` dv 
                left join (select OrganID,GROUP_CONCAT(QQ) as qq,GROUP_CONCAT(Name) as qqname from jpd_cs_qq GROUP BY OrganID) as q
                on dv.OrganID=q.OrganID
                join jpd_front_makes fm on dv.MakeID=fm.MakeID 
                join jpd_organ o on dv.OrganID=o.ID 
                where o.UnionID=(select UnionID from jpd_organ where ID=$organID)
                and o.IsFreeze='0' and o.Status='1' and o.Identity=2";
        if ($pinyin && preg_match('/[A-Za-z]+/', $pinyin)) {
            $sql.=" and fm.pyf like '$pinyin%'";
            $sql.="  order by fm.pyf asc,dv.OrganID asc";
        } else {
            $sql.="  order by dv.OrganID asc,fm.pyf asc";
        }
        $total = Yii::app()->jpdb->createCommand(str_replace($select, 'count(distinct dv.OrganID,fm.name)', $sql))->queryScalar();
        $data = new CSqlDataProvider($sql, array(
            'totalItemCount' => $total,
            'db' => Yii::app()->jpdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
//        $imgarr = self::getArr();
//        $datas = $data->getData();
//        foreach ($datas as $k => $v) {
//            $datas[$k]['Image'] = $imgarr[$v['MakeID']];
//        }
//        $data->setData($datas);
        return array('data' => $data, 'count' => $total);
    }

    //获取信息沟通make拼音
    public static function getMakepin($params) {
        $organID = $params['organID'] ? $params['organID'] : Yii::app()->user->getOrganID();
        $sql = "SELECT 
            distinct fm.pyf
            FROM `jpd_dealer_vehicles` dv 
            join jpd_front_makes fm on dv.MakeID=fm.MakeID 
            join jpd_organ o on dv.OrganID=o.ID 
            where o.UnionID=(select UnionID from jpd_organ where ID=$organID)
            and o.IsFreeze='0' and o.Status='1' and o.Identity=2 order by pyf asc";
        $res = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $data = array();
        foreach ($res as $v) {
            $py = strtoupper(substr(self::checkFirstName($v["pyf"]), 0, 1));
            if (!in_array($py, $data)) {
                $data[] = $py;
            }
        }
        return $data;
    }

    //获取图片数组
    private static function getArr() {
        return array(
            '11000000' => "/images/carlogo/l1.jpg", //斯柯达 上海大众斯柯达
            '23000000' => "/images/carlogo/l16.jpg", //马自达 一汽马自达
            '24000000' => "/images/carlogo/l16.jpg", //马自达 长安马自达
            '14000000' => "/images/carlogo/l8.jpg", //东风雪铁龙 东风雪铁龙
            '2000000' => "/images/carlogo/l9.jpg", //日产  东风日产
            '3000000' => "/images/carlogo/l9.jpg", //日产  郑州日产
            '4000000' => "/images/carlogo/l9.jpg", //日产  进口日产
            '12000000' => "/images/carlogo/l10.jpg", //凯迪拉克  上海通用凯迪拉克
            '25000000' => "/images/carlogo/l10.jpg", //凯迪拉克  进口凯迪拉克
            '5000000' => "/images/carlogo/l11.jpg", //别克 上海通用别克
            '13000000' => "/images/carlogo/l11.jpg", //别克 进口别克
            '6000000' => "/images/carlogo/l12.jpg", //雪弗兰 上海通用雪佛兰
            '1000000' => "/images/carlogo/l13.jpg", //奇瑞  奇瑞汽车
            '7000000' => "/images/carlogo/l17.jpg", //大众 上海大众
                //上汽通用五菱
//            '01' => Yii::app()->theme->baseUrl . "/images/carlogo/l3.jpg",//华晨中华
//            '01' => Yii::app()->theme->baseUrl . "/images/carlogo/l4.jpg",//菲亚特
//            '01' => Yii::app()->theme->baseUrl . "/images/carlogo/l14.jpg",//MG
//            '01' => Yii::app()->theme->baseUrl . "/images/carlogo/l6.jpg",//荣威
//            '01' => Yii::app()->theme->baseUrl . "/images/carlogo/l7.jpg",//标志
                // '01' => Yii::app()->theme->baseUrl . "/images/carlogo/l15.jpg",//海马
        );
    }

    //检测品牌拼音
    private static function checkFirstName($subject) {
        $pattern = '/[A-Za-z]+/';
        preg_match($pattern, $subject, $matches);
        return $matches[0];
    }

    //在线聊天存入mondb chat_session表
    public static function checkSID($params) {
        $sessionid = $params['userid'] > $params['touserid'] ? $params['touserid'] . "_" . $params['userid'] : $params['userid'] . "_" . $params['touserid'];
        $res = Yii::app()->chatmongodb->getDbInstance()->chat_sessions->findOne(array('sessionid' => $sessionid));
        $userid = Yii::app()->user->id;
        $touserid = $params['userid'] == $userid ? $params['touserid'] : $params['userid'];
        //根据参数判断是否声称ID
        if (!$params["notsave"]) {
            if (!$res) {
                Yii::app()->chatmongodb->getDbInstance()->chat_sessions->insert(array(
                    'userid' => $params['userid'],
                    'touserid' => $params['touserid'],
                    'sessionid' => $sessionid
                ));
                Yii::app()->chatmongodb->getDbInstance()->chat_sessions->insert(array(
                    'userid' => $params['touserid'],
                    'touserid' => $params['userid'],
                    'sessionid' => $sessionid
                ));
            }
            return array('sessionid' => $sessionid, 'userid' => $userid, 'touserid' => $touserid);
        } else {
            if (!$res) {
                if ($params["notsave"] > 1) {//大于1则表示非用户来消息
                    return array();
                }
            }
            $userinfo = self::getUserInfo($touserid);
            return array('sessionid' => $sessionid, 'userid' => $userid, 'touserid' => $touserid, 'name' => $userinfo["OrganName"]);
        }
    }

    //在线聊天存入mongodb records表
    public static function saveRecord($params) {
//        $sessionid = $params['userid'] > $params['touserid'] ? $params['touserid'] . $params['userid'] : $params['userid'] . $params['touserid'];
//        $arr = array(
//            'sessionid' => $sessionid,
//            'userid' => $params['userid'],
//            'touserid' => $params['touserid'],
//            'name' => $params['name'],
//            'msg' => $params['msg'],
//            'isread' => $params['isread'],
//            'time' => time()
//        );
        if (is_array($params))
            $collection = Yii::app()->chatmongodb->getDbInstance()->record->insert($params);
        return $collection;
    }

    //获取当前sessionid用户机构信息
    public static function getUserInfo($userid) {
        $sql = "SELECT a.OrganName,a.Logo,d.ID,d.UserName,d.IsMain,d.Online,d.name FROM `jpd_organ` a 
                left join 
                (select b.ID,b.UserName,b.OrganID,b.IsMain,b.Online,c.name from jpd_user b 
                left join jpd_organ_employees c on b.EmployeID=c.ID
                ) as d
                on a.ID=d.OrganID
                where IsBlack='0' and IsFreeze='0' and IsAuth='0' and Status!='0'
                and d.ID=$userid";
        $data = Yii::app()->jpdb->CreateCommand($sql)->queryRow();
        return $data;
    }

    //修改在线状态
    public static function updateonline($userid) {
        if (!isset($userid) || empty($userid)) {
            echo json_encode(array('msg' => '用户id不存在'));
            Yii::app()->end;
        }
        //将用户修改为不在线状态0
        return User::model()->updateByPk($userid, array('online' => 0));
    }

    //获取会话列表
    public static function getSessionList($userid) {
        if ($userid) {
            $res = Yii::app()->chatmongodb->getDbInstance()->chat_sessions->find(array("userid" => $userid));
            $datas = array();
            foreach ($res as $k => $v) {
                $datas[$k] = $v;
                $r = Yii::app()->chatmongodb->getDbInstance()->record->find(array("sessionid" => $v['sessionid']))->sort(array('_id' => -1))->limit(1);
                foreach ($r as $vv) {
                    $datas[$k]['time'] = (int) $vv['time'];
                }
            }
        }
        $result = array();
        if ($datas)
            $result = self::sortdesc($datas, 'time');
        return $result;
    }

    //二维数组按某个键名排序
    /*
     * 例如:$arr=array(array('name'='q','age'=>18),array('name'='q','age'=>17),array('name'='q','age'=>19));
     * 例如上面这个二维数组按照age降序重新生成新的二维数组
     * 方法:sortdesc($arr, 'age', $sort = SORT_DESC)
     */
    public static function sortdesc($datas, $sort_key, $sort = SORT_DESC) {
        $res = array();
        if (is_array($datas)) {
            foreach ($datas as $data) {
                if (is_array($data)) {
                    $res[] = $data[$sort_key];
                } else {
                    return $datas;
                }
            }
        } else {
            return $datas;
        }
        array_multisort($res, $sort, $datas);
        return $datas;
    }

}

?>
