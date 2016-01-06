//隔行变色，放置变色
$("table tbody tr").removeClass("bg-green-light"); 
if($('tr.empty').length>0){
    $("tbody tr:not(.empty)").each(function(i){
        if(i%2==0)return;
        $(this).addClass("bg-green-light"); 
    });
}else if($('#success_assess,#fail_list').length>0){
    $('#success_assess tbody tr,#fail_list tbody tr').each(function(i){
        i%4==0 && $(this).addClass("bg-green-light"); 
    });
}else{
    $("table tbody tr:odd").addClass("bg-green-light"); 
}
$("table tbody tr").live({
    mouseout: function() {
        $(this).removeClass("tr-hover");
    },
    mouseover: function() {
        $(this).addClass("tr-hover");
    }
});

// //表格不换行 &&　拖拽表格宽度
// $(function(){
//     // $('table').css({'width':'100%','table-layout':'fixed'}).find('td,th').css({"overflow":"hidden","white-space":"nowrap"});
//     $('table:not(.dttable)').css({'table-layout':'fixed'}).find('td,th').css({"overflow":"hidden","white-space":"nowrap","text-overflow":"ellipsis"});
//     $('body table').tdDrag({nodrag:true});
//     $('table#goodsdz').find('thead td').css({overflow:'visible'});
// });

//参数 {gt:0} 
//gt int 从第几个td开始插入触发器
//nodrag boolen true=>只显示线，不拖拽
// $.fn.tdDrag=function(option){
//     var default_opt = {gt:0,nodrag:false}
//     option = $.extend(default_opt,option);
//     //宽度触发器
//     var Drag_html = "<b class='yy-tdDrag' style='height:24px;line-height:100%;border-left:1px dashed #ccc;width:1px;padding-left:5px;float:left;'></b>"
//     var gt = option.gt;
//     var nodrag = option.nodrag;
//     this.each(function(){
//         //插入触发器
//         try{
//             $(this).find('th:gt('+gt+')').prepend(Drag_html);
//             $(this).find('thead td:gt('+gt+')').prepend(Drag_html);
//         }catch(e){}
//         if(nodrag)return;
//         $('.yy-tdDrag').css({"cursor":"e-resize"});
//         //拖拽
//         $(document).delegate('.yy-tdDrag','mousedown',function(e){
//             $('head').append('<style id="noselect-fortdDrag">html,body{-moz-user-select: none; -webkit-user-select: none;-khtml-user-select: none; user-select: none;}</style>');
//             var self = $(this);
//             var table = self.closest('table');
//             var ox = e.clientX;
//             var ow = self.closest('td').prev('td').width();
//             var tow= table.width();
//             $(this).closest('table').on('mousemove',function(e){
//                 var nx = e.clientX;
//                 if(nx-ox+ow<=10){return false;}
//                 self.closest('td').prev('td').attr('width',nx-ox+ow);
//                 var pbox = table.closest('div');
//                 if(tow<table.width() && pbox.css('overflow-x')!='scroll'){
//                     pbox.css({"overflow-x":"scroll"});
//                 }else if(pbox.css('overflow-x')=='scroll' && tow>=table.width()){
//                     pbox.css({"overflow-x":"hidden"});
//                 }
//             });
//         });
//         //释放鼠标
//         $(document).mouseup(function(e){
//             $('.yy-tdDrag').closest('table').off('mousemove');
//             $('head').find('#noselect-fortdDrag').remove();
//         });
//     });
// };