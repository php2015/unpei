<style>
.errorMessage {float:left; margin-left:360px; color:red; margin-top:-30px;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/dealer.css" />
<div class="content-row auto_height">
	<?php include 'tabs_active.php';?>
	<div class="inner-padding">
	<div class="form-list">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'dealer-promotion-form',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>true,
    	'clientOptions'=>array('validateOnSubmit'=>true),
	)); ?>
		<p class="form-row">
		<?php echo $form->labelEx($model,'商品名称:',array('class'=>'label')); ?>
		<?php echo $form->textField($model,'goodsName',array('class'=>'width213 input')); ?>
		<?php echo $form->error($model,'goodsName'); ?>
		</p>
		
		
		<p class="form-row">
		<?php echo $form->labelEx($model,'商品编号:',array('class'=>'label')); ?>
		<?php echo $form->textField($model,'goodsNO',array('size'=>24,'maxlength'=>24,'class'=>'width213 input')); ?>
		<?php echo $form->error($model,'goodsNO'); ?>
		</p>
		<p class="form-row">
		<?php echo $form->labelEx($model,'商品品牌:',array('class'=>'label')); ?>
		<?php echo $form->textField($model,'goodsBrand',array('size'=>24,'maxlength'=>24,'class'=>'width213 input')); ?>
		<?php echo $form->error($model,'goodsBrand'); ?>
		</p>
		<p class="form-row">
		<?php echo $form->labelEx($model,'配件品类:',array('class'=>'label')); ?>
			<?php $cpnames = GoodsStandard::model()->findAll();
			$cpname = CHtml::listData($cpnames,"system_type","system_type");
			$cpname = array_filter($cpname);
			echo CHtml::dropDownList('system_type','system_type',$cpname,array(
					'class'=>'width118 select',
					'empty'=>'选择系统',
					'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=> Yii::app()->request->baseUrl.'/common/getcp_name', //url to call
                            'update'=>'#cp_name', //lector to update
                            'data'   => 'js:"system_type="+jQuery(this).val()',)
			));
		?>		
		 <?php echo Chtml::dropDownList('cp_name','cp_name', array(),array(
		    		'class'=>'width118 select',
		    		'empty'=>'请选择品类',
		    ));?> <span id='addcpname' class="btn" style="cursor:pointer">添加</span>
		
		<?php // echo $form->textField($model,'normName',array('size'=>24,'maxlength'=>24,'class'=>'width213 input')); ?>
		<?php //echo $form->error($model,'normName'); ?>
		</p>
		<p class="form-row" id="showcpname"><!-- 显示车系车型 -->
			<label class=label></label>
                        <?php if(isset($_GET['id'])): ?>
                        <?php  $showcpnames = DealerPromotionCpname::model()->findAll("pgoods_id=".$_GET['id']); ?>
			<?php if(!empty($showcpnames)):?>
			<?php foreach ($showcpnames as $showcpname):?>
				<span class='checkbox-add bg-green tag-close catespan'><span><?php //echo $showcpname['father_code'];?></span><span name='cp_name'><?php echo $showcpname['cp_name']?></span><span onclick='xxcpname(this)' key="<?php echo $showcpname['id']?>" class='close icon-close-green xx'></span></span>
			<?php endforeach;?>
			<?php endif;?>
                    <?php endif;?>
		</p>
		<p class="form-row">
		<?php echo $form->labelEx($model,'配件级别:',array('class'=>'label')); ?>
		<?php echo $form->textField($model,'partsLevel',array('size'=>24,'maxlength'=>24,'class'=>'width213 input')); ?>
		<?php echo $form->error($model,'partsLevel'); ?>
		</p>
		<p class="form-row">
		<label class="label">OE　　号:</label>
		<?php echo $form->textField($model,'OENO',array('size'=>24,'maxlength'=>24,'class'=>'width213 input')); ?>
		<?php echo $form->error($model,'OENO'); ?>
		</p>
	
		<p class="form-row">
			<label class='label'><?php echo $form->labelEx($model,'适用车系:'); ?></label>
			<?php
              //  $make_data=  TransportMake::model()->findAll();
                $make_data=  GoodsBrand::getBrand();
                 $make=CHtml::listData($make_data,"id","name");?>
			<?php echo $form->dropDownList($model,'make', $make ,array(
					'class'=>'width118 select',
					'empty'=>'请选择品牌',
					'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=> Yii::app()->request->baseUrl.'/common/getcarbyid', //url to call
                            'update'=>'#DealerPromotion_car', //lector to update
                            'data'   => 'js:"make="+jQuery(this).val()',
                    )
            ));?>
		    <?php echo $form->dropDownList($model,'car', array(),array(
		    		'class'=>'width118 select',
		    		'empty'=>'请选择车系',
		    ));?>
			<?php // echo $form->error($model,'businessCar'); ?>
			<span id='addVehcle' class="btn" style="cursor:pointer">添加</span>
		</p>
		<p class="form-row" id="showVehicle"><!-- 显示车系车型 -->
		<label class=label></label>
                <?php if(isset($_GET['id'])): ?>
                    <?php $showvehicles = DealerParts::model()->findAll('pgoods_id='.$_GET['id']); ?>
                    <?php if(!empty($showvehicles)):?>
                    <?php foreach ($showvehicles as $showvehicle):?>
                            <span class='checkbox-add bg-green tag-close catespan'><span><?php GoodsBrand::showName($showvehicle['maincate']) ?></span>-<span name='model'><?php GoodsBrand::showCar($showvehicle['subcate']) ?></span><span onclick='xxVehicle(this)' key="<?php echo $showvehicle['id']?>" class='close icon-close-green xx'></span></span>
                    <?php endforeach;?>
                    <?php endif;?>
                <?php  endif; ?>
		</p>
		<p class="form-row">
		<?php echo $form->labelEx($model,'优惠说明:',array('class'=>'label','style'=>'vertical-align: top')); ?>
		<?php echo $form->textArea($model,'youhui',array('size'=>60,'maxlength'=>255,'class'=>'width327 textarea')); ?>
		<?php echo $form->error($model,'youhui'); ?>
		</p>
		<p class="form-row">
			<label class="label"></label>
			<input type="button" id='savebutton' value="保存" class="submit">
			<a class='btn' onclick="javascript:window.history.go(-1)">返回</a>
			</p>
	<?php $this->endWidget(); ?>
	</div>
	</div>
</div>;

<script>
//删除主营车系
function xxVehicle(obj){
   var cateid = obj.getAttribute("key")
   if(cateid != 0)
	{
		var url =" <?php echo Yii::app()->createUrl('dealer/marketing/deletepromvehicle'); ?>";
		$.getJSON(url,{cateid:cateid},function(data){
			if(data == 1)
				$(obj).parent().remove();
		});
   }else{
	   $(obj).parent().remove();
	}
}
//删除主营
function xxcpname(obj){
	var bool = true;//confirm('您确定要删除这个吗?');
	if(bool){
	   var cpnid = obj.getAttribute("key")
	   if(cpnid != 0)
		{
			var url = Yii_baseUrl +"/dealer/marketing/deletepromcpname";
			$.getJSON(url,{cpnid:cpnid},function(data){
				if(data == 1){
					$(obj).parent().remove();
				alert('删除成功！');
				}
			});
	   }else{
		   $(obj).parent().remove();
		}
	}
}
// 可多选品类
$(function(){
$("#savebutton").click(function(){
   if(confirm('点击确定后，将保存这条数据')){
       $("form").submit();
   }
   
});
    //onclick="return confirm('点击确定后，将保存这条数据')"
	// 添加主营品类
	$("#addcpname").click(function(){
			if($("#showcpname span.catespan").length <5)
			{
				var system_type =  $("#system_type option:selected").text();
				var cp_name = $("#cp_name option:selected").text()
				if(system_type == "选择系统" || cp_name=="请选择品类")
				{
                                    alert('您还没有选择主营品类！');
                                    return false;
				
				}else{
                                    var al='';
					$("#showcpname span.catespan").each(function(){
//						var systemCode=$(this).find('span[name=system]').html();
						var cpCode=$(this).find('span[name=cp_name]').html();
						if(cp_name==cpCode){
							al='此品类您已添加，不可重复添加！';
						}
					})
					if(al==''){
                                                $("<span class='checkbox-add bg-green tag-close catespan'><span></span><span name='cp_name'>"+cp_name+"</span><span onclick='xxcpname(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showcpname");
                                                $("<input type='hidden' value="+system_type+" name='system_t[]'><input type='hidden' value="+cp_name+" name='cp_name[]'>").appendTo("#showcpname");
					}else{
						alert(al);
					}
                                }
				//$("<span class='checkbox-add bg-green tag-close catespan'><span></span><span>"+cp_name+"</span><span onclick='xxcpname(this)' key='0' class='close icon-close-green xx'>X</span></span>").appendTo("#showcpname");
				//$("<input type='hidden' value="+system_type+" name='system_t[]'><input type='hidden' value="+cp_name+" name='cp_name[]'>").appendTo("#showcpname");
			}else{
				alert("最多只能添加5个");
				}
	});
	// 添加车系
	$("#addVehcle").click(function(){
		if($("#showVehicle span.catespan").length <5){
			
			var businessCar =  $("#DealerPromotion_make option:selected").text();
			var businessCarModel = $("#DealerPromotion_car option:selected").text()
			var businessCarval = $("#DealerPromotion_make").val()
			var businessCarModelval = $("#DealerPromotion_car").val()
			if(businessCar=="请选择品牌" || businessCarModel=="请选择车系")
			{
				alert('请选择适用车系');
				return false;
			}{
                                    var al='';
					$("#showVehicle span.catespan").each(function(){
//						var systemCode=$(this).find('span[name=system]').html();
						var cpCode=$(this).find('span[name=model]').html();
						if(businessCarModel==cpCode){
							al='此车系您已添加，不可重复添加！';
						}
					})
					if(al==''){
                                           $("<span class='checkbox-add bg-green tag-close catespan'><span>"+businessCar+"</span>-<span name='model'>"+businessCarModel+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showVehicle");
                                            $("<input type='hidden' value="+businessCarval+" name='businessCar[]'><input type='hidden' value="+businessCarModelval+" name='businessCarModel[]'>").appendTo("#showVehicle");
					}else{
						alert(al);
					}
                                }
			//$("<span class='checkbox-add bg-green tag-close catespan'><span>"+businessCar+"</span>-<span>"+businessCarModel+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'>X</span></span>").appendTo("#showVehicle");
			//$("<input type='hidden' value="+businessCarval+" name='businessCar[]'><input type='hidden' value="+businessCarModelval+" name='businessCarModel[]'>").appendTo("#showVehicle");
			}else{
				alert("最多只能添加5个");
			}
	});
	
})

</script>
<div style="height:60px"></div>
<div class="block-shadow"></div>
