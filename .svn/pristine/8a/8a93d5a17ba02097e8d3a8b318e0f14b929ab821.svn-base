<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/goodslist.css"/>
<style>
    .content_info{ margin:0px}
    .content2{ margin-left:10px; width:780px; float: left}
    .content2d{width:auto}
    .pp_info, .sx_jg ul{ width:640px}
    .dom-display{ width:635px}
    .tab-bd-con ul {width:auto}
    .content2b{margin-top:0px}
    .zwq_info{ width:380px}
    .zwq_price{ width:180px}
    .zwq_OE{ margin-left:65px; width:150px}

    .pager{ float:right;clear:both}
    .pager li a,.pager .goto a{ font-family: "微软雅黑"; padding: 2px 6px; border:1px solid #eee;}
    .pager span.goto{ font-family: "微软雅黑";}
    .pager li a {display:block;}
    .pager li a:hover{border:1px solid #ff6600}
    .pager li.selected a{ color:#ff6600; font-weight: bold}
    .pager .goto{float: none}
    .pager .input{margin:0; width:30px;height:22px;}
    .fenye{margin:2px 5px}
    .top_fenye ul li{ margin-top:0}
    .top_fenye ul li a{ padding: 2px 6px}
    .content2d #yw1 ul li{ float:left; width:auto}

    .content2d li {
        float: left;
        margin: 0 7px;
        width: 235px;
    }
    .content2d .items li{
        width:770px;border-bottom: 1px solid #D6D4D5;margin-bottom:5px;
    }
    .content2d #yw1 ul li{ float:left; width:auto}
    #make-car-m {border:2px solid #f2b303; }
    #make-car-m {border:2px solid #f2b303;left:622px!important;top:107px!important; }
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
    .sp,.hp{ display:block; height:35px; float:left; width:31px; border-left:1px solid #ccc; border-right:1px solid #ccc}
    .sp{ border-left:none}
    .sp_xianshi{ width:100px; float:left; margin-left:30px}
    .m-top5{ margin-top:5px}
    .huoli a:hover{text-decoration: underline; color:#F3720A}
    .huoli a{color:#0363B9}
    /*    .yjlm_zhankai{background: url("<?php //echo F::themeUrl()                                                                     ?>/images/papmall/tubiao2.png") no-repeat scroll -30px -129px #f0f0f0;
                      border: 1px solid #f0f0f0;color: #444;}*/
</style>
<?php
$reget = $get;
$keyword = $get['keyword'];
if (!empty($keyword) && strstr($keyword, '<<q>>')) {
    $get['keyword'] = $keyword = str_replace('<<q>>', '/', $keyword);
}
$get['keyword'] = $keyword = htmlspecialchars($keyword);
$skwd = $_GET['skwd'];
if (!empty($skwd) && strstr($skwd, '<<q>>')) {
    $skwd = str_replace('<<q>>', '/', $skwd);
}
?>
<div class="wrap-contents"  style="border:1px solid #ccc; background:#fff; width:990px; padding: 5px; margin-top:5px">
    <div style="border:1px solid #F7B652;background-color: #FFEFE0;height:30px; margin:10px  0;line-height: 30px">
        <div style="text-indent: 1em;">
            当前位置：查询结果
            <span style="float: right; margin-right: 20px;*margin-top:-30px"><a href="<?php echo Yii::app()->createUrl('pap/home/index') ?>">返回</a></span>
        </div>

    </div>
    <div class="content1 float_l" >
        <!--子类和标准名称开始-->
        <?php $this->renderPartial('subsearch', array('m' => $m, 'get' => $reget)) ?>
        <!--子类和标准名称结束-->

        <!--一周销量排行开始-->
        <?php //$this->renderPartial('weeksales', array('weekSales' => $weekSales)); ?>
        <!--一周销量排行结束-->
    </div>

    <div class="content2" id="defaults" target="search" style="<?php echo $wid; ?>">
        <!-- 你要找的是不是-->
        <?php if (!empty($huoqq)): ?>
            <div class="more-div" style="border: 1px solid #F7B652;margin-bottom: 10px; position: relative; overflow: hidden">
                <div style="float:left;width:110px;margin:10px 0 0 10px;">
                    <span style="font-weight:bolder;color:#4C4B47">您要找的是不是：</span>
                </div>
                <div style="float:left;width: 600px;margin:8px 0 0 10px;">
                    <ul>
                        <?php
                        foreach ($huoqq as $key => $vlaue):
                            ?>
                            <?php //if (in_array($key, array(0, 1, 2, 3, 4, 5))): ?> 
                            <li style="float:left;margin:4px 15px;white-space: nowrap;" class="huoli">
                                <a href="javascript:void(0)" onclick="huoqq('<?php echo $vlaue['title'] ?>')"><?php echo $vlaue['titles'] ?></a>
                            </li>
                            <?php //endif; ?>

                        <?php endforeach; ?>
                    </ul>
                </div>
                <a href="javascript:;" style="position:absolute; right:5px; top:5px; color:#f28422;display:none"  class="more2">更多</a>
            </div>
        <?php endif; ?>
        <div class="clear"></div>
        <div class="content2_info"> 
            <!--content2a结束-->
            <!--搜索条件开始-->
            <?php $this->renderPartial('goodssx', array('params' => $params, 'get' => $get, 'choose' => $choose, 'brand' => $brand,
                'price' => $price, 'type' => 2, 'makecar' => $makecar, 'dealer' => $dealer));
            ?>
            <!--搜索条件结束-->
            <!--content2b结束-->
            <div class="content2c">
                <div class="content2c1">
                    <div class="float_l paixu" >
                        <span class="float_l" id="order_by" order="<?php echo $order[0] ?>" style="color:#F3720A">综合排序：</span>
                        <ul class="float_l">
                            <?php
                            if (is_array($order['name'])):
                                foreach ($order['name'] as $k => $v):
                                    $od = $get;
                                    unset($od['order']);
                                    if ($order['order'][$k])
                                        $od['order'] = $order['order'][$k];
                                    ?>
                                    <li class='<?php echo $order['class'][$k] ?>'>
                                        <a href="<?php echo Yii::app()->createUrl('pap/mall/search', $od); ?>">
                                    <?php echo $v ?></a></li>
                                <?php endforeach; ?>
                        <?php endif; ?>
                        </ul>
                        <?php
                        if ($get['keyword'] && strpos($get['keyword'], '/') !== false) {
                            $get['keyword']=  str_replace('/', '<<q>>', $get['keyword']);
                        }
                        $ispro = $get;
                        if ($ispro['ispro'] == 1) {
                            unset($ispro['ispro']);
                        } else {
                            $ispro['ispro'] = 1;
                        }
                        ?>
                        &nbsp;
                        <input onclick="window.location.href = '<?php echo Yii::app()->createUrl('pap/mall/search', $ispro); ?>'" type="checkbox" name="ispro" <?php echo $get['ispro'] == 1 ? 'checked' : ''; ?>/>
                        &nbsp;促销
                    </div>

                    <div class="sp_xianshi">
                        <?php $url = Yii::app()->request->getUrl(); ?>
                        <a href="<?php
                        if (strstr($url, "type/list")) {
                            echo "#";
                        } else if (strstr($url, "type/grid")) {
                            echo str_replace("grid", "list", $url);
                        } else {
                            echo $url . "/type/list";
                        }
                        ?>"  class="hp <?php echo $displayType == "list" ? "hp_current" : '' ?>"></a>
                        <a href="<?php
                        if (strstr($url, "type/grid")) {
                            echo "#";
                        } else if (strstr($url, "type/list")) {
                            echo str_replace("list", "grid", $url);
                        } else {
                            echo $url . "/type/grid";
                        }
                        ?>"  class="sp <?php echo $displayType != "list" ? "sp_current" : '' ?>"  ></a>

                    </div>

                    <div class="fenye float_r">
                        <?php
                        $this->widget('widgets.default.WShortPager', array(
                            'pages' => $pages,
                        ))
                        ?>
                    </div>

                </div>
                <!--                <div class="content2c2">
                                    <div class="float_l" style="margin-left:20px">
                                        <span class="float_l">结果中搜索：</span>
                                        <input  type="text" class="input float_l" id="goodskey" value="<?php echo ($keyword || $skwd) ? ($skwd ? $skwd : $keyword) : '名称|编号|拼音|配件品类|OE号|品牌'; ?>"/>
                                        <button class="button2" id="goodssearch" class="float_l">搜索</button>
                                    </div>
                                    <div class="float_r sp_xianshi">
                <?php $url = Yii::app()->request->getUrl(); ?>
                                        <ul>
                                            <li><a href="<?php
                if (strstr($url, "type/list")) {
                    echo "#";
                } else if (strstr($url, "type/grid")) {
                    echo str_replace("grid", "list", $url);
                } else {
                    echo $url . "/type/list";
                }
                ?>"  class="hp <?php echo $displayType == "list" ? "hp_current" : '' ?>"></a></li>
                                            <li><a href="<?php
                if (strstr($url, "type/grid")) {
                    echo "#";
                } else if (strstr($url, "type/list")) {
                    echo str_replace("list", "grid", $url);
                } else {
                    echo $url . "/type/grid";
                }
                ?>"  class="sp <?php echo $displayType != "list" ? "sp_current" : '' ?>"  ></a></li>
                                        </ul>
                                    </div>
                                </div>-->
            </div>
            <!--content2c结束-->
            <div class="content2d" >
<?php //if (!empty($dataProvider['data']) && is_array($dataProvider['data'])):      ?>
                <div class="zwq_splb">

                    <ul class="splist_ul">
                        <?php
                        if ($displayType == "list") {
                            $itemView = "goods_list";
                        } else {
                            $itemView = "goods_grid";
                            echo "<style> 
                            .content2d .items li{width:230px;border:1px solid #e8e8e8;}
                            .content2d .items li:hover{border:1px solid #ff5500;}
                               </style>";
                        }
                        $this->widget('widgets.default.WListView', array(
                            'dataProvider' => $dataProvider,
                            'itemView' => $itemView, // refers to the partial view named '_post'
                            'summaryText' => '',
                            'emptyText' => '
                              <style> .footer{position:absolute}</style>
                                        <div class="nogoods_text" style="height:200px;margin:0 auto;">
                                            <div style=" padding-top: 65px;margin:0 auto; width: 50%">
                                            <div><img src="' . Yii::app()->theme->baseUrl . '/images/images/nogoods.jpg" style="float: left;display: block"/><b><span style=" color:#FF6500;float:left;display: block; font-size: 18px;margin:8px 0 0 15px">非常抱歉,商品持续更新中!</span></b><div style="clear:both"></div></div>
                                                <div style="margin:20px 0 0 20px; *margin-top:-50px">
                                                    <b><p><span style="color:#353535; font-size: 15px;font-family: \'微软雅黑\'">您可以：</span><span style="color:#676767;font-size: 15px; font-family: \'微软雅黑\'"><a href="javascript:void(0)"><span class="contat"  style="color:#FF6500">在线QQ联系客服</span></a>或<a href="' . Yii::app()->createUrl('/helpcenter/home/addquestion3') . '" target="_blank"  style="color:#FF6500">提交问题</a></span></p></b>
                                                </div>
                                            </div>
                                        </div>'
                        ))
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<?php
$keyword = htmlspecialchars_decode($keyword);
$preg = "</script>";
$keyword = str_replace($preg, "<\/script>", $keyword);
$keyword = str_replace("\"", '\"', $keyword);
$keyword = str_replace("</body>", "<\/body>", $keyword);
?>
<script type="text/javascript">
    //你要找的是不是  点击查询
    function huoqq(key) {
        var carmodel = $('#veh').text().replace(/^\s+|\s+$/g, "");
        if (carmodel != '更换车型') {
            alert('请先选择适用车型');
            return false;
        }
        var data = {};
        if ((key != '请输入关键字|拼音搜索' && key != '请输入商品编号搜索' && key != '请输入OE号搜索') && key != '')
        {
            data.keyword = key;
            data.keyword = data.keyword.replace(/\//g, "<<q>>");
            data.keyword = encodeURIComponent(data.keyword);
            data.seatype = $('.sousuo').find('.active').attr('key');
            if (data.seatype == 0) {
                data.seatype = '关键字';
            } else if (data.seatype == 1) {
                data.seatype = '商品编号';
            }
            else if (data.seatype == 2) {
                data.seatype = 'OE号';
            }
        }
        var url = Yii_baseUrl + '/pap/mall/search';
        //        console.log(data);return false;
        $.each(data, function(k, v) {
            if (v != '') {
                url += '/' + k + '/' + v;
            }
        })
        if ($('#default').attr('target') == 'search') {
            window.open(url, '_self');
        }
        else {
            window.open(url, "_blank");
        }
        //        location.href = url;
    }
    $(function() {
        $('input[name=search_keyword]').val("<?php echo $keyword ?>");
        if ($('input[name=search_keyword]').val() == '')
            $('input[name=search_keyword]').val('请输入关键字|拼音搜索');
        //适用车系赋值
        $('#jpmall_make').val("<?php echo $get['make']; ?>");
        $('#jpmall_series').val("<?php echo $get['series']; ?>");
        $('#jpmall_year').val("<?php echo $get['year']; ?>");
        $('#jpmall_model').val("<?php echo $get['model']; ?>");
        //商品搜索
        $('#goodssearch').click(function() {
            var data = {};
            data.keyword = "<?php echo $keyword ?>";
            data.sub = '<?php echo $get['sub'] ?>';
            data.code = '<?php echo $get['code'] ?>';
            if ($.trim($('#goodskey').val()) != '请输入关键字|拼音搜索')
            {
                data.skwd = $('#goodskey').val();
                // data.skwd = encodeURIComponent($('#goodskey').val());
                data.skwd = data.skwd.replace(/\//g, "<<q>>");
                data.skwd = encodeURIComponent(data.skwd);
            }

            data.price = '<?php echo $get['price'] ?>';
            data.brand = '<?php echo $get['brand'] ?>';
            data.type = '<?php echo $get['type'] ?>';
            data.order = '<?php echo $get['order'] ?>';
            data.ispro = '<?php echo $get['ispro'] ?>';
            data.partslevel = '<?php echo $get['partslevel'] ?>';
            var url = Yii_baseUrl + '/pap/mall/search';
            var num = 0;
            $.each(data, function(k, v) {
                if (v != '') {
                    url += '/' + k + '/' + v;
                }

            })
            location.href = url;
        })

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

        //一周收货
        $(".rank li").mouseover(function() {
            $(this).children("div.rank_img").css("display", "block");
            $(this).children("div.rank_price").css("display", "block");
            $(this).children("div.rank_name").addClass("rank_name_current").removeClass("rank_name");
            $(this).siblings().children("div.rank_img").css("display", "none");
            $(this).siblings().children("div.rank_price").css("display", "none");
            $(this).siblings().children("div.rank_name_current").addClass("rank_name").removeClass("rank_name_current");
        });
    })

</script>
<script type="text/javascript">

    $(document).ready(function() {

        $(".more2").live('click', function() {
            $(this).parents(".more-div").css("height", "auto");
            $(this).html("收起").addClass("shouqi2").removeClass("more2");
        })
        $(".shouqi2").live('click', function() {
            $(this).parents(".more-div").css("height", "50px");
            $(this).html("更多").addClass("more2").removeClass("shouqi2");
        })



        //        $("#make-select").click(function(e){  
        //            //判断是否为默认点击厂家
        //            maketarget = true;
        //            //判断是否为默认点击车系
        //            sericesarget = true;
        //            //判断是否为默认点击年款
        //            yeartarget = true;
        //            e.stopPropagation();
        //            var offset = $(this).offset();
        //            var left, top,url,data;
        //            //            left = offset.left -210+ 'px';
        //            //            top = offset.top +26 + 'px';
        //
        //            var width = $(window).width();
        //            //屏幕宽度大于1000
        //            if( width> 1000){
        //                var cutwidth =  (width - 1000)/2;
        //            }else{
        //                cutwidth = 0;
        //            }
        //            left = (offset.left -cutwidth) + 'px';
        //            top = (offset.top +26)-57 + 'px';
        //            $("#make-car-m").css({ 'left':left, 'top':top }).show().removeClass('selectDiv2').removeClass('selectDiv3').addClass('selectDiv');
        //            $("#selectBig").hide();
        //            clearVechileSelect();   
        //            $("#ul-makes li:eq(1)").click();
        //            $('#fit_span').html('');
        //        });
        //            
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

    $('#goodskey').click(function() {
        if ($(this).val() == '名称|编号|拼音|配件品类|OE号|品牌') {
            $(this).val('');
        }
    });

    $('#goodskey').blur(function() {
        if ($(this).val() == '') {
            $(this).val('名称|编号|拼音|配件品类|OE号|品牌');
        }
    });

//    $('.show-detail').click(function() {
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
    //你要找的是不是
    var morehei = $('.more-div').height();
    if (morehei > 55) {
        $('.more-div').css({height: '50px'});
        $('.more2').show();
    } else {
        $('.more2').hide();
    }
    $('.contat').click(function() {
//        $(".helpcontact_d").css("display", "block");
        var url = $('.helpcontact_d ul li:eq(0) a').attr('href');
        if (url != '') {
            window.open(url, "_blank");
        }
//        $("div.helpcontact").css("background-color", "#fff");
//        $("div.helpcontact").css("border", "1px solid #ccc");
//        $("div.helpcontact").css("border-bottom", "none");
    })
</script>
