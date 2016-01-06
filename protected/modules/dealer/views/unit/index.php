<div>
    <div class='tabs' pre='tab'>
        <a class='left-indent'>&nbsp;</a>
        <a class="active" href="<?php echo Yii::app()->createUrl('dealer/unit/index'); ?>">单位管理</a>
    </div>



    <div class="easyui-layout" id="jp-layout" style="height:500px" >				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="
               iconCls: 'icon-edit',
               singleSelect: true,
               toolbar: '#toolbar',
               url: '<?php echo Yii::app()->createUrl('dealer/unit/getunit') ?>',
               method: 'get',
               rownumbers:true,
               pagination:true,
               onDblClickRow: onDblClickRow

               ">
            <thead>
                <tr>


                    <th data-options="field:'UnitName',width:120,editor:{
                        type:'validatebox',
                        options:{
                        required:true
                        }
                        }">单位名称</th>

                    <th data-options="field:'UnitMemo',width:460, editor:'text'">单位说明</th>

                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="append()">添加</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="reload()">刷新</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="save()">保存</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="del()">删除</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    var editIndex = undefined;
    var add = 0;
    $('#dg').datagrid({
        onLoadSuccess:function(data)
        {
            add=0;
        }
    })
    function endEditing(){
        if (editIndex == undefined){return true}
        if ($('#dg').datagrid('validateRow', editIndex)){
            $('#dg').datagrid('endEdit', editIndex);
            editIndex = undefined;
            return true;
        } else {
            return false;
        }
    }
    function onDblClickRow(index){
        if(add==1){
            $('#dg').datagrid('rejectChanges');
            editIndex = undefined;
            add=0;
        }
        if(add==2){
            if (endEditing()){
                var row =$('#dg').datagrid('getChanges',"updated");
                console.log(row);
                if(row.length != 0){
                    var url="<?php echo Yii::app()->createUrl('dealer/unit/save') ?>";
                    $.getJSON(url,{
                        id:row[0].id,
                        UnitName:row[0].UnitName,
                        UnitMemo:row[0].UnitMemo
                    },function(data){
                        if(data){
                            $.messager.show({title:'提示信息',msg:'修改成功'});
                            //$("#dg").datagrid("reload");
                            return true;
                        }else{
                            $.messager.show({title:'提示信息',msg:'修改失败'});
                            $("#dg").datagrid("reload");
                            return false;
                        }
                    });   
                }                    
            }
            
        }
        if (editIndex != index){
            if (endEditing()){
                $('#dg').datagrid('selectRow', index)
                .datagrid('beginEdit', index);
                editIndex = index;
            } else {
                $('#dg').datagrid('selectRow', editIndex);
            }
        }
        add = 2;
    }
    function append(){
        if(add==1){
            endEditing();
            var row=$('#dg').datagrid('getSelected');
            //    console.log(row);
            if(row==null || row.UnitName==''){
                // $.messager.show({title:'提示信息',msg:'单位名称不能为空'});
                //$("#dg").datagrid("reload"); 
                // add=0;
                return false;
            }
            if (endEditing()){
                var url="<?php echo Yii::app()->createUrl('dealer/unit/add') ?>";
                $.getJSON(url,{
                    UnitName:row.UnitName,
                    UnitMemo:row.UnitMemo
                },function(data){
                    if(data){
                        if(data.success==9){
                            $.messager.show({title:'提示信息',msg:data.errorMsg});
                            $("#dg").datagrid("reload");
                            return false;
                        }else if(data.success == 1){
                            $.messager.show({title:'提示信息',msg:data.errorMsg});
                            add=0;
                            appendadd();
                        }else if(data.success == 0){
                            $.messager.show({title:'提示信息',msg:data.errorMsg});
                            $("#dg").datagrid("reload");
                        }      
                    }else{
                        return false;
                    }
                });  	
            }       
        }else{
            appendadd();
        }

    }
    function appendadd(){
        if(add==2){
            $('#dg').datagrid('rejectChanges');
            editIndex = undefined;
            add=0;
        }else if(add==0){
            $('#dg').datagrid('appendRow',{UnitName:''});
            editIndex = $('#dg').datagrid('getRows').length-1;
            $('#dg').datagrid('selectRow', editIndex)
            .datagrid('beginEdit', editIndex);
            add = 1;
        }
    }
    function reload(){
        $("#dg").datagrid("reload");
    }
    function save(){
        if(add==1){
            endEditing();
            var row=$('#dg').datagrid('getSelected');
            //    console.log(row);
            if(row==null || row.UnitName==''){
                // $.messager.show({title:'提示信息',msg:'单位名称不能为空'});
                //$("#dg").datagrid("reload"); 
                // add=0;
                return false;
            }
            if (endEditing()){
                var url="<?php echo Yii::app()->createUrl('dealer/unit/add') ?>";
                $.getJSON(url,{
                    UnitName:row.UnitName,
                    UnitMemo:row.UnitMemo
                },function(data){
                    if(data){
                        if(data.success==9){
                            $.messager.show({title:'提示信息',msg:data.errorMsg});
                            $("#dg").datagrid("reload");
                            return false;
                        }else if(data.success == 1){
                            $.messager.show({title:'提示信息',msg:data.errorMsg});
                        }else if(data.success == 0){
                            $.messager.show({title:'提示信息',msg:data.errorMsg});
                            $("#dg").datagrid("reload");
                        }
                                   
                        return true;
                    }else{
                        return false;
                    }
                });  	
            }       
        }else if(add==2){ 
            if (endEditing()){
                var row=$('#dg').datagrid('getSelected');
                var url="<?php echo Yii::app()->createUrl('dealer/unit/save') ?>";
                $.getJSON(url,{
                    id:row.id,
                    UnitName:row.UnitName,
                    UnitMemo:row.UnitMemo
                },function(data){
                    if(data){
                        $.messager.show({title:'提示信息',msg:'修改成功'});
                        return true;
                    }else{
                        $.messager.show({title:'提示信息',msg:'修改失败'});
                        $("#dg").datagrid("reload");
                        return false;
                    }
                });                       
            }
        }else{
            // alert('请选择添加或修改操作')
        }
        add=0;   
    }
    function del(){
        var row=$('#dg').datagrid('getSelected');
        if(row==null){
            $.messager.show({title:'提示信息',msg:'请选择一行数据'});
            return false;
        }
        if(row.UnitName==''){
            $.messager.show({title:'提示信息',msg:'删除成功'});
            $("#dg").datagrid("reload");
            return true;
        }
        var url="<?php echo Yii::app()->createUrl('dealer/unit/del') ?>";
        $.getJSON(url,{ID:row.id},function(data){
            if(data){
                $.messager.show({title:'提示信息',msg:'删除成功'});
                $("#dg").datagrid("reload");
                return true;
            }else{
                $.messager.show({title:'提示信息',msg:'删除失败'});
                return false;
            }
        });  
    }
</script>