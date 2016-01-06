<style>

    .state .order_step1 {
        background: none repeat scroll 0 0 #f2b303;
        color: #fff;
        height: 35px;
        line-height: 35px;
        margin: -1px 10px 0;
        width: 145px;
    }
    .order_step1 {
        font-size: 14px;
        font-weight: bold;
    }
    div.div_info{width:400px}
    .name_div{text-align:left}
    .name_div a{}
    .width220{width:220px}
    .text_l{text-align: left}
    .text_l a{font-size: 12px; font-weight:bold}
    .state .order_step3 {
        background: none repeat scroll 0 0 #f2b303;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        height: 35px;
        line-height: 35px;
        margin: -1px 10px 0;
        width: 415px;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '退货管理' => Yii::app()->createUrl('pap/dealerreturn/index'),
    '退货单详情',
);
?>  
<ul class="order_bg">
    <?php if ($data->Status <= 4 && $data->ComplainStatus == 0): ?>
        <li style=" width: 19%;height:35px;">
            <span class="order_step1 state">申请退货</span>                                                                                                                                               
        </li >
        <li  style=" width: 19%;height:35px;" class="<?php if ($data->Status == 1) echo 'state'; ?>">
            <span class="order_step1 state" style=" height:35px;">审核退货</span>                                                                                                                                               
        </li>
        <li style=" width: 19%;height:35px;" class="<?php if ($data->Status == 2) echo 'state'; ?>">
            <span class="order_step1 state" style=" height:35px;">买家发货</span>                                                                                                                                                
        </li>
        <li  style=" width: 19%;height:35px;" class=" <?php if ($data->Status == 3) echo 'state'; ?>">
            <span class="order_step1 state" style=" height:35px;">确认收货</span>                                                                                                                                                 
        </li>
        <li  style=" width: 19%;height:35px;" class="step_last <?php if ($data->Status == 4) echo 'state'; ?>">
            <span class="order_step1 state" style=" height:35px;">退货完成</span>                                                                                                                                                
        </li>
    <?php elseif ($data->Status == 5 && $data->ComplainStatus == 1): ?>
        <li class="step_last <?php if ($data->ComplainStatus == 1) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉中</span>
        </li>
    <?php elseif ($data->Status == 5 && $data->ComplainStatus == 2): ?>
        <li class="step_last <?php if ($data->ComplainStatus == 2) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉已处理</span>
        </li>
    <?php elseif ($data->Status == 5 && $data->ComplainStatus == 3): ?>
        <li class="step_last <?php if ($data->ComplainStatus == 3) echo 'state'; ?>" style="margin-left: 300px;width:170px">
            <span class="order_step state">申诉已取消</span>
        </li>
    <?php else: ?>
        <li style=" width:49%;height:35px;" class="step_last <?php if ($data->Status == 5) echo 'state'; ?>">
            <span class="order_step3 state" style=" height:35px;">审核未通过</span>                                                                                                                                                        
        </li>
        <li style=" width: 49%;height:35px;" class="step_last <?php if ($data->Status == 6) echo 'state'; ?>">
            <span class="order_step3 state" style=" height:35px;">退货取消</span>                                                                                                                                                        
        </li>
    <?php endif; ?>
</ul> 
<?php if ($data->ComplainStatus == 0): ?>
    <div class="order_step_info">
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
                            <!--                        <ul class='m-top'><li class='m-top'>1.点击这里 <button class='button2'>发货</button></li>
                                                            </ul>-->
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
                            <b>当前退货单状态：退货单审核未通过</b>
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
    </div>
<?php endif; ?>
<div class="bor_back m-top">              
    <div  class="ddxx" style="height: 30px">
        <p style="display: block;float: left;" >退货单信息</p>
        <div  style="width: 70px;float: right;padding-left: 30px;"><a onclick="auditexit()" herf="" style="cursor:pointer">返回列表</a></div>
    </div>
    <div class="info-box ">
        <p class=" m-top20"><b>退货原因：</b>
            <span class="m-left"><?php echo $data->Result ?></span></p>
        <?php if ($data->Status == 5): ?>
            <p class=" m-top20"><b>审核未通过原因：</b>
                <span class="m-left"><?php echo $data->NoResult ?></span></p>
        <?php endif; ?>
        <div class="mjxx" style="height:70px">
            <p class="m-top20"><b>买家信息</b></p>
            <ul class=" m-top">
                <li>机构名称：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'OrganName') ?></span></li>
                <li>联系电话：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'Phone') ?></span></li>
                <li>机构地址：<span><?php echo OrderreturnService::idgetorgan($data->ServiceID, 'all')->Area ?></span></li>
                <p class="m-top20"></p>
            </ul>
        </div>
        <?php if ($data->Status > 1 && $data->Status != 5 && $returnaddress): ?>
            <div class="mjxx" style="height:auto;line-height:30px">
                <p class=" m-top20"><b>收货地址：</b>
                    <span class="m-left">
                        <?php echo isset($returnaddress['ShippingName']) ? $returnaddress['ShippingName'] : '' ?>，
                        <?php echo isset($returnaddress['Mobile']) ? $returnaddress['Mobile'] : '' ?>  ，
                        <?php echo Area::getCity($returnaddress['Province']) . Area::getCity($returnaddress['City']) . Area::getCity($returnaddress['Area']) . $returnaddress['Address'] ?>，
                        <?php echo $returnaddress['ZipCode']; ?>
                    </span>
                </p>
            </div>
        <?php endif; ?>
        <div style="clear:both"></div>
        <p class="m-top20"><b>订单信息</b></p>
        <ul class="mjxx m-top last">
            <li>退货单编号：<span><?php echo $data->ReturnNO ?></span></li>
            <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
            <?php
//                switch ($data->Status) {
//                    default:break;
//                    case '2': echo "<li>支付宝交易号：<span>$data->AlipayTN</span></li><li>付款时间：<span>"
//                        . date('Y-m-d H:i:s', $data->AccountTime) . "</span></li>";
//                        break;
//                    case '3': echo "<li>支付宝交易号：<span>$data->AlipayTN</span></li><li>付款时间：<span>"
//                        . date('Y-m-d H:i:s', $data->AccountTime) . "</span></li><li>发货时间：<span>"
//                        . date('Y-m-d H:i:s', $data->DeliveryTime) . "</span></li>";
//                        break;
//                    case '9': echo "<li>支付宝交易号：<span>$data->AlipayTN</span></li><li>付款时间：<span>"
//                        . date('Y-m-d H:i:s', $data->AccountTime) . "</span></li><li>发货时间：<span>"
//                        . date('Y-m-d H:i:s', $data->DeliveryTime) . "</span></li><li>收货时间：<span>"
//                        . date('Y-m-d H:i:s', $data->ReceiptTime) . "</span></li>";
//                        break;
//                }
            ?>
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
                    foreach ($data->returngoods as $k => $v):
                        ?>
                        <?php
                        $goods = DealergoodsService::getmongoversion($v['GoodsID'], $v['Version']);
                        ?>
                        <tr class="order_bd">
                            <td>
                                <div class="div_img float_l m-top5"><img src="
                                    <?php
                                    if ($goods['GoodsInfo']['img'][0]['ImageUrl']) {
                                        echo F::uploadUrl() . $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                    } else {
                                        echo F::uploadUrl() . 'common/default-goods.png';
                                    }
                                    ?>" style="width: 90px;height: 100px;"></div> 
                                <div class="div_info float_l m-left5">
                                    <div class="name_div">
                                        <div class="float_l cut width220 text_l">
                                            <a class="order_goods" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>"  href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank"  title="<?php echo $goods['GoodsInfo']['Name']; ?>" ><?php echo $goods['GoodsInfo']['Name']; ?></a>
                                        </div><div class="float_l"><span>&nbsp;&nbsp;订单编号：<?php echo OrderreturnService::orderIDgetorder($v->OrderID, 'OrderSN'); ?></span></div></div>
                                    <p class="">商品编号：<span class="zwq_color"><?php echo $goods['GoodsInfo']['GoodsNO'] ?> </span> | 品牌：<span><?php echo $goods['GoodsInfo']['Brand']; ?> </span></p>
                                    <p style=" width: 400px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">标准名称：<span><?php echo $goods['GoodsInfo']['StandCodeName']; ?> </span> | 拼音代码：<span><?php echo $goods['GoodsInfo']['Pinyin']; ?></span></p>

                                    <?php
                                    $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $v['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                                    ?>
                                    <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                    <p>配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>

                                    <p style=" width: 400px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">OE号：<span>
                                            <?php
                                            if ($goods['GoodsInfo']['oeno']) {
                                                foreach ($goods['GoodsInfo']['oeno'] as $key => $value) {
                                                    if ($key) {
                                                        echo '、' . $value;
                                                    } else {
                                                        echo $value;
                                                    }
                                                }
                                            }
                                            ?>
                                        </span> </p>
            <!--                                        <div class="m-top5" style=" width: 270px;height: 17px;overflow: hidden"><div class="float_l cut width120">商品编号：<a title="<?php echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'GoodsNum'); ?>"><?php echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'GoodsNum') ?></a><span class="zwq_color"></span></div><div class="float_l color_hui"> |</div><div class="float_l cut m_left width120"> <span>品牌：<a title="<?php echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'Brand'); ?>"><?php echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'Brand'); ?></a></span></div></div>
                                            <div class="m-top5" style=" width: 270px;height: 17px;overflow: hidden"><div class="float_l cut width120"> 标准名称：<a title="<?php echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'CpName'); ?>"><?php echo OrderreturnService::idgetordergoods($v->OrderID, $v->GoodsID, 'CpName'); ?></a></div><div class="float_l color_hui">|</div> <div class="float_l cut m_left width120">拼音代码：<a title="<?php echo DealergoodsService::idgetgoods($v->GoodsID, 'Pinyin'); ?>"><?php echo DealergoodsService::idgetgoods($v->GoodsID, 'Pinyin'); ?></a></div> </div>-->
                                </div>
                            </td>               
                            <td> <span class="zwq_color"><?php echo $v->Price ?></span></td> 
                            <td><span ><?php echo $v->Amount ?></span></td>    
                            <td><span ><?php echo $v->PIN ?></span></td>   
                            <?php if ($k == 0): ?>
                                <td rowspan="<?php echo $count ?>"> <span><?php echo OrderreturnService::showOrderStatus($data->Status) ?></span></td>               
                                <td rowspan="<?php echo $count ?>">  <div class="zwq_color"><?php echo $data->Price ?></div></td>
                            <?php endif; ?>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>                 
        </table>
        <input type="hidden" id="ReturnID" value="<?php echo $data->ID ?>">
        <input type="hidden" id="type" value="<?php echo($_GET['type']) ? ($_GET['type']) : 1; ?>">
        <p align="right" class="m-top f_weight shifukuan" id="auditgo" <?php if ($_GET['type'] == 1 || $_GET['type'] == 2) echo 'style="display:none"' ?>> 
            <?php if ($data->Status == 1): ?>
                <button onclick="auditok()">审核通过</button>
                <button onclick="auditno()">审核未通过</button>
                <button onclick="auditexit()" >取消</button>
            <?php elseif ($data->Status == 3): ?>
                <button  onclick="getgoods()">确认收货</button>
                <span id="red"  key="<?php echo $data->PayMethod ?>" trade="<?php echo $data->AlipayTN ?>"></span>
                <button  onclick="auditexit()" >取消</button>
            <?php endif; ?>
        </p>
    </div>
</div>
<div class="bor_back m-top" id="returntype" <?php if ($_GET['type'] != 1 && $_GET['type'] != 2) echo 'style="display:none"' ?>>
    <div  class="ddxx" style="height: 30px">
        <p style="display: block;float: left;" >选择退款方式</p>
    </div>
    <div class="info-box ">
        退款方式：
        <input type="radio" onclick="addaddress(1)" name="typement" style="margin:10px 10px 0px 20px;" <?php if ($_GET['type'] != 2) echo 'checked=checked'; ?>>&nbsp;支付宝担保
        <input type="radio" onclick="addaddress(2)" name="typement"  <?php if ($_GET['type'] == '2') echo 'checked=checked' ?> style="margin:10px 10px 0px 20px;">&nbsp;物流代收款


<!--            <span id="audittype" <?php if ($_GET['type'] == 1 || $_GET['type'] == 2) echo 'style="display:none"' ?>>
                <button onclick="addaddress(1)">支付宝担保</button>
                <button onclick="addaddress(2)">物流代收款</button>
                <button  onclick="auditokno()" >取消</button>    
            </span>-->
<!--            <span id="audittypes">
        <?php
//            if ($_GET['type'] == 1 || $_GET['type'] == 2) {
//                if ($_GET['type'] == 1) {
//                    echo '支付宝担保';
//                }
//                if ($_GET['type'] == 2) {
//                    echo '物流代收款';
//                }
//            }
        ?>
            </span>-->

    </div>
</div> 
<?php if ($data->Status == 1): ?>
    <div class="bor_back m-top" id="addadress" <?php if ($_GET['type'] != 1 && $_GET['type'] != 2) echo 'style="display:none"' ?>>
        <style>
            .success{height:auto;margin:0;width:auto;margin-top: 5px}
        </style>
        <div  class="ddxx" style="height: 30px">
            <p style="display: block;float: left;" >选择收货地址</p>
            <span style=" padding-left: 650px"> <a href="javascript:void(0)"  onclick="newaddress();">使用新地址</a></span>

        </div>
        <?php if (isset($address) && !empty($address)) { ?>
            <div style="border:1px solid #e1e1e1; margin:5px">
                <table id="table">
                    <thead style="background:#f6f6f6">
                        <tr class="bd-tb control">
                            <td width="27" style="padding-left:30px;" align="center">选择</td>
                            <td width="75" align="center">邮政编码</td>
                            <td width="200" align="center">详细地址</td>
                            <td width="100" align="center">手机号码</td>
                            <td width="60" align="center">操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($address as $key => $value): ?>
                            <tr class="" >
                                <td class="width50">
                                    <input type="radio" name="addr" value="<?php echo $address[$key]['ID'] ?>"> </td>
                                <td><?php echo $address[$key]['ZipCode'] ?></td>
                                <td style="width:170px;color:#666"> 
                                    <?php
                                    $add = Area::getCity($address[$key]['State']) . Area::getCity($address[$key]['City']) . Area::getCity($address[$key]['District']) . $address[$key]['Address'] . "&nbsp; (" . $address[$key]['ContactName'] . ")收";
                                    echo $add;
                                    ?>
                                </td>
                                <td><?php echo $value['Phone'] ?></td>
                                <td><a  href="javascript:void(0)" onclick="updateaddress(<?php echo $value['ID'] ?>)">修改本地址</a></td></tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class='mt1em indent'style="text-align:center;line-height:30px">
                    <a class='display-n slider-controler pos-r' href="javascript:;">显示全部地址<i class="icon-arr-b display-ib y-align-m"></i></a>
                </div> 
                <p class="refer" style="margin-top:10px;margin-right: 20px;margin-bottom: 5px;">
                    <input type="submit" id="submit" value="提交退货单" class="submit m_left10">
                    <input type="submit" onclick="adressclose()" value="取消" class="submit m_left10">
                </p>
            </div>
        <?php } ?>
    </div>
<?php endif; ?>
<?php
if ($data->Status == 1) {


//添加收货地址
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'myaddress',
        'options' => array(
            'title' => '添加收货地址',
            'width' => 500,
            'height' => 260,
            'autoOpen' => false,
            'resizable' => false,
            'modal' => true,
            'overlay' => array(
                'backgroundColor' => '#000',
                'opacity' => '0.5'
            ),
//                'buttons'=>array(     
//                    '添加'=>'js:function(){ window.open(Yii_baseUrl + "/pap/default/index","_black");}',     
//                    '取消'=>'js:function(){ $(this).dialog("close");}',     
//                    ),     
        ),
    ));
    echo $this->renderPartial('addadress', array('model' => $model));
    $this->endWidget('zii.widgets.jui.CJuiDialog');

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
}
?>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<script>
    //选择收货地址
    function addaddress(type)
    {
        $('#type').val(type);
        $('#addadress').show();
        $('#audittype').hide();
        if (type == 1) {
            $('#audittypes').html('支付宝担保');
        }
        if (type == 2) {
            $('#audittypes').html('物流代收款');
        }
    }
    //添加收货地址
    function newaddress()
    {
        $('#adresssumit').val('创建');
        $('#JpdReceiveAddress_ContactName').val('');
        $('#JpdReceiveAddress_State').val('370000');
        $('#JpdReceiveAddress_City').empty().append('<option value="">请选择市</option>');
        $('#JpdReceiveAddress_District').empty().append('<option value="">请选择区</option>');
        $('#JpdReceiveAddress_State').change();
        $('#JpdReceiveAddress_Address').val('');
        $('#JpdReceiveAddress_ZipCode').val('');
        $('#JpdReceiveAddress_Phone').val('');
        $('#JpdReceiveAddress_State').removeAttr('city');
        $('#JpdReceiveAddress_State').removeAttr('area');
        $('#myaddress').dialog('open');
    }
    //修改收货地址
    function updateaddress(ID) {
        $('#myaddress').dialog('open');
        $('#adresssumit').val('保存');
        $('#adresssumit').attr('key', ID);
        var url = Yii_baseUrl + '/pap/buyorder/updateaddress';
        $.getJSON(url, {id: ID}, function(data) {
            $('#JpdReceiveAddress_ContactName').val(data.ContactName);
            $('#JpdReceiveAddress_State').val(data.State);
            $('#JpdReceiveAddress_State').attr('city', data.City);
            $('#JpdReceiveAddress_State').attr('area', data.District);
            $('#JpdReceiveAddress_State').change();
            $('#JpdReceiveAddress_Address').val(data.Address);
            $('#JpdReceiveAddress_ZipCode').val(data.ZipCode);
            $('#JpdReceiveAddress_Phone').val(data.Phone);
        });
    }
    //收货地址显示隐藏
    $('#table').each(function() {
        var self = $(this).find('tbody tr:gt(1)');
        self.length > 0 && self.hide() && $('.slider-controler').show() && $('.slider-controler').on('click', function() {
            self.toggle();
            self.filter(':hidden').length > 0 ?
                    $(this).html('显示全部地址<i class="icon-arr-b display-ib y-align-m"></i>') :
                    $(this).html('<span class="font-green">隐藏</span><i class="icon-arr-green-t display-ib y-align-m"></i>');
        });
    });
    //点击收货地址行显示边框

    $('#table tbody tr').live('click', function() {
        $(this).find('input[name=addr]').attr('checked', true);
        //去除同胞元素样式
        $(this).siblings().removeClass('table_bor');
        $(this).addClass('table_bor');
    })
    $('#submit').click(function() {
        var address = $('#table').find('input[name=addr]:checked').val();
        if (address == undefined)
        {
            alert('请选择收货地址');
            return false;
        }
        var ReturnID = $("#ReturnID").val();
        var type = $('#type').val();
        if (type == 1) {
            var url = Yii_baseUrl + '/pap/dealerreturn/returnpaypal/returnID/' + ReturnID + '/addressID/' + address;
        }
        if (type == 2) {
            var url = Yii_baseUrl + '/pap/dealerreturn/Returnpost/returnID/' + ReturnID + '/addressID/' + address;
        }
        location.href = url;
    })
    $('#pyp input[type=radio]').click(function() {
        var payment = $('#pyp input[type=radio]:checked').val();
        if (payment == 2) {
            $("#paypal").removeAttr("checked");
            $(this).attr('checked', 'checked');
        }
        location.href = Yii_baseUrl + '/pap/buyorder/delivery/payment/' + payment;
    });



    //取消添加地址
    function adressclose() {
        $('#addadress').hide();
        $('#auditgo').show();
        $('#returntype').hide();
        $('#type').val(1);
    }
    //添加收货地址保存
    $('#adresssumit').click(function() {

        var url = Yii_baseUrl + '/pap/buyorder/addaddress';
        var key = $('#adresssumit').attr('key');
        var name = $('#JpdReceiveAddress_ContactName').val();
        var province = $('#JpdReceiveAddress_State').val();
        var city = $('#JpdReceiveAddress_City').val();
        var area = $('#JpdReceiveAddress_District').val();
        var address = $('#JpdReceiveAddress_Address').val();
        var zipcode = $('#JpdReceiveAddress_ZipCode').val();
        var phone = $('#JpdReceiveAddress_Phone').val();
        var submit = 1;
        $('#address-form').find('input[type="text"]').each(function(i, v) {
            if ($(this).val() == '') {
                $(this).focus();
                submit = 0;
            }
            if (i == 2 && $(this).val() != '') {
                //匹配手机号码格式是否正确
                var reg = /^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/;
                if (!reg.test(phone)) {
                    $(this).focus();
                    submit = 0;
                }
            }
            if (i == 3 && $(this).val() != '') {
                //匹配邮编是否正确
                var reg = /^[0-9][0-9]{5}$/;
                if (!reg.test(zipcode)) {
                    $(this).focus();
                    submit = 0;
                }
            }
        })
        $('#JpdReceiveAddress_City').focus();
        if (city == '') {
            submit = 0;
            $('#JpdReceiveAddress_City').blur();
        }
        if (submit == 0) {
            return false;
        }
        if (name != '')
        {
            $('#JpdReceiveAddress_ContactName_em_').text('');
        }
        if (province != '') {
            $('#JpdReceiveAddress_Province_em_').text('');
        }
        if (city != '') {
            $('#JpdReceiveAddress_City_em_').text('');
        }
        if (area != '') {
            $('#JpdReceiveAddress_Area_em_').text('');
        }
        if (address != '') {
            $('#JpdReceiveAddress_Address_em_').text('');
        }
        if (zipcode != '') {
            $('#JpdReceiveAddress_ZipCode_em_').text('');
        }
        if (phone != '') {
            $('#JpdReceiveAddress_Phone_em_').text('');
        }
        if ($('.errorMessage').text() != '')
        {
            return false;
        } else {
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    'key': key,
                    'name': name,
                    'province': province,
                    'city': city,
                    'area': area,
                    'address': address,
                    'zipcode': zipcode,
                    'phone': phone
                },
                dataType: 'json',
                //同步  
                async: false,
                success: function(data) {
                    if (data.success == 1)
                    {
                        $("#myaddress").html('<span style="color:blue">地址添加成功,页面即将刷新!</span>');
                        var ReturnID = $("#ReturnID").val();
                        var type = $('#type').val();
                        var url = Yii_baseUrl + '/pap/dealerreturn/audit/ID/' + ReturnID + '/type/' + type;
                        setTimeout(function() {
                            location.href = url;
                        }, 1000);
                    } else {
                        return false;
                    }
                }
            });
        }
    });

    $(document).ready(function() {
        //商品详情
        $('.order_goods').bind('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=GoodsID]').val($(this).attr('goodsid'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        })



        //去掉table样式
        $("table tbody tr").mouseover(function() {
            $(this).css("background", "white")
        })


        var status = $('i.step-point').attr('status');
        switch (status) {
            case '1':
                $('i.step-point').css({'left': '28%'});
                break;
            case '2':
                $('i.step-point').css({'left': '48%'});
                break;
            case '3':
                $('i.step-point').css({'left': '68%'});
                break;
            case '4':
                $('i.step-point').css({'left': '88%'});
                break;
            case '5':
                $('i.step-point').css({'left': '23.5%'});
                break;
            case '6':
                $('i.step-point').css({'left': '73.5%'});
                break;
        }
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");

        })
    })
    //审核通过
    function auditok() {
        $('#auditgo').hide();
        $('#returntype').show();
        $('#addadress').show();
    }
    //审核通过-取消
    function auditokno() {
        $('#auditgo').show();
        $('#returntype').hide();
    }
    //审核通过-支付宝担保
    function auditok1() {
        var ReturnID = $("#ReturnID").val();
        var url = Yii_baseUrl + '/pap/dealerreturn/returnpaypal/returnID/' + ReturnID;
        location.href = url;
    }
    //审核通过-物流代收款
    function auditok2() {
        var ReturnID = $("#ReturnID").val();
        var url = Yii_baseUrl + '/pap/dealerreturn/Returnpost/returnID/' + ReturnID;
        location.href = url;
    }
    /*
     *审核未通过
     */
    function auditno() {
        $('#auditfail').dialog('open');
        var html = '';
        html += "<input type='hidden'>";
        html += "  <span  style='vertical-align: top;'>审核不通过的原因:</span><textarea rows='6' cols='60' id='noinfo'></textarea>"
        $('#addfail').html(html);
    }
    /*
     *保存审核未通过原因
     */
    function save() {
        var 　NoResult = $("#noinfo").val();
        var ReturnID = $("#ReturnID").val();
        var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/noaudit') ?>";
        $.getJSON(url, {ID: ReturnID, noinfo: NoResult}, function(data) {
            if (data) {
                var url = "<?php echo Yii::app()->createUrl('pap/dealerreturn/index') ?>";
                location.href = url;
                return true;
            } else {
                alert('保存失败');
                return false;
            }
        });



    }

    //收货处理
    function getgoods() {
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
            var ReturnID = $('#ReturnID').val();
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

    /*
     * 审核取消
     */
    function auditexit() {
        var url = Yii_baseUrl + '/pap/dealerreturn/index';
        window.location.href = url;
    }
</script>
