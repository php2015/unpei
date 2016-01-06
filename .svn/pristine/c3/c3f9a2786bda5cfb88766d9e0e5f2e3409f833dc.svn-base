<div>
    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/servicemaininfo/index"); ?>" class="active">服务报价列表</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/servicemaininfo/maininfo"); ?>">主营类别管理</a>
    </div>
    <div class="easyui-layout"  style="height:500px">				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("servicer/servicemaininfo/quotelist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="ItemNums" width="65" align="center">项目编号</th>
                    <th field="ItemNames" width="80" align="center">项目名称</th>
                    <th field="ItemQuote" width="50" align="center" data-options="formatter:formatColor">项目报价</th>
                    <th field="ItemExplan" width="150" align="center">服务说明</th>
                </tr>
            </thead>
        </table>	
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        &nbsp;项目编号: <input class="width98 input" name="ItemNum">
        &nbsp;项目名称: <input class="width98 input" name="ItemNames">
        &nbsp;<input class='submit ml10' type='submit' id="search-btn" value='查询'>
    </div>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addQuote()">添加</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editQuote()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destoryQuote()">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="importQuote()">批量导入</a>
        <span class="error-msg" style="border:0px;display: none;">
            <?php echo $message; ?>
        </span>
    </div>
</div>
<div id="quote_dlg" class="easyui-dialog easyui-layout" style="width:480px;height:250px;padding:10px 20px"
     closed="true" buttons="#dlg-quote" modal="true">
    <form id="quote_fm" method="post" novalidate>		
        <table class="dttable">
            <tr class="fitem" style="height:30px;">
                <td align="right">项目名称:</td>
                <td><input name="ItemName" class="easyui-validatebox input" required="true"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">项目报价:</td>
                <td><input name="ItemQuote" class="easyui-validatebox input" required="true"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">服务说明:</td>
                <td><textarea name="ItemIntro" class="textarea" cols="50" rows="4"></textarea></td>
            </tr>
            <input type="hidden" name="itemID" value="">
        </table>						
    </form>
    <div id="dlg-quote">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="save-btn" onclick="saveAll()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#quote_dlg').dialog('close')">取消</a>
    </div>
</div>
<div id="import-dlg" class="easyui-dialog easyui-layout" style="width:400px;height:200px;padding:10px 20px"
     closed="true" buttons="#dlg-import" modal="true">
    <form id="import_fm" action="<?php echo Yii::app()->createUrl('servicer/servicemaininfo/import'); ?>" method="post" enctype="multipart/form-data">
        <div style="margin-top: 10px;">	
            <label class='label'>选择模板：</label>	
            <a class="btn-green" href="<?php echo Yii::app()->theme->baseUrl; ?>/template/service_items_template.xls">下载模板</a>
        </div>
        <div style="margin-top: 10px;">	
            <label class='label'>选择文件：</label>
            <span class='width180 inputfile-input input'>
                <input type="hidden" name="leadExcel" value="true">
                <input type="file" name="inputExcel" class="easyui-validatebox" required="true">
            </span>
            <input class='submit' type='submit' value='上传'>
        </div>				
    </form>
    <div id="dlg-import">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#import-dlg').dialog('close')">取消</a>
    </div>
</div>
<!-- 判断是否有批量上传推荐名录 -->
<?php if (isset($_GET['success']) && $_GET['success'] == TRUE): ?>
    <div id="temp_dlg" class="easyui-dialog easyui-layout" title="导入的服务项目" style="width:640px;height:400px;" 
         modal='true' data-options="iconCls: 'icon-save',
         buttons: [{
         text:'导入',
         iconCls:'icon-ok',
         id:'importitems',
         },{
         text:'取消',
         iconCls:'icon-cancel',
         id:'cancelitems'
         }]">
             <?php $this->renderPartial('templist'); ?>
    </div>
<?php endif; ?>
<script type="text/javascript">
    var msg = $.trim($(".error-msg").text());
    if(msg.length > 0){
        $.messager.show({
            title: '提示信息',
            msg: "<span color='red'>"+msg+"</span>"
        });
    }
    $(function(){
        // 导入
        $("#importitems").click(function(){
            $("#importitems").linkbutton('disable');    //点击导入后失效
            var url = Yii_baseUrl + "/servicer/servicemaininfo/importitem";
            $.getJSON(url,function(data){
                $("#importitems").linkbutton('enable');    //返回后有效
                if(data.error){  //导入失败
                    $.messager.alert('错误',data.errorMsg,"info");
                    $('#temp_dg').datagrid('reload')
                }else{	//导入成功
                    $.messager.show({
                        title: '提示',
                        msg: data.errorMsg
                    });
                    $('#temp_dg').datagrid('reload');
                    window.location =Yii_baseUrl+"/servicer/servicemaininfo/index";
                }
            });
        });
        // 删除--点击取消
        $("#cancelitems").click(function(){
            $.messager.confirm('提示', '您确定要取消吗？', function(r){  
                if (r){
                    var url = Yii_baseUrl + "/servicer/servicemaininfo/destoryitem";
                    $.getJSON(url,function(data){
                        if(data){
                            $.messager.alert('提示',"上传已取消","info");
                            window.location =Yii_baseUrl+"/servicer/servicemaininfo/index";
                        }else{
                            $.messager.alert('提示',"<span  class='color-red'>对不起，取消数据失败！请联系管理员。</span>",'info');
                        }
                    });
                }
            });
        });
        // 删除--点击关闭
        $(".panel-tool-close").click(function(){
            var url = Yii_baseUrl + "/servicer/servicemaininfo/destoryitem";
            $.getJSON(url,function(data){
                if(data){
                    window.location =Yii_baseUrl+"/servicer/servicemaininfo/index";
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/servicer/servicemaininfo/quotelist';
            var num = $("input[name=ItemNum]").val();
            var name = $("input[name=ItemNames]").val();
            $('#dg').datagrid({ url:url,queryParams:{
                    'num':num,
                    'name':name   	
                },method:"get"});
        });
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
    function formatColor(val,row)
    {
        return '<span style="color:red;">￥'+val+'</span>';
    }
    var url;
    function addQuote()
    {
        $('#quote_dlg').dialog({closed:false,title:'添加服务信息'});
        $('#quote_fm').form('clear');
        $("#save-btn").linkbutton('enable');    //保存按钮有效
        url = Yii_baseUrl + "/servicer/servicemaininfo/add";
    }
    function editQuote()
    {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#quote_dlg').dialog('open').dialog('setTitle','编辑服务信息');
            $('#quote_fm').form('load',row);
            $('input[name=itemID]').val(row.ID.toString());
            $("#save-btn").linkbutton('enable');    //保存按钮有效
            url = Yii_baseUrl + "/servicer/servicemaininfo/edit/ID/"+row.ID.toString();
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要修改的服务报价信息!'
            });
        }
    }
    
    function saveAll()
    {
        //项目名称不能为空
        var name=$("input[name=ItemName]").val().trim();
        if (!name) {
            $.messager.show({
                title: '错误',
                msg: '项目名称不能为空'
            });
            return false;
        }
        //验证报价不能为负数
        var quote = $("input[name=ItemQuote]").val();
        if (isNaN(quote)) {
            $.messager.show({
                title: '错误',
                msg: '价格框必须输入数字'
            });
            return false;
        }
        if(quote <= 0){
            $.messager.show({
                title: '错误',
                msg: '价格不能为一个小于等于零的数字'
            });
            return false;
        }
        if(quote > 100000){
            $.messager.show({
                title: '错误',
                msg: '价格不能为一个大于10万的数字'
            });
            return false;
        }
        $('#quote_fm').form('submit',{
            url: url,
            onSubmit: function(){
                if($(this).form('validate')==true){
                    $("#save-btn").linkbutton('disable');   //验证通过保存按钮失效
                    return $(this).form('validate');
                }
                else{
                    $("#save-btn").linkbutton('enable');   //验证不通过保存按钮有效
                    return $(this).form('validate');
                }
            },
            success: function(result){
                var result = eval('('+result+')');
                $("#save-btn").linkbutton('enable');    //返回后保存按钮有效
                if (result.errorMsg){
                    $.messager.show({
                        title: '错误',
                        msg: result.errorMsg
                    });
                } else {
                    $('#quote_dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload'); // reload the user data
                }
            }
        });
    }
    function destoryQuote()
    {
        var row = $("#dg").datagrid("getSelected");
        if (row) {
            $.messager.confirm('确认','您确定要删除这项服务吗？',function(r){
                if (r) {
                    $.post(Yii_baseUrl + "/servicer/servicemaininfo/destory",{id:row.ID},function(result){
                        if (result.errorMsg) {
                            $.messager.show({
                                titlt: '错误',
                                msg: result.errorMsg
                            });
                        }
                        else {
                            $("#dg").datagrid("reload");
                            $("#quote_dlg").dialog("close");
                        }
                    },'json');
                }
            });
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择你要删除的服务项目!'
            });
        }
    }
    function importQuote()
    {
        $('#import-dlg').dialog('open').dialog('setTitle','批量导入服务信息');
        $('#import_fm').form('clear');
    }
</script>