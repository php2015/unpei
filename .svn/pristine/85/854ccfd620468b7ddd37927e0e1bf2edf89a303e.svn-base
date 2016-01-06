<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $item CAuthItem */
/* @var $ancestorDp AuthItemDataProvider */
/* @var $descendantDp AuthItemDataProvider */
/* @var $formModel AddAuthItemForm */
/* @var $form TbActiveForm */
/* @var $childOptions array */

$this->breadcrumbs = array(
	$this->chinname($this->getTypeText(true)) => array('index'),
	$item->description,
);
?>

<div class="title-row clearfix">

	<h1 class="pull-left">
		<?php echo CHtml::encode($item->description); ?>
		<small><?php echo $this->chinname($this->getTypeText(true)); ?></small>
	</h1>

	<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
		'htmlOptions'=>array('class'=>'pull-right'),
		'buttons'=>array(
			array(
				'label'=>Yii::t('AuthModule.main', '编辑'),
				'url'=>array('update', 'name'=>$item->name),
			),
			array(
				'icon'=>'trash',
				'url'=>array('delete', 'name'=>$item->name),
				'htmlOptions'=>array(
					'confirm'=>Yii::t('AuthModule.main', 'Are you sure you want to delete this item?'),
				),
			),
		),
	)); ?>

</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $item,
    'attributes' => array(
        array(
            'name' => 'name',
			'label' => Yii::t('AuthModule.main', '{type}名', array('{type}'=>$this->chinname($this->getTypeText(true)))),
		),
		array(
			'name' => 'description',
			'label' => Yii::t('AuthModule.main', '描述'),
		),
		/*
        array(
			'name' => 'bizrule',
			'label' => Yii::t('AuthModule.main', 'Business rule'),
		),
		array(
			'name' => 'data',
			'label' => Yii::t('AuthModule.main', 'Data'),
		),
		*/
    ),
)); ?>

<hr />

<div class="row-fluid">

	<div class="span6">

		<h3>
			<?php echo Yii::t('AuthModule.main', '父级'); ?>
			<small><?php echo Yii::t('AuthModule.main', '所继承的权限'); ?></small>
		</h3>

		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'striped condensed hover',
			'dataProvider'=>$ancestorDp,
			'emptyText'=>Yii::t('AuthModule.main', '该{type}没有父级!', array('{type}'=>$this->chinname($this->getTypeText(true)))),
			'template'=>"{items}",
			'hideHeader'=>true,
			'columns'=>array(
				array(
					'class'=>'AuthItemDescriptionColumn',
					'itemName'=>$item->name,
				),
				array(
					'class'=>'AuthItemTypeColumn',
					'itemName'=>$item->name,
				),
				array(
					'class'=>'AuthItemRemoveColumn',
					'itemName'=>$item->name,
				),
			),
		)); ?>

	</div>

	<div class="span6">

		<h3>
			<?php echo Yii::t('AuthModule.main', '子级'); ?>
			<small><?php echo Yii::t('AuthModule.main', '所授予的权限'); ?></small>
		</h3>

		<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'type' => 'striped condensed hover',
			'dataProvider'=>$descendantDp,
			'emptyText'=>Yii::t('AuthModule.main', '该{type}没有子级!', array('{type}'=>$this->chinname($this->getTypeText(true)))),
			'hideHeader'=>true,
			'template'=>"{items}",
			'columns'=>array(
				array(
					'class'=>'AuthItemDescriptionColumn',
					'itemName'=>$item->name,
				),
				array(
					'class'=>'AuthItemTypeColumn',
					'itemName'=>$item->name,
				),
				array(
					'class'=>'AuthItemRemoveColumn',
					'itemName'=>$item->name,
				),
			),
		)); ?>

	</div>

</div>

<div class="row-fluid">

	<div class="span6 offset6" style="float:right !important">

		<?php if (!empty($childOptions)): ?>

			<h4><?php echo Yii::t('AuthModule.main', '添加子级'); ?></h4>

			<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'type'=>'inline',
			)); ?>

			<?php echo $form->dropDownList($formModel, 'items', $childOptions, array('label'=>false)); ?>

			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'label'=>Yii::t('AuthModule.main', '添加'),
			)); ?>

			<?php $this->endWidget(); ?>

		<?php endif; ?>

	</div>

</div>