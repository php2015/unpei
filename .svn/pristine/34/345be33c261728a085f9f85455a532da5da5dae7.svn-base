<?php
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
date_default_timezone_set('Asia/Shanghai');
defined('YII_DEBUG') or define('YII_DEBUG',true);
// defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
// including Yii
require_once(dirname(dirname(dirname(__FILE__))).'/../framework/Yii/yii.php');
// we'll use a separate config file
//$configFile=dirname(dirname(__FILE__)).'/config/console.php';
$local=require(dirname(dirname(__FILE__)).'/config/main-local.php');
$base=require(dirname(dirname(__FILE__)).'/config/console.php');
$config=CMap::mergeArray($base, $local);
// creating and running console application
Yii::createConsoleApplication($config)->run();
?>