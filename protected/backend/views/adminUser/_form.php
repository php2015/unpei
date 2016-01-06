<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'admin-user-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">带 <span class="required">*</span> 为必填</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'UserName', array('class' => 'span5', 'maxlength' => 128)); ?>
<label >密码</label>
<?php echo $form->passwordField($model, 'PassWord', array('class' => 'span5', 'maxlength' => 128, 'value' => $model->PassWord)); ?>
<?php echo $form->error($model, 'PassWord', array('class' => 'help-block', 'style' => 'color:#B94A48')); ?>
<label >确认密码</label>
<?php echo $form->passwordField($model, 'verifyPassword', array('class' => 'span5', 'maxlength' => 128, 'value' => $model->PassWord)); ?>
<?php echo $form->error($model, 'verifyPassword', array('class' => 'help-block', 'style' => 'color:#B94A48')); ?>

<?php echo $form->textFieldRow($model, 'Email', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php echo $form->textFieldRow($model, 'Profile', array('class' => 'span5', 'maxlength' => 128)); ?>

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
