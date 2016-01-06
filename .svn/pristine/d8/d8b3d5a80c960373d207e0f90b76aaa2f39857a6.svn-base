<?php $this->beginContent('//layouts/base'); ?>
<div id="content1" class="content1 " >
    <?php if (Yii::app()->user->isGuest): ?>
        <!-- 未登录时，登陆页面样式 ,不包含content2样式-->
        <div>
            <?php echo $content; ?>
        </div>
        <!-- 登陆之后 包含content2 -->
    <?php else: ?>
        <!--头部导航栏-->
        <?php $this->widget('widgets.default.WNavbar'); ?>
        <!--左边工具栏导航-->
        <div class="icon-text-info">
            <?php $this->widget('widgets.default.WSliderbar'); ?>
            <div class="float_r w880 m_left20" style="min-height:600px">
                <div class="content2" >
                    <?php $this->widget('widgets.default.WBreadcrumbs', array('links' => $this->breadcrumbs,)); ?>
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $this->endContent(); ?>
<!--<script>
var a = $("#content1").outerHeight(true);
var b = $("#content_left").outerHeight(true);
if (b < a) {
    $("#content_left").css("height", a);
}
</script>-->
