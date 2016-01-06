<?php

class MakernotifyController extends Controller {

    /**
     * 清空过滤器列表
     * @see Controller::filters()
     */
    public function filters() {
        return array(
        );
    }

    /**
     *    支付完成后返回的URL，在此只进行提示，不对订单进行任何修改操作,这里不严格验证，不改变订单状态
     *
     *    @author    Garbin
     *    @return    void
     */
    function actionIndex() {
        //这里是支付宝，财付通等当订单状态改变时的通知地址
        $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0; //哪个订单
        if (!$order_id) {
            /* 无效的通知请求 */
            $this->show_warning('forbidden');
            Yii::app()->end();
        }

        /* 获取订单信息 */
        //$order_info  = JpOrder::model()->findByPk($order_id);
        //$order_info  =  JporderService::getOrder($order_id);
        $order_info = DealerorderService::getOrder($order_id);
        if (empty($order_info)) {
            /* 没有该订单 */
            $this->show_warning('forbidden');
            Yii::app()->end();
        }

        /* 支付方式 */
        $paymentMethod = $order_info['payment'];
        if ($paymentMethod != '1') {
            /* 支付方式方式错误  */
            $this->show_warning('no_alipay_payment');
            Yii::app()->end();
        }
        $payment = Yii::app()->dalipay;

        /* ----------通知验证开始---------- */
//        $notify_result = $payment->verify_notify($order_info, true);
        $notify_result = $payment->dealer_notify($order_info, true);
        if ($notify_result === false) {
            /* 支付失败 */
            $this->show_warning($payment->get_error());
            /* 记录日志 */
            //$payment->put_log(false,'return');
            Yii::app()->end();
        }
        /* ----------通知验证结束---------- */

        #TODO 临时在此也改变订单状态为方便调试，实际发布时应把此段去掉，订单状态的改变以notify为准
        //$this->_change_order_status($order_id, $notify_result);

        /* 记录日志 */
        //$payment->put_log(true,'return');

        /* 只有支付时会使用到return_url，所以这里显示的信息是支付成功的提示信息 */
        //echo '支付成功';
        $notify = $_GET;
        //$redirectUrl = Yii::app()->createUrl('mall/jporder/paypal');
        $redirectUrl = Yii::app()->createUrl('mall/order/index');
        $this->render('success', array('order_info' => $order_info, 'notify' => $notify, 'redirectUrl' => $redirectUrl));
    }

    /**
     *    支付完成后，外部网关的通知地址，在此会进行订单状态的改变，这里严格验证，改变订单状态
     *
     *    @author    Garbin
     *    @return    void
     */
    function actionNotify() {
        //这里是支付宝，财付通等当订单状态改变时的通知地址
        $order_id = 0;
        if (isset($_POST['order_id'])) {
            $order_id = intval($_POST['order_id']);
        } else {
            $order_id = intval($_GET['order_id']);
        }
        if (!$order_id) {
            /* 无效的通知请求 */
            $this->show_warning('no_such_order');
            Yii::app()->end();
        }

        /* 获取订单信息 */
        //$order_info  = JpOrder::model()->findByPk($order_id);
        //$order_info = JporderService::getOrder($order_id);
        $order_info = DealerorderService::getOrder($order_id);
        if (empty($order_info)) {
            /* 没有该订单 */
            $this->show_warning('no_such_order');
            Yii::app()->end();
        }

        /* 获取支付方式 */
        $paymentMethod = $order_info['payment'];
        if ($paymentMethod != '1') {
            /* 支付方式方式错误  */
            $this->show_warning('no_alipay_payment');
            Yii::app()->end();
        }
        $payment = Yii::app()->dalipay;

        /* ----------通知验证开始---------- */
//        $notify_result = $payment->verify_notify($order_info, true);
        $notify_result = $payment->dealer_notify($order_info, true);
        if ($notify_result === false) {
            /* 支付失败 */
            $payment->verify_result(false);
            /* 记录错误日志 */
            //$payment->put_log(false,'notify');
            Yii::app()->end();
        }
        /* ----------通知验证结束---------- */

        //改变订单状态
        $this->_change_order_status($order_id, $notify_result);
        $payment->verify_result(true);
        /* 记录成功日志 */
        //$payment->put_log(true,'notify');
// 		if ($notify_result['target'] == ORDER_ACCEPTED)
// 		{
// 			/* 发送邮件给卖家，提醒付款成功 */
// 			$model_member =& m('member');
// 			$seller_info  = $model_member->get($order_info['seller_id']);
// 			$mail = get_mail('toseller_online_pay_success_notify', array('order' => $order_info));
// 			$this->_mailto($seller_info['email'], addslashes($mail['subject']), addslashes($mail['message']));
// 			/* 同步发送 */
// 			$this->_sendmail(true);
// 		}
    }

    /**
     *    改变订单状态
     *
     *    @author    Garbin
     *    @param     int $order_id
     *    @param     array  $notify_result
     *    @return    void
     */
    function _change_order_status($order_id, $notify_result) {
        /* 响应通知 */
        //JporderService::respondNotify($order_id, $notify_result);
        DealerorderService::respondNotify($order_id, $notify_result);
    }

    /**
     *    显示错误警告
     *
     */
    function show_warning($msg) {
        $msgstr = Yii::t('paynotify', $msg);
        //$redirectUrl = Yii::app()->createUrl('mall/jporder/paypal');
        $redirectUrl = Yii::app()->createUrl('mall/order/index');
        $this->render('error', array('msg' => $msgstr, 'redirectUrl' => $redirectUrl));
    }

}

?>