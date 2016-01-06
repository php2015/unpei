<div class="wide form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'username',array('size'=>20,'maxlength'=>20)); ?>

<?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>128)); ?>

<?php // echo $form->textFieldRow($model,'create_at'); ?>
<label>机构类型</label>
<?php echo $form->dropDownList($model,'identity',$model->itemAlias('identity'),array('empty'=>'机构类型'))?><p/>
<label>会员类型</label>
<?php echo $form->dropDownList($model,'usertype',$model->itemAlias('usertype'))?>
<label  class="control-label">地址:</label>
 <?php
                    $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                    $state = CHtml::listData($state_data, "id", "name");
                    $s_default = $profile->isNewRecord ? '' : $profile->state;

                    echo Chtml::dropDownList('User[Province]', $profile->state, $state, array(
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
                    echo Chtml::dropDownList('User[City]', $profile->city, $city_update, array(
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
                    echo Chtml::dropDownList('User[Area]', $profile->district, $district_update, array(
                        'class' => 'width90 select',
                        'id' => 'area',
                        'empty' => '请选择地区',
                            )
                    );
                    ?>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType' => 'submit',
	'type'=>'primary',
	'label'=>'搜索',
)); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
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
