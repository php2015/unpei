<div class="easyui-layout" id="jp-layout" style="height:500px;">
    <table id="dg"  class="easyui-datagrid"
           data-options="rownumbers:true,
           region:'center',
           fitColumns:true,
           pagination:true,
           singleSelect:false,
           method:'get',
           url:'<?php echo Yii::app()->createUrl('cim/contact/grouplist') ?>',
           toolbar:'#toolbar'" style="height: 500px">
        <thead>
            <tr>
                <th data-options="field:'ck',checkbox:true"></th>
                <th field="GroupName" width="50">群组名称</th>
                <th field="CreateTime" width="50">创建时间</th>
            </tr>
        </thead>
    </table>
</div>
<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">新增</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">删除</a>
</div>

<div id="dlg" class="easyui-dialog" style="width:800px;height:590px;padding:10px 20px"
     closed="true" modal="true" buttons="#dlg-buttons">
    <form id="fm" method="post" > 
        <div class="fitem" style="margin-top:10px">
            <label>群组名称:</label>
            <input name="GroupName" class="easyui-validatebox input " required="true" style="height: 30px;">

        </div>
        <div class="fitem" >
            <label style="margin-top:20px;margin-left:0px;">备&nbsp;&nbsp;&nbsp;&nbsp;注:</label>
            <textarea name="Remark" style="margin-top:20px;width: 598px; height: 108px;" cols="70"></textarea>
        </div>
        <div style="margin-top:20px;"> 添加群成员:</div>
        <div style="margin-top:10px">  
            <?php echo $this->renderPartial('select') ?>
        </div>


    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
</div>

<div id="dlgedit" class="easyui-dialog" style="width:800px;height:590px;padding:10px 20px"
     closed="true" modal="true" buttons="#dlg-buttons">
    <!--           <form id="fm" method="post" novalidate>  -->
    <div class="fitem" style="margin-top:10px">
        <div class="form-list">
            <p class='form-row'>
                <label>群组名称：</label>
                <input name="GroupName" class="easyui-validatebox input" required="true" id='GP' style="height: 30px;">
            </p>
        </div>
    </div>
    <div class="fitem" style="margin-top:10px">
        <label style="margin-top:20px;margin-left:0px;">备&nbsp;&nbsp;&nbsp;&nbsp;注:</label>       
        <textarea name="Remark" id="re" style="margin-top:10px;width:598px;height:108px"></textarea>
    </div>
    <div style="margin-top:20px;"> 添加群成员：</div>
    <div style="margin-top:10px">
        <?php echo $this->renderPartial('editselect') ?>
    </div>
    <!--                   </form>  -->
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="editGroup()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgedit').dialog('close')">取消</a>
</div>
<script type="text/javascript">
    var url;
    function newUser() {
        $('#send_car').datagrid('reload');
        $('#dlg').dialog('open').dialog('setTitle', '新建群组');
        $('#fm').form('clear');
        $('#select2').datagrid('loadData',{
            total:0,
            rows:[]
        });
        url = Yii_baseUrl + "/cim/contact/addgroup";
    }
    function editUser() {
        var row = $('#dg').datagrid('getSelections');
        if(row)
        {
            if (row.length==1) {
                var row = $('#dg').datagrid('getSelected');
                $('#dlgedit').dialog('open').dialog('setTitle', '编辑群组');
                var group= $("#dlgedit").find("input[name=GroupName]").val(row.GroupName);
                $("#dlgedit").find("input[name=GroupName]").validatebox('validate');
                $('#dlgedit').find('textarea[name=Remark]').val(row.Remark);             
                $.ajax({
                    url:"<?php echo Yii::app()->createUrl("cim/contact/editselect") ?>",
                    data:{
                        id: row.ID
                    },
                    type:'get',
                    success:function(result)
                    {
                        $('#selectedit').datagrid({
                            url : Yii_baseUrl + "/cim/contact/editselect?id="+row.ID,
                            columns:[[
                                    //                                { field: 'customertype', title: '客户类型' },
                                    { field: 'name', title: '客户姓名' },
                                    { field: 'customercategory', title: '客户类别' },
                                    { field: 'sex', title: '性别' },
                                    { field: 'companyname', title: '机构名称' },
                                    { field: 'cooperationtype', title: '合作类型' },
                                    //                                 { field: 'phone', title: '手机号码' },
                                    //                                 { field: 'jiapart_ID', title: '嘉配ID' }
                                ]]
                        });
                        $('#sends').datagrid({
                            url : Yii_baseUrl + "/cim/contact/editgroup?id="+row.ID,
                            columns:[[
                                    //                                { field: 'customertype', title: '客户类型' },
                                    { field: 'name', title: '客户姓名' },
                                    { field: 'customercategory', title: '客户类别' },
                                    { field: 'sex', title: '性别' },
                                    { field: 'companyname', title: '机构名称' },
                                    { field: 'cooperationtype', title: '合作类型' },
                                    /*  { field: 'phone', title: '手机号码' },
                                { field: 'jiapart_ID', title: '嘉配ID' } */
                                ]]
                        });
                    }
                });
            }
            else
            {
                $.messager.alert('提示信息','只能勾选一条数据修改','warning');
            }
        }
        else
        {
            $.messager.alert('提示信息','请先勾选要编辑的群组','warning');
        }
    }
   
    function saveUser() {
        var GroupName=$('#dlg input').val();
        var Remark=$('#dlg textarea').val();
        var iddata=$('#iddata').val();
        if(GroupName==''){
            $.messager.alert('提示信息','群组名称不能为空','info');
            return false;
        }
        $.ajax({
            url:"<?php echo Yii::app()->createUrl("cim/contact/addgroup") ?>",
            data:{
                ids:iddata,
                GroupName:GroupName,
                Remark:Remark
            },
            type:'post',
            success:function(result)
            {
                result=eval('('+result+')')
                if (result.data == '1') {
                    $.messager.alert("提示信息", "操作成功");
                    $("#dlg").dialog("close");
                    $("#dg").datagrid("reload");
                }
                else if(result.blank){
                    $.messager.alert('提示信息',result.blank);
                }
                else if(result.only)
                {
                    $.messager.alert('提示信息',result.only);
                }
                else {
                    $.messager.alert("提示信息", "操作失败");
                }
            }
        });
    }
    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('提示信息', '您确定想要删除该数据?', function(r) {
                if (r) {
                    $.get(Yii_baseUrl + "/cim/contact/deletegroup", {id: row.ID}, function(result) {
                        if (result) {
                            $.messager.alert("提示信息", "操作成功");
                            $("#dlg").dialog("close");
                            $("#dg").datagrid("reload");
                           
                        }
                        else {
                            $.messager.alert("提示信息", "操作失败");
                        }
                    }, 'json');
                }
            });
        }else
        {
            $.messager.alert('提示信息','请先勾选要删除的群组','warning');
        }
    }
    $('#dgs').datagrid({
        title: '业务联系人表',
        url: '<?php echo Yii::app()->createUrl('cim/contact/contactlist') ?>',
        width: '600',
        rownumbers: true,
        columns:[[
                { field:'ck',checkbox:true },
                //                { field: 'customertype', title: '客户类型' },
                { field: 'name', title: '客户姓名' },
                { field: 'customercategory', title: '客户类别' },
                { field: 'sex', title: '性别' },
                { field: 'companyname', title: '机构名称' },
                { field: 'cooperationtype', title: '合作类型' },
                //                 { field: 'phone', title: '手机号码' },
                //                 { field: 'jiapart_ID', title: '嘉配ID' }
            ]],
        singleSelect: false,
        selectOnCheck: true,
        checkOnSelect: true,
        onLoadSuccess:function(data){                   
            if(data){
                $.each(data.rows, function(index, item){
                    if(item.checked){
                        $('#dgs').datagrid('checkRow', index);
                    }
                });
            }
        }     
    });
    function editGroup()
    {
        var iddata=$('#iddata').val();
        var groupname=$("#GP").val();
        var remark=$('#re').val();
        var row = $('#dg').datagrid('getSelected');
        $.ajax({
            url: Yii_baseUrl + "/cim/contact/editgroupsave?id="+row.ID,
            type:'POST',
            data:{
                iddata:iddata,
                groupname:groupname,
                remark:remark
            },
            dataType:'json',
            success:function(data){
                if(data.update=='1'){
                    $.messager.alert("提示信息", "操作成功");
                    $("#dlgedit").dialog("close");
                    $("#dg").datagrid("load");
                }
                else if(data.blank){
                    $.messager.alert('提示信息',data.blank);
                }
                else if(data.only){
                    $.messager.alert('提示信息',data.only);
                }
                else{
                    $.messager.alert("提示信息", "操作失败");
                }
            }
        });
    }
</script>
