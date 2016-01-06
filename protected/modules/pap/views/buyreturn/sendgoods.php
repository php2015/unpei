
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    .list_input{
        border:1px solid #ccc;margin:0 4px;text-align:center;padding:0 3px;
        height: 16px;
        line-height: 20px;
        float: left;
    }
    table tr td{
        vertical-align: middle;
    }
</style>
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '退货管理' => Yii::app()->createUrl('pap/buyreturn'),
    '填写发货信息',
);
?>  
<?php if ($data->Status != 10): ?>
    <ul class="order_bg">
        <li class="<?php if ($data->Status == 5) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">申请退货</span>
        </li>
        <li class="<?php if ($data->Status == 1) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">审核退货</span>
        </li>
        <li class="<?php if ($data->Status == 2) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">买家发货</span>
        </li>
        <li class="step_last <?php if ($data->Status == 3) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">确认收货</span>
        </li>
        <li class="step_last <?php if ($data->Status == 4) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">退货完成</span>
        </li>
    </ul> 
    <div class="order_step_info m-top">
        <i class="step-point" status="<?php echo $data->Status ?>" ><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/images/sanjiao2.png"></i>
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
                        <ul class='m-top'><li class='m-top'>1.点击这里 <button class='button2' onclick="sendgoods()">发货</button></li>
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
                            <dd><?php echo $data->LogtigCompany; ?></dd>
                            <dt>运单号码：</dt>
                            <dd><?php echo $data->ReShipLogis; ?></dd>
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
                            <dd><?php echo $data->LogtigCompany; ?></dd>
                            <dt>运单号码：</dt>
                            <dd><?php echo $data->ReShipLogis; ?></dd>
                        </dl>
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
    <div class="bor_back m-top" style=" overflow: hidden; clear: both">              
        <div  class="ddxx"><p>订单信息</p></div>
        <div class="info-box ">
            <ul class="mjxx m-top last">
                <?php
                $order = PapReturnGoods::model()->find('ReturnID=:returnID', array(':returnID' => $data->ID));
                $paym = PapOrder::model()->findByPk($order['OrderID']);
                ?>
                <li style="margin-left:0px">
                    <span class='f14' style='vertical-align: top;'>退货单号：</span>
                    <span id="ReturnNO" style="margin-right: 30px"><?php echo $data->ReturnNO ?></span>
                    <span class='f14' style='vertical-align: top;'>退款方式：</span>
                    <span class='f14' id="ReturnType">
                        <?php if ($data->Type == 1): ?>
                            未收货订单&nbsp;
                        <?php else : ?>
                            已收货订单&nbsp;
                        <?php endif; ?>

                        <span class='f14' style="margin-left: 30px"id="Payment" key="<?php echo $data['PayMethod'] ?>" return="<?php echo $data['ID'] ?>">
                            <!--退款方式：-->
                            <?php if ($data['PayMethod'] == 0): ?>
                                支付宝担保交易
                            <?php else : ?>
                                物流代收款
                            <?php endif; ?>
                        </span>

                    </span>
                </li>
                <p class="m-top20"></p>
            </ul>
            <div style="clear:both"></div>
            <p class=" m-top20">
                <span class='f14' style='vertical-align: top;'>退货原因：</span>
                <textarea   rows='3' cols='50' id="reason"><?php echo $data->Result ?></textarea>
            </p>
            <br />
            <p class='form-row' id="sendForm">
                <span class='f14'>运货单号：</span><span id="ReShipLogis" class='f14'></span><input class="width108 input" name="ReShipLogis">&nbsp;&nbsp;
                <span class='f14' style="padding-left:20px">物流公司：</span><span id="LogtigCompany" class='f14'></span><input class="width168 input" name="LogtigCompany">&nbsp;&nbsp;
                <span class='f14' id="DeliveryTime" style="padding-left:20px"></span>
            </p>
            <div style="clear:both"></div>
            <p class="m-top"></p>
            <div name="thin-list">
                <table class="m-top20 order_table" id="tb<?php echo $data->ID ?>">
                    <thead>
                        <tr class="order_state_hd"><td>商品信息</td><td>单价(元)</td><td>订购数量</td><td>退货数量</td><td> PN号</td><td>商品总价(元)</td></tr>
                    </thead> 
                    <tbody>
                        <?php
                        if ($data->returngoods): $count = count($data->returngoods);
                            foreach ($data->returngoods as $k => $value):
                                ?>
                                <?php
                                $goods = DealergoodsService::getmongoversion($value['GoodsID'], $value['Version']);
                                ?>
                                <tr class="order_bd" id="tr<?php echo $value->ID ?>">
                                    <td>
                                        <div class="div_img float_l m_left12 " style=" margin-top: 30px;">
                                            <a title="" class="order_goods" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" order="<?php echo $value['OrderID'] ?>" version="<?php echo $value['Version'] ?>" target='_blank'>
                                                <img src="
                                                <?php
                                                if ($goods['GoodsInfo']['img'][0]['ImageUrl']) {
                                                    echo F::uploadUrl() . $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                                } else {
                                                    echo F::uploadUrl() . 'common/default-goods.png';
                                                }
                                                ?>" style="width: 90px;height: 100px;">
                                            </a>
                                        </div> 
                                        <div class="div_info float_l m_left m-top" style="width:360px;">
                                            <div style="float:left;text-align:left;width: 210px;"><a target='_blank' class="order_goods" order="<?php echo $value['OrderID'] ?>" version="<?php echo $value['Version'] ?>"  href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" title="<?php echo $goods ? $goods['GoodsInfo']['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsName'); ?>"><b style="font-size:14px"><?php echo $goods ? $goods['GoodsInfo']['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsName'); ?></b></a></div>
                                            <div style="">订单编号：<?php echo OrderreturnService::orderIDgetorder($value['OrderID'], 'OrderSN'); ?></div>
                                            <div style="clear:both;height:0px"></div>
                                            <p class="">商品编号：<span class="zwq_color"><?php echo $goods ? $goods['GoodsInfo']['GoodsNO'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsNum'); ?></span> | 品牌：<span><?php echo $goods ? $goods['GoodsInfo']['Brand'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'Brand'); ?></span></p>
                                            <p class="">标准名称：<span><?php echo $goods ? Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['GoodsInfo']['StandCode']}'"))->attributes['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'CpName'); ?></span> | 拼音代码：<span><?php echo $goods ? $goods['GoodsInfo']['Pinyin'] : DealergoodsService::idgetgoods($value['GoodsID'], 'Pinyin'); ?></span>
                                                <?php
                                                $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $value['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                                                ?>
                                            <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                            <p>配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>

                                            <p style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">OE号：<span><?php
                                                    if ($goods['GoodsInfo']['oeno']) {
                                                        foreach ($goods['GoodsInfo']['oeno'] as $key => $v) {
                                                            if ($key) {
                                                                echo '、' . $v;
                                                            } else {
                                                                echo $v;
                                                            }
                                                        }
                                                    } if (!$goods) {
                                                        echo ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsOE');
                                                    }
                                                    ?></span> </p>
                                        </div>                                                   
                                    </td>  
                                    <td name='price'><?php echo $value->Price ?>
                                        <input type='hidden' name='oldPrice' Price='<?php echo $value->Price ?>'    >
                                    </td>
                                    <td name='buyamount'><?php echo $value->BuyAmount ?></td> 
                                    <td name='goods'><?php echo $value->Amount ?></td>
                                    <td><input type='text' value='逗号分隔' name='PIN' class='list_input' size='7'
                                               onclick='delstr(this)'  onblur='pnblur(<?php echo $value->ID ?>, this)' onkeyup='pnkeyup(<?php echo $value->ID ?>,<?php echo $value->Amount ?>, this)'></td>

                                    <td name='totalpnblur'><?php echo $value->Price * $value->Amount ?></td> 
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>                 
                </table>
            </div>
            <div style="float: right; margin:5px 20px 5px 0;">
                <button class="button button2 m-top" style="width:65px; *margin-right: 5px;" onclick="sendgoods()">确认发货</button>
                <button class="button button2 m-top" style="width:65px" onclick="nosendgoods()">取消发货</button>
            </div>
            <input type="hidden" name="orderid" value="<?php echo $data->ID ?>" otype="<?php echo $data->Type ?>" ostatus="<?php echo $data->Status ?>">
        </div>

    </div>
    <form action="" method="POST" id="goodsform" target="_blank">
        <input type="hidden" name="Version">
        <input type="hidden" name="Order">
    </form>
    <script>
        $(document).ready(function() {
            //商品详情
            $('.order_goods').bind('click', function() {
                var url = this.href;
                $('input[name=Version]').val($(this).attr('version'));
                $('input[name=Order]').val($(this).attr('order'));
                $('#goodsform').attr('action', url);
                $('#goodsform').submit();
                return false;
            })
            $("table tbody tr").mouseover(function() {
                $(this).css("background", "white"); //取消table覆盖样式
            })
            $('#reason').attr('readonly', true);

            var status = $('i.step-point').attr('status');
            switch (status) {
                case '1':
                    $('i.step-point').css({'left': '30%'});
                    break; //审核退货
                case '2':
                    $('i.step-point').css({'left': '50%'});
                    break; //退货待发货
                case '3':
                    $('i.step-point').css({'left': '68%'});
                    break; //退货待收货
                case '4':
                    $('i.step-point').css({'left': '88%'});
                    break; //已完成
                case '5':
                    $('i.step-point').css({'left': '11%'});
                    break; //审核未通过
            }
        })
        //发货
        function sendgoods() {

            var ReShipLogis = $.trim($('input[name=ReShipLogis]').val());
            if (ReShipLogis == "") {
                alert('运单编号不能为空');
                $('input[name=ReShipLogis]').focus();
                return false;
            }
            if (ReShipLogis.length > 10) {
                alert('运单编号不能超过10个字');
                $('input[name=ReShipLogis]').focus();
                return false;
            }
            var LogtigCompany = $.trim($('input[name=LogtigCompany]').val());
            if (LogtigCompany == "") {
                alert('物流公司不能为空');
                $('input[name=LogtigCompany]').focus();
                return false;
            }
            if (LogtigCompany.length > 20) {
                alert('物流公司不能超过20个字');
                $('input[name=LogtigCompany]').focus();
                return false;
            }
            var id = [];
            var pnStr = '';
            if (pnArr) {
                for (var i in pnArr) {
                    if (pnArr[i] == '@') {
                        alert('PIN号个数不正确');
                        return false;
                    }
                    else if (pnArr[i] == '#') {
                        alert('PIN号格式不正确');
                        return false;
                    } else if (pnArr[i]) {
                        id.push(i);
                        pnStr += pnArr[i] + '-';
                    }
                }
            }
            var ID = $('input[name=orderid]').val();
            var payment = $('#Payment').attr('key');
            if (payment == 0) {
                var url = Yii_baseUrl + '/pap/buyreturn/sendtoapliay';
            } else {
                var url = Yii_baseUrl + '/pap/buyreturn/send';
            }
            $.post(url, {ID: ID, goodsid: id.join(','), PN: pnStr.substring(0, pnStr.length - 1), ReShipLogis: ReShipLogis, LogtigCompany: LogtigCompany}, function(result) {
                // 传入控制器参数:定义参数
                if (result.success) {
                    alert('发货成功');
                    window.location.href = Yii_baseUrl + "/pap/buyreturn";
                }
                else {
                    alert(result.error);
                }
            }, 'json');
        }

        function nosendgoods() {
            window.location.href = Yii_baseUrl + "/pap/buyreturn";
        }
        //PN码的函数
        var pnArr = new Array;
        function delstr(obj) {
            if (obj.value == '逗号分隔') {
                obj.value = '';
            }
        }
        function pnblur(id, obj) {
            if (obj.value.trim() == '') {
                obj.value = '逗号分隔';
                pnArr[id] = '';
            }
        }
        function pnkeyup(id, num, obj) {
            var val = obj.value;
            var Regx = /^[A-Za-z0-9][A-Za-z0-9,-]*$/;
            if (Regx.test(val)) {
                var arr = val.split(',');
                if (arr[arr.length - 1] == '') {
                    num += 1;
                }
                if (arr.length > num) {
                    pnArr[id] = '@';
                    return false;
                } else {
                    pnArr[id] = val;
                    return true;
                }
            } else if (val) {
                pnArr[id] = '#';
                return false;
            }
        }
    </script>
