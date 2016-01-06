<?php
$this->breadcrumbs = array(
    'Menus' => array('index'),
    $model->Name,
);

$this->menu = array(
    array('label' => '创建菜单', 'icon' => 'plus', 'url' => array('create')),
    array('label' => '更新菜单', 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => '删除菜单', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => '管理菜单', 'icon' => 'cog', 'url' => array('admin')),
);
?>

<h1>View Menu #<?php echo $model->ID; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ID',
        'RootID',
        'ExtraUrl',
        'Icon',
        'ActiveIcon',
        'MenuIcon',
        'Name',
        'Url',
        'ParentID',
        'Sort',
        'IsShow',
        'IsLeaf',
        'ChildPage',
        'IsLarge',
        'MainMenuID',
        'type',
    ),
));
?>
