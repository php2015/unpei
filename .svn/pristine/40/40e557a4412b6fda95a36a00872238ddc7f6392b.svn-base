
<!--<script  type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/style.js"  ></script>
<script  type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/Myjs.js"  ></script>-->



<?php
$this->breadcrumbs = array(
    '商品管理'=>Yii::app()->createUrl('common/goodslist'),
    '发布商品'
        )
?>
<div class="bor_back m-top" style="height:560px">
    <div class="success upload-success">
        <div class="float_l"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/<?php if ($result['success']) { ?>success.png<?php } else { ?>fail.jpg<?php } ?>" ></div>
        <div class="float_l m_left20" >
            <b class="success_info"><?php if ($result['success']) { ?>商品发布成功！<?php } else { ?>商品发布失败<?php } ?>            <?php
if (!$result['success']) {
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;失败原因是：' . $result['errorMsg'];
}
?></b>

            <p style="line-height:30px" class="m-top"> <span>请选择<a href="<?php echo Yii::app()->createUrl('pap/dealergoods/addinfo1'); ?>" style="color:#ff6701">继续添加</a></span><span class="m_left40"><a href="<?php echo Yii::app()->createUrl('pap/dealergoods/addinfo1'); ?>">返回商品发布页</a></span></p>

        </div>
        <div style="clear:both"></div>
        <p  class="f_weight m-top" style="font-size:14px; padding-left: 90px"><span class="sec">10</span> 秒后返回商品列表页</p>
        <p  class=" m-top" style="padding-left: 120px"><button class="submit" onclick="gotos()">立即跳转</button></p>
    </div>

</div>
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
            window.location.href ="<?php echo Yii::app()->createUrl('pap/dealergoods/index'); ?>";
    }
    function gotos(){
        window.location.href ="<?php echo Yii::app()->createUrl('pap/dealergoods/index'); ?>";
    }
</script>