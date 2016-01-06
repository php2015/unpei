<!-- 新增 弹出层  
<div id="dlg-group" class="easyui-dialog" style="width:800px;height:600px;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons">
	<?php //echo $this->renderPartial('_form', array('model'=>$model,'epcModel'=>$epcModel,
// 			'action'=>Yii::app()->createUrl('jpdata/epcGroupTemp/create'),'submitFun'=>'saveGroup'
// 		)); ?>
	<div id="dlg-buttons">
    	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:$('#epc-group-temp-form').submit()">保存</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-group').dialog('close')">取消</a>
	</div>
</div>
-->
<div id="dlg-group"></div>
<script type="text/javascript">
    //var url;
	var groupDlgTitle = "新增配件组";
    function newGroup(modelId){
        //$('#dlg-group').dialog('open').dialog('setTitle','添加配件组');
        //$('#epc-group-temp-form').form('reset');
        var url = Yii_jpdata_baseUrl+"/epcGroupTemp/create";
        if(modelId) {
			url += "?ep_ml="+modelId;
    	}
        $('#dlg-group').dialog({
            title: groupDlgTitle,
            width: 800,
            height: 600,
            closed: false,
            cache: false,
            href: url,
            modal: true,
            buttons:[{
				text:'保存',
				iconCls:'icon-ok',
				handler:function(){return saveGroup();}
			},{
				text:'取消',
				iconCls:'icon-cancel',
				handler:function(){$('#dlg-group').dialog('close');}
			}]
        });
    }
    function saveGroup(){
    	$('#epc-group-temp-form').form('submit',{
          //url: url,
          onSubmit: function(){
              //return $(this).form('validate');
              return true;
          },
          success: function(result){
              if(result=='success'){
            	  $('#dlg-group').dialog('close'); // close the dialog
            	  if($('#dg-group')) {
                  	  $('#dg-group').datagrid('reload');//reload the user data
            	  }
            	  $.messager.alert(groupDlgTitle,'信息已经成功提交，感谢您的支持！');
              }else{
            	  $('#dlg-group').find('.form:first').replaceWith(result);
              }
          }
      });
      return true;
   }
</script>