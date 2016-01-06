<?php 
$this->pageTitle=Yii::app()->name.' - 支付失败';
?> 
<script src="<?php echo F::themeUrl().'/js/jquery.js'?>"></script>
  <div class="paysuc" style=" border:3px solid #e1e1e1; height: 350px; background:white; ">           
      <div class="pay_img" style="width:30%; height:100px; margin-top:30px; margin-left: 200px;">
          <img src="<?php echo F::themeUrl()?>/images/images/pay_success.jpg" style="float:left;display: block; margin-top: 50px;"/>
          <span style="float:left;display: block; margin-top: 55px; margin-left: 12px;color:#FF6600; font-family: '微软雅黑'; font-size: 20px">支付失败!</span>
      </div>
      
      <!-- 
      <div class="pay_goods" style="width:55%; height:55px;border-bottom:2px solid #e1e1e1; margin-left: 250px">
          <b><p style="color:#686868;font-size: 12px;">经销商:<?php //echo $order_info['SellerName'];?></p></b>
          <br />
          <p><span style="float:left;display:block;width:150px;color:#595959">订单名称:<?php ///echo $order_info['OrderName'];?></span><span style="float:left;display:block;width:150px;color:#595959">订单编号:<?php //echo $order_info['ID']?></span><a href="<?php //echo $redirectUrl;?>" style="color:#3EB03F">[订单详情]</a></p>
      </div>
       -->
      <div class="pay_error" style="width:55%; height:55px;border-bottom:2px solid #e1e1e1; margin-left: 250px">
      	  <b><p style="color:#686868;font-size: 12px;">错误信息:<span style="margin-left: 12px;color:#FF6600; font-family: '微软雅黑';"><?php echo $msg;?></span></p>
      	  </b>
      	  
      </div>
      <div class="pay_time" style=" width: 30%; margin: 0 auto; margin-top: 30px">
          <p><span class="timer" style="font-size:20px;color:#ff6600;margin-left:60px;float: left;display: block;">10</span><b><span style="color:#565656;float: left;display: block;margin:4px 0 0 5px; font-size: 14px">秒后将跳转到订单列表页面</span></b></p>
          <div style=" clear: both;height: 30px;"></div>
          <span style="margin-left:115px;"><input type="image" src="<?php echo F::themeUrl()?>/images/images/tiaozhuan.jpg" onclick="javascript:location.href='<?php echo $redirectUrl;?>'"/></span>
      </div>
      
  </div>
<script>
    $(function(){
        var timerID = setInterval(function() { 
            var curtime = $(".timer").text();
            curtime = parseInt(curtime);
            curtime --;
            $(".timer").text(curtime);
            if(curtime == 0){
                clearInterval(timerID);
                window.location.href = "<?php echo $redirectUrl;?>"
            }
        }, 1000); 
    })
</script>