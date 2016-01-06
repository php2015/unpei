<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile"),
);
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'icon' => 'cog', 'url' => array('/user/admin')) : array()),
    array('label' => UserModule::t('List User'), 'icon' => 'list', 'url' => array('/user')),
    array('label' => UserModule::t('Edit'), 'icon' => 'pencil', 'url' => array('edit')),
    array('label' => UserModule::t('Change password'), 'icon' => 'pencil', 'url' => array('changepassword')),
    array('label' => UserModule::t('Logout'), 'icon' => 'off', 'url' => array('/user/logout')),
);
?>

<!-- 
<div class='account-part'>
	<div class='account-title'><?php //echo UserModule::t('Account info'); ?></div>
	<div class='account-info'>
		<ul>
			<li>会员有效期 2013-13-31</li>
			<li>老板数  (50)</li>
			<li>采购用户数 (20)</li>
			<li>销售用户数 (30)</li>
		</ul>
		<div class="clear"></div>
		<ul>
			<li>认证核实状态：已认证</li>
			<li>当前会员状态：试用</li>
			<li>嘉配伙伴：是</li>
		</ul>		
		<div class="clear"></div>
	</div>
</div>
 -->
<h1 class='title title-dashed'><?php echo UserModule::t('profile info'); ?></h1>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="successmessage">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>
<dl class="dl-horizontal">
    <dt><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></dt>
    <dd><?php echo CHtml::encode($model->username); ?></dd>
</dl>

<dl class="dl-horizontal">
    <?php
    $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
    if ($profileFields) {
	foreach ($profileFields as $field) {
	    //echo "<pre>"; print_r($profile); die();
	    ?>

	    <dt><?php echo CHtml::encode(UserModule::t($field->title)); ?></dt>
	    <dd><?php echo (($field->widgetView($profile)) ? $field->widgetView($profile) : CHtml::encode((($field->range) ? Profile::range($field->range, $profile->getAttribute($field->varname)) : $profile->getAttribute($field->varname)))); ?></dd>
		<br />
	    <?php
	}//$profile->getAttribute($field->varname)
    }
    ?>
</dl>
<dl class="dl-horizontal">
    <dt><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></dt>
    <dd><?php echo CHtml::encode($model->email); ?></dd>
	<br />

    <dt><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></dt>
    <dd><?php echo $model->create_at; ?></dd>
	<br />

    <dt><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></dt>
    <dd><?php echo $model->lastvisit_at; ?></dd>
	<br />

    <dt><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></dt>
    <dd><?php echo CHtml::encode(User::itemAlias("UserStatus", $model->status)); ?></dd>

</dl>

<div style="margin:20px 0 15px; padding-left:20px; clear:both;">
	<?php echo CHtml::link(UserModule::t('Edit'), array('edit'),array('class'=>'btn-green')); ?>
	<?php echo CHtml::link(UserModule::t('Change password'), array('changepassword'),array('class'=>'btn-green')); ?>
</div>
