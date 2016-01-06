<div class="bor_back m-top">
    <p class="txxx">商品订购清单</p>
    <div class="txxx_info4">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'id' => 'buylist',
            'dataProvider' => $buy,
            'columns' => array(
                array(
                    'name' => '#',
                    'value' => 'CHtml::encode($data[rowNo])',
                    'headerHtmlOptions' => array('width' => '10px')
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
                    'headerHtmlOptions' => array('width' => '90px'),
                    'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                ),
                array(
                    'name' => 'OE号',
                    'type' => 'raw',
                    'value' => '$data[OENO]',
                    'headerHtmlOptions' => array('width' => '100px'),
                    'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                ),
                array(
                    'name' => '品牌',
                    'value' => '$data[BrandName]',
                    'headerHtmlOptions' => array('width' => '70px')
                ),
                array(
                    'name' => '配件档次',
                    'value' => '$data[PL]',
                    'headerHtmlOptions' => array('width' => '60px'),
                ),
                array(
                    'name' => '单价(元)',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("price","$data[Price]",array("style"=>"width:50px;margin-top:2px;height:20px;line-height:20px","onblur"=>"priceblur($data[GoodsID],this)","onkeyup"=>"pricekeyup($data[GoodsID],this)","class"=>"input input5 float_l"))',
                    'headerHtmlOptions' => array('width' => '60px')
                ),
                array(
                    'name' => '数量(个)',
                    'type' => 'raw',
                    'value' => '$data[Num]',
                    'headerHtmlOptions' => array('width' => '100px')
                ),
                array(
                    'name' => '总价(元)',
                    'type' => 'raw',
                    'value' => '$data[totalprices]',
                    'headerHtmlOptions' => array('width' => '75px'),
                    'htmlOptions' => array('name' => 'prices'),
                ),
                array(
                    'name' => '操作',
                    'type' => 'raw',
                    'value' => 'CHtml::tag("a",array("href"=>"javascript:void(0)","key"=>"$data[GoodsID]","class"=>"delgoods"),"删除")',
                    'headerHtmlOptions' => array('width' => '30px')
                ),
            )
        ))
        ?>
    </div>
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

<!--商品订购清单模板-->
<script id="buyTemplate" type="text/x-jquery-tmpl">
    <tr class="odd" goodsid="${ID}">
    <td>${rowNO}</td>
    <td width="100px" style="white-space:nowrap; overflow: hidden;text-overflow:ellipsis;">{{html Name}}</td>
    <td width="90px" style="white-space:nowrap; overflow: hidden;text-overflow:ellipsis;">{{html GoodsNO}}</td>
    <td width="120px" style="white-space:nowrap; overflow: hidden;text-overflow:ellipsis;">{{html OENO}}</td>
    <td width="80px">${BrandName}</td>
    <td width="60px">${PL}</td>
    <td width="50px"><input type="text" name="price" value="${GoodsPrice}" class="input input5 float_l" style="width:50px;margin-top:2px;height:20px;line-height:20px" onkeyup="pricekeyup('${GoodsPrice}',this);" onblur="priceblur('${ID}',this);"></td>
    <td width="100px">
    <a href="javascript:void(0)" class="s" onclick="numsub('${ID}',this)" style="margin-top:2px"></a>
    <input type="text" class="input input5 width40 float_l" style="width:30px;margin-top:2px;height:20px;line-height:20px" value="1" onkeyup="numkeyup('${ID}',this)" onblur="numblur('${ID}',this);" name="num">
    <a href="javascript:void(0)" class="a" onclick="numadd('${ID}',this)" style="margin-top:2px"></a>
    </td>
    <td width="50px" name="prices">${Prices}</td>
    <td width="30px"><a key="${ID}" href="javascript:void(0)" class="delgoods">删除</a></td>
    </tr>
</script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script>
//商品详情
$(document).on('click', '.order_goods', function() {
    var url = this.href;
    $('input[name=Version]').val($(this).attr('version'));
    $('input[name=GoodsID]').val($(this).attr('goodsid'));
    $('#goodsform').attr('action', url);
    $('#goodsform').submit();
    return false;
})
</script>