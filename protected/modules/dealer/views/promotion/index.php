<?php
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
?>
<div class="content2">
    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a <?php if ($actionId == "index") echo $active ?> href="<?php echo Yii::app()->createUrl("dealer/promotion/index") ?>">促销商品管理</a>
    </div>
    <!-- 下载模板 上传 -->    
</div>
<div>
    <table class='nocss'>
        <tr class='lh22'>
            <td><strong>我的促销商品：</strong></td>
            <td width='220'>最多只能添加<strong class="f18 font-green">50</strong>个促销商品</td>
            <td width='220'>已添加促销商品数：<strong class='f18 font-green daagoods'><?php echo $progoods ?></strong> 个</td>
            <td width='220'>还可添加促销商品数：<strong class='f18 font-green blance' ><?php echo 50 - $progoods ?></strong> 个</td>

            <th></th>
        </tr>
    </table>
</div>
<div class="easyui-layout"  id="jp-layout" style="height:500px" >
    <table id="dg"  class="easyui-datagrid" style="height:500px"
           data-options='url:"<?php echo Yii::app()->createUrl('dealer/promotion/getprogoods') ?>",
           region:"center",
           toolbar:"#toolbar",
           method: "get",
           rownumbers:true,
           fitColumns:false,
           singleSelect:true ,
           pagination:false,
           pageSize:50,
           onClickCell: onClickCell'
           >
        <thead>
            <tr>    
                <!--<th data-options="field:'ID',checkbox:true"></th>-->
                <th field="Name" width="180" >商品名称</th>    
                <th field="GoodsNO" >商品编号</th>    
                <th field="Pinyin" width="120">拼音代码</th>    
                <th field="proTime" width="150">促销时间</th>    
                <th field="Price" align="left">参考价</th>    
                <!--<th field="ProPrice" width="100" align="left">促销价</th>-->    
                <!--<th field="ProPrice" width="100" editor="{type:'numberbox',options:{validType:'number',validtype='floatnum'required:true}}">促销价</th>-->
                <th data-options="field:'ProPrice', styler:cellStyler,width:80,align:'right',editor:{type:'numberbox',options:{validtype:'floatnum',precision:2,required:true}}">促销价</th>    
                <th field="OENO"  align="left">OE号</th>    
                <!--<th field="PartsLevel"  align="center">档次</th>-->
                <th field="goodsBrand" align="left">品牌</th>    
                <th field="CpName"  align="left">配件品类</th>    
<!--                <th field="sutecar" align="left">适用车系</th>    -->
                <!--<th field="Memo" width="100" align="left">备注</th>-->    
            </tr>    
        </thead>
    </table>
</div>
<style>
    .nopgoodsdiv{ width: 500px; height:auto; position: absolute; z-index: 100; float: left; display:none;left:68px; top:95px; border: 1px solid #DEDEDE;}
</style>
<div class="nopgoodsdiv">
    <table id="nopgoods"   class="easyui-datagrid" style="height:300px; z-index: 200; "
           data-options='url:"<?php echo Yii::app()->createUrl('dealer/promotion/getnoprogoods') ?>",
           region:"center",
           rownumbers:true,
           fitColumns:false,
           method: "get",
           singleSelect:false,
           pagination:true,
           pageSize:10,'
           >
        <thead>
            <tr>    
                <th data-options="field:'ID',checkbox:true"></th>
                <th field="Name" >商品名称</th>    
                <th field="GoodsNO" >商品编号</th>    
                <th field="Pinyin" width="100">拼音代码</th>    
                <th field="OENO"  align="left">OE号</th>    
                <th field="PartsLevel"  align="center">档次</th>    
                <th field="Price" align="left">参考价</th>    
                <th field="goodsBrand" align="left">品牌</th>    
                <th field="CpName"  align="left">配件品类</th>
            </tr>    
        </thead>
    </table>
</div>
<div id="toolbar">
    <p class="form-row">
        <label>选择商品：</label>
        <input type="text" id="noPgoodsID" class="input " style="width:200px;">
        <input type="button" id="addprogoods" value="添加" class="btn">
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyGoods()">删除</a>-->
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="cancelGoods()">取消促销</a>
    </p>
</div>


<?php // $this->renderPartial('add_recom'); ?>


<script type="text/javascript">
    $.extend($.fn.datagrid.methods, {
        keyCtr : function (jq) {
            return jq.each(function () {
                var grid = $(this);
                grid.datagrid('getPanel').panel('panel').attr('tabindex', 1).bind('keydown', function (e) {
                    switch (e.keyCode) {
                        case 38: // up
                            var selected = grid.datagrid('getSelected');
                            if (selected) {
                                var index = grid.datagrid('getRowIndex', selected);
                                grid.datagrid('selectRow', index - 1);
                            } else {
                                var rows = grid.datagrid('getRows');
                                grid.datagrid('selectRow', rows.length - 1);
                            }
                            break;
                        case 40: // down
                            var selected = grid.datagrid('getSelections');
                            //  $('#nopgoods').datagrid('getSelections');
                            if (selected) {
                                var index = grid.datagrid('getRowIndex', selected);
                                //  console.log(index);
                                var len =  selected.length;
                                grid.datagrid('selectRow', len+0);
                            } else {
                                grid.datagrid('selectRow', 0);
                            }
                            break;
                    }
                });
            });
        }
    });
    $("#nopgoods").datagrid({}).datagrid("keyCtr");

    
    $(function(){
        $("#noPgoodsID").click(function(){
            $(".nopgoodsdiv").show();
            $("#nopgoods").show();
            var url = Yii_baseUrl + '/dealer/promotion/getnoprogoods';
            $('#nopgoods').datagrid({ url:url,queryParams:{
                },method:"get"});
            //alert($("#goodsID").val());
        });
        $(".nopgoodsdiv").click(function(e) {
            e.stopPropagation();
            $(".nopgoodsdiv").show();
        });
        $(".datagrid-view").click(function() {
            if ($(".nopgoodsdiv").css("display") =='block') {
                $(".nopgoodsdiv").hide();
                // alert($(".nopgoodsdiv").css("display"));
            }
        });
        $("#noPgoodsID").keydown(function(){
            var thisValue = $(this).val();
            var event = arguments.callee.caller.arguments[0] || window.event;
            if(event.keyCode == 13){//判断是否按了回车，enter的keycode代码是13，想看其他代码请猛戳这里。
                //  alert(thisValue);
                var url = Yii_baseUrl + '/dealer/promotion/getnoprogoods';
                $('#nopgoods').datagrid({ url:url,queryParams:{
                        'thisValue':thisValue
                    },method:"get"});
            }
        })
        
        //        $('#noPgoodsID').blur(function(){
        //            var thisValue = $(this).val();
        //            var url = Yii_baseUrl + '/dealer/promotion/getnoprogoods';
        //            $('#nopgoods').datagrid({ url:url,queryParams:{
        //                    'thisValue':thisValue
        //                },method:"get"});
        //        });
        
        $("#addprogoods").click(function(){
            //  var ID = $('#goodsID').combogrid('getValues'); 
            var rows = $('#nopgoods').datagrid('getSelections');
            var ids = [];
            for(var i=0; i<rows.length; i++){
                ids.push(rows[i].ID);
            }
            if(ids.length == 0){
                $.messager.show({
                    title: '提示信息',
                    msg: '您还未勾选商品'
                });
                return false;
            }
            var len = ids.length;               // 选择的商品数
            var blance = $(".blance").text(); // 还可以添加促销商品的个数
            var data = '';
            if(blance >= len){
                data = ids.join(',');
            }else{
                var tempID = [];
                for(var i = 0; i<blance;i++){
                    tempID.push(ids[i]);
                }
                $.messager.show({
                    title: '提示信息',
                    msg: "最能只能添加"+blance+"个促销商品！"
                });
                data= tempID.join(',');
            }
            var url = Yii_baseUrl +"/dealer/promotion/addpromotion"
            $.getJSON(url,{IDs:data},function(result){
                if(result.success ==1){
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                    $('#dg').datagrid('reload');
                    $('#nopgoods').datagrid('reload');
                    // window.location.reload();
                    
                    $(".daagoods").text(result.procount);
                    var blance = 50-eval('('+result.procount+')');
                    $(".blance").text(blance);
                    // setTimeout("window.location.reload();",200); //指定1秒刷新一次
                    // $("#goodsID").combogrid("clear");  
                    // $('#goodsID').combogrid('grid').datagrid('reload');
                }else{
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                }
            })
        });
    })
    
        
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
    function cancelGoods(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            //console.log(row.ID)
            $.messager.confirm('提示信息','你确定要取消促销吗？',function(r){
                if (r){
                    var url = Yii_baseUrl+"/dealer/promotion/cancelpro";
                    $.post(url,{id:row.ID},function(result){
                        if (result.success){
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                            $('#dg').datagrid('reload'); // reload the user data
                            //  var goodscount = $("#dg").datagrid("getRows").length;
                            $(".daagoods").text(result.procount);
                            var blance = 50-eval('('+result.procount+')');
                            $(".blance").text(blance);
                            //setTimeout("window.location.reload();",500);
                            //  $('#goodsID').combogrid('grid').datagrid('reload');
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
    
   
    function cellStyler(value,row,index){
        if (!value){
            return 'background-color:#FAFAD2;';
        }
    }
</script>

<script type="text/javascript">

    $.extend($.fn.datagrid.methods, {
        editCell: function(jq,param){
            return jq.each(function(){
                var opts = $(this).datagrid('options');
                var fields = $(this).datagrid('getColumnFields',true).concat($(this).datagrid('getColumnFields'));
                for(var i=0; i<fields.length; i++){
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor1 = col.editor;
                    if (fields[i] != param.field){
                        col.editor = null;
                    }
                }
                $(this).datagrid('beginEdit', param.index);
                for(var i=0; i<fields.length; i++){
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor = col.editor1;
                }
            });
        }
    });

    var editIndex = undefined;
    var editfield = undefined;
    function endEditing(){

        if (editIndex == undefined){
            return true
        }
        if ($('#dg').datagrid('validateRow', editIndex)){
            $('#dg').datagrid('endEdit', editIndex);
            editIndex = undefined;
            //	console.log($('#dg').datagrid('getSelected'));
			
            if(saveChanges()){
                return true;
            }else{
                return false;
            }
		
        } else {
            return false;
        }
    }
    function onClickCell(index, field , value){
        if (endEditing()){
            $('#dg').datagrid('selectRow', index).datagrid('editCell', {index:index,field:field});
            var rs = $('#dg').datagrid('getSelected');
            //           if(value>rs.Price){
            //             //   var ed = $('#dg').datagrid('getEditor', { index: index, field:field }).target().focus();
            ////            $(ed.target).focus().bind('blur', function () {
            ////                endEditing();
            ////            });
            //
            //            return false;
            //           }
            editIndex = index;
            editfield = field;
        }
    }
    function saveChanges(){
        var rs = $('#dg').datagrid('getSelected');
        // alert(rs.Price)
        var changes = eval("rs."+editfield);
        var url = Yii_baseUrl+"/dealer/promotion/savecell";
        if(editfield == "ProPrice"){
            changes = eval(changes);
            var price = rs.Price;
            price = eval(price);
            if(changes > 0){
                if(price >= changes){ // 促销价必须小于等于参考价
                    $.getJSON(url,{ID:rs.ID,fieldName:editfield,change:changes},function(data){
                        if(data){
                            $("#dg").datagrid("reload");
                            return true;
                        }else{
                            return false;
                        }
                    });
                }else{
                    $.messager.alert('提示信息','促销价必须小于等于参考价，点击重新修改！','warning');
                    $('#dg').datagrid('rejectChanges');
                    editIndex = undefined;
                    return false;
                }
            }else{
                $.messager.alert('提示信息','促销价不能小于 0，点击重新修改！','warning');
                $('#dg').datagrid('rejectChanges');
                editIndex = undefined;  
                return false;
            }
                
        }
       
       
    }

</script>