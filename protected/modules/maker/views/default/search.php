<?php
$this->pageTitle=Yii::app()->name.' - 首页';
?>
<div class='width998 content'>
	<div class='tabs' pre='tab'>
		<a class='active' href='<?php echo Yii::app()->createUrl('maker/dealquery/search')?>'>经销商</a>
	</div>
	<!-- 经销商 -->
	<div class='homepadding '>
		<div id="tab1" class="form-list">
		<?php echo CHtml::beginForm(Yii::app()->createUrl('maker/default/search'),'get');?>
		<p class='form-row'>
			<label class="label">
				关键词：&nbsp;
				<?php if (!empty($search['keyword'])):?>
					<?php echo CHtml::textField('keyword',$search['keyword'],array('class'=>"width248 input",'flag'=>2));?>
				<?php else :?>
					<?php echo CHtml::textField('keyword',"原厂OE号，标准名称，配件品牌",array('class'=>"width248 input",'flag'=>1,'style'=>'color:rgb(153,153,153)'));?>
				<?php endif;?></label>
			<label class="label">地&nbsp;区：&nbsp;</label>
				<?php
		                $province_data=  Area::model()->findAll("grade=:grade",
                 			 array(":grade"=>1));
		                $province=CHtml::listData($province_data,"id","name");?>
				<?php echo CHtml::dropDownList('province',$search['province'], $province ,array(
						'class'=>'width118 select',
						'empty'=>'请选择省',
						'ajax' => array(
	                            'type'=>'GET', //request type
	                            'url'=> Yii::app()->request->baseUrl.'/common/DynamicCity', //url to call
	                            'update'=>'#city', //selector to update
	                            'data'   => 'js:"province="+jQuery(this).val()',
	                    )
				));?>
				<?php if($search['province']){
		                $city_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$search['province']));
		                $city=CHtml::listData($city_data,"id","name");
              		}
                	$city_update = $search['province'] ? $city : array();
                ?>
			    <?php echo CHtml::dropDownList('city', $search['city'], $city_update,array(
			    		'class'=>'width118 select',
			    		'empty'=>'请选择市',
			    ));?>
		</p>
		<p class='form-row'>
			<label class="label">适用车型：</label>
					<?php
	                $brand_data=  TransportMake::model()->findAll();
	                $brand=CHtml::listData($brand_data,"Code","Make");?>
				<?php echo CHtml::dropDownList('vehicleMake',$search['vehicleMake'], $brand ,array(
						'class'=>'width118 select',
						'empty'=>'请选择品牌',
						'ajax' => array(
	                            'type'=>'GET', //request type
	                            'url'=> Yii::app()->request->baseUrl.'/common/getcar', //url to call
	                            'update'=>'#vehicleModel', //selector to update
	                            'data'   => 'js:"make="+jQuery(this).val()',
	                    )
	            ));?>
	            <?php if($search['vehicleMake']){
	                $vehicleModel_data=TransportCar::model()->findAll("Make=:parent",array(":parent"=>$search['vehicleMake']));
	                $vehicleModel=CHtml::listData($vehicleModel_data,"Code","Car");
                }?>
                <?php $vehicleModel_update = $search['vehicleMake'] ? $vehicleModel : array();?>
			    <?php echo CHtml::dropDownList('vehicleModel', $search['vehicleModel'], $vehicleModel_update,array(
			    		'class'=>'width118 select',
			    		'empty'=>'请选择车系',
			    ));?>
				
	 			<label class="label">&nbsp;嘉配号：&nbsp;</label>
				<?php echo CHtml::textField('jiapartID',$search['jiapartID'],array('class'=>"width231 input"));?></label>
				
				<input class="submit" type='submit' name='search' value='查 询'/>
				<?php if(!empty($search)): ?>
					<?php echo CHtml::link('清 空',array('/maker/default/search'),array('class'=>"btn-green btn-green-small",'style'=>'font-size: 14px;'))?>
				<?php endif;?>
		</p>
		<p class='form-row'>
			
		</p>
		<?php echo CHtml::endForm();?>
		</div>
	</div>
	<div style='height:5px'></div>
	<div class='block-shadow'></div>
</div>
<div class='width998 content content-rows'>
	<div class='postion pos-r'> <i class='icon-pos'></i>
		共查询出<span class='font-green'>(<?php echo $count;?>)</span>条数据
	</div>
	<div class='divers-f0'></div>
	<?php if(!empty($dealers)):?>
	<div class='number-list'>
		<ul class='jgcx'>
			<?php $i=1;?>
			<?php foreach ($dealers as $dealer):?>
			<li>
				<div class='number-col y-align-t display-ib'> <strong class='f14-b'><?php echo $i;?></strong>
				</div>
				<div class='y-align-t display-ib'>
					<?php echo CHtml::link('[经销商]'.$dealer['organName'],array('/maker/default/detail/dealer/'.$dealer['userID']),array('class'=>"title f14-b",'target'=>'_blank'))?>
					<!--<a class='title f14-b' target="_blank">[经销商]<?php echo $dealer['organName']?></a>
					--><p>
						地址：<?php Area::showCity($dealer['province']).Area::showCity($dealer['city']).Area::showCity($dealer['area'])?><?php echo $dealer['address']?>
						<br>
						联系方式：<?php echo $dealer['Phone']?>
						<br>
						配件品牌：<?php echo $dealer['BusinessBrand']?>
						<br>
						<span class='jp-code'>嘉配号：<?php echo $dealer["jiapartsID"]?></span>
						<!--<a class='mgr40 rebate font-green' href="">优惠说明</a>-->
						<a class='mgr40 see-goods bg-green' href="">授权商品清单</a>
					</p>
				</div>
			</li>
			<?php $i++;?>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="pagelist text-c">
        <?php if ($count>$pagesize):?>
		<?php echo $page ;?>
		<span>
			去第
			<input id='thepage' class='input' value='1' style='width:20px' type='text'/>
			页
			<span id='gopage' class='btn-tiny'>GO</span>
		</span>
	<?php endif;?>
	</div>
	<?php else :?>
		<center><p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('default/search'))?></span></p></center>
	<?php endif;?>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#keyword").focus(function(){  
		if($(this).attr("flag")==null||$(this).attr("flag")==1){
			$(this).attr("flag",2);
			$(this).css("color","rgb(0,0,0)");
			$(this).val("");
		}
	});
	$("#keyword").blur(function(){
		if(($(this).val()=="原厂OE号，标准名称，配件品牌"||$(this).val()=="")&&$(this).attr("flag")==2){
			$(this).attr("flag",1);
			$(this).css("color","rgb(153,153,153)");
			$(this).val("原厂OE号，标准名称，配件品牌");
		}
	}); 
	var count= <?php echo $count; ?>;
	var pagesize= <?php echo $pagesize;?>;
	count = Math.ceil(count/pagesize);
	$("#thepage").keyup(function(){
	    var thisval = $(this).val();
	    if(thisval<1){
	         $(this).val('1');
	    }else if(isNaN(thisval)){
	            $(this).val('1');         
	    }else if(thisval>=count){
	        $(this).val(count);
	    }else if(!isNaN(thisval)){
	        var reg =  /^\+?[1-9][0-9]*$/;　　//正整数 
	        if(!reg.test(thisval)){
	             $(this).val(1);
	        }
	    }
	});
	// 跳转到第几页
	$("#gopage").click(function(){
		var url = "<?php echo Yii::app()->createUrl('maker/default/search'); ?>";
		var page = $("#thepage").val();
		if(isNaN(page))
		{
			alert('请输入阿拉伯数字 !');
			$("#thepage").val('');
		}else{
			location.href=url+"?page="+page;
		}
	}).css('cursor','pointer');
})
</script>