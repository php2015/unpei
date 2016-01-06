<div id="edit_dlg" class="easyui-dialog easyui-layout" style="width:600px;height:320px;padding:10px 20px"
     closed="true" buttons="#dlg-editadds" modal="true">
    <form id="edit_fm" method="post" novalidate>		
        <table>
            <tr class="fitem" style="height:30px;">
                <td align="right">车牌号:</td>
                <td><input name="LicensePlate" class="easyui-validatebox width98 input" required="true"></td>
                <td align="right">行驶证号:</td>
                <td><input name="VehicleLicense" class="width98 input"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">使用性质:</td>
                <td><select name="UseNature" class="width140 select">
                        <option value="">请选择</option>
                        <option value="1">私家车</option>
                        <option value="2">公务车</option>
                        <option value="3">运营车辆</option>
                    </select></td>
                <td align="right">购置时间:</td>
                <td><input name="BuyTime" class="easyui-datebox width98 input" required="true"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">行驶里程:</td>
                <td colspan=3><input name="Mileage" class="easyui-numberbox width98 input" required="true" id="Mileage">&nbsp;km
                <span id="mileageNote"></span></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">车架号:</td>
                <td colspan=3><input name="VinCode" class="easyui-validatebox width98 input" validType="length[0,10]">&nbsp;/VIN码（前10位）</td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td align="right">汽车品牌:</td>
                <td colspan=3>
                    <div class="auto_heights">
                        <ul class="search-content">
                            <li>
                                <select name="makename" class="easyui-validatebox select" required="true" style="width:120px" id="front-vehicle-make-lists" >
                                    <option value="0">--请选择厂家类别</option>
                                </select>
                            </li>
                            <li>
                                <select name="seriesname" class="width120 select" id="front-vehicle-series-lists" >
                                    <option value="0">--请选择车系名称</option>
                                </select>
                            </li>
                            <li id="year-content" >
                                <select name="yearname" class="width120 select" id="front-vehicle-year-lists" > 
                                    <option value="0">--请选择车型年款</option> 
                                </select> 
                            </li>
                            <li id="model-content" >
                                <select name="modelname" class="width120 select" id="front-vehicle-model-lists" > 
                                    <option value="0">--请选择车型名称</option> 
                                </select> 
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">其它品牌:</td>
                <td colspan=3><input name='Vehicles' class='easyui-validatebox input' style="width:350px;"></td>
            </tr>
            <tr>
                <td align="right">选择车主:</td>
                <td colspan=3>
                    <input id="allowner" name="Name" class="easyui-combogrid" style="width:280px" data-options="
                           panelWidth: 550,
                           idField: 'ID',
                           textField: 'Name',
                           method: 'get',
                           columns: [[
                           {field:'Name',title:'车主姓名',width:80,align:'center'},
                           {field:'NickName',title:'昵称',width:80,align:'center'},
                           {field:'Environment',title:'驾驶环境',width:80,align:'center'},
                           {field:'DrivingLicense',title:'驾驶证号',width:100,align:'center'},
                           {field:'Mailbox',title:'邮箱',width:80,align:'center'},
                           {field:'Town',title:'所在城市',width:120,align:'center'}
                           ]],
                           fitColumns: true
                           ">
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newOwner()">新增车主</a>
                    <input type="hidden" name='OwnerID' class='easyui-validatebox width198 input'>
                </td>
            </tr>
        </table>	    
    </form>
    <div id="dlg-editadds">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveAll()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#edit_dlg').dialog('close')">取消</a>
    </div>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl();?>/js/jpdata/vehicleedit.js'></script>
<script>
    $(document).ready(function(){
        $("input[name=Vehicles]").change(function(){
            var car = $(this).val();
            if (car) {
                $("select[name='makename']").attr("disabled",true);
                $("select[name='seriesname']").attr("disabled",true);
                $("select[name='yearname']").attr("disabled",true);
                $("select[name='modelname']").attr("disabled",true);
            }
            else {
                $("select").attr("disabled",false);
            }
        });
    });
    function editCar(){
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#edit_dlg').dialog('open').dialog('setTitle','编辑车辆信息'); 
            $('#edit_fm').form('load',row);
            $('input[name=OwnerID]').val('');
            var cas=row.Car.split(",");
            if(cas.length!=1){
                $("input[name=Vehicles]").val("");
                $("select").attr("disabled",false);
                $("select[name=makename]").attr("carkey",cas[1]);
                $("select[name=seriesname]").attr("carkey",cas[2]);
                $("select[name=yearname]").attr("carkey",cas[3]);
                $("select[name=makename]").find("option").each(function(){
                    if($(this).text()==cas[0]){
                        $("select[name=makename]").val($(this).val()).change();
                        return false;
                    }
                });
            }else{
                $("input[name=Vehicles]").val(row.Car);
                $("select[name='makename']").attr("disabled",true);
                $("select[name='seriesname']").attr("disabled",true);
                $("select[name='yearname']").attr("disabled",true);
                $("select[name='modelname']").attr("disabled",true);
            }
            //获取车主信息
            var url = Yii_baseUrl + "/servicer/servicevehicle/allowner";
            $('#allowner').combogrid('grid').datagrid({ url:url,method:"post"});
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要修改的车辆信息!'
            });
        }	
    }
    function saveAll(){
        var row = $('#dg').datagrid('getSelected');
        var owner = $('input[name=OwnerID]').val();
        var mileage=$('#Mileage').val();
        if(mileage>999999999){
             $('#mileageNote').html('<font color="red">&nbsp;行驶里程数不能超过9位数!</font>');
             return false;
        }
        var val = $('#allowner').combogrid('getValues');
        if (isNaN(val)) {
            if (owner=='') {
                var url = Yii_baseUrl + "/servicer/servicevehicle/update?OwnerID="+row.OID.toString()+"&ID="+row.ID.toString();
            }
            else {
                var url = Yii_baseUrl + "/servicer/servicevehicle/update?OwnerID="+owner+"&ID="+row.ID.toString();
            }
        }
        else if (owner==''){
            var url = Yii_baseUrl + "/servicer/servicevehicle/update?OwnerID="+val+"&ID="+row.ID.toString();
        }
        else {
            var url = Yii_baseUrl + "/servicer/servicevehicle/update?OwnerID="+owner+"&ID="+row.ID.toString();
        }
        //验证车品牌不能为空
        var makename = $("select[name=makename]").val();
        var vehicles = $("input[name=Vehicles]").val();
        if((makename =='' || makename ==0 && vehicles == '')){
            $("input[name=Vehicles]").addClass("validatebox-text validatebox-invalid");
            $("input[name=Vehicles]").attr('title','该输入项为必输项');
            return false;
        }
        $('#edit_fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                console.log(result);
                if (result.errorMsg){
                    $.messager.show({
                        title: '错误',
                        msg: result.errorMsg
                    });
                } else {
                    $('#edit_dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload'); // reload the user data
                }
            }
        });
    }
    $(document).delegate('#Mileage','keyup',function(){
        var mileage=$('#Mileage').val();
        if(mileage>999999999){
             $('#mileageNote').html('<font color="red">&nbsp;行驶里程数不能超过9位数!</font>');
             return false;
        }
        else{
             $('#mileageNote').html('');
        }
    })
</script>