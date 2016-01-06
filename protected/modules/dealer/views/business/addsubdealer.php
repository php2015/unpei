<style>
<!--
.errorMessage {float:left; margin-left:360px; color:red; margin-top:-30px;}
-->
</style>
<div class='content'>
	<?php include 'tabs_active.php';?>
	<div class='tab-content'>
		<div id='tab1'>
			<div class='title title-dashed'>机构信息</div>
			<div class='form-list'>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'subdealer-form',
				'enableAjaxValidation'=>false,
			)); ?>
				<p class="form-row">
					<label class='label'><?php echo $form->labelEx($model,'organName'); ?></label>
					
					<?php echo $form->textField($model,'organName',array('class'=>'width213 input')); ?>
					<?php echo $form->error($model,'organName'); ?>
				</p>
				<p class="form-row">
					<label class='label'><?php echo $form->labelEx($model,'grade'); ?></label>
					<?php echo $form->dropDownList($model,'grade', array(
			    		'0' => '选择级别',
						'一级' => '一级',
						'二级' => '二级',
						'三级' => '三级',
					),array('class'=>'width118 select')); ?>
					<?php echo $form->error($model,'grade'); ?>
				</p>
				<p class="form-row">
					<label class='label'><?php echo $form->labelEx($model,'allowCate'); ?></label>
					<?php echo $form->dropDownList($model,'allowCate', array(
			    		'0' => '选择授权品类',
						'刹车片1' => '刹车片1',
						'刹车片2' => '刹车片2',
						'刹车片3' => '刹车片3',
					),array('class'=>'width118 select')); ?>
					<?php echo $form->error($model,'allowCate'); ?>
				</p>
				<p class="form-row">
					<label class='label'><?php echo $form->labelEx($model,'allowBrand'); ?></label>
					<?php echo $form->dropDownList($model,'allowBrand', array(
			    		'0' => '选择授权品牌',
						'3M' => '3M',
						'4M' => '4M',
						'5M' => '5M',
					),array('class'=>'width118 select')); ?>
					<?php echo $form->error($model,'allowBrand'); ?>
				</p>
				<p class="form-row">  <?php // 授权的城市?>
					<?php
                $state_data=  Area::model()->findAll("grade=:grade",array(":grade"=>1));
               
                $state=CHtml::listData($state_data,"id","name");
                 //var_dump($state);
                $s_default = $model->isNewRecord ? '' : $model->allowProvince;
                echo $form->labelEx($model,'授权销售区域：',array('class'=>'label'));
                echo $form->dropDownList($model, 'allowProvince', $state,
                            array(
                            'class'=>'width144 select',
                            'empty'=>'请选择省份',   
                            'ajax' => array(
                            'type'=>'GET', //request type
                           // 'url'=>CController::createUrl('dynamiccities'), //url to call
                            'url'=> Yii::app()->request->baseUrl.'/Common/dynamiccities', //url to call
                            'update'=>'#DealerSubdealer_allowCity', //lector to update DealerSubdeale_allowCity
                            'data'   => 'js:"province="+jQuery(this).val()',
                            )));

                            //empty since it will be filled by the other dropdown
                $c_default = $model->isNewRecord ? '' : $model->allowCity;
                if(!$model->isNewRecord){
                $city_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->allowProvince));
                $city=CHtml::listData($city_data,"id","name");
                }
                $city_update = $model->isNewRecord ? array() : $city;
                echo $form->dropDownList($model, 'allowCity', $city_update,
                            array(
                            'class'=>'width144 select',
                            'empty'=>'请选择城市',
                            'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=>Yii::app()->request->baseUrl.'/Common/dynamicdistrict', //url to call
                            'update'=>'#DealerSubdealer_area', //lector to update
                            'data'  => 'js:"city="+jQuery(this).val()',
                            )));   
                         ?>
				</p>
				<p class="form-row">
					<label class='label'><?php echo $form->labelEx($model,'person'); ?></label>
					<?php echo $form->textField($model,'person',array('class'=>'width213 input')); ?>
					<?php echo $form->error($model,'person'); ?>
				</p>
				<p class="form-row">
					<label class='label'><?php echo $form->labelEx($model,'phone'); ?></label>
					<?php echo $form->textField($model,'phone',array('class'=>'width213 input')); ?>
					<?php echo $form->error($model,'phone'); ?>
				</p>
				<p class="form-row">
					<?php
                $state_data=  Area::model()->findAll("grade=:grade",array(":grade"=>1));
                $state=CHtml::listData($state_data,"id","name");
                $s_default = $model->isNewRecord ? '' : $model->province;
                echo $form->labelEx($model,'地址：',array('class'=>'label'));
                echo $form->dropDownList($model, 'province', $state,
                            array(
                            'class'=>'width144 select',
                            'empty'=>'请选择省份',   
                            'ajax' => array(
                            'type'=>'GET', //request type
                           // 'url'=>CController::createUrl('dynamiccities'), //url to call
                            'url'=> Yii::app()->request->baseUrl.'/Common/dynamiccities', //url to call
                            'update'=>'#DealerSubdealer_city', //lector to update
                            'data'   => 'js:"province="+jQuery(this).val()',
                            )));

                            //empty since it will be filled by the other dropdown
                $c_default = $model->isNewRecord ? '' : $model->city;
                if(!$model->isNewRecord){
                $city_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->province));
                $city=CHtml::listData($city_data,"id","name");
                }

                $city_update = $model->isNewRecord ? array() : $city;
                echo $form->dropDownList($model, 'city', $city_update,
                            array(
                            'class'=>'width144 select',
                            'empty'=>'请选择城市',
                            'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=>Yii::app()->request->baseUrl.'/Common/dynamicdistrict', //url to call
                            'update'=>'#DealerSubdealer_area', //lector to update
                            'data'  => 'js:"city="+jQuery(this).val()',
                            )));   
                $d_default = $model->isNewRecord ? '' : $model->district;
                if(!$model->isNewRecord){
                $district_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->city));
                $district=CHtml::listData($district_data,"id","name");
                }          
                $district_update = $model->isNewRecord ? array() : $district;
                 echo $form->dropDownList($model, 'area', $district_update,
                         array(
                            'class'=>'width144 select',
                            'empty'=>'请选择地区', 
                         )
                         );
                         ?>
				</p>
				<p class="form-row">
				   <label class='label'></label>  
					<?php echo $form->textField($model,'address',array('class'=>'width213 input')); ?>
					<?php echo $form->error($model,'address'); ?>
				</p>
				<p class="form-row">
					<label class='label'></label>
					<input class='submit' type='submit' value='保存'/>
				</p>
				<?php $this->endWidget(); ?>
			</div><!-- /form  -->
		</div>

	</div>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>

</div>
<script type="text/javascript">
<!--
$(function(){
	// 通过允许的省获取市
	var url="<?php echo Yii::app()->request->baseUrl;?>";
	$("#Subdealer_allowProvince").change(function(){
		var provinceid=$(this).val();
		$.getJSON(url+'/ds04/subdealer/getcity',{provinceid:provinceid},function(city){
			$("#Subdealer_allowCity").empty();
			$.tmpl("<option value='0'>请选择（市/县）</option>").appendTo("#Subdealer_allowCity");
			$.tmpl("<option value='${cityID}'>${city}</option>",city).appendTo("#Subdealer_allowCity");
		});
	})

	// 获取地址。省市区
	$('#Subdealer_province').change(function(){
		var provinceid=$(this).val();
		$.getJSON(url+'/ds04/subdealer/getcity',{provinceid:provinceid},function(city){
			$("#Subdealer_city").empty();
			$("#Subdealer_area").empty();
			$.tmpl("<option value='0'>请选择（市/县）</option>").appendTo("#Subdealer_city");
			$.tmpl("<option value='0'>请选择（区）</option>").appendTo("#Subdealer_area");
			$.tmpl("<option value='${cityID}'>${city}</option>",city).appendTo("#Subdealer_city");
		});
	});
	$('#Subdealer_city').change(function(){
		var cityid=$(this).val();
		$.getJSON(url+'/ds04/subdealer/getarea',{cityid:cityid},function(area){
			$("#Subdealer_area").empty();
			$.tmpl("<option value='0'>请选择（区）</option>").appendTo("#Subdealer_area");
			$.tmpl("<option value='${areaID}'>${area}</option>",area).appendTo("#Subdealer_area");
			//$.tmpl("<option value='${areaID}'>${area}</option>",area).appendTo("#Subdealer_area");
		});
	});
	
})
-->
</script>
