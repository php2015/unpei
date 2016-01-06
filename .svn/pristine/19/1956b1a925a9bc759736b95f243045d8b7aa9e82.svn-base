<style>
    .qq li {
        background: url("<?php echo F::themeUrl() ?>/images/qq.png") no-repeat scroll 4px 2px rgba(0, 0, 0, 0);

    }
    .onlineMenu li {
        height: 24px;
        line-height: 24px;
        padding-left:26px;

    }
</style>
<div class="contents">
    <div class="float_l border" style="width:49.5%; height:320px;border-right:none">
        <div class="padding15 m_left30 m_top10" >
            <div class="float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/girl.jpg"></div>
            <div class="float_l" >
                <p class="wz  m_top10"><b>在线客服</b></p>
                <p class="m_top10"><span class=" ">推荐指数:</span>
                    <?php for ($i = 0; $i < $qq['Recommend']; $i++): ?>
                        <img src="<?php echo F::themeUrl() ?>/images/helpcenter/start.jpg">
                    <?php endfor; ?>
                </p>
                <div style="float:left; margin-top: 10px">适用人群:</div>
                <div style="float: left;width:250px; margin-left: 5px; margin-top: 8px;  margin-bottom: 8px;"><?php echo $qq['Suit'] ?></div>
                <div style="clear:both"></div>
                <div class="m_top10" style="float: left">客服号码:</div>
                <div class="m_top10 onlineMenu" style="float:left">
                    <?php if($lms_time):?>
                    <?php foreach ($lms_time as $key => $value): ?>
                        <?php //if ($isline[$key] == 1): ?>
                             <a style="display:block"; target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $lms_qq[$key] ?>&site=qq&menu=yes;" title="点击这里给我发消息">
                                <img src = "<?php echo F::themeUrl() ?>/images/qq.png" style = "vertical-align:middle">
                                <span style="display:inline-block;width:55px;text-align:center;line-height:25px;height:25px;background:url(<?php echo F::themeUrl() ?>/images/helpcenter/qq1.jpg) no-repeat center;font-size:12px">
                                    <?php echo $lms_name[$key]; ?>
                                </span>
                             </a>
                        <?php //endif; ?>
                                 <!--<p class="m_top10"><span class="">服务时间:</span><span class="m_left5 red"><?php echo $value[0] . '至' . $value[1] . $value[2] . '-' . $value[3] ?> </span></p>-->   
                    <?php endforeach; ?>
                      <?php else:?>
                    <?php echo '暂无客服'?>
                    <?php endif;?>
                </div>
            </div>
            <div class="clear"></div>
        </div>


    </div>
    <div class="float_l border " style="width:49.5%;height:320px;">
        <div class="padding15 m_left30 m_top10" >
            <div class="float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/tel.jpg"></div>
            <div class="float_l" >
                <p class="wz  m_top10"><b>电话客服</b></p>
                <p class="m_top10"><span class="">推荐指数:</span>
                    <?php for ($i = 0; $i < $Telkefu['Recommend']; $i++): ?>
                        <img src="<?php echo F::themeUrl() ?>/images/helpcenter/start.jpg">
                    <?php endfor; ?>
                </p>
                
                <div style="float:left; margin-top: 10px">适用人群:</div>
                <div style="float: left;width:250px; margin-left: 5px; margin-top: 8px;  margin-bottom: 8px;"><?php echo $Telkefu['Suit'] ?></div>
                <div style="clear:both"></div>
                <p class="m_top10"><span class="">服务时间:</span><span class="m_left5 red"><?php echo $opentime[0] . '至' . $opentime[1] . $opentime[2] . '-' . $opentime[3] ?> </span></p>
                <div class="m_top10" style="float: left">客服热线:</div>
                <div class="m_top10 onlineMenu" style="float:left">
                    <?php foreach ($dianhua as $k => $v): ?>
                        <?php echo "&nbsp" . $v . "<br />"; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
