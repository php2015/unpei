<?php

class SMS {

    //域名:http://hb.ums86.com    IP:http://114.80.227.120
    private static $SEND_URL = "http://114.80.227.120:8899/sms/Api/Send.do";
    private static $REPORT_URL = "http://114.80.227.120:8899/sms/Api/report.do";
    private static $REPLY_URL = "http://114.80.227.120:8899/sms/Api/reply.do";
    private static $REPLY_CONFIRM_URL = "http://114.80.227.120:8899/sms/Api/replyConfirm.do";
    private static $SMS_NUM_URL = "http://114.80.227.120:8899/sms/Api/SearchNumber.do";

    public function __construct() {
        
    }

    /**
     * 给企业用户发送短信
     * @param string $SpCode 					企业编号
     * @param string $LoginName 			用户名称
     * @param string $Password 				用户密码
     * @param string $MessageContent 	短信内容, 最大700个字符
     * @param string $UserNumber 			手机号码(多个号码用”,”分隔)，最多1000个号码
     * @param string $SerialNumber 			流水号，20位数字，唯一
     * @param string $ScheduleTime 			预约发送时间，格式:yyyyMMddhhmmss,如‘20090901010101’，立即发送请填空
     * @param string $ExtendAccessNum 	接入号扩展号
     * @param string $f 								提交时检测方式：为”1“ 提交号码中有效的号码仍正常发出短信，无效的号码在返回参数faillist中列出，不为1 或该参数不存在 --- 提交号码中只要有无效的号码，那么所有的号码都不发出短信，所有的号码在返回参数faillist中列出
     * 外部调用方法
     * $sms=new SMS();
     * $ret = $sms->sendMessage("200518", "zx_zshy", "zs0166", "发送测试", "15377076988", "", "", "", "1");
     */
    public function sendMessage($SpCode, $LoginName, $Password, $MessageContent, $UserNumber, $SerialNumber, $ScheduleTime, $ExtendAccessNum, $f) {
        if (empty($SpCode) || empty($LoginName) || empty($Password)) {
            return array("code" => "-1", "SMS" => "企业编号或者用户名或密码为空", "data" => array());
        }
        if (empty($MessageContent) || strlen($MessageContent) > 700) {
            return array("code" => "-1", "SMS" => "短信内容不能为空且最大字符为700个", "data" => array());
        }
        $MessageContent = iconv("UTF-8", "GB2312//IGNORE", $MessageContent);
        if ($UserNumber == '') {
            return array("code" => "-1", "SMS" => "手机号不能为空", "data" => array());
        }
        $phone_arr = explode(",", $UserNumber);
        if (empty($phone_arr) || count($phone_arr) > 1000) {
            return array("code" => "-1", "SMS" => "手机号不能为空且手机号码最大数量为1000", "data" => array());
        }
        $data["SpCode"] = $SpCode;
        $data["LoginName"] = $LoginName;
        $data["Password"] = $Password;
        $data["MessageContent"] = $MessageContent;
        $data["UserNumber"] = $UserNumber;
        $data["SerialNumber"] = $SerialNumber;
        $data["ScheduleTime"] = $ScheduleTime;
        $data["ExtendAccessNum"] = $ExtendAccessNum;
        $data["f"] = $f;
        $return = Sms::call(SMS::$SEND_URL, $data);
        $return = iconv("GB2312", "UTF-8", $return);
        $return = explode("&", $return);
        $ret_arr = array();
        foreach ($return as $val) {
            list($key, $value) = explode("=", $val);
            if ($key == "result") {
                $ret_arr["code"] = $value;
            } elseif ($key == "description") {
                $ret_arr["SMS"] = $value;
            } elseif ($key == "faillist") {
                $ret_arr["data"] = array("faillist" => $value);
            }
        }
        return $ret_arr;
    }

    /**
     * 企业方通过调用http回执接口获取短信回执信息
     * @param string $SpCode 					企业编号
     * @param string $LoginName 			用户名称
     * @param string $Password 				用户密码
     */
    public function getMessage($SpCode, $LoginName, $Password) {
        if (empty($SpCode) || empty($LoginName) || empty($Password)) {
            return array("code" => "-1", "SMS" => "企业编号或者用户名或密码为空", "data" => array());
        }
        $data["SpCode"] = $SpCode;
        $data["LoginName"] = $LoginName;
        $data["Password"] = $Password;
        $return = SMS::call(SMS::$REPORT_URL, $data);
        list($result, $out) = explode("&", $return);
        if ($result != 0) {
            return array("code" => "-1", "SMS" => "返回的数据为空", "data" => array());
        } else {
            $out = explode(";", $out);
            $ret_data = array();
            foreach ($out as $value) {
                list($SerialNumber, $phone, $result) = explode(",", $value);
                array_push($ret_data, array("SerialNumber" => $SerialNumber, "mdn" => $phone, "result" => $result));
            }
            return array("code" => "0", "SMS" => "成功", "data" => $ret_data);
        }
    }

    /**
     * 短信上行回复查询
     * @param string $SpCode 					企业编号
     * @param string $LoginName 			用户名称
     * @param string $Password 				用户密码
     */
    public function getReplyMessage($SpCode, $LoginName, $Password) {
        if (empty($SpCode) || empty($LoginName) || empty($Password)) {
            return array("code" => "-1", "SMS" => "企业编号或者用户名或密码为空", "data" => array());
        }
        $data["SpCode"] = $SpCode;
        $data["LoginName"] = $LoginName;
        $data["Password"] = $Password;
        $return = SMS::call(SMS::$REPLY_URL, $data);
        $return = iconv("GB2312", "UTF-8", $return);
        //curl错误
        if (strstr($return, 'curlerrornum')) {
            $return = explode("&", $return);
            $res=array();
            foreach ($return as $value) {
                list($key, $val) = explode("=", $value);
                if($key=='curlerrornum'){
                   $res['error']=$val;
                }elseif($key=='errormsg'){
                    $res['msg']=$val;
                }
            }
            return $res;
        }
        $return = explode("&", $return);
        $ret_arr = array();
        $datas = array();
        foreach ($return as $value) {
            list($key, $val) = explode("=", $value);
            if ($key == "result") {
                $ret_arr["code"] = $val;
                if ($val == 0) {
                    $ret_arr["SMS"] = "成功";
                } else {
                    $ret_arr["SMS"] = "失败";
                }
            } elseif ($key == "confirm_time") {
                $ret_arr["data"]["confirm_time"] = $val;
            } elseif ($key == "id") {
                $ret_arr["data"]["id"] = $val;
            } elseif ($key == "replys") {
                $ret_arr["data"]["replys"] = json_decode($val, true);
            }
        }
        return $ret_arr;
    }

    /**
     * 短信上行回复查询
     * @param string $SpCode 					企业编号
     * @param string $LoginName 			用户名称
     * @param string $Password 				用户密码
     * @param string $id							上次查询返回的最后一条回复的id号
     */
    public function getReplyConfirmMessage($SpCode, $LoginName, $Password, $id) {
        if (empty($SpCode) || empty($LoginName) || empty($Password)) {
            return array("code" => "-1", "SMS" => "企业编号或者用户名或密码为空", "data" => array());
        }
        $data["SpCode"] = $SpCode;
        $data["LoginName"] = $LoginName;
        $data["Password"] = $Password;
        $data["id"] = $id;
        $return = SMS::call(SMS::$REPLY_CONFIRM_URL, $data);
        $ret_arr = array();
        list($key, $val) = explode("=", $return);
        $ret_arr["code"] = $val;
        if ($val == 0) {
            $ret_arr["SMS"] = "成功";
        } else {
            $ret_arr["SMS"] = "失败";
        }
        return $ret_arr;
    }

    /**
     * 企业方通过调用http回执接口获取短信剩余条数
     * @param string $SpCode 					企业编号
     * @param string $LoginName 			用户名称
     * @param string $Password 				用户密码
     */
    public function getRemainNum($SpCode, $LoginName, $Password) {
        if (empty($SpCode) || empty($LoginName) || empty($Password)) {
            return array("code" => "-1", "SMS" => "企业编号或者用户名或密码为空", "data" => array());
        }
        $data["SpCode"] = $SpCode;
        $data["LoginName"] = $LoginName;
        $data["Password"] = $Password;
        $return = SMS::call(SMS::$SMS_NUM_URL, $data);
        $return = iconv("GB2312", "UTF-8", $return);
        $return = explode("&", $return);
        foreach ($return as $value) {
            list($key, $val) = explode("=", $value);
            if ($key == "result") {
                $ret_arr["code"] = $val;
                if ($val == 0) {
                    $ret_arr["SMS"] = "成功";
                } else {
                    $ret_arr["SMS"] = "失败";
                }
            } elseif ($key == "description") {
                $ret_arr["data"]["description"] = $val;
            } elseif ($key == "number") {
                $ret_arr["data"]["number"] = $val;
            }
        }
        return $ret_arr;
    }

    public static function call($url, $datas = '', $timeout = 10, $outheader = false) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $list = array();
        if ($datas) {
            foreach ($datas as $key => $value) {
                $list[] = $key . '=' . $value;
            }
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $list));
        }

        if ($outheader) {
            curl_setopt($ch, CURLOPT_HEADER, true);
        }

        $ret = @curl_exec($ch);
        if (curl_errno($ch)) {
            $ret = 'curlerrornum=' . curl_errno($ch) . '&errormsg=' . curl_error($ch);
        }

        // 关闭URL请求
        curl_close($ch);
        /* 		if($execCode != 0) {
          throw new Asf_Exception("call remote $url, POST: ".var_export($datas, true). " failed: ".curl_error($ch), $execCode);
          return NULL;
          } */
        return $ret;
    }

}