<div id="dialog" title="机构信息"  class="easyui-dialog" style="width: 500px;height:420px" modal="true" closed="true" buttons="#butt">
    <div style="margin-left: 30px">
        <p class="title title-dashed">
            机构信息
        </p>
        <form id="editpromit" method="post">
            <input type="hidden" name="hide[ID]" id="hiddenID">
            <input type="hidden" name="hide[DealerID]" id="hiddendealerID">
            <input type="hidden" name="hide[PromitArea]" id="hiddenPromitArea">
            <input type="hidden" name="hide[Level]" id="hiddenlevel">
            <input type="hidden" name="hide[BrandName]" id="hiddenBrandName">
            <input type="hidden" name="hide[CustomerType]" id="hiddenCustomerType">
            <input type="hidden" name="hide[Settlement]" id="hiddenSettlement">
        </form>
        <p class="form-row">
            <label>机构名称：</label>
            <input name="organName" class="width108 input "  readonly="readonly" />
            <span><input id="choose" class="btn-small" type="button" value="选择" > </span>
            <span id="errororganName"></span>
        </p>
        <p class="form-row">
            <label>授权品牌：</label>
            <?php
            $barnds = MakeGoodsBrand::model()->findAll('OrganID=:OrganID', array(':OrganID' => Commonmodel::getOrganID()));
            $operate_regions = CHtml::listData($barnds, "BrandID", "BrandName");
            ?>
            <?php echo CHtml::dropDownList('BrandName', '', $operate_regions, array('class' => 'width120 select', 'empty' => '请选择授权品牌')); ?>
            <span><input id="Appendbrand" class="btn-small" type="button" value="添加" > </span>
            <span id="errorBrandName"></span>
        </p>
        <p class="form-row" id="appendrow">
        </p>
        <p class="form-row">
            <label>授权地域：</label>
            <?php
            $operate_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
            $operate_region = CHtml::listData($operate_data, "id", "name");
            ?>
            <?php echo CHtml::dropDownList('PromitArea', '', $operate_region, array('class' => 'width120 select', 'empty' => '请选择授权地域')); ?>
            <span id="errorPromitArea"></span>
        </p>
        <p class="form-row">
            <label>联系电话：</label>
            <input name="Phone"  readonly="readonly" class="width108 input"/>
        </p>
        <p class="form-row">
            <label>授权级别：</label>
            <select name="level" class="select">
                <option value="">请选择授权级别</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
            <span id="errorlevel"></span>
        </p>
        <p class="form-row">
            <label>客户类别：</label>
            <select name="CustomerType" class="select">
                <option value="">请选择客户类别</option>
            </select>
            <?php
//            $type_data = MakeType::model()->findAll(array("condition" => "OrganID = ".Commonmodel::getOrganID()." AND IsDefault = 0"));
//            $type_info = CHtml::listData($type_data, "ID", "TypeName");
            ?>
            <?php // echo CHtml::dropDownList('CustomerType','',$type_info, array('class' => 'width120 select', 'empty' => '请选择客户类别')); ?>
            <span id="errortype"></span>
        </p>
        <p class="form-row">
            <label>结算方式：</label>
            <select name="Settlement" class="select">
                <option value="">请选择结算方式</option>
                <option value="1">支付宝担保</option>
                <option value="2">物流代收款</option>
                <option value="3">月结</option>
                <option value="4">预付款</option>
                <option value="5">打款再提货</option>
            </select>
            <span id="errorsettle"></span>
        </p>
    </div>
</div>
<div id="dialog2"  class="easyui-dialog" title="选择经销商" style="width: 600px;" modal="true" closed="true">
    <p class="form-row" style="margin-left: 20px">
        <label>拼音检索：</label><input id="Pinyin" class="input"/>
    </p>
    <table id="Dealerbrandlist" style="width:580px;height: 400px"></table>
</div>
<div id="butt">
    <a href="javascript:void(0)" class="btn-green" iconCls="icon-ok"  onclick="savequotation()">确认</a>
    <a href="javascript:void(0)" class="btn" iconCls="icon-cancel" onclick="$('#dialog').dialog('close');">关闭</a>
</div>
<script type="text/javascript">
    $("select[name=level]").change(function(){
        if($("select[name=level]").val()){
            $("#errorlevel").html('') 
        }
    })
    $("select[name=PromitArea]").change(function(){
        if($("select[name=PromitArea]").val()){
            $("#errorPromitArea").html('') 
        }
    })
    $("select[name=CustomerType]").change(function(){
        if($("select[name=CustomerType]").val()){
            $("#errortype").html('') 
        }
    })
    $("select[name=Settlement]").change(function(){
        if($("select[name=Settlement]").val()){
            $("#errorsettle").html('') 
        }
    })
    $("#Appendbrand").click(function(){
        var str='';
        var val= $("#BrandName").val();
        var app=$('#'+val).html();
        if(app){
            alert('该品牌已选择')   
            return false
        }
        if(val){
            str= $("#BrandName").find('option[value='+val+']').html();
            str2 = '<span id='+val+'><font color="green">'+str+'</font><a href="javascript:void(0)" onclick="Remove('+val+')">&nbsp;<font color="green">×</font></a>&nbsp;&nbsp;</span>';
            $("#appendrow").append(str2);  
            var hiddenBrandName=$("#hiddenBrandName").val();
            if(hiddenBrandName){
                $("#hiddenBrandName").val(hiddenBrandName+val+',');  
            }else{
                $("#hiddenBrandName").val(','+val+',')   
        
            }
            //       console.log($("#hiddenBrandName").val())
        }else{
            alert('请选择品牌')   
        }
        var mg=$("#appendrow").find('span').html();
        if(mg){$("#errorBrandName").html('')}
    })
    function Remove(data){
        var value=$("#hiddenBrandName").val();
        var deldata=data+',';
        value=value.replace(deldata,'')
        $("#hiddenBrandName").val(value)
        $('#'+data).remove();
    }
    $("#Pinyin").keyup(function(){
        var Pinyin= $("#Pinyin").val();
        $("#Dealerbrandlist").datagrid({
            url:'<?php echo Yii::app()->baseUrl; ?>/maker/promitdealer/getdealers?Pinyin='+Pinyin  
        })
    })
    function savequotation(){
         if(!$("input[name=organName]").val()){
                        $("#errororganName").html('<font color="red">请选择机构</font>');
                        return false
                    }else{
                        $("#errororganName").html('')
                    }
                    var span=$("#appendrow").find('span').html();
                    if(!span){
                        $("#errorBrandName").html('<font color="red">请添加授权品牌</font>');
                        return false
                    }else{
                        $("#errorBrandName").html('') 
                    }
                    if(!$("#PromitArea").val()){
                        $("#errorPromitArea").html('<font color="red">请选择授权地域</font>');
                        return false
                    }else{
                        $("#errorPromitArea").html('')
                    }
                    if(!$("select[name=level]").val()){
                        $("#errorlevel").html('<font color="red">请添加授权级别</font>');
                        return false
                    }else{
                        $("#errorlevel").html('');
                    }
                    if(!$("select[name=CustomerType]").val()){
                        $("#errortype").html('<font color="red">请选择客户类别</font>');
                        return false
                    }else{
                        $("#errorlevel").html('');
                    }
                    if(!$("select[name=Settlement]").val()){
                        $("#errorsettle").html('<font color="red">请选择结算方式</font>');
                        return false
                    }else{
                        $("#errorlevel").html('');
                    }
                    $("#hiddenlevel").val($("select[name=level]").val())
                    $("#hiddenPromitArea").val(','+$("#PromitArea").val()+',')
                    $("#hiddenCustomerType").val($("select[name=CustomerType]").val())
                    $("#hiddenSettlement").val($("select[name=Settlement]").val())
                    $("#editpromit").form({
                        url:'<?php echo Yii::app()->baseUrl; ?>/maker/promitdealer/editpromit',
                        success:function(reg){
                            reg=eval("("+reg+")")
                            if(reg.success==true){
                                $('#dialog').dialog('close')
                                $.messager.show({
                                    title:'提示',
                                    msg:reg.messager
                                })
                                $("#dg").datagrid('reload') 
                            }else{
                                $.messager.show({
                                    title:'提示',
                                    msg:reg.messager
                                })
                            }
                        }
                    })
                    $("#editpromit").submit();
    }
    
    $("#choose").click(function(){
        $('#dialog2').dialog('open');
        $("#Dealerbrandlist").datagrid({
            url:'<?php echo Yii::app()->baseUrl; ?>/maker/promitdealer/getdealers'  
        })
    })
    
    $("#Dealerbrandlist").datagrid({
        pagination:true,
        method:'get',
        singleSelect:true,
        columns:[[
                {field:'organName',title:'机构名称',width:300},   
                {field:'Phone',title:'机构电话',width:100},   
                {field:'userID',title:'操作',formatter:Select,width:100} 
                //             {field:'organName',title:'机构名称'},   
                //             {field:'organName',title:'机构名称'},   
            ]]
    })
    function Select(value,row){
        return '<input type="button" onclick="Onselect('+row.userID+')" value="选择" class="btn-small"/>'
    }
    function Onselect(id){
        $("#errororganName").html('') 
        var Url='<?php echo Yii::app()->baseUrl; ?>/maker/promitdealer/dealerinfo?userID='+id
        $.ajax({
            url:Url,
            dataType:'json',
            success:function(reg){
                $("input[name=organName]").val(reg.organName);
                $("input[name=Phone]").val(reg.Phone);
                $("#hiddendealerID").val(reg.userID);
            }
        })
        $('#dialog2').dialog('close');
    }
</script>