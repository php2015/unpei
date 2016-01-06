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
$cs->registerScriptFile($resourceUrl . '/js/help/style.js', CClientScript::POS_HEAD);
// 加载css
$cs->registerCssFile($resourceUrl . '/css/help/commom.css');
$cs->registerCssFile($resourceUrl . '/css/help/index.css');
//$cs->registerCssFile($resourceUrl . '/css/pap/index.css');
// <!--[if gte IE 7]>
// <link rel='stylesheet' href='/css/ie67.css'/>
// <![endif]-->
//$cs->registerCssFile($resourceUrl.'/css/ie67.css', 'gte IE 7');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible" />
        <meta content="text/html;charset=utf-8" http-equiv="content-type" />
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
        <div class="ui-container" id="scren">
            <div class="global-head">
                <div class="global-head-area">
                    <div class="logo float_l"><a href=""><img src="<?php echo F::themeUrl(); ?>/images/login/logo.png"></a></div>
                    <div class="float_l width180">
                        <a href="" class="float_l"><img src="<?php echo F::themeUrl(); ?>/images/help.jpg"></a>
                    </div>
                    <div class="global-toplink float_r">
                        <div class="float_l customer">
                            <?php echo Yii::app()->user->getLogTitle(); ?>
                        </div>
                        <em>&nbsp;&nbsp;|</em>
                        <!--                        <a href="">登录</a>
                                                <em>|</em>-->

                        <?php
                        //只有修理厂登录才会显示由你配    
                        $organID = Yii::app()->user->getOrganID();
                        $JpdOrgan = Organ::model()->findByPk($organID);
                        if ($JpdOrgan['Identity'] == 3):
                            ?>
                            <a href="<?php echo Yii::app()->createUrl('pap/home/index') ?>" target=_blank>由你配首页</a>  <em>|</em>
                        <?php endif; ?>

                        <a href="<?php echo Yii::app()->createUrl('helpcenter/home/kefu') ?>">在线客服</a><em>|</em>
                    </div>
                    <div class="clear"> </div>
                </div>
                <div class="nav">
                    <ul>
                        <li <?php if (Yii::app()->getController()->getRoute() == 'helpcenter/home/index') echo 'class="current"' ?>>
                            <a href="<?php echo Yii::app()->createUrl('helpcenter/home/index') ?>">首页</a>
                        </li>
                        <li <?php if (Yii::app()->getController()->getRoute() == 'helpcenter/home/question' || Yii::app()->getController()->getRoute() == 'helpcenter/home/searchlist') echo 'class="current"' ?>>
                            <a href="<?php echo Yii::app()->createUrl('helpcenter/home/question') ?>">常见问题</a>
                        </li>
                        <li <?php if (Yii::app()->getController()->getRoute() == 'helpcenter/home/addquestion' || Yii::app()->getController()->getRoute() == 'helpcenter/home/addquestion2' || Yii::app()->getController()->getRoute() == 'helpcenter/home/addquestion3') echo 'class="current"' ?>>
                            <a href="<?php echo Yii::app()->createUrl('helpcenter/home/addquestion') ?>">提交问题</a>
                        </li>
                        <li <?php if (Yii::app()->getController()->getRoute() == 'helpcenter/home/video') echo 'class="current"' ?>><a href="<?php echo Yii::app()->createUrl('helpcenter/home/video') ?>">视频教学</a></li>
                        <li <?php if (Yii::app()->getController()->getRoute() == 'helpcenter/home/kefu') echo 'class="current"' ?>><a href="<?php echo Yii::app()->createUrl('helpcenter/home/kefu') ?>">联系客服</a></li>


                        <?php if ($JpdOrgan['Identity'] == 3): ?>
                            <li><a  target="_blank"href="<?php echo Yii::app()->createUrl("servicer/default/newer", array('goto' => 'newerindex')) ?>">新手入门</a></li>
                        <?php endif; ?>
                        <li <?php if (Yii::app()->getController()->getRoute() == 'helpcenter/home/rule') echo 'class="current"' ?>><a href="<?php echo Yii::app()->createUrl('helpcenter/home/rule') ?>">平台规则</a></li>
                        <!--<li><a href="">新手入门</a></li>-->
                    </ul>
                </div>  
            </div>
            <!-- content -->
            <div class='content'>
                <?php echo $content; ?>
                <div class="sidebar-show" style="display: none;"></div>		
            </div><!-- content -->
        </div>
        <?php $this->widget("widgets.default.WFootMenu") ?>
        <script>
            var screenheight = document.documentElement.clientHeight;
            $('#scren').css('min-height', screenheight - 105);
        </script>

    </body>
</html>
