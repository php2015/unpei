<style>
    table{table-layout:fixed;}
    table tbody td{font-size:12px;}
    table tbody td a{font-size:12px;}
</style>
<?php
$this->pageTitle = '由你配 - 山东配件经销商联盟介绍';
?>
<div class="contents">
    <div class="banner">
        <div class="banner_info">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/login/product2.jpg">
        </div>
    </div>

    <div class="content_info m-top10">
        <div class="" style="margin: 10px 30px 20px;">
            <p><span class="title">山东全车件经销商联盟</span></p>
            <div class="sub"><span>本平台秉持一个车系精选一家最优质的全车件供货商，目前山东全车件经销商联盟上线的经销商都是精选的济南各车系全车件优质供货商，库存大、服务意识强、具有价格优势；我们希望凭借一流的互联网平台，一流的经销商，整合各类最具实力的生产商，打造国内汽车后市场的第一服务体系，为各类终端修理厂提供数据精准、价格低廉、配送及时、退换货无忧的全新服务模式！
                </span></div>
            <p class=" m-top20"><span class="letter-title">目前已加入的经销商</span></p>
            <div style="border:1px solid #c5d2e2; text-align:center; " class="m-top10">
                <!--                表格加入表格后请记着将外面的height:425px;line-height:425px;color:red;样式去掉-->
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => $list,
                    'summaryText'=>'',
                    'columns' => array(
                        array(
                            'name' => '经销商名称',
                            'type' => 'raw',
                            'value' => '$data["OrganName"]'
                        ),
                        array(
                            'name' => '主营配件品牌',
                            'type' => 'raw',
                            'value' => '$data["brand"]',
                            'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                        ),
                        array(
                            'name' => '经营车系',
                            'type' => 'raw',
                            'value' => '$data["vehicles"]',
                            'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                        ),
                        array(
                            'name' => '联系电话',
                            'type' => 'raw',
                            'value' => '$data["TelPhone"]',
                            'htmlOptions' => array('style' => 'word-wrap:break-word;overflow: hidden;text-overflow:ellipsis')
                        ),
                    )
                ))
                ?>
            </div>
            <p class="m-top20"><b style="font-size:14px">由你配平台正在邀请山东省其他车品牌的全车件经销商及修理厂加入，点击按钮申请加入！</b></p>
            <p class="m-top10"><button class="button" id="join">点击申请加入联盟</button></p>
        </div>
    </div>
</div>
<script>
    var Yii_baseUrl = "<?php echo F::baseUrl(); ?>";
    $('#join').click(function(){ 
        window.location.href=Yii_baseUrl+'/member/introduce/join';
    })
</script>
