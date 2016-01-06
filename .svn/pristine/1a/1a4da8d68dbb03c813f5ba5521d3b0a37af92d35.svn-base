(function($){
    $.fn.jExpand = function(){
        var element = this;

        $(element).find("tr:odd").addClass("odd");
        $(element).find("tr:even:gt(0)").addClass("even")
        $(element).find("tr:not(.odd)").hide();
        $(element).find("tr:first-child").show();
        $(element).find("tr.odd").last().addClass("last");

        $(element).find("tr.odd").find("td:last").click(function() {
        	var parent = $(this).parent();
        	$(element).find("tr.odd").removeClass("active");
        	$(element).find("tr.even").removeClass("active");
        	parent.addClass("active");
        	parent.next("tr.even").addClass("active");
        	$(element).find("tr.even").not(".active").hide();
        	parent.next("tr").toggle();
        });
        
    }    
})(jQuery); 