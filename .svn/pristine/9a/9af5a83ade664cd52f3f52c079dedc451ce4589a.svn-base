<?php
$this->breadcrumbs = array(
     '会员列表' => array('admin'),
    $model->UserName,
);

$this->menu = array(
    array('label' => '创建会员', 'icon' => 'plus', 'url' => array('create')),
    array('label' => '修改会员', 'icon' => 'pencil', 'url' => array('update', 'id' => $user->ID)),
    array('label' =>'删除会员', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => ('Are you sure to delete this item?'))),
    array('label' => '管理会员', 'icon' => 'cog', 'url' => array('admin')),
    array('label' =>'会员列表', 'icon' => 'list', 'url' => array('/admin/admin')),
);
?>
<h1><?php echo '查看会员' . ' "' . $user->UserName . '"'; ?></h1>

<?php
$attributes = array(
    'ID',
    'OrganName',
    'Email',
       
);

array_push($attributes, array(
    'name' => 'Phone',
    'value' => $model->Phone
        ), array(
    'name' => 'Type',
    'value' => Organ::itemAlias("usertype", $model->Type)
        ), array(
    'name' => 'IsFreeze',
    'value' => Organ::itemAlias('freeze', $model->IsFreeze)
        ),array(
            'name'=>'IsBlack',
            'value'=>Organ::itemAlias('IsBlack',$model->IsBlack)
        )
);

array_push($attributes, array(
    'name' => 'Status',
    'value' => Organ::itemAlias("UserStatus", $model->Status),
        ), array(
    'name' => 'Identity',
    'value' => Organ::itemAlias("Identity", $model->Identity),
        ),
         array(
    'name' => 'AllAddress',
    'value' => Area::getCity($model->Province).Area::getCity($model->City).Area::getCity($model->Area).$model->Address,
        ),
        array(
            'name'=>'Recommend'
        )
);

$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => $attributes
));
?>
