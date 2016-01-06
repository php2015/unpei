
<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl();?>/css/yxgl.css"/>
<style>
 .yxgl_content2 .fwgl_add{ background-position: 0px -3px}
 table{table-layout:fixed;}   
</style>
<?php 
$this->pageTitle = Yii::app()->name . '-' . "车主管理"; 
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '车主管理',
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl();?>/css/fwgl.css"/>
<style>
    .auto_heights ul li{float:left;}
table{table-layout:fixed;}
</style>
<div class="bor_back m_top10">
<p class="txxx txxx3">车主管理
    <!--<span class="xjd" style="float:right;background-position: 0 -153px;text-indent:25px; line-height:35px"><a href="<?php echo Yii::app()->createUrl('servicer/serviceowner/addowner'); ?>" style="font-weight:400;">添加</a></span>-->
</p>
<p>
    <span class="xjd"style="display:block;float: right;margin-top: -32px; margin-right: 10px;"><a href="<?php echo Yii::app()->createUrl('servicer/serviceowner/addowner'); ?>" style="font-weight:400;">添加</a></span>
</p>

<div class="fwgl_content1a">
	<form action="<?php echo Yii::app()->createUrl('servicer/serviceowner/index');?>" method="post"  target="_self">    
		<p><label class="label1">手机号：</label><input type="text" name="phone" class="width150 input" value="<?php echo $phone;?>">
		<label class="label1 m_left">车主姓名：</label><input type="text" name="name" class="width150 input" value="<?php echo $name;?>">
		<input type="submit" value="查   询"  class="submit m_left" ></p>
	</form>
</div>

<div class="fwgl_content3 m_top10">
<?php
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(// display 'create_time' using an expression
                'name' => '序号',
                'type' => 'raw',
                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                'headerHtmlOptions' => array('style' => 'width:28px;'),
            	//'value' => 'CHtml::encode($data->ID)',
            ),
            array(// display 'author.username' using an expression
                'name' => '登记时间',
                'type' => 'raw',
                'value' => 'CHtml::encode(date("Y-m-d H:i:s",$data->CreateTime))',
                'headerHtmlOptions' => array('style' => 'width:160px;'),
            ),
            array(// display 'author.username' using an expression
                'name' => '车主姓名',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->Name)',
                'headerHtmlOptions' => array('style' => 'width:100px;'),
                'htmlOptions'=>array('style'=>'white-space:nowrap;overflow: hidden;text-overflow:ellipsis')
            ),
            array(// display 'author.username' using an expression
                'name' => '车牌号',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->car)',
                'htmlOptions'=>array('style'=>'word-wrap:break-word;word-break:break-all;')
            ),
            array(// display 'author.username' using an expression
                'name' => '手机号',
                'type' => 'raw',
                'value' => 'CHtml::encode($data->Phone)',
                'headerHtmlOptions' => array('style' => 'width:120px;'),
            ),
            array(
            	// display a column with "view", "update" and "delete" buttons
            	'class' => 'CButtonColumn',
           		'header' => '操作',  
            	'template'=>'{view}{update}{delete}',
		    	'buttons' => array(
			    	'view' => array(
			         	'label' => '详情',
			        	'url' => 'Yii::app()->createUrl("/servicer/serviceowner/detail",array("id"=>$data->ID))'
			    	),
			    	'update' => array(
			         	'label' => '修改',
			        	'url' => 'Yii::app()->createUrl("/servicer/serviceowner/addowner",array("id"=>$data->ID))'
			    	),
			     	'delete' => array(
			    		'lable' => '删除',
			         	'click' => "function(){
			         		if(!confirm('确定要删除这条数据吗？')) return false;
			            	$.ajax({
				            	url:$(this).attr('href'),
				                type:'GET',
				             	dataType:'JSON',
				            	success:function(data)
				           		{
				                	alert(data['errorMsg']);
				                	history.go(0); 
				             	}
			             	});
			        		return false;
			       		}",
			     		'url' => 'Yii::app()->createUrl("/servicer/serviceowner/delowner",array("id"=>$data->ID))',
			    	)
		        ),
                'headerHtmlOptions' => array('style' => 'width:70px;'),
        	),
                    
        ),
    ));
    ?>
</div>
</div>

<!-- 
<div>
    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/serviceowner/index");?>" class="active">车主信息列表</a>
    </div>
    <div class="easyui-layout" id="jp-layout" style="height:500px" >				
        <table id="dg" class="easyui-datagrid" style="height:500px"
               data-options="region:'center',pagination:true,
               rownumbers:true,fitColumns:true,singleSelect:true,
               url:'<?php echo Yii::app()->createUrl("servicer/serviceowner/ownerlist"); ?>',
               method:'get',toolbar:'#tb'">
            <thead>
                <tr>
                    <th field="CreateTime" width="50", align="center">登记时间</th>
                    <th field="Name" width="35" align="center">车主姓名</th>
                    <th field="LicensePlate" width="80" align="center">车牌号</th>
                    <th field="Phone" width="35" align="center">手机号</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="tb" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        &nbsp;手机号: <input class="width98 input" name="Phone">
        &nbsp;车主姓名: <input class="width98 input" name="Name">
        &nbsp;<input class='submit ml10' type='submit' id="search-btn" value='查询'>
    </div>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newOwner()">添加</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editOwner()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyOwner()">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-employee" plain="true" onclick="checkOwner()">车主信息</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-tip" plain="true" onclick="checkCar()">车辆信息</a>
    </div>
</div>
<div id="check_dlg" class="easyui-dialog"  style="width:600px;height:250px;padding:10px 20px"
     closed="true" buttons="#dlg-owners" modal="true">
    <table class="dttable">
        <tr class="fitem" style="height:30px;">
            <td align="right" width=55>车主姓名:</td>
            <td width=185 name="Name"></td>
            <td align="right" width=70>昵称:</td>
            <td width=185 name="NickName"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">性别:</td>
            <td name="Sex"></td>
            <td align="right">驾驶环境:</td>
            <td name="DrivingEnvironment"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">邮箱:</td>
            <td name="Email"></td>
            <td align="right">QQ:</td>
            <td name="QQ"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">电话:</td>
            <td name="Phone"></td>
            <td align="right">驾驶证号:</td>
            <td name="DrivingLicense"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">所在城市:</td>
            <td colspan=3 name="City"></td>
        </tr>
    </table>
    <div id="dlg-owners">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#check_dlg').dialog('close')">取消</a>
    </div>
</div>
<div id="check_car_dlg" class="easyui-dialog" style="width:600px;height:320px;"
     closed="true" buttons="#dlg-cancels" modal="true">
    <table id="allcar" class="easyui-datagrid" data-options="		            
           pagination:false,border:false,rownumbers:true,fitColumns:true,
           fit:true,singleSelect:true,method:'get'">
        <thead>
            <tr>
                <th field="LicensePlate" width="25" align="center">车牌号</th>
                <th field="VehicleLicense" width="25" align="center">行驶证号</th>
                <th field="Category" width="20" align="center">使用性质</th>
                <th field="BuyTime" width="30" align="center">购置时间</th>
                <th field="Mileage" width="30" align="center">行驶里程(km)</th>
                <th field="VinCode" width="30" align="center">车架号/VIN码</th>
                <th field="CarBrand" width="50" align="center">汽车品牌</th>
            </tr>
        </thead>
    </table>	
    <div id="dlg-cancels">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#check_car_dlg').dialog('close')">取消</a>
    </div>
</div>
<?php //$this->renderPartial('add', array()); ?>
<?php //$this->renderPartial('edit', array()); ?>
<script>
    $(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/servicer/serviceowner/ownerlist';
            var licenseplate = $("input[name=LicensePlate]").val();
            var phone = $("input[name=Phone]").val();
            var name = $("input[name=Name]").val();	
            $('#dg').datagrid({ url:url,queryParams:{
                    'licenseplate':licenseplate,
                    'phone':phone,
                    'name':name    	
                },method:"get"});
        });		
    });
    function checkOwner()
    {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            var ID = row.ID.toString();
            $('#check_dlg').dialog('open').dialog('setTitle','查看车主信息');
            $("td[name=Name]").text(row.Name);
            $("td[name=NickName]").text(row.NickName);
            if (row.Sex == '1')
                $("td[name=Sex]").text("男");
            else if (row.Sex == '2')
                $("td[name=Sex]").text("女");
            if (row.DrivingEnvironment == "1")
                $("td[name=DrivingEnvironment]").text("市区");
            else if(row.DrivingEnvironment == "2")
                $("td[name=DrivingEnvironment]").text("高速");
            else if(row.DrivingEnvironment == "3")
                $("td[name=DrivingEnvironment]").text("郊区");
            $("td[name=DrivingLicense]").text(row.DrivingLicense);
            $("td[name=Phone]").text(row.Phone);
            $("td[name=City]").text(row.City); 
            $("td[name=Email]").text(row.Email);
            $("td[name=QQ]").text(row.QQ);
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要查看的车主信息!'
            });
        }	
    } 
    function checkCar()
    {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            if(row.LicensePlate == undefined) {
            	$.messager.show({
                    title: '警告',
                    msg: '暂无车辆信息!'
                });
            }
            else {
	            $('#check_car_dlg').dialog('open').dialog('setTitle','查看车辆信息');
	            var ID = row.ID.toString();
	            $('#allcar').datagrid({ 
	                url:Yii_baseUrl + "/servicer/serviceowner/allcar",
	                queryParams:{'ID':ID},
	                method:"post"
	            });
            }
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要查看的车辆信息!'
            });
        }	
    }
    function destroyOwner(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('确认','您确定要删除这个车主？',function(r){
                if (r){
                    $.post(Yii_baseUrl + "/servicer/serviceowner/destroy",{id:row.ID},function(result){
                        if (result.success){
                            $('#dg').datagrid('reload'); // reload the user data
                            $('#nobanding').combogrid('grid').datagrid('reload'); // reload the user data
                            $('#nobandingcar').combogrid('grid').datagrid('reload'); // reload the user data
                        } else {
                            $.messager.show({
                                title: '错误',
                                msg: result.errorMsg
                            });
                        }
                    },'json');
                }
            });
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要删除的车主信息!'
            });
        }
    }
</script> -->