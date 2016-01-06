// JavaScript Document
$(function() {
    var index = 0;
    function change(index) {
        $('.cnav>li').eq(index).addClass('click');
        $('.cnav>li').eq(index).animate({'width': '160px'}, 500);
        $('.cnav>li').eq(index).siblings().removeClass('click');
        $('.cnav>li').eq(index).siblings().css({'width': '138px'});
    }
    ;


    $('.cnav>li').click(function() {
        index = $(this).index();
        change(index);
        $('.shield').css({'left': 223 + index * 138});
    });

//    $('li.lione').click(function() {
//        $('.car1').show();
//        $('.car1').siblings().hide();
//    });
//    $('li.litwo').click(function() {
//        $('.car2').show();
//        $('.car2').siblings().hide();
//    });
//    $('li.lithr').click(function() {
//        $('.car3').show();
//        $('.car3').siblings().hide();
//    });
//    $('li.lifou').click(function() {
//        $('.car4').show();
//        $('.car4').siblings().hide();
//    });


//    $('.car1>h2>a').click(function() {
//        $(this).addClass('on');
//        $(this).siblings().removeClass('on');
//    });

//    $('.car1').find('li').click(function() {
//        $(this).addClass('onclick');
//        $(this).siblings().removeClass('onclick');
//        $('.i1>a').html($(this).find('em').html());
//        $('.car2').show();
//        $('.car2').siblings().hide();
//        index = 1;
//        change(index);
//        $('.shield').css({'left': '361px'});
//    });

//    $('.car2').find('li').click(function() {
//        $(this).addClass('onclick');
//        $(this).siblings().removeClass('onclick');
//        $(this).parent().siblings().find('li').removeClass('onclick');
//        $('.i2>a').html($(this).html());
//        $('.i2').show();
//        $('.car3').show();
//        $('.car3').siblings().hide();
//        index = 2;
//        change(index);
//        $('.shield').css({'left': '499px'});
//    });

//    $('.car3').find('li').click(function() {
//        $(this).addClass('onclick');
//        $(this).siblings().removeClass('onclick');
//        $('.i3>a').html($(this).html());
//        $('.i3').show();
//        $('.shield').css({'left': '637px'});
//    });

    $('.car4').find('li').click(function() {
        $(this).addClass('onclick');
        $(this).siblings().removeClass('onclick');
    });

    $('.car>h2>i').click(function() {

        index = $(this).index() - 1;
        $('.c_m_main>div').eq(index).show();
        $('.c_m_main>div').eq(index).siblings().hide();
        change(index);
        $('.c_m_main>div').eq(index).find('h2>i').eq(index).nextAll().hide();
        $(this).nextAll().hide();
        $('.shield').css({'left': 223 + index * 138});
    });

//    $('.poshow').click(function() {
//        $(this).toggleClass('ps');
//        $('.pone').toggle();
//        $('.ptwo').toggle();
//        $('.play').toggle(500);
//    });

    $('.car3').find('li').eq(0).click(function() {
        $('.car3').find('input').show();
    });
    $('.car3').find('li').eq(0).siblings().click(function() {
        $('.car3').find('input').hide();
        $('.car4').show();
        $('.car4').siblings().hide();
        index = 3;
        change(index);

    });


    $('.car').find('input').mouseover(function() {
        $(this).css({'background': '#f28218'})
    }).mouseout(function() {
        $(this).css({'background': '#f27300'})
    });

    //图片展示
    var opl = $('.play');
    var oimg = $('.image');
    var oul = oimg.find('ul');
    var owh = oimg.find('li').width();
    var onum = oimg.find('li').length;
    oul.width(owh * onum);
    $('.play').find('span>em').html(onum);
    var i = 1;
    var p = $('.play').find('span>i');
    $('a.next').click(function() {
        if (i < onum - 1) {
            oul.animate({'left': -owh * (i)});
            i++;
            p.html(i);
            $('a.next').css('opacity', '0.9');
        } else if (i = onum - 1) {
            $('a.next').css('opacity', '0.4');
            oul.animate({'left': -owh * (i)});
            i++;
            p.html(i);
        }
        ;

        $('a.prev').css('opacity', '0.9');
    });
    $('a.prev').click(function() {
        if (i > 2) {
            oul.animate({'left': -owh * (i - 2)})
            i--;
            p.html(i);
            $('a.prev').css('opacity', '0.9');
        } else if (i = 2) {
            oul.animate({'left': -owh * (i - 2)})
            i--;
            p.html(i);
            $('a.prev').css('opacity', '0.4')
        }
        ;
        $('a.next').css('opacity', '0.9');
    });
    //鼠标移上移出	
    $('.play').hover(
            function() {
                $(this).find('a.prev,a.next').show();
            },
            function() {
                $(this).find('a.prev,a.next').hide();
            }
    )

});






