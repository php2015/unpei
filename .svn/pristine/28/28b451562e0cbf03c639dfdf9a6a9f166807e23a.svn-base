<div class="">
	<?php if($maintenanceModel){?>
	<div>
		<span style="font-weight: bold;"><?php echo $vehicle['Model'];?></span>
		<span style="font-weight: bold;margin-left:20px;">首保：<?php echo $maintenanceModel['FirstMileage']."km/".$maintenanceModel['FirstPeriod']."个月";;?></span>
		<span style="font-weight: bold;margin-left:10px;">二保：<?php echo $maintenanceModel['SecondMileage']."km/".$maintenanceModel['SecondPeriod']."个月";;?></span>
		<span style="font-weight: bold;margin-left:10px;">间隔：<?php echo $maintenanceModel['IntervalMileage']."km/".$maintenanceModel['IntervalPeriod']."个月";;?></span>
	</div>
	
	<?php if($maintenanceItem && $maintenanceItem['head'] && count($maintenanceItem['head']) > 0){
			$head = $maintenanceItem['head'];
			$left = $maintenanceItem['left'];
			$body = $maintenanceItem['body'];
	?>
	<div style="margin:20px 0;" class="con_rows_table keep_circle">
		<table>
			<thead>
			<tr>
				<th class='nowrap'>保养项目/里程</th>
				<?php for($i=0;$i<count($head);$i++){?>
				<th><?php echo $head[$i]['content'];?></th>
				<?php }?>
			</tr>	
			</thead>
			<tbody>
				<?php for($i=0;$i<count($left);$i++){?>
				<tr>
					<td class="nowrap" style="text-align:left;"><?php echo $left[$i];?></td>
					<?php for($j=0;$j<count($head);$j++){?>
					<td class="nowrap"><?php echo $body[$i][$j];?></td>
					<?php }?>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php }?>
	<?php }else{?>
	<div>暂无保养信息</div>
	<?php }?>
</div>