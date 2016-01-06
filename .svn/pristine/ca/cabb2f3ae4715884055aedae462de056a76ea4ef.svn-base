<style>
    .submit_else {
        background: url("<?php echo F::themeUrl() . '/images/jpd/submit_else.png' ?>") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
        border: medium none;
        color:blue;
        font-size: 14px;
        height: 30px;
        line-height: 28px;
        width: 83px;
    }
    .xlcxx li {
        float: left;
        line-height: 30px;
        margin-left: 70px;
        width: 30%;
    }
    #goodslist .pager{
        display: none 
    }
    .selected{
        font-weight:normal !important;
    }
    .descript_lms{
        margin-top: 20px
    }
    .descript_lms li {
        float: left;
        line-height: 30px;
        margin-left: 70px;
        width: 90%;
    }

    .pager{
        display: none;
    }
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 报价单详情';
$this->breadcrumbs = array(
    '询报价管理' => Yii::app()->createUrl('common/inquerylist'),
    '报价单详情'
);

Yii::app()->clientScript->registerScript('search', '
$("#addresssearch").click(function(){
    $.fn.yiiGridView.update(
        "address",
        {
            url:window.location.href,
        }
    )
});        
');
?>
<!--询价单信息页-->
<?php $this->renderPartial('inquiryinfo', array('inquiryinfo' => $inquiryinfo, 'imsgs' => $imsgs, 'category' => $category)) ?>
<div class="bor_back m-top" style="height:auto; position:relative;*height:200px">
    <p class="txxx">报价单详情<span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo Yii::app()->createUrl('/pap/quotationlist/index'); ?>" class="color_blue" style="font-weight:400">返回</a></span></p>
    <div class="info-box">
        <div>
            <p class="m-top20" style="margin: 10px 0 0 20px"><b>经销商信息</b></p>
            <ul class="xlcxx m-top">
                <li>经销商名称：<span><?php echo $dealer[0]['OrganName']; ?></span></li>
                <li>联系电话：<span><?php echo $dealer[0]['Phone']; ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
        </div>
        <div style="*margin-top:50px">
            <p class="m-top20" style="margin: 10px 0 0 20px"><b>报价单信息</b></p>
            <ul class="xlcxx m-top">
                <li>报价单名称：<span><?php echo $quoinfo['Title']; ?></span></li>
                <li>报价单编号：<span><?php echo $quoinfo['QuoSn']; ?></span></li>
                <li>报价状态：<span><?php echo QuotationService::getstatus($quoinfo['Status']); ?></span></li>
                <li>创建时间：<span><?php echo date('Y-m-d H:i', $quoinfo['CreateTime']); ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
        </div>

    </div>
</div>
<!--报价单商品页-->
<?php $this->renderPartial('quoinfo', array('schinfo' => $schinfo, 'quoinfo' => $quoinfo, 'goodsdata' => $goodsdata, 'sumtotal' => $sumtotal, 'address' => $address, 'discount' => $discount, 'model' => $model, 'mini' => $mini, 'action' => 'quotationlist')) ?>

