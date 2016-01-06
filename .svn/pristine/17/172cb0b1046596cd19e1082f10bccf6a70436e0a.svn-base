<?php
if ($model['OperateType'] == 1) {
    $str = "更换配件";
} else {
    $str = "维修配件";
}

$this->pageTitle = Yii::app()->name . '-' . $str;
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '修改服务记录' => Yii::app()->createUrl('servicer/servicemanage/edit', array('id' => $model->ServiceID)),
    $str
);
?>
<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
</style>
<?php $part = explode(",", $model->PartName); ?>
<!--内容部分-->
<div id="addowner" class="bor_back m_top10">
    <p class="txxx">
        <?php echo $str; ?>
    </p>
    <p>
        <span style="display:block;float: right;margin-top: -25px;margin-right: 15px;">
            <a id="back" style="font-weight:400" href="javascript:void(0)">返回</a>
        </span>
    </p>
    <div class="txxx_info">
        <div class='form'>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'ServicePartsEdit-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                    //'clientOptions' => array('validateOnSubmit' => true)
            ));
            ?>
            <div class='row'>
                <?php echo $form->labelEx($model, '配件维修：', array('class' => 'label')); ?>
                <?php $this->widget("widgets.default.WGcategory", array('notlink' => 'Y', 'mainCategory' => $part['0'], 'subCategory' => $part['1'], 'leafCategory' => $part['2'])); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '品牌：', array('class' => 'label')); ?>
                <?php echo $form->textField($model, 'Brand', array('class' => 'width213 input', 'maxlength' => '10')); ?>
                <?php echo $form->error($model, 'Brand', array('style' => 'color: red;')); ?>
            </div>
            <?php if ($model->OperateType == 1) { ?>
                <div class='row'>
                    <?php echo $form->labelEx($model, '数量：', array('class' => 'label')); ?>
                    <?php echo $form->textField($model, 'Num', array('class' => 'width213 input', 'maxlength' => '5')); ?>
                    <?php echo $form->error($model, 'Num', array('style' => 'color: red;')); ?>
                </div>
                <div class='row'>
                    <?php echo $form->labelEx($model, 'ＯＥ号：', array('class' => 'label')); ?>
                    <?php echo $form->textField($model, 'OE', array('class' => 'width213 input', 'maxlength' => '20')); ?>
                    <?php echo $form->error($model, 'OE', array('style' => 'color: red;')); ?>
                </div>
            <?php } else { ?>
                <div class='row'>
                    <?php echo $form->labelEx($model, '技师名称：', array('class' => 'label')); ?>
                    <?php echo $form->textField($model, 'TechnicianName', array('class' => 'width213 input')); ?>
                    <?php echo $form->error($model, 'TechnicianName', array('style' => 'color: red;')); ?>
                </div>
                <div class='row'>
                    <?php echo $form->labelEx($model, '维修原因：', array('class' => 'label')); ?>
                    <?php echo $form->textArea($model, 'RepairCause', array('size' => 255, 'maxLength' => 128, 'class' => "textarea textarea2")); ?>
                    <?php echo $form->error($model, 'RepairCause', array('style' => 'color: red;')); ?>
                </div>
                <div class='row'>
                    <?php echo $form->labelEx($model, '修后说明：', array('class' => 'label')); ?>
                    <?php echo $form->textArea($model, 'RevisedNote', array('size' => 255, 'maxLength' => 128, 'class' => "textarea textarea2")); ?>
                    <?php echo $form->error($model, 'RevisedNote', array('style' => 'color: red;')); ?>
                </div>
            <?php } ?>
            <div class='row' style="padding-left:200px;margin-bottom:10px;">
                <input class='submit' type='button' id="save" value='保存'/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function() {
        $("#save").click(function() {
            if (window.confirm("您确定要保存吗?"))
            {
                $("#ServicePartsEdit-form").submit();
            }
        });
        $('#back').click(function() {
            history.go(-1);
        });
    });
    //限制IE文本域最大输入数
    $("textarea[maxlength]").keyup(function() {
        var area = $(this);
        var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
        if (max > 0) {
            if (area.val().length > max) { //textarea的文本长度大于maxlength
                area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
            }
        }
    });
    //复制的字符处理问题
    $("textarea[maxlength]").blur(function() {
        var area = $(this);
        var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
        if (max > 0) {
            if (area.val().length > max) { //textarea的文本长度大于maxlength
                area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
            }
        }
    });

</script>

