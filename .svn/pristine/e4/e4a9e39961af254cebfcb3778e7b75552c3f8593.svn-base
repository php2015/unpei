
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
    '重新申请退款',
);
?>  

<?php if ($data->Status != 10): ?>
    <ul class="order_bg">
        <?php if ($data->Type == 1): ?>
            <li class="<?php echo 'state'; ?>">
                <span class="order_step state">申请退货</span>
                <span class="datatime"><?php // echo $data->CreateTime ? date('Y-m-d H:i:s', $data->CreateTime) : '';                                                                                                                                                                                                                                                                       ?></span>
            </li>
            <li class="">
                <span class="order_step state">审核退货</span>
                <span class="datatime"><?php // echo $data->AccountTime ? date('Y-m-d H:i:s', $data->AccountTime) : '';                                                                                                                                                                                                                                                                       ?></span>
            </li>
            <li class="step_last <?php if ($data->Status == 4) echo 'state'; ?>">
                <span class="order_step state">退货完成</span>
                <span class="datatime"><?php // echo $data->ReceiptTime ? date('Y-m-d H:i:s', $data->ReceiptTime) : '';                                                                                                                                                                                                                                                                       ?></span>
            </li>
        <?php elseif ($data->Type == 2): ?>
            <li class="order_step state" style="width:170px;">
                <span class="order_step state" >申请退款</span>
            </li>
            <li class="" style="width:170px;">
                <span class="order_step state">审核退款</span>
            </li>
            <li class="step_last" style="width:170px;">
                <span class="order_step state">退款完成</span>
            </li>
        <?php endif; ?>
    </ul> 
    <div style="height:3px"></div>
    <div class="order_step_info">
        <i class="step-point" status="<?php echo $data->Status ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/images/sanjiao2.png"></i>
    <?php else: ?>
        <div class="order_step_info m-top">
        <?php endif; ?>
        <div class="order_step_bd">
            <div class="trade-status">
                <?php
                switch ($data->Status) {
                    case '11':
                        ?>
                        <b>当前退款单状态：退款单已生成，正等待审核</b>
                        <ul class='m-top'>
                        </ul>
                        <?php
                        break;
                    case '12':
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
                <li>退款单编号：<span><?php echo $data->ReturnNO ?></span></li>
                <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
                <div style="clear:both"></div>

            </ul>
            <div style="clear:both"></div>
            <p class=" m-top20">
                &nbsp;<span class='f14' style='vertical-align: top;'>退款原因:</span>
                <textarea   rows='2' cols='50' id="reason"><?php echo $data->Result ?></textarea>
                <span>(最多可输入100个字符)</span>
            </p>


            <p class='m-top20' id="NoResult">
                &nbsp;<span class='f14' style='vertical-align: top;'>审核反馈:</span>
                <textarea rows='2' cols='50' id="noResultText" readonly><?php echo $data->NoResult ?></textarea><br/>
            </p>
            <br />
            <?php
            $order = PapReturnGoods::model()->find('ReturnID=:returnID', array(':returnID' => $data['ID']));
            $res = PapOrder::model()->findByPk($order['OrderID']);
            ?>
            <input type="hidden" id="pym" value="<?php echo $res['Payment'] ?>">
            <?php if ($data->Type == 1): ?>
                <span style="color: red">亲:注意哟!待收货(
                    物流代收
                    )订单,退货没有退款!</span>
            <?php endif; ?>
            <div style="clear:both"></div>
            <p class="m-top"></p>

            <div name="thin-list">
                <table class="m-top20 order_table" id="tb<?php echo $data->ID ?>">
                    <thead>
                        <tr class="order_state_hd"><td>商品信息</td><td>单价</td><td> 数 量 </td><td>商品总价</td><td> 退款金额</td><td>退款总价</td></tr>
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
                                        <div class="div_img float_l m_left12 " style=" margin-top: 20px; margin-right: 5px;">  
                                            <a title="" class="order_goods" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>"  order="<?php echo $value['OrderID'] ?>"version="<?php echo $value['Version'] ?>" target='_blank'>
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
                                        <div class="div_info float_l  m-top" style="width:360px;">
                                            <div style="float:left;text-align:left;width: 240px;">
                                                <a href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" target='_blank' title="<?php echo $goods ? $goods['GoodsInfo']['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsName'); ?>" class="order_goods f_weight" order="<?php echo $value['OrderID'] ?>"version="<?php echo $value['Version'] ?>" goodsid="<?php echo $value['GoodsID'] ?>"style="font-size:14px"><?php echo $goods ? $goods['GoodsInfo']['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsName'); ?></a>
                                            </div>
                                            <div style="">订单编号：<?php echo OrderreturnService::orderIDgetorder($value['OrderID'], 'OrderSN'); ?></div>
                                            <div style="clear:both; height:0px"></div>
                                            <p class="">商品编号：<span class="zwq_color"><?php echo $goods ? $goods['GoodsInfo']['GoodsNO'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsNum'); ?></span> | 品牌：<span><?php echo $goods ? $goods['GoodsInfo']['Brand'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'Brand'); ?></span></p>
                                            <p class="">标准名称：<span><?php echo $goods ? Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['GoodsInfo']['StandCode']}'"))->attributes['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'CpName'); ?></span> | 拼音代码：<span><?php echo $goods ? $goods['GoodsInfo']['Pinyin'] : DealergoodsService::idgetgoods($value['GoodsID'], 'Pinyin'); ?></span> 
                                                <?php
                                                $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $value['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                                                ?>
                                            <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                            <p>配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>

                                            <p class="">OE号：<span><?php
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
                                                    ?></span></p>
                                        </div>
                                    </td>   

                                    <?php if ($data['Type'] == 1): //未收货 ?> 
                                        <td name='price'><input type='text' class='list_input' size='7' value='<?php echo $value->Price ?>' name='Price' readonly>
                                            <input type='hidden' name='oldPrice' Price='<?php echo $value->Price ?>' />
                                        <td name='buyamount'><?php echo $value->Amount ?></td> 
                                        <td name='goods'>
                                            <input class='list_input goods_amount' type='text' value='<?php echo $value->Amount ?>' amount='<?php echo $value->Amount ?>'  size='2' name='Amount[]'readonly     />
                                        </td>  
                                        <td name='total'><?php echo $value->Price * $value->Amount ?></td> 

                                    <?php elseif ($data['Type'] == 2): //已收货 ?>

                                        <td name='price'> <!--商品单价 -->
                                            <input type='text' readonly class='list_input' size='7' value='<?php echo $value->Price ?>' name='Price'  style="line-height:16px">
                                            <input type='hidden' name='oldPrice' Price='<?php echo $value->Price ?>'>
                                        </td>

                                        <!--购买数量 --> 
                                        <td name='buyamount'><?php echo $value->Amount ?>
                                            <input type='hidden' name='buyamount' buyamount='<?php echo $value->Amount ?>'>
                                        </td> 

                                        <!-- 商品总价-->
                                        <td name='buyamountPrice' buyamountPrice="<?php echo $value->Price * $value->Amount ?>"><?php echo $value->Price * $value->Amount ?></td> 

                                        <td name='goods'>
                                            <input class='list_input goods_amount' type='text'  name="changeprice[]" size='4' onchange='change_price2(this)' >
                                            <input type='hidden' name='oldPrice'  Price='<?php echo $value->Price ?>'>
                                        </td>  
                                        <td name='total'>0</td> 
                                    <?php endif; ?>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>                 
                </table>
            </div>
            <input type="hidden" name="orderid" value="<?php echo $data->ID ?>" otype="<?php echo $data->Type ?>" ostatus="<?php echo $data->Status ?>">
        </div>
        <?php
        $organID = Yii::app()->user->getOrganID();
        $paycount = JpdFinancialPaypal::model()->find('OrganID=:organID', array(":organID" => $organID));
        ?>
        <div style="float: right; margin:5px 20px 5px 0;">
            <input type="hidden" id='pycount' value='<?php echo!empty($paycount['PaypalAccount']) ? $paycount['PaypalAccount'] : '' ?>'>
            <button class="button2 button  m-top" style="width:65px; margin-right: 5px" onclick="checkgo()">提交申请</button>
            <button class="button2 button  m-top" style="width:65px" onclick="nocheckgo()">取消申请</button>
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

            $('#reason').keyup(function() {
                var leng = $(this).val().length;
                var zihu = $('#reason').val().substr(0, 100);
                if (leng > 100) {
                    alert('退货原因不能超过100个字符 ');
                    document.getElementById("reason").value = zihu;
                }
            })
        })
        //重新申请退货
        function checkgo() {
            var ID = $('input[name=orderid]').val();
            var type = $('input[name=orderid]').attr('otype');
            var reason = $.trim($('#reason').val());
            var account = $('#pycount').val();
            var payment = $('#pym').val();
            if (reason == '') {
                alert('退款原因不能为空 ');
                return false;
            } else if (reason.length > 100) {
                alert('退款原因不能超过100个字符 ');
                return false;
            }
            var pricesum = 0;
            if (type == 1) {
                var param = {ID: ID, type: type, reason: reason};
            }
            else {
                //已收货退货单
                var totalsum = 0;
                var id = [];
                var oid = [];
                var i = 0;
                var str = new Array;
                $("div[name='thin-list']").each(function() {
                    var sum = 0;
                    var tb = $(this).find('table').attr('id');
                    $("#" + tb + ">tbody>tr").each(function() {
                        //申请退款  买多少数量退多少数量  在于输入的退款价格
                        var num = $(this).find("td[name=buyamount]").find("input[name='buyamount']").attr('buyamount');
                        var price = $(this).find("td[name=price]").find("input[name=Price]").val();
                        if (num <= 0) {
                            id.push($(this).attr('id').substr(2));
                        }
                        else {
                            str[i] = $(this).attr('id').substr(2) + '-' + price + '-' + num;
                            i++;
                        }
                        //                        sum+=parseInt(num);
                    })
                    //                    if(sum==0){
                    //                        oid.push(tb.substr(2));
                    //                    }
                    //                    totalsum+=sum;
                })

                $("td[name=total]").each(function() {
                    pricesum += parseFloat($(this).text()); //退款总价
                })
                if (pricesum <= 0) {
                    alert('退款金额不能为0');
                    return false;
                }
                // var param={ID:ID,type:type,reason:reason,id:id.join(','),oid:oid.join(','),price:pricesum,goods:str.join(',')};
                var param = {ID: ID, type: type, reason: reason, price: pricesum, goods: str.join(',')};
            }
            pricesum = pricesum.toFixed(2);
            //            if(payment==2){  //物流
            //                var bool= window.confirm('退款总计：￥'+pricesum+' 确认提交该退货订单吗？'); 
            //            }
            //            if(payment==1){ //支付宝
            //                if(account==''){
            //                    alert('您还未设置支付宝帐号，请到用户中心金融账户管理设置');
            //                    return false;
            //                }
            //                var bool= window.confirm('退款总计：￥'+pricesum+'.经销商同意退货申请后,退款会直接打到您的支付宝账号'+account+'中,请确认此账号信息无误!确认提交该退货订单吗?');
            //            }
            var bool = window.confirm('退款总计：￥' + pricesum + '  确认提交该退款订单吗？');
            if (bool) {
                $.post(Yii_baseUrl + "/pap/buyreturn/agaginret2", param, function(result) {
                    if (result.success == 1) {
                        alert('确认成功,等待审核!')
                        window.location.href = Yii_baseUrl + "/pap/buyreturn";
                    }
                    else {
                        //                        alert(result.error);
                        alert('失败');
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
                window.location.href = Yii_baseUrl + "/pap/buyreturn";
            }
        }
        function change_price2(obj) {
            var price = $(obj).parents('td').find("input[name=oldPrice]").attr('Price');  //商品原价
            var buyamount = $(obj).parents('td').parents('tr').find("td[name=buyamount]").attr('buyamount'); //购买数量
            var buyamountPrice = $(obj).parents('td').parents('tr').find("td[name=buyamountPrice]").attr('buyamountPrice'); //商品总价
            if (obj.value == '')
                obj.value = price;
            else if (obj.value.indexOf(".") == -1 && obj.value > 0)
            {
                //如果不是小数且第一位是0就去掉
                if (obj.value.substr(0, 1) == '0')
                    obj.value = obj.value.substr(1);
            }
            var val = parseFloat(obj.value);  //输入的退款金额
            var reg = new RegExp("^[0-9]+(.[0-9]{1,2})?$", "g");
            if (val < 0 || val > buyamountPrice || !reg.test(val)) {
                obj.value = price;
            }
            if (val <= buyamountPrice) {   //输入的金额 只能比单价小才行
                //                $(obj).parents('td').parents('tr').find("td[name=total]").html(val);
                $(obj).parents('td').parents('tr').find("td[name=total]").text((parseFloat(obj.value)).toFixed(2));
            }
            if (val > buyamountPrice || val < 0) {  //如果比单价大 或者小于等于0 退款金额就是单价本身
                $(obj).parents('td').parents('tr').find("td[name=total]").html(price);
            }
            if (!reg.test(val)) {  //如果输入价格不符合
                $(obj).parents('td').parents('tr').find("td[name=total]").text((parseFloat(obj.value)).toFixed(2));
            }
        }
    </script>
