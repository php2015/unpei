<?php
$this->pageTitle = Yii::app()->name . '-违规管理';
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl("member/infomanager/index"),
    '违规管理' 
);
?>
<style>
    .row{margin-top: 5px;}
    .row label {display: inline-block;margin-right: 0;text-align: right;width: 110px !important;}
    .errorMessage{width: 200px;border: 0 none;display: inline;font-size: 12px;}
    .textarea {width: 540px;height: 120px;}
    .width200{width:200px;}
    table{table-layout:fixed;}
</style>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/companymanage.css">
<!--内容部分-->
<div class="bor_back m-top">
    <p class="txxx txxx3">用户信息</p>
    <div class="txxx_info4">
        <div  style="padding-bottom:20px; margin:10px 20px">
            <div class="float_l"><img width="100" height="100" src="<?php echo F::uploadUrl() . ($model->organ->Logo ? $model->organ->Logo : 'logo/touxiang.jpg'); ?>"></div>
            <div class="float_l m_left20">
                <p class="f_weight">用户名：<span><?php echo $model->UserName; ?></span></p>
                <ul  class="membership">
                    <li class="mem_leibie">账户类别：<span><?php echo $model->organ->Type; ?></span></li>
                    <li class="mem_effective">账户有效期：<span><?php echo date("Y-m-d H:i:s", $model->organ->CreateTime) . " 至 " .($model->organ->ExpirationTime?date("Y-m-d H:i:s", $model->organ->ExpirationTime): '2020-01-01') ?></span></li>
                    <li class="mem_status">认证状态：<span class="renzheng"><?php echo $model->organ->IsAuth ? "已认证" : "未认证" ?></span></li>
                    <li style="background-position: 0px -175px;">平台管理分值：<span style="color:#ff7a03"><?php echo $TotalScore; ?>分</span></li>
                </ul>
            </div>

            <div style="clear:both"></div>
        </div>
    </div>
</div>

<div class="bor_back m-top">
    <p class="txxx">
        违规记录
    </p>
    <div>
        <?php 
        $this->widget('widgets.default.WGridView', array(
            'id' => 'apply_list',
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(
                    'name' => '#',
                    'type' => 'raw',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                    'headerHtmlOptions' => array('style' => 'width:20px;'),
                ),
                array(
                    'name' => '违规时间',
                    'value' => 'date("Y-m-d",$data[CreateTime])',
                    'headerHtmlOptions' => array('width' => '70px')
                ),
                array(
                    'name' => '违规类别',
                    'type' => 'raw',
                    'value' => '$data[Name]',
                    'headerHtmlOptions' => array('width' => '200px'),
                    'htmlOptions' => array('style' => 'width:200px; white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                ),
                array(
                    'name' => '违规行为',
                    'type' => 'raw',
                    'value' => '$data[Behavior]',
                    'headerHtmlOptions' => array('width' => '270px'),
                    'htmlOptions' => array('style' => 'width:270px; white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                ),
                array(
                    'name' => '违规次数',
                    'value' => '$data[ListNumber]',
                    'headerHtmlOptions' => array('width' => '60px')
                ),
                array(
                    'name' => '处罚方式',
                    'value' => '$data[Punishment]',
                    'headerHtmlOptions' => array('width' => '150px')
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{view}',
                    'buttons' => array(
                        'view' => array(
                            'lable' => '详情',
                            'url' => 'Yii::app()->createUrl("/member/record/detail",array("id"=>$data[ID],"Identity"=>$data[Identity]))'
                        )
                    )
                )
            )
        ));
        ?>
    </div>
</div>
