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
            <?php endif; ?>
        </span>
        <span class="datatime"></span>
    </li>
    <li  class="state">
        <span class="order_step state">卖家发货</span>
        <span class="datatime"><?php echo date("Y-m-d H:i:s", $order['order']['DeliveryTime']) ?></span>
    </li>
    <li class="step_last">
        <span class="order_step state">确认收货</span>
        <span class="datatime"></span>
    </li>
</ul> 
<div class="order_step_info">
    <i class="step-point step-point3"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/papmall/sanjiao2.png"></i>
    <div class="order_step_bd">
        <div class="trade-status">
            <b>当前订单状态：卖家已发货，请查看页面下方物流信息了解宝贝寄送情况</b>
            <ul class="m-top">
                <?php if ($order['order']['ReturnStatus'] == 0): ?>
                <?php if($order['order']['Payment']==2):?>
                    <li class="m-top">1.如果您已收到货，且对商品满意，你可以 <button id='detailconfirm' key='<?php echo $order['order']['ID'] ?>'class="button7">确认收货</button></li>
                <?php else:?>
                      <li class="m-top">1.如果您已收到货，且对商品满意，你可以 <button id='payconfirm' key='<?php echo $order['order']['ID'] ?>'class="button7">确认收货</button></li>
                 <?php endif;?>
             <?php else: ?>
                    <li class="m-top">1.您已拒收该订单！</li>
                <?php endif; ?>
                <input type='hidden' value='<?php echo $_GET['orderid'] ?>'>

                <!--                    <li class="m-top">2.如果还未收到货，请注意自动打款时间，您可以 <a href="">延长收货时间</a> 或者 <a href="">申请退款</a></li>-->
            </ul>
            <p  class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
            <dl class="wlxx m-top">
                <dt>物流公司：</dt>
                <dd><?php echo!empty($order['order']['ShipLogis']) ? $order['order']['ShipLogis'] : '&nbsp;' ?></dd>
                <dt>运单号码：</dt>
                <dd><?php echo!empty($order['order']['ShipSn']) ? $order['order']['ShipSn'] : '&nbsp;' ?></dd>
            </dl>
        </div>
    </div>

</div>
<script>
    $(document).ready(function(){
         $('#payconfirm').click(function() {
                            alert('请到支付宝执行收货操作');
                            var id = $(this).attr('key');
                            window.open(Yii_baseUrl + '/pap/orderreview/payconfirm/id/' + id);
                        });
                        
        $('#detailconfirm').live('click',function(){
            var bool=window.confirm('您确定已经收到货品?');
            if(bool==false){
                return false;
            }
            var getorderid=$('.m-top').find('input[type=hidden]').val();
            var orderid=$(this).attr('key');
            if(getorderid!=orderid)
            {
                alert('您确认收货的订单不一致');
                return false;
            }
            var url=Yii_baseUrl+'/pap/orderreview/Confirmgoods';
            $.getJSON(url,{orderid:orderid},function(data){
                if(data==1){
                    location.href=Yii_baseUrl+'/pap/orderreview/index';
                }
            });
        });
    })
</script>