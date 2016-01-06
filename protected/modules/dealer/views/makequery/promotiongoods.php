<?php
$this->pageTitle = Yii::app()->name . ' - ' . "经销商商品清单";
?>
	<div class='width998 content-row auto_height'>
	<div class='tabs' pre='tab'>
		<a style='margin-left:-30px;'>&nbsp;</a>
		<a class='active' href='javascript:;;'>经销商商品清单</a>
	</div>
		<div id='tab1'>
			<div class="checkbox-list">
				<div class='ctable-content'>
					<div id="ctable1">
						<table cellspacing=0 cellpadding=0>
						<?php if(!empty($models)):?>
							<thead>
								<tr>
									<td width=10>#</td>
									<td width=75>商品编号</td>
									<td width=110>商品名称</td>
									<td width=64>商品品牌</td>
									<td width=64>配件品类</td>
									<td width=60>配件档次</td>
									<td width=68>OE号</td>
									<td width=100>适用车系</td>
									<td width=123>优惠说明</td>
								</tr>
							</thead>
							<tbody>
							<?php $i=1; foreach ($models as $product):?>
								<tr class='bd-tb'>
									<td>
										<?php echo $i;?>
									</td>
									<td>
										<?php echo F::msubstr($product['goodsNO'])?>
									</td>
									<td>
										<div class='pos-r'>
											<!--<i class='icon-imghere display-ib' showin='click_#imgThumb'></i>-->
											<?php echo F::msubstr($product['goodsName']);?>
											<i class='icon-new pos-a'></i>
										</div>
									</td>
									<td ><?php echo $product['goodsBrand'];?></td>
									<td ><?php echo F::msubstr($product['normName']);?></td>
									<td ><?php echo $product['partsLevel'];?></td>
									<td >
										 <?php
                                                echo F::msubstr($product['OENO']);
//                                               ?>
									</td>
									<td >
										<?php
                                               $vehicles = DealerParts::model()->findAll('pgoods_id=:pgoods_id', array('pgoods_id' => $product['id']));
                                                foreach ($vehicles as $vehicle){
                                             $veh .=  GoodsBrand::getName($vehicle['maincate']).GoodsBrand::getCar($vehicle['subcate']).'-';
                                                }
                                                echo F::msubstr($veh);
                                                $veh='';
                                                ?>
									</td>
									
									<td><?php echo  F::msubstr($product['youhui'],0,8); //$product['youhui']?></td>
								</tr>
								<?php $i++;?>
								<?php endforeach;?>
							</tbody>
							<?php else:?>
								<tr>
								<td colspan="9" align="center">搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;</td>
								</tr>
								<?php endif;?>
						</table>
						<div class="pagelist text-c">
						<?php 
							$this->widget('widgets.default.WLinkPager', array(
									      	'pages' => $pages,
								  		));
						?>
						</div>
					</div>

					
					<div id="ctable3">3</div>
					<div id="ctable4"></div>
				</div>

			</div>

		</div>
	</div>
	<!-- 显示边栏 -->
	<div class="sidebar-show"></div>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>

<!-- OE弹窗 -->
<div id='OEmore' class='pos-a display-n' >
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
        $('.OEmore').click(function(e){
//            var xx = e.originalEvent.x || e.originalEvent.layerX || 0;
//            var yy = e.originalEvent.y || e.originalEvent.layerY || 0; 
//            $("#OEmore").css({"top":yy,"left":xx});
        	$("#OEmore").css({mouse:e});
            $("#OEmore").find('ul').remove();
            $(this).prev('ul').clone().appendTo("#OEmore").show();
            //$("#OEmore").show();
        });
        $('.Modelmore').click(function(e){
//            var xx = e.originalEvent.x || e.originalEvent.layerX || 0;
//            var yy = e.originalEvent.y || e.originalEvent.layerY || 0; 
//            $("#Modelmore").css({"top":yy,"left":xx});
            $("#OEmore").css({mouse:e});
            $("#Modelmore").find('ul').remove();
            $(this).prev('ul').clone().appendTo("#Modelmore").show();
            //$("#OEmore").show();
        });
    })
</script>