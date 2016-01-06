<?php $actionID = $this->getAction()->getId(); ?>
<?php 
if($actionID=='empowerdealer'){
    $key="emp";
    $actionID="empdea";
}else if($actionID=='empowercate'){
    $key="emca";
}else if($actionID=='contacts'){
    $key="cont";
}
?>
<div class="easyui-layout" id="jp-layout" style="height:500px">				
    <table id="dg" style="height:500px"> </table>	
</div>
<div id="tb" style="height:auto">
    <a href="<?php echo Yii::app()->createUrl('maker/makemarketing/add'.$actionID) ?>" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true">添加</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" key="<?php echo $key;?>" id='delAll'>删除</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" id='modify'>编辑</a>
</div>
<?php include 'makerjs.php'; ?>