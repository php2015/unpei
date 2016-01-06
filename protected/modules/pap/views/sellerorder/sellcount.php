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
            <li class="current"><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/sellcount') ?>">订单交易统计 <span class="interval">  |</span></a></li>
            <li class=""><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/sellcustom') ?>">客户购买统计<span class="interval">  |</span></a></li>
            <li class=""><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/sellgoods') ?>">商品销售统计<span class="interval">  |</span></a></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a m-top">
            <form method="get">
                <p>
                    <label  class="">买家名称：</label>
                    <input type="text" class="input" value="<?php echo $params['search_text'] ?>" style="margin-right:10px" name="search_text">
                    <label  class="">成交时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'starttime',
                        'attribute' => 'start_time',
                        'language' => 'zh_cn',
                        'value' => $params['starttime'] ? date('Y-m-d', $params['starttime']) : date('Y-m-01'),
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
                        'value' => $params['endtime'] ? date('Y-m-d', $params['endtime']) : date('Y-m-d'),
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'class' => 'input input3 width100',
                        )
                    ));
                    ?>

                </p>

                <p class="m-top">
                    <label>支付方式：</label>
                    <select class="select select2 width120" name="Payment">
                        <option value ="">支付方式</option>
                        <?php foreach ($type as $k => $v): ?>
                            <option value ="<?php echo $k ?>"<?php if ($k == $params['Payment']) echo 'selected' ?>><?php echo $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label  class=" m_left24">交易状态：</label>
                    <select class="select select2 width120" name="Status">
                        <option value ="">交易状态</option>
                        <?php foreach ($status as $k => $v): ?>
                            <option value ="<?php echo $k; ?>"<?php if ($k == $params['Status']) echo 'selected' ?>><?php echo $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="button" class="submit f_weight m_left" value="查 询" id="form_btn">
                    <input type="button" class="submit f_weight m_left" value="导 出" id="export_btn">
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
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $orderlist,
        'columns' => array(
            array(// display 'create_time' using an expression
                'name' => '序号',
                'value' => '$data[rowNO]',
            ),
            array(// display 'author.username' using an expression
                'name' => '订单编号',
                'value' => '$data[OrderSN]',
            ),
            array(// display 'author.username' using an expression
                'name' => '下单时间',
                'value' => 'SellerorderService::returnTime($data[CreateTime])',
            ),
            array(// display 'author.username' using an expression
                'name' => '买家名称',
                'value' => '$data[BuyerName]',
//                'type' => 'raw',
//                'value' => 'EvaluateService::getOrganName($data[BuyerID])',
            ),
            array(// display 'author.username' using an expression
                'name' => '支付方式',
                'value' => 'SellerorderService::showOrderPayment($data[Payment])',
            ),
            array(// display 'author.username' using an expression
                'name' => '交易状态',
                'value' => 'SellerorderService::showOrderStatus($data[Status],$data[ReturnStatus])',
            ),
            array(// display 'author.username' using an expression
                'name' => '订单金额',
                'value' => '￥.$data[RealPrice]',
            ),
            array(// display 'author.username' using an expression
                'name' => '订单详情',
                'type' => 'raw',
                'value' => '$data[Info]',
            ),
        ),
    ));
    ?>
</div>
<div id="count">
    <label>订单个数：</label><span class="order_count"><?php echo $count; ?></span>
    <label class="m_left24">订单总额共计：</label><span class="amount_count">￥<?php echo $total ?></span>
</div>
<script>
    $(document).ready(function(){  
        $('#form_btn').live('click',function(){
            var url=getUrl();
            window.location.href=Yii_baseUrl+'/pap/sellerorder/sellcount'+url;
        })
        
        $('#export_btn').live('click',function(){
            var url=getUrl();
            var page=<?php echo $params['page'] ?>;
            if(page<1||!page) page=1;
            url+="/page/"+page;
            window.location.href=Yii_baseUrl+'/pap/sellerorder/sellcountexport'+url;
        })
        
        //        var sum=0;
        //        var length=parseInt($('.items>tbody>tr').length);
        //        $('.items>tbody>tr').each(function(){
        //            var amount=$(this).find('td:eq(6)').text().substr(1);
        //            sum+=parseFloat(amount);
        //        })
        //        $('.order_count').html(length+'个');
        //        $('.amount_count').html('￥'+sum.toFixed(2));
        //alert(sum.toFixed(2));
    })
    
    function getUrl(){
        var url='';
        if($.trim($('input[name=search_text]').val())!=''){
            url+='/search_text/'+$('input[name=search_text]').val();
        }
        if($('select[name=Payment]').val()){
            url+='/Payment/'+$('select[name=Payment]').val();
        }
        if($('select[name=Status]').val()){
            url+='/Status/'+$('select[name=Status]').val();
        }
        url+='/starttime/'+$('input[name=starttime]').val();
        url+='/endtime/'+$('input[name=endtime]').val();
        return url;
    }
</script>

