<!-- 弹出层 
<div id="dlg-model" class="easyui-dialog" style="width:800px;height:600px;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons">
	<?php //echo $this->renderPartial('_form', array('model'=>$model,
		//	'action'=>Yii::app()->createUrl('jpdata/epcModelTemp/create'),'submitFun'=>'saveModel'
		//)); ?>
	<div id="dlg-buttons">
    	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:$('#epc-model-temp-form').submit()">保存</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-model').dialog('close')">取消</a>
	</div>
</div>
-->
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/zzhgl.js'></script>
<div id="dlg-model"></div>
<script type="text/javascript">
    //var url;
    var modelDlgTitle = "新增车型";
    function newModel(){
        //$('#dlg-model').dialog('open').dialog('setTitle','添加车型');
        //$('#epc-model-temp-form ').form('reset');
        //url = Yii_jpdata_baseUrl+"/epcModelTemp/create";
    	var url = Yii_jpdata_baseUrl+"/epcModelTemp/create";
        $('#dlg-model').dialog({
            title: modelDlgTitle,
            width: 800,
            height: 600,
            closed: false,
            cache: false,
            href: url,
            modal: true,
            buttons:[{
				text:'保存',
				iconCls:'icon-ok',
				handler:function(){return saveModel();}
			},{
				text:'取消',
				iconCls:'icon-cancel',
				handler:function(){$('#dlg-model').dialog('close');}
			}]
        });
    }
    function saveModel(){
    	$('#epc-model-temp-form').form('submit',{
          //url: url,
          onSubmit: function(){
              //return $(this).form('validate');
              return true;
          },
          success: function(result){
              if(result=='success'){
            	  //$('#dlg-model').find('.form:first').html('提交成功');
            	  $('#dlg-model').dialog('close'); // close the dialog
            	  if($('#dg-model')){
                  	  $('#dg-model').datagrid('reload');//reload the user data
            	  }
            	  $.messager.alert(modelDlgTitle,'信息已经成功提交，感谢您的支持！');
              }else{
              	  $('#dlg-model').find('.form:first').replaceWith(result);
              }
          }
      });
      return true;
  }
</script>    
