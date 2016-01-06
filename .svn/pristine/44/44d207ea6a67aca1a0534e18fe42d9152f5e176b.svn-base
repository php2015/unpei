<style>
    .txxx_info2a{margin:15px 5px}
    .tabs a.selected {
        background: url("<?php echo F::themeUrl() ?>/images/tbg1.png") repeat-x;
        color: #2379c6;
        font-weight: bold;
        line-height: 32px;
    }
    .tabs2 {background: none repeat scroll 0 0 #f3f3f3;border-bottom: 1px solid #e2e2e2;margin-bottom:1px}
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; text-indent:17px}
    .title_lm li a{font-size:14px; color:#0164c1;}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    .txxx2{ border-bottom:2px solid #c5d2e2}
    span.zwq_color{ color:#fb540e}
    .input{width:131px}
    #count{float:right;margin:10px 5px;font-size:14px}
    .goods_eval1,.goods_eval2{text-align:left;padding-left:20px;height:auto;word-break:break-all}
    .goods_eval1{width:300px;;float:left}
    .goods_eval2{text-indent:10px;width:300px;float:left}
    .goods_eval3{text-align:left;padding-left:30px;height:auto;width:200px;overflow:hidden;}
    .goods_eval3 a{color:#6e6edf}
    th,td{vertical-align: middle;}
    .goods_time{color:#acacac}
    .goods_num{padding-right:20px;;overflow:hidden;display:block;float:left}
    .goods_num a{color:#888;}
    /* .goods_name_input{color:#ccc}*/
    .eval_organ{max-width:200px;margin:0 auto;text-align:center;word-break:break-all}
    .eval_organ a{color:#6e6edf}
    .color_ccc{color:#ccc}
    .select,.input{margin-left:0px}
    .width84{
        width:84px;
    }
</style>
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/buylist'),
    '平台对账单',
);
?>
<div class="bor_back m-top">
    <div class="order m-top">
        <div class="txxx_info2a m-top">
            <form method="get">
                <p class="m-top">
                    <label  class="">查询时间：</label>
                    <?php
//                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                        'name' => 'endtime',
//                        'attribute' => 'start_time',
//                        'language' => 'zh_cn',
//                        'value' => $time ? $time : '',
//                        'options' => array(
//                            'dateFormat' => 'yy-mm',
//                            'changeYear' => true,
//                            'yearRange' => '-30:+0'
//                        ),
//                        'htmlOptions' => array(
//                            'class' => 'input',
//                            'style' => 'width:50px',
//                        ),
//                    ));
                    ?>
                    <span>
                        <span id="year">
                            <input type="text" class=" input input3" style="width: 35px;"  name="year" value="<?php echo $year ?>">
                            <label>年</label>
                        </span>
                        <span id="mouth">
                            <input type="text" class=" input input3" style="width: 25px;" name="mouth" value="<?php echo $month ?>">
                            <label>月</label>
                        </span>
                    </span>
                    <label class="label1">支付方式：</label>
                    <select name="Payment" class="select width84">
                        <option value="">全部</option>
                        <option value ="1" <?php echo $payment == 1 ? 'selected' : ''; ?>>支付宝担保</option>
                        <option value ="2" <?php echo $payment == 2 ? 'selected' : ''; ?>>物流代收款</option>
                    </select>
                    <label class="label1">类型：</label>
                    <select name="Type" class="select width84">
                        <option value="">全部</option>
                        <option value ="1" <?php echo $type == 1 ? 'selected' : ''; ?>>订单列表</option>
                        <option value ="2" <?php echo $type == 2 ? 'selected' : ''; ?>>退货单列表</option>
                    </select>
                    <input type="button" class="submit f_weight m_left12" value="查 询" id="form_btn">
                    <input type="button" class="submit f_weight m_left12" value="打 印" id="print_account">
                    <input type="button" class="submit f_weight m_left12" value="生成PDF" id="create_account">
                    <input type="button" class="submit f_weight m_left" value="发送邮件" id="send_account">
                </p>
            </form>
        </div>
    </div>
</div>
<div class="bor_back  m-top">
    <div style="line-height:25px;height:25px;">
        <span style="margin-left:120px">订单收入：<?php echo $model['amount']['income'] ?>元</span>
        <span style="margin-left:120px">退货支出：<?php echo $model['amount']['pay'] ?>元</span>
        <span style="margin-left:150px">合计：<?php echo $model['amount']['total'] ?>元</span>
    </div>
    <div id="tab-order">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $model['data'],
           // 'ajaxUpdate' => true,
            'columns' => array(
//            array(// display 'create_time' using an expression
//                'name' => '序号',
//                'type' => 'raw',
//                'value' => '$data[rowNO]',
//            ),
                array(// display 'author.username' using an expression
                    'name' => '下单时间',
                    'type' => 'raw',
                    'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
                ),
                array(// display 'author.username' using an expression
                    'name' => '交易类型',
                    'type' => 'raw',
                    'value' => '$data[Payment]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '名称',
                    'type' => 'raw',
                    'value' => '$data[Name]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '修理厂名称',
                    'type' => 'raw',
                    'value' => '$data[BuyerName]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '订单/退货单编号',
                    'type' => 'raw',
                    'value' => '$data[No]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '收入/支出',
                    'type' => 'raw',
                    'value' => '$data[Price]',
                ),
                array(// display 'author.username' using an expression
                    'class' => 'CButtonColumn',
                    'header' => '详情',
                    'headerHtmlOptions' => array('width' => '30px'),
                    'template' => '{view}',
                    'buttons' => array(
                        'view' => array(
                            'lable' => '详情',
                           // 'options' => array('target' => '_blank'),
                            'url' => '$data[1]==1?Yii::app()->createUrl("pap/sellerorder/detail",array("ID"=>$data[ID]))
                                :Yii::app()->createUrl("pap/dealerreturn/orderinfo",array("ID"=>$data[ID]))'
                        )
                    )
                ),
            ),
        ));
        ?>
    </div>
    <div id="tab-return">
        <?php
//        $this->widget('widgets.default.WGridView', array(
//            'dataProvider' => $return,
//            'ajaxUpdate' => true,
//            'columns' => array(
////            array(// display 'create_time' using an expression
////                'name' => '序号',
////                'type' => 'raw',
////                'value' => '$data[rowNO]',
////            ),
//                array(// display 'author.username' using an expression
//                    'name' => '退货时间',
//                    'type' => 'raw',
//                    'value' => '$data[CreateTime]',
//                ),
//                array(// display 'author.username' using an expression
//                    'name' => '交易类型',
//                    'type' => 'raw',
//                    'value' => '$data[PayMethod]',
//                ),
//                array(// display 'author.username' using an expression
//                    'name' => '退款支付',
//                    'type' => 'raw',
//                    'value' => '$data[Price]',
//                ),
//                array(// display 'author.username' using an expression
//                    'name' => '修理厂名称',
//                    'type' => 'raw',
//                    'value' => '$data[BuyerName]',
//                ),
//                array(// display 'author.username' using an expression
//                    'name' => '退货单号',
//                    'type' => 'raw',
//                    'value' => '$data[ReturnNO]',
//                ),
//                array(// display 'author.username' using an expression
//                    'class' => 'CButtonColumn',
//                    'header' => '详情',
//                    'headerHtmlOptions' => array('width' => '30px'),
//                    'template' => '{view}',
//                    'buttons' => array(
//                        'view' => array(
//                            'lable' => '详情',
//                            'url' => 'Yii::app()->createUrl("pap/dealerreturn/orderinfo",array("ID"=>$data[ID]))',
//                            'options' => array(
//                                'target' => '_blank'
//                            )
//                        )
//                    )
//                ),
//            ),
//        ));
        ?>
    </div>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jquery.idTabs.min.js'></script>
<script>
    $("#tab-container ul").idTabs();

    $(document).ready(function() {
        //查询
        $('#form_btn').live('click', function() {
            if (!reg()) {
                return false;
            }
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/sellerorder/account' + url;
        })
        //打印
        $('#print_account').live('click', function() {
            if (!reg()) {
                return false;
            }
            var url = getUrl();
            window.open(Yii_baseUrl + '/pap/sellerorder/printaccount' + url);
        })
        //下载
        $('#create_account').live('click', function() {
            if (!reg()) {
                return false;
            }
            var url = getUrl();
            window.open(Yii_baseUrl + '/pap/sellerorder/createaccount' + url);
        })
        //发送邮件
        $('#send_account').live('click', function() {
            if (!reg()) {
                return false;
            }
            var url = getUrl();
            $.ajax({
                url: Yii_baseUrl + '/pap/sellerorder/sendaccount' + url,
                type: 'POST',
                success: function(data)
                {
                    if (data == 'ok')
                        alert('发送成功！');
                    else
                        alert('发送失败，请稍后再试！');
                }
            })
        })
    })

    function getUrl() {
        var url = '';
        if ($('select[name=Payment]').val()) {
            url += '/payment/' + $('select[name=Payment]').val();
        }
        if ($('select[name=Type]').val()) {
            url += '/type/' + $('select[name=Type]').val();
        }
        if ($.trim($('input[name=year]').val()) != '' && $.trim($('input[name=mouth]').val()) != '') {
            url += '/year/' + $('input[name=year]').val();
            url += '/mouth/' + $('input[name=mouth]').val();
        }
        return url;
    }
    function reg() {
        if ($.trim($('input[name=year]').val()) != '' && $.trim($('input[name=mouth]').val()) != '') {
            //验证年份
            var regyear = $('input[name=year]').val();
            if (regyear) {
                var reg = /^((1\d|20)\d{2})$/;
                if (!reg.test(regyear)) {
                    alert('请输入正确的年份');
                    return false;
                }
            }
            //验证月份
            var regmouth = $('input[name=mouth]').val();
            if (regmouth) {
                var reg = /^(0?\d|1[0-2])$/;
                if (!reg.test(regmouth)) {
                    alert('请输入正确的月份');
                    return false;
                }
            }
        }
        return true;
    }
</script>

