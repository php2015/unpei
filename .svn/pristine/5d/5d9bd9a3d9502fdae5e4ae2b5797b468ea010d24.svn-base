<div class="content1b">
    <p class="content1b_lm">一周销量排行</p>
    <ul class="rank">
        <?php if ($weekSales):foreach ($weekSales as $k => $v): ?>
                <li class="top <?php echo in_array($k, array(0, 1, 2)) ? 'top1' : 'top4' ?>">
                    <span><?php echo $k + 1; ?></span>
                    <div class="rank_img" <?php echo $k == 0 ? 'style="display:block"' : ''; ?>>
                        <?php if ($v['ImageUrl']): ?>
                            <img src="<?php echo F::uploadUrl() . $v['ImageUrl']; ?>">
                        <?php else: ?>
                            <img src="<?php echo F::uploadUrl() . 'dealer/default-goods.png'; ?>" width="50">
                        <?php endif; ?>
                    </div>
                    <div class="<?php echo $k == 0 ? 'rank_name_current' : 'rank_name' ?>">
                        <a href="<?php echo yii::app()->createUrl('pap/mall/detail', array('goods' => $v['GoodsID'])) ?>" title="<?php echo $v['Name'] ?>" target="_blank" class="tj_name">
                            <?php echo $v['Name'] ?>
                        </a>
                    </div>
                    <div class="rank_price" <?php echo $k == 0 ? 'style="display:block"' : ''; ?>>
                        ￥<?php echo $v['IsPro'] == 1 && $v['ProPrice'] ? $v['ProPrice'] : $v['Price'] ?></div>
                    <div style="clear:both"></div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            暂无销量排行
        <?php endif; ?>
    </ul>
</div>