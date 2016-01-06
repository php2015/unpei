<div style="float:left;margin-top:20px;margin-left:5px;">
<label>发送对象:</label>
  <table id="send_car" class="easyui-datagrid" style="width:280px;height:250px"
  data-options="singleSelect:false">
  <thead>
  <tr>
  <th data-options="field:'OwnerName',width:100">姓名</th>
  <th data-options="field:'NickName',width:100">昵称</th>
  <th data-options="field:'LicensePlate',width:100">车牌号</th>
  <th data-options="field:'OwnerPhone',width:100,align:'right'">手机号</th>
  </tr>
  </thead>
  </table>
</div>

<ul style="float: left">
  <li><input id="add" type="button" class='btn-sq-add' value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px"></li>
  <li><input id="jan" type="button" class='btn-sq-remove' value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px"></li>
  <li><input id="duoadd" type="button" class='btn-sq-all' value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px"></li>
  <li><input id="duojan" type="button" class='btn-sq-empty' value="&nbsp;&nbsp;&nbsp;&nbsp;" style="cursor:pointer;margin-top:50px"></li>
</ul>

<div style="float:left;margin-top:20px;height:250px;">
<label>已选对象:</label>
  <table id="select2" class="easyui-datagrid" style="width:280px;height:250px"
  data-options="singleSelect:false">
  <thead>
  <tr>
  <th data-options="field:'OwnerName',width:100">姓名</th>
   <th data-options="field:'NickName',width:100">昵称</th>
  <th data-options="field:'LicensePlate',width:100">车牌号</th>
  <th data-options="field:'OwnerPhone',width:100,align:'right'">手机号</th>
  </tr>
  </thead>
  </table>
</div>

<input type="hidden" id="iddata" name='iddata'>
<input type="hidden" id="namedata" name='namedata'>
<input type="hidden" id="phonedata" name='phonedata'>
<input type="hidden" id="licedata" name='licedata'>
<input type="hidden" id="cardata" name='cardata'>
<input type="hidden" id="nickdata" name='nickdata'>
 <script type="text/javascript">
 //从右往左添加
 $('#add').click(function() {
	      //获取选中的选项，删除并追加给对方
            var ids=new Array();
            var iddata='';
            var namedata='';
            var phonedata='';
            var  licedata='';
            var cardata='';
            var nickdata='';
	        var row=$('#send_car').datagrid('getSelected');
	       $.each(row,function(index,value){
				ids[index]=value;
	       })
	       $('#select2').datagrid('appendRow',row);
	      var rowIndex=$('#send_car').datagrid('getRowIndex',row);
	      $('#send_car').datagrid('deleteRow',rowIndex);
	      var row2=$('#select2').datagrid('getRows');
	      $.each(row2,function(index,value){
			iddata=iddata+value.ID+',';
			 namedata=namedata+value.OwnerName+',';
			 phonedata=phonedata+value.OwnerPhone+',';
			 licedata=licedata+value.LicensePlate+',';
			 cardata=cardata+value.CarID+',';
			 nickdata=nickdata+value.NickName+',';
	      });
	     $('#iddata').val(iddata);
	     $("#namedata").val(namedata);
	     $("#phonedata").val(phonedata);
	     $("#licedata").val(licedata);
	     $("#cardata").val(cardata);
	     $('#nickdata').val(nickdata);
	    });
//从左往右添加
 $('#jan').click(function() {
     //获取选中的选项，删除并追加给对方
       var ids=new Array();
       var iddata='';
       var namedata='';
       var phonedata='';
       var  licedata='';
       var cardata='';
       var nickdata='';
       var row=$('#select2').datagrid('getSelected');
      $.each(row,function(index,value){
			ids[index]=value;
      })
      $('#send_car').datagrid('appendRow',row);
     var rowIndex=$('#select2').datagrid('getRowIndex',row);
     $('#select2').datagrid('deleteRow',rowIndex);
     var row2=$('#select2').datagrid('getRows');
     $.each(row2,function(index,value){
    	 iddata=iddata+value.ID+',';
		 namedata=namedata+value.OwnerName+',';
		 phonedata=phonedata+value.OwnerPhone+',';
		 licedata=licedata+value.LicensePlate+',';
		 cardata=cardata+value.CarID+',';
		 nickdata=nickdata+value.NickName+',';
     });
    $('#iddata').val(iddata);
    $("#namedata").val(namedata);
    $("#phonedata").val(phonedata);
    $("#licedata").val(licedata);
    $("#cardata").val(cardata);
    $('#nickdata').val(nickdata);
   });
	//从右往左多选添加
 $('#duoadd').click(function() {
	      //获取选中的选项，删除并追加给对方
            var ids=new Array();
            var iddata='';
            var namedata='';
            var phonedata='';
            var  licedata='';
            var cardata='';
            var nickdata='';
	        var row=$('#send_car').datagrid('getSelections');
	       $.each(row,function(index,value){
	    	   $('#select2').datagrid('appendRow',value);
	    	   var rowIndex=$('#send_car').datagrid('getRowIndex',value);
		 	      $('#send_car').datagrid('deleteRow',rowIndex);
	       })
	      
	      var row2=$('#select2').datagrid('getRows');
	      $.each(row2,function(index,value){
			iddata=iddata+value.ID+',';
			 namedata=namedata+value.OwnerName+',';
			 phonedata=phonedata+value.OwnerPhone+',';
			 licedata=licedata+value.LicensePlate+',';
			 cardata=cardata+value.CarID+',';
			 nickdata=nickdata+value.NickName+',';
	      });
	      $('#iddata').val(iddata);
	      $("#namedata").val(namedata);
		     $("#phonedata").val(phonedata);
		     $("#licedata").val(licedata);
		     $("#cardata").val(cardata);
		     $('#nickdata').val(nickdata);
	    });
 $('#duojan').click(function() {
     //获取选中的选项，删除并追加给对方
	 var ids=new Array();
     var iddata='';
     var namedata='';
     var phonedata='';
     var  licedata='';
     var cardata='';
     var nickdata='';
       var row=$('#select2').datagrid('getSelections');
      $.each(row,function(index,value){
   	   $('#send_car').datagrid('appendRow',value);
   	   var rowIndex=$('#select2').datagrid('getRowIndex',value);
	 	      $('#select2').datagrid('deleteRow',rowIndex);
      })
     var row2=$('#select2').datagrid('getRows');
     $.each(row2,function(index,value){
    	 iddata=iddata+value.ID+',';
		 namedata=namedata+value.OwnerName+',';
		 phonedata=phonedata+value.OwnerPhone+',';
		 licedata=licedata+value.LicensePlate+',';
		 cardata=cardata+value.CarID+',';
		 nickdata=nickdata+value.NickName+',';
     });
     $('#iddata').val(iddata);
     $("#namedata").val(namedata);
	     $("#phonedata").val(phonedata);
	     $("#licedata").val(licedata);
	     $("#cardata").val(cardata);
	     $('#nickdata').val(nickdata);
   });
 </script>

     
