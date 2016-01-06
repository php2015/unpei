<?php
$this->breadcrumbs=array(
	'Cache'=>array('admin'),
	'Cache',
);
?>

<h3>Cache Admin</h3>

<?php echo Yii::app()->user->getFlash('success'); ?>
<?php
echo CHtml::beginForm('','post',array('style'=>'height:300px;margin-top:20px;'));
echo CHtml::hiddenField('clear', 'all'); 
//echo CHtml::button('清除缓存', array('class' => 'btn','style'=>'margin-left:20px;'));
echo CHtml::submitButton('清除缓存', array('class' => 'btn','onclick'=>"javascript:if (!confirm('确认要清除所有缓存？')) {return false;}; "));
echo CHtml::endForm();
?>