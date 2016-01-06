<?php
$this->pageTitle = Yii::app()->name . ' - 采购单管理';
$this->breadcrumbs = array(
    '预约管理' => Yii::app()->createUrl("/servicer/reserve/index"),
    '采购单管理',
);
?>
<link href="<?php echo F::themeUrl(); ?>/css/jpdata.css" type="text/css" rel="stylesheet">
<style>
    .title_lm li a{color: #0164C1;
                   float: left;
                   font-size: 14px;
                   text-align: center;}
    .splb_order{ width:573px}
    .goods_show{width:300px;}
    .div_goodsinfo {text-align: left;width: 295px;}

    .goods_show0, .goods_show1, .goods_show2, .goods_show3{text-align:center;width:88px;vertical-align:middle}
    .goods_show0{width:80px}
    .goods_show1{ width:95px}
    .goods_show3{ width:95px}
    .goods_attr{height: 17px;line-height: 17px;overflow: hidden;width: 358px;}
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
    .width150{ width: 150px}
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
<div id="reserve" class="bor_back m_top10">
    <p class="txxx txxx3">
        采购单管理
    </p>
    <div class="txxx_info4">
        <form action="<?php echo Yii::app()->createUrl('servicer/purchase/index'); ?>" method="get"  target="_self">    
            <div>
                <p class="m_left24 m-top5">
                    <label class="label1 m_left12">车牌号：</label>
                    <input class="width88 input" name="LicensePlate" value="<?php echo $LicensePlate; ?>" maxlength="10">
                    <label class="label1 m_left24">生成时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'value' => $CreateTime,
                        'name' => 'CreateTime',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'class' => 'input width88',
                        ),
                    ));
                    ?>
                </p>
                <p class="m_left24 m-top5">
                    <label class="label1 m_left12">预约号：</label>
                    <input class="width88 input" name="ReserveNum" value="<?php echo $ReserveNum; ?>" maxlength="10">
                    <label class="label1 m_left12">采购单状态：</label>
                    <select class="select" name="InOrder">
                        <option value="1" selected>查询所有采购单</option>
                        <option value="2" <?php if ($InOrder == 2) echo 'selected'; ?>>未生成订单</option>
                        <option value="3" <?php if ($InOrder == 3) echo 'selected'; ?>>已生成订单</option>
                    </select>
                </p>
                <p class="m_top10">
                    <input class='submit m_left' type='submit' id="reserve-purchase-search" style="margin-left:200px;" value='搜索'>
                </p>
            </div>
        </form>
    </div>
    <div class="mbx mbx3 m-top">
        <ul class="tb_head">
            <li class="sp_info" style="width:305px">商品信息</li>
            <li class="shuliang">&nbsp;</li>
            <li class="price" style="width:155px">单价（元）</li>
            <li class="shuliang">数量</li>
            <!--            <li class="caozuo">商品操作</li>-->
            <li class="caozuo" style="width:95px;margin-left: 20px;">预计付款（元）</li>
            <li class="shuliang">&nbsp;</li>
            <li class="caozuo">交易操作</li>
        </ul>
    </div>
    <?php if (!empty(array_filter($dataProvider->getData()))): ?>
        <p style="line-height:25px" class="m-top5">
            <input type="checkbox" class="checkbox m_left12 " id="checkall"> 全选
            <input id="btn_scdd" type="button" class="submit" style="margin:0px 0px 5px 660px;" style="width:250px" value="批量处理">
        </p>
    <?php endif ?>
    <?php
    $this->widget("widgets.default.WListView", array(
        'dataProvider' => $dataProvider,
        'id' => 'list',
        'itemView' => 'list', // refers to the partial view named '_post'
        'summaryText' => '',
        'ajaxUpdate' => true,
        'emptyText' => '无采购单信息',
    ));
    ?>
</div>
<form id="purchase_list_form" action="<?php echo Yii::app()->CreateUrl('/pap/buyorder/delivery',array("purchase"=>1)); ?>" method="post" target="_blank" >
    <input name="purchasekey" type="hidden">
</form>
<script type="text/javascript">
    $(function() {
        $('.purchase_order_add').live('click', function() {
            $('input[name=purchasekey]').val($(this).attr('key'));
            checkmin();
        });
        $('.purchase_order_select').live('click', function() {
            window.open(Yii_baseUrl + '/pap/orderreview/index');
        });
        $("#checkall").click(function() {
            $("input[name=subBox]").attr("checked", this.checked);
        });
        var $subBox = $("input[name=subBox]");
        $subBox.click(function() {
            $("#checkall").attr("checked", $subBox.length == $("input[name=subBox]:checked").length ? true : false);
        });
        $('#btn_scdd').live('click', function() {
            if ($("input[name=subBox]:checked").length == 0) {
                alert("请选择未生成订单的采购单！");
                return false;
            }

            var key = '';
            $("input[name=subBox]:checked").each(function() {
                key += $(this).parent().parent().find('.purchase_order_add').attr('key') + ",";
            });
            $('input[name=purchasekey]').val(key);
            checkmin();
        });
        
    });
    
        //判断是否小于最小交易金额
        function checkmin(){
            var min = 1;
            $.ajaxSetup({
                async:false //设置post同步处理
            });
            $.post(
                Yii_baseUrl + "/servicer/purchase/checkmin",
                {key:$('input[name=purchasekey]').val()},
                function(result){  
                    if(result.result){
                        $('input[name=purchasekey]').val(result.ID);
                        min = 0;
                        var html='';
                        html+="<div><span style='padding-left:20px'>"+result.OrganName+",单笔订单最小交易金额为￥"+result.min+"元</span>\n\
                         \n\<br/><br/><span style='color:red;font-size:11px'>&nbsp;&nbsp;&nbsp;&nbsp;对不起,您购买的"+result.OrganName+"商品须超过最小交易金额，才能生成订单！建议您批量处理采购单，或者立即购买其他商品！</span></div>";
                        $('#minorder').html(html);
                        $('#mymodal').dialog('open');
                    }
                },
                'json'
            );
            if(min === 1){
                if($('input[name=purchasekey]').val()===""){
                    return false;
                }
                $('#purchase_list_form').submit();
            }
        };
</script>
<?php
//最小交易额弹框
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mymodal',
    'options' => array(
        'title' => '提示信息',
        'width' => 400,
        'height' => 200,
        'autoOpen' => false,
        'resizable' => false,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
        'buttons' => array(
            '批量处理' => 'js:function(){ $(this).dialog("close");}',
            '立即购买' => 'js:function(){ checkmin();$(this).dialog("close");}',
        ),
    ),
));
echo '<div id="minorder">最小交易额</div> ';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>     