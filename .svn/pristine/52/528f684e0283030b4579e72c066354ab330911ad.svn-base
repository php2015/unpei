<?php
$this->breadcrumbs = array(
    UserModule::t('会员') => array('/user'),
    UserModule::t('黑名单'),
);

$this->menu = array(
    array('label' => UserModule::t('创建会员'), 'icon' => 'plus', 'url' => array('create')),
    array('label' => UserModule::t('管理会员'), 'icon' => 'cog', 'url' => array('admin')),
	array('label' => UserModule::t('黑名单列表'), 'icon' => 'list', 'url' => array('/user/admin/blacklist')),
);?>
<h1><?php echo UserModule::t("黑名单管理"); ?></h1>
<!-- 操作信息提示{ -->
<?php if(Yii::app()->user->hasFlash('success')):?>  
<div class="successmessage" id='message'>
<?php echo Yii::app()->user->getFlash('success'); ?>  
</div>
<?php endif?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'批量移除',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
	'id'=>'delblack',
)); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->black(),
    'filter' => $model,
    'ajaxUpdate'=>false,    //禁用AJAX分页或排序
    'columns' => array(
	array(
			'class'=>'CCheckBoxColumn',
			'headerHtmlOptions' => array('width'=>'33px'),
             'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
			'selectableRows'=>'2',
			//'value'=>'CHtml::encode($data->id)',
		),
	array(
	    'name' => 'id',
	    'type' => 'raw',
	    'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		'filter'=>false,
),

	array(
	    'name' => 'username',
	    'type' => 'raw',
	    'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
),
	array(
	    'name' => 'email',
	    'type' => 'raw',
	    'value' => 'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
	),
// 	'create_at',
// 	'lastvisit_at',
array(
		'name' => 'identity',
		'value' => 'User::itemAlias("identity",$data->identity)',
		'filter' => User::itemAlias("identity"),
),
array(
		'name' => 'phone',
		'value' => '$data->profile->phone',
),
array(
		'name' => 'usertype',
		'value' => 'User::itemAlias("usertype",$data->profile->UserType)',
		'filter' => User::itemAlias("usertype"),
),
array(
		'name' => 'freeze',
		'value' => 'User::itemAlias("freeze",$data->profile->freeze)',
		'filter'=>User::itemAlias('freeze'),
),
array(
	    'name' => 'superuser',
	    'value' => 'User::itemAlias("AdminStatus",$data->superuser)',
	    'filter' => User::itemAlias("AdminStatus"),
	),
	array(
	    'name' => 'status',
	    'value' => 'User::itemAlias("UserStatus",$data->status)',
	    'filter' => User::itemAlias("UserStatus"),
	),
   array(
	 'name'=>'address',
	  'value'=>'Area::getCity($data->profile->state).Area::getCity($data->profile->city).Area::getCity($data->profile->district)',
 		'filter'=>false,
),
	array(
	    'class' => 'bootstrap.widgets.TbButtonColumn',
		'template'=>'{view}{delete}',
		'buttons'=>array
		(
		   'delete' => array
		  (
				'label'=>'移除黑名单',
				'url'=>'Yii::app()->createUrl("user/admin/deleteblack", array("id"=>$data->id))',
			),
),
	),
   
    ),
));
?>
<script type="text/javascript">
$('#delblack').click(function(){
    var data=new Array();
    $("input:checkbox[name='selectdel[]']:checked").each(function (){
    	 if(this.value!='')
		  	 {
                data.push($(this).val());
        }
});
    var crowid=data.join(',');
    if(crowid==null || crowid.length==0)
    {
    	alert('请勾选要移除的会员');
		return false;
    }
    var confm=confirm('确定要移除黑名单?');
	if(confm==false)
	{
		return false;
	}
	$.ajax({
		url: Yii_baseUrl+'/user/admin/delallblack/',
		type:'post',
		data:{ 
			data: crowid
		},
	   datatype: 'json',
	   success:function(data)
	   {
		   if(data)
		   {
			   $.fn.yiiGridView.update('user-grid');
		   }
	   }
	});
});
</script>