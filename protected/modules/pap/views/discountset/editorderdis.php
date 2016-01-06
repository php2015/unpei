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
    '营销管理'=>Yii::app()->createUrl('common/marketlist'),
     '营销参数设置'=>Yii::app()->createUrl('pap/discountset/discountset') ,
    '修改订单折扣率' ,
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">修改订单折扣率</p>
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
                <?php echo $form->labelEx($model, '订单类型：', array('class' => '')); ?>
                <span>&nbsp;<?php echo $form->labelEx($model, $orderType, array('class' => 'label')); ?></span>
                <?php //echo $form->textField($model, 'OrderType', array('class' => 'width213 input')); ?>
                <?php //echo $form->error($model, 'OrderType', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '支付宝担保折扣率：', array('class' => 'label')); ?>
                <?php echo $form->textField($model, 'OrderAlipay', array('class' => 'width213 input', 'id' => 'text')); ?>
                <?php echo $form->error($model, 'OrderAlipay', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '物流代收款折扣率：', array('class' => 'label')); ?>
                <?php echo $form->textField($model, 'OrderLogis', array('class' => 'width213 input', 'id' => 'text2')); ?>
                <?php echo $form->error($model, 'OrderLogis', array('style' => 'color: red;')); ?>
            </div>
            <div class='row' style="padding-left:200px;">
                <?php if ($model->ID): ?>
                    <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php endif; ?>
                <input class='submit' type='button' id="save" value='保存'/>
                <input class='submit' type='button' id="nosave" value='返回'/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#save").click(function(){
            var text =$('input[id=text]').val();
            var text2 =$('input[id=text2]').val();
            if(window.confirm("您确定要保存吗?"))
            {
                if(isNaN(text)){
                    alert('请输入输数字');
                    return false; 
                }
                if(text>=100 || text<=0){
                    alert('折扣率必须在1-100之间的数值');
                    return false; 
                }
                if(text2>100 || text2<=0){
                    alert('折扣率必须在1-100之间的数值');
                    return false; 
                }
                if(isNaN(text2)){
                    alert('请输入输数字');
                    return false; 
                }
                $("#financial-form").submit();
            }
        });
        
        $('#nosave').click(function(){
               
            window.location.href=Yii_baseUrl+"/pap/discountset/discountset";
        })
    })
</script>


