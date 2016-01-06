<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Registration");
$this->breadcrumbs = array(
    UserModule::t("Registration"),
);
?>
<div class='width998 content-row home-row auto_height bd1'>
    <div class="title tbg2">请填写以下信息
        <span class="right-title">已注册,马上<a href="<?php echo Yii::app()->createUrl('user/login') ?>" >登录</a></span>
    </div>
    <div class='bg-white pos-r'>

        <?php if (Yii::app()->user->hasFlash('registration')): ?>
            <div class="msg-success">
                <?php echo Yii::app()->user->getFlash('registration'); ?>
            </div>
        <?php else: ?>

            <div class="form">
                <?php
                $form = $this->beginWidget('UActiveForm', array(
                    'id' => 'registration-form',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                    'disableAjaxValidationAttributes' => array('RegistrationForm_verifyCode'),
                    'clientOptions' => CMap::mergeArray(Yii::app()->params['clientOptions'], array(
                        'validateOnSubmit' => true,
                            )
                    ),
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                        ));
                ?>

                <?php //echo $form->errorSummary(array($model,$profile));  ?>

                <div class="row">
                    <?php echo $form->labelEx($model, '账号:'); ?>
                    <?php echo $form->textField($model, 'username'); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, '昵称:'); ?>
                    <?php echo $form->textField($model, 'nicknames'); ?>
                    <?php echo $form->error($model, 'nicknames'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, '密码:'); ?>
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <?php echo $form->error($model, 'password'); ?>
                    <!-- 
                    <p class="hint"><?php //echo UserModule::t("Minimal password length 4 symbols.");          ?></p>
                    -->
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, '确认密码:'); ?>
                    <?php echo $form->passwordField($model, 'verifyPassword'); ?>
                    <?php echo $form->error($model, 'verifyPassword'); ?>
                </div>

                <?php if ($model->isAttributeRequired('email')): ?>
                    <div class="row">
                        <?php echo $form->labelEx($model, '邮箱:'); ?>
                        <?php echo $form->textField($model, 'email'); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <?php echo $form->labelEx($model, '身份:'); ?>
                    <?php echo $form->radioButtonList($model, 'identity', array('1' => '生产商', '2' => '经销商', '3' => '修理厂'), array('separator' => '&nbsp', 'class' => 'radio', 'uncheckValue' => null))
                    ?>
                    <?php echo $form->error($model, 'identity'); ?>
                </div>

                <div class="row">
                    <?php $model['recommend'] = '用户名/手机号'; ?>
                    <?php echo $form->labelEx($model, '推荐人:'); ?>
                    <?php echo $form->textField($model, 'recommend'); ?>
                    <?php echo $form->error($model, 'recommend'); ?>
                </div>

                <?php
                $profileFields = Profile::getFields();
                if ($profileFields) {
                    foreach ($profileFields as $field) {
                        ?>

                        <div class="row">
                            <?php echo $form->labelEx($profile, "地址:"); ?>
                            <?php
                            if ($widgetEdit = $field->widgetEdit($profile)) {
                                echo $widgetEdit;
                            } elseif ($field->range) {
                                echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                            } elseif ($field->field_type == "TEXT") {
                                echo$form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                            } else {
                                echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                            }
                            ?>
                            <?php echo $form->error($profile, $field->varname); ?>
                        </div>	
                    <?php } ?>
                    <?php
                }
                ?>

                <?php if (UserModule::doCaptcha('registration')): ?>
                    <div class="row">
                        <?php echo $form->labelEx($model, '验证码:'); ?>
                        <?php echo $form->textField($model, 'verifyCode', array('class' => 'width90')); ?>
                        <?php
                        $this->widget('CCaptcha', array(
                            'showRefreshButton' => true,
                            'clickableImage' => false,
                            'buttonLabel' => '换一张',
                            'imageOptions' => array('align' => 'absmiddle'),
                        ));
                        ?>
                        <?php echo $form->error($model, 'verifyCode'); ?>
                    </div>
                <?php endif; ?>

                <div class="row submit">
                    <?php echo CHtml::submitButton(UserModule::t("Register"), array('class' => 'submit')); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div><!-- form -->

        <?php endif; ?>
    </div>
    <div class='bg-white pos-r' style="height:100px;"></div>
</div>
<script>
    $(document).ready(function(){
        //推荐人默认值
        $("#RegistrationForm_recommend").focus(function(){
            if($(this).val()=="用户名/手机号"){
                $(this).val("");
            }
        })
        //推荐人默认值,并判断推荐人是否在平台上
        $("#RegistrationForm_recommend").blur(function(){
            var recommend = $(this).val();
            if(recommend == ''){
                $(this).val("用户名/手机号");
                $("#RegistrationForm_recommend_warn").remove();
            }
            else{
                if(recommend.length >= 3 && recommend.length <= 20){
                    $.post(Yii_baseUrl + "/user/registration/checkrecommend", {recommend: recommend}, function(result){
                        var result = eval("("+result+")");
                        if(result){
                            $("#RegistrationForm_recommend_warn").remove();
                            $("#RegistrationForm_recommend").after("<div id='RegistrationForm_recommend_warn' class='errorMessage' style='display: inline; margin-left:5px;'>"+result+"</div>");
                        }
                    });
                }
                else{
                    $("#RegistrationForm_recommend_warn").remove();
                }
            }
        });
    });
</script>