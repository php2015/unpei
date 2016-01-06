<link type="text/css" rel="stylesheet" href="<?php echo F::themeUrl().'/css/chat/message.css'?>" />
<link type="text/css" rel="stylesheet" href="<?php echo F::themeUrl().'/css/chat/allmsg.css'?>" />
<link type="text/css" rel="stylesheet" href="<?php echo F::themeUrl().'/css/chat/messageborder.css'?>" />
<link type="text/css" rel="stylesheet" href="<?php echo F::themeUrl().'/css/chat/datapicker.css'?>" />
<style>
 .he{
   float: left;
    height: 30px;
    line-height: 30px;
    overflow: hidden;
    padding-left: 10px;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 84px
    }
</style>
<div class="allmsg">
    	<!--左侧栏-->
    	<div class="c_list">
        	<h2>
            	<input type="text" value="" placeholder="查找联系人" id="searchorgans" />
                <input type="submit" id="search" value="" />
            </h2>
            <ul class="all_nav">
            	<li>最近对话：</li>
            </ul>
            <!--最近对话列表-->
            		<div class="nav_one">
                    	<ul class="good">
                              <?php foreach($relativer as $key=>$value): ?>
                            <li class="i_one active"  key="<?php echo $value['sessionid']?>" touserid='<?php echo $value['userid']?>'><span class="headimg"><img src="<?php echo F::uploadUrl().$value['Path']?>" /></span>
                                <div class='he' title='<?php echo $value['OrganName'].'-'.$value['UserName']?>'><?php echo $value['OrganName'].'-'.$value['UserName']?></div></li>
                            <?php endforeach;?>
                           
                        </ul>
                    </div>
             <!--最近对话列表结束-->
        </div>
        <!--左侧栏结束-->
        <!--右边栏弹窗历史记录-->
        <div  id="msgs">
         </div>              

        <!--右边栏结束-->
    </div>
<form id="importform" method="post">
    <input id="fmpath" name="fileurl" type="hidden">
    <input id="fmname" name="filename" type="hidden">
</form>
<script>
     $(".download").live('click', function() {
        $('#fmpath').val($(this).attr('url'));
        $('#fmname').val($('.downname').text());
        $('#importform').form({
            url: Yii_baseUrl + '/upload/ftpdownload',
            success: function(data) {
                var result = eval('(' + data + ')');
                if (result.res == 0)
                    alert(result.msg)
            }
        });
        $('#importform').submit();
    });
</script>
<!--<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/datapicker.js"></script>-->
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/pap/jquery.coolautosuggest.js' ?>"></script>
<script>
$(function(){
	$('.all_nav').css({'border-radius':'4px'});
	$('ul.good span').css({'border-radius':'30px'});
	$('.msg_xx span').css({'border-radius':'60px'});
	$('.message span').css({'border-radius':'60px'});
	$('.good').find('li').live('click',function(){
		$(this).addClass('active').siblings().removeClass('active');
                var url=Yii_baseUrl+'/pap/privatemsg/msg';
                var sessionid=$(this).attr('key');
                var touserid=$(this).attr('touserid');
                $.ajax({
                    url: url,
                    type:'POST',
                    data:{'sessionid': sessionid,'touserid':touserid},
                    dataType:'html',
                    success:function(data){
                      $('#msgs').html(data);
                      $('.somebody').scrollTop($('.messages').height());
                    }
                });
            });
	$('.good').find('li').eq(0).trigger('click');
          //机构搜索
        $("#searchorgans").coolautosuggest({
            url: Yii_baseUrl + '/chat/chatorgan?chars=',
            onSelected: function(res) {
               if(res){
                   history(res);
               }
            },
            onUpDown: function() {
            }
        });
        function history(obj) {
        var id = obj.id;
        var img = obj.img;
        var name = obj.name;
        var curuserid = <?php echo Yii::app()->user->id; ?>;
        var sessionid = curuserid > id ? id + "_" + curuserid : curuserid + "_" + id;
       // if ($('#' + sessionid).length <= 0) {
            var li = "<li class='i_one active' key='" + sessionid + "' touserid='" + id + "'><span  class='headimg' style='float:left'><img src='" + img + "'/></span><a title='" + name + "'>" + name + "</a></li>";
            $('.good').html(li);
            $('.good').find('.active').trigger('click');
            $(".all_nav").html("<li><span>您要查找:</span> <span class='backss'style='padding-left:123px;cursor:pointer;font-weight:400;color:#f27300'>返回</span></li>");
    }
    $('.backss').live('click',function(){
       var url=Yii_baseUrl+'/pap/privatemsg/closed';
       $.ajax({
           url:url,
           type:'POST',
           data:{},
           dataType:'html',
           success:function(data){
               if(data){
                   $('.good').html(data); 
                   $(".all_nav").find('li :eq(0)').html('<li>最近对话:</li>');
                   $('.good').find('li').eq(0).trigger('click');
                   $('.backss').hide();
                }
           }
       })
    })
     
});


</script>