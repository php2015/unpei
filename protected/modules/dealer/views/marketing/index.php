<?php
$controlerId = Yii::app()->getController()->id;
 $actionId = $this->getAction()->getId();
$active = "class = 'active'";
?>
<style>
    .form-row select{ margin-right: 10px;}
      
</style>
<div class="content2">

    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a <?php if ($actionId == "index" || 'recomupload') echo $active ?> href="<?php echo Yii::app()->createUrl("dealer/marketing/index") ?>">商品管理</a>
    </div>
    <!-- 下载模板 上传 -->    
</div>
<div>
    <div id="toolbar">
        <p class="form-row">
        <div style="margin-left:10px;">
            <form action="<?php echo Yii::app()->createUrl('dealer/marketing/recomupload'); ?>" method="post" enctype="multipart/form-data">
                <div class='btn-green'><a class="btn-green" href="<?php echo Yii::app()->theme->baseUrl; ?>/template/dealergoods.xls">下载模板</a></div>
                <!--			<div class='btn-green'>上传</div>-->
                &nbsp;&nbsp;<label class='label'>选择文件：</label>
                <span class='width180 inputfile-input input'>
                    <input type="hidden" name="leadExcel" value="true">
                    <input type="file" name="inputExcel"  class="easyui-validatebox" >
                </span>
                <input class='submit' type='submit' value='上传'>
            </form>
        </div>
        </p>
        <div class="error-msg" style="border:0px;display: none;">
            <?php echo $message; ?>
        </div>
        <p class="form-row">
            &nbsp;&nbsp;商品编号: <input class="width98 input" name="goodsNO">&nbsp;&nbsp;
            商品名称: <input class="width98 input" name="goodsName">&nbsp;&nbsp;
            OE号: <input class="width98 input" name="OENO">&nbsp;&nbsp;
            是否上架: 
            <select name="IsSale" class="select">
                <option value="">全部</option>
                <option value="1">上架</option>
                <option value="2">下架</option>
            </select>

 <!--<input class='submit ml10' type='submit' id="search-btn" value='查询'>-->
        </p>
        <p class="form-row">
            <label>&nbsp;&nbsp;配件品类:</label>
            <input id="cpname-search" name="CpNameTxt1" class=" input width260" type="text" value="" style="width:286px;">
            <span id="helpcate2" ><img src="<?php echo F::themeUrl() ?>/images/help.png" style=" margin-left:0px;  margin-top: 0px;cursor: pointer"></span>
            <?php // $this->widget('widgets.default.WGcategory', array('scope' => 'select')); ?>
        </p>
        <p class="form-row">
            &nbsp;&nbsp;<label>适用车系:</label>
            <?php // $this->widget('widgets.default.WFrontModel', array('scope' => 'select')); ?>
            <?php $this->widget('widgets.default.WGoodsModel', array('scope' => 'select', "notlink" => 'N')); ?>
            <!--<a href="javascript::;" class="easyui-linkbutton" iconCls="icon-search" id="search-btn">查询</a>-->
            <a id="search-btn" class="btn-green" href="javascript:;;">查询</a>
        </p>
<!--        <p class="form-row">-->
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newGoods()">添加</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editGoods()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyGoods()">删除</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="upSale()">上架</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="downSale()">下架</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="uploadimgs()">批量上传图片</a>
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="DataExport()">导出</a>-->
        <!--</p>-->

    </div>
    <?php  $this->renderPartial('index-tabs'); ?>
    <?php  $this->renderPartial('uploadimg'); ?>
</div>

<?php   $this->renderPartial('add_goods'); ?>
<?php $this->widget('widgets.default.WGoodsCategoryModel'); ?>
<?php $this->widget('widgets.default.WHelpGoodsCategory'); ?>
<script type="text/javascript">
    $(function(){
        // 打开配件品类指引
        $("#helpcate2").click(function(){
            cpname_search = true;
            $("#seach-cxjg").empty();
            $("#seach-cxjg").append('<span class="lm1a">大类》子类》标准名称</span>');
            $("#cpname_value").val('标准名称/拼音首字母');
            $("#help_category").parent('div').addClass('help_category');
            $("#help_category").dialog('open').dialog('setTitle','标准名称选择指引');
        });
        
        // 点击输入框弹出div层
        $("#cpname-search").click(function(e){
            cpname_search = true;
            e.stopPropagation();
            //alert(1234);
            cpnametxt ='';
            $("#cpname-search").val(cpnametxt);
            var offset = $(this).offset();
            var left, top,url,data;
            if(typeof(countSelf) == 'undefined'){
                left = offset.left + 'px';
                top = offset.top +26 + 'px';
            }
            else{
                var width = $(window).width();
                //屏幕宽度大于1000
                if( width> 1000){
                    var cutwidth =  (width - 1000)/2 + 230;
                }else{
                    cutwidth = 230;
                }
                
                left = (offset.left -cutwidth) + 'px';
                top = (offset.top +26 -110) + 'px';
            }
            // alert(offset.left);
            $("#selectBig").css({ 'left':left, 'top':top }).show();
            $("#ul-bigcate li:first").click();
            $("#make-car-m").hide();
        });
        
        // 点击上传按钮
        $("input[type=submit]").click(function(){
            var excel = $("input[name=inputExcel]").val();
            if(!excel){
                $.messager.show({
                    "title":"提示",
                    "msg":"请选择上传文件"
                })
                return false;
            } else{
                $(".submit").submit();
            }
        })
        
        // 
        $("#goodsBrand").change(function(){
            var brand = $("#goodsBrand :selected").text();
            // alert(brand);
            $("input[name=brandID]").val(brand);
        })
        
        $("#search-btn").click(function(){
            var url = Yii_baseUrl + '/dealer/marketing/getgoods';
            var goodsNO = $("input[name=goodsNO]").val();
            var goodsName = $("input[name=goodsName]").val();
            var OENO = $("input[name=OENO]").val();	
            var IsSale = $("select[name=IsSale]").val();	
            //var mainCategoryselect = $("select[name=mainCategoryselect]").val();	
            // var subCategoryselect = $("select[name=subCategoryselect]").val();	
            // var leafCategoryselect = $("select[name=leafCategoryselect]").val();	
            var leafCategoryselect = $("#cpname-search").val();
            var gmake = $("#select_make").val();    	
            var gcar = $("#select_series").val();	
            var gyear = $("#select_year").val();	
            var gmodel = $("#select_model").val();	
            // var MemberStatus = $("#MemberStatus").val();	
            //alert(IsAccount);
            $('#dg').datagrid({ url:url,queryParams:{
                    'goodsNO':goodsNO,
                    'goodsName':goodsName,
                    'OENO':OENO,    	
                    'IsSale':IsSale,    	
                    //'gbigparts':mainCategoryselect,    	
                    //'gsubparts':subCategoryselect,    	
                    //'gcpname':leafCategoryselect,    	
                    'gcpnametxt':leafCategoryselect,    	
                    'gmake':gmake,
                    'gcar':gcar,
                    'gyear':gyear,
                    'gmodel':gmodel
                },method:"get"});
        });		
    })
    // 上架
    function upSale()
    {
        //var row = $('#dg').datagrid('getSelected');
        var ids = [];
        var row = $('#dg').datagrid('getSelections');
        for(var i=0; i<row.length; i++){
            if(row[i].IsSale == '已上架'){
                $.messager.alert('提示信息','有商品已上架','warning');
                return false;
            }else{
                ids.push(row[i].ID);
            }
        }
        // alert(ids);
        if (row.length > 0){
            //            if(row.IsSale == '已上架'){
            //                $.messager.alert('提示信息','该商品已上架','warning');
            //                return false;
            //            }
            //console.log(row.ID)
            $.messager.confirm('提示信息','你确定要把选中的商品上架吗？',function(r){
                if (r){
                    var url = Yii_baseUrl+"/dealer/marketing/upsale";
                    $.post(url,{id:ids.join(',')},function(result){
                        if (result.success){
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                            $('#dg').datagrid('reload'); // reload the user data
                            $('#dg').datagrid('unselectAll');
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
    
    // 下架
    function downSale(){
        var ids = [];
        var row = $('#dg').datagrid('getSelections');
        for(var i=0; i<row.length; i++){
            if(row[i].IsSale == '已下架'){
                $.messager.alert('提示信息','有商品已下架','warning');
                return false;
            }else{
                ids.push(row[i].ID);
            }
        }
       
        if (row.length >0){
            //            if(row.IsSale == '已下架'){
            //                $.messager.alert('提示信息','该商品已下架','warning');
            //                return false;
            //            }
            //console.log(row.ID)
            $.messager.confirm('提示信息','你确定要把选中的商品下架吗？',function(r){
                if (r){
                    var url = Yii_baseUrl+"/dealer/marketing/downsale";
                    $.post(url,{id:ids.join(',')},function(result){
                        if (result.success){
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                            $('#dg').datagrid('reload'); // reload the user data
                            $('#dg').datagrid('unselectAll');
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
    // var msg = $(".error-msg").text().trim();
    var msg = $(".error-msg").text();
    msg = $.trim(msg)//;$(".error-msg").text().trim();
    // alert(msg.length);
    //console.log(msg);
    if(msg.length > 0){
        // alert(123);
        //  setTimeout("window.location = Yii_baseUrl+'/partner/partner/recommendlist';", 2000);
        // $.message.alert('提示信息',msg,'error');
        $.messager.show({
            title: '提示信息',
            msg: "<span color='red'>"+msg+"</span>"
        });
        //alert(msg);
        //window.location = Yii_baseUrl+'/partner/partner/recommendlist';
    }
    function uploadimgs()
    {
        afterSave();
        $('#uploadimg').dialog('open').dialog('setTitle','商品图片批量上传');
    }
</script>

<script>
    $(function(){
        
        $("input[type='file']").live('change',function(){
            var inputfile = $(this).closest('.inputfile');
            if(inputfile.length!=0){
                var after = $(inputfile).nextAll('span');
                after.length>0 && after.remove();
                $(inputfile).after('<span style="margin-left:5px;">'+$(this).val()+'</span>')
            }else{
                var inputfile_input = $(this).closest('.inputfile-input');
                if(inputfile_input.length==0){
                    return;
                }
                var before = $(this).prevAll('span');
                before.length>0 && before.remove();
                $(this).before('<span style="margin-left:5px;">'+$(this).val()+'</span>')
            }
        }); 
    })
</script>
