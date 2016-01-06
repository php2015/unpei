<style>
    .video-left li{ background:#fcfcfc;height:29px; line-height:29px; text-indent:5px; border-bottom:1px solid #ebedec}
    .video-left li.current{ background-position:10px -19px}
    .video-left li.current a{ font-weight:bold; color:#0266bc}
    .botton{
        background:url(<?php echo F::themeUrl() ?>/images/helpcenter/tubiao.png) no-repeat -167px -84px; height:30px; width:70px; border:none; color:#fff; font-weight:bold; font-size:14px
    }
    .sousuo{background:url(<?php echo F::themeUrl() ?>/images/helpcenter/tubiao.png) no-repeat #fff -188px -43px; border:1px solid #ccc;width:310px; margin:3px; height:25px; text-indent:30px ; color:#a5a5a5; outline:none; padding:1px}
</style>
<div class="contents">
<!--    <div class="box-sousuo">
        <input type="text" value="输入问题关键字"  class="sousuo input"/>
        <input type="submit" class="botton" value="搜 索"/>
    </div>-->
    <div class="m_top10">
        <div class="float_l  width190">
            <div class="box">
                <div class="box_lm">视频列表</div>
                <div class="box_info">
                    <ul class="video-left">
                        <?php foreach ($videolist as $key => $value): ?>
                            <li><a href="javascript:void(0)" onclick="lookvideo('<?php echo $value['ID'] ?>')"><?php echo $value['Title'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div> 
        </div>
        <div class="float_r width795">
            <div class="subway border">
                <p class="fw padding10 wz">视频名称：
                    <span style="color:#0266bc"><?php echo $model['Title']; ?></span>
                </p>
                <div class="padding10">
                    <embed src="<?php echo $model['Path'];?>" wmode="transparent" width="600px" align="center" border="0" height="360px">
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
    function lookvideo(ID){
        var url = Yii_baseUrl+'/helpcenter/home/video/ID/'+ID;
        window.location.href=url;  
    }
</script>
