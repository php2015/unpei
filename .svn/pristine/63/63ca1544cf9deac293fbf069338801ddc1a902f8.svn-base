<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $item CAuthItem */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
	$this->chinname($this->getTypeText(true)) => array('index'),
	$item->description => array('view', 'name' => $item->name),
	Yii::t('AuthModule.main', '编辑'),
);
?>

<h1>
	<?php echo CHtml::encode($item->description); ?>
	<small><?php echo $this->chinname($this->getTypeText(true)); ?></small>
</h1>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'type'=>'horizontal',
)); ?>

<?php echo $form->hiddenField($model, 'type'); ?>
<?php echo $form->textFieldRow($model, 'name', array(
	'disabled'=>true,
	'title'=>Yii::t('AuthModule.main', '系统名称创建后不能更改!'),
)); ?>
<?php echo $form->textFieldRow($model, 'description'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => Yii::t('AuthModule.main', '保存'),
	)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'type' => 'link',
		'label' => Yii::t('AuthModule.main', '取消'),
		'url' => array('view', 'name' => $item->name),
	)); ?>
</div>

<?php $this->endWidget(); ?>