<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />

<style>
    .title_lm li a {
        color: #0164C1;
        float: left;
        font-size: 14px;
        text-align: center;
    }
    .coin-se{ background:#f0f0f0; border:1px solid #dedede; padding:10px 15px; border-left:none; border-right:none }
    .coin-se p{line-height: 28px}
    .coin-pr{ color:#fb540e; font-size: 35px; font-weight: bold;}
    .coin-div{ line-height: 56px}

    .coin-bt{ background:url("<?php echo F::themeUrl() . '/images/icons/cash3.jpg' ?>") no-repeat; width:75px; height:30px; line-height:30px; color:#fff; font-size:14px; border:none; cursor:pointer}
    .title_lm2 li a{ color:#666; font-size:13px}
    .title_lm2 li.current a{ color:#fb540e;}
</style><?php
$this->breadcrumbs = array(
    '保证金管理',
    '质量保证金'
);
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
?>

<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li <?php if ($_GET['type'] == 0) echo 'class="current"' ?> ><a href="<?php echo Yii::app()->createUrl('pap/cashdeposit/index/type/0/time/2') ?>">质量保证金 </a><span class="interval">  |</span></li>
            <li <?php if ($_GET['type'] == 1) echo 'class="current"' ?> ><a href="<?php echo Yii::app()->createUrl('pap/cashdeposit/index/type/1/time/2') ?>">基础保证金 </a><span class="interval">  |</span></li>
        </ul>
    </div>
    <div class="coin-se m-top">
        <?php if ($type == 1) { ?>
            <div class="float_l" style="width:45%"><p>基础保证金余额：</p><p class="coin-pr"><?php echo '￥' . $money ?></p></div>
            <div class="float_r" style="width:32%">
                <div class="coin-div">
                    <button class=" coin-bt" onclick="recharge()">充值</button>
                    <!--<img src="<?php // echo F::themeUrl() . '/images/icons/cash1.jpg'             ?>" style="margin-left:30px; vertical-align: middle; margin-right:5px; width:16px; height: 16px"/><a>管理</a><span style="margin-left:20px; color:#999">|</span><img src="<?php // echo F::themeUrl() . '/images/icons/cash2.jpg'             ?>"  style="margin-left:20px; vertical-align: middle; margin-right:5px; width:16px; height: 16px"><a>历史记录</a>-->
                </div>   
            </div>
        <?php } else if ($type == 0) { ?>
            <div class="float_l" style="width:45%"><p>质量保证金余额：</p><p class="coin-pr"><?php echo '￥' . $money ?></p></div>
            <div class="float_r" style="width:32%">
                <div class="coin-div"><button class=" coin-bt" onclick="recharge()">充值</button>
                    <!--<img src="<?php // echo F::themeUrl() . '/images/icons/cash1.jpg'             ?>" style="margin-left:30px; vertical-align: middle; margin-right:5px; width:16px; height: 16px"/><a>管理</a><span style="margin-left:20px; color:#999">|</span><img src="<?php // echo F::themeUrl() . '/images/icons/cash2.jpg'             ?>"  style="margin-left:20px; vertical-align: middle; margin-right:5px; width:16px; height: 16px"><a>历史记录</a>-->
                </div>   
            </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="txxx txxx2">
        <form method="get">
            <ul class="title_lm title_lm2">
                <li <?php if ($_GET['time'] == 1 && empty($_GET['starttime']) && empty($_GET['endtime'])) echo 'class="current"' ?> ><a href="<?php echo Yii::app()->createUrl('pap/cashdeposit/index', array('type' => $_GET['type'] ? $_GET['type'] : 0, 'time' => 1)) ?>">今天 </a></li>
                <li <?php if ($_GET['time'] == 2 && empty($_GET['starttime']) && empty($_GET['endtime'])) echo 'class="current"' ?> ><a href="<?php echo Yii::app()->createUrl('pap/cashdeposit/index', array('type' => $_GET['type'] ? $_GET['type'] : 0, 'time' => 2)) ?>">最近一个月 </a></li>
                <li <?php if ($_GET['time'] == 3 && empty($_GET['starttime']) && empty($_GET['endtime'])) echo 'class="current"' ?> ><a href="<?php echo Yii::app()->createUrl('pap/cashdeposit/index', array('type' => $_GET['type'] ? $_GET['type'] : 0, 'time' => 3)) ?>">最近三个月 </a></li>
            </ul>



            <label  class="m_left24">起始时间：</label>
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
            <input type="submit" class="submit f_weight m_left24" value="搜 索" id="form_btn">

        </form>


    </div>
    <div class="ddgl_content3 m_top10 bor_back "  >


        <!--<div class="tab-bd-con pricekey" style="display:block"> -->
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '序号',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                ),
                array(// display 'author.username' using an expression
                    'name' => '时间',
                    'value' => 'date("Y-m-d H:i:s",$data->CreateTime)',
                ),
                array(// display 'author.username' using an expression
                    'name' => '项目',
                    'value' => '$data->Item',
                ),
                array(// display 'author.username' using an expression
                    'name' => '收款方',
                    'value' => '$data->OrganID',
                ),
                array(// display 'author.username' using an expression
                    'name' => '金额(￥)',
                    'value' => '$data->Money',
                ),
                array(
//                    // display a column with "view", "update" and "delete" buttons
//                    'class' => 'CButtonColumn',
//                    'header' => '操作',
//                    'template' => '{view}',
//                    'buttons' => array(
//                        'view' => array(
//                            'label' => '详情',
//                            'url' => 'Yii::app()->createUrl("/pap/Cashdeposit/info",array("id"=>$data->ID))',
////                        'click'=>'js:function(){ checkC();}'
//                        ),
//                    ),
                    'name' => '操作',
                    'type' => 'raw',
                    'value' => '$data->view',
                ),
            ),
        ));
        ?>
    </div>
</div>
<script>
    function recharge() {
        alert('该功能暂未开放');
    }
</script>

