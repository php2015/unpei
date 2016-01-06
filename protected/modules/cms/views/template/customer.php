<?php 
$this->breadcrumbs = array(
    '模版' => array('index'),
    '客户名录模版管理',
);
$this->menu=array(
	array('label'=>'创建模版', 'icon'=>'', 'url'=>array('uptemp')),
);
?>
<h1>客户名录模版管理</h1>
<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'page-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'Name',
        'templatetype.Name',
        'Describe',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/cms/template/emailtemp",array("ID"=>$data->ID));',
            'updateButtonUrl'=>'Yii::app()->createUrl("/cms/template/emailtemp",array("ID"=>$data->ID));',
            'deleteButtonUrl'=>'Yii::app()->createUrl("/cms/template/emailtemp",array("ID"=>$data->ID));',
        ),
    ),
));
?>