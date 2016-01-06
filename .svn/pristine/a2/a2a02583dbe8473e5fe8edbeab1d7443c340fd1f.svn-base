<?php
$this->pageTitle = Yii::app()->name . ' - 预约管理';
$this->breadcrumbs = array(
    '预约管理' => Yii::app()->createUrl("/servicer/reserve/index"),
);
?>
<div class="bor_back m_top10">
    <p class="txxx txxx3">预约管理

    </p>
    <p style="height:2px">
        <!--<span id="add" class="xjd" style="display: block;float: right;margin-top: -34px;"><a style="cursor:pointer;">添加</a></span>-->
        <span class="xjd" style="display: block;float: right;margin-top: -34px;"><a href="<?php echo Yii::app()->createUrl('servicer/reserve/reserve'); ?>" style="font-weight:400;">预约登记</a></span>
    </p>
    <div class="txxx_info4">
        <form action="<?php echo Yii::app()->createUrl('servicer/reserve/index'); ?>" method="post"  target="_self">    
            <div>
                <p class="m-top5">
                    <label class="label1 m_left24">车牌号：</label>
                    <input class="width88 input" name="LicensePlate" value="<?php echo $arr['LicensePlate'];?>">
                    <label class="label1 m_left12">预约号：</label>
                    <input class="width88 input" name="ReserveNum" value="<?php echo $arr['ReserveNum'];?>">
                    <label class="label1">预约时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        'name' => 'ReserveTime',
                        'value' => $arr['ReserveTime'],
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'changeYear' => true,
                        ),
                        'htmlOptions' => array(
                            'class' => 'input width88',
                        ),
                    ));
                    ?>
                    <input id="code" name="Code" value="<?php echo $arr['Code'];?>"type="hidden">
                </p>
                <p class="m-top5">
                    <label class="m_left12">汽车品牌：</label>
                    <input class="input" id="make-select-index" name="Car" value="<?php echo $arr['Car'];?>" maxlength="10" style="width: 265px;">
                    <input class='submit ml10' style="margin-left:40px;" type='submit' id="search-btn" value='查询'>
                    <?php $this->widget('widgets.default.WCarManageModel'); ?>
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
//                array(// display 'author.username' using an expression
//                    'name' => '登记时间',
//                	'type' => 'raw',
//                    'value' => 'date("Y-m-d H:i:s",$data->CreateTime)',
//                	'headerHtmlOptions' => array('style' => 'width:60px;'),
//                	'htmlOptions' => array('style' => 'width:80px;word-wrap: break-word;word-break: normal;white-space:normal;')
//                ),
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
                	'headerHtmlOptions' => array('style' => 'width:180px;'),
                	'htmlOptions' => array('style' => 'width:180px;word-wrap: break-word;word-break: normal;white-space:normal; ')
                ),
                array(// display 'author.username' using an expression
                    'name' => '预约号',
                	'type' => 'raw',
                    'value' => '$data->ReserveNum',
                	'headerHtmlOptions' => array('style' => 'width:40px;'),
                	'htmlOptions' => array('style' => 'width:40px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(// display 'author.username' using an expression
                    'name' => '预约时间',
                	'type' => 'raw',
                    'value' => '$data->ReserveTime',
                	'headerHtmlOptions' => array('style' => 'width:100px;'),
                	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
                array(
                    // display a column with "view", "update" and "delete" buttons
                    'class' => 'CButtonColumn',
                    'header' => '操作',
                    'template' => '{update}{delete}',
                    'buttons' => array(
                        'update' => array(
                            'label' => '修改',
                            'url' => 'Yii::app()->createUrl("/servicer/reserve/editreserve",array("id"=>$data->ID))'
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
                            'url' => 'Yii::app()->createUrl("/servicer/reserve/delreserve",array("id"=>$data->ID))',
                        )
                    ),
                	'headerHtmlOptions' => array('style' => 'width:24px;'),
                	'htmlOptions' => array('style' => 'width:24px;word-wrap: break-word;word-break: normal;white-space:normal;')
                ),
            ),
        ));
        ?>
    </div>

</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/reserve/maintenance.js'></script>