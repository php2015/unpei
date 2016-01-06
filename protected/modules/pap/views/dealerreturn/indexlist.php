<style>

    .splb_order li{height:130px;}
</style>
<div class="border">
    <?php if ($data->Status > 10): ?>
        <p class="mbx mbx4">
            <span style="padding-left:12px;">  <?php echo date('Y年m月d日', $data->CreateTime) ?></span>
            <span>退款单号：</span><span><?php echo $data->ReturnNO ?></span><span class="m_left40"><?php echo OrderreturnService::idgetname($data->ServiceID) ?></span>
        </p>
    <?php else: ?>
        <p class="mbx mbx4">
            <span style="padding-left:12px;">  <?php echo date('Y年m月d日', $data->CreateTime) ?></span>
            <span>退货单号：</span><span><?php echo $data->ReturnNO ?></span><span class="m_left40"><?php echo OrderreturnService::idgetname($data->ServiceID) ?></span>
        </p>
    <?php endif; ?>
    <div style="border-bottom:1px solid #ebebeb">
        <?php if ($data->returngoods):$count = count($data->returngoods); ?>
            <ul class="splb_order float_l  tb_head m_left">
                <?php foreach ($data->returngoods as $v): ?>

                    <?php
                    $goods = DealergoodsService::getmongoversion($v['GoodsID'], $v['Version']);
                    ?>

                    <li>
                        <div class="div_img float_l m-top">
                            <a class="order_goods" title="" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" version="<?php echo $v['Version'] ?>" target="_blank"  goodsid="<?php echo $v['GoodsID'] ?>">
                                <img src="
                                <?php
                                if ($goods['GoodsInfo']['img'][0]['ImageUrl']) {
                                    echo F::uploadUrl() . $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                } else {
                                    echo F::uploadUrl() . 'common/default-goods.png';
                                }
                                ?>" style="width: 90px;height: 100px;">
                            </a>
                        </div>
                        <div class="div_info float_l m_left m-top">
                            <span>
                                <p class="zwq_name" style="float: left;width: 150px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                                    <a class="order_goods" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>"  href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank"  title="<?php echo $goods['GoodsInfo']['Name']; ?>" ><?php echo $goods['GoodsInfo']['Name']; ?></a>

                                </p>
                                <p style="float: right;font-size: 12px;width: 150px;height: 18px;line-height: 18px;">订单编号：<?php echo OrderreturnService::orderIDgetorder($v['OrderID'], 'OrderSN'); ?></p>
                            </span>
                            <p class="m-top5" style="clear: both;width: 400px;">商品编号：<span class="zwq_color"><?php echo $goods['GoodsInfo']['GoodsNO'] ?></span> | 品牌：<span><?php echo $goods['GoodsInfo']['Brand']; ?></span></p>
                            <p class="m-top5" style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">标准名称：<span><?php echo $goods['GoodsInfo']['StandCodeName'] ?></span> | 拼音代码：<span><?php echo $goods['GoodsInfo']['Pinyin'] ?></span> </p>

                            <?php
                            $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $v['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                            ?>
                            <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                            <p class="m-top5">配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>

                            <p class="m-top5" style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;" >OE号：<span><?php
                                    if ($goods['GoodsInfo']['oeno']) {
                                        foreach ($goods['GoodsInfo']['oeno'] as $key => $value) {
                                            if ($key) {
                                                echo '、' . $value;
                                            } else {
                                                echo $value;
                                            }
                                        }
                                    }
                                    ?></span> 
                            </p>

                        </div>
                        <div class="price float_l zwq_color">￥<?php echo $v['Price'] ?></div>
                        <div class="shuliang float_l"><?php echo $v['Amount'] ?></div>
                    </li>  
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="float_l   goods_show" style="height:<?php echo $count > 1 ? $count * 135 + 1 : $count * 135 ?>px;min-height:135px">
            <div class="float_l goods_show1" style="text-align:center; width:100px;">
                <div class="price zwq_color m_top20">
                    <?php //var_dump($data);exit; ?>
                    <?php if ($data->Type == 2): ?>
                        ￥<?php echo $data->Price ?>
                    <?php elseif ($data->Type == 1): ?>
                        ￥0
                        <br />
                        <br />
                        <span style="">注:未收货订单无退款!</span>
                    <?php endif; ?>
                </div>
                <?php if ($data->Status > 10): ?>
                    <br />
                    <br />
                    <span style="">注:退款金额小于该订单总价!</span>
                <?php endif; ?>
            </div>
            <div class="float_l goods_show2" style="text-align:center; width:100px">
                <div class="m-top20">
                    <?php if (in_array($data->Status, array(2, 3, 4))): ?>
                        <?php if ($data->PayMethod == 2): ?>
                            <div class="p_top7">物流代收款</div>
                        <?php elseif ($data->PayMethod == 0): ?>
                            <div class="p_top7">支付宝担保</div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="order_status " style="padding-top: 7px">
                        <?php if ($data->Status == 5 && $data->ReturnNumber == 15): ?>
                            <span>退货三次不通过</span>
                        <?php elseif ($data->Status == 12 && $data->ReturnNumber == 75): ?>
                            <span>退款三次不通过</span>
                        <?php else: ?>
                            <?php echo ReturnorderService::getStatus($data->Status) ?>
                            <br />
                        <?php endif; ?>
                        <div style="padding-top: 7px"><?php echo ReturnorderService::getComplainStatus($data->ComplainStatus) ?></div>
                    </div>



                    <div  class="p_top7"><?php if ($data->Status > 10): ?>
                            <a href="<?php echo Yii::app()->CreateUrl('pap/dealerreturn/orderinfo2', array('ID' => $data->ID)) ?>">订单详情</a>
                        <?php else: ?>
                            <a href="<?php echo Yii::app()->CreateUrl('pap/dealerreturn/orderinfo', array('ID' => $data->ID)) ?>">订单详情</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="float_l div_caozuo goods_show3" style="text-align:center; width:100px">
                <div class="order_caozuo m-top20">
                    <?php if ($data->Status == 1) echo '<button class="button2 m-top" onclick="onaudit(' . $data->ID . ')">审核退货</button>' ?>
                    <?php if ($data->Status == 11) echo '<button class="button2 m-top" onclick="onaudit2(' . $data->ID . ')">审核退款</button>' ?>
                    <?php if ($data->Status == 3) echo '<button class="button2 m-top" onclick="getgoods(' . $data->ID . ')" >确认收货</button> <span id="red"  key="' . $data->PayMethod . '" trade="' . $data->AlipayTN . '"></span>' ?>
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both"></div></div>
<script>
    function onaudit(ID) {
        var url = Yii_baseUrl + '/pap/dealerreturn/audit/ID/' + ID;
        window.location.href = url;
    }
    function onaudit2(ID) {  //审核退款
        var url = Yii_baseUrl + '/pap/dealerreturn/audit2/ID/' + ID;
        window.location.href = url;
    }
    //收货处理
    function getgoods(ReturnID) {
        var confim = $('#red').attr('key');
        var tradeNO = $('#red').attr('trade');
        if (confim == 0) {
            var bool = window.confirm('请到支付宝订单确认收货!');
            if (bool == true) {
                location.href = "https://lab.alipay.com/consume/queryTradeDetail.htm?tradeNo=" + tradeNO;
            }
        } else {
            var bool = window.confirm('您是否确认收货?');
            if (bool == false) {
                return false;
            }
            var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/goodsget') ?>";
            $.getJSON(url, {ID: ReturnID}, function(data) {
                if (data) {
                    var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/index') ?>";
                    location.href = url;
                    return true;
                } else {
                    alert('收货失败');
                    return false;
                }
            });
        }

    }
</script>