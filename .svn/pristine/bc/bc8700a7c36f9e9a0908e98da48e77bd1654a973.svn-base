<style>
    .zdiul {margin-top:5px;margin-left:15px;min-height:30px;height:auto;}
    .zdiul li {
        width:30%;float:left;margin-right:10px;margin-bottom:5px;
    }
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 物流管理';
$this->breadcrumbs = array(
    '销售管理'=>Yii::app()->createUrl('common/saleslist'),
    '物流管理'
);
?>
<div class="bor_back m-top" style="height:auto; position:relative">
    <p class="txxx">物流信息</p>
    <div class="txxx_info5">       

        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $lists,
            'itemView' => 'lists',
            'id' => 'loglists'
        ));
        ?>
    </div>
</div>
