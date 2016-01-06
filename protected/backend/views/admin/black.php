<?php
$this->breadcrumbs = array(
  '会员' => array('/admin/admin'),
  '黑名单',
);

$this->menu = array(
    array('label' => '创建会员', 'icon' => 'plus', 'url' => array('create')),
    array('label' => '管理会员', 'icon' => 'cog', 'url' => array('admin')),
    array('label' =>'黑名单列表', 'icon' => 'list', 'url' => array('/admin/blacklist')),
);?>
<h1><?php echo "黑名单管理"; ?></h1>
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
            'class' => 'CCheckBoxColumn',
            'headerHtmlOptions' => array('width' => '33px'),
            'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
            'selectableRows' => '2',
        //'value'=>'CHtml::encode($data->id)',
        ),
        array(
            'name' => 'ID',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->ID),array("admin/update","id"=>$data->ID))',
            'filter' => false,
        ),
         array(
            'name' => 'UserName',
            'type' => 'raw',
            'value' => '$data->user->UserName',
        ),
        array(
            'name' => 'OrganName',
            'type' => 'raw',
            'value' => 'CHtml::link(UHtml::markSearch($data,"OrganName"),array("admin/view","id"=>$data->ID))',
        ),
          array(
            'name' => 'Identity',
            'value' => 'Organ::itemAlias("Identity",$data->Identity)',
            'filter' => Organ::itemAlias("Identity"),
        ),
           array(
            'name' => 'Type',
            'value' => 'Organ::itemAlias("usertype",$data->Type)',
           'filter' => Organ::itemAlias("usertype"),
        ),
        array(
            'name' => 'Email',
            'type' => 'raw',
            'value' => 'CHtml::link(UHtml::markSearch($data,"Email"), "mailto:".$data->Email)',
        ),
 	array(
            'name'=>'CreateTime',
            'value'=>'date("Y/m/d H:i:s", $data->CreateTime)',
            'filter' => false,
        ),
// 	'lastvisit_at',
      
        array(
            'name' => 'Phone',
            'value' => '$data->Phone',
        ),
     
        array(
            'name' => 'IsFreeze',
            'value' => 'Organ::itemAlias("freeze",$data->IsFreeze)',
            'filter' => Organ::itemAlias('freeze'),
        ),
    
        array(
            'name' => 'Status',
            'value' => 'Organ::itemAlias("UserStatus",$data->Status)',
            'filter' => Organ::itemAlias("UserStatus"),
        ),
        array(
            'name' => 'AllAddress',
            'value' => 'Area::getCity($data->Province).Area::getCity($data->City).Area::getCity($data->Area).$data->Address',
            'filter' => false,
        ),
	array(
	    'class' => 'bootstrap.widgets.TbButtonColumn',
		'template'=>'{view}{delete}',
		'buttons'=>array
		(
		   'delete' => array
		  (
				'label'=>'移除黑名单',
				'url'=>'Yii::app()->createUrl("/admin/deleteblack", array("id"=>$data->ID))',
			),
),
	),
   
    ),
));
?>
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
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
		url: Yii_baseUrl+'/backend.php/admin/delallblack/',
		type:'post',
		data:{ 
			data: crowid,
			YII_CSRF_TOKEN: $('input[name="YII_CSRF_TOKEN"]').val()  
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