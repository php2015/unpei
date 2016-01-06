$(document).ready(function(){
    //搜索商品初始化
    var data=[{"id":1,"value":"按商品字母检索"},
           {"id":2,"value":"按商品OE号检索"},
           {"id":3,"value":"按商品编号检索"}
     ];
     $("#searchtype").combobox("loadData",data); //下拉框加载本地数据
     
     //加载报价单
    $('#quolists').datagrid({ 
        rownumbers:true,
        pagination:true,
        singleSelect:true,
        fitColumns:true,
        url:Yii_baseUrl +'/mall/quotationorder/Getquolists',
        method:'get',
        toolbar:'#toolbar',
        columns:[[
                  {field:'Title',title:'报价单名称',width:100},
                  {field:'QuoSn',title:'报价单编号',width:100},
                  {field:'servicename',title:'发送对象',width:100},
                  {field:'CreateTime',title:'发送时间',width:100},
                  {field:'status',title:'状态',width:60,align:'center'},
                  {field:'details',title:'报价单详情',width:80,formatter:check} 
                ]],
        view: myview,
        emptyMsg: '暂无数据'
    });
});
    
//输入关键字得到商品列表
$("#keyword").keyup(function(event){
     var grid=$('#contact_search').combogrid('grid'); 
     var row = grid.datagrid('getSelected');
     if(!row)
     {
         $.messager.alert('操作提示', '请先选择报价单发送对象,以便获取商品列表!','info');
         $("#keyword").val('');
         return false;
     }
     var code=event.keyCode;
     var res=0;
     if(code==13)
     {
         res=1;
         $('#goods_list').datagrid('unselectAll');
     }   
     if(res==0)
         return false;
     var searchtype=$('#searchtype').combobox('getValue');  //得到下拉框选中值
     var keyword=$('#keyword').val();
     $('#goods_list').datagrid({ 
             url:Yii_baseUrl +'/mall/quotationorder/Getgoodslists?cooperationtype='+row.cooperationtype,
             queryParams:{
                'searchtype':searchtype,
                'keyword':keyword
             },
             pageSize: 5,  //页面显示条目数
             pageList: [5,10,15], 
             view: myview,
             emptyMsg: '暂无数据',
             method:"get"});   
     //$('#keyword').focus();

});
  
//报价单列表查询
$('#search-btn').click(function(){
    var quoNO=$('#quoNO').val();
    var startdate=$("#startdate").datebox("getValue");
    var enddate=$("#enddate").datebox("getValue");
    //var begin=new Date(startdate.replace(/-/g,"/"));//日期字符串转化成js日期
    //var end=new Date(enddate.replace(/-/g,"/"));
    if(startdate>=enddate&&startdate!=""&&enddate!="")
    {
        $.messager.alert('操作提示','报价单起始时间小于终止时间','warning');
        $("#startdate").datebox('setValue','');
        return false;
    }
    var status=$('#status').val();
    $('#quolists').datagrid({ 
                 url:Yii_baseUrl +'/mall/quotationorder/Getquolists',
                 queryParams:{
                    'startdate':startdate,
                    'enddate':enddate,
                    'status':status,
                    'quoNO':quoNO
                },
                view: myview,
                emptyMsg: '暂无数据',
                method:"get"});    
});

//下载附件
$("#filesname").click(function(){  
            $('#importform').form({
                url:Yii_baseUrl +'/mall/quotationorder/Import',
		success:function(data){
                        var result = eval('('+data+')');
                        if(result.fail)
			   $.messager.alert('提示', result.fail, 'info');
		}
	    });
            $('#importform').submit();

        });

//商品添加到商品订购清单
 $('#goods_add').click(function()
 {
     var buyids=$('#goods_buy_id').val();
     var row=$("#goods_list").datagrid('getSelected');
     if(!row)
        return false;
     //检查商品是否已经存在于商品清单
     if($.inArray(row.ID, buyids.split(","))==-1)
     {
         //$.inArray判断选中id是否被包含在数组中,不包含就返回-1,包含则返回数组索引.buyids.split(",")将字符串buyids分割成数组
         $('#goods_buy').datagrid('appendRow',row);
     }
     else
     {
         $.messager.show({
                    title: '提示信息',
                    msg: '商品已经存在,请在商品清单中修改数量.',
                    timeout: 1800,
                    showType: 'show'
                    }); 
         $('#goods_buy').datagrid('selectRow',$('#goods_buy').datagrid('getRowIndex',row.ID));
      }
     var buy_rows=$('#goods_buy').datagrid('getRows');
     var ids='';
     $.each(buy_rows,function(key,buy_row){
         ids=ids+buy_row.ID+',';
     });
     $('#goods_buy_id').val(ids.substr(0,ids.length-1));
     counttotalprice();
     
 });

//报价单发送对象改变事件
function contactchange()
{
    var grid=$('#contact_search').combogrid('grid'); 
    var row = grid.datagrid('getSelected');
    if(row)
        $('#selectcontact').hide();
    else
    {
        $('#selectcontact').show();
        return false;
    }
    $('#goods_buy').datagrid('loadData',{total:0,rows:[]});
    var searchtype=$('#searchtype').combobox('getValue');  //得到下拉框选中值
    var keyword=$('#keyword').val();
    $('#goods_buy_id').val('');
    //商品列表显示所有商品
    if(row.cooperationtype)
    {
        $('#goods_list').datagrid({ 
             url:Yii_baseUrl +'/mall/quotationorder/Getgoodslists?cooperationtype='+row.cooperationtype,
             queryParams:{
                'searchtype':searchtype,
                'keyword':keyword
             },
             pageSize: 5,  //页面显示条目数
             pageList: [5,10,15], 
             view: myview,
             emptyMsg: '暂无数据',
             method:"get"});   
    }
}

//商品列表加载键盘事件
$('#goods_list').datagrid({ 
         onLoadSuccess:function(){
            $('#goods_list').datagrid('goodsadd');
         }
    });

 //弹出新建报价单窗口
 var url;
 function newquo()
 {
	 $('#quobuc').dialog('open').dialog('setTitle','新建报价单');
         updateclear();
         $('#selectcontact').show();
         //每次打开新建报价单编号
         var oldquotationNO=$('#hiddenquoNO').text();
         var newquotationNO=('BJ'+Date.parse( new Date())).replace(/000$/,'');
         $('#quotationNO').text(newquotationNO+oldquotationNO);
         $("#searchtype").combobox('select',1);//下拉框默认选中
         url=Yii_baseUrl+'/mall/quotationorder/Savequotation';
 }
 
 //弹出报价单编辑窗口
 function editquo()
 {
     var row=$("#quolists").datagrid('getSelected');
     if(row==null)
     {
        $.messager.alert('操作提示','请先选中一条报价单','warning');
        return false;
     }
     if(row.status=='已确认')
     {
        $.messager.alert('操作提示','已确认的报价单不能修改','warning');
        return false;
     }
    updateclear(); 
    getquodetails(row.QuoID);   
 }
 
 //得到报价单详情
function getquodetails(id)
{
    //得到报价单详情
    $.getJSON(Yii_baseUrl+'/mall/quotationorder/Getquodetails',{id:id},function(result){
           //机构名称和电话
           var dealerinfo=new Array();
            $("#updatequo").find("span").each(function(){
                dealerinfo.push($(this).attr("name"));   //将updatequo 下的每个span的name属性值都放在数组dealerinfo中
            })
            $.each(result.dealerinfo,function(key,val){
                if($.inArray(key, dealerinfo)>=0){
                    $("#updatequo").find("span[name="+key+"]").html(val);
                }
            })
             $("#searchtype").combobox('select',1);//下拉框默认选中
             //报价单名称,报价,费用,商品总价
             $("#quoName").val(result.quoinfo.Title);
             $("#quotationNO").text(result.quoinfo.QuoSn);
             $("#totalprices").val(result.quoinfo.TotalFee);
             $("#shipprices").val(result.quoinfo.ShipFee);
             $("#currentquoid").val(id);
             $("#goodsesprices").val(result.quoinfo.GoodFee);
             
             //报价单业务联系人
            $("#contact_search").combogrid('setValue',result.quoinfo.ServiceID);//下拉框默认选中
            
            //加载商品订购清单
            $('#goods_buy').datagrid('loadData',result.goodsinfo);
            //商品已订购id存储
             var buy_rows=$('#goods_buy').datagrid('getRows');
             var ids='';
             $.each(buy_rows,function(key,buy_row){
                    ids=ids+buy_row.ID+',';
             });
             $('#goods_buy_id').val(ids.substr(0,ids.length-1));
             
            //已上传的文件
            if(result.quoinfo.FileName)
            {
                $('#existfile').show();
                var filesname='<a href="javascript:void(0)">'+result.quoinfo.FileName+'</a>';
                $('#filesname').html(filesname); 
                $("#filenames").val(result.quoinfo.FileName);
                $("#FilePath").val(result.quoinfo.File);
            }
             
   });
   $('#quobuc').dialog('open').dialog('setTitle','修改报价单');
   url=Yii_baseUrl+'/mall/quotationorder/Updatequotation';
}
 

//报价单填写(更改)完毕,保存报价单到数据库
function savequotation()
{
    var quoName=$('#quoName').val();
    var totalprices=$('#totalprices').val();
    var shipprices=$('#shipprices').val();
    var buy_rows=$('#goods_buy').datagrid('getRows');
    var quoNO=$('#quotationNO').html();
    var contactID=$('#contact_search').combogrid('getValue');  //得到下拉框选中值
    var quoID=$("#currentquoid").val();
    if(contactID=="")   
    {
       $.messager.alert('操作提示','请先选择报价单发送对象!','warning');
       return false;
    }
    if(buy_rows=='')
    {
        $.messager.alert('操作提示','请先添加商品!','warning');
        return false;
    }   
    if(quoName=='')
    {
        $.messager.alert('操作提示','请输入报价单名!','warning');
        return false;
    }
    if(totalprices=='')
    {
        $.messager.alert('操作提示','请输入报价!','warning');
        return false;
    }
    if(shipprices=='')
    {
        shipprices=0;
    }
    var goodsid='';
    var goodsnum='';
    var goodsprice='';
    $.each(buy_rows,function(key,row){
        goodsid=goodsid+row.ID+',';
        goodsnum=goodsnum+row.Num+',';
        goodsprice=goodsprice+row.ProPrice+',';
    });
    $('#GoodsID').val(goodsid);
    $('#Num').val(goodsnum);
    $('#Price').val(goodsprice);
    url=url+'?quoNO='+quoNO+"&quoID="+quoID
    $('#fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                result=eval("("+result+")");
                 if(result.message)
                 {
                     $('#warning').text(result.message);
                     $('#files').val('');
                     $("a[name=removeupload]").trigger("click");
                 }
                 else if(result) {
                     $.messager.show({
                            title:'提示信息',
                            msg:'发送成功.',
                            timeout:3000,
                            showType:'slide'
			});
                     $('#quobuc').dialog('close'); // close the dialog
                     //updateclear();
                     $('#quolists').datagrid('reload');  
                 }
                 else {
                     $.messager.alert("提示信息", "发送失败");
                 }    
            }
        });
    
    
}

//取消保存
function savecancel()
{
    $.messager.confirm('确认取消','你确定取消所做的更改并关闭窗口?',function(r){  
        if(r)
        {
            $('#quobuc').dialog('close');
            //updateclear();
        }
    
});
}

//单价修改
function formatprice(val,row,index)
{
    return '<input class="easyui-validatebox width190 input" validType="price"  value="'+val+'" onkeyup="pricekeyup('+row.ProPrice+',this);" onblur="priceblur('+row.ID+','+row.ProPrice+',this);">';
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
    counttotalprice(index);
}


//数量修改
function nummodif(val,row,index)
{
    //return '<div style="width:25%;float:left;"><a href="javascript:void(0)" class="easyui-linkbutton" onclick="numsub('+row.ID+','+row.Num+')">-</a></div><div style="width:50%;float:left;color:red">'+val+'</div><div style="width:25%;float:left;"><a href="javascript:void(0)" class="easyui-linkbutton" onclick="numadd('+row.ID+','+row.Num+')">+</a></div>';
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
    counttotalprice(index);
}

//删除商品
function delgoods(val,row,index)
{
    return "<a style='cursor:pointer' onclick='javascript:delgoodsbuy("+row.ID+")'>删除</a>";
}

function delgoodsbuy(id)
{
    var index=$('#goods_buy').datagrid('getRowIndex',id);
    //如果不将num改为1,再一次添加被删除的数据后num会是原值
    $('#goods_buy').datagrid('updateRow',{index:index,row:{Num:1}}); 
    $('#goods_buy').datagrid('deleteRow',index);
    //将商品订单中的商品id加入隐藏id中
    var buy_rows=$('#goods_buy').datagrid('getRows');
    var ids='';
    $.each(buy_rows,function(key,buy_row){
         ids=ids+buy_row.ID+',';
    });
    $('#goods_buy_id').val(ids.substr(0,ids.length-1));
    counttotalprice();
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
    counttotalprice(index);
}

//数量加一
function numadd(id,num)
{
    var index=$('#goods_buy').datagrid('getRowIndex',id);
    num=num+1;
    $('#goods_buy').datagrid('updateRow',{index:index,row:{Num:num}}); 
    counttotalprice(index);
}

//计算商品总价
function counttotalprice(index)
{
    if(index!=undefined)
    {
        var value=$('#goods_buy').datagrid('selectRow',index).datagrid('getSelected'); 
        var totalprices=parseFloat(value.ProPrice)*parseInt(value.Num)+parseFloat(value.LogisticsPrice)*parseInt(value.Num);
        totalprices=totalprices.toFixed(2);
        $('#goods_buy').datagrid('updateRow',{index:index,row:{GoodstotalPrice:totalprices}}); 
        $('#goods_buy').datagrid('unselectRow',index);
    }
    var rows=$('#goods_buy').datagrid('getRows');
    //商品总价
    var goodsesprices=0;
    //物流费用
    var shipprices=parseFloat($('#shipprices').val());
    if($('#shipprices').val()=='')
        shipprices=0;     
    $.each(rows,function(k,value){
        goodsesprices=parseFloat(value.ProPrice)*parseInt(value.Num)+goodsesprices;
        //shipprices=shipprices+parseFloat(value.LogisticsPrice)*value.Num;
    });
    shipprices=shipprices.toFixed(2);
    goodsesprices=goodsesprices.toFixed(2);
    var totalprices=parseFloat(goodsesprices)+parseFloat(shipprices);
    $('#goodsesprices').val(goodsesprices);
    $('#shipprices').val(shipprices);
    $('#totalprices').val(totalprices.toFixed(2));
}

//物流价改变事件
$('#shipprices').change(function(){
    var goodsesprices=$('#goodsesprices').val()==''?0:parseFloat($('#goodsesprices').val());
    var shipprices=$('#shipprices').val()==''?0:parseFloat($('#shipprices').val());
    var totalprices=parseFloat(goodsesprices)+parseFloat(shipprices);
    $('#totalprices').val(totalprices.toFixed(2));    
})

$.extend($.fn.validatebox.defaults.rules, {
               //验证报价
                price: {
                         validator: function (value, param) {
                             return /^[1-9]\d*\.\d{1,2}$|0\.\d{1,2}$|^[1-9]\d*$|^0$/.test(value);
                         },
                         message: '至多保留小数点后两位'
                }
    });
   
//清空数据
function updateclear()
{
    //清空商品清单
    $('#existfile').hide();
    $('#goods_buy').datagrid('loadData',{total:0,rows:[]});
    $('#goods_list').datagrid('loadData',{total:0,rows:[]});
    $("#quotationNO").text('');
    $("#keyword").val('');
    $("#contact_search").combogrid('setValue','');//下拉框默认选中
    $('#warning').text('');
    $("a[name=removeupload]").trigger("click");
    $('#goodsesprices').val('');
    $('#shipprices').val('');
    $('#totalprices').val('');
}

 $("input[type='file']").live('change',function(){
        var inputfile = $(this).closest('.inputfile');
        if(inputfile.length!=0){
            var after = $(inputfile).nextAll('span');
            after.length>0 && after.remove();
            $(inputfile).after('<span style="margin-left:5px;">'+$(this).val()+'</span>')
        }else{
            var inputfile_input = $(this).closest('.inputfile-input');
            if(inputfile_input.length==0){
                return;
            }
            var before = $(this).prevAll('span');
            before.length>0 && before.remove();
            $(this).before('<span style="margin-left:5px;">'+$(this).val()+'</span>')
        }
    });

$("a[name=removeupload]").click(function(){
        $(this).parent('td').find(".input").find("span").remove();
        var afile = $(this).parent('td').find("input");
        afile.after(afile.clone().val(""));
        afile.remove();
});

//商品列表键盘控制
var isbind=false;
$.extend($.fn.datagrid.methods, {
goodsadd : function (jq) {
return jq.each(function () {
    var grid = $(this);
    if(!isbind)
    {
        grid.datagrid('getPanel').panel('panel').attr('tabindex', 1).bind('keyup', function (e) {
            var options=grid.datagrid('options');//options.pageSize当前每页最多数据量,options.pageNumber当前页数
            var data=grid.datagrid('getData');   //data.total数据总量,data.rows.length当前页数据总数
            switch (e.keyCode) {
            case 38: // up
                var selected = grid.datagrid('getSelected');
                if (selected) {
                    var index = grid.datagrid('getRowIndex', selected);
                    if(index>0)
                        grid.datagrid('selectRow', index - 1);
                    else
                        grid.datagrid('selectRow', data.rows.length-1);
                } else {
                    var rows = grid.datagrid('getRows');
                    grid.datagrid('selectRow', rows.length - 1);
                }
                break;
            case 40: // down
                var selected = grid.datagrid('getSelected');
                if (selected) {
                    var index = grid.datagrid('getRowIndex', selected);
                    if(index<data.rows.length-1)
                        grid.datagrid('selectRow', index + 1);
                    else
                        grid.datagrid('selectRow',0);
                } else {
                    grid.datagrid('selectRow', 0);
                }
                break;
            case 13: // enter
                var selected = grid.datagrid('getSelected');
                var buyids=$('#goods_buy_id').val();
                if (selected) {
                    if($.inArray(selected.ID, buyids.split(","))==-1)
                    {
                        $('#goods_buy').datagrid('appendRow',selected);
                        counttotalprice();
                    }
                    else
                    {
                         $.messager.show({
                                title: '提示信息',
                                msg: '商品已经存在,请在商品清单中修改数量.',
                                timeout: 1800,
                                showType: 'show'
                                }); 
                         $('#goods_buy').datagrid('selectRow',$('#goods_buy').datagrid('getRowIndex',selected.ID));
                    }
                    //将商品订单中的商品id加入隐藏id中
                    var buy_rows=$('#goods_buy').datagrid('getRows');
                    var ids='';
                    $.each(buy_rows,function(key,buy_row){
                         ids=ids+buy_row.ID+',';
                    });
                    $('#goods_buy_id').val(ids.substr(0,ids.length-1));
                } else {
                    grid.datagrid('selectRow', 0);
                }
                break;
            }
        });
        isbind=true;
}
});
}
});

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


//查看报价单详情
function check(val,row,index)
{
    return '<a href="javascript:void(0)" class="easyui-linkbutton" onclick="checkdetails('+row.QuoID+')">报价单详情</a>';
}

function checkdetails(quoID)
{
    cleardetails();
    $.getJSON(Yii_baseUrl+'/mall/quotationorder/Getquodetails',{id:quoID},function(result)
    {
        //修理厂信息
        $("#service").find("span[name=ServiceName]").html(result.serviceinfo.serviceName);
        if(result.serviceinfo.serviceAddress)
            $("#service").find("span[name=ServiceAddress]").html(result.serviceinfo.serviceAddress);
        else
            $("#service").find("span[name=ServiceAddress]").html('修理厂未填写联系地址');
        //查看修理厂详情
        var url = Yii_baseUrl + "/dealer/makequery/Servicedetail/id/"+result.serviceinfo.userId;
        $("#service").find("span[name=ServiceDetails]").html("<a href='"+url+"' target='_blank'>查看</a>");
        if(result.serviceinfo.serviceTelePhone&&result.serviceinfo.serviceCellPhone)
            $("#service").find("span[name=ServicePhone]").html(result.serviceinfo.serviceCellPhone+' / '+result.serviceinfo.serviceTelePhone);
        else if(result.serviceinfo.serviceCellPhone&&!result.serviceinfo.serviceTelePhone)
            $("#service").find("span[name=ServicePhone]").html(result.serviceinfo.serviceCellPhone);
        else if(result.serviceinfo.serviceTelePhone&&!result.serviceinfo.serviceCellPhone)
            $("#service").find("span[name=ServicePhone]").html(result.serviceinfo.serviceTelePhone);
        else
            $("#service").find("span[name=ServicePhone]").html('修理厂未填写联系电话');
        //加载报价单信息
       var quoinfo=new Array();
        $("#quoinfos").find("span").each(function(){
            quoinfo.push($(this).attr("name"));   
        })
        $.each(result.quoinfo,function(key,val){
            if($.inArray(key, quoinfo)>=0){
                $("#quoinfos").find("span[name="+key+"]").html(val);
            }
        })
        //加载商品列表
        $('#quodetails_goods_buy').datagrid('loadData',result.goodsinfo);
        //报价单状态
        var status=[{"id":1,"text":"已报价未确认"},{"id":2,"text":"修理厂已确认"}];
        $('#quostatus').combobox('loadData',status);
        $('#quostatus').combobox('select',result.quoinfo.status);
        $('#quostatus').combobox('disable');
        //已上传的文件
        if(result.quoinfo.FileName)
        {
            $('#detailsfile').show();
            var filesname='<a href="javascript:void(0)" style="color:red">'+result.quoinfo.FileName+'</a>';
            $('#detailsfilesname').html(filesname); 
            $('#detailfilename').val(result.quoinfo.FileName); 
            $("#detailsFilePath").val(result.quoinfo.File);
        }  
    })
    $('#quodetails').dialog('open').dialog('setTitle','报价单详情'); 
}
//下载附件
$("#detailsfilesname").click(function(){  
            $('#detailsimport').form({
                url:Yii_baseUrl +'/mall/quotationorder/Import',
		success:function(data){
                        var result = eval('('+data+')');
                        if(result.fail)
			   $.messager.alert('提示', result.fail, 'info');
		}
	    });
            $('#detailsimport').submit();
        })

function cleardetails()
{
    $("#service").find("span").html('');
    $("#quoinfo").find("span [class!=combo]").html('');
    $('#quodetails_goods_buy').datagrid('loadData',{'total':0,'rows':[]});
    $('#detailsfile').hide();
}
