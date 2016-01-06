<style>
    .tr_click{}
    .button {color: #666;height: 26px;line-height: 12px;width: 60px;}
    table{table-layout:fixed;}
    .uploadify{float:left; width:200px; margin-top: 10px}
    .uploadify-queue{display:none}
    .float_l{float:left;}
    .uploadify-button-text{ color:#fff}
    #goodslist table thead th{*padding-left:15px;}
    #goodslist_c0_all{*margin-left:-4px}
    .bjd .suggestions{margin-top:-3px;*margin-top:-13px;left:308px !important;*left:303px ! important}
    .autohide{white-space:nowrap; overflow: hidden;text-overflow:ellipsis;}
</style>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/pap/jquery.coolautosuggest.css">
<?php
Yii::app()->getClientScript()->registerScript('check', '
$("#goodslist li").click(function(){
var goods=$("#goodslist tbody").find("input:checkbox:checked");
    if(goods.length>0){
    if(confirm("还有勾选的商品,如果跳转页面会失去已勾选的数据")){
        return true;
    }else{
    return false;
    }
    }
})
');

Yii::app()->clientScript->registerScript('search', '
    $("#goodssearch").click(function(){
        var searchtype=$("#searchtype").val();
        if(searchtype==1)
           var keyword=$("#keyword").val();
        else
           var keyword=$("#keywords").val();
        var make=$("#epc_make").val();
        var car=$("#epc_series").val();
        var year=$("#epc_year").val();
        var model=$("#epc_model").val();
        var standcode=$("#parts option:selected").attr("standcode");
        var partslevel=$("#PartsLevel").val();
        $.fn.yiiGridView.update(
            "goodslist",
            {
                url:window.location.href,
                data:{
                     searchtype:searchtype,
                     keyword:keyword,
                     standcode:standcode,
                     make:make,
                     car:car,
                     year:year,
                     model:model,
                     partslevel:partslevel
                }
            }
        )
    });        
');
?>
<p class="m-top bjd"> 
    <span >搜索类型：</span>
    <select class="select select2" id="searchtype" style="width:205px">
        <option value ="1">按名称(首字母)或配件品类检索</option>
        <option value ="2">按商品编号检索</option>
        <option value ="3">按商品OE号检索</option>
    </select>
    <input type="text" class="input input3 width215"  id="keyword">
    <input type="text" class="input input3 width215"  id="keywords" style="display:none">
</p>
<p class="m-top">
    <span>配件档次：</span>
    <select class="select select2" id="PartsLevel" style="width:205px">
        <option value ="">全部</option>
        <option value ="A">原厂</option>
        <option value ="B">高端品牌</option>
        <option value ="C">经济实用</option>
        <option value ="D">下线</option>
        <option value ="E">拆车</option>
    </select>
    <input type="submit" value="搜 索" class="submit f_weight" id="goodssearch" style="margin-left:10px">
</p>
<div class="m-top">  
    <span class="add m_left"><span class="jiahao">+</span></span>
    <a href="javascript:;" class="color_blue" id="addgoods">添加至商品清单</a>
</div>
<div style="min-height:240px;max-height:380px;width:850px;margin-top:10px">
    <?php
    $this->widget('widgets.default.WGridView', array(
        'id' => 'goodslist',
        'dataProvider' => $goodslist,
        'ajaxUpdate' => true,
        'afterAjaxUpdate' => 'function(){ 
                        $(".goto").hide(); 
                        $("#goodslist li").click(function(){
                        var goods=$("#goodslist tbody").find("input:checkbox:checked");
                            if(goods.length>0){
                            if(confirm("还有勾选的商品,如果跳转页面会失去已勾选的数据")){
                                return true;
                            }else{
                            return false;
                            }
                            }
                        })                        
                        }',
        'columns' => array(
            array(
                'class' => 'CCheckBoxColumn',
                'headerHtmlOptions' => array('width' => '20px'),
                'checkBoxHtmlOptions' => array('name' => 'selectgoods'),
                'selectableRows' => '2',
                'value' => '$data[ID]',
            ),
            array(
                'name' => '#',
                'value' => 'CHtml::encode($data[rowNo])',
                'headerHtmlOptions' => array('width' => '20px'),
            ),
            array(
                'name' => '商品名称',
                'type' => 'raw',
                'value' => '$data[Name]',
                'headerHtmlOptions' => array('width' => '95px'),
                'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
            ),
            array(
                'name' => '商品编号',
                'type' => 'raw',
                'value' => '$data[GoodsNO]',
                'headerHtmlOptions' => array('width' => '85px'),
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
                'name' => '标准名称',
                'type' => 'raw',
                'value' => '$data[Stand]',
                'headerHtmlOptions' => array('width' => '60px'),
                'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
            ),
            array(
                'name' => '品牌',
                'value' => '$data[BrandName]',
                'headerHtmlOptions' => array('width' => '70px'),
            ),
            array(
                'name' => '配件档次',
                'value' => '$data[PL]',
                'headerHtmlOptions' => array('width' => '70px'),
            ),
            array(
                'name' => '单价(元)',
                'value' => '$data[GoodsPrice]',
                'headerHtmlOptions' => array('width' => '70px'),
            ),
        )
    ))
    ?>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/pap/jquery.coolautosuggest.js"></script>
<script>
    $(function() {
        $("#keyword").coolautosuggest({
            width: 220,
            url: Yii_baseUrl + '/pap/quotation/hotword/keyword/',
            onSelected: function(res) {
                $("#keyword").val(res.val);
                $('#goodssearch').trigger('click');
            },
            onUpDown: function(res) {
                $("#keyword").val(res.val);
            }
        });

        $('#searchtype').change(function() {
            var val = $(this).val();
            if (val == 1) {
                $("#keyword").show();
                $("#keywords").hide();
            } else {
                $("#keyword").hide();
                $("#keywords").show();
            }
        })
    })
</script>