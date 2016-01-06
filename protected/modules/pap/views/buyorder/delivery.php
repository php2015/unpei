<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/css/cart/gwc.css' ?>" />
<style>
    .shop_company_list {
        border-bottom: 1px solid #d2d6d9;
        height: 130px;
        margin: 0 auto;
        padding-left: 10px;
        width: 97%;
    }
    .goods_list {
        float: left;
        margin-right: 70px;
        padding: 20px 0 0 20px;
        width: 40%;
    }
    .goods_list dl dd {
        line-height: 20px;
        margin: 5px 0 0 100px;
    }
    .select{padding:3px 0px}
    .display-n{ color:#EC8051}
    .goodname{font-size:14px; font-weight: bold}
    .addr table{width:979px; margin:0px;}

    .addr table td{text-align:center}
    .dd_info_lm span{font-weight:bold}
    .select{margin-top:0px}
    .addr input{margin-top:0px}
    .shop_company{line-height:30px; margin-top:10px}
</style>
<div class="wrap-contents"  style="border:1px solid #ccc; background:#fff;padding:5px; margin-top: 5px; width:990px">
    <p class="gwc_lm"><span class="gwc_lm_info">我的购物车</span></p>
    <div class="step">

        <div class="step_info">
            <ul>
                <li>
                    <i><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/step2.jpg' ?>"></i><br>
                    <span>1.确认商品信息</span>
                </li>
                <li>
                    <i><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/step1.jpg' ?>"></i><br>
                    <span  class="span_color">2.选择收货地址</span>
                </li>
                <li>
                    <i><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/step2.jpg' ?>"></i><br>
                    <span>3.付款</span>
                </li>
            </ul>
        </div> 


    </div>
    <!--  <div class=" m-top gwc_list">-->
    <!--    <div class="gwc_list_info">-->
    <div class="addr">
        <form id="orderform" action="<?php echo Yii::app()->createUrl('/pap/buyorder/addorder') ?>" method="post">
            <input type="hidden" name="cartIDs" value="<?php if (!empty($cartIDs) && is_array) echo implode(",", $cartIDs) ?>">
            <input type="hidden" name="purchase" value="<?php echo $purchase; ?>">
            <input type="hidden" name="usecouponID">
            <?php
            if ($purchase) {
                Yii::app()->session['cart'] = implode(",", $cartIDs);
            }
            ?>
            <?php Yii::app()->session['var'] = implode(",", $cartIDs); ?> 

            <!-- 支付方式{-->
            <div class="gwc_list_lm">
                <img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/gwc_tb.jpg' ?>"/>
                <span>选择支付方式</span>
            </div>
            <div style="height:60px;" id="pyp">
                <input type="radio" id='paypal' name="payment" value="1" style="margin:10px 10px 10px 20px;*margin-bottom:0px" <?php
                if ($_GET['payment'] == 1) {
                    echo 'checked=checked';
                } else {
                    echo 'checked=checked';
                }
                ?>>
                &nbsp;支付宝担保交易
                <?php if (($_GET['payment'] == 1 || !isset($_GET['payment'])) && $result[0]['discount'] != 100): ?>
                    <?php echo '<span style="color:red;padding-left:20px">您可以享受使用支付宝担保付款,订单打<span class="pyte"style="color:red;"></span>折的优惠！</span>' ?>
                <?php endif; ?>
                <br>
                <input type="radio" name="payment" value="2"  <?php if ($_GET['payment'] == '2') echo 'checked=checked' ?> style="margin:10px 10px 30px 10px;*margin-bottom:0px;margin-left:20px">&nbsp;&nbsp;物流代收款
                <?php if ($_GET['payment'] == 2 && $result[0]['discount'] != 100): ?>
                    <?php echo '<span style="color:red;padding-left:20px">您可以享受网上下单，订单打<span class="pyte" style="color:red;"></span>折的优惠！</span>' ?>
                <?php endif; ?>

            </div>
            <!--end-->
            <div class="gwc_list_lm m-top"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/gwc_tb.jpg' ?>">
                <span>选择收货地址</span><a class="m_left24" href="javascript:void(0)"  onclick="newaddress();">使用新地址</a></div>
            <?php if (isset($address) && !empty($address)) { ?>
                <div style="border:1px solid #e1e1e1; margin:5px">
                    <table id="table">
                        <thead style="background:#f6f6f6">
                            <tr class="bd-tb control">
                                <td width="27" style="padding-left:30px">选择</td>
                                <td width="75">邮政编码</td>
                                <td width="200">详细地址</td>
                                <td width="100">电话号码</td>
                                <td width="60">修改</td>
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
                    </div> </div>
            <?php } ?>
            <div class="gwc_list_lm" style="margin-top:15px">
                <img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/gwc_tb.jpg' ?>"/>
                <span>确认订单信息</span>
            </div>
            <div class="goodslist" style="margin-top:10px">
                <p style="height:30px; line-height: 30px; background: #f6f6f6" class="dd_info_lm">
                    <span style="padding-left: 130px;">商品信息</span> 
                    <span style="margin-left: 75px;">&nbsp;</span>
                    <span style="padding-left: 290px;">单价</span>
                    <span style="padding-left: 160px;">数量</span>
                    <span style="padding-left: 90px;">小计</span>
                </p>
            </div>
            <?php if ($result): ?>
                <?php $count = 0; ?>
                <?php foreach ($result as $cart): ?>
                    <div class="shop_company" style="width:990px; ">
                        <div style="width:40%; float:left; "> <span style="margin-left:10px">&nbsp;&nbsp;经销商：<a href="<?php echo Yii::app()->createUrl("servicer/uniondealer/detail",array('dealer'=>$cart["SellerID"])); ?>" target="_blank">
                                <?php echo $cart["SellerName"]; ?></span></a>
                            <?php if (isset($cart['discount']) && !empty($cart['discount']) && $cart['discount'] != 100) { ?>
                                <span  class="pypl<?php echo $cart["SellerID"] ?>" style='color:#E97816;padding-left:-30px'> 
                                    <?php
                                    if ($payment == 1) {
                                        echo ' 支付宝订单打';
                                    } else if ($payment == 2) {
                                        echo ' 物流代收订单打';
                                    }
                                    ?>

                                    <?php
                                    $OrderAlipay = $cart['discount'];
                                    //  $OrderAlipay = substr($cart['discount'], 0, strlen($cart['discount']) - 1);
                                    echo $OrderAlipay / 10;
                                    ?>折</span><?php } ?>
                            <input type="hidden" id="discountt" value="<?php echo $OrderAlipay / 10 ?>">
                        </div>
                        <div style="width:26%; float:left; text-align: center"> <span >物流配送:</span> 
                            <?php $status = D::getLogistics($cart["SellerID"]); ?>
                            <?php //var_dump($cart["SellerID"]); ?>
                            <?php echo CHtml::dropDownList('Logistics', $Logistics, $status, array('class' => 'width188 select Logistics', 'id' => $cart["SellerID"], 'style' => 'width:180px', 'empty' => '请选择物流')); ?>
                        </div>
                        <div style="width:33%; float:left; text-align: center" class="log<?php echo $cart["SellerID"] ?>">
                            <label>物流公司：</label>
                            <input type="text" name="logistics[]" value=""  class="input abc"/>

                        </div>  
                        <div style="clear:both"></div>
                    </div>
                    <?php
                    $min_price = $cart['MinTurnover'] ? $cart['MinTurnover'] : 0;
                    ?>
                    <?php
                    $listCount = 0;
                    $count = 0;
                    foreach ($cart["GoodsList"] as $list) {
                        $listCount += $list['Quantity'];
                        if ($list['ProPrice']) {
                            $count +=$list['ProPrice'] * $list['Quantity'];
                            $counts +=round($list['ProPrice'] * $cart['discount'] / 100, 2) * $list['Quantity'];
                        } else {
                            $count +=$list['Price'] * $list['Quantity'];
                            $counts +=round($list['Price'] * $cart['discount'] / 100, 2) * $list['Quantity'];
                        }
                    }
                    $totals+=$count;
                    $minus = 0;
                    $total+=sprintf("%.2f", $count);
                    $cha = $total - $counts;
                    $cha = sprintf("%.2f", $cha);
                    ?> 
                    <?php foreach ($cart["GoodsList"] as $list): ?>       
                        <?php
                        if ($list['MakeID']) {
                            $locatecarmodel = MallService::getCarmodeltxt(array('make' => $list['MakeID'], 'series' => $list['CarID'], 'year' => $list['Year'], 'model' => $list['ModelID']));
                            $goodsurl = Yii::app()->createUrl('pap/mall/detail', array('goods' => $list['GoodsID'], 'cart' => $list['ID']));
                        } else {
                            $goodsurl = Yii::app()->createUrl('pap/mall/detail', array('goods' => $list['GoodsID']));
                        }
                        ?>
                        <div class="shop_company_list">
                            <div class="goods_list" style="width: 420px;">
                                <dl>
                                    <dt style="float: left">
                                    <a class="goodname" href="<?php echo $goodsurl ?>" target="_blank" title="<?php echo $list['GoodsName'] ?>">
                                        <img src="<?php echo $list['ImageUrl'] ? F::uploadUrl() . $list['ImageUrl'] : F::uploadUrl() . 'common/default-goods.png' ?>"  width="80" height="80"/></dt>
                                    </a>
                                    <dd style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        <a class="goodname" href="<?php echo $goodsurl ?>" target="_blank" title="<?php echo $list['GoodsName'] ?>">
                                        <?php echo $list['GoodsName'] ?> 
                                               </a>
                                    </dd>
                                 
                                    <dd>商品编号:<?php echo $list['GoodsNum'] ?>| 品牌:<?php echo $list['Brand'] ?> </dd>
                                    <dd> 标准名称:<?php echo $list['CpName'] ?></dd>
                                    <?php if($locatecarmodel):?><dd>定位车型：<span><?php echo $locatecarmodel; ?></dd><?php endif;?>
                                </dl>
                            </div>
                            <div class="price" style="width:150px; margin-left: 530px;padding-top:58px;">

                                <?php if ($list['ProPrice']): ?>
                                    <?php if ($cart['discount'] != 100): ?>
                                        <s><font color="#E97816">￥<span class="pro<?php echo $cart['SellerID'] ?>"><?php echo $list['ProPrice']; ?></span></font></s>
                                    <?php endif; ?>

                                    <?php if (isset($cart['discount']) && !empty($cart['discount']) && $cart['discount'] != 100) { ?>
                                        <p><font color="#E97816">￥<span class="ttz<?php echo $cart['SellerID'] ?>"><?php echo round($list['ProPrice'] * $cart['discount'] / 100, 2); ?></span></font></p>
                                    <?php } else { ?>
                                        <p><font color="#E97816">￥<span class="ttz<?php echo $cart['SellerID'] ?>"><?php echo $list['ProPrice']; ?></span></font></p>
                                    <?php } ?>

                                <?php else: ?>
                                    <p><font color="#E97816">￥<span class="pro<?php echo $cart['SellerID'] ?>"><?php echo $list['Price']; ?></span></font></p>
                                    <?php if (isset($cart['discount']) && !empty($cart['discount']) && $cart['discount'] != 100) { ?>
                                        <p><font color="#E97816">￥<span class='ttz<?php echo $cart['SellerID'] ?>'><?php echo round($list['Price'] * $cart['discount'] / 100, 2); ?></span></font></p>
                <?php } ?>
                                <?php endif ?>
                            </div>
                            <div class="count" style="width:60px;padding-left:740px;margin-top:-18px;*margin-top:-30px ">
                                <?php echo $list['Quantity']; ?>
                            </div>
                            <div class="price_2" style="padding-left:840px; margin-top:-20px;*margin-top:-30px ">
                                    <?php $price = $list['ProPrice'] ? ( round($list['ProPrice'] * $cart['discount'] / 100, 2) ) * $list['Quantity'] : ( round($list['Price'] * $cart['discount'] / 100, 2)) * $list['Quantity']; ?>
                                    <?php $oldprice = $list['ProPrice'] ? $list['ProPrice'] * $list['Quantity'] : $list['Price'] * $list['Quantity']; ?>
                                <span >
                                    <?php if ($cart['discount'] != 100): ?>
                                        <s style="">￥<span class="ckp<?php echo $cart['SellerID'] ?>"><?php echo sprintf('%.2f', $oldprice) ?></span></s><br/>
            <?php endif; ?>
                                    <b class="" style="">￥<span  style="margin-top:10px" class="ckzp<?php echo $cart['SellerID'] ?> tal"><?php echo $price ?></span></b>
                                </span>
                            </div>
                        </div>

                        <?php //$ship += $list['ShipCost'] * $list['Quantity'];  ?>
        <?php endforeach; ?>
                        <?php endforeach; ?>
                <div class="sumtotal2 m-top" style="">
                    <div style="text-align:left;line-height: 20px; float: right">
                        <?php
                         $organID=Yii::app()->user->getOrganID();
                         $data=BuyGoodsService::activeorgan();
                         $params=array();
                         if(in_array($organID,$data))
                         {
                            $act=BuyGoodsService::active();
                            $payment=!empty($_GET['payment'])?$_GET['payment']+1:'2';
                         }
                        $cha = $totals - $counts;
                        $cha=  sprintf("%.2f",$cha);
                        if ($cha!= 0 ):
                            ?>
                            应付金额：<b><span style="color:#E97816;font-size:16px">
                                    <s style="color:#E97816;font-size:16px">￥<?php echo sprintf("%.2f", $totals); ?></s>
                                </span>
                            </b><br>
                        <?php endif; ?>

                        <div style=" clear: both"></div>
                            <?php if ($cha != 0): ?>
                            <span style='padding-left:24px'>立省：</span><span style="word-wrap: break-word;word-break : break-all;width:500px;">
                                <?php if ($_GET['payment'] == 1 || !isset($_GET['payment'])): ?>
                                    <?php echo '<b style="font-size:16px;margin-left:2px;color:#E97816;">-￥' . $cha . "</b>&nbsp;(使用支付宝担保支付,立省)" ?>
                                <?php endif ?>
                        <?php if ($_GET['payment'] == 2): ?>
                                <?php echo ' <b style="color:#E97816;font-size:16px;margin-left:2px;">-￥' . $cha . "</b>&nbsp(使用物流代收支付,立省)" ?>
                            <?php endif ?>
                            </span><br>
                         <?php endif ?>
                            <?php
                            //获取使用优惠券
                            $res= BuyGoodsService::mycoupon();
                            $coupon=$res->getData();
                            if(in_array($organID,$data)){
                            $act=BuyGoodsService::active();
                             if(!empty($act)&& is_array($act)){
                                 //判断当前日期是否在当天
                                  //$in_day=OrderService::is_inday($act['LastTime']);
                                 $current_date=  OrderService::is_current_date();
                                 if($current_date){
                                     $curret_time=$current_date['LastTime'];
                                     $num=$current_date['Num']+1;
                                 }else{
                                     $curret_time=time();
                                     $num=1;
                                 }
                                  $in_day=OrderService::is_inday($curret_time);
                                   //判断当前日期是否在当天 支付方式是哪一种则参与活动
                                 if(($act['Payment']==$payment ||$act['Payment']==1)&& $in_day==1){
                                 $params['PromoID']=intval($act['ID']);
                                 $params['TotalAmount']=$counts;
                                 switch ($act['Type']){
                                     case 1:
                                         //满多少减多少
                                         $act_res=BuyGoodsService::decre($params);
                                         if(!empty($act_res)&&is_array($act_res)){
                                             if(!empty($act_res['DecrAmount']))
                                             echo "<span style='color:#e97816'>参与促销优惠活动:-￥".$act_res['DecrAmount']."<br>(单笔订单满 ￥".$act_res['MinAmount']." 减￥".$act_res['DecrAmount'].")</span>";
                                         }
                                         $order_decr=$act_res['DecrAmount'];
                                         break;
                                     case 2:
                                         //每满减
                                           $act_res=BuyGoodsService::pperdecre($params);
                                           $order_decr=$act_res['DecrTotal'];
                                           if(!empty($order_decr)){
                                            echo "<span style='color:#e97816'>参与促销优惠活动:-".$act_res['DecrTotal']."<br>(单笔订单每满 ￥".$act_res['MinAmount']." 减￥".$act_res['DecrAmount'].")</span>";
                                           }
                                         break;
                                     case 3:
                                         //优惠券;
                                         $act_res=  BuyGoodsService::coupondecre($params);
                                         if($counts>=$act_res['MinAmount']&&$num==1){
                                             echo "<div class='info'><input type='hidden' class='mina' name='minamount' value=".$act_res['MinAmount'].">";
                                          //  echo "<span style='color:red'>单笔订单满".$act_res['MinAmount']."元,系统将赠送您价值".$act_res['DecrAmount']."元优惠券".$act_res['Num']."张</span><br>";
                                            echo "<span style='color:#e97816'>您将有机会参与抽奖活动</span>";
                                             echo "<input type='hidden' name='lott' value='1'>";
                                             echo "<input type='hidden' name='PromoID' value=".$act_res['PromoID']."></div>";
                                             }
                                          break;
                                    }
                                 }
                             }
                            }
                             if(!empty($coupon)&&is_array($coupon))
                            {
                              echo "<span class='cup' style='color:#e97816'><input type='checkbox' class='clpayper'><span class='payper' >使用我的优惠券</span><br>(您可以使用优惠券，减免订单金额,每次只限一张)</span>";
                             }
                             ?>
                            
                        <div class="clear"></div>  <!-- 用于清楚浮动-->
                        实际支付：<b><span style="color:#E97816;font-size:16px">
                                ￥<span class="alltotal" style="color:#E97816;font-size:16px">
                        <?php
                        //如果存在优惠活动金额
                        if(isset($order_decr)&&!empty($order_decr)){
                             $counts= $counts-$order_decr;
                        }
                        echo sprintf("%.2f", $counts + $ship); ?>
                                </span>
                            </span></b>&nbsp;(含运费：￥<?php echo sprintf("%.2f", $ship); ?>)
                        <div class="clear"></div>  
                        <div class="clear" style=""></div>  
                        <p class="refer" style="margin-top:10px;margin-right: 64px">
                        <?php if (!$purchase) { ?>
                                <a href="<?php echo Yii::app()->createUrl('pap/buyorder/cart') ?>"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/back.jpg' ?>">返回购物车</a>
    <?php } ?>
                            <input type="submit" id="submit" value="提交订单" class="submit button2 m_left10"></p>
<?php endif; ?></div>            
                <div style=" clear: both"></div>    
            </div>  
        </form>
    </div> 
</div>
<!--    </div>-->
<!--</div>-->
<?php
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
?> 


<?php
//我的优惠券
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'actpaper',
    'options' => array(
        'title' => '我的优惠券',
        'width' => 500,
        'height' => 360,
        'autoOpen' => false,
        'resizable' => false,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
                'buttons'=>array(     
                    '确定使用'=>'js:function(){ choosecoupon()}',     
                    '取消'=>'js:function(){ $(this).dialog("close"); $(".clpayper").prop("checked",false);}',     
                    ),     
    ),
));
echo $this->renderPartial('coupon',array('dataProvider'=>$dataProvider));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?> 
<script type="text/javascript">
    var dis = $('#discountt').val();
    $('.pyte').text(dis);
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
                        // $("#myaddress").html('<span style="color:blue">地址添加成功,页面即将刷新!</span>');
                        setTimeout("location.reload()", 1000);
                    } else {
                        return false;
                    }
                }
            });
        }
    });
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
    //选择物流公司
    $('.Logistics').change(function() {
        var logistics = $(this).val();
        var target = $(this).attr('id');
        $('.log' + target).find('input[type=text]').val(logistics);
        //$(this).parent().find('input').val(logistics);
    })
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
        
        $("#orderform").submit(function(e){
             $("#submit").attr('disabled', true);
        });
       
         
      
    })
    $('#pyp input[type=radio]').click(function() {
        var payment = $('#pyp input[type=radio]:checked').val();
        var purchase = $('input[name=purchase]').val();
        if (payment == 2) {
            $("#paypal").removeAttr("checked");
            $(this).attr('checked', 'checked');
        }
        location.href = Yii_baseUrl + '/pap/buyorder/delivery/payment/' + payment + '/purchase/' + purchase;
    });
    $('.clpayper').click(function(){
       if($(this).prop('checked')){
        $('#actpaper').dialog('open');
    }
    })
    function choosecoupon(){
       var check=$('#coup-grid').find("input[type=checkbox]:checked").val();
       var url=Yii_baseUrl+'/pap/buyorder/coupon';
       if(check==undefined){
           alert('请选择您要使用的优惠券');
           return false;
        }
        $.getJSON(url,{couponID:check},function(data){
            var html="使用优惠券:-￥"+data.Amount+"";
            var minamount=$('.mina').val();
            var alltotal=parseFloat($('.alltotal').text());
            var total= (parseFloat($('.alltotal').text())-data.Amount).toFixed(2);
            if(alltotal<data.Amount){
                total=0.00;
            }
            if(parseFloat(total)<parseFloat(minamount)){
                $('.info').empty();
            }
            $('.cup').html(html);
            $('#orderform').find('input[name=usecouponID]').val(data.ID);
            $('.alltotal').text(total);
            $('#actpaper').dialog('close');
        })
       
    }
    $('.ui-dialog-titlebar-close').live('click',function(){
       $('.clpayper').prop('checked',false);
    })
</script>