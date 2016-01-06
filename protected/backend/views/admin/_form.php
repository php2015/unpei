<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>
<p class="note"><?php echo '带 <span class="required">*</span> 为必填字段.'; ?></p>
<?php echo $form->errorSummary(array($organ, $model)); ?>
<?php echo $form->textFieldRow($model, 'UserName', array('size' => 20, 'maxlength' => 20)); ?>

<label for="User_password" class="control-label">密码</label>
<?php echo $form->passwordField($model, 'PassWord'); ?>
<?php echo $form->error($model, 'PassWord', array('class' => 'help-block', 'style' => 'color:#B94A48')); ?>

<label for="User_password" class="control-label">确认密码</label>
<?php echo $form->passwordField($model, 'verifyPassword', array('value' => $model->PassWord)); ?>
<?php echo $form->error($model, 'verifyPassword', array('class' => 'help-block', 'style' => 'color:#B94A48')); ?>

<?php echo $form->textFieldRow($organ, 'OrganName'); ?>
<?php echo $form->textFieldRow($organ, 'Email', array('prepend' => '@', 'style' => 'width:180px;')); ?>
<?php echo $form->textFieldRow($organ, 'Phone'); ?>
<?php echo $form->dropDownListRow($organ, 'Identity', Organ::itemAlias('Identity'), array('empty' => '请选择机构类型')); ?>

<?php echo $form->dropDownListRow($organ, 'Status', Organ::itemAlias('UserStatus')); ?>
<?php echo $form->dropDownListRow($organ, 'Type', Organ::itemAlias('usertype')); ?>
<?php     
     $res= Organ::model()->findAll('Identity=:iden',array(':iden'=>2));
?>
<?php echo $form->labelEx($organ, 'RecomID'); ?>
<?php echo Chtml::dropDownList('Organ[Recommend]',!empty($organ['Recommend'])?$organ['Recommend']:'',CHtml::listData($res,'OrganName','OrganName'), array(
    'class' => 'width90 select',
    'id' => 'recm',
    'empty' => '请选择推荐人',
        )
); ?>
<label  class="control-label">地址:</label>
<?php
$state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));
$state = CHtml::listData($state_data, "ID", "Name");
$s_default = $organ->isNewRecord ? '' : $organ->Province;
echo Chtml::dropDownList('Organ[Province]', $organ->Province, $state, array(
    'class' => 'easyui-validatebox width90 select',
    'id' => 'province',
    'empty' => '请选择省份',
    'ajax' => array(
        'type' => 'GET', //request type
        // 'url'=>CController::createUrl('dynamiccities'), //url to call
        'url' => Yii::app()->createUrl('/admin/Dynamiccities'),
        'update' => '#city', //lector to update
        'data' => 'js:"province="+jQuery(this).val()',
)));
//empty since it will be filled by the other dropdown
$c_default = $organ->isNewRecord ? '' : $organ->City;
if (!$organ->isNewRecord) {
    $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $organ->Province));
    $city = CHtml::listData($city_data, "ID", "Name");
}

$city_update = $organ->isNewRecord ? array() : $city;
echo Chtml::dropDownList('Organ[City]', $organ->City, $city_update, array(
    'class' => 'width90 select',
    'id' => 'city',
    'empty' => '请选择城市',
    'ajax' => array(
        'type' => 'GET', //request type
        'url' => Yii::app()->createUrl('/admin/dynamicdistrict'),
        'update' => '#area', //lector to update
        'data' => 'js:"city="+jQuery(this).val()',
)));
$d_default = $organ->isNewRecord ? '' : $organ->Area;
if (!$organ->isNewRecord) {
    $district_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $organ->City));
    $district = CHtml::listData($district_data, "ID", "Name");
}
$district_update = $organ->isNewRecord ? array() : $district;
echo Chtml::dropDownList('Organ[Area]', $organ->Area, $district_update, array(
    'class' => 'width90 select',
    'id' => 'area',
    'empty' => '请选择地区',
        )
);
?>
<?php
$data=array();
 for($i=1;$i<=255;$i++){
     $data[$i]=$i;
 }
?>
<?php echo $form->dropDownListRow($organ, 'Sort', $data); ?>
<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? '创建' : '保存',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(function() {
        //  $("input[name=CompanyType]:eq(0)").attr("checked",'checked'); 
        $("#province").change(function() {
            if ($(this).val()) {
                var province = $(this).val();
                var url = '<?php echo Yii::app()->createUrl('/admin/Dynamicarea') ?>';
                $.getJSON(url, {province: province}, function(data) {
                    if (data != '') {
                        $("#area").empty();
                        $.each(data, function(key, val) {
                            jQuery("<option value='" + key + "'>" + val + "</option>").appendTo("#area");
                        });
                    }
                });
            } else {
                $("#area").empty();
                $("<option value=''>请选择地区</option>").appendTo("#area");
            }
        });
    });
</script>