<?php
/* @var $this ParameterController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'系统参数管理'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'系统参数列表', 'url'=>array('admin')),
	array('label'=>'创建系统参数', 'url'=>array('create')),
);
?>

<h1>创建系统参数</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>