<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
	//echo $controlerId;
?>
<div class='tabs' pre='tab'>
	<a class='left-indent'>&nbsp;</a>
	<a <?php if($actionId=='index') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/business/subdealer');?>">下属机构列表</a>
	<?php if ($actionId=='updatesubdealer'):?>
	<a <?php if($actionId=='updatesubdealer') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/business/updatesubdealer');?>">修改机构</a>
	<?php endif;?>
	<a <?php if($actionId=='addsubdealer') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/business/addsubdealer');?>">添加机构</a>
	<a <?php if($actionId=='batchimport') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/business/batchimport');?>">批量导入</a>
</div>