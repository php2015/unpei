<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ArticleID'); ?>
		<?php echo $form->textField($model,'ArticleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CategoryID'); ?>
		<?php echo $form->textField($model,'CategoryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AuthorID'); ?>
		<?php echo $form->textField($model,'AuthorID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Title'); ?>
		<?php echo $form->textField($model,'Title',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'From'); ?>
		<?php echo $form->textField($model,'From',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Content'); ?>
		<?php echo $form->textArea($model,'Content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Views'); ?>
		<?php echo $form->textField($model,'Views'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreateTime'); ?>
		<?php echo $form->textField($model,'CreateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UpdateTime'); ?>
		<?php echo $form->textField($model,'UpdateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->