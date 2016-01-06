<?php
$this->pageTitle = Yii::app()->name . ' - ' . "车辆信息";
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '车辆管理' => Yii::app()->createUrl('servicer/servicevehicle/index'),
    '车辆信息'
);
?>
<style>
    .gsxx{ width:800px; margin:0 auto; line-height:30px}
    .a_r{ text-align:right}
    .a_l{text-align:left}
    .a_c{ text-align:right}
    .txxx3{ border-bottom:1px dashed #c9d5e3}
    .jg_show { margin:10px 20px}
    .jg_show ul li{ float:left; margin:10px; border:1px solid #ebebeb; padding:5px }
    .jg_show ul li img{ width:200px; height:150px}
    .width115{ width:115px}
    .btn_addPic2{ height:25px; width:100px; background:#f2b303; cursor:pointer; line-height:25px;border-radius:2px}
    .btn_addPic2 span{ color:#fff; font-weight:bold; text-align:center; margin-left:10px; cursor:pointer}
    .filePrew2{height:25px; width:100px; cursor:pointer }
    .upload_jgtp li{ float:left; margin-right:5px; height:81px; width:81px; border:1px solid #ebebeb; position:relative }
    .upload_jgtp li img{ width:80px; height:80px}
    span.guanbi3{ position:absolute; z-index:10; right:0px; cursor:pointer}
    span.guanbi3 img{ width:10px; height:10px}
    .zdyul li{width:30%; margin-left:70px; float:left; line-height:30px;}
</style>
<div class="bor_back m-top">
    <p class="txxx txxx3">车主信息
<!--        <span style="float:right; width:60px; height:35px; line-height:35px">
            <a href="javascript:void(0);" id="back" style="font-weight:400">返回</a>
        </span>-->
    </p>

    <p>
        <span style="display:block;float: right;margin-top: -25px;margin-right: 5px;"> <a href="javascript:void(0);" id="back" style="font-weight:400">返回</a></span>
    </p>
    <div class="txxx_info4">
        <div class="gsxx">
            <ul class="zdyul m-top">
                <li>车主姓名：<span><?php echo $owner['Name']; ?></span></li>
                <li>昵称：<span><?php echo $owner['NickName']; ?></span></li>
                <li>性别：<span><?php echo $owner['Sex']; ?></span></li>
                <li>驾驶环境：<span><?php echo $owner['DrivingEnvironment']; ?></span></li>
                <li>邮箱：<span><?php echo $owner['Email']; ?></span></li>
                <li>QQ：<span><?php echo $owner['QQ']; ?></span></li>
                <li>手机号：<span><?php echo $owner['Phone']; ?></span></li>
                <li>驾驶证号：<span><?php echo $owner['DrivingLicense']; ?></span></li>
                <li>所在城市：<span><?php echo Area::showCity($owner['City']); ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
        </div>
    </div>

    <p class="txxx txxx3">车辆信息</p>
    <div class="txxx_info4">
        <div class="gsxx" style="margin-bottom:30px">
            <ul class="zdyul m-top">
                <li>车牌号：<span><?php echo $car['LicensePlate']; ?></span></li>
                <li>行驶证号：<span><?php echo $car['VehicleLicense']; ?></span></li>
                <li>使用性质：<span><?php echo $car['UseNature']; ?></span></li>
                <li>购置时间：<span><?php echo date('Y-m-d',$car['BuyTime']) ?></span></li>
                <li>行驶里程：<span><?php echo $car['Mileage']; ?></span></li>
                <li>车架号：<span><?php echo $car['VinCode']; ?></span></li>
                <li>服务关系：<span><?php echo $car['Relation']; ?></span></li>
                <li>配件档次：<span><?php echo $car['PartsLevel']; ?></span></li>
                <li>汽车品牌：<span><?php echo $car['Car']; ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#back').click(function(){
            history.go(-1);
        });
    })
</script>