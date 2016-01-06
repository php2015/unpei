<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<?php 
    $this->breadcrumbs = array(
        '用户中心',
        '物流配送商管理'
    );
?>
<div class="bor_back m_top10">
<p class="txxx txxx3">物流配送商管理
	<span id="add" class="xjd" style="float:right;background-position: 0 -153px;text-indent:25px; line-height:35px"><a href="<?php echo Yii::app()->createUrl('/maker/makecompany/adddistribution'); ?>">添加</a></span>
</p>
<div  style="margin:10px 0px">
    <?php
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'name' => '配送商',
                'value' => 'CHtml::encode($data->Name)'
            ),
            array(
                'name' => '价格系数',
                'value' => 'CHtml::encode($data->PriceRatio)'
            ),
            array(
                'name' => '配送时间',
                'value' => 'CHtml::encode($data->DistributionTime)'
            ),
            array(
                'name' => '配送范围',
                'value' => ' CHtml::encode($data->DistributionScope)'
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("/maker/makecompany/adddistribution",array("id"=>$data->ID))'
                    ),
                    'delete' => array(
                        'lable' => '删除',
                        'url' => 'Yii::app()->createUrl("/maker/makecompany/deldistribution",array("id"=>$data->ID))'
                    )
                )
            )
        )
    ))
    ?>

    <!--content1即又半部分结束-->
</div>
