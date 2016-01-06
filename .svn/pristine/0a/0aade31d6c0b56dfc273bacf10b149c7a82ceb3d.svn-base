<style>
.w140{width:140px}
.w40{width:40px}
.float_l{ float:left}
.kf-contact{ position:relative; border-left:1px solid #f27300; background:#fffae7; padding-bottom:10px; min-height:200px; display:none}
.bor-rad{ position:absolute}
.bor-rad1{ top:-1px; left:-1px; background:url('<?php echo Yii::app()->theme->baseUrl."/images/phonecall/bor-top.png" ?>') no-repeat; height:8px; width:100%}
.bor-rad2{ top:-2px; right:-5px}
.bor-rad3{ bottom:-1px; left:-1px}
.bor-rad4{ bottom:-1px; right:-1px}
.bor-rad5{ background:url('<?php echo Yii::app()->theme->baseUrl."/images/phonecall/bor-r.png" ?>') repeat-y; width:9px; right:-6px; display:block;top:6px; bottom:1px}
.bor-rad6{ background:url('<?php echo Yii::app()->theme->baseUrl."/images/phonecall/bor-b.png" ?>'); height:9px; width:100%; display:block; left:-1px; bottom:0px}
.qq-info a{ display:block; background:url('<?php echo Yii::app()->theme->baseUrl."/images/phonecall/qq-bg.png" ?>'); width:80px; height:21px; line-height:21px; color:#bf5d15; font-size:12px; text-decoration:none; text-align:center}
.clear{clear:both; height:0px}
.m_left10{ margin-left:10px}
.kf-qq{ padding-bottom:10px; min-height:50px}
.kf .w110{width:110px; margin:0 10px}
.kf .w120{width:120px; margin:0 10px}
.kf .w130{width:130px; margin:0 10px}
.bor-dashed{height:1px; border-bottom:1px dashed #f27300; }
.kf-info{ font-size:14px; color:#0164c1; font-weight:bold; line-height:30px}
.m_left5{ margin-left:5px}
.kf-time{ font-size:12px; color:#666}
.kf-click{ position:relative; z-index:2; margin-left:-6px;cursor:pointer; margin-top:30px}
.left1{ display:none}
.kf{ margin:0 ; padding:0; position: fixed; top:200px;right:0px;z-index:101;}
</style>

<div class="kf">
   <div class="w140 float_l kf-contact">
     <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/phonecall/girl.png">
     <em class="bor-rad bor-rad1"></em>
     <em class="bor-rad bor-rad5"></em>
     <em class="bor-rad bor-rad6"></em>
     <div class="kf-qq"> 
         <?php if($datainfo):?>
         <?php foreach ($datainfo as $QQ => $name):?>
          <div class="w110" style="margin-bottom:10px">
             <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/phonecall/qq.png" class="float_l" style="margin-top:2px">
             <div class="qq-info float_l m_left10"><a title="点击这里给我发消息" target="_blank" href="<?php echo ' http://wpa.qq.com/msgrd?v=3&uin='.$QQ.'&site=qq&menu=yes;'?>"><?php echo $name;?></a></div>
             <div class="clear"></div>
          </div>
         <?php endforeach;?>
         <?php endif;?>
              
      </div>
     <p class="bor-dashed w110"></p>
     <div class="kf-tel w130">
       <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/phonecall/tel.png" class="float_l" style="margin-top:7px">
       <div class="kf-info float_l m_left5"><?php echo $phoneinfo?$phoneinfo:'400-0909-839';?></div>
       <div class="clear"></div>
     </div>
      <p class="kf-time w120">服务时间：<?php echo $datetimeinfo?$datetimeinfo:'9:00-18:00';?></p>
     </div>
  
   <div class="w40 float_l kf-click">
      <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/phonecall/left3.png" class="left2">
      <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/phonecall/left2.png" class="left1">
   </div>
</div>
<script type="text/javascript"> 
$(document).ready(function() {
	$(".kf").mouseover(function(){
	$(".kf-contact").css("display","block");
	$(".left1").css("display","block");	;
	$(".left2").css("display","none");	
	$(this).css("width","180px");	
		});
	$(".kf").mouseout(function(){
	$(".kf-contact").css("display","none");
	$(".left1").css("display","none");	;
	$(".left2").css("display","block");
	$(this).css("width","37px");	
		});
	
	});
</script>