<!-- 弹出层 
<div id="dlg-part" class="easyui-dialog" style="width:800px;height:600px;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons">
	<?php //echo $this->renderPartial('_form', array('action'=>Yii::app()->createUrl('jpdata/epcPartTemp/create'),'submitFun'=>'savePart',
			//'model'=>$model,'epcModel'=>$epcModel,'epcGroup'=>$epcGroup)); ?>
	<div id="dlg-buttons">
    	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" 
    		onclick="javascript:$('#epc-part-temp-form').submit()">保存</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-part').dialog('close')">取消</a>
	</div>
</div>
-->
<div id="dlg-part"></div>
<script type="text/javascript">
	var partDlgTitle = "新增配件";
    function newPart(param,type){
        //$('#dlg-part').dialog('open').dialog('setTitle','新增配件');
        //$('#epc-part-temp-form').form('reset');
        var url = Yii_jpdata_baseUrl+"/epcPartTemp/create";
        if(param) {
            if(type == '0'){ // 新增配件
			url += "?ep_gp="+param;
			partDlgTitle = "新增配件";
            } else{ // 修改配件信息
    			url += "?ep_pt="+param;
    			partDlgTitle = "配件信息修正";
        	}
    	}
        $('#dlg-part').dialog({
            title: partDlgTitle,
            width: 800,
            height: 600,
            closed: false,
            cache: false,
            href: url,
            modal: true,
            buttons:[{
				text:'保存',
				iconCls:'icon-ok',
				handler:function(){return savePart();}
			},{
				text:'取消',
				iconCls:'icon-cancel',
				handler:function(){$('#dlg-part').dialog('close');}
			}]
        });
    }
    function savePart(){
    	$('#epc-part-temp-form').form('submit',{
          //url: url,
          onSubmit: function(){
              //return $(this).form('validate');
              return true;
          },
          success: function(result){
              if(result=='success'){
            	  $('#dlg-part').dialog('close'); // close the dialog
            	  if($('#dg-part')) {
                  	  $('#dg-part').datagrid('reload');//reload the user data
            	  }
            	  $.messager.alert(partDlgTitle,'信息已经成功提交，感谢您的支持！');
//             	  $.messager.show({
//           			title:partDlgTitle,
//           			msg:'信息已经成功提交，感谢您的支持！',
//           			timeout:5000,
//           			showType:'slide'
//           		  });
              }else{
            	  $('#dlg-part').find('.form:first').replaceWith(result);
              }
          }
      });
      return true;
   }
</script>    