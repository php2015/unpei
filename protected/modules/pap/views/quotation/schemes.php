<style>
    .foreachdiv {
        background: none repeat scroll 0 0 #EFF4FA;
        border: 1px solid #feca9a;
    }
    .zdycss {
        background: none repeat scroll 0 0 #fff;
        height:auto;position:relative;border: 2px solid #feca9a;margin:-1px 5px 10px 5px;
    }
    .zdycss2 {
        background: none repeat scroll 0 0 #fff;
        height:auto;position:relative;border: 2px solid #FF0000;margin:-1px 5px 10px 5px
    }
    .tabs{border-style:none; margin-bottom:0px}
    .tabs li{border-style:none; line-height:17px;background:none}
    .tabs li a{padding:0 10px;background-color:transparent;}
    .tabs li a:hover{color:#e77b1a}
    .selected{color:#E77B1A;font-weight:bold;}
    .selectedli{background: url('<?php echo Yii::app()->theme->baseUrl; ?>/images/sanjiao2.png') no-repeat bottom center !important;} 
    table{table-layout:fixed}
    .selected {font-weight: normal;}
</style>
<?php $selectscheme = 1; ?>
<?php $count = count($schinfo); ?>

<div id="tab-container" class="tabs" style="">
    <ul class="pjcx_ul">
        <?php for ($i = 0, $s = 1; $i < $count; $i++, $s = $i + 1): ?>
            <li class='float-l' style="margin-left:0px; " >
                <a id="a_tab<?php echo $s; ?>" href="#tab-scheme<?php echo $s; ?>" class="tabs_a">方案<?php echo $s; ?></a>
            </li>
        <?php endfor; ?>
        <div style="clear:both"></div>
    </ul>
</div>
<div style="clear:both; height:0px"></div>
<?php foreach ($schinfo as $k => $info): ?>
    <div id="tab-scheme<?php echo $k + 1; ?>" <?php if ($info['Status'] == 1): ?>class="zdycss" <?php else:$selectscheme = $k + 1; ?> class="zdycss2" <?php endif; ?> scheme="schemelist"  <?php if ($k != 0): ?>style="display:none" <?php endif; ?>>
        <div class="foreachdiv">
            <p class="txxx">
                商品订购清单 <?php if ($info['Status'] == 2) echo ' -- 已确认此方案'; ?>
                <?php if ($handle == 'quotation'): ?>
                    <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
                        <a name="delscheme" style="float:right;color:red" href="javascript:void(0)" schid="<?php echo $info['SchID']; ?>">删除方案</a>
                        <a href="<?php echo Yii::app()->createUrl('/pap/quotation/makescheme', array_merge($url, array('schid' => $info['SchID']))); ?>" style="float:right;" class="color_blue">编辑方案</a>
                    </span>
                <?php elseif ($handle == 'inquiry'): ?>
                    <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
                        <?php if ($schemecount == 3): ?><a name="delscheme" style="float:right;color:red" href="javascript:void(0)" schid="<?php echo $info['SchID']; ?>">删除方案</a><?php endif; ?>
                        <a href="<?php echo Yii::app()->createUrl('/pap/inquirylist/makescheme', array_merge($url, array('schid' => $info['SchID']))); ?>" style="float:right;" class="color_blue">编辑方案</a>
                    </span>
                <?php endif; ?>
            </p>
            <div class="bor_back txxx_info4">
                <?php
                $extra = array();
                if ($from == 3) {
                    $extra[] = array(
                        'name' => '选中',
                        'type' => 'raw',
                        'value' => '$data[selected]',
                        'headerHtmlOptions' => array('width' => '40px')
                    );
                }
                $this->widget('widgets.default.WGridView', array(
                    'id' => 'buylist' . ($k + 1),
                    'dataProvider' => $info['goodsinfo'],
                    'columns' => array_merge(array(
                        array(
                            'name' => '#',
                            'type' => 'raw',
                            'value' => '$data[rowNo]',
                            'headerHtmlOptions' => array('width' => '20px')
                        ),
                        array(
                            'name' => '商品名称',
                            'type' => 'raw',
                            'value' => '$data[Name]',
                            'headerHtmlOptions' => array('width' => '100px'),
                            'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                        ),
                        array(
                            'name' => '商品编号',
                            'type' => 'raw',
                            'value' => '$data[GoodsNO]',
                            'headerHtmlOptions' => array('width' => '80px'),
                            'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                        ),
                        array(
                            'name' => 'OE号',
                            'type' => 'raw',
                            'value' => '$data[OENO]',
                            'headerHtmlOptions' => array('width' => '120px'),
                            'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                        ),
                        array(
                            'name' => '品牌',
                            'value' => '$data[BrandName]',
                            'headerHtmlOptions' => array('width' => $from ? '50px' : '80px')
                        ),
                        array(
                            'name' => '配件档次',
                            'value' => '$data[PL]',
                            'headerHtmlOptions' => array('width' => '60px'),
                        ),
                        array(
                            'name' => '单价(元)',
                            'type' => 'raw',
                            'value' => '$data[Price]',
                            'headerHtmlOptions' => array('width' => '70px')
                        ),
                        array(
                            'name' => '数量(个)',
                            'type' => 'raw',
                            'value' => '$data[Num]',
                            'headerHtmlOptions' => array('width' => $from ? '100px' : '60px')
                        ),
                        array(
                            'name' => '总价(元)',
                            'type' => 'raw',
                            'value' => '$data[totalprices]',
                            'headerHtmlOptions' => array('width' => '80px'),
                            'htmlOptions' => array('name' => 'prices'),
                        )
                            ), $extra)
                ))
                ?>
            </div>

            <p class="txxx">报价单信息</p>
            <div class="txxx_info4">
                <p class="m-top">
                    <span style="margin-left:12px;">商品总价：</span><span style="width:150px;display:inline-block;" id="total_append_lms<?php echo ($k + 1) ?>" class="totalprice"><?php echo $info['GoodFee']; ?>元</span>
                    <span style="display:none"><span style="margin-left:98px;margin-right:5px;">物流费用：</span><span><?php echo $info['ShipFee']; ?>元</span></span>
                    <?php if ($info['FileName']): ?>
                        <span style="margin-left:120px;">方案附件：</span><span style="color:green;margin-left:10px" class="schemefiles"><a href="javascript:void(0)" url="<?php echo $info['FileUrl']; ?>"><?php echo $info['FileName']; ?></a></span>
                    <?php endif; ?>
                </p>
                <p class="m-top" style="display:none">
                    <span style="margin-left:36px;">报价：</span><span style="width:150px;display:inline-block;"><?php echo $info['TotalFee']; ?>元</span>
                </p>
            </div>

        </div>      
    </div>
<?php endforeach; ?>
<form id="importform" method="post">
    <input id="fmpath" name="fileurl" type="hidden">
    <input id="fmname" name="filename" type="hidden">
</form>
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="GoodsID">
</form>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jquery.idTabs.min.js'></script>
<script>
    $(function() {
        $("#tab-container ul").idTabs();
        $('div[class=pager]').remove();

        $(".tabs_a").click(function() {
            $('.pjcx_ul li').removeClass('selectedli');
            $(this).parent('li').addClass('selectedli');
        })
        $('#a_tab<?php echo $selectscheme; ?>').trigger('click');
        //商品详情
        $('.order_goods').bind('click', function() {
            var url = this.href;
            $('input[name=Version]').val($(this).attr('version'));
            $('input[name=GoodsID]').val($(this).attr('goodsid'));
            $('#goodsform').attr('action', url);
            $('#goodsform').submit();
            return false;
        })

        //下载附件
        $(".schemefiles").click(function() {
            $('#fmpath').val($(this).find('a').attr('url'));
            $('#fmname').val($(this).find('a').text());
            $('#importform').form({
                url: Yii_baseUrl + '/upload/ftpdownload',
                success: function(data) {
                    var result = eval('(' + data + ')');
                    if (result.res == 0)
                        alert(result.msg)
                }
            });
            $('#importform').submit();
        });
    })
</script>