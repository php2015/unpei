<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
?>
<div class='tabs' pre='tab'>
		<a class='left-indent'>&nbsp;</a>
		<a href="<?php echo Yii::app()->createUrl('maker/makegoods/index')?>" <?php if($actionId=='index') echo $active;?>>商品信息列表</a>
</div>