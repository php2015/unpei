<?php
$this->pageTitle=Yii::app()->name.' - 首页';

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/flash/js/jquery.KinSlideshow-1.2.1.min.js');
?>
<script type="text/javascript">
    var moveStyle
    var rand =parseInt(Math.random()*4)
    switch(rand){
        case 0:	moveStyle="left" ;break;
        case 1:	moveStyle="left" ;break;
        case 2:	moveStyle="left" ;break;
        case 3:	moveStyle="left" ;break;   
    }
    
    $(function(){
        $("#KinSlideshow1").KinSlideshow({
            moveStyle:moveStyle,
            titleBar:{titleBar_height:30,titleBar_bgColor:"",titleBar_alpha:0.5},
            titleFont:{TitleFont_size:12,TitleFont_color:"#FFFFFF",TitleFont_weight:"normal"},
            btn:{btn_bgColor:"#FFFFFF",btn_bgHoverColor:"#FF5500",btn_fontColor:"#000000",
                btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#cccccc",
                btn_borderHoverColor:"#FF5500",btn_borderWidth:1}
        });
    })
</script>

<!-- 广告信息 -->
<div class='width998 content-rows auto_height'>
     <?php $this->widget('widgets.default.WAd'); ?>
</div>

<!-- 产品中心 -->
<div class='width998 content-rows auto_height'>
     <?php $this->widget('widgets.default.WProductCenter'); ?>
</div>