<?php
$action = 'article';
//$id = Yii::app()->user->id;
//$id = array_rand(array_fill_keys(range('a','z'), null), 1);
$id = NULL;
Yii::app()->getClientScript()->registerScript('editorparam', 'window.KEDITOR_PARAM = "action=' . $action . '&id=' . $id . '"', CClientScript::POS_HEAD);
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'article-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableAjaxValidation' => false,
        ));
?>


<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php
echo '<select id="CmsArticle_category_id" name="CmsArticle[CategoryID]">';

$category = CmsCategory::model()->findByPk(5);
$descendants = $category->descendants()->findAll();
$level = 1;
echo '<option value="">请选择分类</option>';
foreach ($descendants as $child) {
    $string = '&nbsp;&nbsp;';
    $string .= str_repeat('&nbsp;&nbsp;', $child->Level - $level);
    if ($child->isLeaf() && !$child->next()->find()) {
        $string .= '';
    } else {

        $string .= '';
    }
    $string .= '' . $child->Name;
//		echo $string;
    if (!$model->isNewRecord) {
        if ($model->CategoryID == $child->ID) {
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
<?php echo $form->textFieldControlGroup($model, 'Title', array('class' => 'span5')); ?>


<?php echo $form->dropDownListControlGroup($model, 'Language', array('en_us' => 'English' , 'zh_cn' => '中文')); ?>


<?php echo $form->textFieldControlGroup($model, 'From', array('class' => 'span5', 'value' => '本站')); ?>


<?php echo $form->textFieldControlGroup($model, 'Url', array('class' => 'span5')); ?>

<?php echo $form->textAreaControlGroup($model, 'Summary', array('class' => 'span5', 'style'=>'height:100px')); ?>

<?php echo $form->textAreaControlGroup($model, 'Content', array('visibility' => 'hidden')); ?>
<?php
$this->widget('ext.kindeditor.KindEditorWidget', array(
    'id' => 'CmsArticle_Content', //Textarea id
    'items' => array(
        'width' => '700px',
        'height' => '300px',
        'themeType' => 'simple',
        'allowImageUpload' => true,
        'allowFileUpload' => true,
        'allowFileManager' => true,
        'items' => array(
            'source', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
            'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
            'justifyright', 'insertorderedlist', 'insertunorderedlist', '|',
            'emoticons', 'image', 'multiimage', 'link',
        ),
    ),
    'options' => array('action' => $action, 'id' => $id)
));
?>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
)); ?>

<?php $this->endWidget(); ?>
