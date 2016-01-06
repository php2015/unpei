<?php header("Content-Type: text/html; charset=UTF-8")?>
<style>
    .select{margin-left:0px}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'epc-group-temp-form',
	'action'=>Yii::app()->createUrl('jpdata/EpcGroupTemp/create'),
	'htmlOptions' => array('enctype' => 'multipart/form-data',
		//'onsubmit'=>"return false",
	),		
	'enableAjaxValidation'=>true,
 	'enableClientValidation'=>true,
 	'clientOptions'=>array(
 			'validateOnSubmit'=>true,
// 			'afterValidate'=>'js:function(form,data,hasError){
//                     if(!hasError){
//                          '.$submitFun.'();
// 						return true;
// 					}
// 					return false;
//             }',
 	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //var_dump($epcModel);//echo $form->errorSummary($model); ?>
	
	<div class="row">
		<input type="hidden" name="EpcGroupTemp[ModelID]" value="<?php echo $model->ModelID?>">
		<?php echo $form->labelEx($model,'ModelID',array('label'=>$model->getAttributeLabel('ModelID').':')); ?>
		<?php //echo $form->textField($model,'modelId',array('size'=>20,'maxlength'=>20)); ?>
		<?php $this->widget('widgets.default.WEpcModel',array('scope'=>'EpcGroupTemp','cascade'=>5,
				'modelField'=>'modelId','mainGroupField'=>'GroupPid',
				'make'=>$epcModel['makeId'],
				'series'=>$epcModel['seriesId'],
				'year'=>$epcModel['year'],
				'model'=>$epcModel['ModelID']
			));?>
		<?php echo $form->error($model,'ModelID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GroupPid',array('label'=>$model->getAttributeLabel('GroupPid').':')); ?>
		<?php //echo $form->textField($model,'parentId',array('size'=>20,'maxlength'=>20)); ?>
		<?php $this->widget('widgets.default.WEpcGroup',array('scope'=>'EpcGroupTemp','cascade'=>1,
				'modelField'=>'modelId','mainGroupField'=>'GroupPid',
				'model'=>$epcModel['modelId']
			));?>
		<?php echo $form->error($model,'GroupPid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name',array('label'=>$model->getAttributeLabel('Name').':')); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Ename',array('label'=>$model->getAttributeLabel('Ename').':')); ?>
		<?php echo $form->textField($model,'Ename',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Ename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GroupNo',array('label'=>$model->getAttributeLabel('GroupNo').':')); ?>
		<?php echo $form->textField($model,'GroupNo',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'GroupNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ApplicableModel',array('label'=>$model->getAttributeLabel('ApplicableModel').':')); ?>
		<?php echo $form->textField($model,'ApplicableModel',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'ApplicableModel'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Note',array('label'=>$model->getAttributeLabel('Note').':')); ?>
		<?php echo $form->textArea($model,'Note',array('rows'=>10, 'cols'=>80)); ?>
		<?php echo $form->error($model,'Note'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Picture',array('label'=>$model->getAttributeLabel('Picture').':')); ?>
		<?php echo $form->fileField($model,'Picture',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Picture',array(),true,false); ?>
	</div>
	<div class="row">
		<label></label>
		大小不能超过2M,允许的图片格式: jpg, jpeg, png, bmp
	</div>

	<div class="row buttons" >
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class'=>'submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->