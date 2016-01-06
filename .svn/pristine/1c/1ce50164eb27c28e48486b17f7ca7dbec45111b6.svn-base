<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jxs.css"  />
<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/goodscommon.css"  />-->
<style>
    .upload-success {
    margin: 50px auto 0;
    width: 500px;}
    .sec,.success_info{color:#FB540E;font-size:14px}
  
    
</style>
    <?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '已卖出的商品' => Yii::app()->createUrl('pap/sellerorder/index'),
    '评价修理厂'
        )
?>
<div class="bor_back m-top" style="height:560px">
    <div class="success upload-success">
        <div class="float_l"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/<?php if ($result['success']) { ?>success.png<?php } else { ?>fail.jpg<?php } ?>" ></div>
        <div class="float_l m_left20" >
            <b class="success_info"><?php if ($result['success']) { ?>评价成功！<?php } else { ?>评价失败<?php } ?></b>

            <p style="line-height:30px" class="m-top"> <span>请选择<a href="<?php echo Yii::app()->createUrl('pap/Sellerorder/index',array('EvaStatus'=>1,'type'=>4)); ?>" style="color:#ff6701">继续评价</a></span><span class="m_left20"><a href="<?php echo Yii::app()->createUrl('pap/Sellerorder/index'); ?>">返回订单列表</a></span></p>

        </div>
        <div style="clear:both"></div>
    <p  class="f_weight m-top" style="font-size:14px; padding-left: 90px"><span class="sec">10</span> 秒后返回订单列表</p>
    <p class=" m-top" style="padding-left: 120px"><button class="submit" onclick="gotos()">立即跳转</button></p>
</div>   </div>
<script type="text/javascript">
    $(function () {            
        setTimeout("lazyGo();", 1000);
    });
    function lazyGo() {
        var sec = $(".sec").text();
        $(".sec").text(--sec);
        if (sec > 0)
            setTimeout("lazyGo();", 1000);
        else
            window.location.href ="<?php echo Yii::app()->createUrl('pap/Sellerorder/index'); ?>";
    }
    function gotos(){
        window.location.href ="<?php echo Yii::app()->createUrl('pap/Sellerorder/index'); ?>";
    }
</script>