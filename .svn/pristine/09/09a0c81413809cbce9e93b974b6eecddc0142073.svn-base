<?php
$this->pageTitle = Yii::app()->name . ' - ' . "修改服务管理";
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '修改服务管理' => Yii::app()->createUrl('servicer/servicemanage/edit', array('id' => $id)),
    '添加配件'
);
?>
<style>
    .gsxx{ width:800px; margin:0 auto; line-height:30px}
    .a_r{ text-align:right}
    .a_l{text-align:left}
    .a_c{ text-align:center}
    .txxx3{ border-bottom:1px dashed #c9d5e3}
    .width115{ width:115px}
    .filePrew2{height:25px; width:100px; cursor:pointer }
</style>
<div class="bor_back m_top">
    <p class="txxx txxx3">添加服务记录</p>
    <p>
        <span style="display:block;float: right;margin-top: -25px;margin-right: 15px;">
            <a href="<?php echo Yii::app()->createUrl("servicer/servicemanage/edit", array('id' => $id)); ?>" style="font-weight:400">返回</a>
        </span>
    </p>
    <div class="txxx_info4">
        <!--添加-->
        <form id="add_parts_fm" method="post" action="<?php echo Yii::app()->createUrl("servicer/servicemanage/addparts", array('id' => $id)); ?>">		
            <div class="dttable" style="padding-top:20px;" title="配件服务登记">
                <p class="m-top5" style="height:30px;">
                    <label class="label m_left12" style="padding-left:16px;">配件服务类别:</label>
                    <input type="checkbox" id="partsCate1" xb='xb' name="partsCate[]" value="1">&nbsp;配件更换&nbsp;&nbsp;
                    <input type="checkbox" id="partsCate2" xb='xb' name="partsCate[]" value="2">&nbsp;配件维修&nbsp;&nbsp;
                </p>
            </div>
            <div id="partsRegisyer" class="dttable">
            </div>
            <input id="add" type="button" value="保存" class="submit" style="margin-top:5px;margin-left:200px;margin-bottom:10px;">
        </form>
        <!--<div id="dlg-parts">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="parts-btn" onclick="saveParts()">保存</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#add_parts_dlg').dialog('close')">取消</a>
        </div>
        -->
    </div>
</div>
<script id="parts_replace" type="text/x-jquery-tmpl">
    <p class="m-top5 parts_replace" style="height:30px;">
    <label class="label1 m_left40" style="padding-left:12px;">配件更换:</label>
    <label class="a_l" colspan="4" style='white-space:nowrap;'>
    <?php $this->widget("widgets.default.WGcategory", array('scope' => '_edit_replace')); ?>
    </label>
    </p>
    <p class="m-top5 parts_replace" style="height:30px;">
    <label class="label1 m_left12" style="padding-left:64px;">品牌: <input name="replaceBrand" class="input" style="width:100px;" maxlength = '10'/></label>
    <label class="a_l" width=150>数量: <input name="replaceNum" class="input" style="width:100px;" value="1" maxlength = '5' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/></label>
    <label class="a_l" width=150>OE号: <input name="replaceOE" class="input" style="width:100px;" maxlength = '20'/></label>
    <label class="a_l">
    <input onclick="partsReplace()" class='submit' href="javascript:;" rm='click_class_bg-green' value="添加" style="padding-left:25px;">
    </label>
    </p>
    <p class="m-top5 showReplace parts_replace" style="margin-left:120px;">
    <label class="label1 m_left12" id="showpartsReplace"></label>
    </p>
</script>
<script id="parts_repair" type="text/x-jquery-tmpl">
    <p class="m-top5 parts_repair" style="height:30px;">
    <label class="label1 m_left40" style="padding-left:12px;">配件维修:</label>
    <label class="a_l" colspan="4" style='white-space:nowrap;'>
    <?php $this->widget("widgets.default.WGcategory", array('scope' => '_edit_repair')); ?>
    </label>
    </p>
    <p class="m-top5 parts_repair" style="height:30px;">
    <label class="label1 m_left12" style="padding-left:64px;">品牌: <input name="repairBrand" class="input" style="width:100px;" maxlength = '10'>&nbsp;
    <input onclick="partsRepair()" class='submit' href="javascript:;" rm='click_class_bg-green' value="添加" style="padding-left:25px;">
    </label>
    </p>
    <p class="m-top5 showRepair parts_repair" style="margin-left:120px;">
    <label class="label1 m_left12" id="showpartsRepair"></label>
    </p>
    <p class="m-top5 parts_repair" style="height:30px;">
    <label class="label1 m_left40" style="padding-left:12px;">技师名称: </label>
    <label class="a_l" colspan="4"><input name="TechnicianName" class="width98 input" /></label>
    </p>
    <p class="m-top5 parts_repair">
    <label class="label1 m_left40" style="padding-left:12px;">维修原因: </label>
    <label class="a_l" colspan="4"><textarea name="RepairCause" maxlength="128" cols="90" rows="2"></textarea></label>
    </p>
    <p class="m-top5 parts_repair">
    <label class="label1 m_left40" style="padding-left:12px;">修后说明: </label>
    <label class="a_l" colspan="4"><textarea name="RevisedNote" maxlength="128" cols="90" rows="2"></textarea></label>
    </p>	
</script>
<?php $this->renderPartial('editjs'); ?>
<script>
    $('.submit').click(function() {
        var contents = $('#mainCategory_edit_replace').val();
        if (contents == 'undefined' || contents == '') {
            alert('请选择配件更换');
            return false;
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#add").live('click', function() {
            //配件更换
            if ($('#partsCate1').attr("checked")) {
                if ($('#showpartsReplace span[name=mainname]').text() === "") {
                    alert("未添加更换所需配件！");
                    return false;
                }
            }
            //配件维修
            if ($('#partsCate2').attr("checked")) {
                if ($('#showpartsRepair span[name=mainname]').text() === "") {
                    alert("未添加维修所需配件！");
                    return false;
                }
            }
            $("#add_parts_fm").submit();
        });
        $('#TechnicianName').live('keyup', function() {
            var leng = $(this).val().length;
            var zihu = $('#TechnicianName').val().substr(0, 24);
            if (leng > 24) {
                alert('日常保养备注信息不能超过24个字符 ');
                document.getElementById("TechnicianName").value = zihu;
            }
        });
//        $('#RepairCause').live('keyup', function() {
//            alert(1);
//            var leng = $(this).val().length;
//            var zihu = $('#RepairCause').val().substr(0, 128);
//            if (leng > 128) {
//                alert('维修原因信息不能超过128个字符 ');
//                document.getElementById("RepairCause").value = zihu;
//            }
//        });
//        $('#RevisedNote').live('keyup', function() {
//            var leng = $(this).val().length;
//            var zihu = $('#RevisedNote').val().substr(0, 128);
//            if (leng > 128) {
//                alert('修后说明信息不能超过128个字符 ');
//                document.getElementById("RevisedNote").value = zihu;
//            }
//        });
        //限制IE文本域最大输入数
        $("textarea[maxlength]").keyup(function() {
            var area = $(this);
            var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
            if (max > 0) {
                if (area.val().length > max) { //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
                }
            }
        });
        //复制的字符处理问题
        $("textarea[maxlength]").blur(function() {
            var area = $(this);
            var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
            if (max > 0) {
                if (area.val().length > max) { //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
                }
            }
        });
    });
</script>