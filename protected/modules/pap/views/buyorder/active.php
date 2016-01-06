<style type="text/css">
    /*html,body,h1,h2,h3,h4,h5,h6,span,a,div,ol,ul,li,dl,dt,dd,table,tbody,tfoot,thead,tr,th,td,input,textarea,form,input,select{margin:0;padding:0;font:14px/2em 'Microsoft Yahei',Arial,Verdana,Helvetica,sans-serif; list-style:none;}
    i,em{ font-style:normal}
    img{ display:inline-block; border:0px;}*/
    /*掉钱*/
    .png{ width:100%; height:363px; position:absolute; left:0px; top:-370px; z-index:98; overflow:hidden;}
    .x_p2{ width:100%; height:363px; position:absolute; left:0px; top:-370px; z-index:95; overflow:hidden;}
    /*掉钱结束*/

    /*抽奖后弹出层*/
    .x_mess{ width:100%; display:none; text-align:center; position:absolute;top:0px; left:0px;}
    .x_m_c{ width:960px; height:80px; margin:0px auto; line-height:80px; font-size:30px; color:#fff; text-align:left; text-indent:284px;}
    .x_m_c i{ color:#EEEB12; font-size:32px;}

    /*抽奖机会*/
    .x_mm{ width:960px; height:80px; line-height:80px; text-align:center; position:absolute; left:0px; top:0px;}
    .x_mm a{ font-size:30px; color:#fff;}
    .x_mm i{ font-size:30px; color:#EEEB12;}
    /*屏蔽层*/
    .pbi{ width:960px; height:420px; background:#fff; position:absolute; left:0px; top:80px;filter:alpha(opacity=0); display:none; *display:block; z-index:98; opacity:0;}
    /*抽奖按钮*/
    .x_quicky{ width:330px; height:330px; position:absolute; left:316px; top:111px;  z-index:99;}
    /*翻牌列*/
    .quickFlip{ position:relative; width:150px; height:200px; float:left; margin:5px 5px; z-index:2;}
    .blackPanel{ width:150px; height:200px; cursor:pointer;}
    .redPanel{ width:150px; height:200px;}
    .redPanel h6{ width:150px; height:60px; line-height:60px; text-align:center; color:#ff4647; font-size:40px; position:absolute; left:0px; top:56px;}
    .closed{ width: 960px; height: 40px; line-height: 40px; text-align: center; font-size: 14px;color: #fff; display:none;}
    .closed span{cursor:pointer}
    .closed a{ color:blue;cursor:pointer;text-decoration: underline}
</style>


<div class="x_cjbj" style=" width:100%; height:800px; position:absolute; top:100px; background:url(<?php echo F::themeUrl() . '/images/coupon/bjs.png' ?>) repeat;  overflow:hidden;z-index:102">
    <!--掉钱-->
    <div class="png">	
        <div style="width:950px; height:364px; margin:0px auto;"><img src="<?php echo F::themeUrl() . '/images/coupon/money.png' ?>" width="949px" height="363px" /></div>
    </div>
    <div class="x_p2">	
        <div style="width:1050px; height:364px; margin-left:100px;"><img src="<?php echo F::themeUrl() . '/images/coupon/money.png' ?>" width="949px" height="363px" /></div>
    </div>
    <!--掉钱结束-->    
    <!--抽奖后弹出层-->
    <div class="x_mess"><div class="x_m_c">恭喜您获得&nbsp;<i></i>&nbsp;元现金优惠劵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></div>
    <!--抽奖后弹出层结束-->
    <!--抽奖列表层-->
    <div style=" width:960px; height:420px; margin:0px auto; padding-top:80px; position:relative;">
        <!--立即抽奖提示、按钮-->
        <div class="x_mm"><a>亲，您获得了一次抽奖机会哦！</a></div>
        <!--屏蔽层-->
                <div class="pbi"></div>
        <div class="x_quicky">
            <img src="<?php echo F::themeUrl() . '/images/coupon/buttun.png' ?>" width="330px" height="330px" style="cursor:pointer;" />
        </div>
        <!--立即抽奖按钮结束-->    	
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div><div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="quickFlip">
            <div class="blackPanel">
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/back.png' ?>" width="150px" height="200px" /></p>
            </div>
            <div class="redPanel">
                <h6><span>0</span>元</h6>
                <p class="first quickFlipCta" style="width:100%; height:100%; margin:0px; padding:0px;"><img src="<?php echo F::themeUrl() . '/images/coupon/redface.png' ?>" width="150px" height="200px" /></p>
            </div>
        </div>
        <div class="closed">
            <span style="cursor: pointer">[关闭活动]</span>&nbsp;&nbsp;&nbsp;
            <span><a href="<?php echo Yii::app()->createUrl('/pap/mycoupon/index'); ?>" target="_blank">查看我的优惠券</a></span>
        </div>
    </div>
    <input  type="hidden" name="curval" value=''>
    <input   type="hidden" name="promoid" value='<?php echo $promoid ?>'>
    <input type="hidden" name="couponval">
    <!--抽奖列表层结束-->
</div>
<script src="<?php echo F::themeUrl() . '/js/jquery.quickflip.source.js' ?>"></script>
<script type="text/javascript">
    //加载遮盖层
    ajaxLoading();
    $('.pbi').show();
    $(function() {
        //翻牌
        $('.quickFlip').quickFlip();
        //获取高度
        var phei = $('.x_cjbj').height();
        $('.x_mess').height(phei);
        //点击翻牌
        $('.x_quicky').click(function() {
            $(this).hide();
            $('.x_mm').hide();
            $('.pbi').hide();
        });
        //前后台交互获取优惠券金额
        $('.quickFlip').click(function() {
            var promoid = $('input[name=promoid]').val();
            var url = Yii_baseUrl + '/pap/buyorder/lott';
            $.ajax({
                url: url,
                data: {'promoid': promoid},
                type: "POST",
                dataType: "json",
                success: function(data) {
                    $('.x_mess').show();
                    $('.pbi').show();
                    $('.end').show();
                    $('.redPanel').find('h6>span').text(data);
                    $('.x_m_c').find('i').html(data);
                    $('.closed').show();
                    $('input[name=couponval]').val(data);
                }
            });
        });
        //关闭活动
        $('.closed').find('span').eq(0).click(function() {
            $('.x_cjbj').remove();
            ajaxLoadEnd();
        });

        function fla() {
            $('.png').animate({'top': '700px', 'opacity': '0'}, 5000, function() {
                $('.png').css({'top': '-370px', 'opacity': '1'});
            })
//            $('.x_p2').animate({'top': '700px', 'opacity': '0'}, 4000, function() {
//                $('.x_p2').css({'top': '-370px', 'opacity': '1','z-inx':'80'});
//            })
        }
        setInterval(fla, 5000);
        var coupon=$('input[name=couponval]').val();
        if(coupon==''){
            '<?php unset(Yii::app()->session['first'])?>'
        }
    })
</script>