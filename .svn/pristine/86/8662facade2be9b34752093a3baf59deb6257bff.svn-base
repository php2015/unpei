<script>
    $(document).ready(function(){
        //选择显示配件服务类别
        $("input:checkbox[xb=xb]").click(function(){;
            $(this).each(function(){
                if($(this).attr("checked") == undefined){
                    var type = this.value;
                    if(type == 1){
                        if($("#partsRegisyer .parts_replace").length>0){
                            $("#partsRegisyer .parts_replace").remove();
                        }						
                    }else if(type == 2){
                        if($("#partsRegisyer .parts_repair").length>0){
                            $("#partsRegisyer .parts_repair").remove();
                        }
                    }
                }else if($(this).attr("checked")){
                    var type = this.value;
                    if(type == 1){
                        if($("#partsRegisyer .parts_replace").length<=0){
                            $("#parts_replace").tmpl().appendTo("#partsRegisyer");
                            $("#partsRegisyer .parts_replace").show();
                        }						
                    }else if(type == 2){
                        if($("#partsRegisyer .parts_repair").length<=0){
                            $("#parts_repair").tmpl().appendTo("#partsRegisyer");
                            $("#partsRegisyer .parts_repair").show();
                        }							
                    }
                }
            })
        })
    });
    function partsReplace()
    {
        var mainid = $("#mainCategory_edit_replace").val();
        var subid = $("#subCategory_edit_replace").val();
        var leafid = $("#leafCategory_edit_replace").val();
        var mains = $("#mainCategory_edit_replace option[value='"+$("#mainCategory_edit_replace").val()+"']").text();
        var subs =  $("#subCategory_edit_replace option[value='"+$("#subCategory_edit_replace").val()+"']").text();
        var leafs = $("#leafCategory_edit_replace option[value='"+$("#leafCategory_edit_replace").val()+"']").text();
        var brand =  $("input[name=replaceBrand]").val();
        var num =  $("input[name=replaceNum]").val();
        var oe =  $("input[name=replaceOE]").val();
        if(leafid.length ==0){
            /*$.messager.show({
                title: '错误',
                msg: '配件标准名称不能为空'
            });*/
            alert("错误：配件标准名称不能为空！");
            return false;
        }
        else if(brand.length ==0){
            /*$.messager.show({
                title: '错误',
                msg: '配件品牌不能为空'
            });*/
            alert("错误：配件品牌不能为空！");
            return false;
        }
        else if(num.length == 0){
            alert("错误：配件数量不能为空！");
            return false;
        }
        else if(num.length > 10){
            alert("错误：配件数量不大于10位数！");
            return false;
        }
        else{
            var msg='';            
            $("#showpartsReplace span").each(function(){
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
                "<br><input type='hidden' value="+mainid+","+subid+","+leafid+","+brand+","+num+","+oe+" name='partsreplace[]'></span>").appendTo("#showpartsReplace");
        }
        else{
            alert("错误："+msg);
        }
    }
    function partsRepair()
    {
        var mainid = $("#mainCategory_edit_repair").val();
        var subid = $("#subCategory_edit_repair").val();
        var leafid = $("#leafCategory_edit_repair").val();
        var mains = $("#mainCategory_edit_repair option[value='"+$("#mainCategory_edit_repair").val()+"']").text();
        var subs =  $("#subCategory_edit_repair option[value='"+$("#subCategory_edit_repair").val()+"']").text();
        var leafs = $("#leafCategory_edit_repair option[value='"+$("#leafCategory_edit_repair").val()+"']").text();
        var brand =  $("input[name=repairBrand]").val();
        if(leafid.length ==0){
            alert("错误：配件标准名称不能为空!");
            return false;
        }
        else if(brand.length ==0){
            alert("错误：维修配件品牌不能为空!");
            return false;
        }
        else{
            var msg='';            
            $("#showpartsRepair span").each(function(){
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
                "<i class='close icon-close-green' onclick='javascript:$(this).parent().remove()' key='0'></i>"+
                "<br><input type='hidden' value="+mainid+","+subid+","+leafid+","+brand+" name='partsrepair[]'></span>").appendTo("#showpartsRepair");
        }
        else{
        	alert("错误："+msg);
        }
    }
    var url;
    var addurl;
    var editurl;
    function editRecord(){
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            var ID = row.ID.toString();
            $('#edit_dlg').dialog({closed:false,title:'编辑服务记录'});
            $(".layout-button-up").remove();    //移除"region:'north'向上收缩样式
            $("td[name=Name]").text(row.Name);
            $("td[name=Phone]").text(row.Phone);
            $("td[name=Gender]").text(row.Gender);
            $("td[name=City]").text(row.City);
            $("td[name=LicensePlate]").text(row.LicensePlate); 
            $("td[name=Uses]").text(row.Uses);
            $("td[name=Car]").text(row.Car);
            $("td[name=VinCode]").text(row.VinCode); 
            $("td[name=Miles]").text(row.Miles+'km');
            $("td[name=BuyTime]").text(row.BuyTime);
            $("input[name=recordID]").val(row.ID);  //获取记录ID
            //获取服务记录
            $('#edit_fm').form('load',row);
            //获取配件服务记录
            $('#partsrecord').datagrid({ 
                url:Yii_baseUrl + "/servicer/servicemanage/partsservice",
                queryParams:{'ID':ID},
                method:"post"
            });
            //日常保养备注
            if(row.ServiceType!="配件服务"){
                $(".remarkedit").show();
            }
            else{
                $(".remarkedit").hide();
            }
            editurl = Yii_baseUrl + "/servicer/servicemanage/update/ID/"+row.ID.toString()
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要修改服务记录!'
            });
        }	
    }
    function saveEdit(){
        var row = $('#dg').datagrid('getSelected');
        var mileage=$('#editMileage').val();
        if(mileage>999999999){
           $('#editMileageNote').html('<font color="red">当前里程数不能超过9位数!</font>'); 
           return false;
        }
        $('#edit_fm').form('submit',{
            url: editurl,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
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
    function addParts()
    {
        var recordID = $("input[name=recordID]").val();
        $("#add_parts_dlg").dialog('open').dialog('setTitle','添加配件服务');
        $('#add_parts_fm').form('clear');
        $("#parts-btn").linkbutton('enable');   //保存按钮有效
        if($("#partsRegisyer .parts_replace").length>0){
            $("#partsRegisyer .parts_replace").remove();
        }	
        if($("#partsRegisyer .parts_repair").length>0){
            $("#partsRegisyer .parts_repair").remove();
        }	
        addurl = Yii_baseUrl + "/servicer/servicemanage/addparts/ID/"+recordID;
    }
    function saveParts()
    {
        //验证配件维修时配件名称和品牌不能为空
        if($("#partsRegisyer .parts_replace").length>0){
            var replaceleaf = $("#leafCategory_edit_replace").val();
            var replacebr = $("input[name=replaceBrand]").val();
            var replacenum = $("input[name=replaceNum]").val();
            if(replaceleaf.length ==0){
                alert("错误：配件标准名称不能为空!");
                return false;
            }
            if(replacebr.length ==0){
                alert("错误：更新配件品牌不能为空!");
                return false;
            }
            if(replacenum.length == 0){
                alert("错误：配件数量不能为空!");
                return false;
            }
            if(replacenum.length > 10){
                alert("错误：配件数量不大于10位数");
                return false;
            }
        }
        //验证配件维修时配件名称和品牌不能为空
        if($("#partsRegisyer .parts_repair").length>0){
            var repairleaf = $("#leafCategory_edit_repair").val();
            var repairbr = $("input[name=repairBrand]").val();
            if(repairleaf.length ==0){
                alert("错误：配件标准名称不能为空");
                return false;
            }
            if(repairbr.length ==0){
                alert("错误：维修配件品牌不能为空");
                return false;
            }
        }
        $('#add_parts_fm').form('submit',{
            url: addurl,
            onSubmit: function(){
                if($(this).form('validate')==true){
                    $("#parts-btn").linkbutton('disable');   //验证通过保存按钮失效
                    return $(this).form('validate');
                }
                else{
                    $("#parts-btn").linkbutton('eable');   //验证不通过保存按钮失效
                    return $(this).form('validate');
                }
            },
            success: function(result){
                var result = eval('('+result+')');
                $("#parts-btn").linkbutton('enable');   //返回后有效
                if (result.errorMsg){
                    alert("错误："+result.errorMsg);
                } else {
                    $('#add_parts_dlg').dialog('close'); 	// close the dialog
                    $('#dg').datagrid('reload'); 			// reload the user data
                    $('#partsrecord').datagrid('reload'); 	// reload the user data
                }
            }
        });
    }
    function editParts()
    {
        var row = $('#partsrecord').datagrid('getSelected');
        if (row) {
            if (row.OperateType == '1') {
                $("#replace_dlg").dialog('open').dialog('setTitle','修改服务记录');
                $('#replace_fm').form('load',row);
                $("#mainCategory_replace").val(row.mainCategory);
                $("#mainCategory_replace").attr("subc",row.subCategory);
                $("#mainCategory_replace").attr("lefc",row.leafCategory);
                $("#mainCategory_replace").change();
                url = Yii_baseUrl + "/servicer/servicemanage/updatereplace/ID/"+row.ID.toString();
            }
            else {
                $("#repair_dlg").dialog('open').dialog('setTitle','修改服务记录');
                $('#repair_fm').form('load',row);
                $("#mainCategory_repair").val(row.mainCategory);
                $("#mainCategory_repair").attr("subc",row.subCategory);
                $("#mainCategory_repair").attr("lefc",row.leafCategory);
                $("#mainCategory_repair").change();
                url = Yii_baseUrl + "/servicer/servicemanage/updaterepair/ID/"+row.ID.toString();
            }
        } 
        else {
            alert("警告：请选择您要修改的配件记录!");
        }
    }
    function saveReplace()
    {
        var replaceleaf = $("#leafCategory_replace").val();
        if(replaceleaf.length ==0){
            alert("错误：配件标准名称不能为空!");
            return false;
        }
        $('#replace_fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.errorMsg){
                    alert("错误："+result.errorMsg);
                } else {
                    $('#replace_dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload'); // reload the user data
                    $('#partsrecord').datagrid('reload'); // reload the user data
                }
            }
        });
    }
    function saveRepair()
    {
        var repairleaf = $("#leafCategory_repair").val();
        if(repairleaf.length ==0){
            alert("错误：配件标准名称不能为空！");
            return false;
        }
        $('#repair_fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.errorMsg){
                    alert("错误："+result.errorMsg);
                } else {
                    $('#repair_dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload'); // reload the user data
                    $('#partsrecord').datagrid('reload'); // reload the user data
                }
            }
        });
    }
    function destroyParts()
    {
        var row = $('#partsrecord').datagrid('getSelected');
        if (row){
            var ID = row.ID.toString();
            var ServiceID = row.ServiceID.toString();
            $.messager.confirm('确认','您确定要删除这条配件服务记录？',function(r){
                if (r){
                    $.post(Yii_baseUrl + "/servicer/servicemanage/destroyparts",{ID:ID,ServiceID:ServiceID},function(result){
                        if (result.success){
                            $('#dg').datagrid('reload'); // reload the user data
                            $('#partsrecord').datagrid('reload'); // reload the user data
                        } else {
                            alert("错误："+result.errorMsg);
                        }
                    },'json');
                }
            });
        }
        else {
            alert("警告：请选择您要删除的配件服务记录!");
        }
    }
    $(document).delegate('#editMileage','keyup',function(){
        var mileage=$('#editMileage').val();
        if(mileage>999999999){
           $('#editMileageNote').html('<font color="red">当前里程数不能超过9位数!</font>'); 
        }
        else{
           $('#editMileageNote').html(''); 
        }
    })
</script>