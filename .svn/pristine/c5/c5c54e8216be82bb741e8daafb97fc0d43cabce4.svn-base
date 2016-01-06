<div>
    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/servicemaintain/index"); ?>" class="active">保养提醒列表</a>
    </div>
    <div class="easyui-layout"  style="height:500px">				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("servicer/servicemaintain/maintainlist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="MaintainDate" width="50" align="center">保养日期</th>
                    <th field="Content" width="150" align="center">提醒内容</th>
                    <th field="Name" width="100" align="center">车主姓名</th>
                    <th field="Status" width="50" align="center" data-options="formatter:formatColor">状态</th>
                </tr>
            </thead>
        </table>	
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="confirmRemind()">确认</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="cancelRemind()">取消提醒</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="checkRemind()">详情</a>
    </div>
    <div>
        &nbsp;车主姓名: <input class="width98 input" name="Name">
        &nbsp;状态: <select class="width98 select" name="Status">
            <option value="">全部</option>
            <option value="1">待提醒</option>
            <option value="2">已提醒</option>
            <option value="3">取消提醒</option>
        </select>
        &nbsp;保养日期: <input class="easyui-datebox" name="MaintainDate">
        &nbsp;<input class='submit ml10' type='submit' id="search-btn" value='查询'>
    </div>
</div>
<div id="check_dlg" class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px"
     closed="true" buttons="#dlg-check" modal="true">
    <table id="remind" style="margin-bottom:10px;">
        <tr>
            <td align="right" width=60><strong>提醒内容:</strong></td>
            <td name="RemindContent"></td>
        </tr>
    </table>
    <div style="height:270px;width:550px;overflow-y:scroll">
        <table id="maintains" class="easyui-datagrid" data-options="		            
               pagination:true,border:false,rownumbers:true,fitColumns:true,
               fit:true,singleSelect:true,method:'get'">
            <thead>
                <tr>
                    <th field="Name" width="45" align="center">姓名</th>
                    <th field="NickName" width="45" align="center">昵称</th>
                    <th field="FirstRemind" width="60" align="center">第一次提醒时间</th>
                    <th field="SecondRemind" width="60" align="center">第二次提醒时间</th>
                    <th field="MaintainDate" width="50" align="center">保养日期</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="dlg-check">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#check_dlg').dialog('close')">取消</a>
    </div>
</div>
<div id="confirm_dlg" class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px"
     closed="true" buttons="#dlg-confirm" modal="true">
    <table id="content" style="margin-bottom:10px;">
        <tr>
            <td align="right" width=60><strong>提醒内容:</strong></td>
            <td name="RemindContent"></td>
        </tr>
    </table>
    <div style="height:270px;width:550px;overflow-y:scroll">
        <table id="confirms" class="easyui-datagrid" data-options="		            
               pagination:true,border:false,rownumbers:true,fitColumns:true,
               fit:true,singleSelect:false,method:'get',multiple: true">
            <thead>
                <tr>
                    <th field="ID" checkbox=true align="center"></th>
                    <th field="Name" width="45" align="center">姓名</th>
                    <th field="NickName" width="45" align="center">昵称</th>
                    <th field="FirstRemind" width="60" align="center">第一次提醒时间</th>
                    <th field="CurrentDate" width="60" align="center">当前提醒时间</th>
                    <th field="MaintainDate" width="50" align="center">保养日期</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="dlg-confirm">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="confirm-btn" onclick="saveConfirm()">确认</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#confirm_dlg').dialog('close')">取消</a>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/servicer/servicemaintain/maintainlist';
            var name = $("input[name=Name]").val();
            var status = $("select[name=Status]").val();	
            var date = $("input[name=MaintainDate]").val();
            $('#dg').datagrid({ url:url,queryParams:{
                    'name':name,
                    'status':status,
                    'date':date      	
                },method:"get"});
        });		
    });
    function formatColor(val,row)
    {
        if (val == '1'){
            return '<span style="color:red;">待发送</span>';
        } 
        else if (val == '2') {
            return '<span style="color:green;">已发送</span>';
        }
        else {
            return '<span style="color:gray;">取消发送</span>';
        }
    }
    function confirmRemind()
    {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            if (row.State == '待发送') {
                var ID = row.ID.toString();
                var Status = row.Status.toString();
                $('#confirm_dlg').dialog('open').dialog('setTitle','确认保养记录');
                $("td[name=RemindContent]").text(row.RemindContent);
                $('#confirms').datagrid({ 
                    url:Yii_baseUrl + "/servicer/servicemaintain/sendstate",
                    queryParams:{
                        'ID':ID,
                        'Status':Status
                    },
                    method:"post"
                });
            }
            else {
                $.messager.show({
                    title: '警告',
                    msg: '请选择您要确认的保养记录!'
                });
            }
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要确认的保养记录!'
            });
        }
    }
    function saveConfirm()
    {
        $("#confirm-btn").linkbutton('disable');   //点击确认后失效
        var row = $('#dg').datagrid('getSelected');
        var ID = row.ID.toString();
        var MaintainTime = row.MaintainTime.toString();
        var ids=new Array();
        var i=0;
        var url = Yii_baseUrl + "/servicer/servicemaintain/confirmremind";
        $("input[name='ID']:checked").each(function(){
            ids[i]=this.value;
            i++;
        });
        //不勾选则默认全部发送
        if (ids == '') {
            $("input[name='ID']").each(function(){
                ids[i]=this.value;
                i++;
            });
        }
        $.post(url,{ID:ID,MaintainTime:MaintainTime,ids:ids},function(result){
            $("#confirm-btn").linkbutton('enable');   //返回后有效
            if (result.success){
                $('#confirm_dlg').dialog('close'); // close the dialog
                $('#dg').datagrid('reload'); // reload the user data
            } 
            else {
                $.messager.show({
                    title: '错误',
                    msg: result.errorMsg
                });
            }
        },'json');
    }
    function cancelRemind()
    {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            if (row.State == '待发送') {
                $.messager.confirm('确认','您确定取消整条保养提醒记录吗？',function(r){
                    if (r){
                        $.post(Yii_baseUrl + "/servicer/servicemaintain/cancel",{ID:row.ID},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload'); // reload the user data
                            } else {
                                $.messager.show({
                                    title: '错误',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
            else {
                $.messager.show({
                    title: '警告',
                    msg: '请选择您要取消的保养记录!'
                });
            }
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要取消的保养记录!'
            });
        }
    }
    function checkRemind()
    {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            var ID = row.ID.toString();
            var Status = row.Status.toString();
            $('#check_dlg').dialog('open').dialog('setTitle','查看保养记录');
            $("td[name=RemindContent]").text(row.RemindContent);
            $('#maintains').datagrid({ 
                url:Yii_baseUrl + "/servicer/servicemaintain/sendstate",
                queryParams:{
                    'ID':ID,
                    'Status':Status
                },
                method:"post"
            });
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要查看的保养记录!'
            });
        }
    }
</script>