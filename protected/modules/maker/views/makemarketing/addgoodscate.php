<style>
.errorMessage {float:left; margin-left:360px; color:red; margin-top:-30px;}
.label{width: 80px;}
</style>
<?php 
if ($model->id){
	$this->pageTitle = Yii::app()->name . ' - ' . "修改品类";
}else{
	$this->pageTitle = Yii::app()->name . ' - ' . "添加品类";
}
?>
<div class='tabs' pre='tab'>
	<a class='left-indent'>&nbsp;</a>
	<?php echo CHtml::link('品类列表', Yii::app()->createUrl('maker/makemarketing/empowercate'));?>
	<?php if ($model->id):?>
		<?php echo CHtml::link('修改品类', Yii::app()->createUrl('maker/makemarketing/addempowercate',array('id'=>$_GET['id'])),array('class'=>'active'));?>
	<?php else :?>
		<?php echo CHtml::link('添加品类', Yii::app()->createUrl('maker/makemarketing/addempowercate'),array('class'=>'active'));?>
	<?php endif;?>
</div>
<?php if ($model->id):?>
	<?php echo CHtml::beginForm(Yii::app()->createUrl("maker/makemarketing/addempowercate/id/{$model->id}"),'post',array('id'=>'form'));?>
<?php else :?>
	<?php echo CHtml::beginForm(Yii::app()->createUrl('maker/makemarketing/addempowercate'),'post',array('id'=>'form'));?>
<?php endif;?>
<div class='pl10 pr10 pt10'>
<div class='content-row-bnm'>
	<p class="form-row">
		<?php echo CHtml::label('品类名称：','MakeEmpowerCategory[cateName]',array('class'=>'label')); ?>
		<?php echo CHtml::textField('MakeEmpowerCategory[cateName]',$model->cateName,array('class'=>'width213 input')); ?>
		<span id="cateNameError" style='color: red;'></span>
	</p>
	<p class="form-row">
		<?php echo CHtml::label('备注：','MakeEmpowerCategory[remarks]',array('class'=>'label')); ?>
		<?php echo CHtml::textArea('MakeEmpowerCategory[remarks]',$model->remarks,array('size'=>255,'maxlength'=>255,'class'=>'width400 textarea','style'=>'vertical-align: top;height: 33px;margin-top: 0em;'));?>
		<?php if ($model->id):?>
			<?php echo CHtml::hiddenField('MakeEmpowerCategory[id]',$model->id);?>
		<?php endif;?>
	</p>
</div>
<div class='content-row-bnm'>
	<p class='pt10 pb10'>
		<?php //echo CHtml::radioButtonList('search[radio]',$search['radio'],array('OE'=>'OE号','goods_num'=>'商品编号'),array('class'=>'label label-inline-wa','separator'=>' '));?>
		<?php //echo CHtml::textField('search[num]',$search['num'],array('class'=>'width118 input'));?>
		<label class='label label-inline-wa' name='1'>商品分类：</label>
		<?php echo CHtml::dropDownList('search[cate]',$search['cate'],$cates,array('class'=>'width118 select','empty'=>'请选择'));?>
		<input type="hidden" id="categoryID" name="type">
                <input class='submit' type='button' id="query" value='查&nbsp;询'>
		<input class='submit' type='button' id="save" value='保&nbsp;存'>
	</p>
</div>
</div>
<div class="checkbox-list">
	<div class='ctable-content'>
		<div id="ctable1">
			<div style="float:left;width:350px;height:500px;overflow-x:scroll;overflow-y:scroll">
			<table cellspacing=0 cellpadding=0 style="width:800px;" id="goods">
				<thead>
					<tr>
						<td width=27>&nbsp;</td>
						<td width=75>商品编号</td>
						<td width=110>商品名称</td>
						<td width=64>商品品牌</td>
						<td width=64>配件品类</td>
						<td width=90>商品类别</td>
						<td width=78>OE号</td>
					</tr>
				</thead>
				<tbody>
				<?php if (!empty($result)):?>
				<?php foreach($result as $goods):?>
					<tr class='bd-tb'>
						<td>
							<?php echo CHtml::checkBox('goods_id',false,array('value'=>$goods['goodsID']));?>
						</td>
						<td>
							<?php echo $goods['goodsno']?>
						</td>
						<td>
							<div class='pos-r'>
								<!--<i class='icon-imghere display-ib' showin='click_#imgThumb'></i>
								--><?php echo $goods['goodsname']?>
								<i class='icon-new pos-a'></i>
							</div>
						</td>
						<td ><?php echo $goods['brand']?></td>
						<td ><?php echo $goods['cp_name']?></td>
						<td ><?php echo $goods['category']?></td>
						<td >
							<?php echo F::msubstr($goods['oe'])?>
						</td>
					</tr>
					<?php endforeach;?>
					<?php endif;?>
				</tbody>
			</table>
			</div>
			<div class='width60 float-l text-c lh30 mt4em'>
			<input type="button" class='btn-sq-add' value="" id="empow">
			<br>
			<input type="button" class='btn-sq-all' value="" id="allempow">
			<br>
			<input type="button" class='btn-sq-remove' value="" id="return">
			<br>
			<input type="button" class='btn-sq-empty' value="" id="allreturn">
			</div>
			<div style="float:right;width:350px;height:500px;overflow-x:scroll;overflow-y:scroll;border-left:1px solid #dfdfdf">
			<table cellspacing=0 cellpadding=0 style="width:800px;" id="categoods">
				<thead>
					<tr style='border-left:none;'>
						<td width=27>&nbsp;</td>
						<td width=75>商品编号</td>
						<td width=110>商品名称</td>
						<td width=64>商品品牌</td>
						<td width=64>配件品类</td>
						<td width=90>商品类别</td>
						<td width=78>OE号</td>
					</tr>
				</thead>
				<tbody>
				<?php if (!empty($bindingcates)):?>
				<?php foreach($bindingcates as $goods):?>
					<tr class='bd-tb'>
						<td>
							<?php echo CHtml::checkBox('cate_id',false,array('value'=>$goods['goodsID']));?>
						</td>
						<td>
							<?php echo $goods['goodsno']?>
						</td>
						<td>
							<div class='pos-r'>
								<!--<i class='icon-imghere display-ib' showin='click_#imgThumb'></i>
								--><?php echo $goods['goodsname']?>
								<i class='icon-new pos-a'></i>
							</div>
						</td>
						<td ><?php echo $goods['brand']?></td>
						<td ><?php echo $goods['cp_name']?></td>
						<td ><?php echo $goods['category']?></td>
						<td >
							<?php echo F::msubstr($goods['oe'])?>
						</td>
						<input type="hidden" value="<?php echo $goods['goodsID'];?>" name="goodscatesrelation[]">
					</tr>
					<?php endforeach;?>
					<?php endif;?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<?php echo CHtml::endForm();?>
<script id="categoodsinfo" type="text/x-jquery-tmpl">
<tr class='bd-tb'>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		<input id="cate_id" type="checkbox" name="cate_id" value='${goodsID}'>
	</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		${goodsno}
	</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		<div class='pos-r'>
			${goodsname}
			<i class='icon-new pos-a'></i>
		</div>
	</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${brand}</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${cp_name}</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${category}</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		${oe}
	</td>
	<input type="hidden" value='${goodsID}' name="goodscatesrelation[]">
</tr>
</script>
<script id="goodsinfo" type="text/x-jquery-tmpl">
<tr class='bd-tb'>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		<input id="goods_id" type="checkbox" name="goods_id" value='${goodsID}'>
	</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		${goodsno}
	</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		<div class='pos-r'>
			${goodsname}
			<i class='icon-new pos-a'></i>
		</div>
	</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${brand}</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${cp_name}</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${category}</td>
	<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
		${oe}
	</td>
</tr>
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#goods tr").live('click',function(){
		if(!$(this).children("td").find("#goods_id").is(":checked")){
			$(this).css('background','#F3F3F3');
			$(this).children("td").find("#goods_id").attr("checked",true);
		}else{
			$(this).css('background','#FFFFFF');
			$(this).children("td").find("#goods_id").attr("checked",false);
		}
	});
	$("#categoods tr").live('click',function(){
		if(!$(this).children("td").find("#cate_id").is(":checked")){
			$(this).css('background','#F3F3F3');
			$(this).children("td").find("#cate_id").attr("checked",true);
		}else{
			$(this).css('background','#FFFFFF');
			$(this).children("td").find("#cate_id").attr("checked",false);
		}
	});
	$('#goods_id').live('click',function(){
		if(!$(this).is(":checked")){
			$(this).parents("tr").css('background','#F3F3F3');
			$(this).attr("checked",true);
		}else{
			$(this).parents("tr").css('background','#FFFFFF');
			$(this).attr("checked",false);
		}
	});
	$('#cate_id').live('click',function(){
		if(!$(this).is(":checked")){
			$(this).parents("tr").css('background','#F3F3F3');
			$(this).attr("checked",true);
		}else{
			$(this).parents("tr").css('background','#FFFFFF');
			$(this).attr("checked",false);
		}
	});
	$('#empow').click(function(){
		var ids=new Array();
		var i=0;
		var goods_id=$("input[name=goods_id]").val();
		if(typeof(goods_id) == "undefined"){
			alert("没有可选的商品！");
		}else{
			$("input[name=goods_id]:checked").each(function(){
				ids[i]=this.value;
				$(this).parents("tr").remove();
				i++;
			});
			if(ids.length==0){
				alert("请选择需要授权的商品！");
			}else{
				$.getJSON("<?php echo Yii::app()->createUrl('maker/makemarketing/getgoodsinfo');?>",{ids:ids},function(result){
					if(result){
						$("#categoodsinfo").tmpl(result).appendTo("#categoods");
					}
				});
			}
		}
	});
	$('#allempow').click(function(){
		var ids=new Array();
		var i=0;
		var goods_id=$("input[name=goods_id]").val();
		if(typeof(goods_id) == "undefined"){
			alert("没有可选的商品！");
		}else{
			$("input[name=goods_id]").each(function(){
				ids[i]=this.value;
				$(this).parents("tr").remove();
				i++;
			});
			if(ids.length==0){
				alert("请选择需要授权的商品！");
			}else{
				$.getJSON("<?php echo Yii::app()->createUrl('maker/makemarketing/getgoodsinfo');?>",{ids:ids},function(result){
					if(result){
						$("#categoodsinfo").tmpl(result).appendTo("#categoods");
					}
				});
			}
		}
	});
	$('#return').click(function(){
		var ids=new Array();
		var i=0;
		var cate_id=$("input[name=cate_id]").val();
		if(typeof(cate_id) == "undefined"){
			alert("没有可选的商品！");
		}else{
			$("input[name=cate_id]:checked").each(function(){
				ids[i]=this.value;
				$(this).parents("tr").remove();
				i++;
			});
			if(ids.length==0){
				alert("请选择需要返回的商品！");
			}else{
				$.getJSON("<?php echo Yii::app()->createUrl('maker/makemarketing/getgoodsinfo');?>",{ids:ids},function(result){
					if(result){
						$("#goodsinfo").tmpl(result).appendTo("#goods");
					}
				});
			}
		}
	});
	$('#allreturn').click(function(){
		var ids=new Array();
		var i=0;
		var cate_id=$("input[name=cate_id]").val();
		if(typeof(cate_id) == "undefined"){
			alert("没有可选的商品！");
		}else{
			$("input[name=cate_id]").each(function(){
				ids[i]=this.value;
				$(this).parents("tr").remove();
				i++;
			});
			if(ids.length==0){
				alert("请选择需要返回的商品！");
			}else{
				$.getJSON("<?php echo Yii::app()->createUrl('maker/makemarketing/getgoodsinfo');?>",{ids:ids},function(result){
					if(result){
						$("#goodsinfo").tmpl(result).appendTo("#goods");
					}
				});
			}
		}
	});	
	$('#save').click(function(){
		if(window.confirm("您确定要保存吗?"))
		{
			if($.trim($("#MakeEmpowerCategory_cateName").val()))
			{
				$("#cateNameError").html("");
                                $("#categoryID").val('save');
//                                $("#save").attr("disabled",true);
				$("#form").submit();
			}
			else{
				$("#cateNameError").html("品类名称 不可为空白.");
			}
		}
	});
	$('#query').click(function(){
                $("#categoryID").val('query');
		$("#form").submit();
	});
	$("#MakeEmpowerCategory_cateName").focus(function(){
		$("#cateNameError").html("");
	});
	$("#MakeEmpowerCategory_cateName").blur(function(){
		if($.trim($("#MakeEmpowerCategory_cateName").val()))
			$("#cateNameError").html("");
		else
			$("#cateNameError").html("品类名称 不可为空白.");
	});
})
</script>