<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/css/cart/gwc.css' ?>" />
<style>
    .shop_company_list {
        border-bottom: 1px solid #d2d6d9;
        height: 140px;
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
        line-height: 25px;
        padding: 5px 0 0 100px;
    }
    .select{padding:3px 0px}
    .display-n{ color:#EC8051}
    .goodname{font-size:14px; font-weight: bold}
    .addr table{width:988px; margin:0px;}

    .addr table td{text-align:center}
    .dd_info_lm span{font-weight:bold}
    .select{margin-top:0px}
    .addr input{margin-top:0px}
    .shop_company{line-height:30px; margin-top:10px}
</style>
<?php
$locatecar = Yii::app()->request->getParam('locate');
$locate = explode('_', $locatecar);
$locatecarmodel = MallService::getCarmodeltxt(array('make' => $locate[0], 'series' => $locate[1], 'year' => $locate[2], 'model' => $locate[3]));
?>
<div class="wrap-contents" style="background:#fff;border:1px solid #ccc;padding:5px; width:990px;margin-top:5px">
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
        <form id="orderform" action="<?php echo Yii::app()->createUrl('/pap/buyorder/buynoworder') ?>" method="post">
            <input type="hidden" name="goodsid" value="<?php
            if (!empty($goods) && is_array($goods)): echo $goods['GoodsID'];
            endif;
            ?>"/>
            <input type="hidden" name="quantity" value="<?php
            if (!empty($amount)): echo $amount;
            endif;
            ?>"/>
            <!--定位车型-->
            <input name="locate" type="hidden" value="<?php echo $locatecar; ?>">
            <input type="hidden" name="usecouponID">
            <!-- 支付方式{-->
            <div class="gwc_list_lm">
                <img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/gwc_tb.jpg' ?>"/>
                <span>选择支付方式</span>
            </div>
            <div style="height:60px;" id="buypay">
                <input type="radio" name="payment" value="1" style="margin:10px 10px 10px 20px; vertical-align: middle" <?php
                if ($_GET['payment'] == 1) {
                    echo 'checked=checked';
                } else {
                    echo 'checked=checked';
                }
                ?>>&nbsp;支付宝担保交易
                       <?php if (($_GET['payment'] == 1 || !isset($_GET['payment'])) && $goods['discount'] != 100): ?>
                           <?php echo '<span style="color:red;padding-left:20px">您可以享受使用支付宝担保付款,订单打<span class="pyte"style="color:red;"></span>折的优惠！</span>' ?>
                       <?php endif; ?>
                <br>
                <input type="radio" name="payment" value="2"   <?php if ($_GET['payment'] == '2') echo 'checked=checked' ?> style="margin:10px 10px 10px 20px; vertical-align: middle;margin-left:20px">&nbsp;物流代收款
                <?php if ($_GET['payment'] == 2 && $goods['discount'] != 100): ?>
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
                                    <td class="width50"><input type="radio" name="addr" value="<?php echo $address[$key]['ID'] ?>"> </td>
                                    <td><?php echo $address[$key]['ZipCode'] ?></td>
                                    <td style="color:#666;"> 
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
                    </div></div>

            <?php } ?>
            <!--确认订单信息-->
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

            <div class="shop_company" style="width:990px; ">
                <div style="width:33%; float:left; text-align: center"><span>&nbsp;&nbsp;经销商：<a href="<?php echo Yii::app()->createUrl("servicer/servicedetail/detail/dealer"); ?>/<?php echo $goods["SellerID"] ?>" target="_blank">
                        <?php echo $goods["OrganName"]; ?></span></a>
                    <?php if (isset($goods['discount']) && !empty($goods['discount']) && $goods['discount'] != 100) { ?>
                        <span  class="pypls" style='color:#E97816;padding-left:-30px'> 
                            <?php
                            if ($_GET['payment'] == 1) {
                                echo ' 支付宝订单打';
                            } else if ($_GET['payment'] == 2) {
                                echo ' 物流代收订单打';
                            }
                            ?>
                            <?php
                            $OrderAlipay = $goods['discount'] / 10;
                            echo $OrderAlipay;
                            ?>折</span>
                    <?php } ?>
                    <input type="hidden" id="discountt" value="<?php echo $OrderAlipay ?>">
                </div>
                <div style="width:33%; float:left; text-align: center"><span>物流配送:</span> 
                    <?php $status = D::getLogistics($goods["SellerID"]); ?>
                    <?php //var_dump($cart["SellerID"]); ?>
                    <?php echo CHtml::dropDownList('Logistics', $Logistics, $status, array('class' => 'width188 select Logistics', 'style' => 'width:180px', 'empty' => '请选择物流')); ?>
                    &nbsp;&nbsp;</div>  <div style="width:33%; float:left; text-align: center" class="logis"><label>物流公司：</label>
                    <input type="text" name="logistics[]" value=""  class="input abc"/></div>
                <input type="hidden"  name="goodsid" value="<?php echo $goods['GoodsID'] ?>">
                <input type="hidden" name="goods_amount" value="<?php echo $amount ?>">
                <div style="clear:both"></div>
            </div>  

            <div class="shop_company_list">
                <div class="goods_list" style="width: 420px; float:left">
                    <dl>
                        <dt style="float: left">
                        <a class="goodname" href="<?php echo Yii::app()->createUrl('pap/mall/detail') ?>/goods/<?php echo $goods['GoodsID'] ?>" target="_blank" title="<?php echo $goods['Name'] ?>">
                            <img src="<?php echo $goods['Images'][0]['ImageUrl'] ? F::uploadUrl() . $goods['Images'][0]['ImageUrl'] : F::uploadUrl() . 'common/default-goods.png' ?>"  width="80" height="80"/></dt>
                        </a>
                        <dd style="color: #42B241;overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" >
                            <a class="goodname" href="<?php echo Yii::app()->createUrl('pap/mall/detail') ?>/goods/<?php echo $goods['GoodsID'] ?>" target="_blank" title="<?php echo $goods['Name'] ?>">
                            <?php echo $goods['Name'] ?></dd>
                        </a>
                        <dd>商品编号:<?php echo $goods['GoodsNO'] ?>| 品牌:<?php echo $goods['BrandName'] ?> | 标准名称:<?php echo $goods['CpName'] ?></dd>
                        <dd>定位车型:<?php echo $locatecarmodel; ?></dd>
                    </dl>
                </div>
                <?php $min_price = $goods['MinTurnover'] ? $goods['MinTurnover'] : 0; ?>
                <div class="price" style="width:150px;padding-top:58px;float:left; padding-left:20px ">
                    <?php if ($goods["ProPrice"]): ?>
                        <?php $count += $goods["ProPrice"] * $amount; ?>    
                        <!--最小金额-->
                        <?php if ($goods['discount'] != 100): ?>
                            <s><font color="#E97816">￥<?php echo $goods["ProPrice"]; ?></font></s>
                        <?php endif; ?>
                        <p>￥<?php echo round($goods["ProPrice"] * $goods['discount'] / 100, 2); ?>
                        <?php else: ?>      <!-- 折扣价与参考价相等（无折扣，即折扣率为100%时） -->
                            <?php $count += $goods["DisPrice"] * $amount; ?>

                            <?php if ($goods['discount'] != 100) { ?>
                            <s><font color="#E97816">￥<?php echo $goods["DisPrice"]; ?></font></s>
                        <?php }; ?>
                        <p><font color="#E97816">￥<?php echo round($goods["DisPrice"] * $goods['discount'] / 100, 2); ?></font></p>
                    <?php endif; ?>
                </div>

                <div class="count" style="width:60px;padding-top:58px; float:left;margin-left: 40px;text-align: center;">
                    <?php echo $amount; ?>
                </div>
                <div class="price_2 " style="padding-top:58px; float:left;width:100px;width: 130px;margin-left: 35px;text-align: center;">
                    <span >
                        <?php if ($goods['discount'] != 100): ?>
                            <s style="color:#E97816">￥<?php echo sprintf("%.2f", $count); ?></s><br/>
                        <?php endif; ?>
                            <?php $pricess=$goods["ProPrice"]?$goods["ProPrice"]:$goods["DisPrice"];?>
<!--                        <b style="color:#E97816">￥<?php //echo sprintf("%.2f", round($count * $goods['discount'] / 100, 2)); ?></b>-->
<b style="color:#E97816">￥<?php echo sprintf("%.2f", round($pricess * $goods['discount'] / 100, 2))*$amount; ?></b>
                    </span>
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="sumtotal2 m-top" >
                <div style="text-align:left;line-height: 20px; float: right">
                    <?php
                    $yuan = sprintf("%.2f", $count + $ship);
                    $zhi =  sprintf("%.2f", round($pricess * $goods['discount'] / 100, 2))*$amount;
                    $cha = $yuan - $zhi;
                    $cha = sprintf("%.2f", $cha);
                    $realamount=sprintf("%.2f", round($pricess * $goods['discount'] / 100, 2))*$amount;
                    $organID=Yii::app()->user->getOrganID();
                    $data=BuyGoodsService::activeorgan();
                      $params=array();
                      if(in_array($organID,$data))
                      {
                         $act=BuyGoodsService::active();
                         $payment=!empty($_GET['payment'])?$_GET['payment']+1:'2';
                      }
                    ?>
                    <?php if ($cha != 0): ?>
                        应付金额：<b><span style="color:#E97816;font-size:16px">￥<?php echo sprintf("%.2f", $count + $ship) ?></span></b><br>
                    <?php endif; ?>
                    <?php if ($cha != 0): ?>
                        <span style="padding-left:24px"> 优惠：</span>
                        <?php if ($_GET['payment'] == 1 || !isset($_GET['payment'])): ?>
                            <?php echo ' <b style="color:#E97816;font-size:16px">-￥' . $cha . "</b>&nbsp;(使用支付宝担保支付,立省)" ?>
                        <?php endif ?>
                        <?php if ($_GET['payment'] == 2): ?>
                            <?php echo ' <b style="color:#E97816;font-size:16px">-￥' . $cha . "</b>&nbsp;(使用物流代收支付,立省)" ?>
                        <?php endif ?><br>
                        <?php $ship += $goods['LogisticsPrice'] * $amount; ?>
                    <?php endif; ?>
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
                                 $params['TotalAmount']=$realamount;
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
                                            echo "<span style='color:#e97816'>参与促销优惠活动:-".$act_res['DecrTotal']."<br>(单笔订单每满 ￥".$act_res['MinAmount']." 减￥".$act_res['DecrAmount'].")</span><br>";
                                           }
                                         break;
                                     case 3:
                                         //优惠券
                                         $act_res=  BuyGoodsService::coupondecre($params);
                                          if($realamount>=$act_res['MinAmount']&&$num==1){
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
                               if(!empty($coupon)&&is_array($coupon)){
                                             echo "<span class='cup' style='color:#e97816'><input type='checkbox' class='clpayper'><span class='payper' >使用我的优惠券</span><br>(您可以使用优惠券，减免订单金额,每次只限一张)</span><br>";
                                         }
                             ?>
                    实际支付：<b>
                        <span style="color:#E97816;font-size:16px">￥</span> <span class="alltotal" style="color:#E97816;font-size:16px">
                            <?php
                              //如果存在优惠活动金额
                        if(isset($order_decr)&&!empty($order_decr)){
                             $realamount= $realamount-$order_decr;
                        }
                        echo $realamount;
                         // echo sprintf("%.2f", round($pricess * $goods['discount'] / 100, 2))*$amount;
                            //echo round(($count + $ship) * $goods['discount'] / 100, 2);
                            ?>  </span></b>(含运费:￥<?php echo sprintf("%.2f", $ship); ?>)<!-- 商品小
                    -->               

                    <div class="clear" style="clear:both"></div>  


                    <p class="refer" style="margin-top:10px"><a href="<?php echo Yii::app()->createUrl('pap') ?>"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/back.jpg' ?>">返回商城</a>
                        <input type="submit" id="submit" value="提交订单" class="submit button2 m_left10"></p>

                </div>  
                <div style=" clear: both"></div>    
            </div> 
        </form>
    </div>
</div>
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
                    '取消'=>'js:function(){ $(this).dialog("close");$(".clpayper").prop("checked",false)}',     
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
            if (i == 3 && $(this).val() != '') {     //匹配邮编是否正确
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
                async: false, success: function(data) {
                    if (data.success == 1)
                    {
                        //$('#myaddress').dialog('close');
                        $("#myaddress").html('<span style="color:blue">地址添加成功,页面即将刷新!</span>');
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
        $('.logis').find('input[type=text]').val(logistics);
        // $(this).parent().find('input').val(logistics);
    })
    //收货地址显示隐藏
    $('#table').each(function() {
        var self = $(this).find('tbody tr:gt(1)');
        self.length > 0 && self.hide() && $('.slider-controler').show() && $('.slider-controler').on('click', function() {
            self.toggle();
            self.filter(':hidden').length > 0 ?
                    $(this).html('显示全部地址<i class="icon-arr-b display-ib y-align-m"></i>') :
                    $(this).html('<span class="font-green"  style="color:#EC8051">隐藏部分地址</span><i class="icon-arr-green-t display-ib y-align-m"></i>');
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
//        $("#orderform").submit();
//       $("#submit").attr('disabled', true);
 $("#orderform").submit(function(e){
             $("#submit").attr('disabled', true);
        });
      
    })
    $('#buypay input[type=radio]').click(function() {
        var payment = $('#buypay input[type=radio]:checked').val();
        if (payment == 2) {
            $("#paypal").removeAttr("checked");
            // $('#paypal').attr('checked',false);
            $(this).attr('checked', 'checked');
        }
        var goodsid = $('input[name=goodsid]').val();
        var amount = $('input[name=goods_amount]').val();
        var url = "<?php echo Yii::app()->request->getUrl(); ?>"
        location.href = Yii_baseUrl + '/pap/buyorder/buynow/goodsid/' + goodsid + '/goods_amout/' + amount + '/payment/' + payment + '/locate/<?php echo $_GET['locate']?>';
    })
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
    //关闭按钮
    $('.ui-dialog-titlebar-close').live('click',function(){
       $('.clpayper').prop('checked',false);
    })
</script>