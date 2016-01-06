<?php
/* @var $this ParameterController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'系统参数设置'=>array('admin'),
	$model->Key=>array('view','id'=>$model->ID),
	'更新',
);

$this->menu=array(
	array('label'=>'系统参数列表', 'url'=>array('admin')),
	array('label'=>'创建系统参数', 'url'=>array('create')),
	array('label'=>'查看系统参数', 'url'=>array('view', 'id'=>$model->ID)),
);
?>

<h1>更新系统参数<?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>