
    <div class=" float_l c-tools w95">
        <?php 
        if(!empty($menu)&&is_array($menu)):
         foreach($menu as $key=>$menus):
          foreach($menus['children'] as $sk=>$sv):
            if($sv['type']==0){
                continue;
            }
        ?>
       
            <div class="c-icon">
                <a href="<?php echo Yii::app()->createUrl($sv['url']);?>"><img src="<?php echo F::uploadUrl() ?>common/frontmenu/<?php echo $sv['icon']?>">
                <p><?php echo $sv['name']?></p> </a>
<!--                <div class="mess">99+</div>-->
            </div> 
       
        <?php endforeach;endforeach;endif;?>
        <div class="c-tools-img"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/c-tools.jpg"></div>
    </div>
