<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; text-indent:17px}
    .title_lm li a{font-size:14px; color:#0164c1;}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    /* .title_lm a:link{font-size:14px; color:#0164c1;}*/
    .txxx2{ border-bottom:2px solid #c5d2e2}
    span.zwq_color{ color:#fb540e}
    .eval_organ{width:220px;margin:0 auto;text-align:center;word-break:break-all}
</style>
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '销售统计' => Yii::app()->CreateUrl('pap/sellerorder/sellcount'),
    '客户购买统计'
);
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li class=""><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/sellcount') ?>">订单交易统计 <span class="interval">  |</span></a></li>
            <li class="current"><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/sellcustom') ?>">客户购买统计<span class="interval">  |</span></a></li>
            <li class=""><a href="<?php echo Yii::app()->createUrl('pap/sellerorder/sellgoods') ?>">商品销售统计<span class="interval">  |</span></a></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a m-top">
            <form method="get">
                <p class="m-top">
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
        'dataProvider' => $goodslist,
        'columns' => array(
            array(// display 'create_time' using an expression
                'name' => '排名',
                'value' => '$data[rowNO]',
            ),
            array(// display 'author.username' using an expression
                'name' => '买家名称',
                'type' => 'raw',
                'value' => 'EvaluateService::getOrganName($data[BuyerID])',
            ),
            array(// display 'author.username' using an expression
                'name' => '订单数',
                'value' => '$data[Status]',
            ),
            array(// display 'author.username' using an expression
                'name' => '购买总额',
                'value' => '￥.$data[GoodsAmount]',
            ),
            array(// display 'author.username' using an expression
                'name' => '购买最多(商品编号)',
                'value' => 'SellerorderService::getMostBuyGoods($data[GoodsNum],$data[goods_count])',
            ),
        ),
    ));
    ?>
</div>
<script>
    $(document).ready(function(){  
        $('#form_btn').live('click',function(){
            var url=getUrl();
            window.location.href=Yii_baseUrl+'/pap/sellerorder/sellcustom'+url;
        })
        
        $('#export_btn').live('click',function(){
            var url=getUrl();
            var page=<?php echo $params['page'] ?>;
            if(page<1||!page) page=1;
            url+="/page/"+page;
            window.location.href=Yii_baseUrl+'/pap/sellerorder/sellcustomexport'+url;
        })
    })
    
    function getUrl(){
        var url='';
        if($.trim($('input[name=search_text]').val())!=''){
            url+='/search_text/'+$('input[name=search_text]').val();
        }
        url+='/starttime/'+$('input[name=starttime]').val();
        url+='/endtime/'+$('input[name=endtime]').val();
        return url;
    }
</script>
