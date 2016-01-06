<?php
/* @var $this ParameterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'系统参数管理',
);

$this->menu=array(
	array('label'=>'系统参数参数列表', 'url'=>array('admin')),
	array('label'=>'创建系统参数', 'url'=>array('create')),
);
?>

<h1>Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
