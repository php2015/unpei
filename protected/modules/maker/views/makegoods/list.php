<?php echo $this->renderPartial('tab') ?>
<!-- 布局层 -->
<div class="easyui-layout" id="jp-layout" style="height:510px">
    <!-- 商品表格 -->
    <?php echo $this->renderPartial('goodslist') ?>
    <!-- 商品添加 -->
    <?php echo $this->renderPartial('add') ?>
    <!-- 商品详情 -->
    <?php echo $this->renderPartial('goodsdetail') ?>
    <!-- 商品批量导入 -->
    <?php echo $this->renderPartial('importgoods', array('category' => $category)); ?>
    <!--商品图片批量导入-->
    <?php $this->renderPartial('uploadimg'); ?>
    <!-- 高级筛选 -->
</div>

<script type="text/javascript">
    var url;
    //新建
    var actionevent;
    function Add()
    {
        actionevent = 'add';
        $('#GoodsNo').removeAttr('onfocus');
        $("#showimglist").empty();
        $("#version").hide();
        $('#GoodsNo').removeAttr("readonly");
        clear();
        $('#makegoodactive').dialog('open').dialog('setTitle', '添加商品');
        $('#leafCategory').val($('#leafCategorysearch').val());
        $('#leafCategory').change();
        //$('#fm_add').form('clear');
        url = Yii_baseUrl + '/maker/makegoods/add';

    }
    //修改
    function Edit()
    {
        actionevent = 'edit';
        clear();
        var allrow = $('#goods').datagrid('getSelections');
        $('#GoodsNo').attr('onfocus', 'this.blur()');
        $("#version").show();
        var imgurl = "<?php echo F::uploadUrl() ?>";
        if (allrow != '')
        {
            if (allrow.length == 1)
            {
                var row = $("#goods").datagrid('getSelected');
                if (row)
                {
                    $.getJSON(
                            Yii_baseUrl + '/maker/makegoods/getversion',
                            {goodsID: row.goodsID},
                    function(data)
                    {
                        if (data)
                        {
                            var html = '';
                            $.each(data, function(ke, ve) {
                                html += "<option value='" + ve.version_name + "'>" + ve.version_name + "</option>"
                            })
                            $('#version_name').html(html);
                            $('#version_name').attr('value', row.version_name);
                            $("#leafCategory").val(row.standard_id);
                            $("#leafCategory").change();
                        }
                    }
                    );
                    //加载图片
                    $("#showimglist").empty();
                    var imageurl = Yii_baseUrl + "/maker/makegoods/getimg";
                    $.getJSON(imageurl, {goodsid: row.goodsID}, function(data) {
                        if (data) {
                            $.each(data, function(index, val) {
                                var span = "<span class='showimages'><img  style='width:80px;height:80px;' src=" + imgurl + val['ImageUrl'] + "><span onclick='xximage(this)' key=" + val['ImageUrl'] + " goodsID=" + val['ID'] + " class='close icon-close-green xx'  name='urlimg' imgname=" + val['ImageName'] + "></span></span>";
                                $("#showimglist").append(span);
                            })
                        }
                    });
                }
                $('#makegoodactive').dialog('open').dialog('setTitle', '修改商品');
                $("#fm_add").form('load', row);
                $('#GoodsNo').attr('readonly', true);
                url = Yii_baseUrl + '/maker/makegoods/edit?goodsID=' + row.goodsID + '&version=' + row.version_name;
            } else
            {
                $.messager.alert('提示信息', '您只能勾选一件商品进行修改', 'info');
            }
        }
        else
        {
            $.messager.alert('提示信息', '请先勾选一条要修改的商品', 'info');
            return false;
        }

    }
    //删除图片
    function xximage(obj) {
        var xximage = obj.getAttribute("key");
        var goodsID = obj.getAttribute("goodsid");
        var tag = obj.getAttribute("tag");
        var xxurl = Yii_baseUrl + "/maker/makegoods/deleteimg";
        $.getJSON(xxurl, {xximage: xximage, goodsID: goodsID}, function(result) {
            $('#showimglist').html();
        })
    }
    //删除
    function Delete()
    {
        var row = $('#goods').datagrid('getSelections');
        var crowd = [];
        if (row != '')
        {
            $.messager.confirm('提示信息', '您确定要删除选择的商品?', function(r) {
                if (r)
                {
                    $.each(row, function(ke, ve) {
                        if (ve != '')
                        {
                            crowd.push(ve.goodsID);
                        }
                    });
                    var crowid = crowd.join(',');
                    var url = Yii_baseUrl + '/maker/makegoods/delete';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {goodsID: crowid},
                        dataType: 'json',
                        success: function(data)
                        {
                            if (data)
                            {
                                $.messager.alert('提示信息', '删除成功', 'info');
                                $('#goods').datagrid('reload');
                                headcheck();
                            }
                        }
                    });
                }
            })
        }
        else
        {
            $.messager.alert('提示信息', '请先勾选要删除的商品', 'info');
            return false;
        }

    }
//删除图片
    function xximage(obj) {
        var xximage = obj.getAttribute("key");
        var goodsID = obj.getAttribute("goodsid");
        var tag = obj.getAttribute("tag");
        var xxurl = Yii_baseUrl + "/maker/makegoods/deleteimg";
        $.getJSON(xxurl, {xximage: xximage, goodsID: goodsID}, function(result) {
            $('#showimglist').html();
        })
    }
//删除
    function Delete()
    {
        var row = $('#goods').datagrid('getSelections');
        var crowd = [];
        if (row != '')
        {
            $.messager.confirm('提示信息', '您确定要删除选择的商品?', function(r) {
                if (r)
                {
                    $.each(row, function(ke, ve) {
                        if (ve != '')
                        {
                            crowd.push(ve.goodsID);
                        }
                    });
                    var crowid = crowd.join(',');
                    var url = Yii_baseUrl + '/maker/makegoods/delete';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {goodsID: crowid},
                        dataType: 'json',
                        success: function(data)
                        {
                            if (data)
                            {
                                $.messager.alert('提示信息', '删除成功', 'info');
                                $("#zxq_box").slideUp("slow");
                                $('.zxq_btn-slide').removeClass("zxq_active");
                                $('#goods').datagrid('reload');
                                $('#dg').datagrid('unselectAll');
                                headcheck();
                            }
                        }
                    });
                }
            })
        }
        else
        {
            $.messager.alert('提示信息', '请先勾选要删除的商品', 'info');
            return false;
        }

    }
//商品上架
    function onsale()
    {
        var row = $('#goods').datagrid('getSelections');
        var crowd = [];
        if (row != '')
        {
            $.messager.confirm('提示信息', '您确定要上架选择的商品?', function(r) {
                if (r)
                {
                    $.each(row, function(ke, ve) {
                        if (ve != '')
                        {
                            crowd.push(ve.goodsID);
                        }
                    });
                    var crowid = crowd.join(',');
                    var url = Yii_baseUrl + '/maker/makegoods/onsale';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {goodsID: crowid},
                        dataType: 'json',
                        success: function(data)
                        {
                            if (data != 0)
                            {
                                $.messager.alert('提示信息', '上架成功', 'info');
                                $("#zxq_box").slideUp("slow");
                                $('.zxq_btn-slide').removeClass("zxq_active");
                                $('#goods').datagrid('reload');
                                $('#dg').datagrid('unselectAll');
                                headcheck();
                            } else if (data == 0)
                            {
                                $.messager.alert('提示信息', '所选择商品已是上架状态', 'info');
                                $("#zxq_box").slideUp("slow");
                                $('.zxq_btn-slide').removeClass("zxq_active");
                                $('#goods').datagrid('reload');
                                headcheck();
                            }
                        }
                    });
                }
            })
        }
        else
        {
            $.messager.alert('提示信息', '请选择要上架的商品', 'info');
            return false;
        }

    }
//去除刷新时全选按钮选中
    function headcheck()
    {
        $('#goods').parent().find("div .datagrid-header-check").children("input[type='checkbox']").eq(0).attr("checked", false);
    }
//商品下架
    function unsale()
    {
        var row = $('#goods').datagrid('getSelections');
        var crowd = [];
        if (row != '')
        {
            $.messager.confirm('提示信息', '您确定要下架选择的商品?', function(r) {
                if (r)
                {
                    $.each(row, function(ke, ve) {
                        if (ve != '')
                        {
                            crowd.push(ve.goodsID);
                        }
                    });
                    var crowid = crowd.join(',');
                    var url = Yii_baseUrl + '/maker/makegoods/unsale';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {goodsID: crowid},
                        dataType: 'json',
                        success: function(data)
                        {
                            if (data != 0)
                            {
                                $.messager.alert('提示信息', '下架成功', 'info');
                                $("#zxq_box").slideUp("slow");
                                $('.zxq_btn-slide').removeClass("zxq_active");
                                $('#goods').datagrid('reload');
                                $('#dg').datagrid('unselectAll');
                                headcheck();
                            } else if (data == 0)
                            {
                                $.messager.alert('提示信息', '所选择商品已是下架状态', 'info');
                                $("#zxq_box").slideUp("slow");
                                $('.zxq_btn-slide').removeClass("zxq_active");
                                $('#goods').datagrid('reload');
                                headcheck();
                            }
                        }
                    });
                }
            })
        }
        else
        {
            $.messager.alert('提示信息', '请选择要下架的商品', 'info');
            return false;
        }

    }


    //选择版本改变事件
    var paramsvalue;
    $('#version_name').change(function()
    {
        var row = $("#goods").datagrid('getSelected');
        var version_name = $('#version_name').val();
        $.ajax({
            url: Yii_baseUrl + '/maker/makegoods/Getinfobyversion',
            data: {'version_name': version_name, 'goodsid': row.goodsID},
            dataType: 'json',
            type: 'POST',
            success: function(res)
            {
                $("#fm_add").form('load', res.versioninfo);
                //$("#leafCategory").val(res.versioninfo.leafCategory);
                $("#leafCategory").change();
                paramsvalue = res.paramsvalue;
            }
        })

    })
    //关闭
    function addcancle()
    {
        $.messager.confirm('提示信息', '您确定要关闭?', function(r) {
            if (r)
            {
                $('#makegoodactive').dialog('close');
            }
        });
    }
    //保存
    var standardparams = 1;
    function Save()
    {
        var urlimg = 0;
        $("#showimglist .showimages").each(function() {
            if ($(this).find('span[add=add]').attr('key')) {
                urlimg += ',' + $(this).find('span[name=urlimg]').attr('key');
                urlimg += ';' + $(this).find('span[name=urlimg]').attr('imgname');
            }
        })
        $("#imgupload").val(urlimg);
        if (!$('#GoodsNo').validatebox('isValid'))
        {
            //$.messager.alert('操作提示','商品分类类别名称必须填写','warning');
            $('#GoodsNo').focus();
            return false;
        }
        //验证配件品类
        var leafcategory = $('#leafCategory').val();
        if (!leafcategory)
        {
            $.messager.alert('提示信息', '请选择配件品类!', 'info');
            return;
        }
        else if (standardparams == 1)
        {
            $.messager.alert('提示信息', '配件品类没有参数,请重新选择配件品类!!', 'info');
            return;
        }
        else
        {
            var params = new Array();
            $('#param').find('input').each(function(k, v) {
                if ($(this).val())
                    params.push($(this).val());
            })
            if (params.length == 0)
            {
                $.messager.alert('提示信息', '至少要填写一个配件品类参数!!', 'info');
                return;
            }
        }
        $.messager.confirm('提示信息', '您确定要保存?', function(r) {
            if (r) {
                $('#fm_add').form('submit', {
                    url: url,
                    onSubmit: function() {
                        return $(this).form('validate');
                    },
                    success: function(result) {
                        if (result == 1)
                        {
                            $.messager.alert('提示信息', '操作成功', 'info');
                            $('#makegoodactive').dialog('close');
                            $('#GoodsNo').validatebox({
                                validType: ''
                            });
                            $("#zxq_box").slideUp("slow");
                            $('.zxq_btn-slide').removeClass("zxq_active");
                            $('#goods').datagrid('reload');
                            $('#goods').datagrid('unselectAll');
                        }
                        else if (result == 2)
                        {
                            $.messager.alert('提示信息', '修改成功', 'info');
                            $('#makegoodactive').dialog('close');
                            $('#goods').datagrid('unselectAll');
                            return false;
                        }
                        else if (result == 3)
                        {
                            $.messager.alert('提示信息', '商品编号已存在,请重新输入', 'info');
                            var goodsno = $('#GoodsNo').val();
                            $('#GoodsNo').validatebox({
                                validType: 'dataexist["' + goodsno + '"]'
                            });
                        }
                        else {
                            $.messager.alert('提示信息', '操作失败', 'info');
                            $('#makegoodactive').dialog('close'); // close the dialog
                            $("#zxq_box").slideUp("slow");
                            $('.zxq_btn-slide').removeClass("zxq_active");
                            $('#goods').datagrid('reload'); // reload the user data
                        }
                    }
                });
            }
        });
    }
    //选择标准名称参数
    $('#leafCategory').change(function() {
        var standID = $('#leafCategory').val();
        var url = Yii_baseUrl + '/maker/makegoods/getstand';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                standID: standID
            },
            dataType: 'json',
            success: function(data)
            {
                var html = '<table style="width:450px;padding-left:27px;" id="tab"><tr><td>属性名称</td><td>属性值</td></tr>';
                if (data != null && typeof(data) == 'object') {
                    standardparams = 2;//标准名称参数存在
                    $.each(data, function(key, value) {
                        if (value != '')
                        {
                            html += "<tr id='c1'><td>" + value.name + ':' + "</td><td> <input class='easyui-validatebox input' name=column[" + value.id + "] id='GoodsForm_column' type='text' /></td></tr>";
                        }
                    });
                    $('#param').html(html);
                    //修改时加载参数值
                    var row = $("#goods").datagrid('getSelected');
                    var currentversion = $('#version_name').val();
                    if (actionevent == 'edit' && currentversion == row.version_name)
                    {

                        $('#param').find('input').each(function(k, v)
                        {
                            var tmpid = $(this).attr('name').match(/\d+/g);
                            $(this).val(row.paramsvalue[tmpid[0]]);
                        })
                    }
                    else if (actionevent == 'edit')
                    {
                        $('#param').find('input').each(function(k, v)
                        {
                            var tmpid = $(this).attr('name').match(/\d+/g);
                            $(this).val(paramsvalue[tmpid[0]]);
                        })
                    }

                } else
                {
                    $('#param').html('<div> </div>');
                    standardparams = 1;//标准名称参数为空
                }
            }
        });
    });
//     //添加车系
//     var caridobj={};
//     var modelobj={};
//     $('#addVehcle').click(function(){
//         $.messager.alert('提示信息','功能未开放,数据采集中...敬请期待！','info');
//         return false;
//         var makeval =  $("#front_make").val();
//         var carval =  $("#front_series").val();
//         var yearval =  $("#front_year").val();
//         var modelval =  $("#front_model").val();
//         //文本
//         var make=$('#front_make').find('option:selected').text();
//         var car=$('#front_series').find('option:selected').text();
//         var year=$('#front_year').find('option:selected').text();
//         var model=$('#front_model').find('option:selected').text();
//         if(make=='请选择厂家')
//         {
//             $.messager.alert('提示信息','请选择厂家','info');
//             return false;
//         }
//         else if(car=='请选择车系')
//         {
//             $.messager.alert('提示信息','请选择车系','info');
//             return false;
//         }
//         else if(year=='请选择年款')
//         {
//             $.messager.alert('提示信息','请选择年款','info');
//             return false;
//         }
//         else if (model=='请选择车型')
//         {
//             $.messager.alert('提示信息','请选择车型','info');
//             return false;
//         }else if(caridobj[makeval+carval])
//         {
//             $.messager.alert('提示信息','该车系已经存在','info');
//             if(yearval!='ALL'&& modelval!='ALL')
//             {
//                 var url=Yii_baseUrl+'/maker/makegoods/addfrontmodel';
//                 $.getJSON(url,{year:yearval,model:modelval},function(data){
//                     if(data)
//                     {
//                         var html='';
//                         html +="<span class=' bg-green' modelid='"+year+modelval+"' style='cursor:pointer;float:left'><span class='year' >"+data.year+"</span>_<span class='"+modelval+"'>"+data.model+"</span><span id='close' class='close icon-close-green'></span></span>";
//                         $('#frontmodel').append(html);
//                     }
//                 });
//             }
//             return false;
//         }
//         else
//         {

//             var span = '';
//             span += "<span carid='"+makeval+carval+"' class='checkbox-add bg-green tag-close catespan' style='float:left;cursor:pointer' id='a"+carval+"' ><span name='make'>"+make+"</span>_<span name='car'>"+car+"</span></span> ";
//             $("#showVehicle").append(span); 
//             caridobj[makeval+carval]=true;
//             if(yearval!='ALL'&& modelval!='ALL')
//             {
//                 var url=Yii_baseUrl+'/maker/makegoods/addfrontmodel';
//                 $.getJSON(url,{year:yearval,model:modelval},function(data){
//                     if(data)
//                     {
//                         var html='';
//                         html +="<span class=' bg-green' modelid='"+year+modelval+"'  style='cursor:pointer;float:left'><span class='year' >"+data.year+"</span>_<span class='"+modelval+"'>"+data.model+"</span><span id='close' class='close icon-close-green'></span><span id='close' class='close icon-close-green'></span></span>";
//                         $('#frontmodel').append(html);
//                     }
//                 });
//                 modelobj[year+modelval]=true;
//             }

//         }
//     });
//     //前市场
//     $('#showVehicle').hover(function(){
//         $('#frontmodel').show();
//     });
//     $('#frontmodel').click(function(){
//         $('#frontmodel').hide();
//     });
//     //选择前市场车型后带出后市场车系
//     $('#front_model').change(function(){
//         var modelval=$(this).val();
//         var carval=$('#front_series').val();
//         if(modelval=='')
//         {
//             return false;
//         }
//         var url=Yii_baseUrl+'/maker/makegoods/getbcar';
//         $.ajax({
//             url: url,
//             type:'POST',
//             data:{
//                 modelID:modelval,
//                 carID:carval
//             },
//             dataType:'json',
//             success:function(data)
//             {
//                 if(data && data[0] != undefined )
//                 {
//                     var html='';
//                     html += "<option value="+data[0].alias+">"+data[0].alias+"</option>"
//                     $('#bcar').html(html);
//                 }else
//                 {
//                     var html='';
//                     html += "<option value="+data.alias+">"+data.alias+"</option>"
//                     $('#bcar').html(html);
//                 }
//                 $('#bcar').change();
//             }
//         });
//     });
//     //后市场车系改变，显示在框中
//     $('#bcar').change(function(){
//         return false;
//         var alias=$(this).val();

//         var url=Yii_baseUrl+'/maker/makegoods/allfrontcar';
//         $.ajax({
//             url: url,
//             type: 'POST',
//             data:{
//                 alias:alias
//             },
//             dataType:'json',
//             success:function(data)
//             {
//                 if(data)
//                 {
//                     var html='';
//                     html +="<span class='checkbox-add bg-green tag-close catespan'  id='showbcar' style='cursor:pointer'><span class='make' >"+data.make+"</span>_<span class='carval'>"+data.car+"</span></span>";
//                     html +="<input type='hidden' name=alias>";
//                     $('#bacvehicle').html(html);
//                     $('#pa').hide();
//                 }
//             }
//         });
//     });
//     //点击框中的后市场车系，出现所有车型
//     $('#bacvehicle').hover(function(){
//         var alias=$('#bcar').val();
//         $("#pa").show();
//         var url=Yii_baseUrl+'/maker/makegoods/showallmodel';
//         $.ajax({
//             url:url,
//             type:'POST',
//             data:{
//                 alias:alias
//             },
//             dataType:'json',
//             success:function(data)
//             {
//                 if(data)
//                 {
//                     var html='';
//                     $.each(data,function(key,value){
//                         html +="<span class='checkbox-add bg-green tag-close catespan'  style='cursor:pointer;float:left'><span class='year' >"+value.year+"</span>_<span class='carval'>"+value.model+"</span></span>";
//                     });
//                     $('#pa').html(html);
//                 }
//             }
//         });

//     });
//     $('#pa').click(function(){
//         $('#pa').hide();
//     })
//     $('#front_select').click(function(){
//         $('#back_select').attr('checked',false);
//         //后市场按钮失效
//         $('#bcar').attr('disabled',true);
//         $("#front_make").attr('disabled',false);
//         $("#front_series").attr('disabled',false);
//         $("#front_year").attr('disabled',false);
//         $("#front_model").attr('disabled',false);
//     });
//     //选择后市场车系
//     $('#back_select').click(function(){
//         //前市场不被选中
//         $('#front_select').attr('checked',false);
//         //后市场下拉框有效
//         $('#bcar').attr('disabled',false);
//         //前市场车系按钮失效
//         $("#front_make").attr('disabled',true);
//         $("#front_series").attr('disabled',true);
//         $("#front_year").attr('disabled',true);
//         $("#front_model").attr('disabled',true);

//         var url=Yii_baseUrl+'/maker/makegoods/allbcar';
//         $.ajax({
//             url:url,
//             type:'POST',
//             data:{},
//             dataType:'json',
//             success:function(data)
//             {
//                 if(data)
//                 {
//                     var html="<option value=''>请选择车系</option>";
//                     $.each(data,function(ke,ve){
//                         html+="<option value="+ve+">"+ve+"</option>";
//                     });
//                     $('#bcar').html(html);
//                 }
//             }
//         })
//     });

    //添加修改弹窗关闭事件
//    $('#makegoodactive').dialog({
//        onClose:function()
//        {
//            $('#param').html('');
//            $('#fm_add').form('clear');
//            $('#front_select').attr('checked',true);
//            $('select[name="inventory"]').val('1');
//            //$('#GoodsBrand option:eq(0)').attr("selected",true);
//            $('#GoodsCategory').val('');
//            $('#GoodsBrand').val('');
//        }
//    })
    function clear()
    {
        $('#param').html('');
        $('#fm_add').form('clear');
        $('#front_select').attr('checked', true);
        $('select[name="inventory"]').val('1');
        //$('#GoodsBrand option:eq(0)').attr("selected",true);
        $('#GoodsCategory').val('');
        $('#GoodsBrand').val('');
    }
    
    //ie中限定textarea长度
    $('#textdesc').keyup(function(){
        if(this.value.length>200)
        {
            this.value=this.value.substring(0,200);
        }    
    })

    $.extend($.fn.validatebox.defaults.rules, {
        //验证报价
        price: {
            validator: function(value, param) {
                var bool = false;
                if (value > 9999999.99 && $.isNumeric(value))
                {
                    $.fn.validatebox.defaults.rules.price.message = '价格应该小于 9999999.99';
                    bool = false;
                }
                else
                {
                    bool = /^[1-9]\d*\.\d{1,2}$|0\.\d{1,2}$|^[1-9]\d*$|^0$/.test(value);
                    $.fn.validatebox.defaults.rules.price.message = '至多保留小数点后两位';
                }
                return bool;
            },
            message: ''
        },
        //验证报价
        znumber: {
            validator: function(value, param) {
                return /^[1-9]\d*$/.test(value);
            },
            message: '请输入正整数;如:120'
        },
        dataexist: {
            validator: function(value, param) {
                return value != param[0]
            },
            message: '此商品编号已存在'
        }
    });
</script>