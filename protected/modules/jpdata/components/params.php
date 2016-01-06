<?php

// this contains the application parameters that can be maintained via GUI
return array(
	'title'=>'嘉配服务平台',
	// Memecache缓存服务
	'memcache'=>array(
		'enable'=>false,
		'servers'=>array('127.0.0.1:11211',),
		'compressed'=>'1',
		'expire'=>'300',
	),	
	// 用户车型数据查询权限控制
	'permission'=>array(
		'enable'=>false,
	),
	// YII表单校验参数
	'clientOptions'=>array(
		'validateOnSubmit' => true,
		'errorCssClass' => 'yiierror',
		'successCssClass' => 'yiisuccess',
		'validatingCssClass' => '',
		'afterValidateAttribute'=>"js:function(form, attribute, data, hasError){
            var id = attribute.id;
	        if(hasError){
				$('#'+id).addClass('error');
	            $('#'+id).parent().children('span.txt-tips').hide();
				$('#'+id).parent().children('span.txt-succ').hide();
	        }else{
				$('#'+id).removeClass('error');
				$('#'+id).parent().children('span.txt-tips').hide();
				$('#'+id).parent().children('span.txt-succ').show();
			}
        }",
	),	
	// 页面标题
	'pagetitle'=>array(
		'site'=>array(
			'index'=>'首页',
			'login'=>'登录',
			'register'=>'注册',
			'signup'=>'注册',
			'findpassword'=>'重置密码',
			'error'=>'错误',
		),
		'user'=>array(
			'index'=>'个人中心',
			'recharge'=>'充值',
			'purchase'=>'购买服务',
			'info'=>'资料修改',
			'password'=>'重置密码',
			'question'=>'密码提示问题',
		),
		'vehicle'=>array(
			'index'=>'前市场车型查询',
		),
		'parts'=>array(
			'index'=>'EPC配件查询',
		),
		'maintenance'=>array(
			'index'=>'车辆养护周期查询',
		),
	),	
);