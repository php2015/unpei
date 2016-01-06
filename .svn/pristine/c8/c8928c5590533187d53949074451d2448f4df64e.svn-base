<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '销售管理'=>Yii::app()->createUrl('common/saleslist'),
    '退货管理'=>Yii::app()->createUrl('pap/dealerreturn/index'),
    '退货单详情',
);
?>  
<?php if ($data->Status != 10): ?>
    <ul class="order_bg">
        <li>
            <span class="order_step state">申请退货</span>
            <span class="datatime"><?php // echo $data->CreateTime ? date('Y-m-d H:i:s', $data->CreateTime) : '';                           ?></span>
        </li>
        <li class="<?php if ($data->Status == 1) echo 'state'; ?>">
            <span class="order_step state">审核退货</span>
            <span class="datatime"><?php // echo $data->AccountTime ? date('Y-m-d H:i:s', $data->AccountTime) : '';                           ?></span>
        </li>
        <li class="<?php if ($data->Status == 2) echo 'state'; ?>">
            <span class="order_step state">买家发货</span>
            <span class="datatime"><?php // echo $data->DeliveryTime ? date('Y-m-d H:i:s', $data->DeliveryTime) : '';                           ?></span>
        </li>
        <li class="step_last <?php if ($data->Status == 3) echo 'state'; ?>">
            <span class="order_step state">确认收货</span>
            <span class="datatime"><?php // echo $data->ReceiptTime ? date('Y-m-d H:i:s', $data->ReceiptTime) : '';                           ?></span>
        </li>
        <li class="step_last <?php if ($data->Status == 4) echo 'state'; ?>">
            <span class="order_step state">退货完成</span>
            <span class="datatime"><?php // echo $data->ReceiptTime ? date('Y-m-d H:i:s', $data->ReceiptTime) : '';                           ?></span>
        </li>
    </ul> 
    <div class="order_step_info">
        <i class="step-point" status="<?php echo $data->Status ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/images/sanjiao2.png"></i>
    <?php else: ?>
        <div class="order_step_info m-top">
        <?php endif; ?>
        <div class="order_step_bd">
            <div class="trade-status">
                <?php
                switch ($data->Status) {
                    case '1':
                        ?>
                        <b>当前退货单状态：退货单已生成，正等待审核</b>
                        <ul class='m-top'>
                        </ul>
                        <?php
                        break;
                    case '2':
                        ?>
                        <b>当前订单状态：审核已通过，正等待发货</b>
                        <ul class='m-top'><li class='m-top'>1.点击这里 <button class='button2'>发货</button></li>
                        </ul>
                        <?php
                        break;
                    case '3':
                        ?>
                        <b>当前订单状态：发货已完成，正等待收货</b>
                        <ul class='m-top'><li class='m-top'>
                        </ul>
                        <p class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
                        <dl class="wlxx m-top">
                            <dt>发货方式：</dt>
                            <dd>快递</dd>
                            <dt>物流公司：</dt>
                            <dd>快捷快递</dd>
                            <dt>运单号码：</dt>
                            <dd>123444444</dd>
                            <dt>物流跟踪：</dt>
                            <dd><ol><li class="">2014-07-28 08:54:13&nbsp;卖家已发货&nbsp;</li>
                                    <li class="">2014-07-27 20:24:08&nbsp;花都狮岭 的 小赵 已收件&nbsp;</li>
                                    <li class="">2014-07-27 22:26:09&nbsp;花都狮岭 的 扫描一 已收件&nbsp;</li>
                                    <li class="">2014-07-27 22:46:26&nbsp;快件离开 花都狮岭 已发往 武汉&nbsp;</li></ol></dd>
                        </dl>
                        <?php
                        break;
                    case '4':
                        ?>
                        <b>当前订单状态：退货已完成</b>
                        <ul class='m-top'>
                        </ul>
                        <p  class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
                        <dl class="wlxx m-top">
                            <dt>发货方式：</dt>
                            <dd>快递</dd>
                            <dt>物流公司：</dt>
                            <dd>快捷快递</dd>
                            <dt>运单号码：</dt>
                            <dd>123444444</dd>
                            <dt>物流跟踪：</dt>
                            <dd>
                                <ol><li class="">2014-07-28 08:54:13&nbsp;卖家已发货&nbsp;</li>
                                    <li class="">2014-07-27 20:24:08&nbsp;花都狮岭 的 小赵 已收件&nbsp;</li>
                                    <li class="">2014-07-27 22:26:09&nbsp;花都狮岭 的 扫描一 已收件&nbsp;</li>
                                    <li class="">2014-07-27 22:46:26&nbsp;快件离开 花都狮岭 已发往 武汉&nbsp;</li>
                                    <li class="">2014-07-27 22:46:26&nbsp;快件离开 广州中心 已发往 武汉中转部&nbsp;</li>
                                    <li class="">2014-07-27 22:46:26&nbsp;快件到达 广州中心 上一站是 花都狮岭&nbsp;</li>                      <li class="">2014-07-27 22:46:26&nbsp;快件离开 花都狮岭 已发往 广州中心&nbsp;</li>
                                    <li class="">2014-07-28 20:01:42&nbsp;快件到达 武汉中转部 上一站是 上海&nbsp;</li>
                                    <li class="">2014-07-28 21:04:27&nbsp;快件离开 武汉中转部 已发往 武昌光谷&nbsp;</li>                      <li class="">2014-07-28 22:26:09&nbsp;快件到达 武汉中转部 上一站是 上海&nbsp;</li>
                                    <li class="">2014-07-29 06:08:02&nbsp;快件到达 武昌光谷 上一站是 武汉中转部&nbsp;</li>                      <li class="">2014-07-29 07:19:24&nbsp;武昌光谷 的 珞瑜路 正在派件&nbsp;</li>
                                    <li class="">2014-07-29 11:37:48&nbsp;快件已签收   签收人拍照签收&nbsp;</li></ol></dd>
                        </dl>
                        <?php
                        break;
                    default:
                        ?>
                        <b>当前订单状态：交易关闭</b><span class="m_left20" style="color:#9A999B">取消原因：超时关闭</span>
                        <p class="m-top">  <button class=" button button4">标记</button></p>
                        <?php
                        break;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="bor_back m-top">              
        <div  class="ddxx"><p>订单信息</p></div>
        <div class="info-box ">
            <p class=" m-top20"><b>退货原因：</b>
                <span class="m-left"><?php echo $data->Result ?></span></p>

            <p class="m-top20"><b>卖家信息</b></p>
            <ul class="mjxx m-top">
                <li>机构名称：<span><?php echo OrderreturnService::idgetorgan($data->DealerID, 'OrganName') ?></span></li>
                <li>联系电话：<span><?php echo OrderreturnService::idgetorgan($data->DealerID, 'Phone') ?></span></li>
                <li>机构地址：<span><?php echo OrderreturnService::idgetorgan($data->DealerID, 'Address') ?></span></li>
                <div style="clear:both"></div>
                <p class="m-top20"></p>
            </ul>

            <p class="m-top20"><b>订单信息</b></p>
            <ul class="mjxx m-top last">
                <li>退货单编号：<span><?php echo $data->ReturnNO ?></span></li>
                <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
                <?php
//                switch ($data->Status) {
//                    default:break;
//                    case '2': echo "<li>支付宝交易号：<span>$data->AlipayTN</span></li><li>付款时间：<span>"
//                        . date('Y-m-d H:i:s', $data->AccountTime) . "</span></li>";
//                        break;
//                    case '3': echo "<li>支付宝交易号：<span>$data->AlipayTN</span></li><li>付款时间：<span>"
//                        . date('Y-m-d H:i:s', $data->AccountTime) . "</span></li><li>发货时间：<span>"
//                        . date('Y-m-d H:i:s', $data->DeliveryTime) . "</span></li>";
//                        break;
//                    case '9': echo "<li>支付宝交易号：<span>$data->AlipayTN</span></li><li>付款时间：<span>"
//                        . date('Y-m-d H:i:s', $data->AccountTime) . "</span></li><li>发货时间：<span>"
//                        . date('Y-m-d H:i:s', $data->DeliveryTime) . "</span></li><li>收货时间：<span>"
//                        . date('Y-m-d H:i:s', $data->ReceiptTime) . "</span></li>";
//                        break;
//                }
                ?>
                <div style="clear:both"></div>
                <p class="m-top20"></p>
            </ul>
            <div style="clear:both"></div>
            <p class="m-top"></p>

            <table class="m-top20 order_table">
                <thead>
                    <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td> 数 量 </td><td> 状 态 </td><td>商品总价（元）</td></tr>
                </thead> 
                <tbody>
                    <?php
                    if ($data->returngoods): $count = count($data->returngoods);
                        foreach ($data->returngoods as $k => $v):
                            ?>
                            <tr class="order_bd">
                                <td>
                                    <div class="div_img float_l m_left12"><img src="../images/0140801152059.jpg"></div> 
                                    <div class="div_info float_l m-left5">
                                        <b style="font-size:14px"><?php echo OrderreturnService::idgetordergoods($v->GoodsID, 'GoodsName'); ?></b>
                                        <p class="m-top5">商品编号：<span class="zwq_color"><?php echo OrderreturnService::idgetordergoods($v->GoodsID, 'GoodsNum'); ?> </span> | 品牌：<span><?php echo OrderreturnService::idgetordergoods($v->GoodsID, 'Brand'); ?> </span></p>
                                        <p class="m-top5">标准名称：<span><?php echo OrderreturnService::idgetordergoods($v->GoodsID, 'CpName'); ?> </span> | 拼音代码：<span>LQQ</span> | 备注：<span>无</span></p>
                                        <p class="m-top5">配件档次：<span>品牌件</span> | OE号：<span><?php echo OrderreturnService::idgetordergoods($v->GoodsID, 'GoodsOE'); ?></span> </p>


                                    </div>
                                </td>               
                                <td> <span class="zwq_color"><?php echo $v->Price ?></span></td> 
                                <td><span ><?php echo $v->Amount ?></span></td>    
                                <?php if ($k == 0): ?>
                                    <td rowspan="<?php echo $count ?>"> <span><?php echo OrderreturnService::showOrderStatus($data->Status) ?></span></td>               
                                    <td rowspan="<?php echo $count ?>">  <div class="zwq_color"><?php echo $data->Price ?></div></td>
                                <?php endif; ?>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>                 
            </table>
             <p align="right" class="m-top f_weight shifukuan"><span class="zwq_color">审核通过</span><span class="zwq_color">审核未通过</span></p>
            <p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color"><?php echo $data->Price ?></span></p>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var status=$('i.step-point').attr('status');
            switch(status){
                case '1':$('i.step-point').css({'left':'12%'});break;
                case '2':$('i.step-point').css({'left':'37%'});break;
                case '3':$('i.step-point').css({'left':'62%'});break;
                case '9':$('i.step-point').css({'left':'87%'});break;
            }
            $(".title_lm li").click(function(){
                $(this).addClass("current");
                $(this).siblings().removeClass("current");

            })	
           
        })
    </script>