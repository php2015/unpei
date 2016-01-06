<style>
    .tj_img img{ text-align:center; vertical-align:middle;margin:0 auto;*margin-top:-145px;max-width:200px;}
    .tj_img img{max-height:190px;}
    .img_box{ display: block}
</style>
<p class="dnss">店长推荐</p>
<div class="dztj">
    <?php if ($goods):?>
        <?php foreach ($goods as $data): ?>
            <div class="dztj_info">
                <div class="tj_img img_box"><a href="<?php echo Yii::app()->createUrl('pap/mall/detail', array('goods' => $data['ID'])); ?>" target="_black"><img src="<?php echo $data['image']; ?>"></a></div>
                <div class="tj_name"><a href="<?php echo Yii::app()->createUrl('pap/mall/detail', array('goods' => $data['ID'])); ?>" title="<?php echo $data['Name']; ?>" target="_black"><?php echo $data['Name']; ?></a></div>
                <div class="tj_price"><span>￥<?php echo  sprintf('%.2f',$data['ProPrice']); ?></span></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="dztj_info">
            暂无推荐
        </div>
    <?php endif; ?>
</div>
<div class="dztj"></div>