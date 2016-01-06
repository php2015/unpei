<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; text-indent:17px}
    .title_lm li a{ font-size:14px; color:#0164c1}
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
    .splb_order li{ height:105px; border-bottom:1px solid #ebebeb; border-right:1px solid #ebebeb}
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
    .interval{
        display: inline-block;

    }
    .goods_show2, .goods_show1{ border-right:1px solid #ebebeb; height:100%}
    .m-top20{ margin-top:20px}
    .border{border:1px solid #ebebeb; margin-top:10px}
    .border:hover{ border:1px solid #bbb}
    .p_top7{padding-top: 7px}
</style>
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '退货管理',
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
            ?>" key="0"><a href="<?php echo Yii::app()->createUrl('pap/dealerreturn/index', array('Status' => 0)) ?>">所有订单 </a><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 1) {
                echo "current";
            }
            ?>" key="1"><a href="<?php echo Yii::app()->createUrl('pap/dealerreturn/index', array('Status' => 1)) ?>">待审核 </a><span class="zwq_color"><?php echo $status[0] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 2) {
                echo "current";
            }
            ?>" key="2"><a href="<?php echo Yii::app()->createUrl('pap/dealerreturn/index', array('Status' => 2)) ?>">待发货 </a><span class="zwq_color"><?php echo $status[1] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 3) {
                echo "current";
            }
            ?>" key="3"><a href="<?php echo Yii::app()->createUrl('pap/dealerreturn/index', array('Status' => 3)) ?>">待收货 </a><span class="zwq_color"><?php echo $status[2] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 4) {
                echo "current";
            }
            ?>" key="4"><a href="<?php echo Yii::app()->createUrl('pap/dealerreturn/index', array('Status' => 4)) ?>">退货完成 </a><span class="zwq_color"><?php echo $status[3] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 5) {
                echo "current";
            }
            ?>" key="5"><a href="<?php echo Yii::app()->createUrl('pap/dealerreturn/index', array('Status' => 5)) ?>">未通过 </a><span class="zwq_color"><?php echo $status[4] ?></span><span class="interval">  |</span></li>
            <li class="<?php
            if ($Status == 6) {
                echo "current";
            }
            ?>" key="6"><a href="<?php echo Yii::app()->createUrl('pap/dealerreturn/index', array('Status' => 6)) ?>">已取消 </a><span class="zwq_color"><?php echo $status[5] + $complainstatus[0] ?></span><span class="interval">  |</span></li>
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
            <div class="zkss_info m-top" style="<?php if ($get) echo 'display:block' ?>">
                <p>
                    <!--                    <label>退货单编号：</label>
                                        <input type="text" class=" input input3 width100" name="ReturnNO" value="<?php echo $_get['ReturnNO'] ?>">-->
                    <label  class=" m_left24">买家名称：</label>
                    <input type="text" class=" input input3 width100" name="ServiceName" value="<?php echo $_GET['ServiceName'] ?>">
                    <label  class=" m_left24">成交时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'StartTime',
                        'value' => $_GET['StartTime'] ? $_GET['StartTime'] : '',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', //database save format  
                            'yearRange' => ''
                        ),
                        'htmlOptions' => array(
                            'style' => 'width:120px;',
                            'class' => 'input',
                        )
                    ));
                    ?> 到                     <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'EndTime',
                        'value' => $_GET['EndTime'] ? $_GET['EndTime'] : '',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd', //database save format  
                            'yearRange' => ''
                        ),
                        'htmlOptions' => array(
                            'style' => 'width:120px;',
                            'class' => 'input',
                        )
                    ));
                    ?>
                    <label class=" m_left24">订单类型：</label>
                    <select class="select select2 width100" name="Type">
                        <option value ="">订单类型</option>
                        <option value ="1" <?php if ($_GET['Type'] == 1) echo 'selected=seleceted' ?> >买家未收货</option>
                        <option value ="2" <?php if ($_GET['Type'] == 2) echo 'selected=seleceted' ?> >买家已收货</option>
                    </select>
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

    <!--<p style="line-height:30px"><input type="checkbox" class="checkbox m_left12"> 全选<span class="sp_plcl m_left"><a href="">批量评价</a></span></p>-->
    <?php
    $this->widget('widgets.default.WListView', array(
        'dataProvider' => $data,
        //'headerView' => 'goodshead',
        'itemView' => 'indexlist',
        'id' => 'orderlistview'
    ));

    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'orderinfo', //弹窗ID  
        'options' => array(//传递给JUI插件的参数  
            'title' => '修改促销价格',
            'autoOpen' => false, //是否自动打开 
            'modal' => true, // 层级
            'width' => '300', //宽度  
            'height' => '250', //高度  
            'resizable' => false,
            'buttons' => array(
                '关闭' => 'js:function(){ $(this).dialog("close");}',
            ),
        ),
    ));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>
<!--content2结束-->

<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<script>
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
        //        $(".title_lm li").live("click",function(){
        //            var key = $(this).attr("key");
        //            var url = Yii_baseUrl+"/pap/dealerreturn/index";
        //            url +="/Status/"+key;
        //            $("#order_form").attr("action",url);
        //            $('#order_form').submit();
        //        })


        $(".zkss").click(function() {
            $('#gbss_btn').toggle();
            $(".zkss_info").slideToggle("slow");
            $(this).toggleClass("zkss2");
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
                var url = Yii_baseUrl + "/pap/dealerreturn/index";
                if (ReturnNO && ReturnNO != '请输入退货单号') {
                    ReturnNO = ReturnNO.replace(/\//g, "<<q>>");
                    ReturnNO = encodeURIComponent(ReturnNO);
                    url += "/ReturnNO/" + ReturnNO;
                }
                var ServiceName = $('input[name=ServiceName]').val();
                if (ServiceName) {
                    ServiceName = ServiceName.replace(/\//g, "<<q>>");
                    ServiceName = encodeURIComponent(ServiceName);
                    url += "/ServiceName/" + ServiceName;
                }
                var StartTime = $('input[name=StartTime]').val();
                if (StartTime) {
                    url += "/StartTime/" + StartTime;
                }
                var EndTime = $('input[name=EndTime]').val();
                if (EndTime) {
                    url += "/EndTime/" + EndTime;
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
    /*订单也选项卡*/
    $(document).ready(function() {
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");

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
    })

</script>