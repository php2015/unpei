<style>
    .border{border:1px solid #ebebeb; margin-top:10px}
    .border:hover{ border:1px solid #bbb}
    .splb_order li{height:150px;}

</style>
<div class="border">
    <p class="mbx mbx4">
        <?php if ($data->Status > 10): ?>
            &nbsp;&nbsp;<span>退款时间：</span><?php echo date('Y年m月d日', $data->CreateTime) ?>
            &nbsp;&nbsp;<span>退款单号：</span><span><?php echo $data->ReturnNO ?></span>
        <?php else: ?>
            &nbsp;&nbsp;<span>退货时间：</span><?php echo date('Y年m月d日', $data->CreateTime) ?>
            &nbsp;&nbsp;<span>退货单号：</span><span><?php echo $data->ReturnNO ?></span>
        <?php endif ?>
        &nbsp;&nbsp;<span>经销商名称：</span><span><?php echo ReturnorderService::idgetname($data->DealerID) ?></span>
    </p>
    <div style="">
        <?php if ($data->returngoods):$count = count($data->returngoods); ?>
            <ul class="splb_order float_l  tb_head m_left">
                <?php foreach ($data->returngoods as $value): //var_dump($value);?>
                    <?php
                    $goods = DealergoodsService::getmongoversion($value['GoodsID'], $value['Version']);
                    ?>
                    <li>
                        <div class="div_img float_l" style="margin-top: 15px;">
                            <a class="order_goods" title="" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" order="<?php echo $value['OrderID'] ?>"version="<?php echo $value['Version'] ?>" target='_blank'>
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
                            <p style="width:270px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis">
                                <a href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" target='_blank' title="<?php echo $goods['GoodsInfo']['Name'] ?>" class="order_goods f_weight" order="<?php echo $value['OrderID'] ?>" version="<?php echo $value['Version'] ?>" goodsid="<?php echo $value['GoodsID'] ?>"style="font-size:14px"><?php echo $goods['GoodsInfo']['Name'] ?></a>
                            </p>
                            <p class="m-top5">商品编号：<span class="zwq_color"><?php echo $goods['GoodsInfo']['GoodsNO'] ?></span> | 品牌：<span><?php echo $goods['GoodsInfo']['Brand'] ?></span></p>
                            <p class="m-top5" style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">标准名称：<span><?php echo $goods ? Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['GoodsInfo']['StandCode']}'"))->attributes['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'CpName'); ?></span> | 拼音代码：<span><?php echo $goods['GoodsInfo']['Pinyin'] ?></span>
                            <p class="">配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>

                            <?php
                            $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $value['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                            ?>
                            <p class="m-top5">定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>

                            <p class="m-top5"style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"> OE号：<span><?php
                                    if ($goods['GoodsInfo']['oeno']) {
                                        foreach ($goods['GoodsInfo']['oeno'] as $key => $v) {
                                            if ($key) {
                                                echo '、' . $v;
                                            } else {
                                                echo $v;
                                            }
                                        }
                                    } if (!$goods) {
                                        echo ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsOE');
                                    }
                                    ?></span>
                            </p>
                        </div>
                        <div class="price float_l zwq_color">￥<?php echo $value['Price'] ?></div>
                        <div class="shuliang float_l"><?php echo $value['Amount'] ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
            <div class="float_l   goods_show" style="height:<?php echo $count > 1 ? $count * 150 + 1 : $count * 150 ?>px;min-height:150px">
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
                    <div class="m_top20">
                        <?php
                        if (in_array($data->Status, array(2, 3, 4))):
                            //只有审核通过以后才显示退款方式     2,退货待发货 3,退货待收货 4,退货完成
                            ?> 
                            <?php if ($data->PayMethod == 2):  //退款方式   ?>
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


                        <div  style="padding-top: 7px">
                            <?php if ($data->Status > 10): ?>
                                <a href="<?php echo Yii::app()->CreateUrl('pap/buyreturn/orderinfo2', array('ID' => $data->ID)) ?>">订单详情</a><br><br>
                            <?php else: ?>
                                <a href="<?php echo Yii::app()->CreateUrl('pap/buyreturn/orderinfo', array('ID' => $data->ID)) ?>">订单详情</a><br><br>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php $HandleStatus = ReturnorderService::getHandleStatus($data->ReturnNO); ?>
                <div class="float_l div_caozuo goods_show3" style="text-align:center; width:100px">
                    <div class="order_caozuo m_top20" >
                        <?php if ($data->Status == 5 && $data->ReturnNumber != 15 && $data->ComplainStatus == 0) echo '<p class=" m-top" ><a onclick="onaudit(' . $data->ID . ')">重新申请退货</a></p>' ?>
                        <?php if ($data->Status == 5 && $data->ComplainStatus == 0) echo '<p class=" m-top" ><a style="color:red"onclick="shensu(' . $data->ID . ')">向平台申诉</a></p>' ?>
                        <?php if ($data->Status == 12 && $data->ReturnNumber != 75 && $data->ComplainStatus == 0) echo '<p class=" m-top" ><a onclick="onaudit12(' . $data->ID . ')">重新申请退款</a></p>' ?>
                        <?php if ($HandleStatus == 1 && $data->ComplainStatus == 1) echo '<p class=" m-top" ><a onclick="nocomplain(' . $data->ID . ')">取消申诉</a></p>' ?>
                        <?php if ($data->Status == 12 && $data->ComplainStatus == 0) echo '<p class=" m-top" ><a style="color:red"onclick="shensu(' . $data->ID . ')">向平台申诉</a></p>' ?>
                        <?php if ($data->Status == 13) echo '<button class="button2 m-top" style="*width:80px" onclick="onaudit13(' . $data->ID . ')">确认收款</button>' ?>
                        <?php if ($data->Status == 2 && $data->Type == 2) echo '<button class="button2 m-top" style="*width:80px" onclick="onaudit2(' . $data->ID . ')">填写发货信息</button>' ?>
                        <?php if ($data->Status == 1 || $data->Status == 5 && $data->ComplainStatus == 0) echo '<button class="button2 m-top" id="noreturn"  key=' . $data->ID . '>取消退货</button>' ?>
                        <?php if ($data->Status == 11 || $data->Status == 12 && $data->ComplainStatus == 0) echo '<button class="button2 m-top" id="noreturnprice"  key=' . $data->ID . '>取消退款</button>' ?>
                    </div>
                </div>

                <div style="clear:both"></div>
            </div>
            <div style="clear:both"></div>
        </div></div>
    <script>
        function shensu(ID) {
            var url = Yii_baseUrl + '/pap/buyreturn/complain/ID/' + ID;
            window.location.href = url;
        }
        function onaudit(ID) { //重新申请
            var url = Yii_baseUrl + '/pap/buyreturn/agaginret/ID/' + ID;
            window.location.href = url;
        }
        function onaudit12(ID) { //重新申请退款
            var url = Yii_baseUrl + '/pap/buyreturn/agaginret2/ID/' + ID;
            window.location.href = url;
        }

        function onaudit2(ID) { //填写发货信息
            var url = Yii_baseUrl + '/pap/buyreturn/send/ID/' + ID;
            window.location.href = url;
        }

        function onaudit13(ID) { //确认收款（申请退款）
            var bool = window.confirm('确定收到款了吗?');
            if (bool) {
                var url = "<?php echo Yii::app()->createUrl('pap/buyreturn/getprice') ?>";
                $.getJSON(url, {ID: ID}, function(data) {
                    if (data) {
                        var url = "<?php echo Yii::app()->createUrl('pap/buyreturn/index') ?>";
                        location.href = url;
                        return true;
                    }
                });
            } else {
                return false;
            }

        }
    </script>