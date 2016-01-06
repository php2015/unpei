<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "商品修改";
?>
<div class="auto_width auto_height" id="ss">
    <!-- tab菜单{ -->
	<div class='tabs' pre='tab'>
		<a class='left-indent'>&nbsp;</a>
		<?php echo CHtml::link('商品修改','javascript::void(0)',array('class'=>'active'))?>
</div>
	<!-- } -->
	<!-- 信息提示 -->
	<?php if(Yii::app()->user->hasFlash('success')):?>  
   <div class="successmessage" id="message">
    <?php echo Yii::app()->user->getFlash('success'); ?>  
   </div>
    <?php endif?>
    <?php if(Yii::app()->user->hasFlash('failed')):?>  
	<div class="errormessage" id="message">
	<?php echo Yii::app()->user->getFlash('failed'); ?>  
	</div>
	<?php endif?>
	<!-- } -->
     <?php 
		$form=$this->beginWidget('CActiveForm', array(
 			'id'=>'goodsmodify-form',
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true),
		    //'clientOptions'=>Yii::app()->params['clientOptions'],
		));
	?>
	<div class="form">
		<div class='title title-dashed' style="height:43px">基础信息
	          <span class='row' style="padding-left:42px">
	          <?php //echo CHtml::beginForm('','post');?>
	          <label>版本选择:</label>
				 <?php echo $form->dropDownlist($model,'version',Chtml::listData($version,'version_name','version_name'),array('id'=>'version'))?>
				 <input type="hidden" name="hidden" id="hidden" value="<?php echo $result['id']?>">
				 <?php echo $form->error($model,'version')?>
				<?php //echo CHtml::endForm();?>
			</span>
			<?php echo CHtml::link("返回",Yii::app()->createUrl('maker/salesmanage/querygoods'),array('style'=>'padding-left:350px;'))?>
		</div>
		<div class='row'>
				 <label class="label">商品名称:</label>
				 <?php echo $form->textField($model,'goodsname',array('class'=>'width213 input','value'=>$result['name']))?>
				 <?php echo $form->error($model,'goodsname')?>
		</div>
	    <div class='row'>
				  <label class="label">商品编号:</label>
				 <?php echo $form->textField($model,'goodsno',array('class'=>'width113 input','value'=>$result['goodsno']))?>
				  <label >商品品牌:</label>
				   <?php echo $form->textField($model,'brand',array('class'=>'width113 input','value'=>$result['brand']))?>
				 <?php  //echo $form->dropDownlist($model,'brand',CHtml::listData($brand,'name','name'),array('class'=>'width113 input'))?>
				 <label>商品类别:</label>
				 <?php  echo $form->dropDownlist($model,'category',CHtml::listData($category,'id','name'),array('class'=>'width113 input'))?>
				 <?php echo $form->error($model,'goodsno')?>
				 <?php echo $form->error($model,'brand')?>
				 <?php echo $form->error($model,'category')?>
		    </div>
	    <div class='row'>
				 <label class="label">原厂OE号:</label>
				 <?php echo $form->textField($model,'oeno',array('class'=>'width213 input','value'=>$result['oe']))?>
				 <span>(如有多个OE号,用" ,"隔开)</span>
				 <?php echo $form->error($model,'oeno')?>
		</div>
		<div class='row' style="display: none">
				<p class="form-row">
				 <label class="label">适用车系:</label>
				 <?php //echo $form->dropDownlist($model,'car',CHtml::listData($car,'VehicleID','car'),array('id'=>'car','class'=>'width113 input','empty'=>'选择车系'))?>
				 <?php //echo $form->dropDownlist($model,'model',CHtml::listData($models,'VehicleID','model'),array('id'=>'model','class'=>'width113 input','empty'=>'选择车型'))?>
				 <span id='goods_add' class='btn-small'  rm='click_#rcby_class_bg-green'>添加</span>					
				 <?php //echo $form->error($model,'car')?>
				 <?php //echo $form->error($model,'model')?>
				 <span id="showRepair" style="margin-left: 35px;">
				 <?php //foreach ($car_result as $value):?>
				 <span class='checkbox-add bg-green tag-close catespan' carid='<?php //echo $value['VehicleID']. $value['VehicleID']?>' ><span class='cars' ><?php //echo $value['car']?></span>_<span class='modelval'><?php// echo $value['model']?></span><span id='close' class='close icon-close-green' cdid='<?php //echo $value['VehicleID']?>'></span></span>
				  <input type='hidden'  value='<?php //echo $value['VehicleID']?>' name='car[]' class="hidden">
				  <input type='hidden'  value="<?php //echo $value['VehicleID']?>" name='model[]' class="hidden">
				 <?php //endforeach;?>
				 </span>
				</p>
		</div>
		<div id="params">
		<div class='title title-dashed' >参数信息</div>
		     	<div class='row'>
					<p class="form-row">
					 <label class="label">模板选择:</label>
					 <?php echo $form->dropDownList($model,'template',CHtml::listData($templates,'id','name'),array('id'=>'template','class'=>'width213 input'))?>
					 <?php echo $form->error($model,'template')?>
					</p>
					<table style="width:400px;padding-left:26px;" id='mdtab' >
					<tr>
					<td>属性名称</td>
					<td>属性值</td>
					</tr>
					<?php if(isset($values['tc1']) && !empty($values['tc1'])):?>
					<tr>
					<td><?php echo $values['tc1']?></td>
					<td><input class='width63 input' name='GoodsForm[column1]' id='GoodsForm_column' type='text' value='<?php echo $values['vc1']?>'/></td>
					</tr>
						<?php endif ?>
					<?php if(isset($values['tc2']) && !empty($values['tc2'])):?>
					<tr>
					<td><?php echo $values['tc2']?></td>
					<td><input class='width63 input' name='GoodsForm[column2]' id='GoodsForm_column' type='text' value='<?php echo $values['vc2']?>'/></td>
					</tr>
						<?php endif ?>
					<?php if(isset($values['tc3']) && !empty($values['tc3'])):?>
					<tr>
					<td><?php echo $values['tc3']?></td>
					<td><input class='width63 input' name='GoodsForm[column3]' id='GoodsForm_column' type='text' value='<?php echo $values['vc3']?>'/></td>
					</tr>
						<?php endif ?>
					<?php if(isset($values['tc4']) && !empty($values['tc4'])):?>
					<tr>
					<td><?php echo $values['tc4']?></td>
					<td><input class='width63 input' name='GoodsForm[column4]' id='GoodsForm_column' type='text' value='<?php echo $values['vc4']?>'/></td>
					</tr>
						<?php endif ?>
							<?php if(isset($values['tc5']) && !empty($values['tc5'])):?>
					<tr>
					<td><?php echo $values['tc5']?></td>
					<td><input class='width63 input' name='GoodsForm[column5]' id='GoodsForm_column' type='text' value='<?php echo $values['vc5']?>'/></td>
					</tr>
						<?php endif ?>
					</table>
						<div class="auto height" id="tabe">
				</div>
				</div>
				<div class='title title-dashed'>销售信息</div>
				<div class='row'>
					 <label class="label">市场指导价:</label>
					 <?php echo $form->textField($model,'price',array('class'=>'width113 input','value'=>$result['price']))?>　元
					 <label class="label">经销商价:</label>
					A类 <?php echo $form->textField($model,'priceA',array('class'=>'width43 input','value'=>$result['priceA']))?>　元
					B类 <?php echo $form->textField($model,'priceB',array('class'=>'width43 input','value'=>$result['priceB']))?>　元
					C类 <?php echo $form->textField($model,'priceC',array('class'=>'width43 input','value'=>$result['priceC']))?>　元
					 <?php echo $form->error($model,'priceA')?>
					 <?php echo $form->error($model,'priceB')?>
					 <?php echo $form->error($model,'priceC')?>
				</div>
		<div class='row'>
			<p class="form-row">
			 <label class="label">配件档次:</label>
			 <?php echo $form->dropDownList($model,'parts_level',CHtml::listData($parts_level,'id','code','description'),array('class'=>'width113 input'))?>
			 <label>现有库存:</label>
			 <?php echo $form->textField($model,'inventory',array('class'=>'width113 input','value'=>$result['inventory']))?>
			 <label>发货天数:</label>
			 <?php echo $form->textField($model,'days',array('class'=>'width113 input','value'=>$result['senddays']))?>
			 <?php echo $form->error($model,'parts_level')?>
			 <?php echo $form->error($model,'inventory')?>
			 <?php echo $form->error($model,'days')?>
			</p>
		</div>
		<div class='row'>
			<p class="form-row">
			 <label class="label">备注:</label>
			 <?php echo $form->textArea($model,'desc',array('style'=>'width:546px;height:60px'))?>
			 <?php echo $form->error($model,'desc')?>
			</p>
		</div>
		</div>
		<p class="form-row">
			<?php  echo CHtml::submitButton('保存',array('class'=>'submit','id'=>'submit','style'=>'margin-left:84px')); ?>
		</p>
	<?php $this->endWidget(); ?>
 	</div>
 </div>
 <?php 
 //这是一段,在显示后定里消失的JQ代码,已集成至Yii中.
Yii::app()->clientScript->registerScript(
'myHideEffect',
'$("#message").animate({opacity: 1.0}, 2000).fadeOut("slow");',
CClientScript::POS_READY
);
?>
<script type="text/javascript">
	$(document).ready(function(){
// 		//删除车系
// 		$('.close').click(function(){
// 		   var vehid=$(this).attr('cdid');
// 		   var  goodid=$('#hidden').val();
// 		   //删除隐藏域
// 		   $(this).closest('span.checkbox-add').nextAll('input[value="'+vehid+'"]').remove();
// 		   var url =  Yii_baseUrl+ "/maker/salesmanage/deletecar";
// 		    $.ajax({
// 		    	 url: url,
// 		    	 type: "POST",
// 		       	 data: {
// 			       	 'vehid': vehid,
// 			       	 'goodid': goodid
// 		       	 },
// 		         dataType: "json",
// 		         success:function(data){
// 			       location.reload();
// 		         }
// 		    });
// 		 });
// 		var caridobj={};
	  
// 		//添加多条车型车系
// 		 $('#goods_add').click(function()
// 		 {
			
// 		 if($("#showRepair span.catespan").length <5){
// 			var car=$("#car").find("option:selected").text();
// 			var carval=$("#car").find("option:selected").val();
// 			var model=$('#model').find('option:selected').text();
// 			var modelval=$('#model').find('option:selected').val();
// 			if(car=='选择车系'&& model=='选择车型')
// 			{
// 				return false;
// 			}
// 			//遍历
// 			$('#showRepair span[carid]').each(function(){
// 				caridobj[$(this).attr('carid')]=true;
// 			});
// 			if(caridobj[carval+modelval])
// 			{
// 				alert('该车系已存在');
// 				return false;
// 			}
// 			$("<span class='checkbox-add bg-green tag-close catespan' carid='"+carval+modelval+"'><span class='cars' >"+car+"</span>_<span class='modelval'>"+model+"</span><span id='close' class='close icon-close-green'></span></span>").appendTo("#showRepair");
// 			$("<input type='hidden'  value="+carval+" name='car[]'><input type='hidden'  value="+modelval+" name='model[]'>").appendTo("#showRepair");

// 			caridobj[carval+modelval]=true;
// 			}
// 		else
// 		{
// 			alert('最多添加5个');
// 		}

// 		});
// 		$(document).delegate('#showRepair .checkbox-add .close','click',function(){
// 				var carid = $(this).closest('[carid]').attr('carid');
// 				caridobj[carid]=null;
// 				});
// 	 //车系车型联动下拉菜单
// 	  $("#car").change(function(){
// 			//传递厂家的参数
// 			var car=$('#car').find('option:selected').text();
// 			var carval=$('#car').find('option:selected').val();
// 			if(carval==''&& car=='选择车系')
// 			{
// 				$('#model').html('<option >选择车型</option>');
// 				return false;
// 			}
// 			var url =  Yii_baseUrl+ "/maker/salesmanage/getmodel";
// 		    $.ajax({
// 		    	 url: url,
// 		    	 type: "POST",
// 		       	 data: {
// 			       	 'car': car
// 		       	 },
// 		         dataType: "json",
// 		         success:function(data){
// 			         var html = "";
// 			         for(i=0;i<data.length;i++){
// 			        	 html += "<option value='"+data[i]['VehicleID']+ "'>"+data[i]['model']+"</option>"
// 			         }
// 			         $('#model').html(html);
// 		         }
// 		    });
// 		    return false;
// 		});
	//版本更换
 	$('#version').change(function(){
		var versionID=$('#version').val();
		var  goodsID=$('#hidden').val();
		location.href="<?php echo Yii::app()->createUrl('maker/salesmanage/modify')?>"+'/id/'+goodsID+'/verid/'+versionID;
 	});
	//添加属性值行
	$('#template').change(function(){
		var template=$('#template').find('option:selected').val();
		if(template=='')
		{
			$('#tab').hide();
			return false;
		}
		var url =  Yii_baseUrl+ "/maker/salesmanage/gettemplatevalue";
	    $.ajax({
	    	 url: url,
	    	 type: "POST",
	       	 data: {
		       	 'template':template
	       	 },
	         dataType: "json",
	         success:function(data){
              var html='<table style="width:450px;padding-left:50px;" id="tab"><tr><td>属性名称</td><td>属性值</td></tr>';
              if(data.Column1!=null)
              {
	        	 html += "<tr id='c1'><td>"+data.Column1+"</td><td> <input class='width43 input' name='GoodsForm[column1]' id='GoodsForm_column' type='text' /></td></tr>";
              }
              if(data.Column2!=null)
              {
		         html +="<tr id='c2'><td>"+data.Column2+"</td><td><input class='width43 input' name='GoodsForm[column2]' id='GoodsForm_column' type='text' /></td></tr>"
              }
              if(data.Column3!=null)
              {
	        	 html += "<tr id='c1'><td>"+data.Column3+"</td><td> <input class='width43 input' name='GoodsForm[column3]' id='GoodsForm_column' type='text' /></td></tr>";
              }
              if(data.Column4!=null)
              {
	        	 html += "<tr id='c1'><td>"+data.Column4+"</td><td> <input class='width43 input' name='GoodsForm[column4]' id='GoodsForm_column' type='text' /></td></tr>";
              }
              if(data.Column5!=null)
              {
	        	 html += "<tr id='c1'><td>"+data.Column5+"</td><td> <input class='width43 input' name='GoodsForm[column5]' id='GoodsForm_column' type='text' /></td></tr>";
              }
			     $('#mdtab').html(html);
	         }
	    });
	});
});
</script>