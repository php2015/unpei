<?php
header("Content-type:text/html;charset=utf-8");
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
//$cs->registerScriptFile($resourceUrl . '/js/jquery-1.8.1.min.js', CClientScript::POS_HEAD);
// 加载js
$resourceUrl = Yii::app()->theme->baseUrl;
$cs->registerCssFile($resourceUrl . '/css/login/login.css');
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
        <meta content="text/html;charset=utf-8" http-equiv="content-type">
        <meta name="Keywords" content="由你配、嘉配服务平台、汽配交易平台、山东汽配采购平台">
        <meta name="description" content="由你配汽配交易平台是北京嘉配科技有限公司为中国汽配后市场量身定制的优质汽配交易平台，目前此平台上汇集了山东省大量的优质全车件经销商及修理厂，修理厂可以通过此平台查询车型信息、配件信息、快速精准采购、形成订单；">
        <link rel="icon" href="<?php echo F::themeUrl(); ?>/images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo F::themeUrl(); ?>/images/favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <?php 
        $controller=Yii::app()->controller->id;
        $con_arr=array('activation','activecompany');
        ?>
        <div class="header">
            <div class="logo"><a href='<?php if(in_array($controller,$con_arr)){
                echo Yii::app()->createUrl('user/logout') ;
            }else{  echo Yii::app()->createUrl('user/login'); }?>'><img style="border:none" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/login/logo.png"></a></div>
            <div class="help">
                <span><a href="<?php echo Yii::app()->createUrl('user/login/lnk'); ?>">桌面快捷</a></span>
                <span ><a href="http://wpa.qq.com/msgrd?v=3&uin=3083702943&site=qq&menu=yes;" target="_blank">在线客服</a>
                </span>
                <span style="border:none;padding-left:5px">
                    <img src="<?php echo Yii::app()->theme->baseUrl . "/images/tel.png" ?>" width="18px" height="18" style="vertical-align:middle; margin-top:-3px;margin-right: 2px">
                    <span style="border:none;font-size:13px">400 0909 839</span>
                </span>
            </div>
        </div>
        <?php echo $content; ?>
        <?php $this->widget("widgets.default.WFootMenu") ?>
    </body>
</html>