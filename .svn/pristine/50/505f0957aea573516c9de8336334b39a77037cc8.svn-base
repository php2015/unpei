<ul class="order_bg">
    <li>
        <span class="order_step state">拍下宝贝</span>
        <span class="datatime"></span>

    </li>
    <li  class="state">
        <span class="order_step state">
        <?php if ($paytype == 1): ?>
                付款到支付宝
            <?php else: ?>
                物流代收款
            <?php endif; ?>
        </span>
        <span class="datatime"><?php echo date("Y-m-d H:i:s",$order['CreateTime'])?></span>
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
    <i class="step-point step-point2"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/papmall/sanjiao2.png"></i>
    <div class="order_step_bd">
        <div class="trade-status">
            <?php if ($paytype == 1): ?>
                <b>当前订单状态：买家已付款，等待商家发货</b>
            <?php else: ?>
                <b>当前订单状态：等待商家发货</b>
            <?php endif; ?>
            <ul class="m-top">
                <!--                    <li class="m-top">1.您可以 <a  href="">提醒卖家发货 </a>（付款24小时后）</li>
                                    
                                    <li class="m-top">2.如果您不想购买，可以 <a href="">申请退款</a></li>-->
            </ul>
               <dl class="wlxx m-top">
                <dt>物流公司：</dt>
                <dd><?php echo  !empty($order['ShipLogis']) ? $order['ShipLogis'] : '未填写' ?></dd>
                <dt>运单号码：</dt>
                <dd><?php echo isset($order['ShipSn']) ? $order['ShipSn'] : '无' ?></dd>
            </dl>                  

        </div>
    </div>
</div>