<link type="text/css" rel="stylesheet" href="<?php echo F::themeUrl() . '/css/car/car.css' ?>" />
<script type="text/javascript" src="<?php //echo F::themeUrl() . '/js/car/jquery-1.11.1.min.js'                                                                                                               ?>"></script>
<script type="text/javascript" src="<?php //echo F::themeUrl() . '/js/car/chose.js'                                                                                                               ?>"></script>
<style>
    #make-car-mall{left:25%!important}
    .selectDiv3{background: #fff; width: 700px; display: none; position: absolute; z-index: 1000;border:2px solid #0065bf;}
    .selected3{ background:#0065bf; color: #fff;}
    .li_toped {background:#39AE39; color:white; border-bottom: 2px #39AE39 solid;}
    a{ text-decoration:none}
    .left_A ul li{ border:1px solid #e1e1e1; width:14px; height:14px; background:#eff4fa; margin:0px 2px 1px; float:left}
    .left_A ul li a{color:#0065bf;font:12px Arial; padding-left:3px; display:block; float:left;width:12px; height:14px;}
    .left_A ul li a:hover{background:#0065bf; color:white}
    .right_A ul{padding:0; margin:0; list-style:none}
    .right_A ul li.li_top{ height:26px; line-height:26px; background:#F0F0F0; color:#414141; padding-left:10px; font:18px/26px Arial; margin:5px 0 2px 5px; font-weight:bold}
    .right_A ul li.li_list{ text-indent:1em; height:26px; line-height:26px; margin:1px 4px 0; overflow: hidden}
    .right_A ul li.li_list a{ color:#676767; font-size:12px;}
    .right_A ul li.selected3 a{color:#fff}
    .right_A ul li.li_list:hover{ background:#0065bf}
    .right_A ul li.li_list:hover a{ color:white}
    .makelist{ height:140px; overflow-y:scroll; float: left; *position: relative}
    .chose_new{font:18px Arial;display:none; float:left; height:30px;line-height:30px; padding-left:10px; margin:5px 0;z-index: 102;}
    .choseXc{display:block;float:right;  margin-right: 7px;margin-top: 10px;} 
    #make-car-mall {border: 2px solid #f2b303; z-index: 1900}
    .series_title{width: 114px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}
    .make_title{width: 100px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}
    .datagrid-mask{z-index: 101}
    .datagrid-masks{z-index: 101}
    .car1 li a{ line-height: 20px}
</style>
<div class="chose_new">
    <div class="cs_main selectDiv3 active" id="make-car-mall">
        <!--屏蔽层-->
        <div class="shield" style="background:#fff"></div>
        <!--屏蔽层结束-->
        <!--关闭按钮-->
        <div class="clo"><img src="<?php echo F::themeUrl() ?>/images/car/clo.png" /></div>
        <div class="cs_nav">
            <p>选择车型</p>
            <ul>
                <li><a href="javascript:void(0)" class="how" onclick="selecthow()">如何选车型</a></li>
                <li><a href="javascript:void(0)" class="non" onclick="selectnon()">反馈没有我的车型</a></li>
            </ul>
        </div>

        <!--关闭按钮结束-->
        <!--导航ul-->
        <ul style=" padding-left:21px;"><li class="fz1"></li>
        </ul>
        <ul class="cnav" style=" position: relative; left:0px; z-index: 98">
            <li class="click lione">汽车品牌</li>
            <li class="litwo">车系</li>
            <li class="lithr">年款</li>
            <li class="lifou">车型</li>
            <div class="clear"></div>
        </ul>
        <ul><li class="fz2"></li>
        </ul>
        <!--导航ul结束-->
        <div class="clear"></div>
        <div class="c_m_main">
            <!--品牌div-->
            <div class="car1 car">
                <h2> 品牌首字母：
                    <span class="xuanze" style="display:none"><input type="text" name="pinyin-w" id="pinyin-w" class="input width260"/>
                        <input type="button" id="pinyin-search" value="拼音检索"  class="btn-green" style="cursor:pointer;"/>
                    </span>
                    <?php
                    $brands = D::queryGoodsBrands();
//                    var_dump($brands);
                    ?>
                    <?php if ($brands): ?>
                        <?php foreach ($brands as $key => $value): ?>
                            <?php $piny2[] = substr($value['pinyin'], 0, 1); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($piny2): ?>
                        <?php foreach ($piny2 as $key => $value): ?>
                            <?php $PINYA[] = ord($value) ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php
                    echo "<a class='brand_f on' href='javascript:void(0)'>热</a>";
                    for ($i = ord("A"); $i <= ord("Z"); $i++) {
                        if (!empty($PINYA) && in_array($i, $PINYA)) {
//                            echo "<li><a href='javascript:void(0)' onclick=on_mall('" . chr($i) . "') >" . chr($i) . "</a></li>";
                            echo "<a class='brand_f' href='javascript:void(0)' >" . chr($i) . "</a>";
                        }
                    }
                    ?>
                </h2>
                <!--<a class="on">热</a><a class="a">A</a><a class="b">B</a><a class="c">C</a><a class="d">D</a><a class="f">F</a><a class="h">H</a><a class="j">J</a><a class="k">K</a><a class="l">L</a><a class="m">M</a><a class="q">Q</a><a class="r">R</a><a class="s">S</a><a class="t">T</a><a class="w">W</a><a class="x">X</a><a class="y">Y</a><a class="z">Z</a></h2>-->
                <ul style="width:660px;height:250px; overflow-y:scroll; position: relative" id="brands">

                    <?php $list = array(); ?>
                    <?php if ($brands): ?>
                        <?php foreach ($brands as $key => $value): ?>
                            <!--<a>-->
                            <li brandid="<?php echo $value['BrandID'] ?>" brandname="<?php echo $value['Name'] ?>">
                                <i>
                                    <img src="<?php echo F::uploadUrl() . $value['BrandLogo'] ?>"/>
                                </i>
                                <span>
                                    <em><?php echo $value['Name'] ?></em>
                                </span>

                            </li> 
                            <!--</a>-->


                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="clear"></div>
                </ul>
                <div class="clear"></div>
            </div>
            <!--车系div-->
            <div class="car2 car">
                <h2>
                    <em>已选车型：</em>
                    <i class="i1">
                        <a>大众</a>
                        <span></span>
                    </i>
                </h2>
                <p>国产</p>
                <ul>
                    <li>开迪</li><li>Polo</li><li>CC</li><li>凌渡</li><li>途观</li><li>朗逸</li><li>桑塔纳</li><li>帕萨特</li>
                    <li>开迪</li><li>Polo</li><li>CC</li><li>凌渡</li><li>途观</li><li>朗逸</li><li>桑塔纳</li><li>帕萨特</li>
                    <li>开迪</li><li>Polo</li><li>CC</li><li>凌渡</li><li>途观</li><li>朗逸</li><li>桑塔纳</li><li>帕萨特</li>
                    <div class="clear"></div>
                </ul>
                <div class="clear"></div>
                <p class="p2">进口</p>
                <ul>
                    <li>途锐</li><li>辉腾</li><li>尚酷</li><li>夏朗</li><li>迈腾</li><li>Eos</li><li>甲壳虫</li><li>Tiguan</li>
                    <li>开迪</li><li>Polo</li><li>CC</li><li>凌渡</li>
                </ul>
                <div class="clear"></div>

            </div>
            <!--年款div-->
            <div class="car3 car">
            </div>
            <!--车型div-->
            <div class="car4 car">
                <h2 id="modelh2"> <em>已选车型：</em><i class="i1"><a>大众</a><span></span></i><i class="i2"><a>大众</a><span></span></i><i class="i3"><a>大众</a><span></span></i></h2>
                <div id=yearmodel style="max-height:220px; overflow-y:auto; *position: relative">
                </div>
                <div class="clear"></div>
                <div style="height: 32px;margin: 0 auto;width: 98px;">
                    <input type="submit" onclick="modelselect()" id="submitmodel" value="确定选择" style="display:none"/>
                </div>
                <div class="poshow" style="display:none;">
                    <p class="pone" style="display:block">车型展示</p>
                    <p class="ptwo" style="display:none">返回车型</p>
                </div>
                <div class="play">

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    window.onload = function() {
        $('.pone').data('statu', 'close');//默认是图片收起
    };
    var Yii_chenhgUrl = "<?php echo F::baseUrl(); ?>";
    var Yii_uploadUrl = "<?php echo F::uploadUrl(); ?>";
    function change(index) {
        $('.cnav>li').eq(index).addClass('click');
//        $('.cnav>li').eq(index).animate({'width': '160px'}, 500);
        $('.cnav>li').eq(index).siblings().removeClass('click');
//        $('.cnav>li').eq(index).siblings().css({'width': '138px'});
    }
    //选择年款时确定
    function yearselect() {
        var data = {};
        data.makeid = $('#selectcar').attr('makeid');
        data.seriesid = $('#selectcar').attr('seriesid');
        saveVechile(data, 'year');
    }
    //选择车型时确定
    function modelselect() {
        var data = {};
        data.makeid = $('#selectyear').attr('makeid');
        data.seriesid = $('#selectyear').attr('seriesid');
        data.yearid = $('#selectyear').attr('yearid');
        if ($('#selectyear').attr('modelid') != '不确定车型') {
            data.modelid = $('#selectyear').attr('modelid');
        }
        saveVechile(data, 'model');
    }
    $(document).on("click", ".cnav li", function() {
        $(this).addClass('click');
        $(this).siblings().removeClass('click');
    });

    //选择品牌
    $(document).on("click", "#brands li", function() {
        $("#brands li").removeClass('onclick');
        $(this).addClass('onclick');
        $('.i1>a').html($(this).find('em').html());
        $('.car2').show();
        $('.car2').siblings().hide();
        index = 1;
        change(index);
        $('.shield').css({'left': '361px'});
        var brandid = $(this).attr('brandid');
        var brandname = $(this).attr('brandname');
        var url = Yii_chenhgUrl + '/common/getLeafMakesofp';
        var data = {brandid: brandid};
        $(".car2").empty();
        $.getJSON(url, data, function(make) {
            $(".car2").append('<h2><em>已选车型：</em><i class = "i1"><a>' + brandname + '</a><span></span></i></h2><div id=makescar style="height:280px; overflow:auto;"></div>');
            $.each(make, function(index, mvalue) {
                $.getJSON(Yii_jpdataUrl + '/vehicle/goodsSeries', {make: mvalue.MakeID}, function(car) {
                    var li = '';
                    li += '<p>' + mvalue.Name + '</p>';
                    li += '<ul>';
                    $.each(car, function(index, cvalue) {
                        if (cvalue.number != 0 && cvalue.number != null) {
                            li += '<li makeid=' + mvalue.MakeID + ' makename=' + mvalue.Name + ' seriesname=' + cvalue.name + '  seriesId=' + cvalue.seriesId + '>' + cvalue.name + '</li>';
                        } else {
                            li += '<li  seriesId="无" style="color:#ccc;" title="此车系暂无商品，平台商品正在不断更新中">' + cvalue.name + '</li>';
                        }
                    });
                    li += '<div class="clear"></div>';
                    li += '</ul><div class="clear"></div>';
                    $("#makescar").append(li);
                });
            });
        });
    });
    //选择车系
    $(document).on("click", "#makescar li", function() {
        var seriesId = $(this).attr('seriesId');
        if (seriesId == '无') {
//            alert('该车系下暂无商品')
            return false;
        }
        $(this).addClass('onclick');
        $(this).siblings().removeClass('onclick');
        $(this).parent().siblings().find('li').removeClass('onclick');
        $('.i2>a').html($(this).html());
        $('.i2').show();
        $('.car3').show();
        $('.car3').siblings().hide();
        index = 2;
        change(index);
        $('.shield').css({'left': '499px'});

        var makeid = $(this).attr('MakeID');
        var makename = $(this).attr('makename');
        var seriesname = $(this).attr('seriesname');
        $(".car3").empty();
        $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYear', {seriesId: seriesId}, function(result) {
            $(".car3").append('<h2><em>已选车型：</em><i class = "i1"><a>' + makename + '</a><span></span></i><i class="i2" style="display: inline;"><a>' + seriesname + '</a><span></span></i></h2><div id=seriesyear style="height:280px; overflow:auto;"></div>');
            var li = '<input type="hidden" id="selectcar" makeid=' + makeid + ' seriesId="' + seriesId + '" makename="' + makename + '" seriesname="' + seriesname + '"/>';
            li += '<ul>';
            li += '<li>不确定年款</li>';
            $.each(result, function(index, yvalue) {
                if (yvalue.year) {
                    if (yvalue.number != 0 && yvalue.number != null) {
                        li += '<li yearid=' + yvalue.year + '>' + yvalue.year + '款</li>';
                    } else {
                        li += '<li yearid="无"  style="color:#ccc;"  title="此年款暂无商品，平台商品正在不断更新中">' + yvalue.year + '款</li>';
                    }

                }
            });
            li += '<div class="clear"></div>';
            li += '</ul><div class="clear"></div><div style="height: 32px;margin: 0 auto;width: 98px;"><input onclick="yearselect()" id=submityear type="submit" value="确定选择" style="display:none"/></div>';
            $("#seriesyear").append(li);
        });
    });
    //选择年款
    $(document).on("click", "#seriesyear li", function() {
        var yearid = $(this).attr('yearid');
        if (yearid == '无') {
//            alert('该年款下暂无商品');
            $("#submityear").hide();
            return false;
        }
        $(this).addClass('onclick');
        $(this).siblings().removeClass('onclick');
        if (yearid) {
            $('.i3>a').html($(this).html());
            $('.i3').show();
            $('.car4').show();
            $('.car4').siblings().hide();
            index = 3;
            change(index);
            $('.shield').css({'left': '637px'});
            var seriesId = $("#selectcar").attr('seriesId');
            var makeid = $("#selectcar").attr('makeid');
            var makename = $("#selectcar").attr('makename');
            var seriesname = $("#selectcar").attr('seriesname');
            $("#modelh2").empty();
            $("#yearmodel").empty();
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYearModels', {seriesId: seriesId, year: yearid}, function(result) {
                $("#modelh2").append('<em>已选车型：</em><i class = "i1"><a>' + makename + '</a><span></span></i><i class="i2" style="display: inline;"><a>' + seriesname + '</a><span></span></i><i class="i3" style="display: inline;"><a>' + yearid + '款</a><span></span></i>');
                var li = '<input type="hidden" id="selectyear" makeid="' + makeid + '" makename="' + makename + '" seriesid="' + seriesId + '" seriesname="' + seriesname + '" yearid="' + yearid + '"/>';
                li += '<ul>';
                li += '<li><i><em>不确定车型</em></i></li>';
                $.each(result, function(index, mvalue) {
                    if (mvalue.number != 0 && mvalue.number != null) {
                        li += '<li modelid=' + mvalue.modelId + ' modelname="' + mvalue.name + '"><i><em>' + mvalue.name + '</em></i></li>';
                    } else {
                        li += '<li  modelid="无"  style="color:#ccc;"  title="此车型暂无商品，平台商品正在不断更新中"><i><em>' + mvalue.name + '</em></i></li>';
                    }
                });
                li += '<div class="clear"></div>';
                li += '</ul><div class="clear"></div>';
                $("#yearmodel").append(li);
                $(".poshow").attr('style', 'display:none');
            });
            $(".poshow").attr('style', 'display:none');
        } else {
            $("#submityear").show();
        }
    });
    //选择车型
    $(document).on("click", "#yearmodel li", function() {
        var modelid = $(this).attr('modelid') ? $(this).attr('modelid') : '不确定车型';
        if (modelid == '无') {
//            alert('该车型下暂无商品');
            $("#submitmodel").hide();
            return false;
        }
        $(this).addClass('onclick');
        $(this).siblings().removeClass('onclick');
        var modelname = $(this).attr('modelname') ? $(this).attr('modelname') : '不确定车型';
        $("#selectyear").attr('modelid', modelid);
        $("#selectyear").attr('modelname', modelname);
        $("#submitmodel").show();
        $(".poshow").show();
    });
    //删除-产家
    $(document).on("click", ".i1", function() {
        change(0);
        $("#submityear").hide();
        $("#submitmodel").hide();
        $(".car").hide();
        $(".car1").show();
        $(".poshow").attr('style', 'display:none');
    });
    //删除-车系
    $(document).on("click", ".i2", function() {
        change(1);
        $(this).addClass('onclick');
        $(this).siblings().removeClass('onclick');
        $("#submityear").hide();
        $("#submitmodel").hide();
        $(".car").hide();
        $(".car2").show();
        $(".poshow").attr('style', 'display:none');
    });
    //删除-年款
    $(document).on("click", ".i3", function() {
        change(2);
        $(this).addClass('onclick');
        $(this).siblings().removeClass('onclick');
        $("#submityear").hide();
        $("#submitmodel").hide();
        $(".car").hide();
        $(".car3").show();
        $(".poshow").attr('style', 'display:none');
    });
//    $(document).ready(function() {
//        $('.i3').click(function() {
//            alert(3);
//            change(2);
//            $(this).addClass('onclick');
//            $(this).siblings().removeClass('onclick');
//            $("#submityear").hide();
//            $("#submitmodel").hide();
//            $(".car").hide();
//            $(".car3").show();
//           $(".poshow").attr('style', 'display:none');
//        });
//    })
    //图片展示或隐藏
    $(document).on("click", ".poshow", function() {
        var select_modelid = $('#yearmodel .onclick').attr('modelid');
        var img_statu = $('.pone').data('statu');
        if (img_statu === 'close' && !select_modelid) {
            alert('暂无图片');
            return false;
        }
        if (img_statu === 'close') {
            if ($('.pone').data('html' + select_modelid)) {
                $('.play').html($('.pone').data('html' + select_modelid));
                $('.pone').data('statu', 'open');
            } else {
                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('pap/home/getmodeldetail') ?>',
                    type: 'post',
                    data: {'modelId': select_modelid},
                    success: function(msg) {
                        if (!msg) {
                            alert('图片暂缺');
                            return false;
                        } else {
                            $('.play').html(msg);
                            $('.pone').data('statu', 'open');
                            $('.pone').data('html' + select_modelid, msg);
                        }
                    }
                });
            }
        } else if (img_statu === 'open') {
            $('.pone').data('statu', 'close');
        }
        $(this).toggleClass('ps');
        $('.pone').toggle();
        $('.ptwo').toggle();
        $('.play').toggle(500);
    });


    $(document).on("click", "li.lione", function() {
        $('.car1').show();
        $('.car1').siblings().hide();
    });
    $(document).on("click", "li.litwo", function() {
        $('.car2').show();
        $('.car2').siblings().hide();
    });
    $(document).on("click", "li.lithr", function() {
        $('.car3').show();
        $('.car3').siblings().hide();
    });
    $(document).on("click", "li.lifou", function() {
        $('.car4').show();
        $('.car4').siblings().hide();
    });
    $(document).ready(function() {
        //关闭
        $('.clo').click(function() {
            if (confirm('关闭选择，不会修改适用车系。确定要执行此操作？')) {
                closeChose();
            }
        });
        $(".brand_f").click(function(e) {
            $(this).addClass('on');
            $(this).siblings().removeClass('on');
            var litxt = $(this).text();
            if (/[A-Z]+/.test(litxt)) {
                $("#pinyin-w").val(litxt);
            } else {
                $("#pinyin-w").val("");
            }
            $("#pinyin-search").click();
        });
        // 拼音检索
        $("#pinyin-search").click(function(e) {
            var pinyin = $("#pinyin-w").val();
            var url = Yii_chenhgUrl + '/common/getLeafCarsofp';
            var data = {pinyin: pinyin};
            $("#brands").empty();
            $.getJSON(url, data, function(result) {
                var li = '';
                $.each(result, function(index, value) {
                    li += "<li brandid=" + value.BrandID + " brandname=" + value.Name + "><i><img src='" + Yii_uploadUrl + "/" + value.BrandLogo + "'/></i><a><span><em>" + value.Name + "</em></span></a></li>";
                });
                $("#brands").append(li);
            });
        });
        // 点击输入框弹出div层
        $("#make-select-mall").click(function(e) {
            e.stopPropagation();
            var offset = $(this).offset();
            var left, top, url, data;
            var width = $(window).width();
            //屏幕宽度大于1000
            if (width > 1000) {
                var cutwidth = (width - 1000) / 2;
            } else {
                cutwidth = 0;
            }

            left = (offset.left - cutwidth) + 'px';
            top = '-' + (offset.top + 170) + 'px';
            $(".chose_new").show();
            $("#make-car-mall").css({'left': left, 'top': top}).show();
        });
        //选择品牌
        $('.car1 li').click(function() {
            $(this).addClass('onclick');
            $(this).siblings().removeClass('onclick');
            $('.i1>a').html($(this).find('em').html());
            $('.car2').show();
            $('.car2').siblings().hide();
            index = 1;
            change(index);
            $('.shield').css({'left': '361px'});
        });
    });
    //关闭车型选择
    function closeChose() {
        $(".chose_new").hide();
        $("#make-car-mall").hide();
        ajaxLoadEnds();
    }

    //鼠标移动图片上显示左右箭头
    $('.play').hover(
            function() {
                $(this).find('a.prev,a.next').show();
            },
            function() {
                $(this).find('a.prev,a.next').hide();
            }
    );
    function selectnon() {
        alert('该功能暂未开放');
    }
    function selecthow() {
        alert('该功能暂未开放');
    }
</script>


