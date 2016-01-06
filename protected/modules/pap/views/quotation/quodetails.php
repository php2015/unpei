<style>
    .zdyul li{width:30%; margin-left:70px; float:left; line-height:30px;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 查看报价单';
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    '发布报价单' => Yii::app()->createUrl('pap/quotation/index'),
    '报价单详情'
);
$returnurl = Yii::app()->request->urlReferrer;
$returnurl = $returnurl ? $returnurl : Yii::app()->createUrl('pap/quotation/index');
?>
<div class="bor_back m-top" style="height:auto; position:relative">
    <p class="txxx">报价单详情<span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo $returnurl; ?>" class="color_blue" style="font-weight:400">返回</a></span>
    </p>
    <div class="info-box">
        <div>
            <p class="m-top20"><b>修理厂信息</b></p>
            <ul class="zdyul m-top">
                <li>修理厂名称：<span><?php echo $service['OrganName']; ?></span></li>
                <li>联系电话：<span><?php echo $service['Phone']; ?></span></li>
                <li style="width:800px;">客户类别及折扣：<span name="type"><?php echo $service['type']; ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
        </div>
        <div>
            <p class="m-top20" style="clear:both"><b>报价单信息</b></p>
            <ul class="zdyul m-top">
                <li>报价单名称：<span><?php echo $quoinfo['Title']; ?></span></li>
                <li>报价单编号：<span><?php echo $quoinfo['QuoSn']; ?></span></li>
                <li>报价状态：<span><?php echo QuotationService::getstatus($quoinfo['Status']); ?></span></li>
                <li>创建时间：<span><?php echo date('Y-m-d H:i', $quoinfo['CreateTime']); ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
        </div>
        <?php if (empty($schinfo)): ?>
            <div style="height:475px;clear:both"><p class="txxx">暂无方案,请先添加方案</p></div>
        <?php else: ?>
            <div style="border:1px solid #c5d2e2;padding:10px;*margin-top:30px">
                <?php $this->renderpartial('schemes', array('schinfo' => $schinfo)); ?>
            </div>
        <?php endif; ?>
        <p class="m-top20" align="center" style='margin-top:10px'><input type="submit" class="submit" value="返回" id="close"></p>
    </div>
</div>
<script>
    $(function() {
        //返回
        $('#close').click(function() {
            window.location.href ='<?php echo $returnurl;?>';
        })

    })
</script>
