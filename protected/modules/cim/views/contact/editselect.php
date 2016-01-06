<div style="float:left;margin-top:20px;">
 所有添加联系人：
 <table id="sends" class="easyui-datagrid" style="width:300px;height:250px"
   data-options="
    region:'center',
    fitColumns:false,
   singleSelect:false">
   <thead>
     <tr>
       <th data-options="field:'name'">姓名</th>
       <th data-options="field:'customertype'">客户类型</th>
       <th data-options="field:'customercategory'">客户类别</th>
       <th data-options="field:'sex'">性别</th>
       <th data-options="field:'companyname'">公司名称</th>
       <th data-options="field:'phone'">手机号</th>
       <th data-options="field:'cooperationtype'">合作类型</th>
     </tr>
   </thead>
 </table>
</div>

<div style="float:left;width:40px">
  <div>
    <input id="adds" class='btn-sq-add' type="button"  value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
  <div>
    <input id="jian" class='btn-sq-remove' type="button"  value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
  <div>
    <input id="moresleft" class='btn-sq-all' type="button"  value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
  <div>
    <input id="moresright" class='btn-sq-empty' type="button"  value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
</div>

<div style="float:left;margin-top:20px;height:250px;">
  已添加联系人:
  <table id="selectedit" class="easyui-datagrid" style="width:300px;height:250px"
       data-options="fitColumns:false,singleSelect:false">
    <thead>
      <tr>
        <th data-options="field:'name'">姓名</th>
        <th data-options="field:'customertype'">客户类型</th>
        <th data-options="field:'customercategory'">客户类别</th>
        <th data-options="field:'sex'">性别</th>
        <th data-options="field:'companyname'">公司名称</th>
        <th data-options="field:'phone'">手机号</th>
        <th data-options="field:'cooperationtype'">合作类型</th>
      </tr>
    </thead>
  </table>
</div>


      <script type="text/javascript">
 $('#adds').click(function() {
	      //获取选中的选项，删除并追加给对方
            var ids=new Array();
            var iddata='';
            var namedata='';
            var phonedata='';
	        var row=$('#sends').datagrid('getSelected');
	       $.each(row,function(index,value){
				ids[index]=value;
	       })
	       $('#selectedit').datagrid('appendRow',row);
	      var rowIndex=$('#sends').datagrid('getRowIndex',row);
	      $('#sends').datagrid('deleteRow',rowIndex);
	      var row2=$('#selectedit').datagrid('getRows');
	      $.each(row2,function(index,value){
			iddata=iddata+value.id+',';
	      });
	     $('#iddata').val(iddata);
	    });
 $('#jian').click(function() {
     //获取选中的选项，删除并追加给对方
       var ids=new Array();
       var iddata='';
       //var row=$('#sends').datagrid('getSelected');
       var row=$('#selectedit').datagrid('getSelected');
      $.each(row,function(index,value){
			ids[index]=value;
      })
      //$('#selectedit').datagrid('appendRow',row);
      $('#sends').datagrid('appendRow',row);
     var rowIndex=$('#selectedit').datagrid('getRowIndex',row);
     $('#selectedit').datagrid('deleteRow',rowIndex);
     var row2=$('#selectedit').datagrid('getRows');
     $.each(row2,function(index,value){
		iddata=iddata+value.id+',';
     });
   var iddata=$('#iddata').val(iddata);
  
   });
//多选右到左
 $('#moresleft').click(function() {
     //获取选中的选项，删除并追加给对方
       var iddata='';
       var row=$('#sends').datagrid('getSelections');
      $.each(row,function(index,value){
   	   $('#selectedit').datagrid('appendRow',value);
   	   var rowIndex=$('#sends').datagrid('getRowIndex',value);
	 	      $('#sends').datagrid('deleteRow',rowIndex);
      })
     
     var row2=$('#selectedit').datagrid('getRows');
     $.each(row2,function(index,value){
		iddata=iddata+value.id+',';
     });
    $('#iddata').val(iddata);
   });
 $('#moresright').click(function() {
     //获取选中的选项，删除并追加给对方
       var iddata='';
       var row=$('#selectedit').datagrid('getSelections');
      $.each(row,function(index,value){
   	   $('#sends').datagrid('appendRow',value);
   	   var rowIndex=$('#selectedit').datagrid('getRowIndex',value);
	 	      $('#selectedit').datagrid('deleteRow',rowIndex);
      })
     var row2=$('#selectedit').datagrid('getRows');
     $.each(row2,function(index,value){
		iddata=iddata+value.id+',';
     });
   
    $('#iddata').val(iddata);
   });
 </script>