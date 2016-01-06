<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
</style>
<?php
$this->breadcrumbs = array(
    '营销管理' => Yii::app()->createUrl('common/marketlist'),
    '客户管理',
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">修改基本信息</p>
    <div class="txxx_info">
        <div class='form'>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'financial-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                    // 'clientOptions' => array('validateOnSubmit' => true)
                    ));
            ?>
            <div class='row'>
                <?php echo $form->labelEx($model, '机构名称：', array('class' => 'label')); ?>
                <?php echo $form->textField($model, 'OrganName', array('class' => 'width213 input', 'readonly' => 'true')); ?>
                <?php echo $form->error($model, 'OrganName', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '客户级别：', array('class' => 'label')); ?>
                <?php echo $form->dropDownList($model, 'Cooperationtype', array('A' => 'A', 'B' => 'B', 'C' => 'C',), array('class' => 'width213 input')); ?>
                <?php echo $form->error($model, 'Cooperationtype', array('style' => 'color: red;')); ?>
            </div>

            <div class='row' style="padding-left:200px;">
                <?php if ($model->ID): ?>
                    <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php endif; ?>
                <input class='submit' type='button' id="save" value='保存'/>
                <input class='submit' type='button' id="nosave" value='取消'/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?"))
            {
                $("#financial-form").submit();
            }
        });
        
        $('#nosave').click(function(){
            window.location.href=Yii_baseUrl+"/pap/contact/index";
        })
    })
</script>
