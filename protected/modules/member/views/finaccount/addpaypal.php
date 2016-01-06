<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 金融帐号管理';
if (Yii::app()->user->Identity=="maker"){
	$url = Yii::app()->createUrl("");
}elseif (Yii::app()->user->Identity=="dealer"){
	$url = Yii::app()->createUrl("common/dealmemberlist");
}else {
	$url = Yii::app()->createUrl("common/memberlist");
}
$this->breadcrumbs = array(
	'用户中心' => $url,
    '金融账户管理' => Yii::app()->createUrl('member/finaccount/index'),
    '添加金融账户'
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">填写基本信息
        <span style="float:right; margin-right:20px;*margin-top:-35px">
            <a id="return" style="font-weight:400" href="javascript:void(0)">返回</a>
        </span>
    </p>
    <div class="txxx_info">
        <div class='form'>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'financial-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true)
                    ));
            ?>
            <div class='row'>
                <?php echo $form->labelEx($model, '姓名：', array('class' => 'label','style'=>'height:20px;line-height:20px;')); ?>
                <?php echo $form->textField($model, 'OwnerName', array('class' => 'width213 input')); ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'OwnerName', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '支付账号：', array('class' => 'label','style'=>'height:20px;line-height:20px;')); ?>
                <?php echo $form->textField($model, 'PaypalAccount', array('class' => 'width213 input')); ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'PaypalAccount', array('style' => 'color: red;')); ?>
            </div>
            <div class='row'>
                <?php echo $form->labelEx($model, '用途：', array('class' => 'label','style'=>'height:20px;line-height:20px;')); ?>
                <?php echo $form->textField($model, 'Uses', array('class' => 'width213 input')); ?>
                <?php echo $form->error($model, 'Uses', array('style' => 'color: red;')); ?>
            </div>
            <div class='row' style="padding-left:200px;margin-bottom:10px;">
                <?php if ($model->ID): ?>
                    <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php endif; ?>
                <input class='submit' type='button' id="save" value='保存'/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function(){
        $.post(
        Yii_baseUrl+"/member/finaccount/isone/",
        function(result){
            if(result!=0){
                alert("警告：错误操作！");
                location.href=Yii_baseUrl+"/member/finaccount/index";
            }
        },
        'json'
    ); 
        $("#save").click(function(){
            //if(window.confirm("您确定要保存吗?"))
            //{
            $("#financial-form").submit();
            //}
        });
        $("#return").live('click',function(){
            window.location.href="<?php echo Yii::app()->createUrl('member/finaccount/index'); ?>";
        });
    })
</script>
