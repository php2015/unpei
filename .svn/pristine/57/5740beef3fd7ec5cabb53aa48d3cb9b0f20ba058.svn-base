<?php
$this->pageTitle = Yii::app()->name . ' - ' . "查看商品清单";
?>
<div class='width998 content-row auto_height'>
	<div class='tabs' pre='tab'>
		<a style='margin-left:-30px;'>&nbsp;</a>
		<a class='active' href='<?php echo Yii::app()->createUrl('/dealer/makequery/empgoods/dealer/'.$_GET['dealer'])?>'>商品清单</a>
	</div>
	<div class='tab-content auto_height'>
    	<!-- search菜单{ -->
    	<?php $this->renderPartial('searchgoods', array('brand' => $brand,'category'=>$category,'car'=>$car,'search'=>$search)); ?>
    	<!-- } -->
	</div>
		<div id='tab1'>
			<div class="checkbox-list">
				<div class='ctable-content'>
					<div id="ctable1">
						<?php if(!empty($models)):?>
						<table cellspacing=0 cellpadding=0>
							<thead>
								<tr>
									<td width=10>#</td>
									<td width=75>商品编号</td>
									<td width=110>商品名称</td>
									<td width=64>商品品牌</td>
									<td width=74>配件品类</td>
									<td width=74>商品类别</td>
									<td width=64>配件档次</td>
									<td width=64>价格</td>
									<td width=54>OE号</td>
									<td width=69>适用车系</td>
								</tr>
							</thead>
							<tbody>
							<?php $i=1;?>
							<?php foreach ($models as $product):?>
								<tr class='bd-tb'>
									<td><?php echo $i;?></td>
									<td><?php echo $product['goodsno']?></td>
									<td>
										<div class='pos-r'>
											<!--<i class='icon-imghere display-ib' showin='click_#imgThumb'></i>
											--><?php echo $product['goodsname'];?>
											<i class='icon-new pos-a'></i>
										</div>
									</td>
									<td ><?php echo $product['brand'];?></td>
									<td ><?php echo $product['cp_name'];?></td>
									<td ><?php echo $product['category'];?></td>
									<td ><?php echo $product['parts_level'];?></td>
									<td ><?php echo '￥'.$product['goodsprice'];?></td>
									<td >
										<?php echo F::msubstr($product['OENO']);?>
									</td>
									<td >
										<?php echo F::msubstr($product['car']);?>
									</td>
								</tr>
								<?php $i++;?>
								<?php endforeach;?>
							</tbody>
						</table>
						<?php else:?>
							<center><p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('/maker/dealquery/empgoods/dealer/'.$_GET['dealer']))?></span></p></center>
						<?php endif;?>
						<div class="pagelist text-c">
						<?php 
							$this->widget('widgets.default.WLinkPager', array(
						      	'pages' => $pages,
					  		));
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style='height:120px'></div>
</div>
<!-- OE弹窗 -->
<div id='OEmore' class='pos-a display-n'>
	<i class='icon-close-s hide'></i>
	<ul>
		<li>123123123</li>
		<li>343434344</li>
		<li>454323478</li>
	</ul>
</div>
<!-- 车型弹窗 -->
<div id='Modelmore' class='pos-a display-n'>
	<i class='icon-close-s hide'></i>
	<ul>
		<li>奥迪A4</li>
		<li>别克凯越</li>
		<li>别克林荫大道</li>
	</ul>
</div>
