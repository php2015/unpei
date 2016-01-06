<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
	//echo $controlerId;
?>

<div class='tabs' pre='tab'>
	<a style='margin-left:-30px;'>&nbsp;</a>
	<a <?php if($controlerId=='servicequery' && $actionId=='index') echo $active;?> href="<?php echo Yii::app()->createUrl('servicer/servicequery/index');?>">经销商查询</a>
	<!--<a <?php //if($controlerId=='servicequery' && $actionId=='promotions') echo $active;?> href="<?php //echo Yii::app()->createUrl('servicer/servicequery/promotions');?>">经销商商品查询</a>-->
	<!--<a <?php //if($controlerId=='servicequery' && $actionId=='service' || $actionId=='serviceDetail') echo $active;?> href="<?php //echo Yii::app()->createUrl('servicer/servicequery/service');?>">合作修理厂</a>-->
</div>