<?php
header("Content-type:text/html;charset=utf-8");
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
// ajax请求时session过期后跳转到登录页面
if (Yii::app()->components['user']->loginRequiredAjaxResponse) {
    $cs->registerScript('ajaxLoginRequired', '
            jQuery("body").ajaxComplete(
                function(event, request, options) {
                    if (request.responseText == "' . Yii::app()->components['user']->loginRequiredAjaxResponse . '") {
                        window.location.href = "' . Yii::app()->createUrl('/user/login') . '";
                    }
                }
            );
        ');
}

// 加载js
$resourceUrl = Yii::app()->theme->baseUrl;
//$cs->registerScriptFile($resourceUrl . '/js/jquery-1.8.1.min.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/jquery-eleMid.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/jquery.tmpl.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/backtop/js/scrolltop.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/jquery.easytabs.min.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/jquery.hashchange.min.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/jExpand.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/galleria-1.3.1.min.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/galleria.classic.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/jpd/tab.js', CClientScript::POS_HEAD);



$cs->registerCssFile($resourceUrl . '/css/jpd/table.css');
$cs->registerCssFile($resourceUrl . '/css/jpd/page.css');
$cs->registerCssFile($resourceUrl . '/css/newhome/com.css');
$cs->registerCssFile($resourceUrl . '/css/newhome/top.css');
//$cs->registerScriptFile($resourceUrl . '/js/newhome/style.js', CClientScript::POS_HEAD);
if (Yii::app()->user->isMaker())
    $cs->registerCssFile($resourceUrl . '/css/jpd/scs.css');
if (Yii::app()->user->isDealer())
    $cs->registerCssFile($resourceUrl . '/css/jpd/jxs.css');
if (Yii::app()->user->isServicer())
    $cs->registerCssFile($resourceUrl . '/css/jpd/fwd.css');
    $cs->registerCssFile($resourceUrl . '/css/jpd/common.css');

$cs->registerCssFile($resourceUrl . '/css/galleria.classic.css');
$cs->registerCssFile($resourceUrl . '/css/jpd/form.css');
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
        <meta content="text/html;charset=utf-8" http-equiv="content-type">
        <link rel="icon" href="<?php echo F::themeUrl(); ?>/images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo F::themeUrl(); ?>/images/favicon.ico" type="image/x-icon" />
    </head>
    <script type="text/javascript">
        var Yii_baseUrl = "<?php echo F::baseUrl(); ?>";
        var Yii_jpdataUrl = '<?php echo F::baseUrl() . '/jpdata'; ?>';
        var Yii_jpdata_baseUrl = "<?php echo Yii::app()->createUrl('/jpdata'); ?>";
        var Yii_theme_baseUrl = "<?php echo F::themeUrl(); ?>";
        var Yii_uploadUrl = "<?php echo F::uploadUrl(); ?>";
    </script>
    <body>
        <div class="wrapper" id='scren'style="  min-height:100%;
             height: auto !important;
             height: 100%;position:relative;width:100%">
            <!-- header -->
            <?php if(Yii::app()->user->isServicer()):?>
            <div class="header">
                <?php $this->widget('widgets.papmall.MTopNav'); ?>
            </div>
             <?php //$this->widget('widgets.papmall.MPhoneCall'); ?>
            <?php else:?>
            <div class="header">
                <?php $this->widget('widgets.default.WTopNav'); ?>
            </div>
              <?php endif?>
             <?php //$this->widget('widgets.papmall.MPhoneCall'); ?>
            <!-- /header -->
            <!-- content -->
            <div class="contents">
                <?php echo $content; ?>
                <div style="clear:both"></div>
            </div>
            <a id="moquu_top" href="javascript:void(0)"></a>
            <!-- /content -->
            <?php $this->widget("widgets.default.WFootMenu") ?>
    </body>
</html>