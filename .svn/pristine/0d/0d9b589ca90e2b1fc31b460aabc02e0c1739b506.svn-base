<?php
$this->breadcrumbs=array(
	'Epc Model Temps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EpcModelTemp', 'url'=>array('index')),
	array('label'=>'Create EpcModelTemp', 'url'=>array('create')),
	array('label'=>'Update EpcModelTemp', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EpcModelTemp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EpcModelTemp', 'url'=>array('admin')),
);
?>

<h1>View EpcModelTemp #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'make',
		'series',
		'year',
		'model',
		'content',
		'fileName',
		'filePath',
		'userId',
		'organId',
		'createTime',
		'updateTime',
		'status',
	),
)); ?>
