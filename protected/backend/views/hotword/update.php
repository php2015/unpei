<?php
/* @var $this HotWordController */
/* @var $model PapHotWord */

//$this->breadcrumbs=array(
//	'Pap Hot Words'=>array('index'),
//	$model->ID=>array('view','id'=>$model->ID),
//	'Update',
//);

$this->menu=array(
	array('label'=>'热词库列表', 'url'=>array('index')),
	array('label'=>'创建热词', 'url'=>array('create')),
	array('label'=>'查看热词', 'url'=>array('view', 'id'=>$model->ID)),
);
?>

<h1>更新热词</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>