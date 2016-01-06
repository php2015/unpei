<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
</style>
<?php
if ($model->ID) {
    $this->breadcrumbs = array(
        '仓储服务点管理' => Yii::app()->createUrl('maker/makecompany/storage'),
        '修改仓储服务点'
    );
} else {
    $this->breadcrumbs = array(
        '仓储服务点管理' => Yii::app()->createUrl('maker/makecompany/storage'),
        '添加仓储服务点'
    );
}
?>
<div class="bor_back m_top10">
    <p class="txxx">填写基本信息
    	<span style=" float:right; margin-right:20px">
		<a id="return" style="font-weight:400" href="<?php echo Yii::app()->createUrl('maker/makecompany/storage');?>">返回</a>
		</span>
    </p>
    <div class="txxx_info">
        <div class='form'>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'MakeStorage-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array('validateOnSubmit' => true)
                ));
        ?>
        <div class='row'>
            <?php echo $form->labelEx($model, '机构名称：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'OrganName', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'OrganName', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '当天到货区域：', array('class' => 'label')); ?>
            <?php
            $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));

            $state = CHtml::listData($state_data, "ID", "Name");
            $s_default = $model->isNewRecord ? '' : $model->TodayArrPro;
            echo $form->dropDownList($model, 'TodayArrPro', $state, array(
                'class' => 'width118 select',
                'empty' => '请选择省份',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                    'update' => '#MakeStorage_TodayArrCity', //selector to update
                    'data' => 'js:"province="+jQuery(this).val()',
                    )));
            ?>
            <?php
            //empty since it will be filled by the other dropdown
            if (!$model->isNewRecord) {
                $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->TodayArrPro));
                $city = CHtml::listData($city_data, "ID", "Name");
            }

            $city_update = $model->isNewRecord ? array() : $city;
            echo $form->dropDownList($model, 'TodayArrCity', $city_update, array(
                'class' => 'width118 select',
                'empty' => '请选择城市',
            ));
            ?>   
            <?php echo $form->error($model, 'TodayArrCity', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '三天内到货区域：', array('class' => 'label')); ?>
            <?php
            $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));

            $state = CHtml::listData($state_data, "ID", "Name");
            $s_default = $model->isNewRecord ? '' : $model->TridArrPro;
            echo $form->dropDownList($model, 'TridArrPro', $state, array(
                'class' => 'width118 select',
                'empty' => '请选择省份',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                    'update' => '#MakeStorage_TridArrCity', //selector to update
                    'data' => 'js:"province="+jQuery(this).val()',
                    )));
            ?>
            <?php
            //empty since it will be filled by the other dropdown
            if (!$model->isNewRecord) {
                $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->TridArrPro));
                $city = CHtml::listData($city_data, "ID", "Name");
            }

            $city_update = $model->isNewRecord ? array() : $city;
            echo $form->dropDownList($model, 'TridArrCity', $city_update, array(
                'class' => 'width118 select',
                'empty' => '请选择城市',
            ));
            ?>   
            <?php echo $form->error($model, 'TridArrCity', array('style' => 'color: red;')); ?>
        </div>
        <div class='row'>
            <?php echo $form->labelEx($model, '三天以上到货区域：', array('class' => 'label')); ?>
            <?php
            $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));

            $state = CHtml::listData($state_data, "ID", "Name");
            $s_default = $model->isNewRecord ? '' : $model->TridAboveArrPro;
            echo $form->dropDownList($model, 'TridAboveArrPro', $state, array(
                'class' => 'width118 select',
                'empty' => '请选择省份',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                    'update' => '#MakeStorage_TridAboveArrCity', //selector to update
                    'data' => 'js:"province="+jQuery(this).val()',
                    )));
            ?>
            <?php
            //empty since it will be filled by the other dropdown
            $c_default = $model->isNewRecord ? '' : $model->TridAboveArrPro;
            if (!$model->isNewRecord) {
                $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->TridAboveArrPro));
                $city = CHtml::listData($city_data, "ID", "Name");
            }

            $city_update = $model->isNewRecord ? array() : $city;
            echo $form->dropDownList($model, 'TridAboveArrCity', $city_update, array(
                'class' => 'width118 select',
                'empty' => '请选择城市',
            ));
            ?>  
            <?php echo $form->error($model, 'TridAboveArrCity', array('style' => 'color: red;')); ?> 
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
            <?php echo $form->labelEx($model, '地址：', array('class' => 'label')); ?>
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
                    'update' => '#MakeStorage_AddCity', //selector to update
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
                    'update' => '#MakeStorage_AddArea', //selector to update
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
        <div class='row' style="padding-left:200px;margin-bottom:20px;">
            <?php if ($model->ID): ?>
                <?php echo $form->hiddenField($model, 'ID'); ?>
            <?php endif; ?>
            <input class='submit' type='button' id="save" value='保存'/>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div></div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#MakeStorage_AddProvince").change(function(){
            var url="<?php echo Yii::app()->request->baseUrl; ?>";
            if($(this).val()){
                var province=$(this).val();
                $.getJSON(url+'/common/dynamicarea',{province:province},function(data){
                    if(data!=''){
                        $("#MakeStorage_AddArea").empty();
                        $.each(data, function(key,val){      
                            jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#MakeStorage_AddArea");
                        }); 
                    }
                });
            }else{
                $("#MakeTechnique_AddArea").empty();
                $("<option value=''>请选择地区</option>").appendTo("#MakeTechnique_AddArea");
            }
        });
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?"))
            {
                $("#MakeStorage-form").submit();
            }
        });
    })
</script>
