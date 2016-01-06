<?php
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$frontRuntimePath = dirname(dirname(dirname(__FILE__))) .'/runtime/front';
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	'runtimePath'=> $frontRuntimePath,
	'import' => array (
		'application.models.*',
		'application.components.*',
		'application.modules.dealer.models.DealerGoods',
		'application.modules.partner.models.*',
		'application.modules.user.models.*',
		'application.modules.mall.models.JpOrder',
	),
	'components' => array (			
		'log' => array (
			'class' => 'CLogRouter',
			'routes' => array (
				array (
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
					'maxFileSize' => '10240',
					'logFile'=> 'command.log',
				),
				array (
					'class' => 'CFileLogRoute',
					'levels' => 'trace, info',
					'categories' => 'command.*, system.db.*',
					'maxFileSize' => '10240',
					'logFile'=> 'command.log',
				),
			),
		),
	),		
	'modules' => array (
		// 用户模块：用户注册、登录、找回密码等，支持邮箱验证
		'user' => array(
			'class' => 'application.modules.user.UserModule',
			# encrypting method (php hash function)
			'hash' => 'md5',
			# send activation email
			'sendActivationMail' => false,
			# allow access for non-activated users
			'loginNotActiv' => false,
			# activate user on registration (only sendActivationMail = false)
			'activeAfterRegister' => true,
			# automatically login from registration
			'autoLogin' => false,
			# registration path
			'registrationUrl' => array('/user/agreement'),
			# recovery password path
			'recoveryUrl' => array('/user/recovery'),
			# login form path
			'loginUrl' => array('/user/login'),
			//'loginUrl' => array('/site/index'),
			# page after login
			//'returnUrl' => array('/user/profile'),
			'returnUrl' => array('/site/index'),
			# page after logout
			'returnLogoutUrl' => array('/user/login'),
		),	
	),	
);