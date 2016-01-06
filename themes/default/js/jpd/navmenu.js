$(function(){
    $("#nav1 li a").mouseover(function(){
        $(this).siblings().css('display','block');
    })
    $("#nav1 li").mouseleave(function(){
        $(this).children(".ej").css("display","none")
    })
    $(".yc_info").click(function(){

        $(this).parent().parent().siblings().slideToggle("slow");
        $(this).toggleClass("yc_info_current")
    })	
	
    $(".sc_info").click(function(){
        $(this).parent().parent().parent().css("display","none");
    })
	
});
