<style>
    fieldset.import {
        border: 2px solid #D4D4D4;
        margin: 0;
        padding: 5px;
        width: 752px;
        /*overflow-x: scroll;*/
    }
    .importgoodslist{
        width: 2000px;
        /*overflow-x: scroll;*/
    }
    .errcolor{
        color: red;
    }
</style>
<!--商品详情弹框开始-->
<!--弹出上传商品的对话框-->

<div id="openimportdlg" modal=true class="easyui-dialog" style="width:450px;height:230px;padding:10px" closed="true" buttons="#import-buttons">
    <fieldset class="import" style="width:370px;height: 90px;"> 
        <legend>导入商品</legend> 
        <form id="form_importgoods" action="<?php // echo Yii::app()->createUrl('maker/makegoods/uploadgoods');    ?>" method="post" enctype="multipart/form-data">
            <!--<div class='btn-green'>上传</div>-->
            <p class="form-row">
                <label class='label'>　　选择文件：</label>
                <span class='width195 inputfile-input input'>
                    <input type="hidden" name="leadExcel" value="true">
                    <input type="file" name="inputExcel" id="uploadify_goods" class="easyui-validatebox"  required="true" >
                </span>
            </p>
            <div class="form-row">
                <label class='label'>选择配件品类：</label>
                <?php echo CHtml::dropDownlist('importCategory', '', $category, array('class' => 'width277 select  easyui-validatebox', 'required' => true));
                ?>
            </div>
            <input type="hidden" onclick="form_importgoods()" id="submit_importgoods" type='button'>
        </form>
        <div style="padding-left:10px;padding-top:10px;font-size:16px;font-weight:bold"><?php echo CHtml::link('点击下载模板', array('/maker/standardparams/index')) ?></div>
    </fieldset>

</div>
<div id="import-buttons">
    <a href="javascript:void(0)" class="btn-green" iconCls="icon-ok"  onclick="supost()" id="supost">上传</a>
    <a href="javascript:void(0)" class="btn" iconCls="icon-cancel" onclick="$('#openimportdlg').dialog('close');">取消</a>
    <!--    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="supost()">上传</a>
        <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#openimportdlg').dialog('close');">关闭</a>-->
</div>

<div id="importgoods_dlg" modal=true class="easyui-dialog" style="width:800px;height:400px;padding:10px" closed="true" buttons="#detail-buttons">

    <fieldset class="import"> 
        <legend>导入商品预览列表</legend> 
        <table id="prev_goods" style="height:305px"  class="easyui-datagrid " title="点击表格编辑商品" 
               rownumbers="true" data-options="iconCls: 'icon-edit', region:'center', 
               fit:true, border:false, singleSelect: true,
               method:'get',onClickCell: onClickCell, toolbar:'#makepretoolbar'">
            <thead>
                <tr>
                    <th data-options="field:'goods_id',checkbox:true">序号</th>
                    <th data-options="field:'goods_no',width:60,editor:'text'">商品编号</th>
<!--                     <th data-options="field:'goods_name',width:60,editor:'text'">商品名称</th> -->
                    <th field="goods_name" width="60" editor="{type:'validatebox',options:{required:true}}">商品名称</th>
                    <th data-options="field:'brand',width:60,editor:'text'">品牌</th>
                    <th data-options="field:'cate',width:60,editor:'text'">配件品类</th>
                    <th data-options="field:'benchmarking_brand',width:60,editor:'text'">标杆品牌</th>
                    <th data-options="field:'benchmarking_sn',width:60,editor:'text'">标杆商品号</th>
<!--                     <th data-options="field:'marketprice',width:60,editor:'text',validtype='price'">市场价</th> -->
                    <th field="marketprice" width="60" editor="{type:'validatebox',options:{validType:'price',required:true}}">市场价</th>
                    <th field="salesprice" width="60" editor="{type:'validatebox',options:{validType:'price',required:true}}">销售价</th>
                    <th field="discountprice" width="60" editor="{type:'validatebox',options:{validType:'price'}}">优惠价</th>
                    <th data-options="field:'inventory',width:60,editor:'text'">库存</th>
                    <th data-options="field:'senddays',width:60,editor:'text'">发货天数</th>
                    <th data-options="field:'description',width:120,editor:'text'">备注</th>
               <!--       <th data-options="field:'goods_id',width:60,editor:'text'">参数</th>-->
<!--                    <th field="MobPhone" width="100" editor="{type:'numberbox',options:{validType:'mobile',required:true}}">手机</th>
                    <th data-options="field:'CompanyType',width:80">机构类别</th>
                    <th field="Email" width="100" editor="{type:'validatebox',options:{validType:'email',require:true}}">邮箱</th>-->
                </tr>   
            </thead>
        </table>
    </fieldset>
</div>
<div id="detail-buttons">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-ok" onclick="importgoods()">导入</a><!--onclick="$('#importgoods_dlg').dialog('close');"-->
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="close_importgoods_dlg()" >关闭</a>
</div>
<div id="makepretoolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="Deleteprev()">删除</a>
</div>
<div id="showErr" class="easyui-dialog">
    <div id="showErrMsg" style="margin: 5px">

    </div>
</div>
<script>
    //获得焦点
    //function t1onfocus(){
    //     $("#uploadify_goods").trigger("click");
    //     $("#uploadify_goods").blur();
    //}
    function supost(){
        $("#submit_importgoods").trigger("click");
    }
    // 删除预览商品
    function Deleteprev(){
        var row=$('#prev_goods').datagrid('getSelected');
        if(row)
        {
            $.messager.confirm('提示信息','您确定要删除选择的商品?',function(r){
                if(r)
                {
                    var url=Yii_baseUrl+'/maker/makegoods/deleteprev';
                    $.ajax({
                        url: url,
                        type:'get',
                        data:{ goodsID: row.goods_id},
                        dataType:'json',
                        success:function(data)
                        {
                            if(data)
                            {
                                $.messager.show({title:'提示信息',msg:'删除成功'});
                                $('#prev_goods').datagrid('reload');
                            }
                        }
                    });
                }
            })
        }
        else
        {
            $.messager.alert('提示信息','请先勾选要删除的商品','info');
            return false;
        }
	
    }


    function form_importgoods()
    {
       
        // 	$.messager.confirm('提示信息','您确定要保存?',function(r){
        // 		if(r){
        if($('#form_importgoods').form('validate'))
        {
                $("#supost").attr("onclick",'');  
        }
        $('#form_importgoods').form('submit',{
            url: Yii_baseUrl + "/maker/makegoods/uploadgoods",
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                $("#supost").attr("onclick",'supost()'); 
                result = eval('('+result+')');
                if(result.success)
                {
                    $.messager.alert('提示信息',result.message,'info');
                    $("#goods").datagrid("reload"); 
                    return false;
                }else{
                    //                    $.messager.show({title:'提示信息',msg:result.message});
                    $("#showErr").dialog({closed:false});
                    var html="";
                    if(typeof(result.message)=='string')
                    {
                        html=html+"<span class='errcolor'>"+result.message+"</span><br>";
                    }
                    else
                    {
                        $.each(result.message,function(key,val){
                            html=html+"<span class='errcolor'>"+val+"</span><br>";
                        });
                    }
                    $("#showErrMsg").html(html);
                    $('#openimportdlg').dialog('close');
                    //                    $('#importgoods_dlg').dialog('open').dialog('setTitle','批量导入商品');
                    $("#goods").datagrid("reload");
                    //                    $("#prev_goods").datagrid({
                    //                        url:Yii_baseUrl + '/maker/makegoods/getmakegoodstemp'
                    //                    });
                }
            }
        });
    }
    
    function openimportdlg(){
        $('#importgoods_dlg').dialog('open').dialog('setTitle','预览批量导入商品');
       
    }
    // 打开导入商品窗口
    function openimportgoods(){
        $('#openimportdlg').dialog('open').dialog('setTitle','批量导入商品');
    }
    // 把预览数据导入到商品表
    function importgoods(){
        // 验证数据通过，则导入到商品表
        var import_url = Yii_baseUrl + "/maker/makegoods/importgoods";
        var data = '';
        $.getJSON(import_url,data,function(result){
            // console.log(result);
            if(result.success){
                $('#importgoods_dlg').dialog('close');
                $('#goods').datagrid('reload');
                $.messager.show({
                    title: '提示信息',
                    msg: result.errMsg
                });
                // setIimeOut(window.open(Yii_baseUrl+"/maker/makegoods/index", '_self'),600);
                //window.open(Yii_baseUrl+"/maker/makegoods/index", '_self');
            }else{
                $.messager.show({
                    title: '提示信息',
                    msg: result.errMsg
                });
            }
        })
    }
    
    // 关闭预览窗口
    function close_importgoods_dlg(){
        $.messager.confirm('提示消息', '你确定要关闭吗？关闭后导入的数据不会上传', function(r){  
            if (r){  
                var delUrl = Yii_baseUrl + "/maker/makegoods/deletemakegoodstemp"
                $.getJSON(delUrl, function(result){
                    if(result.success){
                        $('#importgoods_dlg').dialog('close');
                        $('#goods').datagrid('reload');
                        $.messager.show({
                            title: '提示信息',
                            msg: result.errMsg
                        });
                        $('#importgoods_dlg').dialog('close');
                    }else{
                        $.messager.show({
                            title: '提示信息',
                            msg: result.errMsg
                        });
                    }
                })
            }  
        });  
        
        
    }

    
    $(document).ready(function(){
        $("#showErr").dialog({
            width:300,
            height:250,
            modal:true,
            closed:true,
            title:'错误提示'
        });
        //上传文件名显示
        $("input[type='file']").on('change',function(){
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
</script>

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
        if ($('#prev_goods').datagrid('validateRow', editIndex)){
            $('#prev_goods').datagrid('endEdit', editIndex);
            editIndex = undefined;
            //	console.log($('#prev_goods').datagrid('getSelected'));
			
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
            $('#prev_goods').datagrid('selectRow', index).datagrid('editCell', {index:index,field:field});
            editIndex = index;
            editfield = field;
        }
    }
    function saveChanges(){
        var rs = $('#prev_goods').datagrid('getSelected');
        var changes = eval("rs."+editfield);
        var url = Yii_baseUrl+"/maker/makegoods/savecell";
        $.getJSON(url,{ID:rs.goods_id,fieldName:editfield,change:changes},function(data){
            if(data){
                return true;
            }else{
                return false;
            }
		
        });
    }

    
</script>
