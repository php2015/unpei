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
?>
<div class="tabs">
    <a class="left-indent">&nbsp;</a>
    <a <?php if ($actionId == "index" && !isset($_GET['flag'])) echo $active ?> href="<?php echo Yii::app()->createUrl("member/jpaccount/index") ?>">现金账户</a>
    <a <?php if ($actionId == "pay" && !isset($_GET['flag'])) echo $active ?> href="<?php echo Yii::app()->createUrl("member/jpaccount/pay") ?>">消费币账户</a>
</div>

<div id="tbc" style="padding:5px;height:auto">
    <form id="search-form" method="get" style="margin: 5px">
        <p class="form-row">
            &nbsp;消费币余额：<?php echo $model[0]["CouponsBalance"]; ?>
        </p>
        <p class="form-row">
            &nbsp;收入-支出：
            <select class="easyui-combobox" name="searchcoupons[Direction]" id="cdirection"  style="width:80px;" >
                <option value="0">显示全部</option>
                <option value="1">显示收入</option>
                <option value="2">显示支出</option>
            </select>
            &nbsp;查询时间：
            <select class="easyui-combobox" name="searchcoupons[Period]" id="cperiod" style="width:100px;">
                <option value="0">指定查询时间</option>
                <option value="1">本周</option>
                <option value="2">本月</option>
                <option value="3">最近一个月</option>
                <option value="4">最近三个月</option>
                <option value="5">最近六个月</option>
            </select>
            <input class="easyui-datebox" name="searchcoupons[start_time]" id="cstart_time"></input><label class='label-inline-wa'>-</label>
            <input class="easyui-datebox" name="searchcoupons[end_time]" id="cend_time"></input>
            <input class='submit ml10' type='button' id="search-coupons-btn" value='查询'><span class="cerror"></span>
<!--	    			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" id="search-coupons-btn">查询</a><span class="cerror"></span>-->
        </p>
    </form>
</div>

<div class="easyui-layout" id="jp-layout"  style="height:500px">  
    <table class="easyui-datagrid" title="" style="height:500px" id="couponsList"
           data-options="region:'center',
           rownumbers:true,
           fitColumns:true,
           singleSelect:true,
           collapsible:true,
           pagination:true,
           url:'searchAccountCoupons',
           method:'get',
           toolbar:'#tbc'">
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
<script type="text/javascript">
    //点击查询消费币流水记录
    $('#search-coupons-btn').click(function(){
        var url = Yii_baseUrl + '/member/jpaccount/searchAccountCoupons';
        var direction = $('#cdirection').combobox('getValues').toString();
        var period = $('#cperiod').combobox('getValues').toString();
        var start_time = $("#cstart_time").datebox("getValue"); 
        var end_time = $("#cend_time").datebox("getValue");
        $('.cerror').text('');
        if ((start_time!=0) && (end_time!=0) &&(start_time > end_time)) {
            $('.cerror').text('开始时间大于结束时间,请重新输入').css('color','red');
            return false;
        }
        $('#couponsList').datagrid({ url:url,queryParams:{
                'direction':direction,
                'period':period,
                'start_time':start_time,
                'end_time':end_time     	
            },method:"get"});
    });
</script>