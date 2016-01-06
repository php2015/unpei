<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center;text-indent:17px}
    .title_lm li a{font-size:14px; color:#0164c1;float:left}
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
    .goods_name{height: 20px;line-height: 20px;width: 298px;}
    .goods_name a{font-size:14px;font-weight:bold}
    .goods_attr{height: 17px;line-height: 17px;width: 298px;}
    .goods_side{display:block;float:left}
    .goods_num{max-width:120px;display:block;float:left;cursor:pointer}
    .goods_tt a{color:#fb540e;font-size:14px;font-weight:bold}
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
    .m_top20{margin-top:20px}   
    .m_top7{margin-top: 7px;}
    a{cursor:pointer} 
    .button5{background:#77BAFF;border:none;border-radius:2px; color:#fff; cursor:pointer; padding:2px 4px}
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
              top: -20px;
              width: 450px;
              z-index: 10;
              display:none;
              text-align:left;
              min-height:183px;
              line-height:22px;
    }
.editsend,.change, .send, .order_print, .eval{color:#0164c1}
.editsend:hover, .send:hover, .change:hover, .order_detail:hover, .order_print:hover ,.eval:hover{color:#0164c1;text-decoration: underline;}
.com-info{ width:500px; height:180px; border:2px solid #f47202;background:#fff; position: fixed; padding: 15px; z-index: 10000;top:130px;left:409px }
.com-close{ text-align: right} 
.color_c{color:#f47202} 
.color_b{color:#0264c5} 
.clear{clear:both}
.m-top10{ margin-top:10px}  
.m-top15{ margin-top:15px} 
.datagrid-mask{height:800px}
.datagrid-masks{height:800px}
</style>
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '已卖出的商品' => Yii::app()->createUrl('pap/sellerorder/index'),
        )
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li class="<?php echo!in_array($params['type'], array(1, 2, 3, 4)) ? 'current' : ''; ?>"><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/index') ?>">所有订单 </a><span class="interval">  |</span></li>
            <li class="<?php echo $params['type'] == 1 ? 'current' : ''; ?>"><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/index', array('Status' => 1, 'type' => '1')) ?>">待付款 <span class="zwq_color"><?php echo $count[1] ?></a></span><span class="interval">  |</span></li>
            <li class="<?php echo $params['type'] == 2 ? 'current' : ''; ?>"><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/index', array('Status' => 2, 'type' => '2')) ?>">待发货 <span class="zwq_color"><?php echo $count[2] ?></a></span><span class="interval">  |</span></li>
            <li class="<?php echo $params['type'] == 3 ? 'current' : ''; ?>"><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/index', array('Status' => 3, 'type' => '3')) ?>">待收货 <span class="zwq_color"><?php echo $count[3] ?></a></span><span class="interval">  |</span></li>
            <li class="<?php echo $params['type'] == 4 ? 'current' : ''; ?>"><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/index', array('EvaStatus' => 1, 'type' => '4')) ?>">待评价 <span class="zwq_color"><?php echo $count[4] ?></a></span><span class="interval">  |</span></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a">
            <form id="order_form" >
                <input type="text" class=" input input3 width375 float_l" value="<?php echo $params['search_text'] ? $params['search_text'] : '请输入订单号'; ?>" style="margin-left:0px" name="search_text">
                <?php
                $get = $params;
                unset($get['search_text']);
                ?>
                <input type="button" class="submit f_weight float_l m_left" value="查 询" id="gbss_btn">
                <span class="<?php echo $get['search'] == 'zk' ? 'zkss2' : 'zkss' ?>" id="zkss"> </span>
                <div style="clear:both"></div>
                <div class="zkss_info m-top" style="<?php if ($get['search'] == 'zk') echo 'display:block' ?>">
                    <p>
                        <label>支付方式：</label>
                        <select class="select select2 width120" name="Payment">
                            <option value ="">支付方式</option>
                            <?php foreach ($type as $k => $v): ?>
                                <option value ="<?php echo $k ?>"<?php if ($k == $get['Payment']) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label  class=" m_left24">交易状态：</label>
                        <select class="select select2 width120" name="Status" status="<?php $get['Status'] ?>">
                            <option value ="">交易状态</option>
                            <?php foreach ($status as $k => $v): ?>
                                <option value ="<?php echo $k; ?>"<?php if ($k == $get['Status']) echo 'selected' ?>><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class=" m_left24">评价状态：</label><select class="select select2 width120" name="EvaStatus">
                            <option value ="">评价状态</option>
                            <option value ="1" <?php echo $get['EvaStatus'] == 1 ? 'selected' : '' ?>>待评价</option>
                            <option value ="2" <?php echo $get['EvaStatus'] == 2 ? 'selected' : '' ?>>已评价</option>
                        </select>
                    </p>

                    <p class="m-top">
                        <label  class="">买家名称：</label>
                        <input type="text" class=" input input3 width200" name="BuyerName" value="<?php echo $get['BuyerName'] ?>">
                        <label  class="m_left24">成交时间：</label>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'starttime',
                            'attribute' => 'start_time',
                            'language' => 'zh_cn',
                            'value' => $get['starttime'] ? date('Y-m-d', $get['starttime']) : '',
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                            'htmlOptions' => array(
                                'class' => 'input input3 width100',
                            )
                        ));
                        ?>
                        &nbsp;到&nbsp;<?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'endtime',
                            'attribute' => 'end_time',
                            'language' => 'zh_cn',
                            'value' => $get['endtime'] ? date('Y-m-d', $get['endtime']) : '',
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                            'htmlOptions' => array(
                                'class' => 'input input3 width100',
                            )
                        ));
                        ?>
                    </p>
                    <input type="text" name="type" value="<?php echo $params['type']?$params['type']:''?>">
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
    <form action="" method="POST" id="goodsform" target="_blank">
        <input type="hidden" name="Version">
        <input type="hidden" name="GoodsID">
    </form>
    <form action="<?php echo Yii::app()->createUrl('pap/sellerorder/sendorder'); ?>" method="POST" id="sendform">
        <input type="hidden" name="sendstr">
    </form>
    <!--    <p style="line-height:30px"><input type="checkbox" class="checkbox m_left12"> 全选
        <span class="sp_plcl m_left"><a href="javascript:;">批量评价</a></span></p>-->
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
<script>
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
        //展开、关闭搜索
        $("#zkss").click(function() {
            if ($(this).attr('class') == 'zkss') {
                $(".zkss_info").slideToggle("slow");
                $(this).removeClass('zkss').addClass("zkss2");
            } else {
                $(".zkss_info").slideToggle("slow");
                $(this).removeClass('zkss2').addClass("zkss");
            }
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

        /*订单选项卡*/
        $(".title_lm li").click(function() {
            //$(this).addClass("current");
            //$(this).siblings().removeClass("current");
        })

        //订单号搜索
        $('input[name=search_text]').click(function() {
            if ($(this).val() == '请输入订单号') {
                $(this).val('');
            }
        })
        $('input[name=search_text]').blur(function() {
            if ($(this).val() == '') {
                $(this).val('请输入订单号');
            }
        })

        //订单搜索按钮
        $('#gbss_btn').bind('click', function() {
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/sellerorder/index' + url;
        })

        //订单改价
        $('.change').live('click', function() {
            var order = $(this).attr('order');
            window.location.href = Yii_baseUrl + '/pap/sellerorder/changeorder/order/' + order;
        })

        //订单发货编辑
        $('.editsend').live('click', function() {
            var order = $(this).attr('order');
            window.location.href = Yii_baseUrl + '/pap/sellerorder/editsendorder/order/' + order;
        })

        //发货
        $('.send').live('click', function() {
            var sendstr = $(this).attr('order');
            $('input[name=sendstr]').val(sendstr);
            $('#sendform').submit();
            //sendOrder(sendstr);
        })
        //        window.setInterval(function(){
        //            $('div.show-msg').attr('load','');
        //        },60000);
    })

    //获取url
    function getUrl() {
        var url = '';
        var search_text = $('input[name=search_text]').val();
        if ($.trim(search_text) !== '' && search_text !== '请输入订单号') {
            search_text = search_text.replace(/\//g, "<<q");
            search_text = search_text.replace(/\\/g, "q>>");
            search_text = encodeURIComponent(search_text);
            url += '/search_text/' + search_text;
        }
        var Payment = $('select[name=Payment]').val();
        if (Payment !== '') {
            url += '/Payment/' + Payment;
        }
        var Status = $('select[name=Status]').val();
        if (Status !== '') {
            url += '/Status/' + Status;
        }
        var EvaStatus = $('select[name=EvaStatus]').val();
        if (EvaStatus !== '') {
            url += '/EvaStatus/' + EvaStatus;
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
        var type= $('input[name=type]').val();
        if($.trim(type)!==''){
            url+='/type/'+type;
        }
        var zk = $('#zkss').attr('class');
        if (zk === 'zkss2') {
            url += '/search/zk';
        }
        return url;
    }

    //经销商评价
    function papeva(eva, EvaStatus, Status, BuyerID) {
        window.location.href = Yii_baseUrl + '/pap/sellerorder/papeva/order/' + eva + '/Status/' + Status + '/EvaStatus/' + EvaStatus + '/BuyerID/' + BuyerID;
    }

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
                    if (data.error === 1) {
                        location.reload();
                    }
                }
                else if (data.success)
                {
                    window.location.href = Yii_baseUrl + '/pap/sellerorder/sendorder';
                }
            }
        })
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
                        if (data.ShipSn)
                            html += '<p><span style="padding-left:172px">运单号码为：' + data.ShipSn + '</span>';
                    }
                    if (data.ReceiptTime)
                        html += '<p><span class="od_time">' + data.ReceiptTime + '</span><span>买家已收货</span>';
                    if (data.Status == 10)
                        html += '<p><span class="od_time">' + data.UpdateTime + '</span><span>买家已经取消了该订单</span>';
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