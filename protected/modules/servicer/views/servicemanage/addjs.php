<script>
    $(document).ready(function(){
        $("#query-btn").click(function(){
            var licenseplate = $("input[name=LicensePlate]").val();
            if (licenseplate == ''){
                $('#checkcar').datagrid('loadData', { rows: [] });
                return false;
            }
            else {
                $('#checkcar').datagrid({ 
                    url: Yii_baseUrl + "/servicer/servicemanage/checkcar",
                    queryParams:{'licenseplate':licenseplate},
                    method:"post",
                    onLoadSuccess:function(data){  
                        if(data.totals == 0) {
                            $.messager.confirm("提示","暂无车辆信息,是否进行车主车辆登记？",function(r){
                                if (r) {
                                    window.location =Yii_baseUrl+"/servicer/serviceowner/index";
                                }
                            });
                        }
                    }  
                });
            }
        });
        //选择显示服务类型
        $("input[name='ServiceType']").click(function(){
            var val = $("input[name='ServiceType']:checked").val();
            if (val == '1') {	//日常保养
                $("#partsRemark").show();
                $("#partsSelect").hide();
                $("#partsService .replace").remove();
                $("#partsService .repair").remove();
                $("input:checkbox[xb=xb]").attr('checked',false);
            }
            else if (val == '2') {	//配件服务
                $("#partsRemark").hide();
                $("#partsSelect").show();
            }
            else {	//全部服务
                $("#partsRemark").show();
                $("#partsSelect").show();
            }
        })
        //选择显示配件服务类别
        $("input:checkbox[xb=xb]").click(function(){
            $(this).each(function(){
                if($(this).attr("checked") == undefined){
                    var type = this.value;
                    if(type == 1){
                        if($("#partsService .replace").length>0){
                            $("#partsService .replace").remove();
                        }						
                    }else if(type == 2){
                        if($("#partsService .repair").length>0){
                            $("#partsService .repair").remove();
                        }							
                    }
                }else if($(this).attr("checked")){
                    var type = this.value;
                    if(type == 1){
                        if($("#partsService .replace").length<=0){
                            $("#replace").tmpl().appendTo("#partsService");
                            $("#partsService .replace").show();
                        }						
                    }else if(type == 2){
                        if($("#partsService .repair").length<=0){
                            $("#repair").tmpl().appendTo("#partsService");
                            $("#partsService .repair").show();
                        }							
                    }
                }
            })
        })
    });
    function replace()
    {
        var mainid = $("#mainCategory_add_replace").val();
        var subid = $("#subCategory_add_replace").val();
        var leafid = $("#leafCategory_add_replace").val();
        var mains = $("#mainCategory_add_replace option[value='"+$("#mainCategory_add_replace").val()+"']").text();
        var subs =  $("#subCategory_add_replace option[value='"+$("#subCategory_add_replace").val()+"']").text();
        var leafs = $("#leafCategory_add_replace option[value='"+$("#leafCategory_add_replace").val()+"']").text();
        var brand =  $("input[name=replace_brand]").val();
        var num =  $("input[name=replace_num]").val();
        var oe =  $("input[name=replace_OE]").val();
        if(leafid.length ==0){
            /*$.messager.show({
                title: '错误',
                msg: '配件标准名称不能为空'
            });*/
            alert("错误：配件标准名称不能为空！");
            return false;
        }
        else if(brand.length ==0){
            alert("错误：配件品牌不能为空！");
            return false;
        }
        else if(brand.length > 50){
            alert("错误：配件品牌名称长度不能超过50字符！");
            return false;
        }
        else if(oe.length > 50){
            alert("错误：OE号长度不能超过50字符！");
            return false;
        }
        else if(num==""||!$.isNumeric(num)){
            alert("错误：配件数量不能为空且必须是数字");
            return false;
        }
        else if(num.length > 10){
            alert("错误：配件数量不大于10位数！");
            return false;
        }
        else{
            var msg='';            
            $("#showReplace span").each(function(){
                var system="品类:"+mains+"&nbsp;"+subs+"&nbsp;"+leafs;
                var sbrand="品牌:"+brand;
                var namecp=$(this).find('span[name=mainname]').html();
                var brandcp=$(this).find('span[name=mainbrand]').html();
                if (system==namecp && sbrand==brandcp){	
                    msg='该品牌配件已存在，请勿重复添加!';
                }
            });
        }
        if(msg==''){
            $("<span class='checkbox-add bg-green tag-close mainspan' style='display:block;margin-top:1px;'>"+
                "<span name='mainname'>品类:"+mains+"&nbsp;"+subs+"&nbsp;"+leafs+"</span>"+　
                "&nbsp;<span name='mainbrand'>品牌:"+brand+"</span>&nbsp;<span>数量:"+num+"</span>&nbsp;<span>OE号:"+oe+"</span>"+　
                "<i class='close icon-close-green' onclick='javascript:$(this).parent().remove()' key='0'></i>"+
                "<br><input type='hidden' value="+mainid+","+subid+","+leafid+","+brand+","+num+","+oe+" name='replace[]'></span>").appendTo("#showReplace");
        }
        else{
            alert("错误："+msg);
        }
    }
    function repair()
    {
        var mainid = $("#mainCategory_add_repair").val();
        var subid = $("#subCategory_add_repair").val();
        var leafid = $("#leafCategory_add_repair").val();
        var mains = $("#mainCategory_add_repair option[value='"+$("#mainCategory_add_repair").val()+"']").text();
        var subs =  $("#subCategory_add_repair option[value='"+$("#subCategory_add_repair").val()+"']").text();
        var leafs = $("#leafCategory_add_repair option[value='"+$("#leafCategory_add_repair").val()+"']").text();
        var brand =  $("input[name=repair_brand]").val();
        if(leafid.length ==0){
            alert("错误：配件标准名称不能为空！");
            return false;
        }
        else if(brand.length ==0){
            alert("错误：配件品牌不能为空！");
            return false;
        }
        else if(brand.length > 50){
            alert("错误：配件品牌名称长度不能超过50字符！");
            return false;
        }
        else{
            var msg='';            
            $("#showRepair span").each(function(){
                var system="品类:"+mains+"&nbsp;"+subs+"&nbsp;"+leafs;
                var sbrand="品牌:"+brand;
                var namecp=$(this).find('span[name=mainname]').html();
                var brandcp=$(this).find('span[name=mainbrand]').html();
                if (system==namecp && sbrand==brandcp){	
                    msg='该品牌配件已存在，请勿重复添加!';
                }
            });
        }
        if(msg==''){
            $("<span class='checkbox-add bg-green tag-close mainspan' style='display:block;margin-top:1px;'>"+
                "<span name='mainname'>品类:"+mains+"&nbsp;"+subs+"&nbsp;"+leafs+"</span>&nbsp;<span name='mainbrand'>品牌:"+brand+"</span>"+　
                "<i class='close icon-close-green' onclick='delRepair(this)' key='0'></i>"+
                "<br><input type='hidden' value="+mainid+","+subid+","+leafid+","+brand+" name='repair[]'></span>").appendTo("#showRepair");
        }
        else{
            alert("错误："+msg);
        }
    }
    var url;
    function checkCar(){
        $('#check_car').dialog({closed:false,title:'检查车辆信息'});
        $('#checkcar').datagrid('loadData', { rows: [] });
        $("input[name=LicensePlate]").val('');
        $('#check_fm').form('clear');
    }
    function addRecord(){
        var row = $('#checkcar').datagrid('getSelected');
        if (row) {
            var ID = row.ID.toString();
            $("#partsRemark").hide();	//隐藏该隐藏的日常保养备注及配件服务类别选择
            $("#partsSelect").hide();
            $('#add_dlg').dialog({closed:false,title:'添加服务记录'});
            $('#add_fm').form('clear');
            $("#save-btn").linkbutton('enable');   //保存按钮有效
            //默认服务类型为日常保养
            document.getElementsByName("ServiceType")[0].checked="checked";
            $("#partsRemark").show();
            $('#check_car').dialog('close');
            if($("#partsService .replace").length>0){
                $("#partsService .replace").remove();
            }	
            if($("#partsService .repair").length>0){
                $("#partsService .repair").remove();
            }	
            url = Yii_baseUrl + "/servicer/servicemanage/add?ID="+ID;
        }
        else {
            alert("警告：请选择需要服务登记的车主车辆信息，如未登记，请先前往车主管理完成车主车辆登记！");
        }
    }
    function saveRecord(){
        //验证配件维修时配件名称和品牌不能为空
        if($("#partsService .replace").length>0){
            var replaceleaf = $("#leafCategory_add_replace").val();
            var replacebr = $("input[name=replace_brand]").val();
            var replacenum = $("input[name=replace_num]").val();
            if(replaceleaf.length ==0){
                alert("错误：配件标准名称不能为空！");
                return false;
            }
            if(replacebr.length ==0){
                alert("错误：配件品牌不能为空！");
                return false;
            }
            if(replacenum.length == 0){
                alert("错误：配件数量不能为空！");
                return false;
            }
            if(replacenum.length > 10){
                alert("错误：配件数量不大于10位数！");
                return false;
            }
        }
        //验证配件维修时配件名称和品牌不能为空
        if($("#partsService .repair").length>0){
            var repairleaf = $("#leafCategory_add_repair").val();
            var repairbr = $("input[name=repair_brand]").val();
            if(repairleaf.length ==0){
                alert("错误：配件标准名称不能为空！");
                return false;
            }
            if(repairbr.length ==0){
                alert("错误：配件品牌不能为空！");
                return false;
            }
        }   
        var mileage=$('#mileage').val();
        if(mileage>999999999){
            $('#mileageNote').html('<font color="red">当前里程数不能超过9位数!</font>'); 
            return false;
        }
        $('#add_fm').form('submit',{
            url: url,
            onSubmit: function(){
                if($(this).form('validate')==true){
                    $("#save-btn").linkbutton('disable');   //验证通过保存按钮失效
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
                    alert("错误："+result.errorMsg);
                } else {
                    $('#add_dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload');
                }
            }
        });
    }
    
    //验证里程数不超过9位数
    $(document).delegate('#mileage','keyup',function(){
        var mileage=$('#mileage').val();
        if(mileage>999999999){
            $('#mileageNote').html('<font color="red">当前里程数不能超过9位数!</font>'); 
        }
        else{
            $('#mileageNote').html(''); 
        }
    })
</script>