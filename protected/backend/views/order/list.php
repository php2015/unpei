
<?php
$this->breadcrumbs = array(
  '订单列表'=> array('/order/list')
);?>
<h1><?php echo"订单列表" ?></h1>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
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
            'value' => 'CHtml::link(CHtml::encode($data->ID),array("admin/update","id"=>$data->ID))',
            'filter' => false,
        ),
         array(
             'header'=>'订单编号', 
            'name' => 'OrderSN',
            'type' => 'raw',
            'value' => '$data->OrderSN',
        ),
         array(
             'header'=>'买家名称', 
            'name' => 'BuyerName',
            'type' => 'raw',
            'value' => '$data->BuyerName',
        ),
         array(
             'header'=>'买家手机号', 
            'name' => 'BuyerPhone',
            'type' => 'raw',
            'value' => '$data->BuyerPhone',
            'filter' => false,
        ),
        array(
             'header'=>'卖家名称', 
            'name' => 'SellerName',
            'type' => 'raw',
            'value' => '$data->SellerName',
        ),
        array(
             'header'=>'卖家手机号', 
            'name' => 'SellerPhone',
            'type' => 'raw',
            'value' => '$data->SellerPhone',
             'filter' => false,
        ),
          array(
            'header'=>'下单时间', 
            'name' => 'CreateTime',
            'type' => 'raw',
            'value' => 'date("Y-m-d H:i:s", $data->CreateTime)',
            'filter' => false,
        ),
        
    ),
));
?>
