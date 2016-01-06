<style>
 .key-active{ width:920px;margin:0 auto; border:1px solid #ebebeb; background: #fff; padding: 20px;min-height: 450px }   
 .p-key-act{ text-align: center}
 .p-key-act b{ font-size:14px;color:#0063c1}
 .active-title{ text-align: center; color:#f47202 ;font-size:12px; line-height: 20px; margin-top: 5px}
 .active-white{ text-align:center; font-size:12px}
 .m_left24{margin-left:24px}
 .m_left12{ margin-left: 12px}
 .m-top5{margin-top:5px}
  .m-top10{margin-top:10px}
  .active-checkbox{ vertical-align: middle; margin-right: 5px}
  .active-xy{ color:#0063c1}
  .errorMessage{color:red; position: absolute; top:5px ; left:615px}
  .active-row{ position:relative}
  
</style>
<div class='width998 content-row home-row auto_height bd1 key-active'>
    <?php $this->renderPartial('activehead')?>
    <div class="title tbg2">
        <p class="active-title">
            尊敬的<?php echo Yii::app()->user->name;?>用户您好!<br>
            您的账号需要重新修改密码后，才能被激活登陆由你配平台使用!请立即修改密码
        </p>
    </div>
    <div class='active-white pos-r'>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'active-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
           'clientOptions'=>array(
               'validateOnSubmit'=>true,
           )
//    'focus'=>array($model,'firstName'),
        ));
        ?>

        <?php //echo $form->errorSummary($model); ?>

        <div class="active-row m-top5">
            <label class=" m_left12">原始密码：</label>
            <?php echo $form->passwordField($model, 'PassWord',array('class'=>'input')); ?>
            <?php echo $form->error($model, 'PassWord'); ?>
        </div>
        <div class="active-row m-top5">
            <label class="m_left24">新密码：</label>
            <?php echo $form->passwordField($model, 'NewPassword' ,array('class'=>'input')); ?>
            <?php echo $form->error($model, 'NewPassword'); ?>
        </div>
        <div class="active-row m-top5">
            <label>确认新密码：</label>
            <?php echo $form->passwordField($model, 'verifynewPassword' ,array('class'=>'input')); ?>
            <?php echo $form->error($model, 'verifynewPassword'); ?>
        </div>
<!--        <div class="active-row m-top5">
            <?php // echo $form->checkbox($model, 'agreement',array('class' => 'active-checkbox')) ?><span>同意<a href="<?php //echo Yii::app()->createUrl('/user/agreement/agreement')?>" class="active-xy" target='_blank'><<由你配会员协议>></a></span>
            <?php //echo $form->error($model, 'agreement'); ?>
        </div>-->
        <div class="active-row  m-top10">
            <?php echo CHtml::submitButton('下一步', array('class' => 'submit')); ?>
            <button class="submit back" >返回登录页</button>
        </div>
         
        <?php $this->endWidget(); ?>
    </div><!-- form -->


    <div class='bg-white pos-r' style="height:100px;"></div>
</div>
<script>
    $('.back').click(function(){
        var url='<?php echo Yii::app()->createUrl('/user/logout')?>';
        window.open(url,"_self");
    })
</script>
