<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 130px !important;
    }
	.m_left120{margin-top:10px; margin-left:120px;}
</style>
<?php
$this->breadcrumbs = array(
    ('折扣率设置') => array('discountset'),
    ('修改订单折扣率')
);
?>

<!--内容部分-->
<div class="m_left120">
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
                <span>&nbsp;<?php echo $form->labelEx($model, $orderType, array('class' => '')); ?></span>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '支付宝担保折扣率：', array('class' => '')); ?>
                <?php echo $form->textField($model, 'OrderAlipay', array('class' => 'width213 input', 'id' => 'text')); ?>
                <?php echo $form->error($model, 'OrderAlipay', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '物流代收款折扣率：', array('class' => '')); ?>
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
               
            window.location.href=Yii_baseUrl+"/backend.php/discountset/discountset";
        })
    })
</script>


