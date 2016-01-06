
<!--<script  type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/style.js"  ></script>
<script  type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/Myjs.js"  ></script>-->



<?php
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl('common/dealmemberlist'),
    '主营信息管理'=> Yii::app()->createUrl('dealer/Mainbusiness/Index'),
    '添加结果'
        )
?>
<div class="bor_back m-top" style="height:560px">
    <div class="success upload-success">
        <div class="float_l"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/<?php if ($result['success']) { ?>success.png<?php } else { ?>fail.jpg<?php } ?>" ></div>
        <div class="float_l m_left20" >
            <b class="success_info">
                <?php
                if ($result['status'] == 'add') {
                    if ($result['success']) {
                        echo '品牌添加成功！';
                    } else {
                        echo '品牌添加失败';
                    }
                } else {
                    if ($result['success']) {
                        echo '品牌修改成功！';
                    } else {
                        echo '品牌修改失败';
                    }
                }
                ?>
            </b>
            <?php
            if (!$result['success']) {
                echo '<p style="line-height:30px" class="m-top"> 失败原因是：' . $result['errorMsg'] . '</p>';
            }
            ?>
            <?php if ($result['status'] == 'add'): ?>
                <p style="line-height:30px" class="m-top"> <span>请选择<a href="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Addbrand'); ?>" style="color:#ff6701">继续添加</a></span><span class="m_left40"><a href="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Index'); ?>">返回主营信息管理</a></span></p>
            <?php endif; ?>
        </div>
        <div style="clear:both"></div>
        <p  class="f_weight m-top" style="font-size:14px; padding-left: 90px"><span class="sec">10</span> 返回主营信息管理</p>
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
            window.location.href ="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Index'); ?>";
    }
    function gotos(){
        window.location.href ="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Index'); ?>";
    }
</script>