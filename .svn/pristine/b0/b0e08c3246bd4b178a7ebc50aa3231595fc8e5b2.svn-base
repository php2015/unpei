<?php 
$this->pageTitle = Yii::app()->name . '-' . "服务管理"; 
$this->breadcrumbs = array(
	'服务管理' => Yii::app()->createUrl('/common/servicelist'),
    '服务管理' => Yii::app()->createUrl("servicer/servicemanage/index"),
	'添加服务记录'
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
.input{margin-left:0px}
.select{margin-right:5px; margin-left:0}
</style>
<div class="bor_back m_top">
	<p class="txxx txxx3">添加服务记录</p>
	<p>
		<span style="display:block;float: right;margin-top: -25px;margin-right: 15px;">
		<a href="<?php echo Yii::app()->createUrl('servicer/servicemanage/checkcars')?>" id="back" style="font-weight:400">返回</a>
		</span>
	</p>
	<div class="txxx_info4">
    <form id="add_fm" method="post" action="<?php echo Yii::app()->createUrl("servicer/servicemanage/add");?>">		
        <div id="Overview" class="dttable" style="padding-top:20px;" title="配件服务登记">
            <p class="m-top5" style="height:30px;">
                <label class="label1 m_left40">当前里程数：</label>
                <input name="Mileage" class="width150 input" required="true" id="mileage">&nbsp;km
                    <span id="mileageNote"></span>
            </p>
            <p id="SelectType" class="m-top5" style="height:30px;line-height: 30px;">
                <label class="label1 m_left40" style="padding-left:12px;">服务类型：</label>
                <input type="radio" id="ServiceType1" name="ServiceType" value="1" class="checkbox" checked="checked">&nbsp;日常保养&nbsp;&nbsp;
                <input type="radio" id="ServiceType2" name="ServiceType" value="2" class="checkbox">&nbsp;配件服务&nbsp;&nbsp;
                <input type="radio" id="ServiceType3" name="ServiceType" value="3" class="checkbox">&nbsp;全部服务&nbsp;&nbsp;
            </p>
            <p id="partsRemark" class="m-top5" style="">
                <label class="label m_left12" style="padding-left:16px; vertical-align: top">日常保养备注：</label>
                <textarea id="Remark" name="Remark" cols="90" rows="2" style="border:1px solid #ccc"></textarea>
            </p>
            <p id="partsSelect" class="m-top5" style="height:30px;display:none;">
                <label class="label m_left12" style="padding-left:16px;">配件服务类别：</label>
                <input type="checkbox" id="partsType1" xb='xb' name="partsType[]" value="1" class="checkbox">&nbsp;配件更换&nbsp;&nbsp;
                <input type="checkbox" id="partsType2" xb='xb' name="partsType[]" value="2" class="checkbox">&nbsp;配件维修&nbsp;&nbsp;
            </p>
        </div>
        <div id="partsService" class="dttable">
        </div>
        <p class="m-top5" style="margin-bottom:10px;">
	        <input type="hidden" name="ID" value="<?php echo $id?>">
	        <input id="add" type="button" value="保存" class="submit" style="margin-top:5px;margin-left:200px;">
        </p>
    </form>
    <?php if (!empty($result)){?>
	<script type="text/javascript">
	alert("<?php echo $result['Msg']?>");
	</script>
	<?php if ($result['result']){ $this->redirect(index);}?>
	<?php }?>
<!--     <div id="dlg-adds">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="save-btn" onclick="saveRecord()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#add_dlg').dialog('close')">取消</a>
    </div> -->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#back').click(function(){
		history.go(-1);
		});
	$("#mileage").blur(function(){
		if($("#mileage").val()==""){
			alert("里程数不能为空！");
			$("#mileage").addClass("input1");
		}else{
			if(!/^[0-9_]+$/g.test($("#mileage").val())){
				alert("里程数必须为数字！");
				$("#mileage").addClass("input1");
			}else{
				$("#mileage").removeClass("input1");
			}
		}
	});
	$("#add").live('click',function(){
		if($("#mileage").val()==""){
			alert("里程数不能为空！");
			$("#mileage").addClass("input1");
			return false;
		}
                //配件更换
                if($('#partsType1').attr("checked")){
                    if($('#showReplace span[name=mainname]').text()==""){
                        alert("未添加更换所需配件！");
                        return false;
                    }
                }
                //配件维修
                if($('#partsType2').attr("checked")){
                    if($('#showRepair span[name=mainname]').text()==""){
                        alert("未添加维修所需配件！");
                        return false;
                    }
                }
		$("#add_fm").submit();
	})
	$('#Remark').keyup(function(){
        var leng=$(this).val().length;
        var zihu=$('#Remark').val().substr(0,100);
        if(leng>100){
            alert('日常保养备注信息不能超过100个字符 ');
            document.getElementById("Remark").value = zihu;
        }
    })
    $('#TechnicianName').live('keyup',function(){
        var leng=$(this).val().length;
        var zihu=$('#TechnicianName').val().substr(0,24);
        if(leng>24){
            alert('日常保养备注信息不能超过24个字符 ');
            document.getElementById("TechnicianName").value = zihu;
        }
    })
    $('#RepairCause').live('keyup',function(){
        var leng=$(this).val().length;
        var zihu=$('#RepairCause').val().substr(0,128);
        if(leng>128){
            alert('维修原因信息不能超过128个字符 ');
            document.getElementById("RepairCause").value = zihu;
        }
    }) 
    $('#RevisedNote').live('keyup',function(){
        var leng=$(this).val().length;
        var zihu=$('#RevisedNote').val().substr(0,128);
        if(leng>128){
            alert('修后说明信息不能超过128个字符 ');
            document.getElementById("RevisedNote").value = zihu;
        }
    })
})
</script>
<script id="replace" type="text/x-jquery-tmpl">
    <p class="m-top5 replace" style="height:30px;">
        <label class="label1 m_left40" style="padding-left:12px;">配件更换：</label>
        <td class="a_l" colspan="4" style='white-space:nowrap;'>
            <?php $this->widget("widgets.default.WGcategory", array('scope' => '_add_replace')); ?>
        </td>
    </p>
     <p class="m-top5 replace" style="height:30px;">
        <label class="label1 m_left12" style="padding-left:105px;">品牌：</label>
<input name="replace_brand" class="input" style="width:100px;" />
        <label class="label1" width=150>数量：</label><input name="replace_num" class="input" style="width:100px;" value="1" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
        <label class="label1" width=150>OE号：</label><input name="replace_OE" class="input" style="width:100px;" />
        <label class="label1"></label><input id='addReplace' onclick="replace()" class='submit' href="javascript:;" rm='click_class_bg-green' value="添加" style="padding-left:25px;">
    </p>
   <p class="m-top5 showReplace replace" style="margin-left:120px;">
        <label class="label1 m_left12" id="showReplace"></label>
    </p>
</script>
<script id="repair" type="text/x-jquery-tmpl">
    <p class="m-top5 repair" style="height:30px;">
        <label class="label1 m_left40" style="padding-left:12px;">配件维修：</label>
        <td class="a_l" colspan="4" style='white-space:nowrap;'>
            <?php $this->widget("widgets.default.WGcategory", array('scope' => '_add_repair')); ?>
        </td>
    </p>	
    <p class="m-top5 repair" style="height:30px;">
        <label class="label1 m_left12" style="padding-left:105px;">品牌：</label><input name="repair_brand" class="input" style="width:100px;" />&nbsp;
            <input id='addRepair' onclick="repair()" class='submit' href="javascript:;" rm='click_class_bg-green' value="添加" style="padding-left:25px;">
    </p>
    <p class="m-top5 showRepair repair" style="margin-left:120px;">
        <label class="label1 m_left12" style="padding-left:64px;" id="showRepair"></label>
    </p>
    <p class="m-top5 repair" style="height:30px;">
        <label class="label1 m_left40" style="padding-left:12px;">技师名称：</label>
        <input id="TechnicianName" name="TechnicianName" class="width98 input">
    </p>
    <p class="m-top5 repair">
        <label class="label1 m_left40" style="padding-left:12px; vertical-align:top">维修原因：</label>
        <textarea id="RepairCause" name="RepairCause" cols="90" rows="2" style="border:1px solid #ccc"></textarea>
    </p>
    <p class="m-top5 repair">
        <label class="label1 m_left40" style="padding-left:12px;vertical-align:top">修后说明：</label>
        <textarea id="RevisedNote" name="RevisedNote" cols="90" rows="2"style="border:1px solid #ccc"></textarea>
    </p>	
</script>
<?php $this->renderPartial('addjs'); ?>