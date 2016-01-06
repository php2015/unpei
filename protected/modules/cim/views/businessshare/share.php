<div>
    <div class="tabs" pre="tab">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("cim/businessshare/index"); ?>">共享申请列表</a>
        <a href="<?php echo Yii::app()->createUrl("cim/businessshare/share"); ?>" class="active">共享接收列表</a>
    </div>
    <div class="easyui-layout" id="jp-layout" style="height:500px" >				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("cim/businessshare/sharelist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="CreateTime" width="50" align="center">建立时间</th>
                    <th field="ShareName" width="35" align="center">共享方</th>
                    <th field="ClientName" width="35" align="center">发起方姓名</th>
                    <th field="InitiatorName" width="50" align="center" data-options="formatter:formatOrgan">机构名称</th>
                    <th field="SJiapartsID" width="40" align="center">嘉配ID</th>
                    <th field="Phone" width="40" align="center">联系电话</th>
                    <th field="Address" width="70" align="center">地址</th>
                    <th field="ShareType" width="35" align="center">共享类型</th>
                    <th field="Status" width="30" align="center" data-options="formatter:formatColor">状态</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        <p class='form-row'>
            共享状态: 
            <select name="Status" class="width110 select">
                <option value='0'>请选择</option>
                <option value='1'>待确认</option>
                <option value='2'>共享中</option>
            </select>&nbsp;&nbsp;
            共享类型:
            <select name="ShareType" class="width110 select">
                <option value='0'>全部</option>
                <option value='1'>联系人共享</option>
                <option value='2'>商品共享</option>
                <option value='3'>全部共享</option>
            </select>&nbsp;&nbsp;
            <input class='submit ml10' type='submit' id="search-btn" value='查询'>
        </p>
    </div>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="checkShare()">详情</a>
    </div>
</div>
<div id="check_dlg" class="easyui-dialog"  style="width:500px;height:300px;padding:10px 20px"
     closed="true" buttons="#dlg-check" modal="true">
    <table class="dttable">
        <tr class="fitem" style="height:30px;">
            <td width="70" align="right">&nbsp;&nbsp;发起方：</td>
            <td width="200" name="LaunchName"></td>
            <td width="70" align="right">&nbsp;&nbsp;接收方：</td>
            <td width="160" name="ReceiveName"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">共享方式：</td>
            <td name="ShareType" style="color: green"></td>
            <td align="right">共享状态：</td>
            <td name="Status" style="color: red"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">发起时间：</td>
            <td colspan="3" name="LaunchTime"></td>
        </tr>
        <tr class="fitem updatetime" style="height:30px;">
            <td align="right">确认时间：</td>
            <td colspan="3" name="UpdateTime"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">验证信息：</td>
            <td colspan="3" name="VerifyInfo"></td>
        </tr>
    </table>
    <div id="dlg-check">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" key="0" mode="" id="confirm" onclick="Confirm()">确认</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" key="0" mode="" id="refuse" onclick="Refuse()">拒绝</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-close" onclick="javascript:$('#check_dlg').dialog('close')">关闭</a>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/cim/businessshare/sharelist';
            var Status = $("select[name=Status]").val();
            var ShareType = $("select[name=ShareType]").val();
            $('#dg').datagrid({ url:url,queryParams:{
                    'Status':Status,
                    'ShareType':ShareType                      
                },method:"get"});
        });
    });
    function formatColor(val,row){
        if (val == '待确认') {
            return "<span style='color:red'>"+val+"</span>";
        }
        if (val == '共享中') {
            return "<span style='color:green;'>"+val+"</span>";
        }
    }
    //共享机构黄页
    function formatOrgan(val,row){
        var url = Yii_baseUrl + "/dealer/makequery/detail/dealer/"+row.InitiatorID;
        return "<a href='"+url+"' target='_blank' style='color:red;cursor:pointer;' >"+val+"</a>";
    }
    //查看详情-确认共享申请
    function checkShare(){
        var row = $("#dg").datagrid("getSelected");
        if(row){
            $("#check_dlg").dialog("open").dialog("setTitle","共享记录详情");
            if (row.LaunchTime == row.UpdateTime){
                $(".updatetime").hide();
            } else {
                $(".updatetime").show();
            }
            $("td[name=LaunchName]").text(row.LaunchName);
            $("td[name=ReceiveName]").text(row.ReceiveName);
            $("td[name=ShareType]").text(row.ShareType);
            $("td[name=Status]").text(row.Status);
            $("td[name=LaunchTime]").text(row.LaunchTime);
            $("td[name=UpdateTime]").text(row.UpdateTime);
            $("td[name=VerifyInfo]").text(row.VerifyInfo);
            $("#confirm").attr("mode",row.ShareType);
            $("#refuse").attr("mode",row.ShareType);
            $("#confirm").attr("key",row.ID);
            $("#refuse").attr("key",row.ID);
        }
        else{
            $.messager.alert("提示","请选择一条共享记录","warning");
        }
    }
    var msg = "<br>共享商品：您可以将自己的商品共享给其他的经销商，以获得更多被检索的机会。\n\
               <br>共享联系人：您可以获得其他经销商共享的联系人，以获得更多的联系人资源。";
    //确认共享申请
    function Confirm(){
        var ID = $("#confirm").attr("key");
        var mode = $("#confirm").attr("mode");
        $.messager.confirm("提示", "你是否确认接受该机构的"+mode+"申请呢？"+msg, function(r){
            if(r){
                $.post(Yii_baseUrl + "/cim/businessshare/confirm", {ID:ID}, function(result){
                    if (result.success){
                        $('#dg').datagrid('reload'); 
                        $("#check_dlg").dialog("close");
                    } else {
                        $.messager.alert("提示",result.errorMsg,"error");
                    }
                }, "json");
            }
        })
    }
    //拒绝共享申请
    function Refuse(){
        var ID = $("#refuse").attr("key");
        var mode = $("#confirm").attr("mode");
        $.messager.confirm("提示", "你是否确认拒绝该机构的"+mode+"申请呢？"+msg, function(r){
            if(r){
                $.post(Yii_baseUrl + "/cim/businessshare/cancel", {ID:ID}, function(result){
                    if (result.success){
                        $('#dg').datagrid('reload'); 
                        $("#check_dlg").dialog("close");
                    } else {
                        $.messager.alert("提示",result.errorMsg,"error");
                    }
                }, "json");
            }
        });
    }
</script>