<div>
    <div class="tabs" pre="tab">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("cim/logistics/index"); ?>" class="active">物流配送管理</a>

    </div>
    <div class="easyui-layout" id="jp-layout" style="height:500px" >				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="iconCls: 'icon-edit',region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:false,
               url:'<?php echo Yii::app()->createUrl("cim/logistics/Getlogisticslist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th data-options="field:'ID',checkbox:true"></th>
                    <th field="CreateTime" width="15" align="center" >创建时间</th>
                    <th field="Company" width="20" align="center">物流公司</th>
                    <th field="Description" width="20" align="center">物流描述</th>
                    <th field="Address" width="25" align="center" >配送地区</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newLogistics()">添加</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editLogistics()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="delLogistics()">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="checkDetails()">详情</a>
    </div>
</div>
<?php $this->renderPartial('tianjia'); ?>