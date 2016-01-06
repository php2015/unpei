<div calss="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'address-form',
        //'enableAjaxValidation'=>true,
        'enableClientValidation' => true,
//     'clientOptions'=>array(  
//                'validateOnSubmit'=>true,  
//            ),  
            ))
    ?>
    <div class="row">
        <label>收货姓名:</label>
        <?php echo $form->textField($model, ContactName, array('class' => 'input')) ?>
        <nobr> <?php echo $form->error($model, ContactName, array('style' => 'color:red')); ?></nobr>
    </div>
    <div class="row">
        <label>收货地址:</label>
        <?php
        $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));
        $state = CHtml::listData($state_data, "ID", "Name");
        $s_default = $model->isNewRecord ? '' : $search['province'];
        echo CHtml::dropDownList('JpdReceiveAddress[State]', $s_default, $state, array(
            'empty' => '请选择省',
            'class' => '  select',
            'style' => 'width:100px;margin-left:5px',
            "required" => "true",
            'ajax' => array(
                'type' => 'GET',
                'url' => Yii::app()->request->baseUrl . '/common/dynamiccities',
                'data' => 'js:"province="+jQuery(this).val()',
                'success' => 'function(data){
                             $("#JpdReceiveAddress_City").html(data);
                             if($("#JpdReceiveAddress_State").attr("city"))
                             {
                                 $("#JpdReceiveAddress_City").val($("#JpdReceiveAddress_State").attr("city"));
                                 $("#JpdReceiveAddress_City").change();
                             }else{
                                 $("#JpdReceiveAddress_City").change();
                             }
                        }'
                ))
        );
        $c_default = $model->isNewRecord ? '' : $search['city'];
        if (!$model->isNewRecord) {
            $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $search['province']));
            $city = CHtml::listData($city_data, "ID", "Name");
        }
        $city_update = $model->isNewRecord ? array() : $city;
        echo CHtml::dropDownList('JpdReceiveAddress[City]', $c_default, $city_update, array(
            'empty' => '请选择市',
            'class' => 'width114 select',
            'style' => 'width:100px',
            'ajax' => array(
                'type' => 'GET',
                'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict',
                'data' => 'js:"city="+jQuery(this).val()',
                'success' => 'function(data){
                             $("#JpdReceiveAddress_District").html(data);
                             if($("#JpdReceiveAddress_State").attr("area"))
                                 $("#JpdReceiveAddress_District").val($("#JpdReceiveAddress_State").attr("area"));
                        }'
                ))
        );
        $d_default = $model->isNewRecord ? '' : $search['area'];
        if (!$model->isNewRecord) {
            $district_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $search['city']));
            $district = CHtml::listData($district_data, "ID", "Name");
        }
        $district_update = $model->isNewRecord ? array() : $district;
        echo CHtml::dropDownList('JpdReceiveAddress[District]', $d_default, $district_update, array(
            'empty' => '请选择区',
            'style' => 'width:100px',
            'class' => 'width114 select'
        ));
        ?>
        <?php echo $form->error($model, Province, array('style' => 'color:red')); ?>
        <?php echo $form->error($model, City, array('style' => 'color:red')); ?>
        <?php echo $form->error($model, Area, array('style' => 'color:red')); ?>
    </div>
    <div class="row">
        <label>街道地址:</label>
        <?php echo $form->textField($model, Address, array('class' => 'input', 'style' => 'margin-top:5px;width:250px')); ?>
        <?php echo $form->error($model, Address, array('style' => 'color:red')); ?>
    </div>
    <div class="row">
        <label>邮政编码:</label>
        <?php echo $form->textField($model, ZipCode, array('class' => 'input', 'style' => 'margin-top:5px')); ?>
        <?php echo $form->error($model, ZipCode, array('style' => 'color:red')); ?>
    </div>
    <div class="row">
        <label>手机号码:</label>
        <?php echo $form->textField($model, Phone, array('class' => 'input', 'style' => 'margin-top:5px')); ?>
        <?php echo $form->error($model, Phone, array('style' => 'color:red')); ?>
    </div>
    <div class="row buttons" style="margin-top:5px;">  
        <input type="button" key='' id="adresssumit" class="submit" value="创建" style="margin-left:60px">
        <?php //echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class'=>'submit','style'=>'margin-left:120px;margin-top:5px'));  ?>  
        <input type="button" class="submit" value="取消" onclick="$('#myaddress').dialog('close')">
    </div> 
    <?php $this->endWidget(); ?>
</div>
<script>
    //    $("#JpdReceiveAddress_State").change(function(){
    //        return;
    //        if($(this).val()){
    //            var province=$(this).val();
    //            $.getJSON(Yii_baseUrl+'/common/dynamicarea',{province:province},function(data){
    //                if(data!=''){
    //                    $("#JpdReceiveAddress_District").empty();
    //                    $.each(data, function(key,val){      
    //                        jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#JpdReceiveAddress_District");
    //                    }); 
    //                }
    //            });
    //        }else{
    //            $("#JpdReceiveAddress_District").empty();
    //            $("<option value=''>请选择地区</option>").appendTo("#JpdReceiveAddress_District");
    //        }
    //    });
</script>