<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "商品类别修改";
?>
<?php if(Yii::app()->user->hasFlash('success')):?>  
   <div class="successmessage" id='message'>
    <?php echo Yii::app()->user->getFlash('success'); ?>  
   </div>
    <?php endif?>
    <?php if(Yii::app()->user->hasFlash('failed')):?>  
	<div class="errormessage" id='message'>
	<?php echo Yii::app()->user->getFlash('failed'); ?>  
	</div>
	<?php endif?>
	<div id='modify'style="margin-left:20px; height:300px;">
	  <?php 
		$form=$this->beginWidget('CActiveForm', array(
 			'id'=>'goodcategorymodify-form',
			//'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true),
			//'clientOptions'=>Yii::app()->params['clientOptions'],
		));
	?>
	<div class="form">
		<div class='title title-dashed' style="height:43px">商品类别修改
		<a href="<?php echo Yii::app()->createUrl("/maker/goodscategory/querygoodscategory")?>" style="padding-left:500px">返回</a>
		</div>
		<div class='row'>
				<label>商品类别代号:</label>
			<?php echo CHtml::activetextField($model,'code',array('class'=>'width113 input','value'=>$result['code']))?>
		  </div>
		<div class='row'>
				<label>商品类别名称:</label>
			<?php echo CHtml::activetextField($model,'name',array('class'=>'width113 input','value'=>$result['name']))?>
		</div>
		<div class='row'>
				<label>商品简单说明:</label>
			<?php echo CHtml::activetextField($model,'desc',array('class'=>'width113 input','value'=>$result['desc']))?>
		</div>
		<input type="submit" class="submit" name="submit" style='margin-left:84px' value="保存">
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php 
 //这是一段,在显示后定里消失的JQ代码,已集成至Yii中.
Yii::app()->clientScript->registerScript(
'myHideEffect',
'$("#message").animate({opacity: 1.0}, 2000).fadeOut("slow");',
CClientScript::POS_READY
);
?>