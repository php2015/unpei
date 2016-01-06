<style>
    .ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button{ font-family: "宋体"}
    .xjd3 {
        background: url(<?php echo F::themeUrl(); ?>/images/tubiao2.png) no-repeat;
        background-position: 0px 0px;
        text-indent: 2em;
        display: block;
        height: 23px;
        line-height: 23px;
        width: 20px;
        cursor: pointer;
    }
    .scsp {
        background: url(<?php echo F::themeUrl(); ?>/images/support/scsp.png) no-repeat;
        background-position: 0px 5px;
        text-indent: 2em;
        display: block;
        height: 23px;
        line-height: 23px;
        width: 20px;
        margin-left: 2px;
        cursor: pointer;
    }
    .select_Item{
        vertical-align: middle;width:124px; text-align: center;
    }
    .select_Item .select {
        margin: 0px;
        height: 27px;
        line-height: 27px;
        padding: 0px;
        width: 124px;
        font-family: Trebuchet MS;
    }
    .parts-ul .w130{width:130px}
    .parts-ul .w210{width:210px}
    .parts-ul .w110{width:110px;}
    #addparts-form input.w200{width:200px}
    .w85{width:85px}
    .w90{width:90px}
    .w80{width:80px}
    .f_l{float:left}
    .parts-ul{ background:#ececec; line-height:30px; border:1px solid #ccc}
    .parts-ul li{ text-align:center;}
    .addparts-form .input{ margin-left:0px}
</style>
<!--配件登记开始-->
<div class="content2d">
    <form id="addparts-form" action="<?php Yii::app()->createUrl("servicer/servicesupport/addparts"); ?>" method="post">
        <p>
            日期：<input name="CreateTime" type="text" class="input" value="<?php echo $data[0]['CreateTime'] ? date('Y/m/d', $data[0]['CreateTime']) : date('Y/m/d'); ?>" readonly="readonly"/>
            <span style="color: red">*</span>当前行驶里程数：<input id="add_parts_mileage" maxlength="9" name="Mileage" type="text" class="input" value="<?php echo $data[0]['Mileage']; ?>"/>KM
            <input type="hidden" name="RecordID" value="<?php echo $RecordID; ?>">
            <input type="hidden" name="CarID" value="<?php echo $CarID; ?>">
        </p>
        <div class="center m-top">
            <ul class="parts-ul" >

                <li class="w130 f_l" ><span style="color: red">*</span>保养项目</li>
                <li class="w210 f_l"><span style="color: red">*</span>商品名称</li>
                <li class="w110 f_l">商品编号</li>
                <li class="w85 f_l">档次</li>
                <li class="w110 f_l">品牌</li>
                <li class="w80 f_l"><span style="color: red">*</span>数量</li>
                <li></li>
                <div style="clear:both;height:0px"></div>
            </ul>
        </div>
        <div id="table_body" style="border:1px solid #ccc;">
            <?php if (empty($data)) { //新增配件登记?>
                <div class="m-top5" style="border-bottom:1px solid #ccc;">
                    <div style="vertical-align: middle;width:130px; text-align: center;"  class="f_l select_Item" >
                        <select name="Item[]" class="select w124">
                            <option value="0">请选择</option>
                            <?php
                            foreach ($item as $key => $val) {
                                echo '<option value="' . $val['ItemID'] . '">' . $val['ItemName'] . '</option>';
                            }
                            ?>
                        </select>
                        <input type="hidden" name="partsnum[]" value="1" class="">
                    </div>
                    <div class="f_l" style=" width:655px;margin-bottom: 5px;">
                        <div class="f_l w200" style="text-align:center">
                            <input name="PartName[]" type="text" class="input w200" maxlength="20">
                            <input type="hidden" name="partsID[]" value="">
                        </div>
                        <div class="f_l w110">
                            <input name="OE[]" type="text" class="input w100" maxlength="20">
                        </div>
                        <div class="f_l w80">
                            <select name="PartsLevel[]" class="select w75">
                                <option value="">请选择</option>
                                <option value="A">原厂</option>
                                <option value="B">高端品牌</option>
                                <option value="C">经济实用</option>
                                <option value="D">下线</option>
                                <option value="E">拆车</option>
                            </select>
                        </div>
                        <div class="f_l w110">
                            <input name="Brand[]" type="text" class="input w100" maxlength="10">
                        </div>
                        <div class="f_l w90" style="text-align:center; padding-top:5px">
    <!--                            <input type="button" class="decrease_quantity" value="-" style="text-align: center;" />-->
                            <input class="num" name="num[]" type="text" style="width:30px;text-align: center;" value="0" />
    <!--                            <input type="button" class="add_quantity" value="+" style="text-align: center;" />-->
                        </div>
                        <div style="vertical-align: bottom; width:45px" class="parts_caozuo f_l">
                            <span class="f_l xjd3"></span><span class="scsp f_l"></span>
                        </div>
                        <div style="clear: both"></div>
                    </div>  
                    <div style="clear: both"></div>
                </div>
            <?php } else { //修改配件登记信息?>
                <?php foreach ($data as $key => $val) { ?>
                    <?php $count = count($val['info']); ?>
                    <div class="m-top5" style="border-bottom:1px solid #ccc;">
                        <div style="vertical-align: middle;width:130px; text-align: center;height: <?php echo (27 * $count + 5 * ($count - 1)) . "px" ?>;line-height: <?php echo (27 * $count + 5 * ($count - 1)) . "px" ?>"  class="f_l select_Item" >
                            <select name="Item[]" class="select w124">
                                <option value="0">请选择</option>
                                <?php foreach ($item as $itemkey => $itemval) { ?>
                                    <option value="<?php echo $itemval['ItemID'] ?>" 
                                            <?php if ($itemval['ItemID'] == $val['ItemID']) echo 'selected="selected"'; ?>>
                                                <?php echo $itemval['ItemName']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="partsnum[]" value="<?php echo $count; ?>" class="">
                        </div>
                        <?php foreach ($val['info'] as $k => $v) { ?>
                            <div class="f_l" style=" width:655px;margin-bottom: 5px;">
                                <div class="f_l w200" style="text-align:center">
                                    <input name="PartName[]" type="text" class="input w200" maxlength="20" value="<?php echo $v['GoodsName']; ?>">
                                    <input type="hidden" name="partsID[]" value="<?php echo $v['ID']; ?>">
                                </div>
                                <div class="f_l w110">
                                    <input name="OE[]" type="text" class="input w100" maxlength="20" value="<?php echo $v['GoodsNum']; ?>">
                                </div>
                                <div class="f_l w80">
                                    <select name="PartsLevel[]" class="select w75">
                                        <option value="">请选择</option>
                                        <option value="A" <?php
                                        if ($v['PartsLevel'] == A) {
                                            echo 'selected=selected';
                                        }
                                        ?>>原厂</option>
                                        <option value="B" <?php
                                        if ($v['PartsLevel'] == B) {
                                            echo 'selected=selected';
                                        }
                                        ?>>高端品牌</option>
                                        <option value="C" <?php
                                        if ($v['PartsLevel'] == C) {
                                            echo 'selected=selected';
                                        }
                                        ?>>经济实用</option>
                                        <option value="D" <?php
                                        if ($v['PartsLevel'] == D) {
                                            echo 'selected=selected';
                                        }
                                        ?>>下线</option>
                                        <option value="E" <?php
                                        if ($v['PartsLevel'] == E) {
                                            echo 'selected=selected';
                                        }
                                        ?>>拆车</option>
                                    </select>
                                </div>
                                <div class="f_l w110">
                                    <input name="Brand[]" type="text" class="input w100" maxlength="10" value="<?php echo $v['Brand']; ?>">
                                </div>
                                <div class="f_l w90" style="text-align:center; padding-top:5px">
            <!--                                    <input type="button" class="decrease_quantity" value="-" style="text-align: center;" />-->
                                    <input class="num" name="num[]" type="text" style="width:30px;text-align: center;" value="<?php echo $v['Num'] ? $v['Num'] : 0; ?>" />
            <!--                                    <input type="button" class="add_quantity" value="+" style="text-align: center;" />-->
                                </div>
                                <div style="vertical-align: bottom; width:45px " class="parts_caozuo f_l">
                                    <span class="f_l<?php if ($k === $count - 1) echo " xjd3"; ?>"></span><span class="scsp f_l"></span>
                                </div>
                                <div style="clear: both"></div>
                            </div>  
                        <?php } ?>
                        <div style="clear: both"></div>
                    </div>
                <?php } ?>
            <?php } ?>
            <input id="delID" type="hidden" name="delID" value="">
        </div>

        <p class="m-top">
            <span id="tjbyxm" class="xjd" style="cursor: pointer;color: blue">添加保养项目</span>
        </p>
        <p class="m-top" style="vertical-align: top;">
            补充说明：<textarea name="Remark" style="width:300px;height: 84px" maxlength="127"><?php echo $data[0]['Remark']; ?></textarea>
        </p>
        <p class="m-top" style="text-align: center;">
            <input id="add_parts_form" type="button" value="确定" class="submit">
            <input id="close_dialog" type="button" value="关闭" style="width:80px;height:30px;">
        </p>
    </form>

    <div style="clear:both"></div>
</div>
<!--配件登记结束-->

<script id="add_item" type="text/x-jquery-tmpl">
    <div class="m-top5" style="border-bottom:1px solid #ccc;">
    <div style="vertical-align: middle;width:130px; text-align: center"  class="f_l select_Item" >
    <select name="Item[]" class="select w124">
    <option value="0">请选择</option>
<?php
foreach ($item as $key => $val) {
    echo '<option value="' . $val['ItemID'] . '">' . $val['ItemName'] . '</option>';
}
?>
    </select>
    <input type="hidden" name="partsnum[]" value="1" class="">
    </div>
    <div class="f_l" style=" width:655px;margin-bottom: 5px;">
    <div class="f_l w200" style="text-align:center">
    <input name="PartName[]" type="text" class="input w200" maxlength="20">
    <input type="hidden" name="partsID[]" value="">
    </div>
    <div class="f_l w110">
    <input name="OE[]" type="text" class="input w100" maxlength="20">
    </div>
    <div class="f_l w80">
    <select name="PartsLevel[]" class="select w75">
    <option value="">请选择</option>
    <option value="A">原厂</option>
    <option value="B">高端品牌</option>
    <option value="C">经济实用</option>
    <option value="D">下线</option>
    <option value="E">拆车</option>
    </select>
    </div>
    <div class="f_l w110">
    <input name="Brand[]" type="text" class="input w100" maxlength="10">
    </div>
    <div class="f_l w90" style="text-align:center; padding-top:5px">
<!--    <input type="button" class="decrease_quantity" value="-" style="text-align: center;" />-->
    <input class="num" name="num[]" type="text" style="width:30px;text-align: center;" value="0" />
<!--    <input type="button" class="add_quantity" value="+" style="text-align: center;" />-->
    </div>
    <div style="vertical-align: bottom; " class="parts_caozuo f_l">
    <span class="f_l xjd3"></span><span class="scsp f_l"></span>
    </div>
    <div style="clear: both"></div>
    </div>  
    <div style="clear: both"></div>
    </div>
</script>
<script id="add_parts" type="text/x-jquery-tmpl">
    <div class="f_l" style=" width:655px;margin-bottom: 5px;"">
    <div class="f_l w200" style="text-align:center">
    <input name="PartName[]" type="text" class="input w200" maxlength="20">
    <input type="hidden" name="partsID[]" value="">
    </div>
    <div class="f_l w110">
    <input name="OE[]" type="text" class="input w100" maxlength="20">
    </div>
    <div class="f_l w80">
    <select name="PartsLevel[]" class="select w75">
    <option value="">请选择</option>
    <option value="A">原厂</option>
    <option value="B">高端品牌</option>
    <option value="C">经济实用</option>
    <option value="D">下线</option>
    <option value="E">拆车</option>
    </select>
    </div>
    <div class="f_l w110">
    <input name="Brand[]" type="text" class="input w100" maxlength="10">
    </div>
    <div class="f_l w90" style="text-align:center; padding-top:5px">
<!--    <input type="button" class="decrease_quantity" value="-" style="text-align: center;" />-->
    <input class="num" name="num[]" type="text" style="width:30px;text-align: center;" value="0" />
<!--    <input type="button" class="add_quantity" value="+" style="text-align: center;" />-->
    </div>
    <div style="vertical-align: bottom; " class="parts_caozuo f_l">
    <span class="f_l xjd3"></span><span class="scsp f_l"></span>
    </div>
    <div style="clear: both"></div>
    </div> 
</script>
<script>
    //行程里数只能输入数字
    $("input[name=Mileage]").blur(function() {
        var Mileage = $(this).val();
        if (Mileage.match(/[^\d]/g)) {
            alert("行程里数只能输入正整数");
        }
        var reg = /[^\d]/g;
        var str = Mileage.replace(reg, "");
        $(this).attr("value", str);
    });
    $(".num").focus(function(){
        if($(this).val()==="0"){
            $(this).val("");
        }
    });
    $(".num").blur(function(){
        if($(this).val()===""){
            $(this).val("0");
        }
    });
</script>