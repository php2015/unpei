<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pap/jxs.css"/>
<style>
    .order_state_hd li{ float:left; }
    .order_state_hd{ background:#EFF4FA; height:30px; line-height: 30px}
    tr.order_bd td {vertical-align: middle;}
</style>
<script>
    $(document).ready(function() {
        $('table tbody tr').css('background', 'none');
    })
</script>
<?php
$this->breadcrumbs = array(
    '采购管理',
    '订单总览' => Yii::app()->createUrl('pap/orderreview/index'),
    '订单详情'
        )
?>
<!--待付款进度条-->
<?php if (isset($order) && $order['order']['Status'] == 1): ?>
    <?php echo $this->renderPartial('payhead', array('order' => $order['order'])) ?>
<?php endif; ?>
<!--待发货进度条-->
<?php if (isset($order) && $order['order']['Status'] == 2): ?>
    <?php echo $this->renderPartial('shiphead', array('paytype' => $order['order']['Payment'], 'order' => $order['order'])); ?>
<?php endif ?>
<!--待收货-->
<?php if (isset($order) && $order['order']['Status'] == 3): ?>
    <?php echo $this->renderPartial('receipthead', array('order' => $order, 'paytype' => $order['order']['Payment'])); ?>
<?php endif; ?>
<!--待收货-->
<?php if (isset($order) && $order['order']['Status'] == 9): ?>
    <?php echo $this->renderPartial('finishhead', array('order' => $order, 'paytype' => $order['order']['Payment'])); ?>
<?php endif; ?>
<?php if (isset($order) && $order['order']['Status'] == 10): ?>
    <?php echo $this->renderPartial('canclehead'); ?>
<?php endif; ?>
<div class="bor_back m-top">              
    <div  class="ddxx"><p>订单信息</p></div>
    <div class="info-box ">
        <p class="m-top20"><b>收货地址：</b><span class="m-left5"><?php echo isset($address['ShippingName']) ? $address['ShippingName'] : '' ?>，
                <?php echo isset($address['Mobile']) ? $address['Mobile'] : '' ?>，
                <?php echo Area::getCity($address['Province']) . ' ' . Area::getCity($address['City']) . ' ' . Area::getCity($address['Area']) . ' ' . $address['Address'] ?>，
                <?php echo $address['ZipCode']; ?>
            </span></p>
<!--        <p class=" m-top20"><b>买家留言：</b><span class="m-left"></span></p>-->

        <!--                          <div class="m-top20"  style="border-bottom:1px solid #ebebeb">
                                     <b style="vertical-align:top" class="float_l">补充留言：</b> 
                                     <div class="float_l">
                                     <textarea class="textarea" style="height:80px; width:500px"></textarea><br>
                                  <span class="message m-top m-left5">付款前，您可以对留言信息进行补充。</span><span class="m_left120">还可以输入<span>150</span>字</span><span class="m_left20"><button class="button7">确 定</button></span>
                                     </div>-
                <div style="clear:both"></div>
                <p class="m-top"></p>
        
            </div>-->

        <p class="m-top20"><b>卖家信息</b></p>
        <ul class="mjxx m-top">
            <li>机构名称：<span><?php echo isset($dealer['OrganName']) ? $dealer['OrganName'] : '' ?></span></li>
            <li>联系电话：<span><?php echo isset($dealer['Phone']) ? $dealer['Phone'] : '' ?></span></li>
            <li>地址：<span>  <?php echo Area::getCity($dealer['Province']) . Area::getCity($dealer['City']) . Area::getCity($dealer['Area']) ?></span></li>
            <div style="clear:both"></div>
            <p class="m-top20"></p>
        </ul>

        <div style=" clear: both"></div>
        <p class="m-top20"><b>订单信息</b></p>
        <ul class="mjxx m-top last">
            <li>订单编号：<span><?php echo $order['order']['OrderSN'] ?></span></li>
            <li>下单时间：<span><?php echo date("Y-m-d H:i:s", $order['order']['CreateTime']); ?></span></li>
            <?php
            $paystr = '';
            if ($order['order']['Payment'] == 1) {
                $time = $order['order']['PayTime'] ? date("Y-m-d H:i:s", $order['order']['PayTime']) : '';
                $paystr.="<li>付款时间：<span>" . $time . "</span></li>";
                $paystr.="<li>支付宝交易号：<span>" . $order['order']['AlipayTN'] . "</span></li>";
            }
            switch ($order['order']['Status']) {
                case '2':
                    break;
                case '3':
                    $time = $order['order']['DeliveryTime'] ? date("Y-m-d H:i:s", $order['order']['DeliveryTime']) : '';
                    $paystr.="<li>发货时间：<span>" . $time . "</span></li>";
                    break;
                case '9':
                    $time1 = $order['order']['DeliveryTime'] ? date("Y-m-d H:i:s", $order['order']['DeliveryTime']) : '';
                    $time2 = $order['order']['ReceiptTime'] ? date("Y-m-d H:i:s", $order['order']['ReceiptTime']) : '';
                    $paystr.="<li>发货时间：<span>" . $time1 . "</span></li>";
                    $paystr.="<li>收货时间：<span>" . $time2 . "</span></li>";
                    break;
            }
            echo $paystr;
            ?>
          
             <div style="clear:both"></div>
            <p class="m-top20"></p>
        </ul>
        <div style="clear:both"></div>
        <?php if(!empty($huodong)):?>
        <p class="m-top20"><b>优惠信息</b></p>
        <ul class="mjxx m-top last">
              <?php if(!empty($huodong) && isset($huodong['CouponSn'])):?>
                <li>优惠券编号：<span><?php echo $huodong['CouponSn']?></span></li>
                <li>优惠券面值：<span><?php echo '￥'.$huodong['Amount']?></span></li>
            <?php elseif(!empty($huodong) && isset($huodong['Title'])):?>
                <li>活动标题：<span><a href="<?php echo $huodong['Url']?>"><?php echo $huodong['Title']?></a></span></li>
                <li>已经减满金额：<span><?php echo '￥'.$huodong['Amount']?></span></li>           
            <?php endif;?>
        </ul>
        <?php endif;?>
         <div style="clear:both"></div>
        <p class="m-top"></p>

        <table class="m-top20 order_table">
            <thead>
                <tr class="order_state_hd">
                    <td>商品信息</td>
                    <td>单价（元）</td>
                    <td> 数 量 </td>
                    <?php echo $order['order']['Status'] == 3 || $order['order']['Status'] == 9 ? '<td>PN号</td>' : ''; ?>
                    <td> 状 态 </td>
                    <td>商品总价（元）</td></tr>
            </thead> 
            <tbody>
                <?php
                if (is_array($order['goodsList'])):
                    $count = count($order['goodsList']);
                    foreach ($order['goodsList'] as $key => $list):
                        ?>
                        <tr class="order_bd">
                            <td width="490">
                                <div class="div_img float_l m_left12 m-top">
                                    <a  class="order_goods" title="<?php echo $list['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $list['GoodsID'])) ?>" 
                                        target='_blank' version="<?php echo $list['Version'] ?>" order="<?php echo $order['order']['ID'] ?>">
                                            <?php if ($list['ImageUrl']): ?>
                                            <img src="<?php echo F::uploadUrl() . $list['ImageUrl'] ?>" width="90px" height="90px" style="margin-top:15px">
                                        <?php else: ?>
                                            <img src="<?php echo F::uploadUrl() . 'common/default-goods.png' ?>" width="90px" height="90px" style="margin-top:15px">
                                        <?php endif; ?>
                                    </a>
                                </div> 
                                <div class="div_info float_l m-left5" style="width:300px">
                                    <b><a class="order_goods" title="<?php echo $list['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $list['GoodsID'])) ?>" 
                                          target='_blank' version="<?php echo $list['Version'] ?>" order="<?php echo $order['order']['ID'] ?>" style="font-size:14px"><?php echo $list['GoodsName'] ?>
                                        </a>
                                    </b>
                                    <p class="">商品编号：<span class="zwq_color"><?php
                                            if (strlen($list['GoodsNum']) > 12) {
                                                $plll = substr($list['GoodsNum'], 0, 12);
                                                echo '<a style="color:#fb540e;cursor:pointer" title="' . $list['GoodsNum'] . '">' . $plll . '…</a>';
                                            } else {
                                                echo $list['GoodsNum'];
                                            }
                                            ?></span> | 品牌：<span><?php echo $list['Brand'] ?></span></p>
                                    <p class="">标准名称：<span><?php echo $list['CpName'] ?></span></p>
                                    <p>配件档次：<span><?php echo $list['PartsLevelName']; ?></span></p>
                                    <p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">定位车型：<span title='<?php echo $list['Carmodeltxt']; ?>'><?php echo $list['Carmodeltxt']; ?></span></p>
                                    <p style="height:20px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"> OE号：<span><a title="<?php echo $list['GoodsOE'] ?>" style="cursor:pointer"><?php echo $list['GoodsOE'] ?></a></span> </p>
                                </div>
                            </td> 
                            <td width="80">
                                <?php if ($list['ProPrice'] && $list['ProPrice'] != $v['Price']): ?>    <!--有优惠价且优惠价与参考价不相等时 -->
                                    <?php if ($list['ProPrice'] && $list['ProPrice'] < $list['Price']): ?>
                                        <div style="height:20px;"><s>￥<?php echo $list['Price'] ?></s></div>
                                    <?php endif; ?>
                                    <div >
                                        <span style="color:#eb7616">￥<?php echo $list['ProPrice']; ?></span></div>
                                <?php else: ?>
                                    <div style="width:50px"><span style="color:#eb7616">
                                            ￥<?php echo $list['Price']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </td> 
                            <td width="40"><span ><?php echo $list['Quantity'] ?></span></td>
                            <?php if ($order['order']['Status'] == 3 || $order['order']['Status'] == 9): ?>
                                <td width="100"><p style="word-break:break-all;word-wrap:break-word; white-space:normal;max-width:100px;"><?php echo $list['PN']; ?></p></td>
                            <?php endif; ?>
                            <?php if ($key == 0): ?>
                                <td rowspan="<?php echo $count ?>" width="80"> <span><?php echo SellerorderService::showOrderStatus($order['order']['Status'], $order['order']['ReturnStatus']); ?></span></td>   
                            <?php endif; ?>
                            <td width="110"> 
                                <?php $oldTotal = $list['ProPrice'] ? $list['ProPrice'] * $list['Quantity'] : $list['Price'] * $list['Quantity'] ?>
                                <?php $subTotal = sprintf('%.2f', $oldTotal) ?>
                                <div class="zwq_color">
                                    ￥<?php echo $subTotal ?>
                                </div></td>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>                 
        </table>
        <?php //if (!empty($order['order']['Discount'])):     ?>
        <!--            <div style="height:15px;margin-top:15px; float: right;">
                        <span style="font-size: 13px;margin:20px;">
        <?php
//                    if ($order['order']['OrderType'] == 1)
//                        $n = '商城';
//                    if ($order['order']['OrderType'] == 2)
//                        $n = '询价单';
//                    if ($order['order']['OrderType'] == 3)
//                        $n = '报价单';
//                    if ($order['order']['Payment'] == 1)
//                        echo $n.'支付宝订单折扣率：';
//                    elseif ($order['order']['Payment'] == 2)
//                        echo $n.'物流代收订单折扣率：';
        ?>
                            <span style="color:#E97816; font-weight: bold;"><?php echo $order['order']['Discount'] ?></span></span>
                    </div>-->
        <?php //endif;     ?>
        <!-- <div style="clear:both;height:10px;"></div>
         <div style="height:15px;float: right;">
             <span style="margin:20px; font-size: 13px;">运费:￥<?php echo!empty($order['order']['ShipCost']) ? $order['order']['ShipCost'] : '0.00' ?></span>
         </div>-->
        <!--   <div style="clear:both;height:10px;"></div>
        <?php //if (!empty($order['order']['Discount'])):     ?>
             <div style="height:15px;float: right;">
                  <span style="font-size: 13px;margin:20px;">订单金额：<s><?php echo '￥' . $order['order']['TotalAmount'] ?></s></span>
              </div>-->
        <?php //endif;     ?>
        <div style="clear:both"></div>

        <p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color"><?php echo '￥' . $order['order']['TotalAmount'] ?></span></p>
        <br />
        <div style="text-align:right"><input type="button"  class="button button2"id="goback" value="返回列表" /></div>
    </div>
</div>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="Order">
</form>
<script>
    //商品详情
    $('.order_goods').bind('click', function() {
        var url = this.href;
        $('input[name=Version]').val($(this).attr('version'));
        $('input[name=Order]').val($(this).attr('order'));
        $('#goodsform').attr('action', url);
        $('#goodsform').submit();
        return false;
    })

    $('#goback').click(function() {
        var url = Yii_baseUrl + '/pap/orderreview/index';
        window.location.href = url;
    })
</script>