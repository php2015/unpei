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
    .p_number{margin-top:10px}
    p.gm{margin-top:20px}
    .kf{display:none}
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
<div class="wrap-contents" style="background:#fff; border:1px solid #ccc; padding:5px; margin-top:5px; width:990px">
    <div class="contents" style="padding-bottom:0px">
        <p class="sp_mbx">
            <?php if ($r['BigName']): ?><b><a><?php echo $r['BigName'] ?></a> ></b><?php endif; ?>
            <span><?php if ($r['SubName']): ?><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $r['sub'])) ?>">
                        <?php echo $r['SubName'] ?></a> ><?php endif; ?> 
                <?php if ($r['StandCodeName']): ?><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $r['sub'], 'code' => $r['StandCode'])) ?>">
                        <?php echo $r['StandCodeName'] ?></a> > <?php endif; ?><span class="sp_name"><?php echo $r['Name'] ?></span></span>
        </p>
        <div class="content1" target="default" id="default">
            <div class="content1a float_l">
                <!--图片切换-->
                <div id=preview>
                    <div class=jqzoom id=spec-n1 >
                        <IMG height=350 src="<?php echo F::uploadUrl() . $r['Images'][0]['ImageUrl'] ?>" jqimg="<?php echo F::uploadUrl() . $r['Images'][0]['BigImage'] ?>" width=350>
                    </div>
                    <div id=spec-n5>
                        <div class=control id=spec-left>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/left.gif" />
                        </div>
                        <div id=spec-list>
                            <ul class=list-h>
                                <?php if ($r['Images']):foreach ($r['Images'] as $v): ?>
                                        <li><img src="<?php echo F::uploadUrl() . $v['BigImage'] ?>"> </li>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </ul>
                        </div>
                        <div class=control id=spec-right>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/right.gif" />
                        </div>
                    </div>
                </div> 
            </div>

            <div class="content1b float_l">
                <p class="title"><?php echo $r['Name'] ?></p>
                <input type="hidden" name="minTurnover" value="<?php echo $r['MinTurnover'] ?>">
                <div class="price">
                    <p class="ck_price">交易价：￥<span  class="cck_price"><?php echo $r['Price'] ?></span></p>
                </div>
                <p class="pf">商品评分：<span class="sppf"></span><a class="lanse" id="comment_span" href="#comm_show">（已有<?php echo $r['CommentNo'] ? $r['CommentNo'] : 0 ?>条评价）</a></p>
                <p class="bh">商品编号：<span class="sp_number"><?php echo $r['GoodsNO'] ?></span></p>
                <p class="fw">标准名称：<span><?php echo $r['StandCodeName'] ?></span></p>
                <p class="fw">定位车型：<span><?php echo $carmodeltext; ?></span></p>
                <div class="dialog">
                    <div class="dialog_title">请选择年款车型查看是否适用<span id="dialog_close" style="float:right;margin-right: 8px;cursor:pointer;color:#F00;">Ｘ</span></div>
                    <div class="vehicle">
                    </div>
                    <div class="p_number">
                        <span class="float_l" style="padding-left:10px"> 购买数量：</span>
                        <div class="f_l add_chose">
                            <a class="reduce_num" href="javascript:void(0)"></a>
                            <input type="text" name="qty_item_1" value="1" id="qty_item" class="text" onBlur="setAmount(this);"/>
                            <a class="add_num" href="javascript:void(0)"></a>
                        </div>
                    </div>
                    <p class="bh dialog_1">服务：由<span class="lanse"><?php echo $r['OrganName'] ?></span>
                        <span>从<?php echo $r['Address'][0] . $r['Address'][1] ?>发货，并提供售后服务</span>
                    </p>
                    <?php if ($car['make'] && $car['make']): ?>
                        <p class="gm dialog_1" goodsid="<?php echo $r['GoodsID'] ?>">
                            <button class="ljgm" id="buyagain" goodsid="<?php echo $r['GoodsID'] ?>">再次购买</button>
                        </p>
                    <?php endif; ?>
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
                <p class="shop_lianjie"><a href="<?php echo Yii::app()->createUrl('pap/sellerstore/index', array('dealerid' => $r['SellerID'])) ?>" class="modelrequireds" dealer="<?php echo $r['SellerID']; ?>">进入卖家店铺</a></p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="content2">
            <div class="content2a float_l">
                <!--店内分类-->
                <div class="content2a2">
                    <?php $this->renderPartial('/sellerstore/category', array('cate' => $cate, 'dealerid' => $r['SellerID'])) ?>
                </div>

                <!--店长推荐开始-->
                <div class="content2a3">
                    <?php $this->widget('widgets.papmall.MReGoods', array('sellerID' => $r['SellerID'])); ?>
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
                                <ul>
                                    <div>
                                        <li>商品编号：<span class="sp_number"><?php echo $r['GoodsNO'] ?></span></li>
                                        <li>标准名称：<?php echo $r['StandCodeName']  ?></li>
                                        <li>品牌：<span class="sp_brand"><?php echo $r['BrandName'] ?></span></li>
                                        <li>配件档次：<span class="sp_pjdc"><?php
                                                $PartsLevel = $r['PartsLevel'];
                                                echo Yii::app()->getParams()->PartsLevel[$PartsLevel]
                                                ?></span>
                                        </li>
                                    </div>
                                    <div>
                                        <li>标杆品牌：<span class="sp_bgpp"><?php echo $r['BganCompany'] ?></span></li>
                                        <li>标杆商品号：<span class="sp_bgno"><?php echo $r['BganGoodsNO'] ?></span></li>
                                        <li>单位：<span class="sp_dw"><?php echo $r['UnitName'] ?></span></li>
                                        <li>最小包装数：<span class="sp_bzs"><?php echo $r['MinQuantity'] ?></span></li>
                                    </div>
                                    <li>保修类型:
                                        <?php
                                        switch ($r['ValidityType']) {
                                            case 1:
                                                echo '不保修';
                                                break;
                                            case 2:
                                                echo '包装车';
                                                break;
                                            case 3:
                                                echo '保修' . $r['ValidityDate'] . '月';
                                                break;
                                        }
                                        ?>
                                    </li>
                                </ul>
                                <div style="clear:both;padding:0px"></div>
                                <p style="padding:10px 10px 5px 10px">OE号：<span class="sp_oe"><?php echo $r['OENO'] ?></span></p>
                                <p style="color:#ff5500;word-break:break-all;line-height:20px;padding:0 10px">特征说明：
                                    <span class="sp_tzsm"><?php echo $r['Memo'] ?></span>
                                </p><br/>
                                <div class="goods_info" style="word-wrap:break-word;margin:0 15px">
                                    <span class="sp_info"><?php echo $r['Info'] ?></span>
                                </div>   
                            </div>

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
<?php $this->widget('widgets.default.WCustomerService'); ?>
<script type=text/javascript>
    //购买状态  1：加入购物车   2：立即购买
    var buystatus = 0;
    $(document).ready(function() {
        $("select[name=year]").live('change', function() {
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYearModels', {seriesId: "<?php echo $car['series']; //$cookie['mallseries']->value;                                                                                                                                                                                                                                                                                                                             ?>", year: $("select[name=year]").val()}, function(result) {
                $("select[name=model]").empty();
                $("select[name=model]").append('<option value="">不确定车型</option>');
                var mallmodel = "<?php echo $car['model']; //$cookie['mallmodel']->value;                                                                                                                                                                                                                                                                                                                            ?>";
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
        $("select[name=model]").live('change', function() {
            var data = {};
            data.goodsid = "<?php echo $r['GoodsID'] ?>";
            data.make = "<?php echo $car['make']; //$cookie['mallmake']->value;                                                                                                                                                                                                                                                                                                                             ?>";
            data.series = "<?php echo $car['series']; //$cookie['mallseries']->value;                                                                                                                                                                                                                                                                                                                             ?>";
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
        $(".addgwc").live({
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
                var goodsID = <?php echo $goodsid; ?>;
                var quant = $("#qty_item").val();
                issale(goodsID);
                addGoodsToCar(goodsID, quant);
            }
        });
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
                var goodsID = <?php echo $goodsid; ?>;
                $.getJSON(Yii_baseUrl + '/pap/mall/issale',
                        {goodsid: goodsID},
                function(data) {
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
    });

    //设置年款车型
    function setVechile() {
        $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYear', {seriesId: "<?php echo $car['series']; //$cookie['mallseries']->value;                                                                                                                                                                                                                                                                                                                ?>"}, function(result) {
            $("select[name=year]").append('<option value="">不确定年款</option>');
            var mallyear = "<?php echo $car['year']; //$cookie['mallyear']->value;                                                                                                                                                                                                                                                                                                               ?>";
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
    }

    //添加到购物车
    function addGoodsToCar(goodsid, quant) {
        var make = "<?php echo $car['make']; ?>";
        var series = "<?php echo $car['series']; ?>";
        var year = $('select[name="year"]').val();
        var model = $('select[name="model"]').val();
        var locate = make + '_' + series + '_' + year + '_' + model;
        $.getJSON("<?php echo Yii::app()->createUrl('pap/mall/addgoodstocar') ?>",
                {goodsid: goodsid, quant: quant, locate: locate},
        function(data) {
            if (data) {
                alert('添加成功！');
                getCartCount();
            }
        });
    }

    //再次购买
    $('#buyagain').click(function() {
        var goodsID = $(this).attr('goodsid');
        var issale = '<?php echo $r['IsSale'] ?>';
        if (issale !== '1') {
            alert('商品已下架');
            return false;
        } else {
            $.getJSON(Yii_baseUrl + '/pap/orderreview/getgoods',
                    {goodsid: goodsID},
            function(data) {
                if (data) {
                    var html = '<button class = "addgwc">加入购物车</button>\n\
                                <button class = "ljgm" id = "quickbuy" goodsid = "' + goodsID + '">立即购买</button>';
                    var pricehtml = '';
                    if (data.IsPro == 1 && data.ProPrice > 0) {
                        pricehtml += '<p class="ck_price">促销价：￥<span class="cck_price">' + data.ProPrice + '</span></p>\n\
                                <p class="sc_price">参考价：￥<span class="ssc_price">' + data.Price + '</span></p>';
                    } else if (data.DisPrice > 0) {
                        pricehtml += '<p class="ck_price">折扣价：￥<span class="cck_price">' + data.DisPrice + '</span></p>\n\
                                <p class="sc_price">参考价：￥<span  class="ssc_price">' + data.Price + '</span></p>';
                    } else {
                        pricehtml += '<p class="ck_price">参考价：￥<span  class="cck_price">' + data.Price + '</span></p>';
                    }
                    if (data.img) {
                        $('#spec-n1').html("<IMG height=350 src='" + Yii_uploadUrl + data.img[0].ImageUrl + "' jqimg='" + Yii_uploadUrl + data.img[0].BigImage + "' width=350/>");
                        var imghtml = '';
                        for (var i in data.img) {
                            imghtml += "<li><img src='" + Yii_uploadUrl + data.img[i].BigImage + "'></li>";
                        }
                        $('#spec-list .list-h').html(imghtml);
                    } else {
                        $('#spec-n1').html("<IMG height=350 src='" + Yii_uploadUrl + "dealer/goods-img-big.jpg' jqimg='" + Yii_uploadUrl + "dealer/goods-img-big.jpg' width=350/>");
                        $('#spec-list .list-h').html("<li><img src='" + Yii_uploadUrl + "dealer/goods-img-big.jpg'></li>");
                    }
                    var car = '<?php echo $carmodeltext ?>'.split(" ");
                    var cxhtml = "<p class='dialog_1'><span class='dialog_1' style='color:orangered;font-weight:bold;'>适用车系：</span>\n\
                    <span style='font-weight:bold;'>厂家：</span><span class='makes'>" + car[0] + "</span>&nbsp;&nbsp;&nbsp;&nbsp;\n\
                    <span style='font-weight:bold;'>车系：</span><span class='cars'>" + car[1] + "</span></p>\n\
                    <p style='line-height:27px'><span style='font-weight: bold;'>年款：</span>\n\
                    <select name='year' class='select years' style='width:80px;'></select>\n\
                    <br/><span style='font-weight: bold;'>车型：</span>\n\
                    <select name='model' class='select models'></select>\n\
                    <input id='fit_input' type='hidden' value='<?php echo $fitres ?>'/></p>\n\
                                <div style='clear:both'></div>";
                    $('.title').html(data.Name);
                    $('.sp_name').html(data.Name);
                    $('.sp_number').html(data.GoodsNO);
                    $('.sp_brand').html(data.Brand);
                    $('.sp_pjdc').html(data.PartsLevelName);
                    $('.sp_bgpp').html(data.spec.BganCompany);
                    $('.sp_bgno').html(data.spec.BganGoodsNO);
                    $('.sp_dw').html(data.spec.UnitName);
                    $('.sp_bzs').html(data.pack.MinQuantity);
                    if (data.spec.ValidityType === 3) {
                        $('.sp_bxsj').html(data.spec.ValidityDate);
                    } else {
                        $('.sp_bxsj').parent('li').remove();
                    }
                    if (data.oeno) {
                        $('.sp_oe').html(data.oeno.join(','));
                    } else {
                        $('.sp_oe').html('');
                    }
                    $('.sp_tzsm').html(data.Memo);
                    $('.sp_info').html(data.Info);
                    $('.price').html(pricehtml);
                    $('p.gm').html(html);
                    $('div.vehicle').html(cxhtml);
                    $('<div class="dialog_right dialog_hide">该车型适用！</div><div class="dialog_error dialog_hide">该车型不适用，请重新选择车型！</div>\n\
                                <div class="dialog_true dialog_hide"><button id="model_true" class="dialog_button">确定</button></div>').appendTo('div.dialog');
                    setVechile();
                }
            });
        }
    });
</script>
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
        ),
    ),
));
echo '<div id="minorder">最小交易额</div> ';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?> 