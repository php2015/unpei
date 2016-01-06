<style>
    /*商城加载样式*/
    .ishow{ width:100%; margin:0 auto; position:fixed; bottom:0px; min-width:1000px; z-index:5;background:#666; max-height:102px}
    .bdimg img{ width: 15px;height:15px}
    .ie7{ width:100%; margin:0 auto; height:50px; line-height:50px; min-width:1000px;background:#666; border-top:2px solid #fff}
    .ie7-info{ width:1000px;background:#666;  text-align:center;font-size:12px;height:50px;line-height:50px;margin:0 auto;}
    .ie7 span{ color:#fff; margin-left:10px}
    .updateie{ height:35px; line-height:35px; width:130px; background:url(<?php echo F::themeUrl() . '/images/ie7.png' ?>) 0px -35px; margin-top:5px; display:inline-block}
    .updateie:hover{ background-position:0px 1px}
    .updateies{ height:35px; line-height:35px; width:130px; background:url(<?php echo F::themeUrl() . '/images/loadflash.png' ?>) 0px -35px; margin-top:5px; display:inline-block}
    .updateies:hover{ background-position:0px 1px}
    .ie7guanbi{ cursor:pointer}
    .ie7guanbi img{ padding:2px; border:1px solid #666}
    .ie7guanbi:hover img{ border:1px solid #ccc }


    .loadflash{ width:100%; margin:0 auto; height:50px; line-height:50px;min-width:1000px;background:#666; }
    .loadflash-info{ width:1000px;background:#666;  text-align:center;font-size:12px;height:50px;line-height:50px;margin:0 auto;}
    .loadflash span{ color:#fff; margin-left:10px}
    .loadflash{ cursor:pointer}
    .loadflash img{ padding:2px; border:1px solid #666}
    .loadflashguanbi:hover img{ border:1px solid #ccc }

</style>

<div style="clear:both"></div>
<div class="footer">
    <p class="footer_info">
        <?php
        $count = 0;
        $descendants = $this->getFootMenu();
        foreach ($descendants as $model) {
            $htmlOptions = array();
            if ($count++ == (count($descendants) - 1)) {
                $htmlOptions = array('class' => 'last');
            }
            // echo CHtml::link($model["name"],$model['url']);
            echo CHtml::link($model["name"], $model["url"] ? 'http://' . $model["url"] : 'javascript:void(0)', $htmlOptions);
            //echo CHtml::link($model["name"], $model["url"] ? Yii::app()->request->baseUrl . '/' . $model["url"] : '#', $htmlOptions);
        }
        ?>
        <br>
        北京嘉配科技有限公司版权所有 &copy; (2010-2014) 北京市海淀区善缘街1号1-629
        <br>
        热线电话:400 0909 839&nbsp;&nbsp;&nbsp;邮件：service@jiaparts.com&nbsp;&nbsp;&nbsp;京ICP备12015715号-3
        <span class="bdimg" >
        </span>
    </p>
</div>
<div class="ishow">
    <div class="loadflash"  style="display: none" >
        <div class="loadflash-info">
            <div class="float_l"><span>亲，您的浏览器可能没有安装或禁用了Flash Player，无法上传附件，您可以：</span></div>
            <a href="http://get.adobe.com/cn/flashplayer/"   target="_blank"class="updateies float_l"></a>

            <div class="float_l"><span> 或者 联系客服</span></div>
            <div class="float_l loadflashguanbi" style="margin-left:69px"><img src="<?php echo F::themeUrl() . '/images/ie7guanbi.png' ?>"  style="margin-top:15px"></div>
            <div style="clear:both"></div>
        </div>
    </div>

    <div class="ie7" style="display: none">
        <div class="ie7-info">
            <div class="float_l"><span>亲，您的浏览器版本过低导致图片打开速度过慢，提升打开速度您可以：</span></div>
            <a href="http://www.microsoft.com/zh-cn/download/internet-explorer-9-details.aspx"  target="_blank"class="updateie float_l"></a>

            <div class="float_l"><span> 或者 点击下载</span><img src="<?php echo F::themeUrl() . '/images/chrome.png' ?>" width="17" height="17"  style="vertical-align:middle; margin:0px 5px">
                <a href="http://w.x.baidu.com/alading/anquan_soft_down_b/14744"  target="_blank" style="text-decoration:underline;color:#fff">谷歌浏览器</a></div>

            <div class="float_l ie7guanbi" style="margin-left:69px"><img src="<?php echo F::themeUrl() . '/images/ie7guanbi.png' ?>"  style="margin-top:15px"></div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
<script src="<?php echo F::themeUrl() . '/js/jpd/ieal.js' ?>"></script>
<script>
    var Sys = {};
    var ua = navigator.userAgent.toLowerCase();
    var s;
    (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
            (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
            (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
            (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
            (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
    if (getCookie("Browse") == 'ie') {
        $('.ie7').hide()
    } else {
        $('body').iealert();
    }
    //点击关闭则不在xians
    $('.loadflashguanbi').live('click', function() {
        $('.loadflash').hide();
    })
    function getCookie(name) {
        var start = document.cookie.indexOf(name + "=");
        var len = start + name.length + 1;
        if ((!start) && (name != document.cookie.substring(0, name.length))) {
            return null;
        }
        if (start == -1)
            return null;
        var end = document.cookie.indexOf(';', len);
        if (end == -1)
            end = document.cookie.length;
        return unescape(document.cookie.substring(len, end));
    }

    function setCookie(name, value, expires, path, domain, secure) {
        var today = new Date();
        today.setTime(today.getTime());
        if (expires) {
            expires = expires * 1000 * 60 * 60 * 24;
        }
        var expires_date = new Date(today.getTime() + (expires));
        document.cookie = name + '=' + escape(value) +
                ((expires) ? ';expires=' + expires_date.toGMTString() : '') + //expires.toGMTString()
                ((path) ? ';path=' + path : '') +
                ((domain) ? ';domain=' + domain : '') +
                ((secure) ? ';secure' : '');
    }
</script>