<?php 
$this->pageTitle = Yii::app()->name . ' - ' . "修改服务管理"; 
$this->breadcrumbs = array(
	'服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '服务管理' => Yii::app()->createUrl("servicer/servicemanage/index"),
	'修改服务管理'
);
?>
<style>
.gsxx{ width:800px; margin:0 auto; line-height:30px}
.a_r{ text-align:right}
.a_l{text-align:left}
.a_c{ text-align:right}
.txxx3{ border-bottom:1px dashed #c9d5e3}
.width115{ width:90px}
.row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
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
                   <label class="a_l"><?php echo $owner['Name']; ?></label>
                   <label class="a_c width115">电话：</label>
                   <label class="a_l"><?php echo $owner['Phone']; ?></label>
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
                   <label colspan="a_l"  class="a_l"><?php echo $car['LicensePlate']; ?></label>
                   <label class="a_c width115">使用性质：</label>
                   <label class="a_l"><?php echo $car['UseNature']; ?></label>
                   <label class="a_c width115">汽车品牌：</label>
                   <label class="a_l"><?php echo $car['Car']; ?></label>
                </p>
                <p>
                   <label class="a_c width115">车架号/VIN码：</label>
                   <label class="a_l"><?php echo $car['VinCode']; ?></label>
                   <label class="a_c width115">行驶里程：</label>
                   <label class="a_l"><?php echo $car['Mileage']; ?>km</label>
                   <label class="a_c width115">购置时间：</label>
                   <label class="a_l"><?php echo date("Y-m-d",$car['BuyTime']); ?></label>
                </p>
             </div>
            </div>
            
            <p class="txxx txxx3"><?php if($record->ServiceType==2) echo "当前里程数";else echo "日常保养记录";?></p>
            <div class='form'>
            <?php
	        $form = $this->beginWidget('CActiveForm', array(
	            'id' => 'ServiceRecordEdit-form',
	        	'action' => Yii::app()->createUrl("servicer/servicemanage/editrecord"),
	            //'enableAjaxValidation' => true,
	            //'enableClientValidation' => true,
	           //'clientOptions' => array('validateOnSubmit' => true)
	                ));
	        ?>
            <div class='row'>
            <?php echo $form->labelEx($record, '当前里程数：', array('class' => 'label')); ?>
            <?php echo $form->textField($record, 'Mileage', array('class' => 'width213 input')); ?>km
            <?php echo $form->error($record, 'Mileage', array('style' => 'color: red;')); ?>
            </div>
            <div class='row' <?php if($record->ServiceType==2) echo "style='display:none;'"?>>
            <?php echo $form->labelEx($record, '保养备注：', array('class' => 'label')); ?>
            <?php echo $form->textArea($record, 'Remark', array('size' => 255, 'maxLength' => 200, 'class'=>"textarea textarea2")); ?>
            <?php echo $form->error($record, 'Remark', array('style' => 'color: red;')); ?>
            <?php echo $form->hiddenField($record,'ID')?>
            </div>
             <?php $this->endWidget();?>
             </div>
            <p class="txxx txxx3">配件服务记录</p>
            <div class="txxx_info4">
            <div class="yxgl_content2 m_top">
				<ul>
					<li class="xjd"><a href="<?php echo Yii::app()->createUrl('servicer/servicemanage/addparts',array('id'=>$record->ID));?>">添加</a></li>
				</ul>
				<div style="clear:both"></div>
			</div>
            <div class="bor_back m_top10">
            <?php                                
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => $dataProvider,
                    'ajaxUpdate' => true,
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '序号',
                            'type' => 'raw',
                            'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
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
                            'template' => '{update}{delete}',
                            'headerHtmlOptions' => array('style' => 'width:40px;'),
                            'buttons' => array(
                                'update' => array(
                                    'label' => '修改',
                                    'url' => 'Yii::app()->createUrl("/servicer/servicemanage/editparts",array("id"=>$data->ID))'
                                ),
                                'delete' => array(
                                    'lable' => '删除',
                                    'click' => "function(){
						         		if(!confirm('确定要解除绑定吗？')) return false;
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
                                    'url' => 'Yii::app()->createUrl("/servicer/servicemanage/delparts",array("id"=>$data->ID))',
                                )
                            ),
                        ),
                    )
                ));
                ?>
            </div>
            </div>
            <div class='row' style="padding-left:200px;margin-bottom:20px;">
	            <input class='submit' type='button' id="save" value='保存'/>
	        </div>
        </div>
        <script>
        $(document).ready(function(){
			$("#save").click(function(){
				$("#ServiceRecordEdit-form").submit();
				});
            })
        </script>