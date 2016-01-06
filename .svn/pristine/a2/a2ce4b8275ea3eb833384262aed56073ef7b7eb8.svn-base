<?php
$this->breadcrumbs=array(
	'管理员列表'=>array('admin'),
	//$model->id=>array('view/','id'=>$model->id),
	//$model->id=>'view/'.$model->id,
	'更新',
);

$this->menu=array(
	array('label'=>'创建管理员','icon'=>'plus','url'=>array('create')),
	array('label'=>'查看管理员','icon'=>'eye-open','url'=>array('view','id'=>$model->ID)),
	array('label'=>'管理员列表','icon'=>'cog','url'=>array('admin')),
);
?>

<h1>更新管理员 <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>