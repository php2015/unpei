<div class="easyui-panel" id="tab3panel" style="width:648px;height:310px" closed="true">			
    <table id="orderdg" class="easyui-datagrid" style="height:310px"
           data-options="region:'center',pagination:true,
           rownumbers:true,fitColumns:true,singleSelect:true,
           url:'<?php echo Yii::app()->createUrl("mall/sell/logislist"); ?>',
           method:'get',
           queryParams:{'Status':'2'},
           view: myview,
           emptyMsg: '暂无数据',
           onClickRow:clickorderrow">
        <thead>
            <tr>
                <th field="CreateTime" width="50" align="center">下单时间</th>
                <th field="OrderSN" width="50" align="center">订单编号</th>
                <th field="BuyerName" width="65" align="center">机构名称</th>
                <th field="TotalAmount" width="35" align="center">总金额</th>
                <th field="GoodsList" width="50" align="center" >商品清单</th>
            </tr>
        </thead>
    </table>
</div>
<script>
function formatSeller(val,row)
{
    var url = Yii_baseUrl + "/dealer/makequery/servicedetail/id/"+row.BuyerID;
    return "<a href='"+url+"' target='_blank' style='cursor:pointer;'>"+val+"</a>";
}

function clickorderrow()
{
    location.href=Yii_baseUrl+'/mall/sell/index/Status/2'
}
</script>