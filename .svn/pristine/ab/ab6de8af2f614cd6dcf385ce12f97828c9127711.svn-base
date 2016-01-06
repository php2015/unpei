<?php 
$this->breadcrumbs = array(
    '模版' => array('index'),
    '管理',
);
$this->menu=array(
	array('label'=>'短信模版管理', 'icon'=>'', 'url'=>array('short')),
        array('label'=>'邮件模版管理', 'icon'=>'', 'url'=>array('emailtemp')),
        array('label'=>'商品模版管理', 'icon'=>'', 'url'=>array('goodstemp')),
        array('label'=>'客户名录模版管理', 'icon'=>'', 'url'=>array('customer')),
);
?>
<h1>模版管理</h1>
<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'page-grid',
    'dataProvider' => $model->search(),
//    'filter' => $model,
    'columns' => array(
        'Name',
        'templatetype.Name',
        'Describe',
//	'keywords',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
//            'template' => '{view}{update}{delete}',
//            'viewButtonUrl' => 'Yii::app()->createUrl("/page/index",
//			array("key" => $data->key))',
        ),
    ),
));
?>