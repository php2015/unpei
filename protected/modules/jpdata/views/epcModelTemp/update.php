<?php
$this->breadcrumbs=array(
	'Epc Model Temps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EpcModelTemp', 'url'=>array('index')),
	array('label'=>'Create EpcModelTemp', 'url'=>array('create')),
	array('label'=>'View EpcModelTemp', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EpcModelTemp', 'url'=>array('admin')),
);
?>

<h1>Update EpcModelTemp <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>