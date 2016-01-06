<style>
    .ti{ text-indent:15px}
    /*.box_info p{ margin-bottom:12px}*/
    .sub-wz{ font-size:14px; letter-spacing:1.5px; line-height:30px; color:#666; font-weight:bold}
    .subway-item-center{ background:url(<?php echo F::themeUrl() ?>/images/helpcenter/sub-bg.png) no-repeat; width:172px; height:25px; margin:0 38px 10px;text-indent:17px; line-height:19px;*line-height:25px }
</style>
<?php if (Yii::app()->user->hasFlash('failed')): ?>
    <div class="contents">
        <div class='info' style='border-radius: 10px;width:500px; margin: 0 auto;border:1px solid #666;background:#4096ee;color:#fff;text-indent:15em;'>
            <?php echo Yii::app()->user->getFlash('failed') ?>
        </div>
    </div>
<?php endif ?>
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".info").animate({opacity:1.0},4000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<div class="contents">
    <div class="float_l  width190" >
        <div class="box " style="height:375px;">
            <div class="box_lm">联系我们</div>
            <div class="box_info padding10">
                <p><img src="<?php echo F::themeUrl() ?>/images/helpcenter/girl.jpg" width="30" style="vertical-align:middle"><b style="color:#4096ee">在线客服</b></p>
                <div class = "ti"  style="margin-bottom:8px;">嘉配QQ客服：</div>
<!--                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $num ?>&site=qq&menu=yes;" title="点击这里给我发消息">
                     <img src = "<?php echo F::themeUrl() ?>/images/helpcenter/qq.jpg" style = "vertical-align:middle">
                 </a>-->
                <div style="margin-left:6px;*margin-left:0px;">
                    <?php if ($num): ?>
                        <?php foreach ($num as $key => $value): ?>
                            <?php //if ($isline[$key] == 1): ?>
                            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $value ?>&site=qq&menu=yes;" title="点击这里给我发消息">
                                <img src = "<?php echo F::themeUrl() ?>/images/qq.png" style = "vertical-align:middle" style="position:absolute;*position:relative;">
                                <span style=" position:relative;top:-8px;left:-5px;display:inline-block;width:55px;text-align:center;line-height:25px;height:25px;background:url(<?php echo F::themeUrl() ?>/images/helpcenter/qq1.jpg) no-repeat center;font-size:12px">
                                    <?php echo $nickname[$key]; ?>
                                </span>
                            </a>
                            <?php //endif;  ?>
                    <!--<p class = "ti">服务时间：</p>-->
        <!--                <p class = "ti"><?php echo $fact_online[$key][0] . '至' . $fact_online[$key][1] . $fact_online[$key][2] . '-' . $fact_online[$key][3]
                            ?></p>-->
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php echo '暂无客服' ?>
                    <?php endif; ?>
                </div>
                <p class="m_top10"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/tel.jpg" width="30" style="vertical-align:middle"><b style="color:#4096ee">服务热线</b></p>
                <p class="ti">400电话：400-0909-839</p>
                <p class="ti">服务时间：</p>
                <p class="ti"><?php echo $opentime[0] . '至' . $opentime[1] . $opentime[2] . '-' . $opentime[3] ?></p>

            </div>
        </div>
    </div>

    <div class="float_r width795">
        <form method="get" target="_self"  action="<?php echo Yii::app()->createUrl('helpcenter/home/searchlist') ?>">
            <div class="box-sousuo">
                <input type="text" value="请输入关键字"  class="sousuo input" name="Title"/>
                <input type="submit" class="botton" value="搜 索" style="cursor:pointer"/>
            </div>
        </form>
        <p class="fw padding10 wz">多种服务渠道为您解决问题</p>
        <div class="subway">
            <div class="float_l subway-item">
                <div class="subway-item-top">
                    <img src="<?php echo F::themeUrl() ?>/images/helpcenter/sub6.png">
                    <p align="center" class="sub-wz">在线客服</p>
                </div>
                <div class="subway-item-center">推荐指数:
                    <?php for ($i = 0; $i < $qq['Recommend']; $i++): ?>
                        <img src="<?php echo F::themeUrl() ?>/images/helpcenter/start.png" style="vertical-align:middle">
                    <?php endfor; ?>
                </div>    
                <div class="subway-item-bottom">
                    <p><?php echo $qq['Desc'] ?></p>
                    <p align="center"><span><a href="javascript:void(0)" onclick="checktel()">立即使用</a></span></p>
                </div>
            </div>
            <div class="float_l subway-item bl_no">
                <div class="subway-item-top">
                    <img src="<?php echo F::themeUrl() ?>/images/helpcenter/sub5.png">
                    <p align="center" class="sub-wz">提交问题</p>
                </div>
                <div class="subway-item-center">推荐指数:
                    <?php for ($i = 0; $i < $qianbao['Recommend']; $i++): ?>
                        <img src="<?php echo F::themeUrl() ?>/images/helpcenter/start.png" style="vertical-align:middle">
                    <?php endfor; ?>
                </div>  
                <div class="subway-item-bottom">
                    <p><?php echo $qianbao['Desc'] ?></p><p align="center"><span><a href="javascript:void(0)" onclick="checkques()">开始提交</a></span></p>
                </div>
            </div>
            <div class="float_l subway-item bl_no">
                <div class="subway-item-top">
                    <img src="<?php echo F::themeUrl() ?>/images/helpcenter/sub4.png">
                    <p align="center" class="sub-wz">服务热线</p>

                </div>
                <div class="subway-item-center">推荐指数:
                    <?php for ($i = 0; $i < $dianhua['Recommend']; $i++): ?>
                        <img src="<?php echo F::themeUrl() ?>/images/helpcenter/start.png" style="vertical-align:middle">
                    <?php endfor; ?>
                </div>  
                <div class="subway-item-bottom">
                    <p align="center"><?php echo $dianhua['Desc'] ?></p>
                    <p> 服务时间：<?php echo $opentime[0] . '至' . $opentime[1] . $opentime[2] . '-' . $opentime[3] ?> </p>    
                    <p align="center"><span> <a href="javascript:void(0)" onclick="checktel()">查看电话指引</a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<script>


    //点击时让输入框清空
    $("input[name=Title]").click(function() {
        var Title = $(this).val();
        if (Title == '请输入关键字') {
            $(this).val('');
        }
    })
    $("input[name=Title]").blur(function() {
        var Title = $(this).val();
        if (Title == '') {
            $(this).val('请输入关键字');
        }
    })

    function checkques() {
        var url = Yii_baseUrl + '/helpcenter/home/addquestion';
        window.location.href = url;
    }
    function checktel() {
        var url = Yii_baseUrl + '/helpcenter/home/kefu';
        window.location.href = url;
    }
</script>