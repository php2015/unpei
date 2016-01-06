<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Change password");
$this->breadcrumbs = array(
    UserModule::t("Profile") => array('/user/profile'),
    UserModule::t("Change password"),
);
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'icon' => 'cog', 'url' => array('/user/admin')) : array()),
    array('label' => UserModule::t('List User'), 'icon' => 'list', 'url' => array('/user')),
    array('label' => UserModule::t('Profile'), 'icon' => 'user', 'url' => array('/user/profile')),
    array('label' => UserModule::t('Edit'), 'icon' => 'pencil', 'url' => array('edit')),
    array('label' => UserModule::t('Logout'), 'icon' => 'off', 'url' => array('/user/logout')),
);
?>
<h1 class='title title-dashed'><?php echo UserModule::t('Change password'); ?></h1>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'changepassword-form',
	'enableAjaxValidation' => true,
	'clientOptions' => array(
	    'validateOnSubmit' => true,
	),
    ));
    ?>

    <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model); ?>

    <div class="row">
	<?php echo $form->labelEx($model, 'oldPassword'); ?>
	<?php echo $form->passwordField($model, 'oldPassword'); ?>
	<?php echo $form->error($model, 'oldPassword'); ?>
    </div>

    <div class="row">
	<?php echo $form->labelEx($model, 'password'); ?>
	<?php echo $form->passwordField($model, 'password'); ?>
	    <?php echo $form->error($model, 'password'); ?>
	<p class="hint">
	<?php //echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
    </div>

    <div class="row">
	<?php echo $form->labelEx($model, 'verifyPassword'); ?>
	<?php echo $form->passwordField($model, 'verifyPassword'); ?>
	<?php echo $form->error($model, 'verifyPassword'); ?>
    </div>

    <div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Save"),array('class'=>'submit')); ?>
	<a class='btn' href='javascript:window.history.go(-1)'>返回</a>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->