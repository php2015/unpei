<div class="wrapper">
    <!--头部开始-->
    <?php
    if ($model->ID) {
        $this->breadcrumbs = array(
            '物流配送管理' => Yii::app()->createUrl('maker/makecompany/distribution'),
            '修改物流配送商'
        );
    } else {
        $this->breadcrumbs = array(
            '物流配送管理' => Yii::app()->createUrl('maker/makecompany/distribution'),
            '添加物流配送商'
        );
    }
    ?>
</div>
<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">填写基本信息
    	<span style=" float:right; margin-right:20px">
		<a id="return" style="font-weight:400" href="<?php echo Yii::app()->createUrl('maker/makecompany/distribution');?>">返回</a>
		</span>
    </p>
    <div class="txxx_info">
    <div class='form'>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'distribution-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array('validateOnSubmit' => true),
                ));
        ?>
        <?php echo $form->hiddenField($model, 'OrganID'); ?>

        <div class="row">
            <?php echo $form->labelEx($model, '配送商名称：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'Name', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'Name', array('style' => 'color:red;')); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, '价格系数：', array('class' => 'label')); ?>
            <?php
            echo $form->dropDownList($model, 'PriceRatio', array(
                '90%' => '90%',
                '80%' => '80%',
                '70%' => '70%',
                '60%' => '60%',
                '50%' => '50%',
                    ), array('class' => 'width120 select'));
            ?>
            <?php echo $form->labelEx($model, '配送时间：', array('class' => 'label-inline', 'style' => 'width:75px;')); ?>
            <?php
            echo $form->dropDownList($model, 'DistributionTime', array(
                '1天内' => '1天内',
                '2天内' => '2天内',
                '3天内' => '3天内',
                '4天内' => '4天内',
                '5天内' => '5天内',
                    ), array('class' => 'width120 select'));
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, '配送范围：', array('class' => 'label')); ?>
            <?php echo $form->textField($model, 'DistributionScope', array('class' => 'width213 input')); ?>
            <?php echo $form->error($model, 'DistributionScope', array('style' => 'color: red;')); ?>
        </div>
        <div class="row" style="padding-left:200px;margin-bottom:10px;">
            <?php if ($model->ID): ?>
                <?php echo $form->hiddenField($model, 'ID'); ?>
            <?php endif; ?>
            <input class="submit" id="save" type="button" value='保存'></input>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    </div>
    <!--内容部分结束-->
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?"))
            {
                $("#distribution-form").submit();
            }
        });
    })
</script>