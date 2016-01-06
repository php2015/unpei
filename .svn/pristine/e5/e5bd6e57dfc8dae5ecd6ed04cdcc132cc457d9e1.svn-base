<style>
    .dom-display4 {
        padding: 0;
    }
    .width270{
        width: 270px;
    }
    .more{
        padding-left: 175px;
        padding-top: 5px; 
        display: block;
        color: #0065bf;
        padding-bottom: 10px;
    }
 
    table {
        table-layout:fixed;
        *height:20px;
    }
    td,th{*vertical-align:middle}
</style>
<div id="layout-t4" class="tab-product tab-sub-3 ui-style-gradient" >
    <h2 class="tab-hd"> 
        <span class="tab-hd-con current" style="margin-left:30px" key="serviceowner"><a href="javascript:;">车主信息</a></span>
        <span class="tab-hd-con" key="servicevehicle"><a href="javascript:;">车辆信息</a></span>
        <span class="tab-hd-con" key="servicemanage"  style="border-right: 1px solid #e2e2e2" ><a href="javascript:;">服务记录</a></span> 
    </h2>
    <div class="tab-bd dom-display  dom-display8">
        <div class="tab-bd-con serviceowner" style="display:block"> 
            <form id="searchowner" method="post" action="<?php echo Yii::app()->createUrl('servicer/serviceowner/index') ?>">
                <p>
                    <label class="label1 m_left12">手机号：</label>
                    <input type="text" name="phone" class="input width270">
                </p>
                <p>
                    <label class="label1">车主姓名：</label>
                    <input type="text" name="name" class="input width270">
                </p>
                <p align="center">
                    <input type="button" value="查 询" class="submit m_left" id="searchownerbutton">
                </p>
            </form>
        </div>
        <div class="tab-bd-con servicevehicle"> 
            <form id="searchcar" method="post" action="<?php echo Yii::app()->createUrl('servicer/servicevehicle/index') ?>">
                <p>
                    <label class="label1 m_left12">车牌号：</label>
                    <input type="text" name="LicensePlate" class="input width270">
                </p>
                <p>
                    <label class="label1">行驶证号：</label>
                    <input type="text" name="VehicleLicense" class="input width270">
                </p>
                <p>
                    <label class="label1">购置时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language' => 'zh_cn',
                        //'value'=>'aaaa',//date("Y-m-d",$model->BuyTime),//设置默认值
                        'name' => 'BuyTime',
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'style' => 'width:120px;',
                            'class' => 'input',
                        )
                    ));
                    ?>
                    <label class="label1">使用性质：</label>
                    <select  class="select" style=" width: 100px" name="UseNature">
                        <option value="">请选择</option>
                        <option value="1">私家车</option>
                        <option value="2">公务车</option>
                        <option value="3">运营车</option>
                    </select>
                </p>
                <p align="center">
                    <input type="button" value="查 询" class="submit m_left" id="searchcarbutton">
                </p>
            </form>
        </div>
        <div class="tab-bd-con servicemanage" style=" padding-left: 0px;"> 
            <?php
//            var_dump(Servicemanage::servicegetmanagelist());
            $this->widget('widgets.default.WGridView', array(
                'dataProvider' => Servicemanage::servicegetmanagelist(),
//                'pager' => false,
                'columns' => array(
                    array(// display 'create_time' using an expression
                        'name' => '序号',
                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '车主姓名',
                        'value' => 'CHtml::encode($data->vehicle->owner->Name)',
                		'htmlOptions'=>array('style'=>'white-space:nowrap;overflow: hidden;text-overflow:ellipsis')
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '车牌号',
                        'value' => 'CHtml::encode($data->vehicle->LicensePlate)',
                        'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '手机号',
                        'value' => 'CHtml::encode($data->vehicle->owner->Phone)',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '服务类型',
                        'value' => 'CHtml::encode($data->ServiceType)',
                    ),
                    array(
                        // display a column with "view", "update" and "delete" buttons
                        'class' => 'CButtonColumn',
                        'header' => '操作',
                        'template' => '{view}{update}',
                        'buttons' => array(
                            'view' => array(
                                'label' => '详情',
                                'url' => 'Yii::app()->createUrl("/servicer/servicemanage/detail",array("id"=>$data->ID))'
                            ),
                            'update' => array(
                                'label' => '编辑',
                                'url' => 'Yii::app()->createUrl("/servicer/servicemanage/edit",array("id"=>$data->ID))'
                            ),
                        ),
                    ),
                ),
            ));
            ?>
            <div><a class="more" href="<?php echo Yii::app()->createUrl("servicer/servicemanage/index") ?>">查看更多</a></div>
        </div>

    </div>
</div>
<script>

    //搜索
    $("#searchcarbutton").click(function(){
        if(!$('input[name=LicensePlate]').val() && !$('input[name=VehicleLicense]').val() && !$('input[name=BuyTime]').val() && !$('select[name=UseNature]').val()){
            alert('请输入查询条件');
            return false;
        }
        $("#searchcar").submit()
    })          
    $("#searchownerbutton").click(function(){
        if(!$('input[name=name]').val() && !$('input[name=phone]').val()){
            alert('请输入查询条件');
            return false;
        }
        $("#searchowner").submit()
    })
</script>