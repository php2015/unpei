<?php
$this->pageTitle = Yii::app()->name . ' - ' . "查看商品清单";
?>
<div class='width998 content-row auto_height'>
	<div class='tabs' pre='tab'>
		<a style='margin-left:-30px;'>&nbsp;</a>
		<a class='active' href='<?php echo Yii::app()->createUrl('/maker/dealquery/empgoods/dealer/'.$_GET['dealer'])?>'>商品清单</a>
		<?php echo CHtml::link('返回',array('/maker/dealquery/search'),array("style"=>"float: right"));?>
	</div>
	<div class='mt10 ml10 mr10 auto_height'>
    	<!-- search菜单{ -->
    	<?php $this->renderPartial('searchgoods', array('brand' => $brand,'category'=>$category,'car'=>$car,'searchs'=>$searchs)); ?>
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
<script type="text/javascript">
$(function(){
	var url='<?php echo Yii::app()->createUrl('/maker/dealquery/getmore')?>';
	var showin_list = $("*[showmore]");
	showin_list.each(function(){
		if(!$(this).attr('showmore'))return;
		var self = $(this),
			_opt = self.attr('showmore').split('_'),
			_act = _opt[0],
			_target = $(_opt[1]),
			_tar = _opt[1],
			_id= $(this).attr('key'),
			_field= $(this).attr('field');
		self.on(_act,function(e){
			if(_target.is(':visible'))return;
			$.getJSON(url,{id:_id,field:_field},function(result){
				_target.find("ul li").remove();
				var htmlf="<li>${"+_field+"}</li>";
				$.tmpl(htmlf,result).appendTo(_tar+" ul");
				!_target.is(':visible') && _target.eleMid({"mouse":e}).show();
			});
		});
	});
});
</script>