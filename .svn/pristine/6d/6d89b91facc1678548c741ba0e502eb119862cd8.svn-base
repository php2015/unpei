<div>
    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("maker/makeprice/index"); ?>" class="active">客户类别管理</a>
        <?php if($count>0):?>
        <a href="<?php echo Yii::app()->createUrl("maker/makeprice/price"); ?>">客户价格管理</a>
        <?php else:?>
        <a href="<?php echo Yii::app()->createUrl("maker/makeprice/price"); ?>" onclick="alert('请至少设置一个客户类别');return false;">客户价格管理</a>
        <?php endif;?>
    </div>
    <div class="easyui-layout" id="jp-layout" style="height:500px" >				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("maker/makeprice/typelist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="TypeName" width="35" align="center">类别名称</th>
                    <th field="TypeDesc" width="80" align="center">描述</th>
                    <th field="TypeQuantity" width="35" align="center">客户数</th>
                    <th field="Default" width="35" align="center">是否默认</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newType()">添加</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editType()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyType()">删除</a>
        <input type="hidden" name="count" value="<?php echo $count; ?>">    <!-- 当前机构下客户类别数量 -->
    </div>
</div>
<div id="type_dlg" class="easyui-dialog easyui-layout" style="width:480px;height:250px;padding:10px 20px"
     closed="true" buttons="#dlg-type" modal="true">
    <form id="type_fm" method="post" novalidate>		
        <table class="dttable">
            <tr class="fitem" style="height:30px;">
                <td align="right">类别名称:</td>
                <td><input name="TypeName" class="easyui-validatebox input" required="true"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">描述:</td>
                <td><textarea name="TypeDesc" class="textarea" cols="50" rows="4"></textarea></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">是否默认:</td>
                <td>
                    <label for="IsDefault"><input type="radio" id="IsDefault" name="IsDefault" value="1">&nbsp;是</label>
                    <label for="noDefault" style="margin-left: 10px;"><input type="radio" id="noDefault" name="IsDefault" value="0">&nbsp;否</label>
                </td>
            </tr>
        </table>						
    </form>
    <div id="dlg-type">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="save-btn">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#type_dlg').dialog('close')">取消</a>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //保存
        $("#save-btn").click(function(){
            var count = $("input[name=count]").val();
            var defaults = $("input[type=radio]:checked").val();
            if(count == 0){         //第一次添加客户类别，客户类别一定是默认客户类别
                saveAll();
            } else{                 //已添加多个客户类别
                if(defaults == 1){  //默认客户类别
                    $.messager.confirm("提示", "默认客户类别已存在，是否重置默认客户类别？", function(r){
                        if(r){
                            saveAll();
                        }
                    });
                }else{              //非默认客户类别
                    saveAll();
                }
            }
        });
    });
    var url;
    function newType(){
        $('#type_dlg').dialog('open').dialog('setTitle','添加客户类别');
        $('#type_fm').form('reset');
        //设置添加第一条客户类别数据为默认类别
        var count = $("input[name=count]").val();
        if(count == 0){
            $("input[type=radio]:first").attr("checked",true);
            $("input[type=radio]").attr("disabled", true);
        }else{
            $("input[type=radio]:last").attr("checked",true);
            $("input[type=radio]").attr("disabled", false);
        }
        $("#save-btn").linkbutton('enable');
        url = Yii_baseUrl + "/maker/makeprice/addtype";
    }
    function editType(){
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#type_dlg').dialog('open').dialog('setTitle','编辑客户类别');
            $('#type_fm').form('load',row);
            //默认客户类别不能取消默认，只能修改其他类别为默认替换这个条默认数据的默认状态
            if(row.IsDefault == 1) {
                $("input[type=radio]").attr("disabled", true);
            } else {
                $("input[type=radio]").attr("disabled", false);
            }
            $("#save-btn").linkbutton('enable');
            url = Yii_baseUrl + "/maker/makeprice/edittype/ID/"+row.ID.toString();
        }
        else {
            $.messager.alert('提示',"请选择您要修改的客户类别信息!",'warning');
        }
    }
    function saveAll(){
        var desc = $("textarea[name=TypeDesc]").val();
        if(desc.length > 64){
            $("textarea[name=TypeDesc]").addClass("validatebox-text validatebox-invalid");
            $("textarea[name=TypeDesc]").attr('title','该输入项最大输入64位字符');
            return false;
        }else{
            $("textarea[name=TypeDesc]").removeClass("validatebox-text validatebox-invalid");
        }
        $('#type_fm').form('submit',{
            url: url,
            onSubmit: function(){
                if($(this).form('validate')==true){
                    $("#save-btn").linkbutton('disable'); 
                    return $(this).form('validate');
                }
                else{
                    $("#save-btn").linkbutton('enable');
                    return $(this).form('validate');
                }
            },
            success: function(result){
                var result = eval('('+result+')');
                $("#save-btn").linkbutton('enable');
                if (result.errorMsg){
                    $.messager.alert('错误',result.errorMsg,'error');
                } else {
                    window.location.reload();
                }
            }
        });
    }
    function destroyType()
    {
        var row = $("#dg").datagrid("getSelected");
        var returns = "false";
        if (row) {
            if(row.TypeQuantity == 0){
                if(row.IsDefault != 1){
                    $.messager.confirm('确认','您确定要删除这个客户类别吗？',function(r){
                        if (r) {  
                            $.post(Yii_baseUrl + "/maker/makeprice/destorytype",{ID:row.ID},function(result){
                                if (result.errorMsg) {
                                    $('#dg').datagrid('reload');
                                    $.messager.alert('错误',result.errorMsg,'error');
                                }
                                else {
                                    window.location.reload();
                                }
                            },'json');
                        }
                    });
                }
                else{
                    $.messager.alert('提示',"该客户类别为默认客户类别，暂时无法删除!",'warning');
                }
            }
            else{
                $.messager.alert('提示',"该客户类别有对应客户，暂时无法删除!",'warning');
            }
        }
        else {
            $.messager.alert('提示',"请选择你要删除的客户类别!",'warning');F
        }
    }
</script>