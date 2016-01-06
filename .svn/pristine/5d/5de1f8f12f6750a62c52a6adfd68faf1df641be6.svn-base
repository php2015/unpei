<style>
    .zdyul li{width:30%; margin-left:70px; float:left; line-height:30px;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 报价单';
$update = Yii::app()->request->getParam('update');
$sid = Yii::app()->request->getParam('sid');
$quoid = Yii::app()->request->getParam('quoid');
$draft = $_GET['draft'];
$url = array('sid' => $sid);
if ($quoid)
    $url['quoid'] = $quoid;
if ($draft) {
    $title1 = '报价单草稿';
    $title2 = '修改报价单方案';
    $returnurl = Yii::app()->createUrl('pap/quotation/draft');
    $url['update'] = 't';
    $url['draft'] = 1;
} else {
    $title1 = '发布报价单';
    $returnurl = Yii::app()->createUrl('pap/quotation/index');
    if ($update == 't') {
        $url['update'] = 't';
        $title2 = '修改报价单方案';
    } else {
        $title2 = '新建报价单方案';
    }
}
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    $title1 => $returnurl,
    $title2
);
?>
<div class="bor_back m-top" style="height:auto; position:relative">
    <p class="txxx">报价单方案
        <span class="float_r" style="margin-right:20px ;*margin-top:-35px"><a href="<?php echo $returnurl ?>" class="color_blue" style="font-weight:400">返回列表</a></span>
        <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo Yii::app()->createUrl('/pap/quotation/select', $url); ?>" class="color_blue" style="font-weight:400">重新选择修理厂</a>
        </span>    
    </p>
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
                    <li>报价状态：<span><?php echo $quoinfo['IfSend']==1?'待发送':(QuotationService::getstatus($quoinfo['Status'])); ?></span></li>
                    <li>创建时间：<span><?php echo date('Y-m-d H:i', $quoinfo['CreateTime']); ?></span></li>
                    <div style="clear:both"></div>
                    <p class=" m-top5"></p>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <p class="m_top20" style="clear:both">
        <span class="add m_left"><span class="jiahao">+</span></span>
        <a href="<?php echo Yii::app()->createUrl('/pap/quotation/makescheme', $url); ?>" class="color_blue alternative" id="addscheme">添加方案</a>
    </p>
    <?php if (empty($schinfo)): ?>
        <div style="height:475px;clear:both"><p class="txxx" style="color:red;font-size:12px;font-weight:400">暂无方案,请先添加方案</p></div>
    <?php else: ?>
        <div style="border:1px solid #c5d2e2;padding:10px;margin:10px">
            <?php $this->renderpartial('schemes', array('schinfo' => $schinfo, 'handle' => 'quotation', 'url' => $url)); ?>
        </div>
        <p class="m-top20" align="center">
            <input type="submit" class="submit f_weight" value="发送" id="sendquo" quoid="<?php echo $quoid; ?>" sid="<?php echo $sid; ?>">
            <input type="submit" class="submit f_weight" value="取消发送" id="cancelquo" quoid="<?php echo $quoid; ?>">
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
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<script>
    $(function() {
        //添加方案事件
        $('#addscheme').click(function() {
            var count = $('[scheme=schemelist]').length;
            if (count > 2)
            {
                alert('一个报价单只能添加三个方案');
                return false;
            }
        })

        //删除方案
        $('a[name=delscheme]').click(function() {
            var count = $('[scheme=schemelist]').length;
            if (count == 1) {
                alert('报价单最少有一条方案!如果想要删除此条方案,请先添加另一条方案!');
                return false;
            }
            if (confirm("你确定要删除此条方案?")) {
                var schid = $(this).attr('schid');
                var url = Yii_baseUrl + '/pap/quotation/delscheme';
                $.getJSON(url, {'schid': schid}, function(res) {
                    if (res.count > 0) {
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
                var data = {};
                data.sid = $(this).attr('sid');
                data.quoid = $(this).attr('quoid');
                var draft="<?php echo $draft;?>";
                if(draft){
                    data.draft=1;
                }
                var url = Yii_baseUrl + '/pap/quotation/sendquo';
                $.getJSON(url, data, function(res) {
                    if (res.count > 0) {
                        $("#reminddg").html('<span class="color_blue">您的报价单已经发送成功,跳转到报价单列表页面!</span>');
                        $("#reminddg").dialog("open");
                        var url = '<?php echo $returnurl; ?>';
                        setTimeout("window.location.href='" + url + "'", 1000);
                    }
                    else {
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
                var quoid = $(this).attr('quoid');
                var url = Yii_baseUrl + '/pap/quotation/cancelquo';
                $.getJSON(url, {'quoid': quoid}, function(res) {
                    if (res.count > 2) {
                        $("#reminddg").html('<span class="color_blue">您的报价单取消成功,跳转到报价单列表页面!</span>');
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