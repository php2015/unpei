<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'category-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
    'clientOptions'=>array('validateOnSubmit'=>true),
));
?>
<?php include 'tabs_active_contacts.php';?>
<div class='tab-content'>
	<div class='form-list'>
		<div class='title title-dashed-inline'>
			<span>客户类别</span>
		</div>
		<p class="form-row">
			<?php echo $form->labelEx($model,'客户类别:',array('class'=>'label')); ?>
			<?php echo $form->textField($model,'category',array('class'=>'width213 input')); ?>
			<?php echo $form->error($model,'category',array('style'=>'float:left; margin-left:360px; color:red; margin-top:-30px;')); ?>
		</p>
		<p class="form-row">
			<?php echo CHtml::label('','',array('class'=>'label')); ?>
			<?php echo $form->hiddenField($model,'id',array('class'=>'width130 input'));?>
			<?php echo CHtml::Button('保存',array('id'=>'save','class' => 'submit','style'=>"cursor:pointer"));?><!-- 'onclick' =>'return confirm("您确定要保存吗？")' -->
		</p>		
	</div>
</div>
<?php $this->endWidget(); ?>
<script>
$(function(){
	$("#save").click(function(){
		if(confirm("您确定要保存吗？"))
		{
			$("#save").submit();
		}
	
	});
	
})

</script>