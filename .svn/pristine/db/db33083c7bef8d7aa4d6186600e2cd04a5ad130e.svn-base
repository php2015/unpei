<?php if (count($data['goodsinfo']) > 0): ?>
    <div class="border">
        <p class="mbx mbx4">

            <input <?php if (!$data['InOrder']) echo 'name="subBox"';?> type="checkbox" class="checkbox m_left12 f_weight"> 
            <?php echo date('Y年m月d日', $data['CreateTime']) ?>
            <span>车牌号：</span><span><?php echo $data['LicensePlate']; ?></span>
            <span>预约号：</span><span><?php echo $data['ReserveNum']; ?></span>
        </p>

        <div style="">
            <ul class="splb_order float_l  tb_head m_left5">
                <?php
                $count = count($data['goodsinfo']);
                $pid = '';
                foreach ($data['goodsinfo'] as $k => $v):
                	$pid .= $v['purchaseID'].",";
                    ?>
                    <li>
                        <div class="div_img float_l m-top">
                            <a title="<?php echo $v['GoodsName'] ?>" href="<?php echo $data['InOrder']?Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'],'order' => $v['OrderID'])):Yii::app()->CreateUrl('pap/mall/detail', array('goods' => $v['GoodsID'])) ?>" target='_blank'>
                                <?php if (isset($v['ImageUrl']) && !empty($v['ImageUrl'])) { ?>
                                    <img src="<?php echo Yii::app()->baseUrl . '/upload/' . $v['ImageUrl'] ?>" width="80px" height="80px">
                        <?php } else { ?>
                            <img src="<?php echo F::baseUrl() . '/upload/dealer/default-goods.png'; ?>" width="80px" height="80px">
                        <?php } ?>
                        </a></div>
                        <div class="div_goodsinfo float_l m_left m-top">
                            <p class="goods_name cut width220"><a title="<?php echo $v['GoodsName'] ?>" href="<?php echo $data['InOrder']?Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'],'order' => $v['OrderID'])):Yii::app()->CreateUrl('pap/mall/detail', array('goods' => $v['GoodsID'])) ?>"
                                                                  target='_blank'><?php echo $v['GoodsName'] ?></a></p>
                            <div class="m-top5 goods_attr"><div class="float_l cut width150">商品编号：<span class="zwq_color"><a title="<?php echo $v['GoodsNum'] ?>"><?php echo $v['GoodsNum'] ?></a></span></div><div class="float_l" style="margin-left:10px;margin-right:10px">|</div> <div>品牌：<span><?php echo $v['BrandName'] ?></span></div></div>
                            <p class="m-top5 goods_attr">标准名称：<span><a title="<?php echo $v['CpName'] ?>"><?php echo $v['CpName'] ?></a></span></p>
                            <div class="m-top5 goods_attr"><div class="float_l cut width150"> OE号：<span><a title="<?php echo $v['GoodsOE'] ?>"><?php echo $v['GoodsOE'] ?></a></span></div> <div class="float_l" style="margin-left:10px;margin-right:10px">|</div> <div>经销商：<span><a title="<?php echo $v['OrganName'] ?>"><?php echo $v['OrganName']; ?></a></span></div> </div>

                        </div>
                        <div class="price float_l zwq_color">
                            <?php if ($v['ProPrice'] && $v['ProPrice'] != $v['Price']): ?>   <!-- 有优惠价且优惠价与参考价不相等时 -->
                                <?php if ($v['ProPrice'] && $v['ProPrice'] < $v['Price']): ?>
                                    <div style="height:14px;"><s>￥<?php echo $v['Price'] ?></s></div>
                                <?php endif; ?>
                                <div >
                                    <span style="color:#eb7616">￥<?php echo $v['ProPrice']; ?></span></div>
                            <?php else: ?>
                            	<?php if ($v['DisPrice'] && $v['DisPrice'] < $v['Price']): ?>
                                    <div style="height:14px;"><s>￥<?php echo $v['Price'] ?></s></div>
	                                <div style="width:50px;margin-left:17px;">
	                                	<span style="color:#eb7616">
	                                        	￥<?php echo $v['DisPrice']; ?>
	                                    </span>
	                                </div>
	                            <?php else: ?>
	                            	<div style="width:50px;margin-left:17px;">
	                                	<span style="color:#eb7616">
	                                        	￥<?php echo $v['DisPrice']; ?>
	                                    </span>
	                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="shuliang float_l" style="margin-left:30px"><?php echo $v['Quantity'] ?></div>

                    </li> 
                <?php endforeach;?>
            </ul>
            <?php //endif;    ?>
            <div class="float_l goods_show" style="height:<?php echo $count * 100 ?>px;min-height:100px">
                <div class="goods_show1 float_l"><div class="price m_top20"><span class="zwq_color">￥<?php echo $data['RealPrice']; ?></span></div></div>
                <div class="goods_show3 float_l">
                    <div class="order_caozuo m-top5" style="width:200px;">
                        <span style="">
                        <?php if (!$data['InOrder']){?>
                        	<p class='m-top'><a class='purchase_order_add pyp' key='<?php echo trim($pid,",");?>' target='_blank'>生成订单</a></p>
                        <?php }else {?>
                        	<p class='m-top'><a class='purchase_order_select pyp' target='_blank'>订单详情</a></p>
                        <?php }?>
                        </span>
                    </div>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
<?php endif; ?>