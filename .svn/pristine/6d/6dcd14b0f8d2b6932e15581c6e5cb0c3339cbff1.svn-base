<?php
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
$organID = Commonmodel::getOrganID();
$res = User::model()->findByPk($organID);
?>


<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <a <?php if ($actionId == 'index') echo $active; ?> href="<?php echo Yii::app()->createUrl('cim/discountset/index'); ?>">商城订单</a>
    <a <?php if ($actionId == 'inquiry') echo $active; ?> href="<?php echo Yii::app()->createUrl('cim/discountset/inquiry'); ?>">询价单订单</a>
    <a <?php if ($actionId == 'quote') echo $active; ?> href="<?php echo Yii::app()->createUrl('cim/discountset/quote'); ?>">报价单订单</a>
</div>

