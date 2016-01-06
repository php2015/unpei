<?php
$this->breadcrumbs=array(
    '会员列表'=>Yii::app()->createUrl('admin/admin'),
    '子账户列表'
);
?>
<h3>主帐号：<?php echo $username?></h3>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'account-grid',
    'dataProvider' =>$dataProvider,
    'filter' =>$model,
    'ajaxUpdate' => false, //禁用AJAX分页或排序
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'headerHtmlOptions' => array('width' => '33px'),
            'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
            'selectableRows' => '2',
        //'value'=>'CHtml::encode($data->id)',
        ),
        array(
            'name' => 'ID',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->employ->ID),array("admin/update","id"=>$data->employ->ID))',
            'filter' => false,
        ),
         array(
            'header'=>'姓名',
            'name' => 'Name',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->employ->Name)',
        ),
         array(
            'header'=>'性别',
            'name' => 'Sex',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->employ->Sex)',
            'filter' => false,
        ),
         array(
             'header'=>'职位',
            'name' => 'Job',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->employ->Job)',
             'filter'=>false
        ),
        array(
            'name'=>'Phone',
            'type'=>'raw',
            'value'=>'CHtml::encode($data->employ->Phone)',
            'filter' => false,
        ),
         array(
            'name'=>'Email',
            'type'=>'raw',
            'value'=>'CHtml::encode($data->employ->Email)',
             'filter'=>false
        ),
//        array(
//            'class' => 'bootstrap.widgets.TbButtonColumn',
//            
//        ),
    ),
));
?>