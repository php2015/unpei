<table cellspacing="0" cellpadding="0" width="400px">
	<thead>
		<tr>
			<td width="10">#</td>
			<td width="100">机构名称</td>
			<td width="100">联系方式</td>
			<td width="100">邮箱</td>
			<td width="150">机构地址</td>
			<td width="38">操作</td>
		</tr>
	</thead>
	<tbody>
	<?php if (!empty($dealers)):?>
		<?php $i = 1; foreach ($dealers as $dealer):?>
			<tr class='bg-green-light'>	
				<td width=10 name='contact_user_id'><?php echo $i;?>
				<?php echo CHtml::hiddenField('contact_user_id',$dealer['userID']);?></td>
				<td name='companyname'><?php echo $dealer['organName'];?></td>
				<td name='phone'><?php echo $dealer['Phone'];?></td>
				<td name='email'><?php echo $dealer['Email'];?></td>
				<td><?php Area::showCity($dealer->province).Area::showCity($dealer->city).Area::showCity($dealer->area);?></td>
				<td><?php echo CHtml::button('选择',array('class'=>'btn-small','id'=>'opt'));?></td>
			</tr>
		<?php $i++; endforeach;?>
	<?php else :?>
			<tr>
				<td colspan="5">
					<p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php echo CHtml::link('重新加载',array('makemarketing/addempdea'))?></span></p>
				</td>
			</tr>
	<?php endif;?> 
	</tbody>
</table>