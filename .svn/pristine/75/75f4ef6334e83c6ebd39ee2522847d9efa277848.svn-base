<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    .cancelbtn{height:30px;width:60px;cursor:pointer;line-height:24px}
    .price{height:20px;text-align:right;padding-right:8px}
    .div_img{padding:8px 8px 0 8px;width:95px}
    .div_img img{width:95px}
    div.div_info{ text-align:left;min-width:280px}
    tr.order_bd td {vertical-align: middle;}
    table td, table th {padding:2px 2px}
    .goods_name a{font-size:14px;font-weight:bold;}
    .goods_name{height: 26px;line-height: 26px;overflow: hidden;margin-top:9px}
    .goods_attr{height: 20px;line-height: 20px;overflow: hidden;}
    .goods_side{display:block;float:left}
    .goods_num{max-width:120px;display:block;float:left;cursor:pointer}
    .cut{white-space: nowrap;overflow: hidden; text-overflow: ellipsis}    
    .list_input{
        border:1px solid #ccc;margin:0 4px;text-align:center;padding:0 3px;
        height: 16px;
        line-height: 20px;
        float: left;
    }
</style>
<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '订单改价'
        )
?>
<div class="bor_back m-top">              
    <div class="ddxx" id="">
        <input type="hidden" name="ddorder" value="<?php echo $data->ID ?>">
        <input type="hidden" name="shipcost" value="<?php echo $data->ShipCost ?>">
        <input type="hidden" name='oldpayment'   value='<?php echo $data->Payment?>'>
        <input type="hidden" name='payment'   value='<?php echo $data->Payment?>'>
       <?php       
       ?>
    </div>
    <div class="info-box ">
        <p class="m-top20"><b>订单信息</b></p>
        <ul class="mjxx m-top last">
            <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
            <li>订单编号：<span><?php echo $data->OrderSN ?></span></li>
            <li>卖家名称：<span><?php echo $data->SellerName ?></span></li>
        </ul>
        <div style="clear:both"></div>
         <p class="m-top20"><b>选择支付方式</b></p>
         <div style="height:60px;" id="pyp">
                <input type="radio" id='paypal' name="payment" value="1" style="margin:10px 10px 10px 20px;*margin-bottom:0px" <?php
                if ($data->Payment == 1) {
                    echo 'checked=checked';
                } 
                ?>>
                &nbsp;支付宝担保交易
                <input type="radio" name="payment" value="2"  <?php if ($data->Payment == '2') echo 'checked=checked' ?> style="margin:10px 10px 30px 10px;*margin-bottom:0px;margin-left:20px">&nbsp;&nbsp;物流代收款
         </div>
        <p class="m-top20"><b>收货地址：</b>
        <ul class="mjxx m-top last">
            <li style="white-space:normal;;width:100%"><span><?php echo SellerorderService::getOrderAddress($data->ID) ?></span></li>
        </ul>
        <div style="clear:both"></div>
        <table class="m-top20 order_table">
            <thead>
                <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td>数 量</td><td>购买数量</td><td>商品总价（元）</td><td> 状 态 </td></tr>
            </thead> 
            <tbody>
                <?php
                if ($data->goodsinfo): $count = count($data->goodsinfo);
                    foreach ($data->goodsinfo as $k => $v) {
                        ?>
                        <tr class="order_bd">
                            <td>
                                <div class="div_img float_l m_left12">
                                    <a  class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>" 
                                        target='_blank' version="<?php echo $v['Version'] ?>" order="<?php echo $data->ID?>">
                                        <?php if (!$v['ImageUrl']): ?>
                                            <img src="<?php echo F::uploadUrl() . 'dealer/default-goods.png'; ?>" width="90px" height="90px" style="margin-top:15px">
                                        <?php else: ?>
                                            <img src="<?php echo F::uploadUrl() . $v['ImageUrl']; ?>" width="90px" height="90px" style="margin-top:15px">
                                        <?php endif; ?>
                                    </a>
                                </div> 
                                <div class="div_info float_l m-left5">
                                    <p class="goods_name cut">
                                        <a  class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>" 
                                             version="<?php echo $v['Version'] ?>" order="<?php echo $data->ID?>" target='_blank'><?php echo $v['GoodsName'] ?></a>
                                    </p>
                                    <p class="goods_attr"><span class='goods_side'>商品编号：</span>
                                        <span class="zwq_color goods_num cut" title='<?php echo $v['GoodsNum'] ?>'><?php echo $v['GoodsNum'] ?></span>
                                        <span class='goods_side'>&nbsp;|&nbsp;品牌：<?php echo $v['Brand'] ?></span>
                                    </p>
                                    <p class="goods_attr">标准名称：<span><a title="<?php echo $v['CpName'] ?>"><?php echo $v['CpName'] ?></a></span></p>
                                    <p class="goods_attr cut">配件档次：<span><a title="<?php echo $v['PartsLevelName'] ?>"><?php echo $v['PartsLevelName'] ?></a></span> </p>
                                    <p class="goods_attr cut">定位车型：<span><a title="<?php echo $v['Carmodeltxt'] ?>"><?php echo $v['Carmodeltxt'] ?></a></span> </p>
                                    <p class="goods_attr cut">OE号：<span><a title="<?php echo $v['GoodsOE'] ?>"><?php echo $v['GoodsOE'] ?></a></span> </p>
                                </div>
                            </td>               
                            <td name="price" class="zwq_color">￥<?php echo $v->ProPrice ?></td> 
                            <td><?php echo $v->Quantity ?></td> 
                            <td name="goods"><a class='list_input' onclick='decrease_quantity(this)' href='javascript:;'>-</a>
                                <input class='list_input goods_amount' type='text' value='<?php echo $v['Quantity'] ?>' amount='<?php echo $v['Quantity'] ?>' onblur='change_quantity(this);' onkeyup='change_quantity(this);' size='2' name='Amount[]' goods="<?php echo $v->ID ?>" goodsID="<?php echo $v->GoodsID ?>">
                                <a class='list_input'onclick='add_quantity(this)' href='javascript:;'>+</a></td>    
                            <td name="total" class="zwq_color">￥<?php echo $v->GoodsAmount ?></td>
                            <?php if ($k == 0): ?>
                                <td rowspan="<?php echo $count ?>"> <span><?php echo SellerorderService::showOrderStatus($data->Status) ?></span></td> 
                            <?php endif; ?>
                        </tr>
                        <?php
                    }
                endif;
                ?>
            </tbody>                 
        </table>
        <p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color" id="realprice">￥<?php echo $data->RealPrice ?></span></p>
    </div>
</div>
<div class="m-top" style="padding-left:350px">
    <input type="submit"  class="submit m_left f_weight change"  value="确认修改">
    <input type="button"  class="cancelbtn m_left f_weight"  value="取消">
</div>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="Order">
</form>
<!--content2结束-->
<!--content1即又半部分结束-->
<script>
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
      $('#pyp').find('input[name=payment]').click(function(){
         var payment=$(this).val();
         $('.ddxx').find('input[name=payment]').val(payment);
         
         var idArr1 = [];
         var amountArr1 = [];
         var OrderType =<?php echo $data->OrderType; ?>;
         var SellerID =<?php echo $data->SellerID; ?>;
         var BuyerID =<?php echo $data->BuyerID; ?>;
         $("input[name='Amount[]']").each(function() {
             idArr1.push($(this).attr('goodsID'));
             amountArr1.push($(this).val());
         });
         var url = Yii_baseUrl + '/pap/orderreview/changepay';
            $.ajax({
                url: url,
                type: 'POST',
                data: {'idArr': idArr1.join(','), 'OrderType': OrderType, 'SellerID': SellerID, 'BuyerID':BuyerID,'Payment':payment},
                dataType: 'JSON',
                success: function(data)
                {
                    var i = 0;
                    $("input[name='Amount[]']").each(function() {
                        $(this).parents('td').parents('tr').find("td[name=price]").text("￥"+data[i]);
                        $(this).parents('td').parents('tr').find("td[name=total]").html("<div class='zwq_color'>￥" + (parseFloat(data[i]) * amountArr1[i]).toFixed(2) + "</div>");
                        i++;
                    });
                    changeTotal();
                }
            });
      })
        //商品详情
        $('.order_goods').bind('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=Order]').val($(this).attr('order'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        })

        //取消
        $('.cancelbtn').click(function() {
            if (confirm('您确定要放弃修改该订单吗？')) {
                window.history.go(-1);
                // window.location.href=Yii_baseUrl+'/pap/sellerorder';
            }
        })
        //表格选中取消
        $('table tbody tr').mouseover(function() {
            $(this).css("background", "none")
        })

        //订单修改
        $('.change').click(function() {
            var idArr = [];
            var amountArr = [];
            var idDelArr = [];
            var changeArr = [];
            var priceArr = [];
            var oldpayment=$('.ddxx').find('input[name=oldpayment]').val();
            var  payment=$('.ddxx').find('input[name=payment]').val();
            //取做更改的价格
            $("input[name='Amount[]']").each(function() {
                idArr.push($(this).attr('goods'));
                amountArr.push($(this).val());
                priceArr.push($(this).parents('td').parents('tr').find("td[name=price]").text().substr(1));
                var amount = parseInt($(this).attr('amount'));
                if (amount != $(this).val()) {
                    changeArr.push($(this).val());
                    if ($(this).val() == '0') {
                        idDelArr.push($(this).attr('goods'));
                    }
                }
            })
            //console.log(priceArr);
            if (changeArr.length == 0 && oldpayment==payment ) {
                alert('您还未做任何修改！');
                return false;
            }
            else if (idDelArr.length == $("input[name='Amount[]']").length) {
                alert('请至少保留一件商品！');
                return false;
            }
            var ID =<?php echo $_GET['order']; ?>;
            var url = Yii_baseUrl + '/pap/orderreview/changeorder';
            $.ajax({
                url: url,
                type: 'POST',
                data: {'idArr': idArr.join(','), 'amountArr': amountArr.join(','), 'ProPrice':priceArr.join(','), 'ID': ID,'payment':payment},
                dataType: 'JSON',
                success: function(data)
                {
                    console.log(data);
                    if (data.error)
                    {
                        alert(data.msg);
                        location.reload();
                    }
                    else if (data.success)
                    {
                        alert('修改订单成功');
                        window.history.go(-1);
                    }
                }
            })
        })
    })

    //减少退货数量
    function decrease_quantity(obj) {
        var amount = $(obj).parents('td').find("input[name='Amount[]']").val();
        var num = parseInt(amount);
        if ((num - 1) >= 0) {
            num = num - 1;
            $(obj).parents('td').find("input[name='Amount[]']").val(num);
        }
        var Price = $(obj).parents('td').parents('tr').find("td[name=price]").text().substr(1);
        $(obj).parents('td').parents('tr').find("td[name=total]").html("<div class='zwq_color'>￥" + (parseFloat(Price) * num).toFixed(2) + "</div>");
        changeTotal();
    }

    //增加退货数量
    function add_quantity(obj) {
        var amount = $(obj).parents('td').find("input[name='Amount[]']").val();
        var num = parseInt(amount);
        if ((num + 1) <= 100) {
            num = num + 1;
            $(obj).parents('td').find("input[name='Amount[]']").val(num);
        }
        var Price = $(obj).parents('td').parents('tr').find("td[name=price]").text().substr(1);
        $(obj).parents('td').parents('tr').find("td[name=total]").html("<div class='zwq_color'>￥" + (parseFloat(Price) * num).toFixed(2) + "</div>");
        changeTotal();
    }

    //更改退货数量
    function change_quantity(obj) {
        //  var amount=parseInt($(obj).attr('amount'));
        obj.value = obj.value.replace(/\D/g, '');
        if (obj.value.substr(0, 1) == '0')
            obj.value = parseInt(obj.value);
        var val = parseInt(obj.value);
        if (val < 0 || !val)
            obj.value = 0;
        if (val > 100)
            obj.value = 100;
        var Price = $(obj).parents('td').parents('tr').find("td[name=price]").text().substr(1);
        $(obj).parents('td').parents('tr').find("td[name=total]").html("<div class='zwq_color'>￥" + (parseFloat(Price) * parseInt(obj.value)).toFixed(2) + "</div>");
        changeTotal();
    }

    //计算总价
    function changeTotal() {
        var sum = 0;
        $("td[name=total]").each(function() {
            sum += parseFloat($(this).text().substr(1));
        })
        $('#realprice').text('￥' + sum.toFixed(2));
    }
</script>