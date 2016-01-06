<style>
    .items li{width:755px;border-bottom: 1px solid #e8e8e8;margin-bottom:5px;}
    .zwq_OE{display: none}
    .zwq_info{width:380px}
    .zwq_price{width:180px}
    .pager{ float:right;clear:both}
    .pager li a,.pager .goto a{ font-family: "微软雅黑"; padding: 2px 6px; border:1px solid #eee;}
    .pager span.goto{ font-family: "微软雅黑";}
    .pager li a {display:block;}
    .pager li a:hover{border:1px solid #ff6600}
    .pager li.selected a{ color:#ff6600; font-weight: bold}
    /*.pager .goto{float: none}*/
    .pager .input{margin:0; width:30px;height:22px;}
    .fenye{margin:2px 5px}
    .top_fenye ul li{ margin-top:0}
    .top_fenye ul li a{ padding: 2px 6px}
    .content2d #yw1 ul li{ float:left; width:auto}
    #make-car-m {border:2px solid #f2b303;}
    /*#make-car-m {border:2px solid #f2b303;left: 350.5px!important; top: 377px!important; }*/
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
    .sp,.hp{ display:block; height:35px; float:left; width:31px; border-left:1px solid #ccc; border-right:1px solid #ccc}
    .sp{ border-left:none}
    .sp_xianshi{ width:100px; float:left; margin-left:30px}
</style>
<?php
$skwd = $get['skwd'];
if (!empty($skwd) && strstr($skwd, '<<q>>')) {
    $skwd = str_replace('<<q>>', '/', $skwd);
}
?>
<!--商品排序、OE号查询开始-->
<div class="content2c">
    <div class="content2c1">
        <div class="float_l paixu">
            <span class="float_l" id="order_by" order="<?php echo $order[0] ?>">综合排序：</span>
            <ul class="float_l">
                <?php
                if (is_array($order['name'])):
                    foreach ($order['name'] as $k => $v):
                        $od = $get;
                        unset($od['order']);
                        if ($order['order'][$k])
                            $od['order'] = $order['order'][$k];
                        ?>
                        <li class='<?php echo $order['class'][$k] ?>'>
                            <a href="<?php
                            if (isset($dealerID) && !empty($dealerID)):
                                echo Yii::app()->createUrl('pap/sellerstore/index', $od);
                            else:
                                echo Yii::app()->createUrl('pap/mall/index', $od);
                            endif;
                            ?>">
                                <?php echo $v ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <?php
            $ispro = $get;
            if ($ispro['ispro'] == 1) {
                unset($ispro['ispro']);
            } else {
                $ispro['ispro'] = 1;
            }
            ?>
            &nbsp;<a href="<?php 
            if (isset($dealerID) && !empty($dealerID)):
                   echo Yii::app()->createUrl('pap/sellerstore/index', $ispro);
            else:
            echo Yii::app()->createUrl('pap/mall/index', $ispro);
            endif
            ?>">
                <input type="checkbox" name="ispro" <?php echo $get['ispro'] == 1 ? 'checked' : ''; ?>/>
            </a>&nbsp;促销
        </div>
        <div class="sp_xianshi">
            <?php $url = Yii::app()->request->getUrl(); ?>
            <a href="<?php
            if (strstr($url, "type/list")) {
                echo "#";
            } else if (strstr($url, "type/grid")) {
                echo str_replace("grid", "list", $url);
            } else {
                echo $url . "/type/list";
            }
            ?>"  class="hp <?php echo $displayType == "list" ? "hp_current" : '' ?>"></a>
            <a href="<?php
            if (strstr($url, "type/grid")) {
                echo "#";
            } else if (strstr($url, "type/list")) {
                echo str_replace("list", "grid", $url);
            } else {
                echo $url . "/type/grid";
            }
            ?>"  class="sp <?php echo $displayType != "list" ? "sp_current" : '' ?>"  ></a>

        </div>

        <div class="fenye float_r">
            <?php
            $this->widget('widgets.default.WShortPager', array(
                'pages' => $pages,
            ))
            ?>
        </div>
    </div>
    <!--    <div class="content2c2">
            <div class="float_l" style="margin-left:20px">
    <?php
    $oe = $get;
    unset($oe['oeno'])
    ?>
                <span class="float_l">关键字：</span>
                <input  type="text" id="goodsoeno" class="input float_l" value="<?php //echo $get['oeno']                    ?>" name="oeno"/>
                <input  type="text" class="input float_l" id="goodskey" value="<?php echo $skwd !== null ? $skwd : '名称|编号|拼音|配件品类|OE号|品牌'; ?>"/>
                <button class="button2 float_l" id="goodssearch" style="margin-top:5px">搜索</button>
            </div>
        </div>-->
</div>
<!--商品排序、OE号查询结束-->

<!--商品列表开始-->
<div class="content2d">
    <ul id="goods_ul">
        <?php
        if ($displayType == "list") {
            $itemView = "goods_list";
        } else {
            $itemView = "goods_grid";
            echo "<style> .content2d .items li{width:237px;border:1px solid #e8e8e8;}
                           .content2d .items li:hover{border:1px solid #ff5500;}
                           </style>";
        }
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => $itemView, // refers to the partial view named '_post'
            'summaryText' => '',
            'emptyText' => '
                     <div class="nogoods_text" style="height:200px;margin:0 auto;">
                <div style=" padding-top: 65px;margin:0 auto; width: 50%">
                   <div> <img src="' . Yii::app()->theme->baseUrl . '/images/images/nogoods.jpg" style="float: left;display: block"/><b><span style=" color:#FF6500;float:left;display: block; font-size: 18px;margin:8px 0 0 15px">非常抱歉,商品持续更新中!</span></b></div>
                   <div style="clear:both; height:0px"></div>                    
                    <div style="margin:10px 0 0 50px;*margin-top:-30px">
                       <b><p><span style="color:#353535; font-size: 15px;font-family: \'微软雅黑\'">您可以：</span><span style="color:#676767;font-size: 15px; font-family: \'微软雅黑\'"><a href="javascript:void(0)"><span class="contat" style="color:#FF6500" >在线QQ联系客服</span></a>或<a href="'.Yii::app()->createUrl('/helpcenter/home/addquestion3').'" target="_blank" style="color:#FF6500">提交问题</a></span></p></b>
                    </div>
                </div>
            </div>
'
        ))
        ?>
    </ul>


    <div style="clear:both"></div>
</div>
<!--商品列表结束-->
<script>
//    $(function(){
//        $('input[name=search_keyword]').val("<?php //echo $keyword            ?>");
//        if($('input[name=search_keyword]').val()=='')
//            $('input[name=search_keyword]').val('商品名称|编号|拼音代码|配件品类|OE号|品牌');
//    })
    //适用车系赋值
    $('#jpmall_make').val("<?php echo $get['make']; ?>");
    $('#jpmall_series').val("<?php echo $get['series']; ?>");
    $('#jpmall_year').val("<?php echo $get['year']; ?>");
    $('#jpmall_model').val("<?php echo $get['model']; ?>");
    //商品搜索
    $('#goodssearch').click(function() {
        var data = {};
        data.sub = '<?php echo $get['sub'] ?>';
        data.code = '<?php echo $get['code'] ?>';
        if ($.trim($('#goodskey').val()) != '名称|编号|拼音|配件品类|OE号|品牌')
        {
            data.skwd = $('#goodskey').val();
            data.skwd = data.skwd.replace(/\//g, "<<q>>");
            data.skwd = encodeURIComponent(data.skwd);
        }
        data.price = '<?php echo $get['price'] ?>';
        data.brand = '<?php echo $get['brand'] ?>';
        data.type = '<?php echo $get['type'] ?>';
        data.order = '<?php echo $get['order'] ?>';
        data.ispro = '<?php echo $get['ispro'] ?>';
        data.partslevel = '<?php echo $get['partslevel'] ?>';
<?php
if (isset($dealerID) && !empty($dealerID)) {
    echo "var url = Yii_baseUrl+'/pap/sellerstore/index/id/{$dealerID}';";
} else {
    echo "var url = Yii_baseUrl+'/pap/mall/index';";
}
?>
        $.each(data, function(k, v) {
            if (v != '' && v != undefined) {
                url += '/' + k + '/' + v;
            }

        })
        location.href = url;
    })

    $('#goodskey').click(function() {
        if ($(this).val() == '名称|编号|拼音|配件品类|OE号|品牌') {
            $(this).val('');
        }
    });

    $('#goodskey').blur(function() {
        if ($(this).val() == '') {
            $(this).val('名称|编号|拼音|配件品类|OE号|品牌');
        }
    });
    $('input[name=ispro]').click(function(){
       var pro=$(this).val();
       var dealerid='<?php if(isset($dealerID) && !empty($dealerID)) echo 'dealer';?>';
       if(dealerid=='dealer' && pro=='on'){
           location.href='<?php echo Yii::app()->createUrl('pap/sellerstore/index', $ispro);?>';
       }else{
           location.href='<?php echo Yii::app()->createUrl('pap/mall/index', $ispro);?>';
       }
    })
     $('.contat').click(function(){
       var url=$('.helpcontact_d ul li:eq(0) a').attr('href');
       if(url!=''){
        window.open(url,"_blank");
       }
//        $(".helpcontact_d").css("display", "block");
//        $("div.helpcontact").css("background-color", "#fff");
//        $("div.helpcontact").css("border", "1px solid #ccc");
//        $("div.helpcontact").css("border-bottom", "none");
    })
</script>  