<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/newhome/com.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/newhome/top.css"/>
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/newhome/style.js' ?>"></script>
<?php
$controller = Yii::app()->controller->id;
?>
<?php $this->widget('widgets.papmall.PrivateChat'); ?>
<div class="site-nav" >
    <div class="site-nav-info">
        <a href="<?php echo Yii::app()->createUrl('pap/sellerorder/index'); ?>" title="由你配"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/logo.jpg" class="float_l"></a>
        <?php if (in_array($controller, array('remind', 'servicequestion'))): ?>
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/xxzx.png" class="float_l logo-xxxz" />
            <?php endif; ?>
        <div class="head-customer float_l">
            <div class="name-customer">
                您好,<?php echo Yii::app()->user->name ?> 
                <div class="name-customer-info">
                    <ul>
                        <?php
                            if (!empty($permenu) && is_array($permenu)):
                                foreach ($permenu as $key => $val):
                                    foreach ($val['children'] as $k => $v):
                                        ?>
                                        <li><a href="<?php echo !empty($v['url'])? Yii::app()->createUrl($v['url']):'javascript:void(0)' ?>"><?php echo $v['name'] ?></a></li>
                                        <?php
                                    endforeach;
                                endforeach;
                            endif;
                            ?>
                        <li class="layout">
                            <?php echo CHtml::link('退出登录', Yii::app()->createUrl('/user/logout')) ?>
                        </li>             
                    </ul>
                </div>
            </div>
           
        </div>
        <div class="float_l" style="margin-top:23px; color:#999">|</div>
                <div  class="float_l">
                    <ul>
                        
                 <li class="xiaoxi" >
                    <?php $this->widget('widgets.papmall.TopNews'); ?>
                </li>
                </ul>
                </div>
                
        <div class="head-help float_r" style="width:319px">
            <!--                <div class="head-gwc float_l">
                                <div class="wenz2 float_l">我的购物车</div>
                                <a href="<?php echo Yii::app()->createUrl('pap/buyorder/cart') ?>" target="_blank"> 
                                    <div class="head-gwc-info  float_l">
                                        <span class="amount" style="color:#fff">0</span>
                                    </div>
                                </a>
                            </div>-->
            <ul class="float_l">
               
                <?php if(Yii::app()->user->isServicer()):?>
                <li class="newpeople">
                     <a href="<?php echo Yii::app()->createUrl('servicer/default/newer/goto/newerindex') ?>" target='_blank'>新手指引</a>
                     <span style="color:#0164c1">|</span>
                </li>
                <?php endif;?>
                <!--帮助中心 组件-->
                <li class="helpcenter">
                  <?php $this->widget('widgets.papmall.MHelpcenter')?>
                </li>
                <!--在线客服 组件-->
                 <li class="helpcontact">
                    <div class="helpcontact"><a href="<?php echo Yii::app()->createUrl('helpcenter/home/index') ?>" target="_blank">在线客服</a></div>
                  <?php $this->widget('widgets.papmall.MPhoneCall')?>
                </li>
            </ul>
            <div class="float_r"> <img src="<?php echo F::themeUrl() . '/images/shophome/tel.png' ?>" class="tel-img"/></div>     
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
  <?php if (in_array($controller, array('remind', 'servicequestion','customer'))): ?>
 <div class="xian"></div>      
<?php endif; ?>
<?php if (Yii::app()->user->isServicer()) : ?>
    <script>
        function getCartCount() {
            $.getJSON("<?php echo Yii::app()->createUrl("mall/buy/getcount") ?>", function(data) {
                $(".cartcount").text(data);
            });
        }
    </script>
<?php endif; ?>
<script>
    function Remindevent()
    {
        var business = Number($("#businessRemind").val());
        var system = Number($("#systemRemind").val());
        var url = Yii_baseUrl + "/pap/remind/getremind";
        $.getJSON(url, function(res) {
            //业务提醒
            if (business < res.business) {
                $.messager.lays(300, 150);
                $.messager.anim('fade', 1000);
                $.messager.show("新消息", "<a href=" + Yii_baseUrl + '/pap/remind/index' + ">您有新的业务提醒！</a>", 3000);
                $("#RemindColumn").html("您有新的业务提醒！");
                $("#RemindColumn").attr('key', '1');
                shake($("#RemindColumn"), "red", 10);
                businessRemind();

                //播放声音                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                $('#audiodemo').jPlayer("play");
            }
            $("#businessRemind").val(res.business);

            //系统提醒
            if (system < res.system) {
                $.messager.lays(300, 150);
                $.messager.anim('fade', 1000);
                $.messager.show("新消息", "<a href=" + Yii_baseUrl + '/pap/remind/index' + ">您有新的系统提醒！</a>", 3000);
                $("#RemindColumn").html("您有新的系统提醒！");
                $("#RemindColumn").attr('key', '2');
                shake($("#RemindColumn"), "red", 10);
                systemRemind();

                //播放声音                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                $('#audiodemo').jPlayer("play");
            }
            $("#systemRemind").val(res.system);
        });
        // wshake();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
    }

    //遮盖
    function ajaxLoading() {
        var height = $("body").height();
        $("<div class=\"datagrid-mask\"></div>").css({display: "block", width: "100%", height: height}).appendTo(".wrapper");
    }

    function wshake() {
        shake($("#call_id"), "red", 10);
    }
    function shake(ele, cls, times) {
        var i = 0, t = false, o = ele.attr("class") + " ", c = "", times = times || 2;
        if (t)
            return;
        t = setInterval(function() {
            i++;
            c = i % 2 ? o + cls : o;
            ele.attr("class", c);
            if (i === 2 * times) {
                clearInterval(t);
                ele.removeClass(cls);
            }
        }, 200);
    }
</script>