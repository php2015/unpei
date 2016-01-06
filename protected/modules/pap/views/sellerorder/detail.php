<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    .div_img{padding:8px 8px 0 8px;width:95px}
    .div_img img{width:95px}
    div.div_info{ text-align:left;width:300px}
    tr.order_bd td {vertical-align: middle;}
    .ck_price{text-decoration:line-through;font-weight:400}
    .pro_price{margin-top:5px;color:#fb540e;font-weight:bold}
    .goods_name a{font-size:14px;font-weight:bold;}
    .goods_name{height: 26px;line-height: 26px;overflow: hidden;width: 298px;margin-top:9px}
    .goods_attr{height: 23px;line-height: 23px;overflow: hidden;width: 298px;}
    .goods_side{display:block;float:left}
    .goods_num{max-width:120px;display:block;float:left;cursor:pointer}
    .cut{white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}
</style>
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '订单详情'
);
$returnurl = Yii::app()->request->urlReferrer;
?>
<?php if ($data->Status != 10): ?>
    <ul class="order_bg">
        <li class="<?php if ($data->Status == 1) echo 'state'; ?>">
            <span class="order_step state">拍下宝贝</span>
            <span class="datatime"><?php echo $data->CreateTime ? date('Y-m-d H:i:s', $data->CreateTime) : ''; ?></span>
        </li>
        <li class="<?php if ($data->Status == 2) echo 'state'; ?>">
            <?php if ($data->Payment == 1): ?>
                <span class="order_step state">付款到支付宝</span>
                <span class="datatime"><?php echo $data->PayTime ? date('Y-m-d H:i:s', $data->PayTime) : ''; ?></span>
            <?php else: ?>
                <span class="order_step state">物流代收款</span>
                <span class="datatime"><?php echo $data->CreateTime ? date('Y-m-d H:i:s', $data->CreateTime) : ''; ?></span>
            <?php endif; ?>       
        </li>
        <li class="<?php if ($data->Status == 3) echo 'state'; ?>">
            <span class="order_step state">卖家发货</span>
            <span class="datatime"><?php echo $data->DeliveryTime ? date('Y-m-d H:i:s', $data->DeliveryTime) : ''; ?></span>
        </li>
        <li class="step_last <?php if ($data->Status == 9) echo 'state'; ?>">
            <span class="order_step state">确认收货</span>
            <span class="datatime"><?php echo $data->ReceiptTime ? date('Y-m-d H:i:s', $data->ReceiptTime) : ''; ?></span>
        </li>
        <div style="clear:both"></div>
    </ul>
    <div class="order_step_info">
        <i class="step-point" status="<?php echo $data->Status ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/images/sanjiao2.png"></i>
    <?php else: ?>
        <div class="order_step_info m-top">
        <?php endif; ?>
        <div class="order_step_bd">
            <div class="trade-status">
                <?php
                if ($data->Payment == 1) {
                    $pay = '（支付宝担保）';
                    $statusinfo2 = "当前订单状态：买家已付款{$pay}，请您尽快发货";
                } else {
                    $pay = '（物流代收款）';
                    $statusinfo2 = "当前订单状态：买家已下单{$pay}，请您尽快发货";
                }
                if ($data->ReturnStatus != 0) {
                    $statusinfo3 = "当前订单状态：买家已拒收{$pay}，请查看页面下方物流信息";
                } else {
                    $statusinfo3 = "当前订单状态：您已发货{$pay}，请查看页面下方物流信息";
                }
                switch ($data->Status) {
                    case '1':
                        ?>
                        <b>当前订单状态：宝贝已拍下</b>
                        <ul class='m-top'>
                            <li class='m-top'>1.等待买家付款</li>
                        </ul>
                        <?php
                        break;
                    case '2':
                        ?>
                        <b><?php echo $statusinfo2; ?></b>
                        <ul class='m-top'>
                            <li class='m-top'>1.点击这里 <button class='button2 send' order="<?php echo $data->ID ?>">发货</button></li>
                        </ul>
                        <?php
                        break;
                    case '3':
                        ?>
                        <b><?php echo $statusinfo3; ?></b>
                        <ul class='m-top'>
                        </ul>
                        <?php
                        break;
                    case '9':
                        ?>
                        <b>当前订单状态：交易已成功<?php echo $pay ?></b>
                        <ul class='m-top'>
                        </ul>
                        <?php
                        break;
                    default:
                        ?>
                        <b>当前订单状态：交易取消</b><span class="m_left20" style="color:#9A999B">取消原因：买家取消了该订单</span>
                        <?php
                        break;
                }
                ?>
                <p class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
                <dl class="wlxx m-top">
                    <dt>物流公司：</dt>
                    <dd><?php echo $data->ShipLogis ? $data->ShipLogis : '&nbsp;' ?></dd>
                    <dt>运单号码：</dt>
                    <dd><?php echo $data->ShipSn ? $data->ShipSn : '&nbsp;' ?></dd>
                    <!--                            <dt>物流跟踪：</dt>
                                                <dd><ol><li class="">2014-07-28 08:54:13&nbsp;卖家已发货&nbsp;</li>
                                                        <li>......</li></ol></dd>-->
                </dl>
            </div>
        </div>
    </div>
    <div class="bor_back m-top">              
        <div  class="ddxx"><p>订单信息</p></div>
        <div class="info-box ">
            <p class="m-top20"><b>收货地址：</b>
                <span class="m-left5"><?php echo SellerorderService::getOrderAddress($data->ID) ?></span></p>
<!--            <p class=" m-top20"><b>买家留言：</b>
                <span class="m-left"></span></p>-->
            <p class="m-top20"><b>买家信息</b></p>
            <?php $addr = SellerorderService::getSellerOrgan($data->BuyerID); ?>
            <ul class="mjxx m-top" style="height:40px">
                <li>机构名称：<span><?php echo $data->BuyerName ? $data->BuyerName : $addr['OrganName']; ?></span></li>
                <li>联系电话：<span><?php echo $addr['phone'] ?></span></li>
                <li>城市：<span><?php echo $addr['citys'] ?></span></li>
            </ul>
            <div style="clear:both"></div>
            <p class="m-top20"><b>订单信息</b></p>
            <ul class="mjxx m-top last">
                <li>订单编号：<span><?php echo $data->OrderSN ?></span></li>
                <li>下单时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
                <?php
                $paystr = '';
                if ($data->Payment == 1) {
                    $time = $data->PayTime ? date("Y-m-d H:i:s", $data->PayTime) : '';
                    $paystr.="<li>付款时间：<span>" . $time . "</span></li>";
                    $paystr.="<li>支付宝交易号：<span>$data->AlipayTN</span></li>";
                }
                switch ($data->Status) {
                    case '2':
                        break;
                    case '3':
                        $time = $data->DeliveryTime ? date("Y-m-d H:i:s", $data->DeliveryTime) : '';
                        echo "<li>发货时间：<span>" . $time . "</span></li>";
                        break;
                    case '9':
                        $time1 = $data->DeliveryTime ? date("Y-m-d H:i:s", $data->DeliveryTime) : '';
                        $time2 = $data->ReceiptTime ? date("Y-m-d H:i:s", $data->ReceiptTime) : '';
                        echo "<li>发货时间：<span>" . $time1 . "</span></li>";
                        echo "<li>收货时间：<span>" . $time2 . "</span></li>";
                        break;
                    default:break;
                }
                echo $paystr;
                ?>
                <div style="clear:both"></div>
                <p class="m-top20"></p>
            </ul>
            <div style="clear:both"></div>
            <p class="m-top"></p>

            <table class="m-top20 order_table">
                <thead>
                    <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td> 数量 </td>
                        <?php echo $data->Status == 3 || $data->Status == 9 ? '<td>PN号</td>' : ''; ?><td> 状 态 </td><td>商品总价（元）</td></tr>
                </thead> 
                <tbody>
                    <?php
                    if ($data->goodsinfo): $count = count($data->goodsinfo);
                        foreach ($data->goodsinfo as $k => $v):
                            ?>
                            <tr class="order_bd">
                                <td width="490">
                                    <div class="div_img float_l">
                                        <a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                                            <?php if (!$v['ImageUrl']): ?>
                                                <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="90px" height="90px" style="margin-top:20px">
                                            <?php else: ?>
                                                <img src="<?php echo F::uploadUrl() . $v['ImageUrl']; ?>" width="90px" height="90px" style="margin-top:20px">
                                            <?php endif; ?>
                                        </a>
                                    </div> 
                                    <div class="div_info float_l m-left5">
                                        <p class="goods_name cut">
                                            <a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                                                <?php echo $v['GoodsName'] ?></a>
                                        </p>
                                        <p class="goods_attr"><span class='goods_side'>商品编号：</span>
                                            <span class="zwq_color goods_num cut" title='<?php echo $v['GoodsNum'] ?>'><?php echo $v['GoodsNum'] ?></span>
                                            <span class='goods_side'>&nbsp;|&nbsp;品牌：<?php echo $v['Brand'] ?></span>
                                        </p>
                                        <p class="goods_attr">标准名称：<span><a title="<?php echo $v['CpName'] ?>"><?php echo $v['CpName'] ?></a></span></p>
                                        <p class="goods_attr">配件档次：<span><a title="<?php echo $v['PartsLevelName'] ?>"><?php echo $v['PartsLevelName'] ?></a></span> </p>
                                        <p class="goods_attr cut">定位车型：<span><a title="<?php echo $v['Carmodeltxt'] ?>"><?php echo $v['Carmodeltxt'] ?></a></span> </p>
                                        <p class="goods_attr cut">OE号：<span><a title="<?php echo $v['GoodsOE'] ?>"><?php echo $v['GoodsOE'] ?></a></span> </p>
                                    </div>
                                </td>  
                                <?php if ($v->Price != $v->ProPrice): ?>
                                    <td width="80"><div class="ck_price">￥<?php echo $v->Price ?></div>
                                        <div class="pro_price">￥<?php echo $v->ProPrice ?></div>
                                    </td>
                                <?php else: ?>
                                    <td width="80"> <span class="zwq_color">￥<?php echo $v->ProPrice ?></span></td> 
                                <?php endif; ?>
                                <td width="50"><span ><?php echo $v->Quantity ?></span></td>  
                                <?php if ($data->Status == 3 || $data->Status == 9): ?>
                                    <td width="100"><p style="word-break:break-all;word-wrap:break-word; white-space:normal;max-width:100px;"><?php echo $v->PN; ?></p></td>
                                <?php endif; ?>
                                <?php if ($k == 0): ?>
                                    <td rowspan="<?php echo $count ?>" width="80"> <span><?php echo SellerorderService::showOrderStatus($data->Status, $data->ReturnStatus) ?></span></td>               
                                    <td rowspan="<?php echo $count ?>" width="110">  <div class="zwq_color">￥<?php echo $data->GoodsAmount ?></div></td>
                                <?php endif; ?>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>                 
            </table>
            <p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color">￥<?php echo $data->RealPrice ?></span></p>
            <div style="text-align:right;margin-top:10px"><input type="button"  class="button button2"id="goback" value="返回列表" /></div>
        </div>
    </div>
    <form action="" method="POST" id="goodsform" target="_blank">
        <input type="hidden" name="Version">
        <input type="hidden" name="GoodsID">
    </form>
    <form action="<?php echo Yii::app()->createUrl('pap/sellerorder/sendorder'); ?>" method="POST" id="sendfm">
        <input type="hidden" name="sendstr">
    </form>
    <script>
        $(document).ready(function() {
            var status = $('i.step-point').attr('status');
            switch (status) {
                case '1':
                    $('i.step-point').css({'left': '12%'});
                    break;
                case '2':
                    $('i.step-point').css({'left': '37%'});
                    break;
                case '3':
                    $('i.step-point').css({'left': '62%'});
                    break;
                case '9':
                    $('i.step-point').css({'left': '87%'});
                    break;
            }
            $(".title_lm li").click(function() {
                $(this).addClass("current");
                $(this).siblings().removeClass("current");

            })

            //商品详情
            $('.order_goods').bind('click', function() {
                var url = this.href;
                $('input[name=Version]').val($(this).attr('version'));
                $('input[name=GoodsID]').val($(this).attr('goodsid'));
                $('#goodsform').attr('action', url);
                $('#goodsform').submit();
                return false;
            })

            //订单发货
            $('.send').live('click', function() {
                var sendstr = $(this).attr('order');
                sendOrder(sendstr);
            })
            $("table tbody tr").mouseover(function() {
                $(this).css("background", "white")
            })

            $('#goback').click(function() {
                var returnurl = "<?php echo $returnurl; ?>";
                // if (returnurl && (returnurl.indexOf('pap/sellerorder/send') > 0 || returnurl.indexOf('pap/sellerorder/index') > 0))
                if (returnurl)
                    window.history.go(-1);
                else
                    window.location.href = Yii_baseUrl + '/pap/sellerorder/index';
            })
        })

        //发货
        function sendOrder(sendstr) {
            var url = Yii_baseUrl + '/pap/sellerorder/send';
            $.ajax({
                url: url,
                type: 'POST',
                data: {'sendstr': sendstr},
                dataType: 'JSON',
                success: function(data)
                {
                    if (data.error)
                    {
                        alert(data.msg);
                        if (data.error == 1) {
                            location.reload();
                            $.fn.yiiListView.update(
                                    "goodslistview"
                                    )
                        }
                    }
                    else if (data.success)
                    {
                        $('#sendfm').find('input[name="sendstr"]').val(sendstr);
                        $('#sendfm').submit();
                    }
                }
            })
        }

    </script>