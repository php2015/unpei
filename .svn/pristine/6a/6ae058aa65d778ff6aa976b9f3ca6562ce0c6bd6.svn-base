<div class='width998 content'>
	<div class='tabs' pre='tab'>
<!--		<a class='left-indent'>机构查询</a>-->
		<a href='<?php echo Yii::app()->createUrl('dealer/makequery/index')?>'>品牌厂家</a>
		<a class='active' href="<?php echo Yii::app()->createUrl('ds03/dealerquery/index')?>">授权经销商</a>
		<a href='<?php echo Yii::app()->createUrl('ds03/servicequery/index')?>'>地区修理厂</a>
	</div>
	<div>
		
		<!-- 经销商 -->
		<div class='form-list' id='tab1'>
		<?php echo CHtml::beginForm('index','post');?>
			<p class='form-row'>
				<label class="label">
					关键词：&nbsp;&nbsp;</label>
					<?php echo CHtml::textField('keyword',$search['keyword'],array('class'=>"width248 input",'fuc'=>'s'));?>
				
				<label class="label">
					地&nbsp;&nbsp;区：</label>
					<?php
                $state_data=  Area::model()->findAll("grade=:grade",array(":grade"=>1));
				$state='';
                $state=CHtml::listData($state_data,"id","name");
                $s_default = $model->isNewRecord ? '' : $model->province;
                echo CHtml::label($model,'地址：',array('class'=>'label'));
                echo CHtml::dropDownList('provice', 'province', $state,
                            array(
                            'class'=>'width118 select',
                            'empty'=>'请选择省份',   
                            'ajax' => array(
                            'type'=>'GET', //request type
                           // 'url'=>CController::createUrl('dynamiccities'), //url to call
                            'url'=> Yii::app()->request->baseUrl.'/Common/dynamiccities', //url to call
                            'update'=>'#city', //lector to update
                            'data'   => 'js:"province="+jQuery(this).val()',
                            )));

                            //empty since it will be filled by the other dropdown
                $c_default = $model->isNewRecord ? '' : $model->city;
                if(!$model->isNewRecord){
                $city_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->province));
                $city=CHtml::listData($city_data,"id","name");
                }

                $city_update = $model->isNewRecord ? array() : $city;
                echo Chtml::dropDownList('city', 'city', $city_update,
                            array(
                            'class'=>'width118 select',
                            'empty'=>'请选择城市',
                            'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=>Yii::app()->request->baseUrl.'/Common/dynamicdistrict', //url to call
                            'update'=>'#Dealer_area', //lector to update
                            'data'  => 'js:"city="+jQuery(this).val()',
                            )));   
                         ?>
				<span class="checkbox-add">如果未选择，则系统自动默认为用户所在的市</span>
			</p>
			<p class='form-row'>
				<label class="label">配件品类：</label>
			<?php
                $father_data=  MakePartsGroupFather::model()->findAll();
                $father=CHtml::listData($father_data,"code","category_father");?>
				<?php echo CHtml::dropDownList('category_father','', $father ,array(
						'class'=>'width118 select',
						'empty'=>'请选择主组',
						'ajax' => array(
	                            'type'=>'GET', //request type
	                            'url'=> Yii::app()->request->baseUrl.'/common/getchildren', //url to call
	                            'update'=>'#category_children', //selector to update
	                            'data'   => 'js:"father="+jQuery(this).val()',
	                    )
				));?>
			    <?php echo CHtml::dropDownList('category_children', '', array(),array(
			    		'class'=>'width118 select',
			    		'empty'=>'请选择子组',
			    ));?>
				
 	
				<label class="label">适用车型：</label>
					<?php
                $make_data=  TransportMake::model()->findAll();
                $make=CHtml::listData($make_data,"Code","Make");?>
			<?php echo CHtml::dropDownList('make','businessCar', $make ,array(
					'class'=>'width118 select',
					'empty'=>'请选择品牌',
					'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=> Yii::app()->request->baseUrl.'/common/getcar', //url to call
                            'update'=>'#car', //lector to update
                            'data'   => 'js:"make="+jQuery(this).val()',
                    )
            ));?>
		    <?php echo CHtml::dropDownList('car','businessCarModel', array(),array(
		    		'class'=>'width118 select',
		    		'empty'=>'请选择车系',
		    ));?>
				
			</p>
			<p class='form-row'>
				<label class="label">嘉配号：&nbsp;&nbsp;</label>
					<select name="jiapartID" class="width118 select">
					<option value='0'>选择嘉配号</option>
				 	</select>
				
				<label class="label">嘉配号：</label>
					<select class="width118 select">
						<option></option>
					</select>
				
				<input class="submit" type='submit' name='search' value='查 询'/>
			</p>
			<?php echo CHtml::endForm();?>
		</div>

		
	</div>
	<div style='height:5px'></div>
	<div class='block-shadow'></div>
</div>

<div class='width998 content content-rows'>
	<div class='postion pos-r'> <i class='icon-pos'></i>
		地区：武汉市
		<span class='font-green'>(<?php echo $count ;?>)</span>
	</div>
	<div class='divers-f0'></div>
	<?php if(!empty($models)):?>
	<div class='number-list'>
		<ul class='jgcx'>
			<!-- 授权经销商查询 -->
			
			<?php foreach ($models as $model):?>
			<li>
				<div class='number-col y-align-t display-ib'> <strong class='f14-b'>1</strong>
				</div>
				<div class='y-align-t display-ib'>
					<a class='title f14-b' target="_blank" href="<?php echo Yii::app()->createUrl('ds03/dealerquery/detail/dealerID'); ?><?php echo '/'.$dealer['userID']?>">[经销商]<?php echo $model['organName']?></a>
					<p>
						授权经销地域：<?php Area::showCity($model['domainProvince']); Area::showCity($model['domainCity'])?>
						<br>
						联系方式：<?php echo $dealer['ContactPhone']?> <?php echo $dealer['contactName']?>
						<br>
						配件品牌：<?php echo $dealer['BusinessBrand']?>
						<br>
						配件名称：
						<a class='font-green name' href="#">刹车片</a>
						<span class='mgr40 jp-code'>嘉配号：<?php echo $dealer["Phone"]?></span>
						<span class='mgr40 goods-code'>商品号：185/60RZ</span>
						<a class='mgr40 rebate font-green' href="<?php echo Yii::app()->createUrl('ds03/dealerquery/detail/dealerID'); ?><?php echo '/'.$dealer['userID']?>">优惠说明</a>
						<a class='mgr40 see-goods bg-green' href="<?php echo Yii::app()->createUrl('ds03/dealerquery/detail/dealerID'); ?><?php echo '/'.$dealer['userID']?>">主营商品</a>
					</p>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		
	</div>
	<div class="pagelist text-c">
				<?php echo $page ;?>
				<span>
					去第
					<input id='thepage' class='input' style='width:20px' type='text'/>
					页
					<span id='gopage' class='btn-tiny'>GO</span>
				</span>
	</div>
	<?php else :?>
		<center><p>搜索到   <font color=red>0</font> 条数据 <?php //echo CHtml::link('重新加载',array('dealerquery/index'))?></p></center>
	<?php endif;?>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>
</div>
<script>
$(function(){
	$("#keyword").click(function(){
		$(this).select();
	});

	// 跳转到第几页
	$("#gopage").click(function(){
		var url = "<?php echo Yii::app()->createUrl('dealer/makequery/empowerdealer'); ?>";
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
	
})
</script>
