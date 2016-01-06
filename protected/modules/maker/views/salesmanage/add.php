<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "商品添加";
?>
<div class="auto_width auto_height">
    <!-- tab菜单{ -->
	<?php $this->renderPartial('tab');?>
	<!-- } -->
	<?php if(Yii::app()->user->hasFlash('success')):?>  
   <div class="successmessage" id='message'>
    <?php echo Yii::app()->user->getFlash('success'); ?>  
   </div>
    <?php endif?>
    <?php if(Yii::app()->user->hasFlash('failed')):?>  
	<div class="errormessage" id='message'>
	<?php echo Yii::app()->user->getFlash('failed'); ?>  
	</div>
	<?php endif?>
	
     <?php 
		$form=$this->beginWidget('CActiveForm', array(
 			'id'=>'goodsadd-form',
			//'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
		    'clientOptions'=>array('validateOnSubmit'=>true),
			//'clientOptions'=>Yii::app()->params['clientOptions'],
		));
	?>
	<div class="form">
		<div class='title title-dashed'>基础信息
		</div>
		<div class='row'>
		 <label class="label">商品名称:</label>
				 <?php // echo $form->labelEx($model,'goodsname',array('class'=>'label'))?>
				 <?php echo $form->textField($model,'goodsname',array('class'=>'width213 input'))?>
				 <?php echo $form->error($model,'goodsname')?>
		</div>
	    <div class='row'>
	    <label class="label">商品编号:</label>
				 <?php //echo $form->labelEx($model,'goodsno',array('class'=>'label'))?>
				 <?php echo $form->textField($model,'goodsno',array('class'=>'width113 input'))?>
				  <label >商品品牌:</label>
				   <?php echo $form->textField($model,'brand',array('class'=>'width113 input'))?>
				 <?php //echo $form->dropDownlist($model,'brand',CHtml::listData($brand,'name','name'),array('class'=>'width113 input','empty'=>'选择品牌'))?>
				 <label>商品类别:</label>
				 <?php echo $form->dropDownlist($model,'category',CHtml::listData($category,'id','name'),array('class'=>'width113 input','empty'=>'选择分类'))?>
				 <?php echo $form->error($model,'goodsno')?>
				 <?php echo $form->error($model,'brand')?>
				 <?php echo $form->error($model,'category')?>
		    </div>
	    <div class='row'>
				 <label class="label">原厂OE号:</label>
				 <?php echo $form->textField($model,'oeno',array('class'=>'width213 input'))?>
				 <span>(如有多个OE号,用" ,"隔开)</span>
				 <?php echo $form->error($model,'oeno')?>
		</div>
		<div class='row' style="display: none">
				 <label class="label">适用车系:</label>
				 <?php echo $form->dropDownlist($model,'car',CHtml::listData($car,'VehicleID','car'),array('id'=>'GoodsForm_car','class'=>'width113 input','empty'=>'选择车系'))?>
				 <?php echo $form->dropDownlist($model,'model',array(),array('id'=>'GoodsForm_model','class'=>'width113 input','empty'=>'选择车型'))?>
				 <span id='goods_add' class='btn-small'  rm='click_#rcby_class_bg-green'>添加</span>					
				 <?php echo $form->error($model,'car')?>
				 <?php echo $form->error($model,'model')?>
				 <p/>
				 <span id="showRepair" style="margin-left: 85px;">
				 </span>
		</div>
		<div class='title title-dashed'>参数信息</div>
		     	<div class='row'>
					 <label class="label">模板选择:</label>
					 <?php echo $form->dropDownList($model,'template',CHtml::listData($template,'id','name'),array('id'=>'GoodsForm_template','class'=>'width213 input','empty'=>'请选择模板'))?>
					 <?php echo $form->error($model,'template')?>
					<div class="auto height" id="tabe">
					</div>
				</div>
				<div class='title title-dashed'>销售信息</div>
				<div class='row'>
					 <label class="label">市场指导价:</label>
					 <?php echo $form->textField($model,'price',array('class'=>'width113 input'))?>　元
					 <label class='label'>经销商价:</label>
					A类 <?php echo $form->textField($model,'priceA',array('class'=>'width43 input'))?>　元
					B类 <?php echo $form->textField($model,'priceB',array('class'=>'width43 input'))?>　元
					C类 <?php echo $form->textField($model,'priceC',array('class'=>'width43 input'))?>　元
					 <?php echo $form->error($model,'priceA')?>
					 <?php echo $form->error($model,'priceB')?>
					 <?php echo $form->error($model,'priceC')?>
				</div>
		<div class='row'>
			 <label class="label">配件档次:</label>
			 <?php  echo $form->dropDownList($model,'parts_level',CHtml::ListData($partslevel,'id','code','description'),array('class'=>'width150 input','empty'=>"选择配件档次"))?>
			 <?php echo $form->error($model,'parts_level')?>
			 <label>现有库存:</label>
			 <?php echo $form->textField($model,'inventory',array('class'=>'width113 input'))?>
			 <?php echo $form->error($model,'inventory')?>
			 <label>发货天数:</label>
			 <?php echo $form->textField($model,'days',array('class'=>'width103 input'))?>
			 <?php echo $form->error($model,'days')?>
		</div>
		<div class='row'>
			<p class="form-row">
			 <label class="label">备注:</label>
			 <?php echo $form->textArea($model,'desc',array('class'=>'textarea','style'=>'width:550px;height:80px;'))?>
			 <?php echo $form->error($model,'desc')?>
			</p>
		</div>
		</div>
		<p class="form-row">
				<?php  echo CHtml::submitButton('保存',array('class'=>'submit','id'=>'submit','style'=>'margin-left:84px')); ?>
		</p>
	<?php $this->endWidget(); ?>
	
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
//var caridobj={};
 	$(document).ready(function(){
// 		$('#submit').click(function()
// 		{
// 			console.log($("#showRepair span.catespan").length);
// 			if($("#showRepair span.catespan").length==0){
// 				alert('请添加车系');
// 				return false;
// 			}
// 		})
// 	//添加多条车型车系
// 	 $('#goods_add').click(function()
// 	 {
// 	 if($("#showRepair span.catespan").length <5){
// 		var car=$("#GoodsForm_car").find("option:selected").text();
// 		var carval=$("#GoodsForm_car").find("option:selected").val();
// 		var model=$('#GoodsForm_model').find('option:selected').text();
// 		var modelval=$('#GoodsForm_model').find('option:selected').val();
// 		if(car=='选择车系'&& model=='选择车型')
// 		{
// 			return false;
// 		}
// 		if(caridobj[carval+modelval])
// 		{
// 			alert('该车系已存在');
// 			return false;
// 		}
// 		$("<span class='checkbox-add bg-green tag-close catespan' carid='"+carval+modelval+"'><span class='cars' >"+car+"</span>_<span class='modelval'>"+model+"</span><span id='close' class='close icon-close-green'></span></span>").appendTo("#showRepair");
// 		$("<input type='hidden'  value="+carval+" name='car[]'><input type='hidden'  value="+modelval+" name='model[]'>").appendTo("#showRepair");

// 		caridobj[carval+modelval]=true;
// 		}
// 	else
// 	{
// 		alert('最多添加5个');
// 	}

// 	});


// 		$(document).delegate('#showRepair .checkbox-add .close','click',function(){
// 			var carid = $(this).closest('[carid]').attr('carid');
// 			caridobj[carid]=null;
// 			});
		
// 	 //车系车型联动下拉菜单
// 	  $("#GoodsForm_car").change(function(){
// 			//传递厂家的参数
// 			var car=$('#GoodsForm_car').find('option:selected').text();
// 			var carval=$('#GoodsForm_car').find('option:selected').val();
// 			if(carval==''&& car=='选择车系')
// 			{
// 				$('#GoodsForm_model').html('<option >选择车型</option>');
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
// 			        	 html += "<option value='"+data[i]['VehicleID']+"' >"+data[i]['model']+"</option>"
// 			         }
// 			         $('#GoodsForm_model').html(html);
// 		         }
// 		    });
// 		    return false;
// 		});	
	   
 		//添加属性值行
		$('#GoodsForm_template').change(function(){
			var template=$('#GoodsForm_template').find('option:selected').val();
			if(template=='')
			{
				$('#tab').hide();
				return false;
			}
			$('#GoodsForm_template').removeClass('error');
			var url =  Yii_baseUrl+ "/maker/salesmanage/gettemplatevalue";
		    $.ajax({
		    	 url: url,
		    	 type: "POST",
		       	 data: {
			       	 'template':template
		       	 },
		         dataType: "json",
		         success:function(data){
	              var html='<table style="width:450px;padding-left:27px;" id="tab"><tr><td>属性名称</td><td>属性值</td></tr>';
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
				     $('#tabe').html(html);
		         }
		    });
		});
});
</script>