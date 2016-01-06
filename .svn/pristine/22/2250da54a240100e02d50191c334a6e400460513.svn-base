<div class='width998 content_row'>
	<div class='tabs' pre='tab'>
		<a class='left-indent'>机构查询</a>
		<a href='<?php echo Yii::app()->createUrl('ds03/dealerquery/index');?>' class='active'>授权经销商</a>
		<a href='<?php echo Yii::app()->createUrl('ds03/makequery/index');?>'>品牌厂家</a>
		<a href='<?php echo Yii::app()->createUrl('ds03/servicequery/index');?>'>地区修理厂</a>
	</div>
	<div class=' jgcx'>
		<div class='page-title'>
			<div class='jxs-title'><?php echo $model['organName']?></div>
		</div>
		<div class='page-tel'> <i class='icon-tel'></i>
			<span class='number' style="width:150px;"><?php echo $model['ContactPhone']?></span>
		</div>
	</div>

	<div class='auto_height jgcx info content-rows15'>
		<div class='width683 float-l bg-white'>
			<div class="title title-dashed">
				基础信息 <i class='icon-arr2r-white display-ib'></i>
			</div>
			<div class='info-list'>
				<span>机构名称：</span>
				<?php echo $model['organName']?>
			<br>
			<span>嘉配ID：</span>
			<?php echo $model['jiapartsId']?>
			<br>
			<span>企业类型：</span>
			<?php echo $model['organ']?>
			<br>
			<span>成立年份：</span>
			<?php echo $model['FoudingDate']?>年
			<br>
			<span>店铺面积：</span>
			<?php echo $model['StoreSize']?>m <sup>2</sup>
			<br>
			<span>年销售额：</span>
			<?php echo $model['SaleMoney']?> 元
			<br>
			<span>经营地域：</span>
			<?php echo $txtprovince['BusinessScope']?>
			<br>
			<span>机构介绍：</span>
			<?php echo $model['organIntroduction']?>
		</div>
	</div>
	<div class='width298 float-r bg-white'>
		<div class="title title-dashed">
			联系方式
			<i class='icon-arr2r-white display-ib'></i>
		</div>
		<div class='info-list'>
			<span>*手机：</span>
			<?php echo $model['Phone']?>
			<br>
			<span>固定电话：</span>
			<?php echo $model['ContactPhone']?>
			<br>
			<span>传真：</span>
			<?php echo $model['Fax']?>
			<br>
			<span>*QQ号：</span>
			<?php echo $model['QQ']?>
			<br>
			<span>*邮箱：</span>
			<?php echo $model['Email']?>
			<br>
			<span>地址</span>
			<?php echo $txtprovince['province'].$txtprovince['city'].$txtprovince['area'].$model['address']?>
			</div>
			<div class='block-shadow'></div>
		</div>
	</div>


	<div class=' jgcx photos content-rows15 bg-white'>
		<div class='title'>机构照片</div>
		<div class='pos-r'>
			<a href='javascript:;' class="arr-l scroll-left"></a>
			<div class="photos-list">
				<ul>
				<?php foreach ($organphotos as $organphoto):?>
				<li><?php $src = Yii::app()->theme->baseUrl."/organ/uploads/".$organphoto['photoName']; ?>
					<a href="#"><img src="<?php echo $src?>"></a>
					<div class='text-c mt1em'><a href="#">说明文字</a></div>
				</li>
			<?php endforeach;?>
				</ul>
			</div>
			<a href='javascript:;' class="arr-r scroll-right"></a>
		</div>
	</div>
</div>