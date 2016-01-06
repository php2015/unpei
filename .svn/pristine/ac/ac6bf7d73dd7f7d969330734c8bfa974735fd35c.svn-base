<?php
$this->renderPartial('head', array('organID' => $params['OrganID']));
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '商品交易评价',
);
?><!--买家评价-->
<div class="appraise">
    <ul class="apptop">
        <li><a href="<?php echo Yii::app()->createUrl('pap/sellerevaluate/index') ?>">来自买家的商品评价</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('pap/sellerevaluate/receive') ?>">来自买家的服务评价</a></li>
        <li class="on"><a href="<?php echo Yii::app()->createUrl('pap/sellerevaluate/evaluate') ?>">对买家的信用评价</a></li>
    </ul>
    <div class="eval_tabel">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $evallist,
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '评价内容',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('width' => '150px'),
                    'value' => '$data[evalItem]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '评价',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('width' => '150px'),
                    'value' => '$data[evalScore]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '评价心得',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('width' => '250px'),
                    'value' => '$data[Message]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '买家账号',
                    'type' => 'raw',
                    'value' => 'EvaluateService::getOrganName($data[Recier])',
                ),
            ),
        ));
        ?>
    </div>
    <!--对买家信用评价结束-->
</div>