<?php
$this->breadcrumbs = array(
    ('会员列表') => array('admin'),
    $model->UserName ,
);
$this->menu = array(
    array('label' =>'创建会员', 'icon' => 'plus', 'url' => array('create')),
    array('label' => '查看会员', 'icon' => 'eye-open', 'url' => array('view', 'id' => $organ->ID)),
    array('label' =>'管理会员', 'icon' => 'cog', 'url' => array('admin')),
    array('label' => '会员列表', 'icon' => 'list', 'url' => array('/admin/admin')),
);
?>

<h1><?php echo '编辑会员' .  $model->UserName  ?></h1>

<?php
echo $this->renderPartial('_form', array('model' => $model, 'organ' => $organ));
?>