<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/css/cart/gwc.css' ?>" />
<style>
    .gwc_list_head ul li{padding:0 37px}
    .checkAll{ vertical-align: middle}


</style>
<div class="wrap-contents" style="background:#fff; border:1px solid #ccc; width:990px; padding: 5px; margin-top:5px" >
    <?php
    if (isset($carlist) && !empty($carlist)) {
        $this->renderPartial('carthead');
        ?>
        <p class="gwc_list_lm"><img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/gwc_tb.jpg' ?>"><span>您购物车中的商品</span></p>
        <div class="gwc_list_head m-top">
            <ul>
                <span style="float:left;padding-left:20px"><input type="checkbox" class="allcheck" ></span><li style="width:450px;">商品信息</li>
                <li class="width120">单价</li>
                <li  class="width120">数量</li>
                <li class="width150">小计</li>
                <li class="width100">操作</li>
            </ul>
        </div>

    <?php
    $this->renderPartial('confirmgoods', array('carlist' => $carlist));
    ?>
    <?php } else { ?>
        <!--空购物车-->
        <?php echo $this->renderPartial("carthead") ?>
        <div class=" m-top gwc_nogoods" style="margin-bottom:60px">

            <div class="no_list">
                <img src="<?php echo Yii::app()->theme->baseUrl . '/images/papmall/gouwuche/nogoods.jpg' ?>" class="float_l">
                <div class="float_l  m_left40">
                    <br>
                    <b class="no_goods m-top">您的购物车是空的,您可以</b><br><br>
                    <span class="m-top"><a href="<?php echo Yii::app()->createUrl('pap'); ?>">选购商品</a></span><span class="m-top m_left20"><a href="<?php echo Yii::app()->createUrl('pap/orderreview/index'); ?>">查看订单</a></span>


                </div>
                <div style="clear:both"></div>
            </div>
        </div>
<?php } ?>
</div>