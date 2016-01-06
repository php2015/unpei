
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
    '退货管理' => Yii::app()->createUrl('pap/buyreturn/addreturn'),
    '申请退货',
);
?>  



<ul class="order_bg">
    <?php if ($model[0]['Status'] == 3): ?>
        <li  class="order_step state">
            <span class="order_step state">申请退货</span>
        </li>
        <li>
            <span class="order_step state">审核退货</span>
        </li>
        <li class="step_last">
            <span class="order_step state">退货完成</span>
        </li>
    <?php elseif ($model[0]['Status'] == 9): ?>

        <li class="order_step state" style="width:170px;">
            <span class="order_step state" >申请退货</span>
        </li>
        <li class="" style="width:170px;">
            <span class="order_step state">审核退货</span>
        </li>
        <li class="" style="width:170px;">
            <span class="order_step state">买家发货</span>
        </li>
        <li class=""  style="width:170px;">
            <span class="order_step state">确认收货</span>
        </li>
        <li class="step_last" style="width:170px;">
            <span class="order_step state">退货完成</span>
        </li>

    <?php endif; ?>
</ul> 
<div class="order_step_info">
    <div class="bor_back m-top" style=" overflow: hidden; clear: both">              
        <div  class="ddxx"><p>订单信息</p></div>
        <div class="info-box ">
            <ul class="mjxx m-top last">

                <div style="clear:both"></div>
                <p class="m-top20"></p>
            </ul>
            <p class=" m-top20">
                <span class='f14' style='vertical-align: top;'>退货原因:</span>
                <textarea   rows='5' cols='80' id="Reseaon" style="resize: none;"></textarea>
                <span>(最多可输入100个字符)</span>
                <input type="hidden" name="orderStatus" value="<?php echo $model[0]['Status'] ?>">
                <br />
                <input type="hidden" id="pym" value="<?php echo $model[0]['Payment'] ?>">
                <?php if ($model[0]['Status'] == 3): ?>
                    <span style="color: red">亲:注意哟!待收货(
                        <?php
                        if ($model[0]['Payment'] == 1):
                            echo '支付宝担保交易';
                        else: echo "物流代收";
                        endif;
                        ?>
                        )订单,退货没有退款!</span>
                <?php endif ?>
            </p>

            <div style="clear:both"></div>
            <p class="m-top"></p>

            <div name="thin-list">

                <?php foreach ($model as $k => $vvv): ?>
                  <p class="m-top20"><b>订单信息</b></p>
                    <p style="height:30px; line-height: 30px; padding-top: 5px; padding-left: 20px;">
                        经销商名称：<?php echo $vvv['SellerName']; ?>&nbsp;&nbsp;
                        订单编号：<?php echo $vvv['OrderSN'] ?>&nbsp;&nbsp;
                        下单时间：<?php echo date('Y年m月d日', $vvv->CreateTime) ?>&nbsp;&nbsp;
                        支付方式：<?php
                        if ($model[0]['Payment'] == 1):echo '支付宝担保交易';
                        else: echo "物流代收";
                        endif;
                        ?>
                    </p>
                <table class="order_table" id="tb<?php echo $vvv->ID ?>">
                    <thead>
                        <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td> 数 量 </td><td> 退货数量</td><td>商品总价（元）</td></tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($vvv->goods as $v): ?>
                            <?php
                            $goods = DealergoodsService::getmongoversion($v['GoodsID'], $v['Version']);
                            if ($goods) {
                                $v['GoodsName'] = $goods['GoodsInfo']['Name'];
                                if (is_array($goods['GoodsInfo']['img']) && !empty($goods['GoodsInfo']['img']))
                                    $v['ImageUrl'] = $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                $v['GoodsNum'] = $goods['GoodsInfo']['GoodsNO'];
                                $v['Brand'] = $goods['GoodsInfo']['Brand'];
                                $v['PartsLevelName'] = $goods['GoodsInfo']['PartsLevelName'];
                                $v['CpName'] = Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['GoodsInfo']['StandCode']}'"))->attributes['Name'];
                                if (is_array($goods['GoodsInfo']['oeno']) && !empty($goods['GoodsInfo']['oeno'])) {
                                    $oe = '';
                                    foreach ($goods['GoodsInfo']['oeno'] as $vv) {
                                        if ($vv)
                                            $oe.=$vv . ',';
                                    }
                                    $v['GoodsOE'] = substr($oe, 0, -1);
                                }
                            }
                            ?>
                            <tr class="order_bd" id="tr<?php echo $v['ID'] ?>">
                                <td>
                                    <div class="div_img float_l m_left12 m-top">
                                        <a class="order_goods" title="<?php echo ReturnorderService::idgetgoodsinfo($v['OrderID'], $v['GoodsID'], 'GoodsName'); ?>" 
                                           href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>" target='_blank' version="<?php echo $v['Version'] ?>" order="<?php echo $v['OrderID'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                                               <?php
                                               if ($v['ImageUrl']) :
                                                   ?>
                                                <img src="<?php echo F::uploadUrl() . $v['ImageUrl'] ?>" width="80px" height="80px">
                                            <?php else: ?>
                                                <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="80px" height="80px">
                                            <?php endif; ?>
                                        </a>
                                    </div> 
                                    <div class="div_info float_l m_left m-top5" style="width:300px">
                                        <a class="order_goods"target='_blank'  href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>" 
                                           title="<?php echo $v['GoodsName'] ?>" version="<?php echo $v['Version'] ?>" order="<?php echo $v['OrderID'] ?>" ><b style="font-size:14px"><?php echo $v['GoodsName'] ?></b></a>
                                        <p>商品编号：<span class="zwq_color"><?php echo $v['GoodsNum'] ?> </span> | 品牌：<span><?php echo $v['Brand'] ?> </span></p>
                                        <p class="">标准名称：<span><?php echo $v['CpName'] ?> </span> | 拼音代码：<span><?php echo DealergoodsService::idgetgoods($v['GoodsID'], 'Pinyin'); ?></span> </p>

                                        <?php
                                        $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $v['OrderID'], ":GoodsID" => $v['GoodsID']));
                                        ?>
                                        <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                        <p>配件档次：<span><?php echo $v['PartsLevelName'] ?></span></p>
                                        <p class="">OE号：<span><?php echo $v['GoodsOE'] ?></span> </p>
                                    </div>
                                </td>   

                                <?php //var_dump($vvv);  ?>
                                <?php if ($vvv['Status'] == 3):  //如果订单未收货  ?>   

                                    <td name='price' >
                                        <?php if ($v['ProPrice'] && $v['ProPrice'] != $v['Price']): ?> <!-- 有优惠价且优惠价与参考价不相等时 -->
                                            <input type='text' class='list_input' size='7' value='<?php echo $v->ProPrice ?>' name='Price' readonly>
                                        <?php else: ?>
                                            <input type='text' class='list_input' size='7' value='<?php echo $v->Price ?>' name='Price' readonly>
                                        <?php endif; ?>

                                        <?php if ($v['ProPrice'] && $v['ProPrice'] != $v['Price']): ?>  <!--改价 -->
                                            <input type='hidden' name='oldPrice'  Price='<?php echo $v->ProPrice ?>'>
                                        <?php else: ?>
                                            <input type='hidden' name='oldPrice'  Price='<?php echo $v->Price ?>'>
                                        <?php endif; ?>
                                    </td>
                                    <td name='buyamount'><?php echo $v['Quantity'] ?></td> 
                                    <td name='goods'>
                                        <input class='list_input goods_amount'  type='text' value='<?php echo $v['Quantity'] ?>' amount='<?php echo $v['Quantity'] ?>'  size='2' name='Amount[]' readonly>
                                        <input type='hidden' name='goods' OrderID='<?php echo $v['OrderID'] ?>' GoodsID='<?php echo $v['GoodsID'] ?>'
                                               BuyAmount='<?php echo $v['Quantity'] ?>' BuyTime='<?php echo $v['CreateTime'] ?>' Version="<?php echo $v['Version'] ?>">
                                    </td>  
                                    <?php // var_dump($v);   ?>
                                    <td name='total'><?php echo $v['GoodsAmount'] ?></td> 

                                <?php elseif ($vvv['Status'] == 9):  //已收货订单    ?>  
                                    <td name='price'>
                                        <?php if ($v['ProPrice'] && $v['ProPrice'] != $v['Price']): ?> <!-- 有优惠价且优惠价与参考价不相等时 -->
                                            <input type='text' class='list_input'  size='7' value='<?php echo $v->ProPrice ?>' name='Price' onblur='change_price2(this)' onkeyup='change_price1(this)'>
                                        <?php else: ?>
                                            <input type='text' class='list_input' size='7' value='<?php echo $v->Price ?>' name='Price' onblur='change_price2(this)' onkeyup='change_price1(this)'>
                                        <?php endif; ?>

                                        <?php if ($v['ProPrice'] && $v['ProPrice'] != $v['Price']): ?> <!--改价 -->
                                            <input type='hidden' name='oldPrice'  Price='<?php echo $v->ProPrice ?>'>
                                        <?php else: ?>
                                            <input type='hidden' name='oldPrice' Price='<?php echo $v->Price ?>'>
                                        <?php endif; ?>
                                    </td>
                                    <td name='buyamount' ><?php echo $v['Quantity'] ?></td> 
                                    <td name='goods'>
                                        <a class='list_input' onclick='decrease_quantity(this)' href='javascript:;'>-</a>
                                        <input class='list_input goods_amount' type='text' value='0' amount='<?php echo $v['Quantity'] ?>' onblur='change_quantity(this);' onkeyup='change_quantity(this);' size='2' name='Amount[]'>
                                        <a class='list_input'onclick='add_quantity(this)' href='javascript:;'>+</a>
                                        <input type='hidden' name='goods' OrderID='<?php echo $v['OrderID'] ?>' GoodsID='<?php echo $v['GoodsID'] ?>'
                                               BuyAmount='<?php echo $v['Quantity'] ?>' BuyTime='<?php echo $v['CreateTime'] ?>' Version="<?php echo $v['Version'] ?>" >
                                    </td>  
                                    <td name='total'>0</td> 
                                <?php endif; ?>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>                 
                </table>
            <?php endforeach; ?>
        </div>
    </div>
    <div style="float: right; margin:5px 20px 5px 0;">
        <?php
        $organID = Yii::app()->user->getOrganID();
        $paycount = JpdFinancialPaypal::model()->find('OrganID=:organID', array(":organID" => $organID));
        ?>
        <input type="hidden" id='acount' value='<?php echo!empty($paycount['PaypalAccount']) ? $paycount['PaypalAccount'] : '' ?>'>
        <button class="button button2 m-top" style="width:65px" onclick="wantcheckgo()">提交申请</button>
        &nbsp;&nbsp;
        <button class="button button2 m-top" style="width:65px" onclick="nocheckgo()">取消申请</button>
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

        $('#Reseaon').keyup(function() {
            var leng = $(this).val().length;
            var zihu = $('#Reseaon').val().substr(0, 100);
            if (leng > 100) {
                alert('退货原因不能超过100个字符 ');
                document.getElementById("Reseaon").value = zihu;
            }
        })
    })


    //申请退货
    function wantcheckgo() {
        var reseaon = $.trim($('#Reseaon').val());
        var account = $('#acount').val();
        var payment = $('#pym').val();
        if (reseaon == '') {
            alert('退货原因不能为空 ');
            return false;
        } else if (reseaon.length > 100) {
            alert('退货原因不能超过100个字符 ');
            return false;
        }
        var num = 0;
        var i = 0;
        var result = new Array;
        $("input[name='Amount[]']").each(function() {
            if ($(this).val() > 0) {
                num++;
                var Price = $(this).parents('td').parents('tr').find("td[name=price]").find("input[name=Price]").val();
                var goods = $(this).parents('td').find("input[name=goods]");
                result[i] = goods.attr('OrderID') + '-' + goods.attr('GoodsID') + '-' + $(this).val() + '-' + goods.attr('BuyAmount') + '-' +
                        Price + '-' + goods.attr('BuyTime') + '-' + goods.attr('Version');
                i++;
            }
        })
        if (num <= 0) {
            alert('数量不能全是0');
            return false;
        }
        var sum = 0;
        var Type = 1;
        if ($('input[name=orderStatus]').val() != 3) {  //如果订单状态不是未收货
            $("td[name=total]").each(function() {
                sum += parseFloat($(this).text());
                Type = 2; //退货订单类型已收货
            })
        }
        sum = sum.toFixed(2);
        if (payment == 2) { //物流代收款
            var bool = window.confirm('退款总计：￥' + sum + ' 确认提交该退货订单吗？');
        }
        if (payment == 1) //支付宝担保
        {
            if (account == '') {
                alert('您还未设置支付宝帐号，请到用户中心金融账户管理设置');
                return false;
            }
            var bool = window.confirm('退款总计：￥' + sum + '.经销商同意退货申请后,退款会直接打到您的支付宝账号' + account + '中,请确认此账号信息无误!确认提交该退货订单吗?');
        }
        if (bool) {
            var DealerID = $('input[name=DealerID]').val();
            var url = Yii_baseUrl + "/pap/buyreturn/addreturnorder";
            $.post(url, {
                Goods: result.join(','),
                DealerID: DealerID,
                Price: sum,
                Reseaon: reseaon,
                Type: Type
            }, function(data) {
                if (data.success) {
                    alert('确认成功,等待审核!');
                    window.location.href = Yii_baseUrl + "/pap/buyreturn";
                } else {
                    alert(data.error);
                }
            }, 'json');
        }

    }

    //取消申请
    function nocheckgo() {
        var type = "<?php echo Yii::app()->request->getParam('type'); ?>";
        if (type == 'order') {
            window.location.href = Yii_baseUrl + "/pap/orderreview/index";
        } else {
            window.location.href = Yii_baseUrl + "/pap/buyreturn/addreturn";
        }
    }
    //商品改价
    function change_price1(obj) {
        var price = $(obj).parents('td').find("input[name=oldPrice]").attr('Price');
        var val = obj.value;
        if (!$.isNumeric(val))
        {
            if (val != '')
                obj.value = price;
        }
    }

    function change_price2(obj) {
        var price = $(obj).parents('td').find("input[name=oldPrice]").attr('Price');
        if (obj.value == '')
            obj.value = price;
        else if (obj.value.indexOf(".") == -1 && obj.value > 0)
        {
            //如果不是小数且第一位是0就去掉
            if (obj.value.substr(0, 1) == '0')
                obj.value = obj.value.substr(1);
        }
        var val = parseFloat(obj.value);
        var reg = new RegExp("^[0-9]+(.[0-9]{1,2})?$", "g");
        if (!reg.test(val)) {
            obj.value = val.toFixed(2);
        }
        if (val <= 0 || val > price) {
            obj.value = price;
        }
        var num = $(obj).parents('td').parents('tr').find("td[name=goods]").find("input[name='Amount[]']").val();
        $(obj).parents('td').parents('tr').find("td[name=total]").text((parseFloat(obj.value) * num).toFixed(2));
    }

    //减少退货数量
    function decrease_quantity(obj) {
        var amount = $(obj).parents('td').find("input[name='Amount[]']").val();
        var num = parseInt(amount);
        if ((num - 1) >= 0) {
            num = num - 1;
            $(obj).parents('td').find("input[name='Amount[]']").val(num);
        }
        var Price = $(obj).parents('td').parents('tr').find("td[name=price]").find("input[name=Price]").val();
        $(obj).parents('td').parents('tr').find("td[name=total]").text((parseFloat(Price) * num).toFixed(2));
    }

    //增加退货数量
    function add_quantity(obj) {
        var quantity = $(obj).parents('td').parents('tr').find("td[name=buyamount]").text();
        var amount = $(obj).parents('td').find("input[name='Amount[]']").val();
        var num = parseInt(amount);
        if ((num + 1) <= quantity) {
            num = num + 1;
            $(obj).parents('td').find("input[name='Amount[]']").val(num);
        }
        var Price = $(obj).parents('td').parents('tr').find("td[name=price]").find("input[name=Price]").val();
        $(obj).parents('td').parents('tr').find("td[name=total]").text((parseFloat(Price) * num).toFixed(2));
    }

    //更改退货数量
    function change_quantity(obj) {
        var quantity = $(obj).parents('td').parents('tr').find("td[name=buyamount]").text();
        obj.value = obj.value.replace(/\D/g, '');
        if (obj.value.substr(0, 1) == '0')
            obj.value = obj.value.substr(1);
        var val = parseInt(obj.value);
        if (val <= 0 || !val) {
            obj.value = 0;
        }
        if (val > quantity) {
            obj.value = quantity;
        }
        var Price = $(obj).parents('td').parents('tr').find("td[name=price]").find("input[name=Price]").val();
        $(obj).parents('td').parents('tr').find("td[name=total]").text((parseFloat(Price) * parseInt(obj.value)).toFixed(2));
    }
</script>
