var url;

//车型
function vehicle()
{
	 var row=$("#quotation").datagrid('getSelected');
	 if(row.VIN !='')
     {
     	$('#vins').find('span[name=VIN]').html(row.VIN);
     	$('#makes').hide();
     	$('#vins').show();
     }
     else
    {
     $('#vins').hide();
     $('#makes').show();
     var makekey=Array();
     $('#makes').find('span').each(function(){
         makekey.push($(this).attr('name'));
     });
     $.getJSON(
             Yii_baseUrl+'/mall/quotations/getvehicle',
             {
                 Make:row.Make,
                 Car:row.Car,
                 Year:row.Year,
                 Model:row.Model
             },
             function(data)
             {
             	if(data=='error')
                 {
             		
                  $("#makes").find("span").html('无');
 					
                 }
                 $.each(data,function(key,val){
                     //判断数据中的字段是否在namekey中
                     if($.inArray(key,makekey)>=0){
                         $("#makes").find("span[name="+key+"]").html(val);
                     }
                 });
             });
     	}
}
//创建
function newActive(){
    var row=$('#quotation').datagrid('getSelected');
    $("a[name=removeupload]").trigger("click");
    $('#message').text('');
    if(row)
    { 
        clearsearch();
        $('#ServiceName').val(row.ServiceName);
        $('#phone').val(row.Phone);
        $('#des').text(row.Describe);
//        $('#vehicle').text(row.Vehicle);
//        $('#vehicle').text(row.Vin);
        $('#filename').hide();
        $('#inquiry_pic').empty();
        $.tmpl("<a href='"+Yii_uploadUrl+"${PicPath}' target='_blank'>${PicName}</a><br>",row.InquiryPic).appendTo('#inquiry_pic');
        vehicle();
        if(row.Status=='待报价')
        {
            $('#quoactive').dialog('open').dialog('setTitle','新建报价');
            $('#quo_info').find('input[name=quotation]').val(row.quotation);
            $('#quo_info').find('input[name=ship]').val(row.ship);
            $('#goods_total').find('input[name=goods_total]').val(row.goods_total);
            if(row.Quosn==null)
            {
                time = (new Date()).valueOf();
                $('#qs').text('BJ'+time+row.organID);
            }
            if(row.Parts=='配件')
            {
                $('#parts_list').datagrid({
                    url: Yii_baseUrl+'/mall/quotations/partlist?InquiryID='+row.InquiryID
                });
                
                //$('#godlist').hide();
                //$('#move').hide();
                if(!$('#godlist').panel('options').closed)
                {
                    $('#godlist').panel('close');
                }
                if(!$('#move').panel('options').closed)
                {
                    $('#move').panel('close');
                }
                if($('#parts').panel('options').closed)
                {
                    $('#parts').panel('open');
                }   
                //$('#parts').show();
                //商品金额/报价隐藏
                $('#god').hide();
                $('#goods_total').hide();
                $('#bj').hide();
                $('#bjt').hide();
                $('#sip').css('text-align','left');
                $('#fe').css('text-align','left');
                
                url = Yii_baseUrl+'/mall/quotations/add?inquiryID='+row.InquiryID;
            }
            else
            { //商品金额/报价显示
            	 $('#god').show();
                 $('#goods_total').show();
                 $('#bj').show();
                 $('#bjt').show();
                 $('#sip').css('text-align','center');
                 $('#fe').css('text-align','center');
                 
                //$('#godlist').show();
                //$('#move').show();
                //$('#parts').hide();
                if($('#godlist').panel('options').closed)
                {
                    $('#godlist').panel('open');
                }
                if($('#move').panel('options').closed)
                {
                    $('#move').panel('open');
                }
                if(!$('#parts').panel('options').closed)
                {
                    $('#parts').panel('close');
                }
                $('#fm').form('clear');
                $('#quo_info').find('input[name=title]').val('BJ:'+row.organName);
                var data=[{
                    "id":1,
                    "value":"按商品首字母检索"
                },

                {
                    "id":2,
                    "value":"按商品OE号检索"
                },

                {
                    "id":3,
                    "value":"按商品编号检索"
                }
                ];
                $("#searchtype").combobox("loadData",data); //下拉框加载本地数据
                $("#searchtype").combobox('select',1);//下拉框默认选中
                $('#goods_buy').datagrid('loadData',{
                    total:0,
                    rows:[]
                });
                url = Yii_baseUrl+'/mall/quotations/add?inquiryID='+row.InquiryID;
            }
			
        }
        else if(row.Status=='已报价待确认')
        {
            $.messager.alert('提示信息','询价单已报价','warning');
        }
        else if(row.Status=='已确认')
        {
            $.messager.alert('提示信息','询价单已确认,不能报价','warning');
        }
    }
    else
    {
        $.messager.alert('提示信息','请先选择询价单','warning');
    }
}
function clearsearch()
{
    $("#god_name").attr("value","");
    var goodname='';
    var searchtype=1;
    var row=$('#quotation').datagrid('getSelected');
    $('#goods_list').datagrid({
        url: Yii_baseUrl+'/mall/quotations/goods',
        queryParams:{
        	'inquiryID': row.InquiryID,
            'type':searchtype,
            'goodname':goodname
        },
        method:'get'
    });
}
//修改
function edit()
{
    var row=$("#quotation").datagrid('getSelected');
    $("a[name=removeupload]").trigger("click");
    $('#message').text('');
    if(row)
    {
        clearsearch()
        $('#ServiceName').val(row.ServiceName);
        $('#phone').val(row.Phone);
        $('#des').text(row.Describe);
//        $('#vehicle').text(row.Vehicle);
//        $('#vehicle').text(row.Vin);
        $('#qs').text(row.Quosn);
        vehicle();
        if(row.Status=='已报价待确认')
        {
            if(row.Parts=='配件')
            { 
            	 //商品金额/报价隐藏
                $('#god').hide();
                $('#goods_total').hide();
                $('#bj').hide();
                $('#bjt').hide();
                $('#sip').css('text-align','left');
                $('#fe').css('text-align','left');
                
                $('#quoactive').dialog('open').dialog('setTitle','修改报价单');
                //$('#godlist').hide();
                //$('#move').hide();
                //$('#parts').show();
                if(!$('#godlist').panel('options').closed)
                {
                    $('#godlist').panel('close');
                }
                if(!$('#move').panel('options').closed)
                {
                    $('#move').panel('close');
                }
                if($('#parts').panel('options').closed)
                {
                    $('#parts').panel('open');
                }  
                $('#inquiry_pic').empty();
                $.tmpl("<a href='"+Yii_uploadUrl+"${PicPath}' target='_blank'>${PicName}</a><br>",row.InquiryPic).appendTo('#inquiry_pic');
                $('#filename').html(row.FileName);
                $('#filename').show();
                $('#quo_info').find('input[name=title]').val(row.title);
                $('#quo_info').find('input[name=quotation]').val(row.quotation);
                $('#quo_info').find('input[name=ship]').val(row.ship);
                $('#goods_total').find('input[name=goods_total]').val(row.goods_total);
                $('#parts_list').datagrid({
                    url: Yii_baseUrl+'/mall/quotations/partlist?InquiryID='+row.InquiryID
                })
                url = Yii_baseUrl+'/mall/quotations/edit?quoid='+row.QuoID;
            }
            else
            {
                //$('#godlist').show();
                //$('#move').show();
                //$('#parts').hide();
                if($('#godlist').panel('options').closed)
                {
                    $('#godlist').panel('open');
                }
                if($('#move').panel('options').closed)
                {
                    $('#move').panel('open');
                }
                if(!$('#parts').panel('options').closed)
                {
                    $('#parts').panel('close');
                }
                //商品金额/报价显示
           	    $('#god').show();
                $('#goods_total').show();
                $('#bj').show();
                $('#bjt').show();
                $('#sip').css('text-align','center');
                $('#fe').css('text-align','center');
                
                $('#goods_buy').datagrid({
                    url: Yii_baseUrl +'/mall/quotations/getorder?quoid='+row.QuoID
                });
                $('#inquiry_pic').empty();
                $.tmpl("<a href='"+Yii_uploadUrl+"${PicPath}' target='_blank'>${PicName}</a><br>",row.InquiryPic).appendTo('#inquiry_pic');
                $('#filename').html(row.FileName);
                $('#quo_info').find('input[name=title]').val(row.title);
                $('#quo_info').find('input[name=quotation]').val(row.quotation);
                $('#quo_info').find('input[name=ship]').val(row.ship);
                $('#goods_total').find('input[name=goods_total]').val(row.GoodFee);
                $('#quoactive').dialog('open').dialog('setTitle','修改报价单');
                $('#fm').form('clear');
                $('#fm').form('load',row);
                var data=[{
                    "id":1,
                    "value":"按商品首字母检索"
                },

                {
                    "id":2,
                    "value":"按商品OE号检索"
                },

                {
                    "id":3,
                    "value":"按商品编号检索"
                }
                ];
                $("#searchtype").combobox("loadData",data); //下拉框加载本地数据
                $("#searchtype").combobox('select',1);//下拉框默认选中
                $('#fm').find('input[type=file]').click(function(){
                    $('#filename').hide();
                });
                $('#filename').show();
                //changeprice()
                url = Yii_baseUrl+'/mall/quotations/edit?quoid='+row.QuoID;
            }
        }
        else if(row.Status=='待报价')
        {
            $.messager.alert('提示信息','先报价,后修改','warning');
        }
        else if(row.Status=='已确认')
        {
            $.messager.alert('提示信息','询价单已确认,不能修改','warning');
        }
    }else
    {
        $.messager.alert('提示信息','请选择要修改的询价单','warning');
    }
	
}
//点击发送
function save()
{
    var data='';
    var numdata='';
    var pricedata='';
    var qs=$('#qs').text();
    var goodtotal=$('#goods_total').find('input[name=goods_total]').val();
    var cateID='';
    var partlevel='';
    var row=$('#quotation').datagrid('getSelected');
    var cansave=1;   //不可以发送
    if(row.Parts=='配件')
    {   
        totals();
        $.messager.confirm('提示信息','您确定要发送?',function(r){
            if(r)
            {
                var parts=$('#parts_list').datagrid('getRows');
                $.each(parts,function(k,v){
                    if(v.ID)
                        cansave=2;  //可以发送
                    switch(v.PartsLevel)
                    {
                        case '原厂配件':
                            v.PartsLevel=0;
                            break;
                        case '高端品牌件':
                            v.PartsLevel=1;
                            break;
                        case '经济适用件':
                            v.PartsLevel=2;
                            break;
                    }
                    data=data+v.ID+',';
                    numdata=numdata+v.Number+',';
                    pricedata=pricedata+v.Price+',';
                    cateID=cateID+v.categoryID+',';
                    partlevel=partlevel+v.PartsLevel+',';
                });
                goodtotal=$('#goods_total').find('input[name=goods_total]').val();
                $('#order_data').val(data);
                $('#goods_num').val(numdata);
                $('#goods_price').val(pricedata);
                $('#quo_no').val(qs);
                $('#goods_sum').val(goodtotal);    
                $('#inquiryID').val(row.InquiryID);
                $('#cateID').val(cateID);
                $('#partlevel').val(partlevel);
                if(cansave==1)
                {
                    $.messager.alert('提示信息','无相关商品不能报价','info');
                    return false;
                }
                $('#fm').form('submit',{
                    url: url,
                    onSubmit: function(){
                        return $(this).form('validate');
                    },
                    success: function(result) {
                        result=eval("("+result+")")
                        if(result.message)
                        {
                            $('#message').text(result.message);
                            $("a[name=removeupload]").trigger("click");                      
                        }
                        else if(result.msg)
                        	{
                        	 $.messager.alert("提示信息", result.msg,'info');
                        	 return false;
                        	}
                        else if(result) {
                            $.messager.alert("提示信息", "发送成功");
                            $("#quoactive").dialog("close");
                            $('#quotation').datagrid('reload'); 
                        }
                        else {
                            $.messager.alert("提示信息", "发送失败");
                        }
                    }
                });
            }
        });
    }
    else
    {
        var all=$('#goods_buy').datagrid('getRows');
        if(all=='')
        {
            $.messager.alert('提示信息','请选择商品添加到商品清单列表中','info');
            return false;
        }
        $.messager.confirm('提示信息','您确定要发送?',function(r){
            if(r)
            {
	
                var rowdata= $('#goods_buy').datagrid('getRows');
                $.each(rowdata,function(ind,val){
                    data=data+val.ID+',';
                    numdata=numdata+val.Num+',';
                    pricedata=pricedata+val.ProPrice+',';
                });
                $('#order_data').val(data);
                $('#goods_num').val(numdata);
                $('#goods_price').val(pricedata);
                $('#quo_no').val(qs);
                $('#goods_sum').val(goodtotal);
                $('#fm').form('submit',{
                    url: url,
                    onSubmit: function(){
                        return $(this).form('validate');
                    },
                    success: function(result) {
                        result=eval("("+result+")")
                        if(result.message)
                        {
                            $('#message').text(result.message);
                        }
                        else if(result) {
                            $.messager.alert("提示信息", "发送成功");
                            $("#quoactive").dialog("close");
                            $('#quotation').datagrid('reload');
                
                        }
                        else {
                            $.messager.alert("提示信息", "发送失败");
                        }
                    }
                });
            }
        });
    }
}
//关闭窗口
function addcancle()
{
    $.messager.confirm('提示信息','您确定要关闭?',function(r){
        if(r)
        {
            $('#quoactive').dialog('close');
            $("a[name=removeupload]").trigger("click");
        }
    });
}
//商品检索
$('#add').find("input[name=goods_name]").change(function(){
    var url=Yii_baseUrl+'/mall/quotations/goods';
    var goodname=$('#goods_search').find("input[name='goods_name']").val().toString();
    var searchtype=$('#searchtype').combobox('getValue');
    $('#goods_list').datagrid({
        url: url,
        queryParams:{
            'type':searchtype,
            'goodname':goodname
        },
        method:'get',
        onLoadSuccess: function (data) {
            $('#goods_list tr').focus();
        }
    });
 
});
$('#add').find("input[name=goods_name]").keydown(function(ev){
	
    if(ev.keyCode==13) {
        $('#add').find("input[name=goods_name]").change();
    }
	
})

//询价单搜索
$('#quo_search').delegate('a','click',function()
{
    var url=Yii_baseUrl+'/mall/quotations/list';
    var inquiry_no=$('#inquiry_no').val().toString();
    var inquiry_type=$('#type').val().toString();
    var begintime=$('#quo_search').find('input[name=begintime]').val().toString();
    var endtime=$('#quo_search').find('input[name=endtime]').val().toString();
    var date = new Date();
    var y = date.getFullYear();
    var m = date.getMonth()+1;
    var d = date.getDate();
    var start=new Date(begintime.replace("-", "/").replace("-", "/"));
    var end=new Date(endtime.replace("-", "/").replace("-", "/"));
    if(start>end)
    {
        $.messager.alert('提示信息','开始日期不能小于截止日期!','warning');
        return false;  
    }
    $('#quotation').datagrid({
        url:url,
        queryParams:{
            'inquiry_no':inquiry_no,
            'inquiry_type': inquiry_type,
            'begintime': begintime,
            'endtime': endtime
        },
        'method':'get'
    });
});
//回车事件
//$('#add').find("input[name=goods_name]").focus(function(){
//	$('#add').find("input[name=goods_name]").attr("target","input");
//})
//$('#add').find("input[name=goods_name]").blur(function(){
//	$('#add').find("input[name=goods_name]").attr("target","");
//})
//添加商品
function addgoods(){
    var data=$('#goods_list').datagrid('getSelected');
    
    if(data)
    { 
        var j=0;
        var row=$('#goods_list').datagrid('getSelections');
        $.each(row,function(index,value){
            value.Num=1;
            if(value.LogisticsPrice==null)
            {
                value.LogisticsPrice=parseInt(0);
            }
            value.Total=(parseFloat(value.ProPrice)*parseInt(value.Num))+(parseFloat(value.LogisticsPrice)*parseInt(value.Num));
            value.Total = (value.Total).toFixed(2); 
            var order=$('#goods_buy').datagrid('getRows');
            if(order.length>0)
            {
                $.each(order,function(ind,val){
                    if(val.ID==value.ID)
                    {
                        j=1;
                    }
                });
            }
        });
        if(j==1)
        {
            $.messager.show({
                title: '提示信息',
                msg: '商品已经存在,请在商品清单中修改数量.',
                timeout: 1500,
                showType: 'show'
            }); 
        }
        else
        {
            $.each(row,function(index,value){
                $('#goods_buy').datagrid('appendRow',data);
            });
            //调用计算总价方法
            clicktotal();
        }
    }
}

$('#goods_list').datagrid({

    onSelect:function(rowIndex, rowData)
    {
        $('#add').find("input[name=goods_name]").attr("target","grid");
    }
});

//移除商品清单
$('#goods_buy').datagrid({
    onAfterEdit: function (rowIndex, rowData, changes) {
        //编辑完触发 
        if(changes)
        {
            rowData.Total=(parseFloat(rowData.ProPrice)*parseInt(rowData.Num))+(parseFloat(rowData.LogisticsPrice)*parseInt(rowData.Num));
            rowData.Total=(rowData.Total).toFixed(2);
            //当修改完数量后更新本条记录
            $('#goods_buy').datagrid('updateRow',{
                index: rowIndex,
                row: rowData
            });
            var sum=0;
            var shipsum=0;
            var goodsum=0;
            var all=$('#goods_buy').datagrid('getRows');
            $.each(all,function(ie,ve){
                sum+=parseFloat(ve.Total);
                shipsum+=(parseFloat(ve.LogisticsPrice)*parseInt(ve.Num));
                goodsum+=parseFloat(ve.ProPrice)*parseInt(ve.Num);
            });
            sum=sum.toFixed(2);
            shipsum=shipsum.toFixed(2);
            goodsum=goodsum.toFixed(2);
            var oldships=$('#fm').find('input[name=ship]').val();
            shipsum=parseFloat(shipsum)+parseFloat(oldships);
            changeprice();
            var quotationprice=parseFloat(shipsum)+parseFloat(goodsum);
            $('#fm').find('input[name=quotation]').val(quotationprice);
            $('#fm').find('input[name=ship]').val(shipsum);
            $('#goods_total').find('input[name=goods_total]').val(goodsum);
        }
		   
    } 
});
//订购数量可编辑
$.extend($.fn.datagrid.methods, {
    editCell: function(jq,param){
        return jq.each(function(){
            var opts = $(this).datagrid('options');
            var fields = $(this).datagrid('getColumnFields',true).concat($(this).datagrid('getColumnFields'));
            for(var i=0; i<fields.length; i++){
                var col = $(this).datagrid('getColumnOption', fields[i]);
                col.editor1 = col.editor;
                if (fields[i] != param.field){
                    col.editor = null;
                }
            }
            $(this).datagrid('beginEdit', param.index);
            for(var i=0; i<fields.length; i++){
                var col = $(this).datagrid('getColumnOption', fields[i]);
                col.editor = col.editor1;
            }
        });
    }
});
var editIndex = undefined;
function endEditing(){
    if (editIndex == undefined){
        return true
        }
    if ($('#goods_buy').datagrid('validateRow', editIndex)){
        $('#goods_buy').datagrid('endEdit', editIndex);
        editIndex = undefined;
        return true;
    } else {
        return false;
    }
}
function onClickCell(index, field){
    if (endEditing()){
        $('#goods_buy').datagrid('selectRow', index)
        .datagrid('editCell', {
            index:index,
            field:field
        });
        editIndex = index;
    }
}
//扩展验证
$.extend($.fn.validatebox.defaults.rules, {
    currency : {// 验证货币 
        required:true,
        validator : function(value) { 
            return /^\d+(\.\d{1,2})?$/i.test(value); 
        }, 
        message : '货币格式不正确(只能保留小数点两位)' 
    }, 
    integer : {// 验证整数 
        validator : function(value) { 
            return /^[+]?[1-9]+\d*$/i.test(value); 
        }, 
        message : '请输入正整数' 
    }
		   
});
//数量正整数
$.extend($.fn.numberbox.defaults,{
    min:1, 
    precision:0
});
//扩展dialog随意调整大小
$.extend($.fn.dialog.defaults,{
    resizable:true
})
//表格鼠标事件
$.extend($.fn.datagrid.methods, {
    keyCtr : function (jq) {
        return jq.each(function () {
            var grid = $(this);
            grid.datagrid('getPanel').panel('panel').attr('tabindex', 1).bind('keydown', function (e) {
                switch (e.keyCode) {
                    case 38: // up
                        var selected = grid.datagrid('getSelected');
                        if (selected) {
                            var index = grid.datagrid('getRowIndex', selected);
                            grid.datagrid('selectRow', index - 1);
                        } else {
                            var rows = grid.datagrid('getRows');
                            grid.datagrid('selectRow', rows.length - 1);
                        }
                        break;
                    case 40: // down
                        var selected = grid.datagrid('getSelected');
                        if (selected) {
                            var index = grid.datagrid('getRowIndex', selected);
                            grid.datagrid('selectRow', index + 1);
                        } else {
                            grid.datagrid('selectRow', 0);
                        }
                        break;
                    case 13:
                        addgoods();
                }
            });
        });
    }
});
$("#goods_list").datagrid({}).datagrid("keyCtr");
$("#goods_buy").datagrid({}).datagrid("keyCtr");
function cellStyler(value,row,index){
    return 'color:red';
}
//询价单详情弹框
function Showdetail(val,row){
    var rowindex=$("#quotation").datagrid("getRowIndex",row);
    return '<a href="javascript:void(0)" onClick="Inquirydetail('+rowindex+')" class="showdetail">'+val+'</a>';
}
function Inquirydetail(rowID){
    $("#quotation").datagrid("selectRow",rowID);
    var rows=$('#quotation').datagrid('getSelected');
    $("#picdiv").empty();
    $('#standardname').hide();
    $('#service').find('span[name=ServiceName]').html(rows.ServiceName);
    $('#service').find('span[name=ServicePhone]').html(rows.Phone);
    $('#Describe').text(rows.Describe);
    if(rows.VIN=='')
    {
        $('#VINinfo').hide();
        $('#vehicleinfo').show();
        var namekey=Array();
        $('#vehicleinfo').find('span').each(function(){
            namekey.push($(this).attr('name'));
        });
        $.getJSON(
            Yii_baseUrl+'/mall/quotations/getvehicle',
            {
                Make:rows.Make,
                Car:rows.Car,
                Year:rows.Year,
                Model:rows.Model
            },
            function(data)
            {
                if(data=='error')
                {
					
                    $("#vehicleinfo").find("span").html('无');
					
                }
                $.each(data,function(key,val){
                    //判断数据中的字段是否在namekey中
                    if($.inArray(key,namekey)>=0){
                        $("#vehicleinfo").find("span[name="+key+"]").html(val);
                    }
                });
            });
    }else
    {
        $('#VINinfo').find('span[name=VIN]').html(rows.VIN);
        $('#vehicleinfo').hide();
        $('#VINinfo').show();
    }
    $.getJSON(Yii_baseUrl + "/mall/quotations/getinquirypic",{
        inquiryID: rows.InquiryID
    },function(data){
        if(data.length>0){
            $.tmpl("<p class='form-row' style='margin: 0 0 3px 0;'>"+
                "<label class='label label-inline-wa'>附件${serialnum}：</label>"+
                // 		                "<span class='width220' style='width: 220px;'>${PicName}</span></p>",data).appendTo("#picdiv");
                " <a href='"+Yii_uploadUrl+"${PicPath}' target='_blank'>${PicName}</a><br>",data).appendTo('#picdiv');
        }
    });
		   
    if(rows.Status=='已报价待确认'|| rows.Status=='已确认')
    { 
        $('#quoinfos').show();
        var namequo=Array();
        if(rows.FileName==null)
        {
            $('#Files').html("<span>无</span>");
        }
        else{
            //附件
            $('#Files').html("<span id='down' style='color:#fc6a03;cursor:pointer'>"+rows.FileName+"</span>")
            //点击附件下载
            $('#down').click(function(){
                var FilePath=$('#FilePath').val(rows.File);
                var FileName=$('#FileName').val(rows.FileName);
                $('#importform').form({
                    url:Yii_baseUrl +'/mall/quotations/down',
                    success:function(data){
                        var result = eval('('+data+')');
                        if(result.fail)
                            $.messager.alert('提示', result.fail, 'info');
                    }
                });
                $('#importform').submit();
				
            });
        }
        $('#quoinfo').find('span').each(function()
        {
            namequo.push($(this).attr('name'));
        });
		
        $.getJSON(
            Yii_baseUrl+"/mall/quotations/detail",
            {
                inquiryID: rows.InquiryID
            },
            function(data)
            {
                $.each(data,function(ik,vk){
                    if($.inArray(ik,namequo)>=0)
                    {
                        $('#quoinfo').find("span[name="+ik+"]").html(vk);
                    }
                });
            });
        if(rows.Parts=='配件')
        {
            $('#gdt').hide();
            $('#dlst').show();
            //报价/商品总金额隐藏
            $('#godfe').hide();
            $('#quofe').hide();
            
            $('#detail_list').datagrid({
                url: Yii_baseUrl+'/mall/quotations/partlist?InquiryID='+rows.InquiryID
            });
        }
        else{
            if(rows.QuoID!=null)
            {
            	 //报价/商品总金额隐藏
                $('#godfe').show();
                $('#quofe').show();
                
                $('#gdt').show();
                $('#dlst').hide();
                $('#goods_detail').datagrid({
                    url: Yii_baseUrl+'/mall/quotations/getorder?quoid='+rows.QuoID
                });
            }
        }
				
    }
    if(rows.Status=='待报价')
    {
        $('#quoinfos').hide();
        if(rows.Parts=='配件')
        {
            //获取询价单配件标准名称
            $.getJSON(Yii_baseUrl+'/mall/quotations/getstandardname?InquiryID='+rows.InquiryID,{},function(res){
                if(res.name)
                {
                    $('#standardname').show();
                    $('#standardlabel').text(res.name);
                    
                }
            })
        }            
    }
    $('#detail').dialog('open').dialog('setTitle','详细信息');
}

//数量修改
function nummodif(val,row,index)
{
    return '<div style="margin-top:5px;" class="num-control display-ib"><a class="s float-l" onclick="numsub('+row.ID+','+row.Num+')" href="javascript:;"></a>'+
    '<input class="float-l goods_amount" type="text" value="'+val+'" onkeyup="numkeyup('+row.Num+',this);" onblur="numblur('+row.ID+','+row.Num+',this);">'+
    '<a class="a float-l" onclick="numadd('+row.ID+','+row.Num+')" href="javascript:; "></a></div>';
}

//输入商品数量
function numkeyup(num,obj){
    var	val = obj.value;
    if(val<=1){
        obj.value=1;
    }
    if(isNaN(val))
    {
        //alert('只能输入数字！');
        obj.value=1;
    }
    obj.value=obj.value.replace(/\D/g,'') ;
}

//鼠标移出商品数量
function numblur(id,num,obj){
    var	val = obj.value;
    if(isNaN(val))
    {
        //        alert('只能输入数字！');
        obj.value=1;
    }
    var index=$('#goods_buy').datagrid('getRowIndex',id);
    $('#goods_buy').datagrid('updateRow',{
        index:index,
        row:{
            Num:obj.value
        }
    });
    total(index);
}

//数量减一
function numsub(id,num)
{
    var index=$('#goods_buy').datagrid('getRowIndex',id);
    if(num>1)
    {
        num=num-1;
    }
    else
        return;
    $('#goods_buy').datagrid('updateRow',{index:index,row:{Num:num}}); 
    total(index);
}

//数量加一
function numadd(id,num)
{
    var index=$('#goods_buy').datagrid('getRowIndex',id);
    num=num+1;
    $('#goods_buy').datagrid('updateRow',{index:index,row:{Num:num}}); 
    total(index);
}

function deletes(val,row,rowindex)
{
    return '<a href="javascript:void(0)" onclick="delgood('+row.ID+')" class="easyui-linkbutton">'+val+'</a>';
}
function delgood(ID)
{
    $('#goods_buy').datagrid('selectRecord',ID);
    var row=$('#goods_buy').datagrid('getSelected');
    var index =$("#goods_buy").datagrid("getRowIndex",row);
    $('#goods_buy').datagrid('deleteRow',index);
    var sum=0;
    var shipsum=0;
    var goodsum=0;
    var all=$('#goods_buy').datagrid('getRows');
    $.each(all,function(ie,ve){
        sum+=parseFloat(ve.Total);
        shipsum+=(parseFloat(ve.LogisticsPrice)*parseFloat(ve.Num));
        goodsum+=parseFloat(ve.ProPrice)*parseInt(ve.Num);
    });
    sum=sum.toFixed(2);
    shipsum=shipsum.toFixed(2);
    goodsum=goodsum.toFixed(2);
    var oldships=$('#fm').find('input[name=ship]').val();
    shipsum=parseFloat(shipsum)+parseFloat(oldships);
    changeprice();
    var quotationprice=parseFloat(shipsum)+parseFloat(goodsum);
    $('#fm').find('input[name=quotation]').val(quotationprice);
    $('#fm').find('input[name=ship]').val(shipsum);
    $('#goods_total').find('input[name=goods_total]').val(goodsum);
}
//屏蔽backspace键
if (typeof window.event != 'undefined') {  
    document.onkeydown = function() {  
        var type = event.srcElement.type;  
        var code = event.keyCode;  
        return ((code != 8 && code != 13) ||  
            (type == 'text' && code != 13 ) ||  
            (type == 'textarea') ||  
            (type == 'submit' && code == 13))  
    }  
} else { // FireFox/Others  
    document.onkeypress = function(e) {  
    
        var type = e.target.localName.toLowerCase();  
        var code = e.keyCode;  
        if ((code != 8 && code != 13) ||  
            (type == 'input' && code != 13 ) ||  
            (type == 'textarea') ||  
            (type == 'submit' && code == 13)) {  
            return true;  
        } else {  
            return false ;  
        }  
    }  
} 

//按钮事件添加商品
$('#goods_add').click(function(){
    var data=$('#goods_list').datagrid('getSelected');
    if(data)
    {
        var j=0;
        var row=$('#goods_list').datagrid('getSelections');
        $.each(row,function(index,value){
            value.Num=1;
            if(value.LogisticsPrice==null)
            {
                value.LogisticsPrice=parseInt(0);
            }
            value.Total=(parseFloat(value.ProPrice)*parseInt(value.Num))+(parseFloat(value.LogisticsPrice)*parseInt(value.Num));
            value.Total = (value.Total).toFixed(2); 
            var order=$('#goods_buy').datagrid('getRows');
            if(order.length>0)
            {
                $.each(order,function(ind,val){
                    if(val.ID==value.ID)
                    {
                        j=1;
                    }
	  				
                });
            }
        });
        if(j==1)
        {
            $.messager.alert('提示信息',"商品已经存在,请在商品清单中修改数量",'warning');
        }
        else
        {
            $.each(row,function(index,value){
                $('#goods_buy').datagrid('appendRow',value);
            });
            //调用计算总价方法
            clicktotal()
        }
    }
    else
    {
        $.messager.alert('提示信息','请选择要添加的商品','warning');
    }
});
//计算总价
function clicktotal()
{
    var all=$('#goods_buy').datagrid('getRows');
    var sum=0;
    var shipsum=0;
    var goodsum=0;
    $.each(all,function(ie,ve){
        sum+=parseFloat(ve.Total);
        shipsum+=parseFloat(ve.LogisticsPrice);
        goodsum+=parseFloat(ve.ProPrice)*parseInt(ve.Num);
    });
    sum=sum.toFixed(2);
    shipsum=shipsum.toFixed(2);
    goodsum=goodsum.toFixed(2);

    var oldships=$('#fm').find('input[name=ship]').val();
    if(oldships=='')
        oldships=0;
    shipsum=parseFloat(shipsum)+parseFloat(oldships);
    changeprice();
    var quotationprice=parseFloat(shipsum)+parseFloat(goodsum);
    $('#fm').find('input[name=quotation]').val(quotationprice);
    $('#fm').find('input[name=ship]').val(shipsum);
    $('#goods_total').find('input[name=goods_total]').val(goodsum);
    
    
}
function total(index)
{
    var value=$('#goods_buy').datagrid('selectRow',index).datagrid('getSelected'); 
    if(value.Num=='')
    {
        value.Num=1;
    }
    var sum=0;
    var shipsum=0;
    var goodsum=0;
    value.Total=(parseFloat(value.ProPrice)*parseInt(value.Num))+parseFloat(value.LogisticsPrice)*parseInt(value.Num);
    value.Total=(value.Total).toFixed(2);
    $('#goods_buy').datagrid('updateRow',{
        index:index,
        row:{
            Total:value.Total
            }
        });
    $('#goods_buy').datagrid('unselectRow',index);
var all=$('#goods_buy').datagrid('getRows');
$.each(all,function(ie,ve){
    sum+=parseFloat(ve.Total);
    shipsum+=(parseFloat(ve.LogisticsPrice)*parseInt(ve.Num));
    goodsum+=parseFloat(ve.ProPrice)*parseInt(ve.Num);
});
sum=sum.toFixed(2);
shipsum=shipsum.toFixed(2);
goodsum=goodsum.toFixed(2);
var oldships=$('#fm').find('input[name=ship]').val();
shipsum=parseFloat(shipsum)+parseFloat(oldships);
changeprice();
var quotationprice=parseFloat(shipsum)+parseFloat(goodsum);
$('#fm').find('input[name=quotation]').val(quotationprice);
$('#fm').find('input[name=ship]').val(shipsum);
$('#goods_total').find('input[name=goods_total]').val(goodsum);

}
function changeprice()
{
	 $('#fm').find('input[name=ship]').change(function(){
		   var changesum=$('#goods_total').find('input[name=goods_total]').val();
			var ships=$('#fm').find('input[name=ship]').val();
//			if(changesum=='')
//			{
//				changesum=$('#goods_total').find('input[name=goods_total]').val('0.00');
//				changesum=0.00;
//			}
			if(ships=='')
			{
				ships=$('#fm').find('input[name=ship]').val('0.00');
				ships=0.00
			}
			ships=parseFloat(ships).toFixed(2);
			changesum=parseFloat(changesum).toFixed(2);
			var shiptotal=parseFloat(changesum)+parseFloat(ships);
			 shiptotal=shiptotal.toFixed(2);
			
			$('#fm').find('input[name=quotation]').val(shiptotal);
		});

}

function formatprices(val,row,index)
{
    return '<input class="easyui-validatebox width190 input" validType="price"  value="'+val+'" onkeyup="pricekeyup('+row.ProPrice+',this);" onblur="priceblur('+row.ID+','+row.ProPrice+',this);">'
}

//输入商品单价
function pricekeyup(price,obj){
    var val=obj.value;
    if(!$.isNumeric(val))
    {
        //alert('只能输入数字！');
        if(val!='')
           obj.value=price;
    }
}

//鼠标移出商品单价
function priceblur(id,price,obj){
    if(obj.value=='')
        obj.value='0';
    else if(obj.value.indexOf(".")==-1&&obj.value>0)
    {
        //如果不是小数且第一位是0就去掉
        if(obj.value.substr(0,1)=='0')
           obj.value=obj.value.substr(1);    
    }
    var	val = parseFloat(obj.value);
    var reg = new RegExp("^[0-9]+(.[0-9]{1,2})?$", "g");  
    if (!reg.test(val)) {  
        obj.value=val.toFixed(2); 
    }
    var index=$('#goods_buy').datagrid('getRowIndex',id);
    $('#goods_buy').datagrid('updateRow',{
        index:index,
        row:{
            ProPrice:obj.value
        }
    });
    total(index);
}
