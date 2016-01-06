<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
require(dirname(__FILE__) . '/constant.php');
$basepath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..';
$frontRuntimePath = dirname(dirname(dirname(__FILE__))) . '/runtime/front';
Yii::setPathOfAlias('widgets', $basepath . DIRECTORY_SEPARATOR . 'widgets');
Yii::setPathOfAlias('bootstrap', $basepath . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => $basepath,
    'name' => '由你配',
    // language
    'language' => 'zh_cn',
    // theme
    'theme' => 'default',
    // preloading 'log' component
    'preload' => array('log', 'translate'),
    //'preload' => array('log'),
    'defaultController' => 'site',
    // runtime path
    'runtimePath' => $frontRuntimePath,
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.helpers.*',
        'application.services.*',
        'application.modules.jpdata.components.*',
        'application.modules.jpdata.services.*',
        'application.modules.maker.models.MakeOrgan',
        'application.modules.dealer.models.Dealer',
        'application.modules.servicer.models.Service',
        'application.modules.cms.models.*',
        'application.modules.user.models.*',
        'application.modules.service.models.*',
        'application.modules.user.components.*',
        'application.modules.translate.TranslateModule',
        'application.extensions.PHPExcel.PHPExcel',
        'bootstrap.helpers.TbHtml',
        'application.modules.maker.models.*',
        'application.modules.pap.models.*',
        'application.modules.pap.services.*',
        'application.extensions.YiiMongoDbSuite.*',
        'application.extensions.tcpdf.*',
        'application.extensions.DGSphinxSearch.*',
        'application.extensions.redis.*',
    ),
    //'defaultController'=>'site',
    // path aliases
    'aliases' => array(
        // yiistrap configuration
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change if necessary
    // yiiwheels configuration
    //'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'), // change if necessary
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
            'loginUrl' => array('/user/login'),
            'stateKeyPrefix' => 'front_',
            'loginRequiredAjaxResponse' => 'YII_LOGIN_REQUIRED',
        ),
        // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        // mailer configuration
        'mailer' => array(
            'class' => 'ext.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'page/<key:\w+>' => 'page/index',
                //'themes/default/css/about:blank' => '',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
            'keyPrefix' => 'unipei_cache_',
            'directoryLevel' => 1,
        ),
//    	'cache'=>array(
//    		'class'=>'CXCache',
//    		'keyPrefix' => 'db71c86d',
//    	),
        'session' => array(
            'class' => 'CCacheHttpSession',
            'cookieMode' => 'only',
            'timeout' => 1200
        ),
        'settings' => array(
            'class' => 'application.extensions.CmsSettings',
            'cacheComponentId' => 'cache',
            'cacheId' => 'global_website_settings',
            'cacheTime' => 0,
            'tableName' => '{{admin_settings}}',
            'dbComponentId' => 'jpdb',
            'createTable' => false,
            'dbEngine' => 'InnoDB',
        ),
        'alipay' => array(
            'class' => 'application.vendors.alipay.AlipayProxy',
            'key' => 'ix2s9igfc063qa6djf5vays9kbvq2zy9',
            'partner' => '2088611800244642',
            'return_url' => "http://www.unipei.com/paynotify",
            'notify_url' => "http://www.unipei.com/paynotify/notify",
            'show_url' => '',
        ),
        //经销商采购订单支付宝付款
        'dalipay' => array(
            'class' => 'application.vendors.alipay.AlipayProxy',
            'key' => 'ix2s9igfc063qa6djf5vays9kbvq2zy9',
            'partner' => '2088611800244642',
            'return_url' => "http://www.unipei.com/makernotify",
            'notify_url' => "http://www.unipei.com/makernotify/notify",
            'show_url' => '',
        ),
        //经销商退款服务店支付宝付款
        'returnalipay' => array(
            'class' => 'application.vendors.alipay.AlipayProxy',
            'key' => 'ix2s9igfc063qa6djf5vays9kbvq2zy9',
            'partner' => '2088611800244642',
            'return_url' => "http://www.unipei.com/returnnotify",
            'notify_url' => "http://www.unipei.com/returnnotify/notify",
            'show_url' => '',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    'maxFileSize' => '10240',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                    'categories' => 'order.*,quotation.*,inquiry.*',
                    'logFile' => 'business.log',
                ),
            ),
        ),
        // 合并CSS和JS
        'clientScript' => array(
            'class' => 'application.extensions.EClientScript.EClientScript',
            'combineScriptFiles' => true,
            'combineCssFiles' => true,
            'optimizeScriptFiles' => !YII_DEBUG,
            'optimizeCssFiles' => !YII_DEBUG,
            'optimizeInlineScript' => false,
            'optimizeInlineCss' => false,
            'addFileComment' => false,
            'scriptFileName' => 's.js',
            'cssFileName' => 'c.css',
//            'excludeScriptFiles' => array('jquery.js', 'jquery.min.js'),
            'excludeCssFiles' => array('galleria.classic.css'),
        ),
    ),
    'modules' => array(
        // 脚手架
//        'gii' => array(
//            'class' => 'system.gii.GiiModule',
//            'password' => '123',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//            'ipFilters' => array('127.0.0.1', '::1'),
//        ),
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
        // 消息翻译模块：在前端编辑国际化消息
        'translate',
        // 内容管理模块：广告、公告、客户服务、帮助中心、用户反馈、友情链接等等
        'cms' => array(
            'class' => 'application.modules.cms.CmsModule'
        ),
        // 会员中心模块
        'member' => array(
            'class' => 'application.modules.member.MemberModule'
        ),
        // 生产商模块：商品管理、订单管理、发货等
        'maker' => array(
            'class' => 'application.modules.maker.MakerModule'
        ),
        // 经销商模块：商品查询、下订单等
        'dealer' => array(
            'class' => 'application.modules.dealer.DealerModule'
        ),
        // 修理厂模块：经销商查询等
        'servicer' => array(
            'class' => 'application.modules.servicer.ServicerModule'
        ),
        // 嘉配数据服务模块新版
        'jpdata' => array(
            'class' => 'application.modules.jpdata.JpdataModule',
        //'db' => 'db_epc',
        ),
        // 公共通讯管理模块：业务联系人管理等
        'cim' => array(
            'class' => 'application.modules.cim.CimModule'
        ),
        // 嘉配商城
        'pap' => array(
            'class' => 'application.modules.pap.PapModule'
        ),
        // 帮助中心
        'helpcenter' => array(
            'class' => 'application.modules.helpcenter.HelpcenterModule'
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);
