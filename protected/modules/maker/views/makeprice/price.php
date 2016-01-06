<div class='tabs' pre='tab'>
		<a class='left-indent'>&nbsp;</a>
                <a href="<?php echo Yii::app()->createUrl("maker/makeprice/index"); ?>">客户类别管理</a>
		<a href="<?php echo Yii::app()->createUrl('maker/makeprice/price')?>" class="active">客户价格管理</a>
</div>
<div class="easyui-layout" id="jp-layout" style="height:550px">
    <table id="goods" class="easyui-datagrid"  style="height:550px"
           data-options="
           method:'get',pageSize:20,pageList:[20,50,100,200,500],
           rownumbers:true,
           region:'center',
           fitColumns:false,
           pagination:true,
           singleSelect:true,
           url:'<?php echo Yii::app()->createUrl('/maker/makeprice/getprice'); ?>',
           toolbar:'#price_tb',
           view: myview,
           emptyMsg: '暂无数据'">
        <thead data-options="frozen:true">
            <tr>
                <th data-options="field:'goodsno',width:90,align:'center'">商品编号</th>
                <th data-options="field:'goodsname',width:90,align:'center'">商品名称</th>
                <th data-options="field:'brandname',width:80,align:'center'">商品品牌</th>
                <th data-options="field:'cp_name',width:120,align:'center'">标准名称</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <?php foreach($type as $v):?>
		<th data-options="field:'type<?php echo $v['TypeID'];?>',width:90,align:'center'"><?php echo $v['TypeName']?></th>
                <?php endforeach;?>
            </tr>
        </thead>
    </table>
</div>
<div id="price_tb">
    <p class="form-row" style="margin:15px 0 0 10px">
    &nbsp;&nbsp;客户类别：     
    <select id="ctype" name="mainCar" value="" class="easyui-combogrid" style="width:180px;height:26px;" data-options="
    panelWidth:180,multiple: true,fitColumns: true,idField: 'TypeID',textField: 'TypeName',method: 'get',editable:false,
    url:'<?php echo Yii::app()->createUrl('/maker/makeprice/getctype'); ?>',columns: [[
    {field:'seriesId',checkbox:true},{field:'TypeName',title:'客户类别',width:150,align:'center'},
    ]],
    "></select>
    &nbsp;&nbsp;<label>商品品牌：</label>
    <?php echo CHtml::dropDownlist('GoodsBrand','',CHtml::listData($cate,'BrandID','BrandName'),
               array('class'=>'width120 select','empty'=>'请选择商品品牌','id'=>'goodsbrand'))?>
    </p>
    <p class="form-row" style="margin:15px 0 0px 10px">
    &nbsp;&nbsp;<label>配件品类：</label>
    <?php
        $res = Commonmodel::Getcpnames();
        $params = array('class' => 'width230 select', 'id' => 'leafCategorysearch','empty'=>'请选择配件品类');
        ?>
    <?php echo CHtml::dropDownlist('leafCategorysearch', '', $res['cpnames'], $params);?> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="search-btn" class="btn-green" value="查 询">
    </p>
    <p class="form-row">
    &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editPrice()">修改价格</a>
    &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="importPrice()">价格批量导入</a>
    </p>
</div>
<div id="editprice_dlg"  class="easyui-dialog easyui-layout" style="width:340px;height:320px;padding:20px 20px"
     closed="true" buttons="#dlg-quote" modal="true">
    <form id="editprice_fm" method="post"><table id="editprice_tb"></table><input type="hidden" name="GoodsID" /></form>
    <div id="dlg-quote">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="save-btn" onclick="savePrice()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#editprice_dlg').dialog('close')">取消</a>
    </div>
</div>
<?php $this->renderPartial('import');?>
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

$('#search-btn').click(function(){
    var ctype=String($('#ctype').combogrid('getValues'));
    var goodsbrand=$('#goodsbrand').val();
    var standardid=$('#leafCategorysearch').val();
    $.ajax({
           url:Yii_baseUrl + "/maker/makeprice/getctype",
           type:'get',
           data:{
               'ctype':ctype
           },
           dataType:'json',
           success:function(data)
           {
                options={}; 
                options.queryParams = { 
                   'ctype':ctype,
                   'goodsbrand':goodsbrand,
                   'standardid':standardid
                }; 
                var s="[[";
                for(var i in data){
                    s+="{field:'type"+data[i].TypeID+"',title:'"+data[i].TypeName+"',width:100,align:'center'},";
                }
                s+="]]";
                options.columns=eval(s);
                $('#goods').datagrid(options); 
                $('#goods').datagrid('reload');  
           }
    })
})

//修改价格函数
function editPrice(){
    var row = $('#goods').datagrid('getSelected');
    if(row){
        $('#editprice_dlg').dialog({closed:false,title:'修改商品价格'});
        var url= Yii_baseUrl + "/maker/makeprice/getgprice";
        $.getJSON(url, {'GoodsID':row.GoodsID}, function(result){
            if(result){
                var html='';
                var price='';
                for(var i in result){
                    price=result[i].price?result[i].price:0;
                    html+='<tr style="height:30px">';
                    html+='<td align="right" width="90">'+result[i].name+'：</td>';
                    html+='<td align="left" width="180">';
                    html+='<input class="width150 input" name="'+result[i].type+'" value="'+result[i].price+'" \n\
                    onkeyup="pricekeyup(this,'+price+');" onblur="priceblur(this);"></td></tr>';
                }
                $('#editprice_tb').html(html);
            }
            $('input[name=GoodsID]').val(row.GoodsID);
        });
    }
    else{
        $.messager.show({
            title:'提示',
            msg:'请先选择待修改的商品'
        })
    }
}

//验证价格格式
function pricekeyup(obj,price){
    var val=obj.value;
    if(price){
        if(obj.value!=''){
            if(!$.isNumeric(val))
            {
                obj.value=price;
            }
        }
    }
    else{
        if(!$.isNumeric(val))
        {
            obj.value='';
        }
    }
}
function priceblur(obj){
    if(obj.value!=''){
        if(obj.value.indexOf(".")==-1&&obj.value>0)
        {
            //如果不是小数且第一位是0就去掉
            if(obj.value.substr(0,1)=='0')
                obj.value=obj.value.substr(1);    
        }
        var val = parseFloat(obj.value);
        var reg = new RegExp("^[0-9]+(.[0-9]{1,2})?$", "g");  
        if (!reg.test(val)) {  
            obj.value=val.toFixed(2); 
        }
    }
}

//保存修改价格
function savePrice(){
    var url = Yii_baseUrl + "/maker/makeprice/editprice";
    $('#editprice_fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            if(result=='1'){
                $('#editprice_dlg').dialog('close'); // close the dialog
                $.messager.show({
                    title: '提示',
                    msg: '价格修改成功！'
                });
                $('#goods').datagrid('reload');//reload the user data
            } else {
                $.messager.show({
                    title: '错误信息',
                    msg: '价格修改失败，请稍后再试！'
                });
            }
        }
    });
}
</script>