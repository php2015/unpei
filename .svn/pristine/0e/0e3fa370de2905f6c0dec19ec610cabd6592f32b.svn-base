<?php
$this->breadcrumbs=array(
	'管理员列表'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'创建管理员', 'icon'=>'plus', 'url'=>array('create')),
);

?>

<h1>管理员列表</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'admin-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'UserName',
		'Email',
		array(
                  'name'=>'Profile',
                   'value'=>'$model->Profile',
                    'filter'=>false
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
