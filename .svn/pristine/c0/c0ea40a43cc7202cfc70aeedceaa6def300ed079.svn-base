
<div>
    请勾选您想要使用的优惠券
</div>
<?php
$this->widget('widgets.default.WGridView', array(
    'id' => 'coup-grid',
    'dataProvider' =>$dataProvider,
   // 'filter' => $data,
    'ajaxUpdate' => false, //禁用AJAX分页或排序
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'headerHtmlOptions' => array('width' => '33px'),
            'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
            'selectableRows' => '1',
            'value'=>'$data[ID]',
        ),
          array(
            'name' => '优惠券编号',
            'value' => '$data[CouponSn]',
            'filter' => false,
        ),
        array(
            'name' => '金额(￥)',
            'value' => '$data[Amount]',
            'filter' => false,
        ),
          array(
            'name' => '有效开始日期',
            'headerHtmlOptions' => array('width' => '130px;'),
            'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
            'filter' => false,
        ),
          array(
            'name' => '有效截止日期',
            'value' => 'date("Y-m-d H:i:s",$data[EndTime])',
            'filter' => false,
        ),
    ),
));
?>