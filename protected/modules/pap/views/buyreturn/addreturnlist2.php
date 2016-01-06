<?php if (count($data->goods) > 0): ?>
    <style>
        .border{border:1px solid #ebebeb; margin-top:10px}
        .border:hover{ border:1px solid #bbb}
        .splb_order li{height: 150px;}
    </style>
    <div class="border">
        <p class="mbx mbx4">
            <!--<input type="checkbox" class="checkbox m_left12 f_weight" name="return_check[]" order="<?php echo $data->ID ?>">-->
            <span>&nbsp;&nbsp;下单时间：</span> <?php echo date('Y年m月d日', $data->CreateTime) ?>
            <span  class="m_left20">订单编号：</span><span><?php echo $data->OrderSN ?></span>
            <span  class="m_left20">支付方式：</span>
            <span>
                <?php
                if ($data->Payment == 2) {
                    echo '物流代收款';
                } elseif ($data->Payment == 1) {
                    echo '支付宝担保交易';
                }
                ?></span>
            <span class="m_left20">经销商名称：</span>
            <span><?php echo ReturnorderService::idgetname($data->SellerID) ?></span>
        </p>

        <div style="">
            <?php if ($data->goods):$count = count($data->goods); ?>
                <ul class="splb_order float_l  tb_head m_left5">
                    <?php foreach ($data->goods as $v): ?>
                        <?php
                        $goods = DealergoodsService::getmongoversion($v['GoodsID'], $v['Version']);
                        if ($goods) {
                            $v['GoodsName'] = $goods['GoodsInfo']['Name'];
                            if (is_array($goods['GoodsInfo']['img']) && !empty($goods['GoodsInfo']['img']))
                                $v['ImageUrl'] = $goods['GoodsInfo']['img'][0]['ImageUrl'];
                            $v['GoodsNum'] = $goods['GoodsInfo']['GoodsNO'];
                            $v['Brand'] = $goods['GoodsInfo']['Brand'];
                            $v['PartsLevelName'] = $goods['GoodsInfo']['PartsLevelName'];
                            $v['CpName'] = Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['GoodsInfo']['StandCode']}'"))->attributes['Name'];
                            if (is_array($goods['GoodsInfo']['oeno']) && !empty($goods['GoodsInfo']['oeno'])) {
                                $oe = '';
                                foreach ($goods['GoodsInfo']['oeno'] as $vv) {
                                    if ($vv)
                                        $oe.=$vv . ',';
                                }
                                $v['GoodsOE'] = substr($oe, 0, -1);
                            }
                        }
                        ?>
                        <li>
                            <div class="div_img float_l m-top">
                                <a class="order_goods" title="<?php echo ReturnorderService::idgetgoodsinfo($v['OrderID'], $v['GoodsID'], 'GoodsName'); ?>" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>" 
                                   target='_blank' version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>" order="<?php echo $data->ID ?>">
                                       <?php
                                       if ($v['ImageUrl']) :
                                           ?>
                                        <img src="<?php echo F::uploadUrl() . $v['ImageUrl'] ?>" width="80px" height="80px">
                                    <?php else: ?>
                                        <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="80px" height="80px">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="div_info float_l m_left m-top" >
                                <p style="width:270px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                                    <a class="order_goods" target='_blank' href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>" 
                                       title="<?php echo $v['GoodsName'] ?>" version="<?php echo $v['Version'] ?>" order="<?php echo $data->ID ?>">
                                        <b style="font-size:14px"><?php echo $v['GoodsName'] ?></b>
                                    </a>
                                </p>
                                <p class="m-top5">商品编号：<span class="zwq_color"><?php echo $v['GoodsNum'] ?></span> | 品牌：<span><?php echo $v['Brand']; ?></span></p>
                                <p class="m-top5" style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">标准名称：<span><?php echo $v['CpName'] ?></span> | 拼音代码：<span><?php echo DealergoodsService::idgetgoods($v['GoodsID'], 'Pinyin'); ?></span><!--<span>备注:<?php echo DealergoodsService::idgetgoods($v['GoodsID'], 'Memo'); ?></span>  -->
                                    <?php
                                    $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $v['OrderID'], ":GoodsID" => $v['GoodsID']));
                                    ?>
                                <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                <p class="m-top5">配件档次：<span><?php echo $v['PartsLevelName'] ?></span></p>
                                <p class="m-top5" style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"> OE号：<span><?php echo $v['GoodsOE'] ?></span> </p>
                            </div>
                            <div class="price float_l zwq_color">
                                <?php if ($v['ProPrice'] && $v['ProPrice'] != $v['Price']): ?>   <!-- 有优惠价且优惠价与参考价不相等时 -->
                                    <div >
                                        <span style="color:#eb7616">￥<?php echo $v['ProPrice']; ?></span>
                                    </div>
                                <?php else: ?>
                                    <div>
                                        <span style="color:#eb7616">￥<?php echo $v['Price']; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="shuliang float_l"><?php echo $v['Quantity'] ?></div>
                        </li>  
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
    <!--            <div class="float_l goods_show" style="height:<?php //echo $count * 100   ?>px;min-height:100px;width:260px" >-->
            <div class="float_l   goods_show" style="height:<?php echo $count > 1 ? $count * 150 + 1 : $count * 150 ?>px;min-height:150px"> 
                <div class="float_l goods_show1" style="text-align:center; width:120px;">
                    <div class="price zwq_color " style="margin-top:40px">￥<?php echo $data->RealPrice ?></div></div>
                <div class="float_l div_caozuo goods_show2" style="text-align:center; width:135px">
                    <div class="order_caozuo" style="margin-top:40px">
                        <button class="button button2" style="width:65px" onclick="onaudit('<?php echo $data->ID ?>')">申请退款</button>
                        <!--<div> <a href="<?php //echo Yii::app()->CreateUrl('pap/buyreturn/orderinfo', array('ID' => $data->ID))                                              ?>">订单详情</a></div>-->
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
            <div style="clear:both"></div>
        </div></div>
    <script>
        function onaudit(ID) {  //申请退款
            var url = Yii_baseUrl + '/pap/buyreturn/returngoods2/ID/' + ID;
            window.location.href = url;
        }
    </script>
<?php endif; ?>
