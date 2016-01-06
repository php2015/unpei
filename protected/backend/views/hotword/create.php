<?php
/* @var $this HotWordController */
/* @var $model PapHotWord */

$this->breadcrumbs=array(
	'热词库列表'=>array('index'),
	'创建热词',
);

$this->menu=array(
	array('label'=>'热词库列表', 'url'=>array('index')),
);
?>

<h1>创建热词</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>