<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; text-indent:17px}
    .title_lm li a{font-size:14px; color:#0164c1;}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    .txxx2{ border-bottom:2px solid #c5d2e2}
    .tb_head li{ float:left; color:#fff ; text-align:center}
    .tb_head .sp_info{ width:415px}
    .tb_head .price{ width:100px}
    .tb_head .shuliang{ width:50px}
    .tb_head .s_fukuan{ width:160px}
    .tb_head .caozuo{ width:100px}
    .sp_plcl a{ padding:0px 5px}
    .sp_plcl{ border:1px solid #ccc; display:inline-block; height:20px; line-height:20px;}
    .mbx4{ background:#eff4fa;}
    .mbx4 span{  color:#666}
    span.zwq_color{ color:#fb540e}
    .sp_div{border-top:1px solid #ebebeb;}
    .splb_order{ width:560px}
    .splb_order li{ height:100px; border-right:1px solid #ebebeb;padding-bottom:5px}
    div.div_info{ text-align:left;width:300px}
    .div_img{width:90px}
    .div_img img{width:85px}
    .splb_order .price,.splb_order .shuliang,.splb_order .s_fukuan{ line-height:100px}
    .splb_order .price{width:105px}
    .pricett{margin-top:32px;width:105px}
    .ck_price{text-decoration:line-through;font-weight:400}
    .pro_price{margin-top:5px;color:#fb540e}
    li.last{ border-bottom:none}
    .zkss{display:inline-block; width:100px; height:26px; cursor:pointer}
    .zkss2{display:inline-block; width:100px; height:26px; cursor:pointer}
    .zkss{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px -26px;}
    .zkss2{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px 0px;;}
    .color_blue {color: blue;}
    .goods_name{height: 20px;line-height: 20px;overflow: hidden;width: 298px;}
    .goods_name a{font-size:14px;font-weight:bold}
    .goods_attr{height: 17px;line-height: 17px;overflow: hidden;width: 298px;}
    .cut{white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}

    .goods_show{width:312px;}
    .goods_show table tr{border-bottom:none}
    .goods_show1{text-align:center;width:103px;vertical-align:middle}
    .goods_show2{text-align:center;width:100px;vertical-align:middle}
    .goods_show3{text-align:center;width:100px;vertical-align:middle}
    .goods_show2  , .goods_show1{border-right:1px solid #e8e8e8; }   
    .goods_show .float_l{
        height: 100%;
    }
    .m_top7{margin-top: 7px;}
    .m_top20{margin-top:20px}
    a{ cursor:pointer}
    .border{border:1px solid #ebebeb; margin-top:10px}
    .border:hover{ border:1px solid #bbb}
    .od_time{display: block;float: left;width: 172px;}
    .mouse_div:hover{color:#0164c1}
    #formedit p{height:22px;line-height:22px;}
    .show-msg{background: none repeat scroll 0 0 #fff;
              border: 1px solid #73a6d5;
              border-radius: 1px;
              box-shadow: 0 0 2px 2px #eee;   
              padding: 9px;
              position: absolute;
              right: 88px;
              top: -40px;
              width: 450px;
              z-index: 1;
              display:none;
              text-align:left;
              min-height:183px;
              line-height:22px;
    }
    .change, .send, .order_print, .eval{color:#0164c1}
    .send:hover, .change:hover, .order_detail:hover, .order_print:hover, .eval:hover{color:#0164c1;text-decoration: underline;}
</style>

<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '发货管理' => Yii::app()->createUrl('pap/sellerorder/send'),
        )
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
<!--            <li class="<?php echo!in_array($get['type'], array(1, 2)) ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/sellerorder/send') ?>">所有订单 </a><span class="interval">  |</span></li>
            <li class="<?php echo $get['type'] == 1 ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/sellerorder/send', array('Status' => 1, 'type' => '1')) ?>">待付款 </a><span class="zwq_color"><?php echo $count1 ?></span><span class="interval">  |</span></li>-->
            <li class="<?php echo $get['type'] == 2 ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/sellerorder/send') ?>">待发货 </a><span class="zwq_color"><?php echo $count2 ?></span><span class="interval">  |</span></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a">
            <form method="get" id="order_form" action="<?php //echo Yii::app()->createUrl('pap/sellerorder/send')                                   ?>">
                <div class="zkss_info m-top" style="display:block">
                    <p>
                        <label  class=" m_left24">买家名称：</label>
                        <input type="text" class=" input input3 width150" name="BuyerName" value="<?php echo $get['BuyerName'] ?>">
                        <label  class=" m_left24">下单时间：</label>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'starttime',
                            'attribute' => 'start_time',
                            'language' => 'zh_cn',
                            'value' => $get['starttime'] ? date('Y-m-d', $get['starttime']) : '',
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', //database save format  
                            ),
                            'htmlOptions' => array(
                                'class' => 'input input3 width100',
                            )
                        ));
                        ?>
                        到<?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'endtime',
                            'attribute' => 'end_time',
                            'language' => 'zh_cn',
                            'value' => $get['endtime'] ? date('Y-m-d', $get['endtime']) : '',
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', //database save format  
                            ),
                            'htmlOptions' => array(
                                //'readonly' => 'readonly',
                                // 'style' => 'width:90px;',
                                'class' => 'input input3 width100',
                            )
                        ));
                        ?>
                    </p>
                    <p class="m-top">                        
                        <label class=" m_left24">交易状态：</label>
                        <select class="select select2" name="" status="<?php $get['Status'] ?>" disabled>
                            <option value ="">待发货</option>
                            <?php //foreach ($status as $k => $v): ?>
                                <!--<option value ="<?php echo $k ?>"<?php if ($k == $get['Status']) echo 'selected' ?>><?php echo $v; ?></option>-->
                            <?php //endforeach; ?>
                        </select>
                        <label  style="margin-left:59px">订单号：</label>
                        <input type="text" class=" input input3 width140" value="<?php echo $get['search_text']; ?>" style="margin-left:4px" name="search_text">
                        <input type="button"  class="submit m_left f_weight"  value="查 询" id="gbss_btn">
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="mbx mbx3 m-top">
        <ul class="tb_head">
            <li class="sp_info">商品信息</li>
            <li class="price">单价（元）</li>
            <li class="shuliang">数量</li>
            <li class="caozuo">实付款（元）</li>
            <li class="caozuo">交易状态</li>
            <li class="caozuo">交易操作</li>
        </ul>
    </div>

    <?php if ($get['type'] != 1): ?>
        <p style="line-height:25px; margin-top:5px">
            <input type="checkbox" class="checkbox m_left12" id="checkAll"> 全选
            <span class="sp_plcl m_left"><a href="javascript:;" id="sendAll">合并发货</a></span>
    <!--        <span class="sp_plcl m_left"><a href="">打印发货单</a></span>-->
        </p>
    <?php endif; ?>

    <?php
    $this->widget('widgets.default.WListView', array(
        'dataProvider' => $data,
        //'headerView' => 'goodshead',
        'itemView' => 'orderlist',
        'id' => 'orderlistview'
    ));
    ?>
</div>
<!--content2结束-->
<form action="<?php echo Yii::app()->createUrl('pap/sellerorder/sendorder'); ?>" method="POST" id="sendform">
    <input type="hidden" name="sendstr">
</form>
<script>
    var send = [];

    $(document).ready(function() {

        /*订单选项卡*/
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");
        })

        //订单搜索按钮
        $('#gbss_btn').bind('click', function() {
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/sellerorder/send' + url;
        })

        //翻页处理
        $(".pager a").live('click', function() {
            setTimeout(function() {
                var check = $("input[name='check[]']");
                if (send.length != 0) {
                    for (var i in send) {
                        $('#o' + send[i]).attr('checked', true);
                    }
                }
                $('#checkAll').attr('checked', check.length == $("input[name='check[]']:checked").length ? true : false);
            }, 500);
        })

        //全选
        $('#checkAll').live('click', function() {
            var check = $("input[name='check[]']");
            var checked = $(this).attr('checked');
            check.each(function() {
                $(this).attr('checked', checked ? checked : false);
                var order = $(this).attr('id').substr(1);
                if ($(this).attr('checked') && !isNaN(order)) {
                    if ($.inArray(order, send) == -1) {
                        send.push(order);
                    }
                }
                else {
                    for (var i in send) {
                        if (send[i] == order) {
                            var index = i;
                        }
                    }
                    send.splice(index, 1);
                }
            })
        })

        //选中
        $("input[name='check[]']").live('click', function() {
            var check = $("input[name='check[]']");
            $('#checkAll').attr('checked', check.length == $("input[name='check[]']:checked").length ? true : false);
            var order = $(this).attr('id').substr(1);
            if ($(this).attr('checked') && !isNaN(order)) {
                if ($.inArray(order, send) == -1) {
                    send.push(order);
                }
            }
            else {
                for (var i in send) {
                    if (send[i] == order) {
                        var index = i;
                    }
                }
                send.splice(index, 1);
            }
        });

        //合并发货
        $('#sendAll').click(function() {
            var sendstr = send.join(',');
            sendOrder(sendstr);
        })

        //发货
        $('.send').live('click', function() {
            var sendstr = $(this).attr('order');
            $('input[name=sendstr]').val(sendstr);
            $('#sendform').submit();
        })

        //改价
        $('.change').live('click', function() {
            var order = $(this).attr('order');
            window.location.href = Yii_baseUrl + '/pap/sellerorder/changeorder/order/' + order;
        })

        //        window.setInterval(function(){
        //            $('div.show-msg').attr('load','');
        //        },60000);
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
                    if (data.error == 2) {
                        // location.reload();
                        //                        $.fn.yiiListView.update(	              
                        //                        "orderlistview"
                        //                    )
                    }
                }
                else if (data.success)
                {
                    $('input[name=sendstr]').val(sendstr);
                    $('#sendform').submit();
                    //window.location.href = Yii_baseUrl + '/pap/sellerorder/sendorder';
                }
            }
        })
    }

    //获取url
    function getUrl() {
        var url = '';
        var search_text = $('input[name=search_text]').val();
        if ($.trim(search_text) !== '') {
            search_text = search_text.replace(/\//g, "<<q");
            search_text = search_text.replace(/\\/g, "q>>");
            search_text = encodeURIComponent(search_text);
            url += '/search_text/' + search_text;
        }
        var Status = $('select[name=Status]').val();
        if (Status !== '' && Status !== undefined) {
            url += '/Status/' + Status;
        }
        var BuyerName = $('input[name=BuyerName]').val();
        if ($.trim(BuyerName) !== '') {
            BuyerName = BuyerName.replace(/\//g, "<<q");
            BuyerName = BuyerName.replace(/\\/g, "q>>");
            BuyerName = encodeURIComponent(BuyerName);
            url += '/BuyerName/' + BuyerName;
        }
        var starttime = $('input[name=starttime]').val();
        if ($.trim(starttime) !== '') {
            url += '/starttime/' + starttime;
        }
        var endtime = $('input[name=endtime]').val();
        if ($.trim(endtime) !== '') {
            url += '/endtime/' + endtime;
        }
        return url;
    }

    //订单跟踪
    function showinfo(id) {
        if ($('#follow' + id).attr('load') == 'loaded') {
            $('#follow' + id).show();
            return false;
        }
        var url = Yii_baseUrl + '/pap/sellerorder/getorder';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': id},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.error) {
                    location.reload();
                }
                else {
                    var html = '<div style="font-weight:bold;border-bottom:1px solid #73a6d5;padding-bottom:5px">';
                    html += '<label style="padding-right:120px">处理时间</label><label>处理信息</label>';
                    html += '<a onclick="closeinfo(' + id + ')" style="float:right;padding-right:2px;*margin-top:-30px">×</a></div>';
                    html += '<p><span class="od_time">' + data.CreateTime + '</span><span>买家已下单' + data.text + '</span>';
                    if (data.Payment == 1 && data.PayTime)
                        html += '<p><span class="od_time">' + data.PayTime + '</span><span>买家已付款，请您点击订单详情确认</span>';
                    if (data.ConfirmTime)
                        html += '<p><span class="od_time">' + data.ConfirmTime + '</span><span>您已确认，请尽快发货</span>';
                    if (data.DeliveryTime) {
                        html += '<p><span class="od_time">' + data.DeliveryTime + '</span><span>您已发货</span>\n\
<span style="padding-left:8px">物流公司为：' + data.ShipLogis + '</span>';
                        html += '<p><span style="padding-left:172px">运货单号为：' + data.ShipSn + '</span>';
                    }
                    if (data.ReceiptTime)
                        html += '<p><span class="od_time">' + data.ReceiptTime + '</span><span>买家已收货</span>';
                    $('#follow' + id).html(html);
                    $('#follow' + id).attr('load', 'loaded');
                }
            }
        });
        $('#follow' + id).show();
    }

    function closeinfo(id) {
        $('#follow' + id).hide();
    }
</script>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '订单跟踪',
        'autoOpen' => false, //是否自动打开 
        'modal' => true, // 层级
        'width' => '550', //宽度  
        'resizable' => false,
    ),
));
?>
<div id="formedit">
</div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
