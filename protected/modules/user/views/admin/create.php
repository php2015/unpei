<?php
$this->breadcrumbs = array(
    UserModule::t('会员') => array('admin'),
    UserModule::t('创建'),
);

$this->menu = array(
    array('label' => UserModule::t('会员管理'), 'icon' => 'cog', 'url' => array('admin')),
   // array('label' => UserModule::t('Manage Profile Field'), 'icon' => 'cog', 'url' => array('profileField/admin')),
    array('label' => UserModule::t('List User'), 'icon' => 'list', 'url' => array('/user')),
);
?>
<h1><?php echo UserModule::t("创建会员"); ?></h1>

<?php
echo $this->renderPartial('_form', array('model' => $model, 'profile' => $profile));
?>