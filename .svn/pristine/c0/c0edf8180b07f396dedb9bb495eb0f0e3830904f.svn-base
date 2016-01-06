<style>
    .errorMessage {float:left; margin-left:360px; color:red; margin-top:-30px;}
    .label{width: 80px;}
</style>
<?php
if ($model->id) {
    $this->pageTitle = Yii::app()->name . ' - ' . "修改联系人";
} else {
    $this->pageTitle = Yii::app()->name . ' - ' . "添加联系人";
}
?>
<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('联系人列表', Yii::app()->createUrl('maker/makemarketing/contacts')); ?>
    <?php if ($model->id): ?>
        <?php echo CHtml::link('修改联系人', Yii::app()->createUrl('maker/makemarketing/addcontacts', array('id' => $_GET['id'])), array('class' => 'active')); ?>
    <?php else: ?>
        <?php echo CHtml::link('添加联系人', Yii::app()->createUrl('maker/makemarketing/addcontacts'), array('class' => 'active')); ?>
    <?php endif; ?>
    <?php //echo CHtml::link('批量导入', Yii::app()->createUrl('maker/makemarketing/batchimport/act/cont'));?>
</div>
<div class='tab-content'>
    <div class='form-list'>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'make-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array('validateOnSubmit' => true),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
                ));
        ?>
        <div class='title title-dashed-inline'>
            <span>机构信息</span>
        </div>
        <p class="form-row">
            <?php echo $form->labelEx($model, '机构名称：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'organName', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'organName', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '客户类型：', array('class' => 'label')); ?>
            <?php
            echo $form->dropDownList($model, 'customerType', array(
                'A' => 'A',
                'B' => 'B',
                'C' => 'C',
                    ), array('class' => 'width118 select', 'empty' => '请选择'));
            ?>
            <?php echo $form->error($model, 'customerType', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '合作类型：', array('class' => 'label')); ?>
            <?php
            echo $form->dropDownList($model, 'cooperateType', array(
                'A' => 'A',
                'B' => 'B',
                'C' => 'C',
                    ), array('class' => 'width118 select', 'empty' => '请选择'));
            ?>
            <?php echo $form->error($model, 'cooperateType', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '地址：', array('class' => 'label')); ?>
            <?php
            $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));

            $state = CHtml::listData($state_data, "id", "name");
            $s_default = $model->isNewRecord ? '' : $model->AddProvince;
            echo $form->dropDownList($model, 'AddProvince', $state, array(
                'class' => 'width118 select',
                'empty' => '请选择省份',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                    'update' => '#MakeContacts_AddCity', //selector to update
                    'data' => 'js:"province="+jQuery(this).val()',
                    )));

            //empty since it will be filled by the other dropdown
            $c_default = $model->isNewRecord ? '' : $model->AddCity;
            if (!$model->isNewRecord) {
                $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->AddProvince));
                $city = CHtml::listData($city_data, "id", "name");
            }

            $city_update = $model->isNewRecord ? array() : $city;
            echo $form->dropDownList($model, 'AddCity', $city_update, array(
                'class' => 'width118 select',
                'empty' => '请选择城市',
                'ajax' => array(
                    'type' => 'GET', //request type
                    'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict', //url to call
                    'update' => '#MakeContacts_AddArea', //selector to update
                    'data' => 'js:"city="+jQuery(this).val()',
                    )));
            $d_default = $model->isNewRecord ? '' : $model->AddArea;
            if (!$model->isNewRecord) {
                $district_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->AddCity));
                $district = CHtml::listData($district_data, "id", "name");
            }
            $district_update = $model->isNewRecord ? array() : $district;
            echo $form->dropDownList($model, 'AddArea', $district_update, array(
                'class' => 'width118 select',
                'empty' => '请选择地区',
                    )
            );
            ?>
            <?php echo $form->error($model, 'AddProvince', array('style' => 'color: red;margin-left: 500px;')); ?>
        </p>
        <p class="form-row">
<?php echo $form->labelEx($model, '街道地址：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'AddStreet', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'AddStreet', array('style' => 'color: red;')); ?>
        </p>
        <div class='divis10'></div>
        <div class='title title-dashed-inline'>
            <span>联系人信息</span>
        </div>
        <p class="form-row">
<?php echo $form->labelEx($model, '联系人姓名：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'contactsName', array('class' => 'width130 input')); ?>
            <?php echo $form->error($model, 'contactsName', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
<?php echo $form->labelEx($model, '性别：', array('class' => 'label')); ?>
            <?php
            echo $form->dropDownList($model, 'sex', array(
                '男' => '男',
                '女' => '女',
                    ), array('class' => 'width130 select'));
            ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '电话：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'telephone', array('class' => 'width130 input')); ?>
            <?php echo $form->error($model, 'telephone', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '邮箱：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'email', array('class' => 'width130 input')); ?>
            <?php echo $form->error($model, 'email', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '微信号：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'wechat', array('class' => 'width130 input')); ?>
            <?php echo $form->error($model, 'wechat', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <label class="label">QQ号：</label>
            <?php echo $form->textField($model, 'qq', array('class' => 'width130 input')); ?>
            <?php echo $form->error($model, 'qq', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '备注：', array('class' => 'label', 'style' => 'vertical-align: top;')); ?>
            <?php echo $form->textArea($model, 'remarks', array('size' => 255, 'maxlength' => 255, 'class' => 'width585 textarea')); ?>
            <?php echo $form->error($model, 'remarks', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row text-c">
            <?php if ($model->id): ?>
                <?php echo $form->hiddenField($model, 'id'); ?>
            <?php endif; ?>
            <input class="submit mt2em" type='button' id="save" value='保存'></input>
        </p>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?"))
            {
//                $("#save").attr("disabled",true);
                $("#make-form").submit();
            }
        });
        $("#MakeContacts_AddProvince").change(function(){
            var url="<?php echo Yii::app()->request->baseUrl; ?>";
            if($(this).val()){
                var province=$(this).val();
                $.getJSON(url+'/common/dynamicarea',{province:province},function(data){
                    if(data!=''){
                        $("#MakeContacts_AddArea").empty();
                        $.each(data, function(key,val){      
                            jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#MakeContacts_AddArea");
                        }); 
                    }
                });
            }else{
                $("#MakeContacts_AddArea").empty();
                $("<option value=''>请选择地区</option>").appendTo("#MakeContacts_AddArea");
            }
        });
    })
</script>