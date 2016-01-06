
<div id="goodscategorylist-content" style="margin-top:20px;">
<span style="width:80px;">商品类别列表</span>
<a href="" id="refresh-goodscategorylist" style="display:none">刷新</a>
<div id="ctable1">
						<table cellspacing=0 cellpadding=0>
							<tbody>								
								<?php 
			                     $num = 0;
			                     foreach ($goodscategory as $element){
				                  $num++;
			                    ?>
								<tr class='bd-tb' style="height:20px;" id="tr-<?php echo $element['GoodsCategoryID'];?>">
								<td width=75><?php echo $element['GoodsCategoryID'];?></td>
								<td width=110><?php echo $element['GoodsCategoryName'];?></td>
								<td width=164><?php echo $element['GoodsCategoryDesc'];?></td>
								<td width=64><?php echo $element['GoodsCount'];?></td>
								<td width=90>
								<a href="" goodscategoryid="<?php echo $element['GoodsCategoryID'];?>" class="goodscategory-to-modify">编辑</a>
					            <a href="" goodscategoryid="<?php echo $element['GoodsCategoryID'];?>" class="goodscategory-del">删除</a></td>
					            </tr>
					            <?php }?>
						</tbody>
						</table>

</div>
</div>