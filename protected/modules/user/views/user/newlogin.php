<style>
    #yw0_button{font-size:12px; color:#00b6ff}
    .m_left35{margin-right:-2px;margin-left: 35px}
    img{ border:0;}
    #slides {position: relative;width: 550px;height: 415px;float:left;}
    .slides_container {overflow:hidden;position:relative;display:none;width: 550px;height: 415px;}
    .slides_container div.slide {width: 550px;height: 415px;display:block;}
    .slides_container img {width: 550px;height:415px;display: block;}
    #slides .prev {margin-right: 5px;float:left;}
    #slides .next {margin-right: 5px;float:left;}
    .pagination {margin:6px 0 0;list-style: none;z-index:9999;position: absolute;bottom:70px;left:200px;}
    .pagination li {float: left;margin: 0 3px;}
    .pagination li a {display: block;width: 10px;height: 10px;float: left;overflow: hidden;background:#fff;color:#fff}
    .pagination li.current a, .pagination li.current a:hover { background:#fee648;color:#fee648}
    .pagination li a:hover { background: #fee648}
    .ie7{ width:100%;background:#666; margin:0 auto; height:50px; line-height:50px; position:fixed; bottom:0px; min-width:1000px}
    .ie7-info{ width:1000px;background:#666; margin:0 auto; text-align:center;font-size:12px;height:50px;line-height:50px;}
    #UserLogin_rememberMe{ border:none}
</style>
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/slides.jquery.js' ?>"></script>
<?php
$this->pageTitle = '由你配 - 汽配交易平台 | 嘉配服务平台';
?>
<div class="contents">
    <div id="slides" class="s_lb">
        <div class="slides_container">
<!--            <div class="slide"><a href="<?php echo Yii::app()->createUrl('site/promition') ?>" target="_blank"><img src="<?php //echo Yii::app()->theme->baseUrl . '/images/promotion/huodong.png' ?>"/></a></div>-->
            <div class="slide"><a href="<?php echo Yii::app()->createUrl('/user/login');?>" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/huodong1.png' ?>"/></a></div>
        </div>
    </div>
    <div class="login">
        <div class="user">
            <div style="margin-left:85px;height:20px" class="errorSummary">
                <?php
                if ($model->hasErrors('verifyCode')) {
                    ?>
                    <span style="color:red;font-size: 12px"><?php echo $model->getError('verifyCode'); ?></span>
                    <?php
                } else if ($model->hasErrors('username')) {
                    ?>
                    <span style="color:red;font-size: 12px"><?php echo $model->getError('username'); ?></span>
                    <?php
                } else if ($model->hasErrors('password')) {
                    ?>
                    <span style="color:red;font-size: 12px"><?php echo $model->getError('password'); ?></span>
                    <?php
                } else if ($model->hasErrors('status')) {
                    ?>
                    <span style="color:red;font-size: 12px"><?php echo $model->getError('status'); ?></span>			
                    <?php
                }
                ?>
            </div>
            <?php echo CHtml::beginForm(Yii::app()->getModule('user')->loginUrl); ?>
            <p>
                <span class="leabl m_left20">用户名：</span> 
                <?php echo CHtml::activeTextField($model, 'username', array('class' => 'width214 input')); ?>
            </p>
            <p class="m-top15">
                <span  class="leabl  m_left35">密码：</span> 
                <?php echo CHtml::activePasswordField($model, 'password', array('class' => 'width214 input','style'=>'margin-left:6px')); ?>
            </p>
            <p class="m-top15">
                <?php if (Yii::app()->session['login_error_times'] >= 3): ?>
                <div class='form-row'>
                    <span  class="leabl  m_left20">验证码：</span>
                    <?php echo CHtml::activeTextField($model, 'verifyCode', array('class' => 'input  width80')); ?>
                    <?php
                    $this->widget('CCaptcha', array(
                        'captchaAction' => '/user/login/captcha',
                        'showRefreshButton' => true,
                        'clickableImage' => false,
                        'buttonLabel' => '换一张',
                        'imageOptions' => array('align' => 'absmiddle'),
                    ));
                    ?>
                </div>
            <?php endif; ?>
            </p>
            <p style="margin-top:10px">
                <span  class="leabl" style="padding-left:6px">保持登录：</span>
                <?php echo CHtml::activeCheckBox($model, 'rememberMe', array('class' => 'checkbox')); ?>
            </p>
            <p style="text-align:center" class="m-top15">
                <?php echo CHtml::submitButton('', array('class' => 'button', 'style' => '')); ?>
            </p>
            <p style="text-align:center" class="m-top15"><a href="<?php echo Yii::app()->createUrl('/user/recovery/recovery'); ?>" style="color:#00b6ff; font-size:14px;">忘记密码</a><a href="<?php echo Yii::app()->createUrl('member/introduce/join'); ?>" style="margin-left:20px; font-size:14px; color:#343434">如何加入</a></p>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>
<div class="info">
    <p class="adv"></p>
    <div class="adv_info">
        <div class="advantage">
            <span>由你配平台提供精准的配件、车型数据查询服务及配件在线快速订购服务</span>
        </div>
        <div class="link float_r">
            <a href="<?php echo Yii::app()->createUrl('member/introduce/service'); ?>" target="_blank" title="点击查看由你配服务介绍"><div class="float_l service"></div></a>
            <a href="<?php echo Yii::app()->createUrl('member/introduce/union'); ?>" target="_blank" title="点击查看由你配山东汽配经销商联盟介绍"><div class="float_l union"></div></a>
            <a href="http://www.jiaparts.com" title="点击查看嘉配公司介绍" target="_blank"><div class="float_l jiapei"></div></a>
        </div>
        <div style="clear:both"></div>
    </div></div>
<script type="text/javascript">
    $(function() {
         $('form').submit(function() {
            $('.errorSummary').html('');
            var username = $("#UserLogin_username").val();
            var password = $("#UserLogin_password").val();
            var verifyCode = $("#UserLogin_verifyCode").val();
            if (username == '') {
                $('.errorSummary').html('<span style="color:red;font-size: 12px">用户名不能为空.</span>');
                $("#UserLogin_username").focus();
                return false;
            }
            if (password == '') {
                $('.errorSummary').html('<span style="color:red;font-size: 12px">密码不能为空.</span>');
                $("#UserLogin_password").focus();
                return false;
            }
            if (verifyCode == '') {
                $('.errorSummary').html('<span style="color:red;font-size: 12px">验证码不能为空.</span>');
                $("#UserLogin_verifyCode").focus();
                return false;
            }
            return true;
        });
    });
    $("#slides").slides({
        preload: true,
        preloadImage: 'images/loading.gif',
        play: 3000,
        pause: 100,
        hoverPause: true
    });
    var mw = $(".mbox").width()+10;
    var ml = $(".mbox").length;	
    $(".themes").width(mw*ml);
    $(".t_menu li").mouseover(function(){
        var index = $(this).index();
        $(".themes").animate({left:-mw*index,opacity:1},500);
    })
</script>

