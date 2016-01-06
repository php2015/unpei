<div id="add_dlg" class="easyui-dialog easyui-layout" style="width:600px;height:320px;padding:10px 20px"
     closed="true" buttons="#dlg-adds" modal="true">
    <form id="add_fm" method="post" novalidate>		
        <table>
            <tr class="fitem" style="height:30px;">
                <td align="right">车牌号:</td>
                <td><input name="LicensePlate" class="easyui-validatebox width98 input" required="true"></td>
                <td align="right">行驶证号:</td>
                <td><input name="VehicleLicense" class="easyui-validatebox width98 input" validType="length[0,30]"></td>
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
                <td colspan=3><input name="Mileage" class="easyui-numberbox width98 input" required="true" id="addMileage">&nbsp;km
                <span id="addmileageNote"></span></td>
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
                                <select name="make" class="easyui-validatebox select" required="true" style="width:120px" id="front-vehicle-make-list" >
                                    <option value="0">--请选择厂家类别</option>
                                </select>
                            </li>
                            <li>
                                <select name="series" class="width120 select" id="front-vehicle-series-list" >
                                    <option value="0">--请选择车系名称</option>
                                </select>
                            </li>
                            <li id="year-content" >
                                <select name="year" class="width120 select" id="front-vehicle-year-list" > 
                                    <option value="0">--请选择车型年款</option> 
                                </select> 
                            </li>
                            <li id="model-content" >
                                <select name="model" class="width120 select" id="front-vehicle-model-list" > 
                                    <option value="0">--请选择车型名称</option> 
                                </select> 
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="right">其它品牌:</td>
                <td colspan=3><input name='OtherCar' class='easyui-validatebox input' style="width:350px;"></td>
            </tr>
            <tr>
                <td align="right">选择车主:</td>
                <td colspan=3>
                    <input id="allowners" class="easyui-combogrid" style="width:280px" data-options="
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
    <div id="dlg-adds">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="save-btn" onclick="saveAdd()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#add_dlg').dialog('close')">取消</a>
    </div>
</div>
<div id="add_owner_dlg" class="easyui-dialog easyui-layout" style="width:600px;height:270px;"
     closed="true" buttons="#dlg-owners" modal="true">
    <form id="add_owner_fm" method="post" novalidate>		
        <!--<div data-options="region:'center',border:false" style="padding:10px;">-->	
            <table class="dttable" data-options="region:'center',border:false" style="padding:10px;">
                <tr class="fitem" style="height:30px;">
                    <td align="right" width=55>车主姓名:</td>
                    <td width=185><input name="Name" class="easyui-validatebox width98 input" required="true"></td>
                    <td align="right" width=70>昵称:</td>
                    <td width=185><input name="NickName" class="input" style="width:130px;"></td>
                </tr>
                <tr class="fitem" style="height:30px;">
                    <td align="right">性别:</td>
                    <td><select name="Sex" class="easyui-validatebox select" required="true" style="width:140px;">
                            <option value="">请选择</option>
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select></td>
                    <td align="right">驾驶环境:</td>
                    <td><select name="DrivingEnvironment" class="width140 select">
                            <option value="">请选择</option>
                            <option value="1">市区</option>
                            <option value="2">高速</option>
                            <option value="3">郊区</option>
                        </select></td>
                </tr>
                <tr class="fitem" style="height:30px;">
                    <td align="right">邮箱:</td>
                    <td><input name="Email" class="easyui-validatebox width98 input" validType="email" validType="length[0,128]"></td>
                    <td align="right">QQ:</td>
                    <td><input name="QQ" class="easyui-numberbox width98 input" validType="QQ"></td>
                </tr>
                <tr class="fitem" style="height:30px;">
                    <td align="right">电话:</td>
                    <td><input name="Phone" class="easyui-numberbox width98 input" required="true" validType="mobile"></td>
                    <td align="right">驾驶证号:</td>
                    <td><input name="DrivingLicense" class="easyui-numberbox width98 input" validType="length[0,30]"></td>
                </tr>
                <tr class="fitem" style="height:30px;">
                    <td align="right">所在城市:</td>
                    <td colspan=3>
                        <?php
                        $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1)); //条件:grade = 1
                        $state = CHtml::listData($state_data, "id", "name"); //取出id、name
                        echo CHtml::dropDownList('province', 'province', $state, array(
                            'empty' => '请选择省份',
                            'class' => 'width140 select',
                            'ajax' => array(
                                'type' => 'GET',
                                'url' => Yii::app()->request->baseUrl . '/common/dynamiccities',
                                'update' => '#city',
                                'data' => 'js:"province="+jQuery(this).val()',
                            )
                                )
                        );
                        if (!$model->isNewRecord) {
                            $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => province));
                            $city = CHtml::listData($city_data, "id", "name");
                        }
                        echo '&nbsp;' . CHtml::dropDownList('city', 'city', $city, array(
                            'empty' => '请选择城市',
                            'class' => 'width140 select'
                                )
                        );
                        ?>
                    </td>
                </tr>
            </table>
        <!--</div>-->								
    </form>
    <div id="dlg-owners">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="owner-btn" onclick="saveOwner()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#add_owner_dlg').dialog('close')">取消</a>
    </div>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl();?>/js/jpdata/vehiclecommon.js'></script>
<script>
    $(document).ready(function(){
        $("input[name=OtherCar]").change(function(){
            var car = $(this).val();
            if (car) {
                $("select[name='make']").attr("disabled",true);
                $("select[name='series']").attr("disabled",true);
                $("select[name='year']").attr("disabled",true);
                $("select[name='model']").attr("disabled",true);
            }
            else {
                $("select").attr("disabled",false);
            }
        });
    });
    function newCar(){
        $('#add_dlg').dialog('open').dialog('setTitle','添加车辆信息');
        $('#add_fm').form('reset');
        $("#save-btn").linkbutton('enable');   //保存按钮有效
        $("select").attr("disabled",false);
        var url = Yii_baseUrl + "/servicer/servicevehicle/allowner";
        $('#allowners').combogrid('grid').datagrid({ url:url,method:"post"});
    }
    function saveAdd(){
        var val = $('#allowners').combogrid('getValues'); 
        var mileage=$('#addMileage').val();
        if(mileage>999999999){
             $('#addmileageNote').html('<font color="red">&nbsp;行驶里程数不能超过9位数!</font>');
             return false;
        }
        var owner = $('input[name=OwnerID]').val();
        if (owner){
            var url = Yii_baseUrl + "/servicer/servicevehicle/add/OwnerID/"+owner;
        }
        else {
            var url = Yii_baseUrl + "/servicer/servicevehicle/add/OwnerID/"+val;
        }
        //验证车品牌不能为空
        var brand = $("select[name=make]").val();
        var others = $("input[name=OtherCar]").val();
        if((brand == null || brand == 0) && others==''){
            $("input[name=OtherCar]").addClass("validatebox-text validatebox-invalid");
            $("input[name=OtherCar]").attr('title','汽车品牌不能为空');
            return false;
        }
        $('#add_fm').form('submit',{
            url: url,
            onSubmit: function(){
               if($(this).form('validate')==true){
                    $("#save-btn").linkbutton('disable');   //验证不通过保存按钮失效
                    return $(this).form('validate');
                }
                else{
                    $("#save-btn").linkbutton('eable');   //验证不通过保存按钮失效
                    return $(this).form('validate');
                }
            },
            success: function(result){
                var result = eval('('+result+')');
                $("#save-btn").linkbutton('enable');   //返回后有效
                if (result.errorMsg){
                    $.messager.show({
                        title: '错误',
                        msg: result.errorMsg
                    });
                } else {
                    $('#add_dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload'); // reload the user data
                }
            }
        });
    }
    function newOwner()
    {
        $('#add_owner_dlg').dialog('open').dialog('setTitle','添加车主信息');
        $('#add_owner_fm').form('reset');
        $("#owner-btn").linkbutton('enable');   //保存按钮有效
    }
    function saveOwner(){
        //验证性别不能为空
        var sex = $("select[name=Sex]").val();
        if(sex ==null){
            $("select[name=Sex]").addClass("validatebox-text validatebox-invalid");
            $("select[name=Sex]").attr('title','该输入项为必输项');
            return false;
        }
        var url = Yii_baseUrl + "/servicer/servicevehicle/addowner";
        $('#add_owner_fm').form('submit',{
            url: url,
            onSubmit: function(){
                if($(this).form('validate')==true){
                    $("#owner-btn").linkbutton('disable');   //验证通过保存按钮失效
                    return $(this).form('validate');
                }
                else{
                    $("#owner-btn").linkbutton('eable');   //验证不通过保存按钮失效
                    return $(this).form('validate');
                }
            },
            success: function(result){
                var result = eval('('+result+')');
                $("#owner-btn").linkbutton('enable');   //返回后有效
                if (result.errorMsg){
                    $.messager.show({
                        title: '错误',
                        msg: result.errorMsg
                    });
                } else {
                    $('#add_owner_dlg').dialog('close'); // close the dialog
                    $('#allowners').combogrid('setValue', result.Name);
                    $('#allowner').combogrid('setValue', result.Name);
                    $('input[name=OwnerID]').val(result.ID);
                    $('#allowners').combogrid('grid').datagrid('reload'); // reload the user data
                    $('#allowner').combogrid('grid').datagrid('reload'); // reload the user data
                }
            }
        });
    }
    $(document).delegate('#addMileage','keyup',function(){
        var mileage=$('#addMileage').val();
        if(mileage>999999999){
             $('#addmileageNote').html('<font color="red">&nbsp;行驶里程数不能超过9位数!</font>');
             return false;
        }
        else{
             $('#addmileageNote').html('');
        }
    })
</script>