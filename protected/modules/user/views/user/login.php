<?php
$this->pageTitle=Yii::app()->name.' - 首页';
header("Content-type:text/html;charset=utf-8");
?>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl?>/css/login.css">
<script type="text/javascript">
$(function(){
	$('form').submit(function(){
		$('.errorSummary').html('');;
		var username = $("#UserLogin_username").val();
		var password = $("#UserLogin_password").val();
		var verifyCode = $("#UserLogin_verifyCode").val();
		if(username == ''){
			$("#UserLogin_username").focus();
			return false;
		}
		if(password == ''){
			$("#UserLogin_password").focus();
			return false;
		}
		if(verifyCode == ''){
			$("#UserLogin_verifyCode").focus();
			return false;
		}
		return true;
	});
});
</script>
<div class=' content-row home-row auto_height' style="width:990px; margin:10px 5px;padding-bottom:225px" >
	<div class='width625 float_l slider' style="width:625px">
		<img width=625 height=325 src="<?php echo Yii::app()->theme->baseUrl;?>/images/login-newimg.jpg"></div>
		<div class=" float_l bg-white window-login; m_left" style="width:350px; background:#fff; height:325px; border:1px solid #ddd">
		<h2 class='title font-green f14-b'>
			用户登录&nbsp; <i class='icon-login-word display-ib'></i>
		</h2>
		<div style="margin-left:85px;" class="errorSummary">
			<?php 
				if($model->hasErrors('verifyCode')){
			?>
			<span style="color:red;"><?php echo $model->getError('verifyCode'); ?></span>
			<?php 
				}else if($model->hasErrors('username')){
			?>
			<span style="color:red;"><?php echo $model->getError('username'); ?></span>
			<?php 
				}else if($model->hasErrors('password')){
			?>
			<span style="color:red;"><?php echo $model->getError('password'); ?></span>
			<?php 
				}else if($model->hasErrors('status')){
			?>
			<span style="color:red;"><?php echo $model->getError('status'); ?></span>			
			<?php 
				}
			?>
		</div>
        <!--logo-->
        <?php echo CHtml::beginForm(Yii::app()->getModule('user')->loginUrl); ?>
        
        <?php //echo CHtml::errorSummary($model); ?>
        	
		<div class='form-row'>
			<?php echo CHtml::activeLabelEx($model,'用户名:',array('class'=>'label')); ?>
			<?php echo CHtml::activeTextField($model,'username',array('class'=>'width214 input')); ?>
			</div>
		<div class='form-row'>
			<?php echo CHtml::activeLabelEx($model,'密　码:',array('class'=>'label')); ?>
			<?php echo CHtml::activePasswordField($model,'password',array('class'=>'width214 input')); ?>
		</div>
		<?php if (UserModule::doCaptcha('login')): ?>
		<div class='form-row'>
			<?php echo CHtml::activeLabelEx($model,'验证码:',array('class'=>'label')); ?>
			<?php echo CHtml::activeTextField($model,'verifyCode',array('class'=>'width98 input')); ?>
			<?php $this->widget('CCaptcha',array(
				'captchaAction'=>'/user/login/captcha',
       			'showRefreshButton'=>true,
       		 	'clickableImage'=>false,
        	 	'buttonLabel'=>'换一张',
				'imageOptions'=>array('align'=>'absmiddle'),
        	 )); ?>
		</div>
		<?php endif; ?>
		<div class='form-row'>
			<?php echo CHtml::activeLabelEx($model,'自动登录:',array('class'=>'label')); ?>
			<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
			&nbsp;&nbsp;
		</div>
		<div class='form-row'>
			<label class="label"></label>
			<?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'submit','style'=>'')); ?>
			&nbsp;&nbsp;
			<?php //echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl,array('class'=>'display-ib')); ?>
<!--			&nbsp;&nbsp;|&nbsp;&nbsp;-->
			<?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl,array('id'=>'findpassword')); ?>
		</div>
        
        <?php echo CHtml::endForm(); ?>
	</div>
	<div style="clear:both"></div>
</div>

<!-- 广告信息 -->
<div class='width998 content-rows auto_height'>
     <?php //$this->widget('widgets.default.WAd'); ?>
</div>

<!-- 产品中心 -->
<div class='width998 content-rows auto_height'>
     <?php //$this->widget('widgets.default.WProductCenter'); ?>
</div>