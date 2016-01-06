<style>
    .zdyul li{width:30%; margin-left:70px; float:left; line-height:30px;}
</style>

<?php
$this->pageTitle = Yii::app()->name . ' - 收到的询价单';
$service = $inqres['service'];
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    '收到的询价单' => Yii::app()->createUrl('pap/inquirylist/index'),
    '查看详情'
);
if($_GET['draft']){
    $uri='pap/quotation/draft';
}
elseif($_GET['return']=='quo'){
    $uri='pap/quotation/index';
}else{
    $uri='pap/inquirylist/index';
}
$returnurl = Yii::app()->request->urlReferrer;
$returnurl = $returnurl ? $returnurl : Yii::app()->createUrl($uri);
if (strpos($returnurl, $uri) === false) {
    $returnurl = Yii::app()->createUrl($uri);
}
?>
<?php $this->renderpartial('inqinfo', array('inqres' => $inqres)) ?>

<div class="bor_back m-top" style="height:370px;height:auto;" id="schemediv">
    <p class="txxx">
        <?php if ($inqres['status']['status'] == 5): ?>
            询价单已失效
        <?php else: ?>
            报价单方案
        <?php endif; ?>
        <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo $returnurl; ?>" class="color_blue" style="font-weight:400">返回</a>
        </span></p>
    <div class="info-box">
        <div >
            <p class="m-top20"><b>修理厂信息</b></p>
            <ul class="m-top zdyul">
                <li>修理厂名称：<span><?php echo $service['OrganName']; ?></span></li>
                <li>联系电话：<span><?php echo $service['Phone']; ?></span></li>
                <li style="width:800px;">客户类别及折扣：<span name="type"><?php echo $service['type']; ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
            <?php if ($quoinfo): ?>
                <p class="m-top20" style="clear:both"><b>报价单信息</b></p>
                <ul class="m-top zdyul">
                    <li>报价单名称：<span><?php echo $quoinfo['Title']; ?></span></li>
                    <li>报价单编号：<span><?php echo $quoinfo['QuoSn']; ?></span></li>
                    <li>报价状态：<span><?php echo $inqres['status']['msg']; ?></span></li>
                    <li>创建时间：<span><?php echo date('Y-m-d H:i', $quoinfo['CreateTime']); ?></span></li>
                    <div style="clear:both"></div>
                    <p class=" m-top5"></p>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <?php if (empty($schinfo)): ?>
        <div style="height:220px;clear:both">
            <p class="txxx" align="center">
                <?php if ($inqres['status']['status'] != '5'): ?>
                    <input type="submit" class="submit" value="发起报价" id="quotation">
                <?php endif; ?>
            </p>
        </div>

    <?php else: ?>
        <div style="border:1px solid #c5d2e2;padding:10px;margin:10px;*margin-top:40px">
            <?php $this->renderpartial('/quotation/schemes', array('schinfo' => $schinfo)); ?>
        </div>
        <?php if ($inqres['status']['status'] == 0): ?>
            <p class="m-top20" align="center"><input type="submit" class="submit" value="编辑" id="editquo">
                <input type="submit" class="submit" value="发送" id="sendquo"></p>
        <?php else: ?>
            <p class="m-top20" align="center"><input type="submit" class="submit" value="返回" id="close"></p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'reminddg', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '操作提示',
        'autoOpen' => false, //是否自动打开  
        'width' => '300px', //宽度  
        'height' => 'auto', //高度  
        'buttons' => array(
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮  
        ),
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script>
    $(function() {
        //关闭
        $('#close').click(function() {
            window.location.href ='<?php echo $returnurl;?>';
        })

        //发起报价
        $('#quotation').click(function() {
            window.location.href = Yii_baseUrl + '/pap/inquirylist/makescheme/inqid/<?php echo Yii::app()->request->getParam('inqid'); ?>';
        })

        //编辑报价单
        $('#editquo').click(function() {
            var url=Yii_baseUrl + '/pap/inquirylist/scheme/inqid/<?php echo Yii::app()->request->getParam('inqid'); ?>';
            var draft='<?php echo $_GET['draft'];?>';
            if(draft){
                url+='/draft/1';
            }
            window.location.href = url;
        })

        //发送报价单
        $('#sendquo').click(function() {
            if (confirm("你确定要发送此条报价单吗?"))
            {
                var inqid = '<?php echo Yii::app()->request->getParam('inqid'); ?>';
                var url = Yii_baseUrl + '/pap/inquirylist/sendquo';
                $.getJSON(url, {'inqid': inqid}, function(res) {
                    if (res.count > 0)
                    {
                        $("#reminddg").html('<span style="color:blue">您的报价单已经发送成功,跳转到询价单列表页面!</span>');
                        $("#reminddg").dialog("open");
                        var url = '<?php echo $returnurl;?>';
                        setTimeout("window.location.href='" + url + "'", 1000);
                    }
                    else
                    {
                        alert('发送失败');
                    }
                })
                return true;
            }
        })
    })
</script>