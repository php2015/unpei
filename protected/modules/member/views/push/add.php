


<div id="dlg" class="easyui-dialog" style="width:720px;height:590px;padding:10px 20px"
     closed="true" modal="true" buttons="#dlg-buttons">
   
    <div class="fitem " >
        <label style="margin-top:20px;margin-left:0px;">发送内容:</label>
        <textarea name="content" id="content" style="margin-top:0px;width:400px;height:80px" ></textarea>
        最多能输<span id="textCount">100</span>个字
    </div>
 <div class="fitem " >
    <div style="margin-top:20px;"> 发送方式:
    <select class="width88 select" name="sendway" id="sendway">
            <option value="1">邮件</option>
            <option value="2">短信</option>
        </select>
    </div>
 </div>
    <div style="margin-top:10px">  
        <?php echo $this->renderPartial('select') ?>
    </div>


    <!--                 </form> -->
</div>
<div id="dlg-buttons">
    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon" onclick="saveUser2()">预览</a>-->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">发送</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
</div>

<script type="text/javascript">
    var url;
    function newUser() {
        $('#dlg').dialog('open').dialog('setTitle', '添加推送信息');
         $("#content").val('');
        $('#fm').form('clear');
        $("#textCount").html(100);
         $('#send_car').datagrid('reload');
         // $('#select2').datagrid('clear');
          $('#select2').datagrid('loadData',{total:0,rows:[]}); 
       // url = Yii_baseUrl + "/cim/contact/addgroup";
    }
    function saveUser() {
        var content=$('#content').val();
        var sendway=$('#sendway').val();
        var iddata=$('#iddata').val();
       if(content.length <= 0){
            $.messager.show({
                title: '错误提示',
                msg: '发送内容不能为空!'
            });
           return false;
       }else if(content.length >= 100){
            $.messager.show({
                title: '错误提示',
                msg: '发送信息不能超过100!'
            });
           return false;
       }
       if(sendway.length <=0){
            $.messager.show({
                title: '提示信息',
                msg: '请选择发送方式'
            });
           return false;
       }
       if(iddata.length <= 0){
            $.messager.show({
                title: '错误提示',
                msg: '联系人不能为空！'
            });
           return false;
       }
        // alert(sendway);
        $.ajax({
            url:"<?php echo Yii::app()->createUrl("member/push/addpush") ?>",
            data:{
                ids:iddata,
                sendway:sendway,
                content:content
            },
            type:'post',
            success:function(result)
            {
             	result=eval('('+result+')')
                if (result.data == '1') {
                    //$.messager.alert("提示信息", "操作成功");
                    $.messager.show({
                            title: '提示信息',
                            msg: '推送信息已发送成功!'
                        });
                    $("#dlg").dialog("close");
                    $("#dg").datagrid("load");
                }
                else if(result.data==0)
                {
                    $.messager.alert('提示信息',result.errMsg);
                     $("#dlg").dialog("close");
                }
                else {
                   // $.messager.alert("提示信息", "操作失败");
                    $.messager.show({
                            title: '提示信息',
                            msg: '推送信息发送失败!'
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
        $("#content").keyup(function(){
		var curLength=$("#content").val().length;	
		if(curLength>=100){
			var num=$("#content").val().substr(0,99);
			$("#content").val(num);
			//alert("超过字数限制，多出的字将被截断！" );
                         $.messager.show({
                            title: '错误提示',
                            msg: '超过字数限制，多出的字将被截断！'
                     });
		}
		else{
			$("#textCount").text(99-$("#content").val().length)
		}
	})
    });

</script>
