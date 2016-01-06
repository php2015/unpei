<?php
/* @var $this AssignmentController */
/* @var $model User */
/* @var $authItemDp AuthItemDataProvider */
/* @var $formModel AddAuthItemForm */
/* @var $form TbActiveForm */
/* @var $assignmentOptions array */

$this->breadcrumbs = array(
    Yii::t('AuthModule.main', '用户') => array('index'),
    CHtml::value($model, $this->module->userNameColumn),
);
?>

<h1><?php echo CHtml::encode(CHtml::value($model, $this->module->userNameColumn)); ?>
    <small><?php echo Yii::t('AuthModule.main', '用户'); ?></small>
</h1>

<div class="row-fruid">

    <div class="span6">

        <h3>
            <?php echo Yii::t('AuthModule.main', '权限'); ?>
            <small><?php echo Yii::t('AuthModule.main', '该用户所分配的项目'); ?></small>
        </h3>

        <?php $this->widget('bootstrap.widgets.TbGridView', array(
              'type' => 'striped condensed hover',
              'dataProvider' => $authItemDp,
              'emptyText' => Yii::t('AuthModule.main', '该用户没有任何权限!'),
              'hideHeader' => true,
              'template' => "{items}",
              'columns' => array(
                  array(
                      'class' => 'AuthItemDescriptionColumn',
                      'active' => true,
                  ),
                  array(
                      'class' => 'AuthItemTypeColumn',
                      'active' => true,
                  ),
                  array(
                      'class' => 'AuthAssignmentRevokeColumn',
                      'userId' => $model->{$this->module->userIdColumn},
                  ),
              ),
        )); ?>

        <?php if (!empty($assignmentOptions)): ?>

            <h4><?php echo Yii::t('AuthModule.main', '分配权限'); ?></h4>

            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'type' => 'inline',
            )); ?>

            <?php echo $form->dropDownList($formModel, 'items', $assignmentOptions, array('label' => false)); ?>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
              'buttonType' => 'submit',
              'label' => Yii::t('AuthModule.main', '分配'),
            )); ?>

            <?php $this->endWidget(); ?>
        <?php endif; ?>

    </div>

</div>