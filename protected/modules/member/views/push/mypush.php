<div>
    <?php include 'tab_active.php'; ?>
    <div class="easyui-layout" id="jp-layout" style="height:500px">				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("member/push/getpushbuyrecord"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="CreateTime" width="40" align="left">购买时间</th>
                    <th field="PushType" width="40" align="left">服务类别</th>
                    <th field="Count" width="40" align="left">数量</th>
                    <th field="Amount" width="60" align="left">金额</th>
                    <th field="PayWay" width="40" align="left">支付方式</th>
                </tr>
            </thead>
        </table>	
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">

    <div style="margin-bottom:5px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">订购推送服务</a>
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="checkDetail()">详情</a>-->
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">删除</a>-->
    </div>
    <div>
        <table class='nocss'>
            <tr class='lh22'>
                <td>&nbsp;<strong>我的推送服务：</strong></td>
                <td width='220'>邮件剩余可发送：<strong class='f18 font-green'><?php echo $mypushtotal['EmailBalance'] ?></strong> 封</td>
                <td width='220'>短信剩余可发送：<strong class='f18 font-green'><?php echo $mypushtotal['MessBalance'] ?></strong> 条</td>
              
                <th></th>
            </tr>
        </table>
    </div>
    <div>
        <p class="form-row">
<!--            关键字: <input class="width88 input" name="keyword">
            模糊搜索: <input class="width88 input" name="search">-->
            &nbsp;服务类别:
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
            &nbsp;支付方式:
            <select class="width88 select" name="payway">
                <option value="">显示全部</option>
                <option value="1">消费券</option>
                <option value="2">现金</option>
                <option value="3">支付宝</option>
                <option value="4">银行转账</option>
            </select>
            <input class='submit ml10' type='submit' id="search-btn" value='查询'>
        </p>
    </div>
</div>

<?php $this->renderPartial('pushbuy'); ?>
<?php //$this->renderPartial('detail'); ?>

<script>
    $(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/member/push/getpushbuyrecord';
            var sendway = $("select[name=sendway]").val();
            var month = $("select[name=month]").val();
            var payway = $("select[name=payway]").val();
            // alert(month);
            $('#dg').datagrid({ url:url,queryParams:{
                    'payway':payway,
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