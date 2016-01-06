<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
$backend = dirname(dirname(__FILE__));
$frontend = dirname($backend);
$root = dirname($frontend);
$backendRuntimePath = $root .'/runtime/backend';
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('frontend', $frontend);
Yii::setPathOfAlias('backend', $backend);
Yii::setPathOfAlias('bootstrap', $frontend . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'bootstrap');


$frontendArray=require_once($frontend.'/config/main.php');
unset($frontendArray['components']['user']);

return CMap::mergeArray($frontendArray,array(
    'basePath' => $frontend,
    'name' => '后台管理系统',
    'language' => 'zh_cn',
    'theme' => 'backend',
    'controllerPath' => $backend . '/controllers',
    'viewPath' => $backend . '/views',
    'runtimePath' => $backendRuntimePath,
    // preloading 'log' component
    'preload' => array('log', 'bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.pap.services.LogisticsService',
    	'backend.models.*',
    	'backend.components.*',    		
        'bootstrap.helpers.TbHtml',
    ),
    'modules' => array(
//        'auth' => array(
//            'class' => 'backend.modules.auth.AuthModule' // Path to module in backend.
//        ),
        'plugin' => array(
            'class' => 'application.modules.plugin.PluginModule',
            'pluginRoot' => 'application.plugin', # 插件目录，默认为 application.plugin
            // 'layout' => ''		# 后台插件管理页面主layout文件,默认为 //layouts/main
        ),
    ),
    // application components
    'components' => array(
        'request' => array(
            'enableCsrfValidation' => true,
            'enableCookieValidation' => true,
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            //'loginUrl' => array('/site/login'),
            'stateKeyPrefix' => 'back_',
            'class' => 'backend.components.BackendUser',
        ),
        'themeManager' => array(
            'basePath' => $root . '/themes',
        ),
        // uncomment the following to enable URLs in path-format
//        'authManager' => array(
//            'class' => 'CDbAuthManager', // Provides support authorization item sorting.
//            'connectionID' => 'db',
//            'itemTable' => '{{admin_authitem}}',
//            'itemChildTable' => '{{admin_authitemchild}}',
//            'assignmentTable' => '{{admin_authassignment}}',
//            'behaviors' => array(
//                'auth' => array(
//                    'class' => 'auth.components.AuthBehavior',
//                    'admins' => array('admin'), // users with full access
//                ),
//            ),
//        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => true,
            'rules' => array(
                '<_c:\w+>/<id:\d+>' => '<_c>/view',
                '<_c:\w+>/<_a:\w+>/<id:\d+>' => '<_c>/<_a>',
                '<_c:\w+>/<_a:\w+>' => '<_c>/<_a>',
            ),
        ),
        'plugin' => array(
            'class' => 'application.modules.plugin.components.HookRender', # HookRender 文件目录
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require($backend.'/config/params.php'),
));