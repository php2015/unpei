<?php 
$this->breadcrumbs = array(
    '模版' => array('index'),
    '短信模版管理',
);
$this->menu=array(
	array('label'=>'创建模版', 'icon'=>'', 'url'=>array('uptemp')),
);
?>
<h1>短信模版管理</h1>
<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'page-grid',
    'dataProvider' => $dataProvider,
//    'filter' => $model,
    'columns' => array(
        'Name',
        'templatetype.Name',
        'Describe',
//	'keywords',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/cms/template/short",array("ID"=>$data->ID));',
            'updateButtonUrl'=>'Yii::app()->createUrl("/cms/template/short",array("ID"=>$data->ID));',
            'deleteButtonUrl'=>'Yii::app()->createUrl("/cms/template/short",array("ID"=>$data->ID));',
//            'template' => '{view}{update}{delete}',
//            'viewButtonUrl' => 'Yii::app()->createUrl("/page/index",
//			array("key" => $data->key))',
        ),
    ),
));
?>