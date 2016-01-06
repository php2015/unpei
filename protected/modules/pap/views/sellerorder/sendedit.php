<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    .cancelbtn{height:30px;width:60px;cursor:pointer;line-height:24px}
    .price{height:20px;text-align:right;padding-right:8px}
    .div_img{padding:8px 8px 0 8px;width:95px}
    .div_img img{width:95px}
    div.div_info{ text-align:left;width:300px}
    tr.order_bd td {vertical-align: middle;}
    .goods_name a{font-size:14px;font-weight:bold;}
    .goods_name{height: 26px;line-height: 26px;overflow: hidden;margin-top:9px}
    .goods_attr{height: 23px;line-height: 23px;overflow: hidden;}
    .goods_side{display:block;float:left}
    .goods_num{max-width:120px;display:block;float:left;cursor:pointer}
    .cut{white-space: nowrap;overflow: hidden; text-overflow: ellipsis}
    .txxx2{ border-bottom:1px solid #c5d2e2}
</style>
<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '订单修改'
        )
?>
<div class="bor_back m-top">     
    <div class="txxx txxx2">
        第一步&nbsp;&nbsp;确认订单信息
    </div>
    <!--    <div class="ddxx" id="">
            <input type="hidden" name="ddorder" value="<?php echo $data->ID ?>">
            <input type="hidden" name="shipcost" value="<?php echo $data->ShipCost ?>">
        </div>-->
    <div class="info-box ">
        <p class="m-top20"><b>收货地址：</b>
        <ul class="mjxx m-top last">
            <p><?php echo SellerorderService::getOrderAddress($data->ID) ?></p>
        </ul>
        <div style="clear:both"></div>
        <p class="m-top20"><b>订单信息</b></p>
        <ul class="mjxx m-top last">
            <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
            <li>订单编号：<span><?php echo $data->OrderSN ?></span></li>
            <li>买家名称：<span><?php echo $data->BuyerName ?></span></li>
        </ul>
        <div style="clear:both"></div>
        <table class="m-top20 order_table">
            <thead>
                <tr class="order_state_hd"><td>商品信息</td><td>单价（元）</td><td> 数 量 </td><td>商品总价（元）</td><td> 状 态 </td></tr>
            </thead> 
            <tbody>
                <?php
                if ($data->goodsinfo): $count = count($data->goodsinfo);
                    foreach ($data->goodsinfo as $k => $v):
                        ?>
                        <tr class="order_bd">
                            <td>
                                <div class="div_img float_l m_left12">
                                    <a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                                        <?php if (!$v['ImageUrl']): ?>
                                            <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="90px" height="90px" style="margin-top:20px">
                                        <?php else: ?>
                                            <img src="<?php echo F::uploadUrl() . $v['ImageUrl']; ?>" width="90px" height="90px" style="margin-top:20px">
                                        <?php endif; ?>
                                    </a>
                                </div> 
                                <div class="div_info float_l m-left5">
                                    <p class="goods_name cut"><a class="order_goods" title="<?php echo $v['GoodsName'] ?>" href="<?php echo Yii::app()->CreateUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'])) ?>" target="_blank" version="<?php echo $v['Version'] ?>" goodsid="<?php echo $v['GoodsID'] ?>">
                                            <?php echo $v['GoodsName'] ?></a>
                                    </p>
                                    <p class="goods_attr"><span class='goods_side'>商品编号：</span>
                                        <span class="zwq_color goods_num cut" title='<?php echo $v['GoodsNum'] ?>'><?php echo $v['GoodsNum'] ?></span>
                                        <span class='goods_side'>&nbsp;|&nbsp;品牌：<?php echo $v['Brand'] ?></span>
                                    </p>
                                    <p class="goods_attr">标准名称：<span><a title="<?php echo $v['CpName'] ?>"><?php echo $v['CpName'] ?></a></span></p>
                                    <p class="goods_attr">配件档次：<span><a title="<?php echo $v['PartsLevelName'] ?>"><?php echo $v['PartsLevelName'] ?></a></span> </p>
                                    <p class="goods_attr cut">定位车型：<span><a title="<?php echo $v['Carmodeltxt'] ?>"><?php echo $v['Carmodeltxt'] ?></a></span> </p>
                                    <p class="goods_attr cut">OE号：<span><a title="<?php echo $v['GoodsOE'] ?>"><?php echo $v['GoodsOE'] ?></a></span> </p>
                                </div>
                            </td>               
                            <td> <span class="zwq_color">
                                    ￥<?php echo $v->ProPrice ?>
                                </span>
                            </td> 
                            <td name="goods"><span><?php echo $v->Quantity ?></span></td>    
                            <td name="total">  <div class="zwq_color">￥<?php echo $v->GoodsAmount ?></div></td>
                            <?php if ($k == 0): ?>
                                <td rowspan="<?php echo $count ?>"> <span><?php echo SellerorderService::showOrderStatus($data->Status) ?></span></td> 
                            <?php endif; ?>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>                 
        </table>
        <p align="right" class="m-top f_weight shifukuan">实付款：<span class="zwq_color">￥<?php echo $data->RealPrice ?></span></p>
    </div>
</div>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        第二步&nbsp;&nbsp;修改物流信息
    </div>
    <div class="order m-top">        
        <div class="txxx_info2a">
            <p><label class=" m_left24"><span style="color:red">*</span>物流公司名称：</label>
                <select class="select select2" id="ShipLogis">
                    <option value ="">手动输入物流公司</option>
                    <?php foreach ($logCompany as $v): ?>
                        <option value ="<?php echo $v['LogisticsCompany'] ?>" <?php echo $v['LogisticsCompany'] == $data['ShipLogis'] ? 'selected' : ''; ?>>
                            <?php echo $v['LogisticsCompany'] ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" class=" input input3 width150" value="<?php echo $data['ShipLogis'] ?>" name="ShipLogis" key="<?php echo $data['ShipLogis'] ?>">
                <span style="color:green">（提示：不超过20个字）</span>
            </p>
            <p class="m-top"><label style="margin-left:48px">运单号码：</label>
                <input type="text" class=" input input3 width150" name="ShipSn" value="<?php echo $data['ShipSn'] ?>" key="<?php echo $data['ShipSn'] ?>">
                <span style="color:green">（提示：不超过10个字）</span>
            </p>
        </div>
    </div>
</div>
<div class="m-top" style="padding-left:300px">
    <input type="submit"  class="submit m_left f_weight edit"  value="保&nbsp;存">
    <input type="button"  class="cancelbtn m_left f_weight"  value="取消">
</div>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<!--content2结束-->
<!--content1即又半部分结束-->
<script>
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
        //商品详情
        $('.order_goods').bind('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=GoodsID]').val($(this).attr('goodsid'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        });

        $('#ShipLogis').change(function() {
            if ($(this).val() != '') {
                $('input[name=ShipLogis]').val($(this).val());
            }
            else {
                $('input[name=ShipLogis]').val('');
            }
        })

        //取消
        $('.cancelbtn').click(function() {
            if (confirm('您确定要放弃修改吗？')) {
                window.history.go(-1);
                // window.location.href=Yii_baseUrl+'/pap/sellerorder';
            }
        })
        //表格选中取消
        $('table tbody tr').mouseover(function() {
            $(this).css("background", "none")
        })

        //订单改价
        $('.edit').click(function() {
            var ShipLogis = $.trim($('input[name=ShipLogis]').val());
            var ShipSn = $.trim($('input[name=ShipSn]').val());
            var ShipLogiskey = $('input[name=ShipLogis]').attr('key');
            var ShipSnkey = $('input[name=ShipSn]').attr('key');
            if (ShipLogis == ShipLogiskey && ShipSn == ShipSnkey) {
                alert('您还未做任何修改！');
                return false;
            }
            if (ShipLogis == '' || ShipLogis.length > 20) {
                //alert('请选择正确的物流公司！');
                $('input[name=ShipLogis]').focus();
                return false;
            }
            if (ShipSn.length > 10) {
                //alert('运单号码不超过10个字');
                $('input[name=ShipSn]').focus();
                return false;
            }
            $.post(Yii_baseUrl + "/pap/sellerorder/editsendorder",
                    {ShipLogis: ShipLogis, ShipSn: ShipSn, ID:<?php echo $_GET['order'] ?>}, function(result) {
                if (result.success) {
                    alert('订单保存成功！');
                    window.history.go(-1);
                    // window.location.href=Yii_baseUrl+'/pap/sellerorder/index';
                }
                else {
                    alert(result.msg);
                    location.reload();
                }
            }, 'json');
        })
    })
</script>