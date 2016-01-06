<?php echo $this->renderPartial('tabs_active_contacts'); ?>
<div class="easyui-layout" style="height:500px">
    <table id="dgcate" class="easyui-datagrid" style="height:500px"
           data-options="rownumbers:true,
           region:'center',
           fitColumns:true,
           pagination:true,
           singleSelect:false,
           method:'get',
           url:'<?php echo Yii::app()->createUrl('cim/contact/custormercategorylist'); ?>',
           toolbar:'#toolbarcate'" style="height: 500px">
        <thead>
            <tr>
    <!--        	    <th data-options="field:'ck',checkbox:true"></th> -->
                <th field="category" width="50">客户类别</th>
                <th field="create_time" width="50">创建时间</th>
            </tr>
        </thead>
    </table>
    <div id="toolbarcate">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUserCate()">新建</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUserCate()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUserCate()">删除</a>
    </div>
    <div id="dlgcate" class="easyui-dialog" style="width:400px;height:180px;padding:10px 20px"
         closed="true" modal="true" buttons="#dlg-buttons">
        <form id="fmcate" method="post" novalidate>
            <div class="fitem"  style="margin-top: 10px;">
                <label>客户类别:</label>
                <input name="category" class="easyui-validatebox input" style="width:180px;height:30px" required="true">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUserCate()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgcate').dialog('close')">取消</a>
    </div>
</div>
<script type="text/javascript">
    var url;
    function newUserCate() {
        $('#dlgcate').dialog('open').dialog('setTitle', '新增客户类别');
        $('#fmcate').form('clear');
        url = Yii_baseUrl + "/cim/contact/addcustomercate";
    }
    function editUserCate() {
        var row = $('#dgcate').datagrid('getSelections');
        if (row) {
            if(row.length==1)
            {
                var row=$('#dgcate').datagrid('getSelected');
                $('#dlgcate').dialog('open').dialog('setTitle', '编辑客户类别');
                $('#fmcate').form('load', row);
                url = Yii_baseUrl + "/cim/contact/updatecustomercate?id=" + row.id;
            }
            else
            {
                $.messager.alert('提示信息','只能勾选一条数据修改','warning');
            }
            //url = 'update_user.php?id='+row.ID;
        }else
        {
            $.messager.alert('提示信息','请先勾选客户类别','warning');
        }
    }

    function saveUserCate() {
        $('#fmcate').form('submit', {
            url: url,
            onSubmit: function() {
                return $(this).form('validate');
            },
            success: function(result) {
                result=eval('('+result+')');
                console.log(result);
                if (result.data=='1') {
                    $.messager.alert("提示信息", "操作成功");
                    $("#dlgcate").dialog("close");
                    $("#dgcate").datagrid("load");
                }
                else if(result.blank){
                    $.messager.alert("提示信息", result.blank);
                }
                else if(result.only)
                {
                    $.messager.alert("提示信息", result.only);
                }
                else {
                    $.messager.alert("提示信息", "操作失败");
                }
            }
        });
    }
    function destroyUserCate() {
        var row = $('#dgcate').datagrid('getSelected');
        if (row) {
            $.messager.confirm('提示信息', '您确定想要删除该数据?', function(r) {
                if (r) {
                    $.get(Yii_baseUrl + "/cim/contact/deletecustomercate", {id: row.id}, function(result) {
                        if (result) {
                            $.messager.alert("提示信息", "操作成功");
                            $("#dlgcate").dialog("close");
                            $("#dgcate").datagrid("load");
                        }
                        else {
                            $.messager.alert("提示信息", "操作失败");
                        }
                    }, 'json');
                }
            });
        }else
        {
            $.messager.alert('提示信息','请先勾选客户类别','warning');
        }
    }
</script>