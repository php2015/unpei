<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
?>


<div class='tabs' pre='tab'>
	<a class='left-indent'>&nbsp;</a>
	<a <?php if($actionId=='businesscontacts' || $actionId=='processcontact') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/marketing/businesscontacts');?>">业务联系人</a>
	<a <?php if($actionId=='customercategory' || $actionId=='processcategory') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/marketing/customercategory');?>">客户类别管理</a>
</div>