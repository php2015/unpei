
<style type="text/css">
    html,body,div,h1,h2,h3,h4,h5,h6,p,br,form,input,button,textarea,select,fieldset,blockquote,ul,ol,li,dl,dt,dd,pre,spang,i,em{margin:0;padding:0; list-style:none; font-style:normal; font-size:12px;}
    a{ text-decoration:none}
    body{ background:#f6f6f6;}
    div{ padding:0px; margin:0px auto;}
    img{ display:inline-block; border:0px;}
    .nav{ width:1000px; height:33px;}
    .nav li{ float:left; width:100px; height:33px; text-align:center; line-height:34px; font-size:14px;}
    .nav li.one{ background:url(<?php echo Yii::app()->theme->baseUrl . '/' ?>images/hot/shouye.png) no-repeat;}
    .nav li.cuxiao{ background:url(<?php echo Yii::app()->theme->baseUrl . '/' ?>images/hot/cux.png) 0px 5px no-repeat;}
    .h_list{ width:1000px; height:266px; z-index:7;}
    .pf{ background:url(<?php echo Yii::app()->theme->baseUrl . '/' ?>images/hot/photof.png) no-repeat;float:left; width:213px; height:213px; padding:21px; margin-left:90px; margin-right:50px;}
    .bjcolor{ background:#<?php echo $GoodsInfo['GoodsColour']; ?>; width:1000px; min-height:266px; margin:-5px auto;}
    /*分割线div*/
    .seline{width:1000px; height:24px; padding:30px 0px;}


    .wklist{ width:180px; height:305px; position:absolute; left:10px; top:80px; background:url(<?php echo Yii::app()->theme->baseUrl . '/' ?>images/hot/leftn.png) no-repeat; z-index:9;}
    .fix{ position:fixed; left:14%; top:2px;}
    .wklist li{ color:#f6f6f6; padding-left:30px; height:40px; line-height:40px; font-size:14px;}


    .fto{ width:100%; height:83px; background:#333;}
    .fto p{ width:100%; height:83px; background:url(<?php echo Yii::app()->theme->baseUrl . '/' ?>images/hot/fto.png) center no-repeat;}
</style>
<div style="width:1000px; height:auto; position:relative;">
    <img src="<?php echo F::uploadUrl() . $GoodsInfo['BGurl'] ?>"/>
    <!--    <div class="wklist">
            <ul>
                <li>周一 养护品</li>
                <li>周二 火花塞</li>
                <li>周三 蓄电池</li>
                <li>周四 雨刮片</li>
                <li>周五 灯泡</li>
                <li>周六 滤清器</li>
                <li>周日 刹车片</li>
            </ul>
        </div>-->
    <!--    <div class="h_list" style="position:absolute; left:0px; bottom:0px;">
            <div class="pf">
                <img src="<?php // echo F::uploadUrl() . $GoodsInfo['carrygoods'][0]['Goodsinfo']['img']['0']['ImageUrl']   ?>" width="212px" height="200px"/>
            </div>
            <div style=" float:left; width:570px;">
                <p style="color:#fff; font-size:40px; margin-top:30px; font-weight:600; font-family:'微软雅黑';"><?php // echo $GoodsInfo['carrygoods'][0]['Goodsinfo']['Name']   ?></p>
                <a style="color:#f27300; background:#fff; font-size:20px; padding:0px 6px; font-family:'微软雅黑'; letter-spacing:6px; text-align:center; line-height:38px;">一直被模仿，从未被超越</a>
                <p style="font-family:'微软雅黑'; width:318px; height:56px;">
    <?php // if ($GoodsInfo['carrygoods'][0]['Goodsinfo']['ProPrice']) { ?>
                        <em style="color:#ffff00; font-size:42px; float:left ; text-decoration: line-through;text-line-through-color:red ">￥<?php // echo $GoodsInfo['carrygoods'][0]['Goodsinfo']['Price']   ?></em>
                        <em style="color:#ffff00; font-size:42px; float:left;">￥<?php // echo $GoodsInfo['carrygoods'][0]['Goodsinfo']['ProPrice']   ?></em>
    <?php // } else { ?>
                        <em style="color:#ffff00; font-size:42px; float:left;">￥<?php // echo $GoodsInfo['carrygoods'][0]['Goodsinfo']['Price']   ?></em>
    <?php // } ?>
                </p>
            </div>
        </div>
        <a href="<?php echo Yii::app()->createUrl("pap/mall/detail/goods/" . $GoodsInfo['carrygoods'][0]['Goodsinfo']['ID']); ?>" style="color:#fff; font-size:20px; border:1px solid #fff; padding:2px 16px; margin-top:11px; position: absolute;bottom:30px; right:150px;z-index: 1000">立即秒杀&gt;&gt;</a>-->

</div>
<div class="bjcolor" >
    <?php foreach ($GoodsInfo['carrygoods'] as $k => $v): ?>
        <?php if ($k): ?>
            <div class="seline" >
                <img src="<?php echo Yii::app()->theme->baseUrl . '/' ?>images/hot/seline.png" />
            </div>
        <?php endif; ?>
        <div class="h_list" style=" position: relative">
            <div class="pf">
                <img src="<?php echo F::uploadUrl() . $v['Goodsinfo']['img']['0']['ImageUrl'] ?>" width="212px" height="212px"/>
            </div>
            <div style=" float:left; width:570px;">
                <p style="color:#fff; font-size:40px; margin-top:30px; font-weight:600; font-family:'微软雅黑';"><?php echo $v['Goodsinfo']['Name'] ?></p>
                <a style="color:#f27300; background:#fff; font-size:20px; padding:0px 6px; font-family:'微软雅黑'; letter-spacing:6px; text-align:center; line-height:38px;">刷刷刷，一万年不变的品质</a>
                <p style="font-family:'微软雅黑'; width:318px; height:56px;">
                    <?php if ($v['Goodsinfo']['ProPrice']) { ?>
                        <em style="color:#ffff00; font-size:42px; float:left ; text-decoration: line-through;text-line-through-color:red ">￥<?php echo $v['Goodsinfo']['Price'] ?></em>
                        <em style="color:#ffff00; font-size:42px; float:left;">￥<?php echo $v['Goodsinfo']['ProPrice'] ?></em>
                    <?php } else { ?>
                        <em style="color:#ffff00; font-size:42px; float:left;">￥<?php echo $v['Goodsinfo']['Price'] ?></em>
                    <?php } ?>

                </p>
            </div>
            <a href="<?php echo Yii::app()->createUrl("pap/mall/detail/goods/" . $v['Goodsinfo']['ID']); ?>" style="color:#fff; font-size:20px; border:1px solid #fff; padding:2px 16px; float:right; margin-top:11px; position: absolute;bottom:30px; right:150px">立即秒杀&gt;&gt;</a>
        </div>
    <?php endforeach; ?>

    <div class="seline">
        <img src="<?php echo Yii::app()->theme->baseUrl . '/' ?>images/hot/seline.png" />
    </div>
</div>
<script type="text/javascript">

    $(function() {
        var wklist = $(".wklist"); //得到导航对象
        var win = $(window); //得到窗口对象
        var sc = $(document);//得到滚动条的高度。
        fnroll(sc, wklist);
        win.scroll(function() {
            fnroll(sc, wklist);
        })

        function fnroll(sc, tools) {
            if (sc.scrollTop() >= 358) {
                wklist.addClass("fix");
            } else {
                wklist.removeClass("fix");
            }
        }
    })

</script>
</html>