<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
	$organID = Commonmodel::getOrganID();
	$res=User::model()->findByPk($organID);
?>


<div class='tabs' pre='tab'>
	<a class='left-indent'>&nbsp;</a>
	<a <?php if($actionId=='index' || $actionId=='processContact') echo $active;?> href="<?php echo Yii::app()->createUrl('cim/contact/index');?>">业务联系人</a>
	<a <?php if($actionId=='customercategory' || $actionId=='processCategory') echo $active;?> href="<?php echo Yii::app()->createUrl('cim/contact/customercategory');?>">客户类别管理</a>
	<a <?php if($actionId=='addcontactsgroup' ) echo $active;?> href="<?php echo Yii::app()->createUrl('cim/contact/addcontactsgroup');?>">群组管理</a>
	<?php if($res['identity']==2){?><a <?php if($actionId=='share' ) echo $active;?> href="<?php echo Yii::app()->createUrl('cim/contact/share');?>">共享联系人管理</a><?php }?>
</div>