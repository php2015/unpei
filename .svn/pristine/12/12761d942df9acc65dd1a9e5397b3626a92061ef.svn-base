
<style>
    .li_img img{ text-align:center; vertical-align:middle;margin:0 auto;*margin-top:0px;max-width:486px;
 　myimg:expression(onload=function(){ 
　　this.style.width=(this.offsetWidth >486)?"486px":"auto"})}
.li_img img{max-height:362px; 
　　myimg:expression(onload=function(){ 
　　this.style.height=(this.offsetHeight >362)?"362px":"auto"});}
</style>
<span><i>1</i>/<em><?php echo count($car_picture) ?></em></span>
<a class="prev" href="javascript:void(0);"></a>
<a class="next" href="javascript:void(0);"></a>
<div class="image">
    <ul>
        <?php foreach ($car_picture as $key => $val): ?>
        <li style="background:#ebebeb" class="li_img"><img src="<?php echo $val['originPic'] ?>"  style="vertical-align: middle;"/></li>
        <!--<li style="background:#ebebeb" class="li_img"><img src="<?php echo F::themeUrl() ?>/images/car-car/q5.jpg"  style=" vertical-align: middle;"/></li>-->
                <?php endforeach; ?>
       <div class="clear"></div>
    </ul>
</div>  
<script type="text/javascript">
    //图片切换
    var opl = $('.play');
    var oimg = $('.image');
    var oul = oimg.find('ul');
    var owh = oimg.find('li').width();
    var onum = oimg.find('li').length;
    oul.width((owh+2) * onum);
    $('.play').find('span>em').html(onum);
    var i = 1;
    var p = $('.play').find('span>i');
    $('a.next').click(function() {
        if (i < onum - 1) {
            oul.animate({'left': -(owh+2) * (i)});
            i++;
            p.html(i);
            $('a.next').css('opacity', '0.9');
        } else if (i = onum - 1) {
            $('a.next').css('opacity', '0.4');
            oul.animate({'left': -(owh+2) * (i)});
            i++;
            p.html(i);
        }
        ;
        $('a.prev').css('opacity', '0.9');
    });
    $('a.prev').click(function() {
        if (i > 2) {
            oul.animate({'left': -(owh+1) * (i - 2)})
            i--;
            p.html(i);
            $('a.prev').css('opacity', '0.9');
        } else if (i = 2) {
            oul.animate({'left': -(owh+1) * (i - 2)})
            i--;
            p.html(i);
            $('a.prev').css('opacity', '0.4')
        }
        ;
        $('a.next').css('opacity', '0.9');
    });
</script>