
/*设置遮罩层的高度*/
$(document).ready(function(){
var h2=$("#x2").height();
$(".shade").css("height",h2);

/*点击步骤加上颜色*/
$(".nav .nav_i").click(function(){
	$(".nav .nav_i").removeClass("r_ind_nav");
	$(this).addClass("r_ind_nav");
});

})
/*挑选商品页面两种方式点击步骤出现相应内容，方式1*/
$(document).ready(function(){
	$(".head-nav-info  li:first").addClass("active");
	$(".info .chioce2_s:gt(0)").hide();
	$(".head-nav-info li").click(function(){//mouseover 改为 click 将变成点击后才显示，mouseover是滑过就显示
	$(this).addClass("active").siblings("li").removeClass("active");
	$(".info .chioce2_s:eq("+$(this).index()+")").show().siblings(".chioce2_s").hide().addClass("active");


	})
	$(".next").click(function(){
		$(this).parents(".width1000").hide();
		$(this).parents(".width1000").prev(".chioce2_s").hide();
	   $(this).parents(".width1000").next("").show();
	   $(this).parents(".width1000").next("").next().show();

	  })
	
	})
/*挑选商品页面两种方式点击步骤出现相应内容，方式2*/
$(document).ready(function(){
	$(".head-nav-info  li:first").addClass("active");
	$(".info .chioce_s:gt(0)").hide();
	$(".info .width1000:gt(0)").hide();
	$(".head-nav-info li").click(function(){//mouseover 改为 click 将变成点击后才显示，mouseover是滑过就显示
	$(this).addClass("active").siblings("li").removeClass("active");
	$(".info .chioce_s:eq("+$(this).index()+")").show().siblings(".chioce_s").hide().addClass("active");
	$(".info .width1000:eq("+$(this).index()+")").show().siblings(".width1000").hide().addClass("active");


	})
	
	$(".next").click(function(){
		$(this).parents(".width1000").hide();
		$(this).parents(".width1000").prev(".chioce_s").hide();
	   $(this).parents(".width1000").next("").show();
	   $(this).parents(".width1000").next("").next().show();
	
	  })	
	
	
	
	
	;})
/*提交订单不同支付方式同一步骤点击不同图片显示*/
$(document).ready(function(){
$(".next").click(function(){
		$(this).parents(".width1000").hide();
		$(this).parents(".width1000").prev(".submit_s").hide();
	   $(this).parents(".width1000").next("").show();
	   $(this).parents(".width1000").next("").next().show();
	
	  })	  })