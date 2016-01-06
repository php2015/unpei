<style>
    .mbx5{ background: #ffefe0; text-indent: 10px}
     .mbx5 b span{ color:#343434}
    .pjdj .price, .pjdj .shuliang, .pjdj .s_fukuan{ line-height: 28px}
    .pjdj li{ height: 28px; line-height: 28px }
    .pjdj{border-bottom:1px solid #facaa2}
    .pjdj .div_img{ width:280px}
    .pjdj .div_goodsinfo{ width:110px}
    .pjdj .goods_show{ border-right:1px solid #dbdbdb}
    .pjdj .splb_order{ width:682px}
    .pjdj .tb_head .price{ width:92px}
    .pjdj .tb_head .w100{ width:100px}
    .pjdj .tb_head .w59{ width:59px}
</style>

<?php 
    $count = count($data['partsinfo']);
    if ($count > 0): ?>
    <div class="border">
        <p class="mbx mbx5">
            <b><?php echo date('Y年m月d日', $data['CreateTime']) ?>
            <span>行驶里程数：</span><span><?php echo $data['Mileage']; ?>KM</span></b>
            <span style="float: right;margin-right: 10px;padding-top: 2px;margin-bottom: -5px;*margin-top:-30px">
                <a class="edit_part" style="cursor:pointer;" key="<?php echo $data['RecordID'];?>"><img src="<?php echo F::themeUrl(); ?>/images/support/edit.bmp" /></a>
                <a class="del_part" style="cursor:pointer;" key="<?php echo $data['RecordID'];?>"><img src="<?php echo F::themeUrl(); ?>/images/support/del.bmp" /></a>
            </span>
        </p>

        <?php foreach ($data['partsinfo'] as $key => $val):$count = count($val['info']) ?>
        <div class="pjdj" >
            <div class="float_l goods_show" style="height:<?php echo $count * 28 ?>px;min-height:28px ;width:200px;line-height:<?php echo $count * 28 ?>px; text-align:center">
                <div class="goods_show1 float_l"><div class="price m_top20"><span class="zwq_color"></span></div></div>
                <div class="goods_show3 float_l">
                    <div class="order_caozuo" style="width:200px;">
                        <span style="">
                        <?php echo $val['ItemName']; ?>
                        </span>
                    </div>
                </div>
            </div>
            <ul class="splb_order float_l  tb_head ">
                <?php
                foreach ($val['info'] as $k => $v):
                ?>
                    <li>
                        <div class="div_img float_l" style="width: 270px;display:block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                            <?php echo $v['GoodsName']?$v['GoodsName']:"-";?>
                        </div>
                        <div class="div_goodsinfo float_l m_left " style="width: 120px;display:block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                            <?php echo $v['GoodsNum']?$v['GoodsNum']:"-";?>
                        </div>
                        <div class="price float_l zwq_color" style="width: 92px;display:block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                            <?php echo $v['PartsLevel']?$v['PartsLevel']:"-"; ?>
                        </div>
                        <div class="price float_l zwq_color w100" style="width: 114px;display:block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                            <?php echo $v['Brand']?$v['Brand']:"-";?>
                        </div>
                        <div class="shuliang float_l w59" style="width: 75px;display:block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                            <?php echo $v['Num']?$v['Num']:"-";?>
                        </div>

                    </li> 
                <?php endforeach;?>
            </ul>
            <div style="clear:both"></div>
        </div>
        <?php endforeach;?>
    </div>
<?php endif; ?>