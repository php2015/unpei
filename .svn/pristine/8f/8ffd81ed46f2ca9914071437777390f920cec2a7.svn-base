//加减控件
(function($){
	$(document).delegate('.num-control .s','click',function(){
		var input = $(this).next('input'),
			n = input.val()-1>0?+input.val()-1:0;
		input.val(n);
	});
	$(document).delegate('.num-control .a','click',function(){
		var input = $(this).prev('input');
		input.val(+input.val()+1);
	});

})(jQuery);