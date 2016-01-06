/**
 * 
 */
function departsub(){
    var parentID= $("input[name=parentID]").val();
    var departid= $("#departid").val();
    var departName= $("input[name=departmentName]").val();
    $.getJSON(Yii_baseUrl+'/member/employee/checkdepart',{
        parentID:parentID,
        departid:departid,
        departName:departName
    },function(result){
        if(result){
            $('#departmentform').submit();
        }else{
            $.messager.alert('提示', '部门名称已被同级部门使用', 'info');
            $("#saves").linkbutton("enable");
        }
    });
}
function formatDateText(date) { 
    return date.formatDate("yyyy-MM-dd");  
}
Date.prototype.formatDate = function (format) //author: meizz  
{  
    var o = {  
        "M+": this.getMonth() + 1, //month  
        "d+": this.getDate(),    //day  
        "h+": this.getHours(),   //hour  
        "m+": this.getMinutes(), //minute  
        "s+": this.getSeconds(), //second  
        "q+": Math.floor((this.getMonth() + 3) / 3),  //quarter  
        "S": this.getMilliseconds() //millisecond  
    }  
    if (/(y+)/.test(format)) format = format.replace(RegExp.$1,  
        (this.getFullYear() + "").substr(4 - RegExp.$1.length));  
    for (var k in o) if (new RegExp("(" + k + ")").test(format))  
        format = format.replace(RegExp.$1,  
            RegExp.$1.length == 1 ? o[k] :  
            ("00" + o[k]).substr(("" + o[k]).length));  
    return format;  
}
$(document).ready(function(){
    $('.easyui-tree').tree({
        url:Yii_baseUrl + '/member/employee/getmenu'
    });
    $('#Validity').click(function(){
        if($(this).attr("checked")){
            $('#vali').val('Y');
        }else{
            $('#vali').val('N');
        }
    })
    $('#departmentform').form({    
        onSubmit:function(){
            if($('#departmentform').form('validate')){
                return true;
            }else{
                $("#saves").linkbutton("enable");
                return false;
            }
        },
        success:function(data){
            $("#saves").linkbutton("enable");
            $.messager.alert('提示', eval('('+data+')'), 'info'); 
            if($("#departid").val()){
                $('.easyui-tree').tree({
                    url:Yii_baseUrl + '/member/employee/getmenu',
                    onLoadSuccess:function(){
                        var depart=$('.easyui-tree').tree('find',$("#departid").val());
                        $('.easyui-tree').tree('select',depart.target);
                    }
                });
            }else{
                $('.easyui-tree').tree('reload');
            }
            $('#parentID').combotree('reload');
            $('#parID').combotree('reload');
        }    
    }); 
    $('#employeeform').form({    
        onSubmit:function(){
            if($('#employeeform').form('validate')){
                return true;
            }else{
                $("#saves").linkbutton("enable");
                return false;
            }
        },
        success:function(data){  
            $("#saves").linkbutton("enable");  
            $.messager.alert('提示', eval('('+data+')'), 'info');
            if($("#employeeid").val()){
                $('.easyui-tree').tree({
                    url:Yii_baseUrl + '/member/employee/getmenu',
                    onLoadSuccess:function(){
                        var employ=$('.easyui-tree').tree('find',$("#employeeid").val());
                        $('.easyui-tree').tree('select',employ.target);
                    }
                });
            }else{
                $('.easyui-tree').tree('reload');
            }
        }    
    }); 
    $('#ExpirationDate').datebox({    
        formatter:formatDateText
    }); 
    $('#parID').combotree({    
        width:'140',
        treeWidth:'140'
    });  
    $('#parentID').combotree({    
        width:'140',
        treeWidth:'140',
        onLoadSuccess:function(){
            var t=$('#parentID').combotree('tree');
            var root=t.tree("getRoot");
            $('#parentID').combotree('setValue', root.id);
            var select=$(".easyui-tree").tree("getSelected");
            if(select){
                if(!select.parentID||select.parentID==0){
                    $('.combo input').attr("disabled",true);
                    $('.combo').find("span").hide();
                    $('#parentID').combotree('setValue', "");
                }
            }
        }
    });  
    $('#Birthday').datebox({    
        formatter:formatDateText
    }); 
    $('#Sex').combobox({
        width:'140'
    });
    $('.easyui-tree').tree({
        onClick:function(node){
            if(node.type==0){
                $("#departmentform").show();
                $("#employeeform").hide();
                $("#department").panel("setTitle","部门信息");
                $("input[name=departmentName]").val(node.text);
                $("input[name=departmentName]").validatebox('validate');
                if(!node.parentID||node.parentID==0){
                    $('.combo input').attr("disabled",true);
                    $('.combo').find("span").hide();
                    $('#parentID').combotree('setValue', "");
                }else{
                    $('.combo input').attr("disabled",false);
                    $('.combo').find("span").show();
                    $('#parentID').combotree('setValue', node.parentID);
                }
                $("input[name=describe]").val(node.describe);
                $("input[name=departid]").val(node.id);
            }else{
                $('.combo input').attr("disabled",false);
                $('.combo').find("span").show();
                $("#department").panel("setTitle","员工信息");
                $("#departmentform").hide();
                $("#employeeform").show();
                $.getJSON(Yii_baseUrl+'/member/employee/getemployinfo',{
                    id:node.id
                },function(result){
                    $.each(result,function(key,val){
                        if(key=='truename'||key=='nickname'||key=='phone'||key=='Position'||key=='OPH'||key=='Remark'||key=='EmployeeNum'||key=='username'||key=='password'||key=='email'){
                            $("#"+key).val(val);
                        }else if(key=='Birthday'||key=='ExpirationDate'){
                            $("#"+key).datebox('setValue',val);
                        }else if(key=='parentID'){
                            $("#parID").combotree('setValue',val);
                        }else if(key=='Sex'){
                            $("#Sex").combobox('select',val);
                        }else if(key=='Validity'){
                            if(val=='Y'){
                                $("#Validity").attr("checked", true);
                            }else{
                                $("#Validity").attr("checked", false);
                            }
                        }
                        if(key=='truename'||key=='phone'||key=='username'||key=='password'||key=='email'){
                            $("#"+key).validatebox('validate');
                        }
                    });
                    $("input[name=employeeid]").val(node.id);
                });
            }
        }
    })
    $(".icon-save").live('click',function(){
        if($("#departmentform").is(":visible")){
            $("#saves").linkbutton("disable");
            if($("#departid").val()){
                if($("input[name=parentID]").val()==$("#departid").val()){
                    $.messager.alert('提示', "上级部门不可选择部门本身及其下属部门", 'info');
                    $("#saves").linkbutton("enable");
                }else{
                    var select=$(".easyui-tree").tree("getSelected");
                    if(!$('#departID').tree('isLeaf',select.target)){
                        var checkChildren=$(".easyui-tree").tree("getChildren",select.target);
                        var result=true;
                        $.each(checkChildren,function(index,val){
                            if($("input[name=parentID]").val()==val.id){
                                result=false;
                            }
                        });
                        if(result){
                            departsub();
                        }else{
                            $.messager.alert('提示', "上级部门不可选择部门本身及其下属部门", 'info');
                            $("#saves").linkbutton("enable");
                        }
                    }else{
                        departsub();
                    }
                }
            }else{
                departsub();
            }
        }
        else if($("#employeeform").is(":visible")){
            $("#saves").linkbutton("disable");
            var root=$('.easyui-tree').tree('getRoot');
            if(root){
                var truename= $("#truename").val();
                var username= $("#username").val();
                var employeeNum= $("#EmployeeNum").val();
                var phone= $("#phone").val();
                var email= $("#email").val();
                var employID= $("#employeeid").val();
                $.getJSON(Yii_baseUrl+'/member/employee/checkemploy',{
                    employID:employID,
                    truename:truename,
                    username:username,
                    employeeNum:employeeNum,
                    phone:phone,
                    email:email
                },function(result){
                    if(result.result){
                        $('#employeeform').submit();
                    }else{
                        $.messager.alert('提示', result.message, 'info');
                        $("#saves").linkbutton("enable");
                    }
                });
            }else{
                $.messager.alert('提示', '请先添加部门', 'info');
                $("#saves").linkbutton("enable");
            }
        }
    });
    $("#adddepart").click(function(){
        $("#departmentform").show();
        $("#employeeform").hide();
        $("#department").panel("setTitle","部门信息");
        $('.easyui-tree').tree('reload');
        $("input[name=departmentName]").val("");
        $("input[name=departmentName]").validatebox('validate');
        $('.combo input').attr("disabled",false);
        $('.combo').find("span").show();
        var t=$('#parentID').combotree('tree');
        var root=t.tree("getRoot");
        $('#parentID').combotree('setValue', root.id);
        $("input[name=describe]").val("");
        $("input[name=departid]").val("");
    });
    $("#addemploy").click(function(){
        $("#departmentform").hide();
        $("#employeeform").show();
        $("#department").panel("setTitle","员工信息");
        $('.easyui-tree').tree('reload');
        $('.combo input').attr("disabled",false);
        $('.combo').find("span").show();
        $("#employeeform").find("input").each(function(){
            $(this).val("");
            var key=$(this).attr('id');
            if(key=='truename'||key=='phone'||key=='username'||key=='password'||key=='email'){
                $("#"+key).validatebox('validate');
            }
        });
        var t=$('#parID').combotree('tree');
        var root=t.tree("getRoot");
        $('#parID').combotree('setValue', root.id);
        $("#employeeform").find("#Validity").attr("checked", true);
        $("#employeeform").find("#vali").val('Y');
        $("#employeeform").find("#Sex").combobox('select',0);
    });
    $(".icon-remove").live('click',function(){
        var selected=$('.easyui-tree').tree('getSelected');
        if(selected==null){
            $.messager.alert('提示', "请选择需要删除的部门或员工！", 'info'); 
        }else{
            if(!selected.parentID||selected.parentID==0){
                $.messager.alert('提示', "最高级部门不允许删除！", 'info');  
            }else{
                $.messager.confirm('提示框', '您确定要删除吗?',function(result){
                    if(result){
                        $("#removes").linkbutton("disable");
                        if(selected.type==0){
                            if($('.easyui-tree').tree('isLeaf',selected.target)){
                                $.getJSON(Yii_baseUrl+'/member/employee/deldepart',{
                                    departid:selected.id
                                },function(result){
                                    $("#removes").linkbutton("enable");
                                    if(result>0){
                                        $.messager.alert('提示', "删除成功！", 'info'); 
                                        $('.easyui-tree').tree('reload'); 
                                        $('#parentID').combotree('reload');
                                        $('#parID').combotree('reload');
                                    }else{
                                        $.messager.alert('提示', "删除失败！", 'info');
                                        $('.easyui-tree').tree('reload');
                                        $('#parentID').combotree('reload');
                                        $('#parID').combotree('reload');
                                    }
                                })
                            }else{
                                var children=$('.easyui-tree').tree('getChildren',selected.target);
                                if(children.length>0){
                                    var i=1;
                                    var chilID=selected.id;
                                    $.each(children,function(key,val){
                                        if(val.type==1){
                                            i=2;
                                        }else{
                                            chilID=chilID+","+val.id;
                                        }
                                    });
                                    if(i==2){
                                        $.messager.alert('提示', "此部门内有员工,请先删除部门内的员工！", 'info');  
                                    }else{
                                        $.getJSON(Yii_baseUrl+'/member/employee/deldepart',{
                                            departsid:chilID
                                        },function(result){
                                            $("#removes").linkbutton("enable");
                                            if(result>0){
                                                $.messager.alert('提示', "删除成功！", 'info'); 
                                                $('.easyui-tree').tree('reload'); 
                                                $('#parentID').combotree('reload');
                                                $('#parID').combotree('reload');
                                            }else{
                                                $.messager.alert('提示', "删除失败！", 'info');
                                                $('.easyui-tree').tree('reload');
                                                $('#parentID').combotree('reload');
                                                $('#parID').combotree('reload');
                                            }
                                        })
                                    }
                                }
                            }
                        }else{
                            var userID='<?php echo Yii::app()->user->id;?>';
                            if(userID==selected.id){
                                $.messager.alert('提示', "不能删除自己的账户！", 'info'); 
                            }else{
                                $.getJSON(Yii_baseUrl+'/member/employee/delemployee',{
                                    employeeid:selected.id
                                },function(result){
                                    $("#removes").linkbutton("enable");
                                    if(result>0){
                                        $.messager.alert('提示', "删除成功！", 'info'); 
                                        $('.easyui-tree').tree('reload'); 
                                    }else{
                                        $.messager.alert('提示', "删除失败！", 'info');
                                        $('.easyui-tree').tree('reload');
                                    }
                                });
                            }
                        }
                    }
                });
            }
        }
    });
});