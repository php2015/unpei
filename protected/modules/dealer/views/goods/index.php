
<div class="content-row jxs">
	<div class="page-title">
		<p class='splb pos-r display-ib'></p>
		<p class='display-ib title'> <strong>安徽科达汽车轴瓦</strong>
			<br>
			<span class='f12'>电话：123123123&nbsp;&nbsp;&nbsp;邮箱：1312sjdfaklj</span>
		</p>
		<a href="#" class='btn-green btn-green100 display-ib'>下载商品清单</a>
	</div>
	<div class="page-tel">
		<span class="font-green f14-b">快速订购</span>
		<form class='display-ib'>
			<label class='label'>商品编号：</label>
			<input class='width198 input' type='text' value='请输入完整商品编号'/>
			<label class='label'>商品睡数量：</label>
			<input class='width98 input' type='text' value='请输入完整商品编号'/>
		</form>
	</div>
</div>

<div class="content-rows15 auto_height">
	<div class="width618 bd float-l bg-white">
		<div class="title title-bg-gradual">列表订购</div>
		<div class="normal-list mt1em">
			<table cellspacing=0 cellpadding=0>
				<thead>
					<tr>
						<td width=60>添加</td>
						<td width=80>编号</td>
						<td width=100>商品名称</td>
						<td width=60>价格</td>
						<td width=80>配件档次</td>
						<td width=80>标准名称</td>
						<td width=80>商品分类</td>
						<td width=100>适用车型 </td>
					</tr>
				</thead>
			</table>
		</div>
		<div class="normal-list jxs-scroll-list">
			<table cellspacing=0 cellpadding=0>
				<thead>
					<tr>
						<td width=60></td>
						<td width=80></td>
						<td width=100></td>
						<td width=60></td>
						<td width=80></td>
						<td width=80></td>
						<td width=80></td>
						<td width=100></td>
					</tr>
				</thead>
				<tbody>
				<?php if(!empty($models)):?>
				<?php foreach ($models as $model) :?>
					<tr>
						<td>
						<?php if (in_array($model['id'], $goodsids, true)):?>
						<button class="addgoods" disabled="disabled" key="<?php echo $model['id']?>">已加</button>
						<?php else:?>
						<button class="addgoods" key="<?php echo $model['id']?>">添加</button>
						<?php endif;?>
							
						</td>
						<td><?php echo $model['goodsno']?></td>
						<td><?php echo $model['name']?></td>
						<td width=60><?php echo $model['price']?></td>
						<td width=50><?php echo $model['code']?></td>
						<td><?php echo $model['cpname']?></td>
						<td><?php echo $model['category']?></td>
						<td><?php echo $model['car']?></td>
					</tr>
					<?php endforeach;?>
					<?php else:?>
					<tr><td colspan="8">
						该生产厂家没有可卖的商品，<br>
						<?php echo CHtml::link('选择其他厂家', Yii::app()->createUrl('mall/goods/makelist'));?>
					</td></tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
	<div class='width15 float-l'>&nbsp;</div>
	<div class="width363 bd float-l bg-white splb">
		<?php $this->renderPartial('selectedgoods',array('tempgoods'=>$tempgoods));?>
	</div>
</div>

<script>
$(function(){
	// 添加商品到已选目录
	$(".addgoods").click(function(){
		$(this).attr('disabled',"true");  // 添加后不能再点击
		var mycount = eval($(".mycount").text());
		
		//alert(mycount);
		var goodsid = $(this).attr('key');
		var goodsNO = $(this).parent().next('td').text();
		var goodsName = $(this).parent().next('td').next('td').text();
		//alert(goodsName);
		
		// 把已选商品添加到数据库，如果成功就追加到table中显示出来
		 var url = Yii_baseUrl+"/dealer/goods/addtempgoods";
		 var data = {goodsid:goodsid,goodsNO:goodsNO};
		//alert(url);
		$.ajax({
			 type: "POST",
			 url: url, 
			 data: data,
			 success: function(data){
				// alert(data.success);
				var a = eval('('+data+')');
				 //alert(a.tempid);
				 if(a.success == 1)
				 {
						// 把整行追加到table中
						// 第一个td
						var td1 = '<div class="num-control display-ib">'+
						'<a class="s float-l" href="javascript:;" onclick="decrease_quantity('+a.tempid+')"></a>'+
						'<input type="text" id="input_item_'+a.tempid+'" onkeyup="change_quantity('+a.tempid+',this);" value="1" class="float-l goods_amount">'+
						'<a class="a float-l"  href="javascript:; "onclick="add_quantity('+a.tempid+')"></a>	</div>';
						// 整行
						var tr = "<tr id='selected"+goodsid+"'><td>"+td1+"</td><td>"+goodsNO+"</td><td>"+goodsName+"</td><td><a class='deltpgoods' href='javascript:;;'>删除</a><input  type='hidden' name='tempid' value='"+a.tempid+"' key='1' ></td></tr>";
						$("#selectedgoods tr:eq(0)").after(tr);
						$("#message").remove();
						mycount = mycount+1;
						$(".mycount").text(mycount);
						//alert(a.tempid);
				 }
	      }});
	});

	// 清空所选商品
	$("#emptyAll").click(function(){
		var chk_value =[],key;    
		$('input[name="tempid"]').each(function(){    
		   chk_value.push($(this).val());
		   key = $(this).attr('key');   
		  });
		 // alert(key);
		if(chk_value.length == 0)
		{
			alert("没有选择任何商品");
			return false;
		}
		var bool = confirm("确定清空所有商品吗？");
		if(bool){
			var url = Yii_baseUrl+"/dealer/goods/deltempgoods";
			$.get(url,{promID:chk_value.join(',')},function(data){
				if(data == 1){
				$('#selectedgoods tr').empty();
				var tr = "<tr id='message'><td colspan='4' class='color-red'>商品已清空 ！</td></tr>";
				$("#selectedgoods tr:eq(0)").after(tr);
				 setTimeout("location.reload();",1000);
				}
			});
		}
	}).css("cursor","pointer");
	
	// 删除单个商品
	$(".deltpgoods").live('click',function(){
		var goodsid = $(this).next('input').val();
		//alert(goodsid);
		var bool = confirm("确定要删除商品吗？");
		if(bool){
			$(this).parent().parent().remove();
			var url = Yii_baseUrl+"/dealer/goods/deltempgoods";
			$.get(url,{promID:goodsid},function(data){
			if(data == 1){
				//	location.reload();
				//$('.deltpgoods').parent().parent().remove();
				var tr = "<tr id='message'><td colspan='4' class='color-red'>商品已删除 ！</td></tr>";
				$("#selectedgoods tr:eq(0)").after(tr);
				setTimeout("location.reload();",1000);
			}
			});
		}
	});
	// 创建订单
	$("#createOreder").click(function(){
		var chk_value =[],key;    
		$('input[name="tempid"]').each(function(){    
		   chk_value.push($(this).val());
		   key = $(this).attr('key');   
		  });
		 // alert(chk_value);
		if(chk_value.length == 0)
		{
			alert("没有选择任何商品");
			return false;
		}	 
		var bool = confirm("确定现在生成订单吗?");
		if(bool){
		  var url = Yii_baseUrl+"/dealer/goods/CreateOrder";
		  $.get(url,{promID:chk_value.join(',')},function(data){
			if(data == 1){
				//alert('订单已经生成~~');
				//订单创建成功，则跳转到制定收货方案页面
				 window.location.href = url+'../../../myaddress/shipping';
				}
			});
		}
	});
	
});

// 修改数量
function update_quantity(id,quant)
{
	var url = Yii_baseUrl+"/dealer/goods/updatetpgoods";
	$.get(url,{promID:id,quant:quant},function(data){
		if(data == 1){
			//alert('修改成功');
		}
		});
}
// 减少商品数量
function decrease_quantity(rec_id){
    var item = $('#input_item_' + rec_id);
    var orig = Number(item.val());
    if(orig > 1){
        item.val(orig - 1);
        item.keyup();
    }
    update_quantity(rec_id,item.val());
}
//增加商品数量
function add_quantity(rec_id){
    var item = $('#input_item_' + rec_id);
    var orig = Number(item.val());
    item.val(orig + 1);
    item.keyup();
    update_quantity(rec_id,item.val());
}
//输入商品数量
function change_quantity(rec_id,orig){
	var item = $('#input_item_' + rec_id);
	var	val = orig.value;
		if(val<1)
			val=1;
		else if(isNaN(val))
		{
			alert('只能输入数字！');
			orig.value=1;
		}
		orig.value=orig.value.replace(/\D/g,'') ;
		update_quantity(rec_id,orig.value);
}
</script>