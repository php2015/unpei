<?php
$this->pageTitle = Yii::app()->name . ' - 报价单 -选择商品';
$update = Yii::app()->request->getParam('update');
$sid = Yii::app()->request->getParam('sid');
$quoid = Yii::app()->request->getParam('quoid');
$schid = Yii::app()->request->getParam('schid');
$draft = $_GET['draft'];
$buylists = $buy->getData();
if (empty($buylists))
    $buyempty = 1;
else
    $buyempty = 0;
$url = array('sid' => $sid);
if ($quoid)
    $url['quoid'] = $quoid;
if ($update == 't' && $schid) {
    $url['update'] = 't';
    $title2 = '修改报价单 - 修改方案(修理厂名称:' . $service['OrganName'] . ')';
    $returnurl = Yii::app()->createUrl('pap/quotation/index');
} elseif ($update == 't') {
    $url['update'] = 't';
    $title2 = '修改报价单 - 制定方案(修理厂名称:' . $service['OrganName'] . ')';
    $returnurl = Yii::app()->createUrl('pap/quotation/index');
} else {
    $title2 = '报价单 - 制定方案(修理厂名称:' . $service['OrganName'] . ')';
    $returnurl = Yii::app()->createUrl('pap/quotation/index');
}
$title1 = '发布报价单';
if ($draft) {
    $title1 = '报价单草稿';
    $returnurl = Yii::app()->createUrl('pap/quotation/draft');
    $url['update'] = 't';
    $url['draft'] = 1;
}
$prevurl = Yii::app()->createUrl('pap/quotation/quoscheme', $url);
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    $title1 => $returnurl,
    $title2
);
?>

<div class="gray_back m-top" style="height:auto ; position:relative">
    <input type="hidden" id="ifupdate" value="<?php echo $update; ?>">
    <div class="bor_back">
        <p class="txxx">商品信息<span class="float_r" style="margin-right:20px ;*margin-top:-35px"><a href="<?php echo Yii::app()->createUrl('/pap/quotation/quoscheme', $url); ?>" class="color_blue" style="font-weight:400">返回方案页</a></span></p>
        <div class="txxx_info4">
            <span>适用车系：</span>
            <?php $this->widget('widgets.default.WGoodsModel', array('scope' => 'epc', 'notlink' => 'N', 'link' => 'Y', 'all' => 'N', 'dealerID' => 'exist')); ?>
            <!--经销商商品--->
            <?php $this->renderpartial('goods', array('goodslist' => $goodslist)); ?>
        </div>
    </div>
    <!--报价单商品--->
    <?php $this->renderpartial('buygoods', array('buy' => $buy)); ?>

    <div class="bor_back m-top">
        <p class="txxx">报价单信息</p>
        <div class="txxx_info4">
            <form id="quoform" method="post">
                <input type="hidden" id="serviceid" name="sid" value="<?php echo $sid; ?>">
                <input type="hidden" id="quoid" name="quoid" value="<?php echo $quoid; ?>">
                <input type="hidden" id="schid" name="schid" value="<?php echo $schinfo['SchID']; ?>">
                <input type="hidden" id="buyids" name="quoids">
                <input type="hidden" id="quoprice" name="quoprice">
                <input type="hidden" id="quonum" name="quonum">
                <input type="hidden" id="filename" name="filename">
                <input type="hidden" id="fileurl" name="fileurl">
                <div class="txxx_info2 m-top">
                    <p class="m-top">
                        <?php if ($edit == 1): ?>
                            <span>报价单名称：</span><input type="text" class="input input3" value="<?php echo $schinfo['Title']; ?>" name="quoname" maxlength="20">
                            <span style="margin-left:87px;">报价单编号：</span><span style="padding-left:13px"><?php echo $schinfo['QuoSn']; ?></span>
                            <input type="hidden" name="quosn" value="<?php echo $schinfo['QuoSn']; ?>">
                        <?php elseif ($edit == 2): ?>
                            <span>报价单名称：</span><input type="text" class="input input3" value="<?php echo $dealer['Title']; ?>" name="quoname" maxlength="20">
                            <span style="margin-left:87px;">报价单编号：</span><span style="padding-left:13px"><?php echo $dealer['QuoSn']; ?></span>
                            <input type="hidden" name="quosn" value="<?php echo $dealer['QuoSn']; ?>">
                        <?php else: ?>
                            <span>报价单名称：</span><input type="text" class="input input3" value="BJD:<?php echo $dealer['OrganName']; ?>" name="quoname" maxlength="20">
                            <span style="margin-left:87px;">报价单编号：</span><span style="padding-left:13px"><?php echo 'BJ' . time() . $dealer['organID']; ?></span>
                            <input type="hidden" name="quosn" value="<?php echo 'BJ' . time() . $dealer['organID']; ?>">
                        <?php endif; ?>
                    </p>
                    <div>
                        <p class="m-top float_l" style="width:310px">
                            <span style="margin-left:12px;">商品总价：</span><input type="text" value="<?php echo $schinfo['GoodFee']; ?>" name="totalprices" class="input input3" id="totalprices" onfocus="this.blur()" readonly> 元   
                        </p>
                        <input type='file' name='file_upload' id="file_upload">   
                        <input class="button" type="button" style="margin-top:10px;margin-left: 20px;display:none" id="delfile" value="删除附件">
                        <div style="clear:both"></div>
                    </div>
                    <?php if ($schinfo['FileName']): ?>
                        <p class="m-top">
                            <span style="margin-left:0px;">已上传附件：</span><span style="color:green;margin-left:10px" class="schemefiles"><a href="javascript:void(0)" url="<?php echo $schinfo['FileUrl']; ?>"><?php echo $schinfo['FileName']; ?></a></span>         
                        </p>
                    <?php else: ?><?php endif; ?>
                    <p style="padding-left:200px;*padding-left:100px">
                        <input type="submit" class="submit f_weight" value="保存" id="savescheme" />
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var againadd = 0;
    var uploadify = 1;  //1表示上传插件可以使用  0表示不行
    $(function() {
        var ifedit =<?php echo $edit; ?>;
        var sid = $('#serviceid').val();
        var quoid = $('#quoid').val();
        var buyempty =<?php echo $buyempty; ?>;
        $(".goto").hide();
        if (ifedit != 1)
        {
            $('#buylist tbody tr').remove();
        } else {
            if (buyempty == 1) {
                $('#buylist tbody tr').remove();
            }
            //给每行数据添加商品id
            $('#buylist tbody').find('tr').each(function() {
                $(this).attr('goodsid', $(this).find('td:eq(9) a').attr('key'));
            })
            $('#buylist [class=pager]').remove();
            setbuyids();
        }

        //发送报价单
        $('#savescheme').click(function() {
            $('#savescheme').attr('disabled', 'disabled');
            if (uploadify == 1) {
                var fileupload = $("#file_upload").uploadify('settings', 'buttonText');
                if (fileupload == "正在上传") {
                    if (confirm('附件正在上传,是否取消?')) {
                        $("#file_upload").uploadify('settings', 'buttonText', '上传附件');
                        $("#file_upload").uploadify('cancel')
                    } else {
                        $('#savescheme').removeAttr('disabled');
                        return false;
                    }
                }
            }
            var buyobj = $('#buylist tbody').find('tr');
            if (buyobj.length == 0) {
                $('#savescheme').removeAttr('disabled');
                alert('请先选择报价单商品')
                return false;
            }
            if ($('input[name=quoname]').val() == '') {
                $('#savescheme').removeAttr('disabled');
                alert('请输入报价单名称')
                return false;
            }
            var totalprices = $('#totalprices').val();
            var minturnover = "<?php echo $minturnover; ?>";
            if (parseFloat(totalprices) < parseFloat(minturnover)) {
                var lessprice = parseFloat(minturnover) - parseFloat(totalprices);
                alert('当前设置订单最小交易额为' + minturnover + '元,此报价单商品比订单最小交易金额少' + lessprice.toFixed(2) + '元。请修改后重新保存');
                $('#savescheme').removeAttr('disabled');
                return false;
            }
            if (parseFloat(totalprices) > 99999999.99) {
                alert('目前单笔交易额不能超过99999999.99元,请减少商品后重新保存');
                $('#savescheme').removeAttr('disabled');
                return false;
            }
            var goodsid = '';
            var goodsprice = '';
            var goodsnum = '';
            buyobj.each(function(k, v) {
                goodsid += $(this).attr('goodsid') + ',';
                goodsprice += $(this).find('[name=price]').val() + ',';
                goodsnum += $(this).find('[name=num]').val() + ',';
            })
            $('#buyids').val(goodsid.substr(0, goodsid.length - 1));
            $('#quoprice').val(goodsprice.substr(0, goodsprice.length - 1));
            $('#quonum').val(goodsnum.substr(0, goodsnum.length - 1));
            var url = Yii_baseUrl + '/pap/quotation/savescheme';
            $('#quoform').form('submit', {
                url: url,
                success: function(result) {
                    result = eval("(" + result + ")");
                    if (result.count > 0) {
                        $("#reminddg").html('<span class="color_blue">您的报价单方案已经保存成功,跳转到报价单方案页面!</span>');
                        $("#reminddg").dialog("open");
                        var prevurl = '<?php echo $prevurl; ?>';
                        if (prevurl.indexOf('/quoid/') == -1) {
                            prevurl += '/quoid/' + result.quoid;
                        }
                        setTimeout("window.location.href='" + prevurl + "'", 1000);
                    }
                    else if (result.count == 0) {
                        $('#savescheme').removeAttr('disabled');
                        $("#reminddg").html('<span style="color:blue">' + result.msg + '</span>');
                        $("#reminddg").dialog("open");
                    }
                    else {
                        $('#savescheme').removeAttr('disabled');
                        alert('发送失败');
                    }
                }
            });
            return false;
        })

        //将商品添加到商品订购清单
        $('#addgoods').click(function() {
            var obj = $('#goodslist tbody').find('input[type="checkbox"]:checked');
            if (obj.length == 0) {
                alert('请先选中一条商品数据');
                return;
            }
            var goodsid = $(obj).val();
            var buyids = $('#buyids').val();
            var idsarr = buyids.split(",");
            obj.each(function(k, v) {
                if ($.inArray(goodsid, idsarr) > -1) {
                    if (confirm('商品已存在,是否增加商品数量')) {
                        againadd = 1;
                    }
                }
                return false;
            })
            obj.each(function(k, v) {
                addgoods($(this));
            })
            formatrowno();
            counttotal();
        })
    })

    function addgoods(obj) {
        var goodsid = $(obj).val();
        var buyids = $('#buyids').val();
        var idsarr = buyids.split(",");
        if ($.inArray(goodsid, idsarr) > -1) {
            if (againadd == 1)
                addagain(goodsid);
            return;
        }
        var objtr = $(obj).parents('tr');
        var data = new Object();
        data.ID = goodsid;
        data.rowNO = 1;
        data.Name = objtr.find('td:eq(2)').html();
        data.GoodsNO = objtr.find('td:eq(3)').html();
        data.OENO = objtr.find('td:eq(4)').html();
        data.BrandName = objtr.find('td:eq(6)').html();
        data.PL = objtr.find('td:eq(7)').html();
        data.GoodsPrice = objtr.find('td:eq(8)').html();
        data.Prices = data.GoodsPrice;
        $("#buyTemplate").tmpl(data).prependTo("#buylist tbody");
        if (buyids)
            $('#buyids').val(buyids + ',' + goodsid);
        else
            $('#buyids').val(goodsid);
    }
</script>
<?php $this->renderpartial('quojs', array('info' => $schinfo['info'])); ?>