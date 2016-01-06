<?php
$this->breadcrumbs = array(
    (UserModule::t('会员列表')) => array('admin'),
    $model->username => array('view', 'id' => $model->id),
    (UserModule::t('更新')),
);
$this->menu = array(
    array('label' => UserModule::t('创建会员'), 'icon' => 'plus', 'url' => array('create')),
    array('label' => UserModule::t('查看会员'), 'icon' => 'eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => UserModule::t('管理会员'), 'icon' => 'cog', 'url' => array('admin')),
    array('label' => UserModule::t('管理 Profile字段'), 'icon' => 'cog', 'url' => array('profileField/admin')),
    array('label' => UserModule::t('会员列表'), 'icon' => 'list', 'url' => array('/user')),
);
?>

<h1><?php echo UserModule::t('编辑会员') . " " . $model->id; ?></h1>

<?php
echo $this->renderPartial('_form', array('model' => $model, 'profile' => $profile));
?>