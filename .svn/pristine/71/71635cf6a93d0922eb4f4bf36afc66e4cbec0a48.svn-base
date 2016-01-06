<style>
    .zdyul li{width:30%; margin-left:70px; float:left; line-height:30px;}
</style>

<?php
$this->pageTitle = Yii::app()->name . ' - 收到的询价单';
$update = Yii::app()->request->getParam('update');
$inqid = Yii::app()->request->getParam('inqid');
$service = $inqres['service'];
$draft = $_GET['draft'];
$url = array('inqid' => $inqid);
if ($update == 't') {
    $url['update'] = 't';
    $title = '修改报价单';
} else {
    $title = '发送报价单';
}
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    '收到的询价单' => Yii::app()->createUrl('pap/inquirylist/index'),
    $title
);
//客服代发询价单只能制作一个方案
if ($inqres['baseinfo']['State'] == 1) {
    $schemecount = 1;
} else {
    $schemecount = 3;
}
if ($_GET['return']) {
    $uri = 'pap/quotation/index';
    $url['return'] = 'quo';
} elseif ($_GET['draft']) {
    $uri = 'pap/quotation/draft';
    $url['draft'] = 1;
} else
    $uri = 'pap/inquirylist/index';
$returnurl = Yii::app()->request->urlReferrer;
$returnurl = $returnurl ? $returnurl : Yii::app()->createUrl($uri);
if (strpos($returnurl, $uri) === false) {
    $returnurl = Yii::app()->createUrl($uri);
}
$this->renderpartial('inqinfo', array('inqres' => $inqres));
?>

<div class="bor_back m-top" style="min-height:370px;height:auto;position:relative">
    <p class="txxx">报价单方案<span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo $returnurl; ?>" class="color_blue" style="font-weight:400">返回列表</a></span></p>
    <div class="info-box">
        <div id="serviceinfo">
            <p class="m-top20"><b>修理厂信息</b></p>
            <ul class="zdyul m-top">
                <li>修理厂名称：<span><?php echo $service['OrganName']; ?></span></li>
                <li>联系电话：<span><?php echo $service['Phone']; ?></span></li>
                <li style="width:800px;">客户类别及折扣：<span name="type"><?php echo $service['type']; ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>

            <?php if ($quoinfo): ?>
                <p class="m-top20" style="clear:both"><b>报价单信息</b></p>
                <ul class="zdyul m-top">
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

    <p class="m_top20" style="clear:both">
        <span class="add m_left"><span class="jiahao">+</span></span>
        <a href="<?php echo Yii::app()->createUrl('/pap/inquirylist/makescheme', $url); ?>" class="color_blue alternative" id="addscheme">添加方案</a>
    </p>
    <?php if (empty($schinfo)): ?>
        <div style="height:220px;clear:both"><p class="txxx" style="color:red;font-size:12px;font-weight:400">暂无方案,请先添加方案</p></div>
    <?php else: ?>
        <div style="border:1px solid #c5d2e2;padding:10px;margin:10px">
            <?php $this->renderpartial('/quotation/schemes', array('schinfo' => $schinfo, 'handle' => 'inquiry', 'url' => $url, 'schemecount' => $schemecount)); ?>
        </div>

        <p class="m-top20" align="center">
            <?php if ($update != 't'): ?>
                <input type="submit" class="submit f_weight" value="发送" id="sendquo" inqid="<?php echo $inqid; ?>">
            <?php endif; ?>
            <input type="submit" class="submit f_weight" value="取消发送" id="cancelquo" inqid="<?php echo $inqid; ?>">
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
<script>
    $(function() {
        var schemecount =<?php echo $schemecount; ?>;

        //添加方案事件
        $('#addscheme').click(function() {
            var count = $('[scheme=schemelist]').length;
            if (count > schemecount - 1)
            {
                if (schemecount == 1)
                    alert('客服代发询价单只能添加一个方案');
                else
                    alert('一个报价单只能添加三个方案');
                return false;
            }
        })

        //删除方案
        $('a[name=delscheme]').click(function() {
            var count = $('[scheme=schemelist]').length;
            if (count == 1)
            {
                alert('报价单最少有一条方案!如果想要删除此条方案,请先添加另一条方案!');
                return false;
            }
            if (confirm("你确定要删除此条方案?"))
            {
                var schid = $(this).attr('schid');
                var url = Yii_baseUrl + '/pap/quotation/delscheme';
                $.getJSON(url, {'schid': schid}, function(res) {
                    if (res.count > 0)
                    {
                        location.reload();
                    }
                })
                return true;
            }
        })

        //发送报价单
        $('#sendquo').click(function() {
            if (confirm("你确定要发送此条报价单吗?"))
            {
                $('#sendquo').attr('disabled', 'disabled');
                var inqid = $(this).attr('inqid');
                var url = Yii_baseUrl + '/pap/inquirylist/sendquo';
                $.getJSON(url, {'inqid': inqid}, function(res) {
                    if (res.count > 0)
                    {
                        $("#reminddg").html('<span class="color_blue">您的报价单已经发送成功,跳转到列表页面!</span>');
                        $("#reminddg").dialog("open");
                        var url ='<?php echo $returnurl;?>';
                        setTimeout("window.location.href='" + url + "'", 1000);
                    }
                    else
                    {
                        $('#sendquo').removeAttr('disabled');
                        alert('发送失败');
                    }
                })
                return true;
            }
        })

        //取消报价单发送
        $('#cancelquo').click(function() {
            if (confirm("你确定要取消此条报价单吗?"))
            {
                var inqid = $(this).attr('inqid');
                var url = Yii_baseUrl + '/pap/inquirylist/cancelquo';
                $.getJSON(url, {'inqid': inqid}, function(res) {
                    if (res.failmsg) {
                        alert(res.failmsg);
                    }
                    else if (res.count > 2) {
                        $("#reminddg").html('<span class="color_blue">您的报价单取消成功,跳转到询价单页面!</span>');
                        $("#reminddg").dialog("open");
                        var url = '<?php echo $returnurl; ?>';
                        setTimeout("window.location.href='" + url + "'", 1000);
                    }
                    else if (res.count == -1) {
                        alert(res.msg);
                        window.location.href = '<?php echo $returnurl; ?>';
                    }
                    else {
                        alert('取消失败');
                    }
                })
                return true;
            }
        })
    })
</script>