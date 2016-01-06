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
//    '销售管理' => Yii::app()->createUrl('common/saleslist'),
//    '退货管理' => Yii::app()->createUrl('pap/dealerreturn/index'),
    '保证金管理',
    '质量保证金' => Yii::app()->createUrl('pap/cashdeposit/index/type/0/time/2'),
    '退货单详情',
);
?>  
<div class="bor_back m-top">              
    <div  class="ddxx" style="height: 30px">
        <p style="display: block;float: left;" >退货单信息</p>
        <div  style="width: 70px;float: right;padding-left: 30px;"><a onclick="backto()" herf="" style="cursor:pointer">返回列表</a></div>
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
            <div style="clear:both"></div>
            <p class="m-top20"></p>
        </ul>
        <div style="clear:both"></div>
        <p class="m-top20"><b>退款信息</b></p>
        <ul class="mjxx m-top last">
            <li>退款金额：<span><?php echo $cashinfo->Money ?></span></li>
            <li>退款时间：<span><?php echo date('Y-m-d H:i:s', $cashinfo->CreateTime) ?></span></li>
            <div style="clear:both"></div>
            <p class="m-top20"></p>
        </ul>
        <div style="clear:both"></div>
        <p class="m-top"></p>

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
                                <div class="div_img float_l m-top5"><a class="order_goods" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>"  href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank"  title="<?php echo $goods['GoodsInfo']['Name']; ?>" ><img src="
                                        <?php
                                        if ($goods['GoodsInfo']['img'][0]['ImageUrl']) {
                                            echo F::uploadUrl() . $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                        } else {
                                            echo F::uploadUrl() . 'common/default-goods.png';
                                        }
                                        ?>" style="width: 90px;height: 100px;"></a></div> 
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
    </div>
</div>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<script>
    $(document).ready(function() {
    })
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
    function backto() {
        window.history.go(-1);
    }
</script>
