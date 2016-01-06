<style>
    .title_lm li a{color: #0164C1;
                   float: left;
                   font-size: 14px;
                   text-align: center;}
    .splb_order{ width:508px}
    .goods_show{width:365px;}

    .goods_show0, .goods_show1, .goods_show2, .goods_show3{text-align:center;width:88px;vertical-align:middle}
    .goods_show0{width:80px}
    .goods_show1{ width:95px}
    .goods_show3{ width:95px}
    .goods_attr{height: 17px;line-height: 17px;overflow: hidden;width: 298px;}
    .goods_name a{font-size:14px;font-weight:bold}
    .goods_name{height: 20px;line-height: 20px;overflow: hidden;width: 298px;}
    .goods_show0, .goods_show2  , .goods_show1{border-right:1px solid #e8e8e8; }   
    .goods_show .float_l{
        height: 100%;
    }
    .m_top20{margin-top:20px}
    .zkss_info{ display: none}
    a{ cursor:pointer}
    .cut{  height:20px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}
    .width120{ width: 120px}
    .width220{width:220px}
    .od_time{display: block;float: left;width: 172px;}
    #formedit p{height:22px;line-height:22px;}
    .mouse_div:hover{color:#0164c1}
    .show-msg{background: none repeat scroll 0 0 #fff;
              border: 1px solid #73a6d5;
              border-radius: 1px;
              box-shadow: 0 0 2px 2px #eee;   
              padding: 9px;
              position: absolute;
              right: 88px;
              top: -35px;
              width: 450px;
              z-index: 1;
              display:none;
              text-align:left;
              min-height:183px;
              line-height:22px;
    }
    .border{border:1px solid #ebebeb; margin-top:10px}
    .border:hover{ border:1px solid #bbb}
    .pyp ,.change ,.order_cancel,.payconfirm,.refuse,.eval,.ret,.agin, .confirm{color:#0164c1}
    .order_detail:hover ,.pyp:hover ,.change:hover ,.order_cancel:hover,.payconfirm:hover,
    .refuse:hover,.eval:hover,.ret:hover,.agin:hover, .confirm:hover{color:#0164c1;text-decoration: underline;}
</style>
<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '已买到的商品',
        )
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li class="<?php echo!in_array($_GET['orderstype'], array(1, 2, 3, 4)) ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/orderreview/index') ?>">所有订单</a><span class="interval">  |</span></li>
            <li class="<?php echo $_GET['orderstype'] == 1 ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/orderreview/index', array('orderstype' => 1, 'status' => 1)) ?>">待付款 </a><span class="zwq_color"><?php echo isset($count['paycount']) ? $count['paycount'] : '0'; ?></span><span class="interval">  |</span></li>
            <li class="<?php echo $_GET['orderstype'] == 2 ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/orderreview/index', array('orderstype' => 2, 'status' => 2)) ?>">待发货 </a><span class="zwq_color"><?php echo isset($count['shipcount']) ? $count['shipcount'] : '0'; ?></span><span class="interval">  |</span></li>
            <li class="<?php echo $_GET['orderstype'] == 3 ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/orderreview/index', array('orderstype' => 3, 'status' => 3)) ?>">待收货 </a><span class="zwq_color"><?php echo isset($count['waipcount']) ? $count['waipcount'] : '0'; ?></span><span class="interval">  |</span></li>
            <li class="<?php echo $_GET['orderstype'] == 4 ? 'current' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/orderreview/index', array('orderstype' => 4, 'evastatus' => 1)) ?>">待评价 </a><span class="zwq_color"><?php echo isset($count['acceptcount']) ? $count['acceptcount'] : '0' ?></span><span class="interval">  |</span></li>
        </ul>
    </div>
    <form action="" method="POST" id="goodsform" target="_blank">
        <input type="hidden" name="Version">
        <input type="hidden" name="Order">
    </form>
    <div class="order m-top">
        <div class="txxx_info2a">
            <form action='<?php echo Yii::app()->createUrl('pap/orderreview/index') ?>' method='get'>
                <input type="text" name='ordersn' class=" input input3 width375 float_l" value="<?php echo $_GET['ordersn'] ? $_GET['ordersn'] : '订单编号' ?>" onblur="if (value == '') {
                            value = '订单编号'
                        }" style="margin-left:0px">
                <input type="submit" class="submit f_weight float_l m_left" value="搜 索"><span class="zkss"> </span>
                <div style="clear:both"></div>
                <div class="zkss_info m-top">
                    <p>
                        <label>订单类型：</label>
                        <?php
                        echo CHtml::dropDownList('ordertype', "{$_GET['ordertype']}", array(
                            '1' => '商城订单',
                            '2' => '询价单订单',
                            '3' => '报价单订单'
                                ), array('class' => 'select select2 width80', 'empty' => '全部'))
                        ?>

                        <label  class=" m_left24">下单时间：</label>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'starttime',
                            'attribute' => 'start_time',
                            'language' => 'zh_cn',
                            'value' => $_GET['starttime'] ? $_GET['starttime'] : '',
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
                            'value' => $_GET['endtime'] ? $_GET['endtime'] : '',
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                            ),
                            'htmlOptions' => array(
                                'class' => 'input input3 width100',
                            )
                        ));
                        ?>

                        <label  class=" m_left24">卖家名称：</label>
                        <input type="text" name="sellername"  value="<?php echo isset($_GET['sellername']) ? $_GET['sellername'] : '' ?>" class=" input input3 width200">

                    </p>
                    <p class="m-top">
                        <label>评价状态：</label>
                        <?php
                        echo CHtml::dropDownList('evastatus', "{$_GET['evastatus']}", array('1' => '待评价', '2' => '已评价'), array('class' => 'select select2', 'empty' => '全部'))
                        ?>
                        <label  class=" m_left24">订单状态：</label>
                        <?php
                        echo CHtml::dropDownList('status', "{$_GET['status']}", array('1' => '待付款', '2' => '待发货', '3' => '待收货', '5' => '已拒收', '9' => '已收货', '10' => '已取消'), array('class' => 'select select2', 'empty' => '全部'))
                        ?>

<!--               <label  class=" m_left24" style="margin-left:117px">档次：</label><select class="select select2" >
               <option value ="厂家">厂家</option>
               <option value ="支架">1</option>
               <option value ="框架">2</option><option value ="螺栓">4</option>
               <option value ="螺栓">3</option>
          </select><input type="submit"  class="submit m_left f_weight"  value="搜索">-->
                    </p>
                    <input type="hidden" name="orderstype" value="<?php  echo isset($_GET['orderstype'])?$_GET['orderstype']:''?>"

                </div>

            </form>
        </div>

    </div>
    <div class="mbx mbx3 m-top">
        <ul class="tb_head">
            <li class="sp_info" style="width:305px">商品信息</li>
            <li class="price" style="width:155px">单价（元）</li>
            <li class="shuliang">数量</li>
            <!--            <li class="caozuo">商品操作</li>-->
            <li class="caozuo">实付款（元）</li>
            <li class="caozuo">交易状态</li>
            <li class="caozuo" style="padding-left:60px">交易操作</li>
        </ul>
    </div>
    <?php //if (is_array($dataProvider->getData())): ?>
<!--        <p style="line-height:25px" class="m-top5"><input type="checkbox" class="checkbox m_left12 " id="checkall"> 全选</span></p>-->
    <?php //endif ?>
    <?php
    $this->widget("widgets.default.WListView", array(
        'dataProvider' => $dataProvider,
        'id' => 'orderlist',
        'itemView' => 'list', // refers to the partial view named '_post'
        'summaryText' => '',
        'emptyText' => '无数据',
    ));
    ?>

</div>
<!--content2结束-->

<!--content1即又半部分结束-->

<div style="clear:both"></div>

<!--内容部分结束-->

<div style="clear:both"></div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/pap/style.js'></script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/pap/Myjs.js'></script>
<script>
</script>
<script>
    $(document).ready(function() {
        //商品详情
        $('.order_goods').live('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=Order]').val($(this).attr('order'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        });
        $('#checkall').live('click', function() {
            var checkall = $('#orderlist').find('input[type=checkbox]');
            if ($(this).attr('checked') == undefined)
            {
                checkall.attr('checked', false);
            } else {
                checkall.attr('checked', true);
            }
        });
        $('.confirm').click(function() {
            var url = Yii_baseUrl + '/pap/orderreview/confirmgoods';
            var orderid = $(this).attr('key');
            var bool = window.confirm('您确定已经收到货品?');
            if (bool == false) {
                return false;
            }
            $.post(url, {orderid: orderid}, function(data) {
                if (data == 1) {
                    location.reload();
                    //                    $.fn.yiiListView.update(	               //                    "orderlist"
                    //                );
                } else {
                    alert('确认收货失败');
                    return false;
                }
            });
        });

        $('.payconfirm').click(function() {
            alert('请到支付宝执行收货操作');
            var id = $(this).attr('key');
            window.open(Yii_baseUrl + '/pap/orderreview/payconfirm/id/' + id);
        });
        //修改订单
        $('.change').live('click', function() {
            var order = $(this).attr('order');
            window.location.href = Yii_baseUrl + '/pap/orderreview/changeorder/order/' + order;
        });

        //点击去付款
        $('.pyp').click(function() {
            var alipay = $(this).attr('alipay');
            var id = $(this).attr('key');
            if (!isNaN(id)) {
                if (alipay != 1) {
                    if (confirm('是否前往支付宝进行付款，确定后该订单将不能被修改！')) {
                        gotoAlipay(id);
                    }
                } else {
                    gotoAlipay(id);
                }
            }
        });
    });

    //前往支付宝付款
    function gotoAlipay(id) {
        var url = Yii_baseUrl + '/pap/buyorder/getaccount';
        $.getJSON(url, {orderid: id}, function(data) {
            if (data.success == 1) {
                location.href = Yii_baseUrl + '/pap/buyorder/payorder/id/' + id;
            } else {
                alert(data.failed);
                return false;
            }
        });
    }

    var num = 0;
    function delivery() {
        num++;
        if (num > 3) {
            alert('您今天提醒的次数过多!');
            return false;
        }
        alert('提醒卖家发货成功');
    }
    function papeva(OrderStatus, EvaStatus, OrderID) {
        window.location.href = Yii_baseUrl + '/pap/Orderreview/Buytoevaluation/OrderStatus/' + OrderStatus + '/EvaStatus/' + EvaStatus + '/OrderID/' + OrderID;
    }

    //订单取消
    function cancelOrder(id) {
        if (!isNaN(id)) {
            var url = Yii_baseUrl + '/pap/orderreview/cancelorder';
            var bool = window.confirm('您确定要取消该订单？');
            if (bool == false) {
                return false;
            }
            $.post(url, {orderid: id}, function(data) {
                if (data.success) {
                    alert('该订单已成功取消');
                    window.location.href = Yii_baseUrl + '/pap/orderreview/index';
                } else {
                    alert(data.msg);
                    location.reload();
                    return false;
                }
            }, 'JSON');
        }
    }

    //订单跟踪
    function showinfo(id) {
        if ($('#follow' + id).attr('load') == 'loaded') {
            $('#follow' + id).show();
            return false;
        }
        var url = Yii_baseUrl + '/pap/orderreview/getorder';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': id}, dataType: 'JSON',
            success: function(data)
            {
                if (data.error) {
                    location.reload();
                }
                else {
                    var html = '<div style="font-weight:bold;border-bottom:1px solid #73a6d5;padding-bottom:5px">';
                    html += '<label style="padding-right:120px">处理时间</label><label>处理信息</label>';
                    html += '<a onclick="closeinfo(' + id + ')" style="float:right;padding-right:2px;*margin-top:-30px">×</a></div>';
                    html += '<p><span class="od_time">' + data.CreateTime + '</span><span>您已下单' + data.text + '</span>';
                    if (data.Payment == 1 && data.PayTime)
                        html += '<p><span class="od_time">' + data.PayTime + '</span><span>您已付款，等待卖家确认</span>';
                    if (data.ConfirmTime)
                        html += '<p><span class="od_time">' + data.ConfirmTime + '</span><span>卖家已确认，等待卖家发货</span>';
                    if (data.DeliveryTime) {
                        html += '<p><span class="od_time">' + data.DeliveryTime + '</span><span>卖家已发货</span>\n\
                        <span style="padding-left:12px">物流公司为：' + data.ShipLogis + '</span>';
                        if (data.ShipSn)
                            html += '<p><span style="padding-left:172px">运单号码为：' + data.ShipSn + '</span>';
                    }
                    if (data.ReceiptTime)
                        html += '<p><span class="od_time">' + data.ReceiptTime + '</span><span>您已收货</span>';
                    if (data.Status == 10)
                        html += '<p><span class="od_time">' + data.UpdateTime + '</span><span>您取消了该订单</span>';
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
    //未收货拒收
    $('.refuse').click(function() {
        var orderid = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/buyreturn/returngoods/ID/' + orderid + '/type/order';
        window.open(url, '_blank');
    });
    //拒收未通过 重新申请
    $('.agin').click(function() {
        var orderid = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/buyreturn/agaginret/ID/' + orderid + '/type/order';
        window.open(url, '_blank');
    });

    //交易完成 退货
    $('.returngoods').click(function() {
        var orderid = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/buyreturn/returngoods/ID/' + orderid + '/type/order';
        window.open(url, '_blank');
    });
    //交易完成 退货未通过 重新申请
    $('.againreturn').click(function() {
        var orderid = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/buyreturn/agaginret/ID/' + orderid + '/type/order';
        window.open(url, '_blank');
    });
</script>