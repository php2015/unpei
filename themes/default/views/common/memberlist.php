<?php
$this->breadcrumbs = array(
    '会员中心',
);
?>
<style>
.aim{height:150px; width:150px; border:2px solid #f28422}
.arrow{height:150px; width:150px; background:url(<?php echo F::themeUrl()?>/images/home/images/heng.png) no-repeat center;margin:0px 15px}
.aim:hover{ box-shadow:0px 2px 5px #666;}
.aim_info{margin:20px}
.aim_img img{ vertical-align:middle;padding:0px 16px}
.aim_name{line-height:25px; text-align:center; margin-top:13px;font-size:14px;}
.aim_wz{margin-top:35px; text-align:center; line-height:20px}
.shu_arrow{height:80px}
.shu_arrow1,.shu_arrow2{width:360px;}
.shu_arrow1{background:url(<?php echo F::themeUrl()?>/images/home/images/s1.png) no-repeat right; height:80px}
.shu_arrow2{background:url(<?php echo F::themeUrl()?>/images/home/images/s2.png) no-repeat left; height:80px; margin-left:100px}
</style>
<div class="bor_back" style="height:600px;width:885px; margin:0 auto;margin-top: 10px">
  <div style="margin:50px 30px">
      <div class="first_line">
           <div class="float_l aim">
           <a href=" <?php echo Yii::app()->createUrl('servicer/servicecompany/index')?>"><div class="aim_info">
               <div class="aim_img"><img src="<?php echo F::themeUrl()?>/images/home/images/15.png"></div>
               <p class="aim_name f_weight">公司信息管理</p>
           </div>
           </a>
         </div>
         
           <div class="float_l aim" style="visibility:hidden">
           <a href="<?php echo Yii::app()->createUrl('member/infomanager/index')?>"><div class="aim_info">
               <div class="aim_img"><img src="<?php echo F::themeUrl()?>/images/home/images/3.png"></div>
               <p class="aim_name f_weight">会员信息管理</p>
           </div>
           </a>
         </div>
        <div class="float_l aim" >
           <a href="<?php echo Yii::app()->createUrl('member/infomanager/index')?>"><div class="aim_info">
               <div class="aim_img"><img src="<?php echo F::themeUrl()?>/images/home/images/3.png"></div>
               <p class="aim_name f_weight">会员信息管理</p>
           </div>
           </a>
         </div>
        
         
        
           <div class="float_l arrow" style="visibility:hidden">
            <p class="aim_wz">前市场车型</p>
         </div>
          <div class="float_l aim">
           <a href=" <?php echo Yii::app()->createUrl('member/finaccount/index')?>"><div class="aim_info">
               <div class="aim_img"><img src="<?php echo F::themeUrl()?>/images/home/images/jrzh.png"></div>
               <p class="aim_name f_weight">金融账户管理</p>
           </div>
           </a>
         </div>
        
      
        <div style="clear:both"></div>
      </div>
      <!--第一行结束-->
      <div class="shu_arrow" style="visibility:hidden">
        <div class="float_l shu_arrow1">
          <p style="text-align:right;margin-right:80px; line-height:80px">这里是文字</p>
        </div>
        <div class="float_l shu_arrow2">
          <p style="text-align:left;margin-left:80px; line-height:80px">这里是文字</p>
        
        </div>
        <div style="clear:both"></div>
      </div>
      <!--斜箭头结束-->
      <div class="first_line">
         <div class="float_l aim" style="visibility:hidden">
           <a href="<?php echo Yii::app()->createUrl('jpdata/parts/index')?>"><div class="aim_info">
               <div class="aim_img"><img src="<?php echo F::themeUrl()?>/images/home/images/1.png"></div>
               <p class="aim_name f_weight">配件查询</p>
           </div>
           </a>
         </div>
          <div class="float_l aim">
           <a href="<?php echo Yii::app()->createUrl('member/employee/index')?>"><div class="aim_info">
               <div class="aim_img"><img src="<?php echo F::themeUrl()?>/images/home/images/6.png"></div>
               <p class="aim_name f_weight">子帐户管理</p>
           </div>
           </a>
         </div>
        
         <div class="float_l arrow" >
            <p class="aim_wz">为子帐号分配权限</p>
         </div>
         
         <div class="float_l aim" >
           <a href=" <?php echo Yii::app()->createUrl('member/permission/index')?>"><div class="aim_info">
               <div class="aim_img"><img src="<?php echo F::themeUrl()?>/images/home/images/7.png"></div>
               <p class="aim_name f_weight">权限管理</p>
           </div>
           </a>
         </div>
          <div class="float_l arrow" style="visibility:hidden">
            <p class="aim_wz">前市场车型前市场车型前市场车型</p>
         </div>
        
      
    
     
        <div style="clear:both"></div>
      </div>
      
      
      
      
  
  </div>

</div>