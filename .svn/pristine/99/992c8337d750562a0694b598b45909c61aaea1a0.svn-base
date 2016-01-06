<div class="content2a">
    <div class="content2a_img float_l">
        <ul id="img">
            <li><a href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/hot.jpg" width="585" height="155" /></a></li>
         <li><a href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/hot.jpg" width="585" height="155" /></a></li>
            <li><a href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/hot.jpg" width="585" height="155" /></a></li>
               <li><a href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/hot.jpg" width="585" height="155" /></a></li>
                  <li><a href="javascript:;"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/hot.jpg" width="585" height="155" /></a></li>
        </ul>
        <ul id="num">
            <li  class="hover">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li>5</li>
        </ul>
    </div>
    <div class="content2a_gg float_r">
        <p class="gg_lm">最新促销商品</p>
        <ul>
            <?php if ($isprogoods): ?>
                <?php foreach ($isprogoods as $value): ?>
                    <li>·<a href="<?php echo yii::app()->createUrl('pap/mall/detail', array('goods' => $value['ID'])) ?>" target='_blank'><?php echo $value['Name'] ?></a></li>
                <?php endforeach; ?>
            <?php else: ?>
                暂无促销商品
            <?php endif; ?>
        </ul>
    </div>
    <div style="clear:both"></div>
</div>