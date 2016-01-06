<link href="<?php echo F::themeUrl() . '/css/inquiryorder_detil.css' ?>" rel="stylesheet" type="text/css">
<style>
    .tabs li a{ font-size:14px}
    .selected{
        font-weight:normal !important;}
    </style>
    <?php
    $this->pageTitle = Yii::app()->name . '-' . '询报价详情';
    $this->breadcrumbs = array(
        '询报价管理' => Yii::app()->createUrl('common/inquerylist'),
        '询报价详情',
    );
    ?>
    <?php $this->renderPartial('/quotationlist/inquiryinfo', array('inquiryinfo' => $inquiryinfo, 'imsgs' => $imsgs, 'category' => $category,'res'=>$res)) ?>
    <div class="bor_back m-top" style="height:auto; position:relative;*height:200px">
            <p class="txxx">报价单详情<span class="float_r" style="margin-right:20px ;*margin-top:-35px">
                    <a href="<?php echo Yii::app()->createUrl('/pap/inquiryorder/index'); ?>" class="color_blue" style="font-weight:400">返回</a></span></p>
            <div class="info-box">
                <div>
                    <p class="m-top20" style="margin: 10px 0 0 20px"><b>经销商信息</b></p>
                    <ul class="xlcxx m-top">
                        <li>经销商名称：<span><?php echo $dealer_info['OrganName']; ?></span></li>
                        <li>联系电话：<span><?php echo $dealer_info['Phone']; ?></span></li>
                        <div style="clear:both"></div>
                        <p class=" m-top5"></p>
                    </ul>
                </div>
                <?php if($quoinfo):?>
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
                    <?php endif;?>
            </div>
        </div>

        <!--报价单商品页-->
        <?php $this->renderPartial('/quotationlist/quoinfo', array('schinfo' => $schinfo, 'quoinfo' => $quoinfo, 'goodsdata' => $goodsdata, 'sumtotal' => $sumtotal, 'address' => $address, 'discount' => $discount, 'model' => $model, 'mini' => $mini, 'action' => 'inquiryorder')) ?>

