<?php
$this->pageTitle = Yii::app()->name . '-' . '已提交';
$this->breadcrumbs = array(
    '客服', //=>Yii::app()->createUrl('common/inquerylist'),
    '已提交',
);
?>
<style>
    #list{margin-top: 10px} 
</style>
<div class="bor_back m-top">

    <?php
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $data,
        'id' => 'list',
        'columns' => array(
            array(
                'name' => '问题编号',
                'value' => '$data["ID"]',
                'htmlOptions' => array('width' => '100px'),
            ),
            array(
                'name' => '标题',
                'value' => '$data["Title"]',
            ),
            array(
                'name' => '类型',
                'value' => '$data["Type"]',
                'htmlOptions' => array('width' => '120px'),
            ),
            array(
                'name' => '提交时间',
                'value' => '$data["SubmitTime"]',
                'htmlOptions' => array('width' => '220px'),
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作（详情）',
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'lable' => '详情',
                        'url' => 'Yii::app()->createUrl("/servicer/servicequestion/questiondetail",array("ID"=>$data[ID],"type"=>"wc"))'
                    )
                )
            )
        ),
    ));
    ?>

</div>
