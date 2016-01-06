<div>
	<?php if($wearpartModel && count($wearpartModel) > 0){?>
	<div class="con_rows_table">
		<table>
			<thead>
			<tr>
				<th class='nowrap'>易损件名称</th>
				<th class='nowrap'>更换周期</th>
				<th class='nowrap'>更换数量</th>
				<th class='nowrap'>OE号</th>
				<th class='nowrap'>产品规格</th>
			</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<count($wearpartModel);$i++){?>
				<tr>
					<td><?php echo $wearpartModel[$i]['WearpartName'];?></td>
					<td><?php 
// 							if(!empty($wearpartModel[$i]['ChangeMileage'])){
// 								echo $wearpartModel[$i]['ChangeMileage']."km";
// 							}
// 							if(!empty($wearpartModel[$i]['ChangePeriod'])){
// 								echo "/".$wearpartModel[$i]['ChangePeriod']."个月&nbsp;&nbsp;";
// 							}
							if(!empty($wearpartModel[$i]['ChangeAddition'])){
								echo "".$wearpartModel[$i]['ChangeAddition'];
							}
						?>
					</td>
					<td><?php echo $wearpartModel[$i]['ChangeNum'];?></td>
					<td><?php echo $wearpartModel[$i]['OENO'];?></td>
					<td><?php echo $wearpartModel[$i]['Specification'];?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php }else{?>
	<div>暂无易损件更换周期信息</div>
	<?php }?>
</div>