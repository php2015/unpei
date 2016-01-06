<?php
/* @var $this ParameterController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'系统参数管理'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'系统参数列表', 'url'=>array('admin')),
	array('label'=>'创建系统参数', 'url'=>array('create')),
	array('label'=>'更新系统参数', 'url'=>array('update', 'id'=>$model->ID)),
);
?>

<h1>查看系统参数 #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Category',
		'Key',
		'Value',
	),
)); ?>
