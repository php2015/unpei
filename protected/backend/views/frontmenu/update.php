<?php
$this->breadcrumbs=array(
	'Menus'=>array('admin'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'创建菜单','icon'=>'plus','url'=>array('create')),
	array('label'=>'查看菜单','icon'=>'eye-open','url'=>array('view','id'=>$model->ID)),
	array('label'=>'管理菜单','icon'=>'cog','url'=>array('admin')),
);
?>

<h1>更新菜单 <?php echo $model->Name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>