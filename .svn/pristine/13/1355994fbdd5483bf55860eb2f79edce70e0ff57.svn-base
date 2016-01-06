<?php
$this->pageTitle = Yii::app()->name . ' - ' . "商品清单";
?>
	<div class='width998 content content-rows auto_height'>
	<div class='tabs' pre='tab'>
		<a style='margin-left:-30px;'>&nbsp;</a>
		<a class='active' href="javascript:;;">商品清单</a>
	</div>
	<div class='tab-content auto_height'>
    	<!-- search菜单{ -->
    	<?php $this->renderPartial('searchgoods2', array('category'=>$category,'searchs'=>$search)); ?>
    	<!-- } -->
	</div>
		<div id='tab1'>
			<div class="checkbox-list">
				<div class='ctable-content'>
					<div id="ctable1">
						<table cellspacing=0 cellpadding=0 id="listSort">
							<thead>
								<tr>
									<td width=10>#</td>
									<td class="order" width=75>商品编号</td>
									<td width=110>商品名称</td>
									<td width=64>商品品牌</td>
									<td width=64>商品类别</td>
									<td width=64>配件品类</td>
									<td width=64>价格</td>
									<td width=90>配件档次</td>
									<td width=80>OE号</td>
									<td width=100>备注</td>
								</tr>
							</thead>  
                                                         <?php if(!empty($models)):?>
							<tbody>
                                                           
							<?php $i =1;?>
							<?php foreach ($models as $product):?>
								<tr class='bd-tb'>
								<td><?php echo $i;?></td>
									<td>
										<?php echo $product['goodsno']?>
									</td>
									<td>
										<div class='pos-r'>
											<!--<i class='icon-imghere display-ib' showin='click_#imgThumb'></i>
											--><?php echo $product['goodsname'];?>
											<i class='icon-new pos-a'></i>
										</div>
									</td>
									<td><?php echo $product['brand'];?></td>
									<td><?php echo $product['category'];?></td>
									<td><?php echo $product['cp_name'];?></td>
									<td><?php echo $product['goodsprice'];?></td>
									<td><?php echo $product['parts_level'];?></td>
									<td>
											<?php echo $product['OE']?>
									</td>
									<td><?php echo  F::msubstr($product['description'],0,0); //$product['youhui']?></td>
								</tr>
								<?php $i++;?>
								<?php endforeach;?>
                                                                 </tbody>
                                                               </table>
								<?php else:?>
                                              </table>
							<center>
								<p>搜索到   <font color=red>0</font> 条数据 <?php //echo CHtml::link('重新加载',array('dealerquery/index'))?></p>
							</center>
                                                        
						<?php endif;?>
                                                
						
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
<!-- 	<div class='block-shadow'></div> -->
</div>