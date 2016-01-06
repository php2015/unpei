<ul class="order_bg">
    <li 
        class="state" >
        <span class="order_step state">拍下宝贝</span>
        <span class="datatime"><?php echo date("Y-m-d H:i:s", $order['CreateTime']) ?></span>
    </li>
    <li>
        <span class="order_step state">付款到支付宝</span>
        <span class="datatime"></span>
    </li>
    <li>
        <span class="order_step state">卖家发货</span>
        <span class="datatime"></span>
    </li>
    <li class="step_last">
        <span class="order_step state">确认收货</span>
        <span class="datatime"></span>
    </li>
</ul> 
<div class="order_step_info">
    <i class="step-point"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/papmall/sanjiao2.png"></i>
    <div class="order_step_bd">
        <div class="trade-status">
            <b>当前订单状态：宝贝已拍下，请您尽快付款</b>
            <ul class="m-top">
                <li class="m-top">1.点击这里
<!--                        <a href="<?php //echo Yii::app()->createUrl('pap/buyorder/payorder',array('id'=>Yii::app()->request->getParam('orderid')))             ?>">-->
                    <button id="prepay" class="button2" key="<?php echo Yii::app()->request->getParam('orderid') ?>" 
                            alipay="<?php echo $order['AlipayTN'] ?>">付款</button></li>
                <!--                    <li class="m-top">2.找亲朋好友帮忙付款，点击 <a>找人代付</a></li>
                                    <li class="m-top">3.如果您不想购买，可以 <a href="">取消订单</a></li>-->
            </ul>
            <p  class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
            <dl class="wlxx m-top">
                <dt>物流公司：</dt>
                <dd><?php echo!empty($order['ShipLogis']) ? $order['ShipLogis'] : '未填写' ?></dd>
                <dt>运单号码：</dt>
                <dd><?php echo isset($order['ShipSn']) ? $order['ShipSn'] : '无' ?></dd>
            </dl>
        </div>
    </div>
</div>
<script>
    $('#prepay').click(function() {
        var alipay = $(this).attr('alipay');
        var id = $(this).attr('key');
        if (!isNaN(id)) {
            if (alipay != 1) {
                if (confirm('是否前往支付宝进行付款，确定后该订单将不能被修改！')) {
                    $(this).attr('alipay', 1);
                    gotoAlipay(id);
                }
            } else {
                gotoAlipay(id);
            }
        }
    });
    //前往支付宝付款
    function gotoAlipay(id) {
        var acurl = Yii_baseUrl + '/pap/buyorder/getaccount';
        var url = Yii_baseUrl + '/pap/buyorder/payorder/id/' + id;
        $.getJSON(acurl, {orderid: id}, function(data) {
            if (data.success == 1) {
                window.open(url, '_blank');
            } else {
                alert(data.failed);
                return false;
            }
        })
    }
</script>