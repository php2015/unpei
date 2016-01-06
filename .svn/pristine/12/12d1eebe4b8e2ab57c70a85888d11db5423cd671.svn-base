<style>

    .state .order_step1 {
        background: none repeat scroll 0 0 #f2b303;
        color: #fff;
        height: 35px;
        line-height: 35px;
        margin: -1px 10px 0;
        width: 145px;
    }
    .order_step1 {
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
    '退款单详情',
);
?>  
<?php if ($data->Status > 10): ?>
    <ul class="order_bg">
        <?php if ($data->Status != 12 && $data->Status != 16 && $data->ComplainStatus == 0): ?>
            <li style=" width: 19%;height:35px;">
                <span class="order_step1 state">申请退款</span>                                                                                                                                               
            </li >
            <li  style=" width: 19%;height:35px;" class="<?php if ($data->Status == 11) echo 'state'; ?>">
                <span class="order_step1 state" style=" height:35px;">审核退款</span>                                                                                                                                               
            </li>
            <li  style=" width: 19%;height:35px;" class="step_last <?php if ($data->Status == 13) echo 'state'; ?>">
                <span class="order_step1 state" style=" height:35px;">退款待收款</span>                                                                                                                                                
            </li>
            <li  style=" width: 19%;height:35px;" class="step_last <?php if ($data->Status == 14) echo 'state'; ?>">
                <span class="order_step1 state" style=" height:35px;">退款完成</span>                                                                                                                                                
            </li>
        <?php elseif ($data->Status == 12 && $data->ComplainStatus == 1): ?>
            <li class="step_last <?php if ($data->ComplainStatus == 1) echo 'state'; ?>" style="margin-left: 300px;width:170px">
                <span class="order_step state">申诉中</span>
            </li>
        <?php elseif ($data->Status == 12 && $data->ComplainStatus == 2): ?>
            <li class="step_last <?php if ($data->ComplainStatus == 2) echo 'state'; ?>" style="margin-left: 300px;width:170px">
                <span class="order_step state">申诉已处理</span>
            </li>
        <?php elseif ($data->Status == 5 && $data->ComplainStatus == 3): ?>
            <li class="step_last <?php if ($data->ComplainStatus == 3) echo 'state'; ?>" style="margin-left: 300px;width:170px">
                <span class="order_step state">申诉已取消</span>
            </li>
        <?php else: ?>
            <li style=" width:49%;height:35px;" class="step_last <?php if ($data->Status == 12) echo 'state'; ?>">
                <span class="order_step3 state" style=" height:35px;">审核未通过</span>                                                                                                                                                        
            </li>
            <li style=" width: 49%;height:35px;" class="step_last <?php if ($data->Status == 16) echo 'state'; ?>">
                <span class="order_step3 state" style=" height:35px;">退款取消</span>                                                                                                                                                        
            </li>
        <?php endif; ?>
    </ul> 
<?php endif; ?>
<?php if ($data->ComplainStatus == 0): ?>
    <div class="order_step_info">
        <i class="step-point" status="<?php echo $data->Status ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/images/sanjiao2.png"></i>
        <div class="order_step_info m-top">
            <div class="order_step_bd">
                <div class="trade-status">
                    <?php
                    switch ($data->Status) {
                        case '11':
                            ?>
                            <b>当前退款单状态：退款单已生成，正等待审核</b>
                            <?php
                            break;
                        case '12':
                            ?>
                            <b>当前退款单状态：退款单审核未通过，请重新申请</b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        case '14':
                            ?>
                            <b>当前退款单状态：退款完成</b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        case '16':
                            ?>
                            <b>当前退款单状态：退款单已取消</b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        case '13':
                            ?>
                            <b>当前退款单状态：退款待收款</b>
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
        <p style="display: block;float: left;" >退款单信息</p>
        <div  style="width: 70px;float: right;padding-left: 30px;"><a onclick="auditexit()" herf="" style="cursor:pointer">返回列表</a></div>
    </div>
    <div class="info-box ">
        <p class=" m-top20"><b>退款原因：</b>
            <span class="m-left"><?php echo $data->Result ?></span></p>
        <?php if ($data->Status == 12): ?>
            <p class=" m-top20"><b>审核未通过原因：</b>
                <span class="m-left"><?php echo $data->NoResult ?></span></p>
        <?php endif; ?>
        <div class="mjxx" style="height:70px">
            <p class="m-top20"><b>买家信息</b></p>
            <ul class=" m-top">
                <li>机构名称：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'OrganName') ?></span></li>
                <li>联系电话：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'Phone') ?></span></li>
                <li>机构地址：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'all')->Area ?></span></li>
                <p class="m-top20"></p>
            </ul>
        </div>
        <div style="clear:both"></div>
        <p class="m-top20"><b>订单信息</b></p>
        <ul class="mjxx m-top last">
            <li>退款单编号：<span><?php echo $data->ReturnNO ?></span></li>
            <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
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
                <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td> 数 量 </td><td> 状 态 </td><td>退款总价（元）</td></tr>
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
                                <div class="div_img float_l m-top5"><img src="
                                    <?php
                                    if ($goods['GoodsInfo']['img'][0]['ImageUrl']) {
                                        echo F::uploadUrl() . $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                    } else {
                                        echo F::uploadUrl() . 'common/default-goods.png';
                                    }
                                    ?>" style="width: 90px;height: 90px;"></div> 
                                <div class="div_info float_l m-left5">
                                    <div class="name_div">
                                        <div class="float_l cut width220 text_l">
                                            <a class="order_goods" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>"  href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank"  title="<?php echo $goods['GoodsInfo']['Name']; ?>" ><?php echo $goods['GoodsInfo']['Name'] ?></a>
                                        </div><div class="float_l"><span>&nbsp;&nbsp;订单编号：<?php echo OrderreturnService::orderIDgetorder($v->OrderID, 'OrderSN'); ?></span></div></div>
                                    <p class="">商品编号：<span class="zwq_color"><?php echo $goods['GoodsInfo']['GoodsNO']; ?> </span> | 品牌：<span><?php echo $goods['GoodsInfo']['Brand']; ?> </span></p>
                                    <p style=" width: 400px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">标准名称：<span><?php echo $goods['GoodsInfo']['StandCodeName']; ?> </span> | 拼音代码：<span><?php echo $goods ? $goods['Pinyin'] : DealergoodsService::idgetgoods($v['GoodsID'], 'Pinyin'); ?></span></p>
                                    <?php
                                    $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $v['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                                    ?>
                                    <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                    <p>配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>
                                    <p style=" width: 400px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">OE号：<span>
                                            <?php
                                            if ($goods['GoodsInfo']['oeno']) {
                                                foreach ($goods['GoodsInfo']['oeno'] as $key => $value) {
                                                    if ($key) {
                                                        echo '、' . $value;
                                                    } else {
                                                        echo $value;
                                                    }
                                                }
                                            }
                                            ?>
                                        </span> </p>
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
        <input type="hidden" id="type" value="<?php echo($_GET['type']) ? ($_GET['type']) : 1; ?>">
        <p align="right" class="m-top f_weight shifukuan" id="auditgo" <?php if ($_GET['type'] == 1 || $_GET['type'] == 2) echo 'style="display:none"' ?>> 
            <?php if ($data->Status == 11): ?>
                <button onclick="auditok(<?php echo $data->ID ?>)">审核通过</button>
                <button onclick="auditno()">审核未通过</button>
                <button onclick="auditexit()" >取消</button>
            <?php endif; ?>
        </p>
    </div>
</div>
<?php
if ($data->Status == 11) {
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
}
?>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<script>
    //审核通过
    function auditok(ID) {
        var bool = window.confirm('确定审核通过?');
        if (bool) {
            var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/returnprice') ?>";
            $.getJSON(url, {ID: ID}, function(data) {
                if (data) {
                    var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/index') ?>";
                    location.href = url;
                    return true;
                } else {
                    alert('保存失败');
                    return false;
                }
            });
        } else {
            return false;
        }
    }
    //点击收货地址行显示边框
    $('#table tbody tr').live('click', function() {
        $(this).find('input[name=addr]').attr('checked', true);
        //去除同胞元素样式
        $(this).siblings().removeClass('table_bor');
        $(this).addClass('table_bor');
    });
    $(document).ready(function() {
        //商品详情
        $('.order_goods').bind('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=GoodsID]').val($(this).attr('goodsid'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        });
        //去掉table样式
        $("table tbody tr").mouseover(function() {
            $(this).css("background", "white");
        });


        var status = $('i.step-point').attr('status');
        switch (status) {
            case '11':
                $('i.step-point').css({'left': '28%'});
                break; //审核退款
            case '13':
                $('i.step-point').css({'left': '46%'});
                break; //已完成
            case '12':
                $('i.step-point').css({'left': '23%'});
                break; //审核未通过
            case '16':
                $('i.step-point').css({'left': '73%'});
                break; //已取消
            case '14':
                $('i.step-point').css({'left': '65%'});
                break; //已取消
        }
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");
        });
    });

    //审核通过-取消
    function auditokno() {
        $('#auditgo').show();
        $('#returntype').hide();
    }
    /*
     *审核未通过
     */
    function auditno() {
        $('#auditfail').dialog('open');
        var html = '';
        html += "<input type='hidden'>";
        html += "  <span  style='vertical-align: top;'>审核不通过的原因:</span><textarea rows='6' cols='60' id='noinfo'></textarea>";
        $('#addfail').html(html);
    }
    /*
     *保存审核未通过原因
     */
    function save() {
        var NoResult = $("#noinfo").val();
        var ReturnID = $("#ReturnID").val();
        var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/noaudit2') ?>";
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
    /*
     * 审核取消
     */
    function auditexit() {
        var url = Yii_baseUrl + '/pap/dealerreturn/index';
        window.location.href = url;
    }
</script>
