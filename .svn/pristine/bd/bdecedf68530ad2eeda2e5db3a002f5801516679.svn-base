<?php
$this->breadcrumbs = array(
    UserModule::t('会员列表') => array('/user'),
    UserModule::t('管理'),
);

$this->menu = array(
    array('label' => UserModule::t('创建会员'), 'icon' => 'plus', 'url' => array('create')),
    array('label' => UserModule::t('管理会员'), 'icon' => 'cog', 'url' => array('admin')),
    array('label' => UserModule::t('管理 Profile表字段'), 'icon' => 'cog', 'url' => array('profileField/admin')),
  //  array('label' => UserModule::t('会员列表'), 'icon' => 'list', 'url' => array('/user')),
	array('label' => UserModule::t('黑名单列表'), 'icon' => 'list', 'url' => array('/user/admin/blacklist')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>
<h1><?php echo UserModule::t("会员管理");?></h1>
<p style="display:none"><?php echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>

<?php echo CHtml::link(UserModule::t('更多条件搜索'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
	'model' => $model,
    ));
    ?>
</div><!-- search-form -->
</p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'创建会员',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('user/admin/create')
)); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'冻结会员',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
	 'id'=>'freeze',
	//'url'=>Yii::app()->createUrl('user/admin/create')
)); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'解冻会员',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'id'=>'unfreeze',
)); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'id'=>'deleteAll',
    'label'=>'批量删除',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
	//	'url'=>Yii::app()->createUrl('user/admin/create')
)); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'加入黑名单',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
	'id'=>'black',
)); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'导出用户',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
	'id'=>'importout',
     'url'=>Yii::app()->createUrl('user/admin/importoutexcel')
)); ?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
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
	),
    ),
));
?>
    <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />  
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(  
    'id'=>'mydialog',//弹窗ID  
    // additional javascript options for the dialog plugin  
    'options'=>array(//传递给JUI插件的参数  
        'title'=>'冻结',  
        'autoOpen'=>false,//是否自动打开  
        'width'=>'600px',//宽度  
        'height'=>'auto',//高度  
		 'modal'=>true,
//         'buttons'=>array(  
//             '关闭'=>'js:function(){ $(this).dialog("close");}',//关闭按钮  
//         ),  
  
    ),  
)); ?> 

<label>请填写冻结原因:</label>
<?php echo CHtml::textArea('remark','',
 array('id'=>'remark', 'style'=>'width:500px;height:120px;')); ?>
<?php //echo CHtml::textArea('remark', '','',array('style'=>'width:600px'));?>	<p/>	
<div style="margin-left:200px"><?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'id'=>'submit',
		'type' => 'primary',
		'label' => UserModule::t('保存'),
));?>&nbsp;&nbsp;&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'reset',
		'id'=>'cancle',
		'type' => 'primary',
		'label' => UserModule::t('取消'),
));?>
</div>


<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');  
?>
<script type="text/javascript">
$('#cancle').click(function()
	{
	 $('#mydialog').dialog('close');
		});
//冻结
 $('#freeze').click(function()
 {
	 var data=new Array();
	  $("input:checkbox[name='selectdel[]']:checked").each(function (){
	  if(this.value!=''){
              data.push($(this).val());
      }
	 });
	  var crowid=data.join(',');
    if(crowid==null || crowid.length==0)
    {
  	       alert('请勾选要冻结的会员');
			return false;
    }
    var confm=confirm('确定要冻结所选择会员?');
 		if(confm==false)
		{
			return false;
		}
	  $("#mydialog").dialog("open"); 
		 });
 //导出
 $('#importout').click(function()
 {
   		 var confm=confirm('确定要导出当前用户?');
 		if(confm==false)
		{
			return false;
		}
  });
 //解冻
 $('#unfreeze').click(function(){
		 var data=new Array();
		  $("input:checkbox[name='selectdel[]']:checked").each(function (){
		  if(this.value!=''){
	              data.push($(this).val());
	       }
		 });
		  var crowid=data.join(',');
	    if(crowid==null || crowid.length==0)
	    {
	  	       alert('请勾选要解冻的会员');
				return false;
	    }
	    var confm=confirm('确定要解冻所选择的会员?');
	    
 		if(confm==false)
		{
			return false;
		}
 		$.ajax({
			url: Yii_baseUrl+'/user/admin/unfreeze/',
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
//解冻
 $('#black').click(function(){
		 var data=new Array();
		  $("input:checkbox[name='selectdel[]']:checked").each(function (){
		  if(this.value!=''){
	              data.push($(this).val());
	       }
		 });
		  var crowid=data.join(',');
	    if(crowid==null || crowid.length==0)
	    {
	  	       alert('请勾选要列入黑名单的会员');
				return false;
	    }
	    var confm=confirm('确定要列入黑名单?');
 		if(confm==false)
		{
			return false;
		}
 		$.ajax({
			url: Yii_baseUrl+'/user/admin/black/',
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
 //冻结备注提交
 $('#submit').click(function(){
	 var data=new Array();
	  $("input:checkbox[name='selectdel[]']:checked").each(function (){
	  if(this.value!=''){
            data.push($(this).val());
    }
	 });
	  var crowid=data.join(',');
	  var remark=$('#remark').val();
	  $.ajax({
			url: Yii_baseUrl+'/user/admin/freeze/',
			type:'post',
			data:{ 
				data: crowid,
				remark: remark
			},
		   datatype: 'json',
		   success:function(data)
		   {
			   if(data)
			   {
				   $('#mydialog').dialog('close');
				   $.fn.yiiGridView.update('user-grid');
			   }
		   }
		});
 })
 //批量删除
 $('#deleteAll').click(function(){
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
        	alert('请勾选要删除的会员');
			return false;
        }
        var confm=confirm('确定要删除所选择数据?');
		if(confm==false)
		{
			return false;
		}
		$.ajax({
			url: Yii_baseUrl+'/user/admin/deleteall/',
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
   //表单搜索
	$('.search-form form').submit(function(){
       $.fn.yiiGridView.update('user-grid', {
         data: $(this).serialize()
    });
  	     return false;
    });
</script>
