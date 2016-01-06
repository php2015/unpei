<div class="easyui-panel" id="tab4panel" style="width:648px;height:310px" closed="true">			
    <table id="unusualdg" class="easyui-datagrid" style="height:310px"
           data-options="region:'center',pagination:true,
           rownumbers:true,fitColumns:true,singleSelect:true,
           url:'<?php echo Yii::app()->createUrl("mall/sell/logislist"); ?>',
           method:'get',
           queryParams:{'Status':'unusual'},
           view: myview,
           emptyMsg: '暂无数据',
           onClickRow:clickunusualrow">
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
//datagrid为空时显示 '暂无数据'
var myview = $.extend({},$.fn.datagrid.defaults.view,{
    onAfterRender:function(target){
        $.fn.datagrid.defaults.view.onAfterRender.call(this,target);
        var opts = $(target).datagrid('options');
        var vc = $(target).datagrid('getPanel').children('div.datagrid-view');
        vc.children('div.datagrid-empty').remove();
        if (!$(target).datagrid('getRows').length){
            var d = $('<div class="datagrid-empty"></div>').html(opts.emptyMsg || 'no records').appendTo(vc);
            d.css({
                position:'absolute',
                left:0,
                top:50,
                width:'100%',
                textAlign:'center'
            });
        }
    }
});

function clickunusualrow()
{
    location.href=Yii_baseUrl+'/mall/sell/index/Status/unusual'
}
</script>