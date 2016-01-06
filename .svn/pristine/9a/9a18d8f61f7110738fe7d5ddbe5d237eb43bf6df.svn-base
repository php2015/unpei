<div>
<?php include 'tab_active.php'; ?>
    <div class="easyui-layout" id="jp-layout" style="height:500px">				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("member/push/getpushmess"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="sendtime" width="60" align="center">发送时间</th>
                    <th field="content2" width="240" align="left">推送内容</th>
                    <th field="sendto" width="40" align="center">发送对象</th>
                    <th field="sendway" width="40" align="center">发送方式</th>
                </tr>
            </thead>
        </table>	
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        <p class="form-row">
            &nbsp;关键字: <input class="width88 input" name="keyword">
            &nbsp;模糊搜索: <input class="width88 input" name="search">
            &nbsp;发送方式:
            <select class="width88 select" name="sendway">
                <option value="">显示全部</option>
                <option value="1">邮件</option>
                <option value="2">短信</option>
            </select>
            &nbsp;按月显示:
            <select class="width88 select" name="month">
                <option value="">显示全部</option>
                <option value="1">一月内</option>
                <option value="3">三月内</option>
                <option value="6">六月内</option>
                <option value="12">一年内</option>
            </select>
            <input class='submit ml10' type='submit' id="search-btn" value='查询'>
        </p>
    </div>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="checkDetail()">详情</a>
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">删除</a>-->
    </div>
</div>

<?php $this->renderPartial('add'); ?>
<?php  $this->renderPartial('detail'); ?>

<script>
    $(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/member/push/getpushmess';
            var search = $("input[name=search]").val();	
            var keyword = $("input[name=keyword]").val();	
            var sendway = $("select[name=sendway]").val();
            var month = $("select[name=month]").val();
            // alert(month);
            $('#dg').datagrid({ url:url,queryParams:{
                    'search':search,
                    'keyword':keyword,
                    'sendway':sendway,
                    'month':month
                },method:"get"});
        });
      	
    });
  
    function checkDetail()
    {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#check_detail').dialog('open').dialog('setTitle','推送信息详情');
            $("td[name=sendtime]").text(row.sendtime);
            $("td[name=sendway]").text(row.sendway);
            $("td[name=sendcontent]").text(row.content);
            var url = Yii_baseUrl +"/member/push/getcontacts";
               $('#send_info').datagrid({ url:url,queryParams:{
                    'pushID':row.ID
                },method:"get"});
        }else{
            $.messager.show({
                    title: '提示信息',
                    msg: '您还没有选择数据！'
                });
        }
    }
</script>