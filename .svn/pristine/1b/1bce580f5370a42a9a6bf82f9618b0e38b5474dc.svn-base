<?php
$this->pageTitle = Yii::app()->name . '-' . $str;
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '车辆管理' => Yii::app()->createUrl('servicer/servicevehicle/index'),
    $str
);
?>
<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 150px !important;
    }
    table{table-layout:fixed;}
    #showOwner table{border: 1px solid #feca9a;}
    #showOwner table tr{border-bottom: #FECA9A 1px solid};
    #showOwner table tr td{border-bottom: #FECA9A 1px solid};
</style>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">
        填写基本信息
<!--        <span style=" float:right; margin-right:20px">
            <a id="return" style="font-weight:400" href="javascript:void(0)">返回</a>
        </span>-->
    </p>
    <p>
        <span style="display:block;float: right;margin-top: -25px;margin-right: 5px;"> <a id="return" style="font-weight:400" href="javascript:void(0)">返回</a></span>
    </p>
    <div class="txxx_info">
        <div class='form'>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'ServiceCar-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true)
            ));
            ?>
            <div class='row'>
                <?php echo $form->labelEx($model, '车牌号：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'LicensePlate', array('class' => 'width213 input')); ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'LicensePlate', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '行驶证号：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'VehicleLicense', array('class' => 'width213 input')); ?>
                <?php echo $form->error($model, 'VehicleLicense', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '使用性质：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php
                echo $form->dropDownList($model, 'UseNature', array(
                    '1' => '私家车',
                    '2' => '公务车',
                    '3' => '运营车'
                        ), array(
                    'class' => 'width118 select',
                    'empty' => '请选择',
                ));
                ?>
                <?php echo $form->error($model, 'Sex', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '服务关系：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php
                echo $form->dropDownList($model, 'Relation', array(
                    '1' => '长期',
                    '2' => '暂时'
                        ), array(
                    'class' => 'width118 select',
                    'empty' => '请选择',
                ));
                ?>
                <?php echo $form->error($model, 'Sex', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '配件档次：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php
                echo $form->dropDownList($model, 'PartsLevel', array(
                   'A' => '原厂',
                    'B' => '高端品牌',
                    'C' => '经济实用',
                    'D' => '下线',
                    'E' => '拆车'
                        ), array(
                    'class' => 'width118 select',
                    'empty' => '请选择',
                ));
                ?>
                <?php echo $form->error($model, 'Sex', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '购置时间：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>&nbsp;
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language' => 'zh_cn',
                    'attribute' => 'BuyTime',
                    'model' => $model,
                    //'value'=>'aaaa',//date("Y-m-d",$model->BuyTime),//设置默认值
                    'name' => 'BuyTime',
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd',
                        'changeYear'=>true
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'BuyTime', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '行驶里程(km)：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'Mileage', array('class' => 'input','maxlength'=>10)); ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'Mileage', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '车架号/VIN码(前10位)：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                <?php echo $form->textField($model, 'VinCode', array('class' => 'width213 input', 'id' => 'text')); ?>
                <?php echo $form->error($model, 'VinCode', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>  
                <div class='row'id="brand1">
                    <?php echo $form->hiddenField($model, 'Code', array('id' => 'car_code'));?>
                    <input id="is_car_code" name="Code" value="1"type="hidden">
                    <?php echo $form->labelEx($model, '汽车品牌：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                    <?php echo $form->textField($model, 'Car', array('class' => 'width213 input', 'id' => 'make-select-index')); ?>
                    <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
                </div>
                <div id="select" class='row'>
                    <?php echo $form->labelEx($model, '选择车主：', array('style' => 'height:20px;line-height:20px', 'class' => 'label')); ?>
                    <input class="input" type="text" id="selOwner" readonly="readonly" name="Name" />
                </div>
                <div id="showOwner" class='row' style="display:none">
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
                                'name' => '车主姓名',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->Name)',
                                'headerHtmlOptions' => array('style' => 'width:100px;'),
                                'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '昵称',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->NickName)',
                                'headerHtmlOptions' => array('style' => 'width:100px;'),
                                'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '驾驶环境',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->DrivingEnvironment)',
                                'headerHtmlOptions' => array('style' => 'width:55px;'),
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '驾驶证号',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->DrivingLicense)',
                                'headerHtmlOptions' => array('style' => 'width:80px;'),
                                'htmlOptions' => array('style' => 'width:100px;word-wrap: break-word;word-break: normal;white-space:normal;')
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '邮箱',
                                'type' => 'raw',
                                'value' => 'CHtml::encode($data->Email)',
                                'headerHtmlOptions' => array('style' => 'width:80px;'),
                                'htmlOptions' => array('style' => 'width:80px;word-wrap: break-word;word-break: normal;white-space:normal;')
                            ),
                            array(// display 'author.username' using an expression
                                'name' => '所在城市',
                                'type' => 'raw',
                                'value' => 'CHtml::encode(Area::getCity($data->City))',
                                'headerHtmlOptions' => array('style' => 'width:60px;'),
                            ),
                        ),
                    ));
                    ?>
                </div>
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
                $("#ServiceCar-form").submit();
            });

            $("#return").live('click', function() {
                window.location.href = "<?php echo Yii::app()->createUrl('servicer/servicevehicle/index'); ?>";
            });

            $("#selOwner").click(function() {
                $("#showOwner").show();
            });
            $("#yw0 .table tr").live('click', function() {
                $("#selOwner").val($(this).find('td:eq(1)').text());
            });
        });
    </script>