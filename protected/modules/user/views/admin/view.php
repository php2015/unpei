<?php
$this->breadcrumbs = array(
    UserModule::t('会员列表') => array('admin'),
    $model->username,
);


$this->menu = array(
    array('label' => UserModule::t('创建会员'), 'icon' => 'plus', 'url' => array('create')),
    array('label' => UserModule::t('修改会员'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => UserModule::t('删除会员'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => UserModule::t('Are you sure to delete this item?'))),
    array('label' => UserModule::t('管理会员'), 'icon' => 'cog', 'url' => array('admin')),
    array('label' => UserModule::t('管理 Profile表 字段'), 'icon' => 'cog', 'url' => array('profileField/admin')),
    array('label' => UserModule::t('会员列表'), 'icon' => 'list', 'url' => array('/user')),
);
?>
<h1><?php echo UserModule::t('查看会员') . ' "' . $model->username . '"'; ?></h1>

<?php
$attributes = array(
    'id',
    'username',
);

// $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
// if ($profileFields) {
//     foreach ($profileFields as $field) {
	array_push($attributes,
	array(
	'name'=>'真实姓名',
	'value'=>$profile->truename
	),
	array(
			'name'=>'phone',
			'value'=>$profile->phone
	),
	 array(
	    'name' => 'usertype',
	    'value' => User::itemAlias("usertype", $profile->UserType)
	),
	array(
			'name'=>'freeze',
			'value'=>User::itemAlias('freeze',$profile->freeze)
	)
	);
   // }
//}

array_push($attributes, 'password', 'email', 'activkey', 'create_at', 'lastvisit_at', array(
    'name' => 'superuser',
    'value' => User::itemAlias("AdminStatus", $model->superuser),
	), array(
    'name' => 'status',
    'value' => User::itemAlias("UserStatus", $model->status),
	),
	array(
    'name' => 'identity',
    'value' => User::itemAlias("identity", $model->identity),
	)
);

$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => $attributes,
));
?>
