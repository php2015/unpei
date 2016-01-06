<?php
$this->breadcrumbs = array(
    '内容分类' => array('admin'),
    '管理',
);

$this->menu = array(
    array('label' => '创建分类', 'icon' => 'plus', 'url' => array('create')),
);
?>
<h1>内容分类</h1>
<div class="well well-large">
<?php

$descendants=CmsCategory::model()->findAll(array('condition'=>'Root=1','order'=>'Lft'));
$level = 0;

foreach ($descendants as $category) {
    if ($category->Level == $level)
        echo CHtml::closeTag('li') . "\n";
    else if ($category->Level > $level)
        echo CHtml::openTag('ul') . "\n";
    else {
        echo CHtml::closeTag('li') . "\n";

        for ($i = $level - $category->Level; $i; $i--) {
            echo CHtml::closeTag('ul') . "\n";
            echo CHtml::closeTag('li') . "\n";
        }
    }

    echo CHtml::openTag('li',array('style'=>'border-bottom:1px dashed #333;'));
    echo CHtml::encode($category->Name).'<span style="float:right">['.
            CHtml::link('更新', array('/cms/contentCategory/update', 'id'=>$category->ID)).']['.
            CHtml::link('删除', '', array('submit'=>array('/cms/contentCategory/delete','id'=>$category->ID),'csrf'=>true,'style'=>'cursor:pointer', 'confirm'=>'Are you sure you want to delete this item?')).']</span>';
    $level = $category->Level;
}

for ($i = $level; $i; $i--) {
    echo CHtml::closeTag('li') . "\n";
    echo CHtml::closeTag('ul') . "\n";
}
?>
</div>