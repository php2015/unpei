<div id="dlg" class="easyui-dialog" style="width:800px;height:600px;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons">
    <!---padding:10px 20px-->
    <form id="fm" method="post"  enctype="multipart/form-data" >
        <div class="form-row">
            <label calsss="label">商品编号:</label>
            <input name="GoodsNO" class="easyui-validatebox input" required="true">
            &nbsp;&nbsp;&nbsp;<label>商品名称:</label>
            <input name="Name" class="easyui-validatebox input" required="true" >

        </div>
        <div class="form-row">
            <label >参&nbsp;考&nbsp;价:</label>
            <input name="Price" class="easyui-validatebox input" required="true" validType='floatnum'>
            &nbsp;&nbsp;&nbsp;<label >商品拼音:</label>
            <input name="Pinyin" id="pinyincode" class="easyui-validatebox input" value="" >
        </div>
        <div class="form-row">
            <label>配件品类:</label>
            <?php $this->widget('widgets.default.WGcategory'); ?>
            <!--<span id='addcpname' class="btn" style="cursor:pointer">添加</span>-->

        </div>
        <?php $this->renderPartial('tabs'); ?>
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveGoods()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
</div>

<script>
  
    
    $(function(){
        $("input[name=Name]").blur(function(){
            var name = $(this).val();
            var url = Yii_baseUrl+'/dealer/marketing/getpinyin';
            $.getJSON(url,{name:name},function(a){
                // alert(123);
                $("#pinyincode").val(a);
            })
        })
        //  $("input[name=CompanyType]:eq(0)").attr("checked",'checked'); 
        $("#BigParts").change(function(){
            if($(this).val()){
                var bigcode=$(this).val();
                var url=Yii_baseUrl+'/common/getcpnamebybigp';
                $.getJSON(url,{bigcode:bigcode},function(data){
                    if(data!=''){
                        $("#CpName").empty();
                        $.each(data, function(key,val){      
                            jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#CpName");
                        }); 
                    }
                });
            }else{
                $("#CpName").empty();
                $("<option value=''>请选择标准名称</option>").appendTo("#CpName");
            }
        });
    });
</script>
<script type="text/javascript">
    
    
    var url;
    function newGoods(){
        $("#showVehicle").empty();
        $("#showOENO").empty();
        $("#showimglist").empty();
        $(".inputfile-input span").html('');
        $("#goodsImage").remove();
        $('#dlg').dialog('open').dialog('setTitle','添加商品');
        $('#fm').form('reset');
        url = Yii_baseUrl+"/dealer/marketing/add";
    }
    function editGoods(){
        $(".inputfile-input span").html('');
        //var row = $('#dg').datagrid('getSelected');
        var row = $('#dg').datagrid('getSelections');
        if(row.length <1){
            $.messager.alert('提示信息','您还没有选择数据！','error');
            return false;
        } else if(row.length>=2){
            $.messager.alert('提示信息','只能选择一条数据编辑！','error');
            return false;
        } 
        if (row){
            $('#dlg').dialog('open').dialog('setTitle','修改商品信息');
            row[0].ImageUrl = row[0].ImageUrl;
            row[0].DetectionImg = '';
            $('#fm').form('load',row[0]);
            // 查询该商品的车系
            $("#showVehicle").empty();
            var vehurl = Yii_baseUrl +"/dealer/marketing/getvehbygoodsid";
            $.getJSON(vehurl,{id:row[0].ID},function(data){
                if(data){
                    $.each(data,function(index,val){
                        if(index%2 !=0){
                            var span = "<span class='checkbox-add bg-green tag-close catespan'><span>"+val['Make']+"</span>-<span>"+val['Car']+"</span>-<span>"+val['year']+"</span>-<span name='model'>"+val['Model']+"</span><span onclick='xxVehicle(this)' key="+val['ID']+" class='close icon-close-green xx'></span></span><br>";
                        }else{
                            var span = "<span class='checkbox-add bg-green tag-close catespan'><span>"+val['Make']+"</span>-<span>"+val['Car']+"</span>-<span>"+val['year']+"</span>-<span name='model'>"+val['Model']+"</span><span onclick='xxVehicle(this)' key="+val['ID']+" class='close icon-close-green xx'></span></span>";
                        }
                    
                        $("#showVehicle").append(span);
                    })
                }
            });
            // 显示OE号
            $("#showOENO").empty();
            var oenourl = Yii_baseUrl +"/dealer/marketing/getoenobygoodsid";
            $.getJSON(oenourl,{id:row[0].ID},function(data){
                if(data){
                    $.each(data,function(index,val){
                        var span = "<span class='checkbox-add bg-green tag-close catespan'><span name='model'>"+val['OENO']+"</span><span onclick='xxOENO(this)' key="+val['ID']+" class='close icon-close-green xx'></span></span>";
                        $("#showOENO").append(span);
                    })
                }
            });
            $("#goodsImage").remove();
            // if(row[0].ImageUrl.length != 0 || row[0].ImageUrl != null){
            var themurl = "<?php echo F::themeUrl() ?>"+"/images/icons/icon-red-cross.png";
            var imgurl = " <?php echo F::uploadUrl(); // $url = F::baseUrl() . '/upload/dealer/';    ?>";
            $("<div id='goodsImage'> <img style='width:98px;height:98px;' src="+imgurl+row[0].ImageUrl+" ><span id='xxx'><img onclick='xximage(this)' src="+themurl+" key="+row[0].ImageUrl+"></span></div>") .appendTo("#showImage");
            //   }
            //显示图片列表 showimglist
            $("#showimglist").empty();
            var imageurl = Yii_baseUrl +"/dealer/marketing/getimgbygoodsid";
            $.getJSON(imageurl,{id:row[0].ID},function(data){
                if(data){
                    $.each(data,function(index,val){
                        //  var span = "<span style='height:80px;' class='checkbox-add bg-green tag-close catespan'><span name='model'>"+val['ImageUrl']+"</span><span onclick='xximage(this)' key="+val['ID']+" class='close icon-close-green xx'></span></span><br>";
                        var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+imgurl+val['ImageUrl']+"><span onclick='xximage(this)' key="+val['ImageUrl']+" class='close icon-close-green xx'></span></span>";
                        $("#showimglist").append(span);
                    })
                }
            });
            
            url =Yii_baseUrl+"/dealer/marketing/update/id/"+row[0].ID;
        }else{
            $.messager.alert('提示信息','您还没有选择数据！','error');
        }
    }
    function saveGoods(){
        var mainCategory = $("select[name=mainCategory]").val();
        if(mainCategory ==null || mainCategory == ''){
            //alert('请选择机构类型');
            //  $("#leafCategory").addClass("validatebox-text validatebox-invalid");
            $("#leafCategory").css({
                'background-color': '#FFF3F3',
                ' background-image': 'url("images/validatebox_warning.png")',
                'background-position': 'right center',
                'background-repeat': 'no-repeat',
                'border-color': '#FFA8A8',
                'color': '#000000',
                // "border":'1px solid red',
                // "background-color":"#ff00dd"
            });
            $("select[name=leafCategory]").attr('title','配件品类不能为空');
            // alert('配件品类不能为空');
            return false;
        }
        //        var val = $('#nobanding').combogrid('getValues');
        //        $("#goodsBrand").val(val);
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    //if (result.errorMsg){
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                    $('#dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload');//reload the user data
                   
                } else {
                    $.messager.show({
                        title: '错误信息',
                        msg: result.errorMsg
                    });
                }
            }
        });
    }
    function destroyGoods(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            //console.log(row.ID)
            $.messager.confirm('提示信息','你确定要把选中的这条数据删除吗？',function(r){
                if (r){
                    var url = Yii_baseUrl+"/dealer/marketing/delete";
                    $.post(url,{id:row.ID},function(result){
                        if (result.success){
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                            $('#dg').datagrid('reload'); // reload the user data
                        } else {
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                        }
                    },'json');
                }
            });
        }else{
            $.messager.alert('提示信息','您还没有选择数据！','error');
        }
    }
    
    function saveBrand(){
        $('#fbrand').form('submit',{
            url: Yii_baseUrl+"/dealer/marketing/addbrand",
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    //if (result.errorMsg){
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                    $('#dlgbrand').dialog('close'); // close the dialog
                    //$('#dg').datagrid('reload');//reload the user data
                } else {
                    $.messager.show({
                        title: '错误信息',
                        msg: result.errorMsg
                    });
                }
            }
        });
    }
</script>
<script>
    // 删除图片
    function xximage(obj){
        var xximage = obj.getAttribute("key");
        // alert(xximage);
        // $("#goodsImage").remove();
        // alert(123);
        var xxurl = Yii_baseUrl +"/dealer/marketing/deleteimg";
        $.getJSON(xxurl,{xximage:xximage},function(result){
            // alert(result);
            $("#goodsImage").remove();
            // $("#showimages").remove();
            //obj.parent('span').remove();
            
        })
    }
    //删除主营车系
    function xxVehicle(obj){
        var cateid = obj.getAttribute("key")
        if(cateid != 0)
        {
            var url =" <?php echo Yii::app()->createUrl('dealer/marketing/deletepromvehicle'); ?>";
            $.getJSON(url,{cateid:cateid},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        }else{
            $(obj).parent().remove();
        }
    }
    //删除主营车系
    function xxOENO(obj){
        var cateid = obj.getAttribute("key")
        if(cateid != 0)
        {
            var url =" <?php echo Yii::app()->createUrl('dealer/marketing/deletegoodsoeno'); ?>";
            $.getJSON(url,{cateid:cateid},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        }else{
            $(obj).parent().remove();
        }
    }
    function Trimstr(str,is_global)
    {
        var result;
        result = str.replace(/(^\s+)|(\s+$)/g,"");
        if(is_global.toLowerCase()=="g")
        {
            result = result.replace(/\s/g,"");
        }
        return result;
    }
   
    $(function(){
        $("#leafCategory").change(function(){
            //alert($("#leafCategory").val());
            $("input[name=JiapartsNO]").val($("#leafCategory").val());
            
        })
       
        // 添加车系
        $("#addVehcle").click(function(){
            if($("#showVehicle span.catespan").length <6){
			
                //  var businessCar =  $("#Dealer_businessCar option:selected").text();
                //  var businessCarModel = $("#Dealer_businessCarModel option:selected").text()
                // var businessCarval = $("#front-vehicle-make-list").val()
                //var businessCarModelval = $("#front-vehicle-model-list").val()
                var makeval =  $("#front_make").val();
                var carval =  $("#front_series").val();
                var yearval =  $("#front_year").val();
                var modelval =  $("#front_model").val();
                // 前市场车型
                var make =  $("#front_make option:selected").text();
                var car =  $("#front_series option:selected").text();
                var year =  $("#front_year option:selected").text();
                var model =  $("#front_model option:selected").text();
                //  model = model.replace(/(^\s*)|(\s*$)/g,' ');
                var is_global = 'g';
                model = Trimstr(model,is_global);
                if(yearval == ''){
                    yearval= 0; year = '0';
                }if(modelval==''){
                    modelval = 0; model = '0';
                }
                // model = '2.0L自动四驱经典版';
                if(make == "请选择厂家")
                {
                    alert('您还没有请选择厂家类别！');
                    return false;
                }else{
                    var al='';
                    $("#showVehicle span.catespan").each(function(){
                        //						var systemCode=$(this).find('span[name=system]').html();
                        var cpCode=$(this).find('span[name=model]').html();
                        if(model==cpCode && cpCode !=0){
                            al='此车系您已添加，不可重复添加！';
                        }
                    })
                    if(al==''){
                        if($("#showVehicle span.catespan").length % 2 != 0){
                            $("<span class='checkbox-add bg-green tag-close catespan'><span>"+make+"</span>-<span>"+car+"</span>-<span>"+year+"</span>-<span name='model'>"+model+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'></span></span><br>").appendTo("#showVehicle");
                        }else{
                            $("<span class='checkbox-add bg-green tag-close catespan'><span>"+make+"</span>-<span>"+car+"</span>-<span>"+year+"</span>-<span name='model'>"+model+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showVehicle");
                        }
                        //  $("<input type='hidden' value="+businessCarval+" name='businessCar[]'><input type='hidden' value="+businessCarModelval+" name='businessCarModel[]'>").appendTo("#showVehicle");
                        $("<input type='hidden' value="+makeval+" name='make[]'><input type='hidden' value="+carval+" name='car[]'><input type='hidden' value="+yearval+" name='year[]'><input type='hidden' value="+modelval+" name='model[]'>").appendTo("#showVehicle");
                        $("<input type='hidden' value="+make+" name='maketext[]'><input type='hidden' value="+car+" name='cartext[]'><input type='hidden' value="+year+" name='yeartext[]'><input type='hidden' value="+model+" name='modeltext[]'>").appendTo("#showVehicle");
                    }else{
                        alert(al);
                    }
                }
			
            }else{
                alert("最多只能添加6个");
            }
        });
	
        // 添加OENO　号
        $("#addOENO").click(function(){
            //var OENO = $("input[name=OENO]").val();
            var OENO = $("#OENOValue").val();
            // alert(OENO)
            if(OENO=='')
            {
                alert('请填写OE号');
                return false;
            }else{
                var al='';
                $("#showOENO span.catespan").each(function(){
                    //var systemCode=$(this).find('span[name=system]').html();
                    var cpCode=$(this).find('span[name=model]').html();
                    if(OENO==cpCode){
                        al='此OENO您已添加，不可重复添加！';
                    }
                })
                if(al==''){
                    $("<span class='checkbox-add bg-green tag-close catespan'><span name='model'>"+OENO+"</span><span onclick='xxOENO(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showOENO");
                    $("<input type='hidden' value="+OENO+" name='OENOS[]'>").appendTo("#showOENO");
                    $("#OENOValue").val('');
                }else{
                    //alert(al);
                    $.messager.alert('提示信息',al);
                }
            }
			
           
        });

    })
</script>