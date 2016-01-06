<table id="temp_dg" class="easyui-datagrid " title="点击表格编辑服务报价记录" rownumbers="true" 
       data-options="iconCls: 'icon-edit', region:'center', fit:true, border:false, singleSelect: true,
       url: '<?php echo Yii::app()->createUrl('servicer/servicemaininfo/templist') ?>',
       method:'get',onClickCell: onClickCell">
    <thead>
        <tr>
            <th data-options="field:'ItemName',width:120,align:'center',editor:{type:'validatebox',options:{required:true}},formatter:formateColor">项目名称</th>
            <th data-options="field:'ItemQuote',width:70,align:'center',editor:{type:'numberbox',options:{precision:1,required:true}}">项目报价</th>
            <th data-options="field:'ItemIntro',width:350,align:'center'">服务说明</th>
            <th data-options="field:'ItemRemove',width:45,align:'center',formatter:formateDel">&nbsp;删除</th>
        </tr>   
    </thead>
</table>
<script type="text/javascript">
    $.extend($.fn.datagrid.methods, {
        editCell: function(jq,param){
            return jq.each(function(){
                var opts = $(this).datagrid('options');
                var fields = $(this).datagrid('getColumnFields',true).concat($(this).datagrid('getColumnFields'));
                for(var i=0; i<fields.length; i++){
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor1 = col.editor;
                    if (fields[i] != param.field){
                        col.editor = null;
                    }
                }
                $(this).datagrid('beginEdit', param.index);
                for(var i=0; i<fields.length; i++){
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor = col.editor1;
                }
            });
        }
    });
    var editIndex = undefined;
    var editfield = undefined;
    function endEditing(){
        if (editIndex == undefined){
            return true
        }
        if ($('#temp_dg').datagrid('validateRow', editIndex)){
            $('#temp_dg').datagrid('endEdit', editIndex);
            editIndex = undefined;
            if(saveChanges()){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }
    function onClickCell(index, field , value){
        if (endEditing()){
            $('#temp_dg').datagrid('selectRow', index).datagrid('editCell', {index:index,field:field});
            editIndex = index;
            editfield = field;
        }
    }
    function saveChanges(){
        var row = $('#temp_dg').datagrid('getSelected');
        var changes = eval("row."+editfield);
        var url = Yii_baseUrl+"/servicer/servicemaininfo/savecell";
        $.getJSON(url,{ID:row.ID,fieldName:editfield,change:changes},function(data){
            if(data){
                $("#temp_dg").datagrid("reload");
                return true;
            }else{
                return false;
            }
        });
    }
    function formateColor(val,row){
        if(row.Status==2){
            return "<font color='red'><b>"+val+"</b></font>";
        }
        else if(row.Status==3){
            return "<font color='red'>"+val+"</font>";
        }
        else{
            return val;
        }
    }
    function formateDel(val,row){
        return "<a href='javascript:;' onclick='delItem("+row.ID+")'>删除</a>";
    }
    function delItem(id){
        if(confirm("您确定要删除该项目吗？")){
            $.post(Yii_baseUrl + "/servicer/servicemaininfo/delitem",{ID:id},function(result){
                if (result.emptyMsg) {
                    $.messager.alert('提示',result.emptyMsg);
                    window.location =Yii_baseUrl+"/servicer/servicemaininfo/index";
                }
                else if (result.errorMsg) {
                    $.messager.show({
                        title: '错误',
                        msg: result.errorMsg
                    });
                }
                else {
                    $.messager.show({
                        title: '成功',
                        msg: result.successMsg
                    });
                    $("#temp_dg").datagrid("reload");
                }
            },'json');
        }
    }
</script>