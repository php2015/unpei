<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
	$this->chinname($this->getTypeText(true)) => array('index'),
	Yii::t('AuthModule.main', '添加{type}', array('{type}' => $this->chinname($this->getTypeText(true)))),
);
?>

<h1><?php echo Yii::t('AuthModule.main', '添加{type}', array('{type}' => $this->chinname($this->getTypeText(true)))); ?></h1>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'type'=>'horizontal',
)); ?>

<?php echo $form->hiddenField($model, 'type'); ?>
<?php // echo $form->label($model, '项目名'); ?>
<?php echo $form->textFieldRow($model, 'name'); ?>
<?php echo $form->textFieldRow($model, 'description'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => Yii::t('AuthModule.main', '创建'),
	)); ?>
	<?php $this->widget('TbButton', array(
		'type' => 'link',
		'label' => Yii::t('AuthModule.main', '取消'),
		'url' => array('index'),
	)); ?>
</div>

<?php $this->endWidget(); ?>
