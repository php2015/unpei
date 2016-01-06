<?php
$this->breadcrumbs=array(
	'Epc Group Temps'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List EpcGroupTemp', 'url'=>array('index')),
	array('label'=>'Create EpcGroupTemp', 'url'=>array('create')),
	array('label'=>'Update EpcGroupTemp', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EpcGroupTemp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EpcGroupTemp', 'url'=>array('admin')),
);
?>

<h1>View EpcGroupTemp #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'modelId',
		'parentId',
		'name',
		'ename',
		'groupNo',
		'picture',
		'picturePath',
		'note',
		'applicableModel',
		'userId',
		'organId',
		'createTime',
		'updateTime',
		'status',
	),
)); ?>
