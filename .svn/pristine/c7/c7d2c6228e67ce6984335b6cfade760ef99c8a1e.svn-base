<style>
    .title_lm li a {
        color: #0164C1;
        float: left;
        font-size: 14px;
        text-align: center;
    }
</style>
<?php
$this->breadcrumbs = array(
    '折扣率设置' ,
);
?>
<div class="bor_back m-top">
    <div class="ddgl_content3 m_top10 bor_back">
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
		    'id' => 'discount-grid',
		    'dataProvider' =>$model->search(),
		    //'filter' =>$model,
		    'ajaxUpdate' => false, //禁用AJAX分页或排序
		    'columns' => array(
		         array(
		            'name' => 'OrderType',
		            'type' => 'raw',
		            'value' => 'PapOrderDiscount::getDisOrdertype($data->OrderType)',
		        ),
		        array(
		            'name' => 'OrderAlipay',
		            'type' => 'raw',
		            'value' => '$data->OrderAlipay',
		        ),
		        array(
		            'name' => 'OrderLogis',
		            'type' => 'raw',
		            'value' => '$data->OrderLogis',
		        ),
		        array(
		            'header' => '操作',  
		            'class' => 'bootstrap.widgets.TbButtonColumn',
		            'template'=>'{update}',
		        	'buttons' => array(
                        'update' => array(
                            'label' => '修改',
                            'url' => 'Yii::app()->createUrl("/discountset/editorderdis",array("id"=>$data->ID))'
                        ),
                    ),
		        ),
		    ),
		));
        ?>
    </div>
</div>
