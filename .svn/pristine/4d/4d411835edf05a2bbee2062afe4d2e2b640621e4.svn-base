$(document).ready(function() {
    /*搜索*/
    $(".J_SearchTab li:first").addClass("active");
//    $(".search-bd .search-bd-info:gt(0)").hide();
    $(".J_SearchTab li").click(function() {//mouseover 改为 click 将变成点击后才显示，mouseover是滑过就显示
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".search-bd .search-bd-info:eq(" + $(this).index() + ")").show().addClass('active').attr('key', $(this).index());
        $(".search-bd .search-bd-info:eq(" + $(this).index() + ")").siblings('.search-bd-info').removeClass('active').hide();
    })
    $('.J_SearchTab li:first').trigger('click');

    var type = $('#cur').val();
//     if($.inArray(type,[0,1,2])!= -1){
    if (type == '按商品编号') {
        $(".J_SearchTab li:eq(0)").click(function() {
            $(".search-bd .search-bd-info:eq(0)").find('input[type=text]').val('请输入关键字|拼音搜索').removeClass('handinput');
        })
        $(".J_SearchTab li:eq(2)").click(function() {
            $(".search-bd .search-bd-info:eq(2)").find('input[type=text]').val('请输入OE号搜索').removeClass('handinput');
        })
        $('.J_SearchTab li:eq(1)').addClass('active').siblings('li').removeClass('active');
        $(".search-bd .search-bd-info:eq(1)").show().addClass('active').attr('key', '1');
        $(".search-bd .search-bd-info:eq(1)").siblings('.search-bd-info').removeClass('active').hide();
    } else if (type == '按OE号') {
        $(".J_SearchTab li:eq(0)").click(function() {
            $(".search-bd .search-bd-info:eq(0)").find('input[type=text]').val('请输入关键字|拼音搜索').removeClass('handinput');
            ;
        })
        $(".J_SearchTab li:eq(1)").click(function() {
            $(".search-bd .search-bd-info:eq(1)").find('input[type=text]').val('请输入商品编号搜索').removeClass('handinput');
            ;
        })
        $('.J_SearchTab li:eq(2)').addClass('active').siblings('li').removeClass('active');
        $(".search-bd .search-bd-info:eq(2)").show().addClass('active').attr('key', '2');
        $(".search-bd .search-bd-info:eq(2)").siblings('.search-bd-info').removeClass('active').hide();
    }
    else {
        $(".J_SearchTab li:eq(1)").click(function() {
            $(".search-bd .search-bd-info:eq(1)").find('input[type=text]').val('请输入商品编号搜索').removeClass('handinput');
            ;
        })
        $(".J_SearchTab li:eq(2)").click(function() {
            $(".search-bd .search-bd-info:eq(2)").find('input[type=text]').val('请输入OE号搜索').removeClass('handinput');
            ;
        })
        $('.J_SearchTab li:eq(0)').addClass('active').siblings('li').removeClass('active');
        $(".search-bd .search-bd-info:eq(0)").show().addClass('active').attr('key', '0');
        $(".search-bd .search-bd-info:eq(0)").siblings('.search-bd-info').removeClass('active').hide();
    }

    $(".search-bd-info .keyword").blur(function() {
        if ($(this).val() == '') {
            $(this).removeClass('handinput');
            $(this).val('请输入关键字|拼音搜索');
        }
    })
    $(".search-bd-info .keyword").focus(function() {
        if ($(this).val() == '请输入关键字|拼音搜索') {
            $(this).addClass('handinput');
            $(this).val('');
        }
    })
    $(".search-bd-info .goodsno").blur(function() {
        if ($(this).val() == '') {
            $(this).removeClass('handinput');
            $(this).val('请输入商品编号搜索');
        }
    })
    $(".search-bd-info .goodsno").focus(function() {
        if ($(this).val() == '请输入商品编号搜索') {
            $(this).addClass('handinput');
            $(this).val('');
        }
    })
    $(".search-bd-info .oe").blur(function() {
        if ($(this).val() == '') {
            $(this).removeClass('handinput');
            $(this).val('请输入OE号搜索');
        }
    })
    $(".search-bd-info .oe").focus(function() {
        if ($(this).val() == '请输入OE号搜索') {
            $(this).addClass('handinput');
            $(this).val('');
        }
    })

    /*按汽车结构查找*/
    var hovercategory, outercategory;
    $("li.first").mouseenter(function() {
        var obj = $(this);
        window.clearTimeout(outercategory);
        $('li.first').each(function() {
            if ($(this).html() != obj.html()) {
                $(this).removeClass("li-hover");
                $(this).children(".second-nav").css("display", "none");
            }
        });
        // .siblings().removeClass("li-hover");
        hovercategory = window.setTimeout(function() {
            obj.addClass("li-hover");
//            $('li.first').each(function() {
//                if ($(this).html() != obj.html()) {
//                    $(this).children(".second-nav").css("display", "none");
//                }
//            });
            obj.children(".second-nav").show();
        }, 500);
    });

    $("li.first").mouseleave(function() {
        window.clearTimeout(hovercategory);
        var obj = $(this);
        outercategory = window.setTimeout(function() {
            obj.children(".second-nav").css("display", "none");
            obj.removeClass("li-hover");
        }, 500);
    });


    /*搜索说明*/
    $(".tishi").mouseover(function() {
        $(".promtion").css("display", "block")
    })
    $(".tishi").mouseout(function() {
        $(".promtion").css("display", "none")
    })

    $(".back").click(function() {
        $(".index-content").css("display", "block");
        $(".icon-detail").css("display", "none")
        $(".head-nav-info li:first").addClass("current");


    })
    $(".bjd-info:gt(0)").hide();
    $(".icon-info a").click(function() {//mouseover 改为 click 将变成点击后才显示，mouseover是滑过就显示
//        $(".icon-detail").css("display", "block");
//        $(".index-content").css("display", "none");
        $(".bjd-info:eq(" + $(this).index() + ")").show().siblings(".bjd-info").hide();
        $(".head-nav-info li").removeClass("current");
        // $(".xian").css("display","none");

    });
    var w = $("icon-info").width();
    $(".icon-title").css("width", w)





    /*隐藏展开*/
//    $(".com-zk").click(function() {
//        $(".com-step2").css("display", "none");
//        $(this).removeClass("com-zk").addClass("com-zked");
//        $(this).html("显示");
//
//
//    })
    $(function() {
        $oBtn = $(".com-zk");
        $oDiv = $(".com-step2");

        $oBtn.click(function() {
            if ($oDiv.is(":visible")) {
                $oBtn.html("显示");
                $oBtn.addClass("com-zked");
                $oDiv.hide();
            } else {
                $oBtn.html("隐藏");
                $oBtn.removeClass("com-zked")
                $oDiv.show();
            }
        })
    })

    /*工作台二级导航*/
    $(".text-nav-ul li").mouseover(function() {
        $(this).children(".text-mk-info").css("display", "block");
        $(this).addClass("hover");
    })
    $(".text-nav-ul li").mouseout(function() {
        $(this).children(".text-mk-info").css("display", "none");
        $(this).removeClass("hover");
    })



    /*消息中心修理厂名称鼠标经过效果*/
    $(".xlc-name").mouseover(function() {
        $(".jxs-name-info").css("display", "block");

    })
    $(".xlc-name").mouseout(function() {
        $(".jxs-name-info").css("display", "none");

    })
    /*消息中左侧边选中样式*/
    $(".left-info2").click(function() {
        $(this).addClass("left-info2-current")
        $(".p-current").removeClass("p-current")

    })
    $(".left-info3").click(function() {
        $(this).addClass("left-info3-current")
        $(".p-current").removeClass("p-current")


    })
    /*系统消息点击显示隐藏*/
    $(".system-title").click(function() {

        $(this).next().next(".system").slideToggle("");




    })
    /*首页模块tab切换*/
    $("index-mk-title ul li:first").addClass("current");
    $(".all-icon .icon-info:gt(0)").hide();
    $(".index-mk-title ul li").click(function() {//mouseover 改为 click 将变成点击后才显示，mouseover是滑过就显示
        $(this).addClass("current").siblings("li").removeClass("current");
        $(".all-icon .icon-info:eq(" + $(this).index() + ")").show().siblings(".icon-info").hide().addClass("current");

    })
    /*鼠标经过账号信息显示*/
    $(".name-customer").mouseover(function() {

        $(".name-customer-info").css("display", "block")

    })
    $(".name-customer").mouseout(function() {

        $(".name-customer-info").css("display", "none")

    })

    /*鼠标经消息中心显示*/
    $("li.xiaoxi").mouseover(function() {

        $(".pop-up").css("display", "block");
        $("div.xiaoxi").css("background-color", "#fff");
        $("div.xiaoxi").css("border", "1px solid #ccc");
        $("div.xiaoxi").css("border-bottom", "none");
    })
    $("li.xiaoxi").mouseout(function() {

        $(".pop-up").css("display", "none");
        $("div.xiaoxi").css("background-color", "#f6f6f6");
        $("div.xiaoxi").css("border", "1px solid #f6f6f6")

    })
    $("div.pop-up").mouseover(function() {

        $("div.xiaoxi").css("background-color", "#fff");
        $("div.xiaoxi").css("border", "1px solid #ccc");
        $("div.xiaoxi").css("border-bottom", "none");

    })
    $("div.pop-up").mouseout(function() {
        $("div.xiaoxi").css("background-color", "#f6f6f6");
        $("div.xiaoxi").css("border", "1px solid #f6f6f6")

    })
    $("li.helpcontact").mouseover(function() {

        $(".helpcontact_d").css("display", "block");
        $("div.helpcontact").css("background-color", "#fff");
        $("div.helpcontact").css("border", "1px solid #ccc");
        $("div.helpcontact").css("border-bottom", "none");
    })
    $("li.helpcontact").mouseout(function() {

        $(".helpcontact_d").css("display", "none");
        $("div.helpcontact").css("background-color", "#f6f6f6");
        $("div.helpcontact").css("border", "1px solid #f6f6f6")

    })
    $("div.helpcontact_d").mouseover(function() {

        $("div.helpcontact").css("background-color", "#fff");
        $("div.helpcontact").css("border", "1px solid #ccc");
        $("div.helpcontact").css("border-bottom", "none");

    })
    $("div.helpcontact_d").mouseout(function() {
        $("div.helpcontact").css("background-color", "#f6f6f6");
        $("div.helpcontact").css("border", "1px solid #f6f6f6")

    })

    $("li.helpcenter").mouseover(function() {

        $(".helpcenter_d").css("display", "block");
        $("div.helpcenter").css("background-color", "#fff");
        $("div.helpcenter").css("border", "1px solid #ccc");
        $("div.helpcenter").css("border-bottom", "none");
    })
    $("li.helpcenter").mouseout(function() {

        $(".helpcenter_d").css("display", "none");
        $("div.helpcenter").css("background-color", "#f6f6f6");
        $("div.helpcenter").css("border", "1px solid #f6f6f6")

    })
    $("div.helpcenter_d").mouseover(function() {

        $("div.helpcenter").css("background-color", "#fff");
        $("div.helpcenter").css("border", "1px solid #ccc");
        $("div.helpcenter").css("border-bottom", "none");

    })
    $("div.helpcenter_d").mouseout(function() {
        $("div.helpcenter").css("background-color", "#f6f6f6");
        $("div.helpcenter").css("border", "1px solid #f6f6f6")

    })





    /*左边常用工具固定返回顶部*/
    var a = $(".header").height();
    var b = $(".text-nav").height();
    var c = a + b + 20;
    var tools = $(".c-tools "); //得到导航对象
    var win = $(window); //得到窗口对象
    var sc = $(document);//得到滚动条的高度。
    fnroll(sc, c, tools);
    win.scroll(function() {
        fnroll(sc, c, tools);
    })

    $("#moquu_top").click(function() {
        $(document).scrollTop(0)
    })
    var screenheight = document.documentElement.clientHeight;
    $('#scren').css('min-height', screenheight);

})

function fnroll(sc, c, tools) {
    if (sc.scrollTop() >= c) {

        tools.addClass("fixednav");

        $("#moquu_top").show();

    } else {

        tools.removeClass("fixednav");

        $("#moquu_top").hide();

    }
}