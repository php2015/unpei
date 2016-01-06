<?php $this->renderPartial('businessjs'); ?>
<style>
    .checkbox-add{line-height:22px}
</style>
<div>
    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/servicemaininfo/index"); ?>">服务报价列表</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/servicemaininfo/maininfo"); ?>" class="active">主营类别管理</a>
    </div>
    <?php
    //获取易损件更换、专业修理、车险服务信息
    //array_splice()剔除数组第一个值;	
    $Wearpart = explode(',', $model['WearParts']);
    $Category = implode(array_splice($Wearpart, 1), ',');
    $Prorepair = explode(',', $model['ProRepair']);
    $Range = implode(array_splice($Prorepair, 1), ',');
    $Autoservice = explode(',', $model['AutoService']);
    $Name = implode(array_splice($Autoservice, 1), ',');
    //获取汽车厂家信息
    $brand_data = D::queryGoodsMakes();
    $brand = CHtml::listData($brand_data, "makeId", "name");
    ?>
    <form id="business_fm" method="post" action="<?php echo Yii::app()->createUrl("servicer/servicemaininfo/addbusiness"); ?>">
        <div class="dttable" style="margin:30px 25px;">
            <div class="form-row" style="height:25px;" id="OrganCate">
                <label class="label"><strong>&nbsp;机构类型:</strong></label>
                <input type="radio" id="fpair" name="OrganType" value="1" <?php if ($model['OrganType'] == '1'): ?>checked<?php endif; ?>>
                <label for="fpair">&nbsp;快修店</label>
                <input type="radio" id="bshop" name="OrganType" value="2" <?php if ($model['OrganType'] == '2'): ?>checked<?php endif; ?> style="margin-left:10px;">
                <label for="bshop">&nbsp;美容店</label>
                <input type="radio" id="tpair" name="OrganType" value="3" <?php if ($model['OrganType'] == '3'): ?>checked<?php endif; ?> style="margin-left:10px;">
                <label for="tpair">&nbsp;车系专修厂</label>
                <input type="radio" id="apair" name="OrganType" value="4" <?php if ($model['OrganType'] == '4'): ?>checked<?php endif; ?> style="margin-left:10px;">
                <label for="apair">&nbsp;全修厂</label>
                <input type="hidden" class="input" name="NewType" value="">
                <input type="hidden" class="input" name="DataType" value="<?php
    if ($model['OrganType']): echo $model['OrganType'];
    endif;
    ?>">
            </div>
            <div class="form-row" style="height:25px;" id="ServiceCate">
                <label class="label"><strong>&nbsp;服务类别</strong></label>(只需选择您提供的服务类别)
            </div>
            <div class="form-row" style="height:25px;<?php
                       if (!$model): echo "display:none;";
                       endif;
    ?>" id="deepclean">
                <label class="label">&nbsp;&nbsp;深度清洁:</label>
                <span class='checkbox-add tags clean fdeep <?php if ($model['DeepClean'] == "1级-内外清洁，精细洗车"): ?>bg-green<?php endif; ?>'>1级-内外清洁，精细洗车</span>
                <span class='checkbox-add tags clean sdeep <?php if ($model['DeepClean'] == "2级-粘连物去除，杀菌除味"): ?>bg-green<?php endif; ?>'>2级-粘连物去除，杀菌除味</span>
                <span class='checkbox-add tags clean tdeep <?php if ($model['DeepClean'] == "3级-机械及电路清洁"): ?>bg-green<?php endif; ?>'>3级-机械及电路清洁</span>
                <input type='hidden' class='input' id="DeepClean" value="<?php
                 if ($model['DeepClean']): echo $model['DeepClean'];
                 endif;
    ?>" name='DeepClean'>
            </div>
            <div class="form-row" style="height:25px;<?php
                       if ($model['OrganType'] != '2'): echo "display:none;";
                       endif;
    ?>" id="carbeauty">
                <label class="label">&nbsp;&nbsp;车辆美容:</label>
                <span class='checkbox-add tags beauty ficar <?php if ($model['CarBeauty'] == "1级-抛光打蜡"): ?>bg-green<?php endif; ?>'>1级-抛光打蜡</span>
                <span class='checkbox-add tags beauty secar <?php if ($model['CarBeauty'] == "2级-封釉镀膜"): ?>bg-green<?php endif; ?>'>2级-封釉镀膜</span>
                <span class='checkbox-add tags beauty thcar <?php if ($model['CarBeauty'] == "3级-局部修复"): ?>bg-green<?php endif; ?>'>3级-局部修复</span>
                <span class='checkbox-add tags beauty focar <?php if ($model['CarBeauty'] == "4级-全车烤漆"): ?>bg-green<?php endif; ?>'>4级-全车烤漆</span>
                <input type='hidden' class='input' id="CarBeauty" value="<?php
                 if ($model['CarBeauty']): echo $model['CarBeauty'];
                 endif;
    ?>" name='CarBeauty'>	
            </div>
            <div class="form-row" style="height:25px;<?php
                       if (!$model): echo "display:none;";
                       endif;
    ?>" id="roumain">
                <label class="label">&nbsp;&nbsp;日常保养:</label>
                <span id="rcby" rm="click_#showMain span_dom" class='checkbox-add tags routine <?php if ($model['RouMain'] == "全车系"): ?>bg-green<?php endif; ?>'>全车系</span>
                <span class='checkbox-add'>|</span>
                <input type='hidden' class='input' id="RouMain" value="<?php
                 if ($model['RouMain']): echo $model['RouMain'];
                 endif;
    ?>" name='RouMain'>
                       <?php
                       echo CHtml::dropDownList('mainmake', '', $brand, array(
                           'class' => 'width118 select',
                           'empty' => '请选择品牌'
                       ));
                       ?>
                <input type='hidden' name="main-make" value="">
                <input type='hidden' name="main-car" value="">
                <input id="maincar" name="mainCar" value="" class="easyui-combogrid" style="width:180px;height:26px;" data-options="
                       panelWidth: 180,multiple: true,fitColumns: true,idField: 'name',textField: 'name',method: 'get',editable:false,
                       columns: [[
                       {field:'seriesId',checkbox:true},{field:'name',title:'车系',width:150,align:'center'},
                       ]],
                       ">	
                <a id='addMain' class='btn-small' href="javascript:;" rm='click_#rcby_class_bg-green'>添加</a>
            </div>
            <div id="showMain" style="margin-left:72px;">
                <?php if ($routine): ?>
                    <?php foreach ($routine as $rou): ?>
                        <div class='checkbox-add bg-green tag-close mainspan' style="margin-top:1px;">
                            <span name="mainmake"><?php echo $rou['Make']; ?></span>:
                            <span name="maincar"><?php echo $rou['Car']; ?></span>
                            <i class='close icon-close-green' onclick='delMain(this)' key="<?php echo $rou['ID'] ?>"></i>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>     
            </div>
            <div class="form-row" style="height:25px;<?php
                if ($model['OrganType'] == '1' || $model['OrganType'] == '2'): echo "display:none;";
                endif;
                ?>" id="diagnos">
                <label class='label'>&nbsp;&nbsp;检测诊断:</label>
                <span id="jczd" rm="click_#showDiagnos span_dom" class='checkbox-add tags qcx diagnos <?php if ($model['Diagnos'] == "全车系"): ?>bg-green<?php endif; ?>'>全车系</span>
                <span class='checkbox-add'>|</span>
                <input type='hidden' class='input' id="Diagnos" value="<?php
                 if ($model['Diagnos']): echo $model['Diagnos'];
                 endif;
                ?>" name='Diagnos'>
                       <?php
                       echo CHtml::dropDownList('diagmake', '', $brand, array(
                           'class' => 'width118 select',
                           'empty' => '请选择品牌'
                       ));
                       ?>
                <input type='hidden' name="diag-make" value="">
                <input type='hidden' name="diag-car" value="">
                <input id="diagcar" name="diagCar" value="" class="easyui-combogrid" style="width:180px;height:26px;" data-options="
                       panelWidth: 180,multiple: true,fitColumns: true,idField: 'name',textField: 'name',method: 'get',editable:false,
                       columns: [[
                       {field:'seriesId',checkbox:true},{field:'name',title:'车系',width:150,align:'center'},
                       ]],
                       ">	
                <a id='addDiagnos' class='btn-small' href="javascript:;" rm='click_#jczd_class_bg-green'>添加</a>
            </div>
            <div id="showDiagnos" style="margin-left:72px;">
                <?php if ($diagno): ?>
                    <?php foreach ($diagno as $dia): ?>
                        <div class='checkbox-add bg-green tag-close diagspan' style="margin-top:1px;">
                            <span name="diagmake"><?php echo $dia['Make']; ?></span>:
                            <span name="diagcar"><?php echo $dia['Car']; ?></span>
                            <i class='close icon-close-green' onclick='delDiag(this)' key="<?php echo $dia['ID'] ?>"></i>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="form-row" style="height:25px;<?php
                if ($model['OrganType'] == '2'): echo "display:none;";
                endif;
                ?>" id="wearparts">
                <label class='label'>易损件更换:</label>
                <input type='hidden' class='input' name="partscate" value="<?php
                 if ($Category): echo $Category;
                 endif;
                ?>">
                <input id="partsname" name="Category" value="<?php
                       if ($Category): echo $Category;
                       endif;
                ?>" 
                       class="easyui-combogrid" style="width:200px;height:26px;" data-options="
                       panelWidth: 200,multiple: true,fitColumns: true,
                       idField: 'Category',textField: 'Category',method: 'get',
                       url:'<?php echo Yii::app()->createUrl("servicer/servicemaininfo/getparts"); ?>',
                       columns: [[
                       {field:'ID',checkbox:true},{field:'Category',title:'易损件名称',width:150,align:'center'},
                       ]],
                       ">
                <span id="ysjgh" rm="click_#showParts span_dom" class='checkbox-add tags qcx parts <?php if ($Wearpart[0] == "全车系"): ?>bg-green<?php endif; ?>'>全车系</span>
                <span class='checkbox-add'>|</span>
                <input type='hidden' class='input' id="WearParts" value="<?php
                       if ($Wearpart[0]): echo $Wearpart[0];
                       endif;
                ?>" name='WearParts'>
                       <?php
                       echo CHtml::dropDownList('partsmake', '', $brand, array(
                           'class' => 'width118 select',
                           'empty' => '请选择品牌'
                       ));
                       ?>
                <input type='hidden' name="parts-make" value="">
                <input type='hidden' name="parts-car" value="">
                <input id="partscar" name="partsCar" value="" class="easyui-combogrid" style="width:150px;height:26px;" data-options="
                       panelWidth: 150,multiple: true,fitColumns: true,idField: 'name',textField: 'name',method: 'get',editable:false,
                       columns: [[
                       {field:'seriesId',checkbox:true},{field:'name',title:'车系',width:150,align:'center'},
                       ]],
                       ">
                <a id='addParts' class='btn-small' href="javascript:;" rm='click_#ysjgh_class_bg-green'>添加</a>
            </div>
            <div id="showParts" style="margin-left:72px;">
                <?php if ($part): ?>
                    <?php foreach ($part as $par): ?>
                        <div class='checkbox-add bg-green tag-close partspan' style="margin-top:1px;">
                            <span name="partmake"><?php echo $par['Make']; ?></span>:
                            <span name="partcar"><?php echo $par['Car']; ?></span>
                            <i class='close icon-close-green' onclick='delParts(this)' key="<?php echo $par['ID'] ?>"></i>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="form-row" style="height:25px;<?php
                if ($model['OrganType'] == '1' || $model['OrganType'] == '2'): echo "display:none;";
                endif;
                ?>" id="prorepair">
                <label class='label'>&nbsp;&nbsp;专业修理:</label>
                <input type='hidden' class='input' name="repairrange" value="<?php
                 if ($Range): echo $Range;
                 endif;
                ?>">
                <input id="reparange" name="Range" value="<?php
                       if ($Range): echo $Range;
                       endif;
                ?>" 
                       class="easyui-combogrid" style="width:200px;height:26px;" data-options="
                       panelWidth: 200,multiple: true,fitColumns: true,
                       idField: 'Range',textField: 'Range',method: 'get',
                       url:'<?php echo Yii::app()->createUrl("servicer/servicemaininfo/getrange"); ?>',
                       columns: [[
                       {field:'ID',checkbox:true},{field:'Range',title:'修理范围',width:150,align:'center'},
                       ]],
                       ">
                <span id="zyxl" rm="click_#showRepair span_dom" class='checkbox-add tags qcx repair <?php if ($Prorepair[0] == "全车系"): ?>bg-green<?php endif; ?>'>全车系</span>
                <span class='checkbox-add'>|</span>
                <input type='hidden' class='input' id="ProRepair" value="<?php
                       if ($Prorepair[0]): echo $Prorepair[0];
                       endif;
                ?>" name='ProRepair'>				
                       <?php
                       echo CHtml::dropDownList('repairmake', '', $brand, array(
                           'class' => 'width118 select',
                           'empty' => '请选择品牌'
                       ));
                       ?>
                <input type='hidden' name="repair-make" value="">
                <input type='hidden' name="repair-car" value="">
                <input id="repaircar" name="repairCar" value="" class="easyui-combogrid" style="width:150px;height:26px;" data-options="
                       panelWidth: 150,multiple: true,fitColumns: true,idField: 'name',textField: 'name',method: 'get',editable:false,
                       columns: [[
                       {field:'seriesId',checkbox:true},{field:'name',title:'车系',width:150,align:'center'},
                       ]],
                       ">	
                <a id='addRepair' class='btn-small' href="javascript:;" rm='click_#zyxl_class_bg-green'>添加</a>
            </div>
            <div id="showRepair" style="margin-left:72px;">
                <?php if ($repair): ?>
                    <?php foreach ($repair as $rep): ?>
                        <div class='checkbox-add bg-green tag-close repairspan' style="margin-top:1px;">
                            <span name="repairmake"><?php echo $rep['Make']; ?></span>:
                            <span name="repaircar"><?php echo $rep['Car']; ?></span>
                            <i class='close icon-close-green' onclick='delRepair(this)' key="<?php echo $rep['ID'] ?>"></i>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="form-row" style="height:25px;<?php
                if ($model['OrganType'] == '1' || $model['OrganType'] == '2'): echo "display:none;";
                endif;
                ?>" id="autoservice">
                <label class='label'>&nbsp;&nbsp;车险服务:</label>
                <input type='hidden' class='input' name="carinsur" value="<?php
                 if ($Autoservice[0]): echo $Autoservice[0];
                 endif;
                ?>">
                <select name="InsurType" class="width128 select">
                    <option value="">请选择险企类型</option>
                    <option value="代销险企" <?php if ($Autoservice[0] == "代销险企"): ?>selected="selected"<?php endif; ?>>代销险企</option>
                    <option value="代理理赔险企" <?php if ($Autoservice[0] == "代理理赔险企"): ?>selected="selected"<?php endif; ?>>代理理赔险企</option>
                </select>
                <input type='hidden' class='input' name="insurname" value="<?php
                       if ($Name): echo $Name;
                       endif;
                ?>">
                <input id="insurance" name="Name" value="<?php
                       if ($Name): echo $Name;
                       endif;
                ?>" 
                       class="easyui-combogrid" style="width:200px;height:26px;" data-options="
                       panelWidth: 250,multiple: true,fitColumns: true,
                       idField: 'Name',textField: 'Name',method: 'get',
                       url:'<?php echo Yii::app()->createUrl("servicer/servicemaininfo/getinsur"); ?>',
                       columns: [[
                       {field:'ID',checkbox:true},{field:'Name',title:'险企名称',width:150,align:'center'},
                       ]],
                       ">
            </div>
            <div class="form-row" style="margin-top:20px;">
                <input class='submit' id="save" type='button' value='保存资料' style="margin-left:72px;"/>
                <a class='btn' href="<?php echo Yii::app()->createUrl('servicer/servicemaininfo/maininfo'); ?>">返回</a>
            </div>
        </div>
    </form>
</div>
<script> 
    $(document).ready(function(){
        $("#save").click(function(){
            var newtype=$("input[name='NewType']").val();
            var oldtype=$("input[name='DataType']").val();
            //combogrid取值
            var parts = $('#partsname').combogrid('getValues');
            $("input[name='partscate']").val(parts);
            var range = $('#reparange').combogrid('getValues');
            $("input[name='repairrange']").val(range);
            var insur = $('#insurance').combogrid('getValues');
            $("input[name='insurname']").val(insur);
            //验证日常保养
            var mainmake = $("#mainmake option[value='"+$("#mainmake").val()+"']").text();
            var maincar = $("#maincar").combogrid('getValues');
            $("input[name='main-make']").val(mainmake);
            $("input[name='main-car']").val(maincar);
            var main = "";
            var inmain = $('input[len=main]:last').val();	//获取最后一次添加的品牌车系
            var opmain = mainmake+';'+maincar;				//拼接下拉框中品牌车系数据
            $("#showMain div.mainspan").each(function(){
                var makecp=$(this).find('span[name=mainmake]').html();
                var carcp=$(this).find('span[name=maincar]').html();
                if (mainmake==makecp){	//相同品牌下对车系进行比较
                    var cararr = carcp.split(',');
                    for(var i=0;i<=cararr.length;i++)
                    {
                        if($.inArray(maincar[i],cararr)>=0){
                            main='该车系已存在，请勿重复添加!';
                        }
                    }
                }
            });
            if(opmain == inmain){
                main = "";
            }
            //验证检测诊断
            var diagmake = $("#diagmake option[value='"+$("#diagmake").val()+"']").text();
            var diagcar = $("#diagcar").combogrid('getValues');
            $("input[name='diag-make']").val(diagmake);
            $("input[name='diag-car']").val(diagcar);
            var diag = "";
            var indiag = $('input[len=diag]:last').val();
            var opdiag = diagmake+';'+diagcar;
            $("#showDiagnos div.diagspan").each(function(){
                var makecp=$(this).find('span[name=diagmake]').html();
                var carcp=$(this).find('span[name=diagcar]').html();
                if (diagmake==makecp){	//相同品牌下对车系进行比较
                    var cararr = carcp.split(',');
                    for(var i=0;i<=cararr.length;i++)
                    {
                        if($.inArray(diagcar[i],cararr)>=0){
                            diag='该车系已存在，请勿重复添加!';
                        }
                    }
                }
            });
            if(opdiag == indiag){
                diag = "";
            }
            //验证易损件更换
            var partmake = $("#partsmake option[value='"+$("#partsmake").val()+"']").text();
            var partcar = $("#partscar").combogrid('getValues');
            $("input[name='parts-make']").val(partmake);
            $("input[name='parts-car']").val(partcar);
            var parts = "";
            var inpart = $('input[len=part]:last').val();
            var oppart = partmake+';'+partcar;
            $("#showParts div.partspan").each(function(){
                var makecp=$(this).find('span[name=partmake]').html();
                var carcp=$(this).find('span[name=partcar]').html();
                if (partmake==makecp){	//相同品牌下对车系进行比较
                    var cararr = carcp.split(',');
                    for(var i=0;i<=cararr.length;i++)
                    {
                        if($.inArray(partcar[i],cararr)>=0){
                            parts='该车系已存在，请勿重复添加!';
                        }
                    }
                }
            });
            if(oppart == inpart){
                parts = "";
            }
            //验证专业修理
            var repairmake = $("#repairmake option[value='"+$("#repairmake").val()+"']").text();
            var repaircar = $("#repaircar").combogrid('getValues');
            $("input[name='repair-make']").val(repairmake);
            $("input[name='repair-car']").val(repaircar);
            var repair = ""
            var inrepair = $('input[len=repair]:last').val();
            var oprepair = repairmake+';'+repaircar;
            $("#showRepair div.repairspan").each(function(){
                var makecp=$(this).find('span[name=repairmake]').html();
                var carcp=$(this).find('span[name=repaircar]').html();
                if (repairmake==makecp){	//相同品牌下对车系进行比较
                    var cararr = carcp.split(',');
                    for(var i=0;i<=cararr.length;i++)
                    {
                        if($.inArray(repaircar[i],cararr)>=0){
                            repair='该车系已存在，请勿重复添加!';
                        }
                    }
                }
            });
            if(oprepair == inrepair){
                repair = "";
            }            
            if(newtype!='' || oldtype != ''){
                if (main == "" && diag == "" && parts == "" && repair == "") {
                    $.messager.confirm("提示", "您确定要保存吗?", function(r){
                        if(r){
                            $("#business_fm").submit();
                            $("#save").attr('disabled','true');     //点击后按钮成为不可操作状态
                        }
                    })
                }
                else {
                    $.messager.alert("提示", "品牌车系已存在,请勿重复添加!","error");
                    return false;
                }
            }
            else{
                $.messager.alert("提示", "请选择机构类型!","error");
                return false;
            }
        })
    })
</script>