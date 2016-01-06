<?php
$this->pageTitle=Yii::app()->name.'-'.'已回复';
$this->breadcrumbs = array(
    '客服',//=>Yii::app()->createUrl('common/inquerylist'),
    '已回复',
//    '询价单列表',
);
?>
<style>
    #list{
        margin-top: 10px
    }
</style>
<div class="bor_back m-top">

     <!--<p class="txxx">已回复问题列表</p>-->
    <?php $this->widget('widgets.default.WGridView',array(
        'dataProvider'=>$data,
        'id'=>'list',
        'columns'=>array(
            array(
              'name'=>'问题编号',   
               'value'=>'$data["ID"]',
            ),
           array(
              'name'=>'标题',   
              'value'=>'$data["Title"]',
            ),
            array(
              'name'=>'类型', 
              'value'=>'$data["Type"]',
            ),
            array(
              'name'=>'提交时间',  
             'value'=>'$data["SubmitTime"]',
            ),
            array(
                'name'=>'解答时间',
                'value'=>'$data["AnswerTime"]',
            ),
              array(
                'name'=>'状态（待评价/满意度）',
                'value'=>'$data["Satisfaction"]',
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作（详情）',
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'lable' => '详情',
                        'url' => 'Yii::app()->createUrl("/servicer/servicequestion/questiondetail",array("ID"=>$data[ID],"type"=>"an"))'
                    )
                )
            )
        ),
    ));?>
    
</div>
