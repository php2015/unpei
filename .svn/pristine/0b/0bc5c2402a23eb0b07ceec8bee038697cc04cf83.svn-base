<style>

    .state .order_step2 {
        background: none repeat scroll 0 0 #f2b303;
        color: #fff;
        height: 35px;
        line-height: 35px;
        margin: -1px 10px 0;
        width: 260px;
        font-size: 14px;
        font-weight: bold;
    }

    .order_step2 {
        font-size: 14px;
        font-weight: bold;
    }
    div.div_info{width:400px}
    .name_div{text-align:left}
    .name_div a{}
    .width220{width:220px}
    .text_l{text-align: left}
    .text_l a{font-size: 12px; font-weight:bold}

    .state .order_step3 {
        background: none repeat scroll 0 0 #f2b303;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        height: 35px;
        line-height: 35px;
        margin: -1px 10px 0;
        width: 415px;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '退货管理' => Yii::app()->createUrl('pap/dealerreturn/index'),
    '退货单详情',
);
?>  
<ul class="order_bg">
    <?php if ($data->Status <= 4 && $data->ComplainStatus == 0): ?>
        <li style=" width: 33%">
            <span class="order_step2 state">申请退货</span>
            <span class="datatime"><?php // echo $data->CreateTime ? date('Y-m-d H:i:s', $data->CreateTime) : '';                                                                                                                                                                                            ?></span>
        </li>
        <li style=" width: 33%" class="<?php if ($data->Status == 1) echo 'state'; ?>">
            <span class="order_step2 state">审核退货</span>
            <span class="datatime"><?php // echo $data->AccountTime ? date('Y-m-d H:i:s', $data->AccountTime) : '';                                                                                                                                                                                            ?></span>
        </li>
        <li style=" width: 33%" class="step_last <?php if ($data->Status == 4) echo 'state'; ?>">
            <span class="order_step2 state">退货完成</span>
            <span class="datatime"><?php // echo $data->ReceiptTime ? date('Y-m-d H:i:s', $data->ReceiptTime) : '';                                                                                                                                                                                            ?></span>
        </li>
    <?php elseif ($data->Status == 5 && $data->ComplainStatus == 1): ?>
        <li class="step_last <?php if ($data->ComplainStatus == 1) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉中</span>
        </li>
    <?php elseif ($data->Status == 5 && $data->ComplainStatus == 2): ?>
        <li class="step_last <?php if ($data->ComplainStatus == 2) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉已处理</span>
        </li>
    <?php elseif ($data->Status == 5 && $data->ComplainStatus == 3): ?>
        <li class="step_last <?php if ($data->ComplainStatus == 3) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉已取消</span>
        </li>
    <?php else: ?>
        <li style=" width:50%" class="step_last <?php if ($data->Status == 5) echo 'state'; ?>">
            <span class="order_step3 state">审核未通过</span>
            <span class="datatime"><?php // echo $data->AccountTime ? date('Y-m-d H:i:s', $data->AccountTime) : '';                                                                                                                                                                                            ?></span>
        </li>
        <li style=" width: 50%" class="step_last <?php if ($data->Status == 6) echo 'state'; ?>">
            <span class="order_step3 state">退货取消</span>
            <span class="datatime"><?php // echo $data->ReceiptTime ? date('Y-m-d H:i:s', $data->ReceiptTime) : '';                                                                                                                                                                                            ?></span>
        </li>
    <?php endif; ?>
</ul> 
<?php if ($data->ComplainStatus == 0): ?>
    <div class="order_step_info">
        <i class="step-point" status="<?php echo $data->Status ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/images/sanjiao2.png"></i>
        <div class="order_step_info m-top">
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
                            <!--                        <ul class='m-top'><li class='m-top'>1.点击这里 <button class='button2'>发货</button></li>
                                                    </ul>-->
                            <?php
                            break;
                        case '3':
                            ?>
                            <b>当前订单状态：发货已完成，正等待收货</b>
                            <!--                        <ul class='m-top'><li class='m-top'>
                                                    </ul>
                                                    <p class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
                                                    <dl class="wlxx m-top">
                                                        <dt>发货方式：</dt>
                                                        <dd>快递</dd>
                                                        <dt>物流公司：</dt>
                                                        <dd><?php echo $data->LogtigCompany; ?></dd>
                                                        <dt>运单号码：</dt>
                                                        <dd><?php echo $data->ReShipLogis; ?></dd>
                                                    </dl>-->
                            <?php
                            break;
                        case '4':
                            ?>
                            <b>当前订单状态：退货已完成</b>
                            <!--                        <ul class='m-top'>
                                                    </ul>
                                                    <p  class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
                                                    <dl class="wlxx m-top">
                                                        <dt>发货方式：</dt>
                                                        <dd>快递</dd>
                                                        <dt>物流公司：</dt>
                                                        <dd><?php echo $data->LogtigCompany; ?></dd>
                                                        <dt>运单号码：</dt>
                                                        <dd><?php echo $data->ReShipLogis; ?></dd>
                                                    </dl>-->
                            <?php
                            break;
                        case '5':
                            ?>
                            <b>当前退货单状态：退货单审核未通过，请重新申请</b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        case '6':
                            ?>
                            <b>当前退货单状态：退货单已取消</b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        default:
                            ?>
                            <b>当前订单状态：异常,请联系管理员</b>
                            <?php
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="bor_back m-top">              
    <div  class="ddxx" style="height: 30px">
        <p style="display: block;float: left;" >退货单信息</p>
        <div  style="width: 70px;float: right;padding-left: 30px;"><a onclick="auditexit()" herf="" style="cursor:pointer">返回列表</a></div>
    </div>
    <div class="info-box ">
        <p class=" m-top20"><b>退货原因：</b>
            <span class="m-left"><?php echo $data->Result ?></span></p>
        <?php if ($data->Status == 5): ?>
            <p class=" m-top20"><b>审核未通过原因：</b>
                <span class="m-left"><?php echo $data->NoResult ?></span></p>
        <?php endif; ?>
        <div class="mjxx" style="height:70px">
            <p class="m-top20"><b>买家信息</b></p>
            <ul class="m-top">
                <li>机构名称：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'OrganName') ?></span></li>
                <li>联系电话：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'Phone') ?></span></li>
                <li>机构地址：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'all')->Area ?></span></li>

                <p class="m-top20"></p>
            </ul>
        </div>
        <div style="clear:both"></div>
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

        <?php if ($data->ComplainStatus > 0): ?>
            <p class="m-top20"><b>申诉信息</b></p>
            <ul class="mjxx m-top last">
                <li>申诉状态：<span><?php echo ReturnorderService::getComplainStatus($data->ComplainStatus) ?></span></li>
                <li>申诉时间：<span><?php echo date('Y-m-d H:i:s', $reuslt['AppealTime']) ?></span></li>
                <?php if ($reuslt['HandleTime']): ?>
                    <?php if ($reuslt['ResultStatus'] == 0 && !is_null($reuslt['ResultStatus'])): ?>
                        <li>审核状态：<span>不通过</span></li>
                    <?php elseif ($reuslt['ResultStatus'] == 1): ?>
                        <li>审核状态：<span>通过</span></li>
                    <?php elseif (($reuslt['ResultStatus'] == 2)): ?>
                        <li>审核状态：<span>重新审核</span></li>
                    <?php elseif (is_null($reuslt['ResultStatus'])): ?>
                        <li>审核状态：<span>未审核</span></li>
                    <?php endif; ?>


                    <?php if ($data->ComplainStatus == 2 && $reuslt['ResultStatus'] == 1): ?>
                        <?php if ($reuslt['HandleResult'] == 1) : ?> 
                            <li>汇款状态：
                                <?php if ($reuslt['RemittanceStatus'] == 1): ?>
                                    已汇款(￥<?php echo $reuslt['HandleMoney'] ?>)
                                <?php else: ?>
                                    待汇款(￥<?php echo $reuslt['HandleMoney'] ?>)
                                <?php endif; ?>
                            </li>
                        <?php elseif ($reuslt['HandleResult'] == 0): ?>
                            <li>汇款状态：<span>无需退款</span></li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif ?>
                <div style="clear:both"></div>
                <p class="m-top20"></p>
            </ul>
            <div style="clear:both"></div>
            <p class="m-top"></p>
        <?php endif; ?>

        <table class="m-top20 order_table">
            <thead>
                <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td> 数 量 </td><td> 状 态 </td><td>商品总价（元）</td></tr>
            </thead> 
            <tbody>
                <?php
                if ($data->returngoods): $count = count($data->returngoods);
                    foreach ($data->returngoods as $k => $v):
                        ?>
                        <?php
                        $goods = DealergoodsService::getmongoversion($v['GoodsID'], $v['Version']);
                        ?>
                        <tr class="order_bd">
                            <td>
                                <?php $img = OrderreturnService::idgetimg($v['GoodsID']) ?>
                                <div class="div_img float_l m-top5">
                                    <img src="
                                    <?php
                                    if ($goods['GoodsInfo']['img'][0]['ImageUrl']) {
                                        echo F::uploadUrl() . $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                    } else {
                                        echo F::uploadUrl() . 'common/default-goods.png';
                                    }
                                    ?>" style="width: 90px;height: 100px;">
                                </div> 
                                <div class="div_info float_l m-left5">
                                    <div class="name_div">
                                        <div class="float_l cut width220 text_l">
                                            <a title="<?php echo $goods ? $goods['GoodsInfo']['Name'] : OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'GoodsName'); ?>"><?php echo $goods ? $goods['GoodsInfo']['Name'] : OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'GoodsName'); ?></a>
                                        </div>
                                        <div class="float_l">
                                            <span>&nbsp;&nbsp;订单编号：<?php echo OrderreturnService::orderIDgetorder($v->OrderID, 'OrderSN'); ?></span>
                                        </div>
                                    </div>
                                    <p class="">商品编号：<span class="zwq_color"><?php echo $goods ? $goods['GoodsInfo']['GoodsNO'] : OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'GoodsNum'); ?> </span> | 品牌：<span><?php echo $goods ? $goods['GoodsInfo']['Brand'] : OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'Brand'); ?> </span></p>
                                    <p style=" width: 400px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">标准名称：<span><?php echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'CpName'); ?> </span> | 拼音代码：<span><?php echo $goods ? $goods['GoodsInfo']['Pinyin'] : DealergoodsService::idgetgoods($v->GoodsID, 'Pinyin'); ?></span></p>

                                    <?php
                                    $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $v['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                                    ?>
                                    <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                    <p>配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>
                                    <p style=" width: 400px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">OE号：<span><?php
                                            if ($goods['GoodsInfo']['oeno']) {
                                                foreach ($goods['GoodsInfo']['oeno'] as $key => $value) {
                                                    if ($key) {
                                                        echo '、' . $value;
                                                    } else {
                                                        echo $value;
                                                    }
                                                }
                                            } if (!$goods) {
                                                echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'GoodsOE');
                                            }
                                            ?></span> </p>


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
        <input type="hidden" id="ReturnID" value="<?php echo $data->ID ?>">
        <p align="right" class="m-top f_weight shifukuan" id="auditgo"> 
            <?php if ($data->Status == 1): ?>
                <button  onclick="auditok()">审核通过</button>
                <button  onclick="auditno()">审核未通过</button>
                <button  onclick="auditexit()" >取消</button>
            <?php elseif ($data->Status == 3): ?>
                <button    onclick="getgoods()">确认收货</button>
                <button  onclick="auditexit()" >取消</button>
            <?php endif; ?>



        </p>
       <!--<p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color"><?php // echo $data->Price                                                                                                                                                                         ?></span></p>-->
    </div>
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'auditfail', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '填写审核失败的原因',
        'autoOpen' => false, //是否自动打开 
        'modal' => true, // 层级
        'width' => '480', //宽度  
        'height' => '250', //高度  
        'resizable' => false,
        'buttons' => array(
            '保存' => 'js:function(){ save();}',
            '关闭' => 'js:function(){ $(this).dialog("close");}',
        ),
    ),
));
echo "<div id='addfail'></div>";
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script>
    $(document).ready(function() {
        //去掉table样式
        $("table tbody tr").mouseover(function() {
            $(this).css("background", "white")
        })
        var status = $('i.step-point').attr('status');
        switch (status) {
            case '1':
                $('i.step-point').css({'left': '48%'});
                break;
            case '4':
                $('i.step-point').css({'left': '81%'});
                break;
            case '5':
                $('i.step-point').css({'left': '23.5%'});
                break;
            case '6':
                $('i.step-point').css({'left': '73.5%'});
                break;
        }
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");

        })
    })

    //        //审核通过-支付宝
    //        function auditok1(){
    //            var ReturnID = $("#ReturnID").val();
    //            var url="<?php echo Yii::app()->createUrl('pap/dealerreturn/auditok') ?>";
    //            $.getJSON(url,{ID:ReturnID},function(data){
    //                if(data){
    //                    var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/index') ?>";
    //                    location.href=url;
    //                    return true;
    //                }else{
    //                    alert('保存失败');
    //                    return false;
    //                }
    //            });
    //            
    //        }
    //审核通过
    function auditok() {
        var ReturnID = $("#ReturnID").val();
        var url = Yii_baseUrl + '/pap/dealerreturn/Returnposts/returnID/' + ReturnID;
        location.href = url;
    }
    //审核通过-取消
    function auditokno() {
        $('#auditgo').show();
        $('#audittype').hide();
    }

    //审核通过-支付宝担保
    function auditok1() {
        var ReturnID = $("#ReturnID").val();
        var url = Yii_baseUrl + '/pap/dealerreturn/returnpaypal/returnID/' + ReturnID;
        location.href = url;
    }
    //审核通过-物流代收款
    function auditok2() {
        var ReturnID = $("#ReturnID").val();
        var url = Yii_baseUrl + '/pap/dealerreturn/Returnpost/returnID/' + ReturnID;
        location.href = url;
    }
    /*
     *审核未通过
     */
    function auditno() {
        $('#auditfail').dialog('open');
        var html = '';
        html += "<input type='hidden'>";
        html += "  <span  style='vertical-align: top;'>审核不通过的原因:</span><textarea rows='6' cols='60' id='noinfo'></textarea>"
        $('#addfail').html(html);
    }
    /*
     *保存审核未通过原因
     */
    function save() {
        var 　NoResult = $("#noinfo").val();
        var ReturnID = $("#ReturnID").val();
        var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/noaudit') ?>";
        $.getJSON(url, {ID: ReturnID, noinfo: NoResult}, function(data) {
            if (data) {
                var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/index') ?>";
                location.href = url;
                return true;
            } else {
                alert('保存失败');
                return false;
            }
        });



    }

    //收货处理
    function getgoods() {
        var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/goodsget') ?>";
        var ReturnID = $('#ReturnID').val();
        $.getJSON(url, {ID: ReturnID}, function(data) {
            if (data) {
                var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/index') ?>";
                location.href = url;
                return true;
            } else {
                alert('收货失败');
                return false;
            }
        });
    }

    /*
     * 审核取消
     */
    function auditexit() {
        var url = Yii_baseUrl + '/pap/dealerreturn/index';
        window.location.href = url;
    }
</script>
