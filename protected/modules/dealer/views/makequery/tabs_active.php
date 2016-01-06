<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
	//echo $controlerId;
?>
<style>

    .edf{float:left}
    .aaa{ float:left; width:75px; text-align:right;} 
    .bbb{ margin-left:10px}
    .ccc{height:26px;line-height:26px;  margin-bottom:16px;}

</style>
<div class='tabs' pre='tab'>
	<a style="margin-left:-30px;">&nbsp;</a>
	<a <?php if($controlerId=='makequery' && $actionId=='index') echo $active;?> href='<?php echo Yii::app()->createUrl('dealer/makequery/index')?>'>品牌厂家</a>
	<a <?php if($controlerId=='makequery' && $actionId=='dealersearch') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/makequery/dealersearch')?>">经销商</a>
	<a <?php if($controlerId=='makequery' && $actionId=='servicersearch') echo $active;?> href='<?php echo Yii::app()->createUrl('dealer/makequery/servicersearch')?>'>地区修理厂</a>
	<!--<a <?php // if($controlerId=='makequery' && $actionId=='dealerpromotionsearch') echo $active;?> href='<?php echo Yii::app()->createUrl('dealer/makequery/dealerpromotionsearch')?>'>经销商促销商品查询</a>-->
</div>