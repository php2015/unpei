<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 90px !important;
    }
</style>
<!--头部开始-->
<?php
if ($model->ID) {
    $this->breadcrumbs = array(
        '技术服务点管理' => Yii::app()->createUrl('maker/makecompany/technique'),
        '修改技术服务点'
    );
} else {
    $this->breadcrumbs = array(
        '技术服务点管理' => Yii::app()->createUrl('maker/makecompany/technique'),
        '添加技术服务点'
    );
}
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">填写基本信息
    	<span style=" float:right; margin-right:20px">
		<a id="return" style="font-weight:400" href="<?php echo Yii::app()->createUrl('maker/makecompany/technique');?>">返回</a>
		</span>
    </p>
    <div class="txxx_info">
    <div class='form'>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'MakeTechnique-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array('validateOnSubmit' => true),
                ));
        ?>
        <?php echo $form->hiddenField($model, 'OrganID'); ?>
        <div class='row'>
            <?php echo $form->labelEx($model, '机构名称：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'OrganName', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'OrganName', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '服务项目：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'ServiceProject', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'ServiceProject', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php $serviceTime = explode(' ', $model->ServiceTime); ?>
            <?php $week = explode('至', $serviceTime[0]); ?>
            <?php $hour = explode('-', $serviceTime[1]); ?>
            <?php echo $form->labelEx($model, '服务时间：', array('class' => 'label')); ?>
            <?php
            echo CHtml::dropDownList('beginWeek', $week[0], array(
                '周一' => '周一',
                '周二' => '周二',
                '周三' => '周三',
                '周四' => '周四',
                '周五' => '周五',
                '周六' => '周六',
                '周日' => '周日',
                    ), array('class' => 'width118 select'));
            ?>
            至
            <?php
            echo CHtml::dropDownList('endWeek', $week[1], array(
                '周一' => '周一',
                '周二' => '周二',
                '周三' => '周三',
                '周四' => '周四',
                '周五' => '周五',
                '周六' => '周六',
                '周日' => '周日',
                    ), array('class' => 'width118 select'));
            ?>
            <span id="weekerror" style="color:red"></span>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '服务时间点：', array('class' => 'label')); ?>
            <?php for ($i = 0; $i < 24; $i++): ?>
                <?php $key = $i . ':00'; ?>
                <?php $time[$key] = $key; ?>
            <?php endfor; ?>
            <?php echo CHtml::dropDownList('beginHour', $hour[0], $time, array('class' => 'width118 select')); ?>
            —
            <?php echo CHtml::dropDownList('endHour', $hour[1], $time, array('class' => 'width118 select')); ?>
            <span id="hourerror" style="color:red"></span>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '授权服务地区：', array('class' => 'label')); ?>
            <?php
            $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));
            $state = CHtml::listData($state_data, "ID", "Name");
            $s_default = $model->isNewRecord ? '' : $model->ServiceProvince;
            echo $form->dropDownList($model, 'ServiceProvince', $state, array(
                'class' => 'width118 select',
                'empty' => '请选择省份',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                    'update' => '#MakeTechnique_ServiceCity', //selector to update
                    'data' => 'js:"province="+jQuery(this).val()',
                    )));
            ?>
            <?php
            //empty since it will be filled by the other dropdown
            $c_default = $model->isNewRecord ? '' : $model->ServiceCity;
            if (!$model->isNewRecord) {
                $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->ServiceProvince));
                $city = CHtml::listData($city_data, "ID", "Name");
            }

            $city_update = $model->isNewRecord ? array() : $city;
            echo $form->dropDownList($model, 'ServiceCity', $city_update, array(
                'class' => 'width118 select',
                'empty' => '请选择城市',
            ));
            ?>  
            <?php echo $form->error($model, 'ServiceCity', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '联系人：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'Contacts', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'Contacts', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '联系电话：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'Telephone', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'Telephone', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '机构地址：', array('class' => 'label')); ?>
            <?php
            $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));

            $state = CHtml::listData($state_data, "ID", "Name");
            $s_default = $model->isNewRecord ? '' : $model->AddProvince;
            echo $form->dropDownList($model, 'AddProvince', $state, array(
                'class' => 'width118 select',
                'empty' => '请选择省份',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                    'update' => '#MakeTechnique_AddCity', //selector to update
                    'data' => 'js:"province="+jQuery(this).val()',
                    )));
            ?>
            <?php
            //empty since it will be filled by the other dropdown
            $c_default = $model->isNewRecord ? '' : $model->AddCity;
            if (!$model->isNewRecord) {
                $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->AddProvince));
                $city = CHtml::listData($city_data, "ID", "Name");
            }

            $city_update = $model->isNewRecord ? array() : $city;
            echo $form->dropDownList($model, 'AddCity', $city_update, array(
                'class' => 'width118 select',
                'empty' => '请选择城市',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict', //url to call
                    'update' => '#MakeTechnique_AddArea', //selector to update
                    'data' => 'js:"city="+jQuery(this).val()',
                    )));
            ?>
            <?php
            $d_default = $model->isNewRecord ? '' : $model->AddArea;
            if (!$model->isNewRecord) {
                $district_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->AddCity));
                $district = CHtml::listData($district_data, "ID", "Name");
            }
            $district_update = $model->isNewRecord ? array() : $district;
            echo $form->dropDownList($model, 'AddArea', $district_update, array(
                'class' => 'width118 select',
                'empty' => '请选择地区',
                    )
            );
            ?>
            <?php echo $form->error($model, 'AddProvince', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '街道地址：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'AddStreet', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'AddStreet', array('style' => 'color: red;')); ?>
        </div>
        <div class='row' style="padding-left:200px;margin-bottom:10px;">
            <?php if ($model->ID): ?>
                <?php echo $form->hiddenField($model, 'ID'); ?>
            <?php endif; ?>
            <input class='submit' type='button' id="save" value='保存'/>
        </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<script type="text/javascript">
    function getWeek(week){
        if(week=='周一'){
            return '1';
        }else if(week=='周二'){
            return '2';
        }else if(week=='周三'){
            return '3';
        }else if(week=='周四'){
            return '4';
        }else if(week=='周五'){
            return '5';
        }else if(week=='周六'){
            return '6';
        }else if(week=='周日'){
            return '7';
        }
    }
    $(document).ready(function(){
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?"))
            {
                var weekerror=$("#weekerror").html();
                var hourerror=$("#hourerror").html();
                if(hourerror==''&&weekerror==''){
                    $("#MakeTechnique-form").submit();
                }
            }
        });
        $("#endWeek").change(function(){
            var endWeek=parseInt(getWeek($(this).val()));
            var beginWeek=parseInt(getWeek($("#beginWeek").val()));
            if(parseInt(endWeek)<parseInt(beginWeek)){
                $("#weekerror").html('开始时间不能晚于结束时间');
            }else{
                $("#weekerror").html('');
            }
        })
        $("#beginWeek").change(function(){
            var beginWeek=parseInt(getWeek($(this).val()));
            var endWeek=parseInt(getWeek($("#endWeek").val()));
            if(parseInt(endWeek)<parseInt(beginWeek)){
                $("#weekerror").html('开始时间不能晚于结束时间');
            }else{
                $("#weekerror").html('');
            }
        })
        $("#endHour").change(function(){
            str=$(this).val();
            strs=str.split(":");
            var endhour=parseInt(strs[0]);
            str=$("#beginHour").val();
            strs=str.split(":");
            var beginHour=parseInt(strs[0]);
            if(parseInt(endhour)<parseInt(beginHour)){
                $("#hourerror").html('开始时间不能晚于结束时间');
            }else{
                $("#hourerror").html('');
            }
        })
        $("#beginHour").change(function(){
            str=$(this).val();
            strs=str.split(":");
            var beginHour=parseInt(strs[0]);
            str=$("#endHour").val();
            strs=str.split(":");
            var endhour=parseInt(strs[0]);
            if(parseInt(endhour)<parseInt(beginHour)){
                $("#hourerror").html('开始时间不能晚于结束时间');
            }else{
                $("#hourerror").html('');
            }
        })
        $("#MakeTechnique_AddProvince").change(function(){
            var url="<?php echo Yii::app()->request->baseUrl; ?>";
            if($(this).val()){
                var province=$(this).val();
                $.getJSON(url+'/common/dynamicarea',{province:province},function(data){
                    if(data!=''){
                        $("#MakeTechnique_AddArea").empty();
                        $.each(data, function(key,val){      
                            jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#MakeTechnique_AddArea");
                        }); 
                    }
                });
            }else{
                $("#MakeTechnique_AddArea").empty();
                $("<option value=''>请选择地区</option>").appendTo("#MakeTechnique_AddArea");
            }
        });
    })
</script>