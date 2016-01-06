<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="language" content="en"/>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->getClientScript()->registerCssFile(F::themeUrl() . '/css/styles.css'); ?>
    </head>
    <script type="text/javascript">
        var Yii_baseUrl = "<?php echo F::baseUrl(); ?>";
        var Yii_theme_baseUrl = "<?php echo F::themeUrl(); ?>";
    </script>
    <body screen_capture_injected="true">

        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'color' => TbHtml::NAVBAR_COLOR_INVERSE,
            'brandLabel' => '后台管理',
            'collapse' => true,
        ));
        ?>

        <div class="container-fluid" id="page">

            <?php echo $content; ?>

            <div class="clear"></div>

            <footer>
                <div class="row-fluid">
                    <div class="span12">
                        <p class="powered"><?php echo Yii::powered(); ?>
                            / <?php echo CHtml::link('Jiaparts', 'http://www.jiaparts.com'); ?>
                            <span class="copy">Copyright &copy; <?php echo date('Y'); ?> by <?php echo F::sg('site', 'name'); ?>
                                . All Rights Reserved.</span>
                        </p>
                    </div>
                </div>
            </footer>
            <!-- footer -->

        </div>
        <!-- page -->

    </body>
</html>
