<div id="import-dlg" class="easyui-dialog easyui-layout" style="width:400px;height:200px;padding:10px 20px"
     closed="true" buttons="#dlg-import" modal="true">
    <form id="import_fm" action="" method="post" enctype="multipart/form-data">
        <div style="margin-top: 10px;">	
            <label class='label'>选择模板：</label>	
            <input type="button" class="btn-green" value="导出模板" onclick="exportPrice()">
        </div>
        <div style="margin-top: 10px;">	
            <label class='label'>选择文件：</label>
            <span class='width180 inputfile-input input'>
                <input type="hidden" name="leadExcel" value="true">
                <input type="file" name="inputExcel" class="easyui-validatebox" required="true">
            </span>
            <input class='submit' type='button' value='上 传' onclick="uploadPrice()">
        </div>				
    </form>
    <div id="dlg-import">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#import-dlg').dialog('close')">取消</a>
    </div>
</div>
<script>
    $(document).ready(function(){
        //上传文件名显示
        $("input[type='file']").live('change',function(){
            var inputfile = $(this).closest('.inputfile');
            if(inputfile.length!=0){
                var after = $(inputfile).nextAll('span');
                after.length>0 && after.remove();
                $(inputfile).after('<span style="margin-left:5px;">'+$(this).val()+'</span>')
            }else{
                var inputfile_input = $(this).closest('.inputfile-input');
                if(inputfile_input.length==0){
                    return;
                }
                var before = $(this).prevAll('span');
                before.length>0 && before.remove();
                $(this).before('<span style="margin-left:5px;">'+$(this).val()+'</span>')
            }
        });
    });
    //打开价格导入窗口
    function importPrice()
    {
        $('#import-dlg').dialog('open').dialog('setTitle','客户价格导入');
      //  $('#import_fm').form('clear');
    }
    
    //excel导出
    function exportPrice(){
        var ctype=String($('#ctype').combogrid('getValues'));
        var goodsbrand=$('#goodsbrand').val();
        var standardid=$('#leafCategorysearch').val();
        var rows=$('#goods').datagrid("options").pageSize;
        var page=$('#goods').datagrid("options").pageNumber;
        window.location.href="<?php echo Yii::app()->createUrl('/maker/makeprice/exportprice')?>?&ctype="+ctype+'&goodsbrand='+goodsbrand+'&standardid='+standardid+'&rows='+rows+'&page='+page;
    }
    
   //excel导入
   function uploadPrice(){
       $('#import_fm').form('submit',{
            url: Yii_baseUrl + "/maker/makeprice/importprice",
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                result = eval('('+result+')');
              //  alert(result);return false;
                if(result.success===false)
                {
                    $.messager.alert('提示信息',result.message,'info');
                    $("#goods").datagrid("reload");
                    return false;
//                    $("#prev_goods").datagrid({
//                        url:Yii_baseUrl + '/maker/makegoods/getmakegoodstemp'
//                    });
                }else{
                    $.messager.show({title:'提示信息',msg:result.message});
                    $('#import-dlg').dialog('close');
//                    $('#importgoods_dlg').dialog('open').dialog('setTitle','批量导入商品');
                    $("#goods").datagrid("reload");
                }
            }
        });
   }
</script>