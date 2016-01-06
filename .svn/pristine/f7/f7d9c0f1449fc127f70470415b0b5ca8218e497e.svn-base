<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
		'enableClientValidation'=>true,
// 		'clientOptions'=>CMap::mergeArray(Yii::app()->params['clientOptions'],
// 				array(
// 						'validateOnSubmit'=>true,
// 				)
// 		),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
	));
?>
<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
<?php echo $form->errorSummary(array($profile,$model )); ?>
<?php echo $form->textFieldRow($model, 'username', array('size' => 20, 'maxlength' => 20)); ?>

<label for="User_password" class="control-label">密码</label>
<?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128)); ?>
<?php echo $form->error($model,'password',array('class'=>'help-block','style'=>'color:#B94A48'));?>
<label for="User_password" class="control-label">确认密码</label>
<?php echo $form->passwordField($model,'verifyPassword',array('value'=>$model->password)); ?>
<?php echo $form->error($model,'verifyPassword',array('class'=>'help-block','style'=>'color:#B94A48')); ?>

<?php echo $form->textFieldRow($model, 'email',array('prepend'=>'@','style'=>'width:180px;')); ?>
<?php echo $form->dropDownListRow($model, 'identity', User::itemAlias('identity'),array('empty'=>'请选择机构类型')); ?>

<?php echo $form->dropDownListRow($model, 'superuser', User::itemAlias('AdminStatus')); ?>

<?php echo $form->dropDownListRow($model, 'status', User::itemAlias('UserStatus')); ?>
<?php echo $form->dropDownListRow($profile, 'usertype', User::itemAlias('usertype'),array('empty'=>'请选择会员类别')); ?>
<?php echo $form->textFieldRow($profile,'truename')?>
<?php echo $form->error($profile,'truename')?>
<?php echo $form->textFieldRow($profile,'nickname')?>
<?php echo $form->textFieldRow($profile,'phone')?>
<label  class="control-label">地址:</label>
 <?php
                    $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                    $state = CHtml::listData($state_data, "id", "name");
                    $s_default = $profile->isNewRecord ? '' : $profile->state;

                    echo Chtml::dropDownList('Profile[Province]', $profile->state, $state, array(
                        'class' => 'easyui-validatebox width90 select',
                        'id' => 'province',
                        'empty' => '请选择省份',
                        'ajax' => array(
                            'type' => 'GET', //request type
                            // 'url'=>CController::createUrl('dynamiccities'), //url to call
                             'url' => Yii::app()->createUrl('user/admin/Dynamiccities'),
                            'update' => '#city', //lector to update
                            'data' => 'js:"province="+jQuery(this).val()',
                            )));

					//empty since it will be filled by the other dropdown
                    $c_default = $profile->isNewRecord ? '' : $profile->city;
                    if (!$profile->isNewRecord) {
                        $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $profile->state));
                        $city = CHtml::listData($city_data, "id", "name");
                    }

                    $city_update = $profile->isNewRecord ? array() : $city;
                    echo Chtml::dropDownList('Profile[City]', $profile->city, $city_update, array(
                        'class' => 'width90 select',
                        'id' => 'city',
                        'empty' => '请选择城市',
                        'ajax' => array(
                            'type' => 'GET', //request type
                            'url' => Yii::app()->createUrl('user/admin/dynamicdistrict'),
                            'update' => '#area', //lector to update
                            'data' => 'js:"city="+jQuery(this).val()',
                            )));
                    $d_default = $profile->isNewRecord ? '' : $profile->district;
                    if (!$profile->isNewRecord) {
                        $district_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $profile->city));
                        $district = CHtml::listData($district_data, "id", "name");
                    }
                    $district_update = $profile->isNewRecord ? array() : $district;
                    echo Chtml::dropDownList('Profile[Area]', $profile->district, $district_update, array(
                        'class' => 'width90 select',
                        'id' => 'area',
                        'empty' => '请选择地区',
                            )
                    );
                    ?>
<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType' => 'submit',
	'type' => 'primary',
	'label' => $model->isNewRecord ? UserModule::t('创建') : UserModule::t('保存'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
$(function(){
    //  $("input[name=CompanyType]:eq(0)").attr("checked",'checked'); 
      $("#province").change(function(){
          if($(this).val()){
              var province=$(this).val();
              var url= '<?php echo Yii::app()->createUrl('user/admin/Dynamicarea')?>';
              $.getJSON(url,{province:province},function(data){
                  if(data!=''){
                      $("#area").empty();
                      $.each(data, function(key,val){      
                          jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#area");
                      }); 
                  }
              });
          }else{
              $("#area").empty();
              $("<option value=''>请选择地区</option>").appendTo("#area");
          }
      });
  });
    </script>