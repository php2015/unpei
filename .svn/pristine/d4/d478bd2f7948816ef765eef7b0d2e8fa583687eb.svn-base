<?php if (count($data->goodsinfo) > 0): ?>
    <div class="border">
        <p class="mbx mbx4">

            <input type="checkbox" class="checkbox m_left12 f_weight"> <?php echo date('Y年m月d日', $data->CreateTime) ?>
            <span>订单号：</span><span><?php echo $data->OrderSN ?></span><span class="m_left40"><?php echo $data->SellerName ?></span>
        </p>

        <div style="">
            <?php //if ($data->goods):$count = count($data->goods); ?>
            <ul class="splb_order float_l  tb_head m_left5">
                <?php
                $count = count($data->goodsinfo);
                foreach ($data->goodsinfo as $k => $v) {
                    ?>
                    <li style="height:130px">
                        <div class="div_img float_l m-top">
                            <a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>"
                               target='_blank' version="<?php echo $v['Version'] ?>" order="<?php echo $data->ID ?>">
                                   <?php
                                   if ($v['ImageUrl']) :
                                       ?>
                                    <img src="<?php echo F::uploadUrl() . $v['ImageUrl'] ?>" width="90px" height="90px" style="margin-top:15px">
                                <?php else: ?>
                                    <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="90px" height="90px" style="margin-top:15px">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="div_info float_l m_left m-top">
                            <p class="goods_name cut width220"><a  class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $v['GoodsID'])) ?>"
                                                                   target='_blank' version="<?php echo $v['Version'] ?>" order="<?php echo $data->ID ?>"><?php echo $v['GoodsName'] ?></a></p>
                            <div class="m-top5 goods_attr"><div class="float_l cut width100 " style="width:120px">商品编号：<span class="zwq_color"><a title="<?php echo $v['GoodsNum'] ?>"><?php echo $v['GoodsNum'] ?></a></span></div><div class="float_l" style="margin-left:10px;margin-right:10px">|</div> <div>品牌：<span><?php echo $v['Brand'] ?></span></div></div>
                            <p class="goods_attr">标准名称：<span><a title="<?php echo $v['CpName'] ?>"><?php echo $v['CpName'] ?></a></span></p>
                            <p class="goods_attr cut width220"> 配件档次：<span><a title="<?php echo $v['PartsLevelName'] ?>"><?php echo $v['PartsLevelName'] ?></a></span> </p>
                            <p class="goods_attr cut width220"> 定位车型：<span><a title="<?php echo $v['Carmodeltxt'] ?>" style='color:#0164c1'><?php echo $v['Carmodeltxt'] ?></a></span> </p>
                            <p class="goods_attr cut width220"> OE号：<span><a title="<?php echo $v['GoodsOE'] ?>"><?php echo $v['GoodsOE'] ?></a></span> </p>
                        </div>
                        <div class="price float_l zwq_color">
                            <?php if ($v['ProPrice'] && $v['ProPrice'] != $v['Price']): ?>   <!-- 有优惠价且优惠价与参考价不相等时 -->
                                <?php if ($v['ProPrice'] && $v['ProPrice'] < $v['Price']): ?>
                                    <div style="height:14px;"><s>￥<?php echo $v['Price'] ?></s></div>
                                <?php endif; ?>
                                <div >
                                    <span style="color:#eb7616">￥<?php echo $v['ProPrice']; ?></span></div>
                            <?php else: ?>
                                <div style="width:50px;margin-left:17px;"><span style="color:#eb7616">
                                        ￥<?php echo $v['Price']; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="shuliang float_l" style="margin-left:30px"><?php echo $v['Quantity'] ?></div>
                    </li> 
                <?php } ?>
            </ul>
            <?php //endif;          ?>
            <div class="float_l goods_show" style="height:<?php echo $count > 1 ? $count * 135 + 1 : $count * 135 ?>px;min-height:135px">
                <div class="goods_show1 float_l"><div class="price m_top20">
                        <?php 
                            $promo=OrderService::getHuodong($data->ID);
                           if(!empty($promo) &&($promo['Amount']!=0)): 
                        ?>
                        <s  style="color:#eb7616">￥<?php echo $data->GoodsAmount ;?></s><br>
                        <span><?php 
                        if(!empty($promo['CouponSn'])){
                           echo "<span class='pt10' style='color:#0164c1;font-size:12px'>(优惠券".$promo['Amount']."元)</span><br>";
                        }else if(!empty($promo['PromoID'])){
                             echo "<span class='pt10' style='color:#0164c1;font-size:12px'>(活动减免".$promo['Amount']."元)</span>";
                        }
                     
                        ?></span>
                        <?php endif;?>
                        <span class="zwq_color ">
                            ￥<?php echo $data->TotalAmount ?>
                        </span></div></div>
                <div class="goods_show2 float_l">
                    <div>
                        <?php if ($data['Payment'] == 2): ?>
                            <p class="order_status" style="padding-top:3px">物流代收款</p>
                        <?php endif; ?>
                        <?php if ($data['Payment'] == 1): ?>
                            <p class="order_status" style="padding-top:3px">支付宝担保</p>
                        <?php endif; ?>
                    </div>

                    <div class="m-top5">   
                        <!--方式一:支付宝担保交易,Payment=1：待付款-->
                        <?php if ($data->Payment == 1 && $data->Status == 1): ?>
                            <p class="order_status">待付款</p>
                        <?php endif ?>
                        <!--方式二:Payment=2：待发货-->
                        <?php if ($data->Status == 2): ?>
                            <p class="order_status">等待卖家发货</p>
                        <?php endif ?>
                        <!--方式三:Payment=3：待收货-->
                        <?php if ($data->Status == 3): ?>
                            <?php if ($data->ReturnStatus != 0 || in_array($data->PayStatus, array('WAIT_SELLER_AGREE', 'WAIT_BUYER_RETURN_GOODS', 'WAIT_SELLER_CONFIRM_GOODS', 'REFUND_SUCCESS'))): ?>
                                <p class="order_status">已拒收</p>
                            <?php else: ?>
                                <p class="order_status">卖家已发货</p>
                            <?php endif ?>
                        <?php endif; ?>

                        <!--方式四:Payment=9：已收货-->
                        <?php if ($data->Status == 9): ?>
                            <p class="order_status">交易成功</p>
                        <?php endif ?>

                        <!--方式四:Payment=10 交易取消-->
                        <?php if ($data->Status == 10): ?>
                            <p class="order_status">交易取消</p>
                        <?php endif ?>
                        <?php
                        $return = PapReturnGoods::model()->findAll('OrderID=:orderid', array(':orderid' => $data['ID']));
                        foreach ($return as $key => $value) {
                            $return['ReturnID'] = $value['ReturnID'];
                        }
                        if ($return) {
                            $returnorder = PapReturnOrder::model()->findByPk($return['ReturnID']);
                        }
                        ?>

                    </div>
                    <div class="m-top5">
                        <?php if (in_array($data->ReturnStatus, array(1, 2, 3)) && $returnorder['Status'] == 5 && $returnorder['ComplainStatus'] == 1): ?>
                            <p class="order_status">（申诉处理中）</p>
                        <?php elseif (in_array($data->ReturnStatus, array(1, 2, 3)) && $returnorder['Status'] == 5 && $returnorder['ComplainStatus'] == 2): ?>
                            <p class="order_status">（申诉已处理）</p>
                        <?php else: ?>
                            <?php if (in_array($data->ReturnStatus, array(1, 2, 3)) || $data->PayStatus == 'WAIT_SELLER_AGREE' || $data->PayStatus == 'WAIT_BUYER_RETURN_GOODS' || $data->PayStatus == 'WAIT_SELLER_CONFIRM_GOODS'): ?>
                                <p class="order_status">（退货中）</p>
                            <?php elseif (in_array($data->ReturnStatus, array(4)) || $data->PayStatus == 'REFUND_SUCCESS'): ?>
                                <p class="order_status">（退货完成）</p>
                            <?php elseif (in_array($data->ReturnStatus, array(11))): ?>
                                <p class="order_status">（退款中）</p>
                            <?php elseif (in_array($data->ReturnStatus, array(14))): ?>
                                <p class="order_status">（退款完成）</p>
                            <?php elseif ($returnorder['Status'] == 6): ?>
                                <p class="order_status">（退货已取消）</p>
                                <?php
                            endif;
                        endif;
                        ?>
                    </div>
                    <div style="position:relative;padding-top:5px; *z-index:2" onmouseleave="closeinfo(<?php echo $data->ID ?>)">
                        <div class="mouse_div" style="width:100%;height:20px;cursor:pointer" onmouseover="showinfo(<?php echo $data->ID ?>)">订单跟踪</div>
                        <div class="show-msg" id="follow<?php echo $data->ID ?>">
                        </div>
                    </div>
                    <div><a href="<?php echo Yii::app()->createUrl('pap/orderreview/detail', array("orderid" => $data->ID)) ?>" class="order_detail">订单详情</a>
                        <?php //if ($data->Status >= 2 && $data->Status <= 9):              ?>
                        <!--                <a href="" class="color_blue">查看物流</a><br><br>-->
                        <?php //endif              ?>
                    </div>
                </div>
                <div class="goods_show3 float_l">
                    <div class="order_caozuo m-top5" style="width:200px;">
                        <span style="">
                            <?php
                            switch ($data['Status']) {
                                case 1:
                                    if ($data['Payment'] == 1) {
                                        echo "<p class='m-top'><a class='pyp' key='" . $data['ID'] . "' alipay='" . $data['AlipayTN'] . "'>去付款</a></p>";
                                        if (!$data['AlipayTN']) {
                                            echo "<p class='m-top'><a class='change' order='" . $data['ID'] . "'>修改订单</a></p>";
                                        }
                                        echo "<p class='m-top'><a class='order_cancel' onclick='cancelOrder(" . $data['ID'] . ")'>取消订单</a></p>";
                                    }
                                    break;
                                case 2: //echo "<button onclick='delivery()' class='button2 m-top5'>提醒卖家发货</button>";
                                    if ($data['Payment'] == 2) {
                                        echo "<p class='m-top'><a class='change' order='" . $data['ID'] . "'>修改订单</a></p>";
                                        echo "<p class='m-top'><a class='order_cancel' onclick='cancelOrder(" . $data['ID'] . ")'>取消订单</a></p>";
                                    }
                                    break;
                                case 3:
                                    if ($data['ReturnStatus'] == 0) {
                                        if ($data['Payment'] == 2) {
                                            echo "<p class='m-top'><a class='confirm' key='" . $data['ID'] . "'>确认收货</a></p>";
                                            echo "<p class='m-top'><a class='refuse' key='" . $data['ID'] . "'>拒收</a></p>";
                                            // echo "<button   key='" . $data['ID'] . "'class='refuse button2 m-top'>拒收</button>";
                                        } else {
                                            echo "<p class='m-top'><a class='payconfirm' key='" . $data['ID'] . "'>确认收货</a></p>";
                                        }
                                    } else {

                                        if ($returnorder['Status'] == 5 && $returnorder['ComplainStatus'] == 0) {
                                            echo "<p class='m-top'><a class='ret' style='color:#000' key='" . $data['ID'] . "'>审核未通过</a></p>";
                                            echo "<p class='m-top'><a class='agin' key='" . $return['ReturnID'] . "'>重新申请</a></p>";
                                            // echo "<button   key='" . $data['ID'] . "'class='ret button2 m-top'>审核未通过</button><br>";
                                            // echo "<button   key='" . $return['ReturnID'] . "'class='agin button2 m-top'>重新申请</button><br>";
                                        }
                                    }
                                    break;
                                case 9:
                                    if ($data['ReturnStatus'] == 0 && $returnorder['Status'] != 6) {
                                        echo "<p class='m-top'><a class='returngoods' key='" . $data['ID'] . "'>申请退货</a></p>";
                                    } else {
//                                        $return = PapReturnGoods::model()->find('OrderID=:orderid', array(':orderid' => $data['ID']));
//                                        if ($return) {
//                                            $returnorder = PapReturnOrder::model()->findByPk($return['ReturnID']);
//                                        }
                                        if ($returnorder['Status'] == 5 && $returnorder['ReturnNumber'] != 15 && $returnorder['ComplainStatus'] == 0) {
                                            echo "<p class='m-top'><span style='color:#000'>审核未通过</span></p>";
                                            echo "<p class='m-top'><a class='againreturn' key='" . $return['ReturnID'] . "'>重新申请</a></p>";
                                        } elseif ($returnorder['Status'] == 5 && $returnorder['ReturnNumber'] == 15) {
                                            echo '退货三次不通过！';
                                        }
                                    }
                                    if ($data['EvaStatus'] == 0 || $data['EvaStatus'] == 16)
                                        echo "<p class='m-top'><a class='eval' onclick='papeva(" . $data['Status'] . "," . $data['EvaStatus'] . "," . $data['ID'] . ")'>评价</a></p>";
                                    break;
                                case 10: echo "";
                                    break;
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
<?php endif; ?>