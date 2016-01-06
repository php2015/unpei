<?php if(Yii::app()->user->hasFlash('success')):?>  
<div class="successmessage" id="message">
<?php echo Yii::app()->user->getFlash('success'); ?>  
</div>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('failed')):?>  
<div class="errormessage" id="message">
<?php echo Yii::app()->user->getFlash('failed'); ?>  
</div>
<?php endif?>
<?php if(!empty($result)){?>
	<table cellspacing=0 cellpadding=0 style="width:600px">
		<thead>
			<tr>
				<td width=27>&nbsp;</td>
				<td width=75>商品编号</td>
				<td width=100>商品名称</td>
				<td width=74>商品品牌</td>
				<td width=74>价格</td>
				<td width=78>库存</td>
				<td width=58>配件档次</td>
				<td width=58>发货天数</td>
				<td width=78>备注</td>
				<td width=34>操作</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach($result as $goods):?>
			<tr class='bd-tb'>
				<td>
					<input type='checkbox' class="checkbox" name="checkbox[]" value="<?php echo $goods['id']?>">
				</td>
				<td>
					<?php echo  F::msubstr($goods['goodsno'])?>
				</td>
				<td>
					<div class='pos-r'>
						<?php echo  F::msubstr($goods['goodsname'])?>
						<i class='icon-new pos-a'></i>
					</div>
				</td>
				<td ><?php echo $goods['brand']?></td>
				<td >￥<?php echo $goods['goodsprice']?></td>
				<td ><?php echo $goods['inventory']?></td>
				<td >
					<?php echo $goods['parts_level']?>
					
				</td>
				<td >
					<?php echo $goods['senddays']?>
					
				</td>
				<td >
					<?php echo F::msubstr($goods['description'])?>
					
				</td>
				<td >
					<a class='y-align-m' href="<?php echo Yii::app()->createUrl('maker/salesmanage/modify',array('id'=>$goods['goodsID']))?>"><i class='icon-pencil-green display-ib'></i></a>
					<span class='y-align-m' ><i class='icon-red-cross display-ib' crowid="<?php echo $goods['goodsID']?>" style="cursor:pointer"></i></span>
				</td>
			</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	
<?php }else {?>
<center>
	<p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('makemarketing/empowercate'))?></span></p>
</center>
<?php }?>
