<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/goodslist.css" />
<style>
    /*    .zwq_splb{ width:765px; font-size:12px; color:#696969}
        .zwq_splb ul li{ width:765px; height:116px; border-bottom:1px solid #f0f0f0; list-style:none;margin-bottom:10px}
        .zwq_img{ width:80px; height:80px; margin:5px; overflow:hidden}
        .zwq_info{ width:320px}
        .zwq_price{width:120px; margin-left:10px; margin-right:5px; text-align:center}
        .zwq_OE{ width:120px; margin-left:10px}
        .zwq_name a{ } 
        .zwq_color{ font-size:14px; color:#fb540e; font-weight:bold;}
        .zwq_top{ margin-top:10px}
        .zwq_buttton{ margin-right:10px} 
        #yw1 .zwq_name a{font-size:14px; font-weight:bold}*/
</style>
<div class="wrap-contents"  id="defaults" target="search" style="border:1px solid #ccc; background:#fff; width:990px; padding:5px">
    <div class="content1 float_l">
        <!--子类和标准名称开始-->
        <?php $this->renderPartial('subparts', array('m' => $m, 'sub' => $get['sub'], 'code' => $get['code'])); ?>
        <!--子类和标准名称结束-->

        <!--一周销量排行开始-->
        <?php //$this->renderPartial('weeksales', array('weekSales' => $weekSales)); ?>
        <!--一周销量排行结束-->
    </div>

    <div class="content2 float_l" style='width:780px'>
        <div class="content2_info">
            <!--促销活动开始-->
            <?php //$this->renderPartial('promotion', array('isprogoods' => $isprogoods)); ?>
            <!--促销活动结束-->

            <!--商品筛选开始-->
            <?php $this->renderPartial('goodssx', array('params' => $params, 'get' => $get, 'choose' => $choose, 'brand' => $brand, 'price' => $price, 'type' => 1, 'makecar' => $makecar,'dealer'=>$dealer)); ?>
            <!--商品筛选结束-->

            <!--商品-->
            <?php echo $this->renderPartial('list', array('get' => $get, 'order' => $order, 'dataProvider' => $dataProvider, 'pages' => $pages, 'displayType' => $displayType)); ?>   
            <!--结束-->
        </div>
    </div> 
</div>
<div style="clear:both;height: 0"></div>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/pap/lanrenzhijia.js"></script>
<script type="text/javascript">
    $("#make-select").click(function(e) {
        //判断是否为默认点击厂家
        maketarget = true;
        //判断是否为默认点击车系
        sericesarget = true;
        //判断是否为默认点击年款
        yeartarget = true;
        e.stopPropagation();
        var offset = $(this).offset();
        var left, top, url, data;
        //            left = offset.left -210+ 'px';
        //            top = offset.top +26 + 'px';

        var width = $(window).width();
        //屏幕宽度大于1000
        if (width > 1000) {
            var cutwidth = (width - 1000) / 2;
        } else {
            cutwidth = 0;
        }
        left = (offset.left - cutwidth) + 'px';
        top = (offset.top + 26) + 'px';
        $("#make-car-m").css({'left': left, 'top': top}).show().removeClass('selectDiv2').removeClass('selectDiv3').addClass('selectDiv');
        $("#selectBig").hide();
        clearVechileSelect();
        $("#ul-makes li:eq(1)").click();
        $('#fit_span').html('');
    });



    /*var img = document.getElementById("img");
    var num = document.getElementById("num");
    var ali = img.getElementsByTagName("li");
    var oli = num.getElementsByTagName("li");
    var time = null
    //lanrenzhijiaing = document.getElementById("lanrenzhijia");
    img.style.width = ali.length * 585 + "px", inow = 0;
    for (var i = 0; i < oli.length; i++) {
        oli[i].index = i
        oli[i].onmouseover = function() {
            inow = this.index;
            tab();
            window.clearInterval(time)
        }
        oli[i].onmouseout = function() {
            time = window.setInterval(autoPlay, 2000)
        }
    }

    function tab() {
        for (var i = 0; i < oli.length; i++) {
            oli[i].className = ""
        }
        oli[inow].className = "hover"
        startMove(img, {
            left: -inow * 585
        }, 'buffer')
    }

    function autoPlay() {
        inow++;
        if (inow >= ali.length) {
            inow = 0
        }
        tab();
    }
    time = window.setInterval(autoPlay, 2000)*/

    $(document).ready(function() {
        //选择子类
        $(".content1a_info p").click(function() {
            if ($(this).attr('class') == 'yjlm') {
                $(this).addClass("yjlm_current").removeClass('yjlm');
                $(this).next("div.ejlm").show();
                $(this).parents('.content1a_info').nextAll().find('p').addClass("yjlm").removeClass('yjlm_current');
                $(this).parents('.content1a_info').prevAll().find('p').addClass("yjlm").removeClass('yjlm_current');
                $(this).parents('.content1a_info').nextAll().find('div.ejlm').hide();
                $(this).parents('.content1a_info').prevAll().find('div.ejlm').hide();
            }
        });

        //一周收货
        $(".rank li").mouseover(function() {
            $(this).children("div.rank_img").css("display", "block");
            $(this).children("div.rank_price").css("display", "block");
            $(this).children("div.rank_name").addClass("rank_name_current").removeClass("rank_name");
            $(this).siblings().children("div.rank_img").css("display", "none");
            $(this).siblings().children("div.rank_price").css("display", "none");
            $(this).siblings().children("div.rank_name_current").addClass("rank_name").removeClass("rank_name_current");
        });

        //商品筛选
        $(".more").click(function() {
            $(".pp_info").toggle();
            $(".zm_sx").toggle();
            $(this).toggleClass("shouqi");
            if ($(this).text() === '更多') {
                $(this).text('收起');
            } else {
                $(this).text('更多');
            }

            //$(this).toggleClass("shouqi");
        });

        $(".pp_info ul li a").click(function() {
            $("div.sx_pp").css("display", "none");
            $(".store_jg").css("display", "block")
        })

        $(".tab-hd span:first").addClass("current");
        $("#layout-t .tab-bd-con:gt(0)").hide();
        $(".tab-hd span").mouseover(function() {//mouseover 改为 click 将变成点击后才显示，mouseover是滑过就显示
            $(this).addClass("current").siblings("span").removeClass("current");
            $("#layout-t .tab-bd-con:eq(" + $(this).index() + ")").show().siblings(".tab-bd-con").hide().addClass("current");
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        //添加到购物车
        $(".addgwc").bind({
            'click': function() {
                var goodsID = $(this).attr('goodsid');
                // alert(goodsID);return false;
                var quant = $("#qty_item").val();
                issale(goodsID);
                addGoodsToCar(goodsID, quant);
            }
        })
    })

    function addGoodsToCar(goodsid, quant) {
        $.getJSON("<?php echo Yii::app()->createUrl('pap/mall/addgoodstocar') ?>",
                {goodsid: goodsid, quant: quant},
        function(data) {
            //getCartCount();
            if (data) {
                alert('添加成功！');
                getCartCount();
            }
        });
    }

// $('.show-detail').click(function() {
//        var goodsID = $(this).attr('goodsid');
////          $.getJSON(Yii_baseUrl+'/pap/mall/issale',
////                {goodsid: goodsID},
////        function(data) {
////            if (data) {
////               alert(data.message);
////               return false;
////            }else{
//                window.open(Yii_baseUrl + '/pap/mall/detail/goods/' + goodsID);
////            }
////        });
//        
//    })
//    $('.show-detail').click(function() {
//        var goodsID = $(this).attr('goodsid');
//        window.open(Yii_baseUrl + '/pap/mall/detail/goods/' + goodsID);
//    })
</script>
