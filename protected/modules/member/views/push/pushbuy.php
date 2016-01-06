


<div id="dlg" class="easyui-dialog" style="width:420px;height:300px;padding:10px 20px"
     closed="true" modal="true" buttons="#dlg-buttons">
    <div class="fitem " >
        <label style="margin-top:20px;margin-left:0px;">服务类别:</label>
        <select class="width88 select" name="pushway" id="pushway">
            <option value="1">邮件</option>
            <option value="2">短信</option>
        </select>
    </div>
    <div class="fitem " >
        <div style="margin-top:20px;">购买数量:
            <select class="width88 select" name="count" id="count">
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
            </select>
        </div>
    </div>
    <div class="fitem " >
        <div style="margin-top:20px;">付款方式:
            <input type="radio" value="1" name="payway" checked >消费券
            <input type="radio" value="2" name="payway"> 现金
            <input type="radio" value="3" name="payway"> 支付宝
            <input type="radio" value="4" name="payway"> 银行转账
        </div>
    </div>
    <div class="fitem " >
        <div style="margin-top:20px;">金额:
              <span class="color-price f24" > ￥</span>  
              <span class="color-price f24" id="amount">10</span> 
        </div>
    </div>


    <!--                 </form> -->
</div>
<div id="dlg-buttons">
    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon" onclick="saveUser2()">预览</a>-->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">购买</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
</div>

<script type="text/javascript">
    var url;
    function newUser() {
        $('#dlg').dialog('open').dialog('setTitle', '购买推送服务');
        $('#fm').form('clear');
        //url = Yii_baseUrl + "/cim/contact/addgroup";
    }
    function saveUser() {
        var pushway=$('#pushway').val();
        var count=$('#count').val();
        var payway=$('input[name=payway]:checked').val();
        var amount=$('#amount').text();
//        alert(payway);
//        return false;
        $.ajax({
            url:"<?php echo Yii::app()->createUrl("member/push/buypush") ?>",
            data:{
                pushway:pushway,
                count:count,
                payway:payway,
                amount:amount
            },
            type:'post',
            success:function(result)
            {
                result=eval('('+result+')')
                if (result.data == '1') {
                    //$.messager.alert("提示信息", "操作成功");
                    $.messager.show({
                        title: '提示信息',
                        msg: '购买推送服务成功!'
                    });
                    $("#dlg").dialog("close");
                    $("#dg").datagrid("load");
                    setTimeout("window.location.reload();",100);
                }else {
                    // $.messager.alert("提示信息", "操作失败");
                    $.messager.show({
                        title: '提示信息',
                        msg: '购买推送服务失败!'
                    });
                }
            }
        });
    }
    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('提示信息', '您确定想要删除该数据?', function(r) {
                if (r) {
                    $.get(Yii_baseUrl + "/cim/contact/deletegroup", {id: row.ID}, function(result) {
                        if (result) {
                            $.messager.alert("提示信息", "操作成功");
                            $("#dlg").dialog("close");
                            $("#dg").datagrid("reload");
                           
                        }
                        else {
                            $.messager.alert("提示信息", "操作失败");
                        }
                    }, 'json');
                }
            });
        }else
        {
            $.messager.alert('提示信息','请先勾选要删除的群组','warning');
        }
    }
    
    $(function(){
        $("#count").change(function(){
            $("#amount").html($(this).val()/10);
        });
    });

</script>
