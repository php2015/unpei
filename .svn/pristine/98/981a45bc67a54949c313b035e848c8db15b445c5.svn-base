<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
	//echo $controlerId;class="active"
	
?>


<div class='tabs' pre='tab'>
	<a class='left-indent'>&nbsp;</a>
	<a <?php if($actionId=='index') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/marketing/index');?>">商品列表</a>
	<?php if ($actionId=='updatepomotion'):?>
	<a <?php if($actionId=='updatepomotion') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/marketing/updatepomotion');?>">修改促销商品</a>
	<?php endif;?>
	<a <?php if($actionId=='addpomotion') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/marketing/addpomotion');?>">添加自定义商品</a>
<!--	<a <?php if($actionId=='batchimport') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/marketing/batchimport');?>">批量导入</a>-->
</div>