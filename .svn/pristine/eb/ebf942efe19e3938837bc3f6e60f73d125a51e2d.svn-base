<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/uploadify.css" />
<?php $this->pageTitle = Yii::app()->name . ' - 我的修理厂'; ?>
<?php $serviceOpenTime = explode(',', $model->serviceOpenTime); //营业时间 ?>
<style>
    .dt-left{float:left;width:518px;}
    .dt-right{width:200px;float:right;}
    .dttable{width:100%;}
    .dttable tr{height:30px;}
    .label{width:60px;}
</style>
<div id="showdetail" style="display:<?php echo $display ?>"><!--展示 -->	
    <div class="dtdiv auto_height inner-padding">
        <div class='title title-dashed'>
            <a class='float-r icon-pencil' href="<?php echo Yii::app()->createUrl('servicer/servicemain/index/flag/update'); ?>">修改</a>
            基础信息
        </div>
        <div class='form-list'>
            <div style="float:left;width:550px;">	
                <table class="dttable">
                    <tr>
                        <td align="right">机构名称:</td>
                        <td clospan="3"><?php echo $model['serviceName']; ?></td>
                    </tr>
                    <tr>
                        <td align="right" width=110>成立年份:</td>
                        <td width=165><?php echo $model['serviceFounded']; ?>年</td>
                        <td align="right" width=110>工 位 数:</td>
                        <td width=165><?php echo $model['servicePositionCount']; ?>人</td>
                    </tr>
                    <tr>
                        <td align="right">技师人数:</td>
                        <td><?php echo $model['serviceTechnicianCount']; ?>人</td>
                        <td align="right">停车位数:</td>
                        <td><?php echo $model['serviceParkingDigits']; ?></td>
                    </tr>
                    <tr>
                        <td align="right">店铺面积:</td>
                        <td><?php echo $model['serviceStoreSize']; ?></td>
                        <td align="right">预约模式:</td>
                        <td><?php
if ($model['serviceReservationMode'] == "1"): echo "需要担保";
else: echo "不需要担保";
endif;
?></td>
                    </tr>
                    <tr>
                        <td align="right">营业时间:</td>
                        <td colspan="3"><?php echo $serviceOpenTime[0] . "至" . $serviceOpenTime[1] . "（" . $serviceOpenTime[2] . "-" . $serviceOpenTime[3] . "）"; ?></td>
                    </tr>
                    <tr>
                        <td align="right">经营区域:</td>
                        <td colspan="3"><?php echo Area::showCity($model['serviceRegionProvince']) . Area::showCity($model['serviceRegionCity']) . Area::showCity($model['serviceRegionArea']); ?></td>
                    </tr>
                    <tr>
                        <td align="right">机构简介:</td>
                        <td colspan="3"><?php echo $model['serviceIntro']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="dtdiv auto_height inner-padding">
        <div class='title title-dashed'>联系方式</div>
        <div style="float:left;width:550px;">	
            <table class="dttable">
                <tr>
                    <td width=110 align="right">联 系 人:</td>
                    <td width=165><?php echo $model['serviceContact']; ?></td>
                    <td width=110 align="right">手　机:</td>
                    <td width=165><?php echo $model['serviceCellPhone']; ?></td>
                </tr>
                <tr>
                    <td align="right">固定电话:</td>
                    <td><?php echo $model['serviceTelePhone']; ?></td>
                    <td align="right">QQ号码:</td>
                    <td><?php echo $model['serviceQQ']; ?></td>
                </tr>
                <tr>
                    <td align="right">邮　　箱:</td>
                    <td colspan="3"><?php echo $model['serviceEmail']; ?> </td>
                </tr>
                <tr>
                    <td align="right">地　　址:</td>
                    <td colspan="3"><?php echo Area::showCity($model['serviceProvince']) . Area::showCity($model['serviceCity']) . Area::showCity($model['serviceArea']) . $model['serviceAddress']; ?></td>
                </tr>			
            </table>		
        </div>
    </div>
    <div class=' jgcx photos content-rows15 bg-white'>
        <div class='title'>机构照片</div>
        <div class='pos-r'style="width:730px;">
            <a href='javascript:;' class="arr-l scroll-left"></a>
            <div class="photos-list" style="width:651px;">
                <ul>
                    <?php if ($photo): ?>
                        <?php foreach ($photo as $value): ?>
                            <li>
                                <?php $picurl = F::uploadUrl() . $value['photoName']; ?>
                                <a href="javascript:;;"><span class='showimages'><img style="width:200px" src="<?php echo $picurl; ?>"></span></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <a href='javascript:;' class="arr-r scroll-right" style="background-color: #fff;"></a>
        </div>
    </div>
</div>
<div class='content-row' style='display:<?php echo $display == 'none' ? 'block' : 'none' ?>' ><!-- 修改 -->
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'service-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
            ));
    ?>
    <div class="dtdiv inner-padding">
        <div class='title title-dashed'>
            <a class='float-r' href="<?php echo Yii::app()->createUrl('servicer/servicemain/index'); ?>">返回</a>
            基础信息
        </div>
        <?php
        $year = date('Y', time());
        for ($i = 1980; $i <= $year; $i++) {
            $data[$i] = $i . '年';
        }
        ?>
        <div class='form-list'>
            <table class="dttable">
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '机构名称:', array('class' => 'label')); ?></td>
                    <td colspan=3><?php
        echo $form->textField($model, 'serviceName', array(
            'class' => 'easyui-validatebox input',
            "data-options" => "required:true",
            "style" => "width:248px;",
            'maxlength' => '100'));
        ?>
                        <?php echo $form->error($model, 'serviceName', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>	
                <tr>
                    <td align="right" width=50><?php echo $form->labelEx($model, '成立年份:', array('class' => 'label')); ?></td>
                    <td width=309>
                        <?php echo $form->dropDownList($model, 'serviceFounded', $data, array('class' => 'width100 select')); ?>
                        <?php echo $form->error($model, 'serviceFounded', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                    <td align="right" width=50><?php echo $form->labelEx($model, '工 位 数:', array('class' => 'label')); ?></td>
                    <td width=409>
                        <?php
                        echo $form->dropDownList($model, 'servicePositionCount', array(
                            '1-5' => '1-5',
                            '6-10' => '6-10',
                            '11-15' => '11-15',
                            '16-20' => '16-20'
                                ), array('class' => 'width100 select'));
                        ?>
                        <?php echo $form->error($model, 'servicePositionCount', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '技师人数:', array('class' => 'label')); ?></td>
                    <td>
                        <?php
                        echo $form->dropDownList($model, 'serviceTechnicianCount', array(
                            '1-5' => '1-5',
                            '6-10' => '6-10',
                            '11-15' => '11-15',
                            '16-20' => '16-20'
                                ), array('class' => 'width100 select'));
                        ?>
                        <?php echo $form->error($model, 'serviceTechnicianCount', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                    <td align="right"><?php echo $form->labelEx($model, '停车位数:', array('class' => 'label')); ?></td>
                    <td>
                        <?php
                        echo $form->dropDownList($model, 'serviceParkingDigits', array(
                            '1-5' => '1-5',
                            '6-10' => '6-10',
                            '11-15' => '11-15',
                            '16-20' => '16-20'
                                ), array('class' => 'width100 select'));
                        ?>
                        <?php echo $form->error($model, 'serviceParkingDigits', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>		
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '店铺面积:', array('class' => 'label')); ?></td>
                    <td>
                        <?php
                        echo $form->dropDownList($model, 'serviceStoreSize', array(
                            '0-50m²' => '0-50m²',
                            '50-100m²' => '50-100m²',
                            '100-500m²' => '100-500m²',
                            '500-1000m²' => '500-1000m²'
                                ), array('class' => 'width100 select'));
                        ?>
                        <?php echo $form->error($model, 'serviceStoreSize', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>
                    <td align="right"><?php echo $form->labelEx($model, '预约模式:', array('class' => 'label')); ?></td>
                    <td>
                        <?php
                        echo $form->dropDownList($model, 'serviceReservationMode', array(
                            '0' => '不需要担保',
                            '1' => '需要担保',
                                ), array('class' => 'width100 select'));
                        ?>
                        <?php echo $form->error($model, 'serviceReservationMode', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>		
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '营业时间:', array('class' => 'label')); ?></td>
                    <td colspan=3>
                        <?php
                        for ($j = 1; $j <= 7; $j++) {
                            $sw_key = "周" . $this->getNum($j);
                            $startWeek[$sw_key] = $sw_key;
                        }
                        ?>
                        <?php echo CHtml::dropDownList('startWeek', $serviceOpenTime[0], $startWeek, array('class' => 'width100 select')); ?>
                        <?php
                        for ($q = 1; $q <= 7; $q++) {
                            $ew_key = "周" . $this->getNum($q);
                            $endWeek[$ew_key] = $ew_key;
                        }
                        ?>
                        <?php echo CHtml::dropDownList('endWeek', $serviceOpenTime[1], $endWeek, array('class' => 'width100 select')); ?>
                        <?php
                        for ($x = 0; $x < 24; $x++) {
                            $st_key = $x . ":00";
                            $startTime[$st_key] = $st_key;
                        }
                        ?>
                        <?php echo CHtml::dropDownList('startTime', $serviceOpenTime[2], $startTime, array('class' => 'width100 select')); ?>
                        <?php
                        for ($y = 0; $y < 24; $y++) {
                            $et_key = $y . ":00";
                            $endTime[$et_key] = $et_key;
                        }
                        ?>
                        <?php echo CHtml::dropDownList('endTime', $serviceOpenTime[3], $endTime, array('class' => 'width100 select')); ?><?php echo $form->error($model, 'serviceOpenTime', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>		
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '经营区域:', array('class' => 'label')); ?></td>
                    <td colspan=3><?php
                        $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1)); //条件:grade = 1
                        $state = CHtml::listData($state_data, "id", "name"); //取出id、name
                        $s_default = $model->isNewRecord ? '' : $model->serviceRegionProvince;
                        echo CHtml::dropDownList('serviceRegionProvince', $s_default, $state, array(
                            'empty' => '请选择省份',
                            'class' => 'width114 select',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                                'update' => '#serviceRegionCity', //selector to update	对应的下一个下拉框的value的值
                                'data' => 'js:"province="+jQuery(this).val()',
                            )
                                )
                        );
                        //empty since it will be filled by the other dropdown
                        $c_default = $model->isNewRecord ? '' : $model->serviceRegionCity;
                        if (!$model->isNewRecord) {
                            $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->serviceRegionProvince));
                            $city = CHtml::listData($city_data, "id", "name");
                        }
                        $city_update = $model->isNewRecord ? array() : $city;
                        echo '&nbsp;' . CHtml::dropDownList('serviceRegionCity', $c_default, $city_update, array(
                            'empty' => '请选择城市',
                            'class' => 'width114 select',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict', //url to call
                                'update' => '#serviceRegionArea', //selector to update
                                'data' => 'js:"city="+jQuery(this).val()',
                            )
                                )
                        );
                        $d_default = $model->isNewRecord ? '' : $model->serviceRegionArea;
                        if (!$model->isNewRecord) {
                            $district_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->serviceRegionCity));
                            $district = CHtml::listData($district_data, "id", "name");
                        }
                        $district_update = $model->isNewRecord ? array() : $district;
                        echo '&nbsp;' . CHtml::dropDownList('serviceRegionArea', $d_default, $district_update, array(
                            'empty' => '请选择地区',
                            'class' => 'width114 select'
                        ));
                        ?>
                        <?php echo $form->error($model, 'serviceRegionProvince', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
                    </td>		
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '机构照片:', array('class' => 'label')); ?></td>
                    <td colspan=3>
                        <div class="form-row" >
                            <input type='file' name='file_upload' id="file_upload">
                            <input type="hidden" value="上传" id="file-upload-start">
                            <p id='hidden_upnames'></p>
                            <p class="form-row" id="showimglist" style="position: relative;">
                                <?php if ($photo): ?>
                                    <?php foreach ($photo as $value): ?>
                                        <?php $picurl = F::uploadUrl() . $value['photoName']; ?>
                                        <span class='showimages'>
                                            <img style='width:80px;height:80px;' src="<?php echo $picurl; ?>">
                                            <span key="<?php echo $value['photoName']; ?>" class='close icon-close-green xx'></span>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <input type='hidden' value='' id="photoName" name='photoName' class='width114 input'>
                            </p>
                            <span style="color:#999999">图片最多上传5张</span>
                        </div>
                    </td> 
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '机构简介:', array('class' => 'label')); ?></td>
                    <td colspan=3><?php echo $form->textArea($model, 'serviceIntro', array('class' => 'width527 textarea','maxLength'=>200, 'style' => 'vertical-align: top; height: 100px;')); ?><?php echo $form->error($model, 'serviceIntro', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>
            </table>	
        </div>
    </div>
    <div class="dtdiv inner-padding">
        <div class='title title-dashed'>联系方式</div>
        <div class='form-list'>
            <table class="dttable">
                <tr>
                    <td width=50><?php echo $form->labelEx($model, '联 系 人:', array('class' => 'label')); ?></td>
                    <td width=309><?php echo $form->textField($model, 'serviceContact', array('class' => 'easyui-validatebox width100 input')); ?><?php echo $form->error($model, 'serviceContact', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                    <td width=50><?php echo $form->labelEx($model, '手　机:', array('class' => 'label')); ?></td>
                    <td width=409><?php
                                echo $form->textField($model, 'serviceCellPhone', array(
                                    'class' => 'easyui-validatebox width100 input',
                                    'validtype' => 'mobile',
                                    "data-options" => "required:true",
                                    "maxlength" => '18'));
                                ?><?php echo $form->error($model, 'serviceCellPhone', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '固定电话:', array('class' => 'label')); ?></td>
                    <td><?php
                        echo $form->textField($model, 'serviceTelePhone', array(
                            'class' => 'easyui-validatebox width100 input',
                            'validtype' => 'telephone',
                            "maxlength" => '60'));
                                ?><?php echo $form->error($model, 'serviceTelePhone', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                    <td align="right"><label class="label">QQ号码:</label></td>
                    <td><?php
                        echo $form->textField($model, 'serviceQQ', array(
                            'class' => 'easyui-validatebox width100 input',
                            'validtype' => 'QQ',
                            "maxlength" => '12'));
                                ?><?php echo $form->error($model, 'serviceQQ', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '邮　　箱:', array('class' => 'label')); ?></td>
                    <td colspan=3><?php
                        echo $form->textField($model, 'serviceEmail', array(
                            'class' => 'easyui-validatebox width213 input',
                            'validtype' => 'email',
                            "data-options" => "required:true",
                            "maxlength" => '64'));
                                ?><?php echo $form->error($model, 'serviceEmail', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?></td>
                </tr>
                <tr>
                    <td align="right"><?php echo $form->labelEx($model, '地　　址:', array('class' => 'label')); ?></td>
                    <td colspan="3"><?php
                        $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1)); //条件:grade = 1
                        $state = CHtml::listData($state_data, "id", "name"); //取出id、name
                        $s_default = $model->isNewRecord ? '' : $model->serviceProvince;
                        echo CHtml::dropDownList('serviceProvince', $s_default, $state, array(
                            'empty' => '请选择省份',
                            'class' => 'width114 select',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                                'update' => '#serviceCity', //selector to update	对应的下一个下拉框的value的值
                                'data' => 'js:"province="+jQuery(this).val()',
                            )
                                )
                        );
                        //empty since it will be filled by the other dropdown
                        $c_default = $model->isNewRecord ? '' : $model->serviceCity;
                        if (!$model->isNewRecord) {
                            $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->serviceProvince));
                            $city = CHtml::listData($city_data, "id", "name");
                        }
                        $city_update = $model->isNewRecord ? array() : $city;
                        echo '&nbsp;' . CHtml::dropDownList('serviceCity', $c_default, $city_update, array(
                            'empty' => '请选择城市',
                            'class' => 'width114 select',
                            'ajax' => array(
                                'type' => 'GET', //request type
                                'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict', //url to call
                                'update' => '#serviceArea', //selector to update
                                'data' => 'js:"city="+jQuery(this).val()',
                            )
                                )
                        );
                        $d_default = $model->isNewRecord ? '' : $model->serviceArea;
                        if (!$model->isNewRecord) {
                            $district_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $model->serviceCity));
                            $district = CHtml::listData($district_data, "id", "name");
                        }
                        $district_update = $model->isNewRecord ? array() : $district;
                        echo '&nbsp;' . CHtml::dropDownList('serviceArea', $d_default, $district_update, array(
                            'empty' => '请选择地区',
                            'class' => 'width114 select'
                        ));
                        echo '&nbsp;' . $form->textField($model, 'serviceAddress', array('class' => 'width144 input'));
                                ?><?php echo $form->error($model, 'serviceProvince', array('style' => 'color: red')); ?></td>
                </tr>
                <tr><td colspan=4 align="center"></td></tr>
                <tr><td colspan=4 align="center">
                        <?php echo CHtml::button('保存资料', array('class' => 'submit', 'style' => "margin-right:58px;")); ?>
                    </td></tr>
            </table>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    $(document).ready(function(){
        //处理IE中maxlength无用问题
        $("textarea[maxlength]").keyup(function(){
            var area=$(this);
            var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
            if(max>0){
                if(area.val().length>max){ //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
                }
            }
        });
        //复制的字符处理问题
        $("textarea[maxlength]").blur(function(){
            var area=$(this);
            var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
            if(max>0){
                if(area.val().length>max){ //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
                }
            }
        }); 
        $("#serviceProvince").change(function(){
            if($(this).val()){
                var province=$(this).val();
                $.getJSON(Yii_baseUrl+'/common/dynamicarea',{province:province},function(data){
                    if(data!=''){
                        $("#serviceArea").empty();
                        $.each(data, function(key,val){      
                            $("<option value='"+key+"'>"+val+"</option>").appendTo("#serviceArea");
                        }); 
                    }
                });
            }else{
                $("#serviceArea").empty();
                $("<option value=''>请选择地区</option>").appendTo("#serviceArea");
            }
        });
        $("#serviceRegionProvince").change(function(){
            if($(this).val()){
                var province=$(this).val();
                $.getJSON(Yii_baseUrl+'/common/dynamicarea',{province:province},function(data){
                    if(data!=''){
                        $("#serviceRegionArea").empty();
                        $.each(data, function(key,val){      
                            $("<option value='"+key+"'>"+val+"</option>").appendTo("#serviceRegionArea");
                        }); 
                    }
                });
            }else{
                $("#serviceRegionArea").empty();
                $("<option value=''>请选择地区</option>").appendTo("#serviceRegionArea");
            }
        });
        $("table tbody tr").removeClass("bg-green-light");
        $("table tbody tr").live({
            mouseout: function() {
                $(this).removeClass("tr-hover");
            },
            mouseover: function() {
                $(this).removeClass("tr-hover");
            }
        });
        $("#service-form").form({
            url:Yii_baseUrl + '/servicer/servicemain/saveorgan',
            success:function(data){
                var data = eval('('+data+')');
                if(data=='OK'){
                    window.location.href=Yii_baseUrl + '/servicer/servicemain/index';
                }else if(data=='NoOk'){
                    $.messager.alert('提示',"保存失败",'info');
                }else{
                    $("#filemessage").html(data);
                }
            }
        });
        $(".submit").click(function(){
            if(window.confirm("您确定要保存吗?")){
                var name=$("#Service_serviceName").val();
                var phone=$("#Service_serviceCellPhone").val();
                var email=$("#Service_serviceEmail").val();
                $.getJSON(Yii_baseUrl+'/servicer/servicemain/checkorgan',{
                    name:name,
                    phone:phone,
                    email:email
                },function(result){
                    if(result.result){
                        $("#service-form").submit();
                        $(".submit").attr('disabled','true');     //点击后按钮成为不可操作状态
                    }else{
                        $.messager.alert('提示', result.message, 'info');
                    }
                });
            }
        });
    })
    //删除图片事件
    $(".icon-close-green").live('click',function(){
        var photoName=$(this).attr('key');
        if(typeof(photoName) != "undefined"){
            var phNames=$("#photoName").val();
            if(phNames!=''){
                var photoNames=phNames+','+photoName;
            }else{
                var photoNames=photoName;
            }
            $("#photoName").val(photoNames);
        }
        $(this).parent(".showimages").remove();
    });
</script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify.css">
<?php $this->renderPartial('uploadimagejs'); ?>
<div style='height:60px'></div>
<div class='block-shadow'></div>