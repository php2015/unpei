<!--<style>
input,select{color:black}
</style>-->
<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "商品类别管理";
?>
<div class='tabs' pre='tab'>
		<a class='left-indent'>&nbsp;</a>
		<?php echo CHtml::link('商品类别列表', Yii::app()->createUrl('maker/goodscategory/index'),array('class'=>'active'));?>
</div>
<div class="easyui-layout" id="jp-layout" style="height:auto;margin-top:5px">	
    <table id="goodscategorylists"  style="height:380px">
    </table>
</div>
<div id="toolbar" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addcategory()">添加</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editcategory()">编辑</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="delcategory()">删除</a>
    </div>
</div>

<!--商品分类弹框开始-->
<div id="categorydlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px" closed="true"  modal='true' buttons="#category-buttons">
    <div style="padding:10px 0 10px 40px">
        <form id="categoryfm" method="post" novalidate>
            <table>
                <tr>
                    <td>类别代码:</td>
                    <td><input class="easyui-validatebox input" maxlength="20" style="width:200px" type="text" name="code" onfocus="this.blur()" readonly id="addcode"></input></td>
	        </tr>
                <tr>
                    <td>类别名称:</td>
                    <td><input class="easyui-validatebox input" maxlength="20" style="width:200px" type="text" name="name" data-options="required:true" id="addname"></input></td>
	        </tr>
                <tr>
                    <td valign="top">类别说明:</td>
                    <td><textarea name="desc" style="width:210px;height:80px;" id="adddesc"></textarea></td>
	        </tr>
            </table>
        </form>
    </div>
</div>
<div id="category-buttons">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-save"   id="addsave" onclick="addsave()">保存</a>
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#categorydlg').dialog('close');">关闭</a>
</div>
<!--商品分类弹框结束-->
<script>
$(function(){
    $('#categoryfm input').css('color','black');
})

//easyui datagrid无数据时显示默认值
var datagridemptyview = $.extend({},$.fn.datagrid.defaults.view,{
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

//加载商品类别列表
$('#goodscategorylists').datagrid({
    rownumbers:true,
    pagination:true,
    singleSelect:true,
    fitColumns:true,
    idField:'categoryID',
    url:Yii_baseUrl +'/maker/goodscategory/getcategorylists',
    method:'get',
    toolbar:'#toolbar',
    columns:[[
              {field:'code',title:'类别代码',width:100},
              {field:'name',title:'商品类别名称',width:100},
              {field:'desc',title:'简单说明',width:100},
              {field:'count',title:'商品数量',width:70,align:'center'}
              ]],
    view: datagridemptyview,
    emptyMsg: '暂无数据'
})

//添加商品分类
var url;
function addcategory()
{
    $('#categorydlg').dialog({
        closed:false,
        title:'添加商品分类',
        iconCls: 'icon-add'
    })
    $('#categoryfm').form('clear');
    $('#addcode').val($('#goodscategorylists').datagrid('getData').code);
    url = Yii_baseUrl + "/maker/goodscategory/addcategory";	
}

//添加
function addsave()
{
    $("#addsave").linkbutton("disable");
    if(!$('#addname').validatebox('isValid'))
    {
        //$.messager.alert('操作提示','商品分类类别名称必须填写','warning');
        $('#addname').focus();
        $("#addsave").linkbutton("enable");
        return false;
    }
    var code=$('#addcode').val();
    var name=$('#addname').val();
    var desc=$('#adddesc').val();
    $.ajax({
    	 url: url,
    	 type: "POST",
    	 data: {   		 
        	 'code': code,
        	 'name': name,
        	 'desc': desc
         },
         dataType: "json",        
         success:function(data){
             $("#addsave").linkbutton("enable");
             if(data.msg=='ok')
             {
                 $.messager.show({
				title:'操作提示',
				msg:'添加成功!',
				timeout:2000,
				showType:'slide'
			      });
                 $('#categorydlg').dialog('close');
                 $('#goodscategorylists').datagrid('reload');  
             }
             else if(data.msg=='nameexist')
             {
                 $.messager.alert('操作提示','商品类别名称已存在,请重新输入!','warning');
                 $('#addname').validatebox({  
                     validType:'dataexist["'+name+'"]'
                });
             }
	     else{
                 $.messager.alert('操作提示','商品分类添加失败!','warning');
	     }
         }
    });	
}

//编辑商品分类
function editcategory()
{
    var rows=$('#goodscategorylists').datagrid('getSelections');
    if(rows.length==0)
    {
        $.messager.alert('操作提示','请先选中一条商品分类!','warning');
        return false;
    }
    else if(rows.length>1)
    {
        $.messager.alert('操作提示','只能编辑一条商品分类!','warning');
        return false;
    }
    $('#categorydlg').dialog({
        closed:false,
        title:'编辑商品分类',
        iconCls: 'icon-edit'
    })
    var row=rows[0];
    $('#categoryfm').form('load',{
            name:row.name,
            code:row.code,
            desc:row.desc
    });
    url = Yii_baseUrl + "/maker/goodscategory/editcategory?id="+row.categoryID;
}

//删除单个商品类别
function delcategory()
{
    var row=$('#goodscategorylists').datagrid('getSelected');
    if(!row)
    {
        $.messager.alert('操作提示','请先选中一条商品分类!','warning');
        return false;
    }
    if(row.count>0)
    {
       $.messager.alert('操作提示','选中类别有对应商品,无法删除!','warning');
       return false; 
    }
    $.messager.confirm('操作提示','你确定要删除选中商品类别?',function(res){
        if(res)
        {
            var url=Yii_baseUrl +"/maker/goodscategory/delete";
            $.ajax({
    		    url: url,
    		    type:"POST",
    		    data:{
    		         crowid: row.categoryID
    		         },
    		     dataType: "json",
    		     success: function(data)
    		     {
    		        if(data)
                        {
                              var msg='删除成功!';
                              $.messager.show({
                                title:'操作提示',
                                msg:msg,
                                timeout:2000,
                                showType:'slide'
                              });
                              $('#goodscategorylists').datagrid('reload');

                         }
                         else
                         {
                             $.messager.alert('操作提示','删除失败!','warning');
                         }
    		     }
    	    });
        }
    })
}

$(function(){
    $.extend($.fn.validatebox.defaults.rules, {   
    dataexist: {   
          validator: function(value, param){
              return value!=param[0]
          },   
          message: '此项已存在'  
     }   
  }); 
}) 
</script>