<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/newhome/hm.css"/>
<div class="wrap-contents" >
    <!--首页图标开始-->
    <div class="index-content">
        <div class="pre float_l"></div>
        <div class="icon-mk  float_l">
            <div class="all-icon " style="min-height: 360px">
                <!--常用工具栏-->
                <div class="icon-info" style=" display:block">
                    <?php
                    if (!empty($menuArr) && is_array($menuArr)):
                        foreach ($menuArr as $key => $value):
                            foreach ($value['children'] as $sk => $sv):
                                if ($sv['type'] == 0) {
                                    continue;
                                }
                                ?>
                                <div class="icon float_l">
                                    <a href="<?php echo !empty($sv['url'])?Yii::app()->createUrl($sv['url']):'javascript:void(0)';?>">
                                        <img src="<?php echo F::uploadUrl() ?>common/frontmenu/<?php echo $sv['icon']; ?>">
                                        <p class=" line30"><b><?php echo $sv['name'] ?></b></p> </a>
                                    <!--                            <div class="mess">99+</div>-->
                                </div>
                                <?php
                            endforeach;
                        endforeach;
                    else:
                        ?>
                    <span style="padding-left: 200px;margin-top:200px"> 暂无菜单</span>
                    <?php endif; ?>
                    <div class="clear"></div>
                </div> 
                <!--头部导航栏菜单-->
                <?php
                if (!empty($menuArr) && is_array($menuArr)):
                    foreach ($menuArr as $km => $m):
                        if ($km >= 2) {
                            break;
                        }
                        ?>
                        <div class="icon-info">
                            <?php foreach ($m['children'] as $ck => $child): ?>
                                <div class="icon float_l">
                                    <a href="<?php echo !empty($child['url'])?Yii::app()->createUrl($child['url']):'javascript:void(0)'; ?>">
                                        <img src="<?php echo F::themeUrl() ?>/images/shophome/<?php echo $child['icon'] ?>">
                                        <p class=" line30"><b><?php echo $child['name'] ?></b></p>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                            <div class="clear"></div>
                        </div> 
                        <?php
                    endforeach;
                else:
                    ?>
                    <div class="icon-info">暂无菜单</div>
                <?php endif ?>
            </div> 
            <div class="clear"></div> 

            <div class="index-mk-title m-top10" style="border:1x solid red">
                <ul class="">
                    <li class="current">常用工具</li>
                    <?php
                    if (!empty($menuArr) && is_array($menuArr)):
                        foreach ($menuArr as $key => $value):
                            ?>
                            <?php
                            if ($key >= 2) {
                                break;
                            }
                            ?>
                            <li key="<?php echo $value['iD'] ?>"><?php echo $value['name'] ?></li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
        <div class="next float_r"></div>
        <div class="clear"></div>
    </div>
</div>
<script>
    //轮播切换
    var a = 0;
    $('.next ').click(function() {
        a++;
        if (a > 2) {
            a = 2;
            return false;
        }
        play(a);
    });
    $('.pre').click(function() {
        a--;
        if (a < 0) {
            a = 0;
            return false;
        }
        play(a);
    })
    function play(a) {
        $(".icon-info:eq(" + a + ")").show();
        $(".icon-info:eq(" + a + ")").siblings().removeClass('current').hide();
        $(".index-mk-title ul li:eq(" + a + ")").addClass('current');
        $(".index-mk-title ul li:eq(" + a + ")").siblings().removeClass('current');
    }

</script>