<?php
/* @var $this AssignmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('AuthModule.main', '用户'),
);
?>

<h1><?php echo Yii::t('AuthModule.main', '用户'); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped hover',
    'dataProvider' => $dataProvider,
	'emptyText' => Yii::t('AuthModule.main', 'No assignments found.'),
	'template'=>"{items}\n{pager}",
    'columns' => array(
        array(
            'header' => Yii::t('AuthModule.main', '用户名'),
            'class' => 'AuthAssignmentNameColumn',
        ),
        array(
            'header' => Yii::t('AuthModule.main', '分配项目'),
            'class' => 'AuthAssignmentItemsColumn',
        ),
        array(
            'class' => 'AuthAssignmentViewColumn',
        ),
    ),
)); ?>
