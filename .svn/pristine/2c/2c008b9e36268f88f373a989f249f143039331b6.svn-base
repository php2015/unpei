<?php
$this->pageTitle = Yii::app()->name . ' - 录入车型';
?>
<!-- 选项页tab -->
<div class='tabs' pre='tab'>
	<a class='left-indent'>&nbsp;</a>
	<a class='active' href="<?php echo Yii::app()->createUrl('jpdata/epcModelTemp/index');?>">车型信息</a>
	<a href="<?php echo Yii::app()->createUrl('jpdata/epcGroupTemp/index');?>">配件组信息</a>
	<a href="<?php echo Yii::app()->createUrl('jpdata/epcPartTemp/index');?>">配件组信息</a>
</div>

<!-- 数据表单 -->
<div class="easyui-layout" id="model-layout" style="height:500px" >				
    <table id="dg-model" class="easyui-datagrid" style="height:500px"
         data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("jpdata/epcModelTemp/list"); ?>',
               method:'get',toolbar:'#tb-model'">
        <thead>
            <tr>
                <?php foreach(EpcModelTemp::attributeFields('list') as $field=>$fieldLabel): ?>
                <th width="<?php echo ($field=='createTime')?'80':'50';?>" field="<?php echo $field; ?>"><?php echo $fieldLabel; ?></th>    
                <?php endforeach;?>
            </tr>    
        </thead>
    </table>
</div>    
<!-- 操作菜单 -->
<div id="tb-model" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newModel()">添加</a>
    </div>
</div>
<!-- 弹出层  -->
<?php echo $this->renderPartial('create'); ?>