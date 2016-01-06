<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<style>
    .title_lm li a {
        color: #0164C1;
        float: left;
        font-size: 14px;
        text-align: center;
    }
</style>
<?php
$this->breadcrumbs = array(
    '营销管理'=>Yii::app()->createUrl('common/marketlist'),
      '营销参数设置'=>Yii::app()->createUrl('pap/discountset/turnover'),
    '订单最小金额',
);
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li><a href="<?php echo Yii::app()->createUrl('pap/discountset/index') ?>">价格管理 <span class="zwq_color"><?php echo $count[1] ?></a></span><span class="interval">  |</span></li>
            <li  class="current"><a href="<?php echo Yii::app()->createUrl('pap/discountset/turnover') ?>">订单最小金额 </a><span class="interval">  |</span></li>
            <li><a href="<?php echo Yii::app()->createUrl('pap/cs/index') ?>">客服管理 </a><span class="interval">  |</span></li>
        </ul>
    </div>
    <div class="ddgl_content3 m_top10 bor_back">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'columns' => array(
//                array(// display 'create_time' using an expression
//                    'name' => '序号',
//                    'value' => '$data->ID',
//                ),
                array(// display 'author.username' using an expression
                    'name' => '订单最小交易额(元)',
                    'value' => 'DiscountsetServices::getTurnover($data->ID)',
                ),
                array(
                    // display a column with "view", "update" and "delete" buttons
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{update}',
                    'buttons' => array(
                        'update' => array(
                            'label' => '修改',
                            'url' => 'Yii::app()->createUrl("/pap/discountset/editturnover",array("id"=>$data->ID))'
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>

