<style>
    .jCarouselLite 
    {
        border:1px solid black;
        background-color:#D8D8D8
    }
    .jCarouselLite li
    {
        padding:5px 10px 5px 10px;
    }
</style>
<!--商品详情弹框开始-->
<div id="detaildg" class="easyui-dialog" style="width:800px;height:640px;padding:10px"   modal="true" closed="true" buttons="#detail-buttons">
    <fieldset class="test"> 
        <legend>版本信息</legend> 
        <p class="form-row" style="padding-left:20px; width: 200px;float:left" >
            <label>版本信息:</label>
            <select id="detailversion" class="width110 select"></select>
        </p>
    </fieldset>

    <fieldset class="test"> 
        <legend>基础信息</legend> 
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>商品名称:</label>
            <span name="GoodsName" style="width:100px"></span>
        </p>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>商品编号:</label>
            <span name="GoodsNo" style="width:100px"></span>
        </p>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>OE号:&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <span name="OE" style="width:100px"></span>
        </p>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>标杆品牌:</label>
            <span name="BenchBrand" style="width:100px"></span>
        </p>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>标杆号:　</label>
            <span name="BenchNo" style="width:100px"></span>
        </p>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>适用车型:</label>
            <span name="carmodel" style="width:100px"></span>
        </p>
        <?php
        $organID = Commonmodel::getOrganID();
        $cate = MakeGoodsBrand::model()->findAll('OrganID=:organID and UserID=:userID', array(':organID' => $organID, 'userID' => $organID));
        $result = MakeGoodsCategory::model()->findAll('organID=:organID and userID=:userID', array(':organID' => $organID, ':userID' => $organID));
        $res=  Commonmodel::Getcpnames();
        ?>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left" >
            <label>商品品牌:</label>
            <?php echo CHtml::dropDownlist('GoodsBranddetail', '', CHtml::listData($cate, 'BrandID', 'BrandName'), array('class' => 'width110 select', 'empty' => '请选择品牌'))
            ?>
        </p>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left" >
            <label>商品类别:</label>
            <?php echo CHtml::dropDownlist('GoodsCategorydetail', '', CHtml::listData($result, "id", "name"), array('class' => 'width110 select', 'empty' => '请选择类别'))
            ?>
        </p>
    </fieldset>

    <!-- 参数信息 -->
    <fieldset> 
        <legend>标准名称参数信息</legend> 
        <p class="form-row" style="padding-left:20px;">
            <label>&nbsp;&nbsp;配件品类:</label>
            <?php echo CHtml::dropDownlist('leafCategory','',$res['cpnames'],array('class' => 'width250 select', 'id' => 'leafCategorydetial','empty'=>'请选择配件品类'));
            ?> 
        </p>
        <div id="detailparam"></div>
    </fieldset>

    <!-- 销售信息 -->
    <fieldset class="test"> 
        <legend>销售信息</legend> 
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>　现有库存：</label>
            <select name="inventory" class="select" style="width:60px">
                    <option value="1" selected="selected">有</option>
                    <option value="0">无</option>
                </select>
        </p>
        <p class="form-row" style="padding-left:20px; width: 200px;float:left">
            <label>发货天数：</label>
            <span name="Days" style="width:100px"></span>&nbsp;天
        </p>
        <p  style="padding-left:20px; width: 600px; clear:both; float:none;">
            <label>　　　备注：</label>
            <textarea name="Desc"style="width:500px;height:80px" readonly="readonly" onfocus="this.blur()"></textarea>
        </p>
    </fieldset> 

    <!-- 图片信息 -->
    <fieldset class="test" style="padding-bottom:15px" id="imagearea"> 
        <legend>商品图片</legend> 
        <div  id="imagesshow">
            <div style="float: left;"><a class="prevbutton" href="javascript:void(0)"> </a></div>
            <div class="jCarouselLite" id="jCarouselLite" style="float: left;">
                <ul>
                </ul>
            </div>
            <div style="display:inline;"><a class="nextbutton" href="javascript:void(0)"> </a></div>   
        </div>
    </fieldset>


</div>
<div id="detail-buttons">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#detaildg').dialog('close');">关闭</a>
</div>
<!--商品详情弹框结束-->
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jcarousellite_1.0.1.js'></script>
<script>
    //查看商品详情    
    function goodsdetail()
    {
        clearall();
        var row=$('#goods').datagrid('getSelected');
        if(!row)
        {
            $.messager.alert('操作提示','请先选中一条商品数据!','info');
            return;
        }
        var rows=$('#goods').datagrid('getSelections');
        if(rows.length>1)
        {
            $.messager.alert('操作提示','只能选中一条商品数据!','info');
            return;
        }
        //获取商品版本
        $.getJSON(Yii_baseUrl+'/maker/makegoods/Getversion',{'goodsID':row.goodsID},function(res){
            if(res)
            {
                var html='';
                $.each(res,function(k,v){
                    html+='<option value="'+v.version_name+'">'+v.version_name+'</option>';
                })
                $('#detailversion').append(html);
                $('#detailversion').attr('value',row.version_name);
            }
        })
    
        getversioninfo(row.version_name,row.goodsID);
        $('#detaildg').dialog({
            title:'商品详情',
            closed:false,
            iconCls: 'icon-search'
        })
    }

    //版本改变事件
    $('#detailversion').change(function()
    {
        var version_name=$(this).val();
        $('#detailparam').html('');
        var row=$('#goods').datagrid('getSelected');
        getversioninfo(version_name,row.goodsID) 
    })

    //获取版本信息
    function getversioninfo(versionname,goodsid)
    {
        //获取版本信息
        $.post(Yii_baseUrl+'/maker/makegoods/Getinfobyversion',{'goodsid':goodsid,'version_name':versionname},function(res){
            if(res)
            {
                var spanname=new Array();
                $('#detaildg').find('span').each(function(k,v){
                    if($(this).attr('name'))
                        spanname.push($(this).attr('name'));
                }) 
                var selectname=new Array(); 
                $('#detaildg').find('select').each(function(k,v){
                    if($(this).attr('name'))
                        selectname.push($(this).attr('name'));
                }) 
                //加载基础信息
                $.each(res.versioninfo,function(k,v){
                    if($.inArray(k,spanname)>-1)
                    {
                        $('#detaildg [name="'+k+'"]').html(v);
                    }
                    else if($.inArray(k,selectname)>-1)
                    {
                        $('#detaildg [name="'+k+'"]').attr('value',v);
                    }
                })
                //获取标准名称参数
                $.getJSON(Yii_baseUrl+'/maker/makegoods/Getstand',{'standID':res.versioninfo.leafCategory},function(r){
                    if(r)
                    {
                        var html='<table style="padding-left:30px">';
                        $.each(r,function(k,v){
                            html+='<tr><td style="padding:3px 10px 3px 30px"><label>'+v.name+':</label></td><td><span  keyid="'+v.id+'"></span></td></tr>';
                        })
                        html+='</table>';
                        $('#detailparam').append(html);
                        
                        //加载标准名称参数值
                        $.each(res.paramsvalue,function(k,v){
                            $('#detailparam span[keyid="'+k+'"]').html(v)
                        })
                    }
                })
                //备注
                $('#detaildg textarea').text(res.versioninfo.Desc);
                //禁用下拉框
                $('#detaildg select:gt(0)').attr('disabled',true); 
                $('#GoodsBranddetail').val(res.versioninfo.GoodsBrand);
                $('#GoodsCategorydetail').val(res.versioninfo.GoodsCategory);
                //加载图片
                if(res.imagesinfo.length>0)
                {
                    $('#imagearea').show();
                    var imghtml='';
                    $.each(res.imagesinfo,function(k,v){
                        imghtml+='<li><img src="'+Yii_uploadUrl+v+'" alt="" width="150" height="118"></li>';
                    })
                    $('#imagesshow ul').append(imghtml);
                    var showcount=res.imagesinfo.length<4?res.imagesinfo.length:3;
                    //设置宽度
                    if(res.imagesinfo.length>3)
                        $('.nextbutton,.prevbutton').show();
                    else
                        $('.nextbutton,.prevbutton').hide();
                    if(res.imagesinfo.length>3)
                        $('#imagesshow').attr('style','padding-left:65px');
                    else if(showcount==3)
                        $('#imagesshow').attr('style','padding-left:95px');
                    else if(showcount==2)
                        $('#imagesshow').attr('style','padding-left:180px');
                    else if(showcount==1)
                        $('#imagesshow').attr('style','padding-left:265px');
                    $("#jCarouselLite").jCarouselLite({
                        btnNext: ".nextbutton",
                        btnPrev: ".prevbutton",
                        scroll: 1,
                        visible:showcount,
                        circular: false
                    });
                }
                else{
                    $('#imagearea').hide();
                }
            }
    
        },'json')
    
    }

    //详情弹框关闭事件
//    $('#detaildg').dialog({
//        onClose:function()
//        {
//            $('#detailparam').html('');
//            $('#detailversion').html('');
//            $('#imagesshow ul').html('');
//            $('#imagearea').hide();
//        }
//
//    })

    $(function(){
        $('#imagearea').hide();
    })
    
    function clearall()
    {
        $('#detailparam').html('');
        $('#detailversion').html('');
        $('#imagesshow ul').html('');
        $('#imagearea').hide();
    }
</script>