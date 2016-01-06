<?php 
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
?>

<div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("member/push/index"); ?>" <?php if($actionId == 'index') echo $active; ?> >推送信息管理</a>
        <!--<a href="<?php echo Yii::app()->createUrl("member/push/pushbuy"); ?>" <?php if($actionId == 'pushbuy') echo $active; ?> >推送服务订购</a>-->
        <a href="<?php echo Yii::app()->createUrl("member/push/mypush"); ?>"<?php if($actionId == 'mypush') echo $active; ?> >我的推送服务</a>
</div>