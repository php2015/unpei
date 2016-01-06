<?php
header("Content-type:text/html;charset=utf-8");
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
$action = $this->getAction()->getId();
// 加载js
$resourceUrl = Yii::app()->theme->baseUrl;
$cs->registerCssFile($resourceUrl . '/css/login/com.css');
if ($action != 'service')
    $cs->registerCssFile($resourceUrl . '/css/login/union.css');
$cs->registerCssFile($resourceUrl . '/css/login/service.css');
$cs->registerCssFile($resourceUrl . '/css/jpd/table.css');
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
        <meta content="text/html;charset=utf-8" http-equiv="content-type">
        <?php if ($action == 'service'): ?>
            <meta name="Keywords" content="由你配、由你配产品介绍、由你配经销商服务介绍、由你配修理厂服务介绍、由你配生产商服务介绍、嘉配服务平台">
            <meta name="description" content="由你配产品服务分配件生产商、配件经销商及修理厂三大模块，各模块针对不同群体定制了特有的功能。">
        <?php elseif ($action == 'union'): ?>
            <meta name="Keywords" content="由你配、山东汽配经销商联盟、济南配件经销商联盟、奇瑞配件经销商、大众配件经销商、通用配件经销商、东风日产配件经销商、东风雪铁龙配件经销商">
            <meta name="description" content="由你配-山东汽配经销商联盟成立于2014年7月，目前汇集了奇瑞、上海大众、上海通用、东风雪铁龙、东风日产等全车件经销商。">
        <?php elseif ($action == 'service'): ?>
        <?php endif; ?>
        <link rel="icon" href="<?php echo F::themeUrl(); ?>/images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo F::themeUrl(); ?>/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <div class="header">
            <div class="header_info">
                <div class="logo float_l"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/login/logo.png"></div>
                <div class="help float_r">
                    <span><a href="<?php echo Yii::app()->createUrl('user/login'); ?>"><?php if (Yii::app()->user->isGuest): ?>登录<?php else: ?>工作台<?php endif; ?></a></span>
                    <span><a href="http://w.x.baidu.com/alading/anquan_soft_down_b/14744">谷歌浏览器下载</a></span>
                    <span><a href="<?php echo Yii::app()->createUrl('user/login/lnk'); ?>">桌面快捷</a></span>
                    <span style="border:none"><a href="http://wpa.qq.com/msgrd?v=3&uin=3083702943&site=qq&menu=yes;" target="_blank">在线客服</a></span>
                </div>
            </div>
        </div>
        <?php echo $content; ?>
        <?php $this->widget("widgets.default.WFootMenu") ?>
    </body>
</html>