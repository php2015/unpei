<?php include 'tabs_active_contacts.php';?>
<div class='tab-content'>
	<div id="tab1">
		<div class="checkbox-list">
			<div class='auto_height'>
				<?php echo CHtml::hiddenField(count,count($models),array('class'=>'width100 count')); ?>
            	<?php echo CHtml::button('添加客户类别', array('class'=>'btn-green160 addCategory')); ?>
            	<?php echo CHtml::label('','',array('class' => "error"));?>
            </div>
            <div class='mt1em'></div>
	        <?php if (!empty($models)): ?>
				<table cellspacing=0 cellpadding=0 >
					<thead>
	                	<tr>
	                		<td width=150>客户类别</td>
	                        <td width=60>操作</td>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php foreach ($models as $model): ?>
	                	<tr>
	                		<td><?php echo $model['category'];?></td>
	                        <td><?php echo CHtml::link('修改',array("marketing/processcategory/id/{$model['id']}"),array('confirm'=>'您确定要修改吗？'));?>
	                        <?php echo CHtml::link('删除',array("marketing/deletecategory/id/{$model['id']}"),array('confirm'=>'您确定要删除吗？'));?></td>
	                    </tr>
	                    <?php endforeach; ?>
	                </tbody>
	            </table>
		    <?php else: ?>
	        	<center><p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据&nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('marketing/businessContacts'));?></span></p></center>
	        <?php endif; ?>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".addCategory").click(function(){
		var count = $(".count").val();
		if(count >= 4){
			$('.error').text('最多可添加4种客户类别').css('color','red');
		}
		else{
			$('.error').text('');
			location.href = Yii_baseUrl + "/dealer/marketing/processcategory";
		}
	});
})
</script>