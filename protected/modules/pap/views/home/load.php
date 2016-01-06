<style type="text/css">
    *{margin:0;padding:0;list-style-type:none;}
    a,img{border:0;}
    /* WebDown */
    .WebDown{margin:60px auto; border-radius:7px;position:absolute;z-index:1000;top:140px;display:none}
    .WebDown .tipbox{position:relative;height:320px;background:#fffcef;background:#fff;border-radius:7px;padding:10px;font-size:12px;width:776px;border:solid 2px #ec8051;}
    .WebDown .laba,.WebDown .Close,.WebDown .arrow{background:url(<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/tipboxbg.gif' ?>) no-repeat;}
    .WebDown .laba{display:block;float:left;width:42px;height:39px;overflow:hidden;background-position:-27px 0;}
    .WebDown .tiptext{float:left;margin-left:15px;display:inline;}
    .WebDown  h3,.WebDown  h1{font-size:18px;color:#db7c22;font-family:"微软雅黑","宋体";height:34px;line-height:30px;}
    .WebDown  h1{ font-size:24px; text-align:center;}
    .WebDown .tiptext p label{color:#999;cursor:pointer;margin-left:5px;}
    .WebDown .Close{width:14px;height:14px;overflow:hidden;background-position:-13px 0px;position:absolute;top:5px;right:5px;cursor:pointer;}
    .WebDown img{ vertical-align:middle;  margin-right:3px}
    .WebDown li{ float:left; margin:2px 1px; width:250px}
    .WebDown li b{ color:#ec8051; font-size:14px; font-weight:bold; width:30px }
    .WebDown .notshow{ position:absolute; bottom:10px; right:10px}
</style>

<div class="WebDown" >
    <div class="tipbox">

        <span class="laba"></span>
        <div class="tiptext">
            <h3>目前由你配商城各车系商品数量：</h3>
        </div>
        <div style="clear:both"></div>
        <ul>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/qr.jpg' ?>" width="30px" height="30px"><span>共有奇瑞系列商品 <b>6018</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/dz.jpg' ?>" width="30px" height="30px"><span>共有上海大众系列商品 <b>3245</b> 个</span></li>

            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/bk.jpg' ?>" width="30px" height="30px"><span>共有进口别克系列商品 <b>127</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/rc.jpg' ?>" width="30px" height="30px"><span>共有东风日产系列商品 <b>2900</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/rc.jpg' ?>" width="30px" height="30px"><span>共有郑州日产系列商品 <b>190</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/rc.jpg' ?>" width="30px" height="30px"><span>共有进口日产系列商品 <b>279</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/xtl.jpg' ?>" width="30px" height="30px"><span>共有东风雪铁龙系列商品 <b>1929</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/bz.jpg' ?>" width="30px" height="30px"><span>共有东风标致系列商品 <b>774</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/rw.jpg' ?>" width="30px" height="30px"><span>共有上汽荣威系列商品 <b>1929</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/MG.jpg' ?>" width="30px" height="30px"><span>共有上汽MG系列商品 <b>1364</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/hczh.jpg' ?>" width="30px" height="30px"><span>共有华晨中华系列商品 <b>4238</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/mzd.jpg' ?>" width="30px" height="30px"><span>共有长安马自达系列商品 <b>367</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/mzd.jpg' ?>" width="30px" height="30px"><span>共一汽马自达此系列商品 <b>885</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/mzd.jpg' ?>" width="30px" height="30px"><span>共有进口马自达系列商品 <b>50</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/hm.jpg' ?>" width="30px" height="30px"><span>共有海马汽车系列商品 <b>2380</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/skd.jpg' ?>" width="30px" height="30px"><span>共有上海大众斯柯达系列商品 <b>209</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/bk.jpg' ?>" width="30px" height="30px"><span>共有上海通用别克系列商品 <b>11254</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/kdlk.jpg' ?>" width="30px" height="30px"><span>共有上海通用凯迪拉克系列商品 <b>24</b> 个</span></li>
            <li><img src="<?php echo Yii::app()->theme->baseUrl . '/images/carlogo/xfl.jpg' ?>" width="30px" height="30px"><span>共有上海通用雪佛兰系列商品 <b>5664</b> 个</span></li>

            <div style="clear:both"></div>

        </ul>

        <h1 style="px">商品数据正在不断更新中......</h1>
<!--        <p class="notshow"><input type="checkbox" id="NotShow"  style=" vertical-align: middle"  /><label for="NotShow">以后不再显示</label></p>-->
        <div class="Close"></div>
    </div>
</div>
<script type="text/javascript">
    
    $(function(){
        var width=(window.screen.width-776)/2;
     
        $(window).resize(function() {
          width=($('body').width()-776)/2;
          $('.WebDown').css({'left':width});
        });
        $('.WebDown').css({'left':width});
        $('.WebDown .Close').click(function(){
            $('.WebDown').fadeOut(300);
            ajaxLoadEnd();
            if($("#NotShow").attr("checked")){
                setCookie("Browse","idea",10000);
            }
        });
	
	
        var Sys = {};
        var ua = navigator.userAgent.toLowerCase();
        var s;
        (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
            (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
            (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
            (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
            (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
        if(getCookie("Browse")=="idea"){
            $('.WebDown').hide();
            ajaxLoadEnd();
        }else{
            if(s){
                //$('.WebDown').fadeIn(200);
                $('.WebDown').show();
            }
        }

    });

    function getCookie( name ){
        var first='<?php echo $firstintomall; ?>'
        if(first==0)
            return 'idea';
        var start = document.cookie.indexOf( name + "=" );
        var len = start + name.length + 1;
        if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {
            return null;
        }
        if ( start == -1 ) return null;
        var end = document.cookie.indexOf( ';', len );
        if ( end == -1 ) end = document.cookie.length;
        return unescape( document.cookie.substring( len, end ) );
    }
 
    function setCookie( name, value, expires, path, domain, secure ) {
        var today = new Date();
        today.setTime( today.getTime() );
        if ( expires ) {
            expires = expires * 1000 * 60*60*24;
        }
        var expires_date = new Date( today.getTime() + (expires) );
        document.cookie = name+'='+escape( value ) +
            ( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()
        ( ( path ) ? ';path=' + path : '' ) +
            ( ( domain ) ? ';domain=' + domain : '' ) +
            ( ( secure ) ? ';secure' : '' );
    }
</script>	
