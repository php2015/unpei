<style>
.dttable tr{height:30px;}
</style>
<?php echo $this->renderPartial('tabs_active_contacts.php');?>
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
            	<?php if ($search):?>
            	<?php echo CHtml::link('取消搜索', array('contact/index'), array('class' => "submit btn-green-small")) ?>
            	<?php endif;?>
            </p>
            <?php echo CHtml::endForm(); ?>
        </div>
        <div class="checkbox-list">
        	<div id="message"></div>
            <div class="control">
                <?php echo CHtml::checkBox('all', false, array('class' => 'float-l')); ?>
                <?php echo CHtml::link('全选', 'javascript:void(0)', array('style' => 'font-weight:bold;', 'id' => 'checkall')); ?>
                <?php echo CHtml::link('删除', 'javascript:void(0)', array('id' => 'delAll')); ?>
                <?php echo CHtml::link('添加联系人', 'javascript:void(0)', array('id'=>'addContact')); ?>
            </div>
			<div style="overflow-x: scroll;">
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
                            <td width=180>地址</td>
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
                                <td><?php if ($model['province']): echo Area::showCity($model['province']).Area::showCity($model['city']).Area::showCity($model['area']).$model['address']; else: echo "无"; endif;?></td>
                                <td><?php if ($model['email']): echo F::msubstr($model['email']); else: echo "无"; endif;?></td>
                                <td><?php if ($model['weixin']): echo $model['weixin']; else: echo "无"; endif;?></td>
                                <td><?php if ($model['QQ']): echo $model['QQ']; else: echo "无"; endif;?></td>
                                <td><?php if ($model['memo']): echo F::msubstr($model['memo']); else: echo "无"; endif;?></td>
                                <td><?php if ($model['customercategory']): echo $model['customercategory']; else: echo "无"; endif;?></td>
                                <td><?php echo CHtml::link('查看', 'javascript:void(0)', array('class'=>'checkContact','reg'=>$model['id']));?>
                                	<?php echo CHtml::link('修改', 'javascript:void(0)', array('class'=>'modifyContact','key'=>$model['id']));?>
                                	<?php echo CHtml::link('删除','javascript:void(0)',array('id'=>'delete','deleteid'=>$model['id']));?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
	        <?php else: ?>
	        	<p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据&nbsp;&nbsp;<span style="text-decoration: underline"><?php echo CHtml::link('重新加载',array('contact/index'));?></span></p>
	        <?php endif; ?>
	      	<?php 
				$this->widget('widgets.default.WLinkPager', array(
			      	'pages' => $pages,
		  		));
		  	?>
		</div>
    </div>
</div>
<!-- 添加/修改业务联系人BEGIN -->
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mycontact',
    'options'=>array(
        'title'=>Yii::t('query','修改业务联系人'),
        'autoOpen'=>false,
        'modal'=>'true',
        'width'=>'800px',
        'height'=>'auto'
    )
));?>
<div class='contact_info'>
	<?php echo CHtml::label('','',array('class'=>'error')); ?>
	<div class='title title-dashed-inline'>
		<span>机构信息</span>
	</div>
	<div class="form-row">
	<?php 
		echo CHtml::label('机构名称:','',array('class'=>'label'));
		echo CHtml::textField('companyname','',array('class'=>'width213 input companyname'));
		echo CHtml::hiddenField('contact_user_id','',array('class'=>'width64 input contact_user_id'));
		echo CHtml::button('选择',array('class'=>'btn-small','id'=>'choose'));?>
	</div>
	<div class="form-row">
	<?php 
		echo CHtml::label('客户类型:','',array('class'=>'label'));
		echo CHtml::dropDownList('customertype','', array(
			'A' =>'A','B' =>'B','C' =>'C'),array('class'=>'width118 select customertype','empty'=>'请选择'));
		echo CHtml::label('合作类型:','',array('class'=>'label'));
		echo CHtml::dropDownList('cooperationtype','', array(
			'A' =>'A','B' =>'B','C' =>'C'),array('class'=>'width118 select cooperationtype','empty'=>'请选择')); ?>
	</div>
	<div class="form-row">
	<?php 
		echo CHtml::label('客户类别:','',array('class'=>'label')); 
		$state_data=CustomerCategory::model()->findAll("user_Id=:user_Id",array(":user_Id"=>Yii::app()->user->id));
        $state=CHtml::listData($state_data,"category","category");	
		echo CHtml::dropDownList('customercategory','', $state,array('class'=>'width118 select customercategory','empty'=>'请选择'));
		echo CHtml::link('&nbsp;*&nbsp;添加客户类别',array('contact/customerCategory'),array('style'=>'color:green;margin-left:38px;'));?>
	</div>
	<div class="form-row">
	<?php
		$state_data=  Area::model()->findAll("grade=:grade",array(":grade"=>1));
		$state='';
        $state=CHtml::listData($state_data,"id","name");
        $s_default = $model->isNewRecord ? '' : $model->province;
        echo CHtml::label('地　　址:','',array('class'=>'label'));
        echo CHtml::dropDownList('province', '', $state,
        	array(
	         	'class'=>'width118 select checkbox-add province',
	            'empty'=>'请选择省份',   
	            'ajax' => array(
	            'type'=>'GET', //request type
	            'url'=> Yii::app()->request->baseUrl.'/Common/dynamiccities', //url to call
	            'update'=>'#city', //lector to update
	            'data'   => 'js:"province="+jQuery(this).val()',
	    )));
        $c_default = $model->isNewRecord ? '' : $model->city;
        if(!$model->isNewRecord){
        	$city_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->province));
            $city=CHtml::listData($city_data,"id","name");
        }
		$city_update = $model->isNewRecord ? array() : $city;
        echo CHtml::dropDownList('city', 'city', $city_update,
        	array(
        		'class'=>'width118 select checkbox-add city',
                'empty'=>'请选择城市',
                'ajax' => array(
                'type'=>'GET', //request type
                'url'=>Yii::app()->request->baseUrl.'/Common/dynamicdistrict', //url to call
                'update'=>'#area', //lector to update
                'data'  => 'js:"city="+jQuery(this).val()',
           )));   
        $d_default = $model->isNewRecord ? '' : $model->area;
		if(!$model->isNewRecord){
			$district_data=Area::model()->findAll("parent_id=:parent_id",array(":parent_id"=>$model->city));
            $district=CHtml::listData($district_data,"id","name");
        }          
        $district_update = $model->isNewRecord ? array() : $district;
        echo CHtml::dropDownList('area', 'area', $district_update,
        	array(
        		'class'=>'width118 select area',
                'empty'=>'请选择地区', 
            ));
        echo "&nbsp;&nbsp;".CHtml::textField('address','',array('class'=>'width213 input address')); ?>
	</div>
	<div class='title title-dashed-inline'>
		<span>联系人信息</span>
	</div>
	<p class="form-row">
		<?php echo CHtml::label('姓　　名:','',array('class'=>'label')); ?>
		<?php echo CHtml::textField('name','',array('class'=>'width130 input name')); ?>
		<?php echo CHtml::label('性　　别:','',array('class'=>'label')); ?>
		<?php echo CHtml::dropDownList('sex','', array(
				'男' =>'男',
				'女' =>'女',
			),array('class'=>'width130 select sex','empty'=>'请选择')); ?>
	</p>
	<p class="form-row">
		<?php echo CHtml::label('联系电话:','',array('class'=>'label')); ?>
		<?php echo CHtml::textField('phone','',array('class'=>'width130 input phone')); ?>
		<?php echo CHtml::label('邮　　箱:','',array('class'=>'label')); ?>
		<?php echo CHtml::textField('email','',array('class'=>'width130 input email')); ?>
	</p>
	<p class="form-row">
		<?php echo CHtml::label('微　　信:','',array('class'=>'label')); ?>
		<?php echo CHtml::textField('weixin','',array('class'=>'width130 input weixin')); ?>
		<label class='label'>QQ 号 码:</label>
		<?php echo CHtml::textField('QQ','',array('class'=>'width130 input QQ')); ?>
	</p>
	<p class="form-row">
		<?php echo CHtml::label('备　　注:','',array('class'=>'label','style'=>'vertical-align: top;')); ?>
		<?php echo CHtml::textArea('memo','',array('class'=>'width560 textarea memo'));?>
	</p>
	<p class="form-row text-c">
		<?php echo CHtml::hiddenField('id','',array('class'=>'width130 input contact_id'));?>
		<?php echo CHtml::button('保存',array('class' => 'submit','id'=>'save','style'=>"cursor:pointer"));?>
	</p>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<!-- 添加/修改业务联系人END -->
<!-- 查看业务联系人BEGIN -->
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'checkcontact',
    'options'=>array(
        'title'=>Yii::t('query','查看业务联系人'),
        'autoOpen'=>false,
        'modal'=>'true',
        'width'=>'600px',
        'height'=>'auto'
    )
));?>
<div class='contact_check'>
	<div class="dtdiv" style="width:100%;">
		<div class='title title-dashed-inline'>
			<span>机构信息</span>
		</div>
		<table class="dttable" style="width:100%;">
			<tr>
				<td width=100 align="right">机构名称:</td>
				<td colspan="3" name="companyname"></td>
			</tr>
			<tr>
				<td width=100 align="right">客户类型:</td>
				<td name="customertype" width=100></td>
				<td width=100 align="right">合作类型:</td>
				<td name="cooperationtype" width=200></td>
			</tr>
			<tr>
				<td align="right">客户类别:</td>
				<td colspan="3" name="customercategory"></td>
			</tr>
			<tr>
				<td align="right">地　　址:</td>
				<td colspan="3" name="address"></td>
			</tr>
		</table>
	</div>
	<div class="dtdiv" style="width:100%;">
		<div class='title title-dashed-inline'>
			<span>联系人信息</span>
		</div>
		<table class="dttable" style="width:100%;">
			<tr>
				<td align="right" width=100>姓　　名:</td>
				<td name="name" width=100></td>
				<td align="right" width=100>性　　别:</td>
				<td name="sex" width=200></td>
			</tr>
			<tr>
				<td align="right">联系电话:</td>
				<td name="phone"></td>
				<td align="right">邮　　箱:</td>
				<td name="email"></td>
			</tr>
			<tr>
				<td align="right">微　　信:</td>
				<td name="weixin"></td>
				<td align="right">QQ 号 码:</td>
				<td name="QQ"></td>
			</tr>
			<tr>
				<td align="right">备　　注:</td>
				<td colspan="3" name="memo"></td>
			</tr>
		</table>
	</div>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<!-- 查看业务联系人END -->
<!-- 选择机构名称BEGIN -->
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'choosecontact',
    'options'=>array(
        'title'=>Yii::t('query','选择联系人'),
        'autoOpen'=>false,
        'modal'=>'true',
        'width'=>'620px',
        'height'=>'auto'
    ),
));?>
<div class="checkbox-list">
	<div style="width:600px;height:300px;overflow-y:scroll">
		<div id="tab-container" class='tab-container'  pre='ctable'>
	        <ul class='etabs'>
	            <li class='tab'><?php echo CHtml::link('经销商', '#tabs1'); ?></li>
	            <li class='tab'><?php echo CHtml::link('修理厂', '#tabs2'); ?></li>
	        </ul>
	        <div class='panel-container'>
		        <div id="tabs1">
		        	<?php $this->renderPartial('dealercontacts', array('dealers' => $dealers)); ?>
		        </div>
		        <div id="tabs2">
		        	<?php $this->renderPartial('servicecontacts', array('services' => $services)); ?>
		        </div>	
	        </div>
    	</div>
	</div>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<!-- 选择机构名称END -->
<script type="text/javascript">
$(document).ready(function(){
	//新增业务联系人
	$("#addContact").click(function(){
		$("#ui-dialog-title-mycontact").text('添加业务联系人');
		//清空弹出框
		$(".companyname").val('');		$(".customertype").val('');
		$(".cooperationtype").val('');	$(".customercategory").val('');
		$(".province").val('');			$(".city").val('');	
		$(".area").val('');				$(".address").val('');
		$(".name").val('');				$(".sex").val('');
		$(".phone").val('');			$(".email").val('');
		$(".weixin").val('');			$(".QQ").val('');	
		$(".memo").val('');				$(".contact_id").val('');		
		$(".contact_user_id").val('');	
		$("#mycontact").dialog("open");
	});
	//修改业务联系人
	$(".modifyContact").click(function(){
		$("#ui-dialog-title-mycontact").text('修改业务联系人');
		//清空弹出框
		$(".companyname").val('');		$(".customertype").val('');
		$(".cooperationtype").val('');	$(".customercategory").val('');
		$(".province").val('');			$(".city").val('');	
		$(".area").val('');				$(".address").val('');
		$(".name").val('');				$(".sex").val('');
		$(".phone").val('');			$(".email").val('');
		$(".weixin").val('');			$(".QQ").val('');	
		$(".memo").val('');				$(".contact_id").val('');		
		$(".contact_user_id").val('');	
		$("#mycontact").dialog('open');
		var id = $(this).attr('key');
		$.getJSON(Yii_baseUrl + "/cim/contact/getContact",{id:id},function(data){
			$(".companyname").val(data.companyname);
			$(".customertype").val(data.customertype);
			$(".cooperationtype").val(data.cooperationtype);
			$(".customercategory").val(data.customercategory);
			$(".province").val(data.province);
			$(".city").val(data.city);
			$(".area").val(data.area);
			$(".address").val(data.address);
			$(".name").val(data.name);
			$(".sex").val(data.sex);
			$(".phone").val(data.phone);
			$(".email").val(data.email);
			$(".weixin").val(data.weixin);
			$(".QQ").val(data.QQ);
			$(".memo").val(data.memo);
			$(".contact_id").val(data.id);	//当前需要修改的记录ID
			$(".contact_user_id").val(data.contact_user_id);	//当前需要修改的被添加的业务联系人ID
		});
	});
	//查看业务联系人
	$(".checkContact").click(function(){
		//清空弹出框
		$("td[name=companyname]").html('');
		$("td[name=customertype]").html('');
		$("td[name=cooperationtype]").html('');
		$("td[name=customercategory]").html('');
		$("td[name=address]").html('');
		$("td[name=name]").html('');
		$("td[name=sex]").html('');
		$("td[name=phone]").html('');
		$("td[name=email]").html('');
		$("td[name=weixin]").html('');
		$("td[name=QQ]").html('');
		$("td[name=memo]").html('');
		$("#checkcontact").dialog('open');
		var id = $(this).attr('reg');
		$.getJSON(Yii_baseUrl + "/cim/contact/getContact",{id:id},function(data){
			$("td[name=companyname]").html(data.companyname);
			$("td[name=customertype]").html(data.customertype);
			$("td[name=cooperationtype]").html(data.cooperationtype);
			$("td[name=customercategory]").html(data.customercategory);
			$("td[name=address]").html(data.deatil_address);
			$("td[name=name]").html(data.name);
			$("td[name=sex]").html(data.sex);
			$("td[name=phone]").html(data.phone);
			$("td[name=email]").html(data.email);
			$("td[name=weixin]").html(data.weixin);
			$("td[name=QQ]").html(data.QQ);
			$("td[name=memo]").html(data.memo);
		});
	});
	$("#province").change(function(){
		if($(this).val()){
			var province=$(this).val();
			$.getJSON(Yii_baseUrl+'/common/dynamicarea',{province:province},function(data){
				if(data!=''){
					$("#area").empty();
					$.each(data, function(key,val){      
						jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#area");
					}); 
				}
			});
		}
		else{
			$("#area").empty();
		}
	});
	
	$('#tab-container').easytabs({animate:false});
	
	$("#choose").click(function(){
		$("#choosecontact").dialog("open");
	});
	$("#opt").live('click',function(){
		var companyname = $(this).parents('tr').find('td[name=companyname]').html();
		var user_id = $(this).parents('tr').find('input[name=contact_user_id]').val();
		var phone = $(this).parents('tr').find('td[name=phone]').html();
		var email = $(this).parents('tr').find('td[name=email]').html();
		$(".companyname").val(companyname);
		$(".contact_user_id").val(user_id);
		$(".phone").val(phone);
		$(".email").val(email);
		$("#choosecontact").dialog("close");
	});
	
	$("#save").click(function(){
		if(confirm("您确定要保存吗？")){
			var id = $(".contact_id").val();
			var contact_user_id = $(".contact_user_id").val();
			var customertype = $(".customertype").val();
			var cooperationtype = $(".cooperationtype").val();
			var customercategory = $(".customercategory").val();
			var province = $(".province").val();
			var city = $(".city").val();
			var area = $(".area").val();
			var address = $(".address").val();
			var name = $(".name").val();
			var sex = $(".sex").val();
			var companyname = $(".companyname").val();
			var phone = $(".phone").val();
			var email = $(".email").val();
			var weixin = $(".weixin").val();
			var QQ = $(".QQ").val();
			var memo = $(".memo").val();
			var data = {id:id,contact_user_id:contact_user_id,customertype:customertype,cooperationtype:cooperationtype,
			customercategory:customercategory,province:province,city:city,area:area,address:address,name:name,
			sex:sex,companyname:companyname,phone:phone,email:email,weixin:weixin,QQ:QQ,memo:memo};
			if(name && customertype && cooperationtype){
				if(phone){
					//电话号码验证正则表达式
					var pattern=/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$|(^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$)/;
					if(pattern.test(phone)){
						var url = Yii_baseUrl + "/cim/contact/processContact";
						 $.getJSON(url,data,function(result){
							if(result==1){
								$("<div class='successmessage' style='text-align: center;'>更新成功</div>").insertAfter($("#message")).animate({opacity: 1.0}, 500).fadeOut("slow",function(){
					                //隐藏时把元素删除
					                $(this).remove();
					            });
								setTimeout("location.reload()",10);
								$("#mycontact").dialog('close');
								
							}
							else{
								$("<div class='errormessage' style='text-align: center;'>更新失败，请联系管理员！</div>").insertAfter($("#message")).animate({opacity: 1.0}, 500).fadeOut("slow",function(){
					                //隐藏时把元素删除
					                $(this).remove();
					            }); 
								setTimeout("location.reload()",10);
								$("#mycontact").dialog('close');
							}
						});	
					}		
					else{
						$(".error").html("联系电话格式错误.").css('color','red');
					}
				}else{
					$(".error").html("联系电话 不可为空白.").css('color','red');
				}
			}
			else if(name == ''){
				$(".error").html("联系人 不可为空白.").css('color','red');
			}
			else if(customertype == ''){
				$(".error").html("客户类型 不可为空白.").css('color','red');
			}
			else if(cooperationtype == ''){
				$(".error").html("合作类型 不可为空白.").css('color','red');
			}
		}
	});

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
		var url = Yii_baseUrl + "/cim/contact/delAll";
		$("input[name='id']:checked").each(function(){
			ids[i]=this.value;
			i++;
		});
		var length = ids.length;
		if(length != 0){
			if(window.confirm("您确定要删除吗?")){
				$.getJSON(url,{ids:ids},function(result){
					if(result==1){
						$("<div class='successmessage' style='text-align: center;'>删除成功</div>").insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
				    	   //隐藏时把元素删除
				    	   $(this).remove();
				    	}); 
						$("input[name='id']:checked").each(function(){
							$(this).parents("tr").remove();
						});
						setTimeout("location.reload()",100);
					}else{
						$("<div class='errormessage' style='text-align: center;'>删除失败</div>").insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
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
		var url = Yii_baseUrl + "/cim/contact/deleteContact";
		if(window.confirm("您确定要删除吗?"))
		{
			$.getJSON(url,{id:id},function(result){
				if(result==1){
				    $("<div class='successmessage' style='text-align: center;'>删除成功</div>").insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
			    	   //隐藏时把元素删除
			    	   $(this).remove();
			    	}); 
					$("a[deleteid="+id+"]").parents("tr").remove();
				}else{
					$("<div class='errormessage' style='text-align: center;'>删除失败</div>").insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
			    	   //隐藏时把元素删除
			    	   $(this).remove();
			    	}); 
				}
			})
		}
	});
})
</script>