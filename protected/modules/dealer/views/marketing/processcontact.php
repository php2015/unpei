<style>
.errorMessage {float:left; margin-left:360px; color:red; margin-top:-30px;}
</style>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'contact-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'clientOptions'=>array('validateOnSubmit'=>true),
    'enableAjaxValidation' => false,
 	'enableClientValidation'=>true,
));
?>
<?php include 'tabs_active_contacts.php';?>
<div class='tab-content contact'>
	<div class='form-list'>
		<div class='title title-dashed-inline'>
			<span>机构信息</span>
		</div>
		<p class="form-row">
			<?php echo $form->labelEx($model,'机构名称:',array('class'=>'label')); ?>
			<?php echo $form->textField($model,'companyname',array('class'=>'width213 input')); ?>
			<?php echo $form->hiddenField($model,'contact_user_id',array('class'=>'width64 input'));?>
			<?php echo CHtml::button('选择',array('class'=>'btn-small','id'=>'choose'));?>
			<?php echo $form->error($model,'companyname',array('class'=>'errorMessage','style'=>'margin-left:420px;')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'客户类型:',array('class'=>'label')); ?>
			<?php echo $form->dropDownList($model,'customertype', array(
					'A' =>'A',
					'B' =>'B',
					'C' =>'C',
				),array('class'=>'width118 select customertype','empty'=>'请选择')); ?>
			<?php echo $form->error($model,'customertype',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'合作类型:',array('class'=>'label')); ?>
			<?php echo $form->dropDownList($model,'cooperationtype', array(
					'A' =>'A',
					'B' =>'B',
					'C' =>'C',
				),array('class'=>'width118 select cooperationtype','empty'=>'请选择')); ?>
			<?php echo $form->error($model,'cooperationtype',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'客户类别:',array('class'=>'label')); 
			$state_data=DealerCustomerCategory::model()->findAll("user_Id=:user_Id",array(":user_Id"=>Yii::app()->user->id));
            $state=CHtml::listData($state_data,"category","category");		
			echo $form->dropDownList($model,'customercategory', $state,array('class'=>'width118 select','empty'=>'请选择')); ?>
			<?php echo CHtml::link('&nbsp;*&nbsp;添加客户类别',array('marketing/processcategory'),array('style'=>'color:green;margin-left:38px;'));?>
			<?php echo $form->error($model,'customercategory',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<?php 
				echo $form->labelEx($model,'地　　址:',array('class'=>'label'));
                $state_data=Area::model()->findAll("grade=:grade",array(":grade"=>1));
                $state=CHtml::listData($state_data,"id","name");
                $s_default = $model->isNewRecord ? '' : $model->province;
                echo CHtml::dropDownList('province', $s_default, $state,
                	array(
                		'empty'=>'请选择省份',
                		'class'=>'width114 select',   
                        'ajax' => array(
	                        'type'=>'GET',
	                        'url'=>Yii::app()->request->baseUrl.'/common/dynamiccities',
	                        'update'=>'#city',
	                        'data'   => 'js:"province="+jQuery(this).val()',
                             )
                         )
                    );
                $c_default = $model->isNewRecord ? '' : $model->city;
                if(!$model->isNewRecord){
	                $city_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->province));
	                $city=CHtml::listData($city_data,"id","name");
                }
                $city_update = $model->isNewRecord ? array() : $city;
                
                echo '&nbsp;'.CHtml::dropDownList('city', $c_default, $city_update,
                	array(
                    	'empty'=>'请选择城市',
                		'class'=>'width114 select',  
                        'ajax' => array(
                            'type'=>'GET',
                            'url'=>Yii::app()->request->baseUrl.'/common/dynamicdistrict',
                            'update'=>'#area',
                            'data'  => 'js:"city="+jQuery(this).val()',
                            )
                         )
                    );   
                $d_default = $model->isNewRecord ? '' : $model->area;
                if(!$model->isNewRecord){
	                $district_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->city));
	                $district=CHtml::listData($district_data,"id","name");
                }          
                $district_update = $model->isNewRecord ? array() : $district;
                echo '&nbsp;'.CHtml::dropDownList('area', $d_default, $district_update,
                array(
                	'empty'=>'请选择地区',
                	'class'=>'width114 select'
                ));
            ?>
			<?php echo $form->textField($model,'address',array('class'=>'width213 input')); ?>
		</p>
		<div class="divis10"></div>
		<div class='title title-dashed-inline'>
			<span>联系人信息</span>
		</div>
		<p class="form-row">
			<?php echo $form->labelEx($model,'姓　　名:',array('class'=>'label')); ?>
			<?php echo $form->textField($model,'name',array('class'=>'width130 input name')); ?>
			<?php echo $form->error($model,'name',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'性　　别:',array('class'=>'label')); ?>
			<?php echo $form->dropDownList($model,'sex', array(
					'男' =>'男',
					'女' =>'女',
				),array('class'=>'width130 select','empty'=>'请选择')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'联系电话:',array('class'=>'label')); ?>
			<?php echo $form->textField($model,'phone',array('class'=>'width130 input phone')); ?>
			<?php echo $form->error($model,'phone',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'邮　　箱:',array('class'=>'label')); ?>
			<?php echo $form->textField($model,'email',array('class'=>'width130 input')); ?>
			<?php echo $form->error($model,'email',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'微　　信:',array('class'=>'label')); ?>
			<?php echo $form->textField($model,'weixin',array('class'=>'width130 input')); ?>
			<?php echo $form->error($model,'weixin',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<label class='label'>QQ 号 码:</label>
			<?php echo $form->textField($model,'QQ',array('class'=>'width130 input')); ?>
			<?php echo $form->error($model,'QQ',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row">
			<?php echo $form->labelEx($model,'备　　注:',array('class'=>'label','style'=>'vertical-align: top;')); ?>
			<?php echo $form->textArea($model,'memo',array('class'=>'width560 textarea'));?>
			<?php echo $form->error($model,'memo',array('class'=>'errorMessage')); ?>
		</p>
		<p class="form-row text-c">
			<?php echo $form->hiddenField($model,'id',array('class'=>'width130 input'));?>
			<?php echo CHtml::button('保存',array('class' => 'submit','style'=>"cursor:pointer"));?>
		</p>
	</div>
</div>
<?php $this->endWidget(); ?>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
    'options'=>array(
        'title'=>Yii::t('query','选择联系人'),
        'autoOpen'=>false,
        'modal'=>'true',
        'width'=>'620px',
        'height'=>'auto'
    ),
));?>
<div class="checkbox-list">
	<div style="height:300px;">
		<div id="tab-container" class='tab-container'  pre='ctable'>
	        <ul class='etabs'>
	            <li class='tab'><?php echo CHtml::link('经销商', '#tabs1'); ?></li>
	            <li class='tab'><?php echo CHtml::link('修理厂', '#tabs2'); ?></li>
	        </ul>
	        <div class='panel-container'>
		        <div id="tabs1">
		        	<?php $this->renderPartial('dealercontacts', array('dealers' => $dealers)); ?>
		        </div>
		        <div id="tabs2">
		        	<?php $this->renderPartial('servicecontacts', array('services' => $services)); ?>
		        </div>	
	        </div>
    	</div>
	</div>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<script>
$(document).ready(function(){
	var url=Yii_baseUrl;
	$("#province").change(function(){
		if($(this).val()){
			var province=$(this).val();
			$.getJSON(url+'/common/dynamicarea',{province:province},function(data){
				if(data!=''){
					$("#area").empty();
					$.each(data, function(key,val){      
						jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#area");
					}); 
				}
			});
		}else{
			$("#area").empty();
			$("<option value=''>请选择地区</option>").appendTo("#area");
		}
	});
	
	$('#tab-container').easytabs({animate:false});
	$("#choose").click(function(){
		$("#mydialog").dialog("open");
	});
	$("#opt").live('click',function(){
		var companyname = $(this).parents('tr').find('td[name=companyname]').html();
		var user_id = $(this).parents('tr').find('input[name=contact_user_id]').val();
		var phone = $(this).parents('tr').find('td[name=phone]').html();
		var email = $(this).parents('tr').find('td[name=email]').html();
		$("#DealerBusinessContact_companyname").val(companyname);
		$("#DealerBusinessContact_contact_user_id").val(user_id);
		$("#DealerBusinessContact_phone").val(phone);
		$("#DealerBusinessContact_email").val(email);
		$("#mydialog").dialog("close");
	});
	$('.submit').click(function(){
		if(window.confirm("您确定要保存吗?")){
			$('#contact-form').submit();	
		}
	});
})
</script>