<div class='width998 content_row'>
	<div class=' jgcx'>
		<div class='page-title'>
			<div class='xlc-title'><?php echo $model['serviceName']; ?></div>
		</div>
		<div class='page-tel'> <i class='icon-tel'></i>
			<span class='number'></span>
		</div>
	</div>
	<div class='auto_height jgcx info content-rows15'>
		<div class='width673 float-l bg-white'>
			<div class="title title-dashed">
				基础信息 <i class='icon-arr2r-white display-ib'></i>
			</div>
			<div class='info-list'>
				<span>机构名称：</span>
				<?php echo $model['serviceName'];?>
				<br>
				<span>嘉配ID：</span>
				<?php echo $model['serviceCellPhone'];?>
				<br>
				<span>企业类型：</span>
				<?php echo Companytype::showIdentity();?>
				<br>
				<span>成立年份：</span>
				<?php echo $model['serviceFounded'];?>年
				&nbsp;&nbsp;&nbsp;&nbsp;
				<span>　工位数：</span>
				<?php echo $model['servicePositionCount'];?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span>技师人数：</span>
				<?php echo $model['serviceTechnicianCount'];?>　
				<br> 
				<span>停车位数：</span>
				<?php echo $model['serviceParkingDigits'];?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span>店铺面积：</span>
				<?php echo $model['serviceStoreSize'];?>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<span>预约模式：</span>
				<?php if ($model['serviceReservationMode'] == "1"): echo "需要担保"; else: echo "不需要担保"; endif;?>
				<br>
				<span>营业时间：</span>
				<?php $serviceOpenTime = explode(',', $model->serviceOpenTime);	//营业时间 ?>
				<?php echo $serviceOpenTime[0]."至".$serviceOpenTime[1]."（".$serviceOpenTime[2]."-".$serviceOpenTime[3]."）";?>
				<br>
				<span>经营地域：</span>
				<?php echo Area::showCity($model['serviceRegionProvince']).Area::showCity($model['serviceRegionCity']).Area::showCity($model['serviceRegionArea']);?>
				<br>
				<span>机构介绍：</span>
				<?php echo $model['serviceIntro'];?>
			</div>
		</div>
		<div class='width298 float-r bg-white'>
			<div class="title title-dashed">
				联系方式
				<i class='icon-arr2r-white display-ib'></i>
			</div>
			<div class='info-list'>
				<span>联系人：</span>
				<?php echo $model['serviceContact']; ?>
				<br> 	
				<span>*手机：</span>
				<?php echo $model['serviceCellPhone']; ?>
				<br>
				<span>固定电话：</span>
				<?php echo $model['serviceTelePhone'];?>
				<br>
				<span>*QQ号：</span>
				<?php echo $model['serviceQQ']; ?>
				<br>
				<span>*邮箱：</span>
				<?php echo $model['serviceEmail']; ?>
				<br>
				<span>地址：</span>
				<?php echo Area::showCity($model['serviceProvince']).Area::showCity($model['serviceCity']).Area::showCity($model['serviceArea']).$model['serviceAddress'];?>
			</div>
		</div>
	</div>
	<div class=' jgcx photos content-rows15 bg-white'>
		<div class='title'>机构照片</div>
		<div class='pos-r'>
			<a href='javascript:;' class="arr-l scroll-left"></a>
			<div class="photos-list">
				<ul>
					<?php $url = F::uploadUrl().$photo['photoName'];?>				  					   
					<li>
						<img src="<?php echo $url;?>" alt="<?php echo $photo['photoName'];?>">
						<div class='text-c mt1em'><a href="#">说明文字</a></div>
					</li>
				</ul>
			</div>
			<a href='javascript:;' class="arr-r scroll-right"></a>
		</div>
	</div>
</div>