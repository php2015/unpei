<?php if(Yii::app()->user->hasFlash('success')):?>  
<div class="successmessage">
<?php echo Yii::app()->user->getFlash('success'); ?>  
</div>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('failed')):?>  
<div class="errormessage">
<?php echo Yii::app()->user->getFlash('failed'); ?>  
</div>
<?php endif?>
<?php if(!empty($result)){?>
<table cellspacing=0 cellpadding=0>
	<thead>
		<tr>
			<td width=4%>&nbsp;</td>
			<td width=10%>商品编号</td>
			<td width=18%>商品名称</td>
			<td width=10%>商品品牌</td>
			<td width=25%>关联标杆机构</td>
			<td width=20%>关联商品编号</td>
			<td width=15%>嘉配号</td>		
		</tr>
	</thead>
	<tbody>
	<?php foreach($result as $goods):?>
		<tr class='bd-tb'>
			<td>
				<input type='checkbox' />
			</td>
			<td><?php echo  F::msubstr($goods['goodsno'])?></td>
			<td>
				<div class='pos-r'>
					<?php echo  F::msubstr($goods['goodsname'])?>
					<i class='icon-new pos-a'></i>
				</div>
			</td>
			<td ><?php echo $goods['brand']?></td>
			<td ></td>
			<td ></td>
			<td ></td>
		</tr>
		<?php endforeach;?>
			</tbody>
		</table>
<?php }else {?>
<center>
	<p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('makemarketing/empowercate'))?></span></p>
</center>
<?php }?>
