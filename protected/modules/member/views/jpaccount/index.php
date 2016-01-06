<!-- 现金账户 -->
<style>
    .datagrid-header-inner{float:none;width:auto;}
</style>
<?php
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
if (!isset($_GET['flag'])) {
    
} else {
    $isshow = "";
}
?>
<?php
$this->pageTitle = Yii::app()->name . ' - ' . "嘉配账户管理";
$this->breadcrumbs = array(
    '用户中心',
    '嘉配账户管理',
);
?>
<div class="tabs">
    <a class="left-indent">&nbsp;</a>
    <a <?php if ($actionId == "index" && !isset($_GET['flag'])) echo $active ?> href="<?php echo Yii::app()->createUrl("member/jpaccount/index") ?>">现金账户</a>
    <a <?php if ($actionId == "pay" && !isset($_GET['flag'])) echo $active ?> href="<?php echo Yii::app()->createUrl("member/jpaccount/pay") ?>">消费币账户</a>
</div>

<div id="tb">
    <div style="margin: 5px">
        <p class="form-row">
            &nbsp;现金余额：<?php echo $model[0]["CashBalance"]; ?>
            <input class='submit ml10' type='submit' id="recharge-btn" value='充值'><label style="color:red">（跳转支付宝）</label>
            <!--		    <a id="recharge-btn" class="easyui-linkbutton" href="https://www.alipay.com/">充值</a><label style="color:red">（跳转支付宝）</label>-->
        </p>
        <p class="form-row">
            &nbsp;收入-支出：
            <select class="easyui-combobox" name="search[Direction]" id="direction"  style="width:80px;" >
                <option value="0">显示全部</option>
                <option value="1">显示收入</option>
                <option value="2">显示支出</option>
            </select>
            &nbsp;查询时间：
            <select class="easyui-combobox" name="search[Period]" id="period" style="width:100px;">
                <option value="0">指定查询时间</option>
                <option value="1">本周</option>
                <option value="2">本月</option>
                <option value="3">最近一个月</option>
                <option value="4">最近三个月</option>
                <option value="5">最近六个月</option>
            </select>
            <input class="easyui-datebox" name="search[start_time]" id="start_time"></input><label class='label-inline-wa'>-</label>
            <input class="easyui-datebox" name="search[end_time]" id="end_time"></input>
            <input class='submit ml10' type='submit' id="search-btn" value='查询'><span class="error"></span>
    <!--	    			<a href="#" class="easyui-linkbutton" iconCls="icon-search" id="search-btn">查询</a> <span class="error"></span>-->
        </p>
    </div>
</div>
<div class="easyui-layout"  style="height:500px" id="jp-layout">  
    <div data-options="fit:true">
        <table class="easyui-datagrid" title="" style="width:768px;height:500px" id="accountList"
               data-options="rownumbers:true,singleSelect:true,fitColumns:true,
               pagination:true,		            
               collapsible:true,
               url:'<?php echo Yii::app()->createUrl("member/jpaccount/searchAccount") ?>',
               method:'get',
               toolbar:'#tb'">
            <thead>
                <tr>
                    <th data-options="field:'Account',width:100">金额￥</th>
                    <th data-options="field:'Direction',width:80">收入/支出</th>
                    <th data-options="field:'CreateTime',width:180">日期</th>
                    <th data-options="field:'Remark',width:150">备注</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        //点击查询现金流水记录
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/member/jpaccount/searchAccount';
            var direction = $('#direction').combobox('getValues').toString();
            var period = $('#period').combobox('getValues').toString();
            var start_time = $("#start_time").datebox("getValue"); 
            var end_time = $("#end_time").datebox("getValue");
            $('.error').text('');
            if ((start_time!=0) && (end_time!=0) &&(start_time > end_time)) {
                $('.error').text('开始时间大于结束时间，请重新输入').css('color','red');
                return false;
            }
   
            $('#accountList').datagrid({ url:url,queryParams:{
                    'direction':direction,
                    'period':period,
                    'start_time':start_time,
                    'end_time':end_time     	
                },method:"get"});
        });
    });
    //点击充值
    $("#recharge-btn").click(function () {
        window.open('https://www.alipay.com/');
        //alert("充值页面");
    });
</script>
