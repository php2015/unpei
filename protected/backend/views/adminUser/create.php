<?php
$this->breadcrumbs=array(
	'管理员列表'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'管理员列表', 'icon'=>'cog', 'url'=>array('admin')),
);
?>

<h1>创建管理员</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>