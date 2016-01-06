<p class="dnss">店内分类</p>
<div class="shop_fenlei">
    <?php if (!empty($cate) && is_array($cate)):foreach ($cate as $k => $v): ?>
            <p class="shop_fenlei2 <?php echo $v['BigpartsID'] == $bigid ? 'shop_fenlei3' : '' ?>"><span><?php echo $v['BigName'] ?></span></p>
            <div class="shop_fenlei_info" style="display:<?php echo $v['BigpartsID'] == $bigid ? 'block' : '' ?>">
                <ul>
                    <?php foreach ($v['children'] as $ve): ?>
                        <li><a href="<?php echo Yii::app()->createUrl('pap/sellerstore/index', array('dealerid' => $dealerid, 'sub' => $ve['ID'])) ?>" 
                               style="<?php echo $sub == $ve['ID'] ? 'color:#ec8051' : '' ?>"><?php echo $ve['Name'] ?></a></li>
                        <?php endforeach; ?>
                </ul>
            </div>
            <?php
        endforeach;
    else:
        ?>
        <p style="text-indent:5px;background:none">暂无分类</p>
    <?php endif;
    ?>    
</div>