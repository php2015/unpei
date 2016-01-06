<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'cmscategory-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<?php
if (!$model->isNewRecord) {
    $category_check = CmsCategory::model()->findByPk($model->ID);
    $parent = $category_check->parent()->find();
}
echo '<select id="CmsCategory_node" name="CmsCategory[node]">';

$descendants = CmsCategory::model()->findAll(array('condition' => 'Root=1', 'order' => 'Lft'));
$level = 1;
foreach ($descendants as $child) {
    $string = '&nbsp;&nbsp;';
    $string .= str_repeat('&nbsp;&nbsp;', 2*($child->Level - $level));
//    if ($child->isLeaf() && !$child->next()->find()) {
//        $string .= '&nbsp;&nbsp;';
//    } else {
//
//        $string .= '';
//    }
    $string .= $child->Name;
//		echo $string;
    if (!$model->isNewRecord) {
        if ($parent->ID == $child->ID) {
            $selected = 'selected';

            echo '<option value="' . $child->ID . '" selected="' . $selected . '">' . $string . '</option>';
        } else {
            echo '<option value="' . $child->ID . '" >' . $string . '</option>';
        }
    } else {
        echo '<option value="' . $child->ID . '" >' . $string . '</option>';
    }
}
echo '</select>';
?>
<?php echo $form->textFieldRow($model, 'Name'); ?>
    <?php //echo $form->textFieldControlGroup($model, 'Name', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
)); ?>

<?php $this->endWidget(); ?>
