<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    table tr td{
        vertical-align: middle;
    }
</style>
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '退货管理' => Yii::app()->createUrl('pap/buyreturn'),
    '退货单详情',
);
?>  
<?php // var_dump($data); ?>
<?php if ($data->Status < 6 && $data->ComplainStatus == 0): ?>
    <ul class="order_bg">
        <li class="<?php if ($data->Status == 5) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">申请退货</span>
        </li>
        <li class="<?php if ($data->Status == 1) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">审核退货</span>
        </li>
        <li class="<?php if ($data->Status == 2) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">买家发货</span>
        </li>
        <li class="step_last <?php if ($data->Status == 3) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">确认收货</span>
        </li>
        <li class="step_last <?php if ($data->Status == 4) echo 'state'; ?>" style="width:170px">
            <span class="order_step state">退货完成</span>
        </li>
    </ul> 
<?php elseif ($data->Status == 6): ?>
    <ul class="order_bg" >
        <li class="step_last <?php if ($data->Status == 6) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">退货已取消</span>
        </li>
    </ul> 
<?php elseif ($data->Status == 5 && $data->ComplainStatus == 1): ?>
    <ul class="order_bg" >
        <li class="step_last <?php if ($data->ComplainStatus == 1) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉中</span>
        </li>
    </ul> 
<?php elseif ($data->Status == 5 && $data->ComplainStatus == 2): ?>
    <ul class="order_bg" >
        <li class="step_last <?php if ($data->ComplainStatus == 2) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉已处理</span>
        </li>
    </ul> 
<?php else: ?>
    <ul class="order_bg" >
        <li class="step_last <?php if ($data->ComplainStatus == 3) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉已取消</span>
        </li>
    </ul> 
<?php endif; ?>

<?php if ($data->ComplainStatus == 0): ?>
    <div class="order_step_info m-top">
        <i class="step-point" status="<?php echo $data->Status ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/images/sanjiao2.png"></i>
        <div class="order_step_info m-top">
            <div class="order_step_bd">
                <div class="trade-status">
                    <?php
                    switch ($data->Status) {
                        case '1':
                            ?>
                            <b>当前退货单状态：退货单已生成，正等待审核</b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        case '2':
                            ?>
                            <b>当前订单状态：审核已通过，正等待发货</b>
                            <?php //var_dump($data->ID);?>
                            <ul class='m-top'><li class='m-top'>1.点击这里 <button class='button2' onclick="onaudit2(<?php echo $data->ID ?>)">填写发货信息</button></li>
                            </ul>
                            <?php
                            break;
                        case '3':
                            ?>
                            <b>当前订单状态：发货已完成，正等待收货</b>
                            <ul class='m-top'><li class='m-top'>
                            </ul>
                            <p class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
                            <dl class="wlxx m-top">
                                <dt>发货方式：</dt>
                                <dd>快递</dd>
                                <dt>物流公司：</dt>
                                <dd><?php echo $data->LogtigCompany; ?></dd>
                                <dt>运单号码：</dt>
                                <dd><?php echo $data->ReShipLogis; ?></dd>
                            </dl>
                            <?php
                            break;
                        case '4':
                            ?>
                            <b>当前订单状态：退货已完成</b>
                            <ul class='m-top'>
                            </ul>
                            <p  class="m-top20" style="border-bottom:1px solid #ebebeb; line-height:30px"><b>物流信息</b></p>
                            <dl class="wlxx m-top">
                                <dt>发货方式：</dt>
                                <dd>快递</dd>
                                <dt>物流公司：</dt>
                                <dd><?php echo $data->LogtigCompany; ?></dd>
                                <dt>运单号码：</dt>
                                <dd><?php echo $data->ReShipLogis; ?></dd>
                            </dl>
                            <?php
                            break;
                        case '5':
                            ?>
                            <b>当前退货单状态：退货单审核未通过，请<button class='button2' onclick="chongxin(<?php echo $data->ID ?>)">重新申请</button></b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        case '6':
                            ?>
                            <b>当前退货单状态：退货单已取消</b>
                            <ul class='m-top'>
                            </ul>
                            <?php
                            break;
                        default:
                            ?>
                            <b>当前订单状态：异常,请联系管理员</b>
                            <?php
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="bor_back m-top">              
        <div  class="ddxx"><p>订单信息</p></div>
        <div class="info-box ">
            <p class=" m-top20"><b>退货原因：</b>
                <span class="m-left"><?php echo $data->Result ?></span>

            </p>   
            <?php if (!empty($data->NoResult)): ?>
                <p class=" m-top20"><b>退货未通过原因：</b>
                    <span class="m-left"><?php echo $data->NoResult ?></span>
                </p>
            <?php endif; ?>
            <p class="m-top20"><b>卖家信息</b></p>
            <ul class="mjxx m-top">
                <li>机构名称：<span><?php echo ReturnorderService::getOrganinfo($data->DealerID, 'OrganName') ?></span></li>
                <li>联系电话：<span><?php echo ReturnorderService::getOrganinfo($data->DealerID, 'Phone') ?></span></li>
                <li>机构地址：<span><?php echo ReturnorderService::getOrganinfo($data->DealerID, 'all')->Area ?></span></li>
                <div style="clear:both"></div>
                <p class="m-top20"></p>
            </ul>
            <div style="clear:both"></div>
            <?php if ($data->Status > 1 && $data->Status != 5 && $data->Status != 6): ?>
                <p class=" m-top20"><b>收货地址：</b>
                    <span class="m-left">
                        <?php echo isset($returnaddress['ShippingName']) ? $returnaddress['ShippingName'] : '' ?>，
                        <?php echo isset($returnaddress['Mobile']) ? $returnaddress['Mobile'] : '' ?>  ，
                        <?php echo Area::getCity($returnaddress['Province']) . Area::getCity($returnaddress['City']) . Area::getCity($returnaddress['Area']) . $returnaddress['Address'] ?>，
                        <?php echo $returnaddress['ZipCode']; ?>
                    </span>
                </p>
            <?php endif; ?>
            <div style="clear:both"></div>
            <p class="m-top20"><b>订单信息</b></p>
            <ul class="mjxx m-top last">
                <li>订单类型：<span>已收货退货订单</span></li>
                <li>退货单编号：<span><?php echo $data->ReturnNO ?></span></li>
                <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
                <div style="clear:both"></div>
                <p class="m-top20"></p>
            </ul>
            <div style="clear:both"></div>
            <p class="m-top"></p>

            <?php if ($data->ComplainStatus > 0): ?>
                <p class="m-top20"><b>申诉信息</b></p>
                <ul class="mjxx m-top last">
                    <li>申诉状态：<span><?php echo ReturnorderService::getComplainStatus($data->ComplainStatus) ?></span></li>
                    <li>申诉时间：<span><?php echo date('Y-m-d H:i:s', $reuslt['AppealTime']) ?></span></li>
                    <?php if ($reuslt['HandleTime']): ?>
                        <?php if ($reuslt['ResultStatus'] == 0 && !is_null($reuslt['ResultStatus'])): ?>
                            <li>审核状态：<span>不通过</span></li>
                        <?php elseif ($reuslt['ResultStatus'] == 1): ?>
                            <li>审核状态：<span>通过</span></li>
                        <?php elseif (($reuslt['ResultStatus'] == 2)): ?>
                            <li>审核状态：<span>重新审核</span></li>
                        <?php elseif (is_null($reuslt['ResultStatus'])): ?>
                            <li>审核状态：<span>未审核</span></li>
                        <?php endif; ?>


                        <?php if ($data->ComplainStatus == 2 && $reuslt['ResultStatus'] == 1): ?>
                            <?php if ($reuslt['HandleResult'] == 1) : ?> 
                                <li>汇款状态：
                                    <?php if ($reuslt['RemittanceStatus'] == 1): ?>
                                        已汇款(￥<?php echo $reuslt['HandleMoney'] ?>)
                                    <?php else: ?>
                                        待汇款(￥<?php echo $reuslt['HandleMoney'] ?>)
                                    <?php endif; ?>
                                </li>
                            <?php elseif ($reuslt['HandleResult'] == 0): ?>
                                <li>汇款状态：<span>无需退款</span></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif ?>
                    <div style="clear:both"></div>
                    <p class="m-top20"></p>
                </ul>
                <div style="clear:both"></div>
                <p class="m-top"></p>
            <?php endif; ?>

            <table class="m-top20 order_table">
                <thead>
                    <tr class="order_state_hd"><td>商品信息</td><td>单价</td><td>数量</td><td>PN号</td><td>状态</td><td>退货单总价(元)</td></tr>
                </thead> 
                <tbody>
                    <?php
                    if ($data->returngoods): $count = count($data->returngoods);
                        foreach ($data->returngoods as $k => $value):
                            ?>
                            <?php
                            $goods = DealergoodsService::getmongoversion($value['GoodsID'], $value['Version']);
                            ?>
                            <tr class="order_bd">
                                <td>
                                    <div class="div_img float_l m_left12" style="margin-top: 15px;">
                                        <a title="" class="order_goods" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" order="<?php echo $value['OrderID'] ?>" version="<?php echo $value['Version'] ?>" target='_blank'>
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
                                    <div class="div_info float_l m_left m-top5" style="width:375px">
                                        <div style="float:left;text-align:left;width: 240px;"><a target='_blank' class="order_goods" order="<?php echo $value['OrderID'] ?>"version="<?php echo $value['Version'] ?>"  href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" title="<?php echo $goods['GoodsInfo']['Name'] ?>"><b style="font-size:14px"><?php echo $goods['GoodsInfo']['Name'] ?></b></a></div>
                                        <div style="">订单编号：<?php echo OrderreturnService::orderIDgetorder($value['OrderID'], 'OrderSN'); ?></div>
                                        <div style="clear:both;height:0px"></div>
                                        <p class="">商品编号：<span class="zwq_color"><?php echo $goods['GoodsInfo']['GoodsNO'] ?></span> | 品牌：<span><?php echo $goods['GoodsInfo']['Brand'] ?></span></p>
                                        <p class="">标准名称：<span><?php echo $goods ? Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['GoodsInfo']['StandCode']}'"))->attributes['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'CpName'); ?></span> | 拼音代码：<span><?php echo $goods['GoodsInfo']['Pinyin']; ?></span>
                                        <p>配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>

                                        <?php
                                        $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $value['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                                        ?>
                                        <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                        <p style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"> OE号：<span><?php
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
                                                ?></span> </p>
                                    </div>                                                     
                                </td>               
                                <td> <span class="zwq_color"><?php echo $value->Price ?></span></td> 
                                <td><span ><?php echo $value->Amount ?></span></td>    
                                <td><span ><?php echo $value->PIN ?></span></td>    
                                <?php if ($k == 0): ?>
                                    <td rowspan="<?php echo $count ?>"> <span><?php echo ReturnorderService::getStatus($data->Status) ?></span></td>               
                                    <td rowspan="<?php echo $count ?>">  <div class="zwq_color"><?php echo $data->Price ?></div></td>
                                <?php endif; ?>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>                 
            </table>
            <br />
            <br />
            <div style="text-align:right"><input type="button"  class="button button2"id="goback" value="返回列表" /></div>
            <input type="hidden" id="ReturnID" value="<?php echo $data->ID ?>">
           <!--<p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color"><?php // echo $data->Price                                                                                                                                                                                                                                     ?></span></p>-->
        </div>
    </div>
    <form action="" method="POST" id="goodsform" target="_blank">
        <input type="hidden" name="Version">
        <input type="hidden" name="Order">
    </form>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'auditfail', //弹窗ID  
        'options' => array(//传递给JUI插件的参数  
            'title' => '填写审核失败的原因',
            'autoOpen' => false, //是否自动打开 
            'modal' => true, // 层级
            'width' => '480', //宽度  
            'height' => '250', //高度  
            'resizable' => false,
            'buttons' => array(
                '保存' => 'js:function(){ save();}',
                '关闭' => 'js:function(){ $(this).dialog("close");}',
            ),
        ),
    ));
    echo "<div id='addfail'></div>";
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
    <script>
        $(document).ready(function() {
            //商品详情
            $('.order_goods').bind('click', function() {
                var url = this.href;
                $('input[name=Version]').val($(this).attr('version'));
                $('input[name=Order]').val($(this).attr('order'));
                $('#goodsform').attr('action', url);
                $('#goodsform').submit();
                return false;
            })
            $("table tbody tr").mouseover(function() {
                $(this).css("background", "white"); //取消table覆盖样式

            })

            var status = $('i.step-point').attr('status');
            switch (status) {
                case '1':
                    $('i.step-point').css({'left': '30%'});
                    break; //审核退货
                case '2':
                    $('i.step-point').css({'left': '50%'});
                    break; //退货待发货
                case '3':
                    $('i.step-point').css({'left': '68%'});
                    break; //退货待收货
                case '4':
                    $('i.step-point').css({'left': '88%'});
                    break; //已完成
                case '5':
                    $('i.step-point').css({'left': '11%'});
                    break; //审核未通过
                case '6':
                    $('i.step-point').css({'left': '45%'});
                    break; //已取消
            }
        })

        $('#goback').click(function() {
            var url = Yii_baseUrl + '/pap/buyreturn';
            window.location.href = url;
        })

        function onaudit2(ID) { //填写发货信息
            var url = Yii_baseUrl + '/pap/buyreturn/send/ID/' + ID;
            window.location.href = url;
        }
        function chongxin(ID) { //重新申请退货
            var url = Yii_baseUrl + '/pap/buyreturn/agaginret/ID/' + ID;
            window.location.href = url;
        }
    </script>
