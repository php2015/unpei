<link rel='stylesheet' href='<?php echo Yii::app()->theme->baseUrl ?>/css/pap/dealerstore.css'>
<link rel='stylesheet' href='<?php echo Yii::app()->theme->baseUrl ?>/css/detail.css'>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/goodslist.css"/>
<style>
    .content_info{padding:5px; margin:0px}
    .content1{width:210px}
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
    .content2b {margin-top: 0px;}

    .content2d #yw1 ul li{ float:left; width:auto}
    .pop #make-car-m {border:2px solid #f2b303; }
    /*.pop #make-car-m {border:2px solid #f2b303;left: 313.5px!important; top:229px!important; }*/
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
    .button{width:70px}
    .span1{display: block;float:left;text-align: right;width: 70px;}
</style>
<div class="wrap-contents" style="background:#fff; border:1px solid #ccc; padding:5px; width:990px">
    <div class="content1 float_l"  style="padding-bottom:0px">
        <!--卖家信息 客服信息-->
        <?php if ($this->beginCache('sellerinfo_sellerID_' . $dealerID)) : ?>
            <?php $this->renderPartial('sellerinfo', array('seller' => $seller, 'csinfo' => $csinfo, 'TotalScore' => $TotalScore)); ?>
            <?php $this->endCache(); ?>
        <?php endif; ?> 
        <!--店内分类-->
        <?php $cateParam = array('cate' => $cate, 'dealerid' => $dealerID, 'bigid' => $bigid, 'sub' => $get['sub']); ?>
        <?php if ($this->beginCache('sellercategory_sellerID_' . implode("_", $cateParam))) : ?>
            <div class="content2a2">
                <?php $this->renderPartial('category', $cateParam); ?>
            </div>
            <?php $this->endCache(); ?>
        <?php endif; ?> 
        <!--content1a结束-->
        <!--店长推荐-->
        <?php if ($this->beginCache('mallgoods_sellerID_' . $dealerID)) : ?> 
            <div class="content2a3">
                <?php $this->widget('widgets.papmall.MReGoods', array('sellerID' => $dealerID)) ?>
            </div>
            <?php $this->endCache(); ?>
        <?php endif; ?> 
    </div>

    <div class="content2 float_l" style='width:770px'>
        <!--商品筛选开始-->
        <?php $this->renderPartial('/mall/goodssx', array('params' => $params, 'get' => $get, 'brand' => $brand, 'price' => $price, 'type' => 3, 'makecar' => $makecar, 'dealerID' => $dealerID)); ?>
        <!--商品筛选结束-->
        <input type="hidden" id='dealerid' value="<?php echo $_GET['id'] ?>">
        <?php $this->renderPartial('/mall/list', array('dataProvider' => $dataProvider, 'get' => $get, 'order' => $order, 'pages' => $pages, 'dealerID' => $dealerID, 'displayType' => $displayType)) ?>
    </div>
    <!-- 广告信息 -->
    <div style="clear:both"></div>
<!--    <div class='width998 content-rows auto_height'>
    </div>-->
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/pap/shop.js'></script>
<!--<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/pap/lanrenzhijia.js'></script>-->
<script type="text/javascript">
    $(document).ready(function() {
        //添加到购物车
        $(".addgwc").bind({
            'click': function() {
                var goodsID = $(this).attr('goodsid');
                var quant = $("#qty_item").val();
                issale(goodsID);
                addGoodsToCar(goodsID, quant);
            }
        })
        
         $('.show-detail').click(function() {
        var goodsID = $(this).attr('goodsid');
//          $.getJSON(Yii_baseUrl+'/pap/mall/issale',
//                {goodsid: goodsID},
//        function(data) {
//            if (data) {
//               alert(data.message);
//               return false;
//            }else{
                window.open(Yii_baseUrl + '/pap/mall/detail/goods/' + goodsID);
//            }
//        });
        
    })
//        $('.show-detail').click(function() {
//            var goodsID = $(this).attr('goodsid');
//            window.open(Yii_baseUrl + '/pap/mall/detail/goods/' + goodsID);
//        })
    })
    function issale(goodsid){
       $.getJSON(Yii_baseUrl+'/pap/mall/issale',
                {goodsid: goodsid},
        function(data) {
            //getCartCount();
            if (data) {
               alert(data.message);
               return false;
            }
        });
    }
    function addGoodsToCar(goodsid, quant) {
        $.getJSON("<?php echo Yii::app()->createUrl('pap/mall/addgoodstocar') ?>",
                {goodsid: goodsid, quant: quant},
        function(data) {
            getCartCount();
            if (data) {
                alert('添加成功！');
                getCartCount();
            }
        });
    }

    function getCartCount() {
        $.getJSON("<?php echo Yii::app()->createUrl("pap/buyorder/getcount") ?>", function(data) {
            $(".amount").text(data);
        })
    }
</script>
