<?php header("Content-Type: text/html; charset=UTF-8")?>
<style>
.required{height:28px;line-height:28px;}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'epc-model-temp-form',
	'action'=>Yii::app()->createUrl('jpdata/EpcModelTemp/Create'),
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
		//'onsubmit'=>"return false",
	),		
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	//'focus' => array($model,'Make')
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'Make'); ?>:
		<?php echo $form->textField($model,'Make',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Make'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Series'); ?>:
		<?php echo $form->textField($model,'Series',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Series'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Year',array('class'=>'required')); ?>:
		<?php echo $form->textField($model,'Year',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Model'); ?>:
		<?php echo $form->textField($model,'Model',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Model'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Content'); ?>:
		<?php echo $form->textArea($model,'Content',array('rows'=>10, 'cols'=>80)); ?>
		<?php echo $form->error($model,'Content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FileName'); ?>:
		<?php echo $form->fileField($model,'FileName',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'FileName'); ?>
	</div>
	<div class="row">
		<label></label>
		大小不能超过2M,允许的文档格式: doc, docx, xls, xlsx
	</div>

	<div class="row buttons" >
	<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '提交',array('class'=>'submit')); ?>
	</div>
<?php $this->endWidget(); ?>


</div><!-- form -->