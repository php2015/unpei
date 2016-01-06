<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/goodsinfo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/jpd/page.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/detail.css" />
<style>
    /*#make-car-m {border:2px solid #f2b303;left: 380px!important; top: 360px!important; }*/
    #make-car-mall,#make-car-m {border:2px solid #f2b303;}
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
    .content2a{border: none}
    .zxq_yh{width:100px}
    .content1a{width:350px; height: 435px}
    #comment_span{cursor:pointer}
    .span1{display: block;float:left;text-align: right;width: 70px;}
    .goods_info li{list-style:decimal}
    .fw1{border-bottom: 1px dashed orangered;}
    .p_number{padding:10px 0 0 10px; height:28px; line-height:28px; margin-top:0px}
    p.gm {margin-top: 10px;}
    .dialog{
        background-color: #FBFCFC;
    }
    .dialog_title{
        padding-left: 8px;
        background-color: #ffe2e2;
        font-weight: bold;
        color: #FF6600;
        height: 28px;
        line-height: 28px;
        vertical-align:middle;
        display: none;
    }
    .dialog_hide{
        font-weight: bold;
        text-align: center;
        height: 28px;
        line-height: 28px;
        display: none;
    }
    .dialog_true{height: 28px;line-height: 28px;}
    .dialog_right{color: green;}
    .dialog_error{color: red;}
    .dialog_button {width: 50px;height: 26px;line-height: 26px;background: #F00;border: none;color: #fff;font-weight: bold;}
    .zoomdiv{margin-left:210px!important}
    .btn-green-tiny{background:#ff6600;color:#fff}
    .sptj ul li{list-style:disc;}
    .sptj ol li{list-style:decimal;}
    .sptj ol {padding-left:20px;}
    .sptj ul {padding-left:20px;}
</style>
<?php
$cartid = Yii::app()->request->getParam('cart');
if ($cartid) {
    $locatecarmodel = MallService::getlocalcarmodel(array('from' => 'cart', 'ID' => $cartid));
}
$orderid = Yii::app()->request->getParam('order');
if ($orderid) {
    $locatecarmodel = MallService::getlocalcarmodel(array('from' => 'order', 'ID' => $orderid));
}
?>
<div class="wrap-contents" style="background:#fff;width:990px;padding:5px; margin-top:5px; border:1px solid #ccc">
    <div class="contents" style="padding-bottom:0px">
        <div class="sp_mbx">
            <ul class="sp_mbx_ul">
                <li><?php if ($r['BigName']): ?><b><a><?php echo $r['BigName'] ?></a> ></b><?php endif; ?></li>
                <li><span><?php if ($r['SubName']): ?><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $r['sub'])) ?>">
                                <?php echo $r['SubName'] ?></a> ></span></li>
                    <li> <span><?php if ($r['StandCodeName']): ?><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $r['sub'], 'code' => $r['StandCode'])) ?>">
                                    <?php echo $r['StandCodeName'] ?></a> ></span> 
                        <?php endif; ?><?php endif; ?></li>
                <li><span><?php echo $r['Name'] ?></span></li>
            </ul>
        </div>
        <div class="content1" target="default" id="default">
            <div class="content1a float_l">
                <!--图片切换-->
                <div id=preview>
                    <?php if (!empty($r['img']) && is_array($r['img'])): ?>
                        <div class=jqzoom id=spec-n1 >
                            <IMG height=350 src="<?php echo F::uploadUrl() . $r['img'][0]['ImageUrl'] ?>" jqimg="<?php echo F::uploadUrl() . $r['img'][0]['BigImage'] ?>" width=350>
                        </div>
                    <?php else: ?>
                        <IMG height=350 src="<?php echo F::uploadUrl() . 'common/goods-img-big.jpg' ?>"  width=350>
                    <?php endif; ?>
                    <?php if (!empty($r['img']) && is_array($r['img'])): ?>
                        <div id=spec-n5>
                            <!--                            <div class=control id=spec-left>
                                                            <img src="<?php //echo Yii::app()->theme->baseUrl;         ?>/images/papmall/left.gif" />
                                                        </div>-->
                            <div id=spec-list>
                                <ul class=list-h>
                                    <?php if ($r['img']):foreach ($r['img'] as $v): ?>
                                            <li><img src="<?php echo F::uploadUrl() . $v['BigImage'] ?>" > </li>
                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <li><img src="<?php echo F::uploadUrl() . 'dealer/goods-img-big.jpg' ?>"> </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!--                            <div class=control id=spec-right>
                                                            <img src="<?php //echo Yii::app()->theme->baseUrl;         ?>/images/papmall/right.gif" />
                                                        </div>-->
                        </div>
                    <?php endif; ?>
                </div> 
                <!--end-->
            </div>

            <div class="content1b float_l">
                <p class="title"><?php echo $r['Name'] ?></p>
                <input type="hidden" name="minTurnover" value="<?php echo $r['MinTurnover'] ?>">
                <?php if ($r['IsPro'] == 1): ?>
                    <p class="ck_price">促销价：￥<span class="cck_price"><?php echo $r['ProPrice'] ?></span></p>
                    <p class="sc_price">参考价：￥<span class="ssc_price"><?php echo $r['Price'] ?></span></p>
                <?php elseif ($r['DisPrice']): ?>
                    <p class="ck_price">折扣价：￥<span class="cck_price"><?php echo $r['DisPrice'] ?></span></p>
                    <p class="sc_price">参考价：￥<span  class="ssc_price"><?php echo $r['Price'] ?></span></p>
                <?php else: ?>
                    <p class="ck_price">参考价：￥<span  class="cck_price"><?php echo $r['Price'] ?></span></p>
                <?php endif; ?>
                <p class="pf">商品评分：<span class="sppf"></span><a class="lanse" id="comment_span" href="#comm_show">（已有<?php echo $r['CommentNo'] ? $r['CommentNo'] : 0 ?>条评价）</a></p>
                <p class="bh">商品编号：<span><?php echo $r['GoodsNO'] ?></span></p>
                <p class="fw">标准名称：<span><?php echo $r['StandCodeName'] ?></span></p>
                <?php if ($locatecarmodel): ?><p class="fw">定位车型：<span><?php echo $locatecarmodel; ?></span></p><?php endif; ?>
                <div class="dialog">
                    <div class="dialog_title">请选择年款车型查看是否适用<span id="dialog_close" style="float:right;margin-right: 8px;cursor:pointer;color:#F00;">Ｘ</span></div>
                    <div>
                        <p class="dialog_1"><span class="dialog_1" style="color: orangered;font-weight: bold;">适用车系：</span>
                            <?php $carmodeltextarr = explode(" ", $carmodeltext); ?>
                            <span style="font-weight: bold;" >厂家：</span><span class='makes'><?php echo $carmodeltextarr[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="font-weight: bold;" >车系：</span><span class='cars'><?php echo $carmodeltextarr[1]; ?></span>
                        </p>
                        <p>
                            <span style="font-weight: bold;">年款：</span>
                            <select name="year" class="select years" style="width:80px;">
                            </select>
                            <br /><span style="font-weight: bold;">车型：</span>
                            <select name="model" class="select models"></select>
                            <input id="fit_input" type="hidden" value="<?php echo $res['success'] == 1 ? 1 : 0 ?>" />
        <!--                    <span id="fit_span" style="color:<?php //echo $res['success'] == 1 ? 'green' : 'red'                                                                                                                                                                                                                                       ?>"><?php //echo $res['fit']                                                                                                                                                                                                                                       ?></span>-->
                        </p>
                        <div style="clear:both"></div>         
                    </div>
                    <div class="p_number">
                        <span class="float_l" style="padding-left:10px"> 购买数量：</span>
                        <div class="f_l add_chose">
                            <a class="reduce_num" href="javascript:void(0)"></a>
                            <input type="text" name="qty_item_1" value="1" id="qty_item" class="text" onBlur="setAmount(this);"/>
                            <a class="add_num" href="javascript:void(0)"></a>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <p class="bh dialog_1">服务：由<span class="lanse"><?php echo $r['OrganName'] ?></span><span>从<?php echo $r['Address'][0] . $r['Address'][1] ?>发货，并提供售后服务</span></p>
                    <p class="gm dialog_1" goodsid="<?php echo $r['GoodsID'] ?>"><button class="addgwc">加入购物车</button>
                        <button class="ljgm" id="quickbuy" goodsid="<?php echo $r['GoodsID']; ?>">立即购买</button></p>
                    <div class="dialog_right dialog_hide">该车型适用！</div>
                    <div class="dialog_error dialog_hide">该车型不适用，请重新选择车型！</div>
                    <div class="dialog_true dialog_hide"><button id="model_true" class="dialog_button">确定</button></div>
                </div>
            </div>
            <!--content1b结束-->

            <div class="content1c float_l" style="height:auto">
                <div class="shop_name" style="border-bottom: 1px solid #f0f0f0;line-height:16px;">
                    <div style="float:left;width:70px;text-align: right;margin:5px 0px">卖家：</div>
                    <div class="lanse float_l" style="width:140px;margin:5px 0px"><?php echo $r['OrganName'] ?></div>
                    <div style="clear:both"></div>
                </div>
                <p class="shop_pf">综合评分：<span class="shop_zhpf"></span><span class="font">9.7分</span></p>
                <p class="shop_pf">平台管理分值：<span class="font"><?php echo $r['TotalScore'] ?>分</span></p>
                <div class="shop_info">
                    <p>评分明细</p>
                    <ul>
                        <li>商品评分：<span class="sppf"></span></li>
                        <li>服务评分：<span class="sppf"></span></li>
                        <li>时效评分：<span class="sppf"></span></span></li>
                    </ul>
                </div>
                <div class="shop_addr" style="margin:5px 0 0 22px">
                    <div style="float:left;">所在地：</div>
                    <div style="width:130px;float: left"><?php echo $r['Address'][0] . $r['Address'][1] . $r['Address'][2] ?></div>
                </div>
                <div style="clear:both"></div>
                <p class="shop_lianjie"><a href="<?php echo Yii::app()->createUrl('pap/sellerstore/index', array('dealerid' => $r['OrganID'])) ?>" class="" dealer="<?php echo $r['OrganID']; ?>">进入卖家店铺</a></p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="content2">
            <div class="content2a float_l" >
                <!--店内分类-->
                <div class="content2a2" style="margin-top:0px">
                    <?php $this->renderPartial('/sellerstore/category', array('cate' => $cate, 'dealerid' => $r['OrganID'])) ?>
                </div>

                <!--店长推荐开始-->
                <div class="content2a3">
                    <?php $this->widget('widgets.papmall.MReGoods', array('sellerID' => $r['OrganID'])); ?>
                </div> 
                <!--店长推荐结束-->
            </div>
            <!--content2a结束-->
            <div class="content2b float_r">
                <div class="content2b1"> 
                    <div id="tab">
                        <div class="t_head">
                            <ul class="tab_menu  float_l">
                                <li class="selected">商品详情</li>
                                <li id="comm_show">商品评价</li>
                                <li>发货公告</li>
                            </ul>
                        </div>

                        <div style="clear:both"></div>
                        <div class="tab_box">
                            <div class="spxq">
                                <div> 
                                    <ul>
                                        <li title="<?php echo $r['GoodsNO'] ?>">商品编号：<?php echo $r['GoodsNO'] ?></li>
                                        <li title="<?php echo $r['StandCodeName'] ?>">标准名称：<?php echo  $r['StandCodeName'] ?> </li>
                                        <li>品牌：<?php echo $r['Brand'] ?></li>
                                        <li title="<?php
                                        $PartsLevel = $r['PartsLevel'];
                                        echo Yii::app()->getParams()->PartsLevel[$PartsLevel]
                                        ?>">配件档次：<?php
                                                $PartsLevel = $r['PartsLevel'];
                                                echo Yii::app()->getParams()->PartsLevel[$PartsLevel]
                                                ?></li>
                                        <li title="<?php echo $r['spec']['BganCompany'] ?>">标杆品牌：<?php echo $r['spec']['BganCompany'] ?></li>
                                        <li title="<?php echo $r['spec']['BganGoodsNO'] ?>">标杆商品号：<?php echo $r['spec']['BganGoodsNO'] ?></li>
                                        <li>单位：<?php echo $r['spec']['UnitName'] ?></li>
                                        <li>最小包装数：<?php echo $r['pack']['MinQuantity'] ?></li>
                                        <li>保修类型:
                                            <?php
                                            switch ($r['spec']['ValidityType']) {
                                                case 1:
                                                    echo '不保修';
                                                    break;
                                                case 2:
                                                    echo '包装车';
                                                    break;
                                                case 3:
                                                    echo '保修' . $r['spec']['ValidityDate'];
                                                    break;
                                            }
                                            ?>
                                        </li>
                                        <div style="clear:both;padding:0px"></div>
                                    </ul>
                                    <div style="clear: both; padding:0px"></div>
                                    <p>OE号：<?php echo is_array($r['oeno']) ? implode(',', $r['oeno']) : '' ?></p>
                                    <p style="color:#ff5500;word-break:break-all;line-height:20px;">特征说明：<?php echo $r['Memo'] ?></p><br/>
                                    <div class="goods_info" style="word-wrap:break-word;padding:0px"><?php echo $r['Info'] ?></div>   
                                </div></div>

                            <!--  商品评价 -->
                            <div class="hide sppj">
                                <?php
                                $this->widget('widgets.papmall.MGoods', array('GoodsID' => $r['ID'], 'OrganID' => $r['OrganID']));
                                ?> 
                            </div>

                            <!--发货公告--> 
                            <div class="hide  sptj">
                                <?php echo!empty($data->Content) ? $data->Content : '暂无公告'; ?>
                                <div style="clear:both"></div> 
                            </div>
                        </div>
                    </div>
                </div>              
            </div>
            <div style="clear:both"></div>
        </div>  
    </div>
</div>
<?php //$this->widget('widgets.default.WCustomerService'); ?>
<?php
//最小交易额弹框
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'bunow',
    'options' => array(
        'title' => '提示信息',
        'width' => 400,
        'height' => 200,
        'autoOpen' => false,
        'resizable' => false,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
        'buttons' => array(
            '继续采购' => 'js:function(){ $("#bunow").dialog("close");}',
//            '立即购买' => 'js:function(){ 
//                          var goodsID = $("#quickbuy").attr("goodsid");
//                          var quant = $("#qty_item").val();      
//                          var nurl = Yii_baseUrl + "/pap/buyorder/buynow/goodsid/"+goodsID+"/goods_amout/"+quant+"";
//                            window.open(nurl,"_blank");
//                      }',
        ),
    ),
));
echo '<div id="minorder">最小交易额</div> ';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?> 
<script type=text/javascript>
    //购买状态  1：加入购物车   2：立即购买
    var buystatus = 0;
    $(document).ready(function() {
        $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYear', {seriesId: "<?php echo $car['series']; //$cookie['mallseries']->value;                                                                                                                                                                                                                                       ?>"}, function(result) {
            $("select[name=year]").append('<option value="">不确定年款</option>');
            var mallyear = "<?php echo $car['year']; //$cookie['mallyear']->value;                                                                                                                                                                                                                                      ?>";
            $.each(result, function(index, year) {
                if (index != 0) {
                    if (mallyear == year.year) {
                        var li = ' <option value="' + year.year + '" selected="selected">' + year.year + '</option>';
                    } else {
                        var li = ' <option value="' + year.year + '">' + year.year + '</option>';
                    }
                    $("select[name=year]").append(li);
                }
            });
            $("select[name=year]").change();
        });
        $("select[name=year]").change(function() {
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYearModels', {seriesId: "<?php echo $car['series']; //$cookie['mallseries']->value;                                                                                                                                                                                                                                       ?>", year: $("select[name=year]").val()}, function(result) {
                $("select[name=model]").empty();
                $("select[name=model]").append('<option value="">不确定车型</option>');
                var mallmodel = "<?php echo $car['model']; //$cookie['mallmodel']->value;                                                                                                                                                                                                                                      ?>";
                $.each(result, function() {
                    if (mallmodel == this.modelId) {
                        var li = ' <option value="' + this.modelId + '" selected="selected">' + this.name + '</option>';
                    } else {
                        var li = ' <option value="' + this.modelId + '">' + this.name + '</option>';
                    }
                    $("select[name=model]").append(li);
                })
            })
        });
        //改变车型
        $("select[name=model]").change(function() {
            var data = {};
            data.goodsid = "<?php echo $r['GoodsID'] ?>";
            data.make = "<?php echo $car['make']; //$cookie['mallmake']->value;                                                                                                                                                                                                                                       ?>";
            data.series = "<?php echo $car['series']; //$cookie['mallseries']->value;                                                                                                                                                                                                                                       ?>";
            data.year = $("select[name=year]").val();
            data.model = $("select[name=model]").val();
            $.post(Yii_baseUrl + '/pap/mall/checkcarfit', {data: data}, function(result) {
                if (result.success) {
                    $('.fw1').css('border', '0px');
                    $('.dialog').css('border', '2px solid #D60000');
                    $('.dialog_title').css('display', 'block');
                    $('.dialog_1').css('display', 'none');
                    $('.dialog_error').css('display', 'none');
                    $('.dialog_right').css('display', 'block');
                    $('.dialog_true').css('display', 'block');
                    $('#fit_input').val(1);
                } else {
                    $('.fw1').css('border', '0px');
                    $('.dialog').css('border', '2px solid #D60000');
                    $('.dialog_title').css('display', 'block');
                    $('.dialog_1').css('display', 'none');
                    $('.dialog_right').css('display', 'none');
                    $('.dialog_true').css('display', 'none');
                    $('.dialog_error').css('display', 'block');
                    $('#fit_input').val(0);
                }
            }, 'JSON')
        });
        //关闭
        $("#dialog_close").live('click', function() {
            $('.fw1').css('border-bottom', '1px dashed orangered');
            $('.dialog').css('border', '0px');
            $('.dialog_title').css('display', 'none');
            $('.dialog_1').css('display', 'inline-block');
            $('.dialog_right').css('display', 'none');
            $('.dialog_true').css('display', 'none');
            $('.dialog_error').css('display', 'none');
        });
        //确定
        $("#model_true").live('click', function() {
            $('.fw1').css('border-bottom', '1px dashed orangered');
            $('.dialog').css('border', '0px');
            $('.dialog_title').css('display', 'none');
            $('.dialog_1').css('display', 'inline-block');
            $('.dialog_right').css('display', 'none');
            $('.dialog_true').css('display', 'none');
            $('.dialog_error').css('display', 'none');
            if (buystatus == 1) {
                $(".addgwc").click();
            } else if (buystatus == 2) {
                $("#quickbuy").click();
            }
        });

        //添加到购物车
        $(".addgwc").bind({
            'click': function() {
                buystatus = 1;
                //没有选择适用车型提示选择
                if ($('select[name=model]').val() == "") {
                    $('.fw1').css('border', '0px');
                    $('.dialog').css('border', '2px solid #D60000');
                    $('.dialog_title').css('display', 'block');
                    $('.dialog_1').css('display', 'none');
                    return false;
                }
                //不适用
                if ($('#fit_input').val() == 0) {
                    $('.fw1').css('border', '0px');
                    $('.dialog').css('border', '2px solid #D60000');
                    $('.dialog_title').css('display', 'block');
                    $('.dialog_1').css('display', 'none');
                    $('.dialog_error').css('display', 'block');
                    return false;
                }
                var goodsID = $('p.gm').attr('goodsid');
                var quant = $("#qty_item").val();
                issale(goodsID);
                addGoodsToCar(goodsID, quant);
            }
        })
    });

    function addGoodsToCar(goodsid, quant) {
        var make = "<?php echo $car['make']; ?>";
        var series = "<?php echo $car['series']; ?>";
        var year = $('select[name="year"]').val();
        var model = $('select[name="model"]').val();
        var locate = make + '_' + series + '_' + year + '_' + model;
        $.getJSON("<?php echo Yii::app()->createUrl('pap/mall/addgoodstocar') ?>",
                {goodsid: goodsid, quant: quant, locate: locate},
        function(data) {
            //alert(data);return false;
            //getCartCount();
            if (data) {
                alert('添加成功！');
                getCartCount();
            }
        });
    }

    //立即购买
    $("#quickbuy").live({
        'click': function() {
            buystatus = 2;
            //没有选择适用车型提示选择
            if ($('select[name=model]').val() == "") {
                $('.fw1').css('border', '0px');
                $('.dialog').css('border', '2px solid #D60000');
                $('.dialog_title').css('display', 'block');
                $('.dialog_1').css('display', 'none');
                return false;
            }
            //不适用
            if ($('#fit_input').val() == 0) {
                $('.fw1').css('border', '0px');
                $('.dialog').css('border', '2px solid #D60000');
                $('.dialog_title').css('display', 'block');
                $('.dialog_1').css('display', 'none');
                $('.dialog_error').css('display', 'block');
                return false;
            }
            var goodsID = $(this).attr('goodsid');
            $.getJSON(Yii_baseUrl + '/pap/mall/issale',
                    {goodsid: goodsID},
            function(data) {
                //getCartCount();
                if (data) {
                    alert(data.message);
                    return false;
                } else {
                    var quant = $("#qty_item").val(); //数量
                    //var organName = $('.lanse').text();
                    var price = $(".ssc_price").text(); //参考价
                    var proPrice = $(".cck_price").text(); //促销价
                    //  var logisPrice = $("input[name=logisprice]").val();   //物流费
                    var minTurnover = $("input[name=minTurnover]").val(); //获取该商品经销商设置的订单最小交易额
                    var organname = '<?php echo $r['OrganName'] ?>';
                    if (proPrice == '') {
                        var orderAmount = parseFloat(price) * 1000 * parseInt(quant) / 1000;
                    } else {
                        var orderAmount = parseFloat(proPrice) * 1000 * parseInt(quant) / 1000;
                    }
                    if (orderAmount >= minTurnover) {
                        var make = "<?php echo $car['make']; ?>";
                        var series = "<?php echo $car['series']; ?>";
                        var year = $('select[name="year"]').val();
                        var model = $('select[name="model"]').val();
                        var locate = make + '_' + series + '_' + year + '_' + model;
                        var url = Yii_baseUrl + "/pap/buyorder/buynow/goodsid/" + goodsID + "/goods_amout/" + quant + "/locate/" + locate;
                        window.open(url, '_self');
                    } else {
                        var html = '';
                        html += "<div><span style='padding-left:20px'><?php echo $r['OrganName'] ?>单笔订单最小交易金额为￥" + minTurnover + "元<\span>\n\
          \n\<br/><br/><span style='color:red;font-size:11px'>&nbsp;&nbsp;&nbsp;&nbsp;对不起，您购买的商品未超过" + organname + "最小金额,请您继续采购！</span></div>"
                        $('#minorder').html(html);
                        $('#bunow').dialog('open');
                    }
                }
            });
        }
    });

    function changevehicle() {
        var data = {};
        data.make = $('#papmall_make').val();
        data.series = $('#papmall_series').val();
        data.year = $('#papmall_year').val();
        data.model = $('#papmall_model').val();
        $.post(Yii_baseUrl + '/pap/mall/getvehicle', {data: data}, function(result) {
            if (result) {
                ajaxLoadEnd();
                location.reload();
            }
        }, 'JSON');
    }
</script>
