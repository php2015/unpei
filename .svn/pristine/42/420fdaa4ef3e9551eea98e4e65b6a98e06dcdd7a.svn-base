<?php

class AlipayProxy extends CComponent {

    //字符编码格式 目前支持 gbk 或 utf-8
    private $input_charset = "utf-8";
    //签名方式 不需修改
    private $sign_type = "MD5";
    //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
    public $transport = "http";
    //合作身份者id
    public $partner = "2088311760807753";
    //安全检验码，以数字和字母组成的32位字符
    public $key = "fhodlmou66i1z9nr1l9c31s4dgae6ax2";
    //页面跳转同步通知页面路径
    public $return_url = "";
    //服务器异步通知页面路径
    public $notify_url = "";
    //商品展示地址
    public $show_url = "";
    //ca证书路径地址，用于curl中ssl校验
    //public $cacert = getcwd().DIRECTORY_SEPARATOR.'cacert.pem';
    public $cacert = "";
    //配置数组
    private $alipay_config = null;
    //错误信息
    private $_error = "";

    public function init() {
        Yii::import('application.vendors.alipay.lib.*');
        if (empty($this->cacert)) {
            $this->cacert = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cacert.pem';
        }

        $this->alipay_config = array(
            'partner' => $this->partner,
            'key' => $this->key,
            'sign_type' => $this->sign_type,
            'input_charset' => $this->input_charset,
            'transport' => $this->transport,
            'cacert' => $this->cacert,
        );
    }

    //构建支付表单
    public function buildForm($request) {
        $rs = $request->getParams();
        $order_id = $rs["order_id"];
        $seller_email = $rs["seller_email"];
        $parameter = array(
            'partner' => $this->partner,
            'return_url' => $this->_create_return_url($order_id),
            'notify_url' => $this->_create_notify_url($order_id),
            '_input_charset' => $this->input_charset,
            'show_url' => $this->show_url,
            'seller_email' => $seller_email,
        );

        $parameter = array_merge($parameter, $rs);
        //建立请求
        $alipaySubmit = new AlipaySubmit($this->alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        return $html_text;
    }

    //构建建立请求
    public function buildRequestHttp($request) {
        $rs = $request->getParams();
        $parameter = array(
            'partner' => $this->partner,
            '_input_charset' => $this->input_charset,
        );

        $parameter = array_merge($parameter, $rs);
        //建立请求
        $alipaySubmit = new AlipaySubmit($this->alipay_config);
        $html_text = $alipaySubmit->buildRequestHttp($parameter);
        return $html_text;
    }

    //异步通知验证
    public function verifyNotify() {
        $alipayNotify = new AlipayNotify($this->alipay_config);
        return $alipayNotify->notify_verify();
    }

    //同步通知验证
    public function verifyReturn() {
        $alipayNotify = new AlipayNotify($this->alipay_config);
        return $alipayNotify->return_verify();
    }

    /**
     *    获取通知地址
     *
     *    @author    Garbin
     *    @param     int $store_id
     *    @param     int $order_id
     *    @return    string
     */
    public function _create_notify_url($order_id) {
        return $this->notify_url . "?order_id={$order_id}";
    }

    /**
     *    获取返回地址
     *
     *    @author    Garbin
     *    @param     int $store_id
     *    @param     int $order_id
     *    @return    string
     */
    public function _create_return_url($order_id) {
        return $this->return_url . "?order_id={$order_id}";
    }

    /**
     *    将验证结果反馈给网关
     *
     *    @author    Garbin
     *    @param     bool   $result
     *    @return    void
     */
    public function verify_result($result) {
        if ($result) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    /**
     *    获取通知信息
     *
     *    @author    Garbin
     *    @return    array
     */
    public function _get_notify() {
        /* 如果有POST的数据，则认为POST的数据是通知内容 */
        if (!empty($_POST)) {
            return $_POST;
        }

        /* 否则就认为是GET的 */
        return $_GET;
    }

    /**
     *    通知类型
     *
     *    @author    Garbin
     *    @return    array
     */
    public function _is_notify() {
        /* 如果有POST的数据，则认为是异步通知 */
        if (!empty($_POST)) {
            return true;
        }

        /* 否则就认为是GET的 */
        return false;
    }
      /**
     * 经销商支付宝退款给服务店
     */
   function return_notify($order_info, $strict = false)
   {
        if (empty($order_info)) {
            $this->_error('order_info_empty');
            return false;
        }

        /* 初始化所需数据 */
        $notify = $this->_get_notify();

        $alipayNotify = new AlipayNotify($this->alipay_config);

        /* 验证来路是否可信 */
        if ($strict) {
            /* 严格验证 */
            $verify_result = $alipayNotify->queryNotify($notify['notify_id']);
            if (!$verify_result) {
                /* 来路不可信 */
                $this->_error('notify_unauthentic');
                return false;
            }
        }

        /* 验证通知是否可信 */

        $sign_result = $alipayNotify->verifySign($notify);
        if (!$sign_result) {
            /* 若本地签名与网关签名不一致，说明签名不可信 */
            $this->_error('sign_inconsistent');
            return false;
        }

        /* ----------通知验证结束---------- */

        /* ----------本地验证开始---------- */
        /* 验证与本地信息是否匹配 */
        /* 这里不只是付款通知，有可能是发货通知，确认收货通知 */

        if ($order_info['ReturnNO'] != $notify['out_trade_no']) {
            /* 通知中的订单与欲改变的订单不一致 */
            $this->_error('order_inconsistent');

            return false;
        }
        if ($order_info['Price'] != $notify['total_fee']) {
            /* 支付的金额与实际金额不一致 */
            $this->_error('price_inconsistent');

            return false;
        }
        //至此，说明通知是可信的，订单也是对应的，可信的

        /* 按通知结果返回相应的结果 */
        $order_no = '';
        switch ($notify['trade_status']) {
            case 'WAIT_BUYER_PAY':                //等待买家付款
                $order_status = RORDER_READY;     // 10 
                 $trade_no = $notify['trade_no'];
                break;
            case 'WAIT_SELLER_SEND_GOODS':      //买家已付款，等待卖家发货
                $order_status = RORDER_PENDING; // 订单改为付款状态 10
                $trade_no = $notify['trade_no'];
                break;

            case 'WAIT_BUYER_CONFIRM_GOODS':    //卖家已发货，等待买家确认
                $order_status = RORDER_ACCEPTED;  // 订单状态改为 已发货 20  ， 发货状态：DORDER_SELLED 改为10
                break;

            case 'TRADE_FINISHED':              //交易结束
                /* 说明是第三方担保交易，交易结束 */
                $order_status = RORDER_ABNORMAL; // 订单买家确认收货，订单状态完成。  status =30  ，take_status = 30， abn_status = 30
                break;
            
            default:
                $this->_error('undefined_status');
                return false;
                break;
        }
        
      

        switch ($notify['refund_status']) {
            case 'REFUND_SUCCESS':              //退款成功，取消订单
                $order_status = RORDER_CANCLED;
                break;
        }

        /* 记录日志  */
        $this->put_log();
        return array(
            'target' => $order_status,
            'trade_status' => $notify['trade_status'],
            'trade_no' => $trade_no,
        );
   }

    /**
     *    嘉配订单--返回通知结果
     *
     *    @author    Garbin
     *    @param     array $order_info
     *    @param     bool  $strict
     *    @return    array
     */
    function verify_notify($order_info, $strict = false) {
        if (empty($order_info)) {
            $this->_error('order_info_empty');
            return false;
        }

        /* 初始化所需数据 */
        $notify = $this->_get_notify();

        $alipayNotify = new AlipayNotify($this->alipay_config);

        /* 验证来路是否可信 */
        if ($strict) {
            /* 严格验证 */
            $verify_result = $alipayNotify->queryNotify($notify['notify_id']);
            if (!$verify_result) {
                /* 来路不可信 */
                $this->_error('notify_unauthentic');
                return false;
            }
        }

        /* 验证通知是否可信 */

        $sign_result = $alipayNotify->verifySign($notify);
        if (!$sign_result) {
            /* 若本地签名与网关签名不一致，说明签名不可信 */
            $this->_error('sign_inconsistent');
            return false;
        }

        /* ----------通知验证结束---------- */

        /* ----------本地验证开始---------- */
        /* 验证与本地信息是否匹配 */
        /* 这里不只是付款通知，有可能是发货通知，确认收货通知 */

        if ($order_info['OrderSN'] != $notify['out_trade_no']) {
            /* 通知中的订单与欲改变的订单不一致 */
            $this->_error('order_inconsistent');

            return false;
        }
        if ($order_info['RealPrice'] != $notify['total_fee']) {
            /* 支付的金额与实际金额不一致 */
            $this->_error('price_inconsistent');

            return false;
        }
        //至此，说明通知是可信的，订单也是对应的，可信的

        /* 按通知结果返回相应的结果 */
        $order_no = '';
        switch ($notify['trade_status']) {
            case 'WAIT_BUYER_PAY':                //等待买家付款
                $order_status = ORDER_PENDING;
                break;

            case 'WAIT_SELLER_SEND_GOODS':      //买家已付款，等待卖家发货
                $order_status = ORDER_ACCEPTED;
                $trade_no = $notify['trade_no'];
                break;

            case 'WAIT_BUYER_CONFIRM_GOODS':    //卖家已发货，等待买家确认
                $order_status = ORDER_SHIPPED;
                break;

            case 'TRADE_FINISHED':              //交易结束
                /* 说明是第三方担保交易，交易结束 */
                $order_status = ORDER_FINISHED;
                break;

            case 'TRADE_CLOSED':                //交易关闭
                $order_status = ORDER_CANCLED;
                break;

            default:
                $this->_error('undefined_status');
                return false;
                break;
        }
          switch ($notify['refund_status']) {
            case 'WAIT_SELLER_AGREE':
                 $paystatus='WAIT_SELLER_AGREE';
                 break;
             case 'WAIT_BUYER_RETURN_GOODS':
                 $paystatus='WAIT_BUYER_RETURN_GOODS';
                 break;
             case 'WAIT_SELLER_CONFIRM_GOODS':
                 $paystatus='WAIT_SELLER_CONFIRM_GOODS';
                 break;
            case 'REFUND_SUCCESS':              //退款成功，取消订单
                 $paystatus='REFUND_SUCCESS';
                 $order_status = ORDER_CANCLED;
                break;
        }

//        switch ($notify['refund_status']) {
//            case 'REFUND_SUCCESS':              //退款成功，取消订单
//                $order_status = ORDER_CANCLED;
//                break;
//        }

        /* 记录日志  */
        $this->put_log();
        return array(
            'target' => $order_status,
            'trade_status' => $notify['trade_status'],
            'trade_no' => $trade_no,
            'refund'=>$paystatus,
            'refund_status'=>$notify['refund_status']
        );
    }

    /**
     *    触发错误
     *
     *    @author    Garbin
     *    @param     string $errmsg
     *    @return    void
     */
    function _error($msg) {
        $this->_error = $msg;
        /* 记录日志  */
        $this->put_log();
    }

    /**
     *    检查是否存在错误
     *
     *    @author    Garbin
     *    @return    int
     */
    function has_error() {
        return !empty($this->_error);
    }

    /**
     *    获取错误列表
     *
     *    @author    Garbin
     *    @return    array
     */
    function get_error() {
        return $this->_error;
    }

    /**
     * 写入 log 文件
     *
     */
    function put_log() {
        try {
            // 日志文件路径
            $filepath = Yii::app()->runtimePath . "/alipay/";
            if (!is_dir($filepath)) {
                mkdir($filepath, 0770, true);
            }
            // 同步和异步日志分别写入不同的文件
            $notify_type = "notify";
            if (!$this->_is_notify()) {
                $notify_type = "return";
            }
            $filename = $filepath . $notify_type . "_" . date("Ym") . ".log";

            $handler = null;
            if (($handler = fopen($filename, 'a')) !== false) {
                // 日志信息
                $notify = $this->_get_notify();
                $log_text = strftime("%Y-%m-%d %H:%M:%S", time()) . " " . $notify_type;
                $log_text .= " " . $notify['order_id'];
                $log_text .= " " . $notify['out_trade_no'];
                $log_text .= " " . $notify['trade_no'];
                $log_text .= " " . $notify['trade_status'];
                if ($this->has_error()) {
                    $log_text .= " verify_failure:" . $this->get_error();
                } else {
                    $log_text .= " verify_success";
                }
                $log_text .= "\n[" . $this->createLinkString($notify) . "]\n";
                fwrite($handler, $log_text);
                fclose($handler);
                ;
            }
        } catch (Exception $e) {
            
        }
    }

    /**
     * 发货信息写入 log 文件
     * 日志格式：时间 + 订单ID + 订单号 + 支付宝交易号 + 订单状态 + 请求文本  + 支付宝响应文本
     */
    function put_send_goods_log($order_info, $request, $respone, $result = true, $user_id = 0) {
        try {
            // 日志文件路径
            $filepath = Yii::app()->runtimePath . "/alipay/";
            if (!is_dir($filepath)) {
                mkdir($filepath, 0770, true);
            }
            // 成功 和 错误日志分别写入不同的文件
            $filename = $filepath . 'send_' . date("Ym") . ".log";
// 			if($result === true){
// 				$filename = $filepath . 'send_succ_' .date("Ym"). ".log";
// 			}else{
// 				$filename = $filepath . 'send_err_' .date("Ym"). ".log";
// 			}

            $handler = null;
            if (($handler = fopen($filename, 'a')) !== false) {
                // 日志信息
                $log_text = strftime("%Y-%m-%d %H:%M:%S", time()) . " " . $user_id . " " . $order_info['ID'];
                $log_text .= $order_info['OrderSN'] ? " " . $order_info['OrderSN'] : " -";
                $log_text .= $order_info['AlipayTN'] ? " " . $order_info['AlipayTN'] : " -";
                $log_text .= $order_info['Status'] ? " " . $order_info['Status'] : " -";
                $log_text .= "\n[" . $this->createLinkString($request) . "]";
                $log_text .= "\n[" . $respone . "]";
                $log_text .= "\n";
                fwrite($handler, $log_text);
                fclose($handler);
                ;
            }
        } catch (Exception $e) {
            //var_dump($e);
        }
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    function createLinkstring($para) {
        $arg = "";
        while (list ($key, $val) = each($para)) {
            $arg.=$key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }

        return $arg;
    }

    /**
     *    经销商采购订单--返回通知结果
     *
     *    @author    Garbin
     *    @param     array $order_info
     *    @param     bool  $strict
     *    @return    array
     */
    function dealer_notify($order_info, $strict = false) {
        if (empty($order_info)) {
            $this->_error('order_info_empty');
            return false;
        }

        /* 初始化所需数据 */
        $notify = $this->_get_notify();

        $alipayNotify = new AlipayNotify($this->alipay_config);

        /* 验证来路是否可信 */
        if ($strict) {
            /* 严格验证 */
            $verify_result = $alipayNotify->queryNotify($notify['notify_id']);
            if (!$verify_result) {
                /* 来路不可信 */
                $this->_error('notify_unauthentic');
                return false;
            }
        }

        /* 验证通知是否可信 */

        $sign_result = $alipayNotify->verifySign($notify);
        if (!$sign_result) {
            /* 若本地签名与网关签名不一致，说明签名不可信 */
            $this->_error('sign_inconsistent');
            return false;
        }

        /* ----------通知验证结束---------- */

        /* ----------本地验证开始---------- */
        /* 验证与本地信息是否匹配 */
        /* 这里不只是付款通知，有可能是发货通知，确认收货通知 */

        if ($order_info['ship_bill_no'] != $notify['out_trade_no']) {
            /* 通知中的订单与欲改变的订单不一致 */
            $this->_error('order_inconsistent');

            return false;
        }
        if ($order_info['amount'] != $notify['total_fee']) {
            /* 支付的金额与实际金额不一致 */
            $this->_error('price_inconsistent');

            return false;
        }
        //至此，说明通知是可信的，订单也是对应的，可信的

        /* 按通知结果返回相应的结果 */
        $order_no = '';
        switch ($notify['trade_status']) {
            case 'WAIT_BUYER_PAY':                //等待买家付款
               // $order_status = DORDER_PENDING;     // 10 
                $order_status = DORDER_READY;     // 0 
                break;

            case 'WAIT_SELLER_SEND_GOODS':      //买家已付款，等待卖家发货
             //   $order_status = DORDER_ACCEPTED; //
                $order_status = DORDER_PENDING; // 订单改为付款状态 10
                $trade_no = $notify['trade_no'];
                break;

            case 'WAIT_BUYER_CONFIRM_GOODS':    //卖家已发货，等待买家确认
               // $order_status = DORDER_SHIPPED;
                $order_status = DORDER_ACCEPTED;  // 订单状态改为 已发货 20  ， 发货状态：DORDER_SELLED 改为10
                break;

            case 'TRADE_FINISHED':              //交易结束
                /* 说明是第三方担保交易，交易结束 */
                $order_status = DORDER_SHIPPED; // 订单买家确认收货，订单状态完成。  status =30  ，take_status = 30， abn_status = 30
                break;

            case 'TRADE_CLOSED':                //交易关闭
                $order_status = DORDER_CANCLED;  // 废弃订单 status =30  ，take_status = 30，,abn_status = 40
                break;

            default:
                $this->_error('undefined_status');
                return false;
                break;
        }

        switch ($notify['refund_status']) {
            case 'REFUND_SUCCESS':              //退款成功，取消订单
                $order_status = DORDER_CANCLED;
                break;
        }

        /* 记录日志  */
        $this->put_log();
        return array(
            'target' => $order_status,
            'trade_status' => $notify['trade_status'],
            'trade_no' => $trade_no,
        );
    }

    /**
     * 生产商发货信息
     * 发货信息写入 log 文件
     * 日志格式：时间 + 订单ID + 订单号 + 支付宝交易号 + 订单状态 + 请求文本  + 支付宝响应文本
     */
    function put_maker_goods_log($order_info, $request, $respone, $result = true, $user_id = 0) {
        try {
            // 日志文件路径
            $filepath = Yii::app()->runtimePath . "/alipay/";
            if (!is_dir($filepath)) {
                mkdir($filepath, 0770, true);
            }
            // 成功 和 错误日志分别写入不同的文件
            $filename = $filepath . 'send_' . date("Ym") . ".log";
// 			if($result === true){
// 				$filename = $filepath . 'send_succ_' .date("Ym"). ".log";
// 			}else{
// 				$filename = $filepath . 'send_err_' .date("Ym"). ".log";
// 			}

            $handler = null;
            if (($handler = fopen($filename, 'a')) !== false) {
                // 日志信息
                $log_text = strftime("%Y-%m-%d %H:%M:%S", time()) . " " . $user_id . " " . $order_info['ID'];
                $log_text .= $order_info['ship_bill_no'] ? " " . $order_info['ship_bill_no'] : " -";
                $log_text .= $order_info['AlipayTN'] ? " " . $order_info['AlipayTN'] : " -";
                $log_text .= $order_info['status'] ? " " . $order_info['status'] : " -";
                $log_text .= "\n[" . $this->createLinkString($request) . "]";
                $log_text .= "\n[" . $respone . "]";
                $log_text .= "\n";
                fwrite($handler, $log_text);
                fclose($handler);
                ;
            }
        } catch (Exception $e) {
            //var_dump($e);
        }
    }
}