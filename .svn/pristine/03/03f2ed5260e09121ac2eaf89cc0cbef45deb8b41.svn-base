<div class="">
	<?php if($maintenanceModel){?>
	<div>
		<span style="font-weight: bold;"><?php //echo $vehicle['Model'];?></span>
		<span style="font-weight: bold;margin-left:20px;">预约号：<?php echo $ReserveNum?></span>
		<span style="font-weight: bold;margin-left:20px;">首保：<?php echo $maintenanceModel[0]['FirstMileage']."km/".$maintenanceModel[0]['FirstPeriod']."个月";?></span>
		<span style="font-weight: bold;margin-left:10px;">二保：<?php echo $maintenanceModel[0]['SecondMileage']."km/".$maintenanceModel[0]['SecondPeriod']."个月";?></span>
		<span style="font-weight: bold;margin-left:10px;">间隔：<?php echo $maintenanceModel[0]['IntervalMileage']."km/".$maintenanceModel[0]['IntervalPeriod']."个月";?></span>
	</div>
	
	<div style="margin:20px 0;" class="con_rows_table keep_circle">
		<table>
			<thead>
                            <tr class="backcolor">
                                <th class='nowrap' style="color: #764928;">品类名称</th>
				<th class='nowrap' style="color: #764928;">商品详情</th>
				<th class='nowrap' style="color: #764928;">数量</th>
				<th class='nowrap' style="color: #764928;">操作</th>
			</tr>	
			</thead>
			<tbody>
				<input name="reserveID" type="hidden" value="<?php echo $modelID?>">
				<?php 
					if ($maintenance){
						foreach ($maintenance as $key=>$val){?>
				<tr>
					<td class="nowrap" style="text-align:left;"><?php echo $val['name'];?></td>
					<td id="<?php echo $val['code'];?>" class="nowrap goodsinfo" style="width:70%;text-align:left;"></td>
					<td class="nowrap" style="width:10%;">
						<input name="goodsID[]" type="hidden" value="" />
						<input type="button" value="-" onclick="decrease_quantity('<?php echo $val['code'] ?>')" />
						<input name="num[]" id="input_item_<?php echo $val['code'] ?>" type="text" style="width:50px;text-algin:center;" value="0" onkeyup="change_quantity('<?php echo $val['code'] ?>', this);" />
						<input type="button" value="+" onClick="add_quantity('<?php echo $val['code'] ?>')" />
					</td>
					<td class="nowrap">
						<span id="reserve-goods-search" src="<?php echo Yii::app()->createUrl('/servicer/reserve/searchgoods',array('code'=>$val['code']));?>" style="cursor:pointer">搜索商品</span>
						<input name="gcategoryCode[]" type="hidden" value="<?php echo $val['code'] ?>">
					</td>
				</tr>
				<?php }?>
				<tr>
					<td class="nowrap" colspan="4">
						<input class='submit' type='button' id="reserve-purchase-add" value='加入采购单'>
					</td>
				</tr>
				<?php }else{?>
					<tr>
						<td class="nowrap" colspan="4">暂无需要更换配件</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php }else{?>
	<div>暂无保养信息</div>
	<?php }?>
</div>
<script type="text/javascript">
	//减少数量
    function decrease_quantity(rec_id)
    {
        var item = $('#input_item_' + rec_id);
        var orig = Number(item.val());
        if (orig > 0)
        {
            item.val(orig - 1);
            item.keyup();
        }
    }
    //添加数量
    function add_quantity(rec_id)
    {
        var item = $('#input_item_' + rec_id);
        var orig = Number(item.val());
        item.val(orig + 1);
        item.keyup();
    }
    //输入商品数量
    function change_quantity(rec_id, orig)
    {
        var item = $('#input_item_' + rec_id);
        var val = orig.value;
        if (val < 0)
        {
            orig.value = 0;
        }
        if ($('#' + rec_id).text() == "")
        {
            orig.value = 0;
        }
        if (val > 100)
        {
            alert('最多只能100件');
            orig.value = 100;
        }
        else if (isNaN(val))
        {
            alert('只能输入数字！');
            orig.value = 0;
        }
        orig.value = orig.value.replace(/\D/g, '');
        //update_quantity(rec_id, orig.value);
    }
</script>