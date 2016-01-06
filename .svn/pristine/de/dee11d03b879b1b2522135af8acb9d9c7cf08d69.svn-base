<?php
$this->pageTitle = Yii::app()->name . '-' . "配件登记";
$this->breadcrumbs = array(
    '配件登记'
);
?>
<style>
    <?php if(empty($LicensePlate) || (!empty($LicensePlate) && array_filter($data)) ){?>
.dis-none{display: none;}
    <?php }else{?>
.dis-block{display: none;}
    <?php }?>
span.w90{ width:93px}
span.w85{ width:85px}
span.w40{ width:40px}
.width180{ width:180px}
input.w151{ width:151px}
select.select{height: 27px;line-height: 27px;padding: 3px 0px;width: 138px;font-family: Trebuchet MS;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl(); ?>/css/support/servicesupport.css"/>
<script type="text/javascript" src='<?php echo F::themeUrl();?>/js/support/servicesupport.js'></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl . '/js/support/jquery.bigautocomplete.js' ?>"></script>
<div class="bor_back m_top10">
    <div class="support">
        <form id="service_support_form" action="<?php echo Yii::app()->createUrl("servicer/servicesupport/addservicedata");?>" method="post">
        <p class="support_search LicensePlate_sousuo" style="padding-left:200px">
            <span class="dis-block "  style="width:76px; text-align: right; margin-left:0px"><span id="add" class="xjd" style="width:76px;margin-left:0px;display: inline-block;cursor:pointer;color:#F37200; text-indent:0em"><b style="color:#F37200" style="margin-left:20px">车牌号：</b></span></span>
            <span class="dis-none"  style="width:76px;text-align: right"><span style="width:76px;display: inline-block;cursor:pointer;"><span  class="color_red">*</span>车牌号：</span></span>
        <input id="LicensePlate" class="input w151 dis-block" type="text" value="<?php echo $LicensePlate!==''?$LicensePlate:'输入车辆号开始检索';?>" maxlength="10" autocomplete="off">
            <input class="input w151 dis-none" type="text" name="LicensePlate" value="<?php echo $LicensePlate;?>" maxlength="10">
            <b class="dis-block "><span style="color: #F37200">车主姓名：</span></b>
            <span class="dis-none"><span class="color_red">*</span>车主姓名：</span>
            <input class="input" type="text" name="OwnerName" value="<?php echo $data['Name'];?>" maxlength="10">
            <input type="hidden" name="CarID" value="<?php echo $data['CarID'];?>"/>
        </p>
        <p class="support_data">
            <input id="is_car_code" value="1"type="hidden">
            <input id="car_code" name="Code" value="<?php echo $data['Code'];?>"type="hidden">
            <span class="search_name "><span class="dis-none color_red">*</span>购置时间：</span><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language' => 'zh_cn',
                'value'=>$data['BuyTime'],//date("Y-m-d",$model->BuyTime),//设置默认值
                'name' => 'BuyTime',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'changeYear' => true,
                ),
                'htmlOptions' => array(
                    'class' => 'input',
                    'readonly' => 'readonly'
                ),
            ));
            ?>
            <span class="search_name w90">车架号/Vin码：</span><input class="input" type="text" name="VinCode" value="<?php echo $data['VinCode'];?>" maxlength="10">（前10位）
            <span class="search_name "><span class="dis-none color_red">*</span>汽车品牌：</span><input id="make-select-index" class="input w267" type="text" name="Car" value="<?php echo $data['Car'];?>" maxlength="64">
        </p><?php $this->widget('widgets.default.WGoodsCarModel'); ?>
        <p class="support_data">
            <span class="search_name">使用性质：</span><select class="select" name="UseNature">
                <option value="0" <?php if($data['UseNature'] == 0){echo 'selected=selected';}?>>请选择</option>
                <option value="1" <?php if($data['UseNature'] == 1){echo 'selected=selected';}?>>私家车</option>
                <option value="2" <?php if($data['UseNature'] == 2){echo 'selected=selected';}?>>公务车</option>
                <option value="3" <?php if($data['UseNature'] == 3){echo 'selected=selected';}?>>运营车</option>
            </select>
            <span class="search_name  w90"><span class="dis-none color_red">*</span>行驶里程(KM)：</span><input id="Mileage" class="input" type="text" name="Mileage" value="<?php echo $data['Mileage'];?>" maxlength="9">
            <span class="search_name w85 "><span class="dis-none color_red">*</span>服务关系：</span><select class="select " name="Relation" style="width:100px;">
                <option value="">请选择</option>
                <option value="1" <?php if($data['Relation'] == 1){echo 'selected=selected';}?>>长期</option>
                <option value="2" <?php if($data['Relation'] == 2){echo 'selected=selected';}?>>暂时</option>
            </select>
            <span class="search_name">配件档次：</span><select class="select" name="PartsLevel" style="width:100px;">
                <option value="">请选择</option>
                <option value="A" <?php if($data['PartsLevel'] == A){echo 'selected=selected';}?>>原厂</option>
                <option value="B" <?php if($data['PartsLevel'] == B){echo 'selected=selected';}?>>高端品牌</option>
                <option value="C" <?php if($data['PartsLevel'] == C){echo 'selected=selected';}?>>经济实用</option>
                <option value="D" <?php if($data['PartsLevel'] == D){echo 'selected=selected';}?>>下线</option>
                <option value="E" <?php if($data['PartsLevel'] == E){echo 'selected=selected';}?>>拆车</option>
            </select>
        </p>
        <p class="support_data">
            <span class="search_name">昵称：</span><input class="input" type="text" name="NickName" value="<?php echo $data['NickName'];?>" maxlength="10">
            <span class="search_name w90">性别：</span><select class="select" name="Sex">
                <option value="">请选择</option>
                <option value="1" <?php if($data['Sex'] == 1){echo 'selected=selected';}?>>男</option>
                <option value="2" <?php if($data['Sex'] == 2){echo 'selected=selected';}?>>女</option>
            </select>
            <span class="search_name  w85">邮箱：</span><input class="input" type="text" name="Email" value="<?php echo $data['Email'];?>" maxlength="128">
            <span class="search_name w40">QQ：</span><input class="input" type="text" name="QQ" value="<?php echo $data['QQ'];?>" maxlength="10">
        </p>
        <p class="support_data">
            <span class="search_name "><span class="dis-none color_red">*</span>手机号：</span><input class="input" type="text" name="Phone" value="<?php echo $data['Phone'];?>" maxlength="11">
            <span class="search_name w90 "><span class="dis-none color_red">*</span>驾驶证号：</span><input class="input" type="text" name="DrivingLicense" value="<?php echo $data['DrivingLicense'];?>" maxlength="30">
            <span class="search_name w85 ">所在城市：</span><select class="select" name="Province">
                <option value="">请选择省份</option>
                <?php 
                    foreach ($area as $key=>$val){
                        if($data['ParentID'] == $val['ID']){
                            echo '<option value="'.$val['ID'].'" selected="selected">'.$val['Name'].'</option>';
                        }else{
                            echo '<option value="'.$val['ID'].'">'.$val['Name'].'</option>';
                        }
                    }
                    echo "<script>$('select[name=Province]').change();</script>";
                ?>
            </select>
            <select class="select" name="City">
                <option value="">请选择城市</option>
                <?php 
                    foreach ($data['cityArr'] as $key=>$val){
                        if($data['City'] == $val['ID']){
                            echo '<option value="'.$val['ID'].'" selected="selected">'.$val['Name'].'</option>';
                        }else{
                            echo '<option value="'.$val['ID'].'">'.$val['Name'].'</option>';
                        }
                    }
                ?>
            </select>
        </p>
        <p class="dis-none" style="padding-left:300px;">
            <input id="save_service_data" type="button" class="submit" value="保存">
            <input id="cancel_save" type="button" style="width:80px;height:30px;cursor: pointer" value="取消">
        </p>
        </form>
    </div>
    <div><b><span id="part_register" class="xjd m-top dis-block" style="margin-left: 5px;cursor:pointer;color: #0463c1">配件登记</span></b></div>
    <div class="dis-block">
    <table class="parts-info m-top">
        <thead>
            <tr>
                <td class="width180">保养项目</td>
                <td class="width250">商品名称</td>
                <td class="width100">商品编号</td>
                <td class="width80">档次</td>
                <td class="width100">品牌</td>
                <td style="width:60px">数量</td>
            </tr>
        </thead>
    </table>
    <table class="parts-info">
        <tbody id="support-vehicle-info">
            <?php 
                $this->widget("widgets.default.WListView", array(
                    'dataProvider' => $dataProvider,
                    'id' => 'list',
                    'itemView' => 'list', // refers to the partial view named '_post'
                    'summaryText' => '',
                    'ajaxUpdate' => true,
                    'emptyText' => '无保养信息',
                ));
            ?>
        </tbody>
    </table>
    </div>
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'isaddparts', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '信息提示',
        'autoOpen' => false, //是否自动打开  
        'modal' => true,
        'width' => 360, //宽度  
        'height' => 150, //高度  
        'buttons' => array(
            '确定' => 'js:function(){ location.href = Yii_baseUrl + "/servicer/servicesupport/index?LicensePlate=" + encodeURI(encodeURI($("#LicensePlate").val()));}', //关闭按钮
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮  
        ),
    ),
));
?>
没有在车辆管理中检索到该车辆信息，是否立即添加到车辆管理中？
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'addparts', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '配件登记',
        'autoOpen' => false, //是否自动打开  
        'modal' => true,
        'width' => 830, //宽度  
        'height' => 480, //高度  
//        'buttons' => array(
//            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮  
//        ),
    ),
));
?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<script>
    $("#LicensePlate").bigAutocomplete({
        width: 289,
        url: Yii_baseUrl + '/servicer/servicesupport/licenseplate/'
    });
    
    $(function(){
        var fLicensePlate = '';//判断LicensePlate的值是否改变
        var lLicensePlate = $('#LicensePlate').val();
        $('#LicensePlate').focus(function(){
            if($(this).val()==='输入车辆号开始检索'){
                $(this).val('');
            }
            fLicensePlate = $(this).val();
        });
        $('#LicensePlate').focus();
        
        $('#LicensePlate').blur(function(){
            if($(this).val()===''){
                $(this).val('输入车辆号开始检索');
            }
        });
        
        $(".content2").click(function(e){
            if($(e.target).is('a') || $(e.target).is('input:button') || $(e.target).is('#add') || $(e.target).is('#part_register') || $(e.target).is('#LicensePlate') || $(e.target).is('#bigAutocompleteContent_LicensePlate tr')){
                return ;
            }else{
                lLicensePlate = $('#LicensePlate').val();
                //alert(fLicensePlate + "1   2" + lLicensePlate);
                if(lLicensePlate && lLicensePlate!=='输入车辆号开始检索' && fLicensePlate !== lLicensePlate){
                    $.post(
                        Yii_baseUrl + "/servicer/servicesupport/licenseplateone",
                        {keyword: $("#LicensePlate").val()},
                        function(result) {
                            if(result){
                                location.href = Yii_baseUrl + '/servicer/servicesupport/index?LicensePlate=' + encodeURI(encodeURI($("#LicensePlate").val()));
                            }else{
                                fLicensePlate = lLicensePlate;
                                $("#isaddparts").dialog('open');
                            }
                        },
                        'json'
                    );
                }
            }
        });
    });
</script>
<script>
    //行程里数只能输入数字
    $("#Mileage").blur(function() {
        var Mileage = $(this).val();
        if (Mileage.match(/[^\d]/g)) {
            alert("行程里数只能输入正整数");
        }
        var reg = /[^\d]/g;
        var str = Mileage.replace(reg, "");
        $(this).attr("value", str);
    })
</script>