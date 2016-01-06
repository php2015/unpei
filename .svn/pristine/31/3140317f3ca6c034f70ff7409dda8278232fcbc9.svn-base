<?php 
$this->pageTitle = Yii::app()->name . ' - ' . "车主信息"; 
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '车主管理' => Yii::app()->createUrl('servicer/serviceowner/index'),
	'车主信息'
);
?>
<style>
.gsxx{ width:800px; margin:0 auto; line-height:30px}
.a_r{ text-align:right}
.a_l{text-align:left}
.a_c{ text-align:right}
.txxx3{ border-bottom:1px dashed #c9d5e3}
.jg_show { margin:10px 20px}
.jg_show ul li{ float:left; margin:10px; border:1px solid #ebebeb; padding:5px }
.jg_show ul li img{ width:200px; height:150px}
.width115{ width:115px}
.btn_addPic2{ height:25px; width:100px; background:#f2b303; cursor:pointer; line-height:25px;border-radius:2px}
.btn_addPic2 span{ color:#fff; font-weight:bold; text-align:center; margin-left:10px; cursor:pointer}
.filePrew2{height:25px; width:100px; cursor:pointer }
.upload_jgtp li{ float:left; margin-right:5px; height:81px; width:81px; border:1px solid #ebebeb; position:relative }
.upload_jgtp li img{ width:80px; height:80px}
span.guanbi3{ position:absolute; z-index:10; right:0px; cursor:pointer}
span.guanbi3 img{ width:10px; height:10px}
.zdyul li{width:30%; margin-left:70px; float:left; line-height:30px;}
table{table-layout:fixed;}
</style>
	<div class="bor_back m-top">
 		<p class="txxx txxx3">车主信息
                </p>
                <p>
                    <span style="display:block;float: right;margin-top: -25px;margin-right:10px"><a href="<?php echo Yii::app()->createUrl("servicer/serviceowner/index");?>" style="font-weight:400">返回</a></span>
                </p>
            <div class="txxx_info4">
             <div class="gsxx">
             	<ul class="zdyul m-top">
	                <li>车主姓名：<span><?php echo $owner['Name']; ?></span></li>
	                <li>昵称：<span><?php echo $owner['NickName']; ?></span></li>
	                <li>性别：<span><?php echo $owner['Sex']; ?></span></li>
	                <li>驾驶环境：<span><?php echo $owner['DrivingEnvironment']; ?></span></li>
	                <li>邮箱：<span><?php echo $owner['Email']; ?></span></li>
	                <li>QQ：<span><?php echo $owner['QQ']; ?></span></li>
	                <li>电话：<span><?php echo $owner['Phone']; ?></span></li>
	                <li>驾驶证号：<span><?php echo $owner['DrivingLicense']; ?></span></li>
	                <li>所在城市：<span><?php echo Area::showCity($owner['City']); ?></span></li>
	                <div style="clear:both"></div>
	                <p class=" m-top5"></p>
	            </ul>
             </div>
            </div>
            
            <p class="txxx txxx3">车辆信息</p>
            <div class="txxx_info4">
            <div class="bor_back m_top10">
            <?php $this->widget('widgets.default.WGridView',array(
            	'dataProvider' => $dataProvider,
            	'columns' => array(
            		array(// display 'create_time' using an expression
		                'name' => '序号',
                		'type' => 'raw',
		                'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                'headerHtmlOptions' => array('style' => 'width:20px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '车牌号',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->LicensePlate)',
                                'headerHtmlOptions' => array('style' => 'width:70px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '行驶证号',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->VehicleLicense)',
                                'headerHtmlOptions' => array('style' => 'width:170px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '使用性质',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->UseNature)',
                		'headerHtmlOptions' => array('style' => 'width:60px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '购置时间',
                		'type' => 'raw',
		                'value' => 'CHtml::encode(date("d/m/Y",$data->BuyTime))',
                		'headerHtmlOptions' => array('style' => 'width:60px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '行驶里程(km)',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->Mileage)',
                		'headerHtmlOptions' => array('style' => 'width:80px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '车架号/VIN码',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->VinCode)',
                		'headerHtmlOptions' => array('style' => 'width:70px;'),
		            ),
		            array(// display 'author.username' using an expression
		                'name' => '汽车品牌',
                		'type' => 'raw',
		                'value' => 'CHtml::encode($data->Car)',
                                'headerHtmlOptions' => array('style' => 'width:100px;'),
		            ),
            	)
            ));?>
            </div>
            </div>
        </div>