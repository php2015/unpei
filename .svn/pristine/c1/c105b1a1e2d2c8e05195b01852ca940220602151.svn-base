<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/css/cart/gwc.css' ?>" />
<style>
    .title{border:0px;background:#fff}
</style>
<div class="wrap-contents"  style="background:#fff; border:1px solid #ccc;width:990px; padding: 5px; margin-top:5px">
    <p class="gwc_lm"><span class="gwc_lm_info">我的购物车</span></p>
    <div class="step">
        <div class="step_info">
            <ul>
                <li>
                    <i><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/step2.jpg' ?>"></i><br>
                    <span>1.确认商品信息</span>
                </li>
                <li>
                    <i><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/step2.jpg' ?>"></i><br>
                    <span>2.选择收货地址</span>
                </li>
                <li>
                    <i><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/step1.jpg' ?>"></i><br>
                    <span  class="span_color">3.付款</span>
                </li>
            </ul>
        </div> 


    </div>
    <div class=" m-top gwc_list" style=" overflow: hidden;clear: both">
        <div class="gwc_list_info">
            <p class="gwc_list_lm m-top"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/gwc_tb.jpg' ?>"><span>确认订单信息</span></p>
            <?php foreach ($result as $orderArr): ?>
                <p class="m_left10 m-top" style="margin-top:10px;"> 
                    订单编号：<span><?php echo $orderArr['order']['OrderSN']; ?></span> &nbsp;&nbsp; 
                    提交时间：<span><?php echo date("Y-m-d H:i:s", $orderArr['order']['CreateTime']); ?></span> &nbsp;&nbsp; 
                    支付方式：<span><?php
                        if ($orderArr['order']['Payment'] == 1) : echo "支付宝担保交易";
                        elseif ($orderArr['order']['Payment'] == 2): echo "物流代收款";
                        endif;
                        ?></span>  &nbsp;&nbsp;
                    物流公司：<span><?php echo $orderArr['order']['ShipLogis']; ?></span><span class="float_r" style="padding-right:15px">  
                        经销商：<span></span><?php echo $orderArr['order']['SellerName']; ?></span></p>
                <table class="m-top ygsp m_left10" style="margin-top:10px;width:960px">
                    <tr>
                        <td style="color:#ec4800">商品名称</td>
                        <td style="color:#ec4800">商品编号</td>
                        <td style="color:#ec4800">品牌</td>
                        <td style="color:#ec4800">单价</td>
                        <td style="color:#ec4800">数量</td>
                        <td style="color:#ec4800">小计</td></tr>

                    <?php foreach ($orderArr["goodsList"] as $v): ?>
                        <?php $qus+=$v['Quantity']; ?>
                    <?php endforeach; ?>
                    <?php foreach ($orderArr["goodsList"] as $list): ?>
                        <tr>
                            <td class="width200"><a title="<?php echo $list['GoodsName']; ?>">
                                    <?php
                                    echo mb_substr($list['GoodsName'], 0, 10, 'utf-8');
                                    if (strlen($list['GoodsName']) > 10): echo "...";
                                    endif;
                                    ?></td>
                            <td class="width150"><?php echo $list['GoodsNum']; ?></td>
                            <td class="width150"><a title="<?php echo $list['Brand']; ?>">
                                    <?php
                                    echo mb_substr($list['Brand'], 0, 8, 'utf-8');
                                    if (strlen($list['Brand']) > 8): echo "...";
                                    endif;
                                    ?>
                            </td>
                            <td class="width150">
                                ￥
                                <?php echo $list['ProPrice'] ? $list['ProPrice'] : $list['Price']; ?>
                            </td>
                            <td class="width150"><?php echo $list['Quantity']; ?></td>
                            <td class="width150">
                                ￥<?php echo $list['GoodsAmount'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table> 
                <input type="hidden" class="input" name="orderId" value="<?php echo $orderArr['order']['ID']; ?>">
                <?php $OrderAlipay = substr($orderArr['discount']['OrderAlipay'], 0, strlen($orderArr['discount']['OrderAlipay']) - 1); ?>
                <?php $OrderLogis = substr($orderArr['discount']['OrderLogis'], 0, strlen($orderArr['discount']['OrderLogis']) - 1); ?>
                <?php if ($orderArr['order']['OrderType'] == 1): //商城订单 ?>
                    <?php if ($orderArr['order']['Payment'] == 1): ?>
                        <?php if ($orderArr['order']['TotalAmount'] != $orderArr['order']['RealPrice']): ?>
                            <div style="height:15px;margin-top:15px; float: right;">
                <!--                                <span style="font-size: 13px;margin:10px;">商城支付宝担保订单：<span style="color:#E97816; font-weight: bold;"><?php //echo $OrderAlipay/10;                       ?></span>折</span>-->
                            </div>
                            <div style="margin-top:5px"></div>
                            <!--                            <div style="height:15px;float: right;">-->
                            <!--                                <span style="font-size: 13px;margin:20px;">订单金额：<s>￥<?php //echo $orderArr['order']['TotalAmount'];                       ?></s></span>-->
                            <!--                            </div>-->
                        <?php endif; ?>
                    <?php elseif ($orderArr['order']['Payment'] == 2): ?>
                        <?php if ($orderArr['order']['TotalAmount'] != $orderArr['order']['RealPrice']): ?>
                            <div style="height:15px;margin-top:15px; float: right;">
                <!--                                <span style="font-size: 13px;margin:10px;">商城物流代收款订单：<span style="color:#E97816; font-weight: bold;"><?php // echo $OrderLogis/10;                       ?></span>折</span>-->
                            </div>
                            <div style="margin-top:5px"></div>
                            <!--                            <div style="height:15px;float: right;">-->
                            <!--                                <span style="font-size: 13px;margin:20px;">订单金额：<s>￥<?php //echo $orderArr['order']['TotalAmount'];                       ?></s></span>-->
                            <!--                            </div>-->
                        <?php endif; ?>
                    <?php endif; ?>
                <?php elseif ($orderArr['order']['OrderType'] == 2): //询价单订单 ?>
                    <?php if ($orderArr['order']['Payment'] == 1): ?>
                        <?php if ($orderArr['order']['TotalAmount'] != $orderArr['order']['RealPrice']): ?>
                            <!--                            <div style="height:15px;margin-top:15px; float: right;">
                                                            <span style="font-size: 13px;margin:20px;">询价支付宝担保订单：<span style="color:#E97816; font-weight: bold;"><?php //echo $OrderAlipay/10;                       ?></span>折</span>
                                                        </div>-->
                            <div style="clear:both;height:10px;"></div>
                            <div style="height:15px;float: right;">
                                <span style="font-size: 13px;margin:10px;">订单金额：<s>￥<?php echo $orderArr['order']['RealPrice']; ?></s></span>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($orderArr['order']['Payment'] == 2): ?>
                        <?php if ($orderArr['order']['TotalAmount'] != $orderArr['order']['RealPrice']): ?>
                            <!--                            <div style="height:15px;margin-top:15px; float: right;">
                                                            <span style="font-size: 13px;margin:20px;">询价物流代收款订单：<span style="color:#E97816; font-weight: bold;"><?php //echo $OrderLogis/10;                       ?></span>折</span>
                                                        </div>-->
                            <div style="clear:both;height:10px;"></div>
                            <div style="height:15px;float: right;">
                                <span style="font-size: 13px;margin:10px;">订单金额：<s>￥<?php echo $orderArr['order']['TotalAmount']; ?></s></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php elseif ($orderArr['order']['OrderType'] == 3): //报价单订单 ?>
                    <?php if ($orderArr['order']['Payment'] == 1): ?>
                        <?php if ($orderArr['order']['TotalAmount'] != $orderArr['order']['RealPrice']): ?>
                            <div style="height:15px;margin-top:15px; float: right;">
                                <span style="font-size: 13px;margin:20px;">报价支付宝担保订单：<span style="color:#E97816; font-weight: bold;"><?php echo $OrderAlipay / 10; ?></span>折</span>
                            </div>
                            <div style="clear:both;height:10px;"></div>
                            <div style="height:15px;float: right;">
                                <span style="font-size: 13px;margin:20px;">订单金额：<s>￥<?php echo $orderArr['order']['TotalAmount']; ?></s></span>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($orderArr['order']['Payment'] == 2): ?>
                        <?php if ($orderArr['order']['TotalAmount'] != $orderArr['order']['RealPrice']): ?>
                            <!--                            <div style="height:15px;margin-top:15px; float: right;">
                                                            <span style="font-size: 13px;margin:20px;">报价物流代收款订单：<span style="color:#E97816; font-weight: bold;"><?php //echo $OrderLogis/10;                       ?></span>折</span>
                                                        </div>-->
                            <div style="clear:both;height:10px;"></div>
                            <div style="height:15px;float: right;">
                                <span style="font-size: 13px;margin:20px;">订单金额：<s>￥<?php echo $orderArr['order']['TotalAmount']; ?></s></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <p class="m-top zhifu" style="margin-top:30px">支付金额：<span>￥<?php echo $orderArr['order']['RealPrice']; ?></span></p>
                <p class="m-top zhifu">(含运费：￥<?php echo $orderArr['order']['ShipCost'] ? $orderArr['order']['ShipCost'] : 0; ?>)</p>
        <!--        <p class="m-top zhifu zhifu_color">注：商品平摊可能存在误差，以订单合计为主</p>-->
                <?php if ($orderArr['order']['Payment'] == 1) : ?>
                    <?php if ($orderArr['order']['Status'] == 1): ?>
                                                                                                                                                                                        <!--         <p class="m-top zhifu zhifu_color">注：商品平摊可能存在误差，以订单合计为主</p>-->
                        <p class="m-top zhifu">
                            <span class='pod' style="font-size:13px;margin-left:25px;" 
                                  key="<?php echo $orderArr['order']['ID'] ?>" alipay="<?php echo $orderArr['order']['AlipayTN'] ?>">
                                <input type="button" class="submit button2" value="点击付款">
                            </span>
                <!--            <a  onclick="payment()" href="<?php //echo Yii::app()->createUrl("pap/buyorder/payorder/id/" . $orderArr['order']['ID']);                       ?>" target="_blank" style="font-size:13px;margin-left:25px;"><input type="button" class="submit" value="点击付款"><span></a>-->
                <!--            <input type="submit" value="点击付款" class="submit">-->
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <div style="height:26px; float: right;margin-top:0px;">
                    <p class="form-row">
                        <a href="<?php echo Yii::app()->createUrl("pap/orderreview/index") ?>" style="margin: 20px;font-size: 13px;color: #eb4800;">返回订单列表</a>
                    </p>
            </div>
        </div>
    </div>
</div>
   <?php
     $times=OrderService::is_current_date();
    if($_GET['lottid']&&$_GET['promoid']&&$times['Num']==1&&!isset(Yii::app()->session['first'])){  
       // &&$times['Num']==1
       // &&!isset(Yii::app()->session['first'])
    Yii::app()->session['first']=1;
    echo $this->renderPartial('active',array('promoid'=>$promoid));
}
?>
<?php
//添加收货地址
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'pay',
    'options' => array(
//                'title'=>'支付',     
        'width' => 480,
        'height' => 280,
        'autoOpen' => false,
        'resizable' => false,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
//                'buttons'=>array(     
//                    '添加'=>'js:function(){ window.open(Yii_baseUrl + "/pap/default/index","_black");}',     
//                    '取消'=>'js:function(){ $(this).dialog("close");}',     
//                    ),     
    ),
));
$this->renderPartial('paymessage');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?> 

<script>
    $('.pod').find("input[type=button]").click(function(){
        var alipay = $('.pod').attr('alipay');
        var id = $(this).parent().attr('key');
        if (!isNaN(id)) {
            if (alipay != 1) {
                if (confirm('是否前往支付宝进行付款，确定后该订单将不能被修改！')) {
                    $('.pod').attr('alipay', 1);
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
                $('#pay').dialog('open');
                window.open(url, '_blank');
            } else {
                alert(data.failed);
                return false;
            }
        });
    }
    function paySuccess() {
        window.location.reload();
    }
    function payFail() {
        window.open(Yii_baseUrl + "/page/helpcenter", "_blank");
    }
</script>