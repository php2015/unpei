<div>
    <div class="tabs" pre="tab">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("cim/businessshare/index"); ?>" class="active">共享申请列表</a>
        <a href="<?php echo Yii::app()->createUrl("cim/businessshare/share"); ?>">共享接收列表</a>
    </div>
    <div class="easyui-layout" id="jp-layout" style="height:500px" >				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("cim/businessshare/applylist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="CreateTime" width="50" align="center">建立时间</th>
                    <th field="InitiatorName" width="50" align="center">发起方</th>
                    <th field="ClientName" width="35" align="center">共享人姓名</th>
                    <th field="ShareName" width="50" align="center" data-options="formatter:formatOrgan">机构名称</th>
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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="shareApply()">共享申请</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="checkShare()">详情</a>
    </div>
</div>
<div id="apply_dlg" class="easyui-dialog"  style="width:700px;height:480px;padding:10px 20px"
     closed="true" buttons="#dlg-apply" modal="true">
    <form id="apply_fm" method="post" novalidate>
        <input type="hidden" class="input" name="ContactID">
        <input type="hidden" class="input" name="ShareType">
        <table class="dttable">
            <tr class="fitem" style="height:30px;">
                <td width="120">机构名称：</td>
                <td><input type="text" class="width178 input" name="OrganName"></td>
            </tr>
            <tr class="fitem">
                <td colspan="2">
                    <div style="width:640px;height:200px;overflow-y:auto">
                        <table id="contacts" class="easyui-datagrid" data-options="		            
                               pagination:true,border:false,rownumbers:true,fitColumns:true,
                               fit:true,singleSelect:true,method:'get'">
                            <thead>
                                <tr>
                                    <th field="id" data-options="formatter:checkRadio"></th>
                                    <th field="name" width="25" align="center">客户姓名</th>
                                    <th field="sex" width="20" align="center">性别</th>
                                    <th field="jiapart_ID" width="30" align="center">嘉配ID</th>
                                    <th field="companyname" width="30" align="center">机构名称</th>
                                    <th field="phone" width="35" align="center">联系电话</th>
                                    <th field="address" width="50" align="center">地址</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </td>
            </tr>
            <tr class="fitem" style="height:50px;">
                <td>共享类型：</td>
                <td>
                    <input type="checkbox" name="sharecate" value="1">&nbsp;联系人共享&nbsp;&nbsp
                    <input type="checkbox" name="sharecate" value="2">&nbsp;商品共享
                </td>
            </tr>
            <tr class="fitem">
                <td>验证信息：</td>
                <td>
                    <textarea name="VerifyInfo" cols="90" rows="4" onfocus="if(this.value=='(验证信息不能超过64个字符)') this.value='';" onblur="if(this.value.length < 1) this.value='(验证信息不能超过64个字符)';">(验证信息不能超过64个字符)</textarea>
                </td>
            </tr>
        </table>
    </form>
    <div id="dlg-apply">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="send-btn" onclick="Send()">发送</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#apply_dlg').dialog('close')">取消</a>
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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" key="0" id="cancel" onclick="CancelShare()">取消共享</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-close" onclick="javascript:$('#check_dlg').dialog('close')">关闭</a>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/cim/businessshare/applylist';
            var Status = $("select[name=Status]").val();
            var ShareType = $("select[name=ShareType]").val();
            $('#dg').datagrid({ url:url,queryParams:{
                    'Status':Status,
                    'ShareType':ShareType                      
                },method:"get"});
        });
        $("input[name=OrganName]").keyup(function(){
            var name = $(this).val();
            $('#contacts').datagrid({ 
                url: Yii_baseUrl + "/cim/businessshare/contact",
                queryParams: {'name':name},
                method: "get"
            });
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
        var url = Yii_baseUrl + "/dealer/makequery/detail/dealer/"+row.ShareID;
        return "<a href='"+url+"' target='_blank' style='color:red;cursor:pointer;' >"+val+"</a>";
    }
    //共享申请单选框
    function checkRadio(val,row){
        return "<input type='radio' value="+val+" name='id'>";
    }
    //共享申界面
    function shareApply(){
        $("#apply_dlg").dialog("open").dialog("setTitle", "共享申请");
        $("#apply_fm").form("clear");
        $("#send-btn").linkbutton('enable');    //发送按钮有效
        var verify = "(验证信息不能超过64个字符)";
        $("textarea[name=VerifyInfo]").val(verify);
        $('#contacts').datagrid({ 
            url: Yii_baseUrl + "/cim/businessshare/contact",
            method: "get",
            onClickRow: function () {
                //单击行的时候，将单选按钮设置为选中
                var id = $('#contacts').datagrid("getSelected");
                $("input[name='id']").each(function () {
                    if ($(this).val() == id.id) {
                        $(this).attr("checked", true);
                    }
                });
            }
        });
    }
    //发送共享申请
    function Send(){
        var contact = $("#contacts").datagrid("getSelected");
        if(contact){
            $("input[name=ContactID]").val(contact.id);     //将联系人表ID放入文本框中
        }
        else{
            $.messager.alert("提示","请选择共享机构");
            return false;
        }
        var types = '';
        $("input[name=sharecate]:checked").each(function(){
            types += $(this).val() + ',';
        })
        types = types.substring(0,types.length-1);  //去除字符串最后一个字符（逗号）
        if(types){
            $("input[name=ShareType]").val(types);
        }
        else{
            $("input[name=ShareType]").val('');
            $.messager.alert("提示","请选择共享类型");
            return false;
        }
        var verify = $("textarea[name=VerifyInfo]").val();
        if(verify.length >= 64){
            $.messager.alert("提示","验证信息不能超过64个字符");
            return false;
        }
        $('#apply_fm').form('submit',{
            url: Yii_baseUrl + "/cim/businessshare/shareapply",
            onSubmit: function(){
                if($(this).form('validate')==true){
                    $("#send-btn").linkbutton('disable');   //验证通过保存按钮失效
                    return $(this).form('validate');
                }
                else{
                    $("#send-btn").linkbutton('eable');   //验证不通过保存按钮失效
                    return $(this).form('validate');
                }
            },
            success: function(result){
                var result = eval('('+result+')');
                $("#send-btn").linkbutton('enable');    //返回结果后有效
                if (result.exists){
                    //向该机构的共享申请已存在（待确认）,询问是否覆盖
                    $.messager.confirm("提示", result.exists, function(r){
                        if(r){
                            $("#send-btn").linkbutton('disable');   //确认后发送按钮失效
                            $.post(Yii_baseUrl + "/cim/businessshare/cover", {ContactID:contact.id,ShareType:types,VerifyInfo:verify}, function(data){
                                if (data.success){
                                    $("#dg").datagrid("reload");
                                    $.messager.confirm("提示", data.success+",是否继续发起共享申请?", function(r){
                                        if(r){
                                            $("#send-btn").linkbutton('enable');    //确认继续后发送按钮有效
                                            return true;
                                        }
                                        else{
                                            $("#dg").datagrid("reload");
                                            $("#apply_dlg").dialog("close");
                                        }
                                    });
                                }
                                else{
                                    $("#apply_dlg").dialog("close");
                                    $.messager.alert("提示", data.errorMsg, "error");
                                }
                            }, "json")
                        }
                    })
                }
                else if (result.success){
                    $("#dg").datagrid("reload");
                    $.messager.confirm("提示", result.success+",是否继续发起共享申请?", function(r){
                        if(r){
                            return true;
                        }
                        else{
                            $("#dg").datagrid("reload");
                            $("#apply_dlg").dialog("close");
                        }
                    });
                }
                else {
                    $("#apply_dlg").dialog("close");
                    $.messager.alert("提示", result.errorMsg, "error");
                } 
            }
        });
    }
    //查看详情
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
            $("#cancel").attr("key",row.ID);   //添加共享ID到取消共享方法中
        }
        else{
            $.messager.alert("提示","请选择一条共享记录","warning");
        }
    }
    //取消共享
    function CancelShare(){
        var ID = $("#cancel").attr("key");
        $.messager.confirm("提示", "您是否要取消向该机构的共享状态？", function(r){
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