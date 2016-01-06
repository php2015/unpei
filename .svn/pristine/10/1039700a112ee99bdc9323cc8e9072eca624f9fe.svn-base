<li style="height:316px;position:relative">
    <div class="sp_info">
        <a href="<?php echo yii::app()->createUrl('pap/mall/detail', array('goods' => $data['ID'])) ?>" target='_blank'>
            <div class="sp_img img_box">
                 <?php if ($data['img']): ?>
            <img src="<?php echo F::uploadUrl(). $data['img'][0]['ImageUrl'] ?>" title="<?php echo $data['Name'] ?>" width="350px" height="350px">
        <?php else: ?>
            <img src="<?php echo F::uploadUrl() . 'common/goods-img-big.jpg' ?>" title="<?php echo $data['Name'] ?>" width="350px" height="350px">
        <?php endif; ?>
            </div>
        </a>

        <div style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
            <p style="width: 235px; white-space:nowrap;overflow: hidden;text-overflow:ellipsis">
                <a  href="<?php echo yii::app()->createUrl('pap/mall/detail', array('goods' => $data['ID'])) ?>" target='_blank' title="<?php echo $data['Name'] ?>"><?php echo $data['Name'] ?></a>
            </p>
        </div>
        <div class="sp_name">
            <span style="padding-left:20px;*margin-top:-15px;">销量：<?php echo $data['Sales'] ?></span>
            <span style="padding-left:20px;*margin-top:-15px;">评论数：<?php echo $data['CommentNo'] ? $data['CommentNo'] : 0 ?></span>
        </div>
        <p style="margin:5px 0 0 5px">
            <?php
            $PartsLevel = $data['PartsLevel'];
            echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无档次';
            ?>
        </p>
        <div class="sp_price">
            <?php if ($data['ppp'] != $data['Price']): ?>
                ￥<?php echo sprintf("%.2f", $data['ppp']); ?>
                <span style="padding-left:10px;*margin-top:-15px;">￥<?php echo sprintf("%.2f", $data['Price']) ?></span>
            <?php else: ?>￥<?php
            echo sprintf("%.2f", $data['ppp']);
        endif;
            ?>
        </div>
        <a title="添加到购物车" class="addgwc" style="cursor:pointer" goodsid="<?php echo $data['ID'] ?>">
            <img src="<?php echo F::themeUrl(); ?>/images/papmall/gwc.png" width="30" style="position:absolute;bottom:0;right:0" />
        </a>
    </div>
</li>