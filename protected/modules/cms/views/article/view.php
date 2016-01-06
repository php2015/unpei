<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->Title,
);

$this->menu=array(
	array('label'=>'List Article', 'icon'=>'list', 'url'=>array('index')),
	array('label'=>'Create Article', 'icon'=>'plus','url'=>array('create')),
	array('label'=>'Update Article', 'icon'=>'pencil','url'=>array('update', 'id'=>$model->ArticleID)),
	array('label'=>'Delete Article', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ArticleID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Article', 'icon'=>'cog','url'=>array('admin')),
);
?>

<h1>View Article #<?php echo $model->ArticleID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ArticleID',
		'CategoryID',
		'AuthorID',
		'Title',
		'From',
                'Summary:html',
		'Content:html',
		'Views',
		'CreateTime',
		'UpdateTime',
	),
)); ?>
