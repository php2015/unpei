<!--                <label>主营品牌</label>-->
<table id="dg"  class="easyui-datagrid" style="height:350px"
       data-options='url:"<?php  echo Yii::app()->createUrl('dealer/marketing/getbrand') ?>",
       region:"center",
       toolbar:"#toolbar" ,
       rownumbers:true,
       fitColumns:false,
       singleSelect:true,
       method:"get",
       pagination:true'
       >
    <thead>
        <tr>   
            <th field="BrandName" width="100">品牌名称</th>    
            <th field="Pinyin" width="100">拼音代码</th>    
            <th field="goodsCount" width="100" align="left">商品数</th>    
            <th field="description" width="350">品牌描述</th>    

        </tr>    
    </thead>
</table>
<div id="toolbar">
    <label class="label" style="color:#676767;margin-left: 12px;">主营品牌：</label>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newBrand()">添加</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editBrand()">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyBrand()">删除</a>
</div>
<div id="dlgbrand" class="easyui-dialog" title="添加主营品牌" data-options="iconCls:'icon-save', 'closed':true,'modal':true" style="width:420px;height:240px;padding:10px">
    <form id="fbrand" method="post">
        <p class="form-row">
            <label>品牌名称：</label>
            <!--<input class="easyui-validatebox input" type="text" name="BrandName" data-options="required:true">-->
            <input id="BrandName" type="text" name="BrandName" class="width213 input">
        </p>
        <div class="display-n showbrand" id="showbrand">
            <table id="tablebrand" style="width:300px">
                <thead>
                    <tr>
                        <th align="left">
                            <!--<input type="checkbox" name="checkAll" id="checkAll">-->
                        </th>
                        <th align="left">品牌</th>
                        <th align="left">拼音代码</th>
                        <th align="left">描述</th>
                    </tr>
                </thead>
                <tbody id="tbody2">
                </tbody>
            </table>
        </div>
        <p class="form-row">
            <label>拼音代码：</label>
            <input class="easyui-validatebox input" type="text" name="Pinyin" data-options="required:true">
        </p>
        <p class="form-row">
            <label>描&nbsp;&nbsp;&nbsp;&nbsp;述：</label>
            <textarea name="description" style="height:40px; width: 300px;"></textarea>
        </p>
        <div id="dlg-buttons" style="float:right; margin-right: 30px;">
            <input type="button" class="btn" onclick="saveBrand()" value="保存" style="color:#333;font-size:13px;">
            <input type="button" class="btn" onclick="$('#dlgbrand').dialog('close');$('#fbrand').form('clear');" value="取消" style="color:#333;font-size:13px;">
        </div>
    </form>
</div>
<script type="text/javascript">
  
    var url;
    function newBrand(){
        $('#dlgbrand').dialog('open').dialog('setTitle','添加主营品牌');
        $('#fbrand').form('clear');
        url = Yii_baseUrl+"/dealer/marketing/addbrand";
    }
    function editBrand(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#dlgbrand').dialog('open').dialog('setTitle','添加主营品牌');
            $('#fbrand').form('load',row);
            url =Yii_baseUrl+"/dealer/marketing/updatebrand/id/"+row.ID;
        }else{
            $.messager.alert('提示信息','您还没有选择数据！','error');
        }
    }
    function saveBrand(){
        $('#fbrand').form('submit',{
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
                    $('#dlgbrand').dialog('close'); // close the dialog
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
    
    function destroyBrand(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            if(row.goodsCount != 0){
                $.messager.alert('温馨提示', '该品牌下有商品不能删除！', 'warning');
                return false;
            
            }
            //console.log(row.ID)
            $.messager.confirm('提示信息','你确定要把选中的这条数据删除吗？',function(r){
                if (r){
                    var url = Yii_baseUrl+"/dealer/marketing/deletebrand";
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
</script>
<script>
    $(function(){
        
        $("#BrandName").click(function(){
            var x=$(this).offset();
            var brand ='';
            $("#tbody2").empty();
            //alert(x.top)
            var url = Yii_baseUrl +"/dealer/marketing/searchbrand";
            $.getJSON(url,{brand:brand},function(result){
                $("#showbrand").css({
                    "display":'block',
                    "background-color":"#fff",
                    'left':'80px',
                    'top':'74px'
                });
                $.each(result,function(index,value){
                    var tr= " <tr><td><input type='radio' name='checkbrand' value="+value.BrandName+","+value.Pinyin+"></td>"+
                        "<td>"+value.BrandName+"</td><td>"+value.Pinyin+"</td><td>"+value.description+"</td></tr>";
                    $("#tbody2").append(tr);
                })
            });
        });
        // 品牌检索
        $("#BrandName").keydown(function(){
            var event = arguments.callee.caller.arguments[0] || window.event;
            var x=$(this).offset();
            var brand = $("#BrandName").val();
            $("#tbody2").empty();
            //parseInt(x.left)+'---'+parseInt(x.top)
            var url = Yii_baseUrl +"/dealer/marketing/searchbrand";
            if(event.keyCode == 13){
                $.getJSON(url,{brand:brand},function(result){
                    if(result.length<=0){
                        //  $.messager.alert('提示信息','不存在是否添加');
                        $.messager.confirm('提示信息', '输入的品牌不是认证品牌是否继续添加', function(r){  
                            if (r){  
                            }  
                        });  
                        $("#showbrand").css({"display":'none'});
                        return false;
                    }
                    $("#showbrand").css({
                        "display":'block',
                        "background-color":"#fff",
                        'left':'80px',
                        'top':'74px'
                        // 'left':(x.left-424)+"px",
                        //  'top':(x.top-15) +"px"
                    });
                    $.each(result,function(index,value){
                        var tr= " <tr><td><input type='radio' class='inputcheck' name='checkbrand' value="+value.BrandName+","+value.Pinyin+"></td>"+
                            "<td>"+value.BrandName+"</td><td>"+value.Pinyin+"</td><td>"+value.description+"</td></tr>";
                        $("#tbody2").append(tr);
                    })
                });
            }
        });
         $("#BrandName").change(function(){
            var x=$(this).offset();
            var brand = $("#BrandName").val();
            $("#tbody2").empty();
            //parseInt(x.left)+'---'+parseInt(x.top)
            var url = Yii_baseUrl +"/dealer/marketing/searchbrand";
                $.getJSON(url,{brand:brand},function(result){
                    if(result.length<=0){
                        //  $.messager.alert('提示信息','不存在是否添加');
                        $.messager.confirm('提示信息', '输入的品牌不是认证品牌是否继续添加', function(r){  
                            if (r){  
                                //$("#fbrand input[name=BrandName]").val(brand);
                                //$('#dlgbrand').dialog('open');
                            }  
                        });  
                        $("#showbrand").css({"display":'none'});
                        return false;
                    }
                    $("#showbrand").css({
                        "display":'block',
                        "background-color":"#fff",
                        'left':'70px',
                        'top':'74px'
                        // 'left':(x.left-424)+"px",
                        //  'top':(x.top-15) +"px"
                    });
                    $.each(result,function(index,value){
                        var tr= " <tr><td><input type='radio' class='inputcheck' name='checkbrand' value="+value.BrandName+","+value.Pinyin+"></td>"+
                            "<td>"+value.BrandName+"</td><td>"+value.Pinyin+"</td><td>"+value.description+"</td></tr>";
                        $("#tbody2").append(tr);
                    })
                });
           
        });
        $("input[name=checkbrand]").live('change',function(){
            // var chek = $("input[name=checkbrand] :checked").val()
            var s = '';
            $('input[name="checkbrand"]:checked').each(function(){
                s=$(this).val().split(",");
            }); 
           // $("#showbrand").css({"display":'none'});
           if(s[0]){
             $(this).mouseout(function(){$("#showbrand").hide()})
           }
           // 
        //alert(123);
            var brand = $("#BrandName").val();
            if(brand){
                brand = brand;
            }
            $("#BrandName").val(s[0]);
            $("input[name=Pinyin]").val(s[1]);
            //$("#BrandName").val(brand+chek);
        });
        
          $(".inputcheck").live('change',function(){
               $("#showbrand").hide();
             //  alert(123);
          })
           
        $("#showbrand").click(function(e) {
            e.stopPropagation();
            $("#showbrand").show();
        });
        $("#dlgbrand").click(function() {
            if ($("#showbrand").css("display") =='block') {
                $("#showbrand").hide();
            }
        });

    })
</script>