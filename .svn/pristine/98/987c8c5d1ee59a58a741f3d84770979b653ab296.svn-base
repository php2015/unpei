<div class='width998 content_row'>
	<div class='tabs' pre='tab'>
		<a class='left-indent'>机构查询</a>
		<a href='<?php echo Yii::app()->createUrl('ds03/dealerquery/index');?>'>授权经销商</a>
		<a href='<?php echo Yii::app()->createUrl('ds03/makequery/index');?>' class='active'>品牌厂家</a>
		<a href='<?php echo Yii::app()->createUrl('ds03/servicequery/index');?>'>地区修理厂</a>
	</div>
	<div class='jgcx'>
		<div class='page-title'>
			<div class='ppcj-title'><?php echo $model['name'];?></div>
		</div>
		<div class='page-tel'> <i class='icon-tel'></i>
			<span class='number'></span>
		</div>
	</div>
	<div class='auto_height jgcx info content-rows15'>
		<div class='width683 float-l bg-white'>
			<div class="title title-dashed">
				基础信息 <i class='icon-arr2r-white display-ib'></i>
			</div>
			<div class='info-list'>
				<span>机构名称：</span>
				<?php echo $model['name'];?>
				<br>
				<span>嘉 配 ID：</span>
				<?php echo $model['jiapartsID'];?>
				<br>
				<span>企业类型：</span>
				<?php echo $model['organ'];?>
				<br>
				<span>成立年份：</span>
				<?php if ($model['establish_year']):?>
					<?php echo $model['establish_year'].'年';?>
				<?php endif;?>
				<br>
				<span>年销售额：</span>
				<?php echo $model['year_sales_volume'];?>
				<br>
				<span>公司规模：</span>
				<?php echo $model['company_scale'];?>
				<br>
				<span>经营地域：</span>
				<?php echo $txtprovince['operate_region'];?>
				<br>
				<span>机构简介：</span>
				<?php echo $model['synopsis'];?>
			</div>
		</div>
		<div class='width298 float-r bg-white'>
			<div class="title title-dashed">
				联系方式
				<i class='icon-arr2r-white display-ib'></i>
			</div>
			<div class='info-list'>
				<span>手　　机：</span>
				<?php echo $model['mobile_phone'];?>
				<br>
				<span>固定电话：</span>
				<?php echo $model['telephone'];?>
				<br>
				<span>传　　真：</span>
				<?php echo $model['fax'];?>
				<br>
				<span>QQ 号 码：</span>
				<?php echo $model['qq'];?>
				<br>
				<span>邮　　箱：</span>
				<?php echo $model['email'];?>
				<br>
				<span>官网网址：</span>
				<?php echo $model['url'];?>
				<br>
				<span>网店网址：</span>
				<?php foreach ($onlinestores as $onlinestore):?>
					<br/>
					<?php echo $onlinestore['Name'].'&nbsp;'.$onlinestore['onlineStoreUrl']?>
				<?php endforeach;?>
				<br/>
				<span>地　　址：</span>
					<?php echo $txtprovince['province'].$txtprovince['city'].$txtprovince['area'];?>
			</div>
		</div>
	</div>
	
	<div class='jgcx photos content-rows15 bg-white'>
		<div class='title'>机构照片</div>
		<div class='pos-r'>
			<a href='javascript:;' class="arr-l scroll-left"></a>
			<div class="photos-list">
				<ul>
					<?php foreach ($picture as $key => $pic):?>
						<?php if ($pic['picture_file']):?>
							<?php $picurl = Yii::app()->theme->baseUrl.'/organ/makepicture/'.$pic['picture_file'];?>
							<li>
								<a href="#"><img src="<?php echo $picurl;?>"></a>
								<div class='text-c mt1em'><a href="#">说明文字</a></div>
							</li>
						<?php endif;?>
			    	<?php endforeach;?>
				</ul>
			</div>
			<a href='javascript:;' class="arr-r scroll-right"></a>
		</div>
	</div>
</div>