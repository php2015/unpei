<style>
.title_lm li a {
color: #0164C1;
float: left;
font-size: 14px;
text-align: center;
}
</style>

<?php
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
$this->breadcrumbs = array(
        '营销管理' => Yii::app()->createUrl('common/marketlist'),
		'联盟营销' => Yii::app()->createUrl('dealer/partner/showrecomincome'),
        '营销收益'
    );
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li class="current"><a href="<?php echo Yii::app()->createUrl('dealer/partner/showrecomincome') ?>">营销收益 <span class="zwq_color"><?php echo $count[1] ?></a></span><span class="interval">  |</span></li>
            <li><a href="<?php echo Yii::app()->createUrl('dealer/partner/showrecommended') ?>">推荐记录 </a><span class="interval">  |</span></li>
        </ul>
    </div>



    <div id="tb" style="padding:5px 20px;height:auto">
        <div style='margin:10px 0px;'>
            <b>我的收益详情：</b>
        </div>
        <div class="m-top">
            <div class='nocss'>
                <p class='lh22'>
                    <span width='220'>年收益总额：<b style="color:#fb540e; font-size: 16px;font-family: '微软雅黑';">￥<?php echo $yearin ? $yearin : 0 ?></b></span>
                    <span width='220' style="margin-left:120px">&nbsp;上月实收金额：<b style="color:#fb540e; font-size: 16px;font-family: '微软雅黑';">￥<?php echo $monthin ? $monthin : 0 ?></b></span>
                    <span width='200' style="margin-left:120px">&nbsp;收益接收账户：<font style="color:red"><?php echo $IncomeAccount ? $IncomeAccount : '请添加支付宝账户' ?> </font></span>
                </p>
            </div>
        </div>
        <div class="m_top10">
        <form action="<?php echo Yii::app()->createUrl("/dealer/partner/showrecomincome");?>" method="post">
            <p class='form-row'>
                <span class='label label-inline'>机构名称：</span>
                <input class='width114 input' name="CompanyName">
                <span class='label label-inline'>手机：</span>
                <input class='width98 input' name="MobPhone">
                <span class='label label-inline'>&nbsp;邮箱：</span>
                <input class='width98 input' name="Email">
                <span class='label'></span>
                <input class='submit ml10 m_left' type='submit' id="search-btn" value='查询'>
            </p>
        </form>
        </div>
    </div>
    <div class="bor_back m_top10">
    	<?php
	    $this->widget('widgets.default.WGridView', array(
	        'dataProvider' => $dataProvider,
	        'columns' => array(
	            array(
	                'name' => '机构名称',
	                'value' => 'InquiryorderService::showIncomeDetail($data->ServiceID,"OrganName")'//'CHtml::encode($data->list->CompanyName)'
	            ),
	            array(
	                'name' => '姓名',
	                'value' =>'InquiryorderService::showIncomeName($data->RecomID,$data->ServiceID)'
	            ),
	            array(
	                'name' => '手机',
	                'value' =>'InquiryorderService::showIncomeDetail($data->ServiceID,"Phone")'
	            ),
	            array(
	                'name' => '邮箱',
	                'value' =>'InquiryorderService::showIncomeDetail($data->ServiceID,"Email")'
	            ),
	            array(
	                'name' => '收益',
	                'value' => 'CHtml::encode($data->income)'
	            ),
	            array(
	                'name' => '收益时间段',
	                'value' => 'CHtml::encode(date("Y年m月",strtotime("-1 month",$data->IncomeTime)))'
	            ),
	            array(
	                'class' => 'CButtonColumn',
	                'header' => '操作',
	                'template' => '{select}',
	                'buttons' => array(
	                    'select' => array(
	                        'label' => '查看详情',
	                        'url' => 'Yii::app()->createUrl("/dealer/partner/showdetail",array("ServiceID"=>$data->ServiceID))'
	                    )
	                )
	            ),
	        )
	    ))
	    ?>
    </div>
    <!--<div id="DetailDialog">
        <table id="DetailDatagird"></table>
    </div>-->
</div>
<script>
    /*$(document).ready(function(){
        $("#DetailDialog").dialog({
            title:"收益详情" ,
            width:800,
            height:416,
            modal:true,
            closed:true
        });
        $("#DetailDatagird").datagrid({
            width:786,
            height:380,
            pagination:true,
            rownumbers:true,
            singleSelect:true,
            method:'get',
            columns:[[
                    {
                        field: 'OrderName',
                        width:150, 
                        title: '订单编号'
                    },
                    {
                        field: 'OrderSN',
                        width:100, 
                        title: '订单编号'
                    },
                    {
                        field: 'SellerName',
                        width:150, 
                        title: '经销商名称'
                    },
                    {
                        field: 'BuyerName',
                        width:150, 
                        title: '服务店名称'
                    },
                    {
                        field: 'TotalAmount',
                        width:100, 
                        title: '订单总金额'
                    },
                    {
                        field: 'Incom',
                        width:100, 
                        title: '收益'
                    },
                ]]
            
        });
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/partner/partner/getrecomincome';
            var CompanyName = $("input[name=CompanyName]").val();
            var MobPhone = $("input[name=MobPhone]").val();
            var Email = $("input[name=Email]").val();	
            var CompanyType = $("select[name=CompanyType]").val();	
            var Month = $("select[name=Month]").val();	
            var RecomMethod = $("select[name=RecomMethod]").val();	
            var IsAccount = $("select[name=IsAccount]").val();	
            $('#dg').datagrid({ url:url,queryParams:{
                    'CompanyName':CompanyName,
                    'MobPhone':MobPhone,
                    'Email':Email,    	
                    'CompanyType':CompanyType,    	
                    'Month':Month,    	
                    'RecomMethod':RecomMethod,    	
                    'IsAccount':IsAccount	
                },method:"get"});
        });		
    });
    function showdetail(val,row,rowIndex){
        return '<a href="javascript:void(0)" onclick="Detail('+row.ServiceID+')">查看详情</a>';
    }
    function Detail(ServiceID){
        $("#DetailDialog").dialog({
            closed:false
        });
        $("#DetailDatagird").datagrid({
            url:Yii_baseUrl+"/partner/partner/showdetail",
            queryParams:{"ServiceID":ServiceID}
        });
    }*/
</script>
