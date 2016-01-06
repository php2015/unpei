<style>
    .bor_back{ width:920px;margin:0 auto; border:1px solid #c9d5e3; background: #fff;font-size:12px;}   
    .m-bottom{margin-bottom: 10px}
    .m-top20{margin-top:20px}
    .txxx {height: 35px;line-height: 35px;text-indent: 15px;border-bottom: 1px solid #c9d5e3;font-size: 14px;font-weight: bold;color: #0065bf;}
    .txxx_info4 {margin: 15px 10px 15px 20px;}
    .m_left5{margin-left: 5px;}
    .m_left12{margin-left: 12px;}
    .m_left50{margin-left: 50px;}
    .select {margin-right: 5px;height: 28px;line-height: 28px;padding: 3px 0px;width: 134px;font-family: Trebuchet MS;border: 1px solid #e9e9ea;background: #f5f6f7;}
    .width250{width:250px;}
    .textarea2 {width: 380px;height: 70px;border: 1px solid #dedede;background: #f5f6f7;}
    .m_left65 {margin-left: 65px;}
    .upload_img li {float: left;position: relative;list-style: none;margin-right: 5px;}
    span.guanbi3 {position: absolute;z-index: 10;right: -10px;cursor: pointer;top: 0px;}
    .upload_img li span img {position: absolute;top: 0;right: 10px;z-index: 2;width: 10px;height: 10px;}
    .errorMessage {border: 0 none;color: #b94a48;display: inline;font-size: 12px;}
    .row {line-height: 1em;margin-top: 5px;}
    .row input{margin-left: 0px;width:154px;}
    .m-top20{ margin-top:20px}
    .clear{clear:both; height: 0px}
    .m-top{margin-top:10px}
    .color_red{color: red;}
    .uploadify-queue{display:none}
    span.guanbi4{ position:absolute; z-index:10; right:0px; cursor:pointer;top:0px}
    li{list-style: none }
    .display-ib{display: inline-block}
    .btn_addPic {
        cursor: pointer;
        display: inline-block;
        height: 80px;
        overflow: hidden;
        position: relative;
        width: 80px;
    }
    .filePrew {
        cursor: pointer;
        display: block;
        height: 80px;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 80px;
    }
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'organdata_form',
    //'action' => Yii::app()->baseurl . '/user/activecompany/saveorgan',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    )
        ));
?>
<div class="bor_back m-bottom">
    <p class="txxx">基础信息</p>
    <div class="txxx_info4 gs_info">
        <div class="m_left80">
            <div class="row">
                <label>机构名称：</label>
                <?php
                echo $form->textField($model, 'OrganName', array(
                    'class' => 'width250 input',
                    "data-options" => "required:true",
                    'maxlength' => '100'));
                ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'OrganName', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
            </div>
            <div class="row">
                <?php if ($identity == 3) { ?>
                    <label style="margin-left: -12px">修理厂级别：</label>
                    <?php
                    echo $form->dropDownList($model['service'], 'ServiceType', array(
                        '一级' => '一级',
                        '二级' => '二级',
                        '三级' => '三级',
                            ), array('class' => 'select'));
                    ?>
                <?php } elseif ($identity == 2) { ?>
                    <label class=" m_left185">年销售额：</label>
                    <?php
                    echo $form->dropDownList($model['dealer'], 'SaleMoney', array(
                        '1000万以下' => '1000万以下',
                        '1000-5000万' => '1000-5000万',
                        '5000万以上' => '5000万以上',
                            ), array('class' => 'select'));
                    ?>
                <?php } ?>
                <label>成立年份：</label>
                <?php
                $year = date('Y', time());
                for ($i = 1980; $i <= $year; $i++) {
                    $data[$i] = $i . '年';
                }
                ?>
                <?php echo $form->dropDownList($model, 'FoundDate', $data, array('class' => 'select')); ?>
            </div>
            <?php if ($identity == 3) { ?>
                <div class="row">
                    <label class=" m_left185">店铺面积：</label>
                    <?php
                    echo $form->dropDownList($model['service'], 'ShopArea', array(
                        '小于100㎡' => '小于100㎡',
                        '100㎡~200㎡' => '100㎡~200㎡',
                        '200㎡~300㎡' => '200㎡~300㎡',
                        '300㎡~400㎡' => '300㎡~400㎡',
                        '400㎡~500㎡' => '400㎡~500㎡',
                        '500㎡以上' => '500㎡以上',
                            ), array('class' => 'select'));
                    ?>
                    <label class="m_left12">工位数：</label>
                    <?php
                    echo $form->dropDownList($model['service'], 'PositionCount', array(
                        '1-5' => '1-5',
                        '6-10' => '6-10',
                        '11-15' => '11-15',
                        '16-20' => '16-20',
                            ), array('class' => 'select'));
                    ?>
                </div>
                <div class="row">
                    <label>技师人数：</label>
                    <?php
                    echo $form->dropDownList($model['service'], 'TechnicianCount', array(
                        '1-5' => '1-5',
                        '6-10' => '6-10',
                        '11-15' => '11-15',
                        '16-20' => '16-20',
                            ), array('class' => 'select'));
                    ?>
                    <label class=" m_left185">停车位数：</label>
                    <?php
                    echo $form->dropDownList($model['service'], 'ParkingDigits', array(
                        '1-5' => '1-5',
                        '6-10' => '6-10',
                        '11-15' => '11-15',
                        '16-20' => '16-20',
                            ), array('class' => 'select'));
                    ?>
                </div>
                <div class="row">
                    <!--             <label style="vertical-align:top">预约模式：</label>-->
                    <?php
//                        echo $form->dropDownList($model['service'], 'ReservationMode', array(
//                            '不需要担保' => '不需要担保',
//                            '需要担保' => '需要担保',
//                                ), array('class' => 'select'));
                    ?>

                </div>
                <div class="row">
                    <label style="vertical-align:top">营业时间：</label>
                    <?php
                    echo Chtml::dropDownList('OpenTime[]', $opentime['0'], array(
                        '周一' => '周一',
                        '周二' => '周二',
                        '周三' => '周三',
                        '周四' => '周四',
                        '周五' => '周五',
                        '周六' => '周六',
                        '周七' => '周日',
                            ), array('class' => 'select'));
                    echo Chtml::dropDownList('OpenTime[]', $opentime['1'], array(
                        '周一' => '周一',
                        '周二' => '周二',
                        '周三' => '周三',
                        '周四' => '周四',
                        '周五' => '周五',
                        '周六' => '周六',
                        '周七' => '周日',
                            ), array('class' => 'select'));
                    echo Chtml::dropDownList('OpenTime[]', $opentime['2'], array(
                        '0:00' => '0:00', '1:00' => '1:00', '2:00' => '2:00', '3:00' => '3:00',
                        '4:00' => '4:00', '5:00' => '5:00', '6:00' => '6:00', '7:00' => '7:00',
                        '8:00' => '8:00', '9:00' => '9:00', '10:00' => '10:00', '11:00' => '11:00',
                        '12:00' => '12:00', '13:00' => '13:00', '14:00' => '14:00', '15:00' => '15:00',
                        '16:00' => '16:00', '17:00' => '17:00', '18:00' => '18:00', '19:00' => '19:00',
                        '20:00' => '20:00', '21:00' => '21:00', '22:00' => '22:00', '23:00' => '23:00',
                            ), array('class' => 'select'));
                    echo Chtml::dropDownList('OpenTime[]', $opentime['3'], array(
                        '0:00' => '0:00', '1:00' => '1:00', '2:00' => '2:00', '3:00' => '3:00',
                        '4:00' => '4:00', '5:00' => '5:00', '6:00' => '6:00', '7:00' => '7:00',
                        '8:00' => '8:00', '9:00' => '9:00', '10:00' => '10:00', '11:00' => '11:00',
                        '12:00' => '12:00', '13:00' => '13:00', '14:00' => '14:00', '15:00' => '15:00',
                        '16:00' => '16:00', '17:00' => '17:00', '18:00' => '18:00', '19:00' => '19:00',
                        '20:00' => '20:00', '21:00' => '21:00', '22:00' => '22:00', '23:00' => '23:00',
                            ), array('class' => 'select'));
                    ?>
                </div>
            <?php } elseif ($identity == 2) { ?>
                <div class="row">
                    <label>员工人数：</label>
                    <?php
                    echo $form->dropDownList($model, 'StoreSize', array(
                        '1-30人' => '1-30人',
                        '30-50人' => '30-50人',
                        '51-100人' => '51-100人',
                        '100人以上' => '100人以上',
                            ), array('class' => 'select'));
                    ?>
                    <label class=" m_left185">经营面积：</label>
                    <?php
                    echo $form->dropDownList($model['dealer'], 'ShopArea', array(
                        '100㎡~300㎡' => '100㎡~300㎡',
                        '300㎡~500㎡' => '300㎡~500㎡',
                        '500㎡以上' => '500㎡以上',
                            ), array('class' => 'select'));
                    ?>
                    <!--                    <label class=" m_left185">经营区域：</label>-->
                    <?php
//                    $operate_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
//                    $operate_region = CHtml::listData($operate_data, "ID", "Name");
//                    echo $form->dropDownList($model['dealer'], 'SaleDomain', $operate_region, array('class' => 'select'));
                    ?>
                </div>
            <?php } elseif ($identity == 1) { ?>
                <div class="row">
                    <label class=" m_left185">年销售额：</label>
                    <?php
                    echo $form->dropDownList($model['maker'], 'SaleMoney', array(
                        '10万' => '10万',
                        '50万' => '50万',
                        '100万' => '100万',
                        '200万' => '200万',
                        '500万' => '500万',
                        '1000万' => '1000万',
                        '3000万' => '3000万',
                        '5000万' => '5000万',
                        '8000万' => '8000万',
                        '10000万以上' => '10000万以上',
                            ), array('class' => 'select'));
                    ?>
                </div>
                <div class="row">
                    <label>公司规模：</label>
                    <?php
                    echo $form->dropDownList($model, 'StoreSize', array(
                        '1-10人' => '1-10人',
                        '11-30人' => '11-30人',
                        '31-50人' => '31-50人',
                        '51-100人' => '51-100人',
                        '100-500人' => '100-500人',
                        '501-1000人' => '501-1000人',
                        '1001-5000人' => '1001-5000人',
                        '5000人以上' => '5000人以上',
                            ), array('class' => 'select'));
                    ?>
                    <label class=" m_left185">经营区域：</label>
                    <?php
                    $operate_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                    $operate_region = CHtml::listData($operate_data, "ID", "Name");
                    echo $form->dropDownList($model['maker'], 'SaleDomain', $operate_region, array('class' => 'select'));
                    ?>
                </div>
            <?php } ?>
            <div class="row">
                <label style="vertical-align:top">机构简介：</label>
                <?php echo $form->textArea($model, 'Introduction', array('size' => 255, 'maxLength' => 200, 'class' => "textarea textarea2")); ?>
                <span class="color_red">*</span>(机构简介最多为200字)
                <?php echo $form->error($model, 'Introduction', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
            </div>
            <div style="margin-top: 15px;"><div style="vertical-align:top" class="float_l">机构照片：</div> 
                <div class="float_l" style="margin-left:10px"><input type='file' name='file_upload' id="file_upload">
                    <input type="hidden" value="上传" id="file-upload-start">
                    <span style="line-height:25px;color:#888">图片最多上传5张</span></div>
                <div style="clear:both"></div>
            </div>
            <div class="upload_img m_left65">
                <ul>
                    <div class="form-row" id="showimglist" style=" position: relative;">
                        <?php if (!empty($organphotos[0])): ?>
                            <?php foreach ($organphotos[0] as $k => $organphoto): ?>
                                <li style="margin-right:5px">
                                    <img src="<?php echo F::uploadUrl() . $organphoto['Path']; ?>" style="width:80px;height:80px;">
                                    <span id="delfile" keyid="<?php echo $organphoto['Path'] ?>" class="guanbi3"><img src="<?php echo F::themeUrl(); ?>/images/guanbi3.png"></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <input type='hidden' value='' id="photoId" name='photoId' class='width114 input'>
                    <div style="clear:both"></div>
                </ul>
            </div>
        </div>
    </div>  
</div>
<div class="bor_back m-bottom">

    <p class="txxx">联系方式</p>
    <div class="txxx_info4">
        <div class=" m_left80 gs_info">
            <div class="row">
                <label>手&nbsp;&nbsp;机：</label>
                <?php
                echo $form->textField($model, 'Phone', array(
                    'class' => 'input',
                    'validtype' => 'mobile',
                    "data-options" => "required:true",
                    "maxlength" => '18'
                ));
                ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'Phone', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
            </div>
            <div class="row">
                <label>邮&nbsp;&nbsp;箱：</label>
                <?php
                echo $form->textField($model, 'Email', array(
                    'class' => 'input',
                    'validtype' => 'email',
                    "data-options" => "required:true",
                    "maxlength" => '64'
                ));
                ?>
                <span class="color_red">*</span>
                <?php echo $form->error($model, 'Email', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
            </div>
            <div class="row">
                <label>qq&nbsp;&nbsp;号：</label>
                <?php
                echo $form->textField($model, 'QQ', array(
                    'class' => 'input',
                    'validtype' => 'QQ',
                    "maxlength" => '12'));
                ?>
                <?php echo $form->error($model, 'QQ', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
            </div>
            <div class="row">
                <label>传&nbsp;&nbsp;真：</label>
                <?php
                echo $form->textField($model, 'Fax', array(
                    'class' => 'input',
                    "maxlength" => '15'));
                ?>
                <?php echo $form->error($model, 'Fax', array('class' => 'display-ib', 'style' => 'color: red;background:none;border:none;float:none;margin:none;')); ?>
            </div>
            <div class="row">
                <label>座&nbsp;&nbsp;机：</label>
                <?php
                $telPhone = explode(",", $model->TelPhone);
                $j = 5;
                for ($i = 0; $i < 4; $i++) {
                    if ($j == 5 && empty($telPhone[$i]))
                        $j = $i;
                    ?>
                    <input type="text" key="<?php echo $i; ?>" class="input telPhone" maxlength="18" name="telPhone[]" value="<?php echo $telPhone[$i]; ?>" <?php if (empty($telPhone[$i]) && $i != 0) echo 'style="display:none"'; ?>/>
                <?php } ?>
                <span id="addTel"><a style="cursor:pointer;">添加</a></span><span class="color_red">*</span>
                <span id="showtelphoneerror" class="color_red"></span>
            </div>
            <div class="row">
                <label>地&nbsp;&nbsp;址：</label>
                <?php
                $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));

                $state = CHtml::listData($state_data, "ID", "Name");
                $s_default = $model->isNewRecord ? '' : $model->Province;
                echo $form->dropDownList($model, 'Province', $state, array(
                    'class' => 'select',
                    'empty' => '请选择省份',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/common/dynamiccities', //url to call
                        'update' => '#Organ_City', //selector to update
                        'data' => 'js:"province="+jQuery(this).val()',
                )));

                //empty since it will be filled by the other dropdown
                $c_default = $model->isNewRecord ? '' : $model->City;
                if (!$model->isNewRecord) {
                    $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->Province));
                    $city = CHtml::listData($city_data, "ID", "Name");
                }

                $city_update = $model->isNewRecord ? array() : $city;
                echo $form->dropDownList($model, 'City', $city_update, array(
                    'class' => 'select',
                    'empty' => '请选择城市',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict', //url to call
                        'update' => '#Organ_Area', //selector to update
                        'data' => 'js:"city="+jQuery(this).val()',
                )));
                $d_default = $model->isNewRecord ? '' : $model->Area;
                if (!$model->isNewRecord) {
                    $district_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $model->City));
                    $district = CHtml::listData($district_data, "ID", "Name");
                }
                $district_update = $model->isNewRecord ? array() : $district;
                echo $form->dropDownList($model, 'Area', $district_update, array(
                    'class' => 'select',
                    'empty' => '请选择地区',
                        )
                );
                ?>
                <?php
                echo $form->textField($model, 'Address', array(
                    'class' => 'input',
                ));
                ?>
                <span class="color_red">*</span>
                <span id="showAddresserror" class="color_red"></span>
            </div>

        </div>


    </div>
</div>
<div class=" m-top " style="margin:0 auto; width:920px">
        <div class="float_l bor_back" style="width:440px; height:295px">
            <p class="txxx">营业执照</p>
            <div class="txxx_info4"> 
                <div class="row"><label class="m_left12">注册号：</label>
                    <?php
                    echo $form->textField($model, 'Registration', array(
                        'class' => 'width250 input',
                        "data-options" => "required:true",
                        'maxlength' => '15'));
                    ?>
                </div>
                <div class="row">
                    <p style="float:left; width:65px">执照照片：</p>
                    <div style="float:left; border:1px solid #ebebeb; width:240px; height: 151px; position: relative">
                        <div class="form-row" id="showBLPhotolist" style=" position: relative;">
                            <ul id="upload_photo">
                                <?php if (!empty($model['BLPoto'])): ?>
                                    <li style="margin-right:5px">
                                        <img src="<?php echo F::uploadUrl() . $model['BLPoto']; ?>" style="width:240px;height:150px;" />
                                        <span id="delphoto" keyid="<?php echo $model['BLPoto'] ?>" class="guanbi4"><img src="<?php echo F::themeUrl(); ?>/images/guanbi3.png" /></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <input type='hidden' value='' id="BLPoto" name='BLPoto' class='width114 input'>
                    </div>
                    <div class="clear"></div>
                </div>
                <p class="m-top" style="padding-left:85px"> <input type='file' name='file_upload' id="BLPoto_upload"></p>
            </div>
        </div>
        <div class="float_r bor_back" style="width:465px; height: 295px">
            <?php if ($identity == 3) { ?>
                <p class="txxx">门店照片</p>
                <div class="txxx_info4"> 
                    <div class="upload_img" style="max-height:190px; overflow-y: auto;*overflow:scroll">
                        <div class="form-row" style=" position: relative;">
                            <ul id="showShopPhotolist">
                                <?php if (!empty($organphotos[2])): ?>
                                    <?php foreach ($organphotos[2] as $k => $organphoto): ?>
                                        <li style="margin-right:10px">
                                            <img src="<?php echo F::uploadUrl() . $organphoto['Path']; ?>" style="width:120px;height:90px;">
                                            <span id="delShopphoto" keyid="<?php echo $organphoto['Path'] ?>" class="guanbi3"><img src="<?php echo F::themeUrl(); ?>/images/guanbi3.png"></span>
                                            <?php $path_str .= $val['Path'] . ","; ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <input type='hidden' name='ShopPoto' id="ShopPoto" value="<?php echo $path_str; ?>">
                            <input type='hidden' name='delShopPoto' id="delShopPoto" value="">
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <p class="m-top" style="padding-left:125px"><input type='file' name='file_upload' id="ShopPoto_upload"></p>
                </div>
                <?php $this->renderPartial("uploadBLPhoto2", array('OrganID' => $model['ID'])); ?>
            <?php } elseif ($identity == 2) { ?>
                <p class="txxx">品牌授权书</p>
                <div class="txxx_info4"> 
                    <div style="max-height:190px; overflow-y: auto;*overflow:scroll">
                        <div class="form-row" style=" position: relative;">
                            <ul id="showShopPhotolist">
                                <?php if (!empty($organphotos[1])): ?>
                                    <?php foreach ($organphotos[1] as $k => $organphoto): ?>
                                        <li style="margin-right:10px; margin-bottom:10px">
                                            <label style=" vertical-align: top"><?php echo $organphoto['BrandName']; ?>：</label>
                                            <a href="javascript:void(0);" class="btn_addPic" style="margin-left:5px">
                                                <span id="img_<?php echo $organphoto['ID']; ?>_one">
                                                    <?php if ($organphoto['url1']): ?>
                                                        <img style='width:80px;height:80px;border:none' src="<?php echo F::uploadUrl() . $organphoto['url1']; ?>" path="<?php echo $organphoto['url1']; ?>" key="<?php echo $organphoto['ID']; ?>" app='one' ondblclick='deleteimg(this)'>
                                                    <?php endif; ?>
                                                </span>
                                                <input type="file" name="upload_file[]" class="filePrew" id="one_<?php echo $organphoto['ID']; ?>">
                                            </a>
                                            <a href="javascript:void(0);" class="btn_addPic" >
                                                <span id="img_<?php echo $organphoto['ID']; ?>_two">
                                                    <?php if ($organphoto['url2']): ?>
                                                        <img style='width:80px;height:80px;border:none' src="<?php echo F::uploadUrl() . $organphoto['url2']; ?>" path="<?php echo $organphoto['url2']; ?>" key="<?php echo $organphoto['ID']; ?>" app='two' ondblclick='deleteimg(this)'>
                                                    <?php endif; ?>
                                                </span>
                                                <input type="file" name="upload_file[]" class="filePrew" id="two_<?php echo $organphoto['ID']; ?>">
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                     
                </div>
                <?php $this->renderPartial("uploadBLPhoto1", array('OrganID' => $model['ID'], 'data' => $organphotos[1])); ?>
            <?php } elseif ($identity == 1) { ?>
            <?php } ?>
        </div>
        <div style="clear:both"></div>
    </div>
<div class=" m-bottom" align="center"><input id="save" type="button" class="submit m-top20" value="下一步"></div>
    <?php
    $this->renderPartial("uploadBLPhoto");
    ?>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<script type="text/javascript"><!--
    $(document).ready(function() {
        $("#save").click(function(){
            //机构简介为空验证
            if($("#Organ_Introduction").val() == ""){
                $("#Organ_Introduction_em_").html("机构简介不能为空！");
                $("#Organ_Introduction_em_").css("display","inline-block");
                return false;
            }
            //机构图片为空验证
            if ($("#showimglist").find("li").length == 0) {
                alert("您还没有上传机构图片！");
                return false;
            }
            //座机号码不能为空验证
            var num = 0;
            $(".telPhone").each(function(){
                if($(this).val() == ""){
                    num++;
                }
            });
            if(num == 4){
                $("#showtelphoneerror").html("至少填写一个座机号码！");
                return false;
            }else{
                $("#showtelphoneerror").html("");
            }
            //地址不能为空验证
            if($("#Organ_City").val() == ""){
                $("#showAddresserror").html("地址不能为空");
                return false;
            }else{
                $("#showAddresserror").html("");
            }
            $("#organdata_form").submit();
        });
        //机构简介不能为空验证
        $("#Organ_Introduction").blur(function(){
            if($("#Organ_Introduction").val() == ""){
                $("#Organ_Introduction_em_").html("机构简介不能为空！");
                $("#Organ_Introduction_em_").css("display","inline-block");
            }else{
                $("#Organ_Introduction_em_").html("");
                $("#Organ_Introduction_em_").css("display","none");
            }
        });
        //座机号码不能为空验证
        $(".telPhone").blur(function(){
            var num = 0;
            $(".telPhone").each(function(){
                if($(this).val() == ""){
                    num++;
                }
                if(num == 4){
                    $("#showtelphoneerror").html("至少填写一个座机号码！");
                    return false;
                }else{
                    $("#showtelphoneerror").html("");
                }
            });
        });
        //删除图片事件
        $("#delfile").live('click', function() {
            $("#file_upload").uploadify('disable', false);
            var photoId = $(this).attr('keyid');
            if (typeof (photoId) != "undefined") {
                var phIds = $("#photoId").val();
                if (phIds != '') {
                    var photoIds = phIds + ',' + photoId;
                } else {
                    var photoIds = photoId;
                }
                $("#photoId").val(photoIds);
            }
            $(this).parent().remove();
        });
        var j = "<?php echo $j; ?>";
        $("#addTel").click(function() {
            if (j == 0)
                j = 1;
            if (j >= 4) {
                alert("座机号码最多只能添加4个！");
                return false;
            }
            $("input:text[key=" + j + "]").css('display', 'inline-block');
            j++;
        });
        $("#Organ_Province").change(function() {
            if ($(this).val()) {
                var province = $(this).val();
                var url = '<?php echo Yii::app()->createUrl('/common/dynamicarea') ?>';
                $.getJSON(url, {province: province}, function(data) {
                    if (data != '') {
                        $("#Organ_Area").empty();
                        $.each(data, function(key, val) {
                            jQuery("<option value='" + key + "'>" + val + "</option>").appendTo("#Organ_Area");
                        });
                    }
                });
            } else {
                $("#Organ_Area").empty();
                $("<option value=''>请选择地区</option>").appendTo("#Organ_Area");
            }
        });
    });
--></script>
<script type="text/javascript">
    $(function() {
<?php $path = Yii::app()->user->getIdentity() . '/' . Yii::app()->user->getOrganID() . '/'; ?>
        var path = "<?php echo $path; ?>";
        setTimeout(function(){
        $("#file_upload").uploadify({
            'auto': true,
            'queueId': 'some_file+queue',
            'swf': '<?php echo F::themeUrl(); ?>/js/uploadify/uploadify.swf',
            'uploader': '<?php echo F::baseUrl(); ?>/upload/ftpupload',
            'buttonText': '上传机构图片',
            'height': 25, //flash高
            'method': 'post',
            'formData': {'path': path},
            'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg',
            'queueSizeLimit': 1, //上传数量  
            'fileSizeLimit': '2MB', //上传文件的大小限制
            'onSWFReady': function() {
                if ($("#showimglist").find("li").length >= 5) {
                    $("#file_upload").uploadify('disable', true);
                }
            },
            'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                var errorinfo = '';
                if (responeseDataObj && responeseDataObj.code == 200) {
                    var src_1 = "<?php echo F::uploadUrl() ?>";
                    var src = src_1 + responeseDataObj.fileurl;
                    var span = "<li><img  style='width:80px;height:80px;' src=" + src + "><span id='delfile' keyid=" + responeseDataObj.fileurl + " class='guanbi3'><img src='<?php echo F::themeUrl(); ?>/images/guanbi3.png'></span><input type='hidden' name='goodsImages[]' value=" + responeseDataObj.fileurl + "></li>";
                    $("#showimglist").append(span);
                } else {
                    errorinfo += '文件上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
                if ($("#showimglist").find("li").length == 5) {
                    $("#file_upload").uploadify('disable', true);
                }
            }
        });
        },10);
    });
</script>