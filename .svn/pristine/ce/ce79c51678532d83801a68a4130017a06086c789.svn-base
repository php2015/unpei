<?php
$this->pageTitle = Yii::app()->name . '-' . $str;
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '车主管理' => Yii::app()->createUrl('servicer/serviceowner/index'),
    $str
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl(); ?>/css/fwgl.css"/>
<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
    table{table-layout:fixed;}
    #addowner table{border: 1px solid #feca9a;}
    #addowner table tr{border-bottom: #FECA9A 1px solid};
    #addowner table tr td{border-bottom: #FECA9A 1px solid};
</style>

<!--内容部分-->
<div id="addowner" class="bor_back m_top10">
    <p class="txxx">
        填写基本信息


    </p>
    <p>
        <span style="display:block;float: right;margin-top: -25px;margin-right:10px"><a id="return" style="font-weight:400" href="javascript:void(0)">返回</a></span></p>
    <div class="txxx_info">
        <div class='form'>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'ServiceCarOwner-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true)
            ));
            ?>
            <div class='row'>
                <?php echo $form->labelEx($model, '车主姓名：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'Name', array('class' => 'width213 input', 'maxlength' => '15')); ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'Name', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '昵称：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'NickName', array('class' => 'width213 input','maxlength'=>20)); ?>
                <?php echo $form->error($model, 'NickName', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '性别：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php
                echo $form->dropDownList($model, 'Sex', array(
                    '1' => '男',
                    '2' => '女'
                        ), array(
                    'class' => 'width118 select',
                    'empty' => '请选择',
                ));
                ?>
                <?php echo $form->error($model, 'Sex', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '驾驶环境：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php
                echo $form->dropDownList($model, 'DrivingEnvironment', array(
                    '1' => '市区',
                    '2' => '高速',
                    '3' => '郊区'
                        ), array(
                    'class' => 'width118 select',
                    'empty' => '请选择',
                ));
                ?>
                <?php echo $form->error($model, 'DrivingEnvironment', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '邮箱：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php
                echo $form->textField($model, 'Email', array(
                    'class' => 'input',
                    'validtype' => 'email',
                    "data-options" => "required:true",
                    "maxlength" => '64'
                ));
                ?>
                <?php echo $form->error($model, 'Email', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, 'QQ：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'QQ', array('class' => 'width213 input')); ?>
                <?php echo $form->error($model, 'QQ', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '手机号：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'Phone', array('class' => 'width213 input')); ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'Phone', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '驾驶证号：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'DrivingLicense', array('class' => 'width213 input')); ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'DrivingLicense', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '所在城市：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php
                $data = Area::model()->findByPK("$model->City");
                $Province = $data->ParentID;
                //var_dump($Province);die;
                $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));

                $state = CHtml::listData($state_data, "ID", "Name");
                echo CHtml::dropDownList('Province', $Province, $state, array(
                    'class' => 'width118 select',
                    'empty' => '请选择省份',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                        'update' => '#ServiceCarOwner_City', //selector to update
                        'data' => 'js:"province="+jQuery(this).val()',
                )));
                ?>
                <?php
                //empty since it will be filled by the other dropdown
                $c_default = $model->isNewRecord ? '' : $model->City;
                if (!$model->isNewRecord) {
                    $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $data->ParentID));
                    $city = CHtml::listData($city_data, "ID", "Name");
                }

                $city_update = $model->isNewRecord ? array() : $city;
                echo $form->dropDownList($model, 'City', $city_update, array(
                    'class' => 'width118 select',
                    'empty' => '请选择城市',
                ));
                ?>
            </div>
            <div id="select" class='row'>
                <?php echo $form->labelEx($model, '选择车辆：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <input type="text" id="selCar" class="input" readonly="readonly" name="LicensePlate"/>
            </div>
            <div id="showCar" class='row' style="display:none;" >
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => $car,
                    'ajaxUpdate' => true,
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '序号',
                            'type' => 'raw',
                            'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                            'headerHtmlOptions' => array('style' => 'width:28px;'),
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '车牌号',
                            'type' => 'raw',
                            'value' => 'CHtml::encode($data->LicensePlate)',
                            'headerHtmlOptions' => array('style' => 'width:60px;'),
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
                            'value' => 'CHtml::encode(date("Y-m-d",$data->BuyTime))',
                            'headerHtmlOptions' => array('style' => 'width:60px;'),
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '行驶里程(km)',
                            'type' => 'raw',
                            'value' => 'CHtml::encode($data->Mileage)',
                            'headerHtmlOptions' => array('style' => 'width:80px;'),
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '车架/VIN码',
                            'type' => 'raw',
                            'value' => 'CHtml::encode($data->VinCode)',
                            'headerHtmlOptions' => array('style' => 'width:80px;'),
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '汽车品牌',
                            'type' => 'raw',
                            'value' => 'CHtml::encode($data->Car)',
                            'headerHtmlOptions' => array('style' => 'width:100px;'),
                        ),
                    ),
                ));
                ?>
            </div>
            <?php if ($str == "修改车主信息") { ?>
                <div class='row'>
                    <?php
                    $this->widget('widgets.default.WGridView', array(
                        'dataProvider' => $dataProvider,
                        'ajaxUpdate' => true,
                        'columns' => array(
                            array(// display 'create_time' using an expression
                                'name' => '序号',
                                'type' => 'raw',
                                'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                'headerHtmlOptions' => array('style' => 'width:28px;'),
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '车牌号',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->LicensePlate)',
                                'headerHtmlOptions' => array('style' => 'width:60px;'),
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '行驶证号',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->VehicleLicense)',
                                'headerHtmlOptions' => array('style' => 'width:180px;'),
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
                                'value' => 'CHtml::encode(date("Y-m-d",$data->BuyTime))',
                                'headerHtmlOptions' => array('style' => 'width:80px;'),
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '行驶里程(km)',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->Mileage)',
                                'headerHtmlOptions' => array('style' => 'width:80px;'),
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '车架/VIN码',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->VinCode)',
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
                                'template' => '{update}{delete}',
                                'buttons' => array(
                                    'update' => array(
                                        'label' => '修改',
                                        'url' => 'Yii::app()->createUrl("/servicer/servicevehicle/addcar",array("id"=>$data->ID))'
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
                                        'url' => 'Yii::app()->createUrl("/servicer/serviceowner/delcar",array("id"=>$data->ID))',
                                    )
                                ),
                                'headerHtmlOptions' => array('style' => 'width:48px;'),
                            ),
                        ),
                    ));
                    ?>
                </div>
            <?php } ?>
            <div class='row' style="padding-left:200px;margin-bottom:10px;">
                <?php if ($model->ID): ?>
                    <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php endif; ?>
                <?php echo $form->hiddenField($model, 'CreateTime'); ?>
                <input class='submit' type='button' id="save" value='保存'/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function() {
        $("#save").click(function() {
            //if(window.confirm("您确定要保存吗?"))
            //{
            $("#ServiceCarOwner-form").submit();
            //}
        });
        $("#return").live('click', function() {
            window.location.href = "<?php echo Yii::app()->createUrl('servicer/serviceowner/index'); ?>";
        });
        $("#selCar").click(function() {
            $("#showCar").show();
        });
        $("#yw0 .table tr").live('click', function() {
            $("#selCar").val($(this).find('td:eq(1)').text());
        });
    })
</script>

