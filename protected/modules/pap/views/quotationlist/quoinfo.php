<style>
     a.s,a.a{
        background: url("<?php echo F::themeUrl() . '/images/num-control.png' ?>");
        display: inline-block;
        float: left;
        height: 22px;
        margin-left: 4px;
        width: 22px;
    }
    a.a{ background-position:center right; }
        .float-l{float:left}
    .tabs li{
        height: 30px;
        line-height: 17px;
    }
        .slide1 {
        display: inline;
    }
    .slide2,.huodong {
        display: none;
    }
    
</style>
<div class="bor_back m-top"  <?php if($schinfo && empty($goodsdata)):?>style="padding:10px"<?php endif;?>>
    <?php if (empty($schinfo)): ?>
        <div style="height:100px"><p class="txxx">暂无方案</p></div>
    <?php else: ?>
        <?php if ($quoinfo['Status'] == 2 && !empty($goodsdata)): ?>
        <p class="txxx">订单商品</p>
            <div  class="zdycss2" id='getsure_lms'  scheme="schemelist">
                <div class="foreachdiv">
                    <p class="txxx">
                        商品订购清单
                    </p>
                    <div class="bor_back txxx_info4">
                        <?php
                        $this->widget('widgets.default.WGridView', array(
                            'id' => 'goodslist',
                            'dataProvider' => $goodsdata,
                            'columns' => array(
                                array(
                                    'name' => '#',
                                    'type' => 'raw',
                                    'value' => '$data[rowNo]',
                                    'headerHtmlOptions' => array('width' => '33px')
                                ),
                                array(
                                    'name' => '商品名称',
                                    'type' => 'raw',
                                    'value' => '$data[GoodsName]',
                                    'headerHtmlOptions' => array('width' => '100px')
                                ),
                                array(
                                    'name' => '商品编号',
                                    'type' => 'raw',
                                    'value' => '$data[GoodsNum]',
                                    'headerHtmlOptions' => array('width' => '80px')
                                ),
                                array(
                                    'name' => 'OE号',
                                    'type' => 'raw',
                                    'value' => '$data[GoodsOE]',
                                    'headerHtmlOptions' => array('width' => '120px')
                                ),
                                array(
                                    'name' => '商品品牌',
                                    'value' => '$data[Brand]',
                                    'headerHtmlOptions' => array('width' => '80px')
                                ),
                                array(
                                    'name' => '配件档次',
                                    'value' => '$data[PL]',
                                    'headerHtmlOptions' => array('width' => '60px')
                                ),
                                array(
                                    'name' => '单价(元)',
                                    'type' => 'raw',
                                    'value' => '$data[Price]',
                                    'headerHtmlOptions' => array('width' => '70px')
                                ),
                                array(
                                    'name' => '实际交易价(元)',
                                    'type' => 'raw',
                                    'value' => '$data[ProPrice]',
                                    'headerHtmlOptions' => array('width' => '100px')
                                ),
                                array(
                                    'name' => '数量',
                                    'type' => 'raw',
                                    'value' => '$data[Quantity]',
                                    'headerHtmlOptions' => array('width' => '40px')
                                ),
                                array(
                                    'name' => '成交总价',
                                    'type' => 'raw',
                                    'value' => '$data[GoodsAmount]',
                                    'headerHtmlOptions' => array('width' => '60px'),
                                    'htmlOptions' => array('name' => 'prices'),
                                )
                            )
                        ))
                        ?>
                    </div>

                    <p class="txxx">商品总价
                    <div class="txxx_info4">
                        <p class="m-top">
                            <span style="margin-left:12px;">商品总价：</span><span style="width:150px;display:inline-block;"  ><?php echo $sumtotal; ?>元</span>
                        </p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php $this->renderpartial('/quotation/schemes', array('schinfo' => $schinfo, 'from' => 3)); ?>
        <?php endif; ?>
        <?php if ($quoinfo['Status'] == 1): ?>
            <p class="m-top20" style="margin:0 0 20px 20px">
                <span>请选择方案：</span>
                <?php if ($schinfo) ;foreach ($schinfo as $kk => $vv): ?>
                    <input type="radio" name="radio" key="<?php echo $vv['SchID'] ?>" quoID="<?php echo $vv['QuoID'] ?>" num="<?php echo $kk + 1 ?>"><span>方案<?php echo $kk + 1 ?></span>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>
        <div class="foreachdiv" id="hideaddress" style="display:none">
            <p class="txxx">
                收货地址
                <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
                    <a onclick="newaddress()" style="float:right;color:blue" href="javascript:void(0)">新增收货地址</a>
                </span>
            </p>
            <div class="bor_back txxx_info4">
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'id' => 'address',
                    'dataProvider' => $address,
                    'ajaxUpdate' => true,
                    'columns' => array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'headerHtmlOptions' => array('width' => '20px'),
                            'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
                            'selectableRows' => '1',
                            'value' => 'CHtml::encode($data[ID])',
                        ),
                        array(
                            'name' => '姓名',
                            'type' => 'raw',
                            'value' => '$data[ContactName]',
                            'htmlOptions' => array('style' => 'text-overflow: ellipsis;overflow: hidden;white-space: nowrap;'),
                            'headerHtmlOptions' => array('width' => '70px')
                        ),
                        array(
                            'name' => '邮政编码',
                            'type' => 'raw',
                            'value' => '$data[ZipCode]',
                            'headerHtmlOptions' => array('width' => '60px')
                        ),
                        array(
                            'name' => '详细地址',
                            'type' => 'raw',
                            'value' => 'RPCClient::call("InquiryorderService_showaddress",array("State"=>$data[State],"City"=>$data[City],"District"=>$data[District],"Address"=>$data[Address]))',
                            'headerHtmlOptions' => array('width' => '180px')
                        ),
                        array(
                            'name' => '手机号码',
                            'type' => 'raw',
                            'value' => '$data[Phone]',
                            'headerHtmlOptions' => array('width' => '100px')
                        ),
                        array(
                            'name' => '操作',
                            'type' => 'raw',
                            'value' => 'Chtml::tag("a",array("href"=>"javascript:void(0)","addressid"=>$data[ID]),"修改地址")',
                            'headerHtmlOptions' => array('width' => '80px')
                        ),
                    )
                ))
                ?>
            </div>
            <div style="background:#c9d5e3;height: 1px;margin: 10px 0 10px 0"></div>
            <div style="margin-left:10px"><b><span style="color:#0065bf;font-size: 14px;display: none;" class="huodong">优惠活动</span></b></div>
            <div style="margin:10px 0px 5px 80px;background:#eff4fa;height: 40px" id="huodong" class="huodong">
                
            </div>    
            
             <div style="margin-left:10px"><b><span style="color:#0065bf;font-size: 14px">选择支付方式</span></b></div>
             <div style="margin-top:10px;background:#eff4fa;height: 30px" >
                <div style="display:block;float: left;width: 40%;line-height: 20px" id="onepayment"><input type="radio" name="type" checked value="1" style="margin-left:80px" discount="<?php echo $discount['OrderAlipay'] ? $discount['OrderAlipay'] : '100%' ?>"><span >支付宝担保交易</span></div>
                <div style="display:block;float: left;width: 40%;line-height: 20px" id="twopayment"><input type="radio" name="type" value="2" style="margin-left:40px" discount="<?php echo $discount['OrderLogis'] ? $discount['OrderLogis'] : '100%' ?>"><span >物流代收</span></div>
            </div>    
             
            <div style="background:#c9d5e3;height: 1px;margin: 10px 0 10px 0"></div>
            <div style="background:#eff4fa;height: 45px">
                <div style="display:block;float: left;width: 40%;line-height: 20px" id="showdiscout"><span style="margin-left:80px" >折扣率：<span id="setdiscount"><?php echo $discount['OrderAlipay'] ? $discount['OrderAlipay'] : '100%' ?></span><span id="advice_cu" style="color:red"></span></span></div>
                <div style="display:block;float: left;width: 40%;line-height: 20px"><span style="margin-left:40px">实际交易价：<span id="settotal" style="color:red"></span></span></div> 
            </div> 
        </div>
        <p align="center" style="margin-top:20px">
            <?php if ($quoinfo['Status'] == 1): ?>
                <input type="submit" class="submit" value="确认" id="sure" key="<?php echo $quoinfo['Status'] ?>">
                <input type="submit" class="submit" value="拒绝" id="return" key="<?php echo $schinfo[0]['QuoID'] ?>">
            <?php elseif ($quoinfo['Status'] == 2): ?>
                <input type="submit" class="submit_else" value="已确认" >
            <?php elseif ($quoinfo['Status'] == 3): ?>
                <input type="submit" class="submit_else" value="待修改" >
            <?php elseif ($quoinfo['Status'] == 4): ?>
                <input type="submit" class="submit_else" value="已拒绝" >
            <?php elseif ($quoinfo['Status'] == 5): ?>
                <input type="submit" class="submit_else" value="已失效" >
            <?php endif; ?>
        </p>

    <?php endif; ?>
</div>
<form id="goodsdetil" method="post" action="" target="_blank">
    <input  name="Version" type="hidden">
    <input  name="quo" type="hidden">
    <input  name="Order" type="hidden">
</form>
<?php $this->renderPartial('/inquiryorder/address', array('model' => $model)); ?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>

<?php
//我的优惠券
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'actpaper',
    'options' => array(
        'title' => '我的优惠券',
        'width' => 500,
        'height' => 260,
        'autoOpen' => false,
        'resizable' => false,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
                'buttons'=>array(     
                    '确定使用'=>'js:function(){ choosecoupon()}',     
                    '取消'=>'js:function(){ $(this).dialog("close");}',     
                    ),     
    ),
));
echo $this->renderPartial('/quotationlist/coupon',array('dataProvider'=>BuyGoodsService::mycoupon()));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?> 


<script>
                    //计算报价
                    function counttotal(id) {
                        //计算单个商品总价
                        if (id != undefined) {
                            countgoods(id);
                        }

                        //计算总价
                        var totalprices = 0;
                        $('.zdycss:visible table tbody tr').each(function() {
                            if ($(this).find(':checkbox').attr('checked') == 'checked') {
                                totalprices += parseFloat($(this).find('[name=prices]').text());
                            }
                        })
                        totalprices = totalprices.toFixed(2);
                        $('.zdycss:visible .totalprice').text(totalprices);
                        $("#settotal").html('￥' + totalprices);
                            setamout(totalprices);
                    }

                    //计算单个商品总价
                    function countgoods(id) {
                        var index = $('.selectedli').index();
                        var objtr = $('.zdycss:visible :checkbox[goodsid=' + id + ']');
                        var p = objtr.parents('tr');
                        var price = parseFloat(p.find('td:eq(6)').text());
                        var num = parseInt(p.find('[name=num]').val());
                        var prices = price * num;
                        if ($('input[name=radio][num="' + (index + 1) + '"]').attr('checked')) {
                            var html = '<span style="color:red">' + prices.toFixed(2) + '</span>';
                            p.find('[name=prices]').html(html);
                        } else {
                            p.find('[name=prices]').text(prices.toFixed(2));
                        }

                    }

                    //数量减一
                    function numsub(id, obj)
                    {
                        var num = $(obj).next('input').val();
                        if (num > 1) {
                            num = parseInt(num) - 1;
                        }
                        else
                            return;
                        $(obj).next('input').val(num);
                        counttotal(id);
                    }

                    //数量加一
                    function numadd(id, obj)
                    {
                        var num = $(obj).prev('input').val();
                        num = parseInt(num) + 1;
                        if (num > 100) {
                            num = 100;
                        }
                        $(obj).prev('input').val(num);
                        counttotal(id);
                    }

                    //输入商品数量
                    function numkeyup(id, obj) {
                        var val = obj.value;
                        if (val <= 1) {
                            obj.value = 1;
                        }
                        if (isNaN(val))
                        {
                            obj.value = 1;
                        }
                        if (val > 100) {
                            obj.value = 100;
                        }
                        obj.value = obj.value.replace(/\D/g, '');
                        counttotal(id);
                    }

                    //鼠标移出商品数量
                    function numblur(id, obj) {
                        var val = obj.value;
                        if (isNaN(val))
                        {
                            obj.value = 1;
                        }
                        if (!isNaN(val)) {
                            //如果数量超过100
                            if (parseInt(val) > 100) {
                                obj.value = 100
                            }
                        }
                        counttotal(id);
                    }
                    var lms_goods_sum = 0;
                    var oldlist;
                    var oldlist_data = new Array();//定义上一个选择的列表存储price的数组
                    var cop_amout=0;
                    var CouponSn;//优惠券编号
                    $(function() {
                        //商品选中事件
                        $('input[name=selectgoods]').change(function() {
                            counttotal();
                        })

                        $('#buylist1 [class=pager]').remove();
                        $('#buylist2 [class=pager]').remove();
                        $('#buylist3 [class=pager]').remove();

                        $('input[name=radio]').change(function() {
                            if (oldlist) {
                                //移除html
                                delhtml(oldlist);
                            }
                            var listID = $(this).attr('num');
                            var select_table = 'a_tab' + listID;
                            $('#' + select_table).click();
                            oldlist = listID;
                            var discount = $('input[name=type]:checked').attr('discount');
                            //统计
                            sumtotal(listID, discount);
                            if ($("#sure").attr('key') == 1) {
                                $("#hideaddress").show();
                            }
                        });

                        $('input[name=type]').change(function() {
                            var list_num = $('input[name=radio]:checked').attr('num');
                            delhtml(list_num);
                            var discount = $(this).attr('discount');
                            if (!discount) {
                                discount = '100%';
                            }
                            $("#setdiscount").html(discount);
                            var listID = $('input[name=radio]:checked').attr('num');
                            //统计
                            sumtotal(listID, discount);
                        });

                        //确认
                        var inquiry_sure_click = false;
                        $("#sure").click(function() {
                            if (inquiry_sure_click) {
                                alert('订单正在创建中，请稍后…');
                                return false;
                            }
                            if (lms_goods_sum > 99999999.99) {
                                alert('抱歉，该订单交易金额超过交易上限，无法生成订单');
                                return false;
                            }
                            var SchID = $('input[name=radio]:checked').attr('key');
                            var quoID = $('input[name=radio]:checked').attr('quoID');
                            if (SchID) {
                                var select = $('input[name=radio]:checked').attr('num');
                                var goodsid = '';
                                var num = '';
                                $('#buylist' + select + ' table tbody tr').each(function() {
                                    if ($(this).find(':checkbox').attr('checked') == 'checked') {
                                        goodsid += $(this).find('td:first span').attr('goodsid') + ',';
                                        num += $(this).find('[name=num]').val() + ',';
                                    }
                                })
                                goodsid = goodsid.substr(0, goodsid.length - 1);
                                num = num.substr(0, num.length - 1);
                                var address = $("#address").find('input[name="selectdel[]"]:checked').val();
                                var payment = $("input[name=type]:checked").val();
                                if (address) {
                                    var lms_mini = '<?php echo $mini ?>';
                                    var lms_total = $("#settotal").text();
                                    lms_total = lms_total.replace('￥', '');
                                    lms_total = parseFloat(lms_total);
                                    if (lms_mini > lms_total) {
                                        alert('该经销商最小交易额为￥' + lms_mini + '，生成订单失败');
                                        return false;
                                    }
                                    if (lms_mini > lms_total || confirm('确认生成订单')) {
                                        inquiry_sure_click = true;
                                        $.ajax({
                                            url: '<?php echo Yii::app()->createUrl('pap/'.$action.'/surequotation') ?>',
                                            data: {'SchID': SchID, 'payment': payment, 'addressID': address,
                                                'quoID': quoID, 'goodsid': goodsid, 'num': num,'CouponSn':CouponSn},
                                            type: 'post',
                                            dataType: 'json',
                                            success: function(lms) {
                                                inquiry_sure_click = false;
                                                if (lms.success == true) {
                                                    alert(lms.message);
                                                    if (payment == 1) {
                                                        window.location.href = Yii_baseUrl + '/pap/buyorder/payorder/id/' + lms.orderID;
                                                    } else {
                                                        window.location.href = Yii_baseUrl + '/pap/'+'<?php echo $action?>'+'/index';
                                                    }
                                                } else {
                                                    alert(lms.message);
                                                }
                                            }
                                        })
                                    }
                                } else {
                                    alert('请选择收货地址');
                                }
                            } else {
                                alert('请选择要确认的方案');
                            }
                        });

                        //拒绝报价单
                        $("#return").click(function() {
                            var app = $(this).attr('key');
                            if (app) {
                                $.ajax({
                                    url: '<?php echo Yii::app()->createUrl('pap/inquiryorder/deletequotation') ?>',
                                    data: {'quoID': app},
                                    type: 'post',
                                    dataType: 'json',
                                    success: function(lms) {
                                        if (lms.success) {
                                            alert(lms.message);
                                             window.location.href = Yii_baseUrl + '/pap/'+'<?php echo $action?>'+'/index';
                                        } else {
                                            alert(lms.message);
                                        }
                                    }
                                })
                            } else {
                                alert('请选择方案')
                            }
                        })

                    })

                    //统计表格数据
                    function sumtotal(ID, discount) {
                        var listID = 'buylist' + ID;
                        var shipcost = 0;
                        var settotal = 0;
                        $("#" + listID).find('tbody tr').each(function() {
                          
                            var sell = '';//$(this).find('td:eq(0)').find('span').attr('issell');//以去掉促销
                            var price = $(this).find('td:eq(6)').text();
                            price = $.trim(price);
                            oldlist_data.push(price);
                            price = parseFloat(price);
                            var number = $(this).find('input[name="num"]').val();
                            number = $.trim(number);
                            number = parseFloat(number);
                            var total;
                            var realprice;
                            if (sell != 1) {
                                discount = discount.replace('%', '');
                                realprice = price * (parseFloat(discount) / 100)
                                realprice = parseFloat(realprice);
                                realprice = realprice.toFixed(2);
                                total = realprice * number;
                            }
                              if ($(this).find(':checkbox').attr('checked') == 'checked') {
                               settotal += total;
                            }
                            if (sell != 1) {//如果不是促销，则不改变
                                var realhtml = kuohaohtml(price, realprice);
                                $(this).find('td:eq(6)').html(realhtml);
                                var realtotal = kuohaohtml(price * number, total);
                                $(this).find('td:eq(8)').html(realtotal);
                            }
                        })
                        var pls = settotal;// + shipcost
                        pls = pls.toFixed(2);
                        lms_goods_sum = pls;
//                        $("#settotal").html('￥' + pls);
                        if(discount=='100'){
                            $('#showdiscout').hide();
                             $('#showdiscout').siblings('div').css('margin-left','45px');
                        }else{
                            $('#showdiscout').show();
                              $('#showdiscout').siblings('div').css('margin-left','0px');
                        }
                        $("#total_append_lms" + ID).html(pls + '元');
                        setamout(pls);
                    }
                    function kuohaohtml(price, realprice) {
                        var aaa = price.toFixed(2);
                        var bbb = parseFloat(realprice).toFixed(2);
                        return '<span style="color:red">' + bbb + '</span>'
                    }

                    //移除
                    function delhtml(id) {
                        var listID = 'buylist' + id;
                        var total_append_lms = 0;
                        $("#" + listID).find('tbody tr').each(function(k, v) {
                            var price = oldlist_data[k];
                            var number = $(this).find('input[name="num"]').val();
                            $(this).find('td:eq(6)').html(parseFloat(price));
                            $(this).find('td:eq(8)').html(parseFloat(price) * parseFloat(number));
                            total_append_lms += parseFloat(price) * parseFloat(number);
                        });
                        $("#total_append_lms" + id).html(total_append_lms + '元');
                        oldlist_data = new Array();//初始化
                    }


                    //跳转
                    $('.quottion_goods_href').click(function() {
                        var goodsid = $(this).attr('goodsid');
                        $('input[name=Version]').val($(this).attr('version'));
                        $('input[name=quo]').val($(this).attr('quogoodsid'));
                        $('input[name=Order]').val($(this).attr('orderid'));
                        var url = '<?php echo Yii::app()->baseUrl ?>' + '/pap/orderreview/ordergoods/goods/' + goodsid;
                        $('#goodsdetil').attr('action', url);
                        $('#goodsdetil').submit();
                    });

                    $('#slide').click(function(e) {
                        e.stopPropagation();
                        $('#slidediv').slideToggle(500);
                        $('#down').toggleClass('slide2');
                        if ($('#up').css("display") == "inline")
                        {
                            //隐藏
                            $('#up').attr('class', '');
                            $('#up').addClass('slide2');
//                            $('#content_left').height(content - sch);
                        }
                        else
                        {
                            //显示
                            $('#up').attr('class', '');
                            $('#up').addClass('slide1');
//                            $('#content_left').height(content);
                        }
                    });
                    $('#clickp').click(function() {
                        $('#slide').trigger('click');
                    });
                    
                    //弹出选择窗口
                      $('.payper').live('click',function(){
                        $('#actpaper').dialog('open');
                        }) ; 
                        
                        //标示总价
                        function setamout(amount){
                            $.post('<?php echo Yii::app()->createUrl("pap/quotationlist/getaction")?>',{'amount':amount,'cop_amout':cop_amout},function(msg){
                                var thispayment=$('input[name=type]:checked').val();
                                if((msg.payment==thispayment &&  msg.html)|| (msg.html && msg.payment==0)){
                                    $('.huodong').show();
                                    $('#huodong').html(msg.html);
                                }else{
                                   $('.huodong').hide();  
                                   cop_amout=0;
                                   msg.order_decr=0;
                                }
//                                if(msg.html){
//                                    $('.huodong').show();
//                                    $('#huodong').html(msg.html);
//                                    if(msg.payment==='2'){
//                                    }else if(msg.payment==='3'){
//                                    }
//                                }
                                if(parseFloat(msg.order_decr)<=parseFloat(amount)){
                                      var final=parseFloat(amount)-parseFloat(msg.order_decr);
                                    if(cop_amout>0){
                                        if(final>cop_amout){
                                             $('#settotal').html('￥'+parseFloat(final-cop_amout).toFixed(2)); 
                                        }else{
                                            $('#settotal').html('￥0.00');
                                        }   
                                    }else{
                                         $('#settotal').html('￥'+parseFloat(final).toFixed(2)); 
                                    }
                                }else{
                                    $('#settotal').html('￥0.00');
                                }
                            },'json');
                        }
                        
       function choosecoupon(){
       var check=$('#coup-grid').find("input[type=checkbox]:checked").val();
       if(check==undefined){
           alert('请选择您要使用的优惠券');
           return false;
        }
        var obj_list=$('#coup-grid').find("input[type=checkbox]:checked").parent().siblings();
        var price=  parseFloat($(obj_list[1]).text());
        $('.cup').html("<span style='color:red'>使用优惠券:-￥"+price+"<span>");
        cop_amout=parseFloat(price);
            var settotal=parseFloat($('#settotal').text().replace('￥',''));
            if(settotal>price){
              $('#settotal').html('￥'+parseFloat(settotal-price).toFixed(2));  
            }else{
                 $('#settotal').html('￥0.00');
            }
            $('#actpaper').dialog('close');
            CouponSn=$('#coup-grid').find("input[type=checkbox]:checked").val();
    }
</script>