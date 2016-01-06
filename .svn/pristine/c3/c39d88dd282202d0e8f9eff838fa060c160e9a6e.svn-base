<?php if (count($data->goodsinfo) > 0): ?>
    <div class="border">
        <p class="mbx mbx4">
            <input type="checkbox" class="checkbox m_left12 f_weight" name="check[]" id="o<?php echo $data->ID ?>">&nbsp;
            <span class=""><?php echo date('Y年m月d日', $data->CreateTime) ?></span>
            <span style="margin-left:20px">订单号：</span><span><?php echo $data->OrderSN ?></span>
            <?php
            if ($data->BuyerName) {
                $BuyerName = $data->BuyerName;
            } else {
                $BuyerName = Organ::model()->findByPk($data->BuyerID, array('select' => 'OrganName'))->attributes['OrganName'];
            }
            ?>
            <span class="m_left40"><?php echo $BuyerName; ?></span>
        </p>
        <div class="sp_div">
            <?php if ($data->goodsinfo):$count = count($data->goodsinfo); ?>
                <ul class="splb_order float_l  tb_head m_left5">
                    <?php foreach ($data->goodsinfo as $v): ?>
                        <li style='height:130px'>
                            <div class="div_img float_l m-top">
                                <a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                                    <?php if (!$v['ImageUrl']): ?>
                                        <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="90px" height="90px" style="margin-top:10px">
                                    <?php else: ?>
                                        <img src="<?php echo F::uploadUrl() . $v['ImageUrl']; ?>" width="90px" height="90px" style="margin-top:10px">
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
                                <p class="goods_attr">标准名称：<span><a title="<?php echo $v['CpName'] ?>"><?php echo $v['CpName'] ?></a></span></p>
                                <p class="goods_attr cut">配件档次：<span><a title="<?php echo $v['PartsLevelName'] ?>"><?php echo $v['PartsLevelName'] ?></a></span> </p>
                                <p class="goods_attr cut">定位车型：<span><a title="<?php echo $v['Carmodeltxt'] ?>"><?php echo $v['Carmodeltxt'] ?></a></span> </p>
                                <p class="goods_attr cut">OE号：<span><a title="<?php echo $v['GoodsOE'] ?>"><?php echo $v['GoodsOE'] ?></a></span> </p>
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
                        </li>  
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="float_l goods_show" style="height:<?php echo $count > 1 ? $count * 135 + 1 : $count * 135 ?>px;min-height:135px">
                <div class="goods_show1 float_l">
                    <div class="zwq_color m_top20">￥<?php echo $data->RealPrice ?></div>
                </div>
                 <?php
                        $return = PapReturnGoods::model()->findAll('OrderID=:orderid', array(':orderid' => $data['ID']));
                          foreach($return as $key=>$value){
                           $return['ReturnID']=$value['ReturnID'];
                        }
                        if ($return) {
                            $returnorder = PapReturnOrder::model()->findByPk($return['ReturnID']);
                        }
                        ?>
                <div class="goods_show2 float_l">
                    <div class="m-top5">
                        <div>
                            <?php if ($data->Payment == 1): ?>
                                支付宝担保
                            <?php elseif ($data->Payment == 2): ?>
                                物流代收款
                            <?php endif; ?>
                        </div>
                        <div class="m_top7"><span class="order_status">
                            <?php echo SellerorderService::showOrderStatus($data->Status, $data->ReturnStatus) ?>
                         </span></div>
                         <?php if (in_array($data->ReturnStatus, array(1, 2, 3)) && $returnorder['Status'] == 5 && $returnorder['ComplainStatus'] == 1): ?>
                            <p class="order_status">（申诉处理中）</p>
                        <?php elseif (in_array($data->ReturnStatus, array(1, 2, 3)) && $returnorder['Status'] == 5 && $returnorder['ComplainStatus'] == 2): ?>
                            <p class="order_status">（申诉已处理）</p>
                        <?php else: ?>
                        <?php if (in_array($data->ReturnStatus, array(1, 2, 3))): ?>
                            <div class="m_top7"><span class="order_status">(退货中)</span></div>
                        <?php elseif (in_array($data->ReturnStatus, array(4))): ?>
                            <div class=" m_top7"><span class="order_status">(退货完成)</span></div>
                        <?php elseif (in_array($data->ReturnStatus, array(11))): ?>
                            <div class=" m_top7"><span class="order_status">(退款中)</span></div>
                        <?php elseif (in_array($data->ReturnStatus, array(14))): ?>
                            <div class=" m_top7"><span class="order_status">(退款完成)</span></div>
                        <?php endif;endif; ?>
                        <div style="position:relative;padding-top:7px;" onmouseleave="closeinfo(<?php echo $data->ID ?>)" >
                            <div class="mouse_div" style="width:100%;height:15px;cursor:pointer" onmouseover="showinfo(<?php echo $data->ID ?>)">订单跟踪</div>
                            <div class="show-msg" id="follow<?php echo $data->ID ?>">
                            </div>
                        </div>
                        <div class="m_top7"><a href="<?php echo Yii::app()->CreateUrl('pap/sellerorder/detail', array('ID' => $data->ID)) ?>" class="order_detail">订单详情</a></div>
                    </div>
                </div>
                <div class="goods_show3 float_l">
                    <?php if ($data->Status == 1 || $data->Status == 2): ?>
                        <p class="m-top"><a href="<?php echo yii::app()->createUrl('pap/Sellerorder/orderexport', array('ID' => $data->ID)) ?>"  class="order_print">发货单打印</a></p>
                        <?php if (!$data->AlipayTN): ?>
                            <p class=" m-top "><a class="change"  order="<?php echo $data->ID ?>" >订单改价</a></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($data->Status == 2): ?>      
                        <p class=" m-top"><a class="send"  order="<?php echo $data->ID ?>" >订单发货</a></p>
                    <?php elseif ($data->Status == 3 && $data->ReturnStatus == 0): ?>
                        <p class=" m-top "><a class="editsend"  order="<?php echo $data->ID ?>" >发货编辑</a></p>
                    <?php elseif ($data->Status == 9): ?> 
                        <?php if ($data->EvaStatus == 0 || $data->EvaStatus == 15): ?>                                                                                                                                                                            
                            <p class="m-top">  
                                <a class="eval" onclick="papeva(<?php echo $data->ID ?>,<?php echo $data->EvaStatus ?>,<?php echo $data->Status ?>,<?php echo $data->BuyerID ?>)">评价</a>
                            </p>
                        <?php elseif ($data->EvaStatus == 0 || $data->EvaStatus == 20): ?>
                            <div class="m-top5">已评价</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
<?php endif; ?>
