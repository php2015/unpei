<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/newer/productdel.css" />
<style>
    .spxq ,.sptj{text-indent:20px}
    .wrap-contents{overflow:visible}  
</style>
<div class="column">
    <?php
    $eval = EvaluateService::getevalgoods(array('GoodsID' => $GoodsID));
    $total = $eval[1] + $eval[2] + $eval[3];
    $goods_eval = !empty($total) ? sprintf('%0.1f', $eval[1] / $total * 100) : 0;
    $mids_eval = !empty($total) ? sprintf('%0.1f', $eval[2] / $total * 100) : 0;
    $bads_eval = !empty($total) ? sprintf('%0.1f', $eval[3] / $total * 100) : 0;
    $goods_rate = EvaluateService::getJdtCss($goods_eval);
    $mids_rate = EvaluateService::getJdtCss($mids_eval);
    $bad_rate = EvaluateService::getJdtCss($bads_eval);
    $sql = "SELECT ID FROM `pap_evaluation_goods_image` where GoodsID={$GoodsID} group by EvalID;";
    $res = Yii::app()->papdb->createCommand($sql)->queryAll();
    $pic_eval = count($res);
    ?>
    <div class="rating">
        <p class="rtitle">好评度</p>
        <span class="percent fl"><i><?php echo $goods_eval; ?></i>%</span>
        <div class="cla_percent fr">
            <div class="mt5"><div style="float:left">好评&nbsp;</div><i>(<?php echo $goods_eval; ?>%)</i><?php echo $goods_rate; ?></div>
            <div class="mt5"><div style="float:left">中评&nbsp;</div><i>(<?php echo $mids_eval; ?>%)</i><?php echo $mids_rate; ?></div>
            <div class="mt5"><div style="float:left">差评&nbsp;</div><i>(<?php echo $bads_eval; ?>%)</i><?php echo $bad_rate; ?></div>
        </div>
        <div style='clear:both'></div>
    </div>                               

    <div class="com_main">
        <ul class="subtab headtab" style=" border-bottom-width:1px;">
            <li class="proon click_eval"  key='all'>全部评价<i>(<?php echo $total; ?>)</i></li>
            <li class='click_eval' key='good'>好评<i>(<?php echo $eval[1]; ?>)</i></li>
            <li  class='click_eval'  key='medium'>中评<i>(<?php echo $eval[2]; ?>)</i></li>
            <li  class='click_eval' key='bad'>差评<i>(<?php echo $eval[3]; ?>)</i></li>
            <li  class='click_eval' key='pic'>有图片的评价<i>(<?php echo $pic_eval; ?>)</i></li>
            <div style="clear:both"></div>
        </ul>
        <div style="clear:both"></div>   
        <div class="cmain " style="margin-top:5px">
            <p class="cmtitle  eva-lists"><b class="c1">满意度</b><b class="c2">评价心得</b><b class="c3">购买信息</b><b class="c4">评论者</b></p>
            <ul class="eva-list"></ul>
            <div style="clear:both"></div> 
            <div class="pagelist text-c" id="evapageid">
                <span class="pageeva"><?php echo $page; ?></span>
                <span class="pagego">去第<input type="text" style="width:20px" value="" class="input" id="evapage">页
                    <span class="btn-tiny" id="gopage" style="cursor: pointer;">GO</span>
                </span>
            </div>
        </div>
        <div class="clear"></div>
        <form> 
            <input id="evastatus" type="hidden" value="all"/>
            <input id="evaempty" type="hidden" value="allcontent"/>
            <input id="evaorder" type="hidden" value="orderID"/>
            <input id="goodsid" type="hidden" value="<?php echo $GoodsID ?>"/>
            <input id="organid" type="hidden" value="<?php echo $OrganID ?>"/>
        </form>
    </div>
</div>

<!--商品评价-->
<script id="evaTemplate" type="text/x-jquery-tmpl">
    <li class="cmcontent" style="padding:0px; padding-bottom:12px; border-bottom:1px solid #dedede"><b class="c1">${Eval}</b>
    <b class="c2">
    <p style='text-indent:20px;word-break:break-all;overflow:hidden'>
    {{if BuyerToEvalRemark && BuyerToEvalRemark!='0'}}
    ${BuyerToEvalRemark}
    {{/if}}
    </p>
    <i>[${BCreateTime}]</i>
    {{if SellerToEvalRemark && BuyerToEvalRemark!='0'}}
    <div style='text-indent:20px;word-break:break-all;overflow:hidden'>
    <span style='color:red'>卖家回复：</span>
    <span style="display:inline;">
    ${SellerToEvalRemark}
    </span>
    </div>
    <i>[${UpdateTime}]</i>
    {{/if}}
    </b>
    <b class="c3">适用车型：${CarmodelText}</b>
    <b class="c4" style="z-index:${zindex}">
    <p class='pname'>${BuyerName}</p>
    <i class="ilevel">{{html Xylv}}</i>
    <div class="pdetail" buyerid=${BuyerID} >
    </div></b>
    {{if Picture}}
    <div class="photo">
    {{each(i,pic) Picture}}
    <a><img src="<?php echo F::uploadUrl() ?>${pic.ImageUrl}" /></a>
    {{/each}}
    </div>
    {{/if}}
    </li>
</script>
<!--评论js-->
<script>
    $(document).ready(function() {
        //评价显示
        $('#comm_show').click(function() {
            show('all');
        });

        var intcategory;
        /*卖家信息框*/
        $('.c4').live('mouseenter', function() {
            var obj = $(this);
            intcategory = window.setInterval(function() {
                var pdetail = obj.find('.pdetail');
                var pname = obj.find('.pname').text();
                var lv = obj.find('.ilevel').html();
                var buyerid = $(pdetail).attr('buyerid');
                if ($(pdetail).attr('load') == 'loaded') {
                    $(pdetail).css('display', 'block');
                }
                else if (!isNaN(buyerid) && buyerid != undefined) {
                    $.getJSON(Yii_baseUrl + '/pap/mall/getBuyer', {buyerid: buyerid}, function(data) {
                        var html = '';
                        html += "<a id='trianglet'></a>";
                        html += "<a id='triangleb'></a>";
//                        html += "<h3></h3>";
//                        html += "<h4>" + pname + "</h4>";
                        html += "<div class = 'level'><span style='float:left;'>信用等级：</span>";
                        html += lv;
                        html += "</div>";
                        html += "<div class = 'grate'><div style='float:left'>好评率：</div>";
                        html += '<div style="padding-top:7px;float:left">' + data.jdt.jdt + '</div><div style="color:#ff9330;float:left">' + data.jdt.rate + '%</div>';
                        html += "</div>";
                        html += "<h5>评分细则</h5>";
                        for (var i in data.row) {
                            html += "<p class = 'loan'>" + data.row[i][0] + "</p>";
                            html += "<ul>";
                            html += "<li><em>好评</em>&nbsp;<i>" + data.row[i][1] + "</i></li>";
                            html += "<li><em>中评</em>&nbsp;<i>" + data.row[i][2] + "</i></li>";
                            html += "<li><em>差评</em>&nbsp;<i>" + data.row[i][3] + "</i></li>";
                            html += "</ul>";
                        }
                        $(pdetail).html(html);
                        $(pdetail).attr('load', 'loaded');
                        $(pdetail).css('display', 'block');
                    });
                }
            }, 500);
        });

        $('.c4').live('mouseleave', function() {
            window.clearInterval(intcategory);
            $(this).find('.pdetail').css('display', 'none');
        });
    })

    //  跳转到几页
    $("#gopage").click(function() {
        if (/[\d]/.test($("#evapage").val())) {
            var page = $("#evapage").val();
            page = Math.round(page);
            if (page <= 1) {
                page = 1;
            }
            if (/[\d]/.test($(".pageeva a").eq("-1").text())) {
                var count = $(".pageeva a").eq("-1").text();
            } else {
                var count = $(".pageeva a").eq("-2").text();
            }
            if (page > count) {
                page = count;
            }
            show(page);
        } else {
            show(1);
        }
    });

    function showall() {
        $("#all").click();
    }


    function getSearcheva(page) {
        if (!isNaN(page)) {
            var pages = page;
            $("#evapage").val(page);
        } else {
            $("#evapage").val('1');
            var pages = 1;
        }
        var status = $('#evastatus').val();
        var content = $('#evaempty').val();
        var order = $('#evaorder').val();
        var goodsid = $('#goodsid').val();
        var organid = $('#organid').val();
        return {
            'goodsid': goodsid,
            'organid': organid,
            // 排序
            'orderby': order,
            'content': content,
            'page': pages,
            'status': status
        };
    }

    //获取评论
    function show(page) {
        if (page == 'all' || page == 'good' || page == 'medium' || page == 'bad' || page == 'pic') {
            $('#evastatus').val(page);
        } else if (page == 'content') {
            if ($('#evaempty').val() == 'allcontent') {
                $('#evaempty').val('content');
            } else {
                $('#evaempty').val('allcontent');
            }
        } else if (page == 'orderID' || page == 'ordertimeup' || page == 'ordertimedrop') {
            $('#evaorder').val(page);
        }
        var data = getSearcheva(page);
        $.getJSON("<?php echo yii::app()->createUrl('pap/Mall/Geteva') ?>",
                data,
                function(data) {
                    $('.eva-list').html('');
                    $(".eva-list li").remove();
                    if (data.rows.length) {
                        $('.eva-list').append($("#evaTemplate").tmpl(data.rows));
                        $("#evapageid").show();
                        $(".pageeva").html(data.page);
                        $(".pagego").show();
                    } else {
                        $('.eva-list').html('暂无相关评论！');
                        $("#evapageid").hide();
                    }
                });
    }
    $('.click_eval').click(function() {
        var key = $(this).attr('key');
        $(this).addClass('proon');
        $(this).siblings().removeClass('proon');
        show(key);
    })
</script>
<!--详情页公用JS-->
<script type=text/javascript>
    $(document).ready(function() {
        //tal切换
        var $tab_li = $('#tab ul li');
        $tab_li.click(function() {
            $(this).addClass('selected').siblings().removeClass('selected');
            var index = $tab_li.index(this);
            $('div.tab_box > div').eq(index).show().siblings().hide();
        });

        //跳到评价
        $('#comment_span').click(function() {
            var a = $("#comm_show").offset().top - 5;
            $("html,body").animate({scrollTop: a}, 'slow');
            $('#comm_show').click();
            return false;
        });

        //数量减1
        $('.reduce_num').click(function() {
            var qt = $('#qty_item').val();
            if (qt > 1) {
                $('#qty_item').val(parseInt(qt) - 1);
            }
        });

        //数量加1
        $('.add_num').click(function() {
            var qt = $('#qty_item').val();
            if (qt < 100) {
                $('#qty_item').val(parseInt(qt) + 1);
            }
            else {
                alert('数量最多为100');
            }
        });

        //店铺分类
        $(".shop_fenlei2").click(function() {
            $(this).toggleClass("shop_fenlei3");
            $(this).next("div.shop_fenlei_info").toggle();
        });
    });

    //设置数量
    function setAmount(obj) {
        if (isNaN(obj.value)) {
            alert('请输入一个整数');
        }
        obj.value = obj.value.replace(/\D/g, '');
        if (obj.value.substr(0, 1) === '0')
            obj.value = obj.value.substr(1);
        var val = parseInt(obj.value);
        if (val < 1 || !val) {
            obj.value = 1;
        }
        if (val > 100) {
            alert('数量最多为100');
            obj.value = 100;
        }
    }
</script>
<!--图片处理JS-->
<script type='text/javascript'>
    $(document).ready(function() {
        $(".jqzoom").jqueryzoom({
            xzoom: 400,
            yzoom: 400,
            offset: 10,
            preload: 1,
            lens: 1
        });
        $("#spec-list img").live("mouseover", function() {
            var src = $(this).attr("src");
            $("#spec-n1 img").eq(0).attr({
                src: src.replace("\/n5\/", "\/n1\/"),
                jqimg: src.replace("\/n5\/", "\/n0\/")
            });
            $(this).css({
                "border": "2px solid #ff6600",
                "padding": "1px"
            });
            $(this).parent().siblings("").children().css({"border": "1px solid #ccc",
                "padding": "2px"});
        });
    });
    (function($) {
        $.fn.jqueryzoom = function(options) {
            var settings = {
                xzoom: 200,
                yzoom: 200,
                offset: 10,
                position: "right",
                lens: 1,
                preload: 1};
            if (options) {
                $.extend(settings, options);
            }
            var noalt = '';
            $(this).hover(function() {
                var imageLeft = $(this).offset().left;
                var imageTop = $(this).offset().top;
                var imageWidth = $(this).children('img').get(0).offsetWidth;
                var imageHeight = $(this).children('img').get(0).offsetHeight;
                noalt = $(this).children("img").attr("alt");
                var bigimage = $(this).children("img").attr("jqimg");
                $(this).children("img").attr("alt", '');
                if ($("div.zoomdiv").get().length == 0) {
                    $(this).after("<div class='zoomdiv' style='margin-left:130px'><img class='bigimg' src='" + bigimage + "'/></div>");
                    $(this).append("<div class='jqZoomPup'>&nbsp;</div>");
                }
                if (settings.position == "right") {
                    if (imageLeft + imageWidth + settings.offset + settings.xzoom > screen.width) {
                        leftpos = imageLeft - settings.offset - settings.xzoom;
                    } else {
                        leftpos = imageLeft + imageWidth + settings.offset;
                    }
                } else {
                    leftpos = imageLeft - settings.xzoom - settings.offset;
                    if (leftpos < 0) {
                        leftpos = imageLeft + imageWidth + settings.offset;
                    }
                }
                $("div.zoomdiv").css({top: imageTop, left: leftpos});
                $("div.zoomdiv").width(settings.xzoom);
                $("div.zoomdiv").height(settings.yzoom);
                $("div.zoomdiv").show();
                if (!settings.lens) {
                    $(this).css('cursor', 'crosshair');
                }
                $(document.body).mousemove(function(e) {
                    mouse = new MouseEvent(e);
                    var bigwidth = $(".bigimg").get(0).offsetWidth;
                    var bigheight = $(".bigimg").get(0).offsetHeight;
                    var scaley = 'x';
                    var scalex = 'y';
                    if (isNaN(scalex) | isNaN(scaley)) {
                        var scalex = (bigwidth / imageWidth);
                        var scaley = (bigheight / imageHeight);
                        $("div.jqZoomPup").width((settings.xzoom) / (scalex * 1));
                        $("div.jqZoomPup").height((settings.yzoom) / (scaley * 1));
                        if (settings.lens) {
                            $("div.jqZoomPup").css('visibility', 'visible');
                        }
                    }
                    xpos = mouse.x - $("div.jqZoomPup").width() / 2 - imageLeft;
                    ypos = mouse.y - $("div.jqZoomPup").height() / 2 - imageTop;
                    if (settings.lens) {
                        xpos = (mouse.x - $("div.jqZoomPup").width() / 2 < imageLeft) ? 0 : (mouse.x + $("div.jqZoomPup").width() / 2 > imageWidth + imageLeft) ? (imageWidth - $("div.jqZoomPup").width() - 2) : xpos;
                        ypos = (mouse.y - $("div.jqZoomPup").height() / 2 < imageTop) ? 0 : (mouse.y + $("div.jqZoomPup").height() / 2 > imageHeight + imageTop) ? (imageHeight - $("div.jqZoomPup").height() - 2) : ypos;
                    }
                    if (settings.lens) {
                        $("div.jqZoomPup").css({top: ypos, left: xpos});
                    }
                    scrolly = ypos;
                    $("div.zoomdiv").get(0).scrollTop = scrolly * scaley;
                    scrollx = xpos;
                    $("div.zoomdiv").get(0).scrollLeft = (scrollx) * scalex;
                });
            }, function() {
                $(this).children("img").attr("alt", noalt);
                $(document.body).unbind("mousemove");
                if (settings.lens) {
                    $("div.jqZoomPup").remove();
                }
                $("div.zoomdiv").remove();
            });
            count = 0;
            if (settings.preload) {
                $('body').append("<div style='display:none;' class='jqPreload" + count + "'>360buy</div>");
                $(this).each(function() {
                    var imagetopreload = $(this).children("img").attr("jqimg");
                    var content = jQuery('div.jqPreload' + count + '').html();
                    jQuery('div.jqPreload' + count + '').html(content + '<img src=\"' + imagetopreload + '\">');
                });
            }
        }
    })(jQuery);
    function MouseEvent(e) {
        this.x = e.pageX;
        this.y = e.pageY;
    }
</script>