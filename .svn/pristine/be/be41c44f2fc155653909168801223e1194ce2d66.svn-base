<?php include 'tabs_active_contacts.php';?>
<div class='tab-content'>
    <div id='tab1'>
        <div class="search">
            <?php echo CHtml::beginForm('#', 'get',array('id'=>'searchform')); ?>
            <p class="form-row">
            	<?php echo CHtml::label('客户姓名','',array('class'=>'label label-inline-wa'));?>
                <?php echo CHtml::textField('name', $search['name'], array('class' => 'width144 input y-align-t')); ?>
                <?php echo CHtml::label('联系电话','',array('class'=>'label label-inline-wa'));?>
                <?php echo CHtml::textField('phone', $search['phone'], array('class' => 'width156 input y-align-t')); ?>
            </p>
            <p class="form-row">
            	<?php $key = $search['key'] ? $search['key'] : '备注等关键词';?>
                <?php echo CHtml::label('关&nbsp;键&nbsp;词','',array('class'=>'label label-inline-wa'));?>
                <?php echo CHtml::textField('key', $key, array('class' => 'width210 input y-align-t','fuc'=>'s')); ?>
                <?php echo CHtml::label('','',array('class'=>'label label-inline-wa'));?>
            	<?php echo CHtml::submitButton('搜索', array('class' => "submit btn-green-small")) ?>
            	<?php //if ($search):?>
            	<?php //echo CHtml::link('取消搜索', array('marketing/businessContacts'), array('class' => "submit btn-green-small")) ?>
            	<?php //endif;?>
            </p>
            <?php echo CHtml::endForm(); ?>
        </div>
        <div class="checkbox-list">
        	<div id="message"></div>
            <div class="control">
                <?php echo CHtml::checkBox('all', false, array('class' => 'float-l')); ?>
                <?php echo CHtml::link('全选', 'javascript:void(0)', array('style' => 'font-weight:bold;', 'id' => 'checkall')); ?>
                <?php echo CHtml::link('删除', 'javascript:void(0)', array('id' => 'delAll')); ?>
                <?php echo CHtml::link('添加联系人', Yii::app()->createUrl('dealer/marketing/processcontact')); ?>
            </div>
			<div style="height: 200px; overflow-x: scroll;">
            <?php if (!empty($models)): ?>
                <table cellspacing=0 cellpadding=0 style="width: 1500px">
                    <thead>
                        <tr>
                            <td width=10></td>
                            <td width=50>客户类型</td>
                            <td width=50>客户姓名</td>
                            <td width=27>性别</td>
                            <td width=90>机构名称</td>
                            <td width=50>合作类型</td>
                            <td width=50>联系电话</td>
                            <td width=50>嘉配ID</td>
                            <td width=150>地址</td>
                            <td width=64>邮箱</td>
                            <td width=64>微信号</td>
                            <td width=50>QQ号</td>
                            <td width=78>备注</td>
                            <td width=50>客户类别</td>
                            <td width=60>操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($models as $model): ?>
                            <tr>
                                <td><?php echo CHtml::checkBox('id', false, array('value' => $model->id));?></td>
                                <td><?php echo $model['customertype'];?></td>
                                <td><?php echo $model['name'];?></td>
                                <td><?php if ($model['sex']): echo $model['sex']; else: echo "无"; endif;?></td>
                                <td><?php echo F::msubstr($model['companyname']);?></td>
                                <td><?php echo $model['cooperationtype'];?></td>
                                <td><?php echo F::msubstr($model['phone']);?></td>
                                <td><?php if ($model['jiapart_ID']): echo F::msubstr($model['jiapart_ID']); else: echo "无"; endif;?></td>
                                <td><?php if ($model['province']): $address = Area::getCity($model['province']).Area::getCity($model['city']).Area::getCity($model['area']).$model['address']; echo F::msubstr($address); else: echo "无"; endif;?></td>
                                <td><?php if ($model['email']): echo F::msubstr($model['email']); else: echo "无"; endif;?></td>
                                <td><?php if ($model['weixin']): echo $model['weixin']; else: echo "无"; endif;?></td>
                                <td><?php if ($model['QQ']): echo $model['QQ']; else: echo "无"; endif;?></td>
                                <td><?php if ($model['memo']): echo F::msubstr($model['memo']); else: echo "无"; endif;?></td>
                                <td><?php if ($model['customercategory']): echo $model['customercategory']; else: echo "无"; endif;?></td>
                                <td><?php echo CHtml::link('修改',array("marketing/processcontact/id/{$model['id']}"),array('confirm'=>'您确定要修改吗？'));?>
                                	<?php echo CHtml::link('删除','javascript:void(0)',array('id'=>'delete','deleteid'=>$model['id']));?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
	        <?php else: ?>
	        	<center><p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据&nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('marketing/businessContacts'));?></span></p></center>
	        <?php endif; ?>
	      	<?php 
				$this->widget('widgets.default.WLinkPager', array(
			      	'pages' => $pages,
		  		));
		  	?>
		</div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#all").click(function(){
		$("input[name='id']").attr("checked",this.checked);
	});
	$("#checkall").click(function(){
		$("#all").attr("checked",true);
		$("input[name='id']").attr("checked",true);
	});
	//全选--删除
	$("#delAll").click(function(){	
		var ids=new Array();
		var i=0;
		var url = Yii_baseUrl + "/dealer/marketing/delall";
		$("input[name='id']:checked").each(function(){
			ids[i]=this.value;
			i++;
		});
		//alert(ids);
		var length = ids.length;
		if(length != 0){
			if(window.confirm("您确定要删除吗?")){
				$.getJSON(url,{ids:ids},function(result){
					if(result==length){
						$('<div class="successmessage">删除成功</div>').insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
				    	   //隐藏时把元素删除
				    	   $(this).remove();
				    	}); 
						$("input[name='id']:checked").each(function(){
							$(this).parents("tr").remove();
						});
						setTimeout("location.reload()",200);
					}else{
						$('<div class="errormessage">删除失败</div>').insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
				    	   //隐藏时把元素删除
				    	   $(this).remove();
				    	}); 
					}
				});
			}
		}
		else{
			$('<div class="errormessage">请选择您要删除的记录</div>').insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){});
		}
	});
	$("#delete").live('click',function(){		
		var id = $(this).attr("deleteid");
		var url = Yii_baseUrl + "/dealer/marketing/deletecontact";
		if(window.confirm("您确定要删除吗?"))
		{
			$.getJSON(url,{id:id},function(result){
				if(result==1){
				    $('<div class="successmessage">删除成功</div>').insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
			    	   //隐藏时把元素删除
			    	   $(this).remove();
			    	}); 
					$("a[deleteid="+id+"]").parents("tr").remove();
				}else{
					$('<div class="errormessage">删除失败</div>').insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
			    	   //隐藏时把元素删除
			    	   $(this).remove();
			    	}); 
				}
			})
		}
	});
})
</script>