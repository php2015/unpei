<div class='content'>
	<?php include 'tabs_active.php';?>
	<div class='tab-content'>
		<div id='tab1'>
			<div class="search">
			<?php echo CHtml::beginForm('subdealer','post');?>
				<input class="width198 input y-align-t" name='search' type='text'/>
				<input class="submit btn-green-small" type='submit' value='查询'/>
			<?php echo CHtml::endForm();?>
				
			</div>
			<div class="checkbox-list">
				<div class="control">
					<input class='float-l' name='CheckedAll' type='checkbox'/>
					<a href="javascript:void(0);" id='CheckedAll'> <strong>全选</strong></a>
					<a href="javascript:void(0);" id='noCheck'> <strong>取消</strong></a>
					<a href="javascript:void(0)" id="deleteProID">删除</a>
					<a href="<?php echo Yii::app()->createUrl('dealer/business/addsubdealer'); ?>">添加下属机构</a>
					<div style='display:none;'>
					<span id='CheckedAll' class='btn'>全选</span>
					<span  id='noCheckAll' class='btn'>反选</span>
					<span id='noCheck' class='btn'>取消</span>
					<span id='deleteProID'>删除</span></div>
				</div>
				<?php if(!empty($subdealers)):?>
				<table cellspacing=0 cellpadding=0 >
					<thead>
						<tr>
							<td width=27>&nbsp;</td>
							<td width=121>机构名称</td>
							<td width=64>经营级别</td>
							<td width=64>授权品类</td>
							<td width=64>授权品牌</td>
							<td width=90>授权销售地域</td>
							<td width=78>联系方式</td>
							<td width=99>机构地址</td>
							<td width=34>操作</td>
						</tr>
					</thead>
					<tbody>
					<?php $i=1; foreach ($subdealers as $subdealer):?>
						<tr class='empty'></tr>
						<tr>
							<td>
								<input type="checkbox" name='proID' value='<?php echo $subdealer['id']?>'/>
							</td>
							<td>
								<?php echo $subdealer['organName'];?>
								<br/>
								嘉配ID：(?) <?php echo $subdealer['phone']?>
							</td>
							<td ><?php echo $subdealer['grade']?></td>
							<td ><?php echo $subdealer['allowCate']?></td>
							<td ><?php echo $subdealer['allowBrand']?></td>
							<td ><?php Area::showCity($subdealer['allowProvince']);Area::showCity($subdealer['allowCity']) ?></td>
							<td >
								<?php echo $subdealer['phone']; ?>
								<br/>
								<?php echo  $subdealer['person']?>
							</td>
							<td > <?php Area::showCity($subdealer['province']);Area::showCity($subdealer['city']);Area::showCity($subdealer['area'])?> <?php echo "<br>".$subdealer['address']?></td>
							<td >
								<a href="<?php echo Yii::app()->createUrl('dealer/business/updatesubdealer/id'); ?><?php echo '/'.$subdealer['id']?>">修改</a>
								<br/>
								<!-- <a href="<?php echo Yii::app()->createUrl('dealer/business/deletesubdealer/id'); ?><?php echo '/'.$subdealer['id']?>">删除</a> -->
								<a class='deleteSubdealer' href="javascript:void(0)" name="<?php echo $subdealer['id']?>">删除</a>
							</td>
						</tr>
						<?php $i++; endforeach;?>
					</tbody>
				</table>
				<?php else :?>
				<center><p>搜索到   <font color=red>0</font> 条数据<?php //echo CHtml::link('重新加载',array('subdealer/index'))?></p></center>
				<?php endif;?>
			</div>
			
			<div class="pagelist text-c">
				<?php echo $page ;?>
				<span>
					去第
					<input id='thepage' class='input' style='width:20px' type='text'/>
					页
					<span id='gopage' class='btn-tiny'>GO</span>
				</span>
			</div>
		</div>

	</div>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>

</div>
<script>
$(function(){
	// 跳转到第几页
	$("#gopage").click(function(){
		var url = "<?php echo Yii::app()->createUrl('dealer/business/index'); ?>";
		var page = $("#thepage").val();
		//var page = parseInt(page);
		if(isNaN(page))
		{
			alert('请输入阿拉伯数字 !');
			$("#thepage").val('');
		}else{
			location.href=url+"?page="+page;
		}
	}).css('cursor','pointer');
	
	//全选
	$('input[name="CheckedAll"]').click(function(){
		$('input[name="proID"]').attr("checked",true);
		$('input[name="CheckedAll"]').attr("checked",true);
	});
	
	 $("#CheckedAll").click(function() {
			$('input[name="proID"]').attr("checked",true);
			$('input[name="CheckedAll"]').attr("checked",true);
		});
	$("#noCheckAll").click(function () {//反选  
        $("input[name='proID']").each(function () { 
            $(this).attr("checked", !$(this).attr("checked"));  
        });  
    }); 
	 $("#noCheck").click(function () {//全不选  
        $("input[name='proID']").attr("checked", false);
        $('input[name="CheckedAll"]').attr("checked",false);  
    });  

		// 删除按钮
	 $(".deleteSubdealer").click(function(){
			var id = $(this).attr('name');
			var bool = confirm("@_@ 确定要删除吗？");
			// alert(bool);
			 if(bool == true){
			//alert(chk_value);
			var url = "<?php echo Yii::app()->createUrl('dealer/business/ajaxdelete'); ?>";
			$.get(url,{promID:id},function(data){
				if(data == 1)
					location.reload();
			});}
		});
	// 多选删除
	$("#deleteProID").click(function(){
		var chk_value =[];    
	  $('input[name="proID"]:checked').each(function(){    
	   chk_value.push($(this).val());    
	  });    

		if(chk_value.length ==0 )
		{
			alert('你还没有选择任何内容！');
		}else
		{
			 var bool = confirm("@_@ 确定要删除吗？");
			 if(bool == true){
			//alert(chk_value);
			var url = "<?php echo Yii::app()->createUrl('dealer/business/ajaxdelete'); ?>";
			$.get(url,{promID:chk_value.join(',')},function(data){
				if(data == 1)
					location.reload();
			});}
		}
	});

	
	
})
</script>