<?php
/* @var $this HotWordController */
/* @var $model PapHotWord */

$this->breadcrumbs=array(
	'热词库列表'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'热词库列表', 'url'=>array('index')),
	array('label'=>'创建热词', 'url'=>array('create')),
	array('label'=>'更新热词', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'删除热词', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'key',
		'value',
		array(
                  'name'=>'order',  
                ),
		array(
                    'name'=>'num'
                )
	),
)); ?>
