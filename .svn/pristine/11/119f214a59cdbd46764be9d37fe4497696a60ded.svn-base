<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'recommend-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Name',array('class'=>'span5','label'=>'用户名')); ?>

	<?php echo $form->textFieldRow($model,'MobPhone',array('class'=>'span5')); ?>
        <?php echo $form->dropDownListRow($model, 'CompanyType',array(3=>'修理厂')); ?>
        
        <?php echo $form->textFieldRow($model,'Email',array('class'=>'span5','prepend'=>'@','style'=>'width:180px;')); ?>
        <?php echo $form->textFieldRow($model,'CompanyName',array('class'=>'span5')); ?>
        <?php $CompanyName= empty($model->OrganID)?'':RecommendList::showOrganname($model->OrganID);
       echo $form->textFieldRow($model,'OrganID',array('class'=>'span5','value'=>$CompanyName));
        ?>
        <label  class="control-label">地址:</label>
 <?php
                    $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));
                    $state = CHtml::listData($state_data, "ID", "Name");
                    $s_default = $model->isNewRecord ? '' : $model->Province;

                    echo Chtml::dropDownList('RecommendList[Province]', $model->Province, $state, array(
                        'class' => 'easyui-validatebox width90 select',
                        'id' => 'province',
                        'empty' => '请选择省份',
                        'ajax' => array(
                            'type' => 'GET', //request type
                            // 'url'=>CController::createUrl('dynamiccities'), //url to call
                             'url' => Yii::app()->createUrl('/admin/Dynamiccities'),
                            'update' => '#city', //lector to update
                            'data' => 'js:"province="+jQuery(this).val()',
                            )));

					//empty since it will be filled by the other dropdown
                    $c_default = $model->isNewRecord ? '' : $model->City;
                    if (!$model->isNewRecord) {
                        $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->Province));
                        $city = CHtml::listData($city_data, "ID", "Name");
                    }

                    $city_update = $model->isNewRecord ? array() : $city;
                    echo Chtml::dropDownList('RecommendList[City]', $model->City, $city_update, array(
                        'class' => 'width90 select',
                        'id' => 'city',
                        'empty' => '请选择城市',
                        'ajax' => array(
                            'type' => 'GET', //request type
                            'url' => Yii::app()->createUrl('/admin/dynamicdistrict'),
                            'update' => '#area', //lector to update
                            'data' => 'js:"city="+jQuery(this).val()',
                            )));
                    $d_default = $model->isNewRecord ? '' : $model->Area;
                    if (!$profile->isNewRecord) {
                        $district_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->City));
                        $district = CHtml::listData($district_data, "ID", "Name");
                    }
                    $district_update = $model->isNewRecord ? array() : $district;
                    echo Chtml::dropDownList('RecommendList[Area]', $model->Area, $district_update, array(
                        'class' => 'width90 select',
                        'id' => 'area',
                        'empty' => '请选择地区',
                            )
                    );
                    ?>
        
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
