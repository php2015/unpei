<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
?>
<div class='tabs' pre='tab'>
		<a class='left-indent'>&nbsp;</a>
		<a href="<?php echo Yii::app()->createUrl('maker/salesmanage/index')?>" <?php if($actionId=='querygoods') echo $active;?>>商品信息列表</a>
		<a href="<?php echo Yii::app()->createUrl('maker/salesmanage/goodsadd');?>" <?php if($actionId=='goodsadd') echo $active;?>>添加商品</a>
		<a href="#" style="display: none">批量导入</a>
</div>