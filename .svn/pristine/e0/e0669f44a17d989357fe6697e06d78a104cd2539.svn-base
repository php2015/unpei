<?php
$this->pageTitle = Yii::app()->name . ' - 录入配件组';
?>
<!-- 选项页tab -->
<div class='tabs' pre='tab'>
<!-- 	<a class='left-indent'>&nbsp;</a> -->
	<a href="<?php echo Yii::app()->createUrl('jpdata/epcModelTemp/index');?>">车型信息</a>
	<a class='active' href="<?php echo Yii::app()->createUrl('jpdata/epcGroupTemp/index');?>">配件组信息</a>
	<a href="<?php echo Yii::app()->createUrl('jpdata/epcPartTemp/index');?>">配件信息</a>
</div>

<!-- 数据表单 -->
<div class="easyui-layout" id="jp-layout" style="height:500px" >				
    <table id="dg-group" class="easyui-datagrid" style="height:500px"
         data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("jpdata/epcGroupTemp/list"); ?>',
               method:'get',toolbar:'#toolbar-group'">
        <thead>
            <tr>
                <div class="w">
  					<p class="m-top"><span>车&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：</span><select class="select"></select><select class="select m_left"></select><select class="select m_left"></select></p>
   					<p class="m-top"><span>父 配 件 组：</span><select class="select"></select></p>
   					<p class="m-top"><span>配件组 名称：</span><input type="text" class="input"></p>

				</div>
            </tr>    
        </thead>
    </table>
</div>    
<!-- 操作菜单 -->
<div id="toolbar-group" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" 
			onclick="newGroup()">添加</a>
    </div>
</div>
<!-- 弹出层  -->
<?php echo $this->renderPartial('create'); ?>
    
    <style>
.w{ font-size:12px;}
.select{ border:1px solid #ebebeb; height:30px; line-height:30px; width:150px; background fff}
.input{ border:1px solid #ebebeb; background fff;height:30px; line-height:30px;width:150px; }
.m-top{ margin-top:10px}
.m_left{ margin-left:10px}
</style>