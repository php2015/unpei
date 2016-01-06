<?php
$this->pageTitle = Yii::app()->name . ' - 恢复';
?>
<style>
    .tabs{ border-style: solid;border-width: 0 0 1px;height: 30px;list-style-type: none;margin: 0;line-height:30px;background: none repeat scroll 0 0 #f3f3f3;border-bottom: 1px solid #e2e2e2; width:auto}
    .active{ padding:7px 15px ; background:#fff; margin-left:50px; color: #2379c6;font-size: 14px;font-weight: bold; border-left:1px solid #e2e2e2;border-right:1px solid #e2e2e2}
    .auto_height:after {clear: both;content: "clear";display: block;height: 0;overflow: hidden;visibility: hidden;}
    .msg-success {background: url("<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/icon-login-ok.png") no-repeat scroll 30% center rgba(0, 0, 0, 0);line-height: 2em;padding: 2em 0 1.5em 38%;}
    #yw0_button{font-size:12px; color:#00b6ff}
</style>
<div style='height:2px; background:#2379c6; width:auto'></div>
<div class='width998 content-row home-row auto_height bd1 bor_back m_top10' style="width:980px; margin:10px auto; border:1px solid #ccc; background:#fff">
    <div class="tabs" pre="tab">
        <a style="margin-left:-30px;"> </a>
        <a class="active" href="#">恢复</a>
    </div>
    <div class="findPwd" style="margin:0 auto;margin-top: 20px">
        <div class="find" style="width:100%">
            <div style="width:93%; margin:0 auto;">
                <?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
                    <div class="one" style="float:left;  position:relative; ">
                        <img src="<?php echo F::themeUrl(); ?>/images/one_.jpg" style="margin-left:8px"/>
                        <span style="position:absolute;left:16px;top:3px; font-family:'微软雅黑'; color:white"><b>1</b></span>
                        <div style=" color:#E8996E; font-size:12px; padding-top:5px"><b>输入账户名</b></div>
                    </div>
                    <div class="one" style="float:left;position:relative;">
                        <img src="<?php echo F::themeUrl(); ?>/images/one_.jpg" style="margin-left:8px"/>
                        <span style="position:absolute;left:16px;top:3px; font-family:'微软雅黑'; color:white"><b>2</b></span>
                        <div style=" color:#E8996E; font-size:12px;padding-top:5px"><b>验证身份</b></div>
                    </div>
                <?php else: ?>
                    <div class="one" style="float:left;  position:relative; ">
                        <img src="<?php echo F::themeUrl(); ?>/images/one_.jpg" style="margin-left:8px"/>
                        <span style="position:absolute;left:16px;top:3px; font-family:'微软雅黑'; color:white"><b>1</b></span>
                        <div style=" color:#E8996E; font-size:12px; padding-top:5px"><b>输入账户名</b></div>
                    </div>
                    <div class="one" style="float:left;position:relative;">
                        <img src="<?php echo F::themeUrl(); ?>/images/two.jpg" style="margin-left:8px"/>
                        <span style="position:absolute;left:16px;top:3px; font-family:'微软雅黑'; color:white"><b>2</b></span>
                        <div style=" color:#8A8A8C; font-size:12px;padding-top:5px"><b>验证身份</b></div>
                    </div>
                <?php endif; ?>
                <div class="one" style="float:left;position:relative;">
                    <img src="<?php echo F::themeUrl(); ?>/images/two.jpg"style="margin-left:8px"/>
                    <span style="position:absolute;left:16px;top:3px; font-family:'微软雅黑'; color:white"><b>3</b></span>
                    <div style=" color:#8A8A8C; font-size:12px;padding-top:5px"><b>重置密码</b></div>
                </div>
                <div class="one" >
                    <img src="<?php echo F::themeUrl(); ?>/images/ok.jpg" />
                    <div style=" color:#8A8A8C; font-size:12px;padding-top:5px"><b>完成</b></div>
                </div>
            </div>
        </div>
    </div>
    <div class='bg-white pos-r' style="margin-top: 50px">
        <?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
            <div class="msg-success">
                <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
            </div>
        <?php else: ?>

            <div class="form">
                <?php echo CHtml::beginForm('','post',array('id'=>'fm')); ?>
                <div style="margin-left: 250px" class="row">
                    <?php echo CHtml::activeLabel($form, '账户名:'); ?>
                    <?php echo CHtml::activeTextField($form, 'login_or_email') ?>
                    <span>请输入您的账号或电子邮件地址。</span>
                    <span style="color:red"><?php echo CHtml::error($form, 'login_or_email'); ?></span>
                </div>
                <div style="margin-left: 250px;margin-top:10px" class="row">
                    <?php echo CHtml::activeLabel($form, '验证码:'); ?>
                    <?php echo CHtml::activeTextField($form, 'verifyCode', array('class' => 'width98')); ?>
                    <?php
                    $this->widget('CCaptcha', array(
                        'showRefreshButton' => true,
                        'clickableImage' => false,
                        'buttonLabel' => '换一张',
                        'imageOptions' => array('align' => 'absmiddle')
                    ));
                    ?>
                    <?php
                    if ($form->hasErrors('verifyCode')):
                    ?>
                    <span style="color:red;"><?php echo $form->getError('verifyCode'); ?></span>
                    <?php endif;?>
                </div>
                <div style="margin-left:250px;margin-top:10px" class="row">
                    <?php if ($emailError): ?>
                    <span style="color: red"><?php echo $emailError; ?></span>
                    <?php endif; ?>
                </div>
                <p class="row" style="margin-left: 350px;margin-top:10px">
                    <?php echo CHtml::submitButton(UserModule::t("下一步"), array('class' => 'submit','id'=>'nextstep')); ?>
                </p>
                <?php echo CHtml::endForm(); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class='bg-white pos-r' style="height:100px;"></div>
</div>
<div style="height:200px;"></div>
<script>
$(function(){
    $('#nextstep').click(function(){
        $(this).attr('disabled',true);
        $('#fm').submit();
    })
})
</script>