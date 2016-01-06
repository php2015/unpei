<?php
header("Content-type:text/html;charset=utf-8");
$cs = Yii::app()->clientScript;
//$cs->registerCoreScript('jquery');
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
//// 加载js
$resourceUrl = Yii::app()->theme->baseUrl;
////$cs->registerScriptFile($resourceUrl . '/js/jquery.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($resourceUrl . '/js/jquery.tmpl.js', CClientScript::POS_HEAD);

// 加载css
//$cs->registerCssFile($resourceUrl . '/css/newhome/com.css');
//$cs->registerCssFile($resourceUrl . '/css/pap/index.css');

// <!--[if gte IE 7]>
// <link rel='stylesheet' href='/css/ie67.css'/>
// <![endif]-->
//$cs->registerCssFile($resourceUrl.'/css/ie67.css', 'gte IE 7');
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
        var Yii_baseUrl="<?php echo F::baseUrl(); ?>";
        var Yii_jpdataUrl='<?php echo F::baseUrl() . '/jpdata'; ?>';
    </script>
<!--    <script type="text/javascript">
        var Yii_baseUrl = "<?php echo F::baseUrl(); ?>";
        var Yii_jpdataUrl='<?php echo F::baseUrl() . '/jpdata'; ?>';
        var Yii_jpdata_baseUrl = "<?php echo Yii::app()->createUrl('/jpdata'); ?>";
        var Yii_theme_baseUrl = "<?php echo F::themeUrl(); ?>";
        var Yii_uploadUrl = "<?php echo F::uploadUrl(); ?>";
    </script>-->
    <body>
        <div class="wrapper" id='scren'style="  min-height:100%;
            height: auto !important;
            height: 100%;position:relative">
            <!-- header 头部 -->
            <div class="header">
                <?php $this->widget('widgets.papmall.MTopNav'); ?>
                <!--客服悬浮框-->
                <?php 
                $controller= Yii::app()->controller->id;
                $action=$this->getAction()->id;
                if(($controller=='home'&&$action=='index') ||($controller=='mall'&&$action=='index') ||($controller=='mall'&&$action=='search')):
                   // $this->widget('widgets.papmall.MPhoneCall');
                else:
                ?>
                <?php $this->widget('widgets.default.WCustomerService'); endif;?>
            </div>
            <!-- /header -->
            <!-- content 内容-->
            <div class="contents">
                <div  class="content_info"  >
                    <?php echo $content; ?>
                </div>
            </div>
            <a id="moquu_top" href="javascript:void(0)"></a>
            <!-- 底部 -->
             <?php $this->widget("widgets.default.WFootMenu")?>
        </div>
        <script>
            var screenheight=document.documentElement.clientHeight;
            $('#scren').css('min-height',screenheight);
        </script>
    </body>
</html>