<?php
/* @var $this ParameterController */
/* @var $model Settings */

$this->breadcrumbs=array(
	'系统参数设置'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'系统参数列表', 'url'=>array('admin')),
	array('label'=>'创建系统参数', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#settings-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>系统参数管理</h1>


<?php echo CHtml::link('条件搜索','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                'ID',
		'Category',
		'Key',
                array(
		'name' => 'Value',
		'value' => 'Settings::valueunserialize($data->Value)',
),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
