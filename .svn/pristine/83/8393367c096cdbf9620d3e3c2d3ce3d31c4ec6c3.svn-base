//$(document).ready(function(){
//    $('.tab-hd-con a').bind('click',function(){
//        
//        var key = $(this).parents("span").attr("key");
//        $(".tab-hd-con").removeClass("current");
//        $(this).parent("span").addClass("current");
//        $(".tab-bd-con").hide();
//        $("."+key).show();
//    });
//})
$(document).ready(function(){
    $('.tab-hd-con a').bind('click',function(){
        var frm = $(this).parents(".mukuai");
        var key = $(this).parents("span").attr("key");
        frm.find(".tab-hd-con").removeClass("current");
        $(this).parent("span").addClass("current");
        frm.find(".tab-bd-con").hide();
        frm.find("."+key).show();
    });
})