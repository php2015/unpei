<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; text-indent:17px}
    .title_lm li a{font-size:14px; color:#0164c1;}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    .txxx2{ border-bottom:2px solid #c5d2e2}
    span.zwq_color{ color:#fb540e}
    .input{width:131px}
    #count{float:right;margin:10px 5px;font-size:14px}
</style>
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '销售统计' => Yii::app()->createUrl('pap/sellerorder/sellcount'),
    '订单交易统计'
);
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li class="<?php
            if ($_GET['type'] == '0') {
                echo 'current';
            }
            ?>"><a href="<?php echo Yii::app()->createUrl('pap/promotion/Moneycount/type/0') ?>">促销减免<span class="interval">  |</span></a></li>
            <li class="<?php
            if ($_GET['type'] == '1') {
                echo 'current';
            }
            ?>"><a href="<?php echo Yii::app()->createUrl('pap/promotion/Moneycount/type/1') ?>">优惠券<span class="interval">  |</span></a></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a m-top">
            <form method="get">
                <p>
                    <label  class="">买家名称：</label>
                    <input type="text" class="input" value="<?php echo $_GET['buyname'] ?>" style="margin-right:10px" name="buyname">
                    <label  class=""><?php
                        if ($_GET['type'] == '0') {
                            echo '活动标题';
                        } else {
                            echo '优惠卷号';
                        }
                        ?>：</label>
                    <input type="text" class="input" value="<?php echo $_GET['protitle'] ?>" style="margin-right:10px" name="protitle">
                    <label  class="">订单编号：</label>
                    <input type="text" class="input" value="<?php echo $_GET['orderno'] ?>" style="margin-right:10px" name="orderno">


                </p>

                <p class="m-top">
                    <label  class="">交易时间：</label>
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
                    <label  class=" m_left24">结算状态：</label>
                    <select class="select select2 width120" name="Status">
                        <option value ="">请选择</option>
                        <option value ="0" <?php
                        if ($_GET['Status'] == '0') {
                            echo 'selected=selected';
                        }
                        ?>>未结算</option>
                        <option value ="1" <?php
                        if ($_GET['Status'] == '1') {
                            echo 'selected=selected';
                        }
                        ?>>已结算</option>
                    </select>
                    <input type="button" class="submit f_weight m_left" value="查 询" id="form_btn">
                </p>
            </form>
        </div>
    </div>
</div>
<div class="yxgl_content2 m-top">
    <div style="clear:both"></div>
</div>
<div class="ddgl_content3 m_top10 bor_back2">
    <?php
    if ($_GET['type'] == '0') {
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $promotionlist,
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '序号',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                ),
                array(// display 'author.username' using an expression
                    'name' => '买方名称',
                    'value' => '$data[BuyerName]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '活动标题',
                    'value' => '$data[Title]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '订单号',
                    'value' => '$data[OrderSN]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '交易时间',
                    'value' => 'SellerorderService::returnTime($data[CreateTime])',
                ),
                array(// display 'author.username' using an expression
                    'name' => '减免金额(￥)',
                    'value' => '$data[Amount]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '嘉配结算',
                    'value' => 'PromotionService::returnStatus($data[Status])',
                ),
            ),
        ));
    } else {
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $promotionlist,
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '序号',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                ),
                array(// display 'author.username' using an expression
                    'name' => '买方名称',
                    'value' => '$data[BuyerName]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '优惠卷号',
                    'value' => '$data[CouponSn]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '订单号',
                    'value' => '$data[OrderSN]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '交易时间',
                    'value' => 'SellerorderService::returnTime($data[CreateTime])',
                ),
                array(// display 'author.username' using an expression
                    'name' => '减免金额(￥)',
                    'value' => '$data[Amount]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '嘉配结算',
                    'value' => 'PromotionService::returnStatus($data[Status])',
                ),
            ),
        ));
    }
    ?>
</div>
<script>
    $(document).ready(function() {
        $('#form_btn').live('click', function() {
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/promotion/Moneycount' + url;
        });
    });

    function getUrl() {
        var url = '/type/<?php echo $_GET['type'] ?>';
        if ($.trim($('input[name=buyname]').val()) != '') {
            url += '/buyname/' + $('input[name=buyname]').val();
        }
        if ($.trim($('input[name=protitle]').val()) != '') {
            url += '/protitle/' + $('input[name=protitle]').val();
        }
        if ($.trim($('input[name=orderno]').val()) != '') {
            url += '/orderno/' + $('input[name=orderno]').val();
        }
        if ($('select[name=Status]').val()) {
            url += '/Status/' + $('select[name=Status]').val();
        }
        if ($('input[name=starttime]').val()) {
            url += '/starttime/' + $('input[name=starttime]').val();
        }
        if ($('input[name=endtime]').val()) {
            url += '/endtime/' + $('input[name=endtime]').val();
        }
        return url;
    }
</script>

