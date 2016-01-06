<?php
$this->breadcrumbs=array(
	'管理员列表'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'创建管理员','icon'=>'plus','url'=>array('create')),
	array('label'=>'更新管理员','icon'=>'pencil','url'=>array('update','id'=>$model->ID)),
	array('label'=>'删除管理员','icon'=>'trash','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理员列表','icon'=>'cog','url'=>array('admin')),
);
?>

<h1>查看管理员 <?php echo $model->ID; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'UserName',
		'Email',
	),
)); ?>
