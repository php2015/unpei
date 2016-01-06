<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "品牌管理";
?>

<div class='tabs' pre='tab'>
		<a class='left-indent'>&nbsp;</a>
		<?php echo CHtml::link('商品品牌列表',Yii::app()->createUrl('maker/goodsbrand/index'),array('class'=>'active'))?>
		
</div>
<div style="height: 10px"></div>
        <table id="dg"  class="easyui-datagrid" style="height:480px"
       data-options='url:"<?php  echo Yii::app()->createUrl('maker/goodsbrand/indexdata') ?>",
       region:"center",
       toolbar:"#toolbar" ,
       rownumbers:true,
       fitColumns:false,
       singleSelect:true,
       method:"get",
       pagination:true'
       >
    <thead>
        <tr>   
            <!--<th field="BrandID" width="100" checkbox="true">品牌名称</th>-->    
            <th field="BrandName" width="150">品牌名称</th>    
            <th field="Pinyin" width="100">拼音代码</th>    
            <th field="Number" width="100" align="left">商品数量</th>    
            <th field="Remarks" width="350">品牌描述</th>    

        </tr>    
    </thead>
</table>
<!--    </div>
</div>-->

<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newBrand()">添加</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editBrand()">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyBrand()">删除</a>
</div>
<div id="dlgbrand" class="easyui-dialog" title="添加主营品牌" data-options="iconCls:'icon-save', 'closed':true,'modal':true" style="width:420px;height:240px;padding:10px">
    <form id="fbrand" method="post">
        <p class="form-row">
            <label>品牌名称：</label>
            <!--<input class="easyui-validatebox input" type="text" name="BrandName" data-options="required:true">-->
            <input id="BrandName" type="text" name="BrandName" class=" easyui-validatebox width213 input" data-options="required:true"> 
        </p>
        <div class="display-n showbrand" id="showbrand">
            <table id="tablebrand" style="width:300px">
                <thead>
                    <tr>
                        <th align="left">
                            <!--<input type="checkbox" name="checkAll" id="checkAll">-->
                        </th>
                        <th align="left">品牌</th>
                        <th align="left">拼音代码</th>
                        <th align="left">描述</th>
                    </tr>
                </thead>
                <tbody id="tbody2">
                </tbody>
            </table>
        </div>
        <p class="form-row">
            <label>拼音代码：</label>
            <input id="Pinyin" class="easyui-validatebox input" type="text" name="Pinyin" data-options="required:true"   >
        </p>
        <p class="form-row">
            <label>描&nbsp;&nbsp;&nbsp;&nbsp;述：</label>
            <textarea name="Remarks" style="height:40px; width: 300px;"></textarea>
        </p>
        <div id="dlg-buttons" style="float:right; margin-right: 30px;">
            <a href="javascript:void(0)" class="easyui-linkbutton"  onclick="saveBrand()">保存</a>
            <a href="javascript:void(0)" class="easyui-linkbutton"  onclick="$('#dlgbrand').dialog('close');$('#fbrand').form('clear');">取消</a>
        </div>
    </form>
</div>
<script type="text/javascript">
    $("#BrandName").change(function(){
        var BrandName=$("#BrandName").val();
         var address = Yii_baseUrl+'/maker/goodsbrand/getpinyin';
        $.getJSON(address,{name:BrandName},function(a){
                $("#Pinyin").val(a)
            })
    })
    var url;
    function newBrand(){
        $('#dlgbrand').dialog('open').dialog('setTitle','添加主营品牌');
        $('#fbrand').form('clear');
        url = Yii_baseUrl+"/maker/goodsbrand/edit";
    }
    function editBrand(){
        var rows = $('#dg').datagrid('getSelections');
        if (rows.length==1){
             row = $('#dg').datagrid('getSelected');
            $('#dlgbrand').dialog('open').dialog('setTitle','修改主营品牌');
            $('#fbrand').form('load',row);
            url =Yii_baseUrl+"/maker/goodsbrand/edit/BrandID/"+row.BrandID;
        }else if(rows.length > 1){
            $.messager.alert('提示信息','修改只能选择一条！','error');  
        }else{
            $.messager.alert('提示信息','您还没有选择数据！','error');
        }
    }
    function saveBrand(){
        $('#fbrand').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    //if (result.errorMsg){
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                    $('#dlgbrand').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload');//reload the user data
                } else {
                    $.messager.show({
                        title: '错误信息',
                        msg: result.errorMsg
                    });
                }
            }
        });
    }
    
    function destroyBrand(){
        var row = $('#dg').datagrid('getSelected');
        if(!row){
             $.messager.alert('提示信息','您还没有选择数据！','error');
             return false
        }
        var BrandIDs=row.BrandID;
        if(row.Number>0){
          $.messager.alert('温馨提示', '选择的品牌下有商品不能删除！', 'warning');
              return false    
        }
//        if (row){
//            if(row.Number != 0 && row.Number ){
//                $.messager.alert('温馨提示', '该品牌下有商品不能删除！', 'warning');
//                return false;
//            
//            }
            //console.log(row.ID)
            $.messager.confirm('提示信息','你确定要把选中的数据删除吗？',function(r){
                if (r){
                    var url = Yii_baseUrl+"/maker/goodsbrand/del";
                    $.post(url,{BrandIDs:BrandIDs},function(result){
                        if (result.success){
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                            $('#dg').datagrid('reload'); // reload the user data
                            $('#dg').datagrid('unselectAll');
                        } else {
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                        }
                    },'json');
                }
            });
//        }else{
           
//        }
    }
    //提交
    
</script>
