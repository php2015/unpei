<?php header("Content-Type: text/html; charset=UTF-8")?>
<?php
if($action=='edit')
    $scope='EpcPartTempedit';
else
    $scope='EpcPartTemp';
$ep_pt=Yii::app()->request->getParam('ep_pt');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>$scope,
	'action'=>Yii::app()->createUrl('jpdata/EpcPartTemp/create',array('ep_pt'=>$ep_pt)),
	'htmlOptions' => array('enctype' => 'multipart/form-data',
//			'onsubmit'=>"return false",
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

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
			<input type="hidden" name="EpcPartTemp[ModelID]" value="<?php echo $model->ModelID?>">
		<?php echo $form->labelEx($model,'ModelID',array('label'=>$model->getAttributeLabel('ModelID').':')); ?>
		<?php //echo $form->textField($model,'modelId',array('size'=>20,'maxlength'=>20)); ?>
		<?php $this->widget('widgets.default.WEpcModel',array('scope'=>$scope,'cascade'=>5,
				'modelField'=>'modelId','mainGroupField'=>'mainGroupId',
				'make'=>$epcModel['makeId'],
				'series'=>$epcModel['seriesId'],
				'year'=>$epcModel['year'],
				'model'=>$epcModel['modelId']
			));?>
		<?php echo $form->error($model,'ModelID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GroupIG',array('label'=>$model->getAttributeLabel('GroupIG').':')); ?>
		<?php //echo $form->textField($model,'parentId',array('size'=>20,'maxlength'=>20)); ?>
		<?php $this->widget('widgets.default.WEpcGroup',array('scope'=>$scope,'cascade'=>2,
				'modelField'=>'modelId','mainGroupField'=>'mainGroupId', 'groupField'=>'groupId',
				'model'=>$epcModel['modelId'],
				'mainGroup'=>$epcGroup['groupPid'],
				'group'=>$epcGroup['groupId']
		));?>
		<?php echo $form->error($model,'GroupIG'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'PartID',array()); ?>
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
		<?php echo $form->labelEx($model,'Oeno',array('label'=>$model->getAttributeLabel('Oeno').':')); ?>
		<?php echo $form->textField($model,'Oeno',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Oeno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MarkNo',array('label'=>$model->getAttributeLabel('MarkNo').':')); ?>
		<?php echo $form->textField($model,'MarkNo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'MarkNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Amount',array('label'=>$model->getAttributeLabel('Amount').':')); ?>
		<?php echo $form->textField($model,'Amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Location',array('label'=>$model->getAttributeLabel('Location').':')); ?>
		<?php echo $form->textField($model,'Location',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Price',array('label'=>$model->getAttributeLabel('Price').':')); ?>
		<?php echo $form->textField($model,'Price',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Specification',array('label'=>$model->getAttributeLabel('Specification').':')); ?>
		<?php echo $form->textField($model,'Specification',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Specification'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Beginyear',array('label'=>$model->getAttributeLabel('Beginyear').':')); ?>
		<?php echo $form->textField($model,'Beginyear',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Beginyear'); ?>
                <span>输入格式:2014-1-1</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Endyear',array('label'=>$model->getAttributeLabel('Endyear').':')); ?>
		<?php echo $form->textField($model,'Endyear',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'Endyear'); ?>
                  <span>输入格式:2014-1-1</span>
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
		<?php echo $form->error($model,'Picture',array(),false,false); ?>
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