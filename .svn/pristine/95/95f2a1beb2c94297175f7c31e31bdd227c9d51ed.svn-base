<!-- 操作信息提示{ -->
<?php if(Yii::app()->user->hasFlash('success')):?>  
<div class="successmessage" id='message'>
<?php echo Yii::app()->user->getFlash('success'); ?>  
</div>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('failed')):?>  
<div class="errormessage" id='message'>
<?php echo Yii::app()->user->getFlash('failed'); ?>  
</div>
<?php endif?>
<!-- } -->
	<?php if(!empty($result)){?>
		<table cellspacing=0 cellpadding=0  >
			<thead>
				<tr>
					<td width=27>&nbsp;</td>
					<td width=75>商品编号</td>
					<td width=110>商品名称</td>
					<td width=64>商品品牌</td>
					<td width=64>配件品类</td>
					<td width=64>商品类别</td>
					<td width=60>OE号</td>
					<td width=70 style="display: none">适用车系</td>
					<td width=75>是否上下架</td>
					<td width=44>操作</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach($result as $goods):?>
				<tr class='bd-tb'>
					<td>
					<input type='checkbox' class="checkbox" name="checkbox[]" value="<?php echo $goods['goodsID']?>">
					</td>
					<td>
						<?php echo $goods['goodsno']?>
					</td>
					<td>
						<div class='pos-r'>
							<?php echo $goods['goodsname']?>
							<i class='icon-new pos-a'></i>
						</div>
					</td>
					<td ><?php echo $goods['brand']?></td>
					<td ><?php echo $goods['cp_name']?></td>
					<td ><?php echo $goods['category']?></td>
					<td >
			         <?php $OEArr = explode(',', $goods['OE']);
                            if (count($OEArr) >1): ?>
        					<?php echo $OEArr[0] ?>
                                    <ul style='display:none'>
                                               <li>
                                               <?php $arr=array_slice($OEArr,1,100);
  												echo join(',',$arr); ?>
  												</li>
                                            </ul>
                                            <a class='font-green OEmore' href="javascript:;" showin='click_#OEmore'>更多</a>
                                        <?php else: ?>
                                          <?php echo $goods['OE'] ?>
    									<?php endif; ?>
								</td>
								<td style="display: none">
										<?php $vehicleS =  explode(',',$goods['vehicle']);  if(count($vehicleS) != 1):?>
										<?php echo $vehicleS[0]?>
											<ul style='display:none'><?php foreach ($vehicleS as $vehicle):?>
												<li><?php echo $vehicle?></li>
												<?php endforeach;?>
											</ul>
										<a class='font-green vehiclemore' href="javascript:;" showmore='click_#Modelmore' key="<?php echo $goods['goodsID'];?>" field="suitcartype">更多</a>
										<?php else:?>
											<?php echo $goods['vehicle']?>
										<?php endif;?>
					</td>
					<td>
					<?php 
					if($goods['IsSale']=='Y')
					{
					 echo '已上架';
					}
					else {
					echo '未上架';
						}
					?>
					</td>
					<td >
						<a class='y-align-m' href="<?php echo Yii::app()->createUrl('maker/salesmanage/modify',array('id'=>$goods['goodsID'],'verid'=>$goods['verion_name']))?>" ><i class='icon-pencil-green display-ib'></i></a>
						<span class='y-align-m' ><i class='icon-red-cross display-ib' crowid="<?php echo $goods['goodsID']?>" style="cursor:pointer"></i></span>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
<?php }else {?>
<center>
	<p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('makemarketing/empowercate'))?></span></p>
</center><?php }?>
<script type="text/javascript">
$(function(){
	 $('.OEmore').click(function(e){
         var xx = e.originalEvent.x || e.originalEvent.layerX || 0;
         var yy = e.originalEvent.y || e.originalEvent.layerY || 0; 
         $("#OEmore").css({"top":yy,"left":xx});
         $("#OEmore").find('ul').remove();
        $(this).prev('ul').clone().appendTo("#OEmore").show();
     });
 });
$(function(){
	var url='<?php echo Yii::app()->createUrl('/maker/salesmanage/getmore')?>';
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