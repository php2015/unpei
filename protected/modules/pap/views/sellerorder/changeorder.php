<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    .cancelbtn{height:30px;width:60px;cursor:pointer;line-height:24px}
    .price{height:20px;text-align:right;padding-right:8px}
    .div_img{padding:8px 8px 0 8px;width:95px}
    .div_img img{width:95px}
    div.div_info{ text-align:left;width:300px}
    tr.order_bd td {vertical-align: middle;}
    .goods_name a{font-size:14px;font-weight:bold;}
    .goods_name{height: 26px;line-height: 26px;overflow: hidden;margin-top:9px}
    .goods_attr{height: 23px;line-height: 23px;overflow: hidden;}
    .goods_side{display:block;float:left}
    .goods_num{max-width:120px;display:block;float:left;cursor:pointer}
    .cut{white-space: nowrap;overflow: hidden; text-overflow: ellipsis}
</style>
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '订单改价'
        )
?>
<div class="bor_back m-top">              
    <div class="ddxx" id="">
        <input type="hidden" name="ddorder" value="<?php echo $data->ID ?>">
        <input type="hidden" name="shipcost" value="<?php echo $data->ShipCost ?>">
    </div>
    <div class="info-box ">
        <p class="m-top20"><b>收货地址：</b>
        <ul class="mjxx m-top last">
            <p><?php echo SellerorderService::getOrderAddress($data->ID) ?></p>
        </ul>
        <div style="clear:both"></div>
        <p class="m-top20"><b>订单信息</b></p>
        <ul class="mjxx m-top last">
            <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
            <li>订单编号：<span><?php echo $data->OrderSN ?></span></li>
            <li>买家名称：<span><?php echo $data['BuyerName'] ?></span></li>
        </ul>
        <div style="clear:both"></div>
        <table class="m-top20 order_table">
            <thead>
                <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td> 数 量 </td><td>商品总价（元）</td><td> 状 态 </td></tr>
            </thead> 
            <tbody>
                <?php
                if ($data->goodsinfo): $count = count($data->goodsinfo);
                    foreach ($data->goodsinfo as $k => $v):
                        ?>
                        <tr class="order_bd">
                            <td>
                                <div class="div_img float_l m_left12">
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
                                            <?php echo $v['GoodsName']; ?>
                                        </a>
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
                            <td> <span class="zwq_color">
                                    <input type="text" class="price" value="<?php echo $v->ProPrice ?>" price="<?php echo $v->ProPrice ?>"name='ProPrice[]' goods="<?php echo $v->ID ?>" onblur='change_price2(this)' onkeyup='change_price1(this)' size="10"></span></td> 
                            <td name="goods"><span><?php echo $v->Quantity ?></span></td>    
                            <td name="total">  <div class="zwq_color">￥<?php echo $v->GoodsAmount ?></div></td>
                            <?php if ($k == 0): ?>
                                <td rowspan="<?php echo $count ?>"> <span><?php echo SellerorderService::showOrderStatus($data->Status) ?></span></td> 
                            <?php endif; ?>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>                 
        </table>
        <p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color">￥<?php echo $data->RealPrice ?></span></p>
    </div>
</div>
<div class="m-top" style="padding-left:300px">
    <input type="submit"  class="submit m_left f_weight change"  value="确认改价">
    <input type="button"  class="cancelbtn m_left f_weight"  value="取消">
</div>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<!--content2结束-->
<!--content1即又半部分结束-->
<script>
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {

        //商品详情
        $('.order_goods').bind('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=GoodsID]').val($(this).attr('goodsid'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        })

        //取消
        $('.cancelbtn').click(function() {
            if (confirm('您确定要取消改价吗？')) {
                window.history.go(-1);
                //     window.location.href=Yii_baseUrl+'/pap/sellerorder/index';
                // window.location.href=Yii_baseUrl+'/pap/sellerorder';
            }
        })
        //表格选中取消
        $('table tbody tr').mouseover(function() {
            $(this).css("background", "none")
        })

        //订单改价
        $('.change').click(function() {
            var idArr = [];
            var priceArr = [];
            var changeArr = [];
            //取做更改的价格
            $("input[name='ProPrice[]']").each(function() {
                idArr.push($(this).attr('goods'));
                priceArr.push($(this).val());
                var price = $(this).attr('Price');
                if (price != $(this).val()) {
                    changeArr.push($(this).val());
                }
            })
            if (changeArr.length == 0) {
                alert('您还未更改任何价格！');
                return false;
            }
            var ID = $('input[name=ddorder]').val();
            var url = Yii_baseUrl + '/pap/sellerorder/changeorder';
            $.ajax({
                url: url,
                type: 'POST',
                data: {'idArr': idArr.join(','), 'priceArr': priceArr.join(','), 'ID': ID},
                dataType: 'JSON',
                success: function(data)
                {
                    if (data.error)
                    {
                        alert(data.msg);
                        location.reload();
                    }
                    else if (data.success)
                    {
                        alert('订单改价成功');
                        window.history.go(-1);
                        // window.location.href=Yii_baseUrl+'/pap/sellerorder/index';
                    }
                }
            })
        })
    })

    //商品改价
    function change_price1(obj) {
        var price = parseFloat($(obj).attr('Price'));
        var val = obj.value;
        if (!$.isNumeric(val))
        {
            if (val != '')
                obj.value = price;
        }
    }

    function change_price2(obj) {
        var price = parseFloat($(obj).attr('Price'));
        if (obj.value != price) {
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
            val = parseFloat(obj.value);
            if (val <= 0) {
                alert('新价格必须大于0');
                obj.value = price;
                return false;
            }
            if (val >= price) {
                alert('新价格要小于原价格');
                obj.value = price;
                return false;
            }
            obj.value = val.toFixed(2);
            var num = $(obj).parents('td').parents('tr').find("td[name=goods]").find("span").html();
            $(obj).parents('td').parents('tr').find("td[name=total]").find("div").html('￥' + (parseFloat(obj.value) * num).toFixed(2));
            var sum = 0;
            $("td[name=total]").each(function() {
                sum += parseFloat($(this).find('div').html().substr(1));
            });
            var real = (sum + parseFloat($('input[name=shipcost]').val())).toFixed(2);
            $('p.shifukuan').find('span').html('￥' + real);
        }
    }
</script>