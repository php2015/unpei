

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; width:100px; text-indent:0}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    .txxx2{ border-bottom:2px solid #c5d2e2}
    .tb_head li{ float:left; color:#fff ; text-align:center}
    .tb_head .sp_info{ width:415px}
    .tb_head .price{ width:100px}
    .tb_head .shuliang{ width:100px}
    .tb_head .s_fukuan{ width:160px}
    .tb_head .caozuo{ width:134px}
    .sp_plcl a{ padding:0px 5px}
    .sp_plcl{ border:1px solid #ccc; display:inline-block; height:20px; line-height:20px;}
    .mbx4{ background:#eff4fa;}
    .mbx4 span{  color:#666}
    span.zwq_color{ color:#fb540e}
    .splb_order{ width:615px}
    .splb_order li{ height:100px; border-bottom:1px solid #e8e8e8; border-right:1px solid #e8e8e8}
    div.div_info{ text-align:left;width:300px}
    .div_img{width:90px}
    .splb_order .price,.splb_order .shuliang,.splb_order .s_fukuan{ line-height:100px}
    .splb_order .price{ font-weight:400}
    li.last{ border-bottom:none}
    .zkss{display:inline-block; width:100px; height:26px; cursor:pointer}
    .zkss2{display:inline-block; width:100px; height:26px; cursor:pointer}
    .zkss{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px -26px;}
    .zkss2{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px 0px;;}
    .color_blue {color: blue;}
    .goods_show1{border-right:1px solid #e8e8e8; }   
    .goods_show .float_l{
        height: 100%;
    }
    .m_top20{ margin-top:20px}
    .order_bg .state .order_step{ width:160px}
</style>
<style>
    .list_input{
        border:1px solid #ccc;margin:0 4px;text-align:center;padding:0 3px;
        height: 16px;
        line-height: 20px;
        float: left;
    }
</style>
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '退款管理' => Yii::app()->createUrl('pap/buyreturn/addreturn2'),
    '退款申请',
);
?>  
<?php if ($Status == 9): ?>
    <ul class="order_bg">
        <li class="" style="width:200px">
            <span class="order_step state" >选择经销商</span>
        </li>
        <li class="<?php echo 'state' ?>" style="width:200px">
            <span class="order_step state" >申请退款</span>
        </li>
        <li class="" style="width:200px">
            <span class="order_step state">审核退款</span>
        </li>
        <li class="step_last" style="width:200px;">
            <span class="order_step state ">退款完成</span>
        </li>
    </ul> 
<?php elseif ($Status == 3): ?>
    <ul class="order_bg">
        <li class="" style="width:170px;margin-left: 200px">
            <span class="order_step state" >申请退货</span>
        </li>
        <li class="" style="width:170px;">
            <span class="order_step state">审核退货</span>
        </li>
        <li class="step_last" style="width:170px;">
            <span class="order_step state ">退货完成</span>
        </li>
    </ul> 
<?php endif; ?>

<div class="bor_back m-top">              
    <div  class="ddxx">
        <p>订单信息</p>
    </div>
    <div style="float:right; margin-top: -25px;padding-right: 30px;">
        <a href="javascript:void(0)" onclick="goDealerlist()">返回上一步</a>
    </div>
    <p class="m-top">
    <form method="get" action="<?php //echo Yii::app()->createUrl('pap/buyreturn/addreturn')               ?>"> 
        <p>
            <br />
            <label class=" m_left24" style="height:18px;">订单状态：</label>
<!--            <select class="select select2 width120" name="Status">
                <option value ="3" <?php //echo $Status == 3 ? 'selected' : ''               ?>>待收货</option>
                <option value ="9" <?php //echo $Status == 9 ? 'selected' : ''               ?>>已收货</option>
            </select>-->
            <span>已收货订单</span>
            <label  class=" m_left24" style="height:18px; ">经销商名称：</label>
            <?php echo $model['OrganName']; ?>
<!--            <select class="select select2" name="SellerName" style="width:180px;*width:180px;">
            <?php // foreach ($model as $v): ?>
                    <option value ="<?php //echo $v['SellerName']                ?>"<?php //echo $SellerName == $v['SellerName'] ? 'selected' : ''                ?>><?php //echo $v['SellerName']                ?></option>
            <?php // endforeach; ?>
            </select>-->

        </p>
        <br />
        <p>
            <label  class=" m_left24" style="height:18px;">是否退货：</label>
            <span  style="height:18px;color:red">*</span>
            <label><input type="radio" name="tuihuoRadio" value="radio1" dealerID="<?php echo $deid ?>" id="tuihuo">&nbsp;退货</label>
            <label style="margin-left: 10px"><input type="radio" name="tuihuoRadio" checked="checked" value="radio2" dealerID="<?php echo $deid ?>">&nbsp;无需退货</label>
        </p>
        <br />
        <p>
            <label  class=" m_left24" style="height:20px; display: inline-block;width:65px;"><span style="padding-left: 10px;">关键字：</span></label><input type="text" class=" input input3" style="width:300px"value="<?php echo $Title ? $Title : '商品名称|商品编号|OE号|品牌|拼音代码'; ?>"  name="Title">
            <input type="submit" class="submit m_left f_weight"  value="搜索">
            <a href="#"  id="dakai">查看筛选条件</a>
        </p>
        <div id="content222"class="zkss_info m-top"  style="<?php if ($Title || $OrderSN || $Vehicle || $_GET['start_time'] || $_GET['end_time']) echo 'display:block' ?>">
            <p>
                <label  class="m_left24" style="height:20px; display: inline-block;">订单编号：</label>&nbsp;<input type="text" class=" input input3  width200 " value="<?php echo $OrderSN ? $OrderSN : '订单编号'; ?>"  name="OrderSN">
                <label  class=" m_left24" style="height: 17px;display: inline-block">下单时间：</label> 
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language' => 'zh_cn',
                    'name' => 'start_time',
                    'value' => $_GET['start_time'] ? $_GET['start_time'] : '',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'class' => 'input width80',
                    ),
                ));
                ?>  
                <label style="height: 20px;display: inline-block">
                    到 
                </label>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language' => 'zh_cn',
                    'name' => 'end_time',
                    'value' => $_GET['end_time'] ? $_GET['end_time'] : '',
                    'options' => array(
                        // 'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'class' => 'input input3 width80',
                    ),
                ));
                ?> 
            </p>
            <br />
            <p>
                <label  class="m_left24 " style="height:20px; display: inline-block;">适用车系：</label>
                <input id="make-select" name="Vehicle" type="text" value="<?php echo $Vehicle; ?>" class=" input input3 " style="width:300px">

            </p>
        </div>  
        <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
        <?php $this->widget('widgets.default.WGoodsCategoryModel'); ?>
    </form>
    <br />
    <div id="return_div" style="">
        <!--&nbsp;&nbsp;&nbsp;&nbsp;<button class="button button2" style="width:65px" onclick="apply_return()">批量退款</button>-->
    </div>
</p>
<div class="mbx mbx3 m-top" style="margin-bottom:5px;">
    <ul class="tb_head">
        <li class="sp_info">商品信息</li>
        <li class="price">单价（元）</li>
        <li class="shuliang">数量</li>
        <li class="caozuo">实付款（元）</li>
        <li class="caozuo">操作</li>
    </ul>
</div>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="Order">
</form>

<?php
$this->widget('widgets.default.WListView', array(
    'dataProvider' => $data,
    'itemView' => 'addreturnlist2',
    'id' => 'orderlistview',
    'emptyText' => '<div style="height:200px;margin:0 auto;" class="nogoods_text">
                                            <div style=" padding-top: 65px;margin:0 auto; width: 50%">
                                            <div><img style="float: left;display: block" src="' . Yii::app()->theme->baseUrl . '/images/images/nogoods.jpg"><b><span style=" color:#FF6500;float:left;display: block; font-size: 18px;margin:8px 0 0 15px">非常抱歉,没有找到相关订单信息!</span></b><div style="clear:both"></div></div>
                                             
                                            </div>
                                        </div>'
));
?>
<p class="mbx mbx3 m-top"></p>
</div>
<script>
    $(function() {
        //商品详情
        $('.order_goods').bind('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=Order]').val($(this).attr('order'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        })
        $("#dakai").click(function() {
            $(this).text($("#content222").is(":hidden") ? "收起搜索条件" : "展开搜索条件");
            $("#content222").slideToggle();
        });

        $("#tuihuo").live('click', function() {
            var dealerID = $(this).attr('dealerID');
            var url = Yii_baseUrl + '/pap/buyreturn/addreturn/id/' + dealerID;
            window.location.href = url;
        })

    });
    $("input[name='return_check[]']").live('click', function() {
        var id = $(this).attr('order');
        if ($(this).attr('checked')) {
            var len = $("input[name='return_check[]']:checked").length;
            if (len > 5) {
                alert('Max five!');
                return false;
            }
            else {
                var flag = true;
                $("input[name='orderid[]']").each(function() {
                    if ($(this).val() == id) {
                        flag = false;
                    }
                })
                if (flag) {
                    $('#return_div').append("<input type='hidden' value='" + id + "' name='orderid[]' id='" + id + "'>");
                }
            }
        }
        else {
            $('#' + id).remove();
        }
    })



    //批量申请退货
    function apply_return() {

        var len = $("input[name='return_check[]']:checked").length;
        if (len < 1) {
            alert('还没选择订单');
            return false;
        }
        else if (len > 5) {
            alert('最多5');
            return false;
        } else {
            var str = '';
            $("input[name='orderid[]']").each(function() {
                str += $(this).val() + '_';
            })
            str = str.substring(0, str.length - 1);
            //alert(Yii_baseUrl+'/pap/buyreturn/returngoods/ID/'+str);
            window.open(Yii_baseUrl + '/pap/buyreturn/returngoods2/ID/' + str);
        }
    }

    function goDealerlist() {
        var url = Yii_baseUrl + '/pap/buyreturn/addsecond2';
        window.location.href = url;
    }

    $('input[name=Title]').click(function() {
        if ($(this).val() == '商品名称|商品编号|OE号|品牌|拼音代码') {
            $(this).val('');
        }
    })
    $('input[name=OrderSN]').click(function() {
        if ($(this).val() == '订单编号') {
            $(this).val('');
        }
    })
    $('input[name=Title]').blur(function() {
        if ($(this).val() == '') {
            $(this).val('商品名称|商品编号|OE号|品牌|拼音代码');
        }
    })
    $('input[name=OrderSN]').blur(function() {
        if ($(this).val() == '') {
            $(this).val('订单编号');
        }
    })
</script>