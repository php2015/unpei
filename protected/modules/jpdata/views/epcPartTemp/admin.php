<?php
$this->breadcrumbs=array(
	'Epc Part Temps'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EpcPartTemp', 'url'=>array('index')),
	array('label'=>'Create EpcPartTemp', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('epc-part-temp-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Epc Part Temps</h1>

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
	'id'=>'epc-part-temp-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'modelId',
		'modelName',
		'mainGroupId',
		'mainGroupName',
		'groupId',
		/*
		'groupName',
		'name',
		'ename',
		'oeno',
		'markNo',
		'amount',
		'note',
		'location',
		'picture',
		'picturePath',
		'price',
		'specification',
		'beginyear',
		'endyear',
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
