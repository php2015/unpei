<?php 
$this->breadcrumbs = array(
    '模版' => array('index'),
    '短信模版管理'=>array('short'),
    '创建模版'
);
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'create-uptemp',
//	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true),
        'htmlOptions'=>array(
                'enctype'=>'multipart/form-data',
        ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'Describe',array('class'=>'span5','maxlength'=>150, 'value'=>'')); ?>
        <div class="control-group validating">
            <label class="control-label" for="FileUrl">Excel文件模版</label>
            <div class="controls">
                <?php //echo $form->fileField($model,'FileUrl',array('class'=>'span5')); ?>
                <?php //echo CHtml::activeFileField($model,'FileUrl',array('class'=>'span5'));?>
                <input id="AdminTemplate_FileUrl" class="span5" type="file" name="FileUrl">
            </div>
            <?php echo CHtml::label($message, '', array('style' => 'color:red','id'=>'filemessage')); ?>
        </div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
