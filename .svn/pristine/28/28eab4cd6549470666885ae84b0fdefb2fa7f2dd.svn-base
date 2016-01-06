<?php 
$this->pageTitle = Yii::app()->name . ' - ' . "查看服务管理"; 
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
	'服务管理' => Yii::app()->createUrl("servicer/servicemanage/index"),
	'查看服务管理'
);
?>
<style>
.gsxx{ width:800px; margin:0 auto; line-height:30px}
.a_r{ text-align:right}
.a_l{text-align:left; margin-right:20px}
.a_c{ text-align:right}
.txxx3{ border-bottom:1px dashed #c9d5e3}
.width115{ width:90px}
table{table-layout:fixed;}
</style>
	<div class="bor_back m-top">
 		<p class="txxx txxx3">车主信息</p>
	        <p>
	        	<span style="display:block;float: right;margin-top: -25px;margin-right: 15px;"><a href="<?php echo Yii::app()->createUrl("servicer/servicemanage/index")?>" style="font-weight:400">返回</a></span>
	        </p>
            <div class="txxx_info4">
             <div class="gsxx">
                <p>
                   <label class="a_c width115">车主姓名：</label>
                   <label class="a_l"><?php echo $owner['Name']; ?>;</label>
                   <label class="a_c width115">电话：</label>
                   <label class="a_l"><?php echo $owner['Phone']; ?>;</label>
                   <label class="a_c width115">所在城市：</label>
                   <label class="a_l"><?php echo Area::showCity($owner['City']); ?></label>
                </p>
             </div>
            </div>
            
            <p class="txxx txxx3">车辆信息</p>
            <div class="txxx_info4">
             <div class="gsxx">
                <p>
                   <label class="a_c width115">车牌号：</label>
                   <label colspan="a_l"  class="a_l"><?php echo $car['LicensePlate']; ?>;</label>
                   <label class="a_c width115">使用性质：</label>
                   <label class="a_l"><?php echo $car['UseNature']; ?>;</label>
                   <label class="a_c width115">汽车品牌：</label>
                   <label class="a_l"><?php echo $car['Car']; ?></label>
                </p>
                <p>
                   <label class="a_c width115">车架号/VIN码：</label>
                   <label class="a_l"><?php echo $car['VinCode']; ?>;</label>
                   <label class="a_c width115">行驶里程：</label>
                   <label class="a_l"><?php echo $car['Mileage']; ?>km;</label>
                   <label class="a_c width115">购置时间：</label>
                   <label class="a_l"><?php echo date("Y-m-d",$car['BuyTime']); ?></label>
                </p>
             </div>
            </div>
            
            <p class="txxx txxx3">服务登记信息</p>
            <div class="txxx_info4">
            <div class="gsxx">
                <p>
                   <label class="a_c width115">登记日期：</label>
                   <label colspan="a_l"  class="a_l"><?php echo date("Y-m-d H:i:s",$record['CreateTime']); ?></label>
                   <label class="a_c width115">当前里程数：</label>
                   <label class="a_l"><?php echo $record['Mileage']; ?>km</label>
                </p>
                <?php if (!empty($record['Remark'])){?>
                <p style="word-wrap:break-word; white-space:normal;">
                   <label class="a_c width115">保养备注：</label>
                   <label colspan="3"  class="a_l"><?php echo $record['Remark']; ?></label>
                </p>
                <?php }?>
             </div>
            <div class="bor_back m_top10">
            <?php 
            $this->widget('widgets.default.WGridView',array(
            	'dataProvider' => $dataProvider,
			    'ajaxUpdate' => true,
            	'columns' => array(
            		array(// display 'create_time' using an expression
		                'name' => '序号',
                                'type' => 'raw',
		                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                'headerHtmlOptions' => array('style' => 'width:30px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '日期',
                                'type' => 'raw',
		                'value' => 'CHtml::encode(date("Y-m-d",$data->UpdateTime))',
                                'headerHtmlOptions' => array('style' => 'width:60px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '内容',
                                'type' => 'raw',
		                'value' => 'CHtml::encode($data->PartName)',
                                'headerHtmlOptions' => array('style' => 'width:240px;'),
                                'htmlOptions' => array('style' => 'width:240px;word-wrap: break-word;word-break: break-all;white-space:normal; ')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '品牌',
                                'type' => 'raw',
		                'value' => 'CHtml::encode($data->Brand)',
                                'headerHtmlOptions' => array('style' => 'width:150px;'),
                                'htmlOptions' => array('style' => 'width:150px;word-wrap: break-word;word-break: break-all;white-space:normal; ')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '数量',
                                'type' => 'raw',
		                'value' => 'CHtml::encode($data->Num)',
                                'headerHtmlOptions' => array('style' => 'width:40px;'),
                                'htmlOptions' => array('style' => 'width:40px;word-wrap: break-word;word-break: break-all;white-space:normal; ')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => 'ＯＥ号',
                                'type' => 'raw',
		                'value' => 'CHtml::encode($data->OE)',
                                'headerHtmlOptions' => array('style' => 'width:120px;'),
                                'htmlOptions' => array('style' => 'width:120px;word-wrap: break-word;word-break: break-all;white-space:normal; ')
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '服务类别',
                                'type' => 'raw',
		                'value' => 'CHtml::encode($data->OperateType)',
                                'headerHtmlOptions' => array('style' => 'width:50px;'),
		            ),
		            array(
		            	// display a column with "view", "update" and "delete" buttons
		            	'class' => 'CButtonColumn',
		           		'header' => '操作',  
		            	'template'=>'{view}',
                                'headerHtmlOptions' => array('style' => 'width:40px;'),
				    	'buttons' => array(
		            		'view' => array(
					         	'label' => '详情',
					        	'url' => 'Yii::app()->createUrl("/servicer/servicemanage/servedetail",array("id"=>$data->ID))'
					    	)
				        ),
		        	),
            	)
            ));?>
            </div>
            </div>
        </div>