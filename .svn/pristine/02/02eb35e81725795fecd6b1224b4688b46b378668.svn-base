<table cellspacing="0" cellpadding="0">
<?php if (!empty($services)):?>
	<thead>
		<tr>
			<td width="10">#</td>
			<td width="120">机构名称</td>
			<td width="70">联系方式</td>
			<td width="100">邮箱</td>
			<td width="150">机构地址</td>
			<td width="50">操作</td>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; foreach ($services as $service):?>
		<tr class='bg-green-light'>	
			<td width=10 name='contact_user_id'><?php echo $i;?>
			<?php echo CHtml::hiddenField('contact_user_id',$service['userId']);?></td>
			<td name='companyname'><?php echo $service['serviceName'];?></td>
			<td name='phone'><?php echo $service['serviceCellPhone'];?></td>
			<td name='email'><?php echo $service['serviceEmail'];?></td>
			<td><?php $address = Area::getCity($service['serviceProvince']).Area::getCity($service['serviceCity']).Area::getCity($service['serviceArea']).$service['serviceAddress']; echo F::msubstr($address);?></td>
			<td><?php echo CHtml::button('选择',array('class'=>'btn-small','id'=>'opt'));?></td>
		</tr>
		<?php $i++; endforeach;?>
	</tbody>
	<?php else :?>
		<tr>
			<td colspan="6" align="center">
				<p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('makemarketing/addempdea'))?></span></p>
			</td>
		</tr>
	<?php endif;?>
</table>  