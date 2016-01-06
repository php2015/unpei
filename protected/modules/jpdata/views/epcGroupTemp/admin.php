<?php
$this->breadcrumbs=array(
	'Epc Group Temps'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EpcGroupTemp', 'url'=>array('index')),
	array('label'=>'Create EpcGroupTemp', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('epc-group-temp-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Epc Group Temps</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'epc-group-temp-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'modelId',
		'parentId',
		'name',
		'ename',
		'groupNo',
		/*
		'picture',
		'picturePath',
		'note',
		'applicableModel',
		'userId',
		'organId',
		'createTime',
		'updateTime',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
