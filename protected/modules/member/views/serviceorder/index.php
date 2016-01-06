<?php $this->pageTitle = Yii::app()->name . ' - ' . "嘉配订购服务"; ?>
<div class="tabs">
    <a class="left-indent">&nbsp;</a>
    <a href="#" class="active">嘉配服务订购</a>
</div>
<div class="easyui-layout" style="height:500px">
    <table class="easyui-datagrid" style="height:500px" id="orderList"
           data-options="rownumbers:true,
           region:'center',
           singleSelect:true,
           pagination:true,
           collapsible:true,
           url:'<?php echo Yii::app()->createUrl("member/serviceorder/searchOrder") ?>',
           method:'get',
           toolbar:'#tb'">
        <thead>
            <tr>
                <th data-options="field:'ProuductName',width:100">服务名称</th>
                <th data-options="field:'Remark',width:200">服务描述</th>
                <th data-options="field:'Amount',width:90">金额</th>
                <th data-options="field:'PayMethod',width:90">支付方式</th>
                <th data-options="field:'OrderDate',width:120">服务购买时间</th>
                <th data-options="field:'EndDate',width:120">服务到期时间</th>
            </tr>
        </thead>
    </table>
</div>	
<div id="adddialog" class="easyui-dialog" style="width:380px;height:450px;padding:10px 5px"
     closed="true" buttons="#dlg-buttons">
    <form id="fm" method="post" novalidate class="form-list">
        <table class="dttable">
            <tr class="fitem" style="height:30px;">
                <td align="right" >您续费的</td>
                <td  name="ProuductName"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right" >总金额：</td>
                <td name="Amount"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right" width=105>请选择支付方式：</td><td> <input name="PayMethod" class="easyui-validatebox" type="radio" value="现金" checked>现金（当前余额：￥）</td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right" width=105></td><td><input name="PayMethod" class="easyui-validatebox" type="radio" value="消费券">消费券（当前余额：￥）</td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right" width=105></td><td><input name="PayMethod" class="easyui-validatebox" type="radio" value="现金" >支付宝<label style="color:red">（跳转支付宝）</label></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right" width=105></td><td><input name="PayMethod" class="easyui-validatebox" type="radio" value="网银" id="wangyin" >网银</td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right" width=105>银行：</td><td><input name="BankName" class="easyui-validatebox" type="radio" value="中国农业银行"><img class='y-align-m' src="<?php echo F::themeUrl(); ?>/images/nongye.png?>"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right" width=105></td><td><input name="BankName" class="easyui-validatebox" type="radio" value="中国工商银行"><img class='y-align-m' src="<?php echo F::themeUrl(); ?>/images/gongshang.png?>"></td>
            </tr>
            <tr>
            	<td align="right" width=105></td><td><span style="color:red;">（跳转网银接口）</span></td>
            </tr>
            
        </table>
        <!--        <div class="fitem">-->
        <!--			<label>请选择支付方式：</label>-->
        <!--            <div>-->
        <!--                <input name="PayMethod" class="easyui-validatebox" type="radio" value="现金" checked>现金（当前余额：￥）-->
        <!--            </div>-->
        <!--            <div>-->
        <!--                <input name="PayMethod" class="easyui-validatebox" type="radio" value="消费券">消费券（当前余额：￥）-->
        <!--            </div>-->
        <!--            <div>-->
        <!--                <input name="PayMethod" class="easyui-validatebox" type="radio" value="现金" >支付宝<label style="color:red">（跳转支付宝）</label>-->
        <!--            </div>-->
        <!--            <div>-->
        <!--                <input name="PayMethod" class="easyui-validatebox" type="radio" value="网银" >网银-->
        <!--            </div>-->
        <!--            <div> -->
        <!--                                          银行：-->
        <!--            </div>-->
        <!--            <div>-->
        <!--                <input name="BankName" class="easyui-validatebox" type="radio" value="中国农业银行">中国农业银行-->
        <!--            </div>-->
        <!--            <div>-->
        <!--                <input name="BankName" class="easyui-validatebox" type="radio" value="中国工商银行">中国工商银行-->
        <!--			</div> -->
        <!--		</div>-->
    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveOrder()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#adddialog').dialog('close')">取消</a>
    </div>
</div>
<div id="tb" style="height:auto">
    <p class="form-row">
        <label>&nbsp;服务名称：</label> <input name="" class="width103 input" id="ProuductName">
        <label>&nbsp;金额：</label><input name="" class="width53 input" id="StartAmount"><label class='label-inline-wa'>-</label><input name="" class="width53 input" id="EndAmount"><label>&nbsp;元</label>
        &nbsp;支付方式：
        <select class="easyui-combobox" name="" id="PayMethod"  style="width:80px;" >
            <option value="0">显示全部</option>
            <option value="1">现金</option>
            <option value="2">消费币</option>
            <option value="3">支付宝</option>
            <option value="4">网银</option>
        </select>
    </p>
    <p class="form-row">          
        &nbsp;购买时间：
        <select class="easyui-combobox" name="" id="PurchaseDate" style="width:110px;">
            <option value="0">指定查询时间</option>
            <option value="1">本周</option>
            <option value="2">本月</option>
            <option value="3">最近一个月</option>
            <option value="4">最近三个月</option>
            <option value="5">最近六个月</option>
        </select>
        <input class="easyui-datebox" name="" id="StartTime"></input><label class='label-inline-wa'>-</label>
        <input class="easyui-datebox" name="" id="EndTime"></input>
    </p>
    <p class="form-row">
        &nbsp;到期时间：
        <select class="easyui-combobox" name="" id="ExpirationDate" style="width:110px;">
            <option value="0">指定查询时间</option>
            <option value="1">本周</option>
            <option value="2">本月</option>
            <option value="3">最近一个月</option>
            <option value="4">最近三个月</option>
            <option value="5">最近六个月</option>
        </select>
        <input class="easyui-datebox" name="" id="EStartTime"></input><label class='label-inline-wa'>-</label>
        <input class="easyui-datebox" name="" id="EEndTime"></input>
        <input class='submit ml10' type='submit' id="search-btn" value='查询'> 
        <input class='submit ml10' type='button' id="add-btn" value='续费' onclick="newOrder()">	
        <br><br><span class="error"></span><span class="cerror"></span>		
<!--	<a href="#" class="easyui-linkbutton" iconCls="icon-search" id="search-btn">查询</a><span class="error"></span> -->
        <!--	<a href="#" class="easyui-linkbutton" iconCls="icon-add" id="add-btn" onclick="newOrder()">续费</a>-->
    </p>
</div>
<script type="text/javascript">
    
    $(document).ready(function(){
    	$("input[name=PayMethod]").change(function(){
    		var wy = $("input[name=PayMethod]:checked ").val();
    		if(wy!='网银'){
    			$("input[name=BankName]").attr('checked',false);
    		}
        	});   

        
        //点击查询已订购服务列表
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/member/serviceorder/searchOrder';
            var ProuductName = $('#ProuductName').val();
            var StartAmount = $('#StartAmount').val();
            var EndAmount = $('#EndAmount').val();
            var PayMethod = $('#PayMethod').combobox('getValues').toString();
            var PurchaseDate = $('#PurchaseDate').combobox('getValues').toString();
            var StartTime = $("#StartTime").datebox("getValue"); 
            var EndTime = $("#EndTime").datebox("getValue");
            var ExpirationDate = $('#ExpirationDate').combobox('getValues').toString();
            var EStartTime = $("#EStartTime").datebox("getValue"); 
            var EEndTime = $("#EEndTime").datebox("getValue");
            $('.error').text('');
            if ((StartTime!=0) && (EndTime!=0) &&(StartTime > EndTime)) {
                $('.error').text('购买开始时间大于结束时间，请重新输入！').css('color','red');
                return false;
            }
            $('.cerror').text('');
            if ((EStartTime!=0) && (EEndTime!=0) &&(EStartTime > EEndTime)) {
                $('.cerror').text('到期开始时间大于结束时间，请重新输入！').css('color','red');
                return false;
            }
            $('#orderList').datagrid({ url:url,queryParams:{
                    'ProuductName':ProuductName,
                    'StartAmount':StartAmount,
                    'EndAmount':EndAmount,
                    'PayMethod':PayMethod,
                    'PurchaseDate':PurchaseDate,
                    'StartTime':StartTime,
                    'EndTime':EndTime,
                    'ExpirationDate':ExpirationDate,
                    'EStartTime':EStartTime,
                    'EEndTime':EEndTime    	
                },method:"get"});
        });
    });
    //打开嘉配续费窗口
    function newOrder(){
        var row = $('#orderList').datagrid('getSelected');
        if (row){
            $('#adddialog').dialog('open').dialog('setTitle','续费');
            $('#fm').form('clear');
            $("td[name=ProuductName]").text(row.ProuductName);
            $("td[name=Amount]").text(row.Amount);
        }else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要续费的嘉配服务!'
            });
        }
    }
    //提交续费信息
    function saveOrder(){
        var url = Yii_baseUrl + "/member/serviceorder/renew";
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.errorMsg){
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {
                    $('#adddialog').dialog('close');        // close the dialog
                    $('#orderList').datagrid('reload');    // reload the user data
                }
            }
        });
    }
</script>