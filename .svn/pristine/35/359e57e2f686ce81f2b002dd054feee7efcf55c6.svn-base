<style>
<!--
/*.xx{width:10px;float:right: cursor:pointer; color:red; margin-left:5px;}*/
-->
</style>
<?php
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
?>
<div>
	<div class='tabs' pre='tab'>
		<a class='left-indent'>&nbsp;</a>
		<a <?php if($controlerId=='business' && $actionId=='mainbusiness') echo $active;?> href="<?php echo Yii::app()->createUrl('mall/business/mainbusiness');?>">主营登记</a>
	</div>
	<div class='form-list'>
	<?php 
	$form=$this->beginWidget('CActiveForm', array( 
		'id'=>'dealer-form', 
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			
		),  
	)); 
	?>
		<p class="form-row">
			<label class='label'> 主营配件品牌：</label>
			<?php echo $form->textField($model,'BusinessBrand',array('class'=>'width453 input','onkeyup'=>"this.value=this.value.replace(/，/g, ',')")); ?>
			<span>（每个品牌之间用“，”隔开）</span>
		</p>
		<p class="form-row">
			<label class='label'>主营品类：</label>
			<?php echo $form->textField($model,'BusinessCate',array('class'=>'width453 input','onkeyup'=>"this.value=this.value.replace(/，/g, ',')")); ?>
		</p>
		<p class="form-row slider" style='line-height:0;'>
			<label class='label'></label>
			<span id='tag1' class="width451 slide display-n">
			<a class='tag'>轮胎</a>
			</span>
		</p>
		
		<p class="form-row" id="showVehicle"><!-- 显示车系车型 -->
		<label class=label></label>
		<?php foreach ($showvehicles as $showvehicle):?>
			<span class='checkbox-add bg-green tag-close catespan'><span><?php TransportMake::showMake($showvehicle['businessCar']) ?></span>-<span><?php TransportCar::showCar($showvehicle['businessCarModel']) ?></span><span onclick='xxVehicle(this)' key="<?php echo $showvehicle['id']?>" class='close icon-close-green xx'></span></span>
		<?php endforeach;?>
		</p>
		
		<p class="form-row">
			<label class='label'><?php echo $form->labelEx($model,'businessCar'); ?></label>
			<?php
                $make_data=  TransportMake::model()->findAll();
                $make=CHtml::listData($make_data,"Code","Make");?>
			<?php echo $form->dropDownList($model,'businessCar', $make ,array(
					'class'=>'width118 select',
					'empty'=>'请选择品牌',
					'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=> Yii::app()->request->baseUrl.'/common/getcar', //url to call
                            'update'=>'#Dealer_businessCarModel', //lector to update
                            'data'   => 'js:"make="+jQuery(this).val()',
                    )
            ));?>
		    <?php echo $form->dropDownList($model,'businessCarModel', array(),array(
		    		'class'=>'width118 select',
		    		'empty'=>'请选择车系',
		    ));?>
			<?php echo $form->error($model,'businessCar'); ?>
			<span id='addVehcle' class="btn">添加</span>
		</p>
		<p class="form-row">
			<label class='label'><?php echo $form->labelEx($model,'keyword'); ?></label>
			<?php echo $form->textArea($model,'keyword',array('rows'=>4, 'cols'=>140, 'class'=>'width627 textarea','onkeyup'=>"this.value=this.value.replace(/，/g, ',')"));?>
			<?php echo $form->error($model,'keyword'); ?>
			<br/>
		</p>
		<p class="form-row words-add">
			（最多添加20个关键词，每个关键词之间用“，”隔开）
		</p>
		<p class="form-row">
			<label class="label"></label>
			<input class="submit" type='submit' value='保存资料'></input>
		</p>
		<?php $this->endWidget(); ?>
	</div>
	<!-- 显示边栏 -->
	<div class="sidebar-show"></div>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>

</div>

<script type="text/javascript">

//删除主营
function xxSpan(obj){
   var cateid = obj.getAttribute("key")
   if(cateid != 0)
	{
		var url =" <?php echo Yii::app()->createUrl('ds04/mainbuessine/deletecate'); ?>";
		$.getJSON(url,{cateid:cateid},function(data){
			if(data == 1)
				$(obj).parent().remove();
		});
   }else{
	   $(obj).parent().remove();
	}
}
//删除主营车系
function xxVehicle(obj){
   var cateid = obj.getAttribute("key")
   if(cateid != 0)
	{
		var url =" <?php echo Yii::app()->createUrl('dealer/business/deleteVehicle'); ?>";
		$.getJSON(url,{cateid:cateid},function(data){
			if(data == 1)
				$(obj).parent().remove();
		});
   }else{
	   $(obj).parent().remove();
	}
}


// 可多选品类
$(function(){
	
	// 添加车系
	$("#addVehcle").click(function(){
		if($("#showVehicle span.catespan").length <5){
			
			var businessCar =  $("#Dealer_businessCar option:selected").text();
			var businessCarModel = $("#Dealer_businessCarModel option:selected").text()
			var businessCarval = $("#Dealer_businessCar").val()
			var businessCarModelval = $("#Dealer_businessCarModel").val()

			$("<span class='checkbox-add bg-green tag-close catespan'><span>"+businessCar+"</span><span>"+businessCarModel+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'>X</span></span>").appendTo("#showVehicle");
			$("<input type='hidden' value="+businessCarval+" name='businessCar[]'><input type='hidden' value="+businessCarModelval+" name='businessCarModel[]'>").appendTo("#showVehicle");
			}else{
				alert("最多只能添加5个");
			}
	});
	
})

</script>
