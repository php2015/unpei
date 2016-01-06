<style>
    .table th, .table td {
    padding: 2px;
}
  </style>
<?php
$this->breadcrumbs = array(
  '会员列表'=> array('/admin/admin'),
   '管理',
);

$this->menu = array(
    array('label' =>'创建会员', 'icon' => 'plus', 'url' => array('create')),
    array('label' => '管理会员', 'icon' => 'cog', 'url' => array('admin')),
    array('label' => '黑名单列表', 'icon' => 'list', 'url' => array('/admin/blacklist')),
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
<h1><?php echo"会员管理" ?></h1>
<?php
//echo CHtml::link(UserModule::t('更多条件搜索'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
//    $this->renderPartial('_search', array(
//	'model' => $model,
//    ));
    ?>
</div><!-- search-form -->
</p>
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => '创建会员',
    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'small', // null, 'large', 'small' or 'mini'
    'url' => Yii::app()->createUrl('/admin/create')
));
?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => '冻结会员',
    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'small', // null, 'large', 'small' or 'mini'
    'id' => 'freeze',
        //'url'=>Yii::app()->createUrl('user/admin/create')
));
?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => '解冻会员',
    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'small', // null, 'large', 'small' or 'mini'
    'id' => 'unfreeze',
));
?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'id' => 'deleteAll',
    'label' => '批量删除',
    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'small', // null, 'large', 'small' or 'mini'
        //	'url'=>Yii::app()->createUrl('user/admin/create')
));
?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => '加入黑名单',
    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'small', // null, 'large', 'small' or 'mini'
    'id' => 'black',
));
?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php
//$this->widget('bootstrap.widgets.TbButton', array(
//    'label' => '导出用户',
//    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
//    'size' => 'small', // null, 'large', 'small' or 'mini'
//    'id' => 'importout',
//        // 'url'=>Yii::app()->createUrl('/admin/importoutexcel')
//));
?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' =>$model->search(),
    'filter' =>$model,
    'ajaxUpdate' => false, //禁用AJAX分页或排序
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
            'value' => '$data->UserName',
        ),
        array(
            'name' => 'OrganName',
            'type' => 'raw',
            'value' => '$data->organ->OrganName',
        ),
          array(
            'name' => 'Identity',
            'value' => 'Organ::itemAlias("Identity",$data->organ->Identity)',
            'filter' => Organ::itemAlias("Identity"),
        ),
           array(
            'name' => 'Type',
            'value' => 'Organ::itemAlias("usertype",$data->organ->Type)',
             'filter' => Organ::itemAlias("usertype"),
        ),
        array(
            'name' => 'Email',
            'type' => 'raw',
            'value' => '$data->organ->Email',
        ),
         array(
            'name' => 'Recommend',
            'type' => 'raw',
            'value' => '$data->organ->Recommend',
             'filter'=>false
        ),
 	array(
            'name'=>'organ.CreateTime',
            'value'=>'date("Y/m/d H:i:s", $data->organ->CreateTime)',
            'filter' => false,
        ),
// 	'lastvisit_at',
      
        array(
            'name' => 'Phone',
            'value' => '$data->organ->Phone',
        ),
     
        array(
            'name' => 'IsFreeze',
            'value' => 'Organ::itemAlias("freeze",$data->organ->IsFreeze)',
            'filter' => Organ::itemAlias('freeze'),
        ),
    
        array(
            'name' => 'Status',
            'value' => 'Organ::itemAlias("UserStatus",$data->organ->Status)',
            'filter' => Organ::itemAlias("UserStatus"),
        ),
        array(
            'name' => 'organ.AllAddress',
            'value' => 'Area::getCity($data->organ->Province).Area::getCity($data->organ->City).Area::getCity($data->organ->Area).$data->organ->Address',
            'filter' => false,
        ),
       array
(
    'class'=>'CButtonColumn',
    'template'=>'{account}',
    'viewButtonOptions'=>array('title'=>'查看子账户'),
    'buttons'=>array
    (
        'account' => array
        (
           'label'=>'',
            'options'=>array('class'=>'icon-user','title'=>'查看子账户'),
            'visible'=>'true',
            'url'=>'Yii::app()->createUrl("admin/account", array("id"=>$data->ID))',
        ),
    ),
),
        array(
             'header' => '操作',  
            'class' => 'bootstrap.widgets.TbButtonColumn',
             'template'=>'{view}{update}{delete}',
            'buttons'=>array
        (
            'delete' => array
            (
               'label'=>'',
                'visible'=>'true',
               'click'=>'function(){
                          var bool=confirm("您确定要删除吗");
                         if(bool==false)
                         {
                          return false;
                         }
                          $.ajax({
                              url: $(this).attr("href"),
                              type:"POST",
                              data:{YII_CSRF_TOKEN: $("input[name=YII_CSRF_TOKEN]").val()},
                              dataType:"JSON",
                              success:function(data)
                              {
                                if(data.res==0){
                                 alert(data.message);
                                 location.reload;
                                 return false;
                                }else if(data.res==1){
                                   alert("删除成功");
                                   $.fn.yiiGridView.update(
                                   "user-grid"
                                   )
                                   return false;
                                }
                              }
                          })
                          return false;
                        }',
               'url'=>'Yii::app()->createUrl("admin/delete",array("id"=>$data->ID))',
            ),
        ),
        ),
    ),
));
?>
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />  
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog', //弹窗ID  
    // additional javascript options for the dialog plugin  
    'options' => array(//传递给JUI插件的参数  
        'title' => '冻结',
        'autoOpen' => false, //是否自动打开  
        'width' => '600px', //宽度  
        'height' => 'auto', //高度  
        'modal' => true,
//         'buttons'=>array(  
//             '关闭'=>'js:function(){ $(this).dialog("close");}',//关闭按钮  
//         ),  
    ),
));
?> 

<label>请填写冻结原因:</label>
<?php echo CHtml::textArea('remark', '', array('id' => 'remark', 'style' => 'width:500px;height:120px;'));
?>
<?php //echo CHtml::textArea('remark', '','',array('style'=>'width:600px'));?>	<p/>	
<div style="margin-left:200px"><?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'id' => 'submit',
        'type' => 'primary',
        'label' =>'保存',
    ));
    ?>&nbsp;&nbsp;&nbsp;
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'reset',
        'id' => 'cancle',
        'type' => 'primary',
        'label' =>'取消',
    ));
    ?>
</div>


<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
<script type="text/javascript">
    $('#cancle').click(function()
    {
        $('#mydialog').dialog('close');
    });
//冻结
    $('#freeze').click(function()
    {
        var data = new Array();
        $("input:checkbox[name='selectdel[]']:checked").each(function() {
            if (this.value != '') {
                data.push($(this).val());
            }
        });
        var crowid = data.join(',');
        if (crowid == null || crowid.length == 0)
        {
            alert('请勾选要冻结的会员');
            return false;
        }
        var confm = confirm('确定要冻结所选择会员?');
        if (confm == false)
        {
            return false;
        }
        $("#mydialog").dialog("open");
    });
    //导出
    $('#importout').click(function()
    {
        var data = new Array();
        $("input:checkbox[name='selectdel[]']:checked").each(function() {
            if (this.value != '') {
                data.push($(this).val());
            }
        });
        var crowid = data.join(',');
        if (crowid == null || crowid.length == 0)
        {
            alert('请勾选要导出的会员');
            return false;
        }
        var confm = confirm('确定要导出当前用户?');
        if (confm == false)
        {
            return false;
        }
        location.href = Yii_baseUrl + '/backend.php/admin/Importoutexcel/crowid/' + crowid
    });
    //解冻
    $('#unfreeze').click(function() {
        var data = new Array();
        $("input:checkbox[name='selectdel[]']:checked").each(function() {
            if (this.value != '') {
                data.push($(this).val());
            }
        });
        var crowid = data.join(',');
        if (crowid == null || crowid.length == 0)
        {
            alert('请勾选要解冻的会员');
            return false;
        }
        var confm = confirm('确定要解冻所选择的会员?');

        if (confm == false)
        {
            return false;
        }
        $.ajax({
            url: Yii_baseUrl + '/backend.php/admin/unfreeze/',
            type: 'post',
            data: {
                data: crowid,
                YII_CSRF_TOKEN: $('input[name="YII_CSRF_TOKEN"]').val()
            },
            datatype: 'json',
            success: function(data)
            {
                if (data)
                {
                    $.fn.yiiGridView.update('user-grid');
                }
            }
        });

    });
//加入黑名单
    $('#black').click(function() {
        var data = new Array();
        $("input:checkbox[name='selectdel[]']:checked").each(function() {
            if (this.value != '') {
                data.push($(this).val());
            }
        });
        var crowid = data.join(',');
        if (crowid == null || crowid.length == 0)
        {
            alert('请勾选要列入黑名单的会员');
            return false;
        }
        var confm = confirm('确定要列入黑名单?');
        if (confm == false)
        {
            return false;
        }
        $.ajax({
            url: Yii_baseUrl + '/backend.php/admin/black/',
            type: 'post',
            data: {
                data: crowid,
                YII_CSRF_TOKEN: $('input[name="YII_CSRF_TOKEN"]').val()
            },
            datatype: 'json',
            success: function(data)
            {
                if (data)
                {
                    $.fn.yiiGridView.update('user-grid');
                }
            }
        });

    });
    //冻结备注提交
    $('#submit').click(function() {
        var data = new Array();
        $("input:checkbox[name='selectdel[]']:checked").each(function() {
            if (this.value != '') {
                data.push($(this).val());
            }
        });
        var crowid = data.join(',');
        var remark = $('#remark').val();
        $.ajax({
            url: Yii_baseUrl + '/backend.php/admin/freeze',
            type: 'post',
            data: {
                data: crowid,
                remark: remark,
                YII_CSRF_TOKEN: $('input[name="YII_CSRF_TOKEN"]').val()
            },
            datatype: 'json',
            success: function(data)
            {
                if (data)
                {
                    $('#mydialog').dialog('close');
                    $.fn.yiiGridView.update('user-grid');
                }
            }
        });
    })
    //批量删除
    $('#deleteAll').click(function() {
        var data = new Array();
        $("input:checkbox[name='selectdel[]']:checked").each(function() {
            if (this.value != '')
            {
                data.push($(this).val());
            }
        });
        var crowid = data.join(',');
        if (crowid == null || crowid.length == 0)
        {
            alert('请勾选要删除的会员');
            return false;
        }
        var confm = confirm('确定要删除所选择数据?');
        if (confm == false)
        {
            return false;
        }
        $.ajax({
            url: Yii_baseUrl + '/backend.php/admin/deleteall/',
            type: 'post',
            data: {
                data: crowid,
                YII_CSRF_TOKEN: $('input[name="YII_CSRF_TOKEN"]').val()
            },
            datatype: 'json',
            success: function(data)
            {
                if (data)
                {
                    $.fn.yiiGridView.update('user-grid');
                }
            }
        });
    });
    //表单搜索
    $('.search-form form').submit(function() {
        $.fn.yiiGridView.update('user-grid', {
            data: $(this).serialize()
        });
        return false;
    });
</script>
