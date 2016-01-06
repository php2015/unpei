<p class="mbx mbx4">
    <span style="margin-left:25px">订单号：</span><span><?php echo $data->OrderSN ?></span>
    <span style="margin-left:25px">下单时间：<?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span>
    <span style="margin-left:25px"><?php echo $data->BuyerName ?></span>
</p>

<div class="sp_div">
    <?php if ($data->goodsinfo):$count = count($data->goodsinfo); ?>
        <ul class="splb_order float_l  tb_head m_left">
            <?php foreach ($data->goodsinfo as $v): ?>
                <li style="height:auto">
                    <div class="div_img float_l m-top">
                        <a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                            <?php if (!$v['ImageUrl']): ?>
                                <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="90px" height="90px" style="margin-top:20px">
                            <?php else: ?>
                                <img src="<?php echo F::uploadUrl() . $v['ImageUrl']; ?>" width="90px" height="90px" style="margin-top:20px">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="div_info float_l m_left m-top">
                        <p class="goods_name cut">
                            <a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                                <?php echo $v['GoodsName']; ?>
                            </a>
                        </p>
                        <p class="m-top5 goods_attr"><span class='goods_side'>商品编号：</span>
                            <span class="zwq_color goods_num cut" title='<?php echo $v['GoodsNum'] ?>'><?php echo $v['GoodsNum'] ?></span>
                            <span class='goods_side'>&nbsp;|&nbsp;品牌：<?php echo $v['Brand'] ?></span>
                        </p>
                        <p class="m-top5 goods_attr">标准名称：<span><a title="<?php echo $v['CpName'] ?>"><?php echo $v['CpName'] ?></a></span></p>
                        <p class="m-top5 goods_attr">配件档次：<span><a title="<?php echo $v['PartsLevelName'] ?>"><?php echo $v['PartsLevelName'] ?></a></span></p>
                        <p class="m-top5 goods_attr">定位车型：<span><a title="<?php echo $v['Carmodeltxt'] ?>"><?php echo $v['Carmodeltxt'] ?></a></span></p>
                        <p class="m-top5 goods_attr cut">OE号：<span><a title="<?php echo $v['GoodsOE'] ?>"><?php echo $v['GoodsOE'] ?></a></span> </p>
                    </div>
                    <?php if ($v['Price'] != $v['ProPrice']): ?>
                        <div class="pricett float_l zwq_color">
                            <div class="ck_price">￥<?php echo $v['Price'] ?></div>
                            <div class="pro_price">￥<?php echo $v['ProPrice'] ?></div>
                        </div>
                    <?php else: ?>
                        <div class="price float_l zwq_color">
                            ￥<?php echo $v['ProPrice'] ?>
                        </div>
                    <?php endif; ?>
                    <div class="shuliang float_l"><?php echo $v['Quantity'] ?></div>
                    <div class="pn float_l">
                        <input type="text" class="pn_input" name='PN[]' value='按逗号分隔' size='15' onfocus='delstr(this)'
                               onblur='pnblur(<?php echo $v['ID'] ?>, this)' onkeyup='pnkeyup(<?php echo $v['ID'] ?>,<?php echo $v['Quantity'] ?>, this)'>
                        <span class="pn_span" style="color:red;padding-left:12px"></span>
                        <input type="hidden" name="goods_id[]" value="<?php echo $v['ID'] ?>">
                    </div>
                </li>  
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="float_l goods_show" style="height:<?php echo $count * 100 ?>px">

        <div class="goods_show1"><div class="zwq_color m_top20">￥<?php echo $data->RealPrice ?></div></div>

    </div>
    <div style="clear:both"></div>
</div>