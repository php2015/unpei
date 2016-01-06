<!--头部导航工具栏-->
<div class="text-nav" >
    <div class="text-nav-info" >
        <div class="float_l index-nav">
            <?php if (Yii::app()->user->isServicer()): ?>
                <a href="<?php echo Yii::app()->createUrl('/pap/home/index') ?>">首页</a>
            <?php else: ?>
                <a href="<?php echo Yii::app()->createUrl('pap/sellerorder/index') ?>">首页</a>
            <?php endif ?>
        </div>
       
        <ul class="float_l text-nav-ul">
            <?php 
            if (!empty($nav) && is_array($nav)):
                foreach ($nav as $key => $v): ?>
                    <li key="<?php echo $v['iD']?>"><?php echo $v['name']; ?>
                        <div class="text-mk-info">
                            <?php 
                            if (!empty($v['children']) && is_array($v['children'])):
                            foreach ($v['children'] as $k => $cm): 
                            ?>      
                                        <div class="float_l second-icon" key="<?php echo $cm['iD']?>">
                                            <a href="<?php echo !empty($cm['url'])? Yii::app()->createUrl($cm['url']):'javascript:void(0)' ?>"><img src="<?php echo $cm['icon']?(F::uploadUrl().'common/frontmenu/'.$cm['icon']):''; ?>">
                                            <p><?php echo $cm['name']; ?></p> </a>
<!--                                                <div class="mess">99+</div>-->
                                        </div>
                                   
                                <?php 
                             endforeach;
                             endif;
                            ?>
                            <div class="clear"></div>
                        </div>
                    </li>
    <?php 
    endforeach;
    endif; 
    ?>
            <div class="clear"></div>
        </ul>
        <div class="clear"></div>
    </div>   
    <div class="clear"></div>
</div>
<?php
            $route =Yii::app()->controller->getRoute();
            if($route=='jpdata/vehicle/code'){
                $route='jpdata/vehicle/index';
            }
            $rootID =F::getroot();
            $activeMenu = FrontMenu::getMenuIDByRoute($route, $rootID);
        ?>
<script>
     var curid='<?php echo $activeMenu['ID']?>';
    $('.second-icon').each(function(){
        var menuid=$(this).attr('key');
        if(curid==menuid){
         var current=$(this).parent().parent();
          current.addClass('sj');
        }
    })

</script>