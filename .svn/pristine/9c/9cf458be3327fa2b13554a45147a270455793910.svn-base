<?php $this->workPage = false; ?>
<!--客户信息-->
<div class="kh_info">
    <span class="x1">我的待办事项：</span>
    <a  href="<?php echo F::baseUrl() . '/pap/inquirylist/index/sta/0'; ?>"><span class="spanli" style="color:#fff;">待报价的询价单<span class="fontcolor" style="color:#fff;"><b>（<label class="Dwaitquotation" id="Dwaitquotations" style="color:#fff;"><?php echo $dquotions ? $dquotions : 0; ?></label>）</b></span></span></a>
    <a  href="<?php echo F::baseUrl() . '/pap/sellerorder/index/Status/2/type/2'; ?>"><span class="spanli" style="color:#fff;">待发货的订单<span class="fontcolor" style="color:#fff;"><b>（<label class="Dwaitshipping" id="Dwaitshippings"  style="color:#fff;"><?php echo $dShipping ? $dShipping : 0; ?></label>）</b></span></span></a>
    <a  href="<?php echo F::baseUrl() . '/pap/dealerreturn/index/Status/1'; ?>"><span class="spanli" style="color:#fff;">待审核的退货单<span class="fontcolor" style="color:#fff;"><b>（<label class="Returnaudit" id="Returnaudits"  style="color:#fff;"><?php echo $returnaudit ? $returnaudit : 0; ?></label>）</b></span></span></a>
</div>
<?php $this->widget('widgets.default.WStage'); ?>
<?php
$this->pageTitle = Yii::app()->name . ' - 经销商首页';
?>