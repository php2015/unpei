<div id="KinSlideshow1" style="visibility:;">
    <?php 
    foreach($this->getAds() as $ad){
      echo $ad->getImage();  
    }
    ?>
</div>
<!-- 
<div>
	<img src="<?php //echo Yii::app()->theme->baseUrl?>/images/login-adv-bannar-standby.png">
</div>
 --> 
