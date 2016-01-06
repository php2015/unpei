<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'menu-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableAjaxValidation' => false,
        ));
$menuurl=F::uploadUrl().'common/frontmenu/';
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php
echo CHtml::dropDownList('mainMenu', $model->RootID, CHtml::listData(CActiveRecord::model('FrontMenu')->findAllByAttributes(array("ParentID" => 0)), 'ID', 'Name'), array(
    'prompt' => '选择主菜单',
    'ajax' => array(
        'type' => 'POST',
        'url' => $this->createUrl('getChildMenu'),
        'data' => array('ID' => 'js:this.value', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
        'success' => 'function(data) {
                            $("#secondMenu").html(data);
                            $("#secondMenu").show();
                        }',
)));
if ($model->RootID && $model->ParentID != $model->RootID) {
    $sonmenu = FrontMenu::model()->findAllByAttributes(array("ParentID" => $model->RootID));
    $sonmenu = CHtml::listData($sonmenu, 'ID', 'Name');
} else {
    $sonmenu = array();
}
echo CHtml::dropDownList('secondMenu', $model->ParentID, $sonmenu, array(
    'prompt' => '选择菜单',
    'ajax' => array(
        'type' => 'POST',
        'url' => $this->createUrl('getChildMenu'),
        'update' => '#thirdMenu',
        'data' => array('ID' => 'js:this.value', 'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
        'success' => 'function(data) {
                            $("#thirdMenu").html(data);
                            $("#thirdMenu").show();
                        }',
)));

echo CHtml::dropDownList('thirdMenu', '', array(), array('prompt' => '选择菜单'));
;
?>

<?php echo $form->textFieldRow($model, 'Name', array('class' => 'span5', 'maxlength' => 100)); ?>

<?php echo $form->textFieldRow($model, 'Url', array('class' => 'span5', 'maxlength' => 255, 'hint' => '格式为：模块/控制器/动作  Modules/Controller/action 没地址请留空')); ?>

<?php echo $form->textFieldRow($model, 'ExtraUrl', array('class' => 'span5', 'maxlength' => 255, 'hint' => '格式为：模块/控制器/动作  Modules/Controller/action 没地址请留空')); ?>

<?php echo $form->textFieldRow($model, 'ChildPage', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'Sort', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->hiddenField($model, 'ParentID'); ?>

<?php echo $form->hiddenField($model, 'MainMenuID'); ?>

<?php echo $form->hiddenField($model, 'RootID'); ?>

<?php echo $form->fileFieldControlGroup($model, 'Icon'); ?>
<?php if ($model->Icon): ?>
<label class="control-label">已上传图标</label>
<img src="<?php echo $menuurl.$model->Icon;?>">
<?php endif; ?>

<?php echo $form->fileFieldControlGroup($model, 'MenuIcon'); ?>
<?php if ($model->MenuIcon): ?>
<label class="control-label">已上传工作站图标</label>
<img src="<?php echo $menuurl.$model->MenuIcon;?>">
<?php endif; ?>

<?php echo $form->fileFieldControlGroup($model, 'ActiveIcon'); ?>
<?php if ($model->ActiveIcon): ?>
<label class="control-label">已上传活动图标</label>
<img src="<?php echo $menuurl.$model->ActiveIcon;?>">
<?php endif; ?>
<?php echo $form->dropDownListRow($model, 'type', array('0' => '否', '1' => '是')); ?>
<?php echo $form->dropDownListRow($model, 'IsShow', array('1' => '是', '0' => '否')); ?>
<?php echo $form->dropDownListRow($model, 'IsLarge', array('1' => '是', '0' => '否')); ?>
<?php echo $form->dropDownListRow($model, 'IsLeaf', array('1' => '是', '0' => '否')); ?>
<?php echo $form->textAreaRow($model, 'Memo', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>

<script>
    $("#mainMenu,#secondMenu,#thirdMenu").change(function() {
        $("#FrontMenu_ParentID").val(this.value);
        $("#FrontMenu_MainMenuID").val($("#secondMenu").val());
    });

    $($("#mainMenu").change(function() {
        $("#FrontMenu_RootID").val(this.value);
    }))

    $("#secondMenu").change(function() {
        $("#FrontMenu_MainMenuID").val(this.value);
    })

</script>