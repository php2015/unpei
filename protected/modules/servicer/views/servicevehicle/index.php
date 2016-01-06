<?php
$this->pageTitle = Yii::app()->name . '-' . "车辆管理";
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '车辆管理'
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl(); ?>/css/yxgl.css"/>
<style>
    .auto_heights ul li{float:left;}
    table{table-layout:fixed;}
    .width270{width:270px;}
</style>
<script>
    $(document).ready(function(){
        $("#UseNature  option[value='<?php echo $arr['usenature']; ?>'] ").attr("selected",true);
    })
</script>
<div class="bor_back m_top10">
    <p class="txxx txxx3">车辆管理

    </p>
    <p style="height:2px">
        <!--<span id="add" class="xjd" style="display: block;float: right;margin-top: -34px;"><a style="cursor:pointer;">添加</a></span>-->
        <span class="xjd" style="display: block;float: right;margin-top: -34px;"><a href="<?php echo Yii::app()->createUrl('servicer/servicevehicle/addcar'); ?>" style="font-weight:400;">添加</a></span>
    </p>
    <div class="txxx_info4">
        <form action="<?php echo Yii::app()->createUrl('servicer/servicevehicle/index'); ?>" method="post"  target="_self">    
            <div>
                <p class="m-top5">
                    <label class="label1 m_left12">车主姓名：</label>
                    <input class="width88 input" name="Name" value="<?php echo $arr['name'] ?>">
                    <label class="label1 m_left12" style="margin-left:12px; margin-left:15px\9;*margin-left:15px">&nbsp;车牌号：</label>
                    <input class="width88 input" name="LicensePlate" value="<?php echo $arr['licenseplate'] ?>">
                    <label class="label1 m_left12">汽车品牌：</label>
                    <input type="hidden" id="car_code" name="Code" value="<?php echo $arr['code'] ?>">
                    <input id="make-select-index" class="width270 input" name="Car" value="<?php echo $arr['car'] ?>">
                    <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
                </p>
                <p class="m-top5">
                	<label class="label1 m_left12">购置时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'BuyTime',
                        'value' => $arr['buytime'],
                        'htmlOptions' => array(
                            'class' => 'input',
                        ),
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'yy-mm-dd',
                            'changeYear'=>true
                        ),
                    ));
                    ?>
                    <label class="label1" style="padding-left:6px">行驶证号：</label>
                    <input class="width88 input" name="VehicleLicense" value="<?php echo $arr['vehiclelicense'] ?>">
                    <label class="label1 m_left12">使用性质：</label>
                    <select id="UseNature" class="width118 select" name="UseNature">
                        <option value="">请选择</option>
                        <option value="1">私家车</option>
                        <option value="2">公务车</option>
                        <option value="3">运营车辆</option>
                    </select>
                </p>
                <p class="m-top5">
                    <label class="label1 m_left12">车架/VIN码(前10位)：</label>
                    <input class="width88 input" name="VinCode" value="<?php echo $arr['vincode'] ?>">
                    <input class='submit ml10' style="margin-left:50px;" type='submit' id="search-btn" value='查询'>
                </p>
                <p class="m-top5">
                    
                </p>
            </div>
        </form>
    </div>

    <div class="m_top10">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '序号',
                	'type' => 'raw',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                	'headerHtmlOptions' => array('style' => 'width:28px;'),
                    'htmlOptions' => array('style' => 'width:20px;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '登记时间',
                	'type' => 'raw',
                    'value' => 'date("Y-m-d H:i:s",$data->CreateTime)',
                	'headerHtmlOptions' => array('style' => 'width:65px;'),
                	'htmlOptions' => array('style' => 'width:80px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '车主姓名',
                	'type' => 'raw',
                    'value' => '$data->owner->Name',
                	'headerHtmlOptions' => array('style' => 'width:60px;'),
                	'htmlOptions' => array('style' => 'width:80px;white-space:nowrap; overflow: hidden;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '车牌号',
                	'type' => 'raw',
                    'value' => '$data->LicensePlate',
                	'headerHtmlOptions' => array('style' => 'width:60px;'),
                	'htmlOptions' => array('style' => 'width:80px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '汽车品牌',
                	'type' => 'raw',
                    'value' => '$data->Car',
                	'htmlOptions' => array('style' => 'width:180px;word-wrap: break-word;word-break: normal;white-space:normal; ')
                ),
                array(// display 'author.username' using an expression
                    'name' => '行驶证号',
                	'type' => 'raw',
                    'value' => '$data->VehicleLicense',
                	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '使用性质',
                	'type' => 'raw',
                    'value' => '$data->UseNature',
                	'headerHtmlOptions' => array('style' => 'width:60px;'),
                	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '购置时间',
                	'type' => 'raw',
                    'value' => '$data->BuyTime?date("Y-m-d",$data->BuyTime):""',
                	'headerHtmlOptions' => array('style' => 'width:60px;'),
                	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '车架号/VIN码',
                	'type' => 'raw',
                    'value' => '$data->VinCode',
                	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(
                    // display a column with "view", "update" and "delete" buttons
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{view}{update}{delete}',
                    'buttons' => array(
                        'view' => array(
                            'label' => '详情',
                            'url' => 'Yii::app()->createUrl("/servicer/servicevehicle/detail",array("id"=>$data->ID))'
                        ),
                        'update' => array(
                            'label' => '修改',
                            'url' => 'Yii::app()->createUrl("/servicer/servicevehicle/addcar",array("id"=>$data->ID))'
                        ),
                        'delete' => array(
                            'lable' => '删除',
                            'click' => "function(){
			         		if(!confirm('确定要删除这条数据吗？')) return false;
			            	$.ajax({
				            	url:$(this).attr('href'),
				                type:'GET',
				             	dataType:'JSON',
				            	success:function(data)
				           		{
				                	alert(data['errorMsg']);
				                	history.go(0); 
				             	}
			             	});
			        		return false;
			       		}",
                            'url' => 'Yii::app()->createUrl("/servicer/servicevehicle/delcar",array("id"=>$data->ID))',
                        )
                    ),
                	'headerHtmlOptions' => array('style' => 'width:48px;'),
                	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
            ),
        ));
        ?>
    </div>

</div>