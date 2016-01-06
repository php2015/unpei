<div>
    <div class="tabs" pre="tab">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("cim/pricemanage/index"); ?>" class="active">价格管理列表</a>
        <a href="<?php echo Yii::app()->createUrl("cim/pricemanage/turnover"); ?>">订单最小交易额</a>
    </div>
    <div class="easyui-layout" id="jp-layout" style="height:500px" >				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="iconCls: 'icon-edit',region:'center',pagination:false,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("cim/pricemanage/pricelist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="OrganName" width="50" align="center">机构名称</th>
                    <th field="CooperationType" width="50" align="center">合作类型</th>
                    <th field="PriceRatio" width="50" align="center" data-options="formatter:Color">价格比</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="Set()">设置</a>
    </div>
</div>
<div id="price_dlg" class="easyui-dialog" style="width:400px; height:200px;padding:10px 20px;"
     closed="true" buttons="#dlg-price" modal="true">
    <form id="price_fm" method="post" novalidate>
        <table class="dttable" style="padding: 0px 10px;">
            <tr class="fitem" style="height: 30px;">
                <td>合作类型：</td>
                <td name="CooperationType"></td>
            <input type="hidden" name="CooperationType">
            </tr>
            <tr class="fitem" style="height: 30px;">
                <td>价&nbsp;格&nbsp;比：</td>
                <td><input type="hidden" name="priceID" value="">
                    <input name="PriceRatio" class="easyui-validatebox input" required="true" style="width: 144px;">
                    <span style="margin-left: 5px;color: red;">(请输入百分比)</span></td>
            </tr>
        </table>
    </form>
    <div id="dlg-price">

        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="save-btn" onclick="Save()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#price_dlg').dialog('close')">取消</a>
    </div>
</div>
<script>
    function Color(val,row){
        return '<span style="color:red;">'+val+'</span>';
    }
    var url;
    function Set(){
        var row = $("#dg").datagrid("getSelected");
        if(row){
            if(row.CooperationType=='C：普通客户'){
                $.messager.alert("提示","C类普通客户价格比不可重设置！","warning");
            }
            else{
                $("#price_dlg").dialog("open").dialog("setTitle", "合作类型价格比设置");
                $("#price_fm").form("clear");
                $("td[name=CooperationType]").text(row.CooperationType);
                $("input[name=CooperationType]").val(row.CooperationType);
                $("input[name=PriceRatio]").val(row.PriceRatio);
                $("input[name=priceID]").val(row.ID);
                url = Yii_baseUrl + "/cim/pricemanage/setprice";
            }
        }
        else{
            $.messager.alert("提示","请选择价格比设置对象！","warning");
        }
    }
    function Save(){
        var price = $("input[name=PriceRatio]").val();
        var first = price.substring(0,price.length-1);
        var last = price.substring(price.length-1);
        if(price){
            if(isNaN(first) || last != '%'){
                $.messager.alert("提示","格式错误，请参考C类普通客户价格比重新设置！","warning");
            }
            else if(first >= 100 || first <= 0){
                $.messager.alert("提示","价格比不能为一个小于等于0或者大于等于100的数！","warning");
            }
            else{
                $('#price_fm').form('submit',{
                    url: url,
                    onSubmit: function(){
                        if($(this).form('validate')==true){
                            $("#save-btn").linkbutton('disable');   //验证通过保存按钮失效
                            return $(this).form('validate');
                        }
                        else{
                            $("#save-btn").linkbutton('eable');   //验证不通过保存按钮有效
                            return $(this).form('validate');
                        }
                    },
                    success: function(result){
                        var result = eval('('+result+')');
                        $("#save-btn").linkbutton('enable');    //返回后保存按钮有效
                        if (result.errorMsg){
                            $.messager.alert("错误",result.errorMsg,"warning");
                        } else {
                            $('#price_dlg').dialog('close'); // close the dialog
                            $('#dg').datagrid('reload'); // reload the user data
                        }
                    }
                });
            }
        }  
    }
</script>