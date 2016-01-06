<div style="float:left;margin-top:20px;">
所有联系人：
  <table id="send_car" class="easyui-datagrid" style="width:320px;height:250px"
  data-options="url:'<?php echo Yii::app()->createUrl('cim/contact/Allcontact')?>',singleSelect:false">
  <thead>
  <tr>
  <th data-options="field:'name'">姓名</th>
<!--  <th data-options="field:'customertype'">客户类型</th>-->
  <th data-options="field:'customercategory'">客户类别</th>
  <th data-options="field:'sex'">性别</th>
  <th data-options="field:'companyname'">公司名称</th>
  <th data-options="field:'phone'">手机号</th>
  <th data-options="field:'cooperationtype'">合作类型</th>
  </tr>
  </thead>
  </table>
</div>


<div style="float:left;">
    <div > <input id="add" class='btn-sq-add' type="button" name="button" value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
    <div > <input id="jians" class='btn-sq-remove' type="button" name="button" value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
    <div> <input id="moreleft" class='btn-sq-all' type="button" name="button" value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
    <div > <input id="moreright" class='btn-sq-empty' type="button" name="button" value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px;padding:10px"></div>
</div>

<div style="float:left;margin-top:20px;height:260px;">
已添加联系人:
  <table id="select2" class="easyui-datagrid" style="width:330px;height:246px"
  data-options="singleSelect:false">
    <thead>
    <tr>
    <th data-options="field:'name',width:50">姓名</th>
<!--    <th data-options="field:'customertype',width:50">客户类型</th>-->
    <th data-options="field:'customercategory',width:50">客户类别</th>
    <th data-options="field:'sex',width:50">性别</th>
    <th data-options="field:'companyname',width:50">公司名称</th>
    <th data-options="field:'phone',width:50">手机号</th>
    <th data-options="field:'cooperationtype',width:50">合作类型</th>
    </tr>
    </thead>
  </table>
</div>
     
   <input type="hidden" id="iddata" name='iddata'>
   <input type="hidden" id="namedata" name='namedata'>
   <input type="hidden" id="phonedata" name='phonedata'>
 <script type="text/javascript">
 $('#add').click(function() {
	      //获取选中的选项，删除并追加给对方
            var ids=new Array();
            var iddata='';
            var namedata='';
            var phonedata='';
	        var row=$('#send_car').datagrid('getSelected');
	       $.each(row,function(index,value){
				ids[index]=value;
	       })
	       $('#select2').datagrid('appendRow',row);
	      var rowIndex=$('#send_car').datagrid('getRowIndex',row);
	      $('#send_car').datagrid('deleteRow',rowIndex);
	      var row2=$('#select2').datagrid('getRows');
	      $.each(row2,function(index,value){
			iddata=iddata+value.id+',';
	      });
	     $('#iddata').val(iddata);
	    });
 $('#jians').click(function() {
     //获取选中的选项，删除并追加给对方
       var ids=new Array();
       var iddata='';
       var namedata='';
       var phonedata='';
       var row=$('#select2').datagrid('getSelected');
      $.each(row,function(index,value){
			ids[index]=value;
      })
      $('#send_car').datagrid('appendRow',row);
     var rowIndex=$('#select2').datagrid('getRowIndex',row);
     $('#select2').datagrid('deleteRow',rowIndex);
     var row2=$('#select2').datagrid('getRows');
     $.each(row2,function(index,value){
		iddata=iddata+value.id+',';
     });
    $('#iddata').val(iddata);
   });
//多选右到左
 $('#moreleft').click(function() {
     //获取选中的选项，删除并追加给对方
       var iddata='';
       var row=$('#send_car').datagrid('getSelections');
      $.each(row,function(index,value){
   	   $('#select2').datagrid('appendRow',value);
   	   var rowIndex=$('#send_car').datagrid('getRowIndex',value);
	 	      $('#send_car').datagrid('deleteRow',rowIndex);
      })
     
     var row2=$('#select2').datagrid('getRows');
     $.each(row2,function(index,value){
		iddata=iddata+value.id+',';
     });
    $('#iddata').val(iddata);
   });
 $('#moreright').click(function() {
     //获取选中的选项，删除并追加给对方
       var iddata='';
       var row=$('#select2').datagrid('getSelections');
      $.each(row,function(index,value){
   	   $('#send_car').datagrid('appendRow',value);
   	   var rowIndex=$('#select2').datagrid('getRowIndex',value);
	 	      $('#select2').datagrid('deleteRow',rowIndex);
      })
     var row2=$('#select2').datagrid('getRows');
     $.each(row2,function(index,value){
		iddata=iddata+value.id+',';
     });
    $('#iddata').val(iddata);
   });
 </script>

     
