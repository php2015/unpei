<ul class="order_bg">
    <li>
        <span class="order_step state">拍下宝贝</span>
        <span class="datatime"></span>

    </li>
    <li >
        <span class="order_step state">
            <?php if ($paytype == 1): ?>
                付款到支付宝
            <?php else: ?>
                物流代收款
            <?php endif; ?></span>
        <span class="datatime"></span>
    </li>
    <li  >
        <span class="order_step state">卖家发货</span>
        <span class="datatime"></span>
    </li>
    <li class="state step_last">
        <span class="order_step state">确认收货</span>
        <span class="datatime"><?php echo date("Y-m-d H:i:s",$order['order']['ReceiptTime'])?></span>
    </li>
</ul> 
<div class="order_step_info">
    <i class="step-point step-point4"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/papmall/sanjiao2.png"></i>
    <div class="order_step_bd">
        <div class="trade-status">
            <b>当前订单状态：交易已成功</b>
            <ul class="m-top">
                <li class="m-top">1.如果没有收到货，或收到货后出现问题，您可以联系卖家协商解决</li>

                <li class="m-top">2.如果卖家没有履行应尽的承诺，您可以 “投诉维权”</li>
            </ul>
           <dl class="wlxx m-top">
                <dt>物流公司：</dt>
                <dd><?php echo !empty($order['order']['ShipLogis']) ? $order['order']['ShipLogis'] : '未填写' ?></dd>
                <dt>运单号码：</dt>
                <dd><?php echo !empty($order['order']['ShipSn']) ? $order['order']['ShipSn'] : '无' ?></dd>
            </dl>  
        </div>
    </div>

</div>
