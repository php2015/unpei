<?php 
$this->pageTitle = Yii::app()->name . '-' . "服务管理"; 
$this->breadcrumbs = array(
    '服务管理'  => Yii::app()->createUrl('/common/servicelist'),
    '添加服务记录',
);
?>
<link href="<?php echo F::themeUrl();?>/css/manage.css" type="text/css" rel="stylesheet">
<style>
    .auto_heights ul li{float:left;}
	table{table-layout:fixed;}
</style>
<div class="bor_back m_top">
<p class="txxx txxx3">添加服务记录</p>
	<p>
		<span style="display:block;float: right;margin-top: -25px;margin-right: 15px;">
		<a href="<?php echo Yii::app()->createUrl('servicer/servicemanage/index')?>" id="back" style="font-weight:400">返回</a>
		</span>
	</p>
	<div class="txxx_info4">
   		<form action="<?php echo Yii::app()->createUrl('servicer/servicemanage/checkcars');?>" method="post" target="_self">
    		<div class="gsxx" style="margin-bottom:20px">
            	<p class="m-top5">
               <label class="label1 m_left12">请输入车牌号：</label>
               <input type="text" name="addLicensePlate" class="input" value="<?php if ($addLicensePlate == 'NULL'){ echo "";}else {echo $addLicensePlate;}?>">
               <input type="submit" value="检索车辆" class="submit m_left">
               </p>
            </div>
         </form>
        <?php 
           	$this->widget('widgets.default.WGridView', array(
		        'dataProvider' => $cardata,
			    'ajaxUpdate' => true,
		        'columns' => array(
		            array(// display 'create_time' using an expression
		                'name' => '序号',
                		'type' => 'raw',
		                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
		            	'headerHtmlOptions' => array('style' => 'width:28px;')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '车牌号',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->LicensePlate)',
		            	'headerHtmlOptions' => array('style' => 'width:60px;'),
                		'htmlOptions' => array('style' => 'width:80px;word-wrap: break-word;word-break: normal;white-space:normal;')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '行驶证号',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->VehicleLicense)',
                		'htmlOptions' => array('style' => 'width:80px;word-wrap: break-word;word-break: normal;white-space:normal;')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '使用性质',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->UseNature)',
		            	'headerHtmlOptions' => array('style' => 'width:60px;'),
                		'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '购置时间',
                		'type' => 'raw',
		                'value' => 'CHtml::encode(date("Y-m-d",$data->BuyTime))',
		            	'headerHtmlOptions' => array('style' => 'width:60px;'),
                		'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '行驶里程(km)',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->Mileage)',
		            	'headerHtmlOptions' => array('style' => 'width:80px;'),
                		'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '车架/VIN码',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->VinCode)',
		            	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '汽车品牌',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->Car)',
		            ),
		            array(
		            	// display a column with "view", "update" and "delete" buttons
		            	'class' => 'CButtonColumn',
		           		'header' => '操作',  
		            	'template'=>'{insert}',
				    	'buttons' => array(
					    	'insert' => array(
					         	'label' => '添加记录',
					        	'url' => 'Yii::app()->createUrl("/servicer/servicemanage/addrecord",array("id"=>$data->ID))'
					    	),
				        ),
				        'headerHtmlOptions' => array('style' => 'width:48px;'),
                	'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
		        	),
		        ),
		    ));?>
    </div>
</div>