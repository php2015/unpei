<div class='width998 content'>
	<?php include 'tabs_active.php';?>
	<?php
		//获取汽车品牌信息
   		//$brand_data=TransportMake::model()->findAll();
        //$brand=CHtml::listData($brand_data,"Code","Make");
        $brand_data=GoodsBrand::getBrand();
        $brand=CHtml::listData($brand_data,"id","name");
    ?>
	<div class="form-list">
		<form action="<?php echo Yii::app()->createUrl("dealer/makequery/servicersearch"); ?>" method="get" name="queryForm" >
			<p class='form-row'>
				<label class="label">关键词：&nbsp;&nbsp;</label>
				<input class="width248 input" type="text" name="keyWord" value="<?php if ($search['keyword']): echo $search['keyword']; else: echo "机构名称或关键词"; endif; ?>" onfocus="if (value =='机构名称或关键词'){this.style.color='#000'; value =''}" onblur="if (value ==''){this.style.color='#999'; value='机构名称或关键词'}">							
			</p>
			<p class='form-row'>
				<label class="label">地&nbsp;&nbsp;区：&nbsp;&nbsp;</label>
				<?php
                $state_data=Area::model()->findAll("grade=:grade",array(":grade"=>1));	
                $state=CHtml::listData($state_data,"id","name");	
                $s_default = $model->isNewRecord ? '' : $search['province'];
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
                $c_default = $model->isNewRecord ? '' : $search['city'];
                if(!$model->isNewRecord){
	                $city_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$search['province']));
	                $city=CHtml::listData($city_data,"id","name");
                }
                $city_update = $model->isNewRecord ? array() : $city;
                echo '&nbsp;&nbsp;'.CHtml::dropDownList('city', $c_default, $city_update,
                	array(
                    	'empty'=>'请选择城市',
                		'class'=>'width114 select',  
                        'ajax' => array(
                            'type'=>'GET', 
                            'url'=>Yii::app()->request->baseUrl.'/common/dynamicdistrict', //url to call
                            'update'=>'#area', 
                            'data'  => 'js:"city="+jQuery(this).val()',
                            )
                         )
                    );   
                $d_default = $model->isNewRecord ? '' : $search['area'];
                if(!$model->isNewRecord){
	                $district_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$search['city']));
	                $district=CHtml::listData($district_data,"id","name");
                }          
                $district_update = $model->isNewRecord ? array() : $district;
                echo '&nbsp;&nbsp;'.CHtml::dropDownList('area', $d_default, $district_update,
                array(
                	'empty'=>'请选择地区',
                	'class'=>'width114 select'
                ));
            	?>
				<!--<span class="checkbox-add">如果未选择，则系统自动默认为用户所在的市</span>-->
			</p>
			<p class='form-row'>
				<label class="label">服务类别：</label>
				<select class="width118 select" id="category" name="category">
					<option value="">请选择</option> 
					<option value="深度清洁" <?php if ($search['category'] == "深度清洁"): ?> selected="selected" <?php endif;?>>深度清洁</option>
					<option value="车辆美容" <?php if ($search['category'] == "车辆美容"): ?> selected="selected" <?php endif;?>>车辆美容</option> 
					<option value="日常保养" <?php if ($search['category'] == "日常保养"): ?> selected="selected" <?php endif;?>>日常保养</option>
					<option value="检查诊断" <?php if ($search['category'] == "检查诊断"): ?> selected="selected" <?php endif;?>>检查诊断</option> 
					<option value="易损件更换" <?php if ($search['category'] == "易损件更换"): ?> selected="selected" <?php endif;?>>易损件更换</option>
					<option value="专业修理" <?php if ($search['category'] == "专业修理"): ?> selected="selected" <?php endif;?>>专业修理</option> 
					<option value="车险服务" <?php if ($search['category'] == "车险服务"): ?> selected="selected" <?php endif;?>>车险服务</option>
				</select>
				<select class="width168 select" id="deepCleaning" name="deep" <?php if ($search['category'] != "深度清洁"): ?> style="display: none;" <?php endif;?>>
					<option value="">请选择级别</option> 
					<option value="内外清洁,精细洗车" <?php if ($search['deep'] == "内外清洁,精细洗车"): ?> selected="selected" <?php endif;?>>内外清洁,精细洗车</option>
					<option value="粘连物去除,杀菌除味" <?php if ($search['deep'] == "粘连物去除,杀菌除味"): ?> selected="selected" <?php endif;?>>粘连物去除,杀菌除味</option> 
					<option value="机械及电路清洁" <?php if ($search['deep'] == "机械及电路清洁"): ?> selected="selected" <?php endif;?>>机械及电路清洁</option>
				</select>
				<select class="width118 select" id="vehiclesBeauty" name="vehicle" <?php if ($search['category'] != "车辆美容"): ?> style="display: none;" <?php endif;?>>
					<option value="">请选择级别</option> 
					<option value="抛光打蜡" <?php if ($search['vehicle'] == "抛光打蜡"): ?> selected="selected" <?php endif;?>>抛光打蜡</option>
					<option value="封釉镀膜" <?php if ($search['vehicle'] == "封釉镀膜"): ?> selected="selected" <?php endif;?>>封釉镀膜</option> 
					<option value="局部修复" <?php if ($search['vehicle'] == "局部修复"): ?> selected="selected" <?php endif;?>>局部修复</option>
					<option value="全车烤漆" <?php if ($search['vehicle'] == "全车烤漆"): ?> selected="selected" <?php endif;?>>全车烤漆</option>
				</select>
				<span id="routineMaintenance" <?php if ($search['category'] != "日常保养"): ?> style="display: none;" <?php endif;?>>
					<span id="rcby" class='checkbox-add tags routine <?php if ($search['maintenance'] == "全车系"):?> bg-green <?php endif;?>'>全车系</span>
					<span class="checkbox-add">|</span>
					<?php echo CHtml::dropDownList('maintenance-make',$search['maintenance-make'], $brand ,array(
								'class'=>'width118 select',
								'empty'=>'请选择品牌',
								'ajax' => array(
			                    	'type'=>'GET',
			                        //'url'=> Yii::app()->request->baseUrl.'/common/getcar', 
			                        'url'=> Yii::app()->request->baseUrl.'/common/getcarbyid', //url to call
			                    	'update'=>'#maintenance-car',
			                        'data'   => 'js:"make="+jQuery(this).val()',
			                    )
			            ));?>
			        <?php 
		                $maintenance_data=TransportCar::model()->findAll("Make=:Make",array(":Make"=>$search['maintenance-make']));
		                $maintenance=CHtml::listData($maintenance_data,"Code","Car");
                	?>
				    <?php echo CHtml::dropDownList('maintenance-car', $search['maintenance-car'], $maintenance,array(
				    		'class'=>'width118 select',
				    		'empty'=>'请选择车系',
				    ));?>　
				</span>
				<span id="diagnosis" <?php if ($search['category'] != "检查诊断"): ?> style="display: none;" <?php endif;?>>
					<span id="jczd" class='checkbox-add tags diagnos <?php if ($search['diagnosis'] == "全车系"):?> bg-green <?php endif;?>'>全车系</span>
					<span class="checkbox-add">|</span>
					<?php echo CHtml::dropDownList('diagnosis-make',$search['diagnosis-make'], $brand ,array(
								'class'=>'width118 select',
								'empty'=>'请选择品牌',
								'ajax' => array(
			                    	'type'=>'GET',
			                        //'url'=> Yii::app()->request->baseUrl.'/common/getcar',
			                        'url'=> Yii::app()->request->baseUrl.'/common/getcarbyid', //url to call
			                    	'update'=>'#diagnosis-car',
			                        'data'   => 'js:"make="+jQuery(this).val()',
			                    )
			            ));?>
			        <?php 
		                $diagnosis_data=TransportCar::model()->findAll("Make=:Make",array(":Make"=>$search['diagnosis-make']));
		                $diagnosis=CHtml::listData($diagnosis_data,"Code","Car");
                	?> 
				    <?php echo CHtml::dropDownList('diagnosis-car', $search['diagnosis-car'], $diagnosis,array(
				    		'class'=>'width118 select',
				    		'empty'=>'请选择车系',
				    ));?>
				</span>
				<select class="width118 select" id="wearingParts" name="parts" <?php if ($search['category'] != "易损件更换"): ?> style="display: none;" <?php endif;?>>
					<option value="">请选择易损件类别</option>
					<?php foreach ($parts as $part):?>
					<?php if ($search['parts'] == $part->partsCategory):?>
					<option value="<?php echo $part->partsCategory;?>" selected="selected"><?php echo $part->partsCategory;?></option>
					<?php else:?>
					<option value="<?php echo $part->partsCategory;?>"><?php echo $part->partsCategory;?></option>
					<?php endif;?>
					<?php endforeach;?>
				</select>
				<span id="professionalRepair" <?php if ($search['category'] != "专业修理"): ?> style="display: none;" <?php endif;?>>
					<span id="zyxl" class='checkbox-add tags repair <?php if ($search['repair'] == "全车系"):?> bg-green <?php endif;?>'>全车系</span>
					<span class="checkbox-add">|</span>
					<?php echo CHtml::dropDownList('repair-make',$search['repair-make'], $brand ,array(
								'class'=>'width118 select',
								'empty'=>'请选择品牌',
								'ajax' => array(
			                    	'type'=>'GET', 
			                        //'url'=> Yii::app()->request->baseUrl.'/common/getcar', 
			                        'url'=> Yii::app()->request->baseUrl.'/common/getcarbyid', //url to call
			                    	'update'=>'#repair-car',
			                        'data'   => 'js:"make="+jQuery(this).val()',
			                    )
			            ));?>
			        <?php 
		                $repair_data=TransportCar::model()->findAll("Make=:Make",array(":Make"=>$search['repair-make']));
		                $repair=CHtml::listData($repair_data,"Code","Car");
                	?>    
				    <?php echo CHtml::dropDownList('repair-car', $search['repair-car'], $repair,array(
				    		'class'=>'width118 select',
				    		'empty'=>'请选择车系',
				    ));?>	
				</span>
				<span id="insuranceService" <?php if ($search['category'] != "车险服务"): ?> style="display: none;" <?php endif;?>>
					<label class="label">代理理赔/购险险企:</label>
					<?php 
					foreach ($insur as $key => $ins):?>					
					<input id="<?php echo $key;?>" type="checkbox" name="insurer[]" id="<?php echo $ins['id'];?>" value="<?php echo $ins['insurName'];?>" 
					<?php if ($search['insurer']): foreach ($search['insurer'] as $value): if ($value == $ins['insurName']):?> checked <?php endif; endforeach; endif;?>>					
					<label for='<?php echo $key;?>'><span class='checkbox-add'><?php echo $ins['insurName'];?></span></label>
					<?php endforeach;?>
				</span>
			</p>
			<p class='form-row'>
				<label class="width60 label"></label>
				<input class="submit" type="submit" name="submit" value="查  询">
				<?php //if ($search): ?>
				<a href="<?php //echo Yii::app()->createUrl("dealer/makequery/servicersearch");?>">
					<!--<input class="submit" type='button' name="cancel" value='取消查询'>
				--></a>
				<?php //endif; ?>
			</p>
		</form>	
	</div>
	<div style='height:5px'></div>
	<div class='block-shadow'></div>
</div>

<div class='width998 content content-rows'>
	<div class='postion pos-r'> <i class='icon-pos'></i>
		当前数据总量：<!-- 地区：武汉市 -->
		<span class='font-green' id='count'>(<?php echo $count;?>)</span>
	</div>
	<div class='divers-f0'></div>
	<?php if(!empty($service)):?>
	<div class='number-list'>
	<div class="checkbox-list">
				<div class='ctable-content'>
					<div id="ctable1">
						<table cellspacing=0 cellpadding=0 id="listSort">
							<thead>
								<tr>
									<td width=20>#</td>
									<td width=200>修理厂名称</td>
									<td width=120>联系方式</td>
									<td width=50>工位数</td>
									<td width=50>停车数</td>
									<td width=50>技师数</td>
									<td width=160>合作险企</td>
									<td width=230>地址</td>
								</tr>
							</thead>
							<tbody>
							<?php $i = 0; $j = 1; foreach ($service as $ser): ?>
								<tr>
									<td ><?php echo $j?></td>
									<td >[<?php echo $type[$i]['serviceType'];?>]&nbsp;<?php echo CHtml::link($ser['serviceName'],array('/dealer/makequery/ServiceDetail/id/'.$ser['userId']),array('target'=>'_blank')); ?></td>
									<td ><?php echo $ser['serviceCellPhone']; ?>&nbsp;&nbsp;<?php echo $ser['serviceContact']; ?></td>
									<td ><?php echo $ser['servicePositionCount']; ?></td>
									<td ><?php echo $ser['serviceParkingDigits']; ?></td>
									<td ><?php echo $ser['serviceTechnicianCount']; ?></td>
									<td ><?php echo F::msubstr($insurance[$i]['insuranceService']); ?></td>
									<td ><?php echo F::msubstr(Area::getCity($ser['serviceProvince']).Area::getCity($ser['serviceCity']).Area::getCity($ser['serviceArea']).$ser['serviceAddress'],0,0);?></td>
								</tr>
								<?php $i++; $j++; endforeach;?>
							</tbody>
						</table>
					</div>
					<div id="ctable3">3</div>
					<div id="ctable4"></div>
				</div>
			</div>		
		</div>
	<?php if ($count> 10):?>
	<div class="pagelist text-c">
		<?php echo $page ;?>
		<span>
			去第
			<input id='thepage' class='input' value='<?php echo $_GET['page']?>' style='width:20px' type='text'/>
			页
			<span id='gopage' class='btn-tiny'>GO</span>
		</span>
	</div>
	<?php endif;?>
	
	<?php else :?>
		<center><p>搜索到   <font color=red>0</font> 条数据 <?php //echo CHtml::link('重新加载',array('/dealer/makequery/servicersearch'))?></p></center>
	<?php endif;?>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>
</div>
<script type='text/javascript'>
$(function(){
	var count= eval($("#count").text());
	count = Math.ceil(count/5);
	$("#thepage").keyup(function(){
		var thisval = $(this).val();
		if(thisval<1)
			$(this).val('1');
		else if(isNaN(thisval))
			$(this).val('1');
		else if(thisval>=count)
			$(this).val(count);
		});
	
	// 跳转到第几页
	$("#gopage").click(function(){
		var url = "<?php echo Yii::app()->createUrl('dealer/makequery/servicersearch'); ?>";
		var page = $("#thepage").val();
		//var page = parseInt(page);
		if(isNaN(page))
		{
			alert('请输入阿拉伯数字 !');
			$("#thepage").val('');
		}else{
			location.href=url+"?page="+page;
		}
	}).css('cursor','pointer');
});
</script>
<script type='text/javascript'>
$(document).ready(function(){
	//日常保养
	$(".routine").click(function(){
		var routine = $(this).text();
		$("<input type='hidden' name='maintenance' value="+routine+">").appendTo("#routineMaintenance");
	});
	//检查诊断
	$(".diagnos").click(function(){
		var diagnos = $(this).text();
		$("<input type='hidden' name=diagnosis' value="+diagnos+">").appendTo("#diagnosis");
	});
	//专业修理
	$(".repair").click(function(){
		var repair = $(this).text();
		$("<input type='hidden' name='repair' value="+repair+">").appendTo("#professionalRepair");
	});
	//选择主营类别下级
	$("#category").change(function(){
		var category = $("#category").val();
		switch(category)
		{
			case "深度清洁" : $("#deepCleaning").show();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
			case "车辆美容" : $("#deepCleaning").hide();$("#vehiclesBeauty").show();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
			case "日常保养" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").show();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
			case "检查诊断" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").show();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
			case "易损件更换": $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").show();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
			case "专业修理" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").show();$("#insuranceService").hide(); break;
			case "车险服务" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").show(); break;
		}
	});
	$("#province").change(function(){
		if($(this).val()){
			var province=$(this).val();
			$.getJSON(Yii_baseUrl+'/common/dynamicarea',{province:province},function(data){
				if(data!=''){
					$("#area").empty();
					$.each(data, function(key,val){      
						$("<option value='"+key+"'>"+val+"</option>").appendTo("#area");
					}); 
				}
			});
		}else{
			$("#area").empty();
			$("<option value=''>请选择地区</option>").appendTo("#area");
		}
	});
})
</script>