<style>
    .zwq_color{color:#FB540E}
    .title_lm li{ cursor:pointer;float:left; font-size:14px; color:#0164c1; text-align:center; text-indent:17px}

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
    .splb_order{ width:560px}
    .splb_order li{ height:100px; border-bottom:1px solid #ebebeb; border-right:1px solid #ebebeb}
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
    .goods_show2  , .goods_show1{border-right:1px solid #e8e8e8; }   
    .goods_show .float_l{
        height: 100%;
    }
    .m_top20{margin-top:20px}
    a{ cursor:pointer}
</style>

<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '退货/退款管理' => Yii::app()->createUrl('pap/buyreturn'),
    '处理中的申请'
);
?>   
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li class="<?php
            $Status = Yii::app()->request->getParam('Status');
            if ($Status == 0 || !$Status) {
                echo "current";
            }
            ?>" key="0">所有订单 <span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 1) {
                echo "current";
            }
            ?>" key="1">待审核 <span class="zwq_color"><?php echo $status[0] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 2) {
                echo "current";
            }
            ?>" key="2">待发货 <span class="zwq_color"><?php echo $status[1] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 3) {
                echo "current";
            }
            ?>" key="3">待收货 <span class="zwq_color"><?php echo $status[2] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 4) {
                echo "current";
            }
            ?>" key="4">退货完成 <span class="zwq_color"><?php echo $status[3] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 5) {
                echo "current";
            }
            ?>" key="5">未通过 <span class="zwq_color"><?php echo $status[4] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 6) {
                echo "current";
            }
            ?>" key="6">已取消 <span class="zwq_color"><?php echo $status[5] + $complainstatus[0] ?></span><span class="interval">  |</span></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a">
            <form method="get" id="order_form">
            </form>
            <input type="text" class=" input input3 width375 float_l" value="<?php echo $_GET['ReturnNO'] ? $_GET['ReturnNO'] : '请输入退货单号'; ?>" style="margin-left:0px" name="ReturnNO">
            <input type="submit" class="submit f_weight float_l m_left" id="search_id" value="搜 索">
            <span class="zkss"> </span>
            <div style="clear:both"></div>
            <?php
            $get = $_GET;
            unset($get['ReturnNO']);
            unset($get['Status']);
            unset($get['PapReturnOrder_page']);
            ?>
            <div class="zkss_info m-top" style="<?php if (!$get) echo 'display:none' ?>">
                <p>
                    <label  class=" " style="height: 20px;display: inline-block">卖家名称：</label>
                    <input type="text" class=" input input3 width100" name="DealerName" value="<?php echo $_GET['DealerName'] ?>">
                    <label  class=" m_left24" style="height: 20px;display: inline-block">退货时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'start_time',
                        'value' => $_GET['start_time'] ? $_GET['start_time'] : '',
                        'options' => array(
                            //  'showAnim' => 'fold',
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'class' => 'input width80',
                            'maxlength' => 8,
                        ),
                    ));
                    ?> 
                    <label style="height: 20px;display: inline-block">
                        至
                    </label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'end_time',
                        'value' => $_GET['end_time'] ? $_GET['end_time'] : '',
                        'options' => array(
                            //    'showAnim' => 'fold',
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'class' => 'input input3 width80',
                            'maxlength' => 8,
                        ),
                    ));
                    ?>  
                    <label class=" m_left24" style="height: 20px;display: inline-block">订单类型：</label>
                    <label style="display: inline-block;margin-top: -25px">
                        <select class="select select2 width100 " name="Type" >
                            <option value ="">订单类型</option>
                            <option value ="1" <?php echo $_GET['Type'] == 1 ? 'selected' : '' ?>>买家未收货</option>
                            <option value ="2" <?php echo $_GET['Type'] == 2 ? 'selected' : '' ?>>买家已收货</option>
                        </select>
                    </label>
                    <input type="hidden" name="Status" value="<?php echo $Status; ?>">
                </p>
<!--                <p class="m-top">
                                        <label  class=" m_left24">交易状态：</label>
                                        <select class="select select2" name="Status" status="<?php $get['Status'] ?>">
                                            <option value ="0">交易状态</option>
                                            <option value ="1">退货待审核</option>
                                            <option value ="2">退货待发货</option>
                                            <option value ="3">退货待收货</option>
                                            <option value ="4">退货已完成</option>
                                            <option value ="5">审核未通过</option>
                                            <option value ="6">退货已取消</option>
                                        </select>
                </p>-->
            </div>
        </div>
    </div>
    <input type="submit"  class="submit m_left f_weight" id="addreturn" value="申请">
    <div class="mbx mbx3 m-top">
        <ul class="tb_head">
            <li class="sp_info">商品信息</li>
            <li class="price">单价（元）</li>
            <li class="shuliang">数量</li>
            <li class="caozuo" style="width:105px">退款金额（元）</li>
            <li class="caozuo">交易状态</li>
            <li class="caozuo">交易操作</li>
        </ul>
    </div>
    <form action="" method="POST" id="goodsform" target="_blank">
        <input type="hidden" name="Version">
        <input type="hidden" name="Order">
    </form>

    <!--<p style="line-height:30px"><input type="checkbox" class="checkbox m_left12"> 全选<span class="sp_plcl m_left"><a href="">批量评价</a></span></p>-->
    <?php
    $this->widget('widgets.default.WListView', array(
        'dataProvider' => $data,
        'itemView' => 'orderlist',
        'id' => 'orderlistview',
        'emptyText' => '<div style="height:200px;margin:0 auto;" class="nogoods_text">
                                            <div style=" padding-top: 65px;margin:0 auto; width: 50%">
                                            <img style="float: left;display: block" src="' . Yii::app()->theme->baseUrl . '/images/images/nogoods.jpg"><b><span style=" color:#FF6500;float:left;display: block; font-size: 18px;margin:8px 0 0 15px">非常抱歉,没有找到相关信息!</span></b>
                                            </div>
                                        </div>'
    ));
    ?>
    <p class="mbx mbx3 m-top"></p>
</div>
<!--content2结束-->

<!--content1即又半部分结束-->
<script>
    //商品详情
    $('.order_goods').bind('click', function() {
        var url = this.href;
        $('input[name=Version]').val($(this).attr('version'));
        $('input[name=Order]').val($(this).attr('order'));
        $('#goodsform').attr('action', url);
        $('#goodsform').submit();
        return false;
    })
    //取消退货
    $('#noreturn').live('click', function() {
        var bool = window.confirm('你确定要取消退货吗？');
        if (bool == false)
        {
            return false;
        }
        var ID = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/buyreturn/noreturn';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': ID},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.success == 1) {
                    location.reload();
                }
                else
                {
                    alert(data.errorMsg);
                    return false;
                }
            }
        })
    });

    function nocomplain(ID) {
        var bool = window.confirm('你确定要取消申诉吗？');
        if (bool == false)
        {
            return false;
        }
        $.post(
                Yii_baseUrl + "/pap/buyreturn/nocomplain",
                {ID: ID},
        function(result) {
            if (result.success) {
                alert("取消成功！");
                location.reload();
            }
        },
                'json');
    }

    //取消退款
    $('#noreturnprice').live('click', function() {
        var bool = window.confirm('你确定要取消退款吗？');
        if (bool == false)
        {
            return false;
        }
        var ID = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/buyreturn/noreturnprice';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': ID},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.success == 1) {
                    location.reload();
                }
                else
                {
                    alert(data.errorMsg);
                    return false;
                }
            }
        })
    });


    $('#addreturn').live('click', function() {
        window.location.href = Yii_baseUrl + "/pap/buyreturn/addsecond";
    })

    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
        $(".zkss").click(function() {
            $('#gbss_btn').toggle();
            $(".zkss_info").slideToggle("slow");
            $(this).toggleClass("zkss2");
        })

        $(".title_lm li").live("click", function() {
            var key = $(this).attr("key");
            var url = Yii_baseUrl + "/pap/buyreturn/index";
            url += "/Status/" + key;
            $("#order_form").attr("action", url);
            $('#order_form').submit();
        })

        $('input[name=ReturnNO]').click(function() {
            if ($(this).val() == '请输入退货单号') {
                $(this).val('');
            }
        })
        $('input[name=ReturnNO]').blur(function() {
            if ($(this).val() == '') {
                $(this).val('请输入退货单号');
            }
        })
        $('#search_id').click(function() {
            var ReturnNO = $('input[name=ReturnNO]').val();
            if (ReturnNO != '' && ReturnNO.length >= 1) {
                var url = Yii_baseUrl + "/pap/buyreturn/index";
                if (ReturnNO && ReturnNO != '请输入退货单号') {
                    ReturnNO = ReturnNO.replace(/\//g, "<<q>>");
                    ReturnNO = encodeURIComponent(ReturnNO);
                    url += "/ReturnNO/" + ReturnNO;
                }
                var ServiceName = $('input[name=DealerName]').val();
                if (ServiceName) {
                    ServiceName = ServiceName.replace(/\//g, "<<q>>");
                    ServiceName = encodeURIComponent(ServiceName);
                    url += "/DealerName/" + ServiceName;
                }
                var start_time = $('input[name=start_time]').val();
                if (start_time) {
                    url += "/start_time/" + start_time;
                }
                var end_time = $('input[name=end_time]').val();
                if (end_time) {
                    url += "/end_time/" + end_time;
                }
                var Type = $('select[name=Type]').val();
                if (Type) {
                    url += "/Type/" + Type;
                }
                var Status = $('input[name=Status]').val();
                if (Status) {
                    url += "/Status/" + Status;
                }
                $("#order_form").attr("action", url);
                $('#order_form').submit();
            } else {
                alert('请输入退货单号');
            }
        })
    })
</script>